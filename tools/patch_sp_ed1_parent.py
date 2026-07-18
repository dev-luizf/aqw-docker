#!/usr/bin/env python3
"""Guard the detached spell-effect cleanup used by the cooldown overlay."""

from __future__ import annotations

import argparse
import shutil
import subprocess
import tempfile
from pathlib import Path


CLASS = "sp_ed1"
OLD = "MovieClip(parent).removeChild(this);"


def ffdec(*args: str) -> None:
    subprocess.run(
        ["flatpak", "run", "com.jpexs.decompiler.flash", *args],
        check=True,
    )


def patch(path: Path, backup: bool = True) -> str:
    path = path.resolve()
    if not path.is_file():
        raise FileNotFoundError(path)

    with tempfile.TemporaryDirectory(
        prefix=".sp-ed1-parent-build-", dir=str(path.parent)
    ) as build_name:
        build = Path(build_name)
        export = build / "export"
        source = export / "scripts" / "sp_ed1.as"
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
        text = source.read_text(encoding="utf-8")
        if "if(parent != null)\n         {\n            MovieClip(parent).removeChild(this);" in text:
            return f"{path.name}: sp_ed1 parent guard already present"
        if text.count(OLD) != 1:
            raise RuntimeError(
                f"{path.name}: expected one unguarded sp_ed1 cleanup, "
                f"found {text.count(OLD)}"
            )
        source.write_text(text.replace(OLD, NEW, 1), encoding="utf-8")

        ffdec("-replace", str(path), str(output), CLASS, str(source))
        if not output.is_file() or output.stat().st_size == 0:
            raise RuntimeError("FFDec did not produce the patched assets SWF")

        if backup:
            backup_path = path.with_suffix(path.suffix + ".pre-sp-ed1-parent.bak")
            if not backup_path.exists():
                shutil.copy2(path, backup_path)
        shutil.move(str(output), str(path))

    return f"{path.name}: guarded detached sp_ed1 cleanup"


def main() -> None:
    parser = argparse.ArgumentParser()
    parser.add_argument(
        "--swf",
        type=Path,
        default=Path(__file__).resolve().parents[1]
        / "gamefiles"
        / "interface"
        / "Assets"
        / "assets_2026.swf",
    )
    parser.add_argument("--no-backup", action="store_true")
    args = parser.parse_args()
    print(patch(args.swf, backup=not args.no_backup))


if __name__ == "__main__":
    main()
