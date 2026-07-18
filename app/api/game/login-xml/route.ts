import { authenticateGameLogin } from "@/lib/game/login";

export const dynamic = "force-dynamic";

function escapeXml(value: string | number) {
  return String(value)
    .replaceAll("&", "&amp;")
    .replaceAll('"', "&quot;")
    .replaceAll("<", "&lt;")
    .replaceAll(">", "&gt;");
}

function attributes(values: Record<string, string | number>) {
  return Object.entries(values)
    .map(([key, value]) => `${key}="${escapeXml(value)}"`)
    .join(" ");
}

export async function POST(request: Request) {
  const form = new URLSearchParams(await request.text());
  const username = form.get("unm") ?? form.get("strUsername") ?? "";
  const password = form.get("pwd") ?? form.get("strPassword") ?? "";
  const login = await authenticateGameLogin(username, password);

  if (!login) {
    return new Response(
      '<login bSuccess="0" sMsg="The username and password you entered did not match. Please check the spelling and try again."/>',
      { headers: { "content-type": "text/xml; charset=utf-8", "cache-control": "no-store" } },
    );
  }

  const { servers, ...loginAttributes } = login;
  const compatibleServers =
    servers.length > 1
      ? servers
      : [
          ...servers,
          {
            sName: "Offline",
            sIP: "0.0.0.0",
            iPort: servers[0]?.iPort ?? 5588,
            iCount: 0,
            iMax: 900,
            bOnline: 0,
            iChat: 2,
            bUpg: 0,
            sLang: "xx",
          },
        ];
  const serverXml = compatibleServers
    .map((server) => `<servers ${attributes(server)} />`)
    .join("");

  return new Response(`<login ${attributes(loginAttributes)}>${serverXml}</login>`, {
    headers: {
      "content-type": "text/xml; charset=utf-8",
      "cache-control": "no-store",
    },
  });
}
