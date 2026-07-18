-- Classic Battleon town (/join battleon).
-- SWF: gamefiles/maps/Battleon/town-Battleon-21June12.swf

INSERT INTO `maps` (`Name`, `File`, `MaxPlayers`, `ReqLevel`, `Upgrade`, `Staff`, `PvP`)
SELECT 'Battleon', 'Battleon/town-Battleon-21June12.swf', 10, 1, 0, 0, 0
FROM DUAL
WHERE NOT EXISTS (
  SELECT 1 FROM `maps` WHERE LOWER(`Name`) = 'battleon'
);
