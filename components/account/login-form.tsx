"use client";

import { LoaderCircle, LogIn } from "lucide-react";
import { useRouter } from "next/navigation";
import { useState } from "react";
import { toast } from "sonner";

import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { authClient } from "@/lib/auth/client";

export function LoginForm() {
  const router = useRouter();
  const [pending, setPending] = useState(false);

  return (
    <form
      className="space-y-5"
      onSubmit={async (event) => {
        event.preventDefault();
        setPending(true);
        const data = new FormData(event.currentTarget);
        const result = await authClient.signIn.username({
          username: String(data.get("username")),
          password: String(data.get("password")),
          rememberMe: true,
        });
        setPending(false);

        if (result.error) {
          toast.error("The username or password is incorrect.");
          return;
        }
        router.push("/account");
        router.refresh();
      }}
    >
      <div className="space-y-2">
        <Label htmlFor="username">Username</Label>
        <Input id="username" name="username" autoComplete="username" required />
      </div>
      <div className="space-y-2">
        <Label htmlFor="password">Password</Label>
        <Input
          id="password"
          name="password"
          type="password"
          autoComplete="current-password"
          required
        />
      </div>
      <Button className="w-full" size="lg" disabled={pending}>
        {pending ? <LoaderCircle className="animate-spin" /> : <LogIn />}
        Sign in
      </Button>
    </form>
  );
}
