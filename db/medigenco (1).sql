-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2021 at 03:34 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medigenco`
--

-- --------------------------------------------------------

--
-- Table structure for table `addons`
--

CREATE TABLE `addons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `unique_identifier` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `version` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `activated` int(1) NOT NULL DEFAULT 1,
  `image` varchar(1000) COLLATE utf32_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `addons`
--

INSERT INTO `addons` (`id`, `name`, `unique_identifier`, `version`, `activated`, `image`, `created_at`, `updated_at`) VALUES
(2, 'OTP', 'otp_system', '1.2', 0, 'otp_system.jpg', '2020-09-15 20:54:54', '2020-09-16 07:36:41'),
(3, 'refund', 'refund_request', '1.0', 1, 'refund_request.png', '2020-09-16 21:30:23', '2020-09-16 21:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `ambulances`
--

CREATE TABLE `ambulances` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `com_name` varchar(50) NOT NULL,
  `location_id` int(11) NOT NULL,
  `com_address` longtext NOT NULL,
  `com_email` varchar(50) NOT NULL,
  `com_phone` varchar(11) NOT NULL,
  `com_alternate` varchar(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ambulances`
--

INSERT INTO `ambulances` (`id`, `user_id`, `com_name`, `location_id`, `com_address`, `com_email`, `com_phone`, `com_alternate`, `created_at`, `updated_at`) VALUES
(1, 8, 'Suresh Ambulance Services', 1, 'test road.', 'query@ambSuresh.com', '8563241575', '', '2021-02-18 09:53:20', '2021-02-18 09:53:20');

-- --------------------------------------------------------

--
-- Table structure for table `ambulance_details`
--

CREATE TABLE `ambulance_details` (
  `id` int(11) NOT NULL,
  `ambulance_id` int(11) NOT NULL,
  `local_rent` int(11) NOT NULL,
  `outstay_rent` int(11) NOT NULL,
  `car_no` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `show_price` int(11) NOT NULL DEFAULT 0,
  `outstay_show` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ambulance_details`
--

INSERT INTO `ambulance_details` (`id`, `ambulance_id`, `local_rent`, `outstay_rent`, `car_no`, `created_at`, `updated_at`, `show_price`, `outstay_show`) VALUES
(1, 1, 600, 14, 'MH05DO1017', '2021-03-05 18:47:16', '2021-02-18 09:54:27', 650, 17);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `type_id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `clinic_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time DEFAULT NULL,
  `approve` tinyint(3) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `bed_type` int(11) NOT NULL DEFAULT 0,
  `home_collection` tinyint(3) DEFAULT 0,
  `address` mediumtext DEFAULT NULL,
  `car_no` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `code`, `type_id`, `type`, `clinic_id`, `date`, `time`, `approve`, `created_at`, `updated_at`, `user_id`, `bed_type`, `home_collection`, `address`, `car_no`) VALUES
(1, 'MEDI0001/2020-21', 1, 'diagnostics', NULL, '2021-03-09', '06:42:00', 0, '2021-03-11 16:21:26', '2021-03-09 13:12:48', 10, 0, 0, NULL, NULL),
(2, 'MEDI0002/2020-21', 1, 'ambulances', NULL, '2021-03-09', '06:44:00', 0, '2021-03-11 16:21:29', '2021-03-09 13:14:35', 10, 0, 0, NULL, NULL),
(3, 'MEDI0003/2020-21', 1, 'doctors', 1, '2021-03-10', '05:10:00', 0, '2021-03-11 16:21:31', '2021-03-10 11:40:39', 10, 0, 0, NULL, NULL),
(4, 'MEDI0004/2020-21', 1, 'ambulances', NULL, '2021-03-10', '06:54:00', 0, '2021-03-11 16:21:33', '2021-03-10 13:24:59', 12, 0, 0, NULL, NULL),
(5, 'MEDI0005/2020-21', 1, 'ambulances', NULL, '2021-03-10', '07:09:00', 0, '2021-03-11 16:21:36', '2021-03-10 13:39:40', 12, 0, 0, NULL, NULL),
(6, 'MEDI0006/2020-21', 1, 'hospitals', NULL, '2021-03-11', '06:13:00', 0, '2021-03-11 12:43:02', '2021-03-11 12:43:02', 10, 0, 0, NULL, NULL),
(7, 'MEDI0007/2020-21', 1, 'doctors', 1, '2021-03-11', '06:13:00', 0, '2021-03-11 12:43:36', '2021-03-11 12:43:36', 10, 0, 0, NULL, NULL),
(8, 'MEDI0008/2020-21', 1, 'diagnostics', NULL, '2021-03-10', '09:00:00', 0, '2021-03-11 20:31:10', '2021-03-11 15:00:54', 6, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `locations` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `locations`) VALUES
(1, 'uploads/banner/test.png'),
(2, 'uploads/banner/Fruits.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `clinics`
--

CREATE TABLE `clinics` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `clinic_name` varchar(25) NOT NULL,
  `clinic_address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `location_id` int(11) NOT NULL,
  `clinic_phone` varchar(11) NOT NULL,
  `clinic_alternate` varchar(11) DEFAULT NULL,
  `clinic_email` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clinics`
--

INSERT INTO `clinics` (`id`, `user_id`, `clinic_name`, `clinic_address`, `created_at`, `updated_at`, `location_id`, `clinic_phone`, `clinic_alternate`, `clinic_email`) VALUES
(1, 2, 'Shushant Medico', 'Robi Colony, Darwin Road, Burdwan, Pin = 713101', '2021-02-16 13:33:07', '2021-02-16 13:33:07', 1, '8564937817', '9536847426', 'query@medics.com'),
(2, 3, 'Ranjit Pathology', 'Ashansool Street, Assansol pin- 713334', '2021-02-17 14:32:32', '2021-02-16 14:33:33', 1, '7502698545', '9535696857', 'query@pathelo.com'),
(3, 5, 'Own Dispencery', 'Demo Road', '2021-02-17 14:32:34', '2021-02-16 14:44:56', 1, '9586357478', NULL, 'query@docs.com'),
(4, 14, 'Own Dispensary', '\"Vill.- natungram, P.O.- Hijuli P.S.- Dhantala\"\"\"', '2021-03-20 05:06:22', '2021-03-16 05:32:56', 1, '8965712358', '04023857451', NULL),
(5, 17, 'Abcd Clinic Forum', 'Vill.- natungram, P.O.- Hijuli P.S.- Dhantala', '2021-03-20 01:21:37', '2021-03-20 01:21:37', 1, '9456358576', NULL, NULL),
(6, 18, 'Abcd Clinic Forum', 'Vill.- natungram, P.O.- Hijuli P.S.- Dhantala', '2021-03-20 01:23:17', '2021-03-20 01:23:17', 1, '947456683', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `diagnostics`
--

CREATE TABLE `diagnostics` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_name` varchar(50) NOT NULL,
  `location_id` int(11) NOT NULL,
  `address` longtext NOT NULL,
  `phone` varchar(11) NOT NULL,
  `alternate` int(11) NOT NULL,
  `home_col` tinyint(4) NOT NULL DEFAULT 0,
  `email` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diagnostics`
--

INSERT INTO `diagnostics` (`id`, `user_id`, `shop_name`, `location_id`, `address`, `phone`, `alternate`, `home_col`, `email`, `created_at`, `updated_at`) VALUES
(1, 9, 'Niresh Diagnostic Centre', 1, 'Demo Road, Burdwan', '7636154258', 0, 1, 'n@gtserve.com', '2021-03-09 14:37:54', '2021-02-18 10:13:05');

-- --------------------------------------------------------

--
-- Table structure for table `diagnostic_details`
--

CREATE TABLE `diagnostic_details` (
  `id` int(11) NOT NULL,
  `diagnostic_id` int(11) NOT NULL,
  `test` varchar(25) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `show_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diagnostic_details`
--

INSERT INTO `diagnostic_details` (`id`, `diagnostic_id`, `test`, `price`, `created_at`, `updated_at`, `show_price`) VALUES
(1, 1, 'X-ray', 600, '2021-03-05 16:51:28', '2021-02-18 10:20:56', 650),
(2, 1, 'Glucose,Fasting (F)', 50, '2021-03-05 16:51:34', '2021-02-18 10:20:56', 80);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `special_id` int(11) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `qualification` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT 0,
  `location_id` int(11) NOT NULL,
  `pc_time` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `special_id`, `Name`, `qualification`, `created_at`, `updated_at`, `user_id`, `location_id`, `pc_time`) VALUES
(1, 1, 'Dr.Thakral', 'MBBS', '2021-03-15 08:46:50', '2021-02-16 13:53:17', NULL, 1, NULL),
(2, 1, 'Dr.Siraj', 'MBBS,MD', '2021-02-17 14:29:23', '2021-02-16 14:40:52', 5, 1, NULL),
(3, 2, 'Abcd DM', 'Mbbs,MS', '2021-03-16 10:59:32', '2021-03-16 05:29:32', 14, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_clinics`
--

CREATE TABLE `doctor_clinics` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `clinic_id` int(11) NOT NULL,
  `fees` int(11) NOT NULL,
  `day` varchar(15) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `discount` int(11) NOT NULL DEFAULT 0,
  `pc_time` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor_clinics`
--

INSERT INTO `doctor_clinics` (`id`, `doctor_id`, `clinic_id`, `fees`, `day`, `start`, `end`, `created_at`, `updated_at`, `discount`, `pc_time`) VALUES
(1, 1, 1, 500, 'Sunday', '17:00:00', '20:30:00', '2021-03-14 20:08:45', '2021-03-14 20:08:45', 50, NULL),
(2, 1, 1, 500, 'Tuesday', '15:30:00', '18:30:00', '2021-03-14 20:10:44', '2021-03-14 20:10:44', 0, NULL),
(3, 2, 3, 500, 'Monday', '15:00:00', '17:00:00', '2021-03-15 06:25:09', '2021-03-15 06:25:09', 0, NULL),
(4, 2, 1, 500, 'Tuesday', '17:00:00', '19:30:00', '2021-03-15 06:26:31', '2021-03-15 06:26:31', 50, NULL),
(5, 3, 1, 500, 'Sunday', '04:00:00', '07:00:00', '2021-03-20 05:04:59', '2021-03-19 23:34:59', 400, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_specializations`
--

CREATE TABLE `doctor_specializations` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor_specializations`
--

INSERT INTO `doctor_specializations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'General Medicine', '2021-02-16 13:01:28', '2021-02-16 13:01:28'),
(2, 'General Surgeon', '2021-02-16 13:01:28', '2021-02-16 13:01:28'),
(3, 'Skin Specialist', '2021-02-16 13:02:01', '2021-02-16 13:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(11) NOT NULL,
  `frontend_color` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default',
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `footer_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_login_background` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_login_sidebar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_plus` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `frontend_color`, `logo`, `footer_logo`, `admin_logo`, `admin_login_background`, `admin_login_sidebar`, `favicon`, `site_name`, `address`, `description`, `phone`, `email`, `facebook`, `instagram`, `twitter`, `youtube`, `google_plus`, `created_at`, `updated_at`) VALUES
(1, '1', 'uploads/logo/512.jpg', NULL, 'uploads/admin_logo/wCgHrz0Q5QoL1yu4vdrNnQIr4uGuNL48CXfcxOuS.png', NULL, NULL, 'uploads/img/favicon.jpg', 'Medigenco', 'TPBUSY SOLUTIONS\r\nDL188 SALTLAKE CITY, SECTOR-II \r\nKOLKATA 700091', 'marketplace.', '7894561230', 'Hello@tpbuysolutions.com', 'https://www.facebook.com', 'https://www.instagram.com', 'https://www.twitter.com', 'https://www.youtube.com', 'https://www.googleplus.com', '2021-03-15 11:39:09', '2020-10-21 08:19:15');

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hospital_name` varchar(100) NOT NULL,
  `address` longtext NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `location_id` int(11) NOT NULL,
  `alternate_no` varchar(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `user_id`, `hospital_name`, `address`, `phone`, `email`, `location_id`, `alternate_no`, `created_at`, `updated_at`) VALUES
(1, 7, 'Yureka Health Care Nursing Home', 'Burdwan ABCD Road,Burdwan,West Bengal', '8569741253', 'ask@yureka.com', 1, '8475635249', '2021-02-17 13:58:01', '2021-02-17 13:58:01'),
(2, 22, 'Rebet Nursing Home', 'Rebet Road, Burdwan', '9475696385', '', 1, NULL, '2021-03-21 13:59:39', '2021-03-21 08:29:39');

-- --------------------------------------------------------

--
-- Table structure for table `hospital_details`
--

CREATE TABLE `hospital_details` (
  `id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `bed_type` varchar(50) NOT NULL,
  `total_beds` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `show_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospital_details`
--

INSERT INTO `hospital_details` (`id`, `hospital_id`, `bed_type`, `total_beds`, `price`, `created_at`, `updated_at`, `show_price`) VALUES
(1, 1, 'Normal', 50, 300, '2021-03-05 16:43:50', '2021-02-17 13:59:15', 350),
(2, 1, 'Semi Fowler Bed', 25, 600, '2021-03-05 16:43:54', '2021-02-17 13:59:15', 650);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rtl` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `rtl`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 0, '2019-01-20 12:13:20', '2019-01-20 12:13:20'),
(3, 'Bangla', 'bd', 0, '2019-02-17 06:35:37', '2019-02-18 06:49:51'),
(4, 'Arabic', 'sa', 1, '2019-04-28 18:34:12', '2019-04-28 18:34:12');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(4) NOT NULL,
  `name` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Burdwan', '2021-02-16 13:00:31', '2021-02-16 13:00:31'),
(2, 'Asansol', '2021-02-16 13:00:31', '2021-02-16 13:00:31'),
(3, 'Oddisa', '2021-03-21 13:16:55', '2021-03-21 07:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('tester@gmail.com', '$2y$10$miEd8.sR5Xw7qWeTs.ifoOZkUXs/NvMeiBOdBfwn3axJBrMKzuLKC', '2020-10-03 12:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `searches`
--

CREATE TABLE `searches` (
  `id` int(11) NOT NULL,
  `query` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `count` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `searches`
--

INSERT INTO `searches` (`id`, `query`, `count`, `created_at`, `updated_at`) VALUES
(2, 'dcs', 1, '2020-03-08 00:29:09', '2020-03-08 00:29:09'),
(3, 'das', 3, '2020-03-08 00:29:15', '2020-03-08 00:29:50'),
(4, 'Atta', 4, '2020-09-17 10:26:32', '2020-09-21 08:10:05'),
(5, 'Amul kool', 1, '2020-09-17 19:40:37', '2020-09-17 19:40:37'),
(6, 'Amul', 23, '2020-09-18 09:50:33', '2020-09-24 06:59:17'),
(7, 'Cooking essentials', 2, '2020-09-18 10:15:41', '2020-09-18 10:16:09'),
(8, 'Amul milk', 1, '2020-09-18 13:58:05', '2020-09-18 13:58:05'),
(9, 'milk', 2, '2020-09-18 13:58:17', '2020-09-22 12:09:01'),
(10, 'Kmp', 12, '2020-09-22 12:09:20', '2020-09-23 05:11:46'),
(11, 'Amul fresh cream 250 ml tp', 1, '2020-09-22 14:55:15', '2020-09-22 14:55:15'),
(12, 'Golden crown', 7, '2020-09-22 17:22:26', '2020-09-22 17:23:20'),
(13, 'Mamy pogo bant', 2, '2020-09-23 05:08:55', '2020-09-23 05:09:00'),
(14, 'Mamy pogo bants', 1, '2020-09-23 05:09:17', '2020-09-23 05:09:17'),
(15, 'Everest', 4, '2020-09-24 06:53:33', '2020-09-24 06:58:08'),
(16, 'Kala jaggery', 1, '2020-09-25 17:29:50', '2020-09-25 17:29:50'),
(17, 'Rice', 1, '2020-10-03 06:42:39', '2020-10-03 06:42:39'),
(18, 'fortune', 1, '2020-10-03 08:28:41', '2020-10-03 08:28:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type` int(3) NOT NULL,
  `name` varchar(25) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `dev_key` varchar(100) DEFAULT NULL,
  `location_id` int(11) DEFAULT 0,
  `otp` varchar(10) NOT NULL,
  `postal_code` varchar(8) DEFAULT NULL,
  `country` varchar(25) DEFAULT NULL,
  `city` varchar(25) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `refferel` varchar(100) DEFAULT NULL,
  `wallet` int(10) NOT NULL DEFAULT 0,
  `verified` tinyint(3) NOT NULL DEFAULT 0,
  `alternate_no` varchar(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `remember_token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `name`, `phone`, `address`, `password`, `dev_key`, `location_id`, `otp`, `postal_code`, `country`, `city`, `created_at`, `updated_at`, `refferel`, `wallet`, `verified`, `alternate_no`, `email`, `remember_token`) VALUES
(1, 1, 'Admin', '9685987485', 'admin Street, admin state', '$2y$10$ZTcJT5kC/X1/IBlNz.k/3.fGIe/WeqfG7IfBfVvOwwa6/tTcLSG3y', 'ujkffjkashbdharsyajksndbhjabsfghygasfhvashjdytgasdygasgdjnga', 0, '123456', '700075', 'India', 'Kolkata', '2021-03-18 13:20:10', '2021-02-16 13:15:50', 'hjgashasjaksmdajsgduy', 0, 1, NULL, NULL, '0UtmIIKswoX3UwdrOtAC1Tdl7XqEDhkdI9iuk3MpzRF2iijvEiwQrhAi2LmO'),
(2, 2, 'Sushant Manick', '9836754528', 'Test Road, Test state', '$2y$10$J8m6ZaI.uCbLIYCRdn.1s.oq.FWJrKxuTHcJyg/A85RJ/PY/VNUZC', 'mnbgjhfytdyvhbvghtfdtfhfvhjbftrewvghtuurfhvyf6t6t', 1, '123456', '700079', 'India', 'Burdwan', '2021-02-16 13:25:04', '2021-02-16 13:22:28', 'hngdghdhgy', 0, 1, NULL, 'sushant@gmail.com', ''),
(3, 2, 'Ranjit Sarkar', '8526347981', 'Demo Road,Asansol', '$2y$10$eyr2t5X.84DOOmMGdr7.A.MCcmCNPi9Dfbe1MamVsqGPbzVTaGAHG', NULL, 2, '', '713301', 'India', 'Asansol', '2021-02-16 14:40:01', '2021-02-16 14:31:43', 'fgdsytugh', 0, 1, NULL, 'ranjit@gmail.com', ''),
(5, 3, 'Dr.Siraj', '9474338565', 'asasdcvcffsrfaqasdascva', '$2y$10$0thNQ8/yT8YIljupaEJAlOPTIoFVl4u8378KJh56hdW7xHw9FxiYe', NULL, 2, '123456', '713301', 'India', 'Asansol', '2021-02-16 14:40:04', '2021-02-16 14:39:38', 'hgdhggchgjghd', 0, 1, NULL, NULL, ''),
(6, 7, 'Swarnadeep', '7872003338', 'G.N.P.C Road,Ranaghat', '$2y$10$v9aa9suFWLOR..P.q.as5uAvm/zl0Kk2mRfThHU5zsCDoBEAwYDty', NULL, 1, '5468125', '713103', 'India', 'Burdwan', '2021-02-19 09:32:15', '2021-02-19 04:02:15', NULL, 0, 0, NULL, 'swarnadeeppramanick2@gmail.com', ''),
(7, 4, 'Jagjit Singh', '8647852563', 'abcd road,test', '$2y$10$poNlGleXiJBwhRjfzZ/GHOj9hWKndKGDfGH8onZwOoKdME96f/gyq', 'asdasdxcvscfvsdfasd', 1, '123456', '700075', 'India', 'Burdwan', '2021-02-18 10:39:28', '2021-02-18 05:09:28', NULL, 0, 1, NULL, NULL, ''),
(8, 6, 'Suresh', '9685987485', 'test road', '$2y$10$A8ALFxjCFSosDpckPjw2/udWzOeodYhtUIGCR92tBfWXEnYsegFi2', '$2y$10$A8ALFxjCFSosDpc', 1, '123456', '700075', 'India', 'Burdwan', '2021-02-18 10:43:30', '2021-02-18 05:13:30', NULL, 0, 1, NULL, NULL, ''),
(9, 5, 'Niresh', '6486325874', 'TestDet', '$2y$10$Ra8gvYbUzDcrMYF8aJeWIeHRUG5gyDhn8ZiMM/m9xJgIW4Ax7cYMW', '$2y$10$Ra8gvYbUzDcrMYF8aJe', 1, '123456', '713301', 'India', 'Burdwan', '2021-02-18 10:11:24', '2021-02-18 10:11:24', '$2y$10$Ra8gvYbUzDcrMYF8aJe', 0, 1, '8475635249', NULL, ''),
(10, 7, 'Somenath', '9876543210', NULL, '$2y$10$28CFOxGFHI31MKev0JeBWu9kH7TgdKuaCCsKFWRILZRvPAQUoli9i', NULL, 1, '5468125', NULL, NULL, NULL, '2021-03-04 16:45:58', '2021-03-04 11:15:58', NULL, 0, 0, NULL, 'somenath@gmail.com', ''),
(11, 7, 'Santosh Nandi', '9804213931', NULL, '$2y$10$G7FACjJpK/09Y1Ue7zeWOuTCMApHUBtOcHoZo0EGsgS2mns1WVttG', 'NA', 1, '5468125', NULL, NULL, NULL, '2021-02-19 05:56:54', '2021-02-19 00:26:54', NULL, 0, 0, NULL, 'nandi.santosh@gmail.com', ''),
(12, 7, 'Sourav Sinha', '9050746506', NULL, '$2y$10$8mndnh7ea7JN58HisRDrnOmYTQJwQhcXUiVeTOOsZgMQG1b2/vbeO', 'NA', 1, '5468125', NULL, NULL, NULL, '2021-03-09 02:44:01', '2021-03-08 21:14:01', NULL, 0, 0, NULL, 'sourav.sinha21011988@gmail.com', ''),
(13, 7, 'Debashis Goswami', '8420376613', NULL, '$2y$10$aiCg1ethrDwPA2q08BwDnu5qHgSHgQKLkx6cvjKf.tfdsOG.avv5m', 'NA', 1, '5468125', NULL, NULL, NULL, '2021-03-06 06:38:43', '2021-03-06 01:08:43', NULL, 0, 0, NULL, 'debashis.pm9k@gmail.com', ''),
(14, 3, 'Abcd DM', '7908166308', 'Vill.- natungram, P.O.- Hijuli P.S.- Dhantala', '$2y$10$Se.ZvNWfskqUI9c1JW5m.O73h1enw0FmKGPCNXCLddUIA0Da1p8.6', NULL, 1, '', '741201', 'India', 'Nadia', '2021-03-16 11:02:56', '2021-03-16 05:32:56', NULL, 0, 1, NULL, NULL, ''),
(17, 2, 'Demo', '9474568324', 'asjhgduas b', '$2y$10$WtxA3aSN5AwX9f36.yYhj.96VOdCfSE/es42dkxHzNKatu5Gs6Qla', NULL, 1, '', '745263', 'India', 'jlasgdlu', '2021-03-21 12:57:50', '2021-03-21 07:27:50', NULL, 0, 1, NULL, NULL, ''),
(18, 2, 'asdas', '13213', 'asdad', '$2y$10$v02syqLJuztOd.BRKl6hI.CRPfjndz47UAcLqzZ3.rwreMgRtGZw6', NULL, 1, '', '741201', 'India', 'Nadia', '2021-03-20 01:23:17', '2021-03-20 01:23:17', NULL, 0, 1, NULL, NULL, ''),
(19, 2, 'Rebet', '8635796428', 'asdasdadasdasd', '$2y$10$ArRVBwTqpfFDk53JTmQXA.vjkjXhhK6991ZCXAgMVgMFyDflji/uu', NULL, 3, '', '745698', 'India', 'Noide', '2021-03-21 08:14:27', '2021-03-21 08:14:27', NULL, 0, 1, NULL, NULL, ''),
(20, 2, 'Rebet', '8635796428', 'asdasdadasdasd', '$2y$10$bUoFuBB3Zwpqrpb5SwPsd.AC.H5rdbYY/nwVVgHFjJMxb/Ta72Xde', NULL, 3, '', '745698', 'India', 'Noide', '2021-03-21 08:14:55', '2021-03-21 08:14:55', NULL, 0, 1, NULL, NULL, ''),
(21, 2, 'Rebet', '8635796428', 'asdasdadasdasd', '$2y$10$aQmn070lxA8iFTRw.icPsejBCHzYLPAJ5rwf7nhwG9Ok3gDsD3Zwe', NULL, 3, '', '745698', 'India', 'Noide', '2021-03-21 08:15:26', '2021-03-21 08:15:26', NULL, 0, 1, NULL, NULL, ''),
(22, 2, 'Rebet', '8635796428', 'asdasdadasdasd', '$2y$10$nmAczyN9QJUs5m3SK37Uz.Xr6cQMvKLEqT1OAOUXSVvJEUCvm/PFa', NULL, 1, '', '745698', 'India', 'Noide', '2021-03-21 13:59:39', '2021-03-21 08:29:39', NULL, 0, 1, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2021-02-16 13:10:37', '2021-02-16 13:10:37'),
(2, 'Clinic', '2021-02-16 13:10:37', '2021-02-16 13:10:37'),
(3, 'Doctor', '2021-02-16 13:10:55', '2021-02-16 13:10:55'),
(4, 'Hospital', '2021-02-16 13:10:55', '2021-02-16 13:10:55'),
(5, 'Diagnostics', '2021-02-16 13:11:32', '2021-02-16 13:11:32'),
(6, 'Ambulance', '2021-02-16 13:11:32', '2021-02-16 13:11:32'),
(7, 'Client', '2021-02-16 13:11:43', '2021-02-16 13:11:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addons`
--
ALTER TABLE `addons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ambulances`
--
ALTER TABLE `ambulances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ambulance_details`
--
ALTER TABLE `ambulance_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clinics`
--
ALTER TABLE `clinics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diagnostics`
--
ALTER TABLE `diagnostics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diagnostic_details`
--
ALTER TABLE `diagnostic_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_clinics`
--
ALTER TABLE `doctor_clinics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_specializations`
--
ALTER TABLE `doctor_specializations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospital_details`
--
ALTER TABLE `hospital_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `searches`
--
ALTER TABLE `searches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addons`
--
ALTER TABLE `addons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ambulances`
--
ALTER TABLE `ambulances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ambulance_details`
--
ALTER TABLE `ambulance_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clinics`
--
ALTER TABLE `clinics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `diagnostics`
--
ALTER TABLE `diagnostics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `diagnostic_details`
--
ALTER TABLE `diagnostic_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctor_clinics`
--
ALTER TABLE `doctor_clinics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doctor_specializations`
--
ALTER TABLE `doctor_specializations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hospital_details`
--
ALTER TABLE `hospital_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `searches`
--
ALTER TABLE `searches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
