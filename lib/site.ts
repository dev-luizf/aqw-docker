export function getSiteName() {
  return process.env.SITE_NAME ?? "Worlds";
}

export function getSiteDescription() {
  return (
    process.env.SITE_DESCRIPTION ??
    `News, account tools, and the ${getSiteName()} game client.`
  );
}

export function getHeroImageUrl() {
  return (
    process.env.SITE_HERO_IMAGE ??
    "https://images.unsplash.com/photo-1760262176353-b04199ea732c?auto=format&fit=crop&w=1920&q=80"
  );
}
