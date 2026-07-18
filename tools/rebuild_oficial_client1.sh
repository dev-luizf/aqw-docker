#!/usr/bin/env bash
# Safe rebuild: OficialClient1.swf.orig → repoint → Ruffle frame-script NOPs.
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
ORIG="$ROOT/gamefiles/OficialClient1.swf.orig"
OUT="$ROOT/gamefiles/OficialClient1.swf"
HOST="${REPOINT_HOST:-127.0.0.1}"
PORT="${REPOINT_PORT:-8081}"

if [[ ! -f "$ORIG" ]]; then
  echo "missing source: $ORIG" >&2
  exit 1
fi

cp "$ORIG" "$OUT"
python3 "$ROOT/tools/patch_game_repoint.py" --src "$ORIG" --dst "$OUT" --host "$HOST" --port "$PORT" --no-backup
python3 "$ROOT/tools/patch_ruffle_framescripts.py" --root "$ROOT/gamefiles" --no-backup

echo "rebuilt $OUT (repoint $HOST:$PORT + mcPopup_325/frame2 + cnt_181/frame1 + menu/map patches)"
