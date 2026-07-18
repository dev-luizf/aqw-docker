"use client";

import Script from "next/script";
import { useCallback, useRef, useState } from "react";

type RufflePlayerElement = HTMLElement & {
  ruffle(): {
    load(options: Record<string, unknown>): Promise<void>;
  };
};

type RuffleSource = {
  createPlayer(): RufflePlayerElement;
};

declare global {
  interface Window {
    RufflePlayer?: {
      config?: Record<string, unknown>;
      newest(): RuffleSource;
    };
  }
}

type GameClientProps = {
  loader: string;
  publicGameIp: string;
  gamePort: number;
  socketProxyPort?: number;
  socketProxyUrl?: string;
  version: string;
};

export function GameClient({
  loader,
  publicGameIp,
  gamePort,
  socketProxyPort,
  socketProxyUrl,
  version,
}: GameClientProps) {
  const holderRef = useRef<HTMLDivElement>(null);
  const initialized = useRef(false);
  const [error, setError] = useState<string>();

  const initialize = useCallback(async () => {
    if (initialized.current || !holderRef.current || !window.RufflePlayer) return;
    initialized.current = true;

    const socketProtocol = location.protocol === "https:" ? "wss" : "ws";
    const proxyUrl =
      socketProxyUrl ||
      (socketProxyPort
        ? `${socketProtocol}://${location.hostname}:${socketProxyPort}/flash-socket-proxy`
        : `${socketProtocol}://${location.host}/flash-socket-proxy`);
    const socketProxy = [
      { host: publicGameIp, port: gamePort, proxyUrl },
      { host: "localhost", port: gamePort, proxyUrl },
      { host: "127.0.0.1", port: gamePort, proxyUrl },
    ];

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
      credentialAllowList: [location.origin],
      socketProxy,
    };

    try {
      const player = window.RufflePlayer.newest().createPlayer();
      player.id = "AQWClient";
      player.style.width = "960px";
      player.style.height = "550px";
      holderRef.current.replaceChildren(player);

      await player.ruffle().load({
        url: `${loader}?v=${encodeURIComponent(version)}`,
        parameters: {
          sLang: "en",
          base: `${location.origin}/`,
          isweb: "false",
          isWeb: "false",
          allowNetworking: "all",
        },
        width: 960,
        height: 550,
        allowScriptAccess: true,
        allowNetworking: "all",
        wmode: "window",
        socketProxy,
        credentialAllowList: [location.origin],
      });

      const patchPointer = () => {
        const root = player.shadowRoot;
        if (!root) return;
        if (!root.querySelector("#armagedom-pointer-fix")) {
          const style = document.createElement("style");
          style.id = "armagedom-pointer-fix";
          style.textContent = `
            #virtual-keyboard {
              pointer-events: none !important;
              opacity: 0 !important;
              position: fixed !important;
              left: -10000px !important;
              width: 1px !important;
              height: 1px !important;
            }
            #container, #container canvas { display: block; }
          `;
          root.appendChild(style);
        }

        const keyboard = root.querySelector<HTMLElement>("#virtual-keyboard");
        const canvas = root.querySelector<HTMLElement>("canvas");
        if (keyboard && canvas && keyboard.dataset.armagedomFocusFix !== "true") {
          keyboard.dataset.armagedomFocusFix = "true";
          keyboard.addEventListener("blur", () => {
            canvas.focus({ preventScroll: true });
          });
        }
      };
      patchPointer();
      new MutationObserver(patchPointer).observe(player.shadowRoot ?? player, {
        childList: true,
        subtree: true,
      });
    } catch (cause) {
      initialized.current = false;
      setError(cause instanceof Error ? cause.message : "The game client failed to load.");
    }
  }, [
    gamePort,
    loader,
    publicGameIp,
    socketProxyPort,
    socketProxyUrl,
    version,
  ]);

  return (
    <>
      <Script src="/ruffle/ruffle.js" strategy="afterInteractive" onLoad={initialize} />
      <div className="overflow-x-auto pb-4">
        <div
          ref={holderRef}
          className="mx-auto h-[550px] w-[960px] bg-black shadow-[0_0_45px_10px_rgb(0_0_0/75%)]"
          aria-label="Armagedom Worlds game client"
        />
      </div>
      {error ? (
        <p className="mt-4 text-center text-sm text-destructive">{error}</p>
      ) : null}
    </>
  );
}
