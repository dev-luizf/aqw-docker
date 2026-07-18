import { drizzle } from "drizzle-orm/mysql2";
import mysql from "mysql2/promise";

import * as schema from "./schema";

const globalForDb = globalThis as unknown as {
  pool?: mysql.Pool;
};

function databaseUrl() {
  if (process.env.DATABASE_URL) return process.env.DATABASE_URL;
  const user = encodeURIComponent(process.env.MYSQL_USER ?? "aqw");
  const password = encodeURIComponent(process.env.MYSQL_PASSWORD ?? "aqw");
  const host = process.env.MYSQL_HOST ?? "127.0.0.1";
  const port = process.env.MYSQL_PORT ?? "3306";
  const database = process.env.MYSQL_DATABASE ?? "mextv3";
  return `mysql://${user}:${password}@${host}:${port}/${database}`;
}

export const pool =
  globalForDb.pool ??
  mysql.createPool({
    uri: databaseUrl(),
    connectionLimit: Number(process.env.DB_CONNECTION_LIMIT ?? 10),
    timezone: "Z",
    dateStrings: false,
  });

if (process.env.NODE_ENV !== "production") globalForDb.pool = pool;

export const db = drizzle(pool, { schema, mode: "default" });
