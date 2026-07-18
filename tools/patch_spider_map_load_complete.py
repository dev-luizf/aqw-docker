#!/usr/bin/env python3
"""
Ruffle map-load hang fix for spider.swf.

Problem:
  Heavy map SWFs (notably Greenguard AWWest) reach 100% download under Ruffle,
  but Loader Event.COMPLETE never fires. A progress-only retry is also unsafe:
  the final progress event can happen before Loader.content exists, and repeated
  100% callbacks can initialize the same monsters more than once.

Fix:
  At 100%, remove the loader listeners and register onMapLoadComplete as a
  temporary ENTER_FRAME handler on World. onMapLoadComplete quietly returns
  while ldr_map.content is null. Once content exists, it removes its ENTER_FRAME
  listener and executes the original completion body exactly once.

  Normal maps still use Event.COMPLETE. The added content guard and harmless
  ENTER_FRAME removal also make their existing completion path safe.

  Monster assets are queued after the map is initialized. The server
  deduplicates monster definitions, so the normal all-definition completion
  gate remains safe and ensures cell setup has every required linkage.
"""
from __future__ import annotations

import argparse
import shutil
import struct
import sys
from pathlib import Path

sys.path.insert(0, str(Path(__file__).resolve().parent))
from patch_ruffle_framescripts import (  # noqa: E402
    AbcReader,
    encode_u30,
    extract_abc_from_doabc,
    iter_tags,
    parse_abc_method_bodies,
    read_swf,
    skip_metadata_info,
    skip_traits,
    write_swf,
)


def _rewrite_method_body(
    abc: bytearray,
    method_idx: int,
    new_code: bytes,
    *,
    insert_at: int | None = None,
    maxstack: int | None = None,
) -> None:
    """Replace method code bytes and update code_length; optionally bump maxstack."""
    old_locs = parse_abc_method_bodies(bytes(abc))
    old_target = next((loc for loc in old_locs if loc.method_idx == method_idx), None)
    if old_target is None:
        raise RuntimeError(f"method_idx {method_idx} not found")
    delta = len(new_code) - old_target.code_length

    r = AbcReader(bytes(abc))
    r.u16()
    r.u16()
    int_count = r.u30()
    for _ in range(max(0, int_count - 1)):
        r.u30()
    uint_count = r.u30()
    for _ in range(max(0, uint_count - 1)):
        r.u30()
    double_count = r.u30()
    for _ in range(max(0, double_count - 1)):
        r.pos += 8
    string_count = r.u30()
    for _ in range(max(0, string_count - 1)):
        n = r.u30()
        r.pos += n
    namespace_count = r.u30()
    for _ in range(max(0, namespace_count - 1)):
        r.u8()
        r.u30()
    ns_set_count = r.u30()
    for _ in range(max(0, ns_set_count - 1)):
        c = r.u30()
        for _ in range(c):
            r.u30()
    multiname_count = r.u30()
    for _ in range(max(0, multiname_count - 1)):
        kind = r.u8()
        if kind in (0x07, 0x0D):
            r.u30()
            r.u30()
        elif kind in (0x0F, 0x10):
            r.u30()
        elif kind in (0x11, 0x12):
            pass
        elif kind in (0x09, 0x0E):
            r.u30()
            r.u30()
        elif kind in (0x1B, 0x1C):
            r.u30()
        elif kind == 0x1D:
            r.u30()
            pcount = r.u30()
            for _ in range(pcount):
                r.u30()
        else:
            raise ValueError(f"unknown multiname kind {kind:#x}")
    method_count = r.u30()
    for _ in range(method_count):
        pcount = r.u30()
        r.u30()
        for _ in range(pcount):
            r.u30()
        r.u30()
        flags = r.u8()
        if flags & 0x08:
            ocount = r.u30()
            for _ in range(ocount):
                r.u30()
                r.u8()
        if flags & 0x80:
            for _ in range(pcount):
                r.u30()
    metadata_count = r.u30()
    for _ in range(metadata_count):
        skip_metadata_info(r)
    class_count = r.u30()
    for _ in range(class_count):
        r.u30()
        r.u30()
        flags = r.u8()
        if flags & 0x08:
            r.u30()
        ifcount = r.u30()
        for _ in range(ifcount):
            r.u30()
        r.u30()
        skip_traits(r)
    for _ in range(class_count):
        r.u30()
        skip_traits(r)
    script_count = r.u30()
    for _ in range(script_count):
        r.u30()
        skip_traits(r)
    body_count = r.u30()
    for _ in range(body_count):
        mid = r.u30()
        maxstack_pos = r.pos
        cur_maxstack = r.u30()
        r.u30()  # local_count
        r.u30()  # init_scope
        r.u30()  # max_scope
        code_length_pos = r.pos
        code_length = r.u30()
        code_start = r.pos
        if mid == method_idx:
            tail_start = code_start + code_length
            exc_count_pos = tail_start
            exc_count = AbcReader(bytes(abc[exc_count_pos:])).u30()
            if exc_count and delta and insert_at is not None:
                pos = exc_count_pos + len(encode_u30(exc_count))
                for _ in range(exc_count):
                    for _field in range(3):
                        val_pos = pos
                        val = AbcReader(bytes(abc[pos:])).u30()
                        enc = encode_u30(val)
                        pos += len(enc)
                        if val >= insert_at:
                            abc[val_pos : val_pos + len(enc)] = encode_u30(val + delta)
            new_max = cur_maxstack if maxstack is None else max(cur_maxstack, maxstack)
            abc[:] = (
                abc[:maxstack_pos]
                + encode_u30(new_max)
                + abc[maxstack_pos + len(encode_u30(cur_maxstack)) : code_length_pos]
                + encode_u30(len(new_code))
                + new_code
                + abc[code_start + code_length :]
            )
            return
        r.pos = code_start + code_length
        for _ in range(r.u30()):
            r.u30()
            r.u30()
            r.u30()
            r.u30()
            r.u30()
        skip_traits(r)
    raise RuntimeError(f"method_idx {method_idx} body not found during rewrite")


def replace_tag_payload(raw: bytearray, payload_off: int, old_length: int, new_payload: bytes) -> None:
    if payload_off >= 6:
        tag_code = struct.unpack_from("<H", raw, payload_off - 6)[0]
        if (tag_code & 0x3F) == 0x3F:
            long_len = struct.unpack_from("<I", raw, payload_off - 4)[0]
            if long_len == old_length:
                tag_start = payload_off - 6
            else:
                tag_start = payload_off - 2
        else:
            tag_start = payload_off - 2
    else:
        tag_start = payload_off - 2
    tag_code = struct.unpack_from("<H", raw, tag_start)[0]
    tag = tag_code >> 6
    new_len = len(new_payload)
    if new_len < 0x3F:
        new_hdr = struct.pack("<H", (tag << 6) | new_len)
    else:
        new_hdr = struct.pack("<H", (tag << 6) | 0x3F) + struct.pack("<I", new_len)
    raw[:] = raw[:tag_start] + new_hdr + new_payload + raw[payload_off + old_length :]


# Pristine onMapLoadProgress ends @62..70:
#   add; showConn(...); debugline; returnvoid
_PRISTINE_TAIL = bytes([0xA0, 0x4F, 0x95, 0x89, 0x01, 0x01, 0xF0, 0x4A, 0x47])

# After showConn (@68), append the 100% handoff. `ifne` jumps directly to the
# final return for ordinary progress events. At 100%, remove all LoaderInfo
# listeners and register this.onMapLoadComplete on this ENTER_FRAME.
_PROGRESS_SUFFIX = bytes(
    [
        0xD2,
        0x24,
        0x64,
        0x14,
        0x17,
        0x00,
        0x00,  # getlocal2; pushbyte 100; ifne → return
        0xD0,
        0x4F,
        0xF4,
        0x1F,
        0x00,  # removeMapListeners()
        0xD0,  # this (addEventListener receiver)
        0x60,
        0x10,  # Event
        0x66,
        0xA2,
        0x47,  # Event.ENTER_FRAME
        0xD0,
        0x66,
        0xF8,
        0x1F,
        0x27,  # this.onMapLoadComplete, false
        0x24,
        0x00,  # priority 0
        0x26,  # weak reference
        0x4F,
        0xED,
        0x31,
        0x05,  # addEventListener(...), 5 args
        0x47,
    ]
)

_PROGRESS_MARKER = bytes(
    [0xD0, 0x60, 0x10, 0x66, 0xA2, 0x47, 0xD0, 0x66, 0xF8, 0x1F]
)

# Original onMapLoadComplete prologue through its parameter debug record.
_COMPLETE_PROLOGUE = bytes(
    [0xF1, 0xDC, 0x78, 0xF0, 0x54, 0xD0, 0x30, 0xEF, 0x01, 0xBD, 0x0F, 0x00, 0x54]
)

# Guard Loader.content, then unregister the temporary ENTER_FRAME handler.
_COMPLETE_GUARD = bytes(
    [
        0xD0,
        0x66,
        0xD9,
        0x1E,
        0x66,
        0x86,
        0x89,
        0x01,  # this.ldr_map.content
        0x20,
        0xAB,  # == null
        0x12,
        0x01,
        0x00,
        0x00,  # iffalse → remove ENTER_FRAME listener
        0x47,  # content is not ready: retry next frame
        0xD0,  # this (removeEventListener receiver)
        0x60,
        0x10,  # Event
        0x66,
        0xA2,
        0x47,  # Event.ENTER_FRAME
        0xD0,
        0x66,
        0xF8,
        0x1F,  # this.onMapLoadComplete
        0x4F,
        0xE7,
        0x31,
        0x02,  # removeEventListener(...), 2 args
    ]
)

# Start of the original body after its two diagnostic trace() calls. Those
# traces dereference e.target.url and are invalid for an ENTER_FRAME event.
_COMPLETE_BODY_MARKER = bytes([0xF0, 0x57, 0xD0, 0x66, 0xB0, 0x01])

# Keep the normal monster gate: onMapLoadComplete waits, and
# onMonLoadComplete enters only when every (deduplicated) monster definition is
# available. The server-side Rooms patch ensures mondef does not contain a
# separate duplicate loader for every monster placement.
_MONSTER_INIT_WAIT = bytes(
    [0x10, 0x07, 0x00, 0x00, 0xF0, 0x62, 0xD0, 0x4F, 0xFA, 0x1F, 0x00]
)
_MONSTER_INIT_ASYNC = bytes(
    [0x10, 0x00, 0x00, 0x00, 0xF0, 0x62, 0xD0, 0x4F, 0xFA, 0x1F, 0x00]
)
_MONSTER_LENGTH = bytes(
    [0xD0, 0x66, 0xE7, 0x1E, 0x66, 0xF9, 0x08]
)
_MONSTER_DEFINITION_LENGTH = bytes(
    [0xD0, 0x66, 0xE5, 0x1E, 0x66, 0xF9, 0x08]
)
_PUSH_ONE_PADDED = bytes(
    [0x24, 0x01, 0x02, 0x02, 0x02, 0x02, 0x02]
)
_MONSTER_COMPLETE_ALL = (
    _MONSTER_LENGTH
    + _MONSTER_DEFINITION_LENGTH
    + bytes([0x14, 0x08, 0x00, 0x00])
)
_MONSTER_COMPLETE_DISABLED = (
    _MONSTER_LENGTH
    + _MONSTER_DEFINITION_LENGTH
    + bytes([0x10, 0x08, 0x00, 0x00])
)
_MONSTER_COMPLETE_FIRST = (
    _MONSTER_LENGTH
    + _PUSH_ONE_PADDED
    + bytes([0x14, 0x08, 0x00, 0x00])
)


def _patch_monster_completion_gate(abc: bytearray) -> list[str]:
    """Restore entry after all deduplicated monster definitions complete."""
    report: list[str] = []
    locs = parse_abc_method_bodies(bytes(abc))
    by_name = {(loc.class_name, loc.method_name): loc for loc in locs}

    complete = by_name.get(("World", "onMapLoadComplete"))
    if complete is None:
        raise RuntimeError("onMapLoadComplete not found for monster gate")
    complete_code = bytes(
        abc[complete.code_offset : complete.code_offset + complete.code_length]
    )
    if _MONSTER_INIT_ASYNC in complete_code:
        complete_code = complete_code.replace(
            _MONSTER_INIT_ASYNC, _MONSTER_INIT_WAIT, 1
        )
        _rewrite_method_body(abc, complete.method_idx, complete_code)
        report.append("restored delayed entry after initMonsters")
    elif _MONSTER_INIT_WAIT in complete_code:
        report.append("delayed monster entry already present")
    else:
        raise RuntimeError("onMapLoadComplete monster gate has an unexpected body")

    # Reparse for the second method after rewriting the first body.
    locs = parse_abc_method_bodies(bytes(abc))
    by_name = {(loc.class_name, loc.method_name): loc for loc in locs}
    mon_complete = by_name.get(("World", "onMonLoadComplete"))
    if mon_complete is None:
        raise RuntimeError("onMonLoadComplete not found")
    mon_code = bytes(
        abc[
            mon_complete.code_offset :
            mon_complete.code_offset + mon_complete.code_length
        ]
    )
    if _MONSTER_COMPLETE_ALL in mon_code:
        report.append("all-monster completion gate already present")
    elif _MONSTER_COMPLETE_DISABLED in mon_code:
        mon_code = mon_code.replace(
            _MONSTER_COMPLETE_DISABLED, _MONSTER_COMPLETE_ALL, 1
        )
        _rewrite_method_body(abc, mon_complete.method_idx, mon_code)
        report.append("restored all-monster completion gate")
    elif _MONSTER_COMPLETE_FIRST in mon_code:
        mon_code = mon_code.replace(
            _MONSTER_COMPLETE_FIRST, _MONSTER_COMPLETE_ALL, 1
        )
        _rewrite_method_body(abc, mon_complete.method_idx, mon_code)
        report.append("replaced early entry with all-monster completion gate")
    else:
        raise RuntimeError("onMonLoadComplete gate has an unexpected body")

    return report


def patch_swf(path: Path, backup: bool = True) -> list[str]:
    report: list[str] = []
    _orig, raw, compressed = read_swf(path)
    raw_mutable = bytearray(raw)
    patched = False

    for tag, payload_off, length in iter_tags(raw):
        if tag not in (72, 82):
            continue
        payload = bytes(raw_mutable[payload_off : payload_off + length])
        abc_off_in_payload, abc = (
            extract_abc_from_doabc(payload) if tag == 82 else (0, payload)
        )
        try:
            locs = parse_abc_method_bodies(abc)
        except Exception as exc:
            report.append(f"{path.name}: ABC parse failed: {exc}")
            continue

        progress = next(
            (loc for loc in locs if loc.class_name == "World" and loc.method_name == "onMapLoadProgress"),
            None,
        )
        if progress is None:
            report.append(f"{path.name}: onMapLoadProgress not found")
            continue

        # Verify snippets exist in pristine World methods
        by_name = {(l.class_name, l.method_name): l for l in locs}
        content_snip = bytes([0xD0, 0x66, 0xD9, 0x1E, 0x66, 0x86, 0x89, 0x01])
        complete_loc = by_name.get(("World", "onMapLoadComplete"))
        if complete_loc is None or content_snip not in abc[
            complete_loc.code_offset : complete_loc.code_offset + complete_loc.code_length
        ]:
            report.append(f"{path.name}: onMapLoadComplete missing ldr_map.content snippet")
            continue

        code = abc[progress.code_offset : progress.code_offset + progress.code_length]
        if _PROGRESS_MARKER in code:
            # Early versions of this patch used maxstack=5, but
            # addEventListener(receiver + 5 args) requires six stack slots.
            abc_mut = bytearray(abc)
            _rewrite_method_body(
                abc_mut,
                progress.method_idx,
                code,
                maxstack=6,
            )
            monster_report = _patch_monster_completion_gate(abc_mut)
            report.append(
                f"{path.name}: ENTER_FRAME map fallback already present; "
                "ensured progress maxstack>=6"
            )
            report.extend(f"{path.name}: {line}" for line in monster_report)
            new_payload = payload[:abc_off_in_payload] + bytes(abc_mut)
            replace_tag_payload(raw_mutable, payload_off, length, new_payload)
            patched = True
            continue
        if len(code) < 71 or code[62:71] != _PRISTINE_TAIL:
            report.append(
                f"{path.name}: onMapLoadProgress unexpected tail "
                f"({code[62:71].hex() if len(code) >= 71 else code.hex()})"
            )
            continue

        new_code = code[:68] + _PROGRESS_SUFFIX
        abc_mut = bytearray(abc)
        _rewrite_method_body(
            abc_mut,
            progress.method_idx,
            new_code,
            insert_at=68,
            maxstack=6,
        )

        # Reparse after the first body expansion so the completion method's
        # shifted code offset is current.
        updated_locs = parse_abc_method_bodies(bytes(abc_mut))
        updated_complete = next(
            (
                loc
                for loc in updated_locs
                if loc.class_name == "World"
                and loc.method_name == "onMapLoadComplete"
            ),
            None,
        )
        if updated_complete is None:
            raise RuntimeError("onMapLoadComplete disappeared after progress rewrite")
        complete_code = bytes(
            abc_mut[
                updated_complete.code_offset :
                updated_complete.code_offset + updated_complete.code_length
            ]
        )
        body_at = complete_code.find(_COMPLETE_BODY_MARKER)
        if not complete_code.startswith(_COMPLETE_PROLOGUE) or body_at < 0:
            raise RuntimeError("onMapLoadComplete has an unexpected body")
        new_complete_code = (
            _COMPLETE_PROLOGUE
            + _COMPLETE_GUARD
            + complete_code[body_at:]
        )
        _rewrite_method_body(
            abc_mut,
            updated_complete.method_idx,
            new_complete_code,
            insert_at=body_at,
            maxstack=5,
        )
        monster_report = _patch_monster_completion_gate(abc_mut)
        report.append(
            f"{path.name}: 100% ENTER_FRAME handoff "
            f"(progress {len(code)}->{len(new_code)}, "
            f"complete {len(complete_code)}->{len(new_complete_code)}, "
            "progress maxstack>=6)"
        )
        report.extend(f"{path.name}: {line}" for line in monster_report)

        new_payload = payload[:abc_off_in_payload] + bytes(abc_mut)
        replace_tag_payload(raw_mutable, payload_off, length, new_payload)
        patched = True

    if not patched:
        report.append(f"{path.name}: no patches applied")
        return report

    if backup:
        bak = path.with_suffix(path.suffix + ".pre-map-complete.bak")
        if not bak.exists():
            shutil.copy2(path, bak)
            report.append(f"backup → {bak.name}")

    write_swf(path, bytes(raw_mutable), compressed)
    report.append(f"wrote {path}")
    return report


def main() -> None:
    ap = argparse.ArgumentParser()
    ap.add_argument(
        "--swf",
        type=Path,
        default=Path(__file__).resolve().parents[1] / "gamefiles" / "spider.swf",
    )
    ap.add_argument("--no-backup", action="store_true")
    args = ap.parse_args()
    if not args.swf.exists():
        raise SystemExit(f"missing {args.swf}")
    for line in patch_swf(args.swf, backup=not args.no_backup):
        print(line)


if __name__ == "__main__":
    main()
