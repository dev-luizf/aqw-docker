import type { Metadata } from "next";

import { GameClient } from "@/components/game-client";

export const metadata: Metadata = {
  title: "Play",
  description: "Launch the Armagedom Worlds game client in your browser.",
};

export default function PlayPage() {
  return (
    <main className="play-background min-h-[calc(100vh-4rem)] px-4 py-10">
      <div className="mx-auto max-w-[1100px]">
        <div className="mb-6 text-center">
          <p className="text-sm font-medium uppercase tracking-[0.24em] text-primary">
            Enter the world
          </p>
          <h1 className="mt-2 font-display text-3xl font-semibold">Play Armagedom</h1>
        </div>
        <GameClient
          loader={process.env.GAME_LOADER ?? "/gamefiles/loaders/Loader_Spider.swf"}
          publicGameIp={process.env.PUBLIC_GAME_IP ?? "127.0.0.1"}
          gamePort={Number(process.env.GAME_PORT ?? 5588)}
          version={process.env.GAME_CLIENT_VERSION ?? "ARM001"}
        />
        <p className="mx-auto mt-2 max-w-3xl text-center text-xs leading-5 text-white/55">
          The client runs through Ruffle. If an older browser extension replaces
          the bundled player, disable it for this site and refresh.
        </p>
      </div>
    </main>
  );
}
