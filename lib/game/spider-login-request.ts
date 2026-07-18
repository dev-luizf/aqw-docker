const USERNAME_FIELDS = [
  "strUsername",
  "unm",
  "nick",
  "name",
  "userName",
  "user",
] as const;

const PASSWORD_FIELDS = [
  "strPassword",
  "pwd",
  "pword",
  "password",
  "pass",
] as const;

type SpiderCredentials = {
  username: string;
  password: string;
};

function stringField(
  values: Record<string, unknown>,
  names: readonly string[],
) {
  for (const name of names) {
    const value = values[name];
    if (typeof value === "string") return value;
  }
  return "";
}

function xmlValue(raw: string, names: readonly string[]) {
  for (const name of names) {
    const match = raw.match(
      new RegExp(
        `<${name}>\\s*(?:<!\\[CDATA\\[)?([\\s\\S]*?)(?:\\]\\]>)?\\s*</${name}>`,
        "i",
      ),
    );
    if (match) return match[1];
  }
  return "";
}

function xmlCredentials(raw: string): SpiderCredentials {
  return {
    username: xmlValue(raw, ["nick", "name"]),
    password: xmlValue(raw, ["pword", "pwd"]),
  };
}

export function parseSpiderLoginRequest(
  raw: string,
  contentType = "",
): SpiderCredentials {
  const trimmed = raw.trim();

  if (contentType.includes("application/json") || trimmed.startsWith("{")) {
    try {
      const values = JSON.parse(trimmed) as Record<string, unknown>;
      return {
        username: stringField(values, USERNAME_FIELDS),
        password: stringField(values, PASSWORD_FIELDS),
      };
    } catch {
      return { username: "", password: "" };
    }
  }

  if (trimmed.startsWith("<")) return xmlCredentials(trimmed);

  const form = new URLSearchParams(raw);
  const wrappedLogin = form.get("login");
  if (wrappedLogin?.trimStart().startsWith("<")) {
    return xmlCredentials(wrappedLogin);
  }

  return {
    username:
      USERNAME_FIELDS.map((name) => form.get(name)).find(
        (value): value is string => value !== null,
      ) ?? "",
    password:
      PASSWORD_FIELDS.map((name) => form.get(name)).find(
        (value): value is string => value !== null,
      ) ?? "",
  };
}
