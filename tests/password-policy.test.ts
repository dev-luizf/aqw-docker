import { describe, expect, it } from "vitest";

import {
  MAX_PASSWORD_LENGTH,
  MIN_PASSWORD_LENGTH,
} from "@/lib/auth/password-policy";

describe("password policy", () => {
  it("matches the bundled Flash registration client", () => {
    expect(MIN_PASSWORD_LENGTH).toBe(5);
    expect(MAX_PASSWORD_LENGTH).toBe(128);
  });
});
