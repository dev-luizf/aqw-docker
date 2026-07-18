import { authenticateGameLogin } from "@/lib/game/login";
import { parseSpiderLoginRequest } from "@/lib/game/spider-login-request";

export const dynamic = "force-dynamic";

async function credentials(request: Request) {
  const raw = await request.text();
  const contentType = request.headers.get("content-type") ?? "";
  return parseSpiderLoginRequest(raw, contentType);
}

export function GET() {
  return new Response("hi", {
    headers: { "content-type": "text/plain; charset=utf-8" },
  });
}

export async function POST(request: Request) {
  const parsed = await credentials(request);
  const url = new URL(request.url);
  const username =
    parsed.username ||
    url.searchParams.get("nick") ||
    url.searchParams.get("strUsername") ||
    "";
  const password =
    parsed.password ||
    url.searchParams.get("pword") ||
    url.searchParams.get("strPassword") ||
    "";
  if (!username && !password) {
    return Response.json(
      { bSuccess: "0" },
      { headers: { "cache-control": "no-store" } },
    );
  }

  const login = await authenticateGameLogin(username, password);
  if (!login) {
    return Response.json(
      {
        bSuccess: "0",
        sMsg:
          "The username and password you entered did not match. Please check the spelling and try again.",
      },
      { headers: { "cache-control": "no-store" } },
    );
  }

  return Response.json(
    login,
    { headers: { "cache-control": "no-store" } },
  );
}
