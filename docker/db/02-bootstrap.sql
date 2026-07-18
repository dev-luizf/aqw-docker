-- Runs after 01-mextv3.sql on first container boot.
-- Point the playable server at the Ruffle-friendly loopback IP.
-- Actual game/client values are synced from .env by both runtime entrypoints.

-- Allow full asset paths/hostnames instead of the legacy 50/15-character limits.
ALTER TABLE `settings_login` MODIFY `value` varchar(255) NOT NULL DEFAULT '';
ALTER TABLE `servers` MODIFY `IP` varchar(255) NOT NULL DEFAULT '0.0.0.0';

UPDATE `servers`
SET
  `IP` = '127.0.0.1',
  `Online` = 1,
  `Name` = 'Armagedom',
  `Count` = 0,
  `Max` = 900,
  `MOTD` = 'Welcome to Armagedom Worlds (Docker). Play at /play'
WHERE `id` = 1;

UPDATE `servers`
SET `Online` = 0
WHERE `id` = 2;
