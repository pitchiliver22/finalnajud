-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 10:03 AM
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
-- Database: `sis`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `streetaddress` varchar(255) NOT NULL,
  `address_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `zipcode`, `province`, `city`, `barangay`, `streetaddress`, `address_id`, `created_at`, `updated_at`) VALUES
(1, '6014', 'Cebu', 'Lapu Lapu CIty', 'Gun-ob', 'Lapu Lapu St', 1, '2024-10-06 23:38:16', '2024-10-06 23:38:16');

-- --------------------------------------------------------

--
-- Table structure for table `assessment`
--

CREATE TABLE `assessment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `grade_level` varchar(255) NOT NULL,
  `assessment_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `assessment_date` varchar(255) NOT NULL,
  `assessmen_time` varchar(255) NOT NULL,
  `assessment_fee` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `edp_code` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `1st_quarter` varchar(255) NOT NULL,
  `2nd_quarter` varchar(255) NOT NULL,
  `3rd_quarter` varchar(255) NOT NULL,
  `4th_quarter` varchar(255) NOT NULL,
  `overall_attendance` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `grade` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `edpcode` varchar(255) NOT NULL,
  `room` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `days` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `code_values`
--

CREATE TABLE `code_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `respect` varchar(255) NOT NULL,
  `excellence` varchar(255) NOT NULL,
  `teamwork` varchar(255) NOT NULL,
  `innovation` varchar(255) NOT NULL,
  `sustainability` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `edp_code` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `1st_quarter` decimal(5,2) NOT NULL,
  `2nd_quarter` decimal(5,2) NOT NULL,
  `3rd_quarter` decimal(5,2) NOT NULL,
  `4th_quarter` decimal(5,2) NOT NULL,
  `overall_grade` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(2, '2024_08_07_085723_create_studentdetails_table', 1),
(3, '2024_08_07_094757_create_register_form_table', 1),
(4, '2024_08_07_094811_create_payment_form_table', 1),
(5, '2024_08_08_141849_create_classes_table', 1),
(6, '2024_08_08_142610_create_assessment_table', 1),
(7, '2024_08_08_143522_create_school_year_table', 1),
(8, '2024_08_08_144845_create_grade_table', 1),
(9, '2024_08_08_144851_create_attendance_table', 1),
(10, '2024_08_08_144900_create_code_values_table', 1),
(11, '2024_08_27_132506_create_address_table', 1),
(12, '2024_09_26_140709_create_previous_school_table', 1),
(13, '2024_09_26_150358_create_required_documents__table', 1);

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
-- Table structure for table `payment_form`
--

CREATE TABLE `payment_form` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fee_type` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `payment_proof` varchar(255) NOT NULL,
  `payment_details` text NOT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_form`
--

INSERT INTO `payment_form` (`id`, `fee_type`, `amount`, `payment_proof`, `payment_details`, `payment_id`, `created_at`, `updated_at`) VALUES
(1, 'Enrollment Fee', '500', 'payment_proofs/LXc78P7kldJNXjDuAFqwqm7TF9dlsW04x7pOKj4M.jpg', 'dadsa', 1, '2024-10-06 23:41:12', '2024-10-06 23:41:12');

-- --------------------------------------------------------

--
-- Table structure for table `previous_school`
--

CREATE TABLE `previous_school` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `second_school_name` varchar(255) NOT NULL,
  `second_last_strand` varchar(255) NOT NULL,
  `second_last_year_level` varchar(255) NOT NULL,
  `second_school_year_from` varchar(255) NOT NULL,
  `second_school_year_to` varchar(255) NOT NULL,
  `second_school_type` varchar(255) NOT NULL,
  `primary_school_name` varchar(255) NOT NULL,
  `primary_last_year_level` varchar(255) NOT NULL,
  `primary_school_year_from` varchar(255) NOT NULL,
  `primary_school_year_to` varchar(255) NOT NULL,
  `primary_school_type` varchar(255) NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `previous_school`
--

INSERT INTO `previous_school` (`id`, `second_school_name`, `second_last_strand`, `second_last_year_level`, `second_school_year_from`, `second_school_year_to`, `second_school_type`, `primary_school_name`, `primary_last_year_level`, `primary_school_year_from`, `primary_school_year_to`, `primary_school_type`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 'dsadsadad', 'adsadad', '3', '2014', '2015', 'public', 'adsadad', '3', '2015', '2016', 'public', 1, '2024-10-06 23:39:46', '2024-10-06 23:39:46');

-- --------------------------------------------------------

--
-- Table structure for table `register_form`
--

CREATE TABLE `register_form` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `register_form`
--

INSERT INTO `register_form` (`id`, `firstname`, `lastname`, `middlename`, `suffix`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'claire', 'dungog', 'NA', 'NA', 'kler@gmail.com', 'asdasdasd', '2024-10-06 23:31:24', '2024-10-06 23:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `required_documents`
--

CREATE TABLE `required_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `documents` varchar(255) NOT NULL,
  `required_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `required_documents`
--

INSERT INTO `required_documents` (`id`, `type`, `documents`, `required_id`, `created_at`, `updated_at`) VALUES
(1, '2x2 ID Picture', 'documents/M5TilKOR0ZTP6aYeLu9sNgWF0Ab9F3ATsjoZqmLh.jpg', 1, '2024-10-06 23:40:51', '2024-10-06 23:40:51'),
(2, '2x2 ID Picture', 'documents/bLX0GqWiANnJ2VdWeMuokNH5Jy3KvjgGma2AKKnc.jpg', 1, '2024-10-06 23:40:51', '2024-10-06 23:40:51');

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `S_Y` varchar(255) NOT NULL,
  `school_yearid` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('I7Tdh04MHMyrEOarLSIaNhzogVrPGrBsuY8mtVCq', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaFFpU3NKQ2o2VFF0WWJ4d2VCRlloRUFqRHRKUlpXSXpEcEVubktDcCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdHVkZW50Z3JhZGVzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1728286949);

-- --------------------------------------------------------

--
-- Table structure for table `studentdetails`
--

CREATE TABLE `studentdetails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `civilstatus` varchar(255) NOT NULL,
  `birthdate` varchar(255) NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `mother_occupation` varchar(255) NOT NULL,
  `mother_contact` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `father_occupation` varchar(255) NOT NULL,
  `father_contact` varchar(255) NOT NULL,
  `guardian_name` varchar(255) NOT NULL,
  `guardian_occupation` varchar(255) NOT NULL,
  `guardian_contact` varchar(255) NOT NULL,
  `details_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `studentdetails`
--

INSERT INTO `studentdetails` (`id`, `firstname`, `middlename`, `lastname`, `suffix`, `nationality`, `gender`, `civilstatus`, `birthdate`, `birthplace`, `religion`, `mother_name`, `mother_occupation`, `mother_contact`, `father_name`, `father_occupation`, `father_contact`, `guardian_name`, `guardian_occupation`, `guardian_contact`, `details_id`, `created_at`, `updated_at`) VALUES
(1, 'claire', 'NA', 'dungog', 'NA', 'filipino', 'female', 'single', '2011-01-25', 'Cebu, LLC', 'dadsad', 'concepcion', 'dasd', '0909099090', 'jen', 'adadada', '09090900', 'concepcion', 'sdadsdadsda', '0909090909', 1, '2024-10-06 23:34:02', '2024-10-06 23:34:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `middlename`, `suffix`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'claire', 'dungog', 'NA', 'NA', 'Oldstudent', 'kler@gmail.com', NULL, '$2y$12$R9WQ.VJo0/QbcPCHWwAl0eU4luVwPnS74clfORQoI4rcux//OKSgS', NULL, '2024-10-06 23:32:05', '2024-10-06 23:41:12');

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
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `code_values`
--
ALTER TABLE `code_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
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
-- Indexes for table `register_form`
--
ALTER TABLE `register_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `required_documents`
--
ALTER TABLE `required_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `required_documents_required_id_foreign` (`required_id`);

--
-- Indexes for table `school_year`
--
ALTER TABLE `school_year`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assessment`
--
ALTER TABLE `assessment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `code_values`
--
ALTER TABLE `code_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payment_form`
--
ALTER TABLE `payment_form`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `previous_school`
--
ALTER TABLE `previous_school`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `register_form`
--
ALTER TABLE `register_form`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `required_documents`
--
ALTER TABLE `required_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studentdetails`
--
ALTER TABLE `studentdetails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payment_form`
--
ALTER TABLE `payment_form`
  ADD CONSTRAINT `payment_form_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `previous_school`
--
ALTER TABLE `previous_school`
  ADD CONSTRAINT `previous_school_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `required_documents`
--
ALTER TABLE `required_documents`
  ADD CONSTRAINT `required_documents_required_id_foreign` FOREIGN KEY (`required_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `studentdetails`
--
ALTER TABLE `studentdetails`
  ADD CONSTRAINT `studentdetails_details_id_foreign` FOREIGN KEY (`details_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
