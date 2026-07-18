<?php
/**
 * Spider web login — Artix /api/login/now
 * GET  → plain "hi" (connectivity ping)
 * POST → JSON login result (replaces cf-userlogin.asp for spider.swf)
 */
require_once dirname(__DIR__, 2) . '/config.php';
require_once dirname(__DIR__, 2) . '/classes/class.smarty/Smarty.class.php';
require_once dirname(__DIR__, 2) . '/classes/class.content.php';
require_once dirname(__DIR__, 2) . '/classes/class.gamehandler.php';

header('Cache-Control: no-store, no-cache, must-revalidate');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Content-Type: text/html; charset=utf-8');
    echo 'hi';
    exit;
}

header('Content-Type: application/json; charset=utf-8');

$Handler = new Handler();
$Handler->caching = false;

/**
 * @return array{user?:string,pass?:string}
 */
function parse_login_now_body(): array
{
    $raw = file_get_contents('php://input');
    if ($raw !== false && trim($raw) !== '') {
        $trim = trim($raw);
        if ($trim[0] === '{') {
            $json = json_decode($trim, true);
            if (is_array($json)) {
                return [
                    'user' => $json['strUsername'] ?? $json['unm'] ?? $json['nick'] ?? $json['user'] ?? null,
                    'pass' => $json['strPassword'] ?? $json['pwd'] ?? $json['pword'] ?? $json['pass'] ?? null,
                ];
            }
        }
        if ($trim[0] === '<') {
            $prev = libxml_use_internal_errors(true);
            $xml = simplexml_load_string($trim);
            libxml_clear_errors();
            libxml_use_internal_errors($prev);
            if ($xml !== false) {
                return [
                    'user' => isset($xml->nick) ? (string) $xml->nick : (isset($xml->name) ? (string) $xml->name : null),
                    'pass' => isset($xml->pword) ? (string) $xml->pword : (isset($xml->pwd) ? (string) $xml->pwd : null),
                ];
            }
        }
        if (preg_match('/<nick><!\[CDATA\[(.*?)\]\]><\/nick><pword><!\[CDATA\[(.*?)\]\]><\/pword>/s', $raw, $m)) {
            return ['user' => $m[1], 'pass' => $m[2]];
        }
        if (preg_match('/<name><!\[CDATA\[(.*?)\]\]><\/name><pwd><!\[CDATA\[(.*?)\]\]><\/pwd>/s', $raw, $m)) {
            return ['user' => $m[1], 'pass' => $m[2]];
        }
    }

    $post = $_POST;
    if (isset($post['login']) && is_string($post['login']) && strpos($post['login'], '<login') !== false) {
        $prev = libxml_use_internal_errors(true);
        $xml = simplexml_load_string($post['login']);
        libxml_clear_errors();
        libxml_use_internal_errors($prev);
        if ($xml !== false) {
            return [
                'user' => isset($xml->nick) ? (string) $xml->nick : (isset($xml->name) ? (string) $xml->name : null),
                'pass' => isset($xml->pword) ? (string) $xml->pword : (isset($xml->pwd) ? (string) $xml->pwd : null),
            ];
        }
    }

    return [
        'user' => $post['strUsername'] ?? $post['unm'] ?? $post['nick'] ?? $post['name'] ?? $post['userName'] ?? $post['user'] ?? null,
        'pass' => $post['strPassword'] ?? $post['pwd'] ?? $post['pword'] ?? $post['password'] ?? $post['pass'] ?? null,
    ];
}

function json_fail(string $msg): void
{
    echo json_encode([
        'bSuccess' => '0',
        'sMsg' => $msg,
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    exit;
}

$creds = parse_login_now_body();
$user = isset($creds['user']) ? trim((string) $creds['user']) : '';
$pass = isset($creds['pass']) ? (string) $creds['pass'] : '';

if ($user === '' && $pass === '' && empty($_GET['nick']) && empty($_GET['strUsername'])) {
    // No saved session (Ruffle cannot restore Flash cookies). Omit sMsg so the
    // client skips showError() and lands on the login form instead of the
    // ConnDetail "Back / Contact Us" overlay.
    echo json_encode([
        'bSuccess' => '0',
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    exit;
}

if ($user === '' && isset($_GET['nick'])) {
    $user = trim((string) $_GET['nick']);
}
if ($pass === '' && isset($_GET['pword'])) {
    $pass = (string) $_GET['pword'];
}
if ($user === '' && isset($_GET['strUsername'])) {
    $user = trim((string) $_GET['strUsername']);
}
if ($pass === '' && isset($_GET['strPassword'])) {
    $pass = (string) $_GET['strPassword'];
}

$authed = false;
if ($user !== '' && $pass !== '') {
    $authed = $Handler->AuthenticateUser($user, $pass);
}

if (!$authed) {
  json_fail($user === '' && $pass === ''
      ? 'What? Try again.'
      : 'The username and password you entered did not match. Please check the spelling and try again.');
}

$u = $Handler->UserData;

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

$Handler->MySQL('Query', "UPDATE `servers` SET `Count` = 0 WHERE `Online` = 1 AND `Count` >= `Max`");
$ServerList = $Handler->MySQL('Query', "SELECT * FROM `servers` WHERE Online = 1 ORDER BY id ASC");

$servers = [];
while ($server = $ServerList->fetch_assoc()) {
    $max = max(900, (int) $server['Max']);
    $servers[] = [
        'sName' => (string) $server['Name'],
        'sIP' => (string) $server['IP'],
        'iPort' => $gamePort,
        'iCount' => 0,
        'iMax' => $max,
        'bOnline' => 1,
        'iChat' => isset($server['Chat']) ? (int) $server['Chat'] : 2,
        'bUpg' => isset($server['Upgrade']) ? (int) $server['Upgrade'] : 0,
        'sLang' => 'xx',
    ];
}

if (count($servers) === 0) {
    $servers[] = [
        'sName' => $fallbackName,
        'sIP' => $publicIp,
        'iPort' => $gamePort,
        'iCount' => 0,
        'iMax' => 900,
        'bOnline' => 1,
        'iChat' => 2,
        'bUpg' => 0,
        'sLang' => 'xx',
    ];
}

if (count($servers) < 2) {
    $servers[] = [
        'sName' => 'Offline',
        'sIP' => '0.0.0.0',
        'iPort' => $gamePort,
        'iCount' => 0,
        'iMax' => 900,
        'bOnline' => 0,
        'iChat' => 2,
        'bUpg' => 0,
        'sLang' => 'xx',
    ];
}

echo json_encode([
    'bSuccess' => '1',
    'sMsg' => '',
    'userid' => (string) $userId,
    'unm' => $name,
    'iAccess' => (string) $access,
    'iUpg' => (string) $iUpg,
    'iAge' => (string) $age,
    'sToken' => $hash,
    'dUpgExp' => $dUpgExp,
    'iUpgDays' => (string) $upgDays,
    'iSendEmail' => (string) $activation,
    'strEmail' => $email,
    'bCCOnly' => '0',
    'strCountryCode' => $country,
    'servers' => $servers,
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
