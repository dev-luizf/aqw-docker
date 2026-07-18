import type { Metadata } from "next";
import { Cinzel, Geist } from "next/font/google";
import { Toaster } from "sonner";

import { SiteShell } from "@/components/site-shell";
import { getSiteDescription, getSiteName } from "@/lib/site";

import "./globals.css";

const geist = Geist({
  variable: "--font-geist-sans",
  subsets: ["latin"],
});

const cinzel = Cinzel({
  variable: "--font-cinzel",
  subsets: ["latin"],
});

const siteName = getSiteName();

export const metadata: Metadata = {
  title: {
    default: siteName,
    template: `%s · ${siteName}`,
  },
  description: getSiteDescription(),
};

export default function RootLayout({
  children,
}: Readonly<{ children: React.ReactNode }>) {
  return (
    <html lang="en" className={`${geist.variable} ${cinzel.variable}`}>
      <body className="font-sans antialiased">
        <SiteShell>{children}</SiteShell>
        <Toaster richColors position="top-right" />
      </body>
    </html>
  );
}
