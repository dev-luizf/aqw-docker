# syntax=docker/dockerfile:1

FROM eclipse-temurin:8-jdk AS patcher
WORKDIR /build
COPY emulator/Server /opt/sfs
COPY tools/patch_augoeides_login.sh /tools/patch_augoeides_login.sh
COPY tools/patch_rooms_monster_definitions.sh /tools/patch_rooms_monster_definitions.sh
RUN curl -sL -o /tmp/cfr.jar https://github.com/leibnitz27/cfr/releases/download/0.152/cfr-0.152.jar \
  && chmod +x /tools/patch_augoeides_login.sh /tools/patch_rooms_monster_definitions.sh \
  && SFS_ROOT=/opt/sfs CFR_JAR=/tmp/cfr.jar /tools/patch_augoeides_login.sh \
  && SFS_ROOT=/opt/sfs CFR_JAR=/tmp/cfr.jar /tools/patch_rooms_monster_definitions.sh

FROM eclipse-temurin:8-jre-jammy

RUN apt-get update \
  && apt-get install -y --no-install-recommends default-mysql-client gettext-base \
  && rm -rf /var/lib/apt/lists/*

WORKDIR /opt/sfs

# SmartFoxServer Pro + AugoEidEs extension (compatibility patches applied above)
COPY --from=patcher /opt/sfs /opt/sfs

COPY docker/game/config.xml.template /opt/sfs/config.xml.template
COPY docker/game/AugoEidEs.conf.template /opt/sfs/conf/AugoEidEs.conf.template
COPY docker/game/entrypoint.sh /entrypoint.sh
COPY docker/game/start-sfs.sh /opt/sfs/start-sfs.sh
COPY docker/sync-game-config.sh /opt/sfs/sync-game-config.sh

RUN chmod +x /entrypoint.sh /opt/sfs/start-sfs.sh /opt/sfs/sync-game-config.sh \
  && mkdir -p /opt/sfs/logs /opt/sfs/datastore

EXPOSE 5588
WORKDIR /opt/sfs
ENTRYPOINT ["/entrypoint.sh"]
CMD ["/opt/sfs/start-sfs.sh"]
