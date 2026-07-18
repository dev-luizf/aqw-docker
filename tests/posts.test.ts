import { describe, expect, it } from "vitest";

import { formatPostDate, getAllPosts } from "@/lib/posts";

describe("repository posts", () => {
  it("loads valid, uniquely named posts newest first", () => {
    const posts = getAllPosts();
    expect(new Set(posts.map((post) => post.slug)).size).toBe(posts.length);
    expect(posts.every((post) => post.title && post.summary)).toBe(true);
    expect(posts.map((post) => post.date.getTime())).toEqual(
      posts.map((post) => post.date.getTime()).sort((a, b) => b - a),
    );
  });

  it("formats dates in UTC", () => {
    expect(formatPostDate(new Date("2026-07-18T23:00:00-03:00"))).toBe(
      "July 19, 2026",
    );
  });
});
