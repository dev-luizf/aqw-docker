import type { Metadata } from "next";
import { MailCheck } from "lucide-react";
import Link from "next/link";

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
    <main className="mx-auto flex min-h-[calc(100vh-4rem)] max-w-lg items-center px-4 py-12 text-center">
      <Card className="fantasy-panel w-full">
        <CardHeader>
          <MailCheck className="mx-auto mb-3 size-10 text-primary" />
          <CardTitle className="text-3xl">Email confirmed</CardTitle>
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
    </main>
  );
}
