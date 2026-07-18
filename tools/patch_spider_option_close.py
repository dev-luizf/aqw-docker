#!/usr/bin/env python3
"""Make Advanced Options' X close only the advanced panel."""

from __future__ import annotations

import argparse
import shutil
import subprocess
from pathlib import Path


OLD_CLOSE = """            case "btnClose":
               this.rootClass.ui.mcPopup.onClose();
               this.rootClass.stage.focus = null;
               break;"""

NEW_CLOSE = """            case "btnClose":
               if(e.currentTarget == this.bg2.bg.btnClose)
               {
                  this.bg2.visible = false;
                  this.rootClass.litePreference.data.bVisible = false;
                  this.rootClass.litePreference.flush();
               }
               else
               {
                  this.rootClass.ui.mcPopup.onClose();
                  this.rootClass.stage.focus = null;
               }
               break;"""


def ffdec(*args: str) -> None:
    subprocess.run(
        ["flatpak", "run", "com.jpexs.decompiler.flash", *args],
        check=True,
    )


def patch(path: Path, backup: bool = True) -> str:
    path = path.resolve()
    build = path.parent / ".option-close-build"
    export = build / "export"
    source = export / "scripts" / "mcOption.as"
    output = build / "spider-option-close.swf"

    if build.exists():
        shutil.rmtree(build)
    export.mkdir(parents=True)
    ffdec(
        "-format",
        "script:as",
        "-selectclass",
        "mcOption",
        "-export",
        "script",
        str(export),
        str(path),
    )
    text = source.read_text(encoding="utf-8")
    if NEW_CLOSE in text:
        shutil.rmtree(build)
        return "Advanced Options close handler already fixed"
    if OLD_CLOSE not in text:
        raise RuntimeError("mcOption btnClose handler did not match the expected client")
    source.write_text(text.replace(OLD_CLOSE, NEW_CLOSE, 1), encoding="utf-8")

    ffdec("-replace", str(path), str(output), "mcOption", str(source))
    if not output.is_file() or output.stat().st_size == 0:
        raise RuntimeError("FFDec did not produce the patched Spider SWF")
    if backup:
        backup_path = path.with_suffix(path.suffix + ".pre-option-close.bak")
        if not backup_path.exists():
            shutil.copy2(path, backup_path)
    shutil.move(output, path)
    shutil.rmtree(build)
    return "fixed Advanced Options close handler"


def main() -> None:
    parser = argparse.ArgumentParser()
    parser.add_argument(
        "--swf",
        type=Path,
        default=Path(__file__).resolve().parents[1] / "gamefiles" / "spider.swf",
    )
    parser.add_argument("--no-backup", action="store_true")
    args = parser.parse_args()
    print(patch(args.swf, backup=not args.no_backup))


if __name__ == "__main__":
    main()
