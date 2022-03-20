-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2022 at 04:04 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agriculture`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('admin','employee') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `province_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `village_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `birthdate` date DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `firstname`, `lastname`, `email`, `phone`, `type`, `email_verified_at`, `password`, `address1`, `address2`, `country_id`, `province_id`, `area_id`, `state_id`, `village_id`, `department_id`, `birthdate`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mostafa', 'Ali', 'admin@app.com', '01015558628', 'admin', NULL, '$2y$10$idC358NYnnmcLy1KjN/oresg37Q1seAbEy7pN./WlXJrbUxGwMTd2', 'cairo', 'alex', 1, 1, 1, 1, 1, 1, '2000-01-01', '41w4DKlN9P', '2022-03-20 00:24:17', '2022-03-20 00:24:17'),
(2, 'yyy', 'yyy', 'yyy@app.com', '01015588628', 'admin', NULL, '$2y$10$8GUAyVcD3L8jPxeLlgeTE.ov4pMybu04f/TGBvXUiE6TgVLltgy66', 'cairo', 'alex', 2, 2, 2, 2, 2, 2, '2000-01-01', 'olkjDhYk2p', '2022-03-20 00:24:19', '2022-03-20 00:24:19'),
(4, 'Adonis Champlin PhD', 'Jessy Maggio', 'hwolf@example.com', '94733849362', 'admin', '2022-03-20 00:24:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '641 Feest Estates Apt. 926', '7656 Dario Ranch', 5, 3, 4, 1, 1, 2, '1970-02-15', 'zAeeHdvE7Z', '2022-03-20 00:24:21', '2022-03-20 00:24:21'),
(7, 'Aubree Heidenreich', 'Prof. Elda Rempel II', 'hansen.leatha@example.com', '98007856099', 'admin', '2022-03-20 00:24:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '8389 Amy Way Suite 946', '754 Dietrich Grove Apt. 366', 1, 2, 9, 2, 4, 1, '2000-01-04', 'BCmtef7qC2', '2022-03-20 00:24:21', '2022-03-20 00:24:21'),
(10, 'Meda Reinger', 'Vincent Macejkovic', 'jannie.volkman@example.net', '36737468440', 'admin', '2022-03-20 00:24:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '741 Ferry Mountains', '84380 Buckridge Drive Suite 090', 2, 4, 5, 2, 4, 2, '1981-09-13', 'MwsLEVwjYn', '2022-03-20 00:24:21', '2022-03-20 00:24:21'),
(14, 'Albert Hagenes Jr.', 'Mr. Clyde Morar MD', 'dooley.jazmin@example.com', '01631397577', 'admin', '2022-03-20 00:24:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '41047 Hintz Stravenue Suite 100', '97685 Towne Ramp Suite 106', 5, 2, 12, 1, 3, 1, '1973-05-01', 'acMrjyDDXX', '2022-03-20 00:24:21', '2022-03-20 00:24:21'),
(18, 'Derrick Ward', 'Enoch Rice', 'glenda.renner@example.com', '58136520071', 'admin', '2022-03-20 00:24:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '81797 Kreiger Landing Apt. 877', '82165 Harber Groves Apt. 544', 4, 3, 15, 1, 2, 3, '1982-07-11', 'sirXJnHeLw', '2022-03-20 00:24:21', '2022-03-20 00:24:21'),
(25, 'Prof. Art Christiansen DDS', 'Michelle Rippin', 'malinda10@example.com', '99747015061', 'admin', '2022-03-20 00:24:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '191 Kellie Turnpike Suite 595', '94841 Carolyne Mountains', 4, 3, 6, 1, 1, 3, '1990-08-02', '4KWmDjQFdA', '2022-03-20 00:24:22', '2022-03-20 00:24:22'),
(26, 'Mr. Waldo Bergnaum', 'Mr. Manuel Reichert', 'emmerich.jamar@example.org', '69519171381', 'admin', '2022-03-20 00:24:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '74548 Hoppe Springs', '9759 Gleichner Drive Suite 932', 3, 5, 3, 2, 2, 1, '1975-10-20', 'klXXVSB1xh', '2022-03-20 00:24:22', '2022-03-20 00:24:22'),
(32, 'Lurline Schultz', 'Ludie Ebert', 'evangeline69@example.org', '70187837983', 'admin', '2022-03-20 00:24:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '308 Heath Turnpike', '547 Block Turnpike Apt. 547', 3, 4, 15, 2, 4, 1, '1990-06-06', 'lf8kXQIBM0', '2022-03-20 00:24:22', '2022-03-20 00:24:22');

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `province_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `province_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(2, 1, '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(3, 1, '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(4, 1, '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(5, 1, '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(6, 2, '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(8, 2, '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(9, 2, '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(11, 3, '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(12, 3, '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(13, 3, '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(14, 3, '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(15, 3, '2022-03-20 00:24:16', '2022-03-20 00:24:16');

-- --------------------------------------------------------

--
-- Table structure for table `area_translations`
--

CREATE TABLE `area_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `area_translations`
--

INSERT INTO `area_translations` (`id`, `name`, `locale`, `area_id`, `created_at`, `updated_at`) VALUES
(1, 'الرمادى', 'ar', 1, NULL, NULL),
(2, 'الفلوجه', 'ar', 2, NULL, NULL),
(3, 'القائم', 'ar', 3, NULL, NULL),
(4, 'الحبانيه', 'ar', 4, NULL, NULL),
(5, 'الجزيره', 'ar', 5, NULL, NULL),
(6, 'زاخو', 'ar', 6, NULL, NULL),
(8, 'العماديه', 'ar', 8, NULL, NULL),
(9, 'sumail', 'ar', 9, NULL, NULL),
(11, 'الكرخ', 'ar', 11, NULL, NULL),
(12, 'المدائن', 'ar', 12, NULL, NULL),
(13, 'الاعظميه', 'ar', 13, NULL, NULL),
(14, 'الكاظميه', 'ar', 14, NULL, NULL),
(15, 'المحموديه', 'ar', 15, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_flag.jpg',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_logo`, `created_at`, `updated_at`) VALUES
(1, 'default_flag.jpg', '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(2, 'default_flag.jpg', '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(3, 'default_flag.jpg', '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(4, 'default_flag.jpg', '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(5, 'default_flag.jpg', '2022-03-20 00:24:16', '2022-03-20 00:24:16');

-- --------------------------------------------------------

--
-- Table structure for table `country_translations`
--

CREATE TABLE `country_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `country_translations`
--

INSERT INTO `country_translations` (`id`, `name`, `locale`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'العراق', 'ar', 1, NULL, NULL),
(2, 'مصر', 'ar', 2, NULL, NULL),
(3, 'السعوديه', 'ar', 3, NULL, NULL),
(4, 'سوريا', 'ar', 4, NULL, NULL),
(5, 'فلسطين', 'ar', 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `state_id`, `country_id`, `parent_id`, `slug`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'القسم_الحيوانى', NULL, NULL, '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(2, 2, 2, NULL, 'القسم_الزراعى', NULL, NULL, '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(3, 3, 1, NULL, 'قسم_الالبان', NULL, NULL, '2022-03-20 00:24:16', '2022-03-20 00:24:16');

-- --------------------------------------------------------

--
-- Table structure for table `department_translations`
--

CREATE TABLE `department_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department_translations`
--

INSERT INTO `department_translations` (`id`, `locale`, `department_id`, `name`, `description`, `keyword`, `created_at`, `updated_at`) VALUES
(1, 'ar', 1, 'القسم الحيوانى', 'وصف القسم الحيوانى', 'كلمات القسم الحيوانى', NULL, NULL),
(2, 'ar', 2, 'القسم الزراعى', 'وصف القسم الزراعى', 'كلمات القسم الزراعى', NULL, NULL),
(3, 'ar', 3, 'قسم الالبان', 'وصف قسم الالبان', 'كلمات قسم الالبان', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `province_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `village_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `birthdate` date DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`id`, `firstname`, `lastname`, `email`, `password`, `phone`, `address1`, `address2`, `country_id`, `province_id`, `area_id`, `state_id`, `village_id`, `department_id`, `birthdate`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'MostafaF', 'Ali', 'farmer@app.com', '$2y$10$s8P94Pf71vfbNUocxwJCvuqN2uR8gHkCtqgE5jE9nZ.IvL1w.Yk4O', '01021555555', 'cairo', 'alex', 1, 1, 1, 1, 1, 1, '2000-01-01', NULL, '01LZRaVwzO', '2022-03-20 00:24:17', '2022-03-20 00:24:17'),
(2, 'zzz', 'zzz', 'zzz@gmail.com', '$2y$10$5IMYGTMynMyLzPG0/6nxxuWGZXz3PP6T3Q3bJgaIJmQn/SnCjzyaC', '11021493036', 'cairo', 'alex', 2, 2, 2, 2, 2, 2, '2000-01-01', NULL, 'StY78VlQcD', '2022-03-20 00:24:17', '2022-03-20 00:24:17'),
(7, 'Dr. Eleonore Daniel', 'Rex Connelly', 'rbotsford@example.net', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '99265819453', '7450 Kaleigh Coves Suite 583', '8867 Quitzon Causeway Apt. 410', 2, 2, 8, 2, 2, 1, '2009-11-17', '2022-03-20 00:24:22', '3GMupf9rf9', '2022-03-20 00:24:23', '2022-03-20 00:24:23'),
(10, 'Ethel Beahan', 'Morgan Braun', 'mcglynn.mckayla@example.org', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '64373487594', '2182 Parisian Village', '5268 Larson Centers', 4, 2, 15, 2, 4, 1, '1987-05-21', '2022-03-20 00:24:22', 'bW9Nhyf1uL', '2022-03-20 00:24:23', '2022-03-20 00:24:23'),
(16, 'Anahi Dach', 'Tressie Will', 'doyle.kira@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '43709337373', '898 Waters Estate Apt. 656', '37104 Penelope Brooks Apt. 615', 4, 5, 8, 2, 4, 2, '2003-06-25', '2022-03-20 00:24:22', 'UrAyQkE6Py', '2022-03-20 00:24:23', '2022-03-20 00:24:23'),
(17, 'Austen Jakubowski', 'Cali Williamson', 'yyost@example.org', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '58513722248', '449 Murphy Dam', '6387 Ruby Isle Apt. 408', 1, 1, 12, 2, 2, 2, '1971-09-08', '2022-03-20 00:24:22', 'txhlrTVotu', '2022-03-20 00:24:23', '2022-03-20 00:24:23'),
(21, 'Oma Kilback V', 'Alivia Runte', 'johnston.ellis@example.net', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '92238570503', '274 O\'Keefe Walk Apt. 064', '15933 Strosin Loaf Suite 366', 4, 1, 4, 2, 3, 3, '2000-07-02', '2022-03-20 00:24:22', 'Tae6QhkW3q', '2022-03-20 00:24:23', '2022-03-20 00:24:23'),
(23, 'Raleigh Greenfelder', 'Dr. Euna Ullrich Sr.', 'ookeefe@example.net', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '94082747651', '64036 Yost Estates', '9260 Hyatt Mountains', 3, 4, 2, 1, 3, 3, '2010-03-08', '2022-03-20 00:24:22', 'AgL69FxGIF', '2022-03-20 00:24:23', '2022-03-20 00:24:23'),
(26, 'Van Schultz', 'Dr. Christa Greenfelder', 'paucek.barry@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '31997326939', '585 Carroll Plain Apt. 039', '85376 Will Mills Suite 325', 4, 2, 14, 2, 4, 1, '2016-08-28', '2022-03-20 00:24:22', 'fAlSF4dLxA', '2022-03-20 00:24:23', '2022-03-20 00:24:23'),
(29, 'Beatrice Conn', 'Tre Schimmel', 'boyle.toney@example.net', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '11760962146', '1988 Gaylord Coves', '1680 Purdy Flat', 3, 5, 12, 2, 5, 3, '2010-08-09', '2022-03-20 00:24:22', 'BL2Yxn1eCG', '2022-03-20 00:24:24', '2022-03-20 00:24:24'),
(31, 'Shakira Okuneva', 'Celestine Wunsch', 'dooley.otilia@example.net', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '22207739227', '44909 Parisian Plains Apt. 529', '100 Boris Unions Suite 295', 1, 4, 6, 2, 2, 3, '1993-04-26', '2022-03-20 00:24:22', 'c2CYdRIVkd', '2022-03-20 00:24:25', '2022-03-20 00:24:25');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relation_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_sliders`
--

CREATE TABLE `home_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageable_id` int(11) NOT NULL,
  `imageable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `filename`, `imageable_id`, `imageable_type`, `created_at`, `updated_at`) VALUES
(1, '3.jpg', 1, 'App\\Models\\User', NULL, NULL),
(2, '9.jpg', 2, 'App\\Models\\User', NULL, NULL),
(3, '1.jpg', 3, 'App\\Models\\User', NULL, NULL),
(4, '8.jpg', 4, 'App\\Models\\User', NULL, NULL),
(5, '1.jpg', 5, 'App\\Models\\User', NULL, NULL),
(6, '8.jpg', 6, 'App\\Models\\User', NULL, NULL),
(7, '6.jpg', 7, 'App\\Models\\User', NULL, NULL),
(8, '8.jpg', 8, 'App\\Models\\User', NULL, NULL),
(9, '9.jpg', 9, 'App\\Models\\User', NULL, NULL),
(10, '1.jpg', 10, 'App\\Models\\User', NULL, NULL),
(11, '3.jpg', 11, 'App\\Models\\User', NULL, NULL),
(12, '7.jpg', 12, 'App\\Models\\User', NULL, NULL),
(13, '3.jpg', 13, 'App\\Models\\User', NULL, NULL),
(14, '9.jpg', 14, 'App\\Models\\User', NULL, NULL),
(15, '3.jpg', 15, 'App\\Models\\User', NULL, NULL),
(16, '5.jpg', 16, 'App\\Models\\User', NULL, NULL),
(17, '7.jpg', 17, 'App\\Models\\User', NULL, NULL),
(18, '8.jpg', 18, 'App\\Models\\User', NULL, NULL),
(19, '2.jpg', 19, 'App\\Models\\User', NULL, NULL),
(20, '5.jpg', 20, 'App\\Models\\User', NULL, NULL),
(21, '9.jpg', 21, 'App\\Models\\User', NULL, NULL),
(22, '6.jpg', 22, 'App\\Models\\User', NULL, NULL),
(23, '8.jpg', 23, 'App\\Models\\User', NULL, NULL),
(24, '4.jpg', 24, 'App\\Models\\User', NULL, NULL),
(25, '8.jpg', 25, 'App\\Models\\User', NULL, NULL),
(26, '7.jpg', 26, 'App\\Models\\User', NULL, NULL),
(27, '7.jpg', 27, 'App\\Models\\User', NULL, NULL),
(28, '1.jpg', 28, 'App\\Models\\User', NULL, NULL),
(29, '9.jpg', 29, 'App\\Models\\User', NULL, NULL),
(30, '9.jpg', 30, 'App\\Models\\User', NULL, NULL),
(31, '8.jpg', 31, 'App\\Models\\User', NULL, NULL),
(32, '3.jpg', 32, 'App\\Models\\User', NULL, NULL),
(33, '3.jpg', 1, 'App\\Models\\Farmer', NULL, NULL),
(34, '9.jpg', 2, 'App\\Models\\Farmer', NULL, NULL),
(35, '2.jpg', 3, 'App\\Models\\Farmer', NULL, NULL),
(36, '5.jpg', 4, 'App\\Models\\Farmer', NULL, NULL),
(37, '8.jpg', 5, 'App\\Models\\Farmer', NULL, NULL),
(38, '9.jpg', 6, 'App\\Models\\Farmer', NULL, NULL),
(39, '8.jpg', 7, 'App\\Models\\Farmer', NULL, NULL),
(40, '9.jpg', 8, 'App\\Models\\Farmer', NULL, NULL),
(41, '1.jpg', 9, 'App\\Models\\Farmer', NULL, NULL),
(42, '8.jpg', 10, 'App\\Models\\Farmer', NULL, NULL),
(43, '2.jpg', 11, 'App\\Models\\Farmer', NULL, NULL),
(44, '9.jpg', 12, 'App\\Models\\Farmer', NULL, NULL),
(45, '1.jpg', 13, 'App\\Models\\Farmer', NULL, NULL),
(46, '2.jpg', 14, 'App\\Models\\Farmer', NULL, NULL),
(47, '6.jpg', 15, 'App\\Models\\Farmer', NULL, NULL),
(48, '1.jpg', 16, 'App\\Models\\Farmer', NULL, NULL),
(49, '9.jpg', 17, 'App\\Models\\Farmer', NULL, NULL),
(50, '5.jpg', 18, 'App\\Models\\Farmer', NULL, NULL),
(51, '8.jpg', 19, 'App\\Models\\Farmer', NULL, NULL),
(52, '8.jpg', 20, 'App\\Models\\Farmer', NULL, NULL),
(53, '4.jpg', 21, 'App\\Models\\Farmer', NULL, NULL),
(54, '6.jpg', 22, 'App\\Models\\Farmer', NULL, NULL),
(55, '9.jpg', 23, 'App\\Models\\Farmer', NULL, NULL),
(56, '2.jpg', 24, 'App\\Models\\Farmer', NULL, NULL),
(57, '9.jpg', 25, 'App\\Models\\Farmer', NULL, NULL),
(58, '10.jpg', 26, 'App\\Models\\Farmer', NULL, NULL),
(59, '8.jpg', 27, 'App\\Models\\Farmer', NULL, NULL),
(60, '10.jpg', 28, 'App\\Models\\Farmer', NULL, NULL),
(61, '4.jpg', 29, 'App\\Models\\Farmer', NULL, NULL),
(62, '9.jpg', 30, 'App\\Models\\Farmer', NULL, NULL),
(63, '2.jpg', 31, 'App\\Models\\Farmer', NULL, NULL),
(64, '10.jpg', 32, 'App\\Models\\Farmer', NULL, NULL),
(65, '6.jpg', 1, 'App\\Models\\Admin', NULL, NULL),
(66, '2.jpg', 2, 'App\\Models\\Admin', NULL, NULL),
(67, '7.jpg', 3, 'App\\Models\\Admin', NULL, NULL),
(68, '6.jpg', 4, 'App\\Models\\Admin', NULL, NULL),
(69, '5.jpg', 5, 'App\\Models\\Admin', NULL, NULL),
(70, '9.jpg', 6, 'App\\Models\\Admin', NULL, NULL),
(71, '2.jpg', 7, 'App\\Models\\Admin', NULL, NULL),
(72, '1.jpg', 8, 'App\\Models\\Admin', NULL, NULL),
(73, '6.jpg', 9, 'App\\Models\\Admin', NULL, NULL),
(74, '7.jpg', 10, 'App\\Models\\Admin', NULL, NULL),
(75, '8.jpg', 11, 'App\\Models\\Admin', NULL, NULL),
(76, '2.jpg', 12, 'App\\Models\\Admin', NULL, NULL),
(77, '10.jpg', 13, 'App\\Models\\Admin', NULL, NULL),
(78, '8.jpg', 14, 'App\\Models\\Admin', NULL, NULL),
(79, '2.jpg', 15, 'App\\Models\\Admin', NULL, NULL),
(80, '4.jpg', 16, 'App\\Models\\Admin', NULL, NULL),
(81, '6.jpg', 17, 'App\\Models\\Admin', NULL, NULL),
(82, '7.jpg', 18, 'App\\Models\\Admin', NULL, NULL),
(83, '8.jpg', 19, 'App\\Models\\Admin', NULL, NULL),
(84, '9.jpg', 20, 'App\\Models\\Admin', NULL, NULL),
(85, '1.jpg', 21, 'App\\Models\\Admin', NULL, NULL),
(86, '6.jpg', 22, 'App\\Models\\Admin', NULL, NULL),
(87, '7.jpg', 23, 'App\\Models\\Admin', NULL, NULL),
(88, '7.jpg', 24, 'App\\Models\\Admin', NULL, NULL),
(89, '9.jpg', 25, 'App\\Models\\Admin', NULL, NULL),
(90, '6.jpg', 26, 'App\\Models\\Admin', NULL, NULL),
(91, '6.jpg', 27, 'App\\Models\\Admin', NULL, NULL),
(92, '9.jpg', 28, 'App\\Models\\Admin', NULL, NULL),
(93, '8.jpg', 29, 'App\\Models\\Admin', NULL, NULL),
(94, '6.jpg', 30, 'App\\Models\\Admin', NULL, NULL),
(95, '5.jpg', 31, 'App\\Models\\Admin', NULL, NULL),
(96, '4.jpg', 32, 'App\\Models\\Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2022_03_07_033916_create_settings_table', 1),
(5, '2022_03_07_041141_create_setting_translations_table', 1),
(6, '2022_03_07_131831_create_images_table', 1),
(7, '2022_03_09_220156_create_files_table', 1),
(8, '2022_03_10_065612_create_contact_us_table', 1),
(9, '2022_03_10_131507_create_departments_table', 1),
(10, '2022_03_10_132039_create_department_translations_table', 1),
(11, '2022_03_14_233248_create_countries_table', 1),
(12, '2022_03_15_021616_create_country_translations_table', 1),
(13, '2022_03_15_023030_create_provinces_table', 1),
(14, '2022_03_15_023620_create_province_translations_table', 1),
(15, '2022_03_15_024046_create_areas_table', 1),
(16, '2022_03_15_024339_create_area_translations_table', 1),
(17, '2022_03_15_024849_create_states_table', 1),
(18, '2022_03_15_025320_create_state_translations_table', 1),
(19, '2022_03_15_025815_create_villages_table', 1),
(20, '2022_03_15_030129_create_village_translations_table', 1),
(21, '2022_03_16_000000_create_users_table', 1),
(22, '2022_03_16_153927_create_admins_table', 1),
(23, '2022_03_16_154134_create_farmers_table', 1),
(24, '2022_03_17_203313_create_home_sliders_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(2, 1, '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(3, 1, '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(4, 1, '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(5, 1, '2022-03-20 00:24:16', '2022-03-20 00:24:16');

-- --------------------------------------------------------

--
-- Table structure for table `province_translations`
--

CREATE TABLE `province_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `province_translations`
--

INSERT INTO `province_translations` (`id`, `name`, `locale`, `province_id`, `created_at`, `updated_at`) VALUES
(1, 'الانبار', 'ar', 1, NULL, NULL),
(2, 'دهوك', 'ar', 2, NULL, NULL),
(3, 'بغداد', 'ar', 3, NULL, NULL),
(4, 'البصره', 'ar', 4, NULL, NULL),
(5, 'كركوك', 'ar', 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_mail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inestegram` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondery_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('open','close') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `site_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `support_mail`, `facebook`, `inestegram`, `twitter`, `primary_phone`, `secondery_phone`, `status`, `site_logo`, `site_icon`, `created_at`, `updated_at`) VALUES
(1, 'https://www.google.com/', 'https://www.facebook.com/', 'https://www.google.com/', 'https://www.google.com/', '01021493036', '01021493030', 'open', NULL, NULL, '2022-03-20 00:24:21', '2022-03-20 00:24:21');

-- --------------------------------------------------------

--
-- Table structure for table `setting_translations`
--

CREATE TABLE `setting_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message_maintenance` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting_translations`
--

INSERT INTO `setting_translations` (`id`, `locale`, `setting_id`, `site_name`, `address`, `message_maintenance`) VALUES
(1, 'ar', 1, 'agro', 'iraq', 'website in maintance');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `area_id`, `created_at`, `updated_at`) VALUES
(1, 6, '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(2, 1, '2022-03-20 00:24:16', '2022-03-20 01:03:01');

-- --------------------------------------------------------

--
-- Table structure for table `state_translations`
--

CREATE TABLE `state_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `state_translations`
--

INSERT INTO `state_translations` (`id`, `name`, `locale`, `state_id`, `created_at`, `updated_at`) VALUES
(1, 'Illinois', 'ar', 1, NULL, NULL),
(2, 'Michigan', 'ar', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `province_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `village_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `birthdate` date DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `phone`, `address1`, `address2`, `country_id`, `province_id`, `area_id`, `state_id`, `village_id`, `department_id`, `birthdate`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ahmed', 'ragab', 'ahmedragabyasin2020@gmail.com', '$2y$10$v537XCXTr80AJiMIGjidZ.pND0J1XXkNtRNMQd1P7ga7L7e35855O', '01021493036', 'cairo', 'alex', 1, 1, 1, 1, 1, 1, '2000-01-01', NULL, 'YAd4GTBYeb', '2022-03-20 00:24:20', '2022-03-20 00:24:20'),
(2, 'xxx', 'xxx', 'xxx@gmail.com', '$2y$10$dY.jOvQBzAgS8tmcF9FrlO5os7Gyp9kWOPwm2LkJmXl0UYNx9oAPS', '01021493037', 'cairo', 'alex', 2, 2, 2, 2, 2, 2, '2000-01-01', NULL, '1ZBnP0gLXy', '2022-03-20 00:24:20', '2022-03-20 00:24:20'),
(4, 'Jason Pfeffer', 'Martina Cassin', 'kiera.deckow@example.org', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '11243956889', '99239 Clotilde Port', '235 Ivah Parkways Apt. 574', 1, 2, 13, 2, 5, 3, '2017-04-09', '2022-03-20 00:24:26', 'YpP3tH0a71', '2022-03-20 00:24:26', '2022-03-20 00:24:26'),
(5, 'Shyanne Hand', 'Prof. Giles Collier', 'felicity83@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '56925170554', '509 Goldner Flat', '2137 Daugherty Mountain Apt. 889', 1, 5, 12, 2, 1, 1, '1972-12-03', '2022-03-20 00:24:26', '0kTmZH8ivE', '2022-03-20 00:24:26', '2022-03-20 00:24:26'),
(9, 'Dr. Randal Daugherty V', 'Douglas Greenholt', 'williamson.frida@example.org', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '11509253259', '540 Waelchi Villages Suite 487', '3144 Bartell Points Apt. 652', 3, 4, 5, 2, 4, 2, '2011-08-30', '2022-03-20 00:24:26', 'goFKtmiMuv', '2022-03-20 00:24:26', '2022-03-20 00:24:26'),
(14, 'Naomie Skiles', 'Jaquan Kovacek', 'lessie.hills@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '95890349741', '5634 Senger Shoal Apt. 024', '307 Jarret Junction Apt. 760', 5, 5, 6, 2, 3, 1, '1992-04-19', '2022-03-20 00:24:26', 'Gu5Ktw3Oyz', '2022-03-20 00:24:27', '2022-03-20 00:24:27'),
(25, 'Reese Strosin', 'Jessyca Pacocha', 'blick.dayana@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '33910189541', '343 Chase Land', '223 Oda Spring', 2, 3, 2, 1, 2, 2, '2005-12-21', '2022-03-20 00:24:26', '0mRIxL2i5N', '2022-03-20 00:24:27', '2022-03-20 00:24:27'),
(27, 'Cordia Powlowski', 'Toni Thompson', 'bailee66@example.org', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '98603593059', '914 Beahan Gateway Apt. 775', '11758 Yost Forks Suite 112', 5, 2, 6, 1, 3, 1, '2011-06-28', '2022-03-20 00:24:26', 'AbutwEt7te', '2022-03-20 00:24:27', '2022-03-20 00:24:27'),
(28, 'Tiana Grady', 'Prof. Salvatore Ruecker V', 'abe.dibbert@example.org', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '33493190960', '198 Raoul Mountains', '254 Oda Walk Suite 282', 5, 5, 15, 1, 1, 1, '1993-06-17', '2022-03-20 00:24:26', 'fyqiKVgFtM', '2022-03-20 00:24:27', '2022-03-20 00:24:27');

-- --------------------------------------------------------

--
-- Table structure for table `villages`
--

CREATE TABLE `villages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `villages`
--

INSERT INTO `villages` (`id`, `state_id`, `created_at`, `updated_at`) VALUES
(1, 2, '2022-03-20 00:24:16', '2022-03-20 01:02:07'),
(2, 2, '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(3, 2, '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(4, 2, '2022-03-20 00:24:16', '2022-03-20 00:24:16'),
(5, 1, '2022-03-20 00:24:16', '2022-03-20 00:24:16');

-- --------------------------------------------------------

--
-- Table structure for table `village_translations`
--

CREATE TABLE `village_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `village_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `village_translations`
--

INSERT INTO `village_translations` (`id`, `name`, `locale`, `village_id`, `created_at`, `updated_at`) VALUES
(1, 'qqqqتعديل', 'ar', 1, NULL, NULL),
(2, 'tttt', 'ar', 2, NULL, NULL),
(3, 'uuuu', 'ar', 3, NULL, NULL),
(4, 'tttt', 'ar', 4, NULL, NULL),
(5, 'qqqq', 'ar', 5, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_phone_unique` (`phone`),
  ADD KEY `admins_country_id_foreign` (`country_id`),
  ADD KEY `admins_province_id_foreign` (`province_id`),
  ADD KEY `admins_area_id_foreign` (`area_id`),
  ADD KEY `admins_state_id_foreign` (`state_id`),
  ADD KEY `admins_village_id_foreign` (`village_id`),
  ADD KEY `admins_department_id_foreign` (`department_id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `areas_province_id_foreign` (`province_id`);

--
-- Indexes for table `area_translations`
--
ALTER TABLE `area_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `area_translations_area_id_locale_unique` (`area_id`,`locale`),
  ADD KEY `area_translations_name_locale_index` (`name`,`locale`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country_translations`
--
ALTER TABLE `country_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `country_translations_country_id_locale_unique` (`country_id`,`locale`),
  ADD KEY `country_translations_name_locale_index` (`name`,`locale`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_slug_unique` (`slug`),
  ADD KEY `departments_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `department_translations`
--
ALTER TABLE `department_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `department_translations_department_id_locale_unique` (`department_id`,`locale`),
  ADD KEY `department_translations_name_locale_keyword_index` (`name`,`locale`,`keyword`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `farmers_email_unique` (`email`),
  ADD UNIQUE KEY `farmers_phone_unique` (`phone`),
  ADD KEY `farmers_country_id_foreign` (`country_id`),
  ADD KEY `farmers_province_id_foreign` (`province_id`),
  ADD KEY `farmers_area_id_foreign` (`area_id`),
  ADD KEY `farmers_state_id_foreign` (`state_id`),
  ADD KEY `farmers_village_id_foreign` (`village_id`),
  ADD KEY `farmers_department_id_foreign` (`department_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_sliders`
--
ALTER TABLE `home_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provinces_country_id_foreign` (`country_id`);

--
-- Indexes for table `province_translations`
--
ALTER TABLE `province_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `province_translations_province_id_locale_unique` (`province_id`,`locale`),
  ADD KEY `province_translations_name_locale_index` (`name`,`locale`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_translations`
--
ALTER TABLE `setting_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_translations_setting_id_locale_unique` (`setting_id`,`locale`),
  ADD KEY `setting_translations_locale_index` (`locale`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `states_area_id_foreign` (`area_id`);

--
-- Indexes for table `state_translations`
--
ALTER TABLE `state_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `state_translations_state_id_locale_unique` (`state_id`,`locale`),
  ADD KEY `state_translations_name_locale_index` (`name`,`locale`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD KEY `users_country_id_foreign` (`country_id`),
  ADD KEY `users_province_id_foreign` (`province_id`),
  ADD KEY `users_area_id_foreign` (`area_id`),
  ADD KEY `users_state_id_foreign` (`state_id`),
  ADD KEY `users_village_id_foreign` (`village_id`),
  ADD KEY `users_department_id_foreign` (`department_id`);

--
-- Indexes for table `villages`
--
ALTER TABLE `villages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `villages_state_id_foreign` (`state_id`);

--
-- Indexes for table `village_translations`
--
ALTER TABLE `village_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `village_translations_village_id_locale_unique` (`village_id`,`locale`),
  ADD KEY `village_translations_name_locale_index` (`name`,`locale`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `area_translations`
--
ALTER TABLE `area_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `country_translations`
--
ALTER TABLE `country_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `department_translations`
--
ALTER TABLE `department_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_sliders`
--
ALTER TABLE `home_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `province_translations`
--
ALTER TABLE `province_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setting_translations`
--
ALTER TABLE `setting_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `state_translations`
--
ALTER TABLE `state_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `villages`
--
ALTER TABLE `villages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `village_translations`
--
ALTER TABLE `village_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admins_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admins_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admins_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admins_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admins_village_id_foreign` FOREIGN KEY (`village_id`) REFERENCES `villages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `area_translations`
--
ALTER TABLE `area_translations`
  ADD CONSTRAINT `area_translations_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `country_translations`
--
ALTER TABLE `country_translations`
  ADD CONSTRAINT `country_translations_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `department_translations`
--
ALTER TABLE `department_translations`
  ADD CONSTRAINT `department_translations_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `farmers`
--
ALTER TABLE `farmers`
  ADD CONSTRAINT `farmers_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `farmers_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `farmers_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `farmers_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `farmers_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `farmers_village_id_foreign` FOREIGN KEY (`village_id`) REFERENCES `villages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `provinces`
--
ALTER TABLE `provinces`
  ADD CONSTRAINT `provinces_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `province_translations`
--
ALTER TABLE `province_translations`
  ADD CONSTRAINT `province_translations_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `setting_translations`
--
ALTER TABLE `setting_translations`
  ADD CONSTRAINT `setting_translations_setting_id_foreign` FOREIGN KEY (`setting_id`) REFERENCES `settings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `states_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `state_translations`
--
ALTER TABLE `state_translations`
  ADD CONSTRAINT `state_translations_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_village_id_foreign` FOREIGN KEY (`village_id`) REFERENCES `villages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `villages`
--
ALTER TABLE `villages`
  ADD CONSTRAINT `villages_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `village_translations`
--
ALTER TABLE `village_translations`
  ADD CONSTRAINT `village_translations_village_id_foreign` FOREIGN KEY (`village_id`) REFERENCES `villages` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
