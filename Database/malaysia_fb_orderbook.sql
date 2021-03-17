-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2021 at 08:40 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `malaysia_fb_orderbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Culinary', '2021-01-28 16:19:32', NULL),
(2, 'Biscuit & Bakery', '2021-01-28 16:19:35', NULL),
(3, 'Dairy', '2021-01-28 16:19:37', NULL),
(4, 'Snacks', '2021-01-28 16:19:39', NULL),
(5, 'Sugar Confectionery', '2021-01-28 16:19:42', NULL),
(6, 'Tea & Coffee', '2021-01-28 16:19:29', NULL),
(7, 'Beverage', '2021-01-28 16:19:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_01_10_171109_products', 1),
(5, '2021_01_10_171237_categories', 1),
(6, '2021_01_10_171251_units', 1),
(7, '2021_01_10_171940_orders', 1),
(8, '2021_01_12_183717_order_details', 1),
(9, '2021_01_21_044609_sales_target_assignments', 1),
(10, '2021_01_22_232153_notices', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_canceled` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('PENDING','APPROVED','REJECTED','COMPLETED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_price` double(15,2) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `is_canceled`, `status`, `customer_name`, `customer_phone`, `customer_address`, `comment`, `total_price`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 0, 'PENDING', 'Asikur', '197799', 'Dhaka', 'Ok', 540.00, 1, '2021-01-28 18:13:05', '2021-01-28 18:13:05');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `unit_price` double(15,2) NOT NULL,
  `qty` double(10,2) NOT NULL,
  `total_amount` double(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `unit_price`, `qty`, `total_amount`) VALUES
(1, 1, 7, 45.00, 12.00, 540.00);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Najir Shail Rice (5KG)', NULL, '312', '1.jpg', NULL, NULL),
(2, 1, 'Minicat Rice (5KG)', NULL, '310', '6.jpg', NULL, NULL),
(3, 1, 'Pure Ata (1KG)', NULL, '35', '18.jpg', NULL, NULL),
(4, 1, 'Holud (500gm)', NULL, '80', '4.jpg', NULL, NULL),
(5, 1, 'Holud (250gm)', NULL, '35', '4.jpg', NULL, NULL),
(6, 1, 'Morich (500gm)', NULL, '90', '13.jpg', NULL, NULL),
(7, 1, 'Morich (250gm)', '', '45', '13.jpg', NULL, NULL),
(8, 1, 'Moshla (250gm)', '', '55', '34.jpg', NULL, NULL),
(9, 1, 'Pure Salt (1KG)', NULL, '35', '19.jpg', NULL, NULL),
(10, 1, 'Minicat Rice (25KG)', NULL, '2200', '20.jpg', NULL, NULL),
(11, 1, 'Cooking Oil (5KG)', NULL, '550', '22.jpg', NULL, NULL),
(12, 2, 'Cream Biscuit', NULL, '8', '23.jpg', NULL, NULL),
(13, 2, 'Dry Cake', NULL, '8', '24.jpg', NULL, NULL),
(14, 2, 'Cream Mango', NULL, '12', '25.jpg', NULL, NULL),
(15, 2, 'Milk Bread', NULL, '28', '26.jpg', NULL, NULL),
(16, 2, 'Sandwich Bread', NULL, '35', '27.jpg', NULL, NULL),
(17, 2, 'Energy Bread', NULL, '24', '28.jpg', NULL, NULL),
(18, 3, 'Energy Milk Powder (100gm)', NULL, '25', '2.jpg', NULL, NULL),
(19, 3, 'Full Cream Milk (500gm)', NULL, '45', '17.jpg', NULL, NULL),
(20, 3, 'Chocolate Milk', NULL, '18', '29.jpg', NULL, NULL),
(21, 3, 'Dairy Chocolate', NULL, '12', '30.jpg', NULL, NULL),
(22, 3, 'Energy Milk Powder (500gm)', NULL, '418', '14.jpg', NULL, NULL),
(23, 4, 'Dal Vaja', NULL, '5', '7.jpg', NULL, NULL),
(24, 4, 'Motor Vaja', NULL, '5', '8.jpg', NULL, NULL),
(25, 4, 'Chanachur Vaja', '', '5', '9.jpg', NULL, NULL),
(26, 4, 'Potato Chips', NULL, '10', '11.jpg', NULL, NULL),
(27, 4, 'Ring Chips', NULL, '15', '15.jpg', NULL, NULL),
(28, 4, 'Potato Chips', NULL, '10', '12.jpg', NULL, NULL),
(29, 5, 'White Sugar', NULL, '40', '35.jpg', NULL, NULL),
(30, 6, 'Tea (200gm)', NULL, '18', '16.jpg', NULL, NULL),
(31, 7, 'Pure Water (500ml)', NULL, '10', '36.jpg', NULL, NULL),
(32, 7, 'Cola (500ml)', NULL, '22', '31.jpg', NULL, NULL),
(33, 7, 'Energy Drink', NULL, '18', '33.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales_target_assignments`
--

CREATE TABLE `sales_target_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `target_month` enum('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec') COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_year` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_target_assignments`
--

INSERT INTO `sales_target_assignments` (`id`, `user_id`, `target_month`, `target_year`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 'Jan', '2021', 5000.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('ADMIN','SR','GM','AGM','DEALER','DIPO','RM') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'SR',
  `status` enum('ACTIVE','INACTIVE','BANNED') COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `status`, `name`, `email`, `phone`, `password`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN', 'ACTIVE', 'Admin', 'admin@gmail.com', NULL, '$2y$10$uq9F8mf15xTydqCrnWHsmepYS.cGLyNNZ2NNSIY7MSsXt/.c1rtne', NULL, NULL),
(2, 'SR', 'ACTIVE', 'Rahim Sr', 'rahim@gmail.com', NULL, '$2y$10$nW0RMM3r7kcHeoA3wPv35OODCHE0LRRazepCZd7I79G6ilcs9OMIi', NULL, NULL);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_target_assignments`
--
ALTER TABLE `sales_target_assignments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sales_target_assignments_target_month_target_year_unique` (`target_month`,`target_year`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `sales_target_assignments`
--
ALTER TABLE `sales_target_assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
