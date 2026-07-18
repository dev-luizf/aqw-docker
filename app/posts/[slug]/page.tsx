import type { Metadata } from "next";
import { ArrowLeft, CalendarDays } from "lucide-react";
import Link from "next/link";
import { notFound } from "next/navigation";
import ReactMarkdown from "react-markdown";
import remarkGfm from "remark-gfm";

import { Button } from "@/components/ui/button";
import { formatPostDate, getAllPosts, getPost } from "@/lib/posts";

type Props = { params: Promise<{ slug: string }> };

export function generateStaticParams() {
  return getAllPosts().map((post) => ({ slug: post.slug }));
}

export const dynamicParams = false;

export async function generateMetadata({ params }: Props): Promise<Metadata> {
  const post = getPost((await params).slug);
  return post ? { title: post.title, description: post.summary } : {};
}

export default async function PostPage({ params }: Props) {
  const post = getPost((await params).slug);
  if (!post) notFound();

  return (
    <main className="mx-auto max-w-4xl px-4 py-12 sm:px-6 sm:py-16">
      <Button variant="ghost" asChild className="-ml-3 mb-8">
        <Link href="/">
          <ArrowLeft />
          All posts
        </Link>
      </Button>
      <article className="fantasy-panel rounded-2xl border px-6 py-10 sm:px-12 sm:py-14">
        <div className="mb-5 flex items-center gap-2 text-sm text-muted-foreground">
          <CalendarDays className="size-4" />
          <time dateTime={post.date.toISOString()}>{formatPostDate(post.date)}</time>
        </div>
        <h1 className="font-display text-4xl font-semibold leading-tight sm:text-5xl">
          {post.title}
        </h1>
        <p className="mt-5 text-lg leading-8 text-muted-foreground">{post.summary}</p>
        <div className="my-10 border-t" />
        <div className="prose prose-lg max-w-none">
          <ReactMarkdown remarkPlugins={[remarkGfm]}>{post.content}</ReactMarkdown>
        </div>
      </article>
    </main>
  );
}
