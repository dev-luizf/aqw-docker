import type { Metadata } from "next";

import { GameClient } from "@/components/game-client";
import { getSiteDescription, getSiteName } from "@/lib/site";

export const metadata: Metadata = {
  title: "Play",
  description: getSiteDescription(),
};

export const dynamic = "force-dynamic";

export default function PlayPage() {
  const siteName = getSiteName();

  return (
    <main className="play-stage">
      <GameClient
        siteName={siteName}
        loader={process.env.GAME_LOADER ?? "/gamefiles/loaders/Loader_Spider.swf"}
        publicGameIp={process.env.PUBLIC_GAME_IP ?? "127.0.0.1"}
        gamePort={Number(process.env.GAME_PORT ?? 5588)}
        socketProxyPort={
          process.env.SOCKET_PROXY_PORT
            ? Number(process.env.SOCKET_PROXY_PORT)
            : undefined
        }
        socketProxyUrl={process.env.SOCKET_PROXY_URL || undefined}
        version={process.env.GAME_CLIENT_VERSION ?? "ARM001"}
      />
    </main>
  );
}
