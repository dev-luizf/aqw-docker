#!/usr/bin/env bash
# Patch legacy AugoEidEs responses to match the Spider client protocol.
set -euo pipefail

SFS="${SFS_ROOT:-$(cd "$(dirname "$0")/../emulator/Server" && pwd)}"
CFR_JAR="${CFR_JAR:-/tmp/cfr.jar}"
REQUESTS="$SFS/javaExtensions/augoeides/requests"

if [[ ! -f "$CFR_JAR" ]]; then
  echo "CFR jar not found: $CFR_JAR" >&2
  exit 1
fi

WORKDIR="$(mktemp -d)"
trap 'rm -rf "$WORKDIR"' EXIT

for class_name in BuyItem GetFriendList; do
  java -jar "$CFR_JAR" "$REQUESTS/$class_name.class" >"$WORKDIR/$class_name.java"
done

if ! grep -q 'buy.put((Object)"iQty"' "$WORKDIR/BuyItem.java"; then
  perl -0777 -i -pe '
    s/\(Object\)-1/\(Object\)\(-1\)/g;
    s/boolean bl = item\.isCoins\(\) && cost <= coins \? true : \(valid = cost <= gold\);/valid = item.isCoins() ? cost <= coins : cost <= gold;/
      or die "BuyItem currency validation pattern not found\n";
    s/buy\.put\(\(Object\)"CharItemID", \(Object\)charItemId\);/buy.put((Object)"CharItemID", (Object)charItemId);\n                            buy.put((Object)"iQty", (Object)item.getQuantity());\n                            buy.put((Object)"bBank", (Object)0);/
      or die "BuyItem success response pattern not found\n";
  ' "$WORKDIR/BuyItem.java"
fi

if ! grep -q 'friends.put((Object)"showList"' "$WORKDIR/GetFriendList.java"; then
  perl -0777 -i -pe '
    s/friends\.put\(\(Object\)"friends", \(Object\)world\.users\.getFriends\(user\)\);/friends.put((Object)"friends", (Object)world.users.getFriends(user));\n        friends.put((Object)"showList", (Object)1);/
      or die "GetFriendList response pattern not found\n";
  ' "$WORKDIR/GetFriendList.java"
fi

CLASSPATH="$SFS/javaExtensions:$(find "$SFS/lib" -name '*.jar' | tr '\n' ':')"
mkdir -p "$WORKDIR/out"
javac -cp "$CLASSPATH" -d "$WORKDIR/out" \
  "$WORKDIR/BuyItem.java" \
  "$WORKDIR/GetFriendList.java"

for class_name in BuyItem GetFriendList; do
  cp "$WORKDIR/out/augoeides/requests/$class_name.class" "$REQUESTS/$class_name.class"
done

echo "installed Spider client-contract patches -> $REQUESTS"
