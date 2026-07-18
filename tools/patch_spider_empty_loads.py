#!/usr/bin/env python3
"""Reject empty asset URLs while Spider converts loader queue entries."""

from __future__ import annotations

import argparse
import shutil
import subprocess
import tempfile
from pathlib import Path


CLASS = "types.LoaderData"
OLD = """\
         if(ld.strFile == null)
         {
            ld.strFile = "";
         }"""
NEW = """\
         if(ld.strFile == null || ld.strFile.length == 0)
         {
            return null;
         }"""


def ffdec(*args: str) -> None:
    subprocess.run(
        [
            "flatpak",
            "run",
            "--env=_JAVA_OPTIONS=-Xmx2g",
            "com.jpexs.decompiler.flash",
            *args,
        ],
        check=True,
    )


def patch(path: Path, backup: bool = True) -> str:
    path = path.resolve()
    if not path.is_file():
        raise FileNotFoundError(path)

    with tempfile.TemporaryDirectory(
        prefix=".spider-empty-load-build-", dir=str(path.parent)
    ) as build_name:
        build = Path(build_name)
        export = build / "export"
        source = export / "scripts" / "types" / "LoaderData.as"
        output = build / "patched.swf"
        export.mkdir(parents=True)

        ffdec(
            "-format",
            "script:as",
            "-selectclass",
            CLASS,
            "-export",
            "script",
            str(export),
            str(path),
        )
        if not source.is_file():
            raise RuntimeError("FFDec did not export the Spider LoaderData class")
        text = source.read_text(encoding="utf-8")
        if NEW in text:
            return f"{path.name}: empty loader guard already present"
        if text.count(OLD) != 1:
            raise RuntimeError(
                f"{path.name}: expected one empty-file normalization, found {text.count(OLD)}"
            )
        source.write_text(text.replace(OLD, NEW, 1), encoding="utf-8")

        ffdec("-replace", str(path), str(output), CLASS, str(source))
        if not output.is_file() or output.stat().st_size == 0:
            raise RuntimeError("FFDec did not produce the patched Spider SWF")

        if backup:
            backup_path = path.with_suffix(path.suffix + ".pre-empty-load.bak")
            if not backup_path.exists():
                shutil.copy2(path, backup_path)
        shutil.move(str(output), str(path))

    return f"{path.name}: LoaderData rejects empty asset URLs"


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
