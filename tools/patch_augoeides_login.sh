#!/usr/bin/env bash
# Patch AugoEidEs SmartFox login nick parsing.
#
# Clients send nick as:
#   token~username~version   (Spider / modern)
#   userid~name              (legacy)
#   name                     (plain)
#
# The username is always the second segment when tilde-separated.
set -euo pipefail

SFS="${SFS_ROOT:-$(cd "$(dirname "$0")/../emulator/Server" && pwd)}"
CLASS_SRC="$SFS/javaExtensions/augoeides/AugoEidEs.class"
CFR_JAR="${CFR_JAR:-/tmp/cfr.jar}"

if [[ ! -f "$CFR_JAR" ]]; then
  curl -sL -o "$CFR_JAR" https://github.com/leibnitz27/cfr/releases/download/0.152/cfr-0.152.jar
fi

WORKDIR="$(mktemp -d)"
trap 'rm -rf "$WORKDIR"' EXIT

java -jar "$CFR_JAR" "$CLASS_SRC" > "$WORKDIR/AugoEidEs.java"

if grep -qE '(nickParts|stringArray)\.length > 1' "$WORKDIR/AugoEidEs.java"; then
  echo "AugoEidEs spider-safe nick parse already applied -> $CLASS_SRC"
  exit 0
fi

perl -0777 -i -pe '
  my $new = qq{String string2 = internalEventObject.getParam("nick");\n            String[] nickParts = string2.split("~");\n            String string3 = nickParts.length > 1 ? nickParts[1] : string2;};

  if (s/String string2 = internalEventObject\.getParam\("nick"\);\s*int n = string2\.indexOf\(126\);\s*String string3 = n >= 0 \? string2\.substring\(n \+ 1\) : string2;/$new/s) {
    $_ = $_;
  } elsif (s/String nickRaw = ieo\.getParam\("nick"\);\s*String nick;\s*int nickSep = nickRaw\.indexOf\(126\);\s*nick = nickSep >= 0 \? nickRaw\.substring\(nickSep \+ 1\) : nickRaw;/$new/s) {
    $_ = $_;
  } elsif (s/String nick = ieo\.getParam\("nick"\)\.split\("~"\)\[1\];/$new/s) {
    $_ = $_;
  } else {
    die "login nick pattern not found in AugoEidEs.java\n";
  }
' "$WORKDIR/AugoEidEs.java"

CLASSPATH="$SFS/javaExtensions:$(find "$SFS/lib" -name '*.jar' | tr '\n' ':')"
mkdir -p "$WORKDIR/out"
javac -cp "$CLASSPATH" -d "$WORKDIR/out" "$WORKDIR/AugoEidEs.java"
cp "$WORKDIR/out/augoeides/AugoEidEs.class" "$CLASS_SRC"
echo "installed patched AugoEidEs.class -> $CLASS_SRC"
