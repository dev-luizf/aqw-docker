import { int, mysqlTable, varchar } from "drizzle-orm/mysql-core";

export const servers = mysqlTable("servers", {
  id: int("id", { unsigned: true }).primaryKey(),
  name: varchar("Name", { length: 64 }).notNull(),
  ip: varchar("IP", { length: 255 }).notNull(),
  count: int("Count").notNull(),
  max: int("Max").notNull(),
  online: int("Online").notNull(),
  upgrade: int("Upgrade").notNull(),
  chat: int("Chat").notNull(),
  motd: varchar("MOTD", { length: 255 }).notNull(),
});

export const loginSettings = mysqlTable("settings_login", {
  name: varchar("name", { length: 64 }).primaryKey(),
  value: varchar("value", { length: 255 }).notNull(),
});
