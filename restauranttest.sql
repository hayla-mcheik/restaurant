-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2024 at 12:44 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restauranttest`
--

-- --------------------------------------------------------

--
-- Table structure for table `applied_offers`
--

CREATE TABLE `applied_offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_item_id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `discount_value` decimal(10,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `menu_item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `offer_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_item_menu_item`
--

CREATE TABLE `cart_item_menu_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_item_id` bigint(20) UNSIGNED NOT NULL,
  `menu_item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `restaurant_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'upload/restaurant/gallery/170379605225292.jpeg', NULL, '2023-12-28 18:40:52'),
(2, 2, 'upload/restaurant/gallery/170358854428520.jpg', '2023-12-26 09:02:24', '2023-12-26 09:02:24'),
(3, 2, 'upload/restaurant/gallery/170358873410597.jpg', '2023-12-26 09:05:24', '2023-12-26 09:05:34'),
(4, 1, 'upload/restaurant/gallery/17037960417427.jpeg', '2023-12-28 17:58:19', '2023-12-28 18:40:41'),
(5, 1, 'upload/restaurant/gallery/170379606349912.jpeg', '2023-12-28 17:58:33', '2023-12-28 18:41:03'),
(8, 1, 'upload/restaurant/menucategories/170436126533871.png', '2024-01-10 06:53:02', '2024-01-10 06:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_categories`
--

CREATE TABLE `menu_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(10) UNSIGNED DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_categories`
--

INSERT INTO `menu_categories` (`id`, `restaurant_id`, `name`, `slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'soup', 'soup', 'upload/restaurant/menucategories/170379585140288.jpg', 0, '2023-12-15 18:24:27', '2023-12-28 18:37:31'),
(3, 1, 'italian shawarma', 'italian-shawarma', 'upload/restaurant/menucategories/170379586216217.jpg', 0, '2023-12-28 11:20:13', '2023-12-28 18:37:42'),
(4, 2, 'burger', 'burger', 'upload/restaurant/menucategories/170379288026188.jpg', 0, '2023-12-28 17:48:00', '2023-12-28 17:48:00'),
(5, 2, 'pizza', 'pizza', 'upload/restaurant/menucategories/17037929023489.jpg', 0, '2023-12-28 17:48:22', '2023-12-28 17:48:22'),
(6, 2, 'soup', 'soup', 'upload/restaurant/menucategories/17037929326462.jpg', 0, '2023-12-28 17:48:52', '2023-12-28 17:48:52'),
(7, 2, 'potato', 'potato', 'upload/restaurant/menucategories/170379295248269.jpg', 0, '2023-12-28 17:49:12', '2023-12-28 17:49:12'),
(8, 1, 'erer', 'erer', 'upload/restaurant/menucategories/170436126533871.png', 0, '2024-01-04 07:41:05', '2024-01-04 07:41:05'),
(11, 1, 'menucategories', 'menucategories', 'upload/restaurant/menucategories/170436126533871.png', 0, '2024-01-10 06:53:02', '2024-01-10 06:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_category_id`, `name`, `slug`, `quantity`, `price`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'chinnese soup', 'chinese soup', 5, '20', 'upload/restaurant/menuitems/170379575821257.jpg', '2023-12-15 18:24:56', '2023-12-28 18:35:58'),
(4, 1, 'soup chines', 'soup chines', 2, '120', 'upload/restaurant/menuitems/170379576925163.jpg', '2023-12-28 10:25:38', '2023-12-28 18:36:09'),
(5, 3, 'shwarma', 'shawrama', 2, '5', 'upload/restaurant/menuitems/170379578131933.jpg', '2023-12-28 11:20:41', '2023-12-28 18:36:57'),
(7, 4, 'burger small', 'burger small', 4, '100', 'upload/restaurant/menuitems/170379299126845.jpg', '2023-12-28 17:49:51', '2023-12-28 17:49:51'),
(8, 4, 'burger big', 'burger big', 5, '100', 'upload/restaurant/menuitems/170379301946795.jpg', '2023-12-28 17:50:19', '2023-12-28 17:50:19'),
(9, 5, 'pizza small', 'pizza small', 2, '50', 'upload/restaurant/menuitems/170379305012561.jpg', '2023-12-28 17:50:50', '2023-12-28 17:50:50'),
(10, 5, 'pizza big', 'pizza big', 2, '50', 'upload/restaurant/menuitems/17037930826275.jpg', '2023-12-28 17:51:22', '2023-12-28 17:51:22'),
(11, 6, 'soup small', 'soup small', 2, '40', 'upload/restaurant/menuitems/17037931054566.jpg', '2023-12-28 17:51:45', '2023-12-28 17:51:45'),
(12, 6, 'soup big', 'soup big', 2, '30', 'upload/restaurant/menuitems/170379315142053.jpg', '2023-12-28 17:52:31', '2023-12-28 17:52:31'),
(13, 8, 'lklk', 'lklk', 10, '15', 'upload/restaurant/menuitems/170436131424578.png', '2024-01-04 07:41:54', '2024-01-04 07:41:54'),
(16, 1, 'burgerking', 'burgerking', 5, '20', 'upload/restaurant/menucategories/170436126533871.png', '2024-01-10 06:53:02', '2024-01-10 06:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `menu_item_offer`
--

CREATE TABLE `menu_item_offer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_item_id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_item_offer`
--

INSERT INTO `menu_item_offer` (`id`, `menu_item_id`, `offer_id`, `created_at`, `updated_at`) VALUES
(3, 1, 4, NULL, NULL),
(4, 4, 4, NULL, NULL);

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_12_05_084617_create_restaurant_categories_table', 1),
(7, '2023_12_05_093646_create_restaurant_table', 1),
(8, '2023_12_05_150539_create_menu_categories_table', 1),
(9, '2023_12_05_150548_create_menu_table', 1),
(10, '2023_12_05_150549_create_menu_items_table', 1),
(11, '2023_12_05_150558_create_orders_table', 1),
(12, '2023_12_05_150559_create_order_items_table', 1),
(13, '2023_12_16_191238_create_cart_items_table', 2),
(15, '2023_12_18_210742_add_address_to_users', 3),
(16, '2023_12_18_213236_create_user_addresses_table', 3),
(18, '2023_12_19_084336_create_gallery_table', 4),
(19, '2023_12_19_105209_create_wishlist_table', 5),
(20, '2023_12_27_103149_create_subscriptions_table', 6),
(25, '2023_12_27_120723_create_offers_table', 7),
(30, '2024_01_02_080944_add_to_cart_item_menu_item_table', 10),
(32, '2023_12_27_121359_create_menu_item_offer_table', 11),
(33, '2024_01_01_133829_create_applied_offers_table', 11),
(34, '2024_01_02_072608_create_cart_item_menu_item_table', 11),
(35, '2024_01_02_175231_create_wishlist_offer_table', 11),
(36, '2024_01_08_082555_add_token_to_users_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_type` enum('percentage','fixed_amount') COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_value` decimal(8,2) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `name`, `description`, `discount_type`, `discount_value`, `start_date`, `end_date`, `image`, `is_published`, `restaurant_id`, `created_at`, `updated_at`) VALUES
(4, 'big offer', 'lkjlkjl', 'fixed_amount', '30.00', '2024-01-02 00:00:00', '2024-01-11 00:00:00', 'upload/offers/170422919513692.jpg', 1, 1, '2024-01-02 18:59:55', '2024-01-04 08:02:06');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `order_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `deliverydate` date DEFAULT NULL,
  `status_message` text COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '0=pending,1=approve,2=rejected',
  `payment_mode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'token-name', '04c2f216017238788d2cd0fe6c2368725dbc3f8803937665baf1ffe00ab2ea30', '[\"*\"]', NULL, NULL, '2024-01-08 06:15:18', '2024-01-08 06:15:18'),
(2, 'App\\Models\\User', 1, 'token-name', 'a4fed160a6b285ff795d5cc830270d995efe25c0086d4d69517c468f5070dccc', '[\"*\"]', '2024-01-08 07:08:41', NULL, '2024-01-08 06:56:51', '2024-01-08 07:08:41'),
(3, 'App\\Models\\User', 1, 'token-name', '5fe75b9be15e33cd5b085abd83d24ffc3e91ec34af9e5e93cf2a65f7e0dcf4a8', '[\"*\"]', '2024-01-09 17:31:17', NULL, '2024-01-08 07:09:49', '2024-01-09 17:31:17'),
(4, 'App\\Models\\User', 36, 'token-name', '19a24c6c9782a321808be3be48d414c7fe7d5954bc1f6ff113ef70dd223ce3e9', '[\"*\"]', NULL, NULL, '2024-01-08 09:52:57', '2024-01-08 09:52:57'),
(5, 'App\\Models\\User', 36, 'token-name', 'b85555a036884b5bf50c8d7930762d045bf13dafe356f3649b1144bc9ca7e70f', '[\"*\"]', NULL, NULL, '2024-01-08 09:53:01', '2024-01-08 09:53:01');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `openninghours` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `closinghours` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliverytime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `popular` tinyint(4) DEFAULT 0,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coverimage` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `category_id`, `user_id`, `name`, `slug`, `address`, `map`, `phone`, `email`, `openninghours`, `closinghours`, `deliverytime`, `status`, `popular`, `image`, `coverimage`, `created_at`, `updated_at`) VALUES
(1, 3, 3, 'aljwad', 'aljwad', 'badaro', 'https://hello.com', '78913139', 'dkj@gmai.com', 'Monday  till  friday: from 8 to 5:30\r\nsunday : from 10 to 4', 'saturday', '40-60', 0, 1, 'upload/restaurant/170379519317652.jpeg', 'upload/restaurant/17037951931323.jpeg', '2023-12-15 18:23:56', '2024-01-04 08:34:24'),
(2, 2, 15, 'beit jedde', 'beit jedde', 'bsaba', 'https://hello.com', '78913139', 'restaurant@gmail.com', 'monday -> friday :from 11:am to 11:pm\r\nsaturday and Sunday: from 11:am to 5:pm', NULL, '60-90', 0, 0, 'upload/restaurant/170379526418971.jpeg', 'upload/restaurant/170379526426217.jpeg', '2023-12-26 07:04:46', '2023-12-28 18:27:44');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_categories`
--

CREATE TABLE `restaurant_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(10) UNSIGNED DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_categories`
--

INSERT INTO `restaurant_categories` (`id`, `name`, `slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'chineese', 'chineese', 'upload/restaurantcategory/17037955726286.jpg', 0, '2023-12-15 18:03:22', '2023-12-28 18:32:52'),
(2, 'indian', 'indian', 'upload/restaurantcategory/170379554849977.jpg', 0, '2023-12-15 18:03:39', '2023-12-28 18:32:28'),
(3, 'turkish', 'turkish', 'upload/restaurantcategory/17037955915066.jpg', 0, '2023-12-28 16:43:17', '2023-12-28 18:33:11'),
(4, 'lebanese', 'lebanese', 'upload/restaurantcategory/170379564620310.jpg', 0, '2023-12-28 18:34:06', '2023-12-28 18:34:06'),
(8, 'foodhome', 'foodhome', 'upload/restaurant/menucategories/170436126533871.png', 0, '2024-01-10 06:53:02', '2024-01-10 06:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `email`, `created_at`, `updated_at`) VALUES
(16, 'mcheikhayla26@gmail.com', '2024-01-08 09:53:45', '2024-01-08 09:53:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currentemail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currentpassword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_as` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=admin,2=manager,3=user',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending' COMMENT 'pending, approved',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `lname`, `image`, `currentemail`, `currentpassword`, `phone`, `info`, `role_as`, `status`, `remember_token`, `created_at`, `updated_at`, `address`, `api_token`) VALUES
(1, 'user', 'user@gmail.com', '2023-12-17 13:59:38', '$2y$12$H.o.vaTTBd2oOe2Nj6TQ6OhwbyubRe2Gnh301/uqoL0Nm2/G9kPpm', NULL, 'upload/user/170435649526937.jpeg', NULL, NULL, NULL, NULL, 3, 'active', NULL, '2023-12-15 18:00:36', '2023-12-18 19:26:15', NULL, NULL),
(2, 'admin', 'admin@gmail.com', NULL, '$2y$12$H.o.vaTTBd2oOe2Nj6TQ6OhwbyubRe2Gnh301/uqoL0Nm2/G9kPpm', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'pending', NULL, '2023-12-15 18:02:09', '2023-12-15 18:02:09', NULL, NULL),
(3, 'manager', 'manager@gmail.com', NULL, '$2y$12$H.o.vaTTBd2oOe2Nj6TQ6OhwbyubRe2Gnh301/uqoL0Nm2/G9kPpm', NULL, NULL, NULL, NULL, '78913139', 'business restaurant', 2, 'active', NULL, '2023-12-15 18:04:10', '2023-12-26 09:14:33', NULL, NULL),
(14, 'lala', 'lala@gmail.com', '2023-12-25 21:36:16', '$2y$12$Tm4YW397y4iADsXz8DgKyuBxBrp6nG0TFjRni5LJg5tIeBR1tHGKi', NULL, 'upload/user/170360062525109.jpg', NULL, NULL, '78913139', NULL, 3, 'active', NULL, '2023-12-25 19:35:51', '2023-12-26 12:23:45', NULL, NULL),
(15, 'beitjeddeh', 'restaurant@gmail.com', NULL, '$2y$12$H.o.vaTTBd2oOe2Nj6TQ6OhwbyubRe2Gnh301/uqoL0Nm2/G9kPpm', NULL, NULL, NULL, NULL, '78913139', 'restaurant food description', 2, 'active', NULL, '2023-12-26 06:19:16', '2023-12-26 09:12:10', NULL, NULL),
(16, 'res', 'res@gmail.com', NULL, '$2y$12$teoC6IngrzlTWeZ2/8hkhOJ0EfriSx4W4lqhEddd7oy198zyll1hO', NULL, NULL, NULL, NULL, '78913139', 'res business', 2, 'active', NULL, '2023-12-26 06:36:38', '2023-12-26 06:36:38', NULL, NULL),
(17, 'layla', 'layla@gmail.com', '2024-01-04 07:00:47', '$2y$12$55vj6FuxUtavXt9pnsfiEe8uxAG6kS.Css2hUkkqTSgYnQDRn7b9i', NULL, NULL, NULL, NULL, '78913139', NULL, 3, 'pending', NULL, '2024-01-04 05:00:08', '2024-01-04 05:00:08', NULL, NULL),
(18, 'Roy Abou Zeid', 'abouzeidroy@gmail.com', '2024-01-04 08:16:02', '$2y$12$ADzJf3hZBMQz6HVu/oBIDO/dOmduZLrFnfH8UpMNjEOlMVsGAPtny', NULL, 'upload/user/170435649526937.jpeg', NULL, NULL, '71884898', 'info lorem ipsum', 3, 'pending', NULL, '2024-01-04 06:15:29', '2024-01-04 06:22:09', NULL, NULL),
(36, 'hayla', 'mcheikhayla26@gmail.com', NULL, '$2y$12$0xr3lArmCUYirsYDbL7oc.HNiLgcqVEfOtIGbWan7NzESxlfeq7j.', NULL, NULL, NULL, NULL, '78913139', NULL, 1, 'active', NULL, '2024-01-08 09:52:25', '2024-01-08 09:52:25', NULL, NULL),
(55, 'Roy', 'abouzeidroyadmin@gmail.com', NULL, '$2y$12$6hLayDD93B.9a2JQxTSoZO0H02vP2osK2OG1MJUnYItCgqGXt7fyG', NULL, NULL, NULL, NULL, '12345678', 'description', 1, 'active', NULL, '2024-01-10 06:53:02', '2024-01-10 06:53:02', NULL, NULL),
(56, 'Roymanager', 'abouzeidroymanager@gmail.com', NULL, '$2y$12$5CiD3EvCYTOUDEuvn/jv4eGE/6he8ncZ.3k8TAdFGIc3jOYsUImoK', NULL, NULL, NULL, NULL, '12345678', 'description', 2, 'active', NULL, '2024-01-10 06:53:02', '2024-01-10 06:53:02', NULL, NULL),
(57, 'Royuser', 'abouzeidroyuser@gmail.com', NULL, '$2y$12$ShZSwPoaiJ8VKU9gHIIyO.rwupZDlgXb6SuW/SUFDYOeHW4.v5i3S', NULL, NULL, NULL, NULL, '12345678', 'description', 3, 'active', NULL, '2024-01-10 06:53:02', '2024-01-10 06:53:02', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `label`, `address`, `created_at`, `updated_at`) VALUES
(1, 1, 'work', '291/d/1, 291, Jawaddi Kalan, Ludhiana, Punjab 141002, lebanon', NULL, '2023-12-19 06:35:30'),
(5, 1, 'home', '291/d/1, 291, Jawaddi Kalan, Ludhiana, Punjab 141002, lebanon', '2023-12-20 09:07:01', '2023-12-20 09:07:01');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `menu_item_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `menu_item_id`, `created_at`, `updated_at`) VALUES
(6, 1, 5, '2024-01-02 15:29:54', '2024-01-02 15:29:54'),
(13, 17, 5, '2024-01-04 05:27:01', '2024-01-04 05:27:01'),
(14, 17, 4, '2024-01-04 05:27:34', '2024-01-04 05:27:34'),
(15, 17, 1, '2024-01-04 05:27:50', '2024-01-04 05:27:50'),
(18, 1, 4, '2024-01-10 05:57:53', '2024-01-10 05:57:53'),
(19, 1, 1, '2024-01-10 05:57:58', '2024-01-10 05:57:58');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_offer`
--

CREATE TABLE `wishlist_offer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wishlist_model_id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applied_offers`
--
ALTER TABLE `applied_offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applied_offers_cart_item_id_foreign` (`cart_item_id`),
  ADD KEY `applied_offers_offer_id_foreign` (`offer_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_user_id_foreign` (`user_id`),
  ADD KEY `cart_items_menu_item_id_foreign` (`menu_item_id`),
  ADD KEY `cart_items_offer_id_foreign` (`offer_id`);

--
-- Indexes for table `cart_item_menu_item`
--
ALTER TABLE `cart_item_menu_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_item_menu_item_cart_item_id_foreign` (`cart_item_id`),
  ADD KEY `cart_item_menu_item_menu_item_id_foreign` (`menu_item_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gallery_restaurant_id_foreign` (`restaurant_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_categories`
--
ALTER TABLE `menu_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_categories_restaurant_id_foreign` (`restaurant_id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_category_id_foreign` (`menu_category_id`);

--
-- Indexes for table `menu_item_offer`
--
ALTER TABLE `menu_item_offer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_item_offer_menu_item_id_foreign` (`menu_item_id`),
  ADD KEY `menu_item_offer_offer_id_foreign` (`offer_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offers_restaurant_id_foreign` (`restaurant_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_restaurant_id_foreign` (`restaurant_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_category_id_foreign` (`category_id`),
  ADD KEY `restaurant_user_id_foreign` (`user_id`);

--
-- Indexes for table `restaurant_categories`
--
ALTER TABLE `restaurant_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscriptions_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_token_unique` (`api_token`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlist_user_id_foreign` (`user_id`),
  ADD KEY `wishlist_menu_item_id_foreign` (`menu_item_id`);

--
-- Indexes for table `wishlist_offer`
--
ALTER TABLE `wishlist_offer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlist_offer_wishlist_model_id_foreign` (`wishlist_model_id`),
  ADD KEY `wishlist_offer_offer_id_foreign` (`offer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applied_offers`
--
ALTER TABLE `applied_offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=328;

--
-- AUTO_INCREMENT for table `cart_item_menu_item`
--
ALTER TABLE `cart_item_menu_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_categories`
--
ALTER TABLE `menu_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `menu_item_offer`
--
ALTER TABLE `menu_item_offer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `restaurant_categories`
--
ALTER TABLE `restaurant_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `wishlist_offer`
--
ALTER TABLE `wishlist_offer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applied_offers`
--
ALTER TABLE `applied_offers`
  ADD CONSTRAINT `applied_offers_cart_item_id_foreign` FOREIGN KEY (`cart_item_id`) REFERENCES `cart_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applied_offers_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart_item_menu_item`
--
ALTER TABLE `cart_item_menu_item`
  ADD CONSTRAINT `cart_item_menu_item_cart_item_id_foreign` FOREIGN KEY (`cart_item_id`) REFERENCES `cart_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_item_menu_item_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_categories`
--
ALTER TABLE `menu_categories`
  ADD CONSTRAINT `menu_categories_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`);

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_category_id_foreign` FOREIGN KEY (`menu_category_id`) REFERENCES `menu_categories` (`id`);

--
-- Constraints for table `menu_item_offer`
--
ALTER TABLE `menu_item_offer`
  ADD CONSTRAINT `menu_item_offer_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_item_offer_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD CONSTRAINT `restaurant_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `restaurant_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `restaurant_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `wishlist_offer`
--
ALTER TABLE `wishlist_offer`
  ADD CONSTRAINT `wishlist_offer_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_offer_wishlist_model_id_foreign` FOREIGN KEY (`wishlist_model_id`) REFERENCES `wishlist` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
