-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2020 at 08:41 AM
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
-- Database: `apotek2`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(12, 'ANTI-RHEUMATIC/INFLAMATORY', 'active', '2020-10-23 04:53:24', '2020-10-23 04:53:24'),
(13, 'ANTIBIOTIC', 'active', '2020-10-23 04:53:32', '2020-10-23 04:53:32'),
(14, 'CORTICOSTEROID', 'active', '2020-10-23 04:53:49', '2020-10-23 04:53:49'),
(15, 'ANTIHISTAMINE', 'active', '2020-10-23 04:54:03', '2020-10-23 04:54:03'),
(16, 'DIURETIC', 'active', '2020-10-23 04:54:13', '2020-10-23 04:54:13'),
(17, 'ANAESTHETIC', 'active', '2020-10-23 04:54:35', '2020-10-23 04:54:35'),
(18, 'COUGH&COLD', 'active', '2020-10-23 04:54:51', '2020-10-23 04:54:51'),
(19, 'ANTIPASMODIC', 'active', '2020-10-23 04:55:11', '2020-10-23 04:55:11'),
(20, 'URINARY ANTISEPTIC', 'active', '2020-10-23 04:55:29', '2020-10-23 04:55:29'),
(21, 'ANTIFUNGAL', 'active', '2020-10-23 04:56:04', '2020-10-23 04:56:04'),
(22, 'ANTIEMETIC', 'active', '2020-10-23 04:56:25', '2020-10-23 04:56:25'),
(23, 'ANTIVIRAL', 'active', '2020-10-23 04:56:35', '2020-10-23 04:56:35'),
(24, 'ANTIDIABETIC AGENTS', 'active', '2020-10-23 04:56:54', '2020-10-23 04:56:54'),
(25, 'ANTIASTHMATIC', 'active', '2020-10-23 04:57:20', '2020-10-23 04:57:20'),
(26, 'EYE ANTI-INFECTIVE', 'active', '2020-10-23 04:57:42', '2020-10-23 04:57:42'),
(27, 'OESTROGEN/PROGESTERONE', 'active', '2020-10-27 19:15:42', '2020-10-27 19:15:42'),
(28, 'GOUT', 'active', '2020-10-27 19:18:56', '2020-10-27 19:18:56'),
(29, 'ACNE', 'active', '2020-10-28 01:38:24', '2020-10-28 01:38:24'),
(30, 'ANTIULCERANT', 'active', '2020-10-28 01:50:04', '2020-10-28 01:50:04'),
(31, 'NASAL SPRAY', 'active', '2020-10-29 01:37:48', '2020-10-29 01:37:48'),
(32, 'ANTISEPTIC', 'active', '2020-10-29 01:43:55', '2020-10-29 01:43:55'),
(33, 'ANTI-HIPERTENSIVES', 'active', '2020-11-01 15:17:35', '2020-11-01 15:17:49'),
(34, 'CALCIUM ANTAGONIST', 'active', '2020-11-03 02:24:27', '2020-11-03 02:24:27'),
(35, 'ANTI-HELMINTIK', 'active', '2020-11-05 18:06:42', '2020-11-05 18:06:42'),
(36, 'ANTIOBESITY', 'active', '2020-11-05 18:10:43', '2020-11-05 18:10:43'),
(37, 'EYE DROP', 'active', '2020-11-07 00:45:58', '2020-11-07 00:45:58'),
(38, 'test', 'nonactive', '2020-11-10 22:45:28', '2020-11-10 22:49:04');

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
  `category_id` int(11) NOT NULL,
  `plu` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `satuan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `empty_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `category_id`, `plu`, `name`, `stock`, `price`, `status`, `created_at`, `updated_at`, `satuan`, `empty_date`) VALUES
(18, 12, 1283285, 'PONSTAN FCT 500MG', 320, 3460, 'active', '2020-10-23 06:38:16', '2020-11-03 03:12:55', 'Strip', NULL),
(19, 12, 1304549, 'VOLTAREN RETARD 100MG', 280, 16500, 'active', '2020-10-27 19:10:39', '2020-11-03 03:12:55', 'Strip', NULL),
(20, 12, 1285965, 'VOLTAREN SR 75MG', 150, 15000, 'active', '2020-10-27 19:12:20', '2020-10-27 19:12:20', 'Strip', NULL),
(21, 12, 1302136, 'VOLTAREN TAB 25MG', 100, 7500, 'active', '2020-10-27 19:13:19', '2020-10-27 19:13:19', 'Strip', NULL),
(22, 12, 1302145, 'VOLTAREN TAB 50MG', 0, 4500, 'active', '2020-10-27 19:14:17', '2020-11-07 00:52:22', 'Strip', NULL),
(23, 27, 2266429, 'YASMIN TABLET 21\'S', 19, 248100, 'active', '2020-10-27 19:18:19', '2020-10-28 01:41:39', 'Box', NULL),
(24, 28, 1283543, 'ZYLORIC TAB 100 MG. 1\'S', 40, 6500, 'active', '2020-10-27 19:20:16', '2020-10-27 19:20:16', 'Strip', NULL),
(25, 28, 1283552, 'ZYLORIC TAB 300 MG. 1\'S', 70, 7500, 'active', '2020-10-27 19:21:12', '2020-10-27 19:21:12', 'Strip', NULL),
(26, 21, 1290512, 'ZOVIRAX CREAM 5GR', 5, 170700, 'active', '2020-10-28 01:06:29', '2020-10-29 00:45:00', 'Tube', NULL),
(27, 14, 1297928, 'BENOSON-N CREAM 15G', 9, 46200, 'active', '2020-10-28 01:09:51', '2020-10-28 01:10:24', 'Tube', NULL),
(28, 18, 110484, 'BIOGESIC TABLET 4\'S', 11, 2200, 'active', '2020-10-28 01:12:01', '2020-10-28 01:13:09', 'Strip', NULL),
(29, 22, 110742, 'ANTIMO', 11, 5000, 'active', '2020-10-28 01:12:46', '2020-11-02 18:51:13', 'Strip', NULL),
(30, 18, 221463, 'DECOLSIN KAPSUL 4\'S', 7, 3500, 'active', '2020-10-28 01:14:49', '2020-10-28 01:44:20', 'Strip', NULL),
(31, 12, 1285448, 'CATAFLAM 25 MG 1\'S', 110, 4180, 'active', '2020-10-28 01:15:41', '2020-11-02 06:02:56', 'Strip', NULL),
(32, 21, 1289302, 'DIFLUCAN', 0, 164500, 'active', '2020-10-28 01:16:28', '2020-11-07 00:49:55', 'Strip', NULL),
(33, 12, 1410142, 'PRORIS CAPLET 200MG', 0, 1200, 'active', '2020-10-28 01:17:28', '2020-11-07 00:52:49', 'Strip', NULL),
(34, 15, 3020156, 'CETEME STRIP 12S', 0, 2500, 'active', '2020-10-28 01:19:11', '2020-11-02 18:55:26', 'Strip', '2020-10-08'),
(35, 18, 3094913, 'BODREX HRB S/KPL 4S', 60, 4900, 'active', '2020-10-28 01:20:00', '2020-10-28 01:20:00', 'Strip', NULL),
(36, 12, 3085921, 'THROMBO ASPILETS 30', 13, 33900, 'active', '2020-10-28 01:23:41', '2020-11-02 06:06:00', 'Strip', NULL),
(37, 18, 3085963, 'SANMOL TAB 4\'S', 47, 1600, 'active', '2020-10-28 01:25:35', '2020-10-29 00:46:35', 'Strip', NULL),
(38, 12, 1285822, 'CATAFLAM 50MG 1\'S', 80, 7990, 'active', '2020-10-28 01:28:01', '2020-10-31 04:41:03', 'Strip', NULL),
(39, 13, 1296338, 'OTOPAIN EARDROPS', 13, 99600, 'active', '2020-10-28 01:28:40', '2020-10-31 04:40:40', 'Botol', NULL),
(40, 13, 1296708, 'BIOPLACENTON JELLY', 19, 21800, 'active', '2020-10-28 01:29:33', '2020-10-28 01:32:29', 'Tube', NULL),
(41, 15, 3021389, 'OZEN SIRUP 60ML', 7, 70400, 'active', '2020-10-28 01:30:13', '2020-10-28 01:35:05', 'Botol', NULL),
(42, 25, 1882115, 'NASONEX', 4, 281800, 'active', '2020-10-28 01:36:32', '2020-10-28 01:37:11', 'Botol', NULL),
(43, 29, 2772582, 'MEDI-KLIN GEL 15G', 6, 31400, 'active', '2020-10-28 01:39:18', '2020-11-02 04:58:23', 'Tube', NULL),
(44, 21, 112504, 'CANESTEN CREAM 10G', 6, 38500, 'active', '2020-10-28 01:42:47', '2020-10-28 01:43:25', 'Tube', NULL),
(45, 15, 1506426, 'TELFAST HD TAB180', 0, 12600, 'active', '2020-10-28 01:47:25', '2020-11-05 18:41:47', 'Strip', NULL),
(46, 12, 1439767, 'PANADOL EXTRA CAP 1', 16, 11200, 'active', '2020-10-28 01:49:08', '2020-11-05 18:40:49', 'Strip', NULL),
(47, 30, 110323, 'MYLANTA TABLET 10 S', 14, 8500, 'active', '2020-10-28 01:51:14', '2020-11-03 03:21:25', 'Strip', NULL),
(48, 18, 110573, 'DECOLGEN TABLET 4S', 18, 2100, 'active', '2020-10-28 01:53:01', '2020-10-28 01:53:01', 'Strip', NULL),
(49, 12, 1284718, 'MEFINAL CAPSUL 500MG', 90, 1960, 'active', '2020-10-28 01:54:22', '2020-10-31 04:39:31', 'Strip', NULL),
(50, 12, 1291483, 'VOLTAREN GEL 50G', 10, 204100, 'active', '2020-10-28 01:55:41', '2020-10-28 01:55:41', 'Tube', NULL),
(51, 13, 1296049, 'FG TROCHES TABLET', 30, 1640, 'active', '2020-10-28 01:56:48', '2020-11-02 17:24:50', 'Strip', NULL),
(52, 15, 1284219, 'CLARITIN TABLET 1S', 70, 9900, 'active', '2020-10-28 02:07:57', '2020-11-05 18:38:49', 'Strip', NULL),
(53, 30, 3091980, 'XEPAZYM TABLET 6', 8, 24100, 'active', '2020-10-29 00:40:38', '2020-10-29 00:43:47', 'Strip', NULL),
(54, 18, 3093287, 'SANMOL FORTE TAB 4S', 16, 1800, 'active', '2020-10-29 00:50:43', '2020-10-29 01:39:27', 'Strip', NULL),
(55, 31, 1302323, 'AFRIN NASAL SPRAY', 4, 67500, 'active', '2020-10-29 01:37:27', '2020-11-02 05:03:19', 'Botol', NULL),
(56, 32, 112709, 'DEGIROL LOZENGES 20', 7, 27900, 'active', '2020-10-29 01:49:56', '2020-10-29 01:52:19', 'Box', NULL),
(57, 12, 1119513, 'PANADOL KAPLET 10S', 7, 10200, 'active', '2020-10-29 01:51:35', '2020-11-05 18:13:26', 'Strip', NULL),
(58, 23, 154385, 'DAKTARIN CREAM 10GR', 27, 44200, 'active', '2020-10-29 01:56:33', '2020-10-29 01:58:03', 'Tube', NULL),
(59, 35, 843847, 'VERMOX TABLET 1S', 17, 22410, 'active', '2020-10-29 02:00:00', '2020-11-05 18:08:25', 'Strip', NULL),
(60, 12, 1278621, 'TRAMAL CAP 50 MG', 10, 7550, 'active', '2020-10-31 04:28:06', '2020-10-31 04:34:38', 'Strip', NULL),
(61, 21, 1288341, 'NIZORAL CREAM 15 GR', 8, 126900, 'active', '2020-10-31 04:35:39', '2020-10-31 04:35:39', 'Tube', NULL),
(62, 13, 1303196, 'CENDO XITROL EYE DR', 3, 39000, 'active', '2020-10-31 04:36:17', '2020-11-02 06:03:18', 'Tube', NULL),
(63, 15, 2957814, 'CETIRIZINE 10M NOVEL', 0, 510, 'active', '2020-10-31 04:38:20', '2020-11-02 05:35:25', 'Strip', NULL),
(64, 31, 3030957, 'BREATHY TTS HDG 30M', 3, 78000, 'active', '2020-11-01 15:09:09', '2020-11-01 15:12:36', 'Botol', NULL),
(65, 31, 3030958, 'BNS BRTHY NSL SP 30', 5, 120000, 'active', '2020-11-01 15:10:53', '2020-11-01 15:13:17', 'Botol', NULL),
(66, 14, 3054444, 'DERMACOID LPKRIM 10', 11, 69200, 'active', '2020-11-01 15:11:45', '2020-11-01 15:13:56', 'Tube', NULL),
(67, 33, 1456643, 'LIPITOR TABLET 20MG', 20, 27000, 'active', '2020-11-01 15:18:37', '2020-11-01 15:19:14', 'Strip', NULL),
(68, 13, 1296388, 'OTOPAIN EAR DROPS 8', 5, 99600, 'active', '2020-11-01 15:20:28', '2020-11-07 00:36:37', 'Botol', NULL),
(69, 30, 1292613, 'OMZ CAPSUL 20 MG 1S', 30, 17100, 'active', '2020-11-02 04:54:17', '2020-11-02 04:56:15', 'Strip', NULL),
(70, 14, 1298702, 'DIGENTA CREAM 10GR', 5, 116800, 'active', '2020-11-02 04:55:31', '2020-11-05 18:13:01', 'Tube', NULL),
(71, 14, 3005211, 'EUTHYROX 1S', 45, 3390, 'active', '2020-11-02 05:00:27', '2020-11-02 05:57:39', 'Strip', NULL),
(72, 23, 1446799, 'VALTREX 500MG TABLET', 30, 24800, 'active', '2020-11-02 05:07:29', '2020-11-02 05:20:06', 'Strip', NULL),
(73, 18, 1565076, 'PANADOL KAPLET C&F1', 7, 13500, 'active', '2020-11-02 05:22:06', '2020-11-03 03:09:35', 'Strip', NULL),
(74, 12, 1283998, 'MERISLON 12MG TAB1S', 20, 9400, 'active', '2020-11-02 05:36:33', '2020-11-02 05:53:44', 'Strip', NULL),
(75, 27, 1953422, 'MICROGYNON TABLET 2', 6, 18750, 'active', '2020-11-02 05:37:24', '2020-11-02 05:54:07', 'Box', NULL),
(76, 25, 1280828, 'VENTOLIN INHLR 100M', 13, 153800, 'active', '2020-11-02 05:59:39', '2020-11-02 06:00:24', 'Botol', NULL),
(77, 27, 1297643, 'DIANE 35 21S', 8, 164000, 'active', '2020-11-02 06:08:18', '2020-11-02 17:24:33', 'Box', NULL),
(78, 22, 110332, 'MYLANTA LIQUID 150M', 9, 41500, 'active', '2020-11-02 17:32:08', '2020-11-02 17:32:49', 'Botol', NULL),
(79, 15, 1301148, 'CELESTAMIN SYRUP 60', 4, 90500, 'active', '2020-11-02 18:52:37', '2020-11-02 18:54:10', 'Botol', NULL),
(80, 14, 1302582, 'DIPROGENTA CREAM 10', 7, 131400, 'active', '2020-11-02 18:53:17', '2020-11-02 18:54:42', 'Tube', NULL),
(81, 34, 3041145, 'AMLODIPIN 10MG NOVE', 30, 690, 'active', '2020-11-03 03:04:06', '2020-11-03 03:08:26', 'Strip', NULL),
(82, 30, 110288, 'PROMAG TABLET 12S', 6, 8800, 'active', '2020-11-03 03:07:31', '2020-11-03 03:07:31', 'Strip', NULL),
(83, 34, 2828507, 'SIMVASTATIN 10 OGBD', 90, 690, 'active', '2020-11-03 03:22:44', '2020-11-03 03:30:23', 'Strip', NULL),
(84, 34, 3041149, 'SIMVASTATIN 10MG NOVELL', 60, 685, 'active', '2020-11-03 03:25:44', '2020-11-03 03:30:48', 'Strip', NULL),
(85, 30, 2958598, 'OMEPRAZOLE 20 NOVEL', 0, 550, 'active', '2020-11-03 03:33:06', '2020-11-05 18:44:36', 'Strip', NULL),
(86, 30, 1852395, 'NEXIUM 40MG TABLETS', 42, 30100, 'active', '2020-11-05 18:10:14', '2020-11-05 18:12:19', 'Strip', NULL),
(87, 36, 3020655, 'XENICAL KAP 120MG 1', 35, 15400, 'active', '2020-11-05 18:11:43', '2020-11-05 18:12:38', 'Strip', NULL),
(88, 23, 1291242, 'CLINOVIR TAB 400MG', 60, 10060, 'active', '2020-11-05 18:36:35', '2020-11-05 18:38:20', 'Strip', NULL),
(89, 13, 3064390, 'SALTICIN CREAM 5GR', 2, 38400, 'active', '2020-11-05 18:40:17', '2020-11-07 00:49:06', 'Tube', NULL),
(90, 21, 1290432, 'FLAGYL FORTE TABLET', 30, 9300, 'active', '2020-11-05 18:42:22', '2020-11-05 18:43:49', 'Strip', NULL),
(91, 14, 1520392, 'INERSON SALEP .25 1', 6, 98600, 'active', '2020-11-05 18:42:59', '2020-11-05 18:44:15', 'Tube', NULL),
(92, 30, 3078061, 'OMEPRAZOLE 20MG HEX', 60, 510, 'active', '2020-11-05 18:45:10', '2020-11-05 18:46:03', 'Strip', NULL),
(93, 23, 1290503, 'ZOVIRAX CREAM 2GR', 6, 91000, 'active', '2020-11-06 06:22:46', '2020-11-06 06:23:29', 'Tube', NULL),
(94, 15, 2573918, 'HYDROCORTISONE 2.5%', 2, 4000, 'active', '2020-11-07 00:28:38', '2020-11-07 00:32:18', 'Tube', NULL),
(95, 21, 1291599, 'CANESTEN SDV 0.5G 1', 3, 162500, 'active', '2020-11-07 00:31:15', '2020-11-07 00:36:08', 'Tube', NULL),
(96, 37, 2605098, 'CENDO C/FRSH MNDS 5', 7, 32900, 'active', '2020-11-07 00:47:21', '2020-11-10 07:54:52', 'Botol', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_invoice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `receive_date` date DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `no_invoice`, `date`, `receive_date`, `status`, `created_at`, `updated_at`) VALUES
(34, '432545', '2020-11-04', NULL, 'Pending', '2020-11-10 06:50:13', '2020-11-10 06:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_detail`
--

CREATE TABLE `pemesanan_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pemesanan_id` int(11) NOT NULL,
  `obat_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sisa_stock` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemesanan_detail`
--

INSERT INTO `pemesanan_detail` (`id`, `pemesanan_id`, `obat_id`, `qty`, `keterangan`, `sisa_stock`, `created_at`, `updated_at`) VALUES
(47, 32, 18, 100, 'VGHK', 290, '2020-10-29 00:57:18', '2020-10-29 00:57:18'),
(48, 33, 18, 40, 'HBF5JK', 320, '2020-11-03 03:12:55', '2020-11-03 03:12:55'),
(49, 33, 19, 100, 'HJSBGS7', 280, '2020-11-03 03:12:55', '2020-11-03 03:12:55'),
(50, 34, 18, 20, NULL, NULL, '2020-11-10 06:50:13', '2020-11-10 06:50:13'),
(51, 34, 19, 20, NULL, NULL, '2020-11-10 06:50:13', '2020-11-10 06:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `obat_id` bigint(20) NOT NULL,
  `date` date DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sisa_stock` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `obat_id`, `date`, `qty`, `total`, `status`, `sisa_stock`, `created_at`, `updated_at`) VALUES
(38, 26, '2020-08-01', 1, 170700, 'Approved', 6, '2020-10-28 01:07:06', '2020-10-28 01:07:06'),
(39, 27, '2020-08-02', 1, 46200, 'Approved', 9, '2020-10-28 01:10:24', '2020-10-28 01:10:24'),
(40, 28, '2020-08-04', 4, 8800, 'Approved', 11, '2020-10-28 01:13:09', '2020-10-28 01:13:09'),
(41, 29, '2020-08-04', 1, 5000, 'Approved', 17, '2020-10-28 01:13:27', '2020-10-28 01:13:27'),
(42, 30, '2020-08-05', 1, 3500, 'Approved', 9, '2020-10-28 01:20:20', '2020-10-28 01:20:20'),
(43, 31, '2020-08-05', 10, 41800, 'Approved', 120, '2020-10-28 01:20:46', '2020-10-28 01:20:46'),
(44, 32, '2020-08-05', 4, 658000, 'Approved', 6, '2020-10-28 01:21:09', '2020-10-28 01:21:09'),
(45, 33, '2020-08-05', 30, 36000, 'Approved', 170, '2020-10-28 01:21:33', '2020-10-28 01:21:33'),
(46, 34, '2020-08-05', 2, 5000, 'Approved', 3, '2020-10-28 01:22:12', '2020-10-28 01:22:12'),
(47, 33, '2020-08-06', 10, 12000, 'Approved', 160, '2020-10-28 01:25:56', '2020-10-28 01:25:56'),
(48, 36, '2020-08-06', 1, 33900, 'Approved', 14, '2020-10-28 01:26:20', '2020-10-28 01:26:20'),
(49, 37, '2020-08-06', 2, 3200, 'Approved', 48, '2020-10-28 01:26:47', '2020-10-28 01:26:47'),
(50, 38, '2020-08-06', 10, 79900, 'Approved', 90, '2020-10-28 01:30:41', '2020-10-28 01:30:41'),
(51, 39, '2020-06-07', 1, 99600, 'Approved', 14, '2020-10-28 01:31:05', '2020-10-28 01:31:05'),
(52, 40, '2020-06-07', 1, 21800, 'Approved', 19, '2020-10-28 01:32:29', '2020-10-28 01:32:29'),
(53, 41, '2020-08-07', 1, 70400, 'Approved', 7, '2020-10-28 01:35:05', '2020-10-28 01:35:05'),
(54, 42, '2020-08-08', 1, 281800, 'Approved', 4, '2020-10-28 01:37:11', '2020-10-28 01:37:11'),
(55, 43, '2020-08-09', 1, 31400, 'Approved', 7, '2020-10-28 01:39:50', '2020-10-28 01:39:50'),
(56, 23, '2020-08-10', 1, 248100, 'Approved', 19, '2020-10-28 01:41:39', '2020-10-28 01:41:39'),
(57, 44, '2020-08-11', 1, 38500, 'Approved', 6, '2020-10-28 01:43:25', '2020-10-28 01:43:25'),
(58, 30, '2020-08-12', 2, 7000, 'Approved', 7, '2020-10-28 01:44:20', '2020-10-28 01:44:20'),
(59, 29, '2020-08-14', 1, 5000, 'Approved', 16, '2020-10-28 01:46:07', '2020-10-28 01:46:07'),
(60, 45, '2020-08-15', 20, 252000, 'Approved', 20, '2020-10-28 01:47:46', '2020-10-28 01:47:46'),
(61, 47, '2020-08-16', 2, 17000, 'Approved', 21, '2020-10-28 01:51:39', '2020-10-28 01:51:39'),
(62, 18, '2020-08-16', 10, 34600, 'Approved', 190, '2020-10-28 01:57:14', '2020-10-28 01:57:14'),
(63, 47, '2020-08-18', 4, 34000, 'Approved', 17, '2020-10-28 02:21:20', '2020-10-28 02:21:20'),
(64, 46, '2020-08-18', 1, 11200, 'Approved', 79, '2020-10-29 00:38:22', '2020-10-29 00:38:22'),
(65, 53, '2020-08-19', 2, 48200, 'Approved', 8, '2020-10-29 00:43:47', '2020-10-29 00:43:47'),
(66, 26, '2020-08-19', 1, 170700, 'Approved', 5, '2020-10-29 00:45:00', '2020-10-29 00:45:00'),
(67, 37, '2020-08-19', 1, 1600, 'Approved', 47, '2020-10-29 00:46:35', '2020-10-29 00:46:35'),
(68, 55, '2020-08-21', 1, 67500, 'Approved', 5, '2020-10-29 01:39:02', '2020-10-29 01:39:02'),
(69, 54, '2020-08-20', 4, 7200, 'Approved', 16, '2020-10-29 01:39:27', '2020-10-29 01:39:27'),
(70, 46, '2020-08-21', 2, 22400, 'Approved', 77, '2020-10-29 01:43:28', '2020-10-29 01:43:28'),
(71, 56, '2020-08-22', 1, 27900, 'Approved', 7, '2020-10-29 01:52:19', '2020-10-29 01:52:19'),
(72, 57, '2020-08-22', 2, 20400, 'Approved', 16, '2020-10-29 01:52:45', '2020-10-29 01:52:45'),
(73, 32, '2020-08-23', 2, 329000, 'Approved', 4, '2020-10-29 01:55:16', '2020-10-29 01:55:16'),
(74, 58, '2020-08-24', 1, 44200, 'Approved', 27, '2020-10-29 01:58:03', '2020-10-29 01:58:03'),
(75, 57, '2020-08-24', 2, 20400, 'Approved', 14, '2020-10-29 02:46:12', '2020-10-29 02:46:12'),
(76, 60, '2020-08-24', 20, 151000, 'Approved', 10, '2020-10-31 04:34:38', '2020-10-31 04:34:38'),
(77, 62, '2020-08-24', 1, 39000, 'Approved', 5, '2020-10-31 04:38:53', '2020-10-31 04:38:53'),
(78, 49, '2020-08-25', 10, 19600, 'Approved', 90, '2020-10-31 04:39:31', '2020-10-31 04:39:31'),
(79, 63, '2020-08-25', 80, 40800, 'Approved', 20, '2020-10-31 04:39:52', '2020-10-31 04:39:52'),
(80, 39, '2020-08-27', 1, 99600, 'Approved', 13, '2020-10-31 04:40:40', '2020-10-31 04:40:40'),
(81, 38, '2020-08-29', 10, 79900, 'Approved', 80, '2020-10-31 04:41:03', '2020-10-31 04:41:03'),
(82, 51, '2020-08-30', 20, 32800, 'Approved', 50, '2020-10-31 04:41:31', '2020-10-31 04:41:31'),
(83, 34, '2020-08-31', 2, 5000, 'Approved', 1, '2020-10-31 04:41:50', '2020-10-31 04:41:50'),
(84, 33, '2020-03-09', 20, 24000, 'Approved', 140, '2020-10-31 04:43:59', '2020-10-31 04:43:59'),
(85, 63, '2020-03-09', 10, 5100, 'Approved', 10, '2020-10-31 04:55:50', '2020-10-31 04:55:50'),
(86, 64, '2020-09-03', 2, 156000, 'Approved', 3, '2020-11-01 15:12:36', '2020-11-01 15:12:36'),
(87, 65, '2020-03-09', 1, 120000, 'Approved', 5, '2020-11-01 15:13:17', '2020-11-01 15:13:17'),
(88, 66, '2020-03-09', 1, 69200, 'Approved', 11, '2020-11-01 15:13:56', '2020-11-01 15:13:56'),
(89, 67, '2020-09-04', 10, 270000, 'Approved', 20, '2020-11-01 15:19:14', '2020-11-01 15:19:14'),
(90, 68, '2020-09-05', 1, 99600, 'Approved', 12, '2020-11-01 15:21:00', '2020-11-01 15:21:00'),
(91, 33, '2020-09-05', 50, 60000, 'Approved', 90, '2020-11-02 04:47:34', '2020-11-02 04:47:34'),
(92, 57, '2020-09-06', 1, 10200, 'Approved', 13, '2020-11-02 04:47:56', '2020-11-02 04:47:56'),
(93, 22, '2020-09-07', 10, 45000, 'Approved', 40, '2020-11-02 04:48:27', '2020-11-02 04:48:27'),
(94, 69, '2020-09-08', 6, 102600, 'Approved', 30, '2020-11-02 04:56:15', '2020-11-02 04:56:15'),
(95, 70, '2020-09-08', 1, 116800, 'Approved', 7, '2020-11-02 04:56:53', '2020-11-02 04:56:53'),
(96, 46, '2020-09-08', 5, 56000, 'Approved', 72, '2020-11-02 04:57:37', '2020-11-02 04:57:37'),
(97, 43, '2020-09-08', 1, 31400, 'Approved', 6, '2020-11-02 04:58:23', '2020-11-02 04:58:23'),
(98, 71, '2020-09-08', 25, 84750, 'Approved', 95, '2020-11-02 05:01:48', '2020-11-02 05:01:48'),
(99, 52, '2020-09-09', 10, 99000, 'Approved', 90, '2020-11-02 05:02:25', '2020-11-02 05:02:25'),
(100, 55, '2020-09-09', 1, 67500, 'Approved', 4, '2020-11-02 05:03:19', '2020-11-02 05:03:19'),
(101, 46, '2020-09-09', 1, 11200, 'Approved', 71, '2020-11-02 05:04:23', '2020-11-02 05:04:23'),
(102, 72, '2020-09-09', 6, 148800, 'Approved', 30, '2020-11-02 05:20:06', '2020-11-02 05:20:06'),
(103, 73, '2020-09-10', 2, 27000, 'Approved', 11, '2020-11-02 05:24:41', '2020-11-02 05:24:41'),
(104, 57, '2020-09-10', 3, 30600, 'Approved', 10, '2020-11-02 05:25:06', '2020-11-02 05:25:06'),
(105, 46, '2020-09-10', 3, 33600, 'Approved', 68, '2020-11-02 05:26:39', '2020-11-02 05:26:39'),
(106, 63, '2020-09-11', 10, 5100, 'Approved', 0, '2020-11-02 05:35:25', '2020-11-02 05:35:25'),
(107, 74, '2020-09-12', 10, 94000, 'Approved', 20, '2020-11-02 05:53:44', '2020-11-02 05:53:44'),
(108, 75, '2020-09-12', 1, 18750, 'Approved', 6, '2020-11-02 05:54:07', '2020-11-02 05:54:07'),
(109, 18, '2020-09-13', 10, 34600, 'Approved', 280, '2020-11-02 05:55:04', '2020-11-02 05:55:04'),
(110, 52, '2020-09-13', 10, 99000, 'Approved', 80, '2020-11-02 05:56:10', '2020-11-02 05:56:10'),
(111, 51, '2020-09-13', 10, 16400, 'Approved', 40, '2020-11-02 05:56:35', '2020-11-02 05:56:35'),
(112, 62, '2020-09-13', 1, 39000, 'Approved', 4, '2020-11-02 05:56:59', '2020-11-02 05:56:59'),
(113, 71, '2020-09-13', 50, 169500, 'Approved', 45, '2020-11-02 05:57:39', '2020-11-02 05:57:39'),
(114, 76, '2020-09-14', 2, 307600, 'Approved', 13, '2020-11-02 06:00:24', '2020-11-02 06:00:24'),
(115, 31, '2020-09-14', 10, 41800, 'Approved', 110, '2020-11-02 06:02:56', '2020-11-02 06:02:56'),
(116, 62, '2020-09-14', 1, 39000, 'Approved', 3, '2020-11-02 06:03:18', '2020-11-02 06:03:18'),
(117, 33, '2020-09-14', 20, 24000, 'Approved', 70, '2020-11-02 06:04:19', '2020-11-02 06:04:19'),
(118, 46, '2020-09-14', 3, 33600, 'Approved', 65, '2020-11-02 06:04:38', '2020-11-02 06:04:38'),
(119, 36, '2020-09-14', 1, 33900, 'Approved', 13, '2020-11-02 06:06:00', '2020-11-02 06:06:00'),
(120, 32, '2020-09-15', 3, 493500, 'Approved', 1, '2020-11-02 06:07:26', '2020-11-02 06:07:26'),
(121, 77, '2020-09-15', 1, 164000, 'Approved', 8, '2020-11-02 17:24:33', '2020-11-02 17:24:33'),
(122, 51, '2020-09-16', 10, 16400, 'Approved', 30, '2020-11-02 17:24:50', '2020-11-02 17:24:50'),
(123, 29, '2020-09-17', 1, 5000, 'Approved', 15, '2020-11-02 17:25:11', '2020-11-02 17:25:11'),
(124, 46, '2020-09-17', 1, 11200, 'Approved', 64, '2020-11-02 17:31:03', '2020-11-02 17:31:03'),
(125, 47, '2020-09-19', 1, 8500, 'Approved', 16, '2020-11-02 17:31:28', '2020-11-02 17:31:28'),
(126, 78, '2020-09-19', 1, 41500, 'Approved', 9, '2020-11-02 17:32:49', '2020-11-02 17:32:49'),
(127, 29, '2020-09-19', 4, 20000, 'Approved', 11, '2020-11-02 18:51:13', '2020-11-02 18:51:13'),
(128, 79, '2020-09-19', 1, 90500, 'Approved', 4, '2020-11-02 18:54:10', '2020-11-02 18:54:10'),
(129, 80, '2020-09-19', 1, 131400, 'Approved', 7, '2020-11-02 18:54:42', '2020-11-02 18:54:42'),
(130, 19, '2020-09-19', 20, 330000, 'Approved', 180, '2020-11-02 18:55:05', '2020-11-02 18:55:05'),
(131, 34, '2020-09-19', 1, 2500, 'Approved', 0, '2020-11-02 18:55:26', '2020-11-02 18:55:26'),
(132, 81, '2020-09-21', 10, 6900, 'Approved', 30, '2020-11-03 03:08:26', '2020-11-03 03:08:26'),
(133, 73, '2020-09-22', 4, 54000, 'Approved', 7, '2020-11-03 03:09:35', '2020-11-03 03:09:35'),
(134, 47, '2020-09-22', 2, 17000, 'Approved', 14, '2020-11-03 03:21:25', '2020-11-03 03:21:25'),
(135, 83, '2020-09-22', 10, 6900, 'Approved', 90, '2020-11-03 03:30:23', '2020-11-03 03:30:23'),
(136, 84, '2020-09-22', 40, 27400, 'Approved', 60, '2020-11-03 03:30:48', '2020-11-03 03:30:48'),
(137, 57, '2020-09-24', 1, 10200, 'Approved', 9, '2020-11-03 03:31:25', '2020-11-03 03:31:25'),
(138, 46, '2020-09-24', 2, 22400, 'Approved', 62, '2020-11-03 03:32:23', '2020-11-03 03:32:23'),
(139, 46, '2020-09-24', 20, 224000, 'Approved', 42, '2020-11-03 03:35:54', '2020-11-03 03:35:54'),
(140, 85, '2020-09-25', 20, 11000, 'Approved', 80, '2020-11-03 03:36:31', '2020-11-03 03:36:31'),
(141, 33, '2020-09-27', 20, 24000, 'Approved', 50, '2020-11-03 03:38:03', '2020-11-03 03:38:03'),
(142, 85, '2020-09-25', 20, 11000, 'Approved', 60, '2020-11-05 18:05:43', '2020-11-05 18:05:43'),
(143, 33, '2020-09-27', 20, 24000, 'Approved', 30, '2020-11-05 18:06:01', '2020-11-05 18:06:01'),
(144, 59, '2020-10-01', 3, 67230, 'Approved', 17, '2020-11-05 18:08:25', '2020-11-05 18:08:25'),
(145, 46, '2020-10-01', 20, 224000, 'Approved', 22, '2020-11-05 18:08:47', '2020-11-05 18:08:47'),
(146, 86, '2020-10-01', 7, 210700, 'Approved', 42, '2020-11-05 18:12:19', '2020-11-05 18:12:19'),
(147, 87, '2020-10-01', 35, 539000, 'Approved', 35, '2020-11-05 18:12:38', '2020-11-05 18:12:38'),
(148, 70, '2020-10-01', 2, 233600, 'Approved', 5, '2020-11-05 18:13:01', '2020-11-05 18:13:01'),
(149, 57, '2020-10-03', 2, 20400, 'Approved', 7, '2020-11-05 18:13:26', '2020-11-05 18:13:26'),
(150, 33, '2020-10-03', 20, 24000, 'Approved', 10, '2020-11-05 18:13:43', '2020-11-05 18:13:43'),
(151, 85, '2020-10-03', 20, 11000, 'Approved', 40, '2020-11-05 18:14:07', '2020-11-05 18:14:07'),
(152, 68, '2020-10-04', 4, 398400, 'Approved', 8, '2020-11-05 18:37:29', '2020-11-05 18:37:29'),
(153, 88, '2020-10-04', 10, 100600, 'Approved', 60, '2020-11-05 18:38:20', '2020-11-05 18:38:20'),
(154, 52, '2020-10-05', 10, 99000, 'Approved', 70, '2020-11-05 18:38:49', '2020-11-05 18:38:49'),
(155, 85, '2020-10-06', 20, 11000, 'Approved', 20, '2020-11-05 18:39:09', '2020-11-05 18:39:09'),
(156, 46, '2020-10-06', 6, 67200, 'Approved', 16, '2020-11-05 18:40:49', '2020-11-05 18:40:49'),
(157, 45, '2020-10-07', 20, 252000, 'Approved', 0, '2020-11-05 18:41:47', '2020-11-05 18:41:47'),
(158, 90, '2020-10-07', 20, 186000, 'Approved', 30, '2020-11-05 18:43:49', '2020-11-05 18:43:49'),
(159, 91, '2020-10-08', 2, 197200, 'Approved', 6, '2020-11-05 18:44:15', '2020-11-05 18:44:15'),
(160, 85, '2020-10-09', 20, 11000, 'Approved', 0, '2020-11-05 18:44:36', '2020-11-05 18:44:36'),
(161, 92, '2020-10-09', 50, 25500, 'Approved', 60, '2020-11-05 18:46:03', '2020-11-05 18:46:03'),
(162, 89, '2020-10-11', 5, 192000, 'Approved', 5, '2020-11-06 06:21:57', '2020-11-06 06:21:57'),
(163, 93, '2020-10-12', 3, 273000, 'Approved', 6, '2020-11-06 06:23:29', '2020-11-06 06:23:29'),
(164, 94, '2020-10-12', 5, 20000, 'Approved', 2, '2020-11-07 00:32:18', '2020-11-07 00:32:18'),
(165, 95, '2020-10-13', 2, 650000, 'Approved', 3, '2020-11-07 00:36:08', '2020-11-07 00:36:08'),
(166, 68, '2020-10-13', 3, 298800, 'Approved', 5, '2020-11-07 00:36:37', '2020-11-07 00:36:37'),
(167, 89, '2020-10-13', 3, 115200, 'Approved', 2, '2020-11-07 00:49:06', '2020-11-07 00:49:06'),
(168, 32, '2020-10-17', 1, 164500, 'Approved', 0, '2020-11-07 00:49:55', '2020-11-07 00:49:55'),
(169, 22, '2020-10-17', 42, 180000, 'Approved', -2, '2020-11-07 00:52:22', '2020-11-07 00:52:22'),
(170, 33, '2020-10-17', 10, 12000, 'Approved', 0, '2020-11-07 00:52:49', '2020-11-07 00:52:49');

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
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `remember_token`, `created_at`, `updated_at`, `username`, `role`) VALUES
(1, 'admin', '$2y$10$TWCFFJK3YCY0KIrODn8L5.CoXJUpns5aU51xSReT7.V2F/MjH6lBK', NULL, NULL, NULL, 'admin', 'apoteker'),
(2, 'kepala toko', '$2y$10$s6yMn048LmBaxkxmeFI26eEsTxZUqLfdp2bScAPJRZx6FudgmVXVa', NULL, '2020-09-06 06:47:45', '2020-10-19 23:49:29', 'kepalatoko', 'kepalatoko'),
(4, 'adimas', '$2y$10$MAnr3Uctl0GG3SBaopVRLeVlGTJ..DzvWzbNL8INi757Nz63W60JO', NULL, '2020-10-19 23:51:45', '2020-10-19 23:51:45', 'adimas01', 'apoteker');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pemesanan_detail`
--
ALTER TABLE `pemesanan_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
