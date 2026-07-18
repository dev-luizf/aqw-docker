import { defineConfig } from "drizzle-kit";

export default defineConfig({
  dialect: "mysql",
  schema: "./lib/db/schema/index.ts",
  out: "./lib/db/migrations",
  tablesFilter: [
    "user",
    "account",
    "session",
    "verification",
    "users",
    "users_items",
    "game_login_tickets",
    "servers",
    "settings_login",
  ],
  dbCredentials: {
    url: process.env.DATABASE_URL ?? "mysql://aqw:aqw@127.0.0.1:3306/mextv3",
  },
  strict: true,
  verbose: true,
});
