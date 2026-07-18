# Armagedom Worlds — Docker

## Quick start

```bash
cp .env.example .env
docker compose up -d --build
```

Play in browser (Ruffle + WebSocket proxy):

  http://127.0.0.1:8080/play.php

Hard refresh after SWF changes: **Ctrl+Shift+R**

## Stack

| Service | Role |
|---------|------|
| `db` | MariaDB (`mextv3`) |
| `web` | PHP CMS (live-mounted repo) |
| `game` | SmartFox 1.6.9 + AugoEidEs (TCP 5588) |
| `proxy` | Ruffle WebSocket → TCP bridge |
| `nginx` | Front door (`WEB_PORT_HOST`, default 8080) |

## Default browser client

Configured via `.env`:

- `GAME_LOADER=/gamefiles/loaders/Loader_Spider.swf`
- `GAME_CLIENT_SWF=spider.swf`
- `GAME_CLIENT_BG=Back.swf`
- `GAME_VERSION_STATUS=success`
- `GAME_CLIENT_TITLE`, `GAME_CLIENT_VERSION`
- `GAME_MENU`, `GAME_ASSETS`, `GAME_NEWS`, `GAME_MAP`, `GAME_BOOK`
- `GAME_MAX_*` slot/friend/guild limits
- `GAME_SERVER_*` server picker, chat mode, capacity, and MOTD

`.env` is the source of truth for client and server presentation settings.
PHP reads it directly, while container startup mirrors the same values into
`settings_login` and `servers` only for compatibility with the legacy emulator.

Login-time assets (`gMenu`, `sAssets`, `sBG`) come from `.env`; the MariaDB
`settings_login` values are generated compatibility copies.
Bare `GAME_MENU` filenames are normalized to `gameMenu/<filename>` for both
the PHP APIs and the legacy emulator.
The current Spider client uses `AWMenu14012017.swf` and `assets_2026.swf`.

Loader background (`GAME_CLIENT_BG`) is loaded from `gamefiles/title/<sBG>` and must export
the `TitleScreen` class (use `Back.swf`). `client/prep.swf` is only a loading splash and
will break login with `TitleScreen is not defined`.

AugoEidEs login nick patch is applied at **game image build** (`tools/patch_augoeides_login.sh`).

## Rebuild OficialClient1.swf (safe)

```bash
./tools/rebuild_oficial_client1.sh
```

## Rebuild Game_44.swf (safe)

```bash
./tools/rebuild_game_44.sh
```

## Rebuild Game_20150324.swf (safe)

From repo root. **Do not** patch `game_1_cnt_2`, `cnt_124`, or `cnt_181` on this client (skips login → "create new hero").

```bash
./tools/rebuild_game_20150324.sh
```

## Rebuild spider.swf (Spider / Loader_Spider client)

Download originals once (or use committed `*.orig`):

```bash
curl -sL "https://game.aq.com/game/gamefiles/spider.swf" -o gamefiles/spider.swf.orig
curl -sL "https://game.aq.com/game/gamefiles/Loader_Spider.swf" -o gamefiles/loaders/Loader_Spider.swf.orig
./tools/rebuild_spider.sh
```

Set `.env`: `GAME_LOADER=/gamefiles/loaders/Loader_Spider.swf`, `GAME_CLIENT_SWF=spider.swf`.
Spider uses JSON APIs under `/api/data/*` (gameversion, servers, clientvars, travelmap).

Or manually:

```bash
cp gamefiles/Game_20150324.swf.orig gamefiles/Game_20150324.swf
python3 tools/patch_game_repoint.py --src gamefiles/Game_20150324.swf.orig --dst gamefiles/Game_20150324.swf --host 127.0.0.1 --port 8080
python3 tools/patch_ruffle_framescripts.py
```

`patch_ruffle_framescripts.py` patches only the confirmed legacy-client/menu
frame failures. Spider's `mcPopup_355/frame2` and Greenguard MainTimeline
scripts must remain intact because they initialize popup references and map
cell properties.

`rebuild_spider.sh` also defers the four Options tab initializers until Ruffle
has constructed their timeline children and separates the Advanced Options X
from the main popup close action.

Landings `gamefiles/newuser/AQW-Landing-*.swf` are minimal empty SWF stubs (not symlinks to `AW-Registration.swf`).

## Configure

Copy `.env.example` → `.env` and adjust `PUBLIC_GAME_IP`, `WEB_PORT_HOST`, MySQL passwords, etc.

`WEB_PORT_HOST` is published by nginx. After changing it, recreate nginx too:

    docker compose up -d --force-recreate nginx web game
