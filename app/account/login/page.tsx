import type { Metadata } from "next";
import { headers } from "next/headers";
import Link from "next/link";
import { redirect } from "next/navigation";

import { LoginForm } from "@/components/account/login-form";
import { PageContainer } from "@/components/page-container";
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
import { auth } from "@/lib/auth/server";

export const metadata: Metadata = { title: "Sign in" };

export default async function LoginPage() {
  const session = await auth.api.getSession({ headers: await headers() });
  if (session) redirect("/account");

  return (
    <main className="flex min-h-[calc(100vh-var(--header-height))] items-center py-10">
      <PageContainer width="md">
        <Card className="surface-elevated w-full border-0">
          <CardHeader>
            <CardTitle>Sign in</CardTitle>
            <CardDescription>
              Use the same username and password as the game client.
            </CardDescription>
          </CardHeader>
          <CardContent>
            <LoginForm />
            <p className="mt-6 text-center text-sm">
              <Link
                className="text-muted-foreground transition hover:text-foreground"
                href="/account/recover"
              >
                Forgot your password?
              </Link>
            </p>
          </CardContent>
        </Card>
      </PageContainer>
    </main>
  );
}
