<?php
/**
 * Spider client bootstrap vars — menu/assets/slots (Artix /api/data/clientvars).
 */
require_once dirname(__DIR__, 2) . '/classes/class.gameconfig.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate');

$settings = GameConfig::clientSettings();
unset($settings['sFile'], $settings['sTitle'], $settings['sBG']);

echo json_encode($settings, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
