import { ArrowRight, CalendarDays, Sparkles } from "lucide-react";
import Link from "next/link";

import { Button } from "@/components/ui/button";
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
import { formatPostDate, getAllPosts } from "@/lib/posts";

export default function HomePage() {
  const posts = getAllPosts();

  return (
    <main>
      <section className="border-b border-white/5">
        <div className="mx-auto max-w-6xl px-4 py-16 sm:px-6 sm:py-24">
          <div className="max-w-3xl">
            <div className="mb-5 flex items-center gap-2 text-sm font-medium uppercase tracking-[0.22em] text-primary">
              <Sparkles className="size-4" />
              The world is waiting
            </div>
            <h1 className="font-display text-4xl font-semibold leading-tight sm:text-6xl">
              News from Armagedom
            </h1>
            <p className="mt-6 max-w-2xl text-lg leading-8 text-muted-foreground">
              Release notes, world updates, and dispatches from the team behind{" "}
              {process.env.SITE_NAME ?? "Armagedom Worlds"}.
            </p>
            <Button size="lg" asChild className="mt-8">
              <Link href="/play">
                Play now
                <ArrowRight />
              </Link>
            </Button>
          </div>
        </div>
      </section>

      <section className="mx-auto max-w-6xl px-4 py-12 sm:px-6 sm:py-16">
        <div className="mb-8">
          <p className="text-sm font-medium uppercase tracking-[0.18em] text-primary">
            Chronicle
          </p>
          <h2 className="mt-2 font-display text-3xl font-semibold">Latest posts</h2>
        </div>

        {posts.length === 0 ? (
          <Card className="border-dashed bg-card/40">
            <CardContent className="py-12 text-center text-muted-foreground">
              No dispatches have been published yet.
            </CardContent>
          </Card>
        ) : (
          <div className="grid gap-5 md:grid-cols-2">
            {posts.map((post) => (
              <Card
                key={post.slug}
                className="fantasy-panel group flex flex-col overflow-hidden transition hover:-translate-y-0.5 hover:border-primary/40"
              >
                <CardHeader>
                  <div className="mb-3 flex items-center gap-2 text-xs uppercase tracking-wider text-muted-foreground">
                    <CalendarDays className="size-3.5" />
                    <time dateTime={post.date.toISOString()}>
                      {formatPostDate(post.date)}
                    </time>
                  </div>
                  <CardTitle className="text-2xl">{post.title}</CardTitle>
                  <CardDescription className="pt-2 text-base leading-7">
                    {post.summary}
                  </CardDescription>
                </CardHeader>
                <CardContent className="mt-auto">
                  <Button variant="link" asChild className="h-auto p-0">
                    <Link href={`/posts/${post.slug}`}>
                      Read dispatch
                      <ArrowRight className="transition group-hover:translate-x-1" />
                    </Link>
                  </Button>
                </CardContent>
              </Card>
            ))}
          </div>
        )}
      </section>
    </main>
  );
}
