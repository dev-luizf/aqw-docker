import type { Metadata } from "next";
import { ArrowLeft } from "lucide-react";
import Link from "next/link";

import { RecoverForm } from "@/components/account/recover-form";
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
    <main className="mx-auto flex min-h-[calc(100vh-4rem)] max-w-lg items-center px-4 py-12">
      <Card className="fantasy-panel w-full">
        <CardHeader>
          <CardTitle className="text-3xl">Recover account</CardTitle>
          <CardDescription>
            Recovery links are sent only to verified addresses. The link expires
            after 30 minutes.
          </CardDescription>
        </CardHeader>
        <CardContent>
          <RecoverForm />
          <Button variant="ghost" asChild className="mt-5 w-full">
            <Link href="/account/login">
              <ArrowLeft />
              Back to sign in
            </Link>
          </Button>
        </CardContent>
      </Card>
    </main>
  );
}
