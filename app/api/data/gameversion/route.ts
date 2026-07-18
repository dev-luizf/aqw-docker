import { gameVersion } from "@/lib/game/config";

export const dynamic = "force-dynamic";

export function GET() {
  return Response.json(gameVersion(), {
    headers: { "cache-control": "no-store" },
  });
}
