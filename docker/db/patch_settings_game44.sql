-- Game_44 evaluation stack: newer menu + Dec 2016 UI assets.
-- Apply: docker compose exec -T db mysql -u root -parmagedom mextv3 < docker/db/patch_settings_game44.sql

UPDATE `settings_login` SET `value` = 'F2.swf' WHERE `name` = 'sFile';
UPDATE `settings_login` SET `value` = 'AWMenu14012017.swf' WHERE `name` = 'gMenu';
UPDATE `settings_login` SET `value` = 'AWAssets.swf' WHERE `name` = 'sAssets';
UPDATE `settings_login` SET `value` = 'Back.swf' WHERE `name` = 'sBG';
UPDATE `settings_login` SET `value` = '' WHERE `name` = 'sNews';
