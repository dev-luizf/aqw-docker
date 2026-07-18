import { describe, expect, it } from "vitest";

import { isValidUsername, normalizeUsername } from "@/lib/auth/username";

describe("usernames", () => {
  it("normalizes authentication names independently from display casing", () => {
    expect(normalizeUsername("  Doom_Knight-7 ")).toBe("doom_knight-7");
  });

  it("accepts only the game-safe immutable username alphabet", () => {
    expect(isValidUsername("Hero_7")).toBe(true);
    expect(isValidUsername("../hero")).toBe(false);
    expect(isValidUsername("ab")).toBe(false);
  });
});
