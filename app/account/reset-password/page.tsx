import type { Metadata } from "next";

import { ResetPasswordForm } from "@/components/account/reset-password-form";
import { PageContainer } from "@/components/page-container";
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
    <main className="flex min-h-[calc(100vh-var(--header-height))] items-center py-10">
      <PageContainer width="md">
        <Card className="surface-elevated w-full border-0">
          <CardHeader>
            <CardTitle>Choose a new password</CardTitle>
            <CardDescription>
              Resetting your password signs out all existing sessions.
            </CardDescription>
          </CardHeader>
          <CardContent>
            <ResetPasswordForm token={(await searchParams).token} />
          </CardContent>
        </Card>
      </PageContainer>
    </main>
  );
}
