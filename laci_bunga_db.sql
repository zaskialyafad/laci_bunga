-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2026 at 09:37 AM
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
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_variation_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `product_variation_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 3, 6, 12, 1, '2026-01-03 21:04:09', '2026-01-03 21:08:42'),
(2, 3, 11, 21, 1, '2026-01-03 21:04:59', '2026-01-03 21:04:59');

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
(21, 25, '20.png', 1, '2026-01-02 12:44:29', '2026-01-02 12:44:29'),
(22, 26, '1767451749_0-tihNpRXATc.jpg', 1, '2026-01-03 07:49:11', '2026-01-03 07:49:11'),
(23, 27, '1767522321_0-C4VySGZfHG.jpg', 1, '2026-01-04 03:25:23', '2026-01-04 03:25:23');

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
(10, '2026_01_02_083859_drop_admins_table', 1),
(11, '2026_01_03_232410_create_carts_table', 2),
(12, '2026_01_03_232443_create_wishlists_table', 2),
(13, '2026_01_04_060009_create_orders_table', 3),
(14, '2026_01_05_194250_create_order_items_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `snap_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `receiver_name`, `phone`, `address`, `total_price`, `payment_status`, `snap_token`, `created_at`, `updated_at`) VALUES
(5, 'INV-695a1f5e5e2f2', 3, 'zaskia', '081211841245', 'adalah pokoknya', 770000.00, 'pending', NULL, '2026-01-04 01:05:50', '2026-01-04 01:05:50'),
(6, 'INV-695a1f87dcddd', 3, 'zaskia', '081211841245', 'adalah pokoknya', 770000.00, 'pending', NULL, '2026-01-04 01:06:31', '2026-01-04 01:06:31'),
(7, 'INV-695a21d90b4cd', 1, 'zaskia', '22222', 'adalah pokoknya', 385000.00, 'pending', NULL, '2026-01-04 01:16:25', '2026-01-04 01:16:25'),
(8, 'INV-695a22d454aa7', 1, 'zaskia', '22222', 'adalah pokoknya', 385000.00, 'pending', NULL, '2026-01-04 01:20:36', '2026-01-04 01:20:36'),
(9, 'INV-695a23d321915', 1, 'zaskia', '22222', 'adalah pokoknya', 385000.00, 'pending', NULL, '2026-01-04 01:24:51', '2026-01-04 01:24:51'),
(10, 'INV-695a23fb23e40', 1, 'zaskia', '22222', 'adalah pokoknya', 385000.00, 'pending', NULL, '2026-01-04 01:25:31', '2026-01-04 01:25:31'),
(11, 'INV-695a241204388', 1, 'zaskia', '22222', 'adalah pokoknya', 385000.00, 'pending', NULL, '2026-01-04 01:25:54', '2026-01-04 01:25:54'),
(12, 'INV-695a24ab548ea', 1, 'zaskia', '22222', 'adalah pokoknya', 385000.00, 'pending', NULL, '2026-01-04 01:28:27', '2026-01-04 01:28:27'),
(13, 'INV-695a251b1c138', 1, 'zaskia', '22222', 'adalah pokoknya', 385000.00, 'pending', NULL, '2026-01-04 01:30:19', '2026-01-04 01:30:19'),
(14, 'INV-695a25f6bad7e', 1, 'zaskia', '22222', 'adalah pokoknya', 385000.00, 'pending', NULL, '2026-01-04 01:33:58', '2026-01-04 01:33:58'),
(15, 'INV-695a2607c0b33', 1, 'zaskia', '22222', 'adalah pokoknya', 385000.00, 'pending', NULL, '2026-01-04 01:34:15', '2026-01-04 01:34:15'),
(16, 'INV-695a261673d11', 1, 'zaskia', '22222', 'adalah pokoknya', 385000.00, 'pending', NULL, '2026-01-04 01:34:30', '2026-01-04 01:34:30'),
(17, 'INV-695a282a1f0bc', 1, 'zaskia', '22222', 'adalah pokoknya', 385000.00, 'pending', 'ed16bd3d-e73a-406e-ad9b-d833f30673ee', '2026-01-04 01:43:22', '2026-01-04 01:43:23'),
(18, 'INV-695a286383f06', 1, 'zaskia', '22222', 'adalah pokoknya', 385000.00, 'pending', '352ed0f5-acc7-4ad9-b01b-854e7406536d', '2026-01-04 01:44:19', '2026-01-04 01:44:20'),
(19, 'INV-695a289a4825a', 1, 'zaskia', '22222', 'adalah pokoknya', 385000.00, 'pending', 'efc49af3-b0f0-4643-a7b3-aaf1fb55bb6a', '2026-01-04 01:45:14', '2026-01-04 01:45:15'),
(20, 'INV-695a28dd2e97c', 1, 'zaskia', '22222', 'adalah pokoknya', 385000.00, 'pending', '4645b448-6a78-42fe-8422-a24c8acc6905', '2026-01-04 01:46:21', '2026-01-04 01:46:22'),
(21, 'INV-695a28fa7f3b5', 1, 'zaskia', '22222', 'adalah pokoknya', 385000.00, 'pending', 'bd7e80c0-9127-48dd-86be-25901a75e241', '2026-01-04 01:46:50', '2026-01-04 01:46:51'),
(22, 'INV-695a29a243096', 1, 'zaskia', '22222', 'adalah pokoknya', 385000.00, 'pending', NULL, '2026-01-04 01:49:38', '2026-01-04 01:49:38'),
(23, 'INV-695a29d85862a', 1, 'zaskia', '22222', 'adalah pokoknya', 385000.00, 'pending', '3753ca83-2d66-4fe1-be93-d38392d388af', '2026-01-04 01:50:32', '2026-01-04 01:50:35'),
(24, 'INV-695a2ca99bdc1', 3, 'zaskia', '081211841245', 'adalah pokoknya', 770000.00, 'pending', '20594343-81a5-44ec-9dcf-0ad9b124a867', '2026-01-04 02:02:33', '2026-01-04 02:02:36'),
(25, 'INV-695a2da3ca9f0', 3, 'zaskia', '081211841245', 'adalah pokoknya', 770000.00, 'pending', '4b03a351-ef70-448f-b7c1-1a42b6cfec26', '2026-01-04 02:06:43', '2026-01-04 02:06:45'),
(26, 'INV-695a2de0b5ac8', 3, 'zaskia', '081211841245', 'adalah pokoknya', 770000.00, 'pending', '2a21590d-b917-43b2-a8f5-0295a8b7c08a', '2026-01-04 02:07:44', '2026-01-04 02:07:46'),
(27, 'INV-695a2f5476fdb', 3, 'zaskia', '081211841245', 'adalah pokoknya', 770000.00, 'pending', '1bd3ecca-1903-4300-bcf8-f3537c3826b2', '2026-01-04 02:13:56', '2026-01-04 02:13:58'),
(28, 'INV-695a2f866f876', 3, 'zaskia', '081211841245', 'adalah pokoknya', 770000.00, 'pending', 'c73b95da-aa8c-45d7-9009-72a975731722', '2026-01-04 02:14:46', '2026-01-04 02:14:47'),
(29, 'INV-695a3954c50f4', 3, 'zaskia', '4646', 'vsdvava', 770000.00, 'pending', 'ea212578-a080-4343-a657-9650ce24c6dd', '2026-01-04 02:56:36', '2026-01-04 02:56:38'),
(31, 'INV-695a472234a50', 2, 'zaski', '081211841245', 'di rumah', 3000.00, 'pending', 'd6835d39-d767-4fa9-ad24-aa0831a47a4e', '2026-01-04 03:55:30', '2026-01-04 03:55:32'),
(32, 'INV-695a47540a745', 2, 'zaski', '081211841245', 'di rumah', 3000.00, 'pending', '20cab7bf-d343-4ea2-b76b-37493952e254', '2026-01-04 03:56:20', '2026-01-04 03:56:21'),
(33, 'INV-695bcb9b8e5ea', 3, 'zaskia', '081211841245', 'adaa', 770000.00, 'pending', 'TOKEN-PALSU-DEMO-1767623579', '2026-01-05 07:32:59', '2026-01-05 07:32:59'),
(39, 'INV-695c22c4b1bd3', 1, 'xvf', '014444', 'bvbvncgbbcffg bxbxf', 385000.00, 'pending', '22367548-ef32-4e51-b1cb-6653c7b06d48', '2026-01-05 13:44:52', '2026-01-05 13:44:55'),
(40, 'INV-695c2a1d62a76', 1, 'budi', '003545', 'zmb czjv lhvckJAV lAGk', 6000.00, 'pending', '998874fc-b4b2-4156-a48f-13fd9a0c35bf', '2026-01-05 14:16:13', '2026-01-05 14:16:15'),
(41, 'INV-695c8d4436027', 2, 'cccdz', 'c cgh hf f', 'fghnsdrfh', 388000.00, 'pending', '739ad135-59ea-4fd6-b854-87364578d3ec', '2026-01-05 21:19:16', '2026-01-05 21:19:19'),
(42, 'INV-695c959ac7b0f', 2, 'vbbcf', 'bxfbxbxf', 'bcgb', 100000.00, 'pending', 'd8b7960f-8e03-409a-89c3-1fac5b0d470e', '2026-01-05 21:54:50', '2026-01-05 21:54:56'),
(43, 'INV-695c99c800f6a', 2, 'cobaa', '1444', 'cxvfbffbbdfhdrgfdrgf', 385000.00, 'pending', '9ead981c-f161-4cdf-99e0-78d6bac9ff3b', '2026-01-05 22:12:40', '2026-01-05 22:12:41');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_variation_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_variation_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 39, 6, 12, 1, 385000, '2026-01-05 13:44:52', '2026-01-05 13:44:52'),
(2, 40, 27, 48, 2, 3000, '2026-01-05 14:16:13', '2026-01-05 14:16:13'),
(3, 41, 27, 48, 1, 3000, '2026-01-05 21:19:16', '2026-01-05 21:19:16'),
(4, 41, 7, 14, 1, 385000, '2026-01-05 21:19:16', '2026-01-05 21:19:16'),
(5, 42, 26, 47, 1, 100000, '2026-01-05 21:54:50', '2026-01-05 21:54:50'),
(6, 43, 8, 16, 1, 385000, '2026-01-05 22:12:40', '2026-01-05 22:12:40');

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
('admin@gmail.com', '$2y$12$A5O1v2RtqeAaLXalvvX1MuRbq6uQYF18sc3aPF1K9OaP1FM2FPH4G', '2026-01-05 22:27:56');

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
(25, 6, 'Dreamy Dusk Pajamas Set', 'Set piyama dengan kerah renda yang cantik.', 'show', '2026-01-02 11:28:01', '2026-01-02 11:28:01'),
(26, 5, 'Tas Floral', 'cek tambah data', 'show', '2026-01-03 07:49:09', '2026-01-03 07:49:09'),
(27, 1, 'baju bagus', 'bagusss', 'show', '2026-01-04 03:25:21', '2026-01-04 03:25:21');

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
(12, 6, 'L/XL', 'Dusty Rose', 385000, 9, 'LB-006-DR', '2026-01-02 11:28:02', '2026-01-05 13:44:52'),
(13, 7, 'S/M', 'Muted Sage', 385000, 15, 'LB-007-SG', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(14, 7, 'L/XL', 'Dusty Rose', 385000, 9, 'LB-007-DR', '2026-01-02 11:28:02', '2026-01-05 21:19:16'),
(15, 8, 'S/M', 'Muted Sage', 385000, 15, 'LB-008-SG', '2026-01-02 11:28:02', '2026-01-02 11:28:02'),
(16, 8, 'L/XL', 'Dusty Rose', 385000, 9, 'LB-008-DR', '2026-01-02 11:28:02', '2026-01-05 22:12:40'),
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
(46, 2, 'L/XL', 'Dusty Rose', 385000, 10, 'LB-002-DR', '2026-01-02 12:17:34', '2026-01-02 12:17:34'),
(47, 26, NULL, NULL, 100000, 2, 'SKU-A2XQI5WD', '2026-01-03 07:49:11', '2026-01-05 21:54:50'),
(48, 27, 'S', 'hijau', 3000, 7, 'SKU-BAJ-HIJAU-S', '2026-01-04 03:25:23', '2026-01-05 21:19:16'),
(49, 27, 'M', 'hijau', 3000, 10, 'SKU-BAJ-HIJAU-M', '2026-01-04 03:25:23', '2026-01-04 03:25:23'),
(50, 27, 'L', 'hijau', 3000, 10, 'SKU-BAJ-HIJAU-L', '2026-01-04 03:25:23', '2026-01-04 03:25:23'),
(51, 27, 'XL', 'hijau', 3000, 10, 'SKU-BAJ-HIJAU-XL', '2026-01-04 03:25:23', '2026-01-04 03:25:23'),
(52, 27, 'S', 'biru', 3000, 19, 'SKU-BAJ-BIRU-S', '2026-01-04 03:25:23', '2026-01-04 03:25:23'),
(53, 27, 'M', 'biru', 3000, 10, 'SKU-BAJ-BIRU-M', '2026-01-04 03:25:23', '2026-01-04 03:25:23'),
(54, 27, 'L', 'biru', 3000, 10, 'SKU-BAJ-BIRU-L', '2026-01-04 03:25:23', '2026-01-04 03:25:23'),
(55, 27, 'XL', 'biru', 70000, 55, 'SKU-BAJ-BIRU-XL', '2026-01-04 03:25:23', '2026-01-04 03:25:23');

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
('NXUtRtawAs7ZAYyVxyUlhMJu2sP1PDQnny4BFtAX', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQ3N1NHNnZFFzR2VlaUk2QWZ5blp4ZXh5NkFOYXZZYnJaUkZrcE5BQiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czoxMzoid2ViLmhvbWUtcGFnZSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1767681189);

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
(2, 'Lebah Cantik', 'user@gmail.com', NULL, '$2y$12$sY6U3zedhdP4d1oV6cZjo..pG/Ry/iZqHT0TR44/sV3phzXRG.7qS', 'user', NULL, '2026-01-02 11:31:56', '2026-01-02 11:31:56'),
(3, 'Zaskia Alya Fadilah', 'zaskialyafadilah@upi.edu', NULL, '$2y$12$fB9eI/nWXYt00fJvmMOPMu1PQMvHVRZwn3QEviAtKtBPs9n8Efq/q', 'user', 'u17ARapVggU1OmlhgTbnxMk89RFheMwW0NbgCF97vNbzZRE2LVSxNQEjLTej', '2026-01-03 07:36:10', '2026-01-03 07:36:10');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(2, 3, 7, '2026-01-03 20:10:34', '2026-01-03 20:10:34'),
(4, 2, 27, '2026-01-04 03:48:47', '2026-01-04 03:48:47'),
(5, 2, 7, '2026-01-04 03:48:53', '2026-01-04 03:48:53');

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
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_product_variation_id_foreign` (`product_variation_id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_product_variation_id_foreign` (`product_variation_id`);

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
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_user_id_product_id_unique` (`user_id`,`product_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_product_variation_id_foreign` FOREIGN KEY (`product_variation_id`) REFERENCES `product_variations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gambar_produks`
--
ALTER TABLE `gambar_produks`
  ADD CONSTRAINT `gambar_produks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `order_items_product_variation_id_foreign` FOREIGN KEY (`product_variation_id`) REFERENCES `product_variations` (`id`);

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

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
