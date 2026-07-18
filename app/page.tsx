import { ArrowRight, CalendarDays } from "lucide-react";
import Link from "next/link";

import { HomeHero } from "@/components/home-hero";
import { PageContainer } from "@/components/page-container";
import { formatPostDate, getAllPosts } from "@/lib/posts";

export default function HomePage() {
  const posts = getAllPosts();

  return (
    <main className="pb-16">
      <HomeHero />

      <PageContainer id="news" className="scroll-mt-[var(--header-height)] py-10 sm:py-12">
        <div className="mb-8">
          <h2 className="text-2xl font-semibold tracking-tight sm:text-3xl">
            Latest news
          </h2>
          <p className="mt-2 text-sm text-muted-foreground">
            Patches, releases, and announcements.
          </p>
        </div>

        {posts.length === 0 ? (
          <div className="surface rounded-xl px-6 py-14 text-center text-muted-foreground">
            No posts published yet.
          </div>
        ) : (
          <ul className="divide-y divide-white/[0.06] rounded-xl border border-white/[0.06]">
            {posts.map((post) => (
              <li key={post.slug}>
                <Link
                  href={`/posts/${post.slug}`}
                  className="group flex flex-col gap-3 px-5 py-5 transition hover:bg-white/[0.02] sm:flex-row sm:items-start sm:justify-between sm:gap-8 sm:px-6"
                >
                  <div className="min-w-0 flex-1">
                    <div className="mb-2 flex items-center gap-2 text-xs text-muted-foreground">
                      <CalendarDays className="size-3.5" />
                      <time dateTime={post.date.toISOString()}>
                        {formatPostDate(post.date)}
                      </time>
                    </div>
                    <h3 className="text-lg font-semibold leading-snug group-hover:text-primary">
                      {post.title}
                    </h3>
                    <p className="mt-1.5 line-clamp-2 text-sm leading-6 text-muted-foreground">
                      {post.summary}
                    </p>
                  </div>
                  <span className="inline-flex shrink-0 items-center gap-1 text-sm font-medium text-primary opacity-0 transition group-hover:opacity-100 sm:mt-6">
                    Read
                    <ArrowRight className="size-3.5" />
                  </span>
                </Link>
              </li>
            ))}
          </ul>
        )}
      </PageContainer>
    </main>
  );
}
