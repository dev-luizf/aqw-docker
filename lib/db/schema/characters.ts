import {
  datetime,
  index,
  int,
  mysqlTable,
  uniqueIndex,
  varchar,
} from "drizzle-orm/mysql-core";

import { user } from "./auth";

export const characters = mysqlTable(
  "users",
  {
    id: int("id", { unsigned: true }).autoincrement().primaryKey(),
    authUserId: varchar("AuthUserID", { length: 36 })
      .notNull()
      .references(() => user.id, { onDelete: "cascade" }),
    name: varchar("Name", { length: 32 }).notNull(),
    access: int("Access", { unsigned: true }).notNull().default(1),
    activationFlag: int("ActivationFlag", { unsigned: true }).notNull().default(0),
    country: varchar("Country", { length: 2 }).notNull().default("xx"),
    age: int("Age", { unsigned: true }).notNull(),
    gender: varchar("Gender", { length: 1 }).notNull(),
    email: varchar("Email", { length: 255 }).notNull(),
    level: int("Level", { unsigned: true }).notNull().default(1),
    gold: int("Gold", { unsigned: true }).notNull().default(0),
    coins: int("Coins", { unsigned: true }).notNull().default(0),
    slotsBag: int("SlotsBag", { unsigned: true }).notNull().default(40),
    slotsBank: int("SlotsBank", { unsigned: true }).notNull().default(0),
    slotsHouse: int("SlotsHouse", { unsigned: true }).notNull().default(20),
    dateCreated: datetime("DateCreated").notNull(),
    lastLogin: datetime("LastLogin").notNull(),
    upgradeExpire: datetime("UpgradeExpire").notNull(),
    upgraded: int("Upgraded", { unsigned: true }).notNull().default(0),
    killCount: int("KillCount", { unsigned: true }).notNull().default(0),
    deathCount: int("DeathCount", { unsigned: true }).notNull().default(0),
    kills: int("Kills", { unsigned: true }).notNull().default(0),
    deaths: int("Deaths", { unsigned: true }).notNull().default(0),
    rebirth: int("Rebirth", { unsigned: true }).notNull().default(0),
  },
  (table) => [
    uniqueIndex("users_auth_user_unique").on(table.authUserId),
    uniqueIndex("users_name_unique").on(table.name),
    index("users_email_idx").on(table.email),
  ],
);
