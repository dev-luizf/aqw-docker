#!/usr/bin/env python3
"""Repoint legacy AQW Game_*.swf ABC strings to a local Armagedom server."""

from __future__ import annotations

import argparse
import shutil
import struct
import zlib
from pathlib import Path


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


def build_replacements(host: str, port: int) -> dict[str, str]:
    hostport = f"{host}:{port}"
    base = f"http://{hostport}"
    gamefiles = f"{base}/gamefiles/"
    return {
        "cdn.aqworlds.com": hostport,
        "cdn.aq.com": hostport,
        "aqworldscdn.aq.com": hostport,
        "content.aqworlds.com": hostport,
        "content.aq.com": hostport,
        "www.aq.com": hostport,
        "http://game.aq.com/game/gamefiles/": gamefiles,
        "https://game.aq.com/game/": f"{base}/game/",
        "game.aq.com": hostport,
        "content.aq.com": hostport,
        "https://content.aq.com/game/": f"{base}/",
        "https://www.aq.com/game/": f"{base}/",
        "https://www.aq.com/landing/": gamefiles,
        "https://game.aq.com/game/cf-userlogin.asp": f"{base}/cf-userlogin.asp",
        # Keep same-origin APIs port-agnostic. A leading slash resolves against
        # whichever WEB_PORT_HOST served the SWF.
        "https://www.aq.com/game/quest.asp?userid=": "/game/quest.asp?userid=",
        "http://www.aq.com/game/quest.asp?userid=": "/game/quest.asp?userid=",
        "https://game.aq.com/game/quest.asp?userid=": "/game/quest.asp?userid=",
        "http://game.aqworlds.com/game/": f"{base}/",
        "https://account.aq.com/": f"{base}/",
        "http://launch.artix.com/latest/ArtixSetup.msi": f"{base}/play",
        "http://launch.artix.com/latest/ArtixGames.dmg": f"{base}/play",
        "cf-userlogin.asp": "cf-userlogin.php",
        "cf-userlogin.asp?ran=": "cf-userlogin.php?ran=",
    }


class AbcReader:
    def __init__(self, data: bytes, start: int = 0):
        self.data = data
        self.pos = start

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
        return result

    def bytes_(self, n: int) -> bytes:
        v = self.data[self.pos : self.pos + n]
        self.pos += n
        return v


def rewrite_abc_strings(abc: bytes, replacements: dict[str, str]) -> tuple[bytes, list[str]]:
    r = AbcReader(abc)
    r.u16()
    r.u16()
    for _ in range(max(0, r.u30() - 1)):
        r.u30()
    for _ in range(max(0, r.u30() - 1)):
        r.u30()
    for _ in range(max(0, r.u30() - 1)):
        r.pos += 8

    pool_start = r.pos
    string_count = r.u30()
    strings = [""]
    for _ in range(max(0, string_count - 1)):
        n = r.u30()
        strings.append(r.bytes_(n).decode("utf-8", "replace"))
    pool_end = r.pos

    report: list[str] = []
    new_strings = list(strings)
    for i, value in enumerate(strings):
        if value in replacements:
            new_strings[i] = replacements[value]
            report.append(f"  {value!r} -> {replacements[value]!r}")

    pool = bytearray()
    pool += encode_u30(len(new_strings))
    for s in new_strings[1:]:
        raw = s.encode("utf-8")
        pool += encode_u30(len(raw))
        pool += raw

    return abc[:pool_start] + bytes(pool) + abc[pool_end:], report


def read_swf(path: Path) -> tuple[bytes, bool]:
    data = path.read_bytes()
    if data[:3] == b"CWS":
        return data[:8] + zlib.decompress(data[8:]), True
    if data[:3] == b"FWS":
        return data, False
    raise ValueError(f"unsupported SWF signature {data[:3]!r}")


def write_swf(path: Path, raw: bytes, compressed: bool) -> None:
    ver = raw[3]
    if compressed:
        body = zlib.compress(raw[8:], 9)
        out = b"CWS" + bytes([ver]) + struct.pack("<I", len(raw)) + body
    else:
        out = raw
    path.write_bytes(out)


def patch_tag_header(raw: bytearray, tag_off: int, old_len: int, new_len: int) -> None:
    code_len = struct.unpack_from("<H", raw, tag_off)[0]
    tag = code_len >> 6
    if new_len < 0x3F:
        struct.pack_into("<H", raw, tag_off, (tag << 6) | new_len)
    else:
        struct.pack_into("<H", raw, tag_off, (tag << 6) | 0x3F)
        struct.pack_into("<I", raw, tag_off + 2, new_len)


def iter_tags(raw: bytes):
    i = 8
    nbits = raw[i] >> 3
    i += (5 + nbits * 4 + 7) // 8
    i += 4
    while i + 2 <= len(raw):
        code_len = struct.unpack_from("<H", raw, i)[0]
        tag = code_len >> 6
        length = code_len & 0x3F
        hdr = 2
        if length == 0x3F:
            length = struct.unpack_from("<I", raw, i + 2)[0]
            hdr = 6
        yield tag, i, hdr, i + hdr, length
        i = i + hdr + length
        if tag == 0:
            break


def patch_swf(src: Path, dst: Path, replacements: dict[str, str]) -> list[str]:
    raw, compressed = read_swf(src)
    raw_mutable = bytearray(raw)
    report: list[str] = []
    delta = 0

    for tag, tag_off, _hdr, payload_off, length in iter_tags(raw):
        payload_off += delta
        if tag not in (72, 82):
            continue

        payload = bytes(raw_mutable[payload_off : payload_off + length])
        rel: list[str] = []
        if tag == 82:
            name_end = payload.index(b"\x00", 4)
            abc_off = name_end + 1
            prefix = payload[:abc_off]
            new_abc, rel = rewrite_abc_strings(payload[abc_off:], replacements)
            new_payload = prefix + new_abc
        else:
            new_abc, rel = rewrite_abc_strings(payload, replacements)
            new_payload = new_abc

        if not rel:
            continue
        report.extend(rel)
        old_len = length
        new_len = len(new_payload)
        raw_mutable[payload_off : payload_off + old_len] = new_payload
        patch_tag_header(raw_mutable, tag_off, old_len, new_len)
        delta += new_len - old_len

    if report:
        write_swf(dst, bytes(raw_mutable), compressed)
    return report


def main() -> None:
    ap = argparse.ArgumentParser()
    ap.add_argument("--src", type=Path, required=True)
    ap.add_argument("--dst", type=Path, required=True)
    ap.add_argument("--host", default="127.0.0.1")
    ap.add_argument("--port", type=int, default=8081)
    ap.add_argument("--no-backup", action="store_true", help="do not write *.pre-repoint.bak")
    args = ap.parse_args()

    reps = build_replacements(args.host, args.port)
    if args.dst.exists() and not args.no_backup:
        bak = args.dst.with_suffix(args.dst.suffix + ".pre-repoint.bak")
        if not bak.exists():
            shutil.copy2(args.dst, bak)

    lines = patch_swf(args.src, args.dst, reps)
    for line in lines:
        print(line)
    print(f"wrote {args.dst} ({len(lines)} strings)")


if __name__ == "__main__":
    main()
