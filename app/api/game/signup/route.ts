import type { ResultSetHeader } from "mysql2";
import { verifyPassword } from "better-auth/crypto";
import { and, eq, sql } from "drizzle-orm";
import { z } from "zod";

import { auth } from "@/lib/auth/server";
import {
  MAX_PASSWORD_LENGTH,
  MIN_PASSWORD_LENGTH,
} from "@/lib/auth/password-policy";
import { normalizeUsername } from "@/lib/auth/username";
import { db } from "@/lib/db";
import { account, characterItems, characters, user } from "@/lib/db/schema";

export const dynamic = "force-dynamic";

const signupSchema = z.object({
  username: z.string().trim().min(3).max(32).regex(/^[a-zA-Z0-9_-]+$/),
  password: z.string().min(MIN_PASSWORD_LENGTH).max(MAX_PASSWORD_LENGTH),
  email: z.email(),
  age: z.coerce.number().int().min(13).max(99),
  gender: z.enum(["M", "F"]),
  hairId: z.coerce.number().int().positive().default(1),
  classId: z.coerce.number().int().min(2).max(5).default(2),
  colorHair: z.coerce.number().int().nonnegative().default(0),
  colorSkin: z.coerce.number().int().nonnegative().default(0),
  colorEye: z.coerce.number().int().nonnegative().default(0),
});

function response(status: string, reason?: string) {
  const data = new URLSearchParams({ status });
  if (reason) data.set("strReason", reason);
  return new Response(data.toString(), {
    headers: {
      "content-type": "application/x-www-form-urlencoded; charset=utf-8",
      "cache-control": "no-store",
    },
  });
}

function color(value: number) {
  return value.toString(16).padStart(6, "0").slice(-6).toUpperCase();
}

async function body(request: Request) {
  const form = new URLSearchParams(await request.text());
  return signupSchema.safeParse({
    username: form.get("strUsername"),
    password: form.get("strPassword"),
    email: form.get("strEmail"),
    age: form.get("intAge"),
    gender: form.get("strGender")?.toUpperCase(),
    hairId: form.get("HairID"),
    classId: form.get("ClassID"),
    colorHair: form.get("intColorHair"),
    colorSkin: form.get("intColorSkin"),
    colorEye: form.get("intColorEye"),
  });
}

const starterItems: Record<number, Array<[number, number, number, number]>> = {
  2: [
    [2, 1957, 1, 1],
    [994, 1957, 1, 1],
    [996, 1957, 0, 1],
    [997, 1957, 1, 1],
    [998, 1957, 1, 1],
    [971, 0, 0, 3],
    [972, 0, 0, 3],
    [973, 0, 0, 3],
    [974, 0, 0, 3],
  ],
  3: [[3, 1957, 1, 1]],
  4: [[2008451, 1957, 1, 1]],
  5: [[975, 1957, 1, 1]],
};

export async function POST(request: Request) {
  const parsed = await body(request);
  if (!parsed.success) {
    return response("Error", "Please check the registration fields and try again.");
  }

  const data = parsed.data;
  const normalizedUsername = normalizeUsername(data.username);
  let authUserId: string | undefined;
  let createdIdentity = false;

  const [existing] = await db
    .select({
      id: user.id,
      email: user.email,
      passwordHash: account.password,
      characterId: characters.id,
    })
    .from(user)
    .leftJoin(
      account,
      and(eq(account.userId, user.id), eq(account.providerId, "credential")),
    )
    .leftJoin(characters, eq(characters.authUserId, user.id))
    .where(eq(user.username, normalizedUsername))
    .limit(1);

  if (existing) {
    const valid =
      existing.email.toLowerCase() === data.email.toLowerCase() &&
      existing.passwordHash &&
      (await verifyPassword({ hash: existing.passwordHash, password: data.password }));
    if (!valid) return response("Taken", "The username is already in use.");
    if (existing.characterId) return response("Success");
    authUserId = existing.id;
  } else {
    try {
      const created = await auth.api.signUpEmail({
        headers: request.headers,
        body: {
          name: data.username,
          email: data.email,
          password: data.password,
          username: normalizedUsername,
          displayUsername: data.username,
        },
      });
      authUserId = created.user.id;
      createdIdentity = true;
    } catch {
      return response(
        "Error",
        "The username or email is unavailable, or verification mail could not be sent.",
      );
    }
  }

  try {
    await db.transaction(async (tx) => {
      const hairRows = (await tx.execute(
        sql`SELECT id FROM hairs WHERE id = ${data.hairId} AND Gender = ${data.gender} LIMIT 1`,
      )) as unknown as [Array<{ id: number }>, unknown];
      let hairId = hairRows[0][0]?.id;
      if (!hairId) {
        const fallbackRows = (await tx.execute(
          sql`SELECT id FROM hairs WHERE Gender = ${data.gender} ORDER BY id ASC LIMIT 1`,
        )) as unknown as [Array<{ id: number }>, unknown];
        hairId = fallbackRows[0][0]?.id ?? (data.gender === "F" ? 5 : 4);
      }

      const now = new Date();
      const result = await tx.execute(
        sql`INSERT INTO users (
          AuthUserID, Name, HairID, Access, ActivationFlag, PermamuteFlag,
          Country, Age, Gender, Email, Level, Gold, Coins, TCoins, Exp,
          ColorHair, ColorSkin, ColorEye, ColorBase, ColorTrim, ColorAccessory,
          SlotsBag, SlotsBank, SlotsHouse, DateCreated, LastLogin,
          CpBoostExpire, RepBoostExpire, GoldBoostExpire, ExpBoostExpire,
          UpgradeExpire, UpgradeDays, Upgraded, Achievement, AchievementID,
          Settings, DailyQuests0, DailyQuests1, DailyQuests2, MonthlyQuests0,
          LastArea, CurrentServer, HouseInfo, KillCount, DeathCount, Address,
          Rebirth, webLogin, Brinde, Staff, YouTuber, PvPRank, PRank, Score
        ) VALUES (
          ${authUserId}, ${data.username}, ${hairId}, 1, 0, 0,
          'xx', ${data.age}, ${data.gender}, ${data.email}, 1, 10000, 1000, 0, 0,
          ${color(data.colorHair)}, ${color(data.colorSkin)}, ${color(data.colorEye)},
          '000000', '000000', '000000', 40, 0, 20, ${now}, ${now},
          '2000-01-01 00:00:00', '2000-01-01 00:00:00',
          '2000-01-01 00:00:00', '2000-01-01 00:00:00',
          '2000-01-01 00:00:00', 0, 0, 0, '', 0, 0, 0, 0, 0,
          'faroff-1|Enter|Spawn', 'Offline', '', 0, 0, '0.0.0.0',
          0, 0, 0, 0, 0, 0, 0, 0
        )`,
      );
      const characterId = Number((result[0] as ResultSetHeader).insertId);
      const items = [...(starterItems[data.classId] ?? starterItems[2]), [995, 1957, 1, 1] as const];
      await tx.insert(characterItems).values(
        items.map(([itemId, enhancementId, equipped, quantity]) => ({
          characterId,
          itemId,
          enhancementId,
          equipped,
          quantity,
          bank: 0,
        })),
      );
    });
  } catch {
    if (createdIdentity && authUserId) {
      await db.delete(user).where(eq(user.id, authUserId)).catch(() => undefined);
    }
    return response("Error", "Could not create your character. Please try again.");
  }

  return response("Success");
}
