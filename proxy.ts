import { type NextRequest, NextResponse } from "next/server";

// Account routes enforce auth in their server components. Keeping proxy
// pass-through avoids redirect loops between cookie checks and session lookup.
export function proxy(_request: NextRequest) {
  return NextResponse.next();
}

export const config = {
  matcher: ["/account"],
};
