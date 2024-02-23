-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2024 at 07:25 PM
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
-- Database: `test_job`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_settings`
--

CREATE TABLE `admin_settings` (
  `id` int(12) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `developed_by` varchar(255) DEFAULT NULL,
  `developer_site` varchar(255) DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `thumb_logo` text DEFAULT NULL,
  `fav_icon` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_settings`
--

INSERT INTO `admin_settings` (`id`, `title`, `developed_by`, `developer_site`, `logo`, `thumb_logo`, `fav_icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Laravel 08 CMS', 'Dew Hunt', 'http://dewhunt.com/', 'public/admin/assets/images/img_400160712.svg', 'public/admin/assets/images/img_766574781.svg', 'public/admin/assets/images/img_540235919.svg', 1, '2023-04-13 15:10:05', '2023-04-13 15:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `author`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Book 00', 'Dew Hunt', 'This is a book 00 description.', 'public/images/books/img_549404290.jpg', 1, '2024-02-22 16:58:13', '2024-02-21 18:00:00'),
(2, 'Book 01', 'Salman', 'This is a book 01 description.', 'public/images/books/img_1330929512.jpg', 1, '2024-02-22 17:00:00', '2024-02-22 17:19:25');

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
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `parent_menu` int(11) DEFAULT NULL,
  `menu_name` varchar(255) DEFAULT NULL,
  `menu_link` varchar(255) DEFAULT NULL,
  `menu_icon` varchar(255) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_menu`, `menu_name`, `menu_link`, `menu_icon`, `order_by`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Dashboard', 'admin.index', 'feather icon-home', 1, 1, NULL, '2023-04-13 13:24:39'),
(2, NULL, 'User Management', NULL, 'feather icon-menu', 3, 1, NULL, '2023-04-12 18:00:00'),
(4, 2, 'User Role', 'user_role.index', NULL, 1, 1, NULL, NULL),
(5, 2, 'User', 'user.index', NULL, 2, 1, NULL, NULL),
(6, 2, 'Menu Action Types', 'menu_action_type.index', NULL, 3, 1, NULL, NULL),
(7, 2, 'Menus', 'menu.index', NULL, 4, 1, NULL, NULL),
(9, 2, 'Menu Action', 'menu_action.index', 'ti-layout-grid2', 5, 1, '2021-01-28 13:45:13', '2021-01-28 13:57:03'),
(18, NULL, 'Admin Settings', 'admin_settings.index', 'feather icon-menu', 2, 1, '2023-04-13 13:35:11', '2023-04-13 18:00:00'),
(20, NULL, 'Books', 'book.index', 'feather icon-menu', 4, 1, '2024-02-22 16:14:02', '2024-02-21 18:00:00'),
(21, NULL, 'Reader', 'reader.index', 'feather icon-menu', 5, 1, '2024-02-22 17:42:18', '2024-02-22 17:42:18');

-- --------------------------------------------------------

--
-- Table structure for table `menu_actions`
--

CREATE TABLE `menu_actions` (
  `id` int(11) NOT NULL,
  `parent_menu_id` int(11) DEFAULT NULL,
  `menu_type_id` int(11) DEFAULT NULL,
  `action_name` varchar(255) DEFAULT NULL,
  `action_link` varchar(255) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_actions`
--

INSERT INTO `menu_actions` (`id`, `parent_menu_id`, `menu_type_id`, `action_name`, `action_link`, `order_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 'Add New User Role', 'user_role.add', 1, 1, NULL, NULL),
(2, 4, 2, 'Edit User Role', 'user_role.edit', 2, 1, NULL, NULL),
(3, 4, 3, 'Status', 'user_role.status', 3, 1, NULL, NULL),
(4, 4, 4, 'Delete', 'user_role.delete', 5, 1, NULL, NULL),
(5, 4, 5, 'User\'s Role Menu Permission', 'user_role.permission', 4, 1, NULL, NULL),
(6, 5, 1, 'Add New User', 'user.add', 1, 1, NULL, NULL),
(7, 5, 2, 'Edit User', 'user.edit', 2, 1, NULL, '2021-02-04 13:37:49'),
(8, 5, 3, 'Status', 'user.status', 7, 1, NULL, '2021-02-06 13:20:00'),
(9, 5, 5, 'Users Menu Permission', 'user.permission', 4, 1, NULL, '2021-02-04 13:41:09'),
(10, 5, 4, 'Delete', 'user.delete', 6, 1, NULL, '2021-02-06 13:19:43'),
(11, 6, 1, 'Add New Menu Action Type', 'menu_action_type.add', 1, 1, NULL, NULL),
(12, 6, 2, 'Edit Menu Action Type', 'menu_action_type.edit', 2, 1, NULL, NULL),
(13, 6, 3, 'Status', 'menu_action_type.status', 3, 1, NULL, NULL),
(14, 6, 4, 'Delete', 'menu_action_type.delete', 4, 1, NULL, NULL),
(15, 7, 1, 'Add New Menu', 'menu.add', 1, 1, NULL, NULL),
(16, 7, 2, 'Edit Menu', 'menu.edit', 2, 1, NULL, NULL),
(17, 7, 3, 'Status', 'menu.status', 3, 1, NULL, NULL),
(18, 7, 8, 'View Menu Action', 'menu.view', 4, 1, NULL, NULL),
(19, 7, 4, 'Delete', 'menu.delete', 5, 1, NULL, NULL),
(22, 9, 1, 'Add New Menu Action', 'menu_action.add', 1, 1, '2021-01-31 14:16:25', '2021-02-01 16:04:57'),
(23, 9, 2, 'Edit Menu Action', 'menu_action.edit', 2, 1, '2021-02-01 13:22:35', '2021-02-01 13:22:35'),
(24, 9, 3, 'Status', 'menu_action.status', 3, 1, '2021-02-01 13:23:45', '2021-02-01 13:23:45'),
(25, 9, 4, 'Delete', 'menu_action.delete', 4, 1, '2021-02-01 13:24:16', '2021-02-01 13:24:16'),
(26, 9, 12, 'Menu Action Info', 'menu_action.getMenuActionInfo', 5, 1, '2021-02-02 13:27:56', '2021-02-02 13:27:56'),
(29, 5, 8, 'View', 'user.view', 3, 1, '2021-02-05 13:39:39', '2021-02-05 13:40:12'),
(30, 5, 6, 'Change Password', 'user.changePassword', 5, 1, '2021-02-06 13:17:39', '2021-02-06 13:19:17'),
(40, 18, 1, 'Add', 'admin_settings.add', 1, 1, '2023-04-13 13:36:05', '2024-02-21 18:00:00'),
(41, 18, 2, 'Edit', 'admin_settings.edit', 2, 1, '2023-04-13 13:36:17', '2023-04-13 13:36:17'),
(42, 18, 3, 'Status', 'admin_settings.status', 3, 1, '2023-04-13 13:36:30', '2023-04-13 13:36:30'),
(43, 18, 4, 'Delete', 'admin_settings.delete', 4, 1, '2023-04-13 13:36:40', '2023-04-13 13:36:40'),
(48, 20, 1, 'Add', 'book.add', 1, 1, '2024-02-22 16:37:36', '2024-02-22 16:37:36'),
(49, 20, 2, 'Edit', 'book.edit', 2, 1, '2024-02-22 16:40:27', '2024-02-22 16:40:27'),
(50, 20, 3, 'Status', 'book.status', 3, 1, '2024-02-22 16:44:22', '2024-02-22 16:44:22'),
(51, 20, 4, 'Delete', 'book.delete', 4, 1, '2024-02-22 16:44:40', '2024-02-22 16:44:40'),
(52, 21, 1, 'Add', 'reader.add', 1, 1, '2024-02-22 17:42:37', '2024-02-22 17:42:37'),
(53, 21, 2, 'Edit', 'reader.edit', 2, 1, '2024-02-22 17:42:49', '2024-02-22 17:42:49'),
(54, 21, 3, 'Status', 'reader.status', 3, 1, '2024-02-22 17:43:04', '2024-02-22 17:43:04'),
(55, 21, 4, 'Delete', 'reader.delete', 4, 1, '2024-02-22 17:43:15', '2024-02-22 17:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `menu_action_types`
--

CREATE TABLE `menu_action_types` (
  `id` int(11) NOT NULL,
  `action_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_action_types`
--

INSERT INTO `menu_action_types` (`id`, `action_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Add', 1, NULL, '2021-02-02 12:50:23'),
(2, 2, 'Edit', 1, NULL, NULL),
(3, 3, 'Publication Status', 1, NULL, NULL),
(4, 4, 'Delete', 1, NULL, NULL),
(5, 5, 'Permission', 1, NULL, NULL),
(6, 6, 'Change Password', 1, NULL, NULL),
(7, 7, 'View Popup', 1, NULL, NULL),
(8, 8, 'View', 1, NULL, NULL),
(9, 9, 'Shipping Charge', 1, NULL, NULL),
(10, 10, 'Product List', 1, NULL, NULL),
(11, 11, 'View PDF', 1, NULL, NULL),
(12, 12, 'Ajax Link', 1, '2021-02-02 13:16:36', '2021-02-02 13:26:46'),
(14, 13, 'Others', 1, '2021-11-17 17:07:46', '2021-11-17 17:07:46');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `readers`
--

CREATE TABLE `readers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `readers`
--

INSERT INTO `readers` (`id`, `first_name`, `last_name`, `email`, `phone`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dew', 'Hunt', 'dew.fog1553@gmail.com', '01317243494', 1, '2024-02-22 17:50:13', '2024-02-21 18:00:00'),
(2, 'Salman', 'Sabbir', 'salman.giantssoft@gmail.com', '01317243496', 1, '2024-02-22 17:52:54', '2024-02-22 17:57:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_role_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `permission` text DEFAULT NULL,
  `action_permission` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_role_id`, `name`, `user_name`, `email`, `permission`, `action_permission`, `image`, `password`, `status`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 2, 'Admin', 'admin', 'admin@gmail.com', '1', '', 'public/images/users/7fBtXPgc4SWaav8hKlZGDUbTYwNIOwFTet8VBPZA.jpg', '$2y$10$NfOfPjpkCe6q/sN1NfENa.0encu3G.9fSgPJEEHRTZaotINBMHKU6', 1, NULL, NULL, '2021-01-20 12:52:57', '2024-02-22 18:08:30'),
(2, 3, 'Mr. Developer', 'developer', 'developer@gmail.com', '1,18,2,4,5,6,7,9,20,21', '40,41,42,43,1,2,3,5,4,6,7,29,9,30,10,8,11,12,13,14,15,16,17,18,19,22,23,24,25,26,48,49,50,51,52,53,54,55', NULL, '$2y$10$pmcq4Tq0.jwp/jp4tbdTtONmCfNCp2Y9S6hDqQsKQ28TDiNG.Va.2', 1, NULL, NULL, NULL, '2024-02-23 12:02:25'),
(3, 4, 'Mr. Member', 'mr-member', 'mr.member@gmail.com', '1,20', '48,49,50,51', 'public/images/users/img-00.jpg', '$2y$10$yOfD6NvK7xn4MonU/5jOS.5dZZzUgTvlX3yb788i4GAKnt/Gs5Wfq', 1, NULL, NULL, '2021-02-04 15:16:12', '2024-02-23 12:06:31'),
(5, 4, 'Miss. Member', 'miss-member', 'miss.member@gmail.com', '1,20', '48,49,50,51', NULL, '$2y$10$ec4cuWN.ftBjTDdvSz77TOqjXdi5zARuwXOBoH3uxpB4sw8C.ZOV2', 1, NULL, NULL, '2024-02-22 18:05:29', '2024-02-23 12:06:22');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text DEFAULT NULL,
  `parent_role` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `permission` text DEFAULT NULL,
  `action_permission` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`, `parent_role`, `level`, `order_by`, `status`, `permission`, `action_permission`, `created_at`, `updated_at`) VALUES
(2, 'Super Admin', NULL, 1, 1, 1, '1,18,2,4,5,6,7,9,20,21', '40,41,42,43,1,2,3,5,4,6,7,29,9,30,10,8,11,12,13,14,15,16,17,18,19,22,23,24,25,26,48,49,50,51,52,53,54,55', '2019-04-16 18:50:05', '2024-02-22 18:08:30'),
(3, 'Admin', NULL, 1, 2, 1, '1,18,2,4,5,6,7,9,20,21', '40,41,42,43,1,2,3,5,4,6,7,29,9,30,10,8,11,12,13,14,15,16,17,18,19,22,23,24,25,26,48,49,50,51,52,53,54,55', '2019-04-16 18:52:54', '2024-02-22 18:08:45'),
(4, 'Member', NULL, 1, 3, 1, '1,20', '48,49,50,51', '2020-03-06 18:49:33', '2024-02-22 18:09:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_settings`
--
ALTER TABLE `admin_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_actions`
--
ALTER TABLE `menu_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_action_types`
--
ALTER TABLE `menu_action_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `readers`
--
ALTER TABLE `readers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_user_name_unique` (`user_name`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_settings`
--
ALTER TABLE `admin_settings`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `menu_actions`
--
ALTER TABLE `menu_actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `menu_action_types`
--
ALTER TABLE `menu_action_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `readers`
--
ALTER TABLE `readers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
