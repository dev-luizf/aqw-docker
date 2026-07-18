import type { Metadata } from "next";
import { ArrowLeft } from "lucide-react";
import Link from "next/link";

import { RecoverForm } from "@/components/account/recover-form";
import { PageContainer } from "@/components/page-container";
import { Button } from "@/components/ui/button";
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";

export const metadata: Metadata = { title: "Recover account" };

export default function RecoverPage() {
  return (
    <main className="flex min-h-[calc(100vh-var(--header-height))] items-center py-10">
      <PageContainer width="md">
        <Card className="surface-elevated w-full border-0">
          <CardHeader>
            <CardTitle>Recover account</CardTitle>
            <CardDescription>
              Recovery links are sent only to verified addresses and expire
              after 30 minutes.
            </CardDescription>
          </CardHeader>
          <CardContent>
            <RecoverForm />
            <Button variant="ghost" asChild className="mt-4 w-full">
              <Link href="/account/login">
                <ArrowLeft />
                Back to sign in
              </Link>
            </Button>
          </CardContent>
        </Card>
      </PageContainer>
    </main>
  );
}
