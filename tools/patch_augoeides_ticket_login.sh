#!/usr/bin/env bash
# Replace the reusable users.Hash check with a single-use, 60-second game ticket.
set -euo pipefail

SFS="${SFS_ROOT:-$(cd "$(dirname "$0")/../emulator/Server" && pwd)}"
CLASS_SRC="$SFS/javaExtensions/augoeides/world/Users.class"
CFR_JAR="${CFR_JAR:-/tmp/cfr.jar}"

if [[ ! -f "$CFR_JAR" ]]; then
  curl -fsSL -o "$CFR_JAR" \
    https://github.com/leibnitz27/cfr/releases/download/0.152/cfr-0.152.jar
fi

WORKDIR="$(mktemp -d)"
trap 'rm -rf "$WORKDIR"' EXIT

java -jar "$CFR_JAR" "$CLASS_SRC" > "$WORKDIR/Users.java"

if grep -q "game_login_tickets" "$WORKDIR/Users.java"; then
  echo "AugoEidEs single-use game ticket login already applied -> $CLASS_SRC"
  exit 0
fi

perl -0777 -i -pe '
  my $old = q{int databaseId = this.world.db.jdbc.queryForInt("SELECT id FROM users WHERE Name = ? AND Hash = ? LIMIT 1", new Object[]{name, hash});};
  my $new = q{int databaseId;
            this.world.db.jdbc.beginTransaction();
            try {
                databaseId = this.world.db.jdbc.queryForInt("SELECT u.id FROM game_login_tickets t INNER JOIN users u ON u.id = t.character_id WHERE u.Name = ? AND t.token_hash = SHA2(?, 256) AND t.consumed_at IS NULL AND t.expires_at > NOW() LIMIT 1 FOR UPDATE", new Object[]{name, hash});
                this.world.db.jdbc.run("UPDATE game_login_tickets SET consumed_at = NOW() WHERE character_id = ? AND token_hash = SHA2(?, 256) AND consumed_at IS NULL AND expires_at > NOW()", new Object[]{databaseId, hash});
                this.world.db.jdbc.commitTransaction();
            }
            catch (RuntimeException ticketFailure) {
                if (this.world.db.jdbc.isInTransaction()) {
                    this.world.db.jdbc.rollbackTransaction();
                }
                throw ticketFailure;
            }};
  index($_, $old) >= 0 or die "legacy users.Hash login query not found in Users.java\n";
  s/\Q$old\E/$new/;
' "$WORKDIR/Users.java"

# CFR loses the generic type on two aura queues in this old class. Restore an
# explicit cast so the otherwise unchanged decompiled source compiles on JDK 8.
perl -0777 -i -pe '
  s/for \(RemoveAura ra : auras\) \{/for (Object auraObject : auras) {\n            RemoveAura ra = (RemoveAura)auraObject;/g;
' "$WORKDIR/Users.java"

CLASSPATH="$SFS/javaExtensions:$(find "$SFS/lib" -name '*.jar' | tr '\n' ':')"
mkdir -p "$WORKDIR/out"
javac -cp "$CLASSPATH" -d "$WORKDIR/out" "$WORKDIR/Users.java"
cp "$WORKDIR/out/augoeides/world/Users.class" "$CLASS_SRC"
echo "installed single-use game ticket login -> $CLASS_SRC"
