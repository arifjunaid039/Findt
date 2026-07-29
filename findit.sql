-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 23, 2026 at 11:18 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `claims`
--

INSERT INTO `claims` (`id`, `item_id`, `claimant_id`, `message`, `status`, `created_at`, `updated_at`, `is_blocked`, `blocked_by`) VALUES
(1, 19, 15, 'THIS IS MY PHONE I AM SURE', 'Approved', '2026-07-06 16:59:08', '2026-07-23 17:07:27', 1, 15),
(2, 19, 15, 'TGHUS IS MY PHONE I AM SURE', 'rejected', '2026-07-06 16:59:51', '2026-07-06 17:45:21', 0, NULL),
(3, 19, 15, 'SC         GYFSCYVYUSACVYUSA  GFFFF', 'rejected', '2026-07-06 17:00:41', '2026-07-06 17:45:21', 0, NULL),
(4, 19, 15, 'fassssssssssssssafds', 'rejected', '2026-07-06 17:01:41', '2026-07-06 17:45:21', 0, NULL),
(5, 19, 15, 'fsbbbbbbbbbbbbbbbsfdb', 'rejected', '2026-07-06 17:02:06', '2026-07-06 17:45:21', 0, NULL),
(6, 19, 15, 'fsbbbbbbbbbbbbbbbsfdb', 'rejected', '2026-07-06 17:03:06', '2026-07-06 17:45:21', 0, NULL),
(7, 19, 15, 'dgggggggggggggggggds', 'rejected', '2026-07-06 17:03:14', '2026-07-06 17:45:21', 0, NULL),
(8, 19, 15, 'fasssssssssgddgdddgdd', 'rejected', '2026-07-06 17:05:07', '2026-07-06 17:45:21', 0, NULL),
(9, 19, 15, 'fasssssssssgddgdddgdd', 'rejected', '2026-07-06 17:05:56', '2026-07-06 17:45:21', 0, NULL),
(10, 19, 15, 'fasssssssssgddgdddgdd', 'rejected', '2026-07-06 17:06:53', '2026-07-06 17:45:21', 0, NULL),
(11, 19, 15, 'fasssssssssgddgdddgdd', 'rejected', '2026-07-06 17:07:55', '2026-07-06 17:45:21', 0, NULL),
(12, 19, 15, 'fasssssssssgddgdddgdd', 'rejected', '2026-07-06 17:13:29', '2026-07-06 17:45:21', 0, NULL),
(13, 19, 16, 'This is mine i am sure', 'approved', '2026-07-06 17:32:14', '2026-07-06 17:45:21', 0, NULL),
(14, 19, 16, 'ffffffffffffffffffffffffffffffff', 'approved', '2026-07-06 17:38:23', '2026-07-06 17:42:39', 0, NULL),
(15, 13, 15, 'fdbddddddddddddddfbd', 'rejected', '2026-07-06 17:47:43', '2026-07-06 17:57:49', 0, NULL),
(16, 13, 16, 'egssssssssssssssssssdg', 'approved', '2026-07-06 17:48:30', '2026-07-06 17:57:49', 0, NULL),
(17, 20, 15, 'This is mine i am hundred 100% sure', 'approved', '2026-07-06 18:02:59', '2026-07-06 18:03:09', 0, NULL),
(18, 21, 16, 'This is mine Please give it back to me', 'approved', '2026-07-06 18:07:01', '2026-07-08 17:26:13', 0, NULL),
(19, 23, 15, 'its mine give it me key too', 'approved', '2026-07-08 16:24:13', '2026-07-13 17:31:59', 1, 15),
(22, 23, 16, NULL, 'rejected', '2026-07-14 08:37:51', '2026-07-23 17:13:09', 1, 15),
(23, 43, 18, NULL, 'rejected', '2026-07-23 17:07:53', '2026-07-23 17:08:25', 1, 18);

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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(18, 23, 18, 'That mine', 0, 1, '2026-07-23 17:07:59', '2026-07-23 22:08:19');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `communities`
--

INSERT INTO `communities` (`id`, `name`, `description`, `image`, `created_at`, `category`, `rules`, `leader_phone`, `location`, `privacy`, `banner`, `leader_id`, `leader_cnic`, `updated_at`, `password`, `email`, `status`) VALUES
(10, 'Aptech Scheme 33', 'Bets place to learn web development', '1784720665_communitylogo.png', '2026-07-22 06:44:25', 'Education', 'Be respectful, No fight', '03002136908', 'Aptech Scheme 33', 'public', '1784720665_banner_communtiy banner.jfif', NULL, '42101-1234567-3', '2026-07-22 07:46:38', '$2y$12$OUoe3ONuL/6sSsTySUC4DO9MqCiRoJZe3mzpjL.ee.dIqi8vlCZDS', 'APTECH@GMAIL.COM', 'approved'),
(11, 'LuckyOneMall', 'Shopping Mall', '1784722909_communitylogo.png', '2026-07-22 07:21:49', 'Social', 'Dont fight', '03002136929', 'Lucky One Mall', 'public', '1784722909_banner_communtiy banner.jfif', NULL, '42101-1234567-2', '2026-07-22 07:46:35', '$2y$12$PSBOR5oRWwAwsw8KHlNW5.fS9IVLGWymTa6/AnXYhQOGmM2oVrjp.', 'Luckyone@email.com', 'approved'),
(12, 'Dolmen Mall', 'Shopping mall with all brands', '1784724074_communitylogo.png', '2026-07-22 07:41:14', 'Other', 'NO fighting', '03002136908', 'Dolmen Mall', 'public', '1784724074_banner_communtiy banner.jfif', NULL, '42101-1134567-5', '2026-07-22 07:46:32', '$2y$12$fKa8i/LWsLI5A83ucaJx2.h7KII4T5F4kFdB.6DR/wEu4YXl1WOA.', 'DolmenMall@gmail.com', 'approved'),
(13, 'UBL ACADEMY', 'Best academy for cricket', '1784724302_communitylogo.png', '2026-07-22 07:45:02', 'Sports', 'Learn with honesty', '03002136902', 'Ubl Academy', 'public', '1784724302_banner_communtiy banner.jfif', NULL, '42101-1234467-5', '2026-07-22 07:50:05', '$2y$12$tmJH.lLAWigQQN6m1SvOv.uT2Sgl9Lvw1lBAGPZjnUpvlEwG8z9iy', 'UBLACADEMY@gmail.com', 'approved');

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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(13, 15, 10, '2026-07-22 11:45:13'),
(10, 16, 9, '2026-07-20 21:43:12'),
(12, 15, 9, '2026-07-21 21:05:12'),
(14, 15, 13, '2026-07-22 12:45:18'),
(17, 15, 12, '2026-07-22 12:50:29'),
(16, 15, 11, '2026-07-22 12:45:22');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Junaid arif', 'arifjunaid039@gmail.com', 'BEST', 'Best', '2026-06-30 14:02:01', '2026-06-30 14:02:01'),
(2, 'Junaid arif', 'arifjunaid039@gmail.com', 'BEST', 'Best', '2026-07-20 16:09:31', '2026-07-20 16:09:31');

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conversation_reports`
--

INSERT INTO `conversation_reports` (`id`, `claim_id`, `reporter_id`, `reason`, `details`, `status`, `created_at`, `updated_at`) VALUES
(4, 15, 15, 'other', NULL, 'open', '2026-07-18 08:21:56', '2026-07-18 08:21:56'),
(2, 22, 15, 'fake_item', NULL, 'open', '2026-07-18 07:54:13', '2026-07-18 07:54:13'),
(3, 22, 15, 'harassment', NULL, 'open', '2026-07-18 07:55:41', '2026-07-18 07:55:41'),
(6, 23, 15, 'fake_item', NULL, 'open', '2026-07-23 17:09:47', '2026-07-23 17:09:47');

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
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`),
  KEY `fk_items_community` (`community_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `user_id`, `community_id`, `category_id`, `title`, `description`, `item_type`, `location`, `date_occurred`, `created_at`, `photo`, `brand`, `color`, `sub_type`, `sub_type_other`, `imei_number`, `serial_number`, `verification_notes`, `contact_number`) VALUES
(13, 15, NULL, 1, 'Iphone 13', '256 GB', 'found', 'Dolmen Mall', '2026-07-17', '2026-07-03 14:12:20', '1783105940.png', 'Apple', 'Black', NULL, NULL, '356789104561234', NULL, 'broken glass', '03182513504'),
(19, 15, NULL, 2, 'Wallet', '3 CARDS INSIDE', 'lost', 'Lucky One Mall', '2026-07-01', '2026-07-06 15:46:12', '1783370772.jfif', NULL, 'Black', NULL, NULL, NULL, NULL, NULL, '03182513504'),
(20, 15, NULL, 5, 'Laptop', 'No scrath', 'found', 'Lucky One Mall', '2026-07-01', '2026-07-06 18:02:32', '1783378952.jfif', 'Hp Laptop core i7 gen 8', 'Silver', NULL, NULL, NULL, 'C02XY1234ABC', NULL, '03182513504'),
(21, 15, NULL, 5, 'Laptop', 'one scrath broken screen', 'found', 'Dolmen Mall', '2026-06-29', '2026-07-06 18:05:28', '1783379128.jfif', 'Hp Laptop core i7 gen 8', 'White', NULL, NULL, NULL, 'C02XY1234ABC', 'shift key not working', '03182513503'),
(23, 15, NULL, 4, 'Keys', 'It has keychain of tom', 'found', 'Lucky One Mall', '2026-06-28', '2026-07-08 16:23:18', '1783545798.jpg', NULL, 'Black', NULL, NULL, NULL, NULL, 'house keys too', '03182513504'),
(26, 15, NULL, 4, 'Keys', 'bIKE KEYS', 'found', 'Dolmen Mall', '2026-07-08', '2026-07-20 17:56:07', '1784588167.jpg', NULL, 'Black', NULL, NULL, NULL, NULL, NULL, '03182513504'),
(27, 18, NULL, 6, 'Documents', '3 PAGES', 'lost', 'Aptech Scheme 33', '2026-07-17', '2026-07-21 17:28:02', '1784672882.png', NULL, 'Black', NULL, NULL, NULL, NULL, 'Junaid wriiteen as a name file', '03182513504'),
(28, 18, NULL, 3, 'ID Card', 'MAYA CRAD', 'lost', 'Ubl Academy', '2026-07-06', '2026-07-21 17:30:52', '1784673052.png', NULL, 'White', NULL, NULL, NULL, NULL, 'PLACTIC COATING', '03182513504'),
(29, 18, NULL, 7, 'Jewelry', 'TWO bangles', 'lost', 'Ubl Academy', '2026-07-18', '2026-07-21 17:35:52', '1784673352.jpg', NULL, 'Golden', NULL, NULL, NULL, NULL, 'One broken ARtifical', '03182513504'),
(30, 18, NULL, 4, 'Keys', 'Honda Bike key', 'lost', 'Aptech Scheme 33', '2026-07-17', '2026-07-21 17:36:56', '1784673416.jpg', NULL, 'Black', NULL, NULL, NULL, NULL, 'three keys with doremon keychain', '03182513503'),
(31, 18, NULL, 5, 'Laptop', 'WITH PIN', 'lost', 'LuckyONE Mall', '2026-07-13', '2026-07-21 17:38:54', '1784673534.jfif', NULL, 'Silver', NULL, NULL, NULL, NULL, 'NO scrathes Brand New', '03182513504'),
(32, 18, NULL, 1, 'Mobile Phone', 'With pin pta approved', 'lost', 'Dolmen Mall', '2026-07-13', '2026-07-21 17:40:39', '1784673639.jfif', NULL, 'White', NULL, NULL, NULL, NULL, 'no cover broken glass', '03182513503'),
(33, 18, NULL, 2, 'Wallet', 'LEATHER wALLET', 'lost', 'LuckyOne Mall', '2026-07-13', '2026-07-21 17:42:11', '1784673731.jfif', NULL, 'Black', NULL, NULL, NULL, NULL, NULL, '03182513504'),
(34, 15, NULL, 8, 'Other', '2000 PRICE WRITTEN ON IT', 'lost', 'Dolmen Mall', '2026-07-21', '2026-07-22 05:30:52', '1784716252.jfif', NULL, 'Red', NULL, NULL, NULL, NULL, NULL, '03182513502'),
(35, 15, NULL, 6, 'Documents', 'file', 'found', 'Ubl Academy', '2026-07-21', '2026-07-22 05:34:30', '1784716470.png', NULL, 'White', NULL, NULL, NULL, NULL, '3 papers', '03182513502'),
(36, 15, NULL, 6, 'Documents', '3 papers', 'found', 'Dolmen Mall', '2026-07-21', '2026-07-22 05:45:23', '1784717123.png', NULL, 'White', NULL, NULL, NULL, NULL, 'plastic coating', '03182513504'),
(37, 15, NULL, 9, 'Headphone', 'wireless', 'found', 'Lucky One Mall', '2026-07-20', '2026-07-22 05:48:22', '1784717302.jfif', NULL, 'Black', NULL, NULL, NULL, NULL, 'BRAND NEW', '03182513506'),
(38, 15, NULL, 3, 'ID Card', 'ONE PHOTO JUNAID ID CARD', 'found', 'Dolmen Mall', '2026-07-21', '2026-07-22 05:50:50', '1784717450.png', NULL, 'White', NULL, NULL, NULL, NULL, 'PLASTIC COATING', '03182513502'),
(39, 15, NULL, 7, 'Jewelry', 'RUSTY', 'found', 'Aptech Scheme 33', '2026-07-21', '2026-07-22 05:52:54', '1784717574.jpg', NULL, 'Golden', 'artificial', NULL, NULL, NULL, 'NECKLACE', '03182513504'),
(40, 15, NULL, 5, 'Laptop', 'WITH PPIN', 'found', 'LuckyONE Mall', '2026-07-21', '2026-07-22 05:54:58', '1784717698.jfif', 'Hp Laptop core i7 gen 8', 'Silver', NULL, NULL, NULL, 'C02XY1234ABC', 'no SCRATCHES', '03182513502'),
(41, 15, NULL, 1, 'Mobile Phone', 'sumsung s26 ulta', 'found', 'Ubl Academy', '2026-07-20', '2026-07-22 05:55:56', '1784717756.jfif', NULL, 'Black', NULL, NULL, NULL, NULL, 'brokne prodector', '03182513502'),
(42, 15, NULL, 8, 'Other', 'GUCCI LIPSTICK', 'found', 'Ubl Academy', '2026-07-20', '2026-07-22 05:58:49', '1784717929.jfif', NULL, 'Red', 'lipstick', NULL, NULL, NULL, '20000 price written on it', '03182513503'),
(43, 15, NULL, 2, 'Wallet', '3 cards', 'found', 'Aptech Scheme 33', '2026-07-21', '2026-07-22 05:59:47', '1784717987.jfif', NULL, 'Black', NULL, NULL, NULL, NULL, 'one atm card', '03182513504'),
(44, 15, NULL, 9, 'Headphone', 'wireless', 'lost', 'Lucky One Mall', '2026-07-20', '2026-07-22 06:27:53', '1784719673.jfif', NULL, 'Black', NULL, NULL, NULL, NULL, NULL, '03182513504');

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `phone`, `cnic`, `address`, `photo`, `cnic_photo`, `face_match_score`, `verification_status`, `verified_at`, `verification_note`, `password`, `created_at`, `updated_at`, `status`) VALUES
(15, 'Junaid arif', 'arifjunaid039@gmail.com', '03002136908', '42101-1234567-1', 'Madras', '1784844999.png', 'cnic_photos/DuZhQ6Rc8NqWp0WHlruN3kksTThjLs3nX8W44Rqd.jpg', NULL, 'manual_review', NULL, NULL, '$2y$12$7TJCtEPjmJ71Y0DVaKZ4/Oh7aAZWcnt2PSpKk1j6jWlkdSiytA/iS', '2026-06-19 14:34:25', '2026-07-23 17:16:39', 'active'),
(16, 'Junaid', 'arifjunaid@gmail.com', '03002136904', '42101-1234667-1', 'Gulshan', '1782596610.jpg', NULL, NULL, 'unverified', NULL, NULL, '$2y$12$6W2i9nOtNm/0WUkDX/SbAO/Msuu0GlaA6RmEHHJlWbvLr8k1UIWE2', '2026-06-27 16:43:30', '2026-07-19 17:13:48', 'active'),
(18, 'Jasir', 'Jasir@gmail.com', '03002136903', '42101-1235567-1', 'Kda Society', '1784672744.png', NULL, NULL, 'unverified', NULL, NULL, '$2y$12$VtiBaVnI1QfdIucxU1dtUup9S5CAwBmhrx3CKkNknQNxqt3XHkZqu', '2026-07-21 17:25:44', '2026-07-21 17:25:44', 'active'),
(25, 'Junaid arif', 'junaid09@gmail.com', '03002736904', '42101-1234567-8', 'dsfaa', '1784848391.webp', '1784848391_cnic.jpg', NULL, 'pending', NULL, NULL, '$2y$12$9XWqc34jrbH0qw.lBAOaPevMzLO9XZoVcRFL2VvTgkZJRmGOXonlK', '2026-07-23 18:13:11', '2026-07-23 18:13:11', 'active');

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
