#!/usr/bin/env bash
# Make the SmartFox moveToArea payload contain one monster definition per
# MonsterID. Map placements remain untouched in monmap.
set -euo pipefail

SFS="${SFS_ROOT:-$(cd "$(dirname "$0")/../emulator/Server" && pwd)}"
CLASS_SRC="$SFS/javaExtensions/augoeides/world/Rooms.class"
CFR_JAR="${CFR_JAR:-/tmp/cfr.jar}"

if [[ ! -f "$CFR_JAR" ]]; then
  curl -sL -o "$CFR_JAR" \
    https://github.com/leibnitz27/cfr/releases/download/0.152/cfr-0.152.jar
fi

WORKDIR="$(mktemp -d)"
trap 'rm -rf "$WORKDIR"' EXIT

java -jar "$CFR_JAR" "$CLASS_SRC" > "$WORKDIR/Rooms.java"

if grep -q 'seenMonsterIds' "$WORKDIR/Rooms.java"; then
  echo "Rooms monster-definition deduplication already applied -> $CLASS_SRC"
  exit 0
fi

perl -0777 -i -pe '
  s/(private\s+JSONArray\s+getMonsterDefinition\(Area\s+area\)\s+\{\s*
     JSONArray\s+monDef\s*=\s*new\s+JSONArray\(\);)/
    $1\n        HashSet<Integer> seenMonsterIds = new HashSet<Integer>();/x
    or die "getMonsterDefinition header not found in Rooms.java\n";

  s/(HashSet<Integer>\s+seenMonsterIds\s*=\s*new\s+HashSet<Integer>\(\);\s*)
     for\s+\(MapMonster\s+mapMonster\s*:\s*area\.monsters\)\s+\{\s*
     JSONObject\s+monInfo\s*=\s*new\s+JSONObject\(\);/
    $1 . "for (MapMonster mapMonster : area.monsters) {\n" .
    "            if (!seenMonsterIds.add(mapMonster.getMonsterId())) {\n" .
    "                continue;\n" .
    "            }\n" .
    "            JSONObject monInfo = new JSONObject();"/ex
    or die "getMonsterDefinition loop not found in Rooms.java\n";

  s/ConcurrentHashMap\s+monsters\s*=
     \(ConcurrentHashMap\)room\.properties\.get\(MONSTERS\);/
    ConcurrentHashMap<Integer, MonsterAI> monsters =
        (ConcurrentHashMap<Integer, MonsterAI>)room.properties.get(MONSTERS);/x;

  s/for\s+\(MonsterAI\s+actMon\s*:\s*monsters\.values\(\)\)\s+\{/
    for (Object actMonObject : monsters.values()) {\n
            MonsterAI actMon = (MonsterAI)actMonObject;/x;
' "$WORKDIR/Rooms.java"

CLASSPATH="$SFS/javaExtensions:$(find "$SFS/lib" -name '*.jar' | tr '\n' ':')"
mkdir -p "$WORKDIR/out"
javac -cp "$CLASSPATH" -d "$WORKDIR/out" "$WORKDIR/Rooms.java"
cp "$WORKDIR/out/augoeides/world/Rooms.class" "$CLASS_SRC"
echo "installed deduplicated Rooms.class -> $CLASS_SRC"
