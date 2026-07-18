#!/usr/bin/env python3
"""Guard the Faroff map's optional music setup until the game mixer exists.

The legacy map timeline runs frame 10 while Ruffle is still constructing the
game root.  Accessing ``rootClass.mixer.bSoundOn`` at that point raises AVM2
error #1009 and aborts the rest of the frame script.  Recompile only the map's
MainTimeline class, preserving all map controls and setup code.
"""

from __future__ import annotations

import argparse
import shutil
import subprocess
import tempfile
from pathlib import Path


OLD = "if(rootClass.mixer.bSoundOn)"
NEW = "if(rootClass != null && rootClass.mixer != null && rootClass.mixer.bSoundOn)"
CLASS = "town_fla.MainTimeline"


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
        prefix=".map-mixer-build-", dir=str(path.parent)
    ) as build_name:
        build = Path(build_name)
        export = build / "export"
        source = export / "scripts" / "town_fla" / "MainTimeline.as"
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
        if NEW in text and OLD not in text:
            return f"{path.name}: mixer guard already present"
        if text.count(OLD) != 1:
            raise RuntimeError(
                f"{path.name}: expected one unguarded mixer check, "
                f"found {text.count(OLD)}"
            )
        source.write_text(text.replace(OLD, NEW, 1), encoding="utf-8")

        ffdec("-replace", str(path), str(output), CLASS, str(source))
        if not output.is_file() or output.stat().st_size == 0:
            raise RuntimeError("FFDec did not produce the patched map SWF")

        if backup:
            backup_path = path.with_suffix(path.suffix + ".pre-map-mixer.bak")
            if not backup_path.exists():
                shutil.copy2(path, backup_path)
        shutil.move(str(output), str(path))

    return f"{path.name}: guarded rootClass.mixer in {CLASS}"


def main() -> None:
    parser = argparse.ArgumentParser()
    parser.add_argument(
        "--swf",
        type=Path,
        default=Path(__file__).resolve().parents[1]
        / "gamefiles"
        / "maps"
        / "Battleon"
        / "awfaroffv3.swf",
    )
    parser.add_argument("--no-backup", action="store_true")
    args = parser.parse_args()
    print(patch(args.swf, backup=not args.no_backup))


if __name__ == "__main__":
    main()
