#!/bin/sh
set -e

MYSQL_HOST="${MYSQL_HOST:-db}"
MYSQL_PORT="${MYSQL_PORT:-3306}"
MYSQL_USER="${MYSQL_USER:-aqw}"
MYSQL_PASSWORD="${MYSQL_PASSWORD:-aqw}"
MYSQL_DATABASE="${MYSQL_DATABASE:-mextv3}"
GAME_PORT="${GAME_PORT:-5588}"
SERVER_NAME="${SERVER_NAME:-Armagedom}"
SFS_ADMIN_USER="${SFS_ADMIN_USER:-dolphin}"
SFS_ADMIN_PASSWORD="${SFS_ADMIN_PASSWORD:-test123}"

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

export MYSQL_HOST MYSQL_PORT MYSQL_USER MYSQL_PASSWORD MYSQL_DATABASE
export GAME_PORT SERVER_NAME SFS_ADMIN_USER SFS_ADMIN_PASSWORD

# Escape XML special chars in password for JDBC URL / XML text nodes
xml_escape() {
  printf '%s' "$1" | sed -e 's/&/\&amp;/g' -e 's/</\&lt;/g' -e 's/>/\&gt;/g' -e 's/"/\&quot;/g'
}

export MYSQL_PASSWORD_XML
MYSQL_PASSWORD_XML="$(xml_escape "$MYSQL_PASSWORD")"
export SFS_ADMIN_PASSWORD_XML
SFS_ADMIN_PASSWORD_XML="$(xml_escape "$SFS_ADMIN_PASSWORD")"

envsubst '${GAME_PORT} ${MYSQL_HOST} ${MYSQL_PORT} ${MYSQL_DATABASE} ${MYSQL_USER} ${MYSQL_PASSWORD_XML} ${SFS_ADMIN_USER} ${SFS_ADMIN_PASSWORD_XML}' \
  < /opt/sfs/config.xml.template > /opt/sfs/config.xml

envsubst '${SERVER_NAME} ${MYSQL_HOST} ${MYSQL_PORT} ${MYSQL_DATABASE} ${MYSQL_USER} ${MYSQL_PASSWORD}' \
  < /opt/sfs/conf/AugoEidEs.conf.template > /opt/sfs/conf/AugoEidEs.conf

exec "$@"
