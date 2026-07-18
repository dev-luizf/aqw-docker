# syntax=docker/dockerfile:1

FROM mariadb:11.4
COPY docker/game/migrate.sh /opt/armagedom/migrate.sh
COPY lib/db/migrations /opt/migrations
RUN chmod +x /opt/armagedom/migrate.sh
USER mysql
ENTRYPOINT ["/opt/armagedom/migrate.sh"]
