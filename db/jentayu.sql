-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 25, 2016 at 02:46 AM
-- Server version: 5.7.10
-- PHP Version: 7.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jentayu`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_items`
--

CREATE TABLE `category_items` (
  `id` int(11) NOT NULL,
  `category` varchar(200) NOT NULL,
  `category_items` varchar(200) NOT NULL,
  `qb_accountid` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_items`
--

INSERT INTO `category_items` (`id`, `category`, `category_items`, `qb_accountid`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'all', 'test', 7, 1, 0, '2016-05-02 09:50:36', '2016-05-02 10:06:44'),
(2, 'ok', 'f', 0, 0, 1, '2016-05-02 10:06:58', '2016-05-02 10:06:58');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `starting_receipt_num` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address1` varchar(200) NOT NULL,
  `address2` varchar(200) NOT NULL,
  `address3` varchar(200) NOT NULL,
  `postal_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_id`, `starting_receipt_num`, `name`, `address1`, `address2`, `address3`, `postal_code`) VALUES
(1, 1, 200, 'Jentayu', 'street # 3', '', '', '59500');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `nric` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `cob` varchar(50) NOT NULL,
  `sex` enum('male','female') NOT NULL DEFAULT 'male',
  `citizenship` varchar(50) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `race` varchar(50) NOT NULL,
  `dialect` varchar(50) NOT NULL,
  `marital_status` enum('married','divorce','single') NOT NULL DEFAULT 'single',
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `address3` varchar(255) NOT NULL,
  `address4` varchar(255) NOT NULL,
  `postal_code` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `home_phone` varchar(100) NOT NULL,
  `mobile_phone` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` enum('active','inactive','banned') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `nric`, `dob`, `cob`, `sex`, `citizenship`, `religion`, `race`, `dialect`, `marital_status`, `address1`, `address2`, `address3`, `address4`, `postal_code`, `email`, `home_phone`, `mobile_phone`, `created_by`, `updated_by`, `created_at`, `updated_at`, `status`) VALUES
(2, 'iqbal', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(3, 'malik', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(4, 'dude', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(5, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(6, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(7, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(8, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(9, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(10, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(11, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(12, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(13, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(14, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(15, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(16, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(17, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(18, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(19, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(20, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(21, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(22, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(23, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(24, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(25, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(26, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(27, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(28, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(29, 'jason', 's1723767E', '2016-04-06', '1970-01-01', 'male', 'american', '', 'Malay', '', 'single', '', '', '', '', '34349', '', '', '', 1, 1, '2016-04-24 09:10:36', '2016-04-24 11:48:36', 'active'),
(30, 'jame', 'T0715055A', '0000-00-00', '', 'male', '', '', 'Indonesian', '', '', '', '', '', '', '', '', '', '', 1, 0, '2016-04-25 20:54:20', '2016-04-25 20:54:20', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `contact_roles`
--

CREATE TABLE `contact_roles` (
  `id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `role_type_id` int(11) NOT NULL,
  `role_start` datetime NOT NULL,
  `role_end` datetime NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_roles`
--

INSERT INTO `contact_roles` (`id`, `contact_id`, `role_type_id`, `role_start`, `role_end`, `status`) VALUES
(7, 2, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `module` varchar(200) NOT NULL,
  `status` enum('enable','disable') NOT NULL DEFAULT 'enable',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Users', 'enable', '2016-04-21 09:21:03', '2016-04-21 09:21:03'),
(7, 'Contacts', 'enable', '2016-04-21 19:37:35', '2016-04-21 19:37:35'),
(8, 'Schools', 'enable', '2016-04-21 19:37:44', '2016-04-21 19:37:44'),
(9, 'Course', 'enable', '2016-04-22 07:54:45', '2016-04-22 07:54:45'),
(10, 'Class', 'enable', '2016-04-22 07:56:30', '2016-04-22 07:56:30');

-- --------------------------------------------------------

--
-- Table structure for table `operations`
--

CREATE TABLE `operations` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `operation` varchar(100) NOT NULL,
  `short_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `operations`
--

INSERT INTO `operations` (`id`, `module_id`, `operation`, `short_code`) VALUES
(9, 6, 'Add', 'add'),
(10, 6, 'Update', 'update'),
(11, 6, 'Delete', 'delete'),
(12, 6, 'View', 'view'),
(13, 7, 'Add', 'add'),
(14, 7, 'Update', 'update'),
(15, 7, 'Delete', 'delete'),
(16, 7, 'View', 'view'),
(17, 8, 'Add', 'add'),
(18, 8, 'Update', 'update'),
(19, 8, 'Delete', 'delete'),
(20, 8, 'View', 'view'),
(21, 9, 'Add', 'add'),
(22, 9, 'Update', 'update'),
(23, 9, 'Delete', 'delete'),
(24, 9, 'View', 'view'),
(25, 10, 'Add', 'add'),
(26, 10, 'Update', 'update'),
(27, 10, 'Delete', 'delete'),
(28, 10, 'View', 'view');

-- --------------------------------------------------------

--
-- Table structure for table `payment_modes`
--

CREATE TABLE `payment_modes` (
  `id` int(11) NOT NULL,
  `code` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_modes`
--

INSERT INTO `payment_modes` (`id`, `code`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`, `status`) VALUES
(1, 'VISA', 'Visa Card', 1, 0, '2016-05-10 07:15:13', '2016-05-10 03:05:06', 'active'),
(2, 'MASTER CARD', 'Master Card', 1, 0, '2016-05-10 07:15:13', '2016-05-10 03:05:06', 'active'),
(3, 'PAYONEER', 'Master Card', 1, 0, '2016-05-10 07:15:13', '2016-05-10 03:05:06', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` int(11) NOT NULL,
  `rec_number` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `replaced_by_rec_id` int(11) NOT NULL,
  `rec_date` date NOT NULL,
  `rec_amount` decimal(10,2) NOT NULL,
  `from_name` varchar(200) NOT NULL,
  `rec_notes` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `rec_number`, `contact_id`, `replaced_by_rec_id`, `rec_date`, `rec_amount`, `from_name`, `rec_notes`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`, `deleted`) VALUES
(1, 200, 2, 0, '2016-05-13', '100.00', 'Jason', 'Too easy', 1, 0, '2016-05-13 08:14:59', '2016-05-13 08:14:59', '0000-00-00 00:00:00', 0),
(2, 201, 2, 0, '2016-05-13', '100.00', 'Jason', 'Too easy', 1, 0, '2016-05-13 08:26:19', '2016-05-13 08:26:19', '0000-00-00 00:00:00', 0),
(3, 202, 2, 0, '2016-05-13', '100.00', 'Jason', 'Too easy', 1, 0, '2016-05-13 08:27:06', '2016-05-13 08:27:06', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `receipt_detail`
--

CREATE TABLE `receipt_detail` (
  `id` int(11) NOT NULL,
  `receipt_id` int(11) NOT NULL,
  `category_item_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `item` varchar(50) NOT NULL,
  `notes` varchar(250) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `receipt_detail`
--

INSERT INTO `receipt_detail` (`id`, `receipt_id`, `category_item_id`, `category`, `item`, `notes`, `amount`) VALUES
(1, 1, 1, '', ' Select Itemallok ', 'test', '100.00'),
(2, 1, 1, '', ' Select Itemallok ', 'test', '100.00'),
(3, 3, 1, '', ' Select Itemallok ', 'test', '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `receipt_payment`
--

CREATE TABLE `receipt_payment` (
  `id` int(11) NOT NULL,
  `receipt_id` int(11) NOT NULL,
  `payment_mode_id` int(11) NOT NULL,
  `payment_ref` varchar(250) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `receipt_payment`
--

INSERT INTO `receipt_payment` (`id`, `receipt_id`, `payment_mode_id`, `payment_ref`, `payment_amount`) VALUES
(1, 1, 1, '1', '100.00'),
(2, 1, 2, '2', '12.00'),
(3, 1, 3, '3', '10.00'),
(4, 1, 1, '1', '100.00'),
(5, 1, 2, '2', '12.00'),
(6, 1, 3, '3', '10.00'),
(7, 3, 1, '1', '100.00'),
(8, 3, 2, '2', '12.00'),
(9, 3, 3, '3', '10.00');

-- --------------------------------------------------------

--
-- Table structure for table `roles_type`
--

CREATE TABLE `roles_type` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles_type`
--

INSERT INTO `roles_type` (`id`, `role`, `status`) VALUES
(3, 'Parent', 'active'),
(4, 'Teacher', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `code` varchar(60) DEFAULT NULL,
  `status` enum('active','inactive','banned') NOT NULL DEFAULT 'inactive',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Jason Bourne', 'jasonbourne501@gmail.com', '$2y$10$J031nkurP6oeFQIMKEtomOOBTYrHoVfQIPDyFnrqJGXMdWqY0ZVBS', '', 'active', '2016-04-21 00:00:00', '2016-04-15 00:00:00'),
(2, 'asd', 'asd@yahoo.com', '$2y$10$k5U7ua3uwZHCpF6defVlpuGnxDDxH/UtKIgfWfNQDMKxew92Dz5vW', NULL, 'active', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'asas', 'jason@yahoo.com', '$2y$10$Dpl7b/6DkK4xUFynxL7ewOqrcTCPpN0H34f4HMVrF4xOkfHWE0S4S', NULL, 'active', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'asas', 'suresh@yahoo.com', '$2y$10$GEWS15GAolveLmHXODx4Vu67FaB3m0iDxiMf9bKn/M3uUJI1564pu', NULL, 'active', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Bravo', 'bravo@yahoo.com', '$2y$10$layceYTR17sl7SKio/sdquZgOCuwKjbhrOvHxAvK79rfchjlYx.zS', NULL, 'active', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'jamoola', 'jamoola@yahoo.com', '$2y$10$m3FVYGTKt7.H5KS11OR.iuTwDhA00nhXrzHPF2BEdLTOR2URbGQg2', NULL, 'active', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

CREATE TABLE `user_permissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `operation_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_permissions`
--

INSERT INTO `user_permissions` (`id`, `user_id`, `operation_id`, `created_at`) VALUES
(27, 1, 9, '2016-04-22 07:55:18'),
(28, 1, 10, '2016-04-22 07:55:18'),
(29, 1, 11, '2016-04-22 07:55:18'),
(30, 1, 12, '2016-04-22 07:55:18'),
(31, 1, 13, '2016-04-22 07:55:18'),
(32, 1, 14, '2016-04-22 07:55:18'),
(33, 1, 15, '2016-04-22 07:55:18'),
(34, 1, 16, '2016-04-22 07:55:18'),
(35, 1, 21, '2016-04-22 07:55:18'),
(36, 1, 22, '2016-04-22 07:55:18'),
(37, 1, 23, '2016-04-22 07:55:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_items`
--
ALTER TABLE `category_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_roles`
--
ALTER TABLE `contact_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_modes`
--
ALTER TABLE `payment_modes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipt_detail`
--
ALTER TABLE `receipt_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipt_payment`
--
ALTER TABLE `receipt_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_type`
--
ALTER TABLE `roles_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_items`
--
ALTER TABLE `category_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `contact_roles`
--
ALTER TABLE `contact_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `operations`
--
ALTER TABLE `operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `payment_modes`
--
ALTER TABLE `payment_modes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `receipt_detail`
--
ALTER TABLE `receipt_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `receipt_payment`
--
ALTER TABLE `receipt_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `roles_type`
--
ALTER TABLE `roles_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
