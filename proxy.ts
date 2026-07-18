import { getSessionCookie } from "better-auth/cookies";
import { type NextRequest, NextResponse } from "next/server";

export function proxy(request: NextRequest) {
  if (!getSessionCookie(request, { cookiePrefix: "armagedom" })) {
    return NextResponse.redirect(new URL("/account/login", request.url));
  }
  return NextResponse.next();
}

export const config = {
  matcher: ["/account"],
};
