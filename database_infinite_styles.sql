-- ==============================================================================
-- BASE DE DATOS SQL: INFINITE STYLES (Haute Édition VIP)
-- Proyecto: Sistema de Autenticación, Perfil VIP y Sesiones en Laravel
-- Generado para: Laragon / MySQL
-- Host: 127.0.0.1:3307 | Base de datos: infinite_styles
-- ==============================================================================

CREATE DATABASE IF NOT EXISTS `infinite_styles` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `infinite_styles`;

-- ------------------------------------------------------------------------------
-- 1. TABLA: users (Usuarios y Miembros del Club VIP)
-- ------------------------------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `member_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `membership_tier` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Black Diamond Member',
  `style_preference` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `welcome_drink` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `treatments` json DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_member_code_unique` (`member_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------------------------
-- 2. TABLA: sessions (Almacenamiento de Sesiones Activas en Base de Datos)
-- ------------------------------------------------------------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------------------------
-- 3. TABLA: password_reset_tokens
-- ------------------------------------------------------------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------------------------
-- 4. TABLA: cache
-- ------------------------------------------------------------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------------------------
-- 5. DATOS INICIALES (Usuario VIP de Prueba: Carlos Mendoza)
-- Password: InfiniteVIP2026!
-- ------------------------------------------------------------------------------
INSERT INTO `users` (
  `id`, `member_code`, `name`, `email`, `phone`, `birth_date`,
  `membership_tier`, `style_preference`, `welcome_drink`, `treatments`,
  `password`, `created_at`, `updated_at`
) VALUES (
  1,
  'INF-8842',
  'Carlos Mendoza',
  'carlos.mendoza@executive.com',
  '+34 644 892 104',
  '1987-11-24',
  'Black Diamond Member',
  'cortes',
  'whisky',
  '["cera_mate", "elixir_oud"]',
  '$2y$12$K1d0wQGgQ.9d.pA7Yq0i4ek2B6X2HhF/QJp5lX4L8O0m.X0uIu16.',
  NOW(),
  NOW()
) ON DUPLICATE KEY UPDATE `name`=VALUES(`name`);
