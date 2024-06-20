-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2024 at 10:15 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dash`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `primary_color` varchar(255) NOT NULL,
  `secondary_color` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `domain`, `logo`, `primary_color`, `secondary_color`, `created_at`, `updated_at`) VALUES
(1, 'PrimeroTV', 'primerotv.com', '/logo', '#001e5a', '#2596be', '2024-06-15 00:51:14', '2024-06-15 15:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `lang` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `verification_code` varchar(10) DEFAULT NULL,
  `newsletter` varchar(255) DEFAULT '1',
  `type` varchar(255) DEFAULT NULL,
  `emails_sent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`id`, `ip`, `lang`, `email`, `verification_code`, `newsletter`, `type`, `emails_sent`, `created_at`, `updated_at`) VALUES
(2, '192.168.2.2', '', 'mrdo@email.com', '', NULL, NULL, NULL, '2024-04-07 20:14:22', '2024-04-07 22:10:26'),
(5, 'gfgfdgfd', '', 'gdfhshd', '', NULL, NULL, NULL, '2024-04-07 23:25:56', '2024-04-07 23:25:56'),
(9, '127.0.0.100', 'mrrrd', 'mmrrrddd@email.com', '000', NULL, NULL, NULL, '2024-04-09 03:34:48', '2024-04-16 20:44:13'),
(54, '127.0.0.1', 'en', 'hoodmichal69@gmail.com', 'C9NZ2T', NULL, 'tester', NULL, '2024-06-11 12:29:44', '2024-06-11 13:09:57');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_06_15_000000_create_report_adunits_table', 2),
(6, '2023_06_15_000000_create_adunits_table', 3),
(7, '2023_06_15_000000_create_apps_table', 4),
(8, '2023_06_19_093930_create_permission_tables', 5),
(9, '2023_07_06_000000_create_categories_table', 6),
(10, '2023_07_13_000000_create_countries_table', 7),
(11, '2024_04_05_000000_create_guests_table', 8),
(12, '2024_04_07_000000_create_service_providers_table', 9),
(13, '2024_06_14_000000_create_orders_payment_providers_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(18, 'App\\Models\\User', 275),
(18, 'App\\Models\\User', 276),
(19, 'App\\Models\\User', 279),
(20, 'App\\Models\\User', 280),
(21, 'App\\Models\\User', 269);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `guest_id` varchar(255) DEFAULT NULL,
  `amount` varchar(255) NOT NULL,
  `payment_gateway_id` varchar(255) NOT NULL,
  `payment_order_id` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `email`, `guest_id`, `amount`, `payment_gateway_id`, `payment_order_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'loco@gmail.com', '1', '80', '1', '37HD6FH6D5JS9E', 'Paid', '2024-06-15 15:47:50', '2024-06-15 15:56:19'),
(2, 'cc@gmlkdf.com', '6', '66', '1', 'HD7E6HF653EZ', 'Failed', '2024-06-15 15:59:23', '2024-06-15 15:59:23'),
(3, 'Nizr@hotmail.com', '3', '55', '1', 'JDHF7E736746HDG', 'Pending', '2024-06-15 16:00:06', '2024-06-15 16:00:06');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('morade.live@gmail.com', '$2y$10$vV76v3zMhdZs0aPppyGDGO8WkCk62OtZDPFPeCzIP1Z1YtYsG8RDa', '2023-06-08 20:59:55'),
('test@gmail.com', '$2y$10$/fF41f7JrQIQa3qCgkIpc.uFGounVyuekYbe7zF9aTdxZdwOqnNUW', '2023-06-08 20:52:47');

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `publishable_key` varchar(255) DEFAULT NULL,
  `secret_key` varchar(255) DEFAULT NULL,
  `payment_company` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `name`, `publishable_key`, `secret_key`, `payment_company`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ameer Conseils LTD', 'pk_live_51P0U1t09LjTAzC4svhr6ruSpxcLZwS9IbB3zHtcHbXEQ8A5VzqdWGO00bv1XK1Nkyw4y3WIuc887hgbFx7kEdGYh00mgz9G5oO', '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', 'Stripe', 'Active', '2024-06-15 16:39:21', '2024-06-15 17:44:43'),
(2, 'Morados LTD', 'DJ78EYHFE87TY38HFE', NULL, 'Stripe', 'Active', '2024-06-15 16:39:54', '2024-06-15 17:45:04'),
(3, 'Nizar Shop LTD', 'CH78YD7E8DGE66D', NULL, 'Square', 'Inactive', '2024-06-15 16:40:16', '2024-06-15 17:46:32');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create_user', 'web', '2023-06-19 14:21:27', '2023-06-19 14:21:27'),
(2, 'edit_user', 'web', '2023-06-19 14:24:02', '2023-06-19 14:35:31'),
(4, 'delete_user', 'web', '2023-06-19 16:27:06', '2023-06-19 16:27:06'),
(5, 'read_user', 'web', '2023-06-19 16:34:33', '2023-06-19 16:34:33'),
(6, 'access_roles', 'web', '2023-06-19 19:43:42', '2023-06-19 19:43:42'),
(7, 'read-app', 'web', '2023-07-06 14:01:52', '2023-07-06 14:01:52'),
(8, 'create-app', 'web', '2023-07-06 14:02:05', '2023-07-06 14:02:05'),
(9, 'update-app', 'web', '2023-07-06 14:02:13', '2023-07-06 14:02:13'),
(10, 'destroy-app', 'web', '2023-07-06 14:02:22', '2023-07-06 14:02:22'),
(11, 'read-test', 'web', '2023-07-08 10:11:35', '2023-07-08 10:11:35'),
(12, 'manage-offers', 'web', '2023-07-08 11:26:30', '2023-07-08 11:26:30');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(18, 'admin', 'web', '2023-06-19 19:25:56', '2023-06-19 19:25:56'),
(19, 'publisher', 'web', '2023-06-19 19:26:05', '2023-06-19 19:26:05'),
(20, 'pending', 'web', '2023-06-20 14:54:02', '2023-06-20 14:54:02'),
(21, 'Super Admin', 'web', '2023-07-08 10:06:13', '2023-07-08 10:06:13');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 18),
(1, 20),
(1, 21),
(2, 18),
(2, 21),
(4, 18),
(4, 21),
(5, 18),
(5, 21),
(6, 18),
(6, 21),
(7, 18),
(7, 21),
(8, 18),
(8, 21),
(9, 18),
(9, 21),
(10, 18),
(10, 21);

-- --------------------------------------------------------

--
-- Table structure for table `service_providers`
--

CREATE TABLE `service_providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `m3u_schema` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_providers`
--

INSERT INTO `service_providers` (`id`, `name`, `m3u_schema`, `created_at`, `updated_at`) VALUES
(1, 'Nexon', 'http://es.nexons.live:80/get.php?username=[username]&password=[password]&type=m3u_plus&output=mpegts', '2024-04-07 21:25:08', '2024-04-07 21:25:08'),
(2, 'Trex', 'http://trex.io/[user]/[pass]', '2024-04-07 22:00:41', '2024-04-08 22:53:16'),
(3, 'Leon', 'http://leon.com/user/pass', '2024-04-07 22:51:43', '2024-04-07 22:51:43'),
(6, 'Other', 'fdsgfdgsdf', '2024-04-08 22:52:57', '2024-04-08 22:52:57'),
(7, 'Other 2', 'csdffgfds', '2024-04-08 22:53:05', '2024-04-08 22:53:05');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `service_provider_id` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `guest_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `username`, `password`, `service_provider_id`, `status`, `guest_id`, `created_at`, `updated_at`) VALUES
(1, 'ccccaa', 'aaaccc', '3', '1', '1', '2024-04-07 20:53:01', '2024-06-11 21:32:37'),
(3, 'uu', 'yyy', '2', '1', NULL, '2024-04-08 00:41:53', '2024-06-11 21:40:17'),
(5, 'aaaaa', 'qqqq', '1', '1', NULL, '2024-04-08 01:03:21', '2024-06-11 22:21:39'),
(6, 'gsffhgfdgh', 'bkkjhvdfg', '3', '0', NULL, '2024-04-08 23:22:12', '2024-06-11 21:32:26'),
(7, 'ccccccc', 'cccccc', '2', '0', NULL, '2024-04-08 23:22:51', '2024-06-11 21:32:29'),
(8, 'sssssssss', 'ssssssssss', '2', '0', NULL, '2024-04-08 23:25:10', '2024-06-11 21:32:32'),
(9, 'sqsqs', 'sqsqssq', '1', '1', NULL, '2024-04-08 23:29:39', '2024-06-11 13:13:06'),
(10, 'nbnvbncvb', 'bfgdhbgfdhgfhgf', '1', '1', NULL, '2024-04-08 23:52:45', '2024-06-11 13:25:33'),
(11, 'fdgufhgth', 'grfdhgièrg', '2', '1', NULL, '2024-04-08 23:53:26', '2024-06-12 15:30:03'),
(12, 'yyyy', 'ttttt', '3', '1', NULL, '2024-04-16 19:25:17', '2024-06-11 16:49:46'),
(13, 'qsdsq', 'dfsfdsf', '1', '1', NULL, '2024-04-16 20:47:10', '2024-04-16 20:49:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(269, 'Morad', 'morade.live@gmail.com', NULL, '$2y$10$Sj3..TgH/yWt4sRwUkNEjOzwm1d5XtfwhSYXxu.ZoWD07WjOWcBMG', 'mnaMiOTAVzmxU3uCXxgaV6uUXcKdCP0Zw6gWjlSl8dhApBPLrmCsU11lEtid', '2023-06-08 13:50:23', '2023-06-20 15:03:55'),
(275, 'Yassine', 'probenads@gmail.com', NULL, '$2y$10$GHxCe/JOrKBA.Yx2qKV.GOua8ADY/j21rO04myuRA3dbJ9H9Obf2W', NULL, '2023-06-09 22:21:10', '2023-06-09 22:21:28'),
(276, 'admin', 'admin@admin.com', NULL, '$2y$10$akPVTiVhFZpYOOfuau.dJeYA4EKleZ4SwgO4A4u3yPXMnmugNewDC', 'GXhMR1r19SnZpmqwbyyAsBsDakKJZ0w9bQ5V7HZQvaLevNyebNoKHm6aGKoG', '2023-06-19 09:52:38', '2023-06-19 09:52:38'),
(279, 'publisher unity', 'pub@pub.com', NULL, '$2y$10$AOd3oJcGTrIuf1KzgXXZpOHoczDh0esNIM1acZYi.j/DNJjsVCXlq', NULL, '2023-06-20 15:07:30', '2023-06-20 15:07:30'),
(280, 'Pending', 'pending@pending.com', NULL, '$2y$10$DBsFMuvIeLOD2oomaw4ocObYhW.WL9RT36prGJd4o3Jd.pawLnqni', NULL, '2023-06-23 17:04:07', '2023-06-23 17:04:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `service_providers`
--
ALTER TABLE `service_providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `service_providers`
--
ALTER TABLE `service_providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
