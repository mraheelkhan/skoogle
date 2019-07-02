-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2019 at 12:48 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_skoogle`
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
  `mselect` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
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
(91, 'Manage Departments', 'departments-index', 5, 1, NULL, NULL, 'settings/departments', 0, 'departments, settings,', 1, '2018-12-20 19:00:00', '2018-12-21 00:36:05'),
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
(125, 'Add Preference', 'create-preference', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-06 14:00:00', '2019-01-06 14:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `authentication_log`
--

CREATE TABLE `authentication_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `authenticatable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authenticatable_id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `login_at` timestamp NULL DEFAULT NULL,
  `logout_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `deptname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(10) UNSIGNED NOT NULL,
  `last_modified_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `deptname`, `status`, `user_id`, `last_modified_by`, `created_at`, `updated_at`) VALUES
(2, 'Higher Management', 1, 1, 1, '2018-12-24 00:15:03', '2018-12-24 00:15:03'),
(6, 'Administration', 1, 1, 1, '2018-12-24 00:16:21', '2018-12-24 00:16:21'),
(8, 'Software Development', 1, 1, 1, '2018-12-24 00:16:52', '2018-12-24 04:35:30');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `last_modified_by` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
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
  `scopes` text COLLATE utf8mb4_unicode_ci,
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
  `scopes` text COLLATE utf8mb4_unicode_ci,
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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `permission` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_modified_by` int(10) UNSIGNED NOT NULL,
  `modified_ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_title`, `permissions`, `permission`, `user_id`, `created_ip`, `last_modified_by`, `modified_ip`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '{\"dashboard\":true,\"main-admins\":true,\"roles-index\":true,\"admins-index\":true,\"settings\":true,\"menu-index\":true,\"customers\":true,\"customers-index\":true,\"create-staff\":true,\"show-staff\":true,\"edit-staff\":true,\"status-staff\":true,\"delete-staff\":true,\"staff-reset-password\":true,\"create-customer\":true,\"show-customer\":true,\"edit-customer\":true,\"status-customer\":true,\"delete-customer\":true,\"reset-customer-password\":true,\"show-dashboard-calendar\":true,\"departments-index\":true,\"create-department\":true,\"edit-department\":true,\"delete-department\":true,\"status-department\":true,\"designations-index\":true,\"create-designation\":true,\"edit-designation\":true,\"status-designation\":true,\"delete-designation\":true}', '1,53,2,4,28,29,30,31,32,33,5,3,6,91,92,93,94,95,117,118,119,120,121,7,8,34,35,36,37,38,39', 1, '::1', 1, '::1', 1, '2018-08-10 14:00:00', '2019-06-25 14:45:15'),
(2, 'User', '{\"dashboard\":true,\"main-customers\":true,\"customer-index\":true,\"leads-index\":true}', '1,7,8,9', 1, '::1', 1, '127.0.0.1', 1, '2018-08-10 14:00:00', '2018-09-18 22:40:48'),
(3, 'Customer', '{\\\"customer\\\\/projects\\\":true,\\\"customer-projects-index\\\":true,\\\"customer-fetch-projects\\\":true,\\\"customer-show-projects\\\":true}', '56,57,58', 22, '1', 1, '::1', 1, '2018-11-25 14:00:00', '2018-11-26 14:00:00');

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
  `skypeid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staffdetails`
--

INSERT INTO `staffdetails` (`id`, `user_id`, `dob`, `cnic`, `passportno`, `skypeid`, `created_at`, `updated_at`) VALUES
(1, 1, '1980-04-21 19:00:00', '61101-9666255-6', 'NULL', NULL, '2019-01-10 02:59:53', '2019-02-01 08:14:29');

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
  `avatar` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `iscustomer` tinyint(1) NOT NULL DEFAULT '0',
  `role_id` int(10) UNSIGNED DEFAULT NULL,
  `createdby` int(10) UNSIGNED DEFAULT NULL,
  `updatedby` int(10) UNSIGNED DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `phonenumber`, `avatar`, `status`, `remember_token`, `created_at`, `updated_at`, `iscustomer`, `role_id`, `createdby`, `updatedby`, `username`, `organization_id`) VALUES
(1, 'Raheel', 'Khan', 'admin@admin.com', '$2y$10$MntbYTaK/9avYH/zOD4U5uAjtn4aFUtk4q36MNinnQ6bPdFDK0PwO', '03333639395', 'raheel.jpg', 1, 'B5nx6EjXcrm4BBeigGpXf8MJE33sVUt4P2YZ4Ai74FdHGVNLa2DivqENkes0', '2018-06-25 10:22:52', '2019-06-25 07:24:12', 0, 1, NULL, NULL, '', 0);

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
-- Indexes for table `authentication_log`
--
ALTER TABLE `authentication_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authentication_log_authenticatable_type_authenticatable_id_index` (`authenticatable_type`,`authenticatable_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `authentication_log`
--
ALTER TABLE `authentication_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staffdetails`
--
ALTER TABLE `staffdetails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
