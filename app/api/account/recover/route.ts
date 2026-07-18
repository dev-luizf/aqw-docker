import { eq } from "drizzle-orm";
import { NextResponse } from "next/server";
import { z } from "zod";

import { auth, internalAuthKey } from "@/lib/auth/server";
import { db } from "@/lib/db";
import { user } from "@/lib/db/schema";

const bodySchema = z.object({ email: z.email() });
const neutralMessage =
  "If that verified address belongs to an account, a reset link is on its way.";

export async function POST(request: Request) {
  const parsed = bodySchema.safeParse(await request.json().catch(() => null));

  if (parsed.success) {
    const normalizedEmail = parsed.data.email.trim().toLowerCase();
    const [identity] = await db
      .select({ verified: user.emailVerified })
      .from(user)
      .where(eq(user.email, normalizedEmail))
      .limit(1);

    if (identity?.verified) {
      const internalHeaders = new Headers(request.headers);
      internalHeaders.set("x-armagedom-auth-internal", internalAuthKey);
      await auth.api
        .requestPasswordReset({
          headers: internalHeaders,
          body: {
            email: normalizedEmail,
            redirectTo: "/account/reset-password",
          },
        })
        .catch(() => undefined);
    }
  }

  return NextResponse.json(
    { message: neutralMessage },
    { headers: { "cache-control": "no-store" } },
  );
}
