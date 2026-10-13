-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2026 at 02:41 PM
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
-- Database: `trekking_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departures`
--

CREATE TABLE `departures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trek_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `seats_left` smallint(5) UNSIGNED DEFAULT NULL,
  `price` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departures`
--

INSERT INTO `departures` (`id`, `trek_id`, `start_date`, `seats_left`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-12-05', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(2, 1, '2026-12-19', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(3, 1, '2027-01-09', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(4, 1, '2027-01-23', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(5, 1, '2027-02-06', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(6, 1, '2027-02-20', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(7, 1, '2027-03-06', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(8, 1, '2027-03-20', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(9, 1, '2027-04-10', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(10, 1, '2027-04-24', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(11, 2, '2026-10-24', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(12, 2, '2026-11-07', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(13, 2, '2026-11-21', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(14, 2, '2027-03-06', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(15, 2, '2027-03-20', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(16, 2, '2027-04-10', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(17, 2, '2027-04-24', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(18, 2, '2027-05-08', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(19, 2, '2027-05-22', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(20, 3, '2026-12-05', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(21, 3, '2026-12-19', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(22, 3, '2027-01-09', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(23, 3, '2027-01-23', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(24, 3, '2027-02-06', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(25, 3, '2027-02-20', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(26, 3, '2027-03-06', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(27, 3, '2027-03-20', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(28, 4, '2027-07-10', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(29, 4, '2027-07-24', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(30, 4, '2027-08-07', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(31, 4, '2027-08-21', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(32, 4, '2027-09-11', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(33, 4, '2027-09-25', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(34, 5, '2026-10-24', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(35, 5, '2027-05-08', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(36, 5, '2027-05-22', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(37, 5, '2027-06-05', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(38, 5, '2027-06-19', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(39, 5, '2027-09-11', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(40, 5, '2027-09-25', NULL, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(41, 6, '2027-06-05', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(42, 6, '2027-06-19', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(43, 6, '2027-07-10', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(44, 6, '2027-07-24', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(45, 6, '2027-08-07', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(46, 6, '2027-08-21', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(47, 6, '2027-09-11', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(48, 6, '2027-09-25', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(49, 7, '2027-07-10', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(50, 7, '2027-07-24', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(51, 7, '2027-08-07', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(52, 7, '2027-08-21', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(53, 7, '2027-09-11', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(54, 7, '2027-09-25', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(55, 8, '2027-06-05', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(56, 8, '2027-06-19', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(57, 8, '2027-07-10', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(58, 8, '2027-07-24', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(59, 8, '2027-08-07', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(60, 8, '2027-08-21', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(61, 8, '2027-09-11', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(62, 8, '2027-09-25', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(63, 9, '2026-10-24', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(64, 9, '2026-11-07', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(65, 9, '2026-11-21', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(66, 9, '2027-03-06', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(67, 9, '2027-03-20', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(68, 9, '2027-04-10', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(69, 9, '2027-04-24', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(70, 9, '2027-05-08', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(71, 9, '2027-05-22', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(72, 10, '2026-10-24', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(73, 10, '2026-11-07', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(74, 10, '2026-11-21', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(75, 10, '2027-04-10', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(76, 10, '2027-04-24', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(77, 10, '2027-05-08', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(78, 10, '2027-05-22', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(79, 11, '2026-10-24', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(80, 11, '2026-11-07', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(81, 11, '2026-11-21', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(82, 11, '2027-03-06', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(83, 11, '2027-03-20', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(84, 11, '2027-04-10', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(85, 11, '2027-04-24', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(86, 11, '2027-05-08', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(87, 11, '2027-05-22', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(88, 12, '2026-10-24', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(89, 12, '2026-11-07', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(90, 12, '2026-11-21', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(91, 12, '2027-03-06', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(92, 12, '2027-03-20', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(93, 12, '2027-04-10', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(94, 12, '2027-04-24', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(95, 12, '2027-05-08', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(96, 12, '2027-05-22', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(97, 13, '2027-06-05', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(98, 13, '2027-06-19', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(99, 13, '2027-07-10', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(100, 13, '2027-07-24', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(101, 13, '2027-08-07', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(102, 13, '2027-08-21', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(103, 13, '2027-09-11', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(104, 13, '2027-09-25', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(105, 14, '2026-10-24', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(106, 14, '2027-05-08', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(107, 14, '2027-05-22', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(108, 14, '2027-06-05', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(109, 14, '2027-06-19', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(110, 14, '2027-09-11', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(111, 14, '2027-09-25', NULL, NULL, '2026-10-11 05:54:26', '2026-10-11 05:54:26');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `trek_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `topic` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `group_size` varchar(255) DEFAULT NULL,
  `batch` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faq_category_id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `faq_category_id`, `question`, `answer`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'How do I choose the right trek?', 'Start with your fitness level and the number of days you have. For a first trek, pick an easy or easy-to-moderate route of 4 to 6 days with a gradual climb, and check the best season. If you are unsure, send us an enquiry and we will suggest options.', 0, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(2, 1, 'Can a beginner choose a tough trek?', 'We do not recommend it. High altitude, steep slopes and rough ground need experience and fitness. Begin with an easier trek and build up from there.', 1, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(3, 1, 'Is there an age limit?', 'There is no fixed age limit. Fitness and health matter more. If you have a medical condition, please check with your doctor before booking.', 2, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(4, 1, 'Can I join the trek solo?', 'Yes. Book a fixed-date batch and we will place you in a group with other trekkers.', 3, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(5, 1, 'What food will I get?', 'Simple, filling vegetarian meals and snacks on the trail. Tell us about allergies or special diets when you book so we can plan ahead.', 4, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(6, 1, 'How much water should I carry?', 'Carry two one-litre bottles. You can refill them at every camp.', 5, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(7, 2, 'How do I book a trek?', 'Pick a trek and a batch date, then send us an enquiry using the form below. We will confirm availability and share the payment steps.', 0, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(8, 2, 'What is included in the price?', 'Add your own inclusions here, for example camps or stays, meals on the trek, trek leader and guides, permits and a safety kit.', 1, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(9, 2, 'Can I change my batch date?', 'Add your date-change rules here. Ask us as early as possible so we can check space in other batches.', 2, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(10, 2, 'What is the cancellation policy?', 'Add your cancellation and refund terms here.', 3, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(11, 3, 'Can I trek with kids?', 'Yes, on easy routes such as Dayara Bugyal. Check the minimum age for each trek with our team before booking.', 0, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(12, 3, 'Can we book a private family batch?', 'Add your private or customised trek details here, including group size and pricing.', 1, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(13, 3, 'What should kids carry?', 'A small day pack with water, a snack and a rain layer. Adults or porters carry the main load.', 2, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(14, 4, 'What gear can I rent?', 'Jackets, trekking poles, sleeping bags and shoes. Add your full list here.', 0, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(15, 4, 'How does renting work?', 'Tell us the gear and dates in your enquiry. You collect and return it at the base point. Add your own steps here.', 1, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(16, 4, 'Is there a deposit?', 'Add your deposit and damage policy here.', 2, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(17, 5, 'What is the repeat trek policy?', 'Describe what you offer to returning trekkers here, for example a discount on the next booking.', 0, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(18, 5, 'How do I claim it?', 'Add the steps here, such as quoting your earlier booking ID.', 1, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(19, 6, 'What is a Trek Ambassador?', 'A past trekker who shares their experience and helps new trekkers choose and prepare. Describe your own programme here.', 0, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(20, 6, 'How can I become one?', 'Add the requirements and the sign-up steps here.', 1, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(21, 7, 'Is it safe for women trekkers?', 'Add your safety details here. Common points are trained leaders, daily check-ins, clear camp rules and the option of women-only batches.', 0, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(22, 7, 'Can I join a women-only batch?', 'Add your women-only batch dates and details here.', 1, '2026-10-11 05:54:27', '2026-10-11 05:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `faq_categories`
--

CREATE TABLE `faq_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'book',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_categories`
--

INSERT INTO `faq_categories` (`id`, `name`, `icon`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Beginners Guide', 'book', 0, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(2, 'Booking Guide', 'calendar', 1, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(3, 'Family Treks', 'users', 2, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(4, 'Rent', 'tag', 3, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(5, 'Repeat Your Trek Policy', 'repeat', 4, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(6, 'Trek Ambassador', 'badge', 5, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(7, 'Women Trekker', 'person', 6, '2026-10-11 05:54:27', '2026-10-11 05:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `trek_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'shield',
  `title` varchar(255) NOT NULL,
  `text` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `icon`, `title`, `text`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'shield', 'Certified leaders', 'Trained leaders and local guides check health and pace daily.', 0, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(2, 'cross', 'Safety first', 'First-aid, oxygen and clear weather and altitude plans.', 1, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(3, 'food', 'Good food', 'Hot vegetarian meals. Diets and allergies handled in advance.', 2, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(4, 'leaf', 'Leave no trace', 'We carry waste out and run clean-up drives.', 3, '2026-10-11 05:54:27', '2026-10-11 05:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_01_000001_add_is_admin_to_users_table', 1),
(5, '2025_01_01_000002_create_regions_table', 1),
(6, '2025_01_01_000003_create_treks_table', 1),
(7, '2025_01_01_000004_create_content_tables', 1),
(8, '2025_01_01_000005_create_enquiries_favorites_settings', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'update',
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` varchar(255) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `type`, `title`, `slug`, `excerpt`, `body`, `image`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 'update', 'Kedarnath Trek', 'kedarnath-trek', 'Weather and trail notes for the coming batches', 'Weather and trail notes for the coming batches. This is sample text. Replace it from the admin panel.', 'images/kedarnath-trek-1.jpg', 1, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(2, 'update', 'Chandratal Lake', 'chandratal-lake', 'Clear skies and open camps this week', 'Clear skies and open camps this week. This is sample text. Replace it from the admin panel.', 'images/chandratal-lake-1.jpg', 1, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(3, 'update', 'Roopkund', 'roopkund', 'Snow patches on the upper trail, carry gaiters', 'Snow patches on the upper trail, carry gaiters. This is sample text. Replace it from the admin panel.', 'images/roopkund-1.jpg', 1, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(4, 'update', 'Everest Base Camp', 'everest-base-camp', 'Acclimatisation days added to every batch', 'Acclimatisation days added to every batch. This is sample text. Replace it from the admin panel.', 'images/everest-base-camp-1.jpg', 1, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(5, 'update', 'Goechala', 'goechala', 'Clear mornings expected for peak views', 'Clear mornings expected for peak views. This is sample text. Replace it from the admin panel.', 'images/goechala-1.jpg', 1, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(6, 'article', 'How to choose your first trek', 'how-to-choose-your-first-trek', 'Easy routes, ideal months and what to expect', 'Easy routes, ideal months and what to expect. This is sample text. Replace it from the admin panel.', 'images/dayara-bugyal-1.jpg', 1, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(7, 'article', 'Packing list for a 5-day trek', 'packing-list-for-a-5-day-trek', 'Layers, shoes and the small things people forget', 'Layers, shoes and the small things people forget. This is sample text. Replace it from the admin panel.', 'images/brahmatal-1.jpg', 1, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(8, 'article', 'Altitude sickness: what to know', 'altitude-sickness-what-to-know', 'Signs to watch for and how to acclimatise', 'Signs to watch for and how to acclimatise. This is sample text. Replace it from the admin panel.', 'images/annapurna-base-camp-1.jpg', 1, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(9, 'article', 'Best time for flowers and lakes', 'best-time-for-flowers-and-lakes', 'Monsoon blooms and summer lakes in the Himalayas', 'Monsoon blooms and summer lakes in the Himalayas. This is sample text. Replace it from the admin panel.', 'images/valley-of-flowers-1.jpg', 1, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(10, 'article', 'Ladakh treks for beginners', 'ladakh-treks-for-beginners', 'Valleys, villages and passes to start with', 'Valleys, villages and passes to start with. This is sample text. Replace it from the admin panel.', 'images/markha-valley-1.jpg', 1, '2026-10-11 05:54:26', '2026-10-11 05:54:26');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'India',
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `country`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Uttarakhand', 'India', 'images/dayara-bugyal-1.jpg', 0, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(2, 'Himachal Pradesh', 'India', 'images/chandratal-lake-1.jpg', 1, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(3, 'Kashmir', 'India', 'images/kashmir-great-lakes-1.jpg', 2, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(4, 'Ladakh', 'India', 'images/markha-valley-1.jpg', 3, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(5, 'West Bengal', 'India', 'images/sandakphu-1.jpg', 4, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(6, 'Sikkim', 'India', 'images/goechala-1.jpg', 5, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(7, 'Nepal', 'Nepal', 'images/everest-base-camp-1.jpg', 6, '2026-10-11 05:54:25', '2026-10-11 05:54:25');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `trek_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL DEFAULT 5,
  `body` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `trek_id`, `rating`, `body`, `image`, `is_published`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Aarav Mehta', 14, 5, 'Well planned from start to finish. The guide kept a steady pace and checked on everyone along the way.', NULL, 1, 0, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(2, 'Neha Sharma', 4, 5, 'The trail was green and quiet, and the team handled the rain without any fuss. Great first Himalayan trek.', NULL, 1, 1, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(3, 'Rohan Verma', 5, 5, 'Tough climb, but the leaders explained each day clearly and the camps were warm and comfortable.', NULL, 1, 2, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(4, 'Priya Nair', 11, 5, 'Lovely group, great food at every stop, and a guide who knew every turn. Would trek with them again.', NULL, 1, 3, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(5, 'Karan Singh', 13, 5, 'Easy to book, easy to follow. The lake at sunrise made the whole trip worth it.', NULL, 1, 4, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(6, 'Ishita Roy', 10, 5, 'Eleven days felt short. Clear weather updates and kind, patient support from the whole team.', NULL, 1, 5, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(7, 'Vikram Rao', 7, 5, 'Every lake looked better than the last. The local crew looked after us very well.', NULL, 1, 6, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(8, 'Ananya Das', 2, 5, 'We took the kids on this one. The pace was gentle and the guides made it fun for them.', NULL, 1, 7, '2026-10-11 05:54:26', '2026-10-11 05:54:26');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3w7yZqM2sya2naU8CNMUvL6WjdYYpdZigTYZGKRS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaFFjQTlPbEVpWDY4aTNaUG1HaVpKZER0NnJBVUlyaWpNdDAxTFNCeCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1791709349),
('TXES40LTYqaoOrikYVXVStPwT8obq42c9BLkZILB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQTJUaGhnY1FaRkd3VUhyMUpIcjdCQnlqenltOENEQ3dhcG1wdVlDayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90cmVrcy9rZWRhcmthbnRoYSI7czo1OiJyb3V0ZSI7czoxMDoidHJla3Muc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1791895013),
('XrN3rC06QtjztZwDegXmExGrZVWGgLdtFY9Yvnhv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVHJXOHE1Nm5hNThuMFdDQjQwQ285R3Z4Y3BERUU1SnZBS3p4dWdoWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1791700308);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'site_name', 'Himalaya Trails'),
(2, 'phone', '+91 00000 00000'),
(3, 'email', 'info@example.com'),
(4, 'address', 'Dehradun, Uttarakhand, India'),
(5, 'hours', 'Mon to Sat, 10 AM to 8 PM'),
(6, 'whatsapp', '910000000000'),
(7, 'footer_note', 'Demo details. Replace them in the admin panel.');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `promo_top` varchar(255) DEFAULT NULL,
  `promo_main` varchar(255) DEFAULT NULL,
  `promo_year` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `price_label` varchar(255) DEFAULT NULL,
  `price_text` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `title`, `subtitle`, `image`, `promo_top`, `promo_main`, `promo_year`, `button_text`, `button_url`, `price_label`, `price_text`, `note`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Winter Snow Treks', 'Kedarkantha, Brahmatal and Dayara Bugyal', 'images/hero-1.jpg', 'Winter Treks', 'Sale', '2026', 'Know more', '/category/season/winter', NULL, NULL, 'Limited seats. Book early.', 0, 1, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(2, 'Brahmatal Trek', 'Frozen lakes and ridge walks', 'images/brahmatal-1.jpg', 'Winter Treks', 'Sale', '2026', 'Know more', '/treks/brahmatal', NULL, NULL, 'Travel charges extra', 1, 1, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(3, 'Dayara Bugyal Trek', 'Open meadows and snow views', 'images/dayara-bugyal-1.jpg', 'Winter Treks', 'Sale', '2026', 'Know more', '/treks/dayara-bugyal', NULL, NULL, 'Travel charges extra', 2, 1, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(4, 'Sandakphu Trek', 'Sunrise over Kanchenjunga and Everest', 'images/sandakphu-1.jpg', 'Winter Treks', 'Sale', '2026', 'Know more', '/treks/sandakphu', NULL, NULL, 'Travel charges extra', 3, 1, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(5, 'Himalayan Winter Views', 'Cedar forests and snow peaks on the horizon', 'images/hero-3.jpg', 'Winter Treks', 'Sale', '2026', 'Know more', '/category/season/winter', NULL, NULL, 'Limited seats. Book early.', 4, 1, '2026-10-11 05:54:25', '2026-10-11 05:54:25');

-- --------------------------------------------------------

--
-- Table structure for table `stats`
--

CREATE TABLE `stats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'mtn',
  `number` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `suffix` varchar(255) NOT NULL DEFAULT '+',
  `title` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stats`
--

INSERT INTO `stats` (`id`, `icon`, `number`, `suffix`, `title`, `caption`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'users', 50000, '+', 'Happy Trekkers', 'Across 20+ destinations', 0, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(2, 'mtn', 40, '+', 'Treks', 'Multiple regions', 1, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(3, 'trophy', 10, '+', 'Awards', 'Industry recognition', 2, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(4, 'clock', 12, '+', 'Years', 'Of safe adventures', 3, '2026-10-11 05:54:27', '2026-10-11 05:54:27'),
(5, 'sprout', 100, '+', 'Clean-up drives', 'Conducted on popular trails', 4, '2026-10-11 05:54:27', '2026-10-11 05:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `treks`
--

CREATE TABLE `treks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `region_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `days` smallint(5) UNSIGNED NOT NULL DEFAULT 1,
  `grade` varchar(255) NOT NULL DEFAULT 'Easy',
  `season` varchar(255) NOT NULL DEFAULT 'Summer',
  `short_text` varchar(255) DEFAULT NULL,
  `overview` text DEFAULT NULL,
  `highlights` text DEFAULT NULL,
  `base_camp` varchar(255) DEFAULT NULL,
  `max_altitude` int(10) UNSIGNED DEFAULT NULL,
  `distance_km` smallint(5) UNSIGNED DEFAULT NULL,
  `best_months` varchar(255) DEFAULT NULL,
  `interest` varchar(255) NOT NULL DEFAULT 'Trekking',
  `themes` varchar(255) DEFAULT NULL,
  `experiences` varchar(255) DEFAULT NULL,
  `itinerary` text DEFAULT NULL,
  `inclusions` text DEFAULT NULL,
  `exclusions` text DEFAULT NULL,
  `essentials` text DEFAULT NULL,
  `cancellation` text DEFAULT NULL,
  `price` int(10) UNSIGNED DEFAULT NULL,
  `price_note` varchar(255) DEFAULT NULL,
  `badge` varchar(255) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `rating_count` int(10) UNSIGNED DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `treks`
--

INSERT INTO `treks` (`id`, `region_id`, `title`, `slug`, `days`, `grade`, `season`, `short_text`, `overview`, `highlights`, `base_camp`, `max_altitude`, `distance_km`, `best_months`, `interest`, `themes`, `experiences`, `itinerary`, `inclusions`, `exclusions`, `essentials`, `cancellation`, `price`, `price_note`, `badge`, `rating`, `rating_count`, `is_published`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kedarkantha', 'kedarkantha', 6, 'Easy to Moderate', 'Winter', 'Snow summit and pine forests', 'A classic first winter trek. The trail climbs through pine and oak forest, passes a frozen lake and ends on a snow-covered summit above Sankri with wide views of Swargarohini and Bandarpoonch.', 'Snow summit with 360 degree views\nJuda ka Talab lake camp\nEasy pace, good for first-timers', 'Sankri', 3800, 20, 'Dec to Apr', 'Trekking', 'Snow, Beginner, Summit a Peak', 'Family Treks', 'Drive from Dehradun to Sankri\nSankri to Juda ka Talab\nJuda ka Talab to Kedarkantha Base\nSummit Kedarkantha, descend to Hargaon\nHargaon to Sankri\nDrive from Sankri to Dehradun', 'Stay at camps, guesthouses or teahouses as per the route\nMeals during the trek (vegetarian)\nTrek leader, guides and support staff\nPermits, forest and camping fees\nFirst-aid kit and oxygen cylinder', 'Travel to and from the base point\nPersonal expenses and tips\nTravel and medical insurance\nPorter or mule charges for personal bags\nAnything not listed under inclusions', 'Backpack, 40 to 50 L, with rain cover\nTrekking shoes with good grip\nWarm layers: fleece, down jacket, thermals\nWaterproof jacket and trousers\nCap or sun hat, gloves, sunglasses\nTwo 1-litre water bottles\nTrekking pole (recommended)\nPersonal medicines and sunscreen', 'Add your own cancellation and refund terms here, for example how much is refunded 30, 15 and 7 days before the trek.', NULL, '+ GST', NULL, NULL, NULL, 1, 0, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(2, 1, 'Dayara Bugyal', 'dayara-bugyal', 5, 'Easy', 'Spring', 'Open meadows and snow views', 'A gentle climb from Barsu to one of Uttarakhand\'s largest high-altitude meadows. Green in summer and under deep snow in winter, with Bandarpoonch and Srikanth in the distance.', 'Wide open Himalayan meadows\nShort and easy route\nGood for families and beginners', 'Barsu', 3400, 22, 'Mar to May, Oct to Nov', 'Trekking', 'Meadow, Family with kids, Beginner, Snow', 'Family Treks, Senior Treks', 'Drive from Dehradun to Barsu\nBarsu to Dayara Bugyal\nExplore Bakaria Top and return to camp\nDayara Bugyal to Raithal\nDrive from Raithal to Dehradun', 'Stay at camps, guesthouses or teahouses as per the route\nMeals during the trek (vegetarian)\nTrek leader, guides and support staff\nPermits, forest and camping fees\nFirst-aid kit and oxygen cylinder', 'Travel to and from the base point\nPersonal expenses and tips\nTravel and medical insurance\nPorter or mule charges for personal bags\nAnything not listed under inclusions', 'Backpack, 40 to 50 L, with rain cover\nTrekking shoes with good grip\nWarm layers: fleece, down jacket, thermals\nWaterproof jacket and trousers\nCap or sun hat, gloves, sunglasses\nTwo 1-litre water bottles\nTrekking pole (recommended)\nPersonal medicines and sunscreen', 'Add your own cancellation and refund terms here, for example how much is refunded 30, 15 and 7 days before the trek.', NULL, '+ GST', NULL, NULL, NULL, 1, 1, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(3, 1, 'Brahmatal', 'brahmatal', 6, 'Easy to Moderate', 'Winter', 'Frozen lakes and ridge walks', 'A winter trek through oak and rhododendron forest to frozen lakes and a ridge that looks across to Trishul and Nanda Ghunti.', 'Frozen Bekaltal and Brahmatal lakes\nRidge views of Trishul\nQuiet winter forest trails', 'Lohajung', 3700, 24, 'Dec to Mar', 'Trekking', 'Snow, Lakes, Frozen River and Waterfall', 'Stargazing Treks', 'Drive from Kathgodam to Lohajung\nLohajung to Bekaltal\nBekaltal to Brahmatal\nExplore Brahmatal and Jhandi Top\nDescend to Lohajung\nDrive from Lohajung to Kathgodam', 'Stay at camps, guesthouses or teahouses as per the route\nMeals during the trek (vegetarian)\nTrek leader, guides and support staff\nPermits, forest and camping fees\nFirst-aid kit and oxygen cylinder', 'Travel to and from the base point\nPersonal expenses and tips\nTravel and medical insurance\nPorter or mule charges for personal bags\nAnything not listed under inclusions', 'Backpack, 40 to 50 L, with rain cover\nTrekking shoes with good grip\nWarm layers: fleece, down jacket, thermals\nWaterproof jacket and trousers\nCap or sun hat, gloves, sunglasses\nTwo 1-litre water bottles\nTrekking pole (recommended)\nPersonal medicines and sunscreen', 'Add your own cancellation and refund terms here, for example how much is refunded 30, 15 and 7 days before the trek.', NULL, '+ GST', NULL, NULL, NULL, 1, 2, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(4, 1, 'Valley of Flowers', 'valley-of-flowers', 6, 'Easy to Moderate', 'Monsoon', 'Alpine flowers and Hemkund Sahib', 'A protected alpine valley covered in wildflowers in the monsoon, combined with the high-altitude shrine of Hemkund Sahib.', 'Wildflowers across the valley floor\nVisit to Hemkund Sahib\nWalk beside the Pushpawati river', 'Govindghat', 4330, 38, 'Jul to Sep', 'Trekking', 'Walk in the Valley, Meadow, River', 'Adventure Therapy', 'Drive from Rishikesh to Joshimath\nGovindghat to Ghangaria\nGhangaria to Valley of Flowers and back\nGhangaria to Hemkund Sahib and back\nGhangaria to Govindghat, drive to Joshimath\nDrive from Joshimath to Rishikesh', 'Stay at camps, guesthouses or teahouses as per the route\nMeals during the trek (vegetarian)\nTrek leader, guides and support staff\nPermits, forest and camping fees\nFirst-aid kit and oxygen cylinder', 'Travel to and from the base point\nPersonal expenses and tips\nTravel and medical insurance\nPorter or mule charges for personal bags\nAnything not listed under inclusions', 'Backpack, 40 to 50 L, with rain cover\nTrekking shoes with good grip\nWarm layers: fleece, down jacket, thermals\nWaterproof jacket and trousers\nCap or sun hat, gloves, sunglasses\nTwo 1-litre water bottles\nTrekking pole (recommended)\nPersonal medicines and sunscreen', 'Add your own cancellation and refund terms here, for example how much is refunded 30, 15 and 7 days before the trek.', NULL, '+ GST', NULL, NULL, NULL, 1, 3, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(5, 1, 'Roopkund', 'roopkund', 8, 'Difficult', 'Summer', 'Glacial lake and high ridges', 'A high trek through Ali and Bedni Bugyal meadows to a glacial lake in a stark bowl of rock, with Trishul and Nanda Ghunti in view.', 'Ali and Bedni Bugyal meadows\nHigh glacial lake at 4,800 m\nBig mountain views all along', 'Lohajung', 4800, 53, 'May to Jun, Sep to Oct', 'Trekking', 'Lakes, Glacier, Peaks View', '', 'Drive from Kathgodam to Lohajung\nLohajung to Didna village\nDidna to Ali Bugyal\nAli Bugyal to Pathar Nachauni\nPathar Nachauni to Bhagwabasa\nRoopkund and back to Bhagwabasa\nDescend to Lohajung\nDrive from Lohajung to Kathgodam', 'Stay at camps, guesthouses or teahouses as per the route\nMeals during the trek (vegetarian)\nTrek leader, guides and support staff\nPermits, forest and camping fees\nFirst-aid kit and oxygen cylinder', 'Travel to and from the base point\nPersonal expenses and tips\nTravel and medical insurance\nPorter or mule charges for personal bags\nAnything not listed under inclusions', 'Backpack, 40 to 50 L, with rain cover\nTrekking shoes with good grip\nWarm layers: fleece, down jacket, thermals\nWaterproof jacket and trousers\nCap or sun hat, gloves, sunglasses\nTwo 1-litre water bottles\nTrekking pole (recommended)\nPersonal medicines and sunscreen', 'Add your own cancellation and refund terms here, for example how much is refunded 30, 15 and 7 days before the trek.', NULL, '+ GST', NULL, NULL, NULL, 1, 4, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(6, 2, 'Hampta Pass', 'hampta-pass', 5, 'Moderate', 'Summer', 'Green valley to cold desert', 'A crossover trek that climbs from the green Kullu valley over Hampta Pass into the dry, rugged landscape of Lahaul, ending at Chandratal lake.', 'Green valley to cold desert crossover\nHampta Pass at 4,270 m\nCamp near Chandratal lake', 'Manali', 4270, 26, 'Jun to Sep', 'Trekking', 'Crossover Through, River', 'Summer Camps', 'Manali to Jobra, trek to Chika\nChika to Balu ka Ghera\nBalu ka Ghera to Shea Goru over Hampta Pass\nDrive from Shea Goru to Chandratal\nDrive from Chandratal to Manali', 'Stay at camps, guesthouses or teahouses as per the route\nMeals during the trek (vegetarian)\nTrek leader, guides and support staff\nPermits, forest and camping fees\nFirst-aid kit and oxygen cylinder', 'Travel to and from the base point\nPersonal expenses and tips\nTravel and medical insurance\nPorter or mule charges for personal bags\nAnything not listed under inclusions', 'Backpack, 40 to 50 L, with rain cover\nTrekking shoes with good grip\nWarm layers: fleece, down jacket, thermals\nWaterproof jacket and trousers\nCap or sun hat, gloves, sunglasses\nTwo 1-litre water bottles\nTrekking pole (recommended)\nPersonal medicines and sunscreen', 'Add your own cancellation and refund terms here, for example how much is refunded 30, 15 and 7 days before the trek.', NULL, '+ GST', NULL, NULL, NULL, 1, 5, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(7, 3, 'Kashmir Great Lakes', 'kashmir-great-lakes', 8, 'Moderate', 'Summer', 'Seven alpine lakes', 'A high-altitude route linking Vishansar, Krishansar, Gadsar, Satsar and Gangabal lakes between Sonamarg and Naranag, over open meadows and passes.', 'Seven alpine lakes\nGadsar Pass crossing\nMeadows full of wildflowers in season', 'Sonamarg', 4100, 70, 'Jul to Sep', 'Trekking', 'Lakes, Meadow, Peaks View', '', 'Drive from Srinagar to Sonamarg\nSonamarg to Nichnai\nNichnai to Vishansar Lake via Krishansar\nVishansar to Gadsar over Gadsar Pass\nGadsar to Satsar\nSatsar to Gangabal\nGangabal to Naranag\nDrive from Naranag to Srinagar', 'Stay at camps, guesthouses or teahouses as per the route\nMeals during the trek (vegetarian)\nTrek leader, guides and support staff\nPermits, forest and camping fees\nFirst-aid kit and oxygen cylinder', 'Travel to and from the base point\nPersonal expenses and tips\nTravel and medical insurance\nPorter or mule charges for personal bags\nAnything not listed under inclusions', 'Backpack, 40 to 50 L, with rain cover\nTrekking shoes with good grip\nWarm layers: fleece, down jacket, thermals\nWaterproof jacket and trousers\nCap or sun hat, gloves, sunglasses\nTwo 1-litre water bottles\nTrekking pole (recommended)\nPersonal medicines and sunscreen', 'Add your own cancellation and refund terms here, for example how much is refunded 30, 15 and 7 days before the trek.', NULL, '+ GST', NULL, NULL, NULL, 1, 6, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(8, 4, 'Markha Valley', 'markha-valley', 8, 'Moderate', 'Summer', 'Villages, gompas and high passes', 'A river-valley trek through Ladakhi villages, monasteries and apricot fields, with the Kongmaru La crossing as the high point.', 'Ladakhi villages and homestays\nKongmaru La crossing\nMountain desert scenery', 'Leh', 5200, 75, 'Jun to Sep', 'Trekking', 'Walk in the Valley, River, Off Beat Trek', 'Stargazing Treks', 'Arrive in Leh\nRest and acclimatise in Leh\nChilling to Skiu\nSkiu to Markha\nMarkha to Hankar\nHankar to Nimaling\nNimaling to Kongmaru La to Chokdo\nChokdo to Hemis, drive to Leh', 'Stay at camps, guesthouses or teahouses as per the route\nMeals during the trek (vegetarian)\nTrek leader, guides and support staff\nPermits, forest and camping fees\nFirst-aid kit and oxygen cylinder', 'Travel to and from the base point\nPersonal expenses and tips\nTravel and medical insurance\nPorter or mule charges for personal bags\nAnything not listed under inclusions', 'Backpack, 40 to 50 L, with rain cover\nTrekking shoes with good grip\nWarm layers: fleece, down jacket, thermals\nWaterproof jacket and trousers\nCap or sun hat, gloves, sunglasses\nTwo 1-litre water bottles\nTrekking pole (recommended)\nPersonal medicines and sunscreen', 'Add your own cancellation and refund terms here, for example how much is refunded 30, 15 and 7 days before the trek.', NULL, '+ GST', NULL, NULL, NULL, 1, 7, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(9, 5, 'Sandakphu', 'sandakphu', 7, 'Moderate', 'Spring', 'Sunrise over Kanchenjunga and Everest', 'A walk along the Singalila ridge to the highest point in West Bengal, with a view of Everest, Kanchenjunga, Lhotse and Makalu on clear days.', 'Four of the five highest peaks in view\nRhododendron forests in spring\nSunrise on the Sleeping Buddha range', 'Manebhanjan', 3640, 52, 'Mar to May, Oct to Nov', 'Trekking', 'Peaks View, Rhododendron', '', 'NJP to Manebhanjan, trek to Chitrey\nChitrey to Tumling\nTumling to Kalipokhri\nKalipokhri to Sandakphu\nSandakphu to Gurdum\nGurdum to Rimbick\nDrive from Rimbick to NJP', 'Stay at camps, guesthouses or teahouses as per the route\nMeals during the trek (vegetarian)\nTrek leader, guides and support staff\nPermits, forest and camping fees\nFirst-aid kit and oxygen cylinder', 'Travel to and from the base point\nPersonal expenses and tips\nTravel and medical insurance\nPorter or mule charges for personal bags\nAnything not listed under inclusions', 'Backpack, 40 to 50 L, with rain cover\nTrekking shoes with good grip\nWarm layers: fleece, down jacket, thermals\nWaterproof jacket and trousers\nCap or sun hat, gloves, sunglasses\nTwo 1-litre water bottles\nTrekking pole (recommended)\nPersonal medicines and sunscreen', 'Add your own cancellation and refund terms here, for example how much is refunded 30, 15 and 7 days before the trek.', NULL, '+ GST', NULL, NULL, NULL, 1, 8, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(10, 6, 'Goechala', 'goechala', 11, 'Difficult', 'Spring', 'Close views of Kanchenjunga', 'A long trek in Kanchenjunga National Park from Yuksom through rhododendron forest and high meadows to Goechala viewpoint, passing Samiti Lake.', 'Close views of Kanchenjunga\nSamiti Lake\nRhododendron forests and high camps', 'Yuksom', 4940, 90, 'Apr to May, Oct to Nov', 'Trekking', 'Peaks View, Lakes, Rhododendron', '', 'NJP to Yuksom\nYuksom to Sachen\nSachen to Tshoka\nTshoka to Dzongri\nAcclimatisation day at Dzongri\nDzongri to Thansing\nThansing to Lamuney via Samiti Lake\nGoechala viewpoint, descend to Kokchurang\nKokchurang to Tshoka\nTshoka to Yuksom\nDrive from Yuksom to NJP', 'Stay at camps, guesthouses or teahouses as per the route\nMeals during the trek (vegetarian)\nTrek leader, guides and support staff\nPermits, forest and camping fees\nFirst-aid kit and oxygen cylinder', 'Travel to and from the base point\nPersonal expenses and tips\nTravel and medical insurance\nPorter or mule charges for personal bags\nAnything not listed under inclusions', 'Backpack, 40 to 50 L, with rain cover\nTrekking shoes with good grip\nWarm layers: fleece, down jacket, thermals\nWaterproof jacket and trousers\nCap or sun hat, gloves, sunglasses\nTwo 1-litre water bottles\nTrekking pole (recommended)\nPersonal medicines and sunscreen', 'Add your own cancellation and refund terms here, for example how much is refunded 30, 15 and 7 days before the trek.', NULL, '+ GST', NULL, NULL, NULL, 1, 9, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(11, 7, 'Annapurna Base Camp', 'annapurna-base-camp', 9, 'Moderate', 'Autumn', 'Teahouse trek to the sanctuary', 'A teahouse trek into the Annapurna Sanctuary, a high basin ringed by Annapurna I, Machapuchare and Hiunchuli.', 'Annapurna Sanctuary amphitheatre\nGurung villages and rhododendron forest\nComfortable teahouse stays', 'Pokhara', 4130, 110, 'Mar to May, Oct to Nov', 'Trekking', 'Peaks View, Hot Springs, Rhododendron', '', 'Arrive in Pokhara\nDrive to Nayapul, trek to Ghandruk\nGhandruk to Chhomrong\nChhomrong to Dovan\nDovan to Deurali\nDeurali to Annapurna Base Camp\nBase Camp to Bamboo\nBamboo to Jhinu, drive to Pokhara\nPokhara to Kathmandu', 'Stay at camps, guesthouses or teahouses as per the route\nMeals during the trek (vegetarian)\nTrek leader, guides and support staff\nPermits, forest and camping fees\nFirst-aid kit and oxygen cylinder', 'Travel to and from the base point\nPersonal expenses and tips\nTravel and medical insurance\nPorter or mule charges for personal bags\nAnything not listed under inclusions', 'Backpack, 40 to 50 L, with rain cover\nTrekking shoes with good grip\nWarm layers: fleece, down jacket, thermals\nWaterproof jacket and trousers\nCap or sun hat, gloves, sunglasses\nTwo 1-litre water bottles\nTrekking pole (recommended)\nPersonal medicines and sunscreen', 'Add your own cancellation and refund terms here, for example how much is refunded 30, 15 and 7 days before the trek.', NULL, '+ GST', NULL, NULL, NULL, 1, 10, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(12, 7, 'Everest Base Camp', 'everest-base-camp', 13, 'Difficult', 'Autumn', 'Classic route to Everest base camp', 'The classic Khumbu trek through Sherpa villages and Sagarmatha National Park to Everest Base Camp and the Kala Patthar viewpoint.', 'Everest Base Camp and Kala Patthar\nNamche Bazaar and Sherpa culture\nViews of Ama Dablam, Lhotse and Nuptse', 'Kathmandu', 5545, 112, 'Mar to May, Oct to Nov', 'Trekking', 'Peaks View, Glacier', '', 'Arrive in Kathmandu\nFly to Lukla, trek to Phakding\nPhakding to Namche Bazaar\nAcclimatisation day in Namche\nNamche to Tengboche\nTengboche to Dingboche\nRest day at Dingboche\nDingboche to Lobuche\nLobuche to Gorakshep and Everest Base Camp\nKala Patthar, descend to Pangboche\nPangboche to Namche\nNamche to Lukla\nFly to Kathmandu', 'Stay at camps, guesthouses or teahouses as per the route\nMeals during the trek (vegetarian)\nTrek leader, guides and support staff\nPermits, forest and camping fees\nFirst-aid kit and oxygen cylinder', 'Travel to and from the base point\nPersonal expenses and tips\nTravel and medical insurance\nPorter or mule charges for personal bags\nAnything not listed under inclusions', 'Backpack, 40 to 50 L, with rain cover\nTrekking shoes with good grip\nWarm layers: fleece, down jacket, thermals\nWaterproof jacket and trousers\nCap or sun hat, gloves, sunglasses\nTwo 1-litre water bottles\nTrekking pole (recommended)\nPersonal medicines and sunscreen', 'Add your own cancellation and refund terms here, for example how much is refunded 30, 15 and 7 days before the trek.', NULL, '+ GST', NULL, NULL, NULL, 1, 11, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(13, 2, 'Chandratal Lake', 'chandratal-lake', 4, 'Easy to Moderate', 'Summer', 'Clear mountain lake in Spiti', 'A short, scenic trek to the crescent-shaped Chandratal lake in the Spiti region, set in a wide valley of bare mountains.', 'Clear blue lake at 4,300 m\nShort route with big scenery\nCamping by the lake', 'Batal', 4300, 14, 'Jun to Sep', 'Trekking', 'Lakes, Beginner, Couples, Family with kids', 'Family Treks, Stargazing Treks, Summer Camps', 'Drive from Manali to Batal\nBatal to Chandratal\nRest and explore around the lake\nDrive from Chandratal to Manali', 'Stay at camps, guesthouses or teahouses as per the route\nMeals during the trek (vegetarian)\nTrek leader, guides and support staff\nPermits, forest and camping fees\nFirst-aid kit and oxygen cylinder', 'Travel to and from the base point\nPersonal expenses and tips\nTravel and medical insurance\nPorter or mule charges for personal bags\nAnything not listed under inclusions', 'Backpack, 40 to 50 L, with rain cover\nTrekking shoes with good grip\nWarm layers: fleece, down jacket, thermals\nWaterproof jacket and trousers\nCap or sun hat, gloves, sunglasses\nTwo 1-litre water bottles\nTrekking pole (recommended)\nPersonal medicines and sunscreen', 'Add your own cancellation and refund terms here, for example how much is refunded 30, 15 and 7 days before the trek.', NULL, '+ GST', NULL, NULL, NULL, 1, 12, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(14, 1, 'Kedarnath Trek', 'kedarnath-trek', 5, 'Moderate', 'Summer', 'Temple trek below snow peaks', 'A pilgrim trail from Gaurikund to the Kedarnath temple, set at the foot of snow-capped peaks. The route is about 16 km each way.', 'Kedarnath temple below snow peaks\nWalk beside the Mandakini river\nBhairavnath temple viewpoint', 'Gaurikund', 3580, 32, 'May to Jun, Sep to Oct', 'Pilgrimage Tours', 'Peaks View, River', 'Senior Treks', 'Drive from Rishikesh to Guptkashi\nDrive to Gaurikund, trek to Kedarnath\nTemple visit and Bhairavnath walk\nKedarnath to Gaurikund\nDrive from Gaurikund to Rishikesh', 'Stay at camps, guesthouses or teahouses as per the route\nMeals during the trek (vegetarian)\nTrek leader, guides and support staff\nPermits, forest and camping fees\nFirst-aid kit and oxygen cylinder', 'Travel to and from the base point\nPersonal expenses and tips\nTravel and medical insurance\nPorter or mule charges for personal bags\nAnything not listed under inclusions', 'Backpack, 40 to 50 L, with rain cover\nTrekking shoes with good grip\nWarm layers: fleece, down jacket, thermals\nWaterproof jacket and trousers\nCap or sun hat, gloves, sunglasses\nTwo 1-litre water bottles\nTrekking pole (recommended)\nPersonal medicines and sunscreen', 'Add your own cancellation and refund terms here, for example how much is refunded 30, 15 and 7 days before the trek.', NULL, '+ GST', NULL, NULL, NULL, 1, 13, '2026-10-11 05:54:26', '2026-10-11 05:54:26');

-- --------------------------------------------------------

--
-- Table structure for table `trek_images`
--

CREATE TABLE `trek_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trek_id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trek_images`
--

INSERT INTO `trek_images` (`id`, `trek_id`, `path`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 2, 'images/dayara-bugyal-1.jpg', 0, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(2, 3, 'images/brahmatal-1.jpg', 0, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(3, 4, 'images/valley-of-flowers-1.jpg', 0, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(4, 5, 'images/roopkund-1.jpg', 0, '2026-10-11 05:54:25', '2026-10-11 05:54:25'),
(5, 7, 'images/kashmir-great-lakes-1.jpg', 0, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(6, 8, 'images/markha-valley-1.jpg', 0, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(7, 9, 'images/sandakphu-1.jpg', 0, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(8, 10, 'images/goechala-1.jpg', 0, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(9, 11, 'images/annapurna-base-camp-1.jpg', 0, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(10, 12, 'images/everest-base-camp-1.jpg', 0, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(11, 13, 'images/chandratal-lake-1.jpg', 0, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(12, 13, 'images/chandratal-lake-2.jpg', 1, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(13, 14, 'images/kedarnath-trek-1.jpg', 0, '2026-10-11 05:54:26', '2026-10-11 05:54:26'),
(14, 14, 'images/kedarnath-trek-2.jpg', 1, '2026-10-11 05:54:26', '2026-10-11 05:54:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', NULL, '$2y$12$N7AooFVQeIzycIo1vxSOVe4iDALHSSTlsbuJC7OLCSgM6kd7TFo5m', 1, NULL, '2026-10-11 05:54:25', '2026-10-11 05:54:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `departures`
--
ALTER TABLE `departures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departures_trek_id_foreign` (`trek_id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enquiries_user_id_foreign` (`user_id`),
  ADD KEY `enquiries_trek_id_foreign` (`trek_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faqs_faq_category_id_foreign` (`faq_category_id`);

--
-- Indexes for table `faq_categories`
--
ALTER TABLE `faq_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `favorites_user_id_trek_id_unique` (`user_id`,`trek_id`),
  ADD KEY `favorites_trek_id_foreign` (`trek_id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `regions_name_unique` (`name`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_trek_id_foreign` (`trek_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stats`
--
ALTER TABLE `stats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treks`
--
ALTER TABLE `treks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `treks_slug_unique` (`slug`),
  ADD KEY `treks_region_id_foreign` (`region_id`);

--
-- Indexes for table `trek_images`
--
ALTER TABLE `trek_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trek_images_trek_id_foreign` (`trek_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departures`
--
ALTER TABLE `departures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `faq_categories`
--
ALTER TABLE `faq_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stats`
--
ALTER TABLE `stats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `treks`
--
ALTER TABLE `treks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `trek_images`
--
ALTER TABLE `trek_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `departures`
--
ALTER TABLE `departures`
  ADD CONSTRAINT `departures_trek_id_foreign` FOREIGN KEY (`trek_id`) REFERENCES `treks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD CONSTRAINT `enquiries_trek_id_foreign` FOREIGN KEY (`trek_id`) REFERENCES `treks` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `enquiries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `faqs`
--
ALTER TABLE `faqs`
  ADD CONSTRAINT `faqs_faq_category_id_foreign` FOREIGN KEY (`faq_category_id`) REFERENCES `faq_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_trek_id_foreign` FOREIGN KEY (`trek_id`) REFERENCES `treks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_trek_id_foreign` FOREIGN KEY (`trek_id`) REFERENCES `treks` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `treks`
--
ALTER TABLE `treks`
  ADD CONSTRAINT `treks_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trek_images`
--
ALTER TABLE `trek_images`
  ADD CONSTRAINT `trek_images_trek_id_foreign` FOREIGN KEY (`trek_id`) REFERENCES `treks` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
