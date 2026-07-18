<?php
/**
 * Static fallback for the Flash preloader (gameversion.asp).
 * Values must be URL-encoded — raw spaces break Ruffle/Flash URLVariables.
 */
header('Content-Type: application/x-www-form-urlencoded; charset=UTF-8');
header('Cache-Control: no-store, no-cache, must-revalidate');

$sFile = getenv('GAME_CLIENT_SWF') !== false && getenv('GAME_CLIENT_SWF') !== ''
    ? getenv('GAME_CLIENT_SWF')
    : 'Game_44.swf';
$sTitle = getenv('GAME_CLIENT_TITLE') !== false && getenv('GAME_CLIENT_TITLE') !== ''
    ? getenv('GAME_CLIENT_TITLE')
    : 'Armagedom Worlds';
$sBG = getenv('GAME_CLIENT_BG') !== false && getenv('GAME_CLIENT_BG') !== ''
    ? getenv('GAME_CLIENT_BG')
    : 'Back.swf';
$status = getenv('GAME_VERSION_STATUS') !== false && getenv('GAME_VERSION_STATUS') !== ''
    ? getenv('GAME_VERSION_STATUS')
    : 'miku';

echo http_build_query([
    'status' => $status,
    'sFile'  => $sFile,
    'sTitle' => $sTitle,
    'sBG'    => $sBG,
], '', '&', PHP_QUERY_RFC3986);
