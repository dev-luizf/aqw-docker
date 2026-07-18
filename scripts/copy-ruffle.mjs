import { cpSync, mkdirSync, readdirSync } from "node:fs";
import { dirname, join } from "node:path";
import { fileURLToPath } from "node:url";

const root = join(dirname(fileURLToPath(import.meta.url)), "..");
const source = join(root, "node_modules", "@ruffle-rs", "ruffle");
const destination = join(root, "public", "ruffle");

mkdirSync(destination, { recursive: true });
for (const filename of readdirSync(source)) {
  if (/\.(?:js|wasm)$/.test(filename)) {
    cpSync(join(source, filename), join(destination, filename));
  }
}
