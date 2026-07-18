import { readdir, realpath, stat } from "node:fs/promises";
import path from "node:path";

export function isSafeAssetPath(segments: string[]) {
  return (
    segments.length > 0 &&
    segments.every(
      (segment) =>
        segment.length > 0 &&
        segment !== "." &&
        segment !== ".." &&
        !segment.includes("/") &&
        !segment.includes("\\") &&
        !segment.includes("\0"),
    )
  );
}

export function resolveRegistrationAssetPath(
  segments: string[],
  configuredPath: string,
) {
  if (
    segments.length !== 2 ||
    segments[0].toLowerCase() !== "newuser" ||
    segments[1].toLowerCase() !== "registration.swf"
  ) {
    return segments;
  }

  const configuredSegments = configuredPath
    .replace(/^\/+/, "")
    .split("/")
    .filter(Boolean);
  if (configuredSegments[0]?.toLowerCase() === "gamefiles") {
    configuredSegments.shift();
  }

  return isSafeAssetPath(configuredSegments) ? configuredSegments : null;
}

async function resolveSegments(base: string, segments: string[]) {
  let current = base;

  for (const segment of segments) {
    const entries = await readdir(/* turbopackIgnore: true */ current, {
      withFileTypes: true,
    }).catch(() => []);
    const match = entries.find(
      (entry) => entry.name.toLocaleLowerCase("en-US") === segment.toLocaleLowerCase("en-US"),
    );
    if (!match) return null;
    current = path.join(current, match.name);
  }

  return current;
}

export async function resolveGameAsset(root: string, segments: string[]) {
  if (!isSafeAssetPath(segments)) return null;

  const base = await realpath(/* turbopackIgnore: true */ root).catch(() => null);
  if (!base) return null;

  let candidate = await resolveSegments(base, segments);
  if (!candidate && segments.length === 3 && segments[0].toLowerCase() === "hair") {
    candidate = await resolveSegments(base, [segments[0], segments[1], "Default.swf"]);
  }
  if (!candidate) return null;

  const resolved = await realpath(/* turbopackIgnore: true */ candidate).catch(
    () => null,
  );
  if (
    !resolved ||
    (resolved !== base && !resolved.startsWith(`${base}${path.sep}`)) ||
    !(await stat(/* turbopackIgnore: true */ resolved).catch(() => null))?.isFile()
  ) {
    return null;
  }

  return resolved;
}
