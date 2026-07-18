import { Swords } from "lucide-react";
import Link from "next/link";

import { Button } from "@/components/ui/button";
import { getSiteName } from "@/lib/site";

export function SiteHeader() {
  const siteName = getSiteName();

  return (
    <header className="shrink-0 border-b border-white/[0.06] bg-background/95 backdrop-blur-md">
      <div className="mx-auto flex h-[var(--header-height)] max-w-6xl items-center justify-between px-4 sm:px-6">
        <Link href="/" className="group flex min-w-0 items-center gap-2.5">
          <span className="grid size-7 shrink-0 place-items-center rounded-md bg-primary/15 text-primary">
            <Swords className="size-3.5" />
          </span>
          <span className="truncate font-display text-sm font-semibold tracking-wide sm:text-base">
            {siteName}
          </span>
        </Link>

        <nav
          className="flex shrink-0 items-center gap-5 sm:gap-6"
          aria-label="Primary navigation"
        >
          <Link href="/" className="nav-link">
            News
          </Link>
          <Link href="/account" className="nav-link">
            Account
          </Link>
          <Button size="sm" asChild className="shadow-sm">
            <Link href="/play">Play</Link>
          </Button>
        </nav>
      </div>
    </header>
  );
}
