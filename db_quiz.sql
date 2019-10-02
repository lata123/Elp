-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~trusty.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 25, 2019 at 05:03 AM
-- Server version: 10.1.25-MariaDB-1~trusty
-- PHP Version: 7.2.16-1+ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reset_link` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_code` smallint(6) DEFAULT NULL,
  `mobile_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `auth_token` text COLLATE utf8mb4_unicode_ci,
  `verification_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `password`, `reset_link`, `phone_code`, `mobile_number`, `profile_image`, `status`, `auth_token`, `verification_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 'Amit', ' Sharma', 'samit.sdei@gmail.com', '$2y$10$qlVHnpYVBR/ekUSv297IhOx2ePcpZ763hFX53ShohPtZR/am0mNbG', NULL, NULL, NULL, 'img/hela-logo.png', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvdjEvYWRtaW4vbG9naW4iLCJpYXQiOjE1NjkzODc3NjMsImV4cCI6MTU3MTExNTc2MywibmJmIjoxNTY5Mzg3NzYzLCJqdGkiOiJmWWFuZk4yOEdlcmhsQWVRIn0.eqIdOjZvlrGFmgTkaQTr36fjg7ED8vWjqaQCfiozrrE1569387763', 'mNF5o8mm1r0ozq9Ki3EgqwaqYqeVlEZMAnwkWPRGcJEgG', NULL, '2019-09-24 09:11:16', '2019-09-25 05:02:43');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `category`, `title`, `message`, `status`, `created_at`, `updated_at`, `is_deleted`) VALUES
(17, '3', 'How can I create an account on ELP?', '<p>You can reate an account directly from our apps. If you are an Employer, please download our &quot;ELP Employer&quot; app or if you are a Job Seeker, please download our &quot;ELP Seeker&quot; app. Both apps are available on the App Store and Google Play.</p>', 1, '2019-08-29 13:43:20', '2019-08-29 13:43:20', 0),
(18, '3', 'What is the verification process in the application?', '<p>All of our Job Seekers are required to go through our verification process which consists of one artificial intelligence verification system to verify your documents which is followed by two on boarding interviews with a member of the ELP On Boarding team.</p>', 1, '2019-08-29 13:44:04', '2019-08-29 13:44:04', 0),
(19, '3', 'When I will get paid by the employer?', '<p>You will get paid as soon as you complete a job.</p>', 1, '2019-08-29 13:44:44', '2019-08-29 13:44:44', 0),
(20, '3', 'Can I transfer money directly to my bank account?', '<p>Yes, when you sign-up to ELP, we will ask you for your bank details which we will use to transfer all of your payouts to. Ensure this is always up to date to avoid delays and/or loses.</p>', 1, '2019-08-29 13:45:25', '2019-08-29 13:45:25', 0),
(21, '3', 'Can I cancel the booking after confirmation?', '<p>Cancelling a shift is free up to 5 minutes from the booking time. Once 5+ minutes has been reached, a &pound;12 cancellation fee is applied to your account. If you are a Job Seeker, you must call Customer Service Team on 0800 368 7761 immediately.</p>', 1, '2019-08-29 13:45:56', '2019-08-29 13:45:56', 0),
(22, '1', 'When is the money taken from my card?', '<p>The money will be taken after a job has been completed. However, you will have to pay the required 4-hours policy at the same time you are requesting your booking.</p>', 1, '2019-08-29 13:57:21', '2019-08-29 13:57:21', 0),
(23, '1', 'I need to cancel a shift. Will I be charged for it?', '<p>Cancelling a shift is free up to 5 minutes from the booking time. Once 5+ minutes has been reached, a &pound;12 cancellation fee is applied to your account.</p>', 1, '2019-08-29 13:57:50', '2019-08-29 13:57:50', 0),
(24, '1', 'Is my transaction secure?', '<p>Yes, your trasnaction is secured throughout the process whilst you are on and off any of our services. We use different means of security to protect all of our users therefore, all of your information is private throughout our services and platforms.</p>', 1, '2019-08-29 13:58:20', '2019-08-29 13:58:20', 0),
(25, '1', 'A Seeker has not turned up. Will I have to pay the original fee despite their absence?', '<p>No, you only pay for completed jobs. Therefore, your money will remain in escrow until you wish to request a job or withdrawal it.</p>', 1, '2019-08-29 13:59:01', '2019-08-29 13:59:01', 0),
(26, '1', 'I would like to extend the hire of a ELP Seeker, what should I do?', '<p>Please use our built-in &quot;Extend The Hire&quot; feature within the app which you will have access to once a Job Seeker accepts your job request.</p>', 1, '2019-08-29 13:59:30', '2019-08-29 13:59:30', 0),
(27, '1', 'Are all of ELP Seeker’s verified?', '<p>Yes, all of our Job Seekers are verified via our built-in artificial intelligence verification system which is followed by two on boarding interviews.</p>', 1, '2019-08-29 13:59:54', '2019-08-29 13:59:54', 0),
(28, '2', 'How do I update my bank details?', '<p>You can update your bank details within your account in the ELP Seeker app by going to the &quot;Payment&quot; section in your profile or you can update your bank details via your web account directly under &quot;My account&quot; after you sign-in.</p>', 1, '2019-08-29 14:00:45', '2019-08-29 14:00:45', 0),
(29, '2', 'How and when do I get paid?', '<p>You get paid after a job has been completed successfuly. However, you have to request your payout from your account and depending on your bank, it could take anywhere between 3 to 7 working days to arrive.</p>', 1, '2019-08-29 14:01:13', '2019-08-29 14:01:13', 0),
(30, '2', 'What if I\'m running late?', '<p>Message your Employer via our built-in instant messaging to make them aware of this and call our Customer Service Team on 0800 368 7761 immediately.</p>', 1, '2019-08-29 14:01:39', '2019-08-29 14:01:39', 0),
(31, '2', 'How do I get verified?', '<p>You will need to create an account in our ELP Seeker app and go through our automated ID verification service. You must have a valid proof of ID and address in order to be accepted.</p>', 1, '2019-08-29 14:02:21', '2019-08-29 14:02:21', 0),
(32, '2', 'How can I accept a job?', '<p>You will receive a notification in app when there is a local job posted near you, you will have 30 seconds to accept it.</p>', 1, '2019-08-29 14:02:51', '2019-08-29 14:02:51', 0),
(33, '2', 'Can I message the employers?', '<p>Yes, use our built-in instant messaging feature to communicate with your Employer effectivelty and smoothly.</p>', 1, '2019-08-29 14:03:25', '2019-08-29 14:03:25', 0),
(34, '2', 'How does the Tax work at ELP?', '<p>You must be registered as &quot;Self-Employed&quot; and therefore, you are required to declare your taxes on your own at the end of each calendar year. ELP is not responsible for your tax responsibility.</p>', 1, '2019-08-29 14:03:53', '2019-08-29 14:03:53', 0),
(35, '2', 'How long does it take to get an offer after I have applied?', '<p>This will depend on<strong> </strong>what jobs are going on around you. However, you will receive notifications for work up to 10 miles away from your location.</p>', 1, '2019-08-30 04:36:16', '2019-08-30 04:36:16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `faq_category`
--

CREATE TABLE `faq_category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faq_category`
--

INSERT INTO `faq_category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Employers', '2019-05-02 06:16:37', '2019-05-02 06:16:37'),
(2, 'Job Seekers', '2019-05-02 06:16:37', '2019-05-02 06:16:37'),
(3, 'General', '2019-05-02 06:16:37', '2019-05-02 06:16:37');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_06_26_064636_add_subscribe_and_info_users', 1),
(2, '2019_06_27_121237_add_steps_users', 2),
(3, '2019_07_04_114112_create_locations_table', 3),
(13, '2019_07_22_120020_create_terms_table', 7),
(16, '2019_07_25_121334_add_introduction_to_users', 10),
(17, '2019_07_25_123958_add_can_transact_to_users', 11),
(19, '2019_07_29_055932_create_interviews_table', 12),
(20, '2019_07_19_055932_create_meetings_table', 13),
(21, '2019_07_19_063323_create_meeting_participants_table', 13),
(22, '2019_07_15_073156_add_commission_to_users_table', 14),
(23, '2019_07_24_092410_add_pipedrive_person_id_users', 14),
(24, '2019_08_09_123511_create_seeker_experience_table', 15),
(26, '2019_08_12_055308_add_notify_me_to_users_table', 16),
(27, '2019_08_12_055228_create_sendinblue_region_list_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_type` int(1) NOT NULL COMMENT '1 - User , 2 - Child',
  `fullname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 - inactive, 1 - active',
  `is_logged` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `fullname`, `first_name`, `last_name`, `mobile_number`, `profile_image`, `email`, `password`, `remember_token`, `verification_token`, `status`, `is_logged`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Amit Sharma', 'Amit', ' Sharma', NULL, 'img/hela-logo.png', 'samit.sdei@gmail.com', '$2y$10$i6Bmxe5ohYcLH9LHT/kOFel1KbUQ9pDGDOOBv33ihE0cCEGhBRp/S', NULL, 'uHayMbpOAfMpDnadRW1oeSRSebuMSgDqJpwtn7mSDq7Ft', 1, 1, 0, '2019-09-24 09:12:00', '2019-09-25 05:00:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_category`
--
ALTER TABLE `faq_category`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `faq_category`
--
ALTER TABLE `faq_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
