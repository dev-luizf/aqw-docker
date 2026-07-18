import fs from "node:fs";
import path from "node:path";

import matter from "gray-matter";
import { z } from "zod";

const postMetadataSchema = z.object({
  title: z.string().min(1),
  date: z.coerce.date(),
  summary: z.string().min(1),
  image: z.string().min(1).optional(),
  draft: z.boolean().default(false),
});

type Post = z.infer<typeof postMetadataSchema> & {
  slug: string;
  content: string;
};

const postsDirectory = path.join(process.cwd(), "content", "posts");

function readPost(filename: string): Post {
  const slug = filename.replace(/\.md$/, "");
  if (!/^[a-z0-9]+(?:-[a-z0-9]+)*$/.test(slug)) {
    throw new Error(`Invalid post slug "${slug}"`);
  }

  const source = fs.readFileSync(path.join(postsDirectory, filename), "utf8");
  const parsed = matter(source);
  const metadata = postMetadataSchema.parse(parsed.data);

  return { ...metadata, slug, content: parsed.content };
}

export function getAllPosts(): Post[] {
  if (!fs.existsSync(postsDirectory)) return [];

  const slugs = new Set<string>();
  const posts = fs
    .readdirSync(postsDirectory)
    .filter((filename) => filename.endsWith(".md"))
    .map((filename) => {
      const post = readPost(filename);
      if (slugs.has(post.slug)) throw new Error(`Duplicate post slug "${post.slug}"`);
      slugs.add(post.slug);
      return post;
    });

  return posts
    .filter((post) => process.env.NODE_ENV !== "production" || !post.draft)
    .sort((a, b) => b.date.getTime() - a.date.getTime());
}

export function getPost(slug: string): Post | undefined {
  return getAllPosts().find((post) => post.slug === slug);
}

export function formatPostDate(date: Date): string {
  return new Intl.DateTimeFormat("en", {
    year: "numeric",
    month: "long",
    day: "numeric",
    timeZone: "UTC",
  }).format(date);
}
