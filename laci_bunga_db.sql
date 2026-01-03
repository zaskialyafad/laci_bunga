-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2026 at 09:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laci_bunga_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Dress'),
(2, 'Outerwear'),
(3, 'Tops'),
(4, 'Bottoms'),
(5, 'Accessories'),
(6, 'Set');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gambar_produks`
--

CREATE TABLE `gambar_produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gambar_produks`
--

INSERT INTO `gambar_produks` (`id`, `product_id`, `image`, `is_primary`, `created_at`, `updated_at`) VALUES
(2, 6, '1.png', 1, '2026-01-02 12:44:29', '2026-01-02 12:44:29'),
(3, 7, '2.png', 1, '2026-01-02 12:44:29', '2026-01-02 12:44:29'),
(4, 8, '3.png', 1, '2026-01-02 12:44:29', '2026-01-02 12:44:29'),
(5, 9, '4.png', 1, '2026-01-02 12:44:29', '2026-01-02 12:44:29'),
(6, 10, '5.png', 1, '2026-01-02 12:44:29', '2026-01-02 12:44:29'),
(7, 11, '6.png', 1, '2026-01-02 12:44:29', '2026-01-02 12:44:29'),
(8, 12, '7.png', 1, '2026-01-02 12:44:29', '2026-01-02 12:44:29'),
(9, 13, '8.png', 1, '2026-01-02 12:44:29', '2026-01-02 12:44:29'),
(10, 14, '9.png', 1, '2026-01-02 12:44:29', '2026-01-02 12:44:29'),
(11, 15, '10.png', 1, '2026-01-02 12:44:29', '2026-01-02 12:44:29'),
(12, 16, '11.png', 1, '2026-01-02 12:44:29', '2026-01-02 12:44:29'),
(13, 17, '12.png', 1, '2026-01-02 12:44:29', '2026-01-02 12:44:29'),
(14, 18, '13.png', 1, '2026-01-02 12:44:29', '2026-01-02 12:44:29'),
(15, 19, '14.png', 1, '2026-01-02 12:44:29', '2026-01-02 12:44:29'),
(16, 20, '15.png', 1, '2026-01-02 12:44:29', '2026-01-02 12:44:29'),
(17, 21, '16.png', 1, '2026-01-02 12:44:29', '2026-01-02 12:44:29'),
(18, 22, '17.png', 1, '2026-01-02 12:44:29', '2026-01-02 12:44:29'),
(19, 23, '18.png', 1, '2026-01-02 12:44:29', '2026-01-02 12:44:29'),
(20, 24, '19.png', 1, '2026-01-02 12:44:29', '2026-01-02 12:44:29'),
(21, 25, '20.png', 1, '2026-01-02 12:44:29', '2026-01-02 12:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_05_133000_create_categories_table', 1),
(5, '2025_12_05_134019_create_products_table', 1),
(6, '2025_12_05_134100_create_gambar_produks_table', 1),
(7, '2025_12_10_125154_create_admins_table', 1),
(8, '2025_12_10_165558_create_product_variations_table', 1),
(9, '2026_01_02_083550_add_role_to_users_table', 1),
(10, '2026_01_02_083859_drop_admins_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('archive','show') NOT NULL DEFAULT 'show',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 'Cozy Knit Cardigan', 'Warm and comfortable knit cardigan, ideal for chilly days.', 'archive', '2026-01-02 11:28:01', '2026-01-02 12:17:34'),
(6, 1, 'Meadow Whisper Floral Dress', 'Dress katun dengan motif bunga padang rumput yang lembut.', 'show', '2026-01-02 11:28:01', '2026-01-02 11:28:01'),
(7, 1, 'Vintage Lace Picnic Dress', 'Dress putih dengan detail renda bordir tangan yang klasik.', 'show', '2026-01-02 11:28:01', '2026-01-02 11:28:01'),
(8, 1, 'Daisy Dream Tiered Maxi', 'Maxi dress bertingkat yang memberikan kesan jenjang dan anggun.', 'show', '2026-01-02 11:28:01', '2026-01-02 11:28:01'),
(9, 1, 'Prairie Sunsets Midi Dress', 'Midi dress dengan warna hangat untuk tampilan senja yang manis.', 'show', '2026-01-02 11:28:01', '2026-01-02 11:28:01'),
(10, 1, 'Peony Puff Sleeve Dress', 'Dress dengan lengan puff ikonik gaya cottagecore.', 'show', '2026-01-02 11:28:01', '2026-01-02 11:28:01'),
(11, 2, 'Muted Sage Linen Outer', 'Outer linen panjang warna sage yang menenangkan.', 'show', '2026-01-02 11:28:01', '2026-01-02 11:28:01'),
(12, 2, 'Dusty Rose Knit Cardigan', 'Cardigan rajut lembut dengan kancing mutiara.', 'show', '2026-01-02 11:28:01', '2026-01-02 11:28:01'),
(13, 2, 'Forest Fern Embroidered Vest', 'Rompi dengan bordir manual motif pakis hutan.', 'show', '2026-01-02 11:28:01', '2026-01-02 11:28:01'),
(14, 3, 'Petal Soft Linen Blouse', 'Atasan linen berkualitas tinggi yang nyaman dipakai seharian.', 'show', '2026-01-02 11:28:01', '2026-01-02 11:28:01'),
(15, 3, 'Morning Dew Eyelet Top', 'Blouse dengan detail lubang eyelet yang manis dan sejuk.', 'show', '2026-01-02 11:28:01', '2026-01-02 11:28:01'),
(16, 3, 'Antique Rose Square Neck Blouse', 'Atasan kerah kotak yang memberikan kesan vintage.', 'show', '2026-01-02 11:28:01', '2026-01-02 11:28:01'),
(17, 3, 'Wildflower Smocked Top', 'Atasan fleksibel dengan karet smocking yang inklusif untuk semua ukuran.', 'show', '2026-01-02 11:28:01', '2026-01-02 11:28:01'),
(18, 4, 'Linen Field Culottes', 'Kulot linen potongan lebar untuk ruang gerak yang bebas.', 'show', '2026-01-02 11:28:01', '2026-01-02 11:28:01'),
(19, 4, 'Secret Garden Pleated Skirt', 'Rok plisket dengan warna-warna tanah yang netral.', 'show', '2026-01-02 11:28:01', '2026-01-02 11:28:01'),
(20, 4, 'Autumn Leaf Tiered Skirt', 'Rok panjang bertingkat yang feminin.', 'show', '2026-01-02 11:28:01', '2026-01-02 11:28:01'),
(21, 5, 'Laci Bunga Signature Tote', 'Tas kanvas dengan ilustrasi ikonik Laci Bunga.', 'show', '2026-01-02 11:28:01', '2026-01-02 11:28:01'),
(22, 5, 'Straw Garden Hat', 'Topi jerami klasik untuk melindungi dari matahari.', 'show', '2026-01-02 11:28:01', '2026-01-02 11:28:01'),
(23, 5, 'Wild Rose Silk Scarf', 'Syal sutra motif bunga untuk aksen manis di leher atau tas.', 'show', '2026-01-02 11:28:01', '2026-01-02 11:28:01'),
(24, 6, 'Cottage Comfort Loungewear Set', 'Satu set atasan dan bawahan santai berbahan katun organik.', 'show', '2026-01-02 11:28:01', '2026-01-02 11:28:01'),
(25, 6, 'Dreamy Dusk Pajamas Set', 'Set piyama dengan kerah renda yang cantik.', 'show', '2026-01-02 11:28:01', '2026-01-02 11:28:01');

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `price` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `stock` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sku` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`id`, `product_id`, `size`, `color`, `price`, `stock`, `sku`, `created_at`, `updated_at`) VALUES
(11, 6, 'S/M', 'Muted Sage', 385000, 15, 'LB-006-SG', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(12, 6, 'L/XL', 'Dusty Rose', 385000, 10, 'LB-006-DR', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(13, 7, 'S/M', 'Muted Sage', 385000, 15, 'LB-007-SG', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(14, 7, 'L/XL', 'Dusty Rose', 385000, 10, 'LB-007-DR', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(15, 8, 'S/M', 'Muted Sage', 385000, 15, 'LB-008-SG', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(16, 8, 'L/XL', 'Dusty Rose', 385000, 10, 'LB-008-DR', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(17, 9, 'S/M', 'Muted Sage', 385000, 15, 'LB-009-SG', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(18, 9, 'L/XL', 'Dusty Rose', 385000, 10, 'LB-009-DR', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(19, 10, 'S/M', 'Muted Sage', 385000, 15, 'LB-010-SG', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(20, 10, 'L/XL', 'Dusty Rose', 385000, 10, 'LB-010-DR', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(21, 11, 'S/M', 'Muted Sage', 385000, 15, 'LB-011-SG', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(22, 11, 'L/XL', 'Dusty Rose', 385000, 10, 'LB-011-DR', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(23, 12, 'S/M', 'Muted Sage', 385000, 15, 'LB-012-SG', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(24, 12, 'L/XL', 'Dusty Rose', 385000, 10, 'LB-012-DR', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(25, 13, 'S/M', 'Muted Sage', 385000, 15, 'LB-013-SG', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(26, 13, 'L/XL', 'Dusty Rose', 385000, 10, 'LB-013-DR', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(27, 14, 'S/M', 'Muted Sage', 385000, 15, 'LB-014-SG', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(28, 14, 'L/XL', 'Dusty Rose', 385000, 10, 'LB-014-DR', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(29, 15, 'S/M', 'Muted Sage', 385000, 15, 'LB-015-SG', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(30, 15, 'L/XL', 'Dusty Rose', 385000, 10, 'LB-015-DR', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(31, 16, 'All Size', 'Muted Sage', 125000, 15, 'LB-016-SG', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(32, 16, 'All Size', 'Dusty Rose', 125000, 10, 'LB-016-DR', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(33, 17, 'All Size', 'Muted Sage', 125000, 15, 'LB-017-SG', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(34, 17, 'All Size', 'Dusty Rose', 125000, 10, 'LB-017-DR', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(35, 18, 'All Size', 'Muted Sage', 125000, 15, 'LB-018-SG', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(36, 18, 'All Size', 'Dusty Rose', 125000, 10, 'LB-018-DR', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(37, 19, 'All Size', 'Muted Sage', 125000, 15, 'LB-019-SG', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(38, 19, 'All Size', 'Dusty Rose', 125000, 10, 'LB-019-DR', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(39, 20, 'All Size', 'Muted Sage', 125000, 15, 'LB-020-SG', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(40, 20, 'All Size', 'Dusty Rose', 125000, 10, 'LB-020-DR', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(45, 2, 'S/M', 'Muted Sage', 385000, 15, 'LB-002-SG', '2026-01-02 12:17:34', '2026-01-02 12:17:34'),
(46, 2, 'L/XL', 'Dusty Rose', 385000, 10, 'LB-002-DR', '2026-01-02 12:17:34', '2026-01-02 12:17:34');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('sakh40MJ5OFu4X3zCX2Zm1g6FraLAQRAl0IIzpzc', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUmF5T0t6cWpDajhDRXh3bjJINU5FRFpIY3A4N2Q2VkNXVnNaS29nWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9qZWN0L3ZpZXctZGF0YSI7czo1OiJyb3V0ZSI7czoxNzoicHJvamVjdC52aWV3LWRhdGEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1767384010);

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
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Labung', 'admin@gmail.com', NULL, '$2y$12$sKkz9uthpczY36ryrtEPYOsoPU2YOtgiAzxWCFtI7A2RSnb88qGge', 'admin', NULL, '2026-01-02 11:31:56', '2026-01-02 11:31:56'),
(2, 'Lebah Cantik', 'user@gmail.com', NULL, '$2y$12$sY6U3zedhdP4d1oV6cZjo..pG/Ry/iZqHT0TR44/sV3phzXRG.7qS', 'user', NULL, '2026-01-02 11:31:56', '2026-01-02 11:31:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gambar_produks`
--
ALTER TABLE `gambar_produks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gambar_produks_product_id_foreign` (`product_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_variations_sku_unique` (`sku`),
  ADD KEY `product_variations_product_id_foreign` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gambar_produks`
--
ALTER TABLE `gambar_produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gambar_produks`
--
ALTER TABLE `gambar_produks`
  ADD CONSTRAINT `gambar_produks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD CONSTRAINT `product_variations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
