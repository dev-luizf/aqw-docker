import { clientVariables } from "@/lib/game/config";

export const dynamic = "force-dynamic";

export function GET() {
  return Response.json(clientVariables(), {
    headers: { "cache-control": "no-store" },
  });
}
