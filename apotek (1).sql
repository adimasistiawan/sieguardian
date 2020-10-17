-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2020 at 08:43 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotek`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(5, 't1', '2020-10-13 04:27:41', '2020-10-13 05:55:51'),
(6, 't2', '2020-10-13 04:28:13', '2020-10-13 04:28:13'),
(9, 't6', '2020-10-13 04:41:35', '2020-10-13 04:41:35'),
(10, 'd', '2020-10-14 23:09:02', '2020-10-14 23:09:02');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_08_22_162732_create_obat_table', 2),
(4, '2020_08_23_005249_create_category_table', 3),
(5, '2020_08_23_010831_updated_category_table', 4),
(6, '2020_08_23_011603_updated_category_date_table', 5),
(7, '2020_08_23_052109_obat_category_table', 6),
(8, '2020_09_02_120114_create_table_transaction', 7),
(9, '2020_09_06_132944_update_table_users', 8),
(10, '2020_10_13_121540_create_satuans_table', 9),
(11, '2020_10_16_052641_create_pemesanans_table', 10),
(12, '2020_10_16_053439_create_pemesanan_details_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plu` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `plu`, `name`, `slug`, `stock`, `price`, `created_at`, `updated_at`, `category`, `satuan`) VALUES
(9, 456, 'b', 'b', 100, 50000, '2020-10-13 05:48:34', '2020-10-16 06:33:34', 'T1', 'Box'),
(10, 3456, 'c', 'c', 25, 12000, '2020-10-13 05:49:12', '2020-10-13 05:49:12', 't6', 'Box'),
(11, 2324, 'sdfds', 'sdfds', 2000, 300, '2020-10-13 06:18:01', '2020-10-13 06:18:01', 't2', 'Box'),
(12, 1410142, 'ibuprofen', 'ibuprofen', 101, 2500, '2020-10-14 00:17:07', '2020-10-16 06:47:39', 't1', 'Box');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_invoice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `no_invoice`, `date`, `status`, `created_at`, `updated_at`) VALUES
(14, '1234', '2020-10-16', 'Received', '2020-10-16 06:33:34', '2020-10-16 06:33:34'),
(15, '33445', '2020-10-17', 'Pending', '2020-10-16 06:37:27', '2020-10-16 06:37:27'),
(16, '222', '2020-10-16', 'Pending', '2020-10-16 06:38:21', '2020-10-16 06:38:21'),
(17, '1', '2020-10-17', 'Pending', '2020-10-16 06:40:11', '2020-10-16 06:40:11'),
(18, '321', '2020-10-17', 'Pending', '2020-10-16 06:41:39', '2020-10-16 06:41:39'),
(19, '111', '2020-10-17', 'Received', '2020-10-16 06:47:39', '2020-10-16 06:47:39'),
(20, '33333', '2020-10-17', 'Pending', '2020-10-16 06:49:26', '2020-10-16 06:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_detail`
--

CREATE TABLE `pemesanan_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pemesanan_id` int(11) NOT NULL,
  `obat_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemesanan_detail`
--

INSERT INTO `pemesanan_detail` (`id`, `pemesanan_id`, `obat_id`, `qty`, `keterangan`, `created_at`, `updated_at`) VALUES
(13, 14, 9, 100, '-', '2020-10-16 06:33:34', '2020-10-16 06:33:34'),
(14, 15, 11, 200, '-', '2020-10-16 06:37:28', '2020-10-16 06:37:28'),
(15, 16, 12, 25, '-', '2020-10-16 06:38:21', '2020-10-16 06:38:21'),
(16, 17, 12, 5, '-', '2020-10-16 06:40:11', '2020-10-16 06:40:11'),
(17, 18, 12, 3, '-', '2020-10-16 06:41:40', '2020-10-16 06:41:40'),
(18, 19, 12, 1, '-', '2020-10-16 06:47:39', '2020-10-16 06:47:39'),
(19, 20, 12, 1, '-', '2020-10-16 06:49:26', '2020-10-16 06:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Box', '2020-10-13 05:18:58', '2020-10-13 05:18:58'),
(3, 'strip', '2020-10-14 00:17:37', '2020-10-14 00:17:37'),
(4, 'Tube/Tabung', '2020-10-14 00:17:54', '2020-10-14 00:17:54');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `obat_id` bigint(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `obat_id`, `qty`, `total`, `status`, `created_at`, `updated_at`) VALUES
(15, 9, 1, 50000, 'Approved', '2020-10-14 16:42:03', '2020-10-14 16:42:03'),
(16, 9, 30, 1500000, 'Approved', '2020-10-14 17:35:25', '2020-10-14 17:35:25'),
(17, 9, 19, 950000, 'Approved', '2020-10-14 17:36:20', '2020-10-14 17:36:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `remember_token`, `created_at`, `updated_at`, `username`) VALUES
(1, 'admin', '$2y$10$TWCFFJK3YCY0KIrODn8L5.CoXJUpns5aU51xSReT7.V2F/MjH6lBK', NULL, NULL, NULL, 'admin'),
(2, 'fajarprayoga', '$2y$10$KSaIIWcqUM61CA38XHg6eOggHcXChpRHK19MzqM11duEHuTH.T7oe', NULL, '2020-09-06 06:47:45', '2020-09-06 06:47:45', 'fajar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesanan_detail`
--
ALTER TABLE `pemesanan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pemesanan_detail`
--
ALTER TABLE `pemesanan_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
