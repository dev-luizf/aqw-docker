import type { Metadata } from "next";

import { ResetPasswordForm } from "@/components/account/reset-password-form";
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";

export const metadata: Metadata = { title: "Reset password" };

export default async function ResetPasswordPage({
  searchParams,
}: {
  searchParams: Promise<{ token?: string }>;
}) {
  return (
    <main className="mx-auto flex min-h-[calc(100vh-4rem)] max-w-lg items-center px-4 py-12">
      <Card className="fantasy-panel w-full">
        <CardHeader>
          <CardTitle className="text-3xl">Choose a new password</CardTitle>
          <CardDescription>
            Resetting your password signs out all existing sessions.
          </CardDescription>
        </CardHeader>
        <CardContent>
          <ResetPasswordForm token={(await searchParams).token} />
        </CardContent>
      </Card>
    </main>
  );
}
