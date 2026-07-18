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
      <main className="mx-auto max-w-3xl px-4 py-16">
        <Card className="fantasy-panel">
          <CardHeader>
            <CardTitle>No character linked</CardTitle>
            <CardDescription>
              Create a hero through the game client to finish setting up this account.
            </CardDescription>
          </CardHeader>
          <CardContent>
            <SignOutButton />
          </CardContent>
        </Card>
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
    <main className="mx-auto max-w-6xl px-4 py-12 sm:px-6">
      <div className="mb-8 flex flex-wrap items-start justify-between gap-4">
        <div>
          <p className="text-sm uppercase tracking-[0.18em] text-primary">Character</p>
          <h1 className="mt-2 font-display text-4xl font-semibold">{character.name}</h1>
          <div className="mt-3 flex flex-wrap items-center gap-3 text-sm text-muted-foreground">
            <span>{session.user.email}</span>
            <Badge
              className={
                session.user.emailVerified
                  ? "border-emerald-700/50 bg-emerald-950/50 text-emerald-300"
                  : "border-amber-700/50 bg-amber-950/50 text-amber-300"
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

      <div className="grid gap-6 lg:grid-cols-[1.35fr_1fr]">
        <Card className="fantasy-panel">
          <CardHeader>
            <CardTitle>Character overview</CardTitle>
            <CardDescription>
              Safe account and progression information from the game server.
            </CardDescription>
          </CardHeader>
          <CardContent className="grid gap-px overflow-hidden rounded-lg border bg-border sm:grid-cols-2">
            {stats.map(([label, value]) => (
              <div key={label} className="flex justify-between gap-4 bg-card/95 p-4">
                <span className="text-sm text-muted-foreground">{label}</span>
                <span className="text-sm font-semibold">{value}</span>
              </div>
            ))}
          </CardContent>
        </Card>

        <div className="space-y-6">
          <Card id="email" className="fantasy-panel">
            <CardHeader>
              <CardTitle>Change email</CardTitle>
              <CardDescription>
                Your current password is required. Verified accounts confirm the
                new address before it becomes active.
              </CardDescription>
            </CardHeader>
            <CardContent>
              <ChangeEmailForm />
            </CardContent>
          </Card>
          <Card className="fantasy-panel">
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
    </main>
  );
}
