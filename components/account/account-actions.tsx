"use client";

import { KeyRound, LoaderCircle, LogOut, MailCheck } from "lucide-react";
import { useRouter } from "next/navigation";
import { useState } from "react";
import { toast } from "sonner";

import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { authClient } from "@/lib/auth/client";

export function VerificationActions({
  email,
  verified,
}: {
  email: string;
  verified: boolean;
}) {
  const [pending, setPending] = useState(false);
  if (verified) return null;

  return (
    <Button
      variant="outline"
      disabled={pending}
      onClick={async () => {
        setPending(true);
        const result = await authClient.sendVerificationEmail({
          email,
          callbackURL: "/account/verify-email",
        });
        setPending(false);
        if (result.error) {
          toast.error(result.error.message);
        } else {
          toast.success("Verification email sent.");
        }
      }}
    >
      {pending ? <LoaderCircle className="animate-spin" /> : <MailCheck />}
      Resend verification
    </Button>
  );
}

export function ChangePasswordForm() {
  const [pending, setPending] = useState(false);
  return (
    <form
      className="space-y-4"
      onSubmit={async (event) => {
        event.preventDefault();
        const data = new FormData(event.currentTarget);
        const newPassword = String(data.get("newPassword"));
        if (newPassword !== String(data.get("confirmPassword"))) {
          toast.error("The new passwords do not match.");
          return;
        }
        setPending(true);
        const result = await authClient.changePassword({
          currentPassword: String(data.get("currentPassword")),
          newPassword,
          revokeOtherSessions: true,
        });
        setPending(false);
        if (result.error) {
          toast.error(result.error.message);
          return;
        }
        event.currentTarget.reset();
        toast.success("Password changed.");
      }}
    >
      <div className="space-y-2">
        <Label htmlFor="currentPassword">Current password</Label>
        <Input
          id="currentPassword"
          name="currentPassword"
          type="password"
          autoComplete="current-password"
          required
        />
      </div>
      <div className="space-y-2">
        <Label htmlFor="newPassword">New password</Label>
        <Input
          id="newPassword"
          name="newPassword"
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
      <Button disabled={pending}>
        {pending ? <LoaderCircle className="animate-spin" /> : <KeyRound />}
        Change password
      </Button>
    </form>
  );
}

export function ChangeEmailForm() {
  const [pending, setPending] = useState(false);
  return (
    <form
      className="space-y-4"
      onSubmit={async (event) => {
        event.preventDefault();
        setPending(true);
        const data = new FormData(event.currentTarget);
        const response = await fetch("/api/account/change-email", {
          method: "POST",
          headers: { "content-type": "application/json" },
          body: JSON.stringify({
            newEmail: String(data.get("newEmail")),
            currentPassword: String(data.get("emailCurrentPassword")),
          }),
        });
        const result = (await response.json()) as { message?: string };
        setPending(false);
        if (!response.ok) {
          toast.error(result.message ?? "Unable to change email.");
          return;
        }
        event.currentTarget.reset();
        toast.success(result.message ?? "Check your email to confirm the change.");
      }}
    >
      <div className="space-y-2">
        <Label htmlFor="newEmail">New email</Label>
        <Input id="newEmail" name="newEmail" type="email" autoComplete="email" required />
      </div>
      <div className="space-y-2">
        <Label htmlFor="emailCurrentPassword">Current password</Label>
        <Input
          id="emailCurrentPassword"
          name="emailCurrentPassword"
          type="password"
          autoComplete="current-password"
          required
        />
      </div>
      <Button disabled={pending}>
        {pending ? <LoaderCircle className="animate-spin" /> : <MailCheck />}
        Change email
      </Button>
    </form>
  );
}

export function SignOutButton() {
  const router = useRouter();
  const [pending, setPending] = useState(false);
  return (
    <Button
      variant="outline"
      disabled={pending}
      onClick={async () => {
        setPending(true);
        await authClient.signOut();
        router.push("/account/login");
        router.refresh();
      }}
    >
      {pending ? <LoaderCircle className="animate-spin" /> : <LogOut />}
      Sign out
    </Button>
  );
}
