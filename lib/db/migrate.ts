import { migrate } from "drizzle-orm/mysql2/migrator";

import { db, pool } from "./index";

async function main() {
  try {
    await migrate(db, { migrationsFolder: "./lib/db/migrations" });
  } finally {
    await pool.end();
  }
}

main().catch((error) => {
  console.error(error);
  process.exitCode = 1;
});
