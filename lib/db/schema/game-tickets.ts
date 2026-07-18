import {
  datetime,
  index,
  int,
  mysqlTable,
  uniqueIndex,
  varchar,
} from "drizzle-orm/mysql-core";

import { characters } from "./characters";

export const gameLoginTickets = mysqlTable(
  "game_login_tickets",
  {
    id: int("id", { unsigned: true }).autoincrement().primaryKey(),
    tokenHash: varchar("token_hash", { length: 64 }).notNull(),
    characterId: int("character_id", { unsigned: true })
      .notNull()
      .references(() => characters.id, { onDelete: "cascade" }),
    expiresAt: datetime("expires_at").notNull(),
    consumedAt: datetime("consumed_at"),
    createdAt: datetime("created_at").notNull(),
  },
  (table) => [
    uniqueIndex("game_login_tickets_token_unique").on(table.tokenHash),
    index("game_login_tickets_character_idx").on(table.characterId),
    index("game_login_tickets_expiry_idx").on(table.expiresAt),
  ],
);
