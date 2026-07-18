-- Runs after 01-mextv3.sql on first container boot.
-- Point the playable server at the Ruffle-friendly loopback IP.
-- Actual PUBLIC_GAME_IP is also synced by the web entrypoint on every start.

UPDATE `servers`
SET
  `IP` = '127.0.0.1',
  `Online` = 1,
  `Name` = 'Armagedom',
  `Count` = 0,
  `Max` = 900,
  `MOTD` = 'Welcome to Armagedom Worlds (Docker). Play at /play.php'
WHERE `id` = 1;

UPDATE `servers`
SET `Online` = 0
WHERE `id` = 2;
