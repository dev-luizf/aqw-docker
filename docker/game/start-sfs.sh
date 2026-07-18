#!/bin/sh
set -e
cd /opt/sfs

CP="./:./sfsExtensions/:./javaExtensions/"
for jar in lib/*.jar lib/javamail/*.jar lib/jetty/*.jar lib/jsp-2.1/*.jar; do
  [ -f "$jar" ] || continue
  CP="${CP}:${jar}"
done

echo "Starting SmartFoxServer on port ${GAME_PORT:-5588}..."
JAVA_XMS="${JAVA_XMS:-128m}"
JAVA_XMX="${JAVA_XMX:-768m}"
exec java \
  -server \
  "-Xms${JAVA_XMS}" "-Xmx${JAVA_XMX}" \
  -cp "$CP" \
  -Dfile.encoding=UTF-8 \
  -Djava.util.logging.config.file=logging.properties \
  -Dgui=false \
  -Djava.awt.headless=true \
  it.gotoandplay.smartfoxserver.SmartFoxServer </dev/null
