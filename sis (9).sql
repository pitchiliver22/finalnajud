-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 17, 2024 at 03:32 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sis`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` bigint UNSIGNED NOT NULL,
  `zipcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barangay` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `streetaddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `zipcode`, `province`, `city`, `barangay`, `streetaddress`, `address_id`, `created_at`, `updated_at`, `status`) VALUES
(1, '1234', 'Cambinocot Pitos', 'Cebu City', 'Babag Dos', 'Naga Street', 1, '2024-12-16 17:36:56', '2024-12-16 17:36:56', 'pending'),
(2, '1234', 'Cambinocot Pitos', 'Cebu City', 'Babag Dos', 'Naga Street', 2, '2024-12-16 17:36:56', '2024-12-16 17:36:56', 'pending'),
(3, '1234', 'Cambinocot Pitos', 'Cebu City', 'Babag Dos', 'Naga Street', 3, '2024-12-16 17:36:57', '2024-12-16 17:36:57', 'pending'),
(4, '1234', 'Cambinocot Pitos', 'Cebu City', 'Babag Dos', 'Naga Street', 4, '2024-12-16 17:36:57', '2024-12-16 17:36:57', 'pending'),
(5, '1234', 'Cambinocot Pitos', 'Cebu City', 'Babag Dos', 'Naga Street', 5, '2024-12-16 17:36:57', '2024-12-16 17:36:57', 'pending'),
(6, '1234', 'Cambinocot Pitos', 'Cebu City', 'Babag Dos', 'Naga Street', 6, '2024-12-16 17:36:57', '2024-12-16 17:36:57', 'pending'),
(7, '1234', 'Cambinocot Pitos', 'Cebu City', 'Babag Dos', 'Naga Street', 7, '2024-12-16 17:36:58', '2024-12-16 17:36:58', 'pending'),
(8, '1234', 'Cambinocot Pitos', 'Cebu City', 'Babag Dos', 'Naga Street', 8, '2024-12-16 17:36:58', '2024-12-16 17:36:58', 'pending'),
(9, '1234', 'Cambinocot Pitos', 'Cebu City', 'Babag Dos', 'Naga Street', 9, '2024-12-16 17:36:58', '2024-12-16 17:36:58', 'pending'),
(10, '1234', 'Cambinocot Pitos', 'Cebu City', 'Babag Dos', 'Naga Street', 10, '2024-12-16 17:36:58', '2024-12-16 17:36:58', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `assessment`
--

CREATE TABLE `assessment` (
  `id` bigint UNSIGNED NOT NULL,
  `school_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assessment_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `assessment_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assessment_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assessment_fee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assign`
--

CREATE TABLE `assign` (
  `id` bigint UNSIGNED NOT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adviser` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edpcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startTime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endTime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `days` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_id` bigint UNSIGNED NOT NULL,
  `teacher_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assign`
--

INSERT INTO `assign` (`id`, `grade`, `adviser`, `section`, `edpcode`, `room`, `subject`, `description`, `type`, `unit`, `startTime`, `endTime`, `days`, `status`, `class_id`, `teacher_id`, `created_at`, `updated_at`) VALUES
(1, 'Grade 1', 'John Michael Smith', 'JOY', '11111', '201', 'MOTHER TONGUE', 'ALKD', 'Lec', '2', '07:30', '08:30', 'MWF', 'assigned', 1, 12, '2024-12-16 17:59:03', '2024-12-16 17:59:03'),
(2, 'Grade 1', 'Sarah Anne Johnson', 'JOY', '22222', '202', 'FILIPINO', 'KAJD', 'Lec', '2', '08:30', '09:30', 'MWF', 'assigned', 1, 13, '2024-12-16 17:59:03', '2024-12-16 17:59:03'),
(3, 'Grade 1', 'David Lee Brown', 'JOY', '33333', '203', 'READING', 'ASLKD', 'Lec', '2', '10:30', '11:30', 'MWF', 'assigned', 1, 14, '2024-12-16 17:59:04', '2024-12-16 17:59:04'),
(4, 'Grade 1', 'John Michael Smith', 'JOY', '11111', '201', 'MOTHER TONGUE', 'ALKD', 'Lec', '2', '07:30', '08:30', 'MWF', 'assigned', 2, 12, '2024-12-16 17:59:09', '2024-12-16 17:59:09'),
(5, 'Grade 1', 'Sarah Anne Johnson', 'JOY', '22222', '202', 'FILIPINO', 'KAJD', 'Lec', '2', '08:30', '09:30', 'MWF', 'assigned', 2, 13, '2024-12-16 17:59:09', '2024-12-16 17:59:09'),
(6, 'Grade 1', 'David Lee Brown', 'JOY', '33333', '203', 'READING', 'ASLKD', 'Lec', '2', '10:30', '11:30', 'MWF', 'assigned', 2, 14, '2024-12-16 17:59:09', '2024-12-16 17:59:09'),
(7, 'Grade 1', 'John Michael Smith', 'JOY', '11111', '201', 'MOTHER TONGUE', 'ALKD', 'Lec', '2', '07:30', '08:30', 'MWF', 'assigned', 3, 12, '2024-12-16 17:59:14', '2024-12-16 17:59:14'),
(8, 'Grade 1', 'Sarah Anne Johnson', 'JOY', '22222', '202', 'FILIPINO', 'KAJD', 'Lec', '2', '08:30', '09:30', 'MWF', 'assigned', 3, 13, '2024-12-16 17:59:14', '2024-12-16 17:59:14'),
(9, 'Grade 1', 'David Lee Brown', 'JOY', '33333', '203', 'READING', 'ASLKD', 'Lec', '2', '10:30', '11:30', 'MWF', 'assigned', 3, 14, '2024-12-16 17:59:14', '2024-12-16 17:59:14'),
(10, 'Grade 1', 'John Michael Smith', 'JOY', '11111', '201', 'MOTHER TONGUE', 'ALKD', 'Lec', '2', '07:30', '08:30', 'MWF', 'assigned', 5, 12, '2024-12-16 17:59:19', '2024-12-16 17:59:19'),
(11, 'Grade 1', 'Sarah Anne Johnson', 'JOY', '22222', '202', 'FILIPINO', 'KAJD', 'Lec', '2', '08:30', '09:30', 'MWF', 'assigned', 5, 13, '2024-12-16 17:59:19', '2024-12-16 17:59:19'),
(12, 'Grade 1', 'David Lee Brown', 'JOY', '33333', '203', 'READING', 'ASLKD', 'Lec', '2', '10:30', '11:30', 'MWF', 'assigned', 5, 14, '2024-12-16 17:59:19', '2024-12-16 17:59:19'),
(13, 'Grade 1', 'John Michael Smith', 'JOY', '11111', '201', 'MOTHER TONGUE', 'ALKD', 'Lec', '2', '07:30', '08:30', 'MWF', 'assigned', 6, 12, '2024-12-16 17:59:24', '2024-12-16 17:59:24'),
(14, 'Grade 1', 'Sarah Anne Johnson', 'JOY', '22222', '202', 'FILIPINO', 'KAJD', 'Lec', '2', '08:30', '09:30', 'MWF', 'assigned', 6, 13, '2024-12-16 17:59:24', '2024-12-16 17:59:24'),
(15, 'Grade 1', 'David Lee Brown', 'JOY', '33333', '203', 'READING', 'ASLKD', 'Lec', '2', '10:30', '11:30', 'MWF', 'assigned', 6, 14, '2024-12-16 17:59:24', '2024-12-16 17:59:24');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` bigint UNSIGNED NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edp_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `1st_quarter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `2nd_quarter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `3rd_quarter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `4th_quarter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `overall_attendance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `attendance_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint UNSIGNED NOT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adviser` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edpcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startTime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endTime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `days` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assign_id` bigint UNSIGNED DEFAULT NULL,
  `teacher_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `grade`, `adviser`, `section`, `edpcode`, `room`, `subject`, `description`, `type`, `unit`, `startTime`, `endTime`, `days`, `status`, `assign_id`, `teacher_id`, `created_at`, `updated_at`) VALUES
(1, 'Grade 1', 'John Michael Smith', 'JOY', '11111', '201', 'MOTHER TONGUE', 'ALKD', 'Lec', '2', '07:30', '08:30', 'MWF', 'assigned', 6, 12, '2024-12-16 17:58:10', '2024-12-16 17:59:24'),
(2, 'Grade 1', 'Sarah Anne Johnson', 'JOY', '22222', '202', 'FILIPINO', 'KAJD', 'Lec', '2', '08:30', '09:30', 'MWF', 'assigned', 6, 13, '2024-12-16 17:58:22', '2024-12-16 17:59:24'),
(3, 'Grade 1', 'David Lee Brown', 'JOY', '33333', '203', 'READING', 'ASLKD', 'Lec', '2', '10:30', '11:30', 'MWF', 'assigned', 6, 14, '2024-12-16 17:58:33', '2024-12-16 17:59:24');

-- --------------------------------------------------------

--
-- Table structure for table `core_values`
--

CREATE TABLE `core_values` (
  `id` bigint UNSIGNED NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `respect` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excellence` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teamwork` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `innovation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sustainability` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `core_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `id` bigint UNSIGNED NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edp_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `1st_quarter` decimal(5,2) DEFAULT NULL,
  `2nd_quarter` decimal(5,2) DEFAULT NULL,
  `3rd_quarter` decimal(5,2) DEFAULT NULL,
  `4th_quarter` decimal(5,2) DEFAULT NULL,
  `overall_grade` decimal(5,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `fullname`, `section`, `edp_code`, `subject`, `1st_quarter`, `2nd_quarter`, `3rd_quarter`, `4th_quarter`, `overall_grade`, `status`, `grade_id`, `created_at`, `updated_at`) VALUES
(1, 'Oliver Mandal Pacatang', 'JOY', '11111', 'Default Subject', '0.00', '0.00', '0.00', '0.00', '0.00', 'pending', 1, '2024-12-16 19:17:59', '2024-12-16 19:17:59');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2024_11_07_150306_create_register_form_table', 1),
(3, '2024_11_07_150348_create_studentdetails_table', 1),
(4, '2024_11_07_150607_create_payment_form_table', 1),
(5, '2024_11_07_150656_create_classes_table', 1),
(6, '2024_11_07_150730_create_assessment_table', 1),
(7, '2024_11_07_150804_create_grade_table', 1),
(8, '2024_11_07_150830_create_attendance_table', 1),
(9, '2024_11_07_150855_create_core_values', 1),
(10, '2024_11_07_150922_create_address_table', 1),
(11, '2024_11_07_150947_create_previous_school_table', 1),
(12, '2024_11_07_151022_create_required_documents', 1),
(13, '2024_11_07_151046_create_assign_table', 1),
(14, '2024_11_07_151112_create_profile_picture', 1),
(15, '2024_11_07_151129_create_teachers_table', 1),
(16, '2024_11_07_151150_create_section_table', 1),
(17, '2024_11_10_180753_create_section_schedules_table', 1),
(18, '2024_11_17_173129_create_quarter_settings_table', 1),
(19, '2024_11_18_065750_add_quarter_status_to_quarter_settings_table', 1),
(20, '2024_11_20_160417_add_unique_constraint_to_grades_table', 1),
(21, '2024_11_20_162458_update_quarter_columns_in_grades_table', 1),
(22, '2024_11_28_195449_update_core_values_table', 1),
(23, '2024_11_29_135749_update_attendance_table', 1),
(24, '2024_12_13_141703_add_user_id_to_teachers_table', 1),
(25, '2024_12_15_075409_add_attendance_columns_to_attendance_table', 1),
(26, '2024_12_15_080647_remove_quarter_columns_from_attendance_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_form`
--

CREATE TABLE `payment_form` (
  `id` bigint UNSIGNED NOT NULL,
  `fee_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_proof` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_form`
--

INSERT INTO `payment_form` (`id`, `fee_type`, `amount`, `level`, `payment_proof`, `payment_details`, `payment_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Enrollment Fee', '500', 'Grade 1', 'payment_proofs/L03MxKpPU9o2cmGlPd4thNiZ4PP7lvsLHAUVD2UJ.png', 'asdkl', 1, 'approved', '2024-12-16 17:39:49', '2024-12-16 17:55:20'),
(2, 'Enrollment Fee', '500', 'Grade 1', 'payment_proofs/Uw3dGz5FnERuDUdyxexx5Yb4TdLvLIkx4HYzOEtd.png', 'asdl', 2, 'approved', '2024-12-16 17:53:36', '2024-12-16 17:55:20'),
(3, 'Enrollment Fee', '500', 'Grade 1', 'payment_proofs/hpUzPjw66gHzoE4WEAf0cbEyPxS2UfzkMLoJSfOr.png', 'asd;lk', 3, 'approved', '2024-12-16 17:54:01', '2024-12-16 17:55:20'),
(4, 'Enrollment Fee', '500', 'Grade 1', 'payment_proofs/o2HII3o5urCnJpcUHP2NPzCtjdElgQ9AV9Df1h0m.png', 'alksdakljd', 5, 'approved', '2024-12-16 17:54:32', '2024-12-16 17:55:20'),
(5, 'Enrollment Fee', '500', 'Grade 1', 'payment_proofs/QisYPOTpe9iIcrGF8OwJ1RRtzX4L14QallqM4KIX.jpg', 'salkd', 6, 'approved', '2024-12-16 17:54:57', '2024-12-16 17:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `previous_school`
--

CREATE TABLE `previous_school` (
  `id` bigint UNSIGNED NOT NULL,
  `second_school_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_last_year_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_school_year_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_school_year_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_school_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primary_school_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primary_last_year_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primary_school_year_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primary_school_year_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primary_school_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `previous_school`
--

INSERT INTO `previous_school` (`id`, `second_school_name`, `second_last_year_level`, `second_school_year_from`, `second_school_year_to`, `second_school_type`, `primary_school_name`, `primary_last_year_level`, `primary_school_year_from`, `primary_school_year_to`, `primary_school_type`, `school_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'University of Cebu Lapu Lapu and Mandaue', '7', '2021', '2022', 'Private', 'University of Cebu Lapu Lapu and Mandaue', '1', '2018', '2019', 'Private', 1, 'pending', '2024-12-16 17:36:56', '2024-12-16 17:36:56'),
(2, 'University of Cebu Lapu Lapu and Mandaue', '8', '2021', '2022', 'Private', 'University of Cebu Lapu Lapu and Mandaue', '2', '2018', '2019', 'Private', 2, 'pending', '2024-12-16 17:36:56', '2024-12-16 17:36:56'),
(3, 'University of Cebu Lapu Lapu and Mandaue', '9', '2021', '2022', 'Private', 'University of Cebu Lapu Lapu and Mandaue', '3', '2018', '2019', 'Private', 3, 'pending', '2024-12-16 17:36:57', '2024-12-16 17:36:57'),
(4, 'University of Cebu Lapu Lapu and Mandaue', '7', '2021', '2022', 'Private', 'University of Cebu Lapu Lapu and Mandaue', '4', '2018', '2019', 'Private', 4, 'pending', '2024-12-16 17:36:57', '2024-12-16 17:36:57'),
(5, 'University of Cebu Lapu Lapu and Mandaue', '8', '2021', '2022', 'Private', 'University of Cebu Lapu Lapu and Mandaue', '5', '2018', '2019', 'Private', 5, 'pending', '2024-12-16 17:36:57', '2024-12-16 17:36:57'),
(6, 'University of Cebu Lapu Lapu and Mandaue', '9', '2021', '2022', 'Private', 'University of Cebu Lapu Lapu and Mandaue', '6', '2018', '2019', 'Private', 6, 'pending', '2024-12-16 17:36:57', '2024-12-16 17:36:57'),
(7, 'University of Cebu Lapu Lapu and Mandaue', '7', '2021', '2022', 'Private', 'University of Cebu Lapu Lapu and Mandaue', '1', '2018', '2019', 'Private', 7, 'pending', '2024-12-16 17:36:58', '2024-12-16 17:36:58'),
(8, 'University of Cebu Lapu Lapu and Mandaue', '8', '2021', '2022', 'Private', 'University of Cebu Lapu Lapu and Mandaue', '2', '2018', '2019', 'Private', 8, 'pending', '2024-12-16 17:36:58', '2024-12-16 17:36:58'),
(9, 'University of Cebu Lapu Lapu and Mandaue', '9', '2021', '2022', 'Private', 'University of Cebu Lapu Lapu and Mandaue', '3', '2018', '2019', 'Private', 9, 'pending', '2024-12-16 17:36:58', '2024-12-16 17:36:58'),
(10, 'University of Cebu Lapu Lapu and Mandaue', '7', '2021', '2022', 'Private', 'University of Cebu Lapu Lapu and Mandaue', '4', '2018', '2019', 'Private', 10, 'pending', '2024-12-16 17:36:58', '2024-12-16 17:36:58');

-- --------------------------------------------------------

--
-- Table structure for table `profile_picture`
--

CREATE TABLE `profile_picture` (
  `id` bigint UNSIGNED NOT NULL,
  `profilepicture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quarter_settings`
--

CREATE TABLE `quarter_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `first_quarter_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `second_quarter_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `third_quarter_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `fourth_quarter_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `quarter_status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quarter_settings`
--

INSERT INTO `quarter_settings` (`id`, `first_quarter_enabled`, `second_quarter_enabled`, `third_quarter_enabled`, `fourth_quarter_enabled`, `quarter_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 0, 'active', '2024-12-16 18:04:52', '2024-12-16 18:04:52');

-- --------------------------------------------------------

--
-- Table structure for table `register_form`
--

CREATE TABLE `register_form` (
  `id` bigint UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suffix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `register_form`
--

INSERT INTO `register_form` (`id`, `firstname`, `lastname`, `middlename`, `suffix`, `email`, `password`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Oliver', 'Pacatang', 'Mandal', 'NA', 'oliver@gmail.com', '$2y$12$3fE8IZB7dHEHfXZAF70g9uqfwQRI52zjHQmBTl9Se1iXRUqiZ/wf6', 'approved', 2, '2024-12-16 17:36:56', '2024-12-16 17:36:56'),
(2, 'JohnRhay', 'Batan', 'Sequina', 'NA', 'test1@gmail.com', '$2y$12$8x./yuUphsSqi8OrFcy.5O4eXSomF9HsdEXgv3MNuFtqnSfs2xozq', 'approved', 3, '2024-12-16 17:36:56', '2024-12-16 17:36:56'),
(3, 'Moises', 'Belocura', 'Bel', 'Jr', 'test2@gmail.com', '$2y$12$18b1IMMo/xJum8QUjatYl.tOFlA6a2Hl5qgLai168WojOdjkN2OFW', 'approved', 4, '2024-12-16 17:36:57', '2024-12-16 17:36:57'),
(4, 'Mary', 'Dungog', 'Claire', 'NA', 'test3@gmail.com', '$2y$12$lQCw5A5mH1fpFUuh8X8o6Oc/Lnx/8yrzgkH50MAYi4jkd86bpcHUO', 'approved', 5, '2024-12-16 17:36:57', '2024-12-16 17:36:57'),
(5, 'Bernie', 'Lambo', 'Car', 'NA', 'test4@gmail.com', '$2y$12$YHK8UpRfIOGsCGSHqGJdt.Ngbq8gEOKcnfJayCDfk2qqadCF4hwWO', 'approved', 6, '2024-12-16 17:36:57', '2024-12-16 17:36:57'),
(6, 'John', 'Doe', 'Smith', 'Jr', 'test5@gmail.com', '$2y$12$9GfuFOLFdc7aO9woM.JFuOKAeBV6HPQ.aa9rlWo/cHEiCYI0AQVAu', 'approved', 7, '2024-12-16 17:36:57', '2024-12-16 17:36:57'),
(7, 'Jane', 'Lapil', 'Pil', 'Sr', 'test6@gmail.com', '$2y$12$DEiJunZh4oENRLItJS4IEeSCVSvgd99JEdiTxigT6RRmP6uHV1Pzm', 'approved', 8, '2024-12-16 17:36:58', '2024-12-16 17:36:58'),
(8, 'Bumble', 'Bots', 'Bee', 'NA', 'test7@gmail.com', '$2y$12$QJwjUCnVYts83dqGGUEdqeweFwd62UByu5VSeNY4vYDdEhC61dhFK', 'approved', 9, '2024-12-16 17:36:58', '2024-12-16 17:36:58'),
(9, 'Optimus', 'Bots', 'Prime', 'NA', 'test8@gmail.com', '$2y$12$4.iknpXGJW8/N3YsNzuL8eGVNhoqBKXlXxP2uN7GfMqCmnLDYb1OW', 'approved', 10, '2024-12-16 17:36:58', '2024-12-16 17:36:58'),
(10, 'Lucas', 'Reed', 'James', 'NA', 'test9@gmail.com', '$2y$12$GKjtm10iGw1xvLtAX5mlM.g4hn4hiO31t20JXKvph/SM/ewBuqpzm', 'approved', 11, '2024-12-16 17:36:58', '2024-12-16 17:36:58');

-- --------------------------------------------------------

--
-- Table structure for table `required_documents`
--

CREATE TABLE `required_documents` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `documents` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` bigint UNSIGNED NOT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `grade`, `section`, `created_at`, `updated_at`) VALUES
(1, 'Grade 1', 'Joy', '2024-12-16 17:57:17', '2024-12-16 17:57:17');

-- --------------------------------------------------------

--
-- Table structure for table `section_schedules`
--

CREATE TABLE `section_schedules` (
  `id` bigint UNSIGNED NOT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adviser` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edpcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `days` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('a0QESzjvAcHvXda6hRgLZwB2EjuMBGGJssvvwReQ', 12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVXFnWjZSU01pbWtKRUE4c0FaN1M5d1BYdVJkVGY0THRCM3FkRnZCYiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0MjoiaHR0cHM6Ly9jYXBzdG9uZS50ZXN0L2dyYWRlc3VibWl0LzExMTExLzEyIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTI7fQ==', 1734405479);

-- --------------------------------------------------------

--
-- Table structure for table `studentdetails`
--

CREATE TABLE `studentdetails` (
  `id` bigint UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suffix` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `civilstatus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthplace` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_occupation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_occupation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_occupation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `studentdetails`
--

INSERT INTO `studentdetails` (`id`, `firstname`, `middlename`, `lastname`, `suffix`, `nationality`, `gender`, `civilstatus`, `birthdate`, `birthplace`, `religion`, `mother_name`, `mother_occupation`, `mother_contact`, `father_name`, `father_occupation`, `father_contact`, `guardian_name`, `guardian_occupation`, `guardian_contact`, `details_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Oliver', 'Mandal', 'Pacatang', 'NA', 'Filipino', 'Male', 'Single', '2002-12-25', 'Lapu Lapu City', 'Catholic', 'Loila Dismukes', 'Teacher', '9912345678', 'Jay Tintahar', 'Seaman', '9912345678', 'Loila Dismukes', 'Teacher', '9912345678', 1, 'pending', '2024-12-16 17:36:56', '2024-12-16 17:36:56'),
(2, 'JohnRhay', 'Sequina', 'Batan', 'NA', 'Filipino', 'Male', 'Single', '2002-12-26', 'Lapu Lapu City', 'Catholic', 'Ritchel Lunario', 'Sales Manager', '9912345678', 'John Batan', 'Seaman', '9912345678', 'Ritchel Lunario', 'Sales Manager', '9912345678', 2, 'pending', '2024-12-16 17:36:56', '2024-12-16 17:36:56'),
(3, 'Moises', 'Bel', 'Belocura', 'Jr', 'Filipino', 'Male', 'Single', '2002-12-27', 'Lapu Lapu City', 'Catholic', 'Jela Belocura', 'Flight Stewardess', '9912345678', 'Moises Belocura', 'Seaman', '9912345678', 'Jela Belocura', 'Flight Stewardess', '9912345678', 3, 'pending', '2024-12-16 17:36:57', '2024-12-16 17:36:57'),
(4, 'Mary', 'Claire', 'Dungog', 'NA', 'Filipino', 'Female', 'Single', '2002-12-28', 'Lapu Lapu City', 'Catholic', 'Christy Dungog', 'BDO CEO', '9912345678', 'Mary Dungog', 'Seaman', '9912345678', 'Christy Dungog', 'BDO CEO', '9912345678', 4, 'pending', '2024-12-16 17:36:57', '2024-12-16 17:36:57'),
(5, 'Bernie', 'Car', 'Lambo', 'NA', 'Filipino', 'Male', 'Single', '2002-12-29', 'Lapu Lapu City', 'Catholic', 'Jonella Lambo', 'Lamborghini CEO', '9912345678', 'Bernie Lambo', 'Seaman', '9912345678', 'Jonella Lambo', 'Lamborghini CEO', '9912345678', 5, 'pending', '2024-12-16 17:36:57', '2024-12-16 17:36:57'),
(6, 'John', 'Smith', 'Doe', 'Jr', 'Filipino', 'Male', 'Single', '2002-12-30', 'Lapu Lapu City', 'Catholic', 'Janna Doe', 'Astronaut', '9912345678', 'Skusta Lapil', 'Seaman', '9912345678', 'Janna Doe', 'Astronaut', '9912345678', 6, 'pending', '2024-12-16 17:36:57', '2024-12-16 17:36:57'),
(7, 'Jane', 'Pil', 'Lapil', 'Sr', 'Filipino', 'Female', 'Single', '2002-12-31', 'Lapu Lapu City', 'Catholic', 'Jelane Lapil', 'Astronaut', '9912345678', 'Skusta Lapil', 'Seaman', '9912345678', 'Jelane Lapil', 'Astronaut', '9912345678', 7, 'pending', '2024-12-16 17:36:58', '2024-12-16 17:36:58'),
(8, 'Bumble', 'Bee', 'Bots', 'NA', 'Filipino', 'Male', 'Single', '2003-01-01', 'Lapu Lapu City', 'Catholic', 'Bee Bots', 'Astronaut', '9912345678', 'Skusta Lapil', 'Seaman', '9912345678', 'Bee Bots', 'Astronaut', '9912345678', 8, 'pending', '2024-12-16 17:36:58', '2024-12-16 17:36:58'),
(9, 'Optimus', 'Prime', 'Bots', 'NA', 'Filipino', 'Male', 'Single', '2003-01-02', 'Lapu Lapu City', 'Catholic', 'Bee Bots', 'Astronaut', '9912345678', 'Skusta Lapil', 'Seaman', '9912345678', 'Bee Bots', 'Astronaut', '9912345678', 9, 'pending', '2024-12-16 17:36:58', '2024-12-16 17:36:58'),
(10, 'Lucas', 'James', 'Reed', 'NA', 'Filipino', 'Male', 'Single', '2003-01-03', 'Lapu Lapu City', 'Catholic', 'Nats Reed', 'Astronaut', '9912345678', 'Skusta Lapil', 'Seaman', '9912345678', 'Nats Reed', 'Astronaut', '9912345678', 10, 'pending', '2024-12-16 17:36:58', '2024-12-16 17:36:58');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `grade`, `subject`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'John Michael Smith', 'Grade 1', 'Mother tongue', 12, '2024-12-16 17:57:33', '2024-12-16 17:57:33'),
(2, 'Sarah Anne Johnson', 'Grade 1', 'Filipino', 13, '2024-12-16 17:57:42', '2024-12-16 17:57:42'),
(3, 'David Lee Brown', 'Grade 1', 'Reading', 14, '2024-12-16 17:57:51', '2024-12-16 17:57:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suffix` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `middlename`, `suffix`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin', 'NA', 'Admin', 'admin@admin.com', NULL, '$2y$12$Uy0Gi0ISDysGEuNEUGQsz.bkYju/1V5cR0H.is/pGBoyxz2dF8mzu', NULL, '2024-12-16 17:36:26', '2024-12-16 17:36:26'),
(2, 'Oliver', 'Pacatang', 'Mandal', 'NA', 'OldStudent', 'oliver@gmail.com', NULL, '$2y$12$3fE8IZB7dHEHfXZAF70g9uqfwQRI52zjHQmBTl9Se1iXRUqiZ/wf6', NULL, '2024-12-16 17:36:56', '2024-12-16 17:36:56'),
(3, 'JohnRhay', 'Batan', 'Sequina', 'NA', 'OldStudent', 'test1@gmail.com', NULL, '$2y$12$8x./yuUphsSqi8OrFcy.5O4eXSomF9HsdEXgv3MNuFtqnSfs2xozq', NULL, '2024-12-16 17:36:56', '2024-12-16 17:36:56'),
(4, 'Moises', 'Belocura', 'Bel', 'Jr', 'OldStudent', 'test2@gmail.com', NULL, '$2y$12$18b1IMMo/xJum8QUjatYl.tOFlA6a2Hl5qgLai168WojOdjkN2OFW', NULL, '2024-12-16 17:36:57', '2024-12-16 17:36:57'),
(5, 'Mary', 'Dungog', 'Claire', 'NA', 'OldStudent', 'test3@gmail.com', NULL, '$2y$12$lQCw5A5mH1fpFUuh8X8o6Oc/Lnx/8yrzgkH50MAYi4jkd86bpcHUO', NULL, '2024-12-16 17:36:57', '2024-12-16 17:36:57'),
(6, 'Bernie', 'Lambo', 'Car', 'NA', 'OldStudent', 'test4@gmail.com', NULL, '$2y$12$YHK8UpRfIOGsCGSHqGJdt.Ngbq8gEOKcnfJayCDfk2qqadCF4hwWO', NULL, '2024-12-16 17:36:57', '2024-12-16 17:36:57'),
(7, 'John', 'Doe', 'Smith', 'Jr', 'OldStudent', 'test5@gmail.com', NULL, '$2y$12$9GfuFOLFdc7aO9woM.JFuOKAeBV6HPQ.aa9rlWo/cHEiCYI0AQVAu', NULL, '2024-12-16 17:36:57', '2024-12-16 17:36:57'),
(8, 'Jane', 'Lapil', 'Pil', 'Sr', 'OldStudent', 'test6@gmail.com', NULL, '$2y$12$DEiJunZh4oENRLItJS4IEeSCVSvgd99JEdiTxigT6RRmP6uHV1Pzm', NULL, '2024-12-16 17:36:58', '2024-12-16 17:36:58'),
(9, 'Bumble', 'Bots', 'Bee', 'NA', 'OldStudent', 'test7@gmail.com', NULL, '$2y$12$QJwjUCnVYts83dqGGUEdqeweFwd62UByu5VSeNY4vYDdEhC61dhFK', NULL, '2024-12-16 17:36:58', '2024-12-16 17:36:58'),
(10, 'Optimus', 'Bots', 'Prime', 'NA', 'OldStudent', 'test8@gmail.com', NULL, '$2y$12$4.iknpXGJW8/N3YsNzuL8eGVNhoqBKXlXxP2uN7GfMqCmnLDYb1OW', NULL, '2024-12-16 17:36:58', '2024-12-16 17:36:58'),
(11, 'Lucas', 'Reed', 'James', 'NA', 'OldStudent', 'test9@gmail.com', NULL, '$2y$12$GKjtm10iGw1xvLtAX5mlM.g4hn4hiO31t20JXKvph/SM/ewBuqpzm', NULL, '2024-12-16 17:36:58', '2024-12-16 17:36:58'),
(12, 'John', 'Smith', 'Michael', 'Jr', 'Teacher', 'johnsmith@gmail.com', NULL, '$2y$12$0dCbTrLv96nrhZbtBZxlOOumZGNP6N9ClDWKKFzQAh62SAptHV5K.', NULL, '2024-12-16 17:37:06', '2024-12-16 17:37:06'),
(13, 'Sarah', 'Johnson', 'Anne', 'JNA', 'Teacher', 'sarahjohnson@gmail.com', NULL, '$2y$12$tImij0yKqW2C7onTquM3t.z2XeRRVy0GSTluez0Icffy9jTmwGarS', NULL, '2024-12-16 17:37:06', '2024-12-16 17:37:06'),
(14, 'David', 'Brown', 'Lee', 'Sr', 'Teacher', 'davidbrown@gmail.com', NULL, '$2y$12$TtEdAQO3KZ63RtA5GRCCEeORcFxP89z82eSzgm1gE9KTdA39MCEiW', NULL, '2024-12-16 17:37:06', '2024-12-16 17:37:06'),
(15, 'Emily', 'Davis', 'Rose', 'NA', 'Teacher', 'emilyrose@gmail.com', NULL, '$2y$12$rNXbZTH.OUSHVLkrXP6FUOxU2lgnXRMoidcxXmPLcpQ/quEdE7Bi.', NULL, '2024-12-16 17:37:07', '2024-12-16 17:37:07'),
(16, 'Michael', 'Garcia', 'James', 'Na', 'Teacher', 'michaelgarcia@gmail.com', NULL, '$2y$12$/elfDaYzFBWG3QuLItGNcufNcjuboGZdOnQbmVdPm9EbYG6O2mNBm', NULL, '2024-12-16 17:37:07', '2024-12-16 17:37:07'),
(17, 'Jessica', 'Martinez', 'Marie', 'II', 'Teacher', 'jessicamartinez@gmail.com', NULL, '$2y$12$uGlHUPnfc7U56vZhk7Ddx.jH6RXFtGW5gsoQHJ7VXwYKuuyKLoZiC', NULL, '2024-12-16 17:37:07', '2024-12-16 17:37:07'),
(18, 'Robert', 'Wilson', 'William', 'Jr', 'Teacher', 'robertwilson@gmail.com', NULL, '$2y$12$sSCMWh88R3xuaDy1.5hMmejPUwSaylfNNJm.//EQEsoiC.p5/aKSS', NULL, '2024-12-16 17:37:07', '2024-12-16 17:37:07'),
(19, 'Laura', 'Anderson', 'Elizabeth', 'Jr', 'Teacher', 'lauraelizabeth@gmail.com', NULL, '$2y$12$jDwelwTYbftVkJERbn6AIur/Pils5a.FlY10vZcz1Tuj1IQ6r/HoW', NULL, '2024-12-16 17:37:08', '2024-12-16 17:37:08'),
(20, 'Richard', 'Taylor', 'Thomas', 'Jr', 'Teacher', 'richardtaylor@gmail.com', NULL, '$2y$12$ugZ6IRMs23tPvmP/VDPPUuuL77aLTZDc/9cLh5gm1vjioGLt.x9Ly', NULL, '2024-12-16 17:37:08', '2024-12-16 17:37:08'),
(21, 'Karen', 'Thomas', 'Louise', 'Sr', 'Teacher', 'karenthomas@gmail.com', NULL, '$2y$12$XWIXH1bx3HxmMxB8aQeK5ubOXGaCSgwYDckoFfWLfUXJhVxVlxZ.S', NULL, '2024-12-16 17:37:08', '2024-12-16 17:37:08'),
(22, 'Alice', 'Johnson', 'Marie', 'NA', 'Accounting', 'accounting@gmail.com', NULL, '$2y$12$Opw1khzAUf7hpRTDtABscOFhdh/TObPAWHXfp4qUla7YUMDPxAKxm', NULL, '2024-12-16 17:37:09', '2024-12-16 17:37:09'),
(23, 'Brian', 'Smith', 'David', 'Jr', 'Cashier', 'cashier@gmail.com', NULL, '$2y$12$Mbeabz8PjyDID06XlEtIV.RgMGJwDvwGovP4f3zKwkR8KhD0ens8K', NULL, '2024-12-16 17:37:09', '2024-12-16 17:37:09'),
(24, 'Clara', 'Thompson', 'Louise', 'Sr', 'Record', 'record@gmail.com', NULL, '$2y$12$L2foUpDhmHCMsKZqnfH/uua78paqZKpc2Co30ccMMG8SLwYw1KWxC', NULL, '2024-12-16 17:37:09', '2024-12-16 17:37:09'),
(25, 'Elizabeth', 'Carter', 'Anne', 'NA', 'Principal', 'principal@gmail.com', NULL, '$2y$12$UemQzTZoowwU2ij8.NT0pu3Rh/yXWCZg8sbeVjBJl1gFfohb4uc3O', NULL, '2024-12-16 17:37:09', '2024-12-16 17:37:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address_address_id_foreign` (`address_id`);

--
-- Indexes for table `assessment`
--
ALTER TABLE `assessment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign`
--
ALTER TABLE `assign`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assign_class_id_foreign` (`class_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_attendance_id_foreign` (`attendance_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `core_values`
--
ALTER TABLE `core_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `core_values_core_id_foreign` (`core_id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `grade_edp_code_subject_grade_id_unique` (`edp_code`,`subject`,`grade_id`),
  ADD KEY `grade_grade_id_foreign` (`grade_id`);

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
-- Indexes for table `payment_form`
--
ALTER TABLE `payment_form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_form_payment_id_foreign` (`payment_id`);

--
-- Indexes for table `previous_school`
--
ALTER TABLE `previous_school`
  ADD PRIMARY KEY (`id`),
  ADD KEY `previous_school_school_id_foreign` (`school_id`);

--
-- Indexes for table `profile_picture`
--
ALTER TABLE `profile_picture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quarter_settings`
--
ALTER TABLE `quarter_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register_form`
--
ALTER TABLE `register_form`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `register_form_email_unique` (`email`),
  ADD KEY `register_form_user_id_foreign` (`user_id`);

--
-- Indexes for table `required_documents`
--
ALTER TABLE `required_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `required_documents_required_id_foreign` (`required_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section_schedules`
--
ALTER TABLE `section_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `studentdetails`
--
ALTER TABLE `studentdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentdetails_details_id_foreign` (`details_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teachers_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `assessment`
--
ALTER TABLE `assessment`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assign`
--
ALTER TABLE `assign`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `core_values`
--
ALTER TABLE `core_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `payment_form`
--
ALTER TABLE `payment_form`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `previous_school`
--
ALTER TABLE `previous_school`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `profile_picture`
--
ALTER TABLE `profile_picture`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quarter_settings`
--
ALTER TABLE `quarter_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `register_form`
--
ALTER TABLE `register_form`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `required_documents`
--
ALTER TABLE `required_documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `section_schedules`
--
ALTER TABLE `section_schedules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studentdetails`
--
ALTER TABLE `studentdetails`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `register_form` (`id`);

--
-- Constraints for table `assign`
--
ALTER TABLE `assign`
  ADD CONSTRAINT `assign_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `payment_form` (`payment_id`);

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_attendance_id_foreign` FOREIGN KEY (`attendance_id`) REFERENCES `assign` (`class_id`) ON DELETE CASCADE;

--
-- Constraints for table `core_values`
--
ALTER TABLE `core_values`
  ADD CONSTRAINT `core_values_core_id_foreign` FOREIGN KEY (`core_id`) REFERENCES `assign` (`class_id`) ON DELETE CASCADE;

--
-- Constraints for table `grade`
--
ALTER TABLE `grade`
  ADD CONSTRAINT `grade_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `payment_form` (`payment_id`);

--
-- Constraints for table `payment_form`
--
ALTER TABLE `payment_form`
  ADD CONSTRAINT `payment_form_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `register_form` (`id`);

--
-- Constraints for table `previous_school`
--
ALTER TABLE `previous_school`
  ADD CONSTRAINT `previous_school_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `register_form` (`id`);

--
-- Constraints for table `register_form`
--
ALTER TABLE `register_form`
  ADD CONSTRAINT `register_form_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `required_documents`
--
ALTER TABLE `required_documents`
  ADD CONSTRAINT `required_documents_required_id_foreign` FOREIGN KEY (`required_id`) REFERENCES `register_form` (`id`);

--
-- Constraints for table `studentdetails`
--
ALTER TABLE `studentdetails`
  ADD CONSTRAINT `studentdetails_details_id_foreign` FOREIGN KEY (`details_id`) REFERENCES `register_form` (`id`);

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
