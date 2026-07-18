import { createReadStream } from "node:fs";
import { readdir, realpath, stat } from "node:fs/promises";
import path from "node:path";
import { Readable } from "node:stream";

export const dynamic = "force-dynamic";
export const runtime = "nodejs";

const GAMEFILES_ROOT = path.join(
  /* turbopackIgnore: true */ process.cwd(),
  "public",
  "gamefiles",
);

const contentTypes: Record<string, string> = {
  ".css": "text/css; charset=utf-8",
  ".gif": "image/gif",
  ".html": "text/html; charset=utf-8",
  ".jpeg": "image/jpeg",
  ".jpg": "image/jpeg",
  ".js": "text/javascript; charset=utf-8",
  ".json": "application/json; charset=utf-8",
  ".mp3": "audio/mpeg",
  ".png": "image/png",
  ".swf": "application/x-shockwave-flash",
  ".txt": "text/plain; charset=utf-8",
  ".xml": "application/xml; charset=utf-8",
};

type RouteContext = {
  params: Promise<{ path: string[] }>;
};

async function resolveLegacyPath(segments: string[]) {
  let current = GAMEFILES_ROOT;

  for (const segment of segments) {
    if (
      !segment ||
      segment === "." ||
      segment === ".." ||
      segment.includes("/") ||
      segment.includes("\\") ||
      segment.includes("\0")
    ) {
      return null;
    }

    const entries = await readdir(current, { withFileTypes: true });
    const match =
      entries.find((entry) => entry.name === segment) ??
      entries.find(
        (entry) => entry.name.toLocaleLowerCase("en-US") === segment.toLocaleLowerCase("en-US"),
      );

    if (!match) {
      return null;
    }

    current = path.join(/* turbopackIgnore: true */ current, match.name);
  }

  const [rootPath, filePath] = await Promise.all([
    realpath(GAMEFILES_ROOT),
    realpath(/* turbopackIgnore: true */ current),
  ]);
  if (!filePath.startsWith(`${rootPath}${path.sep}`)) {
    return null;
  }

  const fileStat = await stat(filePath);
  return fileStat.isFile() ? { filePath, fileStat } : null;
}

function parseRange(range: string | null, size: number) {
  if (!range) {
    return null;
  }

  const match = /^bytes=(\d*)-(\d*)$/.exec(range);
  if (!match || (!match[1] && !match[2])) {
    return false;
  }

  let start: number;
  let end: number;

  if (!match[1]) {
    const suffixLength = Number(match[2]);
    if (!Number.isSafeInteger(suffixLength) || suffixLength <= 0) {
      return false;
    }
    start = Math.max(size - suffixLength, 0);
    end = size - 1;
  } else {
    start = Number(match[1]);
    end = match[2] ? Number(match[2]) : size - 1;
  }

  if (
    !Number.isSafeInteger(start) ||
    !Number.isSafeInteger(end) ||
    start < 0 ||
    start >= size ||
    end < start
  ) {
    return false;
  }

  return { start, end: Math.min(end, size - 1) };
}

async function serve(request: Request, context: RouteContext, headOnly = false) {
  try {
    const { path: segments } = await context.params;
    const resolved = await resolveLegacyPath(segments);
    if (!resolved) {
      return new Response("Not Found", { status: 404 });
    }

    const { filePath, fileStat } = resolved;
    const range = parseRange(request.headers.get("range"), fileStat.size);
    if (range === false) {
      return new Response(null, {
        status: 416,
        headers: { "Content-Range": `bytes */${fileStat.size}` },
      });
    }

    const start = range?.start ?? 0;
    const end = range?.end ?? fileStat.size - 1;
    const headers = new Headers({
      "Accept-Ranges": "bytes",
      "Cache-Control": "no-store",
      "Content-Length": String(end - start + 1),
      "Content-Type":
        contentTypes[path.extname(filePath).toLocaleLowerCase("en-US")] ??
        "application/octet-stream",
      "Last-Modified": fileStat.mtime.toUTCString(),
    });

    if (range) {
      headers.set("Content-Range", `bytes ${start}-${end}/${fileStat.size}`);
    }

    if (headOnly) {
      return new Response(null, { status: range ? 206 : 200, headers });
    }

    const stream = Readable.toWeb(createReadStream(filePath, { start, end }));
    return new Response(stream as ReadableStream, {
      status: range ? 206 : 200,
      headers,
    });
  } catch (error) {
    if (
      error instanceof Error &&
      "code" in error &&
      (error.code === "ENOENT" || error.code === "ENOTDIR")
    ) {
      return new Response("Not Found", { status: 404 });
    }
    throw error;
  }
}

export function GET(request: Request, context: RouteContext) {
  return serve(request, context);
}

export function HEAD(request: Request, context: RouteContext) {
  return serve(request, context, true);
}
