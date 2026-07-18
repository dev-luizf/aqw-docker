#!/bin/sh
set -e

MYSQL_HOST="${MYSQL_HOST:-db}"
MYSQL_PORT="${MYSQL_PORT:-3306}"
MYSQL_USER="${MYSQL_USER:-aqw}"
MYSQL_PASSWORD="${MYSQL_PASSWORD:-aqw}"
MYSQL_DATABASE="${MYSQL_DATABASE:-mextv3}"
PUBLIC_GAME_IP="${PUBLIC_GAME_IP:-127.0.0.1}"
SERVER_NAME="${SERVER_NAME:-Armagedom}"

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

# Keep servers.IP aligned with Ruffle socketProxy host on every boot.
mysql -h"$MYSQL_HOST" -P"$MYSQL_PORT" -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE" <<SQL
UPDATE \`servers\`
SET \`IP\`='${PUBLIC_GAME_IP}', \`Name\`='${SERVER_NAME}', \`Online\`=1
WHERE \`id\`=1;
UPDATE \`servers\` SET \`Online\`=0 WHERE \`id\`=2;
SQL

mkdir -p /var/www/html/caches /var/www/html/compiles
chown -R www-data:www-data /var/www/html/caches /var/www/html/compiles 2>/dev/null || true

exec "$@"
