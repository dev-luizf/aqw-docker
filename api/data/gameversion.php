<?php
/**
 * Spider / modern AQW loader — JSON gameversion (Loader_Spider, AQLite, AquaStar).
 * Official: https://game.aq.com/game/api/data/gameversion
 */
require_once dirname(__DIR__, 2) . '/config.php';
require_once dirname(__DIR__, 2) . '/classes/class.gameconfig.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate');

$settings = GameConfig::clientSettings();

echo json_encode([
    'sFile' => $settings['sFile'],
    'sTitle' => $settings['sTitle'],
    'sBG' => $settings['sBG'],
    'sVersion' => $settings['sVersion'],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
