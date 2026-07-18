#!/bin/sh
set -eu

MIGRATIONS_DIR="${MIGRATIONS_DIR:-/opt/migrations}"
JOURNAL="${MIGRATIONS_DIR}/meta/_journal.json"
LOCK_TIMEOUT="${MIGRATION_LOCK_TIMEOUT:-120}"
LOCK_STALE_MINUTES="${MIGRATION_LOCK_STALE_MINUTES:-60}"

case "$LOCK_TIMEOUT" in
  '' | *[!0-9]*)
    echo "Migration lock settings must be non-negative integers" >&2
    exit 1
    ;;
esac
case "$LOCK_STALE_MINUTES" in
  '' | *[!0-9]*)
    echo "Migration lock settings must be non-negative integers" >&2
    exit 1
    ;;
esac

if [ ! -f "$JOURNAL" ]; then
  echo "Migration journal not found: $JOURNAL" >&2
  exit 1
fi

export MYSQL_PWD="$MYSQL_PASSWORD"

database() {
  mysql \
    --protocol=TCP \
    --host="$MYSQL_HOST" \
    --port="$MYSQL_PORT" \
    --user="$MYSQL_USER" \
    --database="$MYSQL_DATABASE" \
    --batch \
    --skip-column-names \
    "$@"
}

database <<'SQL'
CREATE TABLE IF NOT EXISTS `__drizzle_migrations` (
  `id` serial PRIMARY KEY,
  `hash` text NOT NULL,
  `created_at` bigint
);

CREATE TABLE IF NOT EXISTS `__armagedom_migration_lock` (
  `name` varchar(64) NOT NULL,
  `owner` char(64) NOT NULL,
  `acquired_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`name`)
);
SQL

owner="$(
  printf '%s:%s:%s\n' "$(hostname)" "$$" "$(date +%s)" |
    sha256sum |
    cut -d ' ' -f 1
)"

release_lock() {
  database --execute="
    DELETE FROM \`__armagedom_migration_lock\`
    WHERE \`name\` = 'drizzle' AND \`owner\` = '${owner}';
  " >/dev/null 2>&1 || true
}
trap release_lock EXIT INT TERM

echo "Waiting for the database migration lock..."
waited=0
while :; do
  acquired="$(
    database --execute="
      DELETE FROM \`__armagedom_migration_lock\`
      WHERE \`name\` = 'drizzle'
        AND \`acquired_at\` < CURRENT_TIMESTAMP - INTERVAL ${LOCK_STALE_MINUTES} MINUTE;
      INSERT IGNORE INTO \`__armagedom_migration_lock\`
        (\`name\`, \`owner\`) VALUES ('drizzle', '${owner}');
      SELECT COUNT(*) FROM \`__armagedom_migration_lock\`
      WHERE \`name\` = 'drizzle' AND \`owner\` = '${owner}';
    " |
      tail -n 1
  )"

  if [ "$acquired" = "1" ]; then
    break
  fi

  if [ "$waited" -ge "$LOCK_TIMEOUT" ]; then
    echo "Timed out waiting for the database migration lock" >&2
    exit 1
  fi

  sleep 2
  waited=$((waited + 2))
done

manifest="$(mktemp)"
trap 'rm -f "$manifest"; release_lock' EXIT INT TERM

awk '
  /"when":[[:space:]]*[0-9]+/ {
    value = $0
    sub(/^.*"when":[[:space:]]*/, "", value)
    sub(/[^0-9].*$/, "", value)
    timestamp = value
  }
  /"tag":[[:space:]]*"/ {
    value = $0
    sub(/^.*"tag":[[:space:]]*"/, "", value)
    sub(/".*$/, "", value)
    if (timestamp == "") exit 1
    print timestamp "\t" value
    timestamp = ""
  }
' "$JOURNAL" >"$manifest"

if [ ! -s "$manifest" ]; then
  echo "No migrations found in $JOURNAL" >&2
  exit 1
fi

while IFS="$(printf '\t')" read -r created_at tag; do
  case "$created_at" in
    '' | *[!0-9]*)
      echo "Invalid migration timestamp: $created_at" >&2
      exit 1
      ;;
  esac
  case "$tag" in
    '' | *[!A-Za-z0-9_-]*)
      echo "Invalid migration tag: $tag" >&2
      exit 1
      ;;
  esac

  migration="${MIGRATIONS_DIR}/${tag}.sql"
  if [ ! -f "$migration" ]; then
    echo "Migration file not found: $migration" >&2
    exit 1
  fi

  last_applied="$(
    database --execute="
      SELECT COALESCE(MAX(\`created_at\`), 0)
      FROM \`__drizzle_migrations\`;
    "
  )"
  if [ "$last_applied" -ge "$created_at" ]; then
    echo "Migration already applied: $tag"
    continue
  fi

  echo "Applying migration: $tag"
  sed '/^[[:space:]]*--> statement-breakpoint[[:space:]]*$/d' "$migration" |
    database

  hash="$(sha256sum "$migration" | cut -d ' ' -f 1)"
  database --execute="
    INSERT INTO \`__drizzle_migrations\` (\`hash\`, \`created_at\`)
    VALUES ('${hash}', ${created_at});
  "
done <"$manifest"

echo "Database migrations are up to date."
