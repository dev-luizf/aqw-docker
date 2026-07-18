import type { Metadata } from "next";
import { MailCheck } from "lucide-react";
import Link from "next/link";

import { PageContainer } from "@/components/page-container";
import { Button } from "@/components/ui/button";
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";

export const metadata: Metadata = { title: "Email verified" };

export default function VerifyEmailPage() {
  return (
    <main className="flex min-h-[calc(100vh-var(--header-height))] items-center py-10">
      <PageContainer width="md">
        <Card className="surface-elevated w-full border-0 text-center">
          <CardHeader>
            <MailCheck className="mx-auto mb-2 size-9 text-primary" />
            <CardTitle>Email confirmed</CardTitle>
            <CardDescription>
              Your account can now use secure password recovery.
            </CardDescription>
          </CardHeader>
          <CardContent>
            <Button asChild>
              <Link href="/account">Return to account</Link>
            </Button>
          </CardContent>
        </Card>
      </PageContainer>
    </main>
  );
}
