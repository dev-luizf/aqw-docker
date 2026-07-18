<?php
/**
 * Browser play page — Ruffle + WebSocket→TCP proxy (same pattern as project-azdana).
 */
require_once __DIR__ . '/config.php';

$publicGameIP = Configuration::getPublic('PublicGameIP') ?: '127.0.0.1';
$gamePort = (int) (Configuration::getPublic('GamePort') ?: 5588);
$gameLoader = Configuration::getPublic('GameLoader') ?: '/gamefiles/loaders/loader.swf';
$gameLoaderUrl = $gameLoader;
if ($gameLoaderUrl !== '' && $gameLoaderUrl[0] === '/') {
    $loaderFs = __DIR__ . $gameLoaderUrl;
    if (is_file($loaderFs)) {
        $gameLoaderUrl .= '?t=' . filemtime($loaderFs);
    }
}
$gameVersionStatus = getenv('GAME_VERSION_STATUS') !== false ? getenv('GAME_VERSION_STATUS') : '';
$loaderParameters = ['sLang' => 'en'];
if ($gameVersionStatus === 'success' || strpos($gameLoader, 'loaders/loader.swf') !== false) {
    if (stripos($gameLoader, 'Loader_Spider') === false) {
        $loaderParameters['versionProvider'] = '/getversion.asp';
    }
}
$host = $_SERVER['HTTP_X_FORWARDED_HOST'] ?? ($_SERVER['HTTP_HOST'] ?? '127.0.0.1');
// Prefer the public host:port the browser used (nginx may forward without the mapped port).
if (!empty($_SERVER['HTTP_X_FORWARDED_PORT'])
    && strpos($host, ':') === false
    && !in_array($_SERVER['HTTP_X_FORWARDED_PORT'], ['80', '443'], true)
) {
    $host .= ':' . $_SERVER['HTTP_X_FORWARDED_PORT'];
}
$preferredHost = (stripos($host, 'localhost') === 0)
    ? ('127.0.0.1' . (strpos($host, ':') !== false ? substr($host, strpos($host, ':')) : ''))
    : $host;

$proto = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'wss' : 'ws';
if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
    $fwd = strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']);
    $proto = ($fwd === 'https') ? 'wss' : 'ws';
}
$proxyURL = $proto . '://' . $host . '/flash-socket-proxy';

$httpBase = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http')
    . '://' . $preferredHost . '/';
if (stripos($gameLoader, 'Loader_Spider') !== false) {
    // Spider loader: JSON gameversion + gamefiles/* relative to site root.
    $loaderParameters['base'] = $httpBase;
    // Private Ruffle stack: use classic cf-userlogin.php XML (not api/login/now JSON).
    // Loader reads flashvar "isweb" (lowercase); spider always uses loginURL JSON, not cf-userlogin XML.
    $loaderParameters['isweb'] = 'false';
    $loaderParameters['isWeb'] = 'false';
    $loaderParameters['allowNetworking'] = 'all';
}

$configJson = json_encode([
    'publicGameIP' => $publicGameIP,
    'gamePort' => $gamePort,
    'proxyURL' => $proxyURL,
], JSON_UNESCAPED_SLASHES);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Play - <?php echo htmlspecialchars(Configuration::getPublic('Name') ?: 'Armagedom', ENT_QUOTES, 'UTF-8'); ?></title>
    <script>
      if (location.hostname === "localhost") {
        location.replace(location.protocol + "//<?php echo htmlspecialchars($preferredHost, ENT_QUOTES, 'UTF-8'); ?>" + location.pathname + location.search);
      }
    </script>
    <style>
      * { box-sizing: border-box; }
      body {
        margin: 0;
        font-family: Georgia, "Times New Roman", serif;
        background: radial-gradient(ellipse at top, #2a1a12 0%, #0d0a08 55%, #050403 100%);
        color: #e8dcc8;
        min-height: 100vh;
      }
      header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px 20px;
        padding: 12px 20px;
        border-bottom: 1px solid rgba(232, 220, 200, 0.15);
      }
      header nav {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        gap: 8px 16px;
      }
      header a { color: #e8dcc8; text-decoration: none; opacity: 0.85; white-space: nowrap; }
      header a:hover { opacity: 1; }
      .brand { font-size: 1.25rem; letter-spacing: 0.04em; font-weight: bold; }
      main {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        padding: 20px 16px 40px;
      }
      .game-shell {
        width: 960px;
        height: 550px;
        flex-shrink: 0;
        line-height: 0;
        background: #000;
      }
      .game-shell ruffle-player,
      .game-shell ruffle-object {
        width: 960px !important;
        height: 550px !important;
        display: block !important;
      }
      .game-shell canvas {
        display: block;
      }
      .hint { color: #aaa; font-size: 12px; text-align: center; max-width: 960px; }
    </style>
    <script>
      window.__AQW__ = <?php echo $configJson; ?>;
      window.RufflePlayer = window.RufflePlayer || {};
      window.RufflePlayer.config = {
        autoplay: "on",
        unmuteOverlay: "hidden",
        splashScreen: false,
        muted: true,
        allowScriptAccess: true,
        logLevel: "warn",
        polyfills: false,
        wmode: "window",
        letterbox: "on",
        scale: "showAll",
        forceScale: false,
        credentialAllowList: [window.location.origin],
        socketProxy: [
          { host: window.__AQW__.publicGameIP, port: window.__AQW__.gamePort, proxyUrl: window.__AQW__.proxyURL },
          { host: "localhost", port: window.__AQW__.gamePort, proxyUrl: window.__AQW__.proxyURL },
          { host: "127.0.0.1", port: window.__AQW__.gamePort, proxyUrl: window.__AQW__.proxyURL }
        ]
      };

      window.addEventListener("load", function () {
        const holder = document.getElementById("game-holder");
        const loader = <?php echo json_encode($gameLoaderUrl, JSON_UNESCAPED_SLASHES); ?>;
        const ruffle = window.RufflePlayer.newest();
        const player = ruffle.createPlayer();
        player.id = "AQWClient";
        player.style.width = "960px";
        player.style.height = "550px";
        holder.appendChild(player);
        player.ruffle().load({
          url: loader,
          parameters: <?php echo json_encode($loaderParameters, JSON_UNESCAPED_SLASHES); ?>,
          width: 960,
          height: 550,
          allowScriptAccess: true,
          allowNetworking: "all",
          wmode: "window",
          socketProxy: window.RufflePlayer.config.socketProxy,
          credentialAllowList: window.RufflePlayer.config.credentialAllowList,
        });
      });

      // Hidden Ruffle text input can keep focus after typing and block button clicks.
      (function patchRufflePointer() {
        function patch(el) {
          if (!el?.shadowRoot || el.shadowRoot.querySelector("#aqw-pointer-fix")) {
            return;
          }
          const style = document.createElement("style");
          style.id = "aqw-pointer-fix";
          style.textContent = `
            #virtual-keyboard {
              pointer-events: none !important;
              opacity: 0 !important;
              position: fixed !important;
              left: -10000px !important;
              width: 1px !important;
              height: 1px !important;
            }
            #container, #container canvas {
              display: block;
            }
          `;
          el.shadowRoot.appendChild(style);

          const vk = el.shadowRoot.querySelector("#virtual-keyboard");
          const canvas = el.shadowRoot.querySelector("canvas");
          if (!vk || !canvas) {
            return;
          }

          vk.addEventListener("blur", () => {
            canvas.focus({ preventScroll: true });
          });
        }

        const obs = new MutationObserver(() => {
          document.querySelectorAll("ruffle-player, ruffle-object").forEach(patch);
        });
        obs.observe(document.documentElement, { childList: true, subtree: true });
      })();
    </script>
    <script src="https://unpkg.com/@ruffle-rs/ruffle@0.4.0-nightly.2026.7.14"></script>
  </head>
  <body>
    <header>
      <div class="brand"><?php echo htmlspecialchars(Configuration::getPublic('Name') ?: 'Armagedom', ENT_QUOTES, 'UTF-8'); ?></div>
      <nav>
        <a href="/">Home</a>
        <a href="/play.php">Play</a>
        <a href="/Register.php">Register</a>
        <a href="/Ranking.php">Players</a>
        <a href="/GuildRanking.php">Guilds</a>
        <a href="/PvPRanking.php">Weekly PvP</a>
        <a href="/TPVPRanking.php">Total PvP</a>
        <a href="/Maps.php">Maps</a>
        <a href="/Rules.php">Rules</a>
        <a href="/Team.php">Staff</a>
        <a href="/Account/Manage.php">Account</a>
      </nav>
    </header>
    <main>
      <div id="game-holder" class="game-shell"></div>
      <p class="hint">
        Open via http://<?php echo htmlspecialchars($preferredHost, ENT_QUOTES, 'UTF-8'); ?>/play.php —
        game traffic goes through /flash-socket-proxy (Ruffle). Hard refresh if needed (Ctrl+Shift+R).
        If the console shows an older Ruffle, disable the browser Ruffle extension so this page loads nightly 2026-07-14.
        If you see a VerifyError after login, clear cache for this site and reload (a broken spider.swf may be cached).
        If Login does not click after typing, press Tab then Enter, or click the game once outside the text fields.
        If you only see <strong>Back</strong> and <strong>Contact Us</strong> with no login fields, click <strong>Back</strong> once (hard refresh after updates: Ctrl+Shift+R).
      </p>
    </main>
  </body>
</html>
