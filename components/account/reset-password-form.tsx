"use client";

import { KeyRound, LoaderCircle } from "lucide-react";
import { useRouter } from "next/navigation";
import { useState } from "react";
import { toast } from "sonner";

import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { authClient } from "@/lib/auth/client";

export function ResetPasswordForm({ token }: { token?: string }) {
  const router = useRouter();
  const [pending, setPending] = useState(false);

  return (
    <form
      className="space-y-5"
      onSubmit={async (event) => {
        event.preventDefault();
        if (!token) {
          toast.error("This reset link is missing its token.");
          return;
        }
        const data = new FormData(event.currentTarget);
        const password = String(data.get("password"));
        if (password !== String(data.get("confirmPassword"))) {
          toast.error("The passwords do not match.");
          return;
        }
        setPending(true);
        const result = await authClient.resetPassword({
          token,
          newPassword: password,
        });
        setPending(false);
        if (result.error) {
          toast.error("This reset link is invalid or has expired.");
          return;
        }
        toast.success("Password updated. You can sign in now.");
        router.push("/account/login");
      }}
    >
      <div className="space-y-2">
        <Label htmlFor="password">New password</Label>
        <Input
          id="password"
          name="password"
          type="password"
          minLength={8}
          maxLength={128}
          autoComplete="new-password"
          required
        />
      </div>
      <div className="space-y-2">
        <Label htmlFor="confirmPassword">Confirm new password</Label>
        <Input
          id="confirmPassword"
          name="confirmPassword"
          type="password"
          minLength={8}
          maxLength={128}
          autoComplete="new-password"
          required
        />
      </div>
      <Button className="w-full" size="lg" disabled={pending || !token}>
        {pending ? <LoaderCircle className="animate-spin" /> : <KeyRound />}
        Reset password
      </Button>
    </form>
  );
}
