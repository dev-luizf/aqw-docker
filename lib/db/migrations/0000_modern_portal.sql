SET FOREIGN_KEY_CHECKS = 0;
--> statement-breakpoint

DELETE FROM `admin_logs`;
--> statement-breakpoint
DELETE FROM `guilds_inventory`;
--> statement-breakpoint
DELETE FROM `guilds_halls_buildings`;
--> statement-breakpoint
DELETE FROM `guilds_halls_connections`;
--> statement-breakpoint
DELETE FROM `guilds_halls`;
--> statement-breakpoint
DELETE FROM `users_factions`;
--> statement-breakpoint
DELETE FROM `users_friends`;
--> statement-breakpoint
DELETE FROM `users_guilds`;
--> statement-breakpoint
DELETE FROM `users_items`;
--> statement-breakpoint
DELETE FROM `users_logs`;
--> statement-breakpoint
DELETE FROM `users_purchases`;
--> statement-breakpoint
DELETE FROM `users_redeems`;
--> statement-breakpoint
DELETE FROM `users_reports`;
--> statement-breakpoint
DELETE FROM `guilds`;
--> statement-breakpoint
DELETE FROM `recrute`;
--> statement-breakpoint
DELETE FROM `sorteio`;
--> statement-breakpoint
DELETE FROM `users`;
--> statement-breakpoint

ALTER TABLE `users` AUTO_INCREMENT = 1;
--> statement-breakpoint
ALTER TABLE `users_items` AUTO_INCREMENT = 1;
--> statement-breakpoint
ALTER TABLE `users` ENGINE=InnoDB;
--> statement-breakpoint
ALTER TABLE `users_items` ENGINE=InnoDB;
--> statement-breakpoint

CREATE TABLE `user` (
  `id` varchar(36) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `emailVerified` tinyint(1) NOT NULL DEFAULT 0,
  `image` text,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `username` varchar(32),
  `displayUsername` varchar(32),
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email_unique` (`email`),
  UNIQUE KEY `user_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
--> statement-breakpoint

CREATE TABLE `session` (
  `id` varchar(36) NOT NULL,
  `expiresAt` timestamp NOT NULL,
  `token` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ipAddress` varchar(64),
  `userAgent` text,
  `userId` varchar(36) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `session_token_unique` (`token`),
  KEY `session_user_id_idx` (`userId`),
  KEY `session_expires_at_idx` (`expiresAt`),
  CONSTRAINT `session_user_fk` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
--> statement-breakpoint

CREATE TABLE `account` (
  `id` varchar(36) NOT NULL,
  `accountId` varchar(255) NOT NULL,
  `providerId` varchar(64) NOT NULL,
  `userId` varchar(36) NOT NULL,
  `accessToken` text,
  `refreshToken` text,
  `idToken` text,
  `accessTokenExpiresAt` timestamp NULL,
  `refreshTokenExpiresAt` timestamp NULL,
  `scope` text,
  `password` text,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_provider_unique` (`providerId`, `accountId`),
  KEY `account_user_id_idx` (`userId`),
  CONSTRAINT `account_user_fk` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
--> statement-breakpoint

CREATE TABLE `verification` (
  `id` varchar(36) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `expiresAt` timestamp NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `verification_identifier_idx` (`identifier`),
  KEY `verification_expires_at_idx` (`expiresAt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
--> statement-breakpoint

ALTER TABLE `users`
  DROP PRIMARY KEY,
  DROP INDEX `Username`,
  DROP INDEX `Hash`,
  ADD PRIMARY KEY (`id`),
  ADD COLUMN `AuthUserID` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL AFTER `id`,
  MODIFY COLUMN `Email` varchar(255) NOT NULL,
  DROP COLUMN `Hash`,
  DROP COLUMN `Password`,
  ADD UNIQUE KEY `users_auth_user_unique` (`AuthUserID`),
  ADD UNIQUE KEY `users_name_unique` (`Name`),
  ADD KEY `users_email_idx` (`Email`),
  ADD CONSTRAINT `users_auth_user_fk` FOREIGN KEY (`AuthUserID`) REFERENCES `user` (`id`) ON DELETE CASCADE;
--> statement-breakpoint

CREATE TABLE `game_login_tickets` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `token_hash` char(64) NOT NULL,
  `character_id` int unsigned NOT NULL,
  `expires_at` datetime NOT NULL,
  `consumed_at` datetime NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `game_login_tickets_token_unique` (`token_hash`),
  KEY `game_login_tickets_character_idx` (`character_id`),
  KEY `game_login_tickets_expiry_idx` (`expires_at`),
  CONSTRAINT `game_login_tickets_character_fk` FOREIGN KEY (`character_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
--> statement-breakpoint

SET FOREIGN_KEY_CHECKS = 1;
