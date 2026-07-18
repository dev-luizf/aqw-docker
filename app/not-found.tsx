import Link from "next/link";

import { PageContainer } from "@/components/page-container";
import { Button } from "@/components/ui/button";

export default function NotFound() {
  return (
    <main className="flex min-h-[calc(100vh-var(--header-height))] items-center py-16">
      <PageContainer width="md" className="text-center">
        <p className="text-xs font-medium uppercase tracking-[0.25em] text-muted-foreground">
          404
        </p>
        <h1 className="mt-3 text-3xl font-semibold tracking-tight">
          Page not found
        </h1>
        <p className="mt-3 text-muted-foreground">
          The page you&apos;re looking for doesn&apos;t exist.
        </p>
        <Button asChild className="mt-8">
          <Link href="/">Back to news</Link>
        </Button>
      </PageContainer>
    </main>
  );
}
