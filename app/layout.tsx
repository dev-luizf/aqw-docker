import type { Metadata } from "next";
import { Cinzel, Geist } from "next/font/google";
import { Toaster } from "sonner";

import { SiteHeader } from "@/components/site-header";

import "./globals.css";

const geist = Geist({
  variable: "--font-geist-sans",
  subsets: ["latin"],
});

const cinzel = Cinzel({
  variable: "--font-cinzel",
  subsets: ["latin"],
});

export const metadata: Metadata = {
  title: {
    default: process.env.SITE_NAME ?? "Armagedom Worlds",
    template: `%s · ${process.env.SITE_NAME ?? "Armagedom Worlds"}`,
  },
  description:
    process.env.SITE_DESCRIPTION ??
    "News, account tools, and the Armagedom Worlds game client.",
};

export default function RootLayout({
  children,
}: Readonly<{ children: React.ReactNode }>) {
  return (
    <html lang="en" className={`${geist.variable} ${cinzel.variable}`}>
      <body className="antialiased">
        <SiteHeader />
        {children}
        <Toaster richColors position="top-right" />
      </body>
    </html>
  );
}
