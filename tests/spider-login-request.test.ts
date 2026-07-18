import { describe, expect, it } from "vitest";

import { parseSpiderLoginRequest } from "@/lib/game/spider-login-request";

describe("Spider login request parsing", () => {
  it("parses the legacy URL-encoded XML wrapper", () => {
    const body = new URLSearchParams({
      login:
        "<login z='Armagedom'><nick><![CDATA[Hero]]></nick><pword><![CDATA[secret&word]]></pword></login>",
    }).toString();

    expect(
      parseSpiderLoginRequest(body, "application/x-www-form-urlencoded"),
    ).toEqual({
      username: "Hero",
      password: "secret&word",
    });
  });

  it("parses raw Spider XML", () => {
    expect(
      parseSpiderLoginRequest(
        "<login><nick>Hero</nick><pword>secret</pword></login>",
      ),
    ).toEqual({
      username: "Hero",
      password: "secret",
    });
  });

  it("supports JSON and legacy form field aliases", () => {
    expect(
      parseSpiderLoginRequest(
        JSON.stringify({ userName: "Hero", strPassword: "secret" }),
        "application/json",
      ),
    ).toEqual({
      username: "Hero",
      password: "secret",
    });

    expect(parseSpiderLoginRequest("unm=Hero&pwd=secret")).toEqual({
      username: "Hero",
      password: "secret",
    });
  });

  it("fails closed for malformed JSON", () => {
    expect(parseSpiderLoginRequest("{", "application/json")).toEqual({
      username: "",
      password: "",
    });
  });
});
