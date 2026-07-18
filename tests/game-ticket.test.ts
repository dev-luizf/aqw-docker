import { createHash } from "node:crypto";

import { describe, expect, it } from "vitest";

import { hashGameTicket } from "@/lib/game/auth";

describe("game tickets", () => {
  it("stores a SHA-256 digest rather than the reusable raw ticket", () => {
    const ticket = "one-time-secret";
    expect(hashGameTicket(ticket)).toBe(
      createHash("sha256").update(ticket).digest("hex"),
    );
    expect(hashGameTicket(ticket)).not.toContain(ticket);
  });
});
