<?php
/**
 * Static fallback for the Flash preloader (gameversion.asp).
 * Values must be URL-encoded — raw spaces break Ruffle/Flash URLVariables.
 */
header('Content-Type: application/x-www-form-urlencoded; charset=UTF-8');
header('Cache-Control: no-store, no-cache, must-revalidate');

require_once __DIR__ . '/classes/class.gameconfig.php';

$settings = GameConfig::clientSettings();
$status = GameConfig::env('GAME_VERSION_STATUS', 'success');

echo http_build_query([
    'status' => $status,
    'sFile'  => $settings['sFile'],
    'sTitle' => $settings['sTitle'],
    'sBG'    => $settings['sBG'],
], '', '&', PHP_QUERY_RFC3986);
