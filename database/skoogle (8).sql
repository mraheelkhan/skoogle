-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2019 at 11:32 AM
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
(144, 'Job Disable', 'job-admindisable', 139, NULL, NULL, NULL, 'job.admindisable', 0, 'job.admindisable', 1, '2019-03-21 09:00:00', '2019-03-27 09:00:00'),
(145, 'Manage Articles', 'post-adminindex', NULL, 1, NULL, 'fa fa-tasks', 'settings/post', 0, 'post.index, setting,', 1, '2019-03-21 04:00:00', '2019-07-06 01:12:47'),
(146, 'Post Fetch', 'post-adminfetch', 145, NULL, NULL, NULL, 'post.adminfetch', 0, 'post.adminfetch', 1, '2019-03-21 04:00:00', '2019-03-27 04:00:00'),
(147, 'Post Store', 'post-adminstore', 145, NULL, NULL, NULL, 'post.adminstore', 0, 'post.adminstore', 1, '2019-03-21 04:00:00', '2019-03-27 04:00:00'),
(148, 'Post Edit', 'post-adminedit', 145, NULL, NULL, NULL, 'post.adminedit', 0, 'post.adminedit, setting', 1, '2019-03-21 04:00:00', '2019-07-02 09:00:00'),
(149, 'Post Active', 'post-adminactive', 145, NULL, NULL, NULL, 'post.adminactive', 0, 'post.adminactive', 1, '2019-03-21 04:00:00', '2019-03-27 04:00:00'),
(150, 'Post Disable', 'post-admindisable', 145, NULL, NULL, NULL, 'post.admindisable', 0, 'post.admindisable', 1, '2019-03-21 04:00:00', '2019-03-27 04:00:00'),
(151, 'Article Admin Show', 'post-adminshow', 145, NULL, NULL, NULL, 'post.adminshow', 0, 'post.adminshow, setting,', 1, '2019-03-21 04:00:00', '2019-07-02 19:53:45');

-- --------------------------------------------------------

--
-- Table structure for table `applied_jobs`
--

CREATE TABLE `applied_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `cover_letter` text COLLATE utf8mb4_unicode_ci NOT NULL,
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
(8, 1, 1, 'here is the cover later for the job of pakistan and we are here against india and between themw we sare fgoing to kdo asolf for auf0', '1572035752Marker Clustering.png', '2432423', 1, 1, 0, '2019-10-25 15:35:52', '2019-10-25 15:35:52'),
(9, 1, 2, 'I tried and it works only if something else is clicked first eg. a link has been right clicked. Then if I click the browser close button it prompts before closing as expected. Otherwise if I go directly to the page for example and click close button straightaway it doesn\'t work and page closes. The code inside onbeforeunload function hits each but in the last case clearly has no effect.', '1572285431Etaqo.png', '2432423', 1, 1, 0, '2019-10-28 12:57:11', '2019-10-28 12:57:11');

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
(6, 'Business Development Analyst', 0, 'job', 1, 1, 0, '2019-07-05 16:32:01', '2019-07-05 16:32:01'),
(7, 'Internet of Things', 0, 'course', 1, 1, 0, '2019-11-02 12:11:45', '2019-11-02 12:11:45'),
(8, 'Artificial Intelligence', 0, 'course', 1, 1, 0, '2019-11-02 12:14:42', '2019-11-02 12:14:42'),
(9, 'Cyber Security', 0, 'course', 1, 1, 0, '2019-11-02 12:15:03', '2019-11-02 12:15:03'),
(10, 'Programming Languages', 0, 'course', 1, 1, 0, '2019-11-02 12:15:22', '2019-11-02 12:15:22'),
(11, 'Web Development', 0, 'service', 1, 1, 0, '2019-11-10 04:40:57', '2019-11-10 04:40:57'),
(12, 'WordPress Development', 0, 'service', 1, 1, 0, '2019-11-10 04:41:13', '2019-11-10 04:41:13'),
(13, 'Android Development', 0, 'service', 1, 1, 0, '2019-11-10 04:41:24', '2019-11-10 04:41:24'),
(14, 'Graphics Designing', 0, 'service', 1, 1, 0, '2019-11-10 04:41:34', '2019-11-10 04:41:34'),
(15, 'Android Development', 0, 'course', 1, 1, 0, '2019-11-10 13:43:19', '2019-11-10 13:43:19'),
(16, 'Web Development', 0, 'test', 1, 1, 0, '2019-11-10 14:35:16', '2019-11-10 14:35:16'),
(17, 'iOS Development', 0, 'test', 1, 1, 0, '2019-11-10 14:35:28', '2019-11-10 14:35:28'),
(18, 'Android Development', 0, 'test', 1, 1, 0, '2019-11-10 14:35:38', '2019-11-10 14:35:38');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `isActive` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `user_id`, `filename`, `title`, `status`, `is_deleted`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 8, '1573762711-Capture.PNG', 'Ayaz is very PTM person', 1, 0, 0, '2019-11-14 15:18:31', '2019-11-14 15:18:31'),
(2, 8, '1573762720-Capture.PNG', 'Ayaz is very PTM person', 1, 0, 0, '2019-11-14 15:18:40', '2019-11-14 15:18:40'),
(3, 8, '1573762747-Capture.PNG', 'Ayaz is very PTM person', 1, 0, 0, '2019-11-14 15:19:07', '2019-11-14 15:19:07');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chatid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `chatroomid` int(11) NOT NULL,
  `message` varchar(200) NOT NULL,
  `chat_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chatroom`
--

CREATE TABLE `chatroom` (
  `chatroomid` int(11) NOT NULL,
  `chat_name` varchar(60) NOT NULL,
  `date_created` datetime NOT NULL,
  `chat_password` varchar(30) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chatroom`
--

INSERT INTO `chatroom` (`chatroomid`, `chat_name`, `date_created`, `chat_password`, `userid`) VALUES
(1, 'My First Chat Room', '2017-09-11 13:20:18', 'leeann', 2),
(2, 'Free Entrance :)', '2017-09-11 13:20:51', '', 3),
(3, 'Admin Chat Room', '2017-09-11 13:21:24', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chatrooms`
--

CREATE TABLE `chatrooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'created_by',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'single',
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'none',
  `status` int(11) NOT NULL DEFAULT 1,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `isActive` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chatrooms`
--

INSERT INTO `chatrooms` (`id`, `user_id`, `name`, `room_type`, `code`, `logo`, `status`, `is_deleted`, `isActive`, `created_at`, `updated_at`) VALUES
(17, 8, 'Syed Abbas - Raheel', 'single', NULL, 'none', 1, 0, 0, '2019-11-14 12:03:18', '2019-11-14 12:03:18'),
(18, 1, 'React Native', 'group', '1234', 'none', 1, 0, 0, '2019-11-14 12:09:22', '2019-11-14 12:09:22'),
(19, 1, 'Android Development', 'group', '1234', 'none', 1, 1, 0, '2019-11-14 12:09:37', '2019-11-14 12:21:55'),
(20, 1, 'TestDelete chatroom', 'group', '1234', 'none', 1, 1, 0, '2019-11-14 12:24:33', '2019-11-14 12:24:46');

-- --------------------------------------------------------

--
-- Table structure for table `chatroom_messages`
--

CREATE TABLE `chatroom_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `isActive` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chatroom_messages`
--

INSERT INTO `chatroom_messages` (`id`, `user_id`, `room_id`, `message`, `filename`, `status`, `is_deleted`, `isActive`, `created_at`, `updated_at`) VALUES
(31, 8, 17, 'hello', NULL, 1, 0, 0, '2019-11-14 12:03:24', '2019-11-14 12:03:24'),
(32, 1, 17, 'han g', NULL, 1, 0, 0, '2019-11-14 12:03:35', '2019-11-14 12:03:35'),
(33, 8, 17, 'kia ho raha ha?', NULL, 1, 0, 0, '2019-11-14 12:03:40', '2019-11-14 12:03:40'),
(34, 1, 17, 'kuch nahi bs edher udher ap sunae?', NULL, 1, 0, 0, '2019-11-14 12:03:46', '2019-11-14 12:03:46'),
(35, 8, 17, 'yra kia btaon, ? ap mar jae', NULL, 1, 0, 0, '2019-11-14 12:03:53', '2019-11-14 12:03:53'),
(36, 1, 17, 'thek ha', NULL, 1, 0, 0, '2019-11-14 12:03:54', '2019-11-14 12:03:54');

-- --------------------------------------------------------

--
-- Table structure for table `chatroom_participants`
--

CREATE TABLE `chatroom_participants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `isActive` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chatroom_participants`
--

INSERT INTO `chatroom_participants` (`id`, `user_id`, `room_id`, `status`, `is_deleted`, `isActive`, `created_at`, `updated_at`) VALUES
(28, 8, 17, 1, 0, 0, '2019-11-14 12:03:18', '2019-11-14 12:03:18'),
(29, 1, 17, 1, 0, 0, '2019-11-14 12:03:18', '2019-11-14 12:03:18'),
(30, 1, 20, 1, 0, 0, '2019-11-14 12:24:40', '2019-11-14 12:24:40');

-- --------------------------------------------------------

--
-- Table structure for table `chat_member`
--

CREATE TABLE `chat_member` (
  `chat_memberid` int(11) NOT NULL,
  `chatroomid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_member`
--

INSERT INTO `chat_member` (`chat_memberid`, `chatroomid`, `userid`) VALUES
(1, 1, 2),
(2, 2, 3),
(3, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `sale_price` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1 COMMENT '0 = inactive , 1 = active',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 = pending , 1 = display, 2 = moderate, 3 = marked as spam',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 = not deleted , 1 = deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `user_id`, `title`, `description`, `subtitle`, `price`, `sale_price`, `category_id`, `isActive`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'How to visualize data in python', '4. INTELLECTUAL PROPERTY RIGHTS AND LICENSE:\r\n4.1. PRODUCT: All materials, including, but not limited to, software, programs, source code and object\r\ncode, comments to the source or object code, specifications, documents, abstracts and summaries thereof\r\n(collectively, the “Products”) developed by Isotope 11 in connection with the provision of the Services to\r\nClient, or jointly by Client and Isotope 11, or by Isotope 11 pursuant to specifications or instructions\r\nprovided by Client, shall belong exclusively to Client. Isotope 11 acknowledges that the Products shall be\r\ndeemed “works made for hire” by Isotope 11 for Client, and, therefore, shall be the exclusive property of\r\nClient. To the extent the Products are not deemed “works made for hire” under applicable law, Isotope 11\r\nhereby irrevocably assigns and transfers to Client all right, title and interest in and to the Products,\r\nincluding, without limitation, all patent and copyright interests, and agrees to execute all documents\r\nreasonably requested by Client for the purpose of applying for and obtaining domestic and foreign patent\r\nand copyright registrations.\r\n4.2. PRE-EXISTING INTELLECTUAL PROPERTY:. Notwithstanding any provision of this Agreement\r\nto the contrary, any routines, methodologies, processes, libraries, tools or technologies created, adapted or\r\nused by Isotope 11 in its business generally, including all associated intellectual property rights\r\n(collectively, the Development Tools), shall be and remain the sole property of Isotope 11, and\r\nCustomer shall have no interest in or claim to the Development Tools, except as necessary to exercise its\r\nrights in the Products. In addition, notwithstanding any provision of this Agreement to the contrary,\r\nIsotope 11 shall be free to use any ideas, concepts, or know-how developed or acquired by Isotope 11\r\nduring the performance of this Agreement to the extent obtained and retained by Isotope 11’s personnel as\r\nimpression and general learning. Subject to and limited by Client’s intellectual property rights described in\r\nSection 4.1 above, nothing in this Agreement shall be construed to preclude Isotope 11 from using the\r\nDevelopment Tools for use with third parties for the benefit of Isotope 11. ', NULL, 15000, 12000, 9, 1, 2, 0, '2019-11-01 19:00:00', '2019-11-14 13:10:54'),
(2, 2, 'How to visualize data in python', '4. INTELLECTUAL PROPERTY RIGHTS AND LICENSE:\r\n4.1. PRODUCT: All materials, including, but not limited to, software, programs, source code and object\r\ncode, comments to the source or object code, specifications, documents, abstracts and summaries thereof\r\n(collectively, the “Products”) developed by Isotope 11 in connection with the provision of the Services to\r\nClient, or jointly by Client and Isotope 11, or by Isotope 11 pursuant to specifications or instructions\r\nprovided by Client, shall belong exclusively to Client. Isotope 11 acknowledges that the Products shall be\r\ndeemed “works made for hire” by Isotope 11 for Client, and, therefore, shall be the exclusive property of\r\nClient. To the extent the Products are not deemed “works made for hire” under applicable law, Isotope 11\r\nhereby irrevocably assigns and transfers to Client all right, title and interest in and to the Products,\r\nincluding, without limitation, all patent and copyright interests, and agrees to execute all documents\r\nreasonably requested by Client for the purpose of applying for and obtaining domestic and foreign patent\r\nand copyright registrations.\r\n4.2. PRE-EXISTING INTELLECTUAL PROPERTY:. Notwithstanding any provision of this Agreement\r\nto the contrary, any routines, methodologies, processes, libraries, tools or technologies created, adapted or\r\nused by Isotope 11 in its business generally, including all associated intellectual property rights\r\n(collectively, the Development Tools), shall be and remain the sole property of Isotope 11, and\r\nCustomer shall have no interest in or claim to the Development Tools, except as necessary to exercise its\r\nrights in the Products. In addition, notwithstanding any provision of this Agreement to the contrary,\r\nIsotope 11 shall be free to use any ideas, concepts, or know-how developed or acquired by Isotope 11\r\nduring the performance of this Agreement to the extent obtained and retained by Isotope 11’s personnel as\r\nimpression and general learning. Subject to and limited by Client’s intellectual property rights described in\r\nSection 4.1 above, nothing in this Agreement shall be construed to preclude Isotope 11 from using the\r\nDevelopment Tools for use with third parties for the benefit of Isotope 11. ', NULL, 15000, 12000, 9, 1, 1, 0, '2019-11-01 19:00:00', '2019-11-01 19:00:00'),
(3, 2, 'Ayaz is very PTM person', '<p>asdfasdfasdkl;fj asd;lfjkasd ;lfjasd;kl fjasd;klfj</p>\r\n\r\n<p>asdfjasdklfj;lasd fjasd;klfj lasdkfj;lasd</p>', NULL, 0, NULL, 8, 1, 1, 1, '2019-11-04 03:04:42', '2019-11-04 03:10:37'),
(4, 1, 'Sishake Product Page', '<p>asdf asfasf asdfasd fasd fasdf</p>', NULL, 0, NULL, 8, 1, 1, 1, '2019-11-04 03:06:16', '2019-11-04 03:08:55'),
(5, 1, 'Sishake Product Page', '<p>asdf asfasf asdfasd fasd fasdf</p>', NULL, 0, NULL, 8, 1, 1, 1, '2019-11-04 03:06:29', '2019-11-04 04:33:07'),
(6, 1, 'Introduction to Java SE', '<p>To&nbsp;<em>clear</em>&nbsp;route&nbsp;<em>cache</em>&nbsp;of your&nbsp;<em>Laravel</em>&nbsp;application execute the following command from the shell. You can use config:<em>clear</em>&nbsp;to&nbsp;<em>clear</em>&nbsp;the config&nbsp;<em>cache</em>&nbsp;of the&nbsp;<em>Laravel</em>&nbsp;application. Also, you may need to&nbsp;<em>clear</em>&nbsp;compiled view files of your&nbsp;<em>Laravel</em>&nbsp;application.</p>', NULL, 0, NULL, 10, 1, 1, 0, '2019-11-04 04:33:00', '2019-11-04 04:33:00'),
(7, 1, 'Sishake Product Page', '<p>asdfdasf asdfasdfasd fasdfasdf</p>', NULL, 0, NULL, 8, 1, 1, 1, '2019-11-07 05:20:06', '2019-11-07 05:20:12'),
(8, 1, 'Ayaz is very PTM person', '<p>ayment-gateway-as-paypal-alternative1606629&nbsp;ayment-gateway-as-paypal-alternative1606629 v&nbsp;ayment-gateway-as-paypal-alternative1606629&nbsp;ayment-gateway-as-paypal-alternative1606629&nbsp;ayment-gateway-as-paypal-alternative1606629 vayment-gateway-as-paypal-alternative1606629&nbsp;ayment-gateway-as-paypal-alternative1606629&nbsp;ayment-gateway-as-paypal-alternative1606629&nbsp;ayment-gateway-as-paypal-alternative1606629 v</p>', NULL, 0, NULL, 15, 1, 1, 0, '2019-11-10 13:44:19', '2019-11-10 13:44:19');

-- --------------------------------------------------------

--
-- Table structure for table `course_applieds`
--

CREATE TABLE `course_applieds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1 COMMENT '0 = inactive , 1 = active',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 = pending , 1 = display, 2 = moderate, 3 = marked as spam',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 = not deleted , 1 = deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_applieds`
--

INSERT INTO `course_applieds` (`id`, `user_id`, `course_id`, `isActive`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 8, 8, 1, 1, 0, '2019-11-10 15:44:49', '2019-11-10 15:44:49'),
(2, 8, 8, 1, 1, 0, '2019-11-10 15:46:24', '2019-11-10 15:46:24'),
(5, 1, 6, 1, 1, 0, '2019-11-14 13:23:20', '2019-11-14 13:23:20'),
(6, 1, 8, 1, 1, 0, '2019-11-18 00:38:29', '2019-11-18 00:38:29'),
(7, 1, 8, 1, 1, 0, '2019-11-18 00:38:32', '2019-11-18 00:38:32');

-- --------------------------------------------------------

--
-- Table structure for table `course_videos`
--

CREATE TABLE `course_videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1 COMMENT '0 = inactive , 1 = active',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 = pending , 1 = display, 2 = moderate, 3 = marked as spam',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 = not deleted , 1 = deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_videos`
--

INSERT INTO `course_videos` (`id`, `user_id`, `course_id`, `title`, `file_name`, `description`, `isActive`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Introduction to Python', 'abc.mp4', 'here is the dummy description of the videos and pakistan', 1, 1, 0, '2019-11-01 19:00:00', '2019-11-01 19:00:00'),
(2, 1, 1, 'Introduction to data visualization', 'abc1.mp4', 'here is the dummy description of the videos and pakistan', 1, 1, 0, '2019-11-01 19:00:00', '2019-11-01 19:00:00'),
(3, 1, 6, 'Sishake Product Page', '3 seconds of LOL.webm', '<p>enctype=&quot;multipart/form-data&quot;</p>', 1, 1, 1, '2019-11-04 04:52:16', '2019-11-06 06:05:02'),
(4, 1, 6, 'Sishake Product Page', '3 seconds of LOL.webm', '<p>enctype=&quot;multipart/form-data&quot;</p>', 1, 1, 1, '2019-11-04 04:52:25', '2019-11-06 06:04:57'),
(5, 1, 6, 'Connects PK - Your Problem, Our Concern', '3 seconds of LOL.webm', '<p>CourseShow</p>', 1, 1, 0, '2019-11-04 04:53:55', '2019-11-04 04:53:55'),
(6, 1, 6, 'Highcharts Demo', '3 seconds of LOL.webm', '<p>asdfg</p>', 1, 1, 1, '2019-11-04 04:54:30', '2019-11-06 06:05:28'),
(7, 1, 5, 'Ayaz is very PTM person', '1572863772-Go ! Bwaaah !   [3 SECOND VIDEO].mkv', '<p>$file-&gt;getClientOriginalName()&nbsp;.&nbsp;&quot;&quot;&nbsp;.&nbsp;time();</p>', 1, 1, 0, '2019-11-04 05:36:12', '2019-11-04 05:36:12'),
(8, 1, 6, '500 initial pyament', '1572864071-3 seconds of LOL.webm', '<p>{{ asset(&#39;images/&#39;.$data-&gt;featured_image) }}</p>', 1, 1, 0, '2019-11-04 05:41:11', '2019-11-04 05:41:11'),
(9, 1, 8, 'Sishake Product Page', '1573411869-3 seconds of LOL.webm', '<p>ayment-gateway-as-paypal-alternative1606629&nbsp;ayment-gateway-as-paypal-alternative1606629&nbsp;ayment-gateway-as-paypal-alternative1606629&nbsp;ayment-gateway-as-paypal-alternative1606629&nbsp;ayment-gateway-as-paypal-alternative1606629&nbsp;ayment-gateway-as-paypal-alternative1606629 vayment-gateway-as-paypal-alternative1606629</p>', 1, 1, 0, '2019-11-10 13:51:09', '2019-11-10 13:51:09'),
(10, 1, 8, '500 initial pyament', '1573411887-Go ! Bwaaah !   [3 SECOND VIDEO].mkv', '<p>ayment-gateway-as-paypal-alternative1606629&nbsp;ayment-gateway-as-paypal-alternative1606629&nbsp;ayment-gateway-as-paypal-alternative1606629ayment-gateway-as-paypal-alternative1606629&nbsp;</p>', 1, 1, 0, '2019-11-10 13:51:28', '2019-11-10 13:51:28');

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
-- Table structure for table `enrolled_courses`
--

CREATE TABLE `enrolled_courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1 COMMENT '0 = inactive , 1 = active',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 = pending , 1 = display, 2 = moderate, 3 = marked as spam',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 = not deleted , 1 = deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrolled_courses`
--

INSERT INTO `enrolled_courses` (`id`, `user_id`, `course_id`, `isActive`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 0, '2019-11-03 19:00:00', '2019-11-03 19:00:00'),
(2, 1, 6, 1, 1, 0, '2019-11-03 19:00:00', '2019-11-03 19:00:00'),
(3, 8, 6, 1, 1, 0, '2019-11-06 04:54:27', '2019-11-06 04:54:27'),
(9, 1, 8, 1, 1, 0, '2019-11-14 12:47:51', '2019-11-14 12:47:51'),
(10, 8, 8, 1, 1, 0, '2019-11-14 12:48:00', '2019-11-14 12:48:00');

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
(5, 8, 'kay sure, thank you for your reply. i will get in touch with you skay sure, thank you for your reply. i will get in touch with you skay sure, thank you for your reply. i will get in touch with you skay sure, thank you for your reply. i will get in touch with you skay sure, thank you for your reply. i will get in touch with you skay sure, thank you for your reply. i will get in touch with you s', 4, 0, 1, 1, 1, '2019-07-04 08:12:29', '2019-10-31 03:47:26'),
(6, 8, 'kay sure, thank you for your reply. i will get in touch with you skay sure, thank you for your reply. i will get in touch with you skay sure, thank you for your reply. i will get in touch with you skay sure, thank you for your reply. i will get in touch with you skay sure, thank you for your reply. i will get in touch with you skay sure, thank you for your reply. i will get in touch with you skay sure, thank you for your reply. i will get in touch with you s', 4, 0, 1, 1, 0, '2019-07-04 08:12:35', '2019-07-05 04:28:47'),
(7, 8, 'this is answer body of the anser which is for the testing purpose of hte system', 3, 1, 1, 1, 0, '2019-07-04 15:06:31', '2019-07-04 18:20:13'),
(8, 1, 'thank you so much for your answer', 3, 0, 1, 1, 0, '2019-07-04 16:10:32', '2019-07-04 16:10:32'),
(9, 1, 'hkh klhj lkj jhlkjh ljkh klhj', 5, 1, 1, 1, 0, '2019-10-17 11:57:23', '2019-10-17 12:06:02'),
(10, 1, 'kjhklhkhklhkl hjk klh kl', 5, 0, 1, 1, 0, '2019-10-17 11:57:34', '2019-10-17 11:57:34'),
(11, 1, 'ayment-gateway -as-paypal-alter native1606629aym  ent-gateway-a s-paypal-alternative160 6629ayment-gatew ay-as-paypal-alternative1606629', 3, 0, 1, 1, 0, '2019-11-10 13:57:10', '2019-11-10 13:57:10'),
(12, 1, 'ayment-gateway -as-paypal-alter native1606629aym  ent-gateway-a s-paypal-alternative160 6629ayment-gatew ay-as-paypal-alternative1606629', 3, 0, 1, 1, 0, '2019-11-10 13:57:10', '2019-11-10 13:57:10'),
(13, 8, 'sdfasdfasd asdfasd ayment-gateway-a s-paypal-alternative1606629', 3, 0, 1, 1, 0, '2019-11-10 13:57:33', '2019-11-10 13:57:33'),
(14, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu.', 3, 0, 1, 1, 1, '2019-11-14 13:31:03', '2019-11-14 13:32:03');

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
(4, 8, 'Authentication - Laravel - The PHP Framework For Web Artisans https', 'Authentication - Laravel - The PHP Framework For Web Artisans\r\nhttps Authentication - Laravel - The PHP Framework For Web Artisans\r\nhttps Authentication - Laravel - The PHP Framework For Web Artisans\r\nhttps Authentication - Laravel - The PHP Framework For Web Artisans\r\nhttps VV Authentication - Laravel - The PHP Framework For Web Artisans\r\nhttpsAuthentication - Laravel - The PHP Framework For Web Artisans\r\nhttpsAuthentication - Laravel - The PHP Framework For Web Artisans\r\nhttpsAuthentication - Laravel - The PHP Framework For Web Artisans\r\nhttpsAuthentication - Laravel - The PHP Framework For Web Artisans\r\nhttpsAuthentication - Laravel - The PHP Framework For Web Artisans\r\nhttpsAuthentication - Laravel - The PHP Framework For Web Artisans\r\nhttpsAuthentication - Laravel - The PHP Framework For Web Artisans\r\nhttpsAuthentication - Laravel - The PHP Framework For Web Artisans\r\nhttpsAuthentication - Laravel - The PHP Framework For Web Artisans\r\nhttpsAuthentication - Laravel - The PHP Framework For Web Artisans\r\nhttps', 3, 1, 1, 0, '2019-07-04 06:22:45', '2019-07-05 05:48:55'),
(5, 8, 'Laravel auth is wonderful but how to implement it in Model', 'Then again please note that logout requires POST as HTTP request method. There are many valid reason behind this, but just to mention one very important is that in this way you can prevent cross-site request forgery.\r\n\r\nSo according to what I have just pointed out a correct way to implement this could be just this:\r\nThen again please note that logout requires POST as HTTP request method. There are many valid reason behind this, but just to mention one very important is that in this way you can prevent cross-site request forgery.\r\n\r\nSo according to what I have just pointed out a correct way to implement this could be just this:\r\nThen again please note that logout requires POST as HTTP request method. There are many valid reason behind this, but just to mention one very important is that in this way you can prevent cross-site request forgery.\r\n\r\nSo according to what I have just pointed out a correct way to implement this could be just this:\r\nThen again please note that logout requires POST as HTTP request method. There are many valid reason behind this, but just to mention one very important is that in this way you can prevent cross-site request forgery.\r\n\r\nSo according to what I have just pointed out a correct way to implement this could be just this:\r\nThen again please note that logout requires POST as HTTP request method. There are many valid reason behind this, but just to mention one very important is that in this way you can prevent cross-site request forgery.\r\n\r\nSo according to what I have just pointed out a correct way to implement this could be just this:\r\nThen again please note that logout requires POST as HTTP request method. There are many valid reason behind this, but just to mention one very important is that in this way you can prevent cross-site request forgery.\r\n\r\nSo according to what I have just pointed out a correct way to implement this could be just this:\r\nThen again please note that logout requires POST as HTTP request method. There are many valid reason behind this, but just to mention one very important is that in this way you can prevent cross-site request forgery.\r\n\r\nSo according to what I have just pointed out a correct way to implement this could be just this:\r\nThen again please note that logout requires POST as HTTP request method. There are many valid reason behind this, but just to mention one very important is that in this way you can prevent cross-site request forgery.\r\n\r\nSo according to what I have just pointed out a correct way to implement this could be just this:', 3, 1, 1, 0, '2019-07-04 06:30:37', '2019-07-04 06:30:37'),
(6, 1, 'Authentication - Laravel - The PHP Framework For Web Artisans https', 'destroy Duis dapibus aliquam mi, eget euismod sem scelerisque ut. Vivamus at elit quis urna adipiscing iaculis. Curabitur vitae velit in neque dictum blandit. Proin in iaculis nequeDuis dapibus aliquam mi, eget euismod sem scelerisque ut. Vivamus at elit quis urna adipiscing iaculis. Curabitur vitae velit in neque dictum blandit. Proin in iaculis nequeDuis dapibus aliquam mi, eget euismod sem scelerisque ut. Vivamus at elit quis urna adipiscing iaculis. Curabitur vitae velit in neque dictum blandit. Proin in iaculis neque\r\n\r\nDuis dapibus aliquam mi, eget euismod sem scelerisque ut. Vivamus at elit quis urna adipiscing iaculis. Curabitur vitae velit in neque dictum blandit. Proin in iaculis nequeDuis dapibus aliquam mi, eget euismod sem scelerisque ut. Vivamus at elit quis urna adipiscing iaculis. Curabitur vitae velit in neque dictum blandit. Proin in iaculis neque\r\nDuis dapibus aliquam mi, eget euismod sem scelerisque ut. Vivamus at elit quis urna adipiscing iaculis. Curabitur vitae velit in neque dictum blandit. Proin in iaculis nequeDuis dapibus aliquam mi, eget euismod sem scelerisque ut. Vivamus at elit quis urna adipiscing iaculis. Curabitur vitae velit in neque dictum blandit. Proin in iaculis neque', 11, 1, 1, 0, '2019-11-14 14:12:56', '2019-11-14 14:12:56');

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
(10, 1, 14, 5, 'Senior Android Developer', 'fulltime', 'location of the job is very good', '2019-10-18', 'Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job Her is description of the job', '40000-50000', 1, 1, 0, '2019-10-17 11:11:51', '2019-10-17 11:11:51'),
(11, 1, 14, 5, 'YOu will have to look for Laravel development issues and management.', 'freelance', 'Islamabad PC', '2019-11-23', 'YOu will have to look for Laravel development issues and management. YOu will have to look for Laravel development issues and management. YOu will have to look for Laravel development issues and management. YOu will have to look for Laravel development issues and management. \r\nYOu will have to look for Laravel development issues and management. YOu will have to look for Laravel development issues and management. YOu will have to look for Laravel development issues and management. \r\nYOu will have to look for Laravel development issues and management. YOu will have to look for Laravel development issues and management. \r\nYOu will have to look for Laravel development issues and management. YOu will have to look for Laravel development issues and management. \r\nYOu will have to look for Laravel development issues and management. \r\nYOu will have to look for Laravel development issues and management.', '40000-50000', 1, 2, 0, '2019-11-07 23:13:47', '2019-11-07 23:14:05'),
(12, 1, 14, 5, 'Senior Laravel Developer', 'freelance', 'Islamabad PC', '2019-11-30', 'YOu will have to look for Laravel development issues and management. YOu will have to look for Laravel development issues and management. YOu will have to look for Laravel development issues and management. \r\nYOu will have to look for Laravel development issues and management. YOu will have to look for Laravel development issues and management. YOu will have to look for Laravel development issues and management. \r\nYOu will have to look for Laravel development issues and management. YOu will have to look for Laravel development issues and management.', '40000-50000', 1, 2, 0, '2019-11-07 23:14:35', '2019-11-10 07:06:37'),
(13, 1, 0, 6, 'asdfasfasdf sa fsafsajlhf saflas flasf', 'fulltime', 'Islamabad PC', '2019-12-12', 'SELECT Countries.CountryName,Organizations.Name,Cities.CityName,[OutreachWorkerServiceDetails].ClientID, Clients.Regno,\r\n        COUNT(ClientID) [Total Contact],SUM(SyringeOut) SyringeOut,SUM(SyringeIn) SyringeIn,SUM(SpiritSwab) SpiritSwab,SUM(Bandage) SunnyPlast, SUM([OutreachWorkerServiceDetails].[Condoms]) as [Condoms]\r\n        FROM [OutreachWorkerServiceDetails]\r\n         INNER JOIN dbo.OutreachWorkerService on OutreachWorkerService.id=OutreachWorkerServiceDetails.OutreachWorkerServiceID\r\n         INNER JOIN [Clients] ON [Clients].[ID] = [OutreachWorkerServiceDetails].[ClientID]\r\n         inner join Countries on Countries.id=OutreachWorkerService.CountryID\r\n         inner join Organizations on Organizations.id=OutreachWorkerService.OrganizationID\r\n         inner join Cities on Cities.id=OutreachWorkerService.CityID\r\n        WHERE([OutreachWorkerServiceDetails].SyringeOut > 0 OR [OutreachWorkerServiceDetails].SyringeIn > 0)\r\n          AND \r\n		  [OutreachWorkerServiceDetails].ClientID IS NOT NULL\r\n          AND OutreachWorkerService.[date] between \'7-1-2016\' and \'12-31-2016\'\r\n          AND OutreachWorkerService.CountryID=168\r\n        GROUP BY  Countries.CountryName,Organizations.Name,Cities.CityName,[OutreachWorkerServiceDetails].ClientID, Clients.Regno\r\n		ORDER BY  Countries.CountryName,Organizations.Name,Cities.CityName,[OutreachWorkerServiceDetails].ClientID, Clients.Regno ASC', '40000-50000', 1, 1, 0, '2019-12-04 03:57:09', '2019-12-04 03:57:09');

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
(9, '2019_06_27_151403_create_post_comments_table', 6),
(10, '2019_06_27_142902_create_courses_table', 7),
(11, '2019_06_27_150133_create_course_videos_table', 7),
(12, '2019_06_27_150359_create_enrolled_courses_table', 7),
(14, '2019_11_09_203359_create_services_table', 8),
(16, '2019_06_27_142236_create_project_contributors_table', 9),
(17, '2019_06_27_142328_create_project_messages_table', 9),
(18, '2019_06_27_141806_create_projects_table', 10),
(19, '2019_11_10_202241_create_course_applieds_table', 11),
(20, '2019_11_10_204720_create_service_applieds_table', 12),
(21, '2019_11_12_060803_create_chatrooms_table', 13),
(22, '2019_11_12_060843_create_chatroom_messages_table', 13),
(23, '2019_11_12_060921_create_chatroom_participants_table', 13),
(24, '2019_06_27_150837_create_reports_table', 14),
(25, '2019_11_14_200446_create_certificates_table', 15);

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
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `post_date`, `post_content`, `post_title`, `image`, `post_status`, `is_comment`, `post_url`, `post_type`, `isActive`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, '<p>her eis <strong>the title </strong>of ht<strong>e apksiat</strong>n papasofjasdf lasdjkf</p>\r\n\r\n<p>asdfjklas<em>dj flasdjkf</em>lasd fjasd</p>\r\n\r\n<p>fasdfasdf</p>', 'here is the title', '1573025987-Capture.PNG', '1', 1, 'here-is-the-title-1235873', NULL, 1, 1, 0, '2019-10-27 09:13:51', '2019-10-27 09:13:51'),
(8, 1, 2, NULL, '<p>I tried and it works only if something else is clicked first eg. a link has been right clicked. Then if I click the browser close button it prompts before closing as expected. Otherwise if I go directly to the page for example and click close button straightaway it doesn&#39;t work and page closes. The code inside onbeforeunload function hits each but in the last case clearly has no effect.</p>', 'Ayaz is very PTM person', '1573025987-Capture.PNG', '1', 1, 'Ayaz-is-very-PTM-person1478464', NULL, 1, 1, 0, '2019-10-28 12:58:27', '2019-10-31 04:03:14'),
(9, 1, 3, NULL, '<p>I read comments on answer set as&nbsp;<strong>Okay</strong>. Most of the user are asking that the button and some links click should be allowed. Here one more line is added to the existing code that will work.</p>\r\n\r\n<pre>\r\n<code>&lt;script type=&quot;text/javascript&quot;&gt;\r\n  var hook = true;\r\n  window.onbeforeunload = function() {\r\n    if (hook) {\r\n\r\n      return &quot;Did you save your stuff?&quot;\r\n    }\r\n  }\r\n  function unhook() {\r\n    hook=false;\r\n  }</code></pre>\r\n\r\n<p>Call unhook() onClick for button and links which you want to allow. E.g.</p>\r\n\r\n<pre>\r\n<code>&lt;a href=&quot;#&quot; onClick=&quot;unhook()&quot;&gt;This link will allow navigation&lt;/a&gt;</code></pre>', 'i\'ll create responsive WordPress website', '1573025987-Capture.PNG', '1', 1, 'i-ll-create-responsive-WordPress-website1950801', NULL, 1, 1, 0, '2019-10-28 12:59:03', '2019-10-31 04:01:15'),
(10, 1, 3, NULL, '<p>ou can try like this: Controller : use Illuminate\\Support\\Facades\\Request; class UploadController extends Controller { public function&nbsp;<em>upload</em>(Request $request)&nbsp;...ou can try like this: Controller : use Illuminate\\Support\\Facades\\Request; class UploadController extends Controller { public function&nbsp;<em>upload</em>(Request $request)&nbsp;...&nbsp;ou can try like this: Controller : use Illuminate\\Support\\Facades\\Request; class UploadController extends Controller { public function&nbsp;<em>upload</em>(Request $request)&nbsp;...ou can try like this: Controller : use Illuminate\\Support\\Facades\\Request; class UploadController extends Controller { public function&nbsp;<em>upload</em>(Request $request)&nbsp;...ou can try like this: Controller : use Illuminate\\Support\\Facades\\Request; class UploadController extends Controller { public function&nbsp;<em>upload</em>(Request $request)&nbsp;...</p>', 'Connects PK - Your Problem, Our Concern', '1573025987-Capture.PNG', '1', 1, 'Connects-PK---Your-Problem--Our-Concern1962907', NULL, 1, 1, 0, '2019-11-04 02:49:32', '2019-11-04 02:49:32'),
(11, 1, 3, NULL, '<p>&nbsp;enctype=&quot;multipart/form-data&quot;&nbsp;&nbsp;enctype=&quot;multipart/form-data&quot;&nbsp;&nbsp;enctype=&quot;multipart/form-data&quot;&nbsp;&nbsp;enctype=&quot;multipart/form-data&quot;&nbsp;&nbsp;enctype=&quot;multipart/form-data&quot;&nbsp;&nbsp;enctype=&quot;multipart/form-data&quot;&nbsp;&nbsp;enctype=&quot;multipart/form-data&quot; v&nbsp;enctype=&quot;multipart/form-data&quot;&nbsp;enctype=&quot;multipart/form-data&quot;&nbsp;enctype=&quot;multipart/form-data&quot;&nbsp;enctype=&quot;multipart/form-data&quot;&nbsp;enctype=&quot;multipart/form-data&quot;</p>', 'i\'ll create responsive WordPress website', '1573025987-Capture.PNG', '1', 1, 'i-ll-create-responsive-WordPress-website1835232', NULL, 1, 1, 0, '2019-11-06 02:39:47', '2019-11-06 02:39:47'),
(12, 1, 5, NULL, '<p>Earn 10 skoogle coins &amp; unlock the Matching Game by posting your first service. Not sure what to offer?&nbsp;<a href=\"#\">Take our skill test</a>Earn 10 skoogle coins &amp; unlock the Matching Game by posting your first service. Not sure what to offer?&nbsp;<a href=\"#\">Take our skill test</a>Earn 10 skoogle coins &amp; unlock the Matching Game by posting your first service. Not sure what to offer?&nbsp;<a href=\"#\">Take our skill test</a></p>\r\n\r\n<p>Earn 10 skoogle coins &amp; unlock the Matching Game by posting your first service. Not sure what to offer?&nbsp;<a href=\"#\">Take our skill test</a></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Earn 10 skoogle coins &amp; unlock the <strong>Matching Game by posting y</strong>our first service. Not sure what to offer?&nbsp;<a href=\"#\">Take our skill test</a>Earn 10 skoogle coins &amp; unlock the<em> Matching Game</em> by posting your first service. Not sure what to offer?&nbsp;<a href=\"#\">Take our skill test</a>Earn 10 skoogle coins &amp; unlock the Matching Game by posting your <span class=\"marker\">first service.</span> Not sure what to offer?&nbsp;<a href=\"#\">Take our skill test</a></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Earn 10 skoogle coins &amp; unlock the Matching Game by posting your first service. Not sure what to offer?&nbsp;<a href=\"#\">Take our skill test</a></p>', 'i\'ll create responsive WordPress website', '1573410364-Capture.PNG', '1', 1, 'i-ll-create-responsive-WordPress-website1483727', NULL, 1, 1, 0, '2019-11-10 13:26:04', '2019-11-10 13:26:04');

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

--
-- Dumping data for table `post_comments`
--

INSERT INTO `post_comments` (`id`, `user_id`, `post_id`, `comment_body`, `comment_type`, `up_votes`, `isActive`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 9, 'my name is khan', NULL, 0, 1, 1, 1, '2019-10-28 13:07:44', '2019-11-12 15:36:41'),
(2, 2, 9, 'my name is khan', NULL, 0, 1, 1, 0, '2019-10-28 13:07:53', '2019-10-28 13:07:53'),
(4, 2, 9, 'this is very good pakistan', NULL, 0, 1, 1, 0, '2019-10-28 13:08:33', '2019-10-28 13:08:33'),
(5, 8, 8, 'this is the dummy comment on the post of raheel khan from raheel kahn', NULL, 0, 1, 1, 1, '2019-10-28 13:21:54', '2019-10-31 03:56:41'),
(6, 8, 8, 'this is very good ocmment on the post of raheel khan', NULL, 0, 1, 1, 1, '2019-10-31 04:04:14', '2019-10-31 04:04:23'),
(7, 8, 8, 'this is another comment and check if it appear on the backoffice of admin', NULL, 0, 1, 1, 0, '2019-10-31 04:04:46', '2019-10-31 04:04:46'),
(8, 1, 10, 'awkljfklasdjflas kfklas fjaskljfasd', NULL, 0, 1, 1, 1, '2019-11-10 13:14:21', '2019-11-10 13:15:54'),
(9, 8, 10, 'askldjflas fjasfnm,asfnas fn,masdnfasdf', NULL, 0, 1, 1, 0, '2019-11-10 13:14:38', '2019-11-10 13:14:38'),
(10, 1, 12, 'commentscom  mentscomments', NULL, 0, 1, 1, 0, '2019-11-10 13:28:11', '2019-11-10 13:28:11'),
(11, 1, 12, 'comments comments comments comments comments', NULL, 0, 1, 1, 0, '2019-11-10 13:28:21', '2019-11-10 13:28:21');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_type` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1 COMMENT '0 = inactive , 1 = active',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 = pending , 1 = display, 2 = moderate, 3 = marked as spam',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 = not deleted , 1 = deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `user_id`, `title`, `image`, `description`, `project_type`, `category_id`, `start_date`, `end_date`, `url`, `isActive`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Semester Schedulling System in Android', NULL, 'This is the prject which is required by a university to automate their semester schedule which will show the times and dates of the activities including the exams and assignments etc. ', NULL, 1, NULL, '2019-11-20', 'Semester-Schedulling-System-in-Android12353', 1, 1, 1, '2019-11-09 19:00:00', '2019-12-04 02:32:51'),
(2, 1, 'Sishake Product Page', NULL, 'Select2 will register itself as a jQuery function if you use any of the distribution builds, so you can call .select2() on any jQuery selector where you would like to initialize Select2.\r\n 2019-11-15\r\nSelect2 will register itself as a jQuery function if you use any of the distribution builds, so you can call .select2() on any jQuery selector where you would like to initialize Select2.\r\n 2019-11-15\r\nSelect2 will register itself as a jQuery function if you use any of the distribution builds, so you can call .select2() on any jQuery selector where you would like to initialize Select2.\r\n 2019-11-15\r\nSelect2 will register itself as a jQuery function if you use any of the distribution builds, so you can call .select2() on any jQuery selector where you would like to initialize Select2.', NULL, 13, NULL, '2019-11-15', 'Sishake-Product-Page1163948', 1, 1, 1, '2019-11-10 07:18:22', '2019-11-14 12:46:17'),
(3, 1, 'Ayaz is very PTM person', NULL, 'markAsClosed markAsClosed markAsClosed markAsClosed markAsClosed markAsClosed markAsClosed markAsClosed markAsClosed markAsClosed markAsClosed markAsClosed markAsClosed markAsClosed markAsClosed markAsClosed markAsClosed markAsClosed', NULL, 11, NULL, '2019-11-28', 'Ayaz-is-very-PTM-person1624986', 1, 1, 1, '2019-11-10 07:30:27', '2019-11-12 15:42:28'),
(4, 1, 'Payment gateway as paypal alternative', NULL, 'ayment-gateway-as-paypal-alt\r\nernative1606629ayment-gat\r\neway-as-paypal-alternative1\r\n606629ayment-gateway-as-\r\npaypal-alternative1606629\r\nayment-gateway-as-paypal-a\r\nlternative1606629ayment-gateway-as-paypal-alternative1606629', NULL, 12, NULL, '2019-11-30', 'Payment-gateway-as-paypal-alternative1606629', 1, 1, 1, '2019-11-10 13:41:49', '2019-11-12 15:42:22'),
(5, 1, 'WordPress plugin development using Vue JS', NULL, 'Try:\r\n\r\nChecking the network cables, modem, and router\r\nReconnecting to Wi-Fi\r\nRunning Windows Network Diagnostics\r\nERR_INTERNET_DISCONNECTED\r\nTry:\r\n\r\nChecking the network cables, modem, and router\r\nReconnecting to Wi-Fi\r\nRunning Windows Network Diagnostics\r\nERR_INTERNET_DISCONNECTED\r\nTry:\r\n\r\nChecking the network cables, modem, and router\r\nReconnecting to Wi-Fi\r\nRunning Windows Network Diagnostics\r\nERR_INTERNET_DISCONNECTED', NULL, 12, NULL, '2019-11-29', 'WordPress-plugin-development-using-Vue-JS1229407', 1, 1, 0, '2019-11-14 14:30:49', '2019-11-14 14:30:49'),
(6, 1, 'Highcharts Demo dfa ea dfas fe adfa s', '1575447775-Web-Slider-v1.jpg', '<p>And let me tell you--this week&rsquo;s Get Ruthed coaching session with EBA student Stacey Freeman is one that you&rsquo;ll definitely NOT want to miss, especially if you&rsquo;ve ever had a setback that shook your confidence to the core. We&rsquo;re talking about how to bounce back from failure and keep going, even when you feel like giving up.</p>', NULL, 14, NULL, '2019-12-25', 'Highcharts-Demo-dfa-ea-dfas-fe-adfa-s1803969', 1, 1, 1, '2019-12-04 03:22:55', '2019-12-04 03:25:13'),
(7, 1, 'Sishake Product Page asdasd asdadw wa asdaw', '1575447903-Web-Slider.jpg', '<p>And let me tell you--this week&rsquo;s Get Ruthed coaching session with EBA student Stacey Freeman is one that you&rsquo;ll definitely NOT want to miss, especially if you&rsquo;ve ever had a setback that shook your confidence to the core. We&rsquo;re talking about how to bounce back from failure and keep going, even when you feel like giving up.</p>', NULL, 12, NULL, '2019-12-26', 'Sishake-Product-Page-asdasd-asdadw-wa-asdaw1056506', 1, 1, 0, '2019-12-04 03:25:03', '2019-12-04 03:25:03');

-- --------------------------------------------------------

--
-- Table structure for table `project_contributors`
--

CREATE TABLE `project_contributors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1 COMMENT '0 = inactive , 1 = active',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 = pending , 1 = display, 2 = moderate, 3 = marked as spam',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 = not deleted , 1 = deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_contributors`
--

INSERT INTO `project_contributors` (`id`, `user_id`, `project_id`, `isActive`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 8, 2, 1, 1, 0, '2019-11-10 08:36:26', '2019-11-10 08:36:26'),
(2, 1, 2, 1, 1, 0, '2019-11-10 08:37:24', '2019-11-10 08:37:24'),
(3, 8, 3, 1, 1, 0, '2019-11-10 08:51:41', '2019-11-10 08:51:41'),
(4, 8, 1, 1, 1, 0, '2019-11-10 13:35:46', '2019-11-10 13:35:46');

-- --------------------------------------------------------

--
-- Table structure for table `project_messages`
--

CREATE TABLE `project_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `message_body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1 COMMENT '0 = inactive , 1 = active',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 = pending , 1 = display, 2 = moderate, 3 = marked as spam',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 = not deleted , 1 = deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'initiator of report',
  `reporter_id` int(11) NOT NULL COMMENT 'comment, post, course or review etc ID',
  `reported_user_id` int(11) NOT NULL COMMENT 'against id - fk of usertable',
  `report_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_body` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1 COMMENT '0 = inactive , 1 = active',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 = pending , 1 = display, 2 = moderate, 3 = marked as spam',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 = not deleted , 1 = deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `user_id`, `reporter_id`, `reported_user_id`, `report_type`, `message_body`, `isActive`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 8, 'False Info', NULL, 1, 1, 0, '2019-11-12 15:10:39', '2019-11-12 15:10:39'),
(2, 1, 2, 8, 'Hate Speach', NULL, 1, 1, 0, '2019-11-12 15:11:27', '2019-11-12 15:11:27'),
(3, 1, 2, 2, 'Harrassment', NULL, 1, 1, 0, '2019-11-12 15:36:57', '2019-11-12 15:36:57'),
(4, 8, 11, 11, 'False Info', NULL, 1, 1, 0, '2019-11-14 13:33:51', '2019-11-14 13:33:51'),
(5, 8, 5, 5, 'Harrassment', NULL, 1, 1, 0, '2019-11-14 13:37:00', '2019-11-14 13:37:00'),
(6, 8, 5, 5, 'Harrassment', NULL, 1, 1, 0, '2019-11-14 13:51:42', '2019-11-14 13:51:42'),
(7, 8, 5, 8, 'Harrassment', NULL, 1, 1, 0, '2019-11-14 13:57:31', '2019-11-14 13:57:31'),
(8, 1, 5, 8, 'False Info', NULL, 1, 1, 0, '2019-11-14 14:03:46', '2019-11-14 14:03:46'),
(9, 1, 5, 8, 'Hate Speach', NULL, 1, 1, 0, '2019-11-14 14:04:02', '2019-11-14 14:04:02'),
(10, 1, 7, 7, 'False Info', NULL, 1, 1, 0, '2019-12-04 02:32:04', '2019-12-04 02:32:04'),
(11, 1, 7, 7, 'Harrassment', NULL, 1, 1, 0, '2019-12-04 02:32:16', '2019-12-04 02:32:16'),
(12, 1, 6, 1, 'False Info', NULL, 1, 1, 0, '2019-12-04 02:40:39', '2019-12-04 02:40:39');

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
(1, 'Super Admin', '{\"dashboard\":true,\"main-admins\":true,\"roles-index\":true,\"admins-index\":true,\"settings\":true,\"menu-index\":true,\"customers\":true,\"customers-index\":true,\"create-staff\":true,\"show-staff\":true,\"edit-staff\":true,\"status-staff\":true,\"delete-staff\":true,\"staff-reset-password\":true,\"create-customer\":true,\"show-customer\":true,\"edit-customer\":true,\"status-customer\":true,\"delete-customer\":true,\"reset-customer-password\":true,\"show-dashboard-calendar\":true,\"departments-index\":true,\"create-department\":true,\"edit-department\":true,\"delete-department\":true,\"status-department\":true,\"designations-index\":true,\"create-designation\":true,\"edit-designation\":true,\"status-designation\":true,\"delete-designation\":true,\"category-index\":true,\"category-fetch\":true,\"category-store\":true,\"category-edit\":true,\"category-active\":true,\"category-disable\":true,\"forum-adminindex\":true,\"forum-adminfetch\":true,\"forum-adminstore\":true,\"forum-adminedit\":true,\"forum-adminactive\":true,\"forum-admindisable\":true,\"forum-adminshow\":true,\"job-adminindex\":true,\"job-adminfetch\":true,\"job-adminstore\":true,\"job-adminedit\":true,\"job-adminactive\":true,\"job-admindisable\":true,\"post-adminindex\":true,\"post-adminfetch\":true,\"post-adminstore\":true,\"post-adminedit\":true,\"post-adminactive\":true,\"post-admindisable\":true,\"post-adminshow\":true}', '1,53,2,4,28,29,30,31,32,33,5,3,6,91,92,93,94,95,117,118,119,120,121,126,127,128,129,130,131,7,8,34,35,36,37,38,39,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151', 1, '::1', 1, '::1', 1, '2018-08-10 14:00:00', '2019-10-31 03:45:06'),
(2, 'User', '{\"dashboard\":true,\"main-customers\":true,\"customer-index\":true,\"leads-index\":true}', '1,7,8,9', 1, '::1', 1, '127.0.0.1', 1, '2018-08-10 14:00:00', '2018-09-18 22:40:48'),
(3, 'Customer', '{\\\"customer\\\\/projects\\\":true,\\\"customer-projects-index\\\":true,\\\"customer-fetch-projects\\\":true,\\\"customer-show-projects\\\":true}', '56,57,58', 22, '1', 1, '::1', 1, '2018-11-25 14:00:00', '2018-11-26 14:00:00'),
(4, 'Admin', '{\"dashboard\":true,\"main-admins\":true,\"admins-index\":true,\"settings\":true,\"menu-index\":true,\"customers\":true,\"customers-index\":true,\"create-staff\":true,\"show-staff\":true,\"edit-staff\":true,\"status-staff\":true,\"delete-staff\":true,\"staff-reset-password\":true,\"create-customer\":true,\"show-customer\":true,\"edit-customer\":true,\"status-customer\":true,\"delete-customer\":true,\"reset-customer-password\":true,\"departments-index\":true,\"create-department\":true,\"edit-department\":true,\"delete-department\":true,\"status-department\":true,\"designations-index\":true,\"create-designation\":true,\"edit-designation\":true,\"status-designation\":true,\"delete-designation\":true}', '1,2,4,28,29,30,31,32,33,5,6,91,92,93,94,95,117,118,119,120,121,7,8,34,35,36,37,38,39', 1, '::1', 1, '::1', 1, '2019-07-01 19:00:00', '2019-07-01 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'fulltime, part time, freelance, depends',
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1 COMMENT '0 = inactive , 1 = active',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 = pending , 1 = display, 2 = moderate, 3 = marked as spam',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 = not deleted , 1 = deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `user_id`, `url`, `category_id`, `title`, `description`, `image`, `type`, `price`, `isActive`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'I-will-create-a-web-site-for-you1043192', 11, 'I will create a web site for you', 'This is the dummy text for services page which can edited a deleted from both user and admin side. all you have to just push the button of delete. \r\nThis is the dummy text for services page which can edited a deleted from both user and admin side. all you have to just push the button of delete. \r\n\r\nThis is the dummy text for services page which can edited a deleted from both user and admin side. all you have to just push the button of delete. \r\n\r\nThis is the dummy text for services page which can edited a deleted from both user and admin side. all you have to just push the button of delete.', '1575446748-Web-Slider-v1.jpg', NULL, '50000', 1, 1, 0, '2019-11-10 05:06:14', '2019-11-10 05:06:14'),
(2, 1, 'I-will-create-a-website-for-you1384800', 12, 'I will create a website for you', 'This is the dummy text for services page which can edited a deleted from both user and admin side. all you have to just push the button of delete. \r\nThis is the dummy text for services page which can edited a deleted from both user and admin side. all you have to just push the button of delete. \r\nThis is the dummy text for services page which can edited a deleted from both user and admin side. all you have to just push the button of delete. \r\nThis is the dummy text for services page which can edited a deleted from both user and admin side. all you have to just push the button of delete.', '1575446748-Web-Slider-v1.jpg', NULL, '50000', 1, 1, 0, '2019-11-10 05:06:51', '2019-11-10 05:40:13'),
(3, 1, 'Web-App-Development-service1204014', 11, 'Web App Development service', 'Here is the dummy text for the creation of Pakistan web app develppment which might help everyone in the country to be more fruitfull to each other. a Here is the dummy text for the creation of Pakistan web app develppment which might help everyone in the country to be more fruitfull to each other. aHere is the dummy text for the creation of Pakistan web app develppment which might help everyone in the country to be more fruitfull to each other. aHere is the dummy text for the creation of Pakistan web app develppment which might help everyone in the country to be more fruitfull to each other. aHere is the dummy text for the creation of Pakistan web app develppment which might help everyone in the country to be more fruitfull to each other. a', '1575446748-Web-Slider-v1.jpg', NULL, '150000', 1, 1, 0, '2019-11-10 05:35:37', '2019-11-10 05:52:45'),
(6, 1, 'Create-Android-App-with-API-Call1251489', 14, 'Create Android App with API Call', '<p>H&nbsp;ave questions, comments or just want to say hello:ave questions, comments or just want to say hello:ave questions, comments or just want to say hello:ave questions, comments or just want to say hello:</p>\r\n\r\n<ul>\r\n	<li><a href=\"#\">info@s</a></li>\r\n	<li>gwgfasdfas</li>\r\n	<li>fasdf</li>\r\n	<li>asdf</li>\r\n	<li>asdf</li>\r\n	<li>asdf</li>\r\n	<li>asdfasd</li>\r\n	<li>fasd</li>\r\n	<li>f</li>\r\n</ul>', '1575446748-Web-Slider-v1.jpg', NULL, '60000', 1, 2, 0, '2019-11-10 13:30:19', '2019-11-14 12:44:08'),
(7, 1, 'Connects-PK---Your-Problem--Our-Concernaasd1323850', 12, 'Connects PK - Your Problem, Our Concernaasd', '<p>&nbsp;enctype=&quot;multipart/form-data&quot;&nbsp;ye bayan sunney ke baad sochta hu ke kal qayamat ke din ALLAH ke samney mai ALLAH ko,aap swallallahu alaihi wasallam ko aur sahaba o ko kya muh dikhaunga aur kya jawab dunga..ya ALLAH hamey kahne sunnay se ziada ikhlaas ke sath maut tak amal karne ki taufiq ata farma.. ameen ameen yaRabbulaalamin</p>', '1575446748-Web-Slider-v1.jpg', NULL, NULL, 1, 1, 0, '2019-12-04 03:05:48', '2019-12-04 03:05:48');

-- --------------------------------------------------------

--
-- Table structure for table `service_applieds`
--

CREATE TABLE `service_applieds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT 1 COMMENT '0 = inactive , 1 = active',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 = pending , 1 = display, 2 = moderate, 3 = marked as spam',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0 = not deleted , 1 = deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_applieds`
--

INSERT INTO `service_applieds` (`id`, `user_id`, `service_id`, `isActive`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(2, 8, 6, 1, 1, 0, '2019-11-10 15:56:49', '2019-11-10 15:56:49'),
(4, 8, 2, 1, 1, 0, '2019-11-14 12:37:19', '2019-11-14 12:37:19'),
(5, 1, 2, 1, 1, 0, '2019-11-14 13:14:44', '2019-11-14 13:14:44');

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
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skypeid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staffdetails`
--

INSERT INTO `staffdetails` (`id`, `user_id`, `dob`, `cnic`, `passportno`, `gender`, `address`, `description`, `skypeid`, `created_at`, `updated_at`) VALUES
(1, 1, '1980-04-21 19:00:00', '61101-9666255-6', 'NULL', '', 'F7, Blue Area, Islamabad', 'I am very energetic developer who does not say NO on any kind of development. ', NULL, '2019-01-10 02:59:53', '2019-02-01 08:14:29'),
(2, 11, NULL, NULL, NULL, 'male', NULL, NULL, NULL, '2019-11-10 12:50:36', '2019-11-10 12:50:36'),
(3, 12, NULL, NULL, NULL, 'male', NULL, NULL, NULL, '2019-11-14 16:33:43', '2019-11-14 16:33:43'),
(4, 13, NULL, NULL, NULL, 'male', NULL, NULL, NULL, '2019-11-14 16:35:12', '2019-11-14 16:35:12'),
(5, 14, NULL, NULL, NULL, 'male', NULL, NULL, NULL, '2019-11-14 16:35:35', '2019-11-14 16:35:35');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(150) NOT NULL,
  `uname` varchar(60) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `access` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `uname`, `photo`, `access`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', '', 1),
(2, 'lee', '7e0d7f8a5d96c24ffcc840f31bce72b2', 'lee', '', 2),
(3, 'julyn', 'bf70c261981e1708530982d56d2e8e01', 'julyn', '', 2);

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
(1, 'Raheelaa', 'Khanasfasd', 'admin@admin.com', '$2y$10$MntbYTaK/9avYH/zOD4U5uAjtn4aFUtk4q36MNinnQ6bPdFDK0PwO', '03333639395', '1573761020-central_database-512.png', 1, 'YpTzXfkjL4IS5NVwPqmY3vso3IlQUGbvct6wt0p5GQ1L9hxY4y1YGJ1eBLSG', '2018-06-25 10:22:52', '2019-11-14 14:58:28', 0, 1, 1, NULL, NULL, '', 1, 0),
(7, 'Raheel', 'Khan', 'adminaaa@admin.com', '$2y$10$.ltGPfRid5qNIYrRz6Q/bOZ4dXNX./869VJm7Kfp1fxfTNAwKLQMi', '3333639395', 'default_avatar_male.jpg', 1, NULL, '2019-07-01 19:00:00', '2019-07-02 02:45:45', 1, NULL, 2, NULL, NULL, NULL, 15, 0),
(8, 'Syed Abbas', 'Khan', 'abbas@gmail.com', '$2y$10$MntbYTaK/9avYH/zOD4U5uAjtn4aFUtk4q36MNinnQ6bPdFDK0PwO', '3333222211', 'default_avatar_male.jpg', 1, NULL, '2019-07-01 19:00:00', '2019-11-14 15:46:41', 0, 2, 2, NULL, NULL, NULL, 8, 0),
(9, 'janan', 'khan', 'test@gmail.com', '$2y$10$ARpKBXaP6NicpVb4RxQiS.v2/yUV3wCsu5rX9uWBFrFN8og09Y5ye', NULL, '1573408019-central_database-512.png', 1, NULL, '2019-11-10 12:47:00', '2019-11-10 12:47:00', 0, NULL, 2, NULL, NULL, NULL, 0, 0),
(10, 'hilal', 'khan', 'test2@gmail.com', '$2y$10$.BVpHqvnea4eLPh9ytCDFOIFjsK6S4p44pHm9sEULic/MGyD2MFRO', NULL, '1573408148-inventory-icon.png', 1, NULL, '2019-11-10 12:49:08', '2019-11-10 12:49:08', 0, NULL, 2, NULL, NULL, NULL, 0, 0),
(11, 'maryam', 'khan', 'test24@gmail.com', '$2y$10$Iu/onC.p3YU.dNN6wQjHyOymtrna9ETXdnXb9pm1vqwLWl5/K4SB.', '923333639395', '1573408236-360-customer-im2.jpg', 1, NULL, '2019-11-10 12:50:36', '2019-11-10 12:50:36', 0, NULL, 2, NULL, NULL, NULL, 0, 0),
(12, 'asdf', 'asdlf', 'kslfjsdal@gasdl.cmo', '$2y$10$JJ5DN2BibiCzzWGBX0E4D.8r5uvA3DKSdTL7NJkPlAWfTo1PsxhIu', '1242345234', '1573767223-central_database-512.png', 1, NULL, '2019-11-14 16:33:43', '2019-11-14 16:33:43', 0, NULL, 2, NULL, NULL, NULL, 0, 0),
(13, 'asdf', 'asdlf', 'kslfjsssdal@gasdl.cmo', '$2y$10$u6I2ih52Qjo/6uZ2AV4yfuis468bACdOqN2fJyktPUl4/fJLITGu.', '1242345234', '1573767312-central_database-512.png', 1, NULL, '2019-11-14 16:35:12', '2019-11-14 16:35:12', 0, NULL, 2, NULL, NULL, NULL, 0, 0),
(14, 'asdf', 'asdlf', 'kslfjsssdal@gasdssl.cmo', '$2y$10$ZC2r19RsGLm9Ny/GSGieTO6cu3jxFsG96H2b0xp3Xlduo8tBMOeR2', '1242345234', '1573767335-Capture.PNG', 1, NULL, '2019-11-14 16:35:35', '2019-11-14 16:35:35', 0, NULL, 2, NULL, NULL, NULL, 0, 0);

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
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chatid`);

--
-- Indexes for table `chatroom`
--
ALTER TABLE `chatroom`
  ADD PRIMARY KEY (`chatroomid`);

--
-- Indexes for table `chatrooms`
--
ALTER TABLE `chatrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatroom_messages`
--
ALTER TABLE `chatroom_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatroom_participants`
--
ALTER TABLE `chatroom_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_member`
--
ALTER TABLE `chat_member`
  ADD PRIMARY KEY (`chat_memberid`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_applieds`
--
ALTER TABLE `course_applieds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_videos`
--
ALTER TABLE `course_videos`
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
-- Indexes for table `enrolled_courses`
--
ALTER TABLE `enrolled_courses`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_url_unique` (`url`);

--
-- Indexes for table `project_contributors`
--
ALTER TABLE `project_contributors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_messages`
--
ALTER TABLE `project_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_user_id_foreign` (`user_id`),
  ADD KEY `roles_last_modified_by_foreign` (`last_modified_by`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_url_unique` (`url`);

--
-- Indexes for table `service_applieds`
--
ALTER TABLE `service_applieds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffdetails`
--
ALTER TABLE `staffdetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staffdetails_cnic_unique` (`cnic`),
  ADD UNIQUE KEY `staffdetails_passportno_unique` (`passportno`),
  ADD KEY `staffdetails_user_id_foreign` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `applied_jobs`
--
ALTER TABLE `applied_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `authentication_log`
--
ALTER TABLE `authentication_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chatid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chatroom`
--
ALTER TABLE `chatroom`
  MODIFY `chatroomid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chatrooms`
--
ALTER TABLE `chatrooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `chatroom_messages`
--
ALTER TABLE `chatroom_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `chatroom_participants`
--
ALTER TABLE `chatroom_participants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `chat_member`
--
ALTER TABLE `chat_member`
  MODIFY `chat_memberid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `course_applieds`
--
ALTER TABLE `course_applieds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `course_videos`
--
ALTER TABLE `course_videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- AUTO_INCREMENT for table `enrolled_courses`
--
ALTER TABLE `enrolled_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `forum_answers`
--
ALTER TABLE `forum_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `forum_questions`
--
ALTER TABLE `forum_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `project_contributors`
--
ALTER TABLE `project_contributors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `project_messages`
--
ALTER TABLE `project_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `service_applieds`
--
ALTER TABLE `service_applieds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staffdetails`
--
ALTER TABLE `staffdetails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
