import { drizzleAdapter } from "@better-auth/drizzle-adapter";
import { APIError, createAuthMiddleware } from "better-auth/api";
import { betterAuth } from "better-auth/minimal";
import { username } from "better-auth/plugins";

import { sendAuthEmail } from "@/lib/auth/email";
import {
  MAX_PASSWORD_LENGTH,
  MIN_PASSWORD_LENGTH,
} from "@/lib/auth/password-policy";
import { normalizeUsername, usernamePattern } from "@/lib/auth/username";
import { db } from "@/lib/db";
import * as schema from "@/lib/db/schema";

const baseURL =
  process.env.BETTER_AUTH_URL ?? process.env.APP_URL ?? "http://127.0.0.1:8081";
const configuredSecret = process.env.BETTER_AUTH_SECRET;

if (process.env.NODE_ENV === "production" && !configuredSecret) {
  throw new Error("BETTER_AUTH_SECRET is required in production.");
}

export const internalAuthKey =
  configuredSecret ?? "development-only-secret-change-before-production";

export const auth = betterAuth({
  appName: process.env.SITE_NAME ?? "Armagedom Worlds",
  baseURL,
  secret: internalAuthKey,
  database: drizzleAdapter(db, {
    provider: "mysql",
    schema,
    transaction: true,
  }),
  databaseHooks: {
    user: {
      update: {
        before: async (data) => {
          const immutableIdentity = { ...data };
          delete immutableIdentity.username;
          delete immutableIdentity.displayUsername;
          return { data: immutableIdentity };
        },
      },
    },
  },
  hooks: {
    before: createAuthMiddleware(async (context) => {
      const protectedCredentialPaths = [
        "/change-email",
        "/request-password-reset",
      ];
      if (
        protectedCredentialPaths.includes(context.path) &&
        context.headers?.get("x-armagedom-auth-internal") !==
          internalAuthKey
      ) {
        throw APIError.from("FORBIDDEN", {
          code: "PROTECTED_ACCOUNT_FLOW_REQUIRED",
          message: "Use the protected account flow.",
        });
      }
    }),
  },
  advanced: {
    database: {
      generateId: () => crypto.randomUUID(),
    },
    cookiePrefix: "armagedom",
  },
  session: {
    expiresIn: 60 * 60 * 24 * 7,
    updateAge: 60 * 60 * 24,
  },
  emailAndPassword: {
    enabled: true,
    requireEmailVerification: false,
    minPasswordLength: MIN_PASSWORD_LENGTH,
    maxPasswordLength: MAX_PASSWORD_LENGTH,
    autoSignIn: false,
    resetPasswordTokenExpiresIn: 30 * 60,
    revokeSessionsOnPasswordReset: true,
    sendResetPassword: async ({ user, token }) => {
      if (!user.emailVerified) return;
      const url = `${baseURL}/account/reset-password?token=${encodeURIComponent(token)}`;
      await sendAuthEmail({
        to: user.email,
        subject: "Reset your Armagedom password",
        text: "Use this single-use link within 30 minutes to choose a new password.",
        url,
      });
    },
  },
  emailVerification: {
    sendOnSignUp: true,
    sendOnSignIn: false,
    expiresIn: 60 * 60,
    sendVerificationEmail: async ({ user, url }) => {
      await sendAuthEmail({
        to: user.email,
        subject: "Verify your Armagedom email",
        text: "Confirm this address to enable account recovery.",
        url,
      });
    },
  },
  user: {
    changeEmail: {
      enabled: true,
      updateEmailWithoutVerification: true,
      sendChangeEmailConfirmation: async ({ user, newEmail, url }) => {
        await sendAuthEmail({
          to: user.emailVerified ? newEmail : user.email,
          subject: "Confirm your new Armagedom email",
          text: `Confirm the change to ${newEmail}.`,
          url,
        });
      },
    },
  },
  rateLimit: {
    enabled: true,
    window: 60,
    max: 100,
    customRules: {
      "/sign-in/username": { window: 60 * 15, max: 10 },
      "/request-password-reset": { window: 60 * 60, max: 5 },
      "/send-verification-email": { window: 60 * 60, max: 5 },
    },
  },
  plugins: [
    username({
      minUsernameLength: 3,
      maxUsernameLength: 32,
      usernameNormalization: normalizeUsername,
      displayUsernameNormalization: (value) => value.trim(),
      usernameValidator: (value) => usernamePattern.test(value),
      displayUsernameValidator: (value) => usernamePattern.test(value),
    }),
  ],
});
