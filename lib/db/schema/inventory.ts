import { index, int, mysqlTable } from "drizzle-orm/mysql-core";

import { characters } from "./characters";

export const characterItems = mysqlTable(
  "users_items",
  {
    id: int("id", { unsigned: true }).autoincrement().primaryKey(),
    characterId: int("UserID", { unsigned: true })
      .notNull()
      .references(() => characters.id, { onDelete: "cascade" }),
    itemId: int("ItemID", { unsigned: true }).notNull(),
    enhancementId: int("EnhID", { unsigned: true }).notNull(),
    equipped: int("Equipped", { unsigned: true }).notNull(),
    quantity: int("Quantity", { unsigned: true }).notNull(),
    bank: int("Bank", { unsigned: true }).notNull(),
  },
  (table) => [
    index("users_items_character_idx").on(table.characterId),
    index("users_items_item_idx").on(table.itemId),
  ],
);
