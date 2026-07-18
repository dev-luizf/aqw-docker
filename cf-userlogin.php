<?php
/**
 * Flash/Ruffle account login — returns classic AQW <login> XML.
 *
 * XMLtoObject() turns same-named children into an array only when there are
 * 2+ of them. A single <servers/> becomes a plain object, so ServerList's
 * servers[i].sName stays null and the UI keeps FLA defaults (e.g. "Galanoth"
 * + FULL). Always emit at least two <servers/> children.
 *
 * iMax < 0 means FULL in the client — never send -1 for local Docker.
 */
require_once 'config.php';
require_once 'classes/class.smarty/Smarty.class.php';
require_once 'classes/class.content.php';
require_once 'classes/class.gamehandler.php';
require_once 'classes/class.data.php';

header('Content-Type: text/xml; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate');

$Handler = new Handler();
$Handler->caching = false;

if (empty($_POST)) {
    die('Invalid Request');
}

$_POST = $Handler->MySQL('EscapeArray', $_POST);

$authed = false;
if (isset($_POST['token']) && strcasecmp($_POST['token'], session_id()) == 0) {
    $authed = true;
} elseif ((isset($_POST['unm']) || isset($_POST['strUsername'])) && (isset($_POST['pwd']) || isset($_POST['strPassword']))) {
    $user = isset($_POST['unm']) ? $_POST['unm'] : $_POST['strUsername'];
    $pass = isset($_POST['pwd']) ? $_POST['pwd'] : $_POST['strPassword'];
    $authed = $Handler->AuthenticateUser($user, $pass);
}

if (!$authed) {
    echo '<login bSuccess="0" sMsg="The username and password you entered did not match. Please check the spelling and try again."/>';
    exit();
}

$u = $Handler->UserData;

// Upgrade days from expire date (DB UpgradeDays can be stale).
$upgDays = 0;
try {
    $expireRaw = !empty($u->UpgradeExpire) ? $u->UpgradeExpire : '2000-01-01 00:00:00';
    if ($expireRaw === '0000-00-00' || $expireRaw === '0000-00-00 00:00:00') {
        $expireRaw = '2000-01-01 00:00:00';
    }
    $datetime1 = new DateTime('now');
    $datetime2 = new DateTime($expireRaw);
    $upgDays = (int) $datetime1->diff($datetime2)->format('%r%a');
} catch (Exception $e) {
    $upgDays = 0;
    $expireRaw = '2000-01-01 00:00:00';
}

$dUpgExp = preg_replace('/\s+/', 'T', $expireRaw);
$email = isset($u->Email) && $u->Email !== null && $u->Email !== '' ? $u->Email : 'player@localhost';
$country = isset($u->Country) && $u->Country !== null && $u->Country !== '' ? $u->Country : 'xx';
$age = isset($u->Age) && $u->Age !== null && $u->Age !== '' ? (int) $u->Age : 18;
$access = isset($u->Access) ? (int) $u->Access : 1;
$activation = isset($u->ActivationFlag) ? (int) $u->ActivationFlag : 5;
$hash = isset($u->Hash) ? (string) $u->Hash : '';
$name = isset($u->Name) ? (string) $u->Name : '';
$userId = isset($u->id) ? (int) $u->id : 0;
$iUpg = $upgDays >= 0 ? 1 : 0;

$addr = $Handler->MySQL('EscapeString', isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1');
$countryEsc = $Handler->MySQL('EscapeString', $country);
$Handler->MySQL('Query', "UPDATE `users` SET Country = '{$countryEsc}', LastLogin = NOW(), webLogin=1, Address='{$addr}' WHERE id={$userId}");

$gamePort = (int) (Configuration::getPublic('GamePort') ?: 5588);
$publicIp = Configuration::getPublic('PublicGameIP') ?: '127.0.0.1';
$fallbackName = Configuration::getPublic('ServerName') ?: 'Armagedom';

// Keep player-count in sync for the CMS, but never advertise FULL to Flash.
$Handler->MySQL('Query', "UPDATE `servers` SET `Count` = 0 WHERE `Online` = 1 AND `Count` >= `Max`");

$ServerList = $Handler->MySQL('Query', "SELECT * FROM `servers` WHERE Online = 1 ORDER BY id ASC");

$xml = new SimpleXMLElement('<login/>');
$xml->addAttribute('bSuccess', '1');
$xml->addAttribute('sMsg', '');
$xml->addAttribute('userid', (string) $userId);
$xml->addAttribute('unm', $name);
$xml->addAttribute('iAccess', (string) $access);
$xml->addAttribute('iUpg', (string) $iUpg);
$xml->addAttribute('iAge', (string) $age);
$xml->addAttribute('sToken', $hash);
$xml->addAttribute('dUpgExp', $dUpgExp);
$xml->addAttribute('iUpgDays', (string) $upgDays);
$xml->addAttribute('iSendEmail', (string) $activation);
$xml->addAttribute('strEmail', $email);
$xml->addAttribute('bCCOnly', '0');
$xml->addAttribute('strCountryCode', $country);

$addServer = function (SimpleXMLElement $xml, $sName, $sIP, $iPort, $iCount, $iMax, $bOnline, $iChat, $bUpg) {
    $child = $xml->addChild('servers');
    $child->addAttribute('sName', (string) $sName);
    $child->addAttribute('sIP', (string) $sIP);
    $child->addAttribute('iPort', (string) (int) $iPort);
    $child->addAttribute('iCount', (string) (int) $iCount);
    // Client: iMax < 0 => "FULL". Always advertise open capacity locally.
    $max = (int) $iMax;
    if ($max < 1) {
        $max = 900;
    }
    $child->addAttribute('iMax', (string) $max);
    $child->addAttribute('bOnline', $bOnline ? '1' : '0');
    $child->addAttribute('bChat', '1');
    $child->addAttribute('iChat', (string) $iChat);
    $child->addAttribute('bUpg', (string) $bUpg);
    $child->addAttribute('sLang', 'xx');
};

$added = 0;
while ($server = $ServerList->fetch_assoc()) {
    $addServer(
        $xml,
        $server['Name'],
        $server['IP'],
        $gamePort,
        0, // show empty; DB Count can lag behind crashed sessions
        max(900, (int) $server['Max']),
        1,
        isset($server['Chat']) ? $server['Chat'] : '2',
        isset($server['Upgrade']) ? $server['Upgrade'] : '0'
    );
    $added++;
}

if ($added === 0) {
    $addServer($xml, $fallbackName, $publicIp, $gamePort, 0, 900, 1, '2', '0');
    $added++;
}

// Force XMLtoObject array path (single child becomes a non-indexable object).
if ($added < 2) {
    $addServer($xml, 'Offline', '0.0.0.0', $gamePort, 0, 900, 0, '2', '0');
}

// Emit element only (no XML declaration) — Flash XMLtoObject is picky.
$dom = dom_import_simplexml($xml);
echo $dom->ownerDocument->saveXML($dom->ownerDocument->documentElement);
exit();
