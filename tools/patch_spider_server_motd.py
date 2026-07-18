#!/usr/bin/env python3
"""Make Spider display the server-provided MOTD instead of a hardcoded message."""

from __future__ import annotations

import argparse
import shutil
from pathlib import Path

from patch_game_repoint import AbcReader, encode_u30
from patch_ruffle_framescripts import (
    extract_abc_from_doabc,
    iter_tags,
    parse_abc_method_bodies,
    read_swf,
    write_swf,
)
from patch_spider_map_load_complete import _rewrite_method_body, replace_tag_payload


HARDCODED_MOTD = (
    "Message of The Day: Staff will never ask for your password! If someone asks "
    "for your password, report them for Griefing. NEVER share your password!"
)


def read_u30(data: bytes, pos: int) -> tuple[int, int]:
    value = 0
    shift = 0
    while True:
        byte = data[pos]
        pos += 1
        value |= (byte & 0x7F) << shift
        if not byte & 0x80:
            return value, pos
        shift += 7


def string_index(abc: bytes, wanted: str) -> int | None:
    reader = AbcReader(abc)
    reader.u16()
    reader.u16()
    for _ in range(max(0, reader.u30() - 1)):
        reader.u30()
    for _ in range(max(0, reader.u30() - 1)):
        reader.u30()
    for _ in range(max(0, reader.u30() - 1)):
        reader.pos += 8

    count = reader.u30()
    for index in range(1, count):
        value = reader.bytes_(reader.u30()).decode("utf-8", "replace")
        if value == wanted:
            return index
    return None


def patch_swf(path: Path, backup: bool = True) -> str:
    compressed, raw, _ = read_swf(path)
    raw_mutable = bytearray(raw)

    for tag, payload_off, length in iter_tags(raw):
        if tag not in (72, 82):
            continue

        payload = bytes(raw[payload_off : payload_off + length])
        abc_off, abc = extract_abc_from_doabc(payload) if tag == 82 else (0, payload)
        try:
            literal_index = string_index(abc, HARDCODED_MOTD)
            methods = parse_abc_method_bodies(abc)
        except Exception:
            continue
        if literal_index is None:
            continue

        push_literal = bytes([0x2C]) + encode_u30(literal_index)
        target = None
        literal_pos = -1
        for method in methods:
            code = abc[method.code_offset : method.code_offset + method.code_length]
            pos = code.find(push_literal)
            if pos >= 0:
                target = method
                literal_pos = pos
                break
        if target is None:
            return "Spider MOTD already uses the server value"

        code = bytes(abc[target.code_offset : target.code_offset + target.code_length])

        # The failure branch later in the same handler already reads resObj[5].
        # Reuse its exact bytecode, including the current slot/multiname indexes.
        response_value = None
        for pos in range(literal_pos + len(push_literal), min(len(code) - 8, literal_pos + 512)):
            if code[pos : pos + 3] != b"\x65\x00\x6c":
                continue
            _, after_slot = read_u30(code, pos + 3)
            if code[after_slot : after_slot + 2] != b"\x24\x05":
                continue
            if code[after_slot + 2] != 0x66:
                continue
            _, expression_end = read_u30(code, after_slot + 3)
            response_value = code[pos:expression_end]
            break
        if response_value is None:
            raise RuntimeError("Could not locate Spider resObj[5] bytecode")

        assignment_prefix = literal_pos - 2
        if code[assignment_prefix:literal_pos] != b"\x65\x00":
            raise RuntimeError("Unexpected Spider MOTD assignment prefix")

        suffix_pos = literal_pos + len(push_literal)
        if code[suffix_pos : suffix_pos + 2] != b"\x82\x6d":
            raise RuntimeError("Unexpected Spider MOTD assignment suffix")
        _, assignment_end = read_u30(code, suffix_pos + 2)

        # Reclaim the preceding trace(date_server) debug sequence. Padding with
        # NOPs keeps the method length and every branch offset unchanged.
        replacement_start = assignment_prefix - 14
        if code[replacement_start] != 0xF0:
            raise RuntimeError("Unexpected Spider pre-MOTD trace sequence")

        replacement = b"\x65\x00" + response_value + code[suffix_pos:assignment_end]
        available = assignment_end - replacement_start
        if len(replacement) > available:
            raise RuntimeError("Spider MOTD replacement does not fit safely")
        replacement = bytes([0x02]) * (available - len(replacement)) + replacement

        new_code = (
            code[:replacement_start]
            + replacement
            + code[assignment_end:]
        )
        if len(new_code) != len(code):
            raise RuntimeError("Spider MOTD patch changed method length")

        abc_mutable = bytearray(abc)
        _rewrite_method_body(abc_mutable, target.method_idx, new_code)
        new_payload = payload[:abc_off] + bytes(abc_mutable)
        replace_tag_payload(raw_mutable, payload_off, length, new_payload)

        if backup:
            backup_path = path.with_suffix(path.suffix + ".pre-server-motd.bak")
            if not backup_path.exists():
                shutil.copy2(path, backup_path)

        write_swf(path, bytes(raw_mutable), compressed)
        return "Spider MOTD now uses loginResponse resObj[5]"

    raise RuntimeError("Spider hardcoded MOTD was not found")


def main() -> None:
    parser = argparse.ArgumentParser()
    parser.add_argument(
        "--swf",
        type=Path,
        default=Path(__file__).resolve().parents[1] / "gamefiles" / "spider.swf",
    )
    parser.add_argument("--no-backup", action="store_true")
    args = parser.parse_args()
    print(patch_swf(args.swf, backup=not args.no_backup))


if __name__ == "__main__":
    main()
