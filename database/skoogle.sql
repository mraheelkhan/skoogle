-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2019 at 09:43 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skoogle`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminmenus`
--

CREATE TABLE `adminmenus` (
  `id` int(10) UNSIGNED NOT NULL,
  `menutitle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parentid` int(10) UNSIGNED DEFAULT NULL,
  `showinnav` tinyint(1) DEFAULT NULL,
  `setasdefault` tinyint(1) DEFAULT NULL,
  `iconclass` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urllink` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `displayorder` int(11) DEFAULT NULL,
  `mselect` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adminmenus`
--

INSERT INTO `adminmenus` (`id`, `menutitle`, `slug`, `parentid`, `showinnav`, `setasdefault`, `iconclass`, `urllink`, `displayorder`, `mselect`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'dashboard', NULL, 1, 1, 'fa fa-dashboard', '/dashboard', 0, 'dashboard', 1, '2018-08-09 14:00:00', '2018-08-10 06:11:19'),
(2, 'Staff', 'main-admins', NULL, 1, 1, 'fa fa-users', '#', 1, 'admins, admins.edit, admins.create, admins.show, resetpassword', 1, '2018-08-09 14:00:00', '2018-12-20 19:00:00'),
(3, 'Roles', 'roles-index', 5, 1, 1, NULL, '/roles', 0, 'roles, roles.edit, roles.create', 1, '2018-08-09 14:00:00', '2018-12-19 19:00:00'),
(4, 'Manage Staff', 'admins-index', 2, 1, 1, NULL, '/admins', 1, 'admins, admins.edit, admins.create, admins.show, resetpassword', 1, '2018-08-09 14:00:00', '2018-12-19 19:00:00'),
(5, 'Settings', 'settings', NULL, 1, 1, 'fa fa-gear', '#', 15, 'menu, menu.edit,, menu.create,roles, roles.edit, roles.create', 1, '2018-08-09 14:00:00', '2018-12-19 19:00:00'),
(6, 'Manage Menu', 'menu-index', 5, 1, 1, NULL, '/menu', 0, 'menu, menu.edit,, menu.create', 1, '2018-08-09 14:00:00', '2018-08-10 06:47:49'),
(7, 'Customers', 'customers', NULL, 1, 1, 'fa fa-users', '#', 3, 'customers, customers.edit, customers.create, customers.show, customer.resetpassword,leads,leads.edit,leads.create,createrecording,leads.show', 1, '2018-08-12 14:00:00', '2018-08-12 14:00:00'),
(8, 'Manage Customers', 'customers-index', 7, 1, 1, 'fa fa-users', '/customers', 0, 'customers, customers.edit, customers.create, customers.show, customer.resetpassword', 1, '2018-08-12 14:00:00', '2018-08-12 14:00:00'),
(28, 'Add Staff', 'create-staff', 2, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 14:00:00', '2018-09-21 14:00:00'),
(29, 'Staff Details', 'show-staff', 2, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 14:00:00', '2018-09-21 22:10:17'),
(30, 'Edit Staff', 'edit-staff', 2, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 14:00:00', '2018-09-21 14:00:00'),
(31, 'Change Staff Status', 'status-staff', 2, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 14:00:00', '2018-09-21 14:00:00'),
(32, 'Delete Staff', 'delete-staff', 2, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 14:00:00', '2018-09-21 14:00:00'),
(33, 'Staff Reset Password', 'staff-reset-password', 2, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 14:00:00', '2018-09-21 14:00:00'),
(34, 'Add Customer', 'create-customer', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 14:00:00', '2018-09-21 14:00:00'),
(35, 'View Customer', 'show-customer', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 14:00:00', '2018-09-21 14:00:00'),
(36, 'Edit Customer', 'edit-customer', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 14:00:00', '2018-09-21 14:00:00'),
(37, 'Change Customer Status', 'status-customer', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 14:00:00', '2018-09-21 14:00:00'),
(38, 'Delete Customer', 'delete-customer', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 14:00:00', '2018-09-21 14:00:00'),
(39, 'Customer Reset Password', 'reset-customer-password', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 14:00:00', '2018-09-21 14:00:00'),
(53, 'Show Dashboard Calendar', 'show-dashboard-calendar', 1, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-26 14:00:00', '2018-09-26 14:00:00'),
(56, 'Customer Projects', 'customer/projects', NULL, 1, NULL, 'fa fa-users', 'customer/projects', 2, 'customer/projects', 1, '2018-11-25 14:00:00', '2018-11-25 19:43:11'),
(57, 'Customer Project Index', 'customer-projects-index', 56, NULL, NULL, NULL, 'customer.projects.index', 0, 'customer.projects.index', 1, '2018-11-25 14:00:00', '2018-11-25 14:00:00'),
(58, 'Customer Fetch Projects', 'customer-fetch-projects', 56, NULL, NULL, NULL, 'customer.fetch.projects', 0, 'customer.fetch.projects', 1, '2018-11-25 14:00:00', '2018-11-25 14:00:00'),
(91, 'Manage Organizations', 'departments-index', 5, 1, NULL, NULL, 'settings/departments', 0, 'departments, settings,', 1, '2018-12-20 19:00:00', '2019-06-30 19:00:00'),
(92, 'Add Department', 'create-department', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-12-23 19:00:00', '2018-12-24 03:52:47'),
(93, 'Edit Department', 'edit-department', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-12-23 19:00:00', '2018-12-23 19:00:00'),
(94, 'Delete Department', 'delete-department', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-12-23 19:00:00', '2018-12-23 19:00:00'),
(95, 'Department Status', 'status-department', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-12-23 19:00:00', '2018-12-23 19:00:00'),
(117, 'Manage Designations', 'designations-index', 5, 1, NULL, NULL, 'settings/designations', 0, 'designations', 1, '2018-12-30 14:00:00', '2018-12-30 14:00:00'),
(118, 'Add Designation', 'create-designation', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-12-30 14:00:00', '2018-12-31 02:51:41'),
(119, 'Edit Designation', 'edit-designation', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-12-30 14:00:00', '2018-12-31 02:51:55'),
(120, 'Designation Status', 'status-designation', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-12-30 14:00:00', '2018-12-30 14:00:00'),
(121, 'Delete Designation', 'delete-designation', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-12-30 14:00:00', '2018-12-30 14:00:00'),
(122, 'Preferences', 'preferences-index', 5, 1, NULL, NULL, 'settings/preferences', 0, 'preferences,settings', 1, '2019-01-06 14:00:00', '2019-01-08 14:00:00'),
(123, 'Eit Preference', 'edit-preference', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-06 14:00:00', '2019-01-06 14:00:00'),
(124, 'Delete Preference', 'delete-preference', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-06 14:00:00', '2019-01-06 14:00:00'),
(125, 'Add Preference', 'create-preference', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-06 14:00:00', '2019-01-06 14:00:00'),
(126, 'Manage Category', 'category-index', 5, 1, NULL, NULL, 'category', 0, 'category.index, setting,', 1, '2019-03-21 14:00:00', '2019-07-03 05:53:45'),
(127, 'Category Fetch', 'category-fetch', 5, NULL, NULL, NULL, 'category.fetch', 0, 'category.fetch', 1, '2019-03-21 14:00:00', '2019-03-27 14:00:00'),
(128, 'Category Store', 'category-store', 5, NULL, NULL, NULL, 'category.store', 0, 'category.store', 1, '2019-03-21 14:00:00', '2019-03-27 14:00:00'),
(129, 'Category Edit', 'category-edit', 5, NULL, NULL, NULL, 'category.edit', 0, 'category.edit, setting', 1, '2019-03-21 14:00:00', '2019-07-02 19:00:00'),
(130, 'Category Active', 'category-active', 5, NULL, NULL, NULL, 'category.active', 0, 'category.active', 1, '2019-03-21 14:00:00', '2019-03-27 14:00:00'),
(131, 'Category Disable', 'category-disable', 5, NULL, NULL, NULL, 'category.disable', 0, 'category.disable', 1, '2019-03-21 14:00:00', '2019-03-27 14:00:00'),
(132, 'Manage Forum', 'forum-adminindex', NULL, 1, NULL, 'fa fa-question', 'settings/forum', 0, 'forum.adminindex', 1, '2019-03-21 14:00:00', '2019-07-03 19:00:00'),
(133, 'Forum Questions Fetch', 'forum-adminfetch', 132, NULL, NULL, NULL, 'forum.adminfetch', 0, 'forum.adminfetch', 1, '2019-03-21 14:00:00', '2019-03-27 14:00:00'),
(134, 'Forum Questions Store', 'forum-adminstore', 132, NULL, NULL, NULL, 'forum.adminstore', 0, 'forum.adminstore', 1, '2019-03-21 14:00:00', '2019-03-27 14:00:00'),
(135, 'Forum Questions Edit', 'forum-adminedit', 132, NULL, NULL, NULL, 'forum.adminedit', 0, 'forum.adminedit', 1, '2019-03-21 14:00:00', '2019-03-27 14:00:00'),
(136, 'Forum Questions Active', 'forum-adminactive', 132, NULL, NULL, NULL, 'forum.adminactive', 0, 'forum.adminactive', 1, '2019-03-21 14:00:00', '2019-03-27 14:00:00'),
(137, 'Forum Questions Disable', 'forum-admindisable', 132, NULL, NULL, NULL, 'forum.adminisable', 0, 'forum.admindisable', 1, '2019-03-21 14:00:00', '2019-03-27 14:00:00'),
(138, 'Forum Admin Show', 'forum-adminshow', 132, NULL, NULL, NULL, 'forum.adminshow', 0, 'forum.adminshow, setting,', 1, '2019-03-21 09:00:00', '2019-07-03 00:53:45'),
(139, 'Manage Jobs', 'job-adminindex', NULL, 1, NULL, 'fa fa-tasks', 'settings/job', 0, 'job.index, setting,', 1, '2019-03-21 09:00:00', '2019-07-06 06:12:47'),
(140, 'Job Fetch', 'job-adminfetch', 139, NULL, NULL, NULL, 'job.adminfetch', 0, 'job.adminfetch', 1, '2019-03-21 09:00:00', '2019-03-27 09:00:00'),
(141, 'Job Store', 'job-adminstore', 139, NULL, NULL, NULL, 'job.adminstore', 0, 'job.adminstore', 1, '2019-03-21 09:00:00', '2019-03-27 09:00:00'),
(142, 'Job Edit', 'job-adminedit', 139, NULL, NULL, NULL, 'job.adminedit', 0, 'job.adminedit, setting', 1, '2019-03-21 09:00:00', '2019-07-02 14:00:00'),
(143, 'Job Active', 'job-adminactive', 139, NULL, NULL, NULL, 'job.adminactive', 0, 'job.adminactive', 1, '2019-03-21 09:00:00', '2019-03-27 09:00:00'),
(144, 'Job Disable', 'job-admindisable', 139, NULL, NULL, NULL, 'job.admindisable', 0, 'job.admindisable', 1, '2019-03-21 09:00:00', '2019-03-27 09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `applied_jobs`
--

CREATE TABLE `applied_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `cover_letter` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cv_file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary_expected` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1 COMMENT '0 = inactive , 1 = active',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 = pending , 1 = display, 2 = moderate, 3 = marked as spam',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 = not deleted , 1 = deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applied_jobs`
--

INSERT INTO `applied_jobs` (`id`, `user_id`, `job_id`, `cover_letter`, `cv_file_name`, `salary_expected`, `isActive`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 9, 'sadf asf asdf asdf sadf asf asdf asdf sadf asf asdf asdfsadf asf asdf asdf sadf asf asdf asdf sadf asf asdf asdfsadf asf asdf asdfsadf asf asdf asdfsadf asf asdf asdfsadf asf asdf asdf', '1562452440Capture.PNG', '1212', 1, 1, 0, '2019-07-06 17:34:00', '2019-07-06 17:34:00'),
(2, 8, 9, 'here is the coverletter of my job as applying and considering this job thakn ou', '1562452643download.jfif', '900', 1, 1, 0, '2019-07-06 17:37:23', '2019-07-06 17:37:23'),
(3, 8, 9, 'here is the doc file test', '1562453629srs1.docx', '202', 1, 1, 0, '2019-07-06 17:53:49', '2019-07-06 17:53:49'),
(4, 8, 9, 'sadfasdf asfasf s y for - Senior Android Developer\r\ny for - Senior Android Developer\r\ny for - Senior Android Developer\r\ny for - Senior Android Developer\r\ny for - Senior Android Developer', '1562454650gaminglaptops-lowres-9178-570x380.jpg', '2432423', 1, 1, 0, '2019-07-06 18:10:50', '2019-07-06 18:10:50'),
(5, 1, 5, 'here is the cover letter for my job, find it', '1571328618Screensho3t_2.png', '20000', 1, 1, 0, '2019-10-17 11:10:18', '2019-10-17 11:10:18'),
(6, 1, 5, 'lskjflsadjf asljfl sadlskjflsadjf asljfl sadlskjflsadjf asljfl sadlskjflsadjf asljfl sadlskjflsadjf asljfl sadlskjflsadjf asljfl sadlskjflsadjf asljfl sadlskjflsadjf asljfl sad', '1571328643Screenshot_21.png', '40000', 1, 1, 0, '2019-10-17 11:10:43', '2019-10-17 11:10:43'),
(7, 1, 1, 'here is the cover later by me and do consider me for this job so I can get back to you as soon as I can. \r\n\r\nThakn youj asflasdklfasdf much', '1572035688Etaqo.png', '2432423', 1, 1, 0, '2019-10-25 15:34:48', '2019-10-25 15:34:48'),
(8, 1, 1, 'here is the cover later for the job of pakistan and we are here against india and between themw we sare fgoing to kdo asolf for auf0', '1572035752Marker Clustering.png', '2432423', 1, 1, 0, '2019-10-25 15:35:52', '2019-10-25 15:35:52');

-- --------------------------------------------------------

--
-- Table structure for table `authentication_log`
--

CREATE TABLE `authentication_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `authenticatable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authenticatable_id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_at` timestamp NULL DEFAULT NULL,
  `logout_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_category_id` int(11) NOT NULL DEFAULT 0 COMMENT ' 0 = no parent',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT ' project, question, skill, course, video ',
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 = inactive , 1 = active',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 = not deleted , 1 = deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `parent_category_id`, `type`, `user_id`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Android', 3, 'category', 1, 1, 0, '2019-07-03 06:26:37', '2019-07-03 06:42:51'),
(2, 'iOS Development', 3, 'skill', 1, 1, 0, '2019-07-03 06:37:28', '2019-07-03 06:42:56'),
(3, 'Software Development', 0, 'category', 1, 1, 0, '2019-07-03 06:42:14', '2019-07-03 06:42:14'),
(5, 'Laravel Development', 0, 'job', 1, 1, 0, '2019-07-05 16:31:14', '2019-07-05 16:31:14'),
(6, 'Business Development Analyst', 0, 'job', 1, 1, 0, '2019-07-05 16:32:01', '2019-07-05 16:32:01');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `deptname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `user_id` int(10) UNSIGNED NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `allow_outside` int(11) NOT NULL DEFAULT 1,
  `isDeleted` int(11) NOT NULL DEFAULT 0,
  `last_modified_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `deptname`, `status`, `user_id`, `address`, `phone_number`, `business_email`, `allow_outside`, `isDeleted`, `last_modified_by`, `created_at`, `updated_at`) VALUES
(8, 'Mrasat Inc', 1, 1, 'G7 ISB', '9282878228', 'business@gmail.com', 1, 0, 1, '2018-12-24 00:16:21', '2018-12-24 00:16:21'),
(14, 'Zamunga Inc', 1, 1, 'Pakistan zindabad', '923332828281', 'email@gak.com', 1, 0, 1, '2019-07-02 02:40:36', '2019-07-03 11:27:42'),
(15, 'Iqra University', 1, 1, 'G7 ISB', '9282878228', 'business2@gmail.com', 1, 0, 1, '2019-07-02 02:40:48', '2019-07-02 02:40:48');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `last_modified_by` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `name`, `user_id`, `last_modified_by`, `status`, `created_at`, `updated_at`) VALUES
(2, 'PHP Developer', 1, 1, 1, '2018-12-31 02:53:38', '2018-12-31 02:53:38'),
(3, 'Designer', 1, 1, 1, '2018-12-31 02:53:46', '2018-12-31 03:24:15'),
(4, 'iOS Developer', 1, 1, 1, '2018-12-31 02:53:58', '2018-12-31 02:54:38'),
(28, 'Laravel Developer', 1, 1, 1, '2019-01-11 01:55:52', '2019-01-11 01:55:52'),
(29, 'Android Developer', 1, 1, 1, '2019-01-11 01:56:06', '2019-01-11 01:56:06');

-- --------------------------------------------------------

--
-- Table structure for table `forum_answers`
--

CREATE TABLE `forum_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `answer_body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_id` int(11) NOT NULL,
  `isSolution` int(11) NOT NULL DEFAULT 0 COMMENT '0 = no, 1 = solution',
  `isActive` int(11) NOT NULL DEFAULT 1 COMMENT '0 = inactive , 1 = active',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 = pending , 1 = display, 2 = moderate, 3 = marked as spam',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 = not deleted , 1 = deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forum_answers`
--

INSERT INTO `forum_answers` (`id`, `user_id`, `answer_body`, `question_id`, `isSolution`, `isActive`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 8, 'I dont know the exact answer but yes you can use it askjslf asfljkas l;faskf jSe ssionSe ssionS s sionS essio n', 4, 0, 1, 1, 0, '2019-07-04 07:45:46', '2019-07-04 13:08:39'),
(2, 1, 'Yeah we also dont know why is this happening, new zealand lost last three matches to pakistan, australia and england.', 4, 0, 1, 1, 1, '2019-07-04 07:47:29', '2019-07-05 04:36:12'),
(3, 8, 'for futher information kindly contact me on my email rk@mraheelkhan.com', 4, 0, 1, 1, 0, '2019-07-04 08:07:09', '2019-07-05 04:29:32'),
(4, 1, 'okay sure, thank you for your reply. i will get in touch with you shorty.', 4, 0, 1, 1, 1, '2019-07-04 08:07:42', '2019-07-05 04:36:32'),
(5, 8, 'kay sure, thank you for your reply. i will get in touch with you skay sure, thank you for your reply. i will get in touch with you skay sure, thank you for your reply. i will get in touch with you skay sure, thank you for your reply. i will get in touch with you skay sure, thank you for your reply. i will get in touch with you skay sure, thank you for your reply. i will get in touch with you s', 4, 0, 1, 1, 0, '2019-07-04 08:12:29', '2019-07-04 13:29:27'),
(6, 8, 'kay sure, thank you for your reply. i will get in touch with you skay sure, thank you for your reply. i will get in touch with you skay sure, thank you for your reply. i will get in touch with you skay sure, thank you for your reply. i will get in touch with you skay sure, thank you for your reply. i will get in touch with you skay sure, thank you for your reply. i will get in touch with you skay sure, thank you for your reply. i will get in touch with you s', 4, 0, 1, 1, 0, '2019-07-04 08:12:35', '2019-07-05 04:28:47'),
(7, 8, 'this is answer body of the anser which is for the testing purpose of hte system', 3, 1, 1, 1, 0, '2019-07-04 15:06:31', '2019-07-04 18:20:13'),
(8, 1, 'thank you so much for your answer', 3, 0, 1, 1, 0, '2019-07-04 16:10:32', '2019-07-04 16:10:32'),
(9, 1, 'hkh klhj lkj jhlkjh ljkh klhj', 5, 1, 1, 1, 0, '2019-10-17 11:57:23', '2019-10-17 12:06:02'),
(10, 1, 'kjhklhkhklhkl hjk klh kl', 5, 0, 1, 1, 0, '2019-10-17 11:57:34', '2019-10-17 11:57:34');

-- --------------------------------------------------------

--
-- Table structure for table `forum_questions`
--

CREATE TABLE `forum_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1 COMMENT '0 = inactive , 1 = active',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 = pending , 1 = display, 2 = moderate, 3 = marked as spam',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 = not deleted , 1 = deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forum_questions`
--

INSERT INTO `forum_questions` (`id`, `user_id`, `question_title`, `question_body`, `category_id`, `isActive`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(3, 1, 'here is the title of my questionasasasasa1111', 'i need to check on the iOS dvevelopmnt and salary of it in USA per year', 1, 1, 2, 0, '2019-07-04 04:51:40', '2019-07-05 05:48:41'),
(4, 8, 'Authentication - Laravel - The PHP Framework For Web Artisans https', 'Authentication - Laravel - The PHP Framework For Web Artisans\r\nhttps Authentication - Laravel - The PHP Framework For Web Artisans\r\nhttps Authentication - Laravel - The PHP Framework For Web Artisans\r\nhttps Authentication - Laravel - The PHP Framework For Web Artisans\r\nhttps VV Authentication - Laravel - The PHP Framework For Web Artisans\r\nhttpsAuthentication - Laravel - The PHP Framework For Web Artisans\r\nhttpsAuthentication - Laravel - The PHP Framework For Web Artisans\r\nhttpsAuthentication - Laravel - The PHP Framework For Web Artisans\r\nhttpsAuthentication - Laravel - The PHP Framework For Web Artisans\r\nhttpsAuthentication - Laravel - The PHP Framework For Web Artisans\r\nhttpsAuthentication - Laravel - The PHP Framework For Web Artisans\r\nhttpsAuthentication - Laravel - The PHP Framework For Web Artisans\r\nhttpsAuthentication - Laravel - The PHP Framework For Web Artisans\r\nhttpsAuthentication - Laravel - The PHP Framework For Web Artisans\r\nhttpsAuthentication - Laravel - The PHP Framework For Web Artisans\r\nhttps', 3, 1, 1, 0, '2019-07-04 06:22:45', '2019-07-05 05:48:55'),
(5, 8, 'Laravel auth is wonderful but how to implement it in Model', 'Then again please note that logout requires POST as HTTP request method. There are many valid reason behind this, but just to mention one very important is that in this way you can prevent cross-site request forgery.\r\n\r\nSo according to what I have just pointed out a correct way to implement this could be just this:\r\nThen again please note that logout requires POST as HTTP request method. There are many valid reason behind this, but just to mention one very important is that in this way you can prevent cross-site request forgery.\r\n\r\nSo according to what I have just pointed out a correct way to implement this could be just this:\r\nThen again please note that logout requires POST as HTTP request method. There are many valid reason behind this, but just to mention one very important is that in this way you can prevent cross-site request forgery.\r\n\r\nSo according to what I have just pointed out a correct way to implement this could be just this:\r\nThen again please note that logout requires POST as HTTP request method. There are many valid reason behind this, but just to mention one very important is that in this way you can prevent cross-site request forgery.\r\n\r\nSo according to what I have just pointed out a correct way to implement this could be just this:\r\nThen again please note that logout requires POST as HTTP request method. There are many valid reason behind this, but just to mention one very important is that in this way you can prevent cross-site request forgery.\r\n\r\nSo according to what I have just pointed out a correct way to implement this could be just this:\r\nThen again please note that logout requires POST as HTTP request method. There are many valid reason behind this, but just to mention one very important is that in this way you can prevent cross-site request forgery.\r\n\r\nSo according to what I have just pointed out a correct way to implement this could be just this:\r\nThen again please note that logout requires POST as HTTP request method. There are many valid reason behind this, but just to mention one very important is that in this way you can prevent cross-site request forgery.\r\n\r\nSo according to what I have just pointed out a correct way to implement this could be just this:\r\nThen again please note that logout requires POST as HTTP request method. There are many valid reason behind this, but just to mention one very important is that in this way you can prevent cross-site request forgery.\r\n\r\nSo according to what I have just pointed out a correct way to implement this could be just this:', 3, 1, 1, 0, '2019-07-04 06:30:37', '2019-07-04 06:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL DEFAULT 0 COMMENT '0 = individual, no company',
  `category_id` int(11) NOT NULL,
  `job_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'fulltime, part time, freelance, depends',
  `job_location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary_range` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1 COMMENT '0 = inactive , 1 = active',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 = pending , 1 = display, 2 = moderate, 3 = marked as spam',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 = not deleted , 1 = deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `user_id`, `organization_id`, `category_id`, `job_title`, `job_type`, `job_location`, `deadline`, `description`, `salary_range`, `isActive`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 2, 8, 6, 'asdfasfasdf sa fsafsajlhf saflas flasf', 'parttime', 'rawalpindi ISB', '2019-07-20', 'job_descriptionjob_descriptionjob_descriptionjob_descriptionjob_description job_description job_descriptionjob_description', '200-300', 1, 1, 0, '2019-07-05 17:13:03', '2019-07-06 06:56:50'),
(2, 2, 8, 6, 'asdfasfasdf sa fsafsajlhf saflas flasf', 'parttime', 'rawalpindi ISB', '2019-07-20', 'job_descriptionjob_descriptionjob_descriptionjob_descriptionjob_description job_description job_descriptionjob_description', '200-300', 1, 1, 0, '2019-07-05 17:13:26', '2019-07-06 06:55:04'),
(3, 1, 8, 5, 'asdfasfasdf sa fsafsajlhf saflas flasf', 'fulltime', 'location of the job is very good', '2019-07-12', 'description description description description description descriptiondescription description descriptiondescription description descriptiondescription description descriptiondescription description descriptiondescription description descriptiondescription description description', '200-300', 0, 2, 0, '2019-07-05 17:14:38', '2019-07-06 07:00:12'),
(4, 4, 8, 5, 'asdfasfasdf sa fsafsajlhf saflas flasf', 'freelance', 'rawalpindi ISB', '2019-07-18', '@if(session(\'message\'))\r\n    <script>\r\n      $( document ).ready(function() {\r\n        swal.fire(\"message\", \"{{session(\'message\')}}\", \"success\");\r\n      });\r\n    </script>\r\n@endif\r\n@if(session(\'failed\'))\r\n    <script>\r\n      $( document ).ready(function() {\r\n        swal.fire(\"Failed\", \"{{session(\'failed\')}}\", \"error\");\r\n      });\r\n      \r\n    </script>\r\n@endif', '200-300', 1, 1, 0, '2019-07-05 17:15:31', '2019-07-06 07:05:29'),
(5, 2, 8, 5, 'asdfasfasdf sa fsafsajlhf saflas flasf', 'fulltime', 'rawalpindi ISB', '2019-07-27', '!!  Job Description !!  Job Description !!  Job Description !!  Job Description !!  Job Description !!  Job Description !!  Job Description !!  Job Description !!  Job Description', '200-300', 1, 1, 0, '2019-07-05 17:17:55', '2019-07-05 17:17:55'),
(6, 2, 8, 6, 'asdfasfasdf sa fsafsajlhf saflas flasf', 'parttime', 'rawalpindi ISB', '2019-07-19', '{!! Session::get(\'message\') !!}{!! Session::get(\'message\') !!}{!! Session::get(\'message\') !!}{!! Session::get(\'message\') !!}{!! Session::get(\'message\') !!}{!! Session::get(\'message\') !!}{!! Session::get(\'message\') !!}{!! Session::get(\'message\') !!}{!! Session::get(\'message\') !!}{!! Session::get(\'message\') !!}{!! Session::get(\'message\') !!}{!! Session::get(\'message\') !!}{!! Session::get(\'message\') !!}{!! Session::get(\'message\') !!}{!! Session::get(\'message\') !!}{!! Session::get(\'message\') !!}{!! Session::get(\'message\') !!}{!! Session::get(\'message\') !!}{!! Session::get(\'message\') !!}{!! Session::get(\'message\') !!}', '200-300', 1, 1, 0, '2019-07-05 17:19:52', '2019-07-06 07:05:26'),
(7, 1, 8, 5, 'asdfasfasdf sa fsafsajlhf saflas flasf', 'parttime', 'location of the job is very good', '2019-07-12', '@if(Session::has(\'message\'))\r\n	<p class=\"alert alert-success\">{!! Session::get(\'message\') !!}</p>\r\n@endif@if(Session::has(\'message\'))\r\n	<p class=\"alert alert-success\">{!! Session::get(\'message\') !!}</p>\r\n@endif@if(Session::has(\'message\'))\r\n	<p class=\"alert alert-success\">{!! Session::get(\'message\') !!}</p>\r\n@endif@if(Session::has(\'message\'))\r\n	<p class=\"alert alert-success\">{!! Session::get(\'message\') !!}</p>\r\n@endif', '200-300', 1, 2, 0, '2019-07-05 17:20:33', '2019-07-06 06:55:30'),
(8, 1, 14, 5, 'Full Stack Web Developer', 'fulltime', 'Islamabad PC', '2019-07-11', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat quos rem ullam, placeat amet.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat quos rem ullam, placeat amet. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat quos rem ullam, placeat amet. vLorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat quos rem ullam, placeat amet. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat quos rem ullam, placeat amet.', 'PKR 220k - 250k', 1, 2, 0, '2019-07-05 18:06:52', '2019-07-06 07:00:41'),
(9, 1, 14, 5, 'Senior Android Developer', 'fulltime', 'rawalpindi ISB', '2019-07-19', 'Your source for breaking news, news about New York, sports, business, entertainment, opinion, real estate, culture, fashion, and more. Your source for breaking news, news about New York, sports, business, entertainment, opinion, real estate, culture, fashion, and more. Your source for breaking news, news about New York, sports, business, entertainment, opinion, real estate, culture, fashion, and more. Your source for breaking news, news about New York, sports, business, entertainment, opinion, real estate, culture, fashion, and more. Your source for breaking news, news about New York, sports, business, entertainment, opinion, real estate, culture, fashion, and more.', 'PKR 220k - 250k', 1, 2, 0, '2019-07-06 05:33:19', '2019-10-17 11:13:42'),
(10, 1, 14, 5, 'Senior Android Developer', 'fulltime', 'location of the job is very good', '2019-10-18', 'Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job', '40000-50000', 1, 1, 0, '2019-10-17 11:11:51', '2019-10-17 11:11:51');

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
(1, '2019_06_25_142014_create_categories_table', 1),
(3, '2019_06_27_081014_create_forum_questions_table', 2),
(4, '2019_06_27_081641_create_forum_answers_table', 3),
(6, '2019_06_27_151621_create_jobs_table', 4),
(7, '2019_06_27_153110_create_applied_jobs_table', 5),
(8, '2019_06_27_151020_create_posts_table', 6),
(9, '2019_06_27_151403_create_post_comments_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('f785bba7-d09d-4b33-8325-a21f9f120fc5', 'App\\Notifications\\ProposalLeadNotification', 'App\\User', 1, '{\"letter\":{\"title\":\"New proposal has been requested\",\"body\":\"A new proposal has been requested by Shahid Umar, please review it.\",\"redirectURL\":\"http:\\/\\/localhost:8000\\/leads\\/2\"}}', '2018-09-21 21:55:10', '2018-09-20 19:49:38', '2018-09-21 21:55:10');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('shahid.umar@gmail.com', '$2y$10$qS66RTOxkWrFDh/X0KzI/eiXdu08UXmhRa.WyY6apxT4Vkv6TbxSW', '2018-08-09 04:47:41');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `post_date` date DEFAULT NULL,
  `post_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 = not publish, 1 = publish',
  `is_comment` int(11) NOT NULL DEFAULT 1 COMMENT '1= on, 0= off',
  `post_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'post, article, job',
  `isActive` int(11) NOT NULL DEFAULT 1 COMMENT '0 = inactive , 1 = active',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 = pending , 1 = display, 2 = moderate, 3 = marked as spam',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 = not deleted , 1 = deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `post_date`, `post_content`, `post_title`, `post_status`, `is_comment`, `post_url`, `post_type`, `isActive`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 8, 2, NULL, '<p>her eis <strong>the title </strong>of ht<strong>e apksiat</strong>n papasofjasdf lasdjkf</p>\r\n\r\n<p>asdfjklas<em>dj flasdjkf</em>lasd fjasd</p>\r\n\r\n<p>fasdfasdf</p>', 'here is the title', '1', 1, 'here-is-the-title-1235873', NULL, 1, 1, 0, '2019-10-27 09:13:51', '2019-10-27 09:13:51'),
(3, 1, 3, NULL, '<p>OKAY OKAY asdfasdf asdf asdfasdf asdfasd fasdfasd fadsfa</p>\r\n\r\n<p>will not say love from Ind or Pak ,we should not divide our love for music in terms of national,the only thing I could say for him Love this tallent from bottom of my heart!!!!!!!!!!</p>\r\n\r\n<p>will not say love from Ind or Pak ,we should not divide our love for music in terms of national,the only thing I could say for him Love this tallent from bottom of my heart!!!!!!!!!!</p>\r\n\r\n<p>will not say love from Ind or Pak ,we should not divide our love for music in terms of national,the only thing I could say for him Love this tallent from bottom of my heart!!!!!!!!!!</p>\r\n\r\n<p>will not say love from Ind or Pak ,we should not divide our love for music in terms of national,the only thing I could say for him Love this tallent from bottom of my heart!!!!!!!!!!</p>\r\n\r\n<p>will not say love from Ind or Pak ,we should not divide our love for music in terms of national,the only thing I could say for him Love this tallent from bottom of my heart!!!!!!!!!!</p>\r\n\r\n<p>will not say love from Ind or Pak ,we should not divide our love for music in terms of national,the only thing I could say for him Love this tallent from bottom of my heart!!!!!!!!!!</p>\r\n\r\n<p>will not say love from Ind or Pak ,we should not divide our love for music in terms of national,the only thing I could say for him Love this tallent from bottom of my heart!!!!!!!!!!</p>\r\n\r\n<p>will not say love from Ind or Pak ,we should not divide our love for music in terms of national,the only thing I could say for him Love this tallent from bottom of my heart!!!!!!!!!!</p>\r\n\r\n<p>&nbsp;</p>', 'garzi ba eba zan ba na khafa k', '1', 1, 'garzi-ba-eba-zan-ba-na-khafa-k-1979423', NULL, 1, 1, 0, '2019-10-27 14:28:04', '2019-10-27 15:41:50'),
(4, 1, 1, NULL, '<p>her is the coneenf othe&nbsp;myArticles.&nbsp;these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !</p>\r\n\r\n<p>these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !</p>\r\n\r\n<p>these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !</p>\r\n\r\n<p>these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !these OSTezz are the best ever made. incredible !</p>\r\n\r\n<p>these OSTezz are the best ever made. incredible !</p>', 'Sishake Product Page of Pakistan', '1', 1, 'Sishake-Product-Page-of-Pakistan1735386', NULL, 1, 1, 0, '2019-10-27 14:46:06', '2019-10-27 15:42:12');

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE `post_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment_body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `up_votes` int(11) NOT NULL DEFAULT 0,
  `isActive` int(11) NOT NULL DEFAULT 1 COMMENT '0 = inactive , 1 = active',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 = pending , 1 = display, 2 = moderate, 3 = marked as spam',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 = not deleted , 1 = deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_modified_by` int(10) UNSIGNED NOT NULL,
  `modified_ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_title`, `permissions`, `permission`, `user_id`, `created_ip`, `last_modified_by`, `modified_ip`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '{\"dashboard\":true,\"main-admins\":true,\"roles-index\":true,\"admins-index\":true,\"settings\":true,\"menu-index\":true,\"customers\":true,\"customers-index\":true,\"create-staff\":true,\"show-staff\":true,\"edit-staff\":true,\"status-staff\":true,\"delete-staff\":true,\"staff-reset-password\":true,\"create-customer\":true,\"show-customer\":true,\"edit-customer\":true,\"status-customer\":true,\"delete-customer\":true,\"reset-customer-password\":true,\"show-dashboard-calendar\":true,\"departments-index\":true,\"create-department\":true,\"edit-department\":true,\"delete-department\":true,\"status-department\":true,\"designations-index\":true,\"create-designation\":true,\"edit-designation\":true,\"status-designation\":true,\"delete-designation\":true,\"category-index\":true,\"category-fetch\":true,\"category-store\":true,\"category-edit\":true,\"category-active\":true,\"category-disable\":true,\"forum-adminindex\":true,\"forum-adminfetch\":true,\"forum-adminstore\":true,\"forum-adminedit\":true,\"forum-adminactive\":true,\"forum-admindisable\":true,\"forum-adminshow\":true,\"job-adminindex\":true,\"job-adminfetch\":true,\"job-adminstore\":true,\"job-adminedit\":true,\"job-adminactive\":true,\"job-admindisable\":true}', '1,53,2,4,28,29,30,31,32,33,5,3,6,91,92,93,94,95,117,118,119,120,121,126,127,128,129,130,131,7,8,34,35,36,37,38,39,132,133,134,135,136,137,138,139,140,141,142,143,144', 1, '::1', 1, '::1', 1, '2018-08-10 14:00:00', '2019-07-06 06:32:56'),
(2, 'User', '{\"dashboard\":true,\"main-customers\":true,\"customer-index\":true,\"leads-index\":true}', '1,7,8,9', 1, '::1', 1, '127.0.0.1', 1, '2018-08-10 14:00:00', '2018-09-18 22:40:48'),
(3, 'Customer', '{\\\"customer\\\\/projects\\\":true,\\\"customer-projects-index\\\":true,\\\"customer-fetch-projects\\\":true,\\\"customer-show-projects\\\":true}', '56,57,58', 22, '1', 1, '::1', 1, '2018-11-25 14:00:00', '2018-11-26 14:00:00'),
(4, 'Admin', '{\"dashboard\":true,\"main-admins\":true,\"admins-index\":true,\"settings\":true,\"menu-index\":true,\"customers\":true,\"customers-index\":true,\"create-staff\":true,\"show-staff\":true,\"edit-staff\":true,\"status-staff\":true,\"delete-staff\":true,\"staff-reset-password\":true,\"create-customer\":true,\"show-customer\":true,\"edit-customer\":true,\"status-customer\":true,\"delete-customer\":true,\"reset-customer-password\":true,\"departments-index\":true,\"create-department\":true,\"edit-department\":true,\"delete-department\":true,\"status-department\":true,\"designations-index\":true,\"create-designation\":true,\"edit-designation\":true,\"status-designation\":true,\"delete-designation\":true}', '1,2,4,28,29,30,31,32,33,5,6,91,92,93,94,95,117,118,119,120,121,7,8,34,35,36,37,38,39', 1, '::1', 1, '::1', 1, '2019-07-01 19:00:00', '2019-07-01 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `staffdetails`
--

CREATE TABLE `staffdetails` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `dob` timestamp NULL DEFAULT NULL,
  `cnic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passportno` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skypeid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staffdetails`
--

INSERT INTO `staffdetails` (`id`, `user_id`, `dob`, `cnic`, `passportno`, `gender`, `skypeid`, `created_at`, `updated_at`) VALUES
(1, 1, '1980-04-21 19:00:00', '61101-9666255-6', 'NULL', '', NULL, '2019-01-10 02:59:53', '2019-02-01 08:14:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonenumber` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `iscustomer` tinyint(1) NOT NULL DEFAULT 0,
  `isPro` int(11) DEFAULT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `createdby` int(10) UNSIGNED DEFAULT NULL,
  `updatedby` int(10) UNSIGNED DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `designation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `phonenumber`, `avatar`, `status`, `remember_token`, `created_at`, `updated_at`, `iscustomer`, `isPro`, `role_id`, `createdby`, `updatedby`, `username`, `organization_id`, `designation_id`) VALUES
(1, 'Raheel', 'Khan', 'admin@admin.com', '$2y$10$MntbYTaK/9avYH/zOD4U5uAjtn4aFUtk4q36MNinnQ6bPdFDK0PwO', '03333639395', 'raheel.jpg', 1, 'aVqbSdAlSqNN7ue1Va9YMtP0fP9ta00aLwYRTQ2mOOL2WGVT7d2A3IB0AZar', '2018-06-25 10:22:52', '2019-07-01 07:44:10', 0, 1, 1, NULL, NULL, '', 14, 0),
(7, 'Raheel', 'Khan', 'adminaaa@admin.com', '$2y$10$.ltGPfRid5qNIYrRz6Q/bOZ4dXNX./869VJm7Kfp1fxfTNAwKLQMi', '3333639395', 'default_avatar_male.jpg', 1, NULL, '2019-07-01 19:00:00', '2019-07-02 02:45:45', 1, NULL, 2, NULL, NULL, NULL, 15, 0),
(8, 'Syed Abbas', 'Khan', 'abbas@gmail.com', '$2y$10$nw4LjC6K4XcUCSxkRSJAleUeylUzl4sRwGPnFUqi0Mf1MbfVwbCKa', '3333222211', 'default_avatar_male.jpg', 1, NULL, '2019-07-01 19:00:00', '2019-07-01 19:00:00', 1, NULL, 2, NULL, NULL, NULL, 8, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminmenus`
--
ALTER TABLE `adminmenus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `adminmenus_slug_unique` (`slug`),
  ADD KEY `adminmenus_parentid_foreign` (`parentid`);

--
-- Indexes for table `applied_jobs`
--
ALTER TABLE `applied_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authentication_log`
--
ALTER TABLE `authentication_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authentication_log_authenticatable_type_authenticatable_id_index` (`authenticatable_type`,`authenticatable_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_user_id_foreign` (`user_id`),
  ADD KEY `departments_last_modified_by_foreign` (`last_modified_by`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `designations_user_id_foreign` (`user_id`),
  ADD KEY `designations_last_modified_by_foreign` (`last_modified_by`);

--
-- Indexes for table `forum_answers`
--
ALTER TABLE `forum_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_questions`
--
ALTER TABLE `forum_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_post_url_unique` (`post_url`);

--
-- Indexes for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_user_id_foreign` (`user_id`),
  ADD KEY `roles_last_modified_by_foreign` (`last_modified_by`);

--
-- Indexes for table `staffdetails`
--
ALTER TABLE `staffdetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staffdetails_cnic_unique` (`cnic`),
  ADD UNIQUE KEY `staffdetails_passportno_unique` (`passportno`),
  ADD KEY `staffdetails_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_createdby_foreign` (`createdby`),
  ADD KEY `users_updatedby_foreign` (`updatedby`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminmenus`
--
ALTER TABLE `adminmenus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `applied_jobs`
--
ALTER TABLE `applied_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `authentication_log`
--
ALTER TABLE `authentication_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `forum_answers`
--
ALTER TABLE `forum_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `forum_questions`
--
ALTER TABLE `forum_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staffdetails`
--
ALTER TABLE `staffdetails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
