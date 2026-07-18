#!/usr/bin/env bash
# Exit the legacy interactive console cleanly when the container has no stdin.
set -euo pipefail

SFS="${SFS_ROOT:-$(cd "$(dirname "$0")/../emulator/Server" && pwd)}"
CLASS_SRC="$SFS/javaExtensions/augoeides/console/Console.class"
CFR_JAR="${CFR_JAR:-/tmp/cfr.jar}"

if [[ ! -f "$CFR_JAR" ]]; then
  echo "CFR jar not found: $CFR_JAR" >&2
  exit 1
fi

WORKDIR="$(mktemp -d)"
trap 'rm -rf "$WORKDIR"' EXIT

java -jar "$CFR_JAR" "$CLASS_SRC" >"$WORKDIR/Console.java"

if grep -q 'if (cmd == null)' "$WORKDIR/Console.java"; then
  echo "AugoEidEs headless console patch already applied -> $CLASS_SRC"
  exit 0
fi

perl -0777 -i -pe '
  s/String cmd = reader\.readLine\(\);/String cmd = reader.readLine();\n                if (cmd == null) {\n                    return;\n                }/
    or die "console read pattern not found in Console.java\n";
' "$WORKDIR/Console.java"

CLASSPATH="$SFS/javaExtensions:$(find "$SFS/lib" -name '*.jar' | tr '\n' ':')"
mkdir -p "$WORKDIR/out"
javac -cp "$CLASSPATH" -d "$WORKDIR/out" "$WORKDIR/Console.java"
cp "$WORKDIR/out/augoeides/console/Console.class" "$CLASS_SRC"
echo "installed headless-safe Console.class -> $CLASS_SRC"
