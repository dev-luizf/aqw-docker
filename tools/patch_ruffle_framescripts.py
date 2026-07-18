#!/usr/bin/env python3
"""
Surgical in-place NOP for Ruffle-breaking AQW timeline frame scripts.

ONLY the frame scripts that throw #1009/#1010 under Ruffle — not generic
stop() timelines (NOP'ing those makes MovieClips keep animating).

Patches the first opcode to returnvoid (0x47). No ABC size change.
"""

from __future__ import annotations

import argparse
import shutil
import struct
import zlib
from dataclasses import dataclass
from pathlib import Path


RETURNVOID = 0x47
RETURNVALUE = 0x48


def encode_u30(n: int) -> bytes:
    out = bytearray()
    while True:
        b = n & 0x7F
        n >>= 7
        if n:
            out.append(b | 0x80)
        else:
            out.append(b)
            break
    return bytes(out)


def find_stop_multiname(abc: bytes) -> int | None:
    """Return a multiname index whose name is 'stop', or None."""
    r = AbcReader(abc)
    r.u16()
    r.u16()
    for _ in range(max(0, r.u30() - 1)):
        r.u30()
    for _ in range(max(0, r.u30() - 1)):
        r.u30()
    for _ in range(max(0, r.u30() - 1)):
        r.pos += 8
    string_count = r.u30()
    strings = [""]
    stop_idx = None
    for _ in range(max(0, string_count - 1)):
        n = r.u30()
        s = r.bytes_(n).decode("utf-8", "replace")
        strings.append(s)
        if s == "stop" and stop_idx is None:
            stop_idx = len(strings) - 1
    if stop_idx is None:
        return None

    for _ in range(max(0, r.u30() - 1)):
        r.u8()
        r.u30()
    for _ in range(max(0, r.u30() - 1)):
        c = r.u30()
        for _ in range(c):
            r.u30()

    multiname_count = r.u30()
    # Prefer QName (0x07); fall back to Multiname (0x09).
    qname_hit = None
    multi_hit = None
    for mi in range(1, multiname_count):
        kind = r.u8()
        name_idx = -1
        if kind in (0x07, 0x0D):
            r.u30()
            name_idx = r.u30()
            if name_idx == stop_idx and qname_hit is None:
                qname_hit = mi
        elif kind in (0x0F, 0x10):
            name_idx = r.u30()
            if name_idx == stop_idx and multi_hit is None:
                multi_hit = mi
        elif kind in (0x11, 0x12):
            pass
        elif kind in (0x09, 0x0E):
            name_idx = r.u30()
            r.u30()
            if name_idx == stop_idx and multi_hit is None:
                multi_hit = mi
        elif kind in (0x1B, 0x1C):
            r.u30()
        elif kind == 0x1D:
            r.u30()
            pcount = r.u30()
            for _ in range(pcount):
                r.u30()
        else:
            raise ValueError(f"unknown multiname kind {kind:#x}")
    return qname_hit if qname_hit is not None else multi_hit


def make_int_zero_return_stub(code_length: int) -> bytes:
    stub = bytes([0x24, 0x00, RETURNVALUE])  # pushbyte 0; returnvalue
    if len(stub) <= code_length:
        return stub
    return bytes([RETURNVOID])


def make_stop_stub(stop_mn: int | None, code_length: int) -> bytes:
    """
    Prefer: getlocal0 + callpropvoid(stop, 0) + returnvoid
    so timelines halt. Fall back to bare returnvoid if needed.
    """
    if stop_mn is not None:
        stub = bytes([0xD0, 0x4F]) + encode_u30(stop_mn) + bytes([0x00, RETURNVOID])
        if len(stub) <= code_length:
            return stub
    return bytes([RETURNVOID])


def find_qname_multinames(abc: bytes, wanted: set[str]) -> dict[str, int]:
    """First QName (0x07) multiname index for each string name."""
    r = AbcReader(abc)
    r.u16()
    r.u16()
    for _ in range(max(0, r.u30() - 1)):
        r.u30()
    for _ in range(max(0, r.u30() - 1)):
        r.u30()
    for _ in range(max(0, r.u30() - 1)):
        r.pos += 8
    string_count = r.u30()
    strings = [""]
    name_to_str: dict[str, int] = {}
    for _ in range(max(0, string_count - 1)):
        n = r.u30()
        s = r.bytes_(n).decode("utf-8", "replace")
        strings.append(s)
        if s in wanted and s not in name_to_str:
            name_to_str[s] = len(strings) - 1
    for _ in range(max(0, r.u30() - 1)):
        r.u8()
        r.u30()
    for _ in range(max(0, r.u30() - 1)):
        c = r.u30()
        for _ in range(c):
            r.u30()
    multiname_count = r.u30()
    found: dict[str, int] = {}
    # Prefer QName; fall back to Multiname (0x09).
    qname_hit: dict[str, int] = {}
    multi_hit: dict[str, int] = {}
    for mi in range(1, multiname_count):
        kind = r.u8()
        name_idx = -1
        if kind in (0x07, 0x0D):
            r.u30()
            name_idx = r.u30()
            if 0 < name_idx < len(strings):
                s = strings[name_idx]
                if s in wanted and s not in qname_hit:
                    qname_hit[s] = mi
        elif kind in (0x0F, 0x10):
            name_idx = r.u30()
        elif kind in (0x11, 0x12):
            pass
        elif kind in (0x09, 0x0E):
            name_idx = r.u30()
            r.u30()
            if 0 < name_idx < len(strings):
                s = strings[name_idx]
                if s in wanted and s not in multi_hit:
                    multi_hit[s] = mi
        elif kind in (0x1B, 0x1C):
            r.u30()
        elif kind == 0x1D:
            r.u30()
            pcount = r.u30()
            for _ in range(pcount):
                r.u30()
        else:
            raise ValueError(f"unknown multiname kind {kind:#x}")
    for s in wanted:
        if s in qname_hit:
            found[s] = qname_hit[s]
        elif s in multi_hit:
            found[s] = multi_hit[s]
    return found


def make_portrait_stub(
    method_name: str,
    abc: bytes,
    code_length: int,
    code_offset: int | None = None,
    orig_code: bytes | None = None,
) -> bytes | None:
    """
    hidePortraitTarget: jump to the original visible=false epilogue (known-good
    opcodes/multinames). Mid-body padded with returnvoid for the verifier.

    showPortraitBox: set local2.visible=true using the same Multiname/pushtrue
    encoding the original method used, then returnvoid + pad.

    orig_code: pristine method body (from .orig) when the SWF was already stubbed.
    """
    code = (
        orig_code
        if orig_code is not None
        else (abc[code_offset : code_offset + code_length] if code_offset is not None else None)
    )
    if code is None or len(code) != code_length or code_length < 8:
        return None

    if method_name == "hidePortraitTarget":
        # Original epilogue is the final getlex/ui … returnvoid block (~33 bytes).
        epi_len = 33
        if code_length <= epi_len + 6:
            return None
        epi = bytes(code[-epi_len:])
        if epi[0] != 0x60 or epi[-1] != RETURNVOID:
            return None
        target = code_length - epi_len
        # jump at offset 2 (after getlocal0+pushscope): target = 2 + 4 + s24
        s24 = target - 6
        if s24 < 0 or s24 > 0x7FFFFF:
            return None
        jump = bytes(
            [
                0xD0,
                0x30,
                0x10,
                s24 & 0xFF,
                (s24 >> 8) & 0xFF,
                (s24 >> 16) & 0xFF,
            ]
        )
        pad = bytes([RETURNVOID]) * (target - len(jump))
        return jump + pad + epi

    if method_name == "showPortraitBox":
        # Find last setproperty visible in the pristine body (mn after 0x61).
        vis_mn = None
        i = 0

        def read_u30(buf: bytes, pos: int) -> tuple[int, int]:
            result = 0
            shift = 0
            while True:
                b = buf[pos]
                pos += 1
                result |= (b & 0x7F) << shift
                if not (b & 0x80):
                    return result, pos
                shift += 7

        while i < len(code):
            op = code[i]
            i += 1
            if op == 0x61:  # setproperty
                mn, i = read_u30(code, i)
                vis_mn = mn  # last wins; final ops set visible=true
            elif op in (0x60, 0x66, 0x68, 0x5D, 0x5E, 0x80):
                _, i = read_u30(code, i)
            elif op in (0x46, 0x4A, 0x4E, 0x4F, 0x50):
                _, i = read_u30(code, i)
                _, i = read_u30(code, i)
            elif op in (0x10, 0x11, 0x12, 0x13, 0x14, 0x15, 0x16, 0x17, 0x18, 0x19, 0x1A):
                i += 3
            elif op == 0x24:
                i += 1
            elif op in (0x62, 0x63, 0x6C, 0x6D):
                _, i = read_u30(code, i)
            elif op == RETURNVOID:
                pass
            # other ops: best-effort; if we lose sync vis_mn may still be found earlier
        if vis_mn is None:
            names = find_qname_multinames(abc, {"visible"})
            vis_mn = names.get("visible")
        if vis_mn is None:
            return None
        # Use 0x26 like the original epilogue (not 0x21) — matches ASC output.
        stub = (
            bytes([0xD0, 0x30, 0xD2, 0x26])
            + bytes([0x61])
            + encode_u30(vis_mn)
            + bytes([RETURNVOID])
        )
        if len(stub) > code_length:
            return None
        return stub + bytes([RETURNVOID]) * (code_length - len(stub))

    return None


def load_orig_method_code(method_name: str) -> bytes | None:
    """Load pristine Game method body from Game_20150324.swf.orig."""
    orig = Path(__file__).resolve().parents[1] / "gamefiles" / "Game_20150324.swf.orig"
    if not orig.exists():
        return None
    try:
        _, raw, _ = read_swf(orig)
    except Exception:
        return None
    for tag, payload_off, length in iter_tags(raw):
        if tag not in (72, 82):
            continue
        payload = bytes(raw[payload_off : payload_off + length])
        abc_off, abc = extract_abc_from_doabc(payload) if tag == 82 else (0, payload)
        try:
            locs = parse_abc_method_bodies(abc)
        except Exception:
            continue
        for loc in locs:
            if loc.class_name == "Game" and loc.method_name == method_name:
                return bytes(abc[loc.code_offset : loc.code_offset + loc.code_length])
    return None

# Exact (class, method) pairs confirmed to throw under Ruffle.
EXACT_TARGETS: set[tuple[str, str]] = {
    # Game_44 — ads checkbox on main content clip
    ("cnt_181", "frame1"),
    # game menu — null children on these clips
    ("comp_73", "frame2"),
    ("comp_64", "frame2"),
    ("Button_91", "frame1"),
    ("GameMenu", "frame2"),
    # game menu — red button frame2 null-ref spam (#1009)
    ("cmpLongRedButton2_67", "frame2"),
    # game menu — NewMenuViewer Security/addChild failures
    ("NewMenuViewer_80", "frame1"),
    ("NewMenuViewer_80", "frame2"),
    ("NewMenuViewer_80", "frame26"),
    ("NewMenuViewer_80", "frame33"),
    ("NewMenuViewer_80", "frame42"),
    # hair Default.swf symbol timelines (#1009)
    ("Symbol12_3", "frame1"),
    ("Symbol8_9", "frame1"),
    ("Symbol10_8", "frame1"),
    ("Male_5", "frame1"),
    ("Male_6", "frame1"),
    # Yulgar map button
    ("Btn_140", "frame1"),
    # inventory popup — removeChild #2025 under Ruffle when reopening
    ("mcPopup_325", "frame2"),
    # Game3089 (spider) — not used in default Armagedom stack
    ("game_1_cnt_6", "frame38"),
}

# ABC methods that should early-return 0 (int) — e.g. Game3089 charCount before login data exists.
INT_ZERO_RETURN_TARGETS: set[tuple[str, str]] = {
    ("Game", "charCount"),
}

# Non-MovieClip / instance methods: bare returnvoid only (never callpropvoid stop).
# stop+return on Chat caused #1069 "Property stop not found on Chat".
RETURNVOID_ONLY_TARGETS: set[tuple[str, str]] = {
    ("Chat", "startWindowTimer"),
}

# Custom in-place stubs (must fit in existing method body length).
# hidePortraitTarget: jump to original hide-chrome epilogue (correct pushfalse=0x27).
# showPortraitBox must NOT be stubbed — that skipped head/face loading (black avatars)
# and skipped pAV assignment (#1010 on portraitClick).
CUSTOM_STUB_TARGETS: set[tuple[str, str]] = set()

# Methods previously stubbed that must be restored to pristine .orig bytecode.
RESTORE_ORIG_TARGETS: set[tuple[str, str]] = set()


class AbcReader:
    def __init__(self, data: bytes, start: int = 0):
        self.data = data
        self.pos = start

    def u8(self) -> int:
        v = self.data[self.pos]
        self.pos += 1
        return v

    def u16(self) -> int:
        v = struct.unpack_from("<H", self.data, self.pos)[0]
        self.pos += 2
        return v

    def u30(self) -> int:
        result = 0
        shift = 0
        while True:
            b = self.data[self.pos]
            self.pos += 1
            result |= (b & 0x7F) << shift
            if not (b & 0x80):
                break
            shift += 7
            if shift > 35:
                raise ValueError("u30 too long")
        return result

    def bytes_(self, n: int) -> bytes:
        v = self.data[self.pos : self.pos + n]
        self.pos += n
        return v


@dataclass
class MethodBodyLoc:
    class_name: str
    method_name: str
    method_idx: int
    max_stack_offset: int
    max_stack: int
    code_offset: int
    code_length: int


def skip_metadata_info(r: AbcReader) -> None:
    r.u30()
    item_count = r.u30()
    for _ in range(item_count):
        r.u30()
        r.u30()


def skip_traits(r: AbcReader) -> list[tuple[int, int, int]]:
    out: list[tuple[int, int, int]] = []
    trait_count = r.u30()
    for _ in range(trait_count):
        name = r.u30()
        kind = r.u8()
        trait_kind = kind & 0x0F
        attr = kind >> 4
        method_idx = -1
        if trait_kind in (0, 6):
            r.u30()
            r.u30()
            vindex = r.u30()
            if vindex:
                r.u30()
        elif trait_kind in (1, 2, 3, 5):
            r.u30()
            method_idx = r.u30()
        elif trait_kind == 4:
            r.u30()
            r.u30()
        else:
            raise ValueError(f"unknown trait kind {trait_kind}")
        if attr & 0x4:
            mcount = r.u30()
            for _ in range(mcount):
                r.u30()
        out.append((name, trait_kind, method_idx))
    return out


def parse_abc_method_bodies(abc: bytes) -> list[MethodBodyLoc]:
    r = AbcReader(abc)
    r.u16()
    major = r.u16()
    if major < 46:
        raise ValueError(f"unexpected ABC version {major}")

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
    strings = [""]
    for _ in range(max(0, string_count - 1)):
        n = r.u30()
        strings.append(r.bytes_(n).decode("utf-8", "replace"))

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
    multinames: list[tuple[int, int]] = [(-1, -1)]
    for _ in range(max(0, multiname_count - 1)):
        kind = r.u8()
        name_idx = -1
        if kind in (0x07, 0x0D):
            r.u30()
            name_idx = r.u30()
        elif kind in (0x0F, 0x10):
            name_idx = r.u30()
        elif kind in (0x11, 0x12):
            pass
        elif kind in (0x09, 0x0E):
            name_idx = r.u30()
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
        multinames.append((kind, name_idx))

    def mn_name(idx: int) -> str:
        if idx <= 0 or idx >= len(multinames):
            return ""
        _, name_idx = multinames[idx]
        if name_idx <= 0 or name_idx >= len(strings):
            return ""
        return strings[name_idx]

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
    instances: list[tuple[str, list[tuple[int, int, int]]]] = []
    for _ in range(class_count):
        name_mn = r.u30()
        r.u30()
        flags = r.u8()
        if flags & 0x08:
            r.u30()
        ifcount = r.u30()
        for _ in range(ifcount):
            r.u30()
        r.u30()
        traits = skip_traits(r)
        instances.append((mn_name(name_mn), traits))

    for _ in range(class_count):
        r.u30()
        skip_traits(r)

    script_count = r.u30()
    for _ in range(script_count):
        r.u30()
        skip_traits(r)

    method_to_names: dict[int, list[tuple[str, str]]] = {}
    for cname, traits in instances:
        for name_mn_idx, tkind, method_idx in traits:
            if method_idx < 0 or tkind not in (1, 2, 3, 5):
                continue
            method_to_names.setdefault(method_idx, []).append((cname, mn_name(name_mn_idx)))

    body_count = r.u30()
    locs: list[MethodBodyLoc] = []
    for _ in range(body_count):
        method_idx = r.u30()
        max_stack_offset = r.pos
        max_stack = r.u30()
        r.u30()
        r.u30()
        r.u30()
        code_length = r.u30()
        code_offset = r.pos
        r.pos += code_length
        exc_count = r.u30()
        for _ in range(exc_count):
            r.u30()
            r.u30()
            r.u30()
            r.u30()
            r.u30()
        skip_traits(r)
        for cname, mname in method_to_names.get(method_idx, [("", f"method#{method_idx}")]):
            locs.append(
                MethodBodyLoc(
                    class_name=cname,
                    method_name=mname,
                    method_idx=method_idx,
                    max_stack_offset=max_stack_offset,
                    max_stack=max_stack,
                    code_offset=code_offset,
                    code_length=code_length,
                )
            )
    return locs


def read_swf(path: Path) -> tuple[bytes, bytes, bool]:
    data = path.read_bytes()
    sig = data[:3]
    if sig == b"CWS":
        return data, data[:8] + zlib.decompress(data[8:]), True
    if sig == b"FWS":
        return data, data, False
    raise ValueError(f"unsupported SWF sig {sig!r}")


def write_swf(path: Path, raw: bytes, compressed: bool) -> None:
    ver = raw[3]
    if compressed:
        body = zlib.compress(raw[8:], 9)
        out = b"CWS" + bytes([ver]) + struct.pack("<I", len(raw)) + body
    else:
        out = b"FWS" + bytes([ver]) + struct.pack("<I", len(raw)) + raw[8:]
        out = out[:4] + struct.pack("<I", len(out)) + out[8:]
    path.write_bytes(out)


def iter_tags(raw: bytes):
    i = 8
    nbits = raw[i] >> 3
    rect_bits = 5 + nbits * 4
    i += (rect_bits + 7) // 8
    i += 4
    while i + 2 <= len(raw):
        code_len = struct.unpack_from("<H", raw, i)[0]
        tag = code_len >> 6
        length = code_len & 0x3F
        hdr = 2
        if length == 0x3F:
            length = struct.unpack_from("<I", raw, i + 2)[0]
            hdr = 6
        payload_off = i + hdr
        yield tag, payload_off, length
        i = payload_off + length
        if tag == 0:
            break


def extract_abc_from_doabc(payload: bytes) -> tuple[int, bytes]:
    name_end = payload.index(b"\x00", 4)
    abc_off = name_end + 1
    return abc_off, payload[abc_off:]


def patch_swf(path: Path, targets: set[tuple[str, str]], backup: bool = True) -> list[str]:
    _original, raw, compressed = read_swf(path)
    raw_mutable = bytearray(raw)
    report: list[str] = []
    total = 0

    for tag, payload_off, length in iter_tags(raw):
        if tag not in (72, 82):
            continue
        payload = bytes(raw_mutable[payload_off : payload_off + length])
        abc_off_in_payload, abc = (
            extract_abc_from_doabc(payload) if tag == 82 else (0, payload)
        )
        try:
            locs = parse_abc_method_bodies(abc)
        except Exception as e:
            report.append(f"{path.name}: ABC parse failed: {e}")
            continue

        abc_abs = payload_off + abc_off_in_payload
        stop_mn = find_stop_multiname(abc)
        seen: set[int] = set()
        for loc in locs:
            if loc.method_idx in seen or loc.code_length < 1:
                continue
            key = (loc.class_name, loc.method_name)
            if (
                key not in targets
                and key not in INT_ZERO_RETURN_TARGETS
                and key not in RETURNVOID_ONLY_TARGETS
                and key not in CUSTOM_STUB_TARGETS
                and key not in RESTORE_ORIG_TARGETS
            ):
                continue
            abs_code = abc_abs + loc.code_offset
            if key in RESTORE_ORIG_TARGETS:
                orig_code = load_orig_method_code(loc.method_name)
                if orig_code is None or len(orig_code) != loc.code_length:
                    report.append(
                        f"{path.name}: skip restore {loc.class_name}/{loc.method_name} "
                        f"(orig unavailable or length mismatch)"
                    )
                    continue
                stub = orig_code
                kind = f"restore-orig({len(stub)}b)"
            elif key in CUSTOM_STUB_TARGETS:
                # Always build from pristine .orig body so multinames/epilogue match ASC output.
                orig_code = load_orig_method_code(loc.method_name)
                if orig_code is None or len(orig_code) != loc.code_length:
                    report.append(
                        f"{path.name}: skip {loc.class_name}/{loc.method_name} "
                        f"(orig body unavailable or length mismatch "
                        f"orig={None if orig_code is None else len(orig_code)} "
                        f"cur={loc.code_length})"
                    )
                    continue
                stub = make_portrait_stub(
                    loc.method_name,
                    abc,
                    loc.code_length,
                    orig_code=orig_code,
                )
                if stub is None:
                    report.append(
                        f"{path.name}: skip {loc.class_name}/{loc.method_name} "
                        f"(custom stub unavailable)"
                    )
                    continue
                kind = f"portrait-stub({len(stub)}b)"
            elif key in INT_ZERO_RETURN_TARGETS:
                stub = make_int_zero_return_stub(loc.code_length)
                kind = "return0"
            elif key in RETURNVOID_ONLY_TARGETS:
                stub = bytes([RETURNVOID])
                kind = "returnvoid"
            else:
                stub = make_stop_stub(stop_mn, loc.code_length)
                kind = "stop+return" if len(stub) > 1 else "returnvoid"
            old = bytes(raw_mutable[abs_code : abs_code + len(stub)])
            raw_mutable[abs_code : abs_code + len(stub)] = stub
            seen.add(loc.method_idx)
            total += 1
            report.append(
                f"{path.name}: patch {loc.class_name}/{loc.method_name} "
                f"→ {kind} (was {old.hex()})"
            )

    if total and backup:
        bak = path.with_suffix(path.suffix + ".pre-ruffle-nop.bak")
        # Keep the pristine original backup if present; otherwise create one.
        if not bak.exists():
            shutil.copy2(path, bak)
            report.append(f"backup → {bak.name}")

    if total:
        write_swf(path, bytes(raw_mutable), compressed)
        report.append(f"wrote {path} ({total} NOPs)")
    else:
        report.append(f"{path.name}: no matching targets")
    return report


def main() -> None:
    ap = argparse.ArgumentParser()
    ap.add_argument(
        "--root",
        type=Path,
        default=Path(__file__).resolve().parents[1] / "gamefiles",
    )
    ap.add_argument("--no-backup", action="store_true", help="do not write *.pre-ruffle-nop.bak")
    args = ap.parse_args()
    root = args.root

    jobs: list[tuple[Path, set[tuple[str, str]]]] = [
        # Game_20150324 uses mcPopup_270 (Game_44 uses mcPopup_325).
        # hidePortraitTarget / ui_* / Chat.startWindowTimer: #1009 under Ruffle
        # aborts frame19 before stop() → timeline drifts to Account (newchar).
        (
            root / "Game_20150324.swf",
            {
                ("mcPopup_270", "frame2"),
                ("ui_158", "frame1"),
                ("ui_186", "frame1"),
            },
        ),
        (
            root / "Game_44.swf",
            {
                ("mcPopup_325", "frame2"),
                ("cnt_181", "frame1"),
            },
        ),
        (
            root / "OficialClient1.swf",
            {
                ("mcPopup_325", "frame2"),
                ("cnt_181", "frame1"),
            },
        ),
        (
            root / "spider.swf",
            {
                ("game_1_cnt_login_6", "frame38"),
            },
        ),
        (
            root / "gameMenu" / "AWMenu02022017.swf",
            {
                ("comp_73", "frame2"),
                ("comp_64", "frame2"),
                ("Button_91", "frame1"),
                ("GameMenu", "frame2"),
                ("cmpLongRedButton2_67", "frame2"),
                ("NewMenuViewer_80", "frame1"),
                ("NewMenuViewer_80", "frame2"),
                ("NewMenuViewer_80", "frame26"),
                ("NewMenuViewer_80", "frame33"),
                ("NewMenuViewer_80", "frame42"),
            },
        ),
        (root / "maps" / "Battleon" / "YulgarV4.swf", {("Btn_140", "frame1")}),
    ]
    menu_targets = {
        ("comp_73", "frame2"),
        ("comp_64", "frame2"),
        ("Button_91", "frame1"),
        ("GameMenu", "frame2"),
        ("cmpLongRedButton2_67", "frame2"),
        ("NewMenuViewer_80", "frame1"),
        ("NewMenuViewer_80", "frame2"),
        ("NewMenuViewer_80", "frame26"),
        ("NewMenuViewer_80", "frame33"),
        ("NewMenuViewer_80", "frame42"),
    }
    # Keep other menu copies in sync with the active one (DB may point at any).
    for menu in sorted((root / "gameMenu").glob("AWMenu*.swf")):
        if menu.name == "AWMenu02022017.swf":
            continue
        jobs.append((menu, menu_targets))
    # Yulgar aliases (real files only)
    for name in ("Eyulgaraw.swf", "Christmasyulgar.swf"):
        p = root / "maps" / "Battleon" / name
        if p.exists() and not p.is_symlink():
            jobs.append((p, {("Btn_140", "frame1")}))
    # Do not stub Greenguard MainTimeline scripts. Those frames assign setup
    # properties such as intSpeed, pads, and actions before cellSetup runs.
    hair_targets = {
        ("Symbol12_3", "frame1"),
        ("Symbol8_9", "frame1"),
        ("Symbol10_8", "frame1"),
        ("Male_5", "frame1"),
        ("Male_6", "frame1"),
    }
    for hair in (
        root / "hair" / "M" / "Default.swf",
        root / "hair" / "F" / "Default.swf",
    ):
        if hair.exists() and not hair.is_symlink():
            continue  # keep Default.swf timelines intact for skeleton sync

    for path, targets in jobs:
        if not path.exists():
            print(f"missing {path}")
            continue
        for line in patch_swf(path, targets, backup=not args.no_backup):
            print(line)


if __name__ == "__main__":
    main()
