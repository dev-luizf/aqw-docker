import travelMap from "@/lib/game/travelmap.json";

export function GET() {
  return Response.json(travelMap, {
    headers: { "cache-control": "no-store" },
  });
}
