-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2020 at 07:42 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel-shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_ename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `cat_ename`, `parent_id`, `img`, `created_at`, `updated_at`) VALUES
(4, 'آموزش طراحی سایت', 'web app', 0, NULL, NULL, NULL),
(8, 'آموزش laravel', 'laravel', 4, NULL, '2020-09-30 12:44:58', '2020-09-30 12:44:58'),
(9, 'آموزش php', 'php', 4, NULL, '2020-09-30 12:45:32', '2020-09-30 12:45:32'),
(10, 'آموزش اپلیکیشن موبایل', 'phone', 0, NULL, '2020-09-30 12:46:29', '2020-09-30 12:46:29'),
(12, 'آموزش فلاتر', 'fluter', 10, NULL, '2020-09-30 13:42:29', '2020-09-30 13:42:29'),
(14, 'آموزش پایگاه داده', 'database1', 0, NULL, '2020-10-03 09:36:38', '2020-10-03 09:36:38'),
(15, 'آموزش  mysql', 'mysql', 14, NULL, '2020-10-03 09:46:23', '2020-10-03 09:46:23'),
(27, 'آموزش اندروید', 'android1', 10, NULL, '2020-10-03 11:13:54', '2020-10-03 11:14:32');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `parent_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `status` int(255) NOT NULL,
  `created_at` int(255) DEFAULT NULL,
  `updated_at` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `content`, `parent_id`, `product_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'شیما رحمانی', 'shima1366_rahmani@yahoo.com', 'تست پیام', 0, 25, 1, 1603206294, 1603276700),
(4, 'شیما رحمانی', 'shima1366_rahmani@yahoo.com', 'پیام آزمایشی سوم', 0, 24, 1, 1603222560, 1603276698),
(5, 'مدیر', 'shima1366_rahmani@yahoo.com', 'با سلام.\r\nحتما', 4, 24, 1, 1603282348, 1603282348),
(6, 'مدیر', 'shima1366_rahmani@yahoo.com', 'با سلام حتما', 1, 25, 1, 1603282453, 1603282453),
(7, 'مدیر', 'shima1366_rahmani@yahoo.com', 'شاید', 4, 24, 1, 1603282516, 1603282516),
(8, 'طاهره رحمانی', 'tss346raha@gmail.com', 'تست پیام', 0, 25, 1, 1603284114, 1603284155);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `discount_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_value` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `discount_name`, `discount_value`, `created_at`, `updated_at`) VALUES
(2, 'کد دوم', 10, '2020-10-25 15:06:01', '2020-10-25 15:06:01'),
(3, 'laravel', 50, '2020-11-02 14:49:37', '2020-11-02 14:49:37');

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
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2020_10_25_175105_create_discounts_table', 2),
(14, '2020_10_25_190516_create_statistics_table', 3),
(15, '2020_10_25_190719_create_statistics_user_table', 3),
(16, '2020_11_02_191947_create_orders_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RefId` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saleReferenceId` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_read` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `fname`, `lname`, `email`, `mobile`, `time`, `date`, `product_id`, `number_product`, `payment_status`, `RefId`, `saleReferenceId`, `zip_code`, `address`, `order_read`, `total_price`, `price`, `user_id`) VALUES
(3, 'شیما', 'رحمانی', 'shima1366_rahmani@yahoo.com', '09102929468', 1604948327, '1399-8-19', '27,', '1,', 'ok', 'a', NULL, NULL, NULL, 'no', 120000, 120000, 1),
(4, 'طاهره', 'رحمانی', 'tss346raha@gmail.com', '09102929468', 1605105345, '1399-8-21', '27,24,', '1,2,', 'ok', 'a', '', NULL, NULL, 'no', 360000, 180000, 3);

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
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_url` varchar(255) NOT NULL,
  `text` text DEFAULT NULL,
  `view_number` int(11) NOT NULL,
  `show_status` int(1) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `order_number` int(11) NOT NULL,
  `links` text DEFAULT NULL,
  `tag` text DEFAULT NULL,
  `img` varchar(1000) DEFAULT NULL,
  `course_time` varchar(100) DEFAULT NULL,
  `download_file_number` int(3) DEFAULT NULL,
  `download_file_size` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `title_url`, `text`, `view_number`, `show_status`, `price`, `order_number`, `links`, `tag`, `img`, `course_time`, `download_file_number`, `download_file_size`, `created_at`, `updated_at`) VALUES
(19, 'دوره اندروید', 'دوره-اندروید', NULL, 0, 1, 120000, 0, NULL, NULL, 'upload/1604259377.jpg', NULL, NULL, NULL, '2020-10-05 10:13:29', '2020-11-01 19:36:28'),
(23, 'دوره php', 'دوره-php', NULL, 34, 1, 120000, 0, NULL, NULL, 'upload/1602182096.png', '12 ساعت', NULL, NULL, '2020-10-05 12:31:09', '2020-10-13 15:09:33'),
(24, 'دوره html', 'دوره-html', NULL, 107, 1, 120000, 0, NULL, NULL, 'upload/1602181871.png', '12 ساعت', 5, NULL, '2020-10-05 12:31:45', '2020-11-11 14:21:19'),
(25, 'دوره لاراول', 'دوره-لاراول', NULL, 198, 1, 0, 0, NULL, NULL, 'upload/1602182068.png', '12 ساعت', NULL, NULL, '2020-10-05 12:46:31', '2020-11-09 14:22:52'),
(26, 'دوره فلاتر', 'دوره-فلاتر', NULL, 0, 0, 120000, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-05 12:54:40', '2020-10-05 12:54:40'),
(27, 'دوره mysql', 'دوره-mysql', NULL, 22, 1, 120000, 0, NULL, NULL, 'upload/1604259453.png', NULL, NULL, NULL, '2020-10-05 12:55:40', '2020-11-11 14:21:10'),
(28, 'دوره sql server', 'دوره-sql-server', NULL, 8, 0, 120000, 0, NULL, NULL, 'upload/1601915226.jpg', NULL, NULL, NULL, '2020-10-05 12:57:06', '2020-10-12 17:52:58');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `product_id`, `category_id`) VALUES
(61, 26, 10),
(62, 26, 12),
(69, 24, 4),
(70, 24, 8),
(73, 23, 4),
(74, 23, 9),
(75, 25, 4),
(76, 25, 8),
(77, 28, 14),
(78, 28, 15),
(81, 19, 10),
(82, 19, 27),
(83, 27, 14),
(84, 27, 15);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(225) NOT NULL,
  `option_value` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `option_name`, `option_value`) VALUES
(1, 'terminalid', '1'),
(2, 'username', '2'),
(3, 'password', '4');

-- --------------------------------------------------------

--
-- Table structure for table `statistics`
--

CREATE TABLE `statistics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view` int(11) NOT NULL,
  `total_view` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statistics`
--

INSERT INTO `statistics` (`id`, `year`, `month`, `day`, `view`, `total_view`) VALUES
(1, '1399', '8', '19', 2, 24),
(2, '1399', '8', '19', 2, 24),
(3, '1399', '8', '19', 2, 24),
(4, '1399', '8', '19', 2, 24),
(5, '1399', '8', '19', 2, 24),
(6, '1399', '8', '20', 1, 24),
(7, '1399', '8', '21', 1, 24);

-- --------------------------------------------------------

--
-- Table structure for table `statistics_user`
--

CREATE TABLE `statistics_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statistics_user`
--

INSERT INTO `statistics_user` (`id`, `year`, `month`, `day`, `user_ip`) VALUES
(1, '1399', '8', '04', '::2'),
(2, '1399', '8', '04', '::1'),
(3, '1399', '8', '11', '::1'),
(4, '1399', '8', '12', '::1'),
(5, '1399', '8', '13', '::1'),
(6, '1399', '8', '19', '::1'),
(7, '1399', '8', '19', '::1'),
(8, '1399', '8', '20', '::1'),
(9, '1399', '8', '21', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `email_verified_at`, `password`, `username`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'شیما', 'رحمانی', 'shima1366_rahmani@yahoo.com', NULL, '$2y$10$5Ae4Te6HoEe9kamRfFAU2eCaC0E.dHtkvuguK1SSX19Ono18gAMfG', 'text', 'admin', 'VavMCxDe5WU7lOjoncJDTmObMF5Py6O8B11BRhLfXnA6HakL7UuYDEGvFYlK', '2020-10-08 15:56:45', '2020-11-02 19:19:03'),
(2, 'شیما', 'رحمانی', 'shima_rahmani@yahoo.com', NULL, '$2y$10$7v0abgEGEb4TimADIXWlfucyomOqtlLUGxAaP/mhxfob37Kq31lpO', NULL, 'user', 'p0J4rb1QP3rYoB9DoNuGmQRPETe9nhPzJ9Xh1jny4Erz4Id5BqCWhpzwuYAg', '2020-10-10 10:58:25', '2020-11-01 16:44:49'),
(3, 'طاهره', 'رحمانی', 'tss346raha@gmail.com', NULL, '$2y$10$kH1.biqjATBe07G0ZV8QnuXZnkGhK218J3DNsVGpHsDoCR/mKppMm', NULL, 'user', 'maZZrUIUikuxv5sNpT9xEvhj1oMzIuOeBsbc2cBN61l5FJQM3PsZMnHBv0rL', '2020-10-10 11:47:12', '2020-11-02 15:11:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
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
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statistics_user`
--
ALTER TABLE `statistics_user`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `statistics_user`
--
ALTER TABLE `statistics_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
