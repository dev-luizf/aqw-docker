---
title: "Run AQ Worlds locally"
date: "2026-07-18"
summary: "Start your own AQW private server with Docker and configure the portal, game server, and client from one file."
---

AQW Docker packages the website, game server, browser socket bridge, and
database into one Docker setup. You can run the complete world on your own
computer without installing each service separately.

## What you need

- [Docker Desktop](https://docs.docker.com/get-started/get-docker/)
- A downloaded and extracted copy of this project

## Start the server

Open a terminal inside the project folder and create your local `.env` file.

On Windows PowerShell:

```powershell
Copy-Item .env.example .env
docker compose up --build -d
```

On macOS or Linux:

```bash
cp .env.example .env
docker compose up --build -d
```

The first build may take a few minutes. When it is ready, open
**http://127.0.0.1:8081** and select **Play** to create a character and enter
the game.

## Configure your world with `.env`

The `.env` file is the main configuration source for the whole project. Docker
passes its values to the portal, game server, client, socket bridge, and
database. Configure it before the first start when possible; this makes the
initial database use your chosen server settings immediately.

For a quick custom world, start with:

```env
# Names shown on the portal, game client, and server list
SITE_NAME=My AQW Server
SERVER_NAME=My Server
GAME_CLIENT_TITLE=My AQW Server

# Server-list message and maximum concurrent players
GAME_SERVER_MOTD=Welcome to my server!
GAME_SERVER_MAX_PLAYERS=100

# Character storage and social limits
GAME_MAX_BAG_SLOTS=100
GAME_MAX_BANK_SLOTS=200
GAME_MAX_HOUSE_SLOTS=50
GAME_MAX_GUILD_MEMBERS=50
GAME_MAX_FRIENDS=100
GAME_MAX_LOADOUT_SLOTS=10
```

The rest of `.env.example` is grouped by purpose:

| Settings                                                               | What they control                                                                                                                   |
| ---------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------- |
| `WEB_PORT_HOST`, `PROXY_PORT_HOST`                                     | Ports exposed on your computer for the portal and browser-to-game bridge.                                                           |
| `APP_ENV`, `BETTER_AUTH_URL`, `BETTER_AUTH_SECRET`                     | Portal environment, public URL, and account-session security. If you change the web port or hostname, update `BETTER_AUTH_URL` too. |
| `DEV_LOG_AUTH_LINKS`, `SMTP_*`, `MAIL_FROM`                            | Verification and password-reset email. Local development can print auth links; production requires SMTP.                            |
| `MYSQL_*`                                                              | Database name, user, password, and port. Replace the example passwords before any deployment.                                       |
| `PUBLIC_GAME_IP`, `GAME_PORT`, `SERVER_NAME`                           | Address, port, and name advertised by the game server.                                                                              |
| `GAME_SERVER_*`                                                        | Player capacity, chat mode, upgrade-only access, and message of the day.                                                            |
| `GAME_CLIENT_*`, `GAME_ASSETS`, `GAME_MAP`, and related `GAME_*` paths | SWF client identity and the game assets loaded in the browser. Keep the defaults unless you have compatible replacement files.      |
| `GAME_MAX_*`                                                           | Bag, bank, house, guild, friend, and loadout limits exposed to the client.                                                          |
| `JAVA_XMS`, `JAVA_XMX`                                                 | Minimum and maximum memory available to the Java game server.                                                                       |
| `SFS_ADMIN_*`                                                          | SmartFox administration credentials and allowed address. Replace the example credentials before deployment.                         |

Change only the value after `=` and keep each setting on its own line. Empty
values such as `SOCKET_PROXY_URL=` are intentional for the local setup; only
set that variable when the socket bridge has a separate public `wss://` URL.

After saving `.env`, rebuild and restart the services so every container gets
the new values:

```bash
docker compose up --build -d
```

## Stop and return later

Your characters and progress are stored in a Docker volume and remain available
after the services stop.

```bash
# Stop
docker compose down

# Start again
docker compose up -d
```

## Troubleshooting

Make sure Docker Desktop is running, then inspect the service status:

```bash
docker compose ps
```

To read error messages from the portal, database, or game server:

```bash
docker compose logs
```

This configuration is designed for play on the same computer. Publishing it on
the internet also requires unique secrets, working email delivery, TLS, firewall
rules, and additional network hardening.
