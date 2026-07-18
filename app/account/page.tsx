import type { Metadata } from "next";
import { eq } from "drizzle-orm";
import { headers } from "next/headers";
import { redirect } from "next/navigation";

import {
  ChangeEmailForm,
  ChangePasswordForm,
  SignOutButton,
  VerificationActions,
} from "@/components/account/account-actions";
import { PageContainer } from "@/components/page-container";
import { Badge } from "@/components/ui/badge";
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
import { auth } from "@/lib/auth/server";
import { db } from "@/lib/db";
import { characters } from "@/lib/db/schema";

export const metadata: Metadata = { title: "Account" };
export const dynamic = "force-dynamic";

function number(value: number) {
  return new Intl.NumberFormat("en").format(value);
}

export default async function AccountPage() {
  const session = await auth.api.getSession({ headers: await headers() });
  if (!session) redirect("/account/login");

  const [character] = await db
    .select()
    .from(characters)
    .where(eq(characters.authUserId, session.user.id))
    .limit(1);

  if (!character) {
    return (
      <main className="py-12">
        <PageContainer width="md">
          <Card className="surface-elevated border-0">
            <CardHeader>
              <CardTitle>No character linked</CardTitle>
              <CardDescription>
                Create a hero through the game client to finish setting up this
                account.
              </CardDescription>
            </CardHeader>
            <CardContent>
              <SignOutButton />
            </CardContent>
          </Card>
        </PageContainer>
      </main>
    );
  }

  const stats = [
    ["Level", number(character.level)],
    ["Gold", number(character.gold)],
    ["Coins", number(character.coins)],
    ["Rebirths", number(character.rebirth)],
    ["Total kills", number(character.kills)],
    ["Total deaths", number(character.deaths)],
    ["Weekly kills", number(character.killCount)],
    ["Weekly deaths", number(character.deathCount)],
    ["Bag slots", number(character.slotsBag)],
    ["Bank slots", number(character.slotsBank)],
    ["House slots", number(character.slotsHouse)],
    ["Last login", new Date(character.lastLogin).toLocaleString()],
  ];

  return (
    <main className="py-10 sm:py-12">
      <PageContainer>
        <div className="mb-8 flex flex-wrap items-start justify-between gap-4">
          <div>
            <p className="text-xs font-medium uppercase tracking-[0.18em] text-muted-foreground">
              Account
            </p>
            <h1 className="mt-1 text-3xl font-semibold tracking-tight">
              {character.name}
            </h1>
            <div className="mt-2 flex flex-wrap items-center gap-2 text-sm text-muted-foreground">
              <span>{session.user.email}</span>
              <Badge
                className={
                  session.user.emailVerified
                    ? "border-emerald-800/60 text-emerald-400"
                    : "border-amber-800/60 text-amber-400"
                }
              >
                {session.user.emailVerified ? "Verified" : "Unverified"}
              </Badge>
            </div>
          </div>
          <div className="flex gap-2">
            <VerificationActions
              email={session.user.email}
              verified={session.user.emailVerified}
            />
            <SignOutButton />
          </div>
        </div>

        <div className="grid gap-5 lg:grid-cols-[1.4fr_1fr]">
          <Card className="surface-elevated border-0">
            <CardHeader>
              <CardTitle>Character</CardTitle>
              <CardDescription>
                Progression and inventory limits from the game server.
              </CardDescription>
            </CardHeader>
            <CardContent>
              <dl className="grid gap-px overflow-hidden rounded-lg border border-white/[0.06] sm:grid-cols-2">
                {stats.map(([label, value]) => (
                  <div
                    key={label}
                    className="flex items-center justify-between gap-4 bg-background/40 px-4 py-3"
                  >
                    <dt className="text-sm text-muted-foreground">{label}</dt>
                    <dd className="text-sm font-medium tabular-nums">{value}</dd>
                  </div>
                ))}
              </dl>
            </CardContent>
          </Card>

          <div className="space-y-5">
            <Card id="email" className="surface-elevated border-0">
              <CardHeader>
                <CardTitle>Change email</CardTitle>
                <CardDescription>
                  Your current password is required. Verified accounts confirm
                  the new address before it becomes active.
                </CardDescription>
              </CardHeader>
              <CardContent>
                <ChangeEmailForm />
              </CardContent>
            </Card>
            <Card className="surface-elevated border-0">
              <CardHeader>
                <CardTitle>Change password</CardTitle>
                <CardDescription>
                  Other browser sessions will be signed out.
                </CardDescription>
              </CardHeader>
              <CardContent>
                <ChangePasswordForm />
              </CardContent>
            </Card>
          </div>
        </div>
      </PageContainer>
    </main>
  );
}
