<?php
/**
 * Local quest gate check — Spider calls /game/quest.asp?userid=&qvalue= on map travel.
 * Live Artix returns plain "OK"; must be same-origin (no CORS) for Ruffle URLLoader.
 */
header('Content-Type: text/plain; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Access-Control-Allow-Origin: *');

echo 'OK';
