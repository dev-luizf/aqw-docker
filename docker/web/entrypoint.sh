#!/bin/sh
set -e

MYSQL_HOST="${MYSQL_HOST:-db}"
MYSQL_PORT="${MYSQL_PORT:-3306}"
MYSQL_USER="${MYSQL_USER:-aqw}"
MYSQL_PASSWORD="${MYSQL_PASSWORD:-aqw}"
MYSQL_DATABASE="${MYSQL_DATABASE:-mextv3}"

echo "Waiting for MySQL at ${MYSQL_HOST}:${MYSQL_PORT}..."
i=0
until mysqladmin ping -h"$MYSQL_HOST" -P"$MYSQL_PORT" -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" --silent 2>/dev/null; do
  i=$((i + 1))
  if [ "$i" -ge 60 ]; then
    echo "MySQL did not become ready in time" >&2
    exit 1
  fi
  sleep 2
done
echo "MySQL is up."

/var/www/html/docker/sync-game-config.sh

mkdir -p /var/www/html/caches /var/www/html/compiles
chown -R www-data:www-data /var/www/html/caches /var/www/html/compiles 2>/dev/null || true

exec "$@"
