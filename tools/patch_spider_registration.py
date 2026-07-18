#!/usr/bin/env python3
"""Route Spider's Create Account button into its in-client registration flow."""

from __future__ import annotations

import argparse
import shutil
from pathlib import Path

from patch_game_repoint import patch_swf as rewrite_strings
from patch_ruffle_framescripts import (
    extract_abc_from_doabc,
    iter_tags,
    parse_abc_method_bodies,
    read_swf,
    write_swf,
)


CLASS_NAME = "game_1_cnt_login_6"
METHOD_NAME = "onCreateClick"

# Original handler:
#   navigateToURL(new URLRequest("https://www.aq.com/landing/"), "_blank");
#   btnCreate.removeEventListener(MouseEvent.CLICK, onCreateClick);
OLD_CODE = bytes.fromhex(
    "f1 b2 76 f0 07 d0 30 ef 01 bd 0f 00 07 f0 09 "
    "5d 95 82 01 5d 96 82 01 2c b4 76 4a 96 82 01 01 "
    "2c f9 49 4f 95 82 01 02 "
    "f0 0a d0 66 97 82 01 60 98 82 01 66 99 82 01 "
    "d0 66 9a 82 01 4f 9b 82 01 02 f0 0b 47"
)

# Existing constant-pool references from this ABC:
#   16683 MovieClip, 16684 parent, 10568 params, 11852 vars,
#   13208 "Account", 10035 gotoAndPlay.
PARENT = bytes.fromhex(
    "5d ab 82 01 "  # findpropstrict MovieClip
    "60 ac 82 01 "  # getlex parent
    "46 ab 82 01 01 "  # MovieClip(parent)
)
RESET_LEGACY_VARS = (
    PARENT
    + bytes.fromhex(
        "66 c8 52 "  # .params
        "20 "  # null
        "61 cc 5c"  # .vars = null
    )
)
ENTER_ACCOUNT = PARENT + bytes.fromhex(
    "2c 98 67 "  # "Account"
    "4f b3 4e 01"  # gotoAndPlay("Account")
)

PROLOGUE = OLD_CODE[: OLD_CODE.index(bytes.fromhex("5d 95 82 01"))]
PADDING = bytes([0x02]) * (
    len(OLD_CODE) - len(PROLOGUE) - len(RESET_LEGACY_VARS) - len(ENTER_ACCOUNT) - 1
)
NEW_CODE = PROLOGUE + RESET_LEGACY_VARS + ENTER_ACCOUNT + PADDING + bytes([0x47])

if len(NEW_CODE) != len(OLD_CODE):
    raise RuntimeError("registration patch must preserve the method body length")


def patch(path: Path, registration: str, backup: bool = True) -> str:
    original, raw, compressed = read_swf(path)
    mutable = bytearray(raw)

    for tag, payload_off, length in iter_tags(raw):
        if tag not in (72, 82):
            continue
        payload = bytes(mutable[payload_off : payload_off + length])
        abc_off, abc = extract_abc_from_doabc(payload) if tag == 82 else (0, payload)
        try:
            methods = parse_abc_method_bodies(abc)
        except Exception:
            continue
        target = next(
            (
                method
                for method in methods
                if method.class_name == CLASS_NAME and method.method_name == METHOD_NAME
            ),
            None,
        )
        if target is None:
            continue

        current = abc[target.code_offset : target.code_offset + target.code_length]
        already_patched = current == NEW_CODE
        if not already_patched and current != OLD_CODE:
            raise RuntimeError("Create Account bytecode did not match the expected Spider client")

        if backup and not already_patched:
            backup_path = path.with_suffix(path.suffix + ".pre-registration.bak")
            if not backup_path.exists():
                shutil.copy2(path, backup_path)

        if not already_patched:
            patched_abc = bytearray(abc)
            patched_abc[target.code_offset : target.code_offset + target.code_length] = NEW_CODE
            patched_payload = payload[:abc_off] + bytes(patched_abc)
            mutable[payload_off : payload_off + length] = patched_payload
            write_swf(path, bytes(mutable), compressed)

        old_registration = "newuser/AQW-Landing-MERGETEST.swf"
        rewritten = rewrite_strings(path, path, {old_registration: registration})
        if already_patched and not rewritten:
            return "Spider registration flow and configured SWF are already patched"
        return f"routed Create Account to {registration!r}"

    raise RuntimeError(f"{CLASS_NAME}.{METHOD_NAME} was not found")


def main() -> None:
    parser = argparse.ArgumentParser()
    parser.add_argument(
        "--swf",
        type=Path,
        default=Path(__file__).resolve().parents[1] / "gamefiles" / "spider.swf",
    )
    parser.add_argument(
        "--registration",
        default="newuser/registration.swf",
        help="gamefiles-relative registration SWF path",
    )
    parser.add_argument("--no-backup", action="store_true")
    args = parser.parse_args()
    print(
        patch(
            args.swf,
            registration=args.registration,
            backup=not args.no_backup,
        )
    )


if __name__ == "__main__":
    main()
