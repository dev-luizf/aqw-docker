import { headers } from "next/headers";
import { NextResponse } from "next/server";
import { z } from "zod";

import { auth, internalAuthKey } from "@/lib/auth/server";

const bodySchema = z.object({
  newEmail: z.email(),
  currentPassword: z.string().min(8).max(128),
});

export async function POST(request: Request) {
  const parsed = bodySchema.safeParse(await request.json().catch(() => null));
  if (!parsed.success) {
    return NextResponse.json({ message: "Invalid email or password." }, { status: 400 });
  }

  const requestHeaders = await headers();
  const session = await auth.api.getSession({ headers: requestHeaders });
  if (!session) {
    return NextResponse.json({ message: "Authentication required." }, { status: 401 });
  }

  try {
    const internalHeaders = new Headers(requestHeaders);
    internalHeaders.set("x-armagedom-auth-internal", internalAuthKey);
    await auth.api.verifyPassword({
      headers: requestHeaders,
      body: { password: parsed.data.currentPassword },
    });
    await auth.api.changeEmail({
      headers: internalHeaders,
      body: {
        newEmail: parsed.data.newEmail,
        callbackURL: "/account/verify-email",
      },
    });
    if (!session.user.emailVerified) {
      await auth.api.sendVerificationEmail({
        headers: requestHeaders,
        body: {
          email: parsed.data.newEmail,
          callbackURL: "/account/verify-email",
        },
      });
    }
    return NextResponse.json({
      message: session.user.emailVerified
        ? "Check the new address to confirm the change."
        : "Email updated. Check it for a verification link.",
    });
  } catch {
    return NextResponse.json(
      { message: "The current password is incorrect or the email is unavailable." },
      { status: 400 },
    );
  }
}
