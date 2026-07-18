#!/bin/sh
set -eu

# The legacy emulator reads these tables directly. Keep them as a projection
# of the environment; they are no longer configuration sources.
to_hex() {
  printf '%s' "$1" | od -An -tx1 | tr -d ' \n'
}

sql_text() {
  printf "CONVERT(UNHEX('%s') USING utf8mb4)" "$(to_hex "$1")"
}

require_uint() {
  case "$2" in
    ''|*[!0-9]*)
      echo "$1 must be a non-negative integer, got: $2" >&2
      exit 1
      ;;
  esac
}

sync_setting() {
  name="$1"
  value="$2"
  mysql -h"$MYSQL_HOST" -P"$MYSQL_PORT" -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE" \
    --execute="INSERT INTO settings_login (name, value) VALUES ($(sql_text "$name"), $(sql_text "$value")) ON DUPLICATE KEY UPDATE value=VALUES(value)"
}

# Existing volumes may still use the narrow fields from the original dump.
mysql -h"$MYSQL_HOST" -P"$MYSQL_PORT" -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE" --execute="
ALTER TABLE settings_login MODIFY value varchar(255) NOT NULL DEFAULT '';
ALTER TABLE servers MODIFY IP varchar(255) NOT NULL DEFAULT '0.0.0.0';
"

game_menu="${GAME_MENU:-}"
case "$game_menu" in
  ''|*/*) ;;
  *) game_menu="gameMenu/$game_menu" ;;
esac

sync_setting gMenu "$game_menu"
sync_setting sAssets "${GAME_ASSETS:-AWAssets.swf}"
sync_setting sBG "${GAME_CLIENT_BG:-Back.swf}"
sync_setting sBook "${GAME_BOOK:-news/spiderbook3.swf}"
sync_setting sFBC "${GAME_FBC:-FBC-2011-03-08.swf}"
sync_setting sFile "${GAME_CLIENT_SWF:-spider.swf}"
sync_setting sLoader ""
sync_setting sMap "${GAME_MAP:-news/Map-UI_r38.swf}"
sync_setting sNews "${GAME_NEWS:-}"
sync_setting sNewUser "${GAME_NEW_USER:-newuser/AW-Registration.swf}"
sync_setting sProfile ""
sync_setting sTitle "${GAME_CLIENT_TITLE:-${SITE_NAME:-Armagedom Worlds}}"
sync_setting sVersion "${GAME_CLIENT_VERSION:-ARM001}"
sync_setting sWTSandbox "false"
sync_setting iMaxBagSlots "${GAME_MAX_BAG_SLOTS:-500}"
sync_setting iMaxBankSlots "${GAME_MAX_BANK_SLOTS:-900}"
sync_setting iMaxHouseSlots "${GAME_MAX_HOUSE_SLOTS:-300}"
sync_setting iMaxGuildMembers "${GAME_MAX_GUILD_MEMBERS:-800}"
sync_setting iMaxFriends "${GAME_MAX_FRIENDS:-300}"
sync_setting iMaxLoadoutSlots "${GAME_MAX_LOADOUT_SLOTS:-50}"

server_name="${SERVER_NAME:-Armagedom}"
server_ip="${PUBLIC_GAME_IP:-127.0.0.1}"
server_max="${GAME_SERVER_MAX_PLAYERS:-900}"
server_chat="${GAME_SERVER_CHAT_MODE:-2}"
server_upgrade="${GAME_SERVER_UPGRADE_ONLY:-0}"
server_motd="${GAME_SERVER_MOTD:-Welcome to ${server_name}!}"

require_uint GAME_SERVER_MAX_PLAYERS "$server_max"
require_uint GAME_SERVER_CHAT_MODE "$server_chat"
require_uint GAME_SERVER_UPGRADE_ONLY "$server_upgrade"

mysql -h"$MYSQL_HOST" -P"$MYSQL_PORT" -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE" --execute="
UPDATE servers SET
  Name=$(sql_text "$server_name"),
  IP=$(sql_text "$server_ip"),
  Online=1,
  Upgrade=${server_upgrade},
  Chat=${server_chat},
  Max=${server_max},
  MOTD=$(sql_text "$server_motd")
WHERE id=1;
UPDATE servers SET Online=0 WHERE id<>1;
"
