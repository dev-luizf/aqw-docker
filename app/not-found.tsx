import Link from "next/link";

import { Button } from "@/components/ui/button";

export default function NotFound() {
  return (
    <main className="mx-auto flex min-h-[70vh] max-w-3xl flex-col items-center justify-center px-6 text-center">
      <p className="font-display text-sm tracking-[0.3em] text-primary">404</p>
      <h1 className="mt-4 font-display text-4xl font-semibold">Path not found</h1>
      <p className="mt-4 text-muted-foreground">
        This part of the old portal has faded into legend.
      </p>
      <Button asChild className="mt-8">
        <Link href="/">Return home</Link>
      </Button>
    </main>
  );
}
