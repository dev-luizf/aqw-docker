#!/usr/bin/env python3
"""Recompile the Custom Drops UI classes with safe lifecycle and quantity handling.

``iconDrops`` owns a timer which can outlive ``customDrops``.  When the
advanced option is toggled off, the next timer event used to dereference the
now-null ``cDropsUI`` object.  The custom drop list also aggregates multiple
server drop packets into one row, so accepting a row must acknowledge every
queued drop while preserving partial failures.  The checked-in ActionScript
sources are used as the replacement input for the affected classes.  New
conditional drops also expand the panel immediately so the pending list is
visible without an extra click.
"""

from __future__ import annotations

import argparse
import shutil
import subprocess
import tempfile
from pathlib import Path


def ffdec(*args: str) -> None:
    subprocess.run(
        ["flatpak", "run", "com.jpexs.decompiler.flash", *args],
        check=True,
    )


PATCHES = (
    (
        "liteAssets.draw.dEntry",
        Path("scripts/liteAssets/draw/dEntry.as"),
        Path("tools/spider_login_sprite/scripts/liteAssets/draw/dEntry.as"),
        "internal var dropRequests:int = 1;",
    ),
    (
        "liteAssets.draw.iconDrops",
        Path("scripts/liteAssets/draw/iconDrops.as"),
        Path("tools/spider_login_sprite/scripts/liteAssets/draw/iconDrops.as"),
        "public function stopAlert()",
    ),
    (
        "liteAssets.draw.customDrops",
        Path("scripts/liteAssets/draw/customDrops.as"),
        Path("tools/spider_login_sprite/scripts/liteAssets/draw/customDrops.as"),
        "private function openForDrop()",
    ),
    (
        "liteAssets.handlers.optionHandler",
        Path("scripts/liteAssets/handlers/optionHandler.as"),
        Path("tools/spider_login_sprite/scripts/liteAssets/handlers/optionHandler.as"),
        "if(r.cDropsUI != null)\n                  {\n                     r.cDropsUI.cleanup();\n                  }\n                  r.cDropsUI = new customDrops(r);",
    ),
)


def patch(path: Path, backup: bool = True) -> str:
    path = path.resolve()
    if not path.is_file():
        raise FileNotFoundError(path)

    root = Path(__file__).resolve().parents[1]
    current = path
    changed = False
    with tempfile.TemporaryDirectory(
        prefix=".spider-custom-drops-build-", dir=str(path.parent)
    ) as build_name:
        build = Path(build_name)
        for index, (class_name, relative_export, relative_source, marker) in enumerate(PATCHES):
            source_input = root / relative_source
            if not source_input.is_file():
                raise FileNotFoundError(source_input)
            export = build / f"export-{index}"
            export.mkdir(parents=True)
            ffdec(
                "-format",
                "script:as",
                "-selectclass",
                class_name,
                "-export",
                "script",
                str(export),
                str(current),
            )
            exported_source = export / relative_export
            exported_text = exported_source.read_text(encoding="utf-8")
            replacement_text = source_input.read_text(encoding="utf-8")
            if marker not in replacement_text:
                raise RuntimeError(f"replacement source is missing {marker}: {source_input}")
            if marker in exported_text:
                continue
            exported_source.write_text(replacement_text, encoding="utf-8")
            output = build / f"patched-{index}.swf"
            ffdec(
                "-replace",
                str(current),
                str(output),
                class_name,
                str(exported_source),
            )
            if not output.is_file() or output.stat().st_size == 0:
                raise RuntimeError(f"FFDec did not produce a patched Spider SWF for {class_name}")
            current = output
            changed = True

        if not changed:
            return f"{path.name}: Custom Drops lifecycle guards already present"
        if backup:
            backup_path = path.with_suffix(path.suffix + ".pre-custom-drops.bak")
            if not backup_path.exists():
                shutil.copy2(path, backup_path)
        shutil.move(str(current), str(path))

    return f"{path.name}: fixed Custom Drops lifecycle"


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
