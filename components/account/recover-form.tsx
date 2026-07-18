"use client";

import { LoaderCircle, Mail } from "lucide-react";
import { useState } from "react";
import { toast } from "sonner";

import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
export function RecoverForm() {
  const [pending, setPending] = useState(false);

  return (
    <form
      className="space-y-5"
      onSubmit={async (event) => {
        event.preventDefault();
        setPending(true);
        const data = new FormData(event.currentTarget);
        await fetch("/api/account/recover", {
          method: "POST",
          headers: { "content-type": "application/json" },
          body: JSON.stringify({ email: String(data.get("email")) }),
        });
        setPending(false);
        toast.success(
          "If that verified address belongs to an account, a reset link is on its way.",
        );
        event.currentTarget.reset();
      }}
    >
      <div className="space-y-2">
        <Label htmlFor="email">Verified email address</Label>
        <Input id="email" name="email" type="email" autoComplete="email" required />
      </div>
      <Button className="w-full" size="lg" disabled={pending}>
        {pending ? <LoaderCircle className="animate-spin" /> : <Mail />}
        Send reset link
      </Button>
    </form>
  );
}
