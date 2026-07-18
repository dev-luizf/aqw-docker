#!/bin/sh
set -e
cd /opt/sfs

CP="./:./sfsExtensions/:./javaExtensions/"
for jar in lib/*.jar lib/javamail/*.jar lib/jetty/*.jar lib/jsp-2.1/*.jar; do
  [ -f "$jar" ] || continue
  CP="${CP}:${jar}"
done

echo "Starting SmartFoxServer on port ${GAME_PORT:-5588}..."
# AugoEidEs Console reads System.console(); under Docker that is null and NPEs.
# Feed a closed stdin so the console thread exits quietly after the server is up.
exec java \
  -server \
  -Xms256m -Xmx1024m \
  -cp "$CP" \
  -Dfile.encoding=UTF-8 \
  -Djava.util.logging.config.file=logging.properties \
  -Dgui=false \
  -Djava.awt.headless=true \
  it.gotoandplay.smartfoxserver.SmartFoxServer </dev/null
