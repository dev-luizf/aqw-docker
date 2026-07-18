import { createHash, randomBytes } from "node:crypto";

import { verifyPassword } from "better-auth/crypto";
import { and, eq } from "drizzle-orm";

import { db } from "@/lib/db";
import {
  account,
  characters,
  gameLoginTickets,
  user,
} from "@/lib/db/schema";
import { normalizeUsername } from "@/lib/auth/username";

export async function verifyGameCredentials(username: string, password: string) {
  const normalized = normalizeUsername(username);
  const [result] = await db
    .select({
      authUser: user,
      passwordHash: account.password,
      character: characters,
    })
    .from(user)
    .innerJoin(
      account,
      and(eq(account.userId, user.id), eq(account.providerId, "credential")),
    )
    .innerJoin(characters, eq(characters.authUserId, user.id))
    .where(eq(user.username, normalized))
    .limit(1);

  if (!result?.passwordHash) return undefined;
  const valid = await verifyPassword({
    hash: result.passwordHash,
    password,
  });
  return valid ? result : undefined;
}

export async function createGameTicket(characterId: number) {
  const ticket = randomBytes(32).toString("base64url");
  const tokenHash = hashGameTicket(ticket);
  const now = new Date();
  const expiresAt = new Date(now.getTime() + 60_000);

  await db.transaction(async (tx) => {
    await tx
      .delete(gameLoginTickets)
      .where(eq(gameLoginTickets.characterId, characterId));
    await tx.insert(gameLoginTickets).values({
      tokenHash,
      characterId,
      createdAt: now,
      expiresAt,
    });
  });

  return ticket;
}

export function hashGameTicket(ticket: string) {
  return createHash("sha256").update(ticket).digest("hex");
}
