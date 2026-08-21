-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 17, 2026 at 09:53 AM
-- Server version: 8.4.7
-- PHP Version: 8.5.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `findit`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Junaid', 'Junaid@findit.com', '12345678', NULL, '2026-07-10 19:59:52', '2026-07-10 19:59:52');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(6, 'Documents'),
(9, 'Headphone'),
(3, 'ID Card'),
(7, 'Jewelry'),
(4, 'Keys'),
(5, 'Laptop'),
(1, 'Mobile Phone'),
(8, 'Other'),
(2, 'Wallet');

-- --------------------------------------------------------

--
-- Table structure for table `claims`
--

DROP TABLE IF EXISTS `claims`;
CREATE TABLE IF NOT EXISTS `claims` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `item_id` bigint UNSIGNED DEFAULT NULL,
  `claimant_id` int DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `blocked_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_claims_item` (`item_id`),
  KEY `fk_claims_claimant` (`claimant_id`),
  KEY `fk_claims_blocked_by` (`blocked_by`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `claims`
--

INSERT INTO `claims` (`id`, `item_id`, `claimant_id`, `message`, `status`, `created_at`, `updated_at`, `is_blocked`, `blocked_by`) VALUES
(25, 59, 15, NULL, 'approved', '2026-07-29 18:38:07', '2026-08-09 06:41:26', 0, NULL),
(26, 61, 15, NULL, 'rejected', '2026-08-08 06:39:39', '2026-08-09 06:04:32', 0, NULL),
(28, 68, 28, NULL, 'rejected', '2026-08-08 08:02:20', '2026-08-08 08:02:27', 0, NULL),
(29, 66, 28, NULL, 'approved', '2026-08-08 08:02:42', '2026-08-08 08:08:23', 0, NULL),
(30, 64, 15, NULL, 'rejected', '2026-08-09 06:37:51', '2026-08-09 06:38:36', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `claim_messages`
--

DROP TABLE IF EXISTS `claim_messages`;
CREATE TABLE IF NOT EXISTS `claim_messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `claim_id` int NOT NULL,
  `sender_id` int NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `claim_id` (`claim_id`),
  KEY `sender_id` (`sender_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `claim_messages`
--

INSERT INTO `claim_messages` (`id`, `claim_id`, `sender_id`, `message`, `read`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 1, 15, 'DDDDDDDDDDDDDDDDDDDDDDD', 0, 0, '2026-07-06 16:06:30', '2026-07-06 16:06:30'),
(2, 19, 15, 'IT', 0, 0, '2026-07-06 16:12:57', '2026-07-06 16:12:57'),
(3, 19, 15, 'I', 0, 0, '2026-07-06 16:13:00', '2026-07-06 16:13:00'),
(4, 19, 15, 'I', 0, 0, '2026-07-06 16:13:52', '2026-07-06 16:13:52'),
(5, 1, 15, 'ir', 0, 0, '2026-07-06 16:27:36', '2026-07-06 16:27:36'),
(6, 1, 15, 'idk', 0, 0, '2026-07-06 16:28:49', '2026-07-06 16:28:49'),
(7, 1, 15, 'This is my wallet', 0, 0, '2026-07-06 16:42:27', '2026-07-06 16:42:27'),
(8, 1, 15, 'one hbl bank card', 0, 0, '2026-07-06 16:48:43', '2026-07-06 16:48:43'),
(9, 1, 15, 'f', 0, 0, '2026-07-06 16:49:00', '2026-07-06 16:49:00'),
(10, 1, 15, 'dssssssacsac', 0, 0, '2026-07-06 16:52:52', '2026-07-06 16:52:52'),
(11, 20, 16, 'IT IS MINE', 0, 1, '2026-07-08 17:06:35', '2026-07-08 22:07:09'),
(12, 20, 15, 'no its not your', 0, 0, '2026-07-08 18:12:00', '2026-07-08 18:12:00'),
(13, 21, 15, 'IT MINE GIVE IT BACK SCHOOL WALA  BAHUT MARA GA', 0, 0, '2026-07-12 16:24:48', '2026-07-12 16:24:48'),
(14, 21, 15, 'gfive it back', 0, 0, '2026-07-13 15:06:09', '2026-07-13 15:06:09'),
(15, 19, 15, 'fbx', 0, 0, '2026-07-13 17:17:16', '2026-07-13 17:17:16'),
(16, 22, 16, 'thats mine', 0, 1, '2026-07-14 08:38:45', '2026-07-14 13:39:22'),
(17, 1, 15, 'I have got ypur wallet', 0, 0, '2026-07-20 17:45:22', '2026-07-20 17:45:22'),
(18, 23, 18, 'That mine', 0, 1, '2026-07-23 17:07:59', '2026-07-23 22:08:19'),
(19, 27, 27, 'this is mine', 0, 1, '2026-08-08 06:56:33', '2026-08-08 11:59:24'),
(20, 29, 28, 'THIS IS MINE', 0, 1, '2026-08-08 08:02:48', '2026-08-08 13:07:49'),
(21, 29, 15, 'what is the conformination', 0, 0, '2026-08-08 08:08:00', '2026-08-08 08:08:00'),
(22, 29, 15, 'tell me the proof', 0, 0, '2026-08-08 08:08:20', '2026-08-08 08:08:20');

-- --------------------------------------------------------

--
-- Table structure for table `communities`
--

DROP TABLE IF EXISTS `communities`;
CREATE TABLE IF NOT EXISTS `communities` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rules` text COLLATE utf8mb4_unicode_ci,
  `leader_phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privacy` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'public',
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leader_id` bigint DEFAULT NULL,
  `leader_cnic` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `communities`
--

INSERT INTO `communities` (`id`, `name`, `description`, `image`, `created_at`, `category`, `rules`, `leader_phone`, `location`, `privacy`, `banner`, `leader_id`, `leader_cnic`, `updated_at`, `password`, `email`, `status`) VALUES
(10, 'Aptech Scheme 33', 'Bets place to learn web development', '1784720665_communitylogo.png', '2026-07-22 06:44:25', 'Education', 'Be respectful, No fight', '03002136908', 'Aptech Scheme 33', 'public', '1784720665_banner_communtiy banner.jfif', NULL, '42101-1234567-3', '2026-07-22 07:46:38', '$2y$12$OUoe3ONuL/6sSsTySUC4DO9MqCiRoJZe3mzpjL.ee.dIqi8vlCZDS', 'APTECH@GMAIL.COM', 'approved'),
(11, 'LuckyOneMall', 'Shopping Mall', '1784722909_communitylogo.png', '2026-07-22 07:21:49', 'Social', 'Dont fight', '03002136929', 'Gulshan-e-Iqbal', 'public', '1784722909_banner_communtiy banner.jfif', NULL, '42101-1234567-2', '2026-07-29 17:42:43', '$2y$12$PSBOR5oRWwAwsw8KHlNW5.fS9IVLGWymTa6/AnXYhQOGmM2oVrjp.', 'Luckyone@email.com', 'approved'),
(12, 'Dolmen Mall', 'Shopping mall with all brands', '1784724074_communitylogo.png', '2026-07-22 07:41:14', 'Other', 'NO fighting', '03002136908', 'Dolmen Mall', 'public', '1784724074_banner_communtiy banner.jfif', NULL, '42101-1134567-5', '2026-07-22 07:46:32', '$2y$12$fKa8i/LWsLI5A83ucaJx2.h7KII4T5F4kFdB.6DR/wEu4YXl1WOA.', 'DolmenMall@gmail.com', 'approved'),
(13, 'ubl', 'Best academy for cricket', '1784724302_communitylogo.png', '2026-07-22 07:45:02', 'Sports', 'Learn with honesty', '03002136902', 'Gulshan-e-Iqbal', 'public', '1784724302_banner_communtiy banner.jfif', NULL, '42101-1234467-5', '2026-07-29 17:06:18', '$2y$12$tmJH.lLAWigQQN6m1SvOv.uT2Sgl9Lvw1lBAGPZjnUpvlEwG8z9iy', 'UBLACADEMY@gmail.com', 'approved'),
(15, 'Mah Rose Parlour', 'A best Parlour of world', '1785360062_community logo', '2026-07-29 16:21:02', 'Other', 'Be Respectful', '03002135298', 'Mah Rose Parlour', 'public', '1785360062_banner_community banner.jpg', NULL, '42101-1234567-3', '2026-07-29 16:21:53', '$2y$12$m90hVdi09Tqw3TqbsHVvre4YsZAVJXXI2AGyQfNAapJJJkpxXlbKu', 'MahRoseParlour@gmail.com', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `community_members`
--

DROP TABLE IF EXISTS `community_members`;
CREATE TABLE IF NOT EXISTS `community_members` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `community_id` int NOT NULL,
  `joined_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `community_id` (`community_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `community_members`
--

INSERT INTO `community_members` (`id`, `user_id`, `community_id`, `joined_at`) VALUES
(1, 1, 1, '2026-06-22 21:42:42'),
(2, 1, 2, '2026-06-22 21:42:42'),
(3, 1, 3, '2026-06-22 21:42:42'),
(4, 2, 1, '2026-06-22 21:42:42'),
(5, 2, 5, '2026-06-22 21:42:42'),
(6, 15, 6, '2026-06-28 22:59:07'),
(7, 15, 7, '2026-06-28 23:39:44'),
(8, 15, 8, '2026-06-29 22:25:03'),
(26, 15, 10, '2026-07-29 22:23:51'),
(10, 16, 9, '2026-07-20 21:43:12'),
(12, 15, 9, '2026-07-21 21:05:12'),
(27, 26, 13, '2026-08-08 11:43:31'),
(22, 15, 12, '2026-07-29 21:09:47'),
(16, 15, 11, '2026-07-22 12:45:22'),
(25, 15, 15, '2026-07-29 21:22:15'),
(28, 26, 15, '2026-08-08 11:43:36'),
(29, 27, 13, '2026-08-08 11:58:51'),
(30, 27, 15, '2026-08-08 11:58:54'),
(31, 28, 13, '2026-08-08 13:03:02'),
(32, 28, 15, '2026-08-08 13:03:04');

-- --------------------------------------------------------

--
-- Table structure for table `community_user`
--

DROP TABLE IF EXISTS `community_user`;
CREATE TABLE IF NOT EXISTS `community_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `community_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `community_user_unique` (`community_id`,`user_id`),
  KEY `fk_community_user_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Junaid arif', 'arifjunaid039@gmail.com', 'BEST', 'Best', '2026-06-30 14:02:01', '2026-06-30 14:02:01'),
(2, 'Junaid arif', 'arifjunaid039@gmail.com', 'BEST', 'Best', '2026-07-20 16:09:31', '2026-07-20 16:09:31'),
(3, 'Musab', 'Musab@gmail.com', 'BEST', 'NICE LAYOUT', '2026-08-08 06:47:04', '2026-08-08 06:47:04'),
(4, 'Sufyan', 'Sufyan@gmail.com', 'LAYOUT', 'nice layout', '2026-08-08 06:58:41', '2026-08-08 06:58:41'),
(5, 'Sufyan', 'Sufyan@gmail.com', 'LAYOUT', 'BEST LAYOUT', '2026-08-08 08:04:11', '2026-08-08 08:04:11');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
CREATE TABLE IF NOT EXISTS `conversations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `claim_id` bigint UNSIGNED NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `owner_id` bigint UNSIGNED NOT NULL,
  `claimant_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `claim_id`, `item_id`, `owner_id`, `claimant_id`, `created_at`, `updated_at`) VALUES
(1, 12, 19, 15, 15, '2026-07-06 17:13:29', '2026-07-06 17:13:29'),
(2, 13, 19, 15, 16, '2026-07-06 17:32:14', '2026-07-06 17:32:14'),
(3, 14, 19, 15, 16, '2026-07-06 17:38:23', '2026-07-06 17:38:23'),
(4, 15, 13, 15, 15, '2026-07-06 17:47:43', '2026-07-06 17:47:43'),
(5, 16, 13, 15, 16, '2026-07-06 17:48:30', '2026-07-06 17:48:30'),
(6, 17, 20, 15, 15, '2026-07-06 18:02:59', '2026-07-06 18:02:59'),
(7, 18, 21, 15, 16, '2026-07-06 18:07:01', '2026-07-06 18:07:01'),
(8, 19, 23, 15, 15, '2026-07-08 16:24:13', '2026-07-08 16:24:13');

-- --------------------------------------------------------

--
-- Table structure for table `conversation_reports`
--

DROP TABLE IF EXISTS `conversation_reports`;
CREATE TABLE IF NOT EXISTS `conversation_reports` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `claim_id` bigint UNSIGNED NOT NULL,
  `reporter_id` bigint UNSIGNED NOT NULL,
  `reason` enum('spam','inappropriate','harassment','fake_item','other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `status` enum('open','reviewed','dismissed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `claim_id` (`claim_id`),
  KEY `reporter_id` (`reporter_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conversation_reports`
--

INSERT INTO `conversation_reports` (`id`, `claim_id`, `reporter_id`, `reason`, `details`, `status`, `created_at`, `updated_at`) VALUES
(4, 15, 15, 'other', NULL, 'open', '2026-07-18 08:21:56', '2026-07-18 08:21:56'),
(2, 22, 15, 'fake_item', NULL, 'open', '2026-07-18 07:54:13', '2026-07-18 07:54:13'),
(3, 22, 15, 'harassment', NULL, 'open', '2026-07-18 07:55:41', '2026-07-18 07:55:41'),
(6, 23, 15, 'fake_item', NULL, 'open', '2026-07-23 17:09:47', '2026-07-23 17:09:47'),
(8, 27, 15, 'other', NULL, 'open', '2026-08-08 06:59:42', '2026-08-08 06:59:42');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `community_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `item_type` enum('lost','found') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_occurred` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_type_other` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imei_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification_notes` text COLLATE utf8mb4_unicode_ci,
  `contact_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`),
  KEY `fk_items_community` (`community_id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `user_id`, `community_id`, `category_id`, `title`, `description`, `item_type`, `location`, `date_occurred`, `created_at`, `photo`, `brand`, `color`, `sub_type`, `sub_type_other`, `imei_number`, `serial_number`, `verification_notes`, `contact_number`, `status`) VALUES
(47, 15, 10, 6, 'Documents', 'Junaid passport', 'lost', 'Federal B Area', '2026-07-28', '2026-07-29 18:16:42', '1785367002.png', NULL, NULL, NULL, NULL, NULL, NULL, 'Only one stamp', '03182513506', 'pending'),
(48, 15, 10, 9, 'Headphone', 'Brand new headphone', 'lost', 'Malir', '2026-07-26', '2026-07-29 18:18:27', '1785367107.jfif', NULL, 'Black', NULL, NULL, NULL, NULL, 'Wireless', '03182513502', 'pending'),
(49, 15, 13, 3, 'ID Card', 'Maya card name', 'lost', 'Gulistan-e-Johar', '2026-07-21', '2026-07-29 18:19:35', '1785367175.png', NULL, NULL, NULL, NULL, NULL, NULL, 'plastic coating', '03182513503', 'pending'),
(50, 15, 13, 7, 'Jewelry', 'Gold necklace', 'lost', 'Federal B Area', '2026-07-28', '2026-07-29 18:21:03', '1785367263.jpg', NULL, 'Golden', 'artificial', NULL, NULL, NULL, 'with knot to wear', '03182513503', 'pending'),
(51, 15, 13, 4, 'Keys', 'Its not single bunch of keys', 'lost', 'Shah Faisal Colony', '2026-07-19', '2026-07-29 18:21:54', '1785367314.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'with keychain', '03182513504', 'pending'),
(52, 15, 12, 5, 'Laptop', 'KEYBOARD NOT WORKING', 'lost', 'Saddar', '2026-07-26', '2026-07-29 18:23:01', '1785367381.jfif', 'Hp Laptop core i7 gen 8', 'Silver', NULL, NULL, NULL, 'C02XY1234ABC', 'with password', '03182513504', 'pending'),
(53, 15, 12, 1, 'Mobile Phone', 'Sumsung phone', 'lost', 'Defence (DHA)', '2026-07-20', '2026-07-29 18:24:12', '1785367452.jfif', NULL, 'Black', NULL, NULL, NULL, NULL, 'With password', '03182513503', 'pending'),
(54, 15, 11, 8, 'Other', 'Its brand new', 'lost', 'PECHS', '2026-07-28', '2026-07-29 18:25:26', '1785367526.jfif', NULL, 'Red', 'lipstick', NULL, NULL, NULL, 'even with tag 2000 price', '03182513502', 'pending'),
(55, 15, 15, 2, 'Wallet', '3 CARDS INSIDE ONE ATM CARD', 'lost', 'Gulshan-e-Maymar', '2026-07-27', '2026-07-29 18:26:51', '1785367611.jfif', NULL, 'Black', NULL, NULL, NULL, NULL, NULL, '03182513502', 'approved'),
(56, 15, 15, 6, 'Documents', 'A PROPERTY PAORDER', 'found', 'Korangi', '2026-07-21', '2026-07-29 18:28:50', '1785367730.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '03182513502', 'pending'),
(57, 15, 10, 9, 'Headphone', 'Black color headphone', 'found', 'Federal B Area', '2026-07-20', '2026-07-29 18:29:42', '1785367782.jfif', NULL, NULL, NULL, NULL, NULL, NULL, 'Wireless', '03182513502', 'pending'),
(58, 15, 13, 3, 'ID Card', 'It a maya card', 'found', 'Nazimabad', '2026-07-23', '2026-07-29 18:30:50', '1785367850.png', NULL, 'White', NULL, NULL, NULL, NULL, NULL, '03182513506', 'pending'),
(59, 15, 12, 7, 'Jewelry', 'Gold necklace', 'found', 'North Nazimabad', '2026-07-19', '2026-07-29 18:31:30', '1785367890.jpg', NULL, 'Golden', 'artificial', NULL, NULL, NULL, NULL, '03182513503', 'approved'),
(60, 15, 12, 4, 'Keys', 'Single key', 'found', 'Landhi', '2026-07-12', '2026-07-29 18:32:27', '1785367947.jpg', NULL, 'Black', NULL, NULL, NULL, NULL, NULL, '03182513503', 'pending'),
(61, 15, 11, 5, 'Laptop', 'Keyboard not working', 'found', 'Clifton', '2026-07-28', '2026-07-29 18:33:17', '1785367997.jfif', NULL, NULL, NULL, NULL, NULL, 'C02XY1234ABC', NULL, '03182513503', 'pending'),
(62, 15, NULL, 1, 'Mobile Phone', 'Sumsung phone', 'found', 'Nazimabad', '2026-07-26', '2026-07-29 18:33:54', '1785368034.jfif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '03182513504', 'pending'),
(63, 15, 11, 8, 'Other', 'New lipstick chaseup tag', 'found', 'North Nazimabad', '2026-07-20', '2026-07-29 18:35:20', '1785368120.jfif', NULL, 'Red', 'lipstick', NULL, NULL, NULL, NULL, '03182513502', 'pending'),
(64, 15, 15, 2, 'Wallet', '3 CARDS INSIDE', 'found', 'Defence (DHA)', '2026-07-28', '2026-07-29 18:36:04', '1785368164.jfif', NULL, 'Black', NULL, NULL, NULL, NULL, NULL, '03182513502', 'pending'),
(65, 15, 15, 7, 'Jewelry', 'GOLD NECKLACE', 'found', 'Defence (DHA)', '2026-07-19', '2026-07-29 18:36:47', '1785368207.jpg', NULL, 'Golden', NULL, NULL, NULL, NULL, NULL, '03182513502', 'pending'),
(66, 15, 11, 7, 'Jewelry', 'gold necklace', 'lost', 'Defence (DHA)', '2026-08-03', '2026-08-08 06:41:00', '1786189260.jpg', NULL, 'Golden', 'gold', NULL, NULL, NULL, NULL, '03182513504', 'approved'),
(68, 28, NULL, 4, 'Keys', 'IT IS MINE HONDA BIKE KEY', 'lost', 'PECHS', '2026-08-02', '2026-08-08 08:02:06', '1786194126.jpg', NULL, 'Black', NULL, NULL, NULL, NULL, NULL, '03182513502', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `conversation_id` int NOT NULL,
  `sender_id` int NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `conversation_id` (`conversation_id`),
  KEY `sender_id` (`sender_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `sender_id`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 1, 15, 'this is yopur', 0, '2026-07-06 17:26:20', '2026-07-06 17:26:20'),
(2, 2, 16, 'This is mine i am sure', 1, '2026-07-06 17:32:30', '2026-07-06 22:32:45'),
(3, 5, 15, 's', 1, '2026-07-06 17:50:01', '2026-07-06 23:05:45');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `reporter_id` int DEFAULT NULL,
  `claim_id` bigint UNSIGNED NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `reporter_id` (`reporter_id`),
  KEY `item_id` (`item_id`),
  KEY `fk_reports_claim` (`claim_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_otp` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_otp_expires_at` timestamp NULL DEFAULT NULL,
  `phone_verified_at` timestamp NULL DEFAULT NULL,
  `cnic` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnic_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `face_match_score` decimal(5,2) DEFAULT NULL,
  `verification_status` enum('unverified','pending','auto_approved','manual_review','verified','rejected','auto_rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unverified',
  `verified_at` timestamp NULL DEFAULT NULL,
  `verification_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('active','blocked') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `cnic` (`cnic`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `phone`, `phone_otp`, `phone_otp_expires_at`, `phone_verified_at`, `cnic`, `address`, `photo`, `cnic_photo`, `face_match_score`, `verification_status`, `verified_at`, `verification_note`, `password`, `created_at`, `updated_at`, `status`) VALUES
(15, 'Junaid arif', 'arifjunaid039@gmail.com', '03002136902', NULL, NULL, NULL, '42101-1234567-1', 'Madras', '1784844999.png', 'cnic_photos/DuZhQ6Rc8NqWp0WHlruN3kksTThjLs3nX8W44Rqd.jpg', NULL, 'manual_review', NULL, NULL, '$2y$12$7TJCtEPjmJ71Y0DVaKZ4/Oh7aAZWcnt2PSpKk1j6jWlkdSiytA/iS', '2026-06-19 14:34:25', '2026-08-15 00:24:14', 'active'),
(18, 'Jasir', 'Jasir@gmail.com', '03002136903', NULL, NULL, NULL, '42101-1235567-1', 'Kda Society', '1784672744.png', NULL, NULL, 'unverified', NULL, NULL, '$2y$12$VtiBaVnI1QfdIucxU1dtUup9S5CAwBmhrx3CKkNknQNxqt3XHkZqu', '2026-07-21 17:25:44', '2026-08-07 21:26:22', 'active'),
(26, 'Musab', 'Musab@gmail.com', '03002136901', NULL, NULL, NULL, '42101-1234564-8', 'Gulshan', '1786189377.webp', '1786189377_cnic.jpg', NULL, 'pending', NULL, NULL, '$2y$12$.YITAZRSijx09qdkC0N.UuYfVa6zaJZeew8zV3OCeKCcTGrRTbRMm', '2026-08-08 06:42:57', '2026-08-08 08:06:57', 'active'),
(28, 'Sufyan', 'Sufyan@gmail.com', '03002136912', NULL, NULL, NULL, '42101-1234562-1', 'Gulshan', '1786194010.webp', '1786194010_cnic.jpg', NULL, 'pending', NULL, NULL, '$2y$12$FC9wXzTMsR1KsXWuDZ6bdef24qckNlV1R9AkxxB3FS3B2hMlI0gnO', '2026-08-08 08:00:10', '2026-08-08 08:06:46', 'active'),
(29, 'Ali', 'ali@email.com', '03002136412', NULL, NULL, NULL, '42501-1234261-8', 'Korangi', '1786281031.jfif', '1786281031_cnic.jpg', NULL, 'pending', NULL, NULL, '$2y$12$Z5r9nDhSFBIjwAAgqYfE8OA1D8f1IeyCHhLDw.BDCsPODG5.2vTHS', '2026-08-09 08:10:31', '2026-08-09 08:10:31', 'active'),
(30, 'Arsalan', 'Arsalan@gmail.com', '03002136612', NULL, NULL, NULL, '42101-1287531-2', 'Defence', '1786752572.jfif', '1786752572_cnic.jpg', NULL, 'pending', NULL, NULL, '$2y$12$55Ba3NqrXTFILDOk1Ql/LuDxs9cQ/4YT2SaL6LcpE4sD2oo6qyR8i', '2026-08-14 19:09:33', '2026-08-14 19:09:33', 'active'),
(31, 'Hamza', 'Hamza@gmail.com', '03002139241', '676128', '2026-08-14 19:30:55', NULL, '42101-6487531-2', 'Defence', '1786752739.jfif', '1786752739_cnic.jpg', NULL, 'pending', NULL, NULL, '$2y$12$Xe1RIOVq5yx1xprqQMnxNu5iTQiIvD1w89V0bLCLvtz/lSo5IX4Ai', '2026-08-14 19:12:19', '2026-08-15 00:20:55', 'active'),
(32, 'Junaid arif', 'arifjunaid@gmail.com', '03002136921', '829011', '2026-08-14 19:48:10', NULL, '42101-1239713-2', 'Gulshan', '1786753490.jfif', '1786753490_cnic.jpg', NULL, 'pending', NULL, NULL, '$2y$12$hsLpksT52LP8cKBt5/tCJucLPGtJLH4rSOZ/DKftA/6k/zB/iyc1G', '2026-08-14 19:24:50', '2026-08-15 02:35:01', 'active'),
(33, 'Junaid arif', 'arifjunai@gmail.com', '03182513502', '262833', '2026-08-14 19:51:50', NULL, '42101-1237841-2', 'Gulshan', '1786754495.jfif', '1786754495_cnic.jpg', NULL, 'pending', NULL, NULL, '$2y$12$phD.YfF0anlJa1/ckOBPmOsnTCiqkK8SNgqx3ijCXNZp8jNDUPPb6', '2026-08-14 19:41:35', '2026-08-15 00:49:39', 'active'),
(34, 'Junaid arif', 'arif@gmail.com', '03182513501', '710103', '2026-08-14 20:11:45', NULL, '42101-1234152-3', 'Gulshan', '1786755013.jfif', '1786755013_cnic.jpg', NULL, 'pending', NULL, NULL, '$2y$12$7iUxgo7FyeM0h6sHiV43A.1PwEnbB349vNT.blBzXBLf9VxsangTm', '2026-08-14 19:50:13', '2026-08-15 01:10:46', 'active'),
(35, 'Junaid arif', 'junaid@gmail.com', '03182513507', NULL, NULL, '2026-08-14 20:11:31', '42101-2352362-1', 'Gulshan', '1786756270.jfif', '1786756270_cnic.jpg', NULL, 'pending', NULL, NULL, '$2y$12$kCgOKfKxM9mPyVLqYaEY2Oc85s1RskFvY4JtYdLW.llZZ9LT/a6OW', '2026-08-14 20:11:10', '2026-08-15 01:18:56', 'active'),
(38, 'Junaid arif', 'junaid039@gmail.com', '03002136908', NULL, NULL, '2026-08-14 21:36:31', '42101-1228157-2', 'Defence', '1786761339.jfif', '1786761339_cnic.jpg', NULL, 'pending', NULL, NULL, '$2y$12$T1ZzkdfqEqTu3cMqrNfACu2xV1cOjZZt2IiGaLlM0V1KHMK4WgHSy', '2026-08-14 21:35:39', '2026-08-15 02:36:31', 'active');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `claims`
--
ALTER TABLE `claims`
  ADD CONSTRAINT `fk_claims_blocked_by` FOREIGN KEY (`blocked_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_claims_claimant` FOREIGN KEY (`claimant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_claims_item` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `community_user`
--
ALTER TABLE `community_user`
  ADD CONSTRAINT `fk_community_user_community` FOREIGN KEY (`community_id`) REFERENCES `communities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_community_user_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_items_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_items_community` FOREIGN KEY (`community_id`) REFERENCES `communities` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_items_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `fk_reports_claim` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reports_item` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reports_reporter` FOREIGN KEY (`reporter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
