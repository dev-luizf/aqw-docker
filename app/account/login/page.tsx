import type { Metadata } from "next";
import { headers } from "next/headers";
import Link from "next/link";
import { redirect } from "next/navigation";

import { LoginForm } from "@/components/account/login-form";
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
    <main className="mx-auto flex min-h-[calc(100vh-4rem)] max-w-lg items-center px-4 py-12">
      <Card className="fantasy-panel w-full">
        <CardHeader>
          <CardTitle className="text-3xl">Manage account</CardTitle>
          <CardDescription>
            Sign in with the same username and password used by the game client.
          </CardDescription>
        </CardHeader>
        <CardContent>
          <LoginForm />
          <div className="mt-6 text-center text-sm">
            <Link className="text-primary hover:underline" href="/account/recover">
              Forgot your password?
            </Link>
          </div>
        </CardContent>
      </Card>
    </main>
  );
}
