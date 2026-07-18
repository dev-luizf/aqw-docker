import { mkdir, mkdtemp, rm, writeFile } from "node:fs/promises";
import { tmpdir } from "node:os";
import path from "node:path";

import { describe, expect, it } from "vitest";

import {
  isSafeAssetPath,
  resolveGameAsset,
  resolveRegistrationAssetPath,
} from "@/lib/game/assets";

describe("game asset resolution", () => {
  it("rejects traversal and separator smuggling", () => {
    expect(isSafeAssetPath(["maps", "..", "secret"])).toBe(false);
    expect(isSafeAssetPath(["maps\\secret"])).toBe(false);
    expect(isSafeAssetPath(["maps/secret"])).toBe(false);
  });

  it("resolves path segments without case sensitivity", async () => {
    const root = await mkdtemp(path.join(tmpdir(), "armagedom-assets-"));

    try {
      await mkdir(path.join(root, "Maps", "Greenguard"), { recursive: true });
      const expected = path.join(root, "Maps", "Greenguard", "AWWest.swf");
      await writeFile(expected, "test");
      expect(
        await resolveGameAsset(root, ["maps", "greenguard", "awwest.swf"]),
      ).toBe(expected);
    } finally {
      await rm(root, { recursive: true, force: true });
    }
  });

  it("maps the registration alias to the configured game asset", () => {
    expect(
      resolveRegistrationAssetPath(
        ["newuser", "registration.swf"],
        "newuser/AW-Registration.swf",
      ),
    ).toEqual(["newuser", "AW-Registration.swf"]);
  });

  it("rejects an unsafe registration asset setting", () => {
    expect(
      resolveRegistrationAssetPath(
        ["newuser", "registration.swf"],
        "../private.swf",
      ),
    ).toBeNull();
  });
});
