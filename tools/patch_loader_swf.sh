#!/usr/bin/env bash
# Patch official loaders/loader.swf so it loads title/Back.swf and passes titleDomain
# to the game (same behavior as AW_loader.swf). Requires FFDec (flatpak).
set -euo pipefail
ROOT="$(cd "$(dirname "$0")/.." && pwd)"
LOADER="$ROOT/gamefiles/loaders/loader.swf"
ORIG="$ROOT/gamefiles/loaders/loader.swf.orig"
AS_SRC="$ROOT/tools/loader_patches/MainTimeline.as"
FFDEC=(flatpak run com.jpexs.decompiler.flash)
BACKUP="$(mktemp)"

if [[ ! -f "$ORIG" ]]; then
  cp "$LOADER" "$ORIG"
fi

mkdir -p "$(dirname "$AS_SRC")"
if [[ ! -f "$AS_SRC" ]]; then
  echo "missing patched AS: $AS_SRC" >&2
  echo "Restore from git or re-create MainTimeline.as (must load title/ + titleDomain)." >&2
  exit 1
fi

# Keep current patched loader if FFDec fails after restore-from-orig.
cp "$LOADER" "$BACKUP"
trap 'cp "$BACKUP" "$LOADER"; rm -f "$BACKUP"' ERR
cp "$ORIG" "$LOADER"
"${FFDEC[@]}" -replace "$LOADER" "$LOADER" "Loader_fla.MainTimeline" "$AS_SRC"
trap - ERR
rm -f "$BACKUP"
echo "patched $LOADER (titleDomain + title/\$sBG)"
