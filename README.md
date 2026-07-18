# Armagedom Worlds

The portal is a Next.js 16 App Router application. It uses Tailwind CSS v4,
shadcn-style components, repository Markdown posts, Better Auth, Drizzle ORM,
and a pinned self-hosted Ruffle client. SmartFox/AugoEidEs, the WebSocket
bridge, MariaDB, game assets, content seed, and SWF patch tools remain intact.

## Run locally with Docker

```bash
cp .env.example .env
# Replace BETTER_AUTH_SECRET before starting.
docker compose up --build
```

Open <http://127.0.0.1:8081>. The migration service runs the reviewed Drizzle
migrations once before either the portal or SmartFox starts.

The first migration intentionally clears player-created data and preserves the
static game definitions loaded by `docker/db/01-mextv3.sql`. Never run
`drizzle-kit push` against production. Add reviewed SQL migrations under
`lib/db/migrations/`, then run:

```bash
corepack pnpm db:migrate
```

## Local Next.js development

```bash
corepack pnpm install
cp .env.example .env
corepack pnpm dev
```

`DATABASE_URL` may be used instead of the individual `MYSQL_*` variables.
Ruffle is copied from the pinned npm package into `public/ruffle` before dev
and builds; generated files are not committed.

## Posts

Add `content/posts/<slug>.md` with:

```yaml
---
title: Post title
date: 2026-07-18
summary: Short homepage summary.
image: /images/optional-image.jpg
draft: false
---
```

Slugs, required metadata, and duplicate names are checked during the build.
Production builds exclude drafts and pre-render all published post pages.

## Authentication mail

Production requires `APP_ENV=production` and SMTP (`SMTP_HOST`, `SMTP_PORT`,
credentials when needed, and `MAIL_FROM`). The app refuses to start without
SMTP in that mode, and authentication links are never logged. For local
development only, `APP_ENV=development` plus `DEV_LOG_AUTH_LINKS=true`
explicitly enables link logging.

Players may enter the game before verification, but password recovery only
sends mail for verified addresses. Account credentials are Better Auth
identities linked to integer game characters by `users.AuthUserID`.

## Game compatibility

Nginx serves exact-case `/gamefiles/*` paths directly. Missing paths pass to a
traversal-safe case-insensitive Next.js resolver, including the default-hair
fallback. Browser TCP traffic uses `/flash-socket-proxy`.

The game image applies:

- `tools/patch_augoeides_login.sh` for Spider nick parsing.
- `tools/patch_augoeides_ticket_login.sh` for atomic, single-use game tickets.
- `tools/patch_rooms_monster_definitions.sh` for existing compatibility.

The legacy PHP portal and Apache runtime have been removed. Only active Flash
URL aliases are retained as Next.js rewrites; removed CMS URLs return 404.
