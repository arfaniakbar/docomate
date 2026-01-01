-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 01, 2026 at 05:05 AM
-- Server version: 8.0.30
-- PHP Version: 8.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_magang`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evidences`
--

CREATE TABLE `evidences` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` int DEFAULT NULL,
  `po_id` bigint DEFAULT NULL,
  `pangwas_id` bigint DEFAULT NULL,
  `tematik_id` bigint DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `file_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `catatan_admin` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `evidences`
--

INSERT INTO `evidences` (`id`, `project_id`, `po_id`, `pangwas_id`, `tematik_id`, `user_id`, `lokasi`, `deskripsi`, `file_path`, `status`, `catatan_admin`, `created_at`, `updated_at`) VALUES
(62, 33, 2, 27, 2, 3, 'jalan', 'jalan', '[{\"path\":\"evidences\\/33\\/0.jpg\",\"caption\":\"EV\\/ODP Solid-PB-8 AS\\/0.jpg\"},{\"path\":\"evidences\\/33\\/1.jpg\",\"caption\":\"EV\\/ODP Solid-PB-8 AS\\/1.jpg\"},{\"path\":\"evidences\\/33\\/2.jpg\",\"caption\":\"EV\\/ODP Solid-PB-8 AS\\/2.jpg\"},{\"path\":\"evidences\\/33\\/3.jpg\",\"caption\":\"EV\\/ODP Solid-PB-8 AS\\/3.jpg\"},{\"path\":\"evidences\\/33\\/4.jpg\",\"caption\":\"EV\\/ODP Solid-PB-8 AS\\/4.jpg\"},{\"path\":\"evidences\\/33\\/5.jpg\",\"caption\":\"EV\\/ODP Solid-PB-8 AS\\/5.jpg\"},{\"path\":\"evidences\\/33\\/6.jpg\",\"caption\":\"EV\\/ODP Solid-PB-8 AS\\/6.jpg\"},{\"path\":\"evidences\\/33\\/7.jpg\",\"caption\":\"EV\\/ODP Solid-PB-8 AS\\/7.jpg\"},{\"path\":\"evidences\\/33\\/IN.jpg\",\"caption\":\"EV\\/ODP Solid-PB-8 AS\\/IN.jpg\"},{\"path\":\"evidences\\/33\\/1.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/1.jpg\"},{\"path\":\"evidences\\/33\\/10-11.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/10-11.jpg\"},{\"path\":\"evidences\\/33\\/12-13.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/12-13.jpg\"},{\"path\":\"evidences\\/33\\/14-15.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/14-15.jpg\"},{\"path\":\"evidences\\/33\\/16-17.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/16-17.jpg\"},{\"path\":\"evidences\\/33\\/18-19.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/18-19.jpg\"},{\"path\":\"evidences\\/33\\/2-3.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/2-3.jpg\"},{\"path\":\"evidences\\/33\\/20-21.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/20-21.jpg\"},{\"path\":\"evidences\\/33\\/22-23-24.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/22-23-24.jpg\"},{\"path\":\"evidences\\/33\\/25.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/25.jpg\"},{\"path\":\"evidences\\/33\\/4-5.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/4-5.jpg\"},{\"path\":\"evidences\\/33\\/6-7.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/6-7.jpg\"},{\"path\":\"evidences\\/33\\/8-9.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/8-9.jpg\"},{\"path\":\"evidences\\/33\\/1.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/1.jpg\"},{\"path\":\"evidences\\/33\\/10.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/10.jpg\"},{\"path\":\"evidences\\/33\\/11.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/11.jpg\"},{\"path\":\"evidences\\/33\\/12.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/12.jpg\"},{\"path\":\"evidences\\/33\\/13.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/13.jpg\"},{\"path\":\"evidences\\/33\\/14.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/14.jpg\"},{\"path\":\"evidences\\/33\\/15.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/15.jpg\"},{\"path\":\"evidences\\/33\\/16.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/16.jpg\"},{\"path\":\"evidences\\/33\\/17.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/17.jpg\"},{\"path\":\"evidences\\/33\\/18.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/18.jpg\"},{\"path\":\"evidences\\/33\\/19.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/19.jpg\"},{\"path\":\"evidences\\/33\\/2.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/2.jpg\"},{\"path\":\"evidences\\/33\\/20.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/20.jpg\"},{\"path\":\"evidences\\/33\\/21.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/21.jpg\"},{\"path\":\"evidences\\/33\\/22.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/22.jpg\"},{\"path\":\"evidences\\/33\\/23.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/23.jpg\"},{\"path\":\"evidences\\/33\\/24.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/24.jpg\"},{\"path\":\"evidences\\/33\\/25.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/25.jpg\"},{\"path\":\"evidences\\/33\\/26.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/26.jpg\"},{\"path\":\"evidences\\/33\\/27.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/27.jpg\"},{\"path\":\"evidences\\/33\\/28.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/28.jpg\"},{\"path\":\"evidences\\/33\\/29.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/29.jpg\"},{\"path\":\"evidences\\/33\\/3.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/3.jpg\"},{\"path\":\"evidences\\/33\\/4.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/4.jpg\"},{\"path\":\"evidences\\/33\\/5.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/5.jpg\"},{\"path\":\"evidences\\/33\\/6.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/6.jpg\"},{\"path\":\"evidences\\/33\\/7.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/7.jpg\"},{\"path\":\"evidences\\/33\\/8.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/8.jpg\"},{\"path\":\"evidences\\/33\\/9.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/9.jpg\"},{\"path\":\"evidences\\/33\\/1.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/1.jpg\"},{\"path\":\"evidences\\/33\\/10.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/10.jpg\"},{\"path\":\"evidences\\/33\\/11.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/11.jpg\"},{\"path\":\"evidences\\/33\\/12.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/12.jpg\"},{\"path\":\"evidences\\/33\\/13.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/13.jpg\"},{\"path\":\"evidences\\/33\\/14.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/14.jpg\"},{\"path\":\"evidences\\/33\\/15.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/15.jpg\"},{\"path\":\"evidences\\/33\\/16.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/16.jpg\"},{\"path\":\"evidences\\/33\\/17.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/17.jpg\"},{\"path\":\"evidences\\/33\\/18.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/18.jpg\"},{\"path\":\"evidences\\/33\\/19.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/19.jpg\"},{\"path\":\"evidences\\/33\\/2.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/2.jpg\"},{\"path\":\"evidences\\/33\\/20.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/20.jpg\"},{\"path\":\"evidences\\/33\\/21.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/21.jpg\"},{\"path\":\"evidences\\/33\\/22.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/22.jpg\"},{\"path\":\"evidences\\/33\\/23.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/23.jpg\"},{\"path\":\"evidences\\/33\\/24.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/24.jpg\"},{\"path\":\"evidences\\/33\\/25.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/25.jpg\"},{\"path\":\"evidences\\/33\\/26.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/26.jpg\"},{\"path\":\"evidences\\/33\\/27.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/27.jpg\"},{\"path\":\"evidences\\/33\\/28.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/28.jpg\"},{\"path\":\"evidences\\/33\\/3.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/3.jpg\"},{\"path\":\"evidences\\/33\\/4.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/4.jpg\"},{\"path\":\"evidences\\/33\\/5.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/5.jpg\"},{\"path\":\"evidences\\/33\\/6.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/6.jpg\"},{\"path\":\"evidences\\/33\\/7.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/7.jpg\"},{\"path\":\"evidences\\/33\\/8.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/8.jpg\"},{\"path\":\"evidences\\/33\\/9.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/9.jpg\"},{\"path\":\"evidences\\/33\\/0.jpg\",\"caption\":\"EV\\/ODP Solid-PB-8 AS\\/0.jpg\"},{\"path\":\"evidences\\/33\\/1.jpg\",\"caption\":\"EV\\/ODP Solid-PB-8 AS\\/1.jpg\"},{\"path\":\"evidences\\/33\\/2.jpg\",\"caption\":\"EV\\/ODP Solid-PB-8 AS\\/2.jpg\"},{\"path\":\"evidences\\/33\\/3.jpg\",\"caption\":\"EV\\/ODP Solid-PB-8 AS\\/3.jpg\"},{\"path\":\"evidences\\/33\\/4.jpg\",\"caption\":\"EV\\/ODP Solid-PB-8 AS\\/4.jpg\"},{\"path\":\"evidences\\/33\\/5.jpg\",\"caption\":\"EV\\/ODP Solid-PB-8 AS\\/5.jpg\"},{\"path\":\"evidences\\/33\\/6.jpg\",\"caption\":\"EV\\/ODP Solid-PB-8 AS\\/6.jpg\"},{\"path\":\"evidences\\/33\\/7.jpg\",\"caption\":\"EV\\/ODP Solid-PB-8 AS\\/7.jpg\"},{\"path\":\"evidences\\/33\\/IN.jpg\",\"caption\":\"EV\\/ODP Solid-PB-8 AS\\/IN.jpg\"},{\"path\":\"evidences\\/33\\/1.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/1.jpg\"},{\"path\":\"evidences\\/33\\/10-11.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/10-11.jpg\"},{\"path\":\"evidences\\/33\\/12-13.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/12-13.jpg\"},{\"path\":\"evidences\\/33\\/14-15.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/14-15.jpg\"},{\"path\":\"evidences\\/33\\/16-17.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/16-17.jpg\"},{\"path\":\"evidences\\/33\\/18-19.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/18-19.jpg\"},{\"path\":\"evidences\\/33\\/2-3.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/2-3.jpg\"},{\"path\":\"evidences\\/33\\/20-21.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/20-21.jpg\"},{\"path\":\"evidences\\/33\\/22-23-24.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/22-23-24.jpg\"},{\"path\":\"evidences\\/33\\/25.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/25.jpg\"},{\"path\":\"evidences\\/33\\/4-5.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/4-5.jpg\"},{\"path\":\"evidences\\/33\\/6-7.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/6-7.jpg\"},{\"path\":\"evidences\\/33\\/8-9.jpg\",\"caption\":\"EV\\/PU-AS-DE-5070\\/8-9.jpg\"},{\"path\":\"evidences\\/33\\/1.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/1.jpg\"},{\"path\":\"evidences\\/33\\/10.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/10.jpg\"},{\"path\":\"evidences\\/33\\/11.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/11.jpg\"},{\"path\":\"evidences\\/33\\/12.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/12.jpg\"},{\"path\":\"evidences\\/33\\/13.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/13.jpg\"},{\"path\":\"evidences\\/33\\/14.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/14.jpg\"},{\"path\":\"evidences\\/33\\/15.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/15.jpg\"},{\"path\":\"evidences\\/33\\/16.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/16.jpg\"},{\"path\":\"evidences\\/33\\/17.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/17.jpg\"},{\"path\":\"evidences\\/33\\/18.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/18.jpg\"},{\"path\":\"evidences\\/33\\/19.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/19.jpg\"},{\"path\":\"evidences\\/33\\/2.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/2.jpg\"},{\"path\":\"evidences\\/33\\/20.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/20.jpg\"},{\"path\":\"evidences\\/33\\/21.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/21.jpg\"},{\"path\":\"evidences\\/33\\/22.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/22.jpg\"},{\"path\":\"evidences\\/33\\/23.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/23.jpg\"},{\"path\":\"evidences\\/33\\/24.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/24.jpg\"},{\"path\":\"evidences\\/33\\/25.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/25.jpg\"},{\"path\":\"evidences\\/33\\/26.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/26.jpg\"},{\"path\":\"evidences\\/33\\/27.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/27.jpg\"},{\"path\":\"evidences\\/33\\/28.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/28.jpg\"},{\"path\":\"evidences\\/33\\/29.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/29.jpg\"},{\"path\":\"evidences\\/33\\/3.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/3.jpg\"},{\"path\":\"evidences\\/33\\/4.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/4.jpg\"},{\"path\":\"evidences\\/33\\/5.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/5.jpg\"},{\"path\":\"evidences\\/33\\/6.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/6.jpg\"},{\"path\":\"evidences\\/33\\/7.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/7.jpg\"},{\"path\":\"evidences\\/33\\/8.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/8.jpg\"},{\"path\":\"evidences\\/33\\/9.jpg\",\"caption\":\"EV\\/PU-AS-SC\\/9.jpg\"},{\"path\":\"evidences\\/33\\/1.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/1.jpg\"},{\"path\":\"evidences\\/33\\/10.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/10.jpg\"},{\"path\":\"evidences\\/33\\/11.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/11.jpg\"},{\"path\":\"evidences\\/33\\/12.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/12.jpg\"},{\"path\":\"evidences\\/33\\/13.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/13.jpg\"},{\"path\":\"evidences\\/33\\/14.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/14.jpg\"},{\"path\":\"evidences\\/33\\/15.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/15.jpg\"},{\"path\":\"evidences\\/33\\/16.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/16.jpg\"},{\"path\":\"evidences\\/33\\/17.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/17.jpg\"},{\"path\":\"evidences\\/33\\/18.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/18.jpg\"},{\"path\":\"evidences\\/33\\/19.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/19.jpg\"},{\"path\":\"evidences\\/33\\/2.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/2.jpg\"},{\"path\":\"evidences\\/33\\/20.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/20.jpg\"},{\"path\":\"evidences\\/33\\/21.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/21.jpg\"},{\"path\":\"evidences\\/33\\/22.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/22.jpg\"},{\"path\":\"evidences\\/33\\/23.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/23.jpg\"},{\"path\":\"evidences\\/33\\/24.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/24.jpg\"},{\"path\":\"evidences\\/33\\/25.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/25.jpg\"},{\"path\":\"evidences\\/33\\/26.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/26.jpg\"},{\"path\":\"evidences\\/33\\/27.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/27.jpg\"},{\"path\":\"evidences\\/33\\/28.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/28.jpg\"},{\"path\":\"evidences\\/33\\/3.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/3.jpg\"},{\"path\":\"evidences\\/33\\/4.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/4.jpg\"},{\"path\":\"evidences\\/33\\/5.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/5.jpg\"},{\"path\":\"evidences\\/33\\/6.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/6.jpg\"},{\"path\":\"evidences\\/33\\/7.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/7.jpg\"},{\"path\":\"evidences\\/33\\/8.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/8.jpg\"},{\"path\":\"evidences\\/33\\/9.jpg\",\"caption\":\"EV\\/PU-S7.0-400NM\\/9.jpg\"}]', 'approved', NULL, '2026-01-01 04:58:59', '2026-01-01 05:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_25_015448_create_evidence_table', 1),
(5, '2025_09_25_053205_add_status_to_evidences_table', 1),
(6, '2025_10_10_023002_rename_judul_to_lokasi_in_evidences_table', 1),
(7, '2025_10_14_055929_ubah_kolom_file_path_pada_tabel_evidences', 2),
(8, '2025_10_23_005048_alter_file_path_column_on_evidences_table', 3),
(9, '2025_10_26_110654_create_sessions_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pangwas`
--

CREATE TABLE `pangwas` (
  `id` bigint NOT NULL,
  `nama_pangwas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pangwas`
--

INSERT INTO `pangwas` (`id`, `nama_pangwas`, `created_at`, `updated_at`) VALUES
(10, 'Mbappe', '2025-11-04 23:24:44', '2026-01-01 04:35:36'),
(13, 'Neymar', '2025-11-04 23:25:38', '2026-01-01 04:35:04'),
(27, 'Ronaldo', '2026-01-01 04:54:59', '2026-01-01 04:54:59');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int NOT NULL,
  `lokasi` text NOT NULL,
  `deskripsi` text,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `lokasi`, `deskripsi`, `ts`) VALUES
(1, 'test', 'asd', '2025-10-22 06:29:42'),
(2, 'test2', 'asd', '2025-10-22 06:31:19'),
(3, 'Banjarmasin', NULL, '2025-10-28 00:12:54'),
(4, 'Banjarmasin', NULL, '2025-11-04 02:25:22'),
(5, 'Banjarmasin Timur', NULL, '2025-11-05 05:32:17'),
(6, 'Banjarmasin Tengah', 'a', '2025-11-05 07:21:21'),
(7, 'Banjarmasin Timur Pekapuran Raya', NULL, '2025-11-10 01:17:13'),
(8, 'Banjarmasin Kelayan', NULL, '2025-11-10 01:36:25'),
(9, 'Banjarmasin Kelayan Utara', NULL, '2025-11-12 02:27:16'),
(10, 'Banjarbaru Landasan Ulin', NULL, '2025-11-12 07:20:59'),
(11, 'Sungai Lulut', NULL, '2025-11-12 07:26:28'),
(12, 'Banjarmasin', NULL, '2025-11-12 07:41:53'),
(13, 'jalann', 'asdasd', '2025-12-30 04:13:11'),
(14, 'jalan jancok', 'asdw', '2025-12-30 14:49:42'),
(15, 'jalan melati', 'asw', '2025-12-30 14:55:26'),
(16, 'jalan', 'jalan', '2025-12-30 16:09:34'),
(17, 'jalan jambrut', 'aksj', '2025-12-31 02:04:38'),
(18, 'JALAN SLEBEW ANJAY', 'pp', '2025-12-31 02:23:49'),
(19, 'jalan ahmad yayan', 'yayan', '2025-12-31 02:31:01'),
(20, 'abdi bokep', 'asd', '2025-12-31 02:38:16'),
(21, 'bjm', 'gaga', '2025-12-31 06:47:07'),
(22, 'BJM', 'kabel rusak', '2025-12-31 06:54:06'),
(23, 'JALAN BANJARMASIN', 'kabel kena layangan', '2025-12-31 07:11:28'),
(24, 'JALAN DJOK MENTAYA', 'odp lepas', '2025-12-31 07:31:10'),
(25, 'JALAN ULM', '123', '2025-12-31 08:00:29'),
(26, 'jalan ulm', 'asd', '2025-12-31 08:05:19'),
(27, 'jalan kamus', 'abc', '2025-12-31 08:09:41'),
(28, 'jalan jalan', 'asw', '2025-12-31 08:14:06'),
(29, 'JALAN SUKA SUKA', '123', '2025-12-31 08:16:32'),
(30, 'JALAN MELATI INDAH', 'odp,kabel,patch cord', '2026-01-01 04:14:00'),
(31, 'JALAN RAYA SABILAL', 'odp', '2026-01-01 04:32:23'),
(32, 'bjb', 'kabel', '2026-01-01 04:56:49'),
(33, 'jalan', 'jalan', '2026-01-01 04:58:59');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id` bigint NOT NULL,
  `no_po` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`id`, `no_po`, `created_at`, `updated_at`) VALUES
(2, '13J2025', '2025-11-09 16:49:58', '2026-01-01 04:44:32'),
(4, '10F2025', '2025-11-09 17:29:09', '2026-01-01 04:44:47'),
(5, '20A2025', '2025-11-09 17:29:19', '2026-01-01 04:45:03'),
(6, '27M2025', '2025-11-11 23:25:53', '2026-01-01 04:45:24'),
(8, '10JL2025', '2025-12-30 18:03:13', '2026-01-01 04:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0nQcVVTBN2cxnA8bfPwQlAW75KtUbOhwJctDWvSO', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiREVQWWhEdndpSTVvY1BzRXNNdVlhT1ZGSmE4U2JJWFg1VUFYZVR5byI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rYXJ5YXdhbi9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1767243839);

-- --------------------------------------------------------

--
-- Table structure for table `tematik`
--

CREATE TABLE `tematik` (
  `id` bigint NOT NULL,
  `nama_tematik` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tematik`
--

INSERT INTO `tematik` (`id`, `nama_tematik`, `created_at`, `updated_at`) VALUES
(2, 'Arfani', '2025-12-30 18:02:22', '2026-01-01 04:38:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'karyawan',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Telkom', 'admin', 'admin@telkom.co.id', NULL, '$2y$12$IxZpWPWS6OnIyVNq4oTQheUQnw58OFBm8LCi44Xzv3V5JBo0nfC3q', 'admin', NULL, '2025-10-09 18:32:43', '2025-10-09 18:32:43'),
(3, 'Muhammad Arfani Akbar', 'akbar', 'akbarcihuy@gmail.com', NULL, '$2y$12$oQ6gy4YjvgnBBlqrIjmWE.SGd2fxvyhThPlIS4SWapaSTNx07.aPq', 'karyawan', NULL, '2025-10-09 18:40:23', '2025-12-31 06:57:02');

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
-- Indexes for table `evidences`
--
ALTER TABLE `evidences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evidences_user_id_foreign` (`user_id`),
  ADD KEY `fk_evidence_po` (`po_id`),
  ADD KEY `fk_evidence_tematik` (`tematik_id`),
  ADD KEY `fk_evidences_pangwas` (`pangwas_id`),
  ADD KEY `fk_evidences_project` (`project_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `pangwas`
--
ALTER TABLE `pangwas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_po` (`no_po`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tematik`
--
ALTER TABLE `tematik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `evidences`
--
ALTER TABLE `evidences`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pangwas`
--
ALTER TABLE `pangwas`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tematik`
--
ALTER TABLE `tematik`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `evidences`
--
ALTER TABLE `evidences`
  ADD CONSTRAINT `evidences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_evidence_pangwas` FOREIGN KEY (`pangwas_id`) REFERENCES `pangwas` (`id`),
  ADD CONSTRAINT `fk_evidence_po` FOREIGN KEY (`po_id`) REFERENCES `purchase_order` (`id`),
  ADD CONSTRAINT `fk_evidence_tematik` FOREIGN KEY (`tematik_id`) REFERENCES `tematik` (`id`),
  ADD CONSTRAINT `fk_evidence_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_evidences_pangwas` FOREIGN KEY (`pangwas_id`) REFERENCES `pangwas` (`id`),
  ADD CONSTRAINT `fk_evidences_project` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
