# Armagedom Worlds — Docker

## Quick start

```bash
cp .env.example .env
docker compose up -d --build
```

Play in browser (Ruffle + WebSocket proxy):

  http://127.0.0.1:8081/play.php

Hard refresh after SWF changes: **Ctrl+Shift+R**

## Stack

| Service | Role |
|---------|------|
| `db` | MariaDB (`mextv3`) |
| `web` | PHP CMS (live-mounted repo) |
| `game` | SmartFox 1.6.9 + AugoEidEs (TCP 5588) |
| `proxy` | Ruffle WebSocket → TCP bridge |
| `nginx` | Front door (`WEB_PORT_HOST`, default 8081) |

## Default browser client

Configured via `.env`:

- `GAME_LOADER=/gamefiles/loaders/loader.swf`
- `GAME_CLIENT_SWF=Game_44.swf`
- `GAME_CLIENT_BG=client/prep.swf`
- `GAME_VERSION_STATUS=success` → `play.php` uses `/getversion.asp`

Login-time assets (`gMenu`, `sAssets`, `sBG`) come from `settings_login` in MariaDB.
Game_44 stack defaults: `AWMenu14012017.swf`, `AWAssets.swf` → `FantasyDreamAssets-v02.swf`.

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

Or manually:

```bash
cp gamefiles/Game_20150324.swf.orig gamefiles/Game_20150324.swf
python3 tools/patch_game_repoint.py --src gamefiles/Game_20150324.swf.orig --dst gamefiles/Game_20150324.swf --host 127.0.0.1 --port 8081
python3 tools/patch_ruffle_framescripts.py
```

`patch_ruffle_framescripts.py` patches only `mcPopup_270/frame2` on `Game_20150324.swf`, plus pre-patched `gameMenu/AWMenu*.swf` and `maps/Battleon/{YulgarV4,Eyulgaraw,Christmasyulgar}.swf`.

Landings `gamefiles/newuser/AQW-Landing-*.swf` are minimal empty SWF stubs (not symlinks to `AW-Registration.swf`).

## Configure

Copy `.env.example` → `.env` and adjust `PUBLIC_GAME_IP`, `WEB_PORT_HOST`, MySQL passwords, etc.
