#!/usr/bin/env bash
# Safe rebuild: spider.swf.orig + Loader_Spider.swf.orig → repoint → Ruffle NOPs.
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
SPIDER_ORIG="$ROOT/gamefiles/spider.swf.orig"
SPIDER_OUT="$ROOT/gamefiles/spider.swf"
LOADER_ORIG="$ROOT/gamefiles/loaders/Loader_Spider.swf.orig"
LOADER_OUT="$ROOT/gamefiles/loaders/Loader_Spider.swf"
HOST="${REPOINT_HOST:-127.0.0.1}"
PORT="${REPOINT_PORT:-8081}"

for f in "$SPIDER_ORIG" "$LOADER_ORIG"; do
  if [[ ! -f "$f" ]]; then
    echo "missing source: $f" >&2
    echo "Download from https://game.aq.com/game/gamefiles/{spider.swf,Loader_Spider.swf}" >&2
    exit 1
  fi
done

cp "$SPIDER_ORIG" "$SPIDER_OUT"
python3 "$ROOT/tools/patch_game_repoint.py" --src "$SPIDER_ORIG" --dst "$SPIDER_OUT" --host "$HOST" --port "$PORT" --no-backup
python3 "$ROOT/tools/patch_spider_registration.py" \
  --swf "$SPIDER_OUT" \
  --registration "${GAME_NEW_USER:-newuser/AW-Registration.swf}" \
  --no-backup
python3 "$ROOT/tools/patch_spider_map_load_complete.py" --swf "$SPIDER_OUT" --no-backup
python3 "$ROOT/tools/patch_spider_empty_loads.py" --swf "$SPIDER_OUT" --no-backup

cp "$LOADER_ORIG" "$LOADER_OUT"
python3 "$ROOT/tools/patch_game_repoint.py" --src "$LOADER_ORIG" --dst "$LOADER_OUT" --host "$HOST" --port "$PORT" --no-backup

python3 "$ROOT/tools/patch_ruffle_framescripts.py" --root "$ROOT/gamefiles" --no-backup
python3 "$ROOT/tools/restore_spider_popup_init.py" --swf "$SPIDER_OUT" --orig "$SPIDER_ORIG" --no-backup
python3 "$ROOT/tools/patch_spider_option_frames.py" --swf "$SPIDER_OUT" --no-backup
python3 "$ROOT/tools/patch_spider_option_close.py" --swf "$SPIDER_OUT" --no-backup
python3 "$ROOT/tools/patch_map_mixer.py" --swf "$ROOT/gamefiles/maps/battleon/awfaroffv3.swf" --no-backup
python3 "$ROOT/tools/patch_sp_ed1_parent.py" --swf "$ROOT/gamefiles/interface/Assets/assets_2026.swf" --no-backup
python3 "$ROOT/tools/patch_spider_custom_drops.py" --swf "$SPIDER_OUT" --no-backup
python3 "$ROOT/tools/patch_spider_server_motd.py" --swf "$SPIDER_OUT" --no-backup

echo "rebuilt $SPIDER_OUT + $LOADER_OUT (repoint $HOST:$PORT + map/popup/options compatibility)"
