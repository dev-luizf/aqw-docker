import type { Metadata } from "next";
import { ArrowLeft, CalendarDays } from "lucide-react";
import Link from "next/link";
import { notFound } from "next/navigation";
import ReactMarkdown from "react-markdown";
import remarkGfm from "remark-gfm";

import { PageContainer } from "@/components/page-container";
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
    <main className="py-10 sm:py-12">
      <PageContainer width="lg">
        <Link
          href="/"
          className="mb-8 inline-flex items-center gap-1.5 text-sm text-muted-foreground transition hover:text-foreground"
        >
          <ArrowLeft className="size-3.5" />
          All posts
        </Link>

        <article className="surface-elevated rounded-xl px-6 py-8 sm:px-10 sm:py-10">
          <div className="mb-4 flex items-center gap-2 text-sm text-muted-foreground">
            <CalendarDays className="size-3.5" />
            <time dateTime={post.date.toISOString()}>
              {formatPostDate(post.date)}
            </time>
          </div>
          <h1 className="text-3xl font-semibold tracking-tight sm:text-4xl">
            {post.title}
          </h1>
          <p className="mt-4 text-lg leading-8 text-muted-foreground">
            {post.summary}
          </p>
          <div className="my-8 border-t border-white/[0.06]" />
          <div className="prose prose-lg max-w-none">
            <ReactMarkdown remarkPlugins={[remarkGfm]}>
              {post.content}
            </ReactMarkdown>
          </div>
        </article>
      </PageContainer>
    </main>
  );
}
