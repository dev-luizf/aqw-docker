import { createReadStream } from "node:fs";
import { stat } from "node:fs/promises";
import path from "node:path";
import { Readable } from "node:stream";

import {
  resolveGameAsset,
  resolveRegistrationAssetPath,
} from "@/lib/game/assets";

export const dynamic = "force-dynamic";

const contentTypes: Record<string, string> = {
  ".swf": "application/vnd.adobe.flash.movie",
  ".xml": "application/xml",
  ".json": "application/json",
  ".png": "image/png",
  ".jpg": "image/jpeg",
  ".jpeg": "image/jpeg",
  ".gif": "image/gif",
  ".mp3": "audio/mpeg",
};

export async function GET(
  _request: Request,
  context: { params: Promise<{ path: string[] }> },
) {
  const requestedSegments = (await context.params).path;
  const segments = resolveRegistrationAssetPath(
    requestedSegments,
    process.env.GAME_NEW_USER ?? "newuser/AW-Registration.swf",
  );
  if (!segments) return new Response("Not Found", { status: 404 });

  const root =
    process.env.GAMEFILES_ROOT ??
    path.join(/* turbopackIgnore: true */ process.cwd(), "gamefiles");
  const asset = await resolveGameAsset(root, segments);
  if (!asset) return new Response("Not Found", { status: 404 });

  const metadata = await stat(/* turbopackIgnore: true */ asset);
  const stream = Readable.toWeb(
    createReadStream(/* turbopackIgnore: true */ asset),
  ) as ReadableStream;
  return new Response(stream, {
    headers: {
      "content-type":
        contentTypes[path.extname(asset).toLowerCase()] ?? "application/octet-stream",
      "content-length": String(metadata.size),
      "cache-control": "no-store, no-cache, must-revalidate",
      pragma: "no-cache",
    },
  });
}
