# syntax=docker/dockerfile:1

FROM eclipse-temurin:8-jdk AS patcher
WORKDIR /build
ARG CFR_VERSION=0.152
ARG CFR_SHA256=f686e8f3ded377d7bc87d216a90e9e9512df4156e75b06c655a16648ae8765b2
COPY emulator/Server /opt/sfs
COPY tools/patch_augoeides_login.sh /tools/patch_augoeides_login.sh
COPY tools/patch_augoeides_ticket_login.sh /tools/patch_augoeides_ticket_login.sh
COPY tools/patch_augoeides_console.sh /tools/patch_augoeides_console.sh
COPY tools/patch_rooms_monster_definitions.sh /tools/patch_rooms_monster_definitions.sh
RUN curl -fsSL -o /tmp/cfr.jar "https://github.com/leibnitz27/cfr/releases/download/${CFR_VERSION}/cfr-${CFR_VERSION}.jar" \
  && echo "${CFR_SHA256}  /tmp/cfr.jar" | sha256sum -c - \
  && chmod +x /tools/patch_augoeides_login.sh /tools/patch_augoeides_ticket_login.sh /tools/patch_augoeides_console.sh /tools/patch_rooms_monster_definitions.sh \
  && SFS_ROOT=/opt/sfs CFR_JAR=/tmp/cfr.jar /tools/patch_augoeides_login.sh \
  && SFS_ROOT=/opt/sfs CFR_JAR=/tmp/cfr.jar /tools/patch_augoeides_ticket_login.sh \
  && SFS_ROOT=/opt/sfs CFR_JAR=/tmp/cfr.jar /tools/patch_augoeides_console.sh \
  && SFS_ROOT=/opt/sfs CFR_JAR=/tmp/cfr.jar /tools/patch_rooms_monster_definitions.sh \
  && rm -rf /opt/sfs/lib/jetty /opt/sfs/lib/jsp-2.1 /opt/sfs/webserver

FROM eclipse-temurin:8-jre-jammy

RUN apt-get update \
  && apt-get install -y --no-install-recommends default-mysql-client gettext-base \
  && rm -rf /var/lib/apt/lists/* \
  && groupadd --system --gid 1001 smartfox \
  && useradd --system --uid 1001 --gid smartfox --home-dir /opt/sfs --shell /usr/sbin/nologin smartfox

WORKDIR /opt/sfs

# SmartFoxServer Pro + AugoEidEs extension (compatibility patches applied above)
COPY --from=patcher --chown=smartfox:smartfox /opt/sfs /opt/sfs

COPY --chown=smartfox:smartfox docker/game/config.xml.template /opt/sfs/config.xml.template
COPY --chown=smartfox:smartfox docker/game/AugoEidEs.conf.template /opt/sfs/conf/AugoEidEs.conf.template
COPY docker/game/entrypoint.sh /entrypoint.sh
COPY --chown=smartfox:smartfox docker/game/start-sfs.sh /opt/sfs/start-sfs.sh
COPY --chown=smartfox:smartfox docker/sync-game-config.sh /opt/sfs/sync-game-config.sh

RUN chmod +x /entrypoint.sh /opt/sfs/start-sfs.sh /opt/sfs/sync-game-config.sh \
  && install -d -o smartfox -g smartfox /opt/sfs/logs /opt/sfs/datastore

USER smartfox:smartfox
EXPOSE 5588
WORKDIR /opt/sfs
ENTRYPOINT ["/entrypoint.sh"]
CMD ["/opt/sfs/start-sfs.sh"]
