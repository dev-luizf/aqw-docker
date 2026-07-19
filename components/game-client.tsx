"use client";

import Script from "next/script";
import { useEffect, useRef, useState } from "react";

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
  siteName: string;
  loader: string;
  publicGameIp: string;
  gamePort: number;
  socketProxyPort?: number;
  socketProxyUrl?: string;
  version: string;
};

export function GameClient({
  siteName,
  loader,
  publicGameIp,
  gamePort,
  socketProxyPort,
  socketProxyUrl,
  version,
}: GameClientProps) {
  const holderRef = useRef<HTMLDivElement>(null);
  // Already true after client navigations when ruffle.js is still in the document.
  const [scriptReady, setScriptReady] = useState(
    () => typeof window !== "undefined" && Boolean(window.RufflePlayer),
  );
  const [error, setError] = useState<string>();

  useEffect(() => {
    if (!scriptReady || !holderRef.current || !window.RufflePlayer) return;

    const holder = holderRef.current;
    let cancelled = false;
    let observer: MutationObserver | undefined;

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
      ...window.RufflePlayer.config,
      autoplay: "on",
      unmuteOverlay: "hidden",
      splashScreen: false,
      allowScriptAccess: true,
      logLevel: "warn",
      polyfills: false,
      wmode: "window",
      letterbox: "on",
      scale: "showAll",
      quality: "medium",
      forceScale: false,
      allowFullscreen: true,
      backgroundExecutionMode: "mainThread",
      socketProxy,
    };

    const player = window.RufflePlayer.newest().createPlayer();
    player.id = "AQWClient";
    player.style.width = "100%";
    player.style.height = "100%";
    holder.replaceChildren(player);

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

    void (async () => {
      try {
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
          allowFullscreen: true,
          quality: "medium",
          wmode: "window",
          socketProxy,
        });

        if (cancelled) return;

        patchPointer();
        observer = new MutationObserver(patchPointer);
        observer.observe(player.shadowRoot ?? player, {
          childList: true,
          subtree: true,
        });
      } catch (cause) {
        if (cancelled) return;
        setError(cause instanceof Error ? cause.message : "The game client failed to load.");
      }
    })();

    return () => {
      cancelled = true;
      observer?.disconnect();
      player.remove();
      holder.replaceChildren();
    };
  }, [
    gamePort,
    loader,
    publicGameIp,
    scriptReady,
    socketProxyPort,
    socketProxyUrl,
    version,
  ]);

  return (
    <>
      <Script
        src="/ruffle/ruffle.js"
        strategy="afterInteractive"
        onReady={() => setScriptReady(true)}
      />
      <div
        ref={holderRef}
        className="game-client-frame"
        aria-label={`${siteName} game client`}
      />
      {error ? (
        <p className="mt-4 text-center text-sm text-destructive">{error}</p>
      ) : null}
    </>
  );
}
