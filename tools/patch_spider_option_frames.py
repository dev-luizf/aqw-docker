#!/usr/bin/env python3
"""
Defer non-General option-frame setup until Ruffle has constructed the frame.

The legacy client runs each mcOption frame script while Ruffle is still binding
the named timeline children. setUpFrame() consequently sees null buttons/text
fields, throws #1009 before stop(), and the timeline falls through into the
next settings tab. Stop the timeline first and schedule setup for the next
event-loop turn, when all frame children are available.
"""

from __future__ import annotations

import argparse
import shutil
from pathlib import Path

from patch_ruffle_framescripts import (
    encode_u30,
    extract_abc_from_doabc,
    find_qname_multinames,
    iter_tags,
    parse_abc_method_bodies,
    read_swf,
    write_swf,
)


TARGET_METHODS = {"frame1", "frame10", "frame18", "frame26"}


def deferred_setup_code(names: dict[str, int]) -> bytes:
    stop = encode_u30(names["stop"])
    set_timeout = encode_u30(names["setTimeout"])
    setup = encode_u30(names["setUpFrame"])
    current_label = encode_u30(names["currentLabel"])
    return (
        b"\xd0\x30"
        + b"\x5d" + stop
        + b"\x4f" + stop + b"\x00"
        + b"\x5d" + set_timeout
        + b"\xd0\x66" + setup
        + b"\x24\x00"
        + b"\xd0\x66" + current_label
        + b"\x4f" + set_timeout + b"\x03"
        + b"\x47"
    )


def patch(path: Path, backup: bool = True) -> list[str]:
    _original, raw, compressed = read_swf(path)
    out = bytearray(raw)
    report: list[str] = []
    patched = 0

    for tag, payload_offset, length in iter_tags(raw):
        if tag not in (72, 82):
            continue
        payload = raw[payload_offset : payload_offset + length]
        abc_offset, abc = (
            extract_abc_from_doabc(payload) if tag == 82 else (0, payload)
        )
        try:
            locations = parse_abc_method_bodies(abc)
        except Exception:
            continue
        targets = [
            loc
            for loc in locations
            if loc.class_name == "mcOption" and loc.method_name in TARGET_METHODS
        ]
        if not targets:
            continue

        names = find_qname_multinames(
            abc, {"stop", "setTimeout", "setUpFrame", "currentLabel"}
        )
        missing = {"stop", "setTimeout", "setUpFrame", "currentLabel"} - names.keys()
        if missing:
            raise RuntimeError(f"mcOption ABC is missing multinames: {sorted(missing)}")
        code = deferred_setup_code(names)
        abc_absolute = payload_offset + abc_offset

        for loc in targets:
            if len(code) > loc.code_length:
                raise RuntimeError(
                    f"{loc.method_name}: deferred setup needs {len(code)} bytes, "
                    f"body only has {loc.code_length}"
                )
            max_stack = encode_u30(4)
            old_max_stack = encode_u30(loc.max_stack)
            if len(max_stack) != len(old_max_stack):
                raise RuntimeError(f"{loc.method_name}: max-stack width changed")

            body = code + b"\x47" * (loc.code_length - len(code))
            code_at = abc_absolute + loc.code_offset
            stack_at = abc_absolute + loc.max_stack_offset
            old_body = bytes(out[code_at : code_at + loc.code_length])
            if old_body == body and loc.max_stack == 4:
                report.append(f"{path.name}: {loc.method_name} already deferred")
                continue
            out[code_at : code_at + loc.code_length] = body
            out[stack_at : stack_at + len(max_stack)] = max_stack
            report.append(f"{path.name}: deferred mcOption/{loc.method_name}")
            patched += 1

    if patched:
        if backup:
            backup_path = path.with_suffix(path.suffix + ".pre-option-frames.bak")
            if not backup_path.exists():
                shutil.copy2(path, backup_path)
                report.append(f"backup -> {backup_path.name}")
        write_swf(path, bytes(out), compressed)
        report.append(f"wrote {path} ({patched} option frame patches)")
    elif not report:
        raise RuntimeError("mcOption frame methods were not found")
    return report


def main() -> None:
    parser = argparse.ArgumentParser()
    parser.add_argument(
        "--swf",
        type=Path,
        default=Path(__file__).resolve().parents[1] / "gamefiles" / "spider.swf",
    )
    parser.add_argument("--no-backup", action="store_true")
    args = parser.parse_args()
    for line in patch(args.swf, backup=not args.no_backup):
        print(line)


if __name__ == "__main__":
    main()
