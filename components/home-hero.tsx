import Image from "next/image";
import Link from "next/link";

import { PageContainer } from "@/components/page-container";
import { getSiteDescription, getSiteName, getHeroImageUrl } from "@/lib/site";

const HERO_IMAGE = getHeroImageUrl();

export function HomeHero() {
  const siteName = getSiteName();
  const description = getSiteDescription();

  return (
    <section className="home-hero relative overflow-hidden border-b border-white/[0.06]">
      <Image
        src={HERO_IMAGE}
        alt=""
        fill
        priority
        className="object-cover object-center"
        sizes="100vw"
      />
      <div className="home-hero-overlay absolute inset-0" aria-hidden="true" />

      <PageContainer className="relative flex min-h-[min(70vh,40rem)] flex-col justify-end pb-10 pt-20 sm:min-h-[min(75vh,44rem)] sm:pb-14 sm:pt-24">
        <p className="text-xs font-medium uppercase tracking-[0.22em] text-primary">
          Adventure awaits
        </p>
        <h1 className="mt-3 max-w-3xl font-display text-4xl font-semibold leading-[1.1] tracking-tight sm:text-5xl lg:text-6xl">
          {siteName}
        </h1>
        <p className="mt-4 max-w-xl text-base leading-7 text-white/75 sm:text-lg">
          {description}
        </p>
        <div className="mt-7 flex flex-wrap items-center gap-5">
          <Link
            href="/play"
            className="text-sm font-medium text-primary underline-offset-4 transition hover:text-primary/80 hover:underline"
          >
            Enter the world
          </Link>
          <span className="hidden h-4 w-px bg-white/20 sm:block" aria-hidden="true" />
          <Link
            href="#news"
            className="text-sm text-white/70 transition hover:text-white"
          >
            Read the latest news
          </Link>
        </div>
      </PageContainer>
    </section>
  );
}
