<?php
/**
 * Spider client server list — JSON array (same shape as Artix /api/data/servers).
 */
require_once dirname(__DIR__, 2) . '/config.php';
require_once dirname(__DIR__, 2) . '/classes/class.smarty/Smarty.class.php';
require_once dirname(__DIR__, 2) . '/classes/class.content.php';
require_once dirname(__DIR__, 2) . '/classes/class.gamehandler.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate');

$Handler = new Handler();
$Handler->caching = false;

$gamePort = (int) (Configuration::getPublic('GamePort') ?: 5588);
$publicIp = Configuration::getPublic('PublicGameIP') ?: '127.0.0.1';
$fallbackName = Configuration::getPublic('ServerName') ?: 'Armagedom';

$Handler->MySQL('Query', "UPDATE `servers` SET `Count` = 0 WHERE `Online` = 1 AND `Count` >= `Max`");
$ServerList = $Handler->MySQL('Query', "SELECT * FROM `servers` WHERE Online = 1 ORDER BY id ASC");

$out = [];
while ($server = $ServerList->fetch_assoc()) {
    $max = max(900, (int) $server['Max']);
    $out[] = [
        'sName' => (string) $server['Name'],
        'sIP' => (string) $server['IP'],
        'iCount' => 0,
        'iMax' => $max,
        'bOnline' => 1,
        'iChat' => isset($server['Chat']) ? (int) $server['Chat'] : 2,
        'bUpg' => isset($server['Upgrade']) ? (int) $server['Upgrade'] : 0,
        'sLang' => 'xx',
        'iPort' => $gamePort,
        'iLevel' => 0,
        'accessLevel' => 0,
    ];
}

if (count($out) === 0) {
    $out[] = [
        'sName' => $fallbackName,
        'sIP' => $publicIp,
        'iCount' => 0,
        'iMax' => 900,
        'bOnline' => 1,
        'iChat' => 2,
        'bUpg' => 0,
        'sLang' => 'xx',
        'iPort' => $gamePort,
        'iLevel' => 0,
        'accessLevel' => 0,
    ];
}

// Spider UI expects at least two entries when rendering the server picker.
if (count($out) < 2) {
    $out[] = [
        'sName' => 'Offline',
        'sIP' => '0.0.0.0',
        'iCount' => 0,
        'iMax' => 900,
        'bOnline' => 0,
        'iChat' => 2,
        'bUpg' => 0,
        'sLang' => 'xx',
        'iPort' => $gamePort,
        'iLevel' => 0,
        'accessLevel' => 0,
    ];
}

echo json_encode($out, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
