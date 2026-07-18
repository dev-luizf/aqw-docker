import { eq } from "drizzle-orm";

import { gameNetwork } from "@/lib/game/config";
import { db } from "@/lib/db";
import { servers } from "@/lib/db/schema";

export const dynamic = "force-dynamic";

export async function GET() {
  const rows = await db.select().from(servers).where(eq(servers.online, 1));
  const result = rows.map((server) => ({
    sName: server.name,
    sIP: server.ip || gameNetwork.publicIp,
    iPort: gameNetwork.port,
    iCount: Math.max(0, server.count),
    iMax: Math.max(1, server.max),
    bOnline: 1,
    iChat: server.chat,
    bUpg: server.upgrade,
    sLang: "xx",
    sMOTD: server.motd,
  }));

  return Response.json(result, {
    headers: { "cache-control": "no-store" },
  });
}
