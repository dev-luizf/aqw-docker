import { eq } from "drizzle-orm";

import { createGameTicket, verifyGameCredentials } from "@/lib/game/auth";
import { gameNetwork } from "@/lib/game/config";
import { db } from "@/lib/db";
import { characters, servers } from "@/lib/db/schema";

export async function authenticateGameLogin(username: string, password: string) {
  const verified = await verifyGameCredentials(username, password);
  if (!verified) return null;

  const now = new Date();
  await db
    .update(characters)
    .set({ lastLogin: now, email: verified.authUser.email })
    .where(eq(characters.id, verified.character.id));
  const ticket = await createGameTicket(verified.character.id);

  const activeServers = await db.select().from(servers).where(eq(servers.online, 1));
  const serverList = activeServers.map((server) => ({
    sName: server.name,
    sIP: server.ip || gameNetwork.publicIp,
    iPort: gameNetwork.port,
    iCount: Math.max(0, server.count),
    iMax: Math.max(1, server.max),
    bOnline: 1,
    iChat: server.chat,
    bUpg: server.upgrade,
    sLang: "xx",
  }));

  const upgradeExpiry = new Date(verified.character.upgradeExpire);
  const upgradeDays = Math.ceil((upgradeExpiry.getTime() - now.getTime()) / 86_400_000);

  return {
    bSuccess: "1",
    sMsg: "",
    userid: String(verified.character.id),
    unm: verified.character.name,
    iAccess: String(verified.character.access),
    iUpg: upgradeDays >= 0 ? "1" : "0",
    iAge: String(verified.character.age),
    sToken: ticket,
    dUpgExp: upgradeExpiry.toISOString().replace(".000Z", ""),
    iUpgDays: String(upgradeDays),
    iSendEmail: verified.authUser.emailVerified ? "5" : "0",
    strEmail: verified.authUser.email,
    bCCOnly: "0",
    strCountryCode: verified.character.country,
    servers:
      serverList.length > 0
        ? serverList
        : [
            {
              sName: gameNetwork.serverName,
              sIP: gameNetwork.publicIp,
              iPort: gameNetwork.port,
              iCount: 0,
              iMax: 900,
              bOnline: 1,
              iChat: 2,
              bUpg: 0,
              sLang: "xx",
            },
          ],
  };
}
