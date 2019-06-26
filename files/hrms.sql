-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2019 at 07:57 AM
-- Server version: 5.7.26-0ubuntu0.16.04.1
-- PHP Version: 7.1.25-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrms`
--

-- --------------------------------------------------------

--
-- Table structure for table `absences`
--

CREATE TABLE `absences` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `absences`
--

INSERT INTO `absences` (`id`, `user_id`, `leave_type_id`, `reason`, `date`, `deleted_at`, `created_at`, `updated_at`, `type`) VALUES
(1, 2, 0, 'traffic', '2019-01-08', NULL, '2019-01-09 13:38:08', '2019-01-09 13:38:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `active_appraisals`
--

CREATE TABLE `active_appraisals` (
  `id` int(10) UNSIGNED NOT NULL,
  `appraisalquestionare_id` int(11) NOT NULL,
  `employees_participating` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appication_statuses`
--

CREATE TABLE `appication_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `appication_statuses`
--

INSERT INTO `appication_statuses` (`id`, `status`, `description`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Rejected', 'Candidate Rejected', 0, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(2, 'Shortlisted', 'Candidate Shortlisted', 1, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(3, 'Offered', 'Candidate Employment offer made', 2, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(4, 'Hired', 'Candidate Hired', 3, '2019-01-09 07:10:38', '2019-01-09 07:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `appraisal_questionares`
--

CREATE TABLE `appraisal_questionares` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `questions` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `appraisal_questionares`
--

INSERT INTO `appraisal_questionares` (`id`, `name`, `questions`, `department_id`, `designation_id`, `created_at`, `updated_at`) VALUES
(1, 'Environment', '["1"]', 7, 9, '2019-01-09 13:27:05', '2019-01-09 13:27:05');

-- --------------------------------------------------------

--
-- Table structure for table `appraisal_questions`
--

CREATE TABLE `appraisal_questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` longtext COLLATE utf8_unicode_ci NOT NULL,
  `question_type_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `appraisal_questions`
--

INSERT INTO `appraisal_questions` (`id`, `question`, `question_type_id`, `created_at`, `updated_at`) VALUES
(1, 'what can we do to make our environment clean?', 1, '2019-01-09 13:24:20', '2019-01-09 13:24:20'),
(2, 'how many years of experience do you have ', 2, '2019-01-31 12:47:34', '2019-01-31 12:47:34');

-- --------------------------------------------------------

--
-- Table structure for table `appreciation_templates`
--

CREATE TABLE `appreciation_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `appreciation_templates`
--

INSERT INTO `appreciation_templates` (`id`, `title`, `subject`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Identification ', 'staff IDs ', '<p>ids&nbsp;</p>', '2019-01-31 12:30:51', '2019-01-31 12:30:51');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `make` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `asset_type_id` int(100) DEFAULT NULL,
  `serial_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `part_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `created_at`, `updated_at`, `make`, `model`, `asset_type_id`, `serial_no`, `part_no`, `color`) VALUES
(1, '2019-01-31 14:15:49', '2019-01-31 14:16:00', 'make3', 'model1', 2, 'ser1234', '3453455', 'green');

-- --------------------------------------------------------

--
-- Table structure for table `asset_transactions`
--

CREATE TABLE `asset_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_types`
--

CREATE TABLE `asset_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `asset_types`
--

INSERT INTO `asset_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Mobile Phones ', '2019-01-31 12:07:55', '2019-01-31 12:07:55'),
(2, 'Laptops ', '2019-01-31 12:09:12', '2019-01-31 12:09:12');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_in` datetime NOT NULL,
  `time_out` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `award_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gift_item` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cash_price` decimal(10,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`id`, `user_id`, `award_name`, `gift_item`, `cash_price`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 43, 'Quisquam dolorem.', 'Est ut unde.', '3458.00', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(2, 17, 'Illo dolores.', 'Ratione officia sed.', '4255.00', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(3, 47, 'Sit autem officia.', 'Veritatis nobis et.', '637.00', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(4, 2, 'Deleniti quod.', 'Enim ullam ipsa qui.', '4560.00', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(5, 34, 'Et et repudiandae.', 'Et quas nam totam.', '1569.00', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `account_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `account_number` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `bank_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `branch_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `branch_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `user_id`, `account_name`, `account_number`, `bank_name`, `deleted_at`, `created_at`, `updated_at`, `branch_name`, `bank_code`, `branch_code`) VALUES
(1, 2, 'Anne Mararo', '1175045446', 'KCB', NULL, '2019-02-22 13:00:07', '2019-03-22 12:19:06', 'THIKA BRANCH', '01108', '01108'),
(2, 24, 'Zipporah Kwamboka Ondari', '01109670830200', 'COOP BANK', NULL, '2019-02-22 13:05:13', '2019-03-22 12:20:19', 'KISII BRANCH', ' 11008 ', ' 11008 '),
(3, 4, 'Mweresa Basweti Diana', '0170175659851', 'EQUITY BANK', NULL, '2019-02-28 09:24:15', '2019-02-28 09:24:15', 'COMMUNITY BRANCH', '68017', '68017'),
(4, 7, 'Phulen Lianzika', '1160164981593', 'EQUITY BANK', NULL, '2019-02-28 09:26:49', '2019-02-28 09:26:49', 'MIGORI BRANCH', '68116', '68116'),
(5, 5, 'Ramkrishna Jalala ', '0900603020', ' DIAMOND TRUST', NULL, '2019-02-28 09:34:33', '2019-02-28 09:34:33', 'INDUSTRIAL AREA ', '63009', '63009'),
(6, 8, 'Ernest Wangatia', '6797940011', 'COMERCIAL BANK OF AFRICA', NULL, '2019-02-28 09:42:29', '2019-03-22 09:43:59', 'WESTLANDS', '07004', '07004'),
(7, 9, 'Francis Musembi', '1139402250', 'KCB', NULL, '2019-02-28 11:23:43', '2019-02-28 11:23:43', 'INDUSTRIAL AREA BRANCH', '01113', '01113'),
(8, 10, 'Davis Kuloba Wafula', '1004774929', 'NIC BANK', NULL, '2019-02-28 11:31:22', '2019-02-28 11:31:22', 'KITENGELA BRANCH', '41000', '41000'),
(9, 11, 'Thomas Siko', '0510193683800', 'EQUITY BANK', NULL, '2019-02-28 11:34:37', '2019-02-28 11:34:37', 'KISII BRANCH', '68051', '68051'),
(10, 12, 'Jackson Kibet', '0300162187991', 'EQUITY BANK', NULL, '2019-02-28 11:36:16', '2019-03-22 09:44:42', 'ELDORET BRANCH', '68030', '68030'),
(11, 13, 'Moraa Ongombe Eddah', '1129205363', 'KCB', NULL, '2019-03-04 07:18:02', '2019-03-04 07:18:02', 'INDUSTRIAL AREA', '01113', '01113'),
(12, 14, 'Mary Kisanya', '1116163582100', 'COOP BANK', NULL, '2019-03-04 07:33:01', '2019-03-04 07:33:01', 'UPPERHILL', '11037', '11037'),
(13, 15, 'Lilian Omwenga', '1116190117', 'KCB', NULL, '2019-03-05 10:23:27', '2019-03-05 10:23:27', 'MOI AVENUE', '01100', '01100'),
(14, 16, 'Juma Wilfred Mariera', '01116289015100', 'COOP BANK', NULL, '2019-03-05 10:25:54', '2019-03-05 10:25:54', 'KITENGELA BRANCH', '11064', '11064'),
(15, 17, 'Edwin Mokaya', '1240294743', 'KCB BANK', NULL, '2019-03-05 10:56:51', '2019-03-05 10:56:51', 'KEROKA BRANCH', '01233', '01233'),
(16, 6, 'Allan Indeche', '0470194021312', 'EQUITY BANK', NULL, '2019-03-05 10:58:29', '2019-03-05 10:58:29', 'MOI AVENUE', '68047', '68047'),
(17, 18, 'Isaac Cheruiyot Bor', '01109405981800', 'COOP BANK', NULL, '2019-03-22 09:46:53', '2019-03-22 09:46:53', 'DONHOLM', '11087', '11087'),
(18, 19, 'Gideon Mutuku Mue', '0120176208758', 'EQUITY BANK', NULL, '2019-03-22 09:55:37', '2019-03-22 09:55:37', 'TOM MBOYA', ' 68012 ', ' 68012 '),
(19, 20, 'Saladin Bidu Galgalo', '1238459056', ' KCB ', NULL, '2019-03-22 10:01:29', '2019-03-22 10:01:29', 'KEROKA BRANCH ', '01234', '01234'),
(20, 21, 'Dennis Ndegwa Maina', ' 0120193009870 ', ' EQUITY', NULL, '2019-03-22 10:02:55', '2019-03-22 10:02:55', 'TOM MBOYA ', ' 68012 ', ' 68012 '),
(21, 23, 'Anderson Ambwere Obote', '0500167453452', 'EQUITY BANK', NULL, '2019-03-22 10:04:41', '2019-03-22 12:38:26', 'KAKAMEGA BRANCH', '68050', '68050'),
(22, 22, 'Robert Moguku Onduso', '1205112146', 'KCB BANK', NULL, '2019-03-22 10:25:36', '2019-03-22 10:25:36', 'KISII BRANCH', '01191', '01191'),
(23, 25, 'Joshua Oloipera Tajewuo', '001206758643', 'KCB BANK', NULL, '2019-03-22 10:27:13', '2019-03-22 10:27:13', 'MASHARIKI', '01249', '01249'),
(24, 26, 'Caroline Chepngetich', '01109357629400', 'COOP BANK', NULL, '2019-03-22 10:28:24', '2019-03-22 10:28:24', 'BOMET BRANCH', '11082', '11082'),
(25, 27, 'Stella Nchore', '1240199508750', 'EQUITY BANK', NULL, '2019-03-22 10:29:33', '2019-03-22 10:29:33', 'KISII BRANCH', '68051', '68051'),
(26, 28, 'Denish Muga Okoth', '01109434112800', 'COOP BANK', NULL, '2019-03-22 10:32:27', '2019-03-22 10:32:27', 'NDHIWA', '11100', '11100'),
(27, 29, 'Haron Magati Omwenga', '1212938526', 'KCB BANK', NULL, '2019-03-22 10:33:29', '2019-03-22 10:33:29', 'KISII BRANCH', '01191', '01191'),
(28, 30, 'Dickson Ouru Kombo', '01116506015300', 'COOP BANK', NULL, '2019-03-22 10:34:29', '2019-03-22 10:34:29', 'NAKURU BRANCH', '11006', '11006'),
(29, 31, 'Benard Cheruiyot Terer', '0300192704523', 'EQUITY BANK', NULL, '2019-03-22 10:42:04', '2019-03-22 10:42:04', 'KEROKA BRANCH', '68124', '68124'),
(30, 32, 'Timothy Obare', '1146271964', 'KCB ', NULL, '2019-03-22 10:43:06', '2019-03-22 10:59:37', 'KEROKA BRANCH', '01233', '01233'),
(31, 33, 'Robert Gekonge', '0200193875609', 'EQUITY BANK ', NULL, '2019-03-22 10:44:11', '2019-03-22 10:44:11', 'KEROKA BRANCH', '68124', '68124'),
(32, 34, 'William Ochieng Outa', '1119734606', 'KCB BANK', NULL, '2019-03-22 10:45:03', '2019-03-22 10:45:03', 'KEROKA BRANCH', '01233', '01233'),
(33, 35, 'Enock Moranga Ndege', '1145660738', 'KCB BANK', NULL, '2019-03-22 10:45:56', '2019-03-22 10:45:56', 'MVITA BRANCH', '01136', '01136'),
(34, 36, 'Nathaniel Njoroge Gichure', '0690192520017', 'EQUITY BANK', NULL, '2019-03-22 10:47:59', '2019-03-22 10:47:59', 'KIMENDE BRANCH', '68111', '68111'),
(35, 37, 'Pauline Omuga', '1250762146', 'KCB ', NULL, '2019-03-22 10:48:50', '2019-03-22 10:48:50', 'KEROKA BRANCH', '01233', '01233'),
(36, 38, 'Thomas Mutuku', '1239152043', 'KCB BANK', NULL, '2019-03-22 10:49:55', '2019-03-22 10:49:55', 'JOGOO RD', '01137', '01137'),
(37, 39, 'Mercy Mukami', '001206761121', 'KCB BANK', NULL, '2019-03-22 10:50:58', '2019-03-22 10:50:58', 'MASHARIKI', '01249', '01249'),
(38, 96, 'Kennedy Motende Maganga', '1209650525', 'KCB BANK', NULL, '2019-03-22 10:52:06', '2019-03-22 10:52:06', 'KEROKA BRANCH', '01233', '01233'),
(39, 40, 'Douglas Ombongi James', '1247957578', 'KCB BANK', NULL, '2019-03-22 10:52:58', '2019-03-22 10:52:58', 'KEROKA BRANCH', '01233', '01233'),
(40, 41, 'Bonfance Sime', '1252318707', 'KCB BANK', NULL, '2019-03-22 10:53:59', '2019-03-22 10:53:59', 'KEROKA BRANCH', '01233', '01233'),
(41, 42, 'Wilbert Mangera', '1252239785', 'KCB BANK', NULL, '2019-03-22 10:54:58', '2019-03-22 10:54:58', 'KEROKA BRANCH', '01233', '01233'),
(42, 43, 'Justus Muli', '01116496109800', 'COOP BANK', NULL, '2019-03-22 10:56:13', '2019-03-22 10:56:13', 'KEROKA BRANCH', '11083', '11083'),
(43, 44, 'Urbunus Ndeto Ngui', '1241214344', 'KCB BANK', NULL, '2019-03-22 11:00:38', '2019-03-22 11:00:38', 'MATUU', '01134', '01134'),
(44, 45, 'Anthony Kituku', ' 1241289468 ', ' KCB BANK', NULL, '2019-03-22 11:02:05', '2019-03-22 11:02:05', 'KEROKA BRANCH ', '01233', '01233'),
(45, 46, 'Dennis Odende Juma', '1120644488', 'KCB BANK', NULL, '2019-03-22 11:03:16', '2019-03-22 11:03:16', 'KISUMU BRANCH', '01105', '01105'),
(46, 47, 'Esiera Avity', '1212906659', 'KCB BANK', NULL, '2019-03-22 11:04:39', '2019-03-22 11:04:39', 'SOTIK', '01189', '01189'),
(47, 48, 'Wambua Kalui', '1133082629', 'KCB BANK', NULL, '2019-03-22 11:06:07', '2019-03-22 11:06:07', 'SARIT CENTRE', '01141', '01141'),
(48, 49, 'Erick Ongeri Mongasia', '1174884398', 'KCB BANK', NULL, '2019-03-22 11:07:53', '2019-03-22 11:07:53', 'KITENGELA', '01162', '01162'),
(49, 50, 'Obiri Lameck Machora', '1215819609', 'KCB BANK', NULL, '2019-03-22 11:08:58', '2019-03-22 11:08:58', 'KEROKA BRANCH', '01233', '01233'),
(50, 51, 'Fredrick Alando', '1251290604', 'KCB BANK', NULL, '2019-03-22 11:10:06', '2019-03-22 11:10:06', 'KEROKA BRANCH', '01233', '01233'),
(51, 52, 'Alex Wambua', '1212974484', 'KCB BANK', NULL, '2019-03-22 11:11:16', '2019-03-22 11:11:16', 'KEROKA BRANCH', '01233', '01233'),
(52, 53, 'Chome Kazungu', '1241416346', 'KCB BANK', NULL, '2019-03-22 11:12:31', '2019-03-22 11:12:31', 'KEROKA BRANCH', '01233', '01233'),
(53, 54, 'Okongo Robert', '1179607643', 'KCB BANK', NULL, '2019-03-22 11:14:08', '2019-03-22 11:14:08', 'SONDU', '01245', '01245'),
(54, 97, 'Msechu Deric', '1136253092', 'KCB BANK', NULL, '2019-03-22 11:15:09', '2019-03-22 11:15:09', 'PRESTIGE', '01259', '01259'),
(55, 55, 'Emmanuel Wafula', '001121689272', 'KCB BANK', NULL, '2019-03-22 11:16:32', '2019-03-22 11:16:32', 'KITALE', '01149', '01149'),
(56, 56, 'Joseph Mekenye Ochoi', '1211856607', 'KCB BANK', NULL, '2019-03-22 11:17:41', '2019-03-22 11:17:41', 'SOTIK', '01189', '01189'),
(57, 57, 'Omaiko Mogaka', '1212954769', 'KCB BANK', NULL, '2019-03-22 11:18:39', '2019-03-22 11:18:39', 'KEROKA BRANCH', '01233', '01233'),
(58, 58, 'Charles Matunda Okongo', '1215071272', 'KCB BANK', NULL, '2019-03-22 11:20:17', '2019-03-22 11:20:17', 'SOTIK', '01189', '01189'),
(59, 60, 'Module Administrator', ' 1239180179 ', ' KCB BANK', NULL, '2019-03-22 11:21:35', '2019-03-22 11:25:24', 'KISII BRANCH ', '01191', '01191'),
(60, 59, 'Omori Onsongo Joshua', '0700168994699', 'EQUITY BANK', NULL, '2019-03-22 11:24:50', '2019-03-22 11:24:50', 'KITENGELA BRANCH', '68070', '68070'),
(61, 61, 'Nyambati Bworina Erick', '1232304859', 'KCB BANK', NULL, '2019-03-22 11:26:30', '2019-03-22 11:26:30', 'KILGORIS BRANCH', '01234', '01234'),
(62, 62, 'Peter Orora Moriyasi', '1230198818050', 'EQUITY BANK/', NULL, '2019-03-22 11:28:04', '2019-03-22 11:28:04', 'NYAMIRA', '68132', '68132'),
(63, 63, 'Jamal Mohammed', '1238871070', ' KCB BANK', NULL, '2019-03-22 11:29:24', '2019-03-22 11:29:24', 'SOTIK BRANCH ', '01189', '01189'),
(64, 64, 'Onguti Barongo John', '1234818396', 'KCB BANK', NULL, '2019-03-22 11:30:42', '2019-03-22 11:30:42', 'KEROKA BRANCH', '01233', '01233'),
(65, 65, 'Luke Kerongo Ayunga', '01109058940200', 'COOP BANK', NULL, '2019-03-22 11:31:38', '2019-03-22 11:31:38', 'EMBAKASI JUNCTION', '11121', '11121'),
(66, 66, 'Mercury Teresa', '1167311159', 'KCB BANK', NULL, '2019-03-22 11:32:34', '2019-03-22 11:32:34', 'MASHARIKI BRANCH', '01249', '01249'),
(67, 67, 'Atieno Rachael', '01108081103100', 'COOP BANK', NULL, '2019-03-22 11:34:07', '2019-03-22 11:34:07', 'KITENGELA BRANCH', '11000', '11000'),
(68, 68, 'Mary Atieno', '2038901101', 'BBK BANK', NULL, '2019-03-22 11:35:15', '2019-03-22 11:35:15', 'MARKET BRANCH', '03094', '03094'),
(69, 69, 'Lydiah Bonareri Ombongi', '0300193410094', 'EQUITY BANK', NULL, '2019-03-22 11:37:35', '2019-03-22 11:37:35', 'ELDORET BRANCH', '68030', '68030'),
(70, 69, 'Lydiah Bonareri Ombongi', '0300193410094', 'EQUITY BANK', NULL, '2019-03-22 11:37:36', '2019-03-22 11:37:36', 'ELDORET BRANCH', '68030', '68030'),
(71, 70, 'Simon Nzioki', '001139095927', ' KCB BANK', NULL, '2019-03-22 11:38:39', '2019-03-22 11:38:39', 'INDUSTRIAL AREA BRANCH ', '01113', '01113'),
(72, 71, 'Victor Kinara Nyambane', '01116028831200', 'COOP BANK', NULL, '2019-03-22 11:40:01', '2019-03-22 11:40:01', 'INDUSTRIAL AREA BRANCH', '11007', '11007'),
(73, 72, 'Otieno Felix Owour', '1111795711', 'KCB BANK', NULL, '2019-03-22 11:41:08', '2019-03-22 11:41:08', 'UNITED MALL', '01243', '01243'),
(74, 73, 'Mutunga Wilson Mutuku', '1220175439', 'KCB BANK', NULL, '2019-03-22 11:41:59', '2019-03-22 11:41:59', 'EASLEIGH BRANCH', '01091', '01091'),
(75, 74, 'Mutonga Mwaura Francis', '01116500511500', 'COOP BANK', NULL, '2019-03-22 11:42:48', '2019-03-22 11:42:48', 'KAREN BRANCH', '11135', '11135'),
(76, 77, 'Christopher Kilonzo', '1251180647', 'KCB BANK', NULL, '2019-03-22 11:45:14', '2019-03-22 11:45:14', 'KEROKA BRANCH', '01233', '01233'),
(77, 75, 'George Nyagaya', '0290190383480', 'EQUITY BANK', NULL, '2019-03-22 11:46:21', '2019-03-22 12:13:36', 'KISUMU BRANCH', ' 68029 ', ' 68029 '),
(78, 76, 'Kennedy Ochieng', '01116386039000', 'COOP BANK', NULL, '2019-03-22 11:47:01', '2019-03-22 12:12:04', 'KISUMU BRANCH', '11000', '11000'),
(79, 78, 'Obed Nyakundi', '0800193619175', 'EQUITY BANK', NULL, '2019-03-22 11:47:52', '2019-03-22 11:47:52', 'INDUSTRIAL AREA', '68000', '68000'),
(80, 79, 'Zena Akoth', '01109671072700', 'COOP BANK', NULL, '2019-03-22 11:49:21', '2019-03-22 11:49:21', 'KISII BRANCH', ' 11008 ', ' 11008 '),
(81, 80, 'Module Administrator', '01108423453200', 'COOP BANK', NULL, '2019-03-22 11:50:13', '2019-03-22 12:15:46', 'KISII BRANCH', ' 11009 ', ' 11009 '),
(82, 81, 'Module Administrator', '1212149114', 'KCB BANK', NULL, '2019-03-22 11:51:07', '2019-03-22 11:51:07', 'KISII BRANCH', '01191', '01191'),
(83, 82, 'Prisca Malova', '0500195439239', 'EQUITY BANK', NULL, '2019-03-22 11:52:00', '2019-03-22 11:52:00', ' KAKAMEGA BRANCH', '68050', '68050'),
(84, 83, 'Phibian Nyabuto', '0730164198657', 'EQUITY BANK', NULL, '2019-03-22 11:53:31', '2019-03-22 11:53:31', 'NGONG', '68073', '68073'),
(85, 84, 'Olivia Owen', '01550204172200', 'NATIONAL BANK OF KENYA', NULL, '2019-03-22 11:54:35', '2019-03-22 11:54:35', 'KISUMU BRANCH', '12050', '12050'),
(86, 85, 'Jane Mudiri', '01116116792100', 'COOP BANK', NULL, '2019-03-22 11:55:44', '2019-03-22 11:55:44', 'NAIVASHA BRANCH', '11015', '11015'),
(87, 86, 'Florence Akinyi', '1006311276', 'NIC BANK', NULL, '2019-03-22 11:56:39', '2019-03-22 11:56:39', 'ELDORET BRANCH', '41116', '41116'),
(88, 87, 'Stanley Gisore Maina', '0100375924300', 'STANDARD CHARTERED', NULL, '2019-03-22 11:57:58', '2019-03-22 11:57:58', 'WESTLANDS ', '02015', '02015'),
(89, 88, 'Everlyne Meraba', '1240199946491', 'EQUITY BANK', NULL, '2019-03-22 11:59:56', '2019-03-22 11:59:56', 'KEROKA BRANCH', '68124', '68124'),
(90, 89, 'Irene Cherono', '1157497411', 'KCB BANK', NULL, '2019-03-22 12:00:58', '2019-03-22 12:00:58', 'SOTIK', '01094', '01094'),
(91, 90, 'Monica Apopa', '01108471174300', 'COOP BANK', NULL, '2019-03-22 12:01:45', '2019-03-22 12:01:45', 'MBALE BRANCH', '11110', '11110'),
(92, 91, 'Mildred Wayua', '01108313144900', 'COOP BANK', NULL, '2019-03-22 12:02:33', '2019-03-22 12:02:33', 'KITENGELA BRANCH', '11064', '11064'),
(93, 92, 'Grace Rehema', '0120194292534', 'EQUITY BANK', NULL, '2019-03-22 12:03:23', '2019-03-22 12:03:23', 'KENYATTA AVENUE', '68129', '68129'),
(94, 93, 'Loice Mutua', '01109683028500', 'COOP BANK', NULL, '2019-03-22 12:05:01', '2019-03-22 12:05:43', 'DONHOLM BRANCH', '11087', '11087'),
(95, 94, 'Juline Aluoch', '0150100063007', 'EQUITY BANK', NULL, '2019-03-22 12:09:03', '2019-03-22 12:09:03', 'MAMA NGINA BRANCH', '68015', '68015'),
(96, 95, 'Allan Omuka', '1144998638', 'KCB BANK', NULL, '2019-03-22 12:10:02', '2019-03-22 12:10:02', 'MOI AVENUE', '01100', '01100');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `location`, `contact`, `created_at`, `updated_at`) VALUES
(1, 'nyansiongo', 'Kisii', '0796332555', '2019-01-09 11:51:25', '2019-01-09 11:52:28'),
(2, 'Nairobi Depot ', 'Nairobi', '0796332555', '2019-01-31 11:39:03', '2019-01-31 11:39:03');

-- --------------------------------------------------------

--
-- Table structure for table `cancel_contracts`
--

CREATE TABLE `cancel_contracts` (
  `id` int(10) UNSIGNED NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cancel_contracts`
--

INSERT INTO `cancel_contracts` (`id`, `reason`, `created_at`, `updated_at`) VALUES
(1, 'fghthhhgh', '2019-01-31 12:05:21', '2019-01-31 12:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `cancel_contract_user`
--

CREATE TABLE `cancel_contract_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `cancel_contract_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cancel_contract_user`
--

INSERT INTO `cancel_contract_user` (`id`, `user_id`, `cancel_contract_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `job_vacancy_id` int(11) NOT NULL,
  `resume` text COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `skills` longtext COLLATE utf8_unicode_ci NOT NULL,
  `experience` longtext COLLATE utf8_unicode_ci NOT NULL,
  `salary` int(11) NOT NULL,
  `language` text COLLATE utf8_unicode_ci NOT NULL,
  `application_date` date NOT NULL,
  `recruitment_type` int(11) NOT NULL,
  `status` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `first_name`, `last_name`, `email`, `contact_no`, `job_vacancy_id`, `resume`, `comment`, `gender`, `dob`, `skills`, `experience`, `salary`, `language`, `application_date`, `recruitment_type`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Willson', 'Exteer', 'exteer@gmail.com', '0785128945', 1, '', 'Welcome', 'MALE', '0000-00-00', '<p>I AM well equipped just try me.&nbsp;</p>', '<p>6 years&nbsp;</p>', 52000, 'Chinese', '2019-02-28', 0, '2', NULL, '2019-02-06 06:25:21', '2019-02-06 06:25:21');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Baragoi', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(2, 'Bungoma', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(3, 'Busia', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(4, 'Butere', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(5, 'Dadaab', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(6, 'Diani Beach', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(7, 'Eldoret', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(8, 'Emali', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(9, 'Embu', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(10, 'Garissa', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(11, 'Gede', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(12, 'Hola', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(13, 'Homa Bay', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(14, 'Isiolo', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(15, 'Kitui', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(16, 'Kibwezi', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(17, 'Makindu', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(18, 'Wote', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(19, 'Mutomo', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(20, 'Kajiado', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(21, 'Kakamega', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(22, 'Kakuma', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(23, 'Kapenguria', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(24, 'Kericho', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(25, 'Kiambu', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(26, 'Kilifi', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(27, 'Kisii', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(28, 'Kisumu', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(29, 'Kitale', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(30, 'Lamu', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(31, 'Langata', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(32, 'Litein', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(33, 'Lodwar', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(34, 'Lokichoggio', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(35, 'Londiani', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(36, 'Loyangalani', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(37, 'Machakos', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(38, 'Malindi', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(39, 'Mandera', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(40, 'Maralal', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(41, 'Marsabit', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(42, 'Meru', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(43, 'Mombasa', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(44, 'Moyale', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(45, 'Mumias', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(46, 'Muranga', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(47, 'Nairobi', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(48, 'Naivasha', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(49, 'Nakuru', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(50, 'Namanga', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(51, 'Nanyuki', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(52, 'Naro Moru', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(53, 'Narok', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(54, 'Nyahururu', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(55, 'Nyeri', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(56, 'Ruiru', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(57, 'Shimoni', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(58, 'Takaungu', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(59, 'Thika', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(60, 'Vihiga', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(61, 'Voi', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(62, 'Wajir', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(63, 'Watamu', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(64, 'Webuye', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(65, 'Wundanyi', '2019-01-09 07:10:38', '2019-01-09 07:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `company_offences`
--

CREATE TABLE `company_offences` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `id` int(10) UNSIGNED NOT NULL,
  `template_id` int(11) DEFAULT NULL,
  `expiry_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `renewable_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `cancel_contract_users` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`id`, `template_id`, `expiry_date`, `reason`, `renewable_date`, `status`, `cancel_contract_users`, `created_at`, `updated_at`) VALUES
(1, 1, '03/01/2020', NULL, NULL, 1, NULL, '2019-01-31 12:04:26', '2019-01-31 12:04:26'),
(2, 1, '12/31/2019', NULL, NULL, 1, NULL, '2019-02-15 05:28:48', '2019-02-15 05:28:48'),
(3, 3, '03/09/2021', NULL, NULL, 1, NULL, '2019-02-15 05:34:00', '2019-02-15 05:49:55'),
(4, 3, '03/09/2021', NULL, NULL, 1, NULL, '2019-02-15 05:50:34', '2019-02-15 05:50:34'),
(5, 3, '03/09/2021', NULL, NULL, 1, NULL, '2019-02-15 05:51:26', '2019-02-15 05:51:26'),
(6, 2, '01/01/2020', NULL, NULL, 1, NULL, '2019-02-15 05:53:27', '2019-02-15 05:53:27'),
(7, 3, '03/09/2021', NULL, NULL, 1, NULL, '2019-02-15 05:54:29', '2019-02-15 05:54:29'),
(8, 1, '03/09/2021', NULL, NULL, 1, NULL, '2019-02-15 13:17:22', '2019-02-15 13:17:22'),
(9, 2, '01/09/2020', NULL, NULL, 1, NULL, '2019-02-18 10:45:06', '2019-02-19 12:18:34'),
(10, 2, '01/01/2020', NULL, NULL, 1, NULL, '2019-02-18 10:46:57', '2019-02-18 10:46:57'),
(11, 3, '03/09/2021', NULL, NULL, 1, NULL, '2019-02-18 11:54:35', '2019-02-18 11:54:35');

-- --------------------------------------------------------

--
-- Table structure for table `contract_templates`
--

CREATE TABLE `contract_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contract_parameter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contract_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_frequency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gross_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `start_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contract_templates`
--

INSERT INTO `contract_templates` (`id`, `name`, `duration`, `contract_parameter`, `contract_type`, `payment`, `payment_frequency`, `gross_amount`, `created_at`, `updated_at`, `start_date`) VALUES
(1, 'SIX MONTHS ', '06/30/2019', 'Renewable', 'Employment', 'Paid', 'Monthly', '', '2019-01-31 12:03:22', '2019-03-22 12:52:19', '12/31/2018'),
(2, 'ONE YEAR', '01/31/2020', 'Renewable', 'Employment', 'Paid', 'Monthly', '', '2019-02-15 05:47:49', '2019-03-22 12:51:41', '01/01/2019'),
(3, 'TWO YEARS', '01/01/2021', 'Renewable', 'Employment', 'Paid', 'Monthly', '', '2019-02-15 05:49:16', '2019-03-04 07:45:14', '01/01/2019'),
(4, 'HIRED', '01/01/2021', 'Non-renewable', 'Consultancy', 'Paid', 'Monthly', '60000.00', '2019-02-15 06:16:17', '2019-03-22 12:53:00', '11/01/2019');

-- --------------------------------------------------------

--
-- Table structure for table `contract_user`
--

CREATE TABLE `contract_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `contract_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contract_user`
--

INSERT INTO `contract_user` (`id`, `user_id`, `contract_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, NULL),
(3, 7, 2, NULL, NULL),
(4, 5, 3, NULL, NULL),
(5, 4, 4, NULL, NULL),
(6, 6, 5, NULL, NULL),
(7, 8, 6, NULL, NULL),
(8, 9, 6, NULL, NULL),
(9, 10, 6, NULL, NULL),
(10, 11, 6, NULL, NULL),
(11, 12, 6, NULL, NULL),
(12, 13, 6, NULL, NULL),
(13, 14, 6, NULL, NULL),
(14, 15, 6, NULL, NULL),
(15, 16, 6, NULL, NULL),
(16, 17, 6, NULL, NULL),
(17, 18, 6, NULL, NULL),
(18, 19, 6, NULL, NULL),
(19, 20, 6, NULL, NULL),
(20, 21, 7, NULL, NULL),
(21, 22, 7, NULL, NULL),
(22, 23, 7, NULL, NULL),
(23, 24, 7, NULL, NULL),
(24, 30, 8, NULL, NULL),
(25, 31, 9, NULL, NULL),
(26, 32, 9, NULL, NULL),
(27, 33, 9, NULL, NULL),
(28, 34, 9, NULL, NULL),
(29, 35, 9, NULL, NULL),
(30, 36, 9, NULL, NULL),
(31, 37, 9, NULL, NULL),
(32, 38, 9, NULL, NULL),
(33, 39, 9, NULL, NULL),
(34, 40, 9, NULL, NULL),
(35, 41, 9, NULL, NULL),
(36, 42, 9, NULL, NULL),
(37, 43, 9, NULL, NULL),
(38, 44, 9, NULL, NULL),
(39, 45, 9, NULL, NULL),
(40, 46, 9, NULL, NULL),
(41, 47, 9, NULL, NULL),
(42, 48, 9, NULL, NULL),
(43, 49, 9, NULL, NULL),
(44, 50, 9, NULL, NULL),
(45, 51, 9, NULL, NULL),
(46, 52, 9, NULL, NULL),
(47, 53, 9, NULL, NULL),
(48, 54, 9, NULL, NULL),
(49, 55, 9, NULL, NULL),
(50, 56, 9, NULL, NULL),
(51, 57, 9, NULL, NULL),
(52, 58, 9, NULL, NULL),
(53, 59, 9, NULL, NULL),
(54, 60, 9, NULL, NULL),
(55, 61, 9, NULL, NULL),
(56, 62, 9, NULL, NULL),
(57, 63, 9, NULL, NULL),
(58, 64, 9, NULL, NULL),
(59, 65, 9, NULL, NULL),
(60, 66, 9, NULL, NULL),
(61, 67, 9, NULL, NULL),
(62, 68, 9, NULL, NULL),
(63, 69, 9, NULL, NULL),
(64, 70, 9, NULL, NULL),
(65, 71, 9, NULL, NULL),
(66, 72, 9, NULL, NULL),
(67, 73, 9, NULL, NULL),
(68, 74, 9, NULL, NULL),
(69, 75, 10, NULL, NULL),
(70, 76, 10, NULL, NULL),
(71, 77, 10, NULL, NULL),
(72, 78, 10, NULL, NULL),
(73, 79, 10, NULL, NULL),
(74, 80, 10, NULL, NULL),
(75, 81, 10, NULL, NULL),
(76, 82, 10, NULL, NULL),
(77, 83, 10, NULL, NULL),
(78, 84, 10, NULL, NULL),
(79, 85, 10, NULL, NULL),
(80, 86, 10, NULL, NULL),
(81, 87, 10, NULL, NULL),
(82, 88, 10, NULL, NULL),
(83, 89, 10, NULL, NULL),
(84, 90, 10, NULL, NULL),
(85, 91, 10, NULL, NULL),
(86, 92, 10, NULL, NULL),
(87, 93, 10, NULL, NULL),
(88, 94, 10, NULL, NULL),
(89, 95, 10, NULL, NULL),
(90, 25, 11, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cut_offs`
--

CREATE TABLE `cut_offs` (
  `id` int(10) UNSIGNED NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `department` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `payment_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `leave_type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department`, `deleted_at`, `payment_id`, `created_at`, `updated_at`, `leave_type_id`) VALUES
(1, 'Web Development', '2019-01-09 11:55:17', 0, '2019-01-09 07:10:38', '2019-01-09 11:55:17', NULL),
(2, 'Marketing', NULL, 0, '2019-01-09 07:10:38', '2019-01-09 07:10:38', NULL),
(3, 'Sales', NULL, 0, '2019-01-09 07:10:38', '2019-01-09 07:10:38', NULL),
(4, 'Administration', NULL, 0, '2019-01-09 07:10:38', '2019-02-05 07:11:29', NULL),
(5, 'Content', '2019-01-09 11:55:27', 0, '2019-01-09 07:10:38', '2019-01-09 11:55:27', NULL),
(6, 'IT', NULL, 0, '2019-01-09 11:53:49', '2019-01-09 11:53:49', NULL),
(7, 'Production', NULL, 0, '2019-01-09 11:54:51', '2019-02-13 13:46:13', NULL),
(8, 'Finance ', NULL, 0, '2019-01-31 11:39:47', '2019-01-31 11:39:47', NULL),
(9, 'Maintenance ', NULL, 0, '2019-01-31 11:40:06', '2019-01-31 11:40:06', NULL),
(10, 'Logistics ', NULL, 0, '2019-01-31 11:40:20', '2019-01-31 11:40:20', NULL),
(11, 'HR & ADMIN', NULL, 0, '2019-02-05 07:41:53', '2019-02-15 10:07:26', NULL),
(12, 'Dispatch', NULL, 0, '2019-02-13 13:45:53', '2019-02-13 13:45:53', NULL),
(13, 'Procurement/Stores', NULL, 0, '2019-02-13 13:46:49', '2019-02-13 13:46:49', NULL),
(14, 'Extension', NULL, 0, '2019-02-13 13:47:20', '2019-02-13 13:47:20', NULL),
(15, 'Quality Assurance', NULL, 0, '2019-02-13 13:48:02', '2019-02-13 13:48:02', NULL),
(16, 'Sales & Marketing', NULL, 0, '2019-02-13 13:49:03', '2019-02-13 13:49:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `department_leave_type`
--

CREATE TABLE `department_leave_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `department_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `designation_item_id` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `user_id`, `designation_item_id`, `date_start`, `date_end`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 2, '2019-02-01', '2020-06-23', NULL, '2019-01-31 12:50:46', '2019-01-31 12:50:46'),
(2, 2, 4, '2019-01-06', '2019-01-30', NULL, '2019-01-31 14:25:44', '2019-01-31 14:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `designation_items`
--

CREATE TABLE `designation_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `designation_item` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `designation_items`
--

INSERT INTO `designation_items` (`id`, `designation_item`, `department_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Junior Web Developer', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(2, 'Senior Web Developer', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(3, 'Web Development Manager', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(4, 'Marketing Manager', 2, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(5, 'Marketing Associate', 2, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(6, 'Sales Manager', 3, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(7, 'Sales Associate', 3, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(8, 'Admin Associate', 4, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(9, 'Content Manager', 5, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(10, 'Content Junior Writer', 5, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(11, 'Content Senior Writer', 5, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(12, 'HUMAN RESOURCE', 4, NULL, '2019-01-09 11:56:13', '2019-01-09 11:56:13'),
(13, 'System Administrator ', 6, NULL, '2019-01-31 11:41:58', '2019-01-31 11:41:58'),
(14, 'Network Administrator', 6, NULL, '2019-02-05 07:43:43', '2019-02-05 07:43:43'),
(15, 'System Administrator', 6, NULL, '2019-02-05 07:44:10', '2019-02-05 07:44:10'),
(16, 'General IT Administrator', 6, NULL, '2019-02-05 07:44:31', '2019-02-05 07:44:31'),
(17, 'test', 7, '2019-02-08 11:52:32', '2019-02-08 11:52:24', '2019-02-08 11:52:32'),
(18, 'Dispatch Supervisor ', 8, '2019-02-13 13:52:55', '2019-02-08 11:54:24', '2019-02-13 13:52:55'),
(19, 'Receptionist', 8, NULL, '2019-02-13 13:33:34', '2019-02-13 13:33:34'),
(20, 'Sales Person', 0, NULL, '2019-02-13 13:34:13', '2019-02-13 13:34:13'),
(21, 'Receptionist', 11, NULL, '2019-02-13 13:35:04', '2019-02-13 13:35:04'),
(22, 'Accounts Payables', 8, NULL, '2019-02-13 13:35:51', '2019-02-13 13:42:53'),
(23, 'Finance Manager', 8, NULL, '2019-02-13 13:37:19', '2019-02-13 13:37:19'),
(24, 'Cost Accounts', 8, NULL, '2019-02-13 13:39:24', '2019-02-13 13:39:24'),
(25, 'Accounts Receivables', 8, NULL, '2019-02-13 13:42:30', '2019-02-13 13:42:30'),
(26, 'Accounts Clerk', 8, NULL, '2019-02-13 13:43:32', '2019-02-13 13:43:32'),
(27, 'Milk Receiving Clerk', 8, NULL, '2019-02-13 13:44:21', '2019-02-13 13:44:21'),
(28, 'Supervisor', 12, NULL, '2019-02-13 13:51:03', '2019-02-13 13:51:03'),
(29, 'Ass. Supervisor', 12, NULL, '2019-02-13 13:51:28', '2019-02-13 13:51:28'),
(30, 'Supervisor', 13, NULL, '2019-02-13 13:52:20', '2019-02-13 13:52:20'),
(31, 'Ass. Supervisor', 13, NULL, '2019-02-13 13:54:12', '2019-02-13 13:54:12'),
(32, 'Supervisor', 14, NULL, '2019-02-13 13:54:43', '2019-02-13 13:54:43'),
(33, 'Grader', 14, NULL, '2019-02-13 13:55:06', '2019-02-13 13:55:06'),
(34, 'QA Supervisor', 15, NULL, '2019-02-13 13:55:35', '2019-02-13 13:55:35'),
(35, 'Supervisor', 7, NULL, '2019-02-13 13:56:47', '2019-02-13 13:56:47'),
(36, 'Plant Manager', 7, NULL, '2019-02-13 13:57:10', '2019-02-13 13:57:10'),
(37, 'Senior Electronic & Electrical Technician ', 9, NULL, '2019-02-13 13:58:36', '2019-02-13 13:58:36'),
(38, 'R.O. Operator', 9, NULL, '2019-02-13 13:59:18', '2019-02-13 13:59:18'),
(39, 'Welder', 9, NULL, '2019-02-13 14:00:04', '2019-02-13 14:00:04'),
(40, 'Operative', 7, NULL, '2019-02-15 10:05:46', '2019-02-15 10:05:46'),
(41, 'Driver', 10, NULL, '2019-02-17 15:30:15', '2019-02-17 15:30:15'),
(42, 'ASM NRB GT', 16, NULL, '2019-02-17 15:32:45', '2019-02-17 15:32:45'),
(43, 'Sales MGR MT', 16, NULL, '2019-02-17 15:33:31', '2019-02-17 15:33:31'),
(44, 'Customer Care/Sales', 16, NULL, '2019-02-17 15:34:51', '2019-02-17 15:34:51'),
(45, 'Marchandiser', 16, NULL, '2019-02-17 15:35:38', '2019-02-17 15:35:38'),
(46, 'Sales REP', 16, NULL, '2019-02-17 15:35:57', '2019-02-17 15:35:57'),
(47, 'BA NRB', 16, NULL, '2019-02-17 15:36:35', '2019-02-17 15:36:35'),
(48, 'Marketing Executive', 2, NULL, '2019-02-17 15:37:29', '2019-02-17 15:37:29'),
(49, 'Carpenter', 9, NULL, '2019-02-17 15:39:12', '2019-02-17 15:39:12'),
(50, 'ETP Operator', 9, NULL, '2019-02-17 15:39:43', '2019-02-17 15:39:43'),
(51, 'Plumber', 9, NULL, '2019-02-17 15:40:04', '2019-02-17 15:40:04'),
(52, 'Boiler Operator', 9, NULL, '2019-02-17 15:41:07', '2019-02-17 15:41:07');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `document_type_id` int(11) NOT NULL,
  `document` text COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `document_types`
--

CREATE TABLE `document_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `document_type` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `document_types`
--

INSERT INTO `document_types` (`id`, `document_type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Resume', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(2, 'Application Letter', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(3, 'Admission', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(4, 'Other', NULL, '2019-02-06 06:20:25', '2019-02-06 06:20:25'),
(5, 'Payslip', NULL, '2019-02-08 12:01:35', '2019-02-08 12:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `education_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `education_institution` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `education_grade` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `types` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `escalations`
--

CREATE TABLE `escalations` (
  `id` int(10) UNSIGNED NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `recruitment_id` int(11) NOT NULL,
  `process_id` int(11) NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci,
  `application_status` int(11) DEFAULT NULL,
  `esc_status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `description`, `date_start`, `date_end`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'teambuilding', 'teambuilding', '2019-02-03', '2019-02-13', '', NULL, '2019-01-09 12:31:14', '2019-02-08 12:00:10'),
(2, 'wewe qwewe  wewr wew', 'qqdwq', '2019-01-01', '2019-01-25', '', '2019-01-31 14:16:55', '2019-01-31 14:16:43', '2019-01-31 14:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `purchase_from` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `purchase_date` date NOT NULL,
  `amount` decimal(7,2) NOT NULL,
  `attachment` text COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hierachies`
--

CREATE TABLE `hierachies` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hierachies`
--

INSERT INTO `hierachies` (`id`, `user_id`, `manager_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-01-31 08:38:10', '2019-01-31 08:38:10');

-- --------------------------------------------------------

--
-- Table structure for table `hierachy_user`
--

CREATE TABLE `hierachy_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `hirachy_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hierachy_user`
--

INSERT INTO `hierachy_user` (`id`, `hirachy_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(10) UNSIGNED NOT NULL,
  `occasion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issued_appreciations`
--

CREATE TABLE `issued_appreciations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issued_warnings`
--

CREATE TABLE `issued_warnings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `issued_warnings`
--

INSERT INTO `issued_warnings` (`id`, `user_id`, `title`, `subject`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'Late  ', 'reporting late on duty  ', '<p>bbbbbb</p>', 0, '2019-01-31 12:29:06', '2019-01-31 12:29:06');

-- --------------------------------------------------------

--
-- Table structure for table `job_groups`
--

CREATE TABLE `job_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_vacancies`
--

CREATE TABLE `job_vacancies` (
  `id` int(10) UNSIGNED NOT NULL,
  `job_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `details` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_vacancies`
--

INSERT INTO `job_vacancies` (`id`, `job_title`, `user_id`, `status`, `details`, `type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Quality', 2, 0, 'WEWRWEERWYQQYQUQ', 'CAUSUAL ', NULL, '2019-01-31 12:33:59', '2019-02-06 06:29:21'),
(2, 'Telecommunication ', 3, 0, 'Must have IT skills', 'Entry Level', NULL, '2019-02-06 06:29:06', '2019-02-18 12:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `applied_on` date NOT NULL,
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `leave_no` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `backstopper_id` int(11) DEFAULT NULL,
  `remaining_days` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `user_id`, `leave_type_id`, `date_from`, `date_to`, `applied_on`, `reason`, `comment`, `leave_no`, `status`, `deleted_at`, `created_at`, `updated_at`, `staff_id`, `backstopper_id`, `remaining_days`) VALUES
(1, 1, 6, '2019-02-20', '2019-03-08', '2019-02-05', 'visiting our market', 'am going to visit our customers', 16, 0, NULL, '2019-02-05 08:43:29', '2019-02-05 08:43:29', 0, NULL, '5'),
(2, 1, 6, '2019-02-06', '2019-02-13', '2019-02-05', 'finding hope', 'withcome', 7, 0, NULL, '2019-02-05 09:16:54', '2019-02-05 09:16:54', 1, NULL, '18');

-- --------------------------------------------------------

--
-- Table structure for table `leavetype_user`
--

CREATE TABLE `leavetype_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `leave_type_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `staff_type_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `leavetype_user`
--

INSERT INTO `leavetype_user` (`id`, `leave_type_id`, `staff_type_id`, `created_at`, `updated_at`) VALUES
(1, '6', '1', NULL, NULL),
(2, '6', '3', NULL, NULL),
(3, '6', '4', NULL, NULL),
(4, '6', '5', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `leave_balances`
--

CREATE TABLE `leave_balances` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `opening_balance` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_days`
--

CREATE TABLE `leave_days` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `leaves_no` int(11) NOT NULL,
  `remaining_leaves` int(11) NOT NULL,
  `can_exceed_limit` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `leave_days`
--

INSERT INTO `leave_days` (`id`, `user_id`, `leave_type_id`, `leaves_no`, `remaining_leaves`, `can_exceed_limit`, `created_at`, `updated_at`) VALUES
(1, 3, 6, 21, 21, NULL, '2019-02-05 08:41:26', '2019-02-05 08:41:26'),
(2, 1, 6, 21, 18, NULL, '2019-02-05 08:42:09', '2019-02-05 09:16:54');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `leave_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `selected_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `backstopper_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count_start_half_day` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count_end_half_day` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `staff_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `staff_type_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `carried_forward` int(11) NOT NULL DEFAULT '0',
  `encashed` int(11) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `count_days` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `leave_type`, `selected_by`, `backstopper_id`, `designation`, `gender`, `count_start_half_day`, `count_end_half_day`, `staff_id`, `staff_type_id`, `carried_forward`, `encashed`, `deleted_at`, `created_at`, `updated_at`, `count_days`) VALUES
(1, 'Vacation Leave', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38', 0),
(2, 'Sick Leave', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38', 0),
(3, 'Maternal Leave', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38', 0),
(4, 'Paternal Leave', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38', 0),
(5, 'Birthday Leave', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38', 0),
(6, 'visit', 'by_staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2019-02-05 08:40:44', '2019-02-05 08:40:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `monthly_repayment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `installment_months` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `purpose` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `interest_rate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `approved_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `approved_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reject_reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lost_assets`
--

CREATE TABLE `lost_assets` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_01_14_025419_create_departments_table', 1),
('2016_01_14_053708_create_bank_accounts_table', 1),
('2016_01_14_053728_create_roles_table', 1),
('2016_01_14_053811_create_document_types_table', 1),
('2016_01_14_053926_create_expenses_table', 1),
('2016_01_14_054052_create_leave_types_table', 1),
('2016_01_14_054950_create_events_table', 1),
('2016_01_15_043254_create_holidays_table', 1),
('2016_01_19_084359_create_notices_table', 1),
('2016_01_19_101239_create_designation_items_table', 1),
('2016_01_19_101350_create_designations_table', 1),
('2016_01_19_101452_create_leaves_table', 1),
('2016_01_19_101544_create_absences_table', 1),
('2016_01_19_101626_create_documents_table', 1),
('2016_01_19_101709_create_awards_table', 1),
('2016_04_04_060813_create_permissions_table', 1),
('2016_04_04_061152_create_role_permissions_table', 1),
('2016_04_13_025653_create_job_vacancies_table', 1),
('2016_04_13_031905_create_candidates_table', 1),
('2016_05_02_080304_create_attendances_table', 1),
('2016_05_02_081949_create_cut_offs_table', 1),
('2016_12_21_102620_create_recruitment_types_table', 1),
('2016_12_22_074355_create_recruitment_processes_table', 1),
('2017_01_01_182434_create_assets_table', 1),
('2017_01_01_182548_create_lost_assets_table', 1),
('2017_01_01_182624_create_asset_transactions_table', 1),
('2017_01_05_073338_create_education_table', 1),
('2017_01_11_075043_create_branches_table', 1),
('2017_01_11_080058_create_cities_table', 1),
('2017_01_12_075202_create_company_offences_table', 1),
('2017_01_12_122757_create_job_groups_table', 1),
('2017_01_16_014504_create_trainings_table', 1),
('2017_01_16_014645_create_training_types_table', 1),
('2017_01_17_074158_create_travel_perdiems_table', 1),
('2017_01_18_232417_create_travel_modes_table', 1),
('2017_01_20_040902_create_notifications_table', 1),
('2017_01_20_042756_create_travel_requests_table', 1),
('2017_02_13_125813_create_vehicles_table', 1),
('2018_04_06_104531_create_termination_letters_table', 1),
('2018_04_06_104637_create_termination_issues_table', 1),
('2018_04_07_063821_create_warnings_table', 1),
('2018_04_08_115256_create_issued_warnings_table', 1),
('2018_04_09_021659_create_appreciation_templates_table', 1),
('2018_04_09_021728_create_issued_appreciations_table', 1),
('2018_04_18_122601_create_offer_letters_table', 1),
('2018_04_19_083834_create_appication_statuses_table', 1),
('2018_04_21_025805_create_offereds_table', 1),
('2018_04_21_061506_create_escalations_table', 1),
('2018_06_02_033949_create_appraisal_questions_table', 1),
('2018_06_02_061335_create_question_types_table', 1),
('2018_06_09_145304_create_appraisal_questionares_table', 1),
('2018_06_16_180437_create_active_appraisals_table', 1),
('2018_06_18_133916_create_ratings_table', 1),
('2018_06_19_063902_create_user_appraisals_table', 1),
('2018_09_26_092052_leave_type_pivot_table', 1),
('2018_09_27_050357_create_leave_days_table', 1),
('2019_01_05_152758_add_staff_id_field', 1),
('2019_01_06_001611_add_count_days_field', 1),
('2019_01_06_042254_department_leave_type_table', 1),
('2019_01_06_042702_add_leave_type_id_field', 1),
('2019_01_07_043440_add_backstopped_by_field', 1),
('2019_01_07_061701_create_user_leave_type_table', 1),
('2019_01_07_074825_create_leave_balances_table', 1),
('2019_01_07_101037_add_remaining_days_field', 1),
('2019_01_08_132219_create_sub_departments_table', 1),
('2019_01_08_135942_Remove_department_field', 1),
('2019_01_09_083646_create_contract_templates_table', 2),
('2019_01_15_040843_create_contracts_table', 2),
('2019_01_15_060049_create_contract_user_table', 2),
('2019_01_15_082013_create_cancel_contracts_table', 2),
('2019_01_15_082343_create_cancel_contract_user_table', 2),
('2019_01_15_102820_create_renew_contracts_table', 2),
('2019_01_15_103328_create_renew_contract_user_table', 2),
('2019_01_15_114851_create_loans_table', 2),
('2019_01_16_070747_create_asset_types_table', 2),
('2019_01_16_081434_create_request_assets_table', 2),
('2019_01_16_081505_create_return_assets_table', 2),
('2019_01_18_113125_create_hierachies_table', 2),
('2019_01_18_113537_create_hierachy_user_table', 2),
('2019_01_31_135712_add_password_confirmation_field_to_users', 3),
('2019_02_01_043405_add_branch_name_column', 4),
('2019_02_04_100205_add_custom_fields_to_users', 5),
('2019_02_04_101025_add_start_date_field', 5),
('2019_02_04_120546_add_nssf_no_field', 6),
('2019_02_18_111417_add_type_field_to_absences', 7),
('2019_02_18_132817_add_nssf_field', 7),
('2019_02_22_135133_add_branchcode_bankcode_beneficiary_name', 8);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(10) UNSIGNED NOT NULL,
  `published` tinyint(1) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offereds`
--

CREATE TABLE `offereds` (
  `id` int(10) UNSIGNED NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `template` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attachement` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offer_letters`
--

CREATE TABLE `offer_letters` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` tinyint(1) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission`, `label`, `level`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'view_absences', 'View Absences', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(2, 'create_absences', 'Create Absences', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(3, 'edit_absences', 'Edit Absences', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(4, 'delete_absences', 'Delete Absences', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(5, 'view_awards', 'View Awards', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(6, 'create_awards', 'Create Awards', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(7, 'edit_awards', 'Edit Awards', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(8, 'delete_awards', 'Delete Awards', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(9, 'view_bank_accounts', 'View Bank Accounts', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(10, 'create_bank_accounts', 'Create Bank Accounts', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(11, 'edit_bank_accounts', 'Edit Bank Accounts', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(12, 'delete_bank_accounts', 'Delete Bank Accounts', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(13, 'view_departments', 'View Departments', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(14, 'create_departments', 'Create Departments', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(15, 'edit_departments', 'Edit Departments', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(16, 'delete_departments', 'Delete Departments', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(17, 'view_designations', 'View Designations', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(18, 'create_designations', 'Create Designations', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(19, 'edit_designations', 'Edit Designations', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(20, 'delete_designations', 'Delete Designations', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(21, 'view_designation_items', 'View Designation Items', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(22, 'create_designation_items', 'Create Designation Items', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(23, 'edit_designation_items', 'Edit Designation Items', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(24, 'delete_designation_items', 'Delete Designation Items', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(25, 'view_documents', 'View Documents', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(26, 'create_documents', 'Create Documents', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(27, 'edit_documents', 'Edit Documents', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(28, 'delete_documents', 'Delete Documents', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(29, 'view_document_types', 'View Document Types', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(30, 'create_document_types', 'Create Document Types', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(31, 'edit_document_types', 'Edit Document Types', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(32, 'delete_document_types', 'Delete Document Types', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(33, 'view_events', 'View Events', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(34, 'create_events', 'Create Events', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(35, 'edit_events', 'Edit Events', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(36, 'delete_events', 'Delete Events', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(37, 'view_expenses', 'View Expenses', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(38, 'create_expenses', 'Create Expenses', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(39, 'edit_expenses', 'Edit Expenses', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(40, 'delete_expenses', 'Delete Expenses', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(41, 'view_holidays', 'View Holidays', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(42, 'create_holidays', 'Create Holidays', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(43, 'edit_holidays', 'Edit Holidays', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(44, 'delete_holidays', 'Delete Holidays', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(45, 'view_leaves', 'View Leaves', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(46, 'create_leaves', 'Create Leaves', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(47, 'edit_leaves', 'Edit Leaves', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(48, 'delete_leaves', 'Delete Leaves', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(49, 'process_leave', 'Process Leaves', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(50, 'view_leave_types', 'View Leave Types', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(51, 'create_leave_types', 'Create Leave Types', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(52, 'edit_leave_types', 'Edit Leave Types', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(53, 'delete_leave_types', 'Delete Leave Types', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(54, 'view_notices', 'View Notices', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(55, 'create_notices', 'Create Notices', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(56, 'edit_notices', 'Edit Notices', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(57, 'delete_notices', 'Delete Notices', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(58, 'view_users', 'View Users', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(59, 'create_users', 'Create Users', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(60, 'edit_users', 'Edit Users', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(61, 'delete_users', 'Delete Users', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(62, 'view_job_vacancies', 'View Job Vacancies', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(63, 'create_job_vacancies', 'Create Job Vacancies', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(64, 'edit_job_vacancies', 'Edit Job Vacancies', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(65, 'delete_job_vacancies', 'Delete Job Vacancies', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(66, 'view_candidates', 'View Candidates', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(67, 'create_candidates', 'Create Candidates', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(68, 'edit_candidates', 'Edit Candidates', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(69, 'delete_candidates', 'Delete Candidates', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(70, 'view_attendances', 'View Attendances', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(71, 'create_attendances', 'Create Attendances', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(72, 'edit_attendances', 'Edit Attendances', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(73, 'delete_attendances', 'Delete Attendances', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(74, 'view_cut_offs', 'View Cut Offs', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(75, 'create_cut_offs', 'Create Cut Offs', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(76, 'edit_cut_offs', 'Edit Cut Offs', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(77, 'delete_cut_offs', 'Delete Cut Offs', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(78, 'approve_travel_request', 'Approve Travel Requests', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(79, 'request_assets', 'Request Assets', 1, NULL, '2019-02-15 05:30:49', '2019-02-15 05:30:49'),
(80, 'return_assets', 'Return Assets', 1, NULL, '2019-02-15 05:31:06', '2019-02-15 05:31:06'),
(81, 'apply_loans', 'Apply Loans/Advances', 1, NULL, '2019-02-15 05:31:28', '2019-02-15 05:31:28'),
(82, 'can_approve_loans', 'Can Approve Loans/Advances', 1, NULL, '2019-02-15 05:32:04', '2019-02-15 05:32:04'),
(83, 'approve_leaves', 'Approve Leaves', 1, NULL, '2019-02-15 05:32:21', '2019-02-15 05:32:21');

-- --------------------------------------------------------

--
-- Table structure for table `question_types`
--

CREATE TABLE `question_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_value` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `question_types`
--

INSERT INTO `question_types` (`id`, `name`, `type_value`, `created_at`, `updated_at`) VALUES
(1, 'environment', 2, '2019-01-09 13:22:15', '2019-01-09 13:22:15'),
(2, 'CLEANER', 1, '2019-01-31 12:45:25', '2019-01-31 12:46:53');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `rateable_id` int(10) UNSIGNED NOT NULL,
  `rateable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recruitment_processes`
--

CREATE TABLE `recruitment_processes` (
  `id` int(10) UNSIGNED NOT NULL,
  `recruitment_type_id` int(11) NOT NULL,
  `process` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recruitment_types`
--

CREATE TABLE `recruitment_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `recruitment_types`
--

INSERT INTO `recruitment_types` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Honored ', 'Get honored', '2019-02-06 06:27:00', '2019-02-06 06:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `renew_contracts`
--

CREATE TABLE `renew_contracts` (
  `id` int(10) UNSIGNED NOT NULL,
  `renewal_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `renew_contract_user`
--

CREATE TABLE `renew_contract_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `renew_contract_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_assets`
--

CREATE TABLE `request_assets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `req_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `reject_reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `request_assets`
--

INSERT INTO `request_assets` (`id`, `user_id`, `asset_id`, `req_date`, `status`, `reject_reason`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '01/22/2019', 0, NULL, '2019-01-31 14:37:40', '2019-01-31 14:37:40');

-- --------------------------------------------------------

--
-- Table structure for table `return_assets`
--

CREATE TABLE `return_assets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `return_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `layout` tinyint(1) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `layout`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 1, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(2, 'employee', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(3, 'Team Leader/Manager', 0, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(4, 'HumanResource', 0, NULL, '2019-02-05 08:03:49', '2019-02-15 06:38:38'),
(5, 'Activate', 0, '2019-02-08 12:06:03', '2019-02-08 12:05:51', '2019-02-08 12:06:03'),
(6, 'Receptionist', 0, '2019-02-15 06:27:33', '2019-02-13 13:27:12', '2019-02-15 06:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `level` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `permission_id`, `role_id`, `level`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(2, 2, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(3, 3, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(4, 4, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(5, 5, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(6, 6, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(7, 7, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(8, 8, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(9, 9, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(10, 10, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(11, 11, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(12, 12, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(13, 13, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(14, 14, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(15, 15, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(16, 16, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(17, 17, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(18, 18, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(19, 19, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(20, 20, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(21, 21, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(22, 22, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(23, 23, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(24, 24, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(25, 25, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(26, 26, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(27, 27, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(28, 28, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(29, 29, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(30, 30, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(31, 31, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(32, 32, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(33, 33, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(34, 34, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(35, 35, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(36, 36, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(37, 37, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(38, 38, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(39, 39, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(40, 40, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(41, 41, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(42, 42, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(43, 43, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(44, 44, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(45, 45, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(46, 46, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(47, 47, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(48, 48, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(49, 49, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(50, 50, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(51, 51, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(52, 52, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(53, 53, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(54, 54, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(55, 55, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(56, 56, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(57, 57, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(58, 58, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(59, 59, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(60, 60, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(61, 61, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(62, 62, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(63, 63, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(64, 64, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(65, 65, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(66, 66, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(67, 67, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(68, 68, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(69, 69, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(70, 70, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(71, 71, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(72, 72, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(73, 73, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(74, 74, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(75, 75, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(76, 76, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(77, 77, 1, 'all', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(78, 78, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(79, 1, 2, NULL, NULL, '2019-01-09 07:10:38', '2019-02-15 06:27:20'),
(80, 5, 2, NULL, NULL, '2019-01-09 07:10:38', '2019-02-15 06:27:20'),
(81, 25, 2, NULL, NULL, '2019-01-09 07:10:38', '2019-02-15 06:27:20'),
(82, 33, 2, NULL, NULL, '2019-01-09 07:10:38', '2019-02-15 06:27:20'),
(83, 37, 2, NULL, NULL, '2019-01-09 07:10:38', '2019-02-15 06:27:20'),
(84, 41, 2, NULL, NULL, '2019-01-09 07:10:38', '2019-02-15 06:27:20'),
(85, 78, 1, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(86, 45, 2, NULL, NULL, '2019-01-09 07:10:38', '2019-02-15 06:27:20'),
(87, 46, 2, NULL, NULL, '2019-01-09 07:10:38', '2019-02-15 06:27:20'),
(88, 53, 2, NULL, '2019-02-15 06:27:20', '2019-01-09 07:10:38', '2019-02-15 06:27:20'),
(89, 61, 2, NULL, '2019-02-15 06:27:20', '2019-01-09 07:10:38', '2019-02-15 06:27:20'),
(90, 1, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(91, 2, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(92, 3, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(93, 4, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(94, 5, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(95, 6, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(96, 7, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(97, 8, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(98, 17, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(99, 18, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(100, 19, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(101, 20, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(102, 25, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(103, 26, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(104, 27, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(105, 28, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(106, 37, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(107, 38, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(108, 39, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(109, 40, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(110, 45, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(111, 46, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(112, 47, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(113, 48, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(114, 49, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(115, 58, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(116, 59, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(117, 60, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(118, 61, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(119, 70, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(120, 71, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(121, 72, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(122, 73, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(123, 74, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(124, 75, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(125, 76, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(126, 77, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(127, 61, 3, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(128, 62, 3, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(129, 63, 3, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(130, 64, 3, NULL, NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(131, 65, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(132, 66, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(133, 67, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(134, 68, 3, 'team', NULL, '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(135, 1, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(136, 5, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(137, 6, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(138, 7, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(139, 8, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(140, 9, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(141, 10, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(142, 11, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(143, 12, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(144, 13, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(145, 14, 4, NULL, '2019-02-15 06:31:13', '2019-02-05 08:03:49', '2019-02-15 06:31:13'),
(146, 15, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(147, 16, 4, NULL, '2019-02-15 06:31:13', '2019-02-05 08:03:49', '2019-02-15 06:31:13'),
(148, 17, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(149, 18, 4, NULL, '2019-02-15 06:31:13', '2019-02-05 08:03:49', '2019-02-15 06:31:13'),
(150, 19, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(151, 20, 4, NULL, '2019-02-15 06:31:13', '2019-02-05 08:03:49', '2019-02-15 06:31:13'),
(152, 21, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(153, 22, 4, NULL, '2019-02-15 06:31:13', '2019-02-05 08:03:49', '2019-02-15 06:31:13'),
(154, 23, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(155, 24, 4, NULL, '2019-02-15 06:31:13', '2019-02-05 08:03:49', '2019-02-15 06:31:13'),
(156, 25, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(157, 26, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(158, 28, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(159, 29, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(160, 30, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(161, 32, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(162, 33, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(163, 34, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(164, 35, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(165, 36, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(166, 37, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(167, 38, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(168, 39, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(169, 40, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(170, 41, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(171, 42, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(172, 43, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(173, 44, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(174, 45, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(175, 46, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(176, 47, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(177, 48, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(178, 49, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(179, 50, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(180, 51, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(181, 52, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(182, 53, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(183, 54, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(184, 55, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(185, 56, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(186, 57, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(187, 58, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(188, 60, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(189, 62, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(190, 63, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(191, 64, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(192, 65, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(193, 66, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(194, 67, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(195, 68, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(196, 69, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(197, 70, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(198, 73, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(199, 74, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(200, 75, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(201, 77, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(202, 78, 4, NULL, NULL, '2019-02-05 08:03:49', '2019-02-18 05:36:23'),
(203, 25, 6, NULL, NULL, '2019-02-13 13:27:12', '2019-02-13 13:27:12'),
(204, 33, 6, NULL, NULL, '2019-02-13 13:27:12', '2019-02-13 13:27:12'),
(205, 46, 6, NULL, NULL, '2019-02-13 13:27:12', '2019-02-13 13:27:12'),
(206, 54, 6, NULL, NULL, '2019-02-13 13:27:12', '2019-02-13 13:27:12'),
(207, 13, 2, NULL, NULL, '2019-02-15 06:27:20', '2019-02-15 06:27:20'),
(208, 17, 2, NULL, NULL, '2019-02-15 06:27:20', '2019-02-15 06:27:20'),
(209, 26, 2, NULL, NULL, '2019-02-15 06:27:20', '2019-02-15 06:27:20'),
(210, 50, 2, NULL, NULL, '2019-02-15 06:27:20', '2019-02-15 06:27:20'),
(211, 54, 2, NULL, NULL, '2019-02-15 06:27:20', '2019-02-15 06:27:20'),
(212, 79, 2, NULL, NULL, '2019-02-15 06:27:20', '2019-02-15 06:27:20'),
(213, 80, 2, NULL, NULL, '2019-02-15 06:27:20', '2019-02-15 06:27:20'),
(214, 79, 4, NULL, NULL, '2019-02-15 06:31:13', '2019-02-18 05:36:23'),
(215, 80, 4, NULL, NULL, '2019-02-15 06:31:13', '2019-02-18 05:36:23'),
(216, 81, 4, NULL, NULL, '2019-02-15 06:31:13', '2019-02-18 05:36:23'),
(217, 82, 4, NULL, NULL, '2019-02-15 06:31:13', '2019-02-18 05:36:23'),
(218, 83, 4, NULL, NULL, '2019-02-15 06:31:13', '2019-02-18 05:36:23'),
(219, 27, 4, NULL, NULL, '2019-02-18 05:36:23', '2019-02-18 05:36:23'),
(220, 31, 4, NULL, NULL, '2019-02-18 05:36:23', '2019-02-18 05:36:23'),
(221, 71, 4, NULL, NULL, '2019-02-18 05:36:23', '2019-02-18 05:36:23'),
(222, 72, 4, NULL, NULL, '2019-02-18 05:36:23', '2019-02-18 05:36:23'),
(223, 76, 4, NULL, NULL, '2019-02-18 05:36:23', '2019-02-18 05:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `sub_departments`
--

CREATE TABLE `sub_departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_departments`
--

INSERT INTO `sub_departments` (`id`, `name`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'Network Admin Office', 6, '2019-01-09 11:57:34', '2019-02-05 07:19:04'),
(2, 'System Admin Office', 6, '2019-02-05 07:19:48', '2019-02-05 07:19:48'),
(3, 'IT Admin', 6, '2019-02-05 07:20:40', '2019-02-05 07:20:40'),
(4, 'Technical Support', 6, '2019-02-05 07:21:19', '2019-02-05 07:21:19'),
(5, 'Data Management', 6, '2019-02-05 07:21:43', '2019-02-05 07:21:43');

-- --------------------------------------------------------

--
-- Table structure for table `termination_issues`
--

CREATE TABLE `termination_issues` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `termination_letters`
--

CREATE TABLE `termination_letters` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE `trainings` (
  `id` int(10) UNSIGNED NOT NULL,
  `training_type_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `training_types`
--

CREATE TABLE `training_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `travel_modes`
--

CREATE TABLE `travel_modes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `travel_modes`
--

INSERT INTO `travel_modes` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Public', 'Public transport', '2019-01-09 07:10:38', '2019-01-09 07:10:38'),
(2, 'Business visit', 'Visiting our customers', '2019-01-09 13:20:36', '2019-01-09 13:20:36'),
(3, 'PROMOTION ', 'PROMOTION ', '2019-01-31 12:42:26', '2019-01-31 12:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `travel_perdiems`
--

CREATE TABLE `travel_perdiems` (
  `id` int(10) UNSIGNED NOT NULL,
  `department_id` int(11) NOT NULL,
  `travel_mode_id` int(11) NOT NULL,
  `from_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `to_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fare` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `travel_perdiems`
--

INSERT INTO `travel_perdiems` (`id`, `department_id`, `travel_mode_id`, `from_location`, `to_location`, `fare`, `created_at`, `updated_at`) VALUES
(2, 3, 2, '1/05/2019', '5/01/2019', '23445', '2019-01-31 12:41:03', '2019-01-31 12:41:03'),
(3, 6, 1, '02/27/2019', '03/28/2019', '16000', '2019-01-31 12:41:46', '2019-01-31 12:41:46');

-- --------------------------------------------------------

--
-- Table structure for table `travel_requests`
--

CREATE TABLE `travel_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `travel_perdiem_id` int(11) NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `applied_on` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cellphone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `local_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permanent_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `employee_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL,
  `blood_group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `allergies` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `doctor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `family_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emergency_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `clinic_tel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prescription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `disabled` enum('NO','YES') COLLATE utf8_unicode_ci NOT NULL,
  `designation_item_id` int(11) NOT NULL,
  `date_hired` date DEFAULT NULL,
  `exit_date` date DEFAULT NULL,
  `salary` decimal(10,2) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `profile_picture` text COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `password_confirmation` int(11) DEFAULT NULL,
  `id_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kra_pin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `personal_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nhif_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nssf_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nssf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `birthday`, `gender`, `email`, `telephone`, `cellphone`, `local_address`, `permanent_address`, `employee_id`, `department_id`, `blood_group`, `allergies`, `doctor`, `family_contact`, `emergency_contact`, `clinic_tel`, `prescription`, `disabled`, `designation_item_id`, `date_hired`, `exit_date`, `salary`, `role_id`, `username`, `password`, `profile_picture`, `remember_token`, `deleted_at`, `created_at`, `updated_at`, `password_confirmation`, `id_no`, `kra_pin`, `personal_email`, `nhif_no`, `nssf_no`, `nssf`) VALUES
(1, 'Module', 'Administrator', '1977-09-09', 'M', 'admin@cloudhr.biz', '0796332555', '0796332555', 'Nyansiongo', 'Nyansiongo', '0000', 6, '', '', '', '0796332555', '', '', '', 'NO', 16, '1971-09-06', NULL, '0.00', 1, 'administrator', '$2y$10$YE0z6fMl96wnSgzQPwiohuoqahfEQWAvThi52zHjW6ugXmFao7i6O', '', 'J5wAub8uYij2zitKm8lrRsVSSzepFkoYiDjhuNRJqAN4fmeMbn0ZuYD2W2cz', NULL, '2019-01-09 07:10:38', '2019-03-05 11:42:18', 0, '1234567', '', NULL, '', NULL, ''),
(2, 'Anne', 'Mararo', '2019-02-06', 'F', 'shure@gmail.com', '0796332555', '0712458796', 'nyansiongo', 'kisii', '001', 11, 'O+', 'none', 'none', '0712458796', '0712458796', 'none', 'not any', 'NO', 12, '2018-12-30', NULL, '150000.00', 4, 'zippy8080', '$2y$10$ebQ4EfitYfm4FBRtKmPUFuAo7SYqrcFkSUGEpQIhlJVKhNdlOs4CO', '', NULL, NULL, '2019-01-09 12:22:32', '2019-02-22 09:40:20', 0, '22241295', 'A003329351W', NULL, '2291364', NULL, '967211816'),
(3, 'Highlandcf', 'hr', '2007-06-27', 'F', 'highlandcfhr@gmail.com', '0719414014', '0719414014', '', '', '000', 11, '', '', '', 'highlandcfhr@gmail.com', '0719414014', '', '', 'NO', 12, '2018-12-30', NULL, '0.00', 1, 'highlandcfhr@gmail.c', '$2y$10$uAP5tqoUvfdrVuEsMpcrfeNnh7P7edOuoBStG1VNlkgglalvavqDa', '', 'HAldaLD12iVta2FJd5cYgQirUX6sav5vIbR5AYl8SbSjTMx28wXknvPOcfe0', NULL, '2019-01-31 08:26:14', '2019-04-01 11:45:02', 0, '', '', NULL, '', NULL, ''),
(4, 'Mweresa', 'Basweti Diana', '2019-01-15', 'F', 'vinn@vinn.com', '03243534534', '0234234345', '', 'box 32', '003', 11, '', '', '', '234234123323', '', '', '', 'NO', 12, '2019-01-22', '2019-01-31', '32100.00', 2, 'junior', '$2y$10$uvt7lMBNuvOF8uA5.qZUZeRPeyJmwOSQ6Oe5C36zPwwHugOJD1AIu', '', NULL, NULL, '2019-01-31 14:00:58', '2019-02-25 13:04:18', 0, '30506894', '', NULL, '7651505', NULL, '2021393585'),
(5, 'Ramkrishna', 'Jalala ', '1960-01-28', 'M', 'rkjalala@gmail.com', '0722968602', '', '', '', '005', 8, '', '', '', '', '0722968602', '', '', 'NO', 23, '2018-09-07', NULL, '25000.00', 2, 'rkjalala@gmail.com', '$2y$10$g9Z72OGfezKX4BbH5l4gV.GR/H6Dkup93fH1CGQGumRmy4vD8QdXm', '', NULL, NULL, '2019-02-05 08:17:43', '2019-02-25 06:59:30', 0, '31808914', 'A002848990U', NULL, '1754773', NULL, '828545626'),
(6, 'Allan', 'Indeche', '1966-07-11', 'M', 'allanindeche@gmail.com', '0722286984', '', '', '', '016', 12, '', '', '', '', '0722286984', '', '', 'NO', 32, '2017-05-30', NULL, '20000.00', 2, 'allanindeche@gmail.c', '$2y$10$O03zePPaWzj264w8EbogXe8LcmpzuL2tM.4FvO7GBzlimW0Nx9mo.', '', 'LVdrwD2zR9bgZ2MxOS8mSol0DsWOzDN8ds9XZxPVootCAPZz2rFSEROZeoKx', NULL, '2019-02-08 11:30:40', '2019-02-22 09:52:12', 0, '9915841', 'A001493373V', NULL, '1040212', NULL, '043622917'),
(7, 'Phulen', 'Lianzika', '2019-02-02', 'F', 'phulenlianzika@gmail.com', '0706381302', '', '', '', '004', 11, '', '', '', '', '0706381302', '', '', 'NO', 12, '2019-02-24', NULL, '25000.00', 2, 'phulenlianzika@gmail', '$2y$10$Fw9CVI5XHgXrPM3tpo2qAuvVgPHrJF1KyyXjJXHWEjyCF7eR/G0rS', '', NULL, NULL, '2019-02-13 13:17:44', '2019-02-22 09:44:12', 0, '30333450', 'A008600724M', NULL, 'R7620970', NULL, '2021203985'),
(8, 'Ernest', 'Wangatia', '2019-01-28', 'M', 'wangatiae@gmail.com', '0720332978', '', '', '', '006', 8, '', '', '', '', '0720332978', '', '', 'NO', 22, '2018-09-03', NULL, '25000.00', 2, 'wangatiae@gmail.com', '$2y$10$FYDwHddpxJidddOG0zaAleA9HyD72cB2vHjZ/JOgWMrr3GAMWbJ5q', '', NULL, NULL, '2019-02-14 07:29:23', '2019-02-22 09:45:21', 0, '2239140', 'A004059195E', NULL, '1903158', NULL, '659671921'),
(9, 'Francis', 'Musembi', '2019-02-05', 'M', 'francisngui711@gmail.com', '0726258752', '', '', '', '007', 8, '', '', '', '', '0726258752', '', '', 'NO', 24, '2018-04-02', NULL, '25000.00', 2, 'francisngui711@gmail', '$2y$10$GxjO.QqYUkkH4nkEn01A5OUlPJiQiactNPLgY8RXdiR5lJeD0imAu', '', NULL, NULL, '2019-02-14 07:39:42', '2019-02-22 09:48:08', 0, '10681814', 'A006888377Z', NULL, '7095733', NULL, '2011477206'),
(10, 'Davis', 'Kuloba Wafula', '2019-02-04', 'M', 'dkuloba@yahoo.com', '0726535177', '', '', '', '008', 8, '', '', '', '', '0726535177', '', '', 'NO', 25, '2018-11-06', NULL, '25000.00', 2, 'dkuloba@yahoo.com', '$2y$10$Z4qzL4bwR.FXRPlWYVWYQeEq9qn3dOLQ2hAeb4DmdIgPhe/HHmsn6', '', NULL, NULL, '2019-02-14 07:47:40', '2019-02-28 11:26:30', 0, '24394434', 'A005512012Y', NULL, 'R87622', NULL, '362497915'),
(11, 'Thomas', 'Siko', '2019-02-04', 'M', 'thomassiko62@gmail.com', '0729696966', '', '', '', '009', 8, '', '', '', '', '0729696966', '', '', 'NO', 26, '2018-12-04', NULL, '25000.00', 2, 'thomassiko62@gmail.c', '$2y$10$zYWx8m0uL5r1FfdQDXAc0uSRQjpPkJRXOLTcLnCaD/KZYBpV3qlAq', '', NULL, NULL, '2019-02-14 07:56:31', '2019-02-22 09:49:06', 0, '25299450', 'A009216584E', NULL, '4953292', NULL, '898258928'),
(12, 'Jackson', 'Kibet', '2019-02-04', 'M', 'kosgeyjackson@gmail.com', '0727542002', '', '', '', '010', 8, '', '', '', '', '0727542002', '', '', 'NO', 26, '2018-12-03', NULL, '25000.00', 2, 'kosgeyjackson@gmail.', '$2y$10$XZJH6A9dwD4Z.9zUBPbNJu0K1xGvKTpbXlEYpPOUaTE3HoFkbhtK6', '', NULL, NULL, '2019-02-14 08:00:29', '2019-02-20 12:56:09', 0, '32399338', '', NULL, '8551265', NULL, ''),
(13, 'Moraa', 'Ongombe Eddah', '2019-02-04', 'F', 'eddah@gmail.com', '0789564235', '', '', '', '011', 8, '', '', '', '', '0789564235', '', '', 'NO', 26, '2018-07-17', '2018-08-13', '25000.00', 2, 'eddah@gmail.com', '$2y$10$CsEezMS97ZN8c0NTlyeujORlVsfbCYVeXFAQszc8.b/FQFCvAz0UG', '', NULL, NULL, '2019-02-14 08:06:01', '2019-02-25 13:02:28', 0, '26209238', 'A005359457I', NULL, '2773254', NULL, '171196821'),
(14, 'Mary', 'Kisanya', '2019-02-03', 'F', 'maryk@gmail.com', '0756987521', '', '', '', '012', 8, '', '', '', '', '0756987521', '', '', 'NO', 26, '2019-02-04', NULL, '0.00', 2, 'maryk@gmail.com', '$2y$10$iY7yf9nnxQyEEuAC5YYAT.LniLsY/A88JnQForLm1WsA6KRo9h43K', '', NULL, NULL, '2019-02-14 08:09:31', '2019-02-22 09:50:12', 0, '28623589', 'A010122495I', NULL, '5068785', NULL, '2016089816'),
(15, 'Lilian', 'Omwenga', '2019-02-04', 'F', 'lomwenga@gmail.com', '0756984562', '', '', '', '013', 8, '', '', '', '', '0756984562', '', '', 'NO', 26, '2018-07-03', NULL, '25000.00', 2, 'lomwenga@gmail.com', '$2y$10$BmECnuCvApOE1bCgfaALwOfV..jQwii8TwdefK6J5nOoWFVgcWkk6', '', NULL, NULL, '2019-02-14 08:12:10', '2019-02-22 09:50:35', 0, '27991839', 'A005509566L', NULL, '7257364', NULL, '2017367382'),
(16, 'Juma', 'Wilfred Mariera', '2019-02-04', 'M', 'juma.highland@gmail.com', '0790346024', '', '', '', '014', 8, '', '', '', '', '0790346024', '', '', 'NO', 27, '2018-11-05', NULL, '34500.00', 2, 'juma.highland@gmail.', '$2y$10$NUl2.o1RKDx3M8SH0HAhtuYjSGHolnQ1D6H4Q/CsLoQf4n8n6JEaK', '', NULL, NULL, '2019-02-14 08:14:20', '2019-02-25 12:58:35', 0, '33445301', 'A010140294D', NULL, '6377769', NULL, '00658340'),
(17, 'Edwin', 'Mokaya', '2019-02-04', 'M', 'edwinmokaya2016@gmail.com', '0718632724', '', '', '', '015', 8, '', '', '', '', '0718632724', '', '', 'NO', 27, '2018-10-09', NULL, '34500.00', 2, 'edwinmokaya2016@gmai', '$2y$10$k3sucKPm9f67fAFqq6YZX.DL1xnsV1y5Y/pfLh.Q/ypGNTnQwIXP2', '', NULL, NULL, '2019-02-14 08:19:29', '2019-02-22 09:51:21', 0, '29188224', 'A008765388U', NULL, '7103492', NULL, '2016350952'),
(18, 'Isaac', 'Cheruiyot Bor', '1983-03-23', 'M', 'isaacbor80@gmail.com', '0720694470', '', '', '', '017', 12, '', '', '', '', '0720694470', '', '', 'NO', 29, '2018-07-02', NULL, '34500.00', 2, 'isaacbor80@gmail.com', '$2y$10$zM2IAnuk4qriyWt5Onm8jew6HRznQFSS6Q6bn.8xV/UclpA2AmKa.', '', NULL, NULL, '2019-02-14 08:27:55', '2019-02-25 12:53:26', 0, '22358660', 'A006263363R', NULL, '3357415', NULL, '41972091'),
(19, 'Gideon', 'Mutuku Mue', '1979-02-14', 'M', 'gideon@gmail.com', '0729878922', '', '', '', '018', 13, '', '', '', '', '0729878922', '', '', 'NO', 28, '2019-01-04', NULL, '34500.00', 2, 'gideon@gmail.com', '$2y$10$9BDzeSr3yfL7N.Yr1XqYrOZtiW2T/9.r3QBjl7IMvkILTqqnnaVc2', '', NULL, NULL, '2019-02-14 09:36:41', '2019-03-22 09:48:37', 0, '10969125', 'A001180078H', NULL, '396224', NULL, '022738/91'),
(20, 'Saladin', 'Bidu Galgalo', '2018-11-02', 'M', 'saladin@yopmail.com', '0701119953', '', '', '', '019', 13, '', '', '', '', '0701119953', '', '', 'NO', 31, '2019-02-06', NULL, '17000.00', 2, 'saladin@yopmail.com', '$2y$10$L5SPrDFErq0KvH1huIMLJeU9zOfEyx8BGpKGFdbCUlazIDGO/aZom', '', NULL, NULL, '2019-02-14 09:43:21', '2019-03-22 09:49:51', 0, '27539583', 'A012389685N', NULL, '6955525', NULL, '201577764'),
(21, 'Dennis', 'Ndegwa Maina', '2018-06-02', 'M', 'dennis@gmail.com', '0796332888', '', '', '', '020', 6, '', '', '', '', '0796332888', '', '', 'NO', 16, '2018-06-04', NULL, '36500.00', 2, 'dennis@gmail.com', '$2y$10$GYDJWvUK3WazU9RabknBCOimoiExzc..rO34i93YbkipNGevmUsD.', '', NULL, NULL, '2019-02-14 09:48:04', '2019-02-25 13:05:10', 0, '27532815', 'A005976921J', NULL, '4562289', NULL, '2001736135'),
(22, 'Robert', 'Moguku Onduso', '2018-12-04', 'M', 'robertonduso77@gmail.com', '0704843788', '', '', '', '021', 6, '', '', '', '', '0704843788', '', '', 'NO', 14, '2018-01-10', NULL, '25000.00', 2, 'robertonduso77@gmail', '$2y$10$IN0aP//D4hm4NosOejeBEO0k0cMKiVqsqFy5si.GFAfnTL6Q1cpEG', '', NULL, NULL, '2019-02-14 09:53:20', '2019-02-25 13:41:02', 0, '32342196', 'A009842412P', NULL, '7049377', NULL, '2016631022'),
(23, 'Anderson', 'Ambwere Obote', '1990-02-15', 'M', 'ambwereanders@gmail.com', '0725977953', '', '', '', '022', 6, '', '', '', '', '0725977953', '', '', 'NO', 13, '2018-12-03', NULL, '25000.00', 2, 'ambwereanders@gmail.', '$2y$10$ucwPum1.gPS/LKNC/ZIzVOrCxjHzBUg2r5fF5HlZqaYcutACEfbUC', '', NULL, NULL, '2019-02-14 10:03:47', '2019-02-25 13:40:38', 0, '25902976', 'A005477744E', NULL, '6816436', NULL, '200245468'),
(24, 'Zipporah', 'Kwamboka Ondari', '2019-02-05', 'F', 'zippyondari91@gmail.com', '0729850079', '', '', '', '002', 11, '', '', '', '', '0729850079', '', '', 'NO', 12, '2018-08-07', NULL, '20000.00', 2, 'zippyondari91@gmail.', '$2y$10$R7Ud7MIwKKc.Oesnjj6G7eK7.y7UqjjSXUNlCSqVZyiWB/gxyepne', '', NULL, NULL, '2019-02-14 14:13:35', '2019-02-25 13:40:11', 0, '28469474', 'A006265985J', NULL, '4210093', NULL, '523025823'),
(25, 'Joshua', 'Oloipera Tajewuo', '2019-02-04', 'M', 'joshua.tajewuo@gmail.com', '0726006269', '', '', '', '023', 14, '', '', '', '', '0726006269', '', '', 'NO', 32, '2019-01-06', NULL, '25000.00', 2, 'joshua.tajewuo@gmail', '$2y$10$gYkpA5tnVqtmFVseV4Hf2evaOCq6Tt6oFz.otGVUS0CZyc/sMr7xS', '', '5Af1xkImViHaLa26ftrZpigsPieeWbzx3vKYAc9W2mEkucBvhgYbVaBLeHrS', NULL, '2019-02-15 07:08:05', '2019-02-25 12:54:25', 0, '25261152', 'A005609197Q', NULL, '2909765', NULL, '401465918'),
(26, 'Caroline', 'Chepngetich', '2019-02-04', 'F', 'chepngetichcaro2013@gmail.com', '0710612744', '', '', '', '024', 14, '', '', '', '', '0710612744', '', '', 'NO', 33, '2018-09-04', NULL, '20000.00', 2, 'chepngetichcaro2013@', '$2y$10$HuBP4N/If.Jm2YDOqq.np.bPMfuw3qempJKOQ6qbDdCpe3xJXctiq', '', NULL, NULL, '2019-02-15 07:14:12', '2019-02-22 09:56:20', 0, '27865952', 'A007820792F', NULL, '4658068', NULL, '2001736073'),
(27, 'Stella', 'Nchore', '2019-02-04', 'F', 'stellahnchore84@gmail.com', '0720507035', '', '', '', '025', 14, '', '', '', '', '0720507035', '', '', 'NO', 33, '2018-11-19', NULL, '34500.00', 2, 'stellahnchore84@gmai', '$2y$10$.Y6YtS9lo.V/u6YdNkMIKeLQegV.mHiSxMEl8RkwADxc876au.5VS', '', NULL, NULL, '2019-02-15 07:17:16', '2019-02-22 09:56:46', 0, '23700743', 'A005143784S', NULL, '3127804', NULL, '25991682'),
(28, 'Denish', 'Muga Okoth', '2019-02-04', 'M', 'denish@gmail.com', '0756985874', '', '', '', '026', 14, '', '', '', '', '0756985874', '', '', 'NO', 33, '2018-07-10', NULL, '25000.00', 2, 'denish@gmail.com', '$2y$10$Vy0Fc30LRl.QTK.Sl7ilxejMPfY0lXx8LIBnQBT1RdryxCdPlWnQi', '', NULL, NULL, '2019-02-15 07:19:44', '2019-02-25 12:55:19', 0, '30134410', 'A010117945M', NULL, '6361487', NULL, '2012784248'),
(29, 'Haron', 'Magati Omwenga', '2019-02-04', 'M', 'haronmagati85@gmail.com', '0701415126', '', '', '', '027', 14, '', '', '', '', '0701415126', '', '', 'NO', 33, '2018-12-03', NULL, '20000.00', 2, 'haronmagati85@gmail.', '$2y$10$QrW5uNin1vHsBcSAnbK99.Sbc87hypTGNBIeMZTYazI5ZPbZxfa4u', '', NULL, NULL, '2019-02-15 07:33:07', '2019-02-25 12:55:53', 0, '32633171', 'A011239224M', NULL, '7313388', NULL, '2017668896'),
(30, 'Dickson', 'Ouru Kombo', '2019-02-04', 'M', 'dickson@gmail.com', '0718965470', '', '', '', '028', 14, '', '', '', '', '0718965470', '', '', 'NO', 33, '2018-11-06', NULL, '20000.00', 2, 'dickson@gmail.com', '$2y$10$NhxzzaOugYZt5VYt3LbXZuLOIXvdc5JKv/LVFxtX.u9YXQ8H43CZ.', '', NULL, NULL, '2019-02-15 07:36:18', '2019-02-25 12:56:33', 0, '28896079', 'A007219242T', NULL, '3252156', NULL, '52143291'),
(31, 'Benard', 'Cheruiyot Terer', '2019-02-04', 'M', 'benard@gmail.com', '0769583241', '', '', '', '029', 14, '', '', '', '', '0769583241', '', '', 'NO', 33, '2018-11-05', NULL, '20000.00', 2, 'benard@gmail.com', '$2y$10$Dk6rIGYRpgzDsjRLDy.Jc.HLd0MqLP88HHWt9wea6BD2wCBH0zh.e', '', NULL, NULL, '2019-02-15 07:42:32', '2019-02-25 12:57:35', 0, '20161876', 'A010191573F', NULL, '3498596', NULL, '152757937'),
(32, 'Timothy', 'Obare', '2019-02-04', 'M', 'timothymosigisi1971@gmail.com', '0728462933', '', '', '', '030', 14, '', '', '', '', '0728462933', '', '', 'NO', 33, '2018-09-10', NULL, '20000.00', 2, 'timothymosigisi1971@', '$2y$10$Kdcz9X9sPvCl.7xMB0W/7ec8JVoujg/HxcwBP4aVcbVOduccTzA3i', '', NULL, NULL, '2019-02-15 08:10:53', '2019-02-22 09:58:54', 0, '11112021', 'A002629895U', NULL, 'R1189816', NULL, '383771927'),
(33, 'Robert', 'Gekonge', '2018-11-04', 'M', 'robert@gmail.com', '0714192036', '', '', '', '031', 14, '', '', '', '', '0714192036', '', '', 'NO', 33, '2018-10-07', NULL, '34500.00', 2, 'robert@gmail.com', '$2y$10$oCrrso90xZoYojv8det0tOO5lZ/UR17Ykh1Yo0LZdFMmN8Tjktbwy', '', NULL, NULL, '2019-02-15 08:19:54', '2019-02-22 09:59:20', 0, '27766920', 'A007887509M', NULL, '2889232', NULL, '86457892X'),
(34, 'William', 'Ochieng Outa', '2018-10-08', 'M', 'outawilly@gmail.com', '0716111120', '', '', '', '032', 15, '', '', '', '', '0716111120', '', '', 'NO', 34, '2018-11-05', NULL, '25000.00', 2, 'outawilly@gmail.com', '$2y$10$9WgFVWOdnnq5B9L9O.5q4.dy3WtcWPVXVbjtiZ3Z4yJBkqOkECQTS', '', NULL, NULL, '2019-02-15 08:23:31', '2019-02-25 13:24:23', 0, '28371177', 'A005654860D', NULL, '5474670', NULL, '554536919'),
(35, 'Enock', 'Moranga Ndege', '2019-02-04', 'M', 'enock.moranga@yahoo.com', '0711909913', '', '', '', '033', 15, '', '', '', '', '0711909913', '', '', 'NO', 30, '2018-11-06', NULL, '25000.00', 2, 'enock.moranga@yahoo.', '$2y$10$DqJAY03A1wbdTvSV.D5cFObW3WnxWAaAvvG.y8oUciV5MnBCCyi2.', '', NULL, NULL, '2019-02-15 08:27:12', '2019-02-25 13:26:04', 0, '32072837', 'A007565580J', NULL, '7416203', NULL, '0086238'),
(36, 'Nathaniel', 'Njoroge Gichure', '2018-12-02', 'M', 'nathanielgichure3@gmail.com', '0723576161', '', '', '', '034', 15, '', '', '', '', '0723576161', '', '', 'NO', 30, '2018-11-26', NULL, '34500.00', 2, 'nathanielgichure3@gm', '$2y$10$qaXmO3zSeEnjOIAAuS688.y/1sie8p7Hd4UaeXs09lnoUqlvI4/mK', '', NULL, NULL, '2019-02-15 08:32:42', '2019-02-25 13:26:58', 0, '25214872', 'A004645889S', NULL, '3979928', NULL, '90913491'),
(37, 'Pauline', 'Omuga', '2019-02-04', 'M', 'omugapauline93@gmail.com', '0708008868', '', '', '', '035', 15, '', '', '', '', '0708008868', '', '', 'NO', 6, '2018-11-05', NULL, '25000.00', 2, 'omugapauline93@gmail', '$2y$10$COXn70bDKh4Pd5v2YNw3k.ohW7/2zNWwa1oG2pfnX66X828HztBy.', '', NULL, NULL, '2019-02-15 08:54:12', '2019-02-22 10:00:56', 0, '29931852', 'A006900124K', NULL, '7648169', NULL, '2021389386'),
(38, 'Thomas', 'Mutuku', '2019-02-04', 'M', 'thomasmutuku632@gmail.com', '0723092246', '', '', '', '036', 7, '', '', '', '', '0723092246', '', '', 'NO', 36, '2017-02-14', NULL, '34500.00', 2, 'thomasmutuku632@gmai', '$2y$10$9r3cBY2AGdMKi7ev17MvUuDLNuTVnBvU48GvMWJTMfPAI8y7pLpy.', '', NULL, NULL, '2019-02-15 08:56:33', '2019-02-22 10:01:20', 0, '9264662', 'A001307057R', NULL, '1841778', NULL, '017037'),
(39, 'Mercy', 'Mukami', '2019-02-04', 'M', 'njeru.m.mukami@gmail.com', '0723641840', '', '', '', '037', 7, '', '', '', '', '0723641840', '', '', 'NO', 31, '2018-07-10', NULL, '25000.00', 2, 'njeru.m.mukami@gmail', '$2y$10$mWqLXVFY1zUBwprPHxED.uCSer78G2lOvFh5IRPNOXiLbuP.Btare', '', NULL, NULL, '2019-02-15 09:09:17', '2019-02-22 10:01:43', 0, '24391050', 'A004491233G', NULL, '4349214', NULL, '999397818'),
(40, 'Douglas', 'Ombongi James', '2019-02-04', 'M', 'jamesdouglas2030@gmail.com', '0724635877', '', '', '', '039', 7, '', '', '', '', '0724635877', '', '', 'NO', 40, '2018-10-08', NULL, '25000.00', 2, 'jamesdouglas2030@gma', '$2y$10$aQi5FuGr7Umx3OhHjZNYcuEYi/qDeWSZLZg80.JYm6SZWr8sLIUwC', '', NULL, NULL, '2019-02-15 10:11:42', '2019-02-25 13:23:29', 0, '27194267', 'A007073219F', NULL, '4299173', NULL, '292364911'),
(41, 'Bonfance', 'Simi', '2019-02-04', 'M', 'simi@gmail.com', '0707567849', '', '', '', '040', 7, '', '', '', '', '0707567849', '', '', 'NO', 40, '2018-05-08', NULL, '20000.00', 2, 'simi@gmail.com', '$2y$10$Xy2PMd9q1Nlm04eBpLzlje8pJ.IkJlIs/I0.Wx/Eg3oXojTYRgkiO', '', NULL, NULL, '2019-02-15 10:16:52', '2019-03-22 10:57:03', 0, '29506841', 'A006777632I', NULL, '5844708', NULL, '200879821'),
(42, 'Wilbert', 'Mangera', '2019-02-04', 'M', 'wilbertmangera@yahoo.com', '0725539435', '', '', '', '041', 7, '', '', '', '', '0725539435', '', '', 'NO', 40, '2018-09-11', NULL, '20000.00', 2, 'wilbertmangera@yahoo', '$2y$10$U0Rvf5vVc8Jdja/.pDDE5uW5guyfs/bz9vu9PBfTvIozrW2l5bsaC', '', NULL, NULL, '2019-02-15 12:07:24', '2019-02-22 10:05:03', 0, '22242138', 'A002736323U', NULL, 'P0961928', NULL, '413815927'),
(43, 'Justus', 'Muli Maithya', '2019-02-04', 'M', 'justmuli136@gmail.com', '0701309013', '', '', '', '042', 7, '', '', '', '', '0701309013', '', '', 'NO', 40, '2018-09-10', NULL, '25000.00', 2, 'justmuli136@gmail.co', '$2y$10$WY4EDYN2COatT4Vzh4LX.uXV3bMu.rinb.1jjDujBSwAPYtBzzBbu', '', NULL, NULL, '2019-02-17 09:37:25', '2019-03-22 10:57:46', 0, '27673790', 'A008026868D', NULL, '5143471', NULL, '2002482539'),
(44, 'Urbunus', 'Ndeto Ngui', '2018-11-07', 'M', 'ndetourbanus3@gmail.com', '0725091637', '', '', '', '043', 9, '', '', '', '', '0725091637', '', '', 'NO', 37, '2018-06-12', NULL, '34500.00', 2, 'ndetourbanus3@gmail.', '$2y$10$64ezx5K5L32sKHYeq8qMdeWNy9P56y2hNiUQU09.yt/n2dQIGmqsG', '', NULL, NULL, '2019-02-17 09:40:13', '2019-02-25 13:18:26', 0, '30503581', 'A004860686H', NULL, '1498134', NULL, '732730929'),
(45, 'Anthony', 'Kituku', '2018-10-08', 'M', 'KilonzoANTHONY2018@gmail.com', '0700868575', '', '', '', '044', 9, '', '', '', '', '0700868575', '', '', 'NO', 30, '2018-09-03', NULL, '20000.00', 2, 'KilonzoANTHONY2018@g', '$2y$10$ZqKcxoGOTNn5RjjOjsxDyuGhwQhSmaai78TIuwS3PM1hENDDH/vv2', '', NULL, NULL, '2019-02-17 09:44:00', '2019-02-22 10:06:33', 0, '21648840', 'A012692322M', NULL, '1599573', NULL, '131224/93'),
(46, 'Dennis', 'Odende Juma', '2018-12-03', 'M', 'dennisjuma06@gmail.com', '0728577110', '', '', '', '045', 9, '', '', '', '', '0728577110', '', '', 'NO', 19, '2018-10-08', NULL, '20000.00', 2, 'dennisjuma06@gmail.c', '$2y$10$FULaC5M6tDQmDAPe/IGoOOAXWebO/XVxhCD95x9So3AY6TV45dIIS', '', NULL, NULL, '2019-02-17 09:47:25', '2019-02-25 13:19:05', 0, '27557721', 'A008444351T', NULL, '5443947', NULL, '2006895009'),
(47, 'Esiera', 'Avity', '2019-02-04', 'M', 'avityesiera2018@gmail.com', '0723910622', '', '', '', '046', 9, '', '', '', '', '0723910622', '', '', 'NO', 25, '2018-09-10', NULL, '20000.00', 2, 'avityesiera2018@gmai', '$2y$10$thF/UBjtTXB1LLkrE6PMben729uSx02xfCqiGl2x4XIkO8AVqmZmi', '', NULL, NULL, '2019-02-17 09:49:46', '2019-02-22 10:07:20', 0, '23931320', 'A003701469U', NULL, '1985105', NULL, '778741915'),
(48, 'Wambua', 'Kalui', '2019-02-04', 'M', 'kaluiwambua@gmail.com', '0729289303', '', '', '', '047', 9, '', '', '', '', '0729289303', '', '', 'NO', 6, '2018-12-03', NULL, '20000.00', 2, 'kaluiwambua@gmail.co', '$2y$10$Z1tLOsOOnzIKjdE3mxk9Sumj7eFsne2Isl092HmmMmym/v8uk/qXe', '', NULL, NULL, '2019-02-17 09:53:49', '2019-02-22 10:07:44', 0, '4641215', 'A007462828U', NULL, '7311250', NULL, '780907914'),
(49, 'Erick', 'Ongeri Mongasia', '2019-02-04', 'M', 'erick89ongeri@gmail.com', '0712631265', '', '', '', '048', 9, '', '', '', '', '0712631265', '', '', 'NO', 35, '2018-11-13', NULL, '20000.00', 2, 'erick89ongeri@gmail.', '$2y$10$Eq35KVJQZzy2Cg00BLRkUe4blgNY./UcXCwojcUqgKuvh0Lt8u45a', '', NULL, NULL, '2019-02-17 09:56:01', '2019-02-25 13:19:53', 0, '28182816', 'A007416868J', NULL, '4109782', NULL, '819796913'),
(50, 'Obiri', 'Lameck Machora', '2019-02-04', 'M', 'lameckobiri4@gmail.com', '0719503287', '', '', '', '049', 9, '', '', '', '', '0719503287', '', '', 'NO', 51, '2018-10-15', NULL, '25000.00', 2, 'lameckobiri4@gmail.c', '$2y$10$QLHMo9/rK4xjO2pfJOcBte8JXFYTlRbQjZKNYEBhCmndVJE55qwLK', '', NULL, NULL, '2019-02-17 09:59:34', '2019-02-25 13:20:42', 0, '29296828', 'A006982501T', NULL, '4494764', NULL, '240010930'),
(51, 'Fredrick', 'Alando', '2018-11-05', 'M', 'alandofredrick@gmail.com', '0713105611', '', '', '', '050', 9, '', '', '', '', '0713105611', '', '', 'NO', 39, '2018-11-06', NULL, '34500.00', 2, 'alandofredrick@gmail', '$2y$10$yIe722UkY24cXBm7qngecuwysqXsuv9tchwrZJezd7nqhFXC9KIeC', '', NULL, NULL, '2019-02-17 10:02:11', '2019-02-22 10:09:54', 0, '24920715', 'A006834330T', NULL, '6290973', NULL, '2012417033'),
(52, 'Alex', 'Wambua', '2018-11-20', 'M', 'wambuaalex75@gmail.com', '0706407047', '', '', '', '051', 9, '', '', '', '', '0706407047', '', '', 'NO', 35, '2018-10-16', NULL, '34500.00', 2, 'wambuaalex75@gmail.c', '$2y$10$AL8jmqnp3esYeHwLarHpKe.5KsbWkxxN/l.qvO0tm2RT59HuKQlpu', '', NULL, NULL, '2019-02-17 10:04:33', '2019-02-22 10:10:30', 0, '31442222', 'A010379202L', NULL, '7311254', NULL, '2017662865'),
(53, 'Chome', 'Kazungu', '2019-02-04', 'M', 'kazunguchome2@gmail.com', '0756892450', '', '', '', '052', 10, '', '', '', '', '0756892450', '', '', 'NO', 35, '2018-07-09', NULL, '20000.00', 2, 'kazunguchome2@gmail.', '$2y$10$IKw/OgX9HRBoN38G6ttCQOj1MVN5jZqRv/8dED3vSZwK06JtY2j6m', '', NULL, NULL, '2019-02-17 15:25:21', '2019-02-22 10:11:06', 0, '29659348', 'A012662691B', NULL, '4138543', NULL, '963091913'),
(54, 'Okongo', 'Robert', '2019-02-04', 'M', 'rokongo2015@gmail.com', '0723304367', '', '', '', '053', 10, '', '', '', '', '0723304367', '', '', 'NO', 39, '2018-10-08', NULL, '34500.00', 2, 'rokongo2015@gmail.co', '$2y$10$XvCfwZPfycft6q8SH.MpG.8OQLwyGKLWXX.zhKnDWeqGgFsc6/RJa', '', NULL, NULL, '2019-02-17 15:27:14', '2019-02-22 10:11:32', 0, '13328926', 'A009377352E', NULL, '3360929', NULL, '2009353201'),
(55, 'Emmanuel', 'Wafula', '2019-02-04', 'M', 'emmanuelkip06@gmail.com', '0726967070', '', '', '', '055', 10, '', '', '', '', '0726967070', '', '', 'NO', 41, '2018-11-05', NULL, '34500.00', 2, 'emmanuelkip06@gmail.', '$2y$10$mw/fwxcUhGxv81E8EUnNROrDbFm129Tzza88JYxYR/M1U6tHGOiVa', '', NULL, NULL, '2019-02-17 15:45:25', '2019-02-22 10:14:46', 0, '27313650', 'A009014444J', NULL, '4637939', NULL, '2001578869'),
(56, 'Joseph', 'Mekenye Ochoi', '2019-02-04', 'M', 'ochoi@gmail.com', '0708934567', '', '', '', '056', 10, '', '', '', '', '0708934567', '', '', 'NO', 41, '2018-10-07', NULL, '20000.00', 2, 'ochoi@gmail.com', '$2y$10$Ix4H2ONs0POWSQxk0JGVy.0WuhD5mW8BQJUWOx/Ys8LsdA4aIEnlC', '', NULL, NULL, '2019-02-17 15:48:10', '2019-02-25 13:06:39', 0, '5846346', 'A003028213C', NULL, '1246441', NULL, '268894'),
(57, 'Omaiko', 'Mogaka', '2019-02-04', 'M', 'omaikon@yahoo.com', '0721965212', '', '', '', '057', 10, '', '', '', '', '0721965212', '', '', 'NO', 41, '2018-11-05', NULL, '20000.00', 2, 'omaikon@yahoo.com', '$2y$10$Sfl4JKIUdZHfY59blVcoZ.rc8I1NuT56s7fWRhEyk.R1CkZyFs28u', '', NULL, NULL, '2019-02-17 15:50:53', '2019-02-22 10:15:41', 0, '10154417', 'A002495119P', NULL, 'O227785', NULL, '716484919'),
(58, 'Charles', 'Matunda Okongo', '2019-02-04', 'M', 'okongocharles059@gmail.com', '0724218033', '', '', '', '058', 10, '', '', '', '', '0724218033', '', '', 'NO', 41, '2018-09-11', NULL, '20000.00', 2, 'okongocharles059@gma', '$2y$10$2../kVsOazTgkoTPXaQD0OSfzNUI6SJXv9rRXUX/2FvB4C5qD426m', '', NULL, NULL, '2019-02-17 15:53:21', '2019-02-25 13:08:59', 0, '0410650', 'A002451682P', NULL, '2543258', NULL, '961852623'),
(59, 'Omori', 'Onsongo Joshua', '2018-12-03', 'M', 'Joshua@gmail.com', '0721456890', '', '', '', '059', 10, '', '', '', '', '0721456890', '', '', 'NO', 41, '2018-11-05', NULL, '25000.00', 2, 'Joshua@gmail.com', '$2y$10$MRhZdbBSIfug.YsSodM3X.QGu.tVioaJ39vZVRDvFySkkvuID05ZO', '', NULL, NULL, '2019-02-17 15:55:53', '2019-02-25 13:10:01', 0, '28665877', 'A010058108G', NULL, '6982065', NULL, '2017598218'),
(60, 'David', 'Ndege', '2019-02-04', 'M', 'ndege@gmail.com', '0745632001', '', '', '', '060', 10, '', '', '', '', '0745632001', '', '', 'NO', 41, '2018-10-15', NULL, '34500.00', 2, 'ndege@gmail.com', '$2y$10$gI//n4tVTNMzlIbw6A5rZOv3H6QM.pxOuvImMbggEMZrZcx/dtQ2m', '', NULL, NULL, '2019-02-17 15:58:22', '2019-02-22 10:17:04', 0, '24723769', 'A012166734M', NULL, 'R8514036', NULL, '20519842'),
(61, 'Nyambati', 'Bworina Erick', '2019-02-04', 'M', 'Nyambati@gmail.com', '0790126584', '', '', '', '061', 10, '', '', '', '', '0790126584', '', '', 'NO', 41, '2018-11-11', NULL, '20000.00', 2, 'Nyambati@gmail.com', '$2y$10$r8zhkas9sNoe9hbJvG8nUeiKeCyu//3/Pd8/DJCtWjkoN18wqyM66', '', NULL, NULL, '2019-02-17 16:00:21', '2019-02-25 13:14:18', 0, '24867702', 'A011981333Z', NULL, '8009913', NULL, '2023434417'),
(62, 'Peter', 'Orora Moriyasi', '2019-02-04', 'M', 'Moriasi@gmail.com', '0741258963', '', '', '', '062', 10, '', '', '', '', '0741258963', '', '', 'NO', 41, '2018-11-04', NULL, '34500.00', 2, 'Moriasi@gmail.com', '$2y$10$J8bFAi.Ds7lPXg.d9b78.OmQ1FjPOug7wzoTDajejag4k1nHxpD2u', '', NULL, NULL, '2019-02-17 16:02:52', '2019-02-25 13:15:29', 0, '27603524', 'A010863940V', NULL, '4690400', NULL, '2016482808'),
(63, 'Jamal', 'Mohammed', '2019-02-04', 'M', 'Jamal@gmail.com', '0745896235', '', '', '', '063', 10, '', '', '', '', '0745896235', '', '', 'NO', 41, '2018-11-04', NULL, '25000.00', 2, 'Jamal@gmail.com', '$2y$10$94YJsLpIDnMdM0IjSaT3GO0MbkWaUQEVIH/qFnnRVV3sJTXv4VuhK', '', NULL, NULL, '2019-02-17 16:04:56', '2019-02-22 10:18:14', 0, '24308333', 'A012454363R', NULL, '8698047', NULL, '2024279145'),
(64, 'Onguti', 'Barongo John', '2019-02-04', 'M', 'Barongo@gmail.com', '0728593418', '', '', '', '064', 10, '', '', '', '', '0728593418', '', '', 'NO', 41, '2018-09-10', NULL, '25000.00', 2, 'Barongo@gmail.com', '$2y$10$UMb18nmDV433hqd5rnJ5peQc4I15d01S95IjDVETA9Dqz9gAsbN7K', '', NULL, NULL, '2019-02-17 16:06:57', '2019-02-25 13:16:47', 0, '26932262', 'A009341586W', NULL, '517598', NULL, '2005233143'),
(65, 'Luke', 'Kerongo Ayunga', '2019-02-04', 'M', 'Kerongo@gmail.com', '0745698210', '', '', '', '065', 10, '', '', '', '', '0745698210', '', '', 'NO', 41, '2018-10-01', NULL, '20000.00', 2, 'Kerongo@gmail.com', '$2y$10$B4o29B3qZq/4EzRb9pKxqu0XwYhD7il1QR9K/QUDwoP8nJyoyKVT6', '', NULL, NULL, '2019-02-17 16:09:29', '2019-02-25 13:25:32', 0, '20828815', 'A004444014C', NULL, '3004677', NULL, '456891919'),
(66, 'Mercury', 'Teresa', '2019-02-04', 'F', 'mactetsy@gmail.com', '0720288049', '', '', '', '066', 2, '', '', '', '', '0720288049', '', '', 'NO', 48, '2018-11-11', NULL, '25000.00', 2, 'mactetsy@gmail.com', '$2y$10$FPzspsRqxcvehUI/lwObKOa7uDhQLTwFBDRWqm2oCEvs.Hv6rasSG', '', NULL, NULL, '2019-02-17 16:13:06', '2019-02-22 10:19:28', 0, '13899709', 'A002720862T', NULL, '1222881', NULL, '433787'),
(67, 'Atieno', 'Rachael', '2019-02-04', 'F', 'Rachael@gmail.com', '0714528963', '', '', '', '067', 16, '', '', '', '', '0714528963', '', '', 'NO', 20, '2018-07-16', NULL, '34500.00', 2, 'Rachael@gmail.com', '$2y$10$kPeEV7/nSQbsBIcvNtg1juqdtxe1QGSUc./KS8tlZpxplibbRozUW', '', NULL, NULL, '2019-02-17 16:18:03', '2019-02-22 10:19:52', 0, '20909970', 'A002682042N', NULL, '1218113', NULL, '610517813'),
(68, 'Mary', 'Atieno', '2019-02-04', 'F', 'Atieno@gmail.com', '0790154870', '', '', '', '068', 16, '', '', '', '', '0790154870', '', '', 'NO', 20, '2018-10-22', NULL, '20000.00', 2, 'Atieno@gmail.com', '$2y$10$1WINysrpWQf419B1nAwnu.rITGP9qTBTM7NdkZv7SeTAMx3jZlUkK', '', NULL, NULL, '2019-02-17 16:20:22', '2019-02-22 10:20:11', 0, '27555049', 'A006033416Z', NULL, '4251232', NULL, '456022821'),
(69, 'Lydiah', 'Bonareri Ombongi', '2019-02-04', 'F', 'Lydiah@gmail.com', '0740052698', '', '', '', '069', 16, '', '', '', '', '0740052698', '', '', 'NO', 20, '2019-02-04', NULL, '25000.00', 2, 'Lydiah@gmail.com', '$2y$10$ZeCznUXdbGYXS7Cva2UuW.aODDgHFPY5riInwOHRSpIfiIndumwQi', '', NULL, NULL, '2019-02-17 16:22:58', '2019-02-25 13:27:59', 0, '21853596', 'A005646772L', NULL, '3952933', NULL, '52133182'),
(70, 'Simon', 'Nzioki', '2019-02-03', 'M', 'Nzioki@gmail.com', '0712004533', '', '', '', '070', 16, '', '', '', '', '0712004533', '', '', 'NO', 20, '2018-09-03', NULL, '20000.00', 2, 'Nzioki@gmail.com', '$2y$10$l4kzeCRtH3tdUhW7n5KKEeO2N/6VxtV0iznOsyzcvkT1CumzYRFRm', '', NULL, NULL, '2019-02-17 16:25:12', '2019-02-22 10:21:09', 0, '20302417', 'A003920883D ', NULL, '2453688', NULL, '079872'),
(71, 'Victor', 'Kinara Nyambane', '2019-02-04', 'M', 'Victor@gmail.com', '0740055580', '', '', '', '071', 16, '', '', '', '', '0740055580', '', '', 'NO', 20, '2018-11-05', NULL, '20000.00', 2, 'Victor@gmail.com', '$2y$10$/Wqt2ea2xDRqdSjNtqXwreGVe9UNqLILSIP1/oUcLMEY4zBINlcEO', '', NULL, NULL, '2019-02-17 16:27:17', '2019-02-25 13:30:16', 0, '23765211', 'A002819943K', NULL, '1363875', NULL, '140067930'),
(72, 'Otieno', 'Felix Owour', '2019-02-04', 'M', 'Otieno@gmail.com', '0712004560', '', '', '', '072', 16, '', '', '', '', '0712004560', '', '', 'NO', 20, '2018-09-02', NULL, '25000.00', 2, 'Otieno@gmail.com', '$2y$10$biRcSgaXvpHwMai/41AzfurIJyJQ3YTrcxVefMne5cJzktdtPXZnm', '', NULL, NULL, '2019-02-17 16:29:32', '2019-02-25 13:31:17', 0, '22487737', 'A003653393D', NULL, '2001695', NULL, '160608910'),
(73, 'Mutunga', 'Wilson Mutuku', '2019-02-03', 'M', 'Mutunga@gmail.com', '0745200150', '', '', '', '073', 16, '', '', '', '', '0745200150', '', '', 'NO', 20, '2018-09-03', NULL, '20000.00', 2, 'Mutunga@gmail.com', '$2y$10$vdsVxwLdzU6wXUkCcTvJG.5fiDtlOtsKV1fvjiWn0h0huWx2TVf7C', '', NULL, NULL, '2019-02-17 16:32:22', '2019-02-25 13:32:01', 0, '24184259', 'A003978312B', NULL, '5909491', NULL, '155763911'),
(74, 'Mutonga', 'Mwaura Francis', '2019-02-03', 'M', 'Mutonga@gmail.com', '0745620014', '', '', '', '074', 16, '', '', '', '', '0745620014', '', '', 'NO', 20, '2018-10-08', NULL, '25000.00', 2, 'Mutonga@gmail.com', '$2y$10$fR5CJ7MHHdDmFb0tM0lKGOBy5CWUdM8K/YIb35gqKSS7uXSIHACjK', '', NULL, NULL, '2019-02-17 16:35:01', '2019-02-25 13:33:11', 0, '30036289', 'A008984047I', NULL, '2434366', NULL, '2001225303'),
(75, 'George', 'Nyagaya', '2019-02-03', 'M', 'gnyagaya@gmail.com', '0721751742', '', '', '', '075', 16, '', '', '', '', '0721751742', '', '', 'NO', 6, '2018-10-08', NULL, '25000.00', 2, 'gnyagaya@gmail.com', '$2y$10$ddJ1/OoA91RSHTKaqned3ePA1ApsS/WB/TYAxqWmyAEh3G.h09Rbq', '', NULL, NULL, '2019-02-17 16:40:58', '2019-02-22 10:28:24', 0, '21624563', 'A003430078N', NULL, '1684833', NULL, '480789924'),
(76, 'Kennedy', 'Ochieng', '2019-02-03', 'M', 'Ochieng@gmail.com', '0740102050', '', '', '', '076', 16, '', '', '', '', '0740102050', '', '', 'NO', 20, '2018-11-05', NULL, '25000.00', 2, 'Ochieng@gmail.com', '$2y$10$T5GV95AFjaJmNkKx/liyhuvCA56JJrfJycv4l9uuXRiF8w4QzRuL6', '', NULL, NULL, '2019-02-18 09:31:55', '2019-02-22 10:30:01', 0, '26663309', 'A004860790E', NULL, '3157192', NULL, '408340916'),
(77, 'Christopher', 'Kilonzo', '2019-01-21', 'M', 'Kilonzo@gmail.com', '0740589030', '', '', '', '077', 16, '', '', '', '', '0740589030', '', '', 'NO', 20, '2018-10-22', NULL, '34500.00', 2, 'Kilonzo@gmail.com', '$2y$10$/xHAAJOX6391azc7kYgl5ODGLync3U0DAVN83JRDkMFUtKHykWF12', '', NULL, NULL, '2019-02-18 09:41:26', '2019-02-22 10:30:32', 0, '35606671', 'A010738508Y', NULL, '7211559', NULL, '2017086505'),
(78, 'Obed', 'Nyakundi', '2019-02-04', 'M', 'onchanguobed94@gmail.com', '0720938457', '', '', '', '078', 16, '', '', '', '', '0720938457', '', '', 'NO', 20, '2018-10-08', NULL, '20000.00', 2, 'onchanguobed94@gmail', '$2y$10$1.zcEBjEwnbMCCQlXUInA.inH1sVSmqnXARqChjJQylDz/qvx.1BS', '', NULL, NULL, '2019-02-18 09:44:39', '2019-02-19 11:41:30', 0, '24022943', '', NULL, '2898516', NULL, '236591916'),
(79, 'Zena', 'Akoth', '2019-02-04', 'F', 'zena@gmail.com', '0718464683', '', '', '', '079', 16, '', '', '', '', '0718464683', '', '', 'NO', 20, '2018-11-12', NULL, '20000.00', 2, ' zena@gmail.com ', '$2y$10$Jk8gBuZqJTQR9Emc.GwLwOnJCt.myUfQKm1G30qbSJdi0qAx4Pz/a', '', NULL, NULL, '2019-02-18 09:48:45', '2019-02-22 10:31:28', 0, '30345813', 'A008204768Y', NULL, '4333823', NULL, '556877829'),
(80, 'Alex', 'Abuga Nyaosi', '2019-02-03', 'M', 'Abuga@gmail.com', '0741145860', '', '', '', '080', 16, '', '', '', '', '0741145860', '', '', 'NO', 20, '2018-11-13', NULL, '20000.00', 2, 'Abuga@gmail.com', '$2y$10$4SMvpM/.tXHVfdqjldwK4O5KU73EVvLEXfXatfgW6rQ8QgJ4Hp3WO', '', NULL, NULL, '2019-02-18 09:52:31', '2019-03-22 12:15:15', 0, '32401157', 'A010379202L', NULL, 'R9374536', NULL, '2025468871'),
(81, 'Thomas', 'Mayienda', '2019-02-03', 'M', 'Mayienda@gmail.com', '0770123654', '', '', '', '081', 16, '', '', '', '', '0770123654', '', '', 'NO', 20, '2018-10-07', NULL, '20000.00', 2, 'Mayienda@gmail.com', '$2y$10$ZfhsNgUqfhL1yUoHlm2DROI2HNev2CCCdg9QsXnRjkMtv2xyVfL5m', '', NULL, NULL, '2019-02-18 10:03:29', '2019-02-19 11:44:27', 0, '32443504', '', NULL, 'R9365269', NULL, '2025065555'),
(82, 'Prisca', 'Malova', '2019-02-03', 'F', 'Malova@gmial.com', '0750236401', '', '', '', '083', 16, '', '', '', '', '0750236401', '', '', 'NO', 45, '2018-10-07', NULL, '25000.00', 2, 'Malova@gmial.com', '$2y$10$5uZQwGzmE1YBWnG7DNQleuzWZ7pBlu5Z3nrNQFN.OEWYzdvSKvKS6', '', NULL, NULL, '2019-02-18 10:05:33', '2019-04-01 11:46:40', 0, '26214027', 'A005599529N', NULL, '3088986', NULL, '265731828'),
(83, 'Phibian', 'Nyabuto', '2019-02-03', 'F', 'Nyabuto@gmail.com', '0741005400', '', '', '', '082', 16, '', '', '', '', '0741005400', '', '', 'NO', 45, '2018-10-09', NULL, '34500.00', 2, 'Nyabuto@gmail.com', '$2y$10$UVEdHbQ1Igvl3EdOd0I4LutSC2MFzWNuww1Tm0CZqhIQWjDwjW5xK', '', NULL, NULL, '2019-02-18 10:08:06', '2019-02-22 10:35:14', 0, '25436004', 'A005966889D', NULL, '3107077', NULL, '22671182'),
(84, 'Olivia', 'Owen', '2019-02-04', 'F', 'Olivia@gmail.com', '0740005428', '', '', '', '084', 16, '', '', '', '', '0740005428', '', '', 'NO', 45, '2018-11-19', NULL, '34500.00', 2, 'Olivia@gmail.com', '$2y$10$gdXqW10Ih8abMLJ1HPFphet71kKqygWd7WqzfQ8LQz52fop5Q1C8S', '', NULL, NULL, '2019-02-18 10:10:29', '2019-02-22 10:36:08', 0, '26459913', 'A009195222M', NULL, '4636424', NULL, '20150091'),
(85, 'Jane', 'Mudiri', '2019-02-04', 'F', 'Mudiri@gmail.com', '0789560010', '', '', '', '085', 16, '', '', '', '', '0789560010', '', '', 'NO', 45, '2018-11-11', NULL, '25000.00', 2, 'Mudiri@gmail.com', '$2y$10$GVJFQjHdGtYO7kDFn9Dm7OyOiBAYm7z.eJ6SnZRymhnr0u6NN7km6', '', NULL, NULL, '2019-02-18 10:12:50', '2019-02-22 10:37:19', 0, '12418809', 'A002627728C', NULL, '618891', NULL, '584404816'),
(86, 'Florence', 'Akinyi', '2019-02-03', 'F', 'Akinyi@gmail.com', '0744401258', '', '', '', '086', 16, '', '', '', '', '0744401258', '', '', 'NO', 45, '2018-09-04', NULL, '25000.00', 2, 'Akinyi@gmail.com', '$2y$10$GOtzxTNhXlqU6qJpsX8jlu9PLHS8dzuDRr8bG.H8Fswtt7bD8ccC6', '', NULL, NULL, '2019-02-18 10:15:26', '2019-02-22 10:38:03', 0, '21382100', 'A003183861Z', NULL, '9010622', NULL, '2025039804'),
(87, 'Stanley', 'Gisore Maina', '2019-02-03', 'M', 'stan.gisore@gmail.com', '0716295343', '', '', '', '087', 16, '', '', '', '', '0716295343', '', '', 'NO', 44, '2018-12-01', NULL, '20000.00', 2, 'stan.gisore@gmail.co', '$2y$10$aKQpv.md6XzdX6MUtJ5blutv2RuXC7wOv2eAFXEbgGMeHSdEGvO8.', '', NULL, NULL, '2019-02-18 10:18:24', '2019-02-25 13:48:05', 0, '21954759', 'A003228912M', NULL, 'R1811522', NULL, '649857925'),
(88, 'Everlyne', 'Meraba', '2018-12-04', 'F', 'Everlyne@gmail.com', '0720900300', '', '', '', '088', 16, '', '', '', '', '0720900300', '', '', 'NO', 45, '2018-10-16', NULL, '34500.00', 2, 'Everlyne@gmail.com', '$2y$10$y2PamvFBL3UxleXPawMR5uQhwHFMa.sKNbWMUwseueEvaCHgXEdw2', '', NULL, NULL, '2019-02-18 10:24:27', '2019-02-19 11:51:22', 0, '26505223', '', NULL, 'R9462924', NULL, '2025158609'),
(89, 'Irene', 'Cherono', '2019-02-03', 'F', 'Cherono@gmail.com', '0740005000', '', '', '', '089', 16, '', '', '', '', '0740005000', '', '', 'NO', 45, '2018-11-04', NULL, '25000.00', 2, 'Cherono@gmail.com', '$2y$10$nhkIUpG0G9ZQSiH6aoSdDuLr3HB8TSM/Eh2UlwNkL/9aHSyNNsV1S', '', NULL, NULL, '2019-02-18 10:27:45', '2019-02-19 11:54:20', 0, '29283626', '', NULL, 'R8778184', NULL, '20221932'),
(90, 'Monica', 'Apopa', '2019-01-27', 'F', 'Apopa@gmail.com', '0714858247', '', '', '', '090', 16, '', '', '', '', '0714858247', '', '', 'NO', 45, '2018-09-10', NULL, '20000.00', 2, 'Apopa@gmail.com', '$2y$10$pFRGTka8a7YI62UdgWzFI.DzlhKzaqcja8siDjszOkYhng1NASOQy', '', NULL, NULL, '2019-02-18 10:30:13', '2019-02-19 11:55:06', 0, '26133302', '', NULL, '6731461', NULL, '00281000'),
(91, 'Mildred', 'Wayua', '2019-02-04', 'F', 'Wayua@gmail.com', '0784552055', '', '', '', '091', 16, '', '', '', '', '0784552055', '', '', 'NO', 47, '2018-09-09', NULL, '34500.00', 2, 'Wayua@gmail.com', '$2y$10$HgIh/wbF2bxwHxN29pU64Om0sss8Dkz1dDA7hxyM/u2C8GP.tPVGG', '', NULL, NULL, '2019-02-18 10:32:54', '2019-02-19 11:56:20', 0, '27369821', '', NULL, '3019065', NULL, '20019475'),
(92, 'Grace', 'Rehema Ongole', '2019-02-04', 'F', 'Rehema@gmail.com', '0715555780', '', '', '', '092', 16, '', '', '', '', '0715555780', '', '', 'NO', 47, '2018-11-05', NULL, '20000.00', 2, 'Rehema@gmail.com', '$2y$10$Xp05vZr1wxCDfX418OFZMeUhqhV5UunY2ZXfHfhePJ7yNP9WgqoQ2', '', NULL, NULL, '2019-02-18 10:34:49', '2019-03-22 12:07:23', 0, '22879764', '', NULL, '953700', NULL, '2025936552'),
(93, 'Loice', 'Mbinya Mutua', '2019-02-03', 'F', 'Loice@gmail.com', '0790099911', '', '', '', '093', 16, '', '', '', '', '0790099911', '', '', 'NO', 47, '2018-11-04', NULL, '25000.00', 2, 'Loice@gmail.com', '$2y$10$RqErA.2bonUaIsyncZA4tu3JsF.4yQ7X6cPMlPxVCDzOIKNGKBc4.', '', NULL, NULL, '2019-02-18 10:36:53', '2019-03-22 12:06:25', 0, '28728162', '', NULL, '', NULL, '2009524087'),
(94, 'Juline', 'Aluoch', '2019-02-03', 'F', 'Juline@gmail.com', '0785426900', '', '', '', '094', 16, '', '', '', '', '0785426900', '', '', 'NO', 47, '2018-09-03', NULL, '20000.00', 2, 'Juline@gmail.com', '$2y$10$DSL1szlRKbDWXbNtuye9oufXzciqXFgIMavS.Uo/g1frPElHIHVOy', '', NULL, NULL, '2019-02-18 10:39:13', '2019-02-19 11:59:56', 0, '21033025', '', NULL, '2900273', NULL, '70728581X'),
(95, 'Allan', 'Omuka', '2019-02-03', 'M', 'Omuka@gmail.com', '0745896520', '', '', '', '095', 16, '', '', '', '', '0745896520', '', '', 'NO', 46, '2018-08-06', NULL, '25000.00', 2, 'Omuka@gmail.com', '$2y$10$JICwN3Mi9LVr71xAKmHW9OqGTWwvjGuR2pQML0Na35ySiF5vfqefy', '', NULL, NULL, '2019-02-18 10:41:25', '2019-02-22 10:29:33', 0, '50084442', 'A008120745E', NULL, '', NULL, ''),
(96, 'Kennedy', 'Motende Maganga', '2019-02-04', 'M', 'kenmaganga85@gmail.com', '0724779169', '', '', '', '038', 7, '', '', '', '', '0724779169', '', '', 'NO', 40, '2019-02-04', NULL, '20000.00', 2, 'kenmaganga85@gmail.c', '$2y$10$/jCdvSE5fmlerxPNWET7ze91XaOvUJ0bGZyle3ZoscDMXdNR7gXPG', '', NULL, NULL, '2019-02-19 08:52:45', '2019-02-25 13:22:29', 0, '24556935', 'A006496392L', NULL, '2782356', NULL, '268682917'),
(97, 'Msechu', 'Deric', '2019-02-04', 'M', 'msechuderic@gmail.com', '0720839320', '', '', '', '054', 10, '', '', '', '', '0720839320', '', '', 'NO', 41, '2018-10-08', NULL, '25000.00', 2, 'msechuderic@gmail.co', '$2y$10$d0oK/3QHElSCUtBKrQ2IrOzA4lFamDyNdc7yXhI3XIm3zlSlUqAtm', '', NULL, NULL, '2019-02-19 09:25:02', '2019-04-01 12:12:30', 0, '25053952', 'A006808297U', NULL, '3084953', NULL, '451143914');

-- --------------------------------------------------------

--
-- Table structure for table `user_appraisals`
--

CREATE TABLE `user_appraisals` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `activeappraisal_id` int(11) NOT NULL,
  `useranswer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_leave_type`
--

CREATE TABLE `user_leave_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `vehicle_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vehicle_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vehicle_model` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vehicle_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vehicle_purchase_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warnings`
--

CREATE TABLE `warnings` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `warnings`
--

INSERT INTO `warnings` (`id`, `title`, `subject`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Late ', 'reporting late on duty ', '<p>bbbbbb</p>', 0, '2019-01-31 12:28:32', '2019-01-31 12:28:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absences`
--
ALTER TABLE `absences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `active_appraisals`
--
ALTER TABLE `active_appraisals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appication_statuses`
--
ALTER TABLE `appication_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appraisal_questionares`
--
ALTER TABLE `appraisal_questionares`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appraisal_questions`
--
ALTER TABLE `appraisal_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appreciation_templates`
--
ALTER TABLE `appreciation_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_transactions`
--
ALTER TABLE `asset_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_types`
--
ALTER TABLE `asset_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cancel_contracts`
--
ALTER TABLE `cancel_contracts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cancel_contract_user`
--
ALTER TABLE `cancel_contract_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `candidates_email_unique` (`email`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_offences`
--
ALTER TABLE `company_offences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contract_templates`
--
ALTER TABLE `contract_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contract_user`
--
ALTER TABLE `contract_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cut_offs`
--
ALTER TABLE `cut_offs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_leave_type`
--
ALTER TABLE `department_leave_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation_items`
--
ALTER TABLE `designation_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_types`
--
ALTER TABLE `document_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `escalations`
--
ALTER TABLE `escalations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hierachies`
--
ALTER TABLE `hierachies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hierachy_user`
--
ALTER TABLE `hierachy_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issued_appreciations`
--
ALTER TABLE `issued_appreciations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issued_warnings`
--
ALTER TABLE `issued_warnings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_groups`
--
ALTER TABLE `job_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_vacancies`
--
ALTER TABLE `job_vacancies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leavetype_user`
--
ALTER TABLE `leavetype_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_balances`
--
ALTER TABLE `leave_balances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_days`
--
ALTER TABLE `leave_days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lost_assets`
--
ALTER TABLE `lost_assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offereds`
--
ALTER TABLE `offereds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer_letters`
--
ALTER TABLE `offer_letters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_types`
--
ALTER TABLE `question_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_rateable_id_rateable_type_index` (`rateable_id`,`rateable_type`),
  ADD KEY `ratings_rateable_id_index` (`rateable_id`),
  ADD KEY `ratings_rateable_type_index` (`rateable_type`),
  ADD KEY `ratings_user_id_index` (`user_id`);

--
-- Indexes for table `recruitment_processes`
--
ALTER TABLE `recruitment_processes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recruitment_types`
--
ALTER TABLE `recruitment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renew_contracts`
--
ALTER TABLE `renew_contracts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renew_contract_user`
--
ALTER TABLE `renew_contract_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_assets`
--
ALTER TABLE `request_assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_assets`
--
ALTER TABLE `return_assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_departments`
--
ALTER TABLE `sub_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `termination_issues`
--
ALTER TABLE `termination_issues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `termination_letters`
--
ALTER TABLE `termination_letters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_types`
--
ALTER TABLE `training_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travel_modes`
--
ALTER TABLE `travel_modes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travel_perdiems`
--
ALTER TABLE `travel_perdiems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travel_requests`
--
ALTER TABLE `travel_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_appraisals`
--
ALTER TABLE `user_appraisals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_leave_type`
--
ALTER TABLE `user_leave_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warnings`
--
ALTER TABLE `warnings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absences`
--
ALTER TABLE `absences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `active_appraisals`
--
ALTER TABLE `active_appraisals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `appication_statuses`
--
ALTER TABLE `appication_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `appraisal_questionares`
--
ALTER TABLE `appraisal_questionares`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `appraisal_questions`
--
ALTER TABLE `appraisal_questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `appreciation_templates`
--
ALTER TABLE `appreciation_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `asset_transactions`
--
ALTER TABLE `asset_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `asset_types`
--
ALTER TABLE `asset_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cancel_contracts`
--
ALTER TABLE `cancel_contracts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cancel_contract_user`
--
ALTER TABLE `cancel_contract_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `company_offences`
--
ALTER TABLE `company_offences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `contract_templates`
--
ALTER TABLE `contract_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `contract_user`
--
ALTER TABLE `contract_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `cut_offs`
--
ALTER TABLE `cut_offs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `department_leave_type`
--
ALTER TABLE `department_leave_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `designation_items`
--
ALTER TABLE `designation_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `document_types`
--
ALTER TABLE `document_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `escalations`
--
ALTER TABLE `escalations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hierachies`
--
ALTER TABLE `hierachies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hierachy_user`
--
ALTER TABLE `hierachy_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `issued_appreciations`
--
ALTER TABLE `issued_appreciations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `issued_warnings`
--
ALTER TABLE `issued_warnings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `job_groups`
--
ALTER TABLE `job_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_vacancies`
--
ALTER TABLE `job_vacancies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `leavetype_user`
--
ALTER TABLE `leavetype_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `leave_balances`
--
ALTER TABLE `leave_balances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `leave_days`
--
ALTER TABLE `leave_days`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lost_assets`
--
ALTER TABLE `lost_assets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `offereds`
--
ALTER TABLE `offereds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `offer_letters`
--
ALTER TABLE `offer_letters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT for table `question_types`
--
ALTER TABLE `question_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `recruitment_processes`
--
ALTER TABLE `recruitment_processes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `recruitment_types`
--
ALTER TABLE `recruitment_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `renew_contracts`
--
ALTER TABLE `renew_contracts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `renew_contract_user`
--
ALTER TABLE `renew_contract_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `request_assets`
--
ALTER TABLE `request_assets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `return_assets`
--
ALTER TABLE `return_assets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;
--
-- AUTO_INCREMENT for table `sub_departments`
--
ALTER TABLE `sub_departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `termination_issues`
--
ALTER TABLE `termination_issues`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `termination_letters`
--
ALTER TABLE `termination_letters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `training_types`
--
ALTER TABLE `training_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `travel_modes`
--
ALTER TABLE `travel_modes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `travel_perdiems`
--
ALTER TABLE `travel_perdiems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `travel_requests`
--
ALTER TABLE `travel_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `user_appraisals`
--
ALTER TABLE `user_appraisals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_leave_type`
--
ALTER TABLE `user_leave_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `warnings`
--
ALTER TABLE `warnings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
