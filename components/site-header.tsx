import { Shield, Swords } from "lucide-react";
import Link from "next/link";

import { Button } from "@/components/ui/button";

export function SiteHeader() {
  return (
    <header className="sticky top-0 z-50 border-b border-white/10 bg-background/85 backdrop-blur-xl">
      <div className="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 sm:px-6">
        <Link href="/" className="group flex items-center gap-3">
          <span className="grid size-9 place-items-center rounded-lg border border-primary/30 bg-primary/10 text-primary transition group-hover:bg-primary/20">
            <Swords className="size-5" />
          </span>
          <span className="font-display text-lg font-semibold tracking-wide">
            {process.env.SITE_NAME ?? "Armagedom Worlds"}
          </span>
        </Link>
        <nav className="flex items-center gap-1" aria-label="Primary navigation">
          <Button variant="ghost" asChild>
            <Link href="/">News</Link>
          </Button>
          <Button variant="ghost" asChild>
            <Link href="/play">Play</Link>
          </Button>
          <Button variant="outline" asChild>
            <Link href="/account">
              <Shield className="size-4" />
              <span className="hidden sm:inline">Account</span>
            </Link>
          </Button>
        </nav>
      </div>
    </header>
  );
}
