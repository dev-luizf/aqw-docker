#!/usr/bin/env bash
# Safe rebuild: Game_20150324.swf.orig → repoint → Ruffle frame-script NOPs.
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
ORIG="$ROOT/gamefiles/Game_20150324.swf.orig"
OUT="$ROOT/gamefiles/Game_20150324.swf"
HOST="${REPOINT_HOST:-127.0.0.1}"
PORT="${REPOINT_PORT:-8081}"

if [[ ! -f "$ORIG" ]]; then
  echo "missing source: $ORIG" >&2
  exit 1
fi

cp "$ORIG" "$OUT"
python3 "$ROOT/tools/patch_game_repoint.py" --src "$ORIG" --dst "$OUT" --host "$HOST" --port "$PORT" --no-backup
python3 "$ROOT/tools/patch_ruffle_framescripts.py" --root "$ROOT/gamefiles" --no-backup

echo "rebuilt $OUT (repoint $HOST:$PORT + mcPopup_270/frame2 + menu/map patches)"

# Also ensure loader loads title/Back.swf + titleDomain (black-screen fix)
if [[ -x "$ROOT/tools/patch_loader_swf.sh" ]]; then
  "$ROOT/tools/patch_loader_swf.sh" || true
fi
