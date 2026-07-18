#!/usr/bin/env python3
"""Restore Spider's popup initializer after the obsolete Ruffle stub."""

from __future__ import annotations

import argparse
import shutil
from pathlib import Path

from patch_ruffle_framescripts import (
    extract_abc_from_doabc,
    iter_tags,
    parse_abc_method_bodies,
    read_swf,
    write_swf,
)
from patch_spider_map_load_complete import replace_tag_payload


TARGET = ("mcPopup_355", "frame2")


def find_method_code(path: Path) -> bytes:
    _source, raw, _compressed = read_swf(path)
    for tag, payload_off, length in iter_tags(raw):
        if tag not in (72, 82):
            continue
        payload = raw[payload_off : payload_off + length]
        abc_offset, abc = (
            extract_abc_from_doabc(payload) if tag == 82 else (0, payload)
        )
        del abc_offset
        for loc in parse_abc_method_bodies(abc):
            if (loc.class_name, loc.method_name) == TARGET:
                return abc[loc.code_offset : loc.code_offset + loc.code_length]
    raise RuntimeError(f"{TARGET[0]}/{TARGET[1]} not found in {path}")


def restore(path: Path, original: Path, backup: bool = True) -> str:
    pristine_code = find_method_code(original)
    _source, raw, compressed = read_swf(path)
    raw_mutable = bytearray(raw)

    for tag, payload_off, length in iter_tags(raw):
        if tag not in (72, 82):
            continue
        payload = bytes(raw_mutable[payload_off : payload_off + length])
        abc_offset, abc = (
            extract_abc_from_doabc(payload) if tag == 82 else (0, payload)
        )
        for loc in parse_abc_method_bodies(abc):
            if (loc.class_name, loc.method_name) != TARGET:
                continue
            if loc.code_length != len(pristine_code):
                raise RuntimeError(
                    "popup initializer length mismatch: "
                    f"current={loc.code_length}, original={len(pristine_code)}"
                )
            current_code = abc[
                loc.code_offset : loc.code_offset + loc.code_length
            ]
            if current_code == pristine_code:
                return "popup initializer already intact"

            abc_mutable = bytearray(abc)
            abc_mutable[
                loc.code_offset : loc.code_offset + loc.code_length
            ] = pristine_code
            new_payload = payload[:abc_offset] + bytes(abc_mutable)
            replace_tag_payload(raw_mutable, payload_off, length, new_payload)

            if backup:
                backup_path = path.with_suffix(path.suffix + ".pre-popup-restore.bak")
                if not backup_path.exists():
                    shutil.copy2(path, backup_path)
            write_swf(path, bytes(raw_mutable), compressed)
            return "restored mcPopup_355/frame2 initializer"

    raise RuntimeError(f"{TARGET[0]}/{TARGET[1]} not found in {path}")


def main() -> None:
    parser = argparse.ArgumentParser()
    parser.add_argument("--swf", type=Path, required=True)
    parser.add_argument("--orig", type=Path, required=True)
    parser.add_argument("--no-backup", action="store_true")
    args = parser.parse_args()
    print(restore(args.swf, args.orig, backup=not args.no_backup))


if __name__ == "__main__":
    main()
