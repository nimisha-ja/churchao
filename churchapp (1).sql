-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2025 at 03:49 PM
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
-- Database: `churchapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(2, 'feast', 'july 28', '2025-06-28 13:42:45', '2025-06-29 12:08:55');

-- --------------------------------------------------------

--
-- Table structure for table `certificate_requests`
--

CREATE TABLE `certificate_requests` (
  `id` int(11) NOT NULL,
  `family_id` int(11) NOT NULL,
  `certificate_type` varchar(50) NOT NULL,
  `details` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `certificate_file` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificate_requests`
--

INSERT INTO `certificate_requests` (`id`, `family_id`, `certificate_type`, `details`, `status`, `certificate_file`, `created_at`, `updated_at`) VALUES
(1, 17, 'Baptism', 'Please prepare certificate by next Sunday.', 'Rejected', NULL, '2025-06-26 18:01:14', '2025-06-28 15:51:14'),
(2, 17, 'Death', 'eff', 'Pending', NULL, '2025-06-26 13:03:12', '2025-06-26 13:03:12'),
(3, 15, 'Baptism', 'nm', 'Approved', '1751107071_83bed1870fdae9893c3e.pdf', '2025-06-28 09:16:46', '2025-06-28 16:07:51');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `family_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `donation_date` date NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `purpose_id` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `family_id`, `amount`, `donation_date`, `notes`, `created_at`, `purpose_id`, `updated_at`) VALUES
(1, 15, 1000000.00, '2025-06-19', '', '2025-06-29 18:03:52', 1, '2025-06-29 18:03:52'),
(2, 17, 12000.00, '2025-06-29', '', '2025-06-29 18:04:51', 1, '2025-06-29 18:37:26');

-- --------------------------------------------------------

--
-- Table structure for table `donation_purposes`
--

CREATE TABLE `donation_purposes` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation_purposes`
--

INSERT INTO `donation_purposes` (`id`, `title`, `description`, `is_active`) VALUES
(1, 'church building donation', 'church building donation', 1);

-- --------------------------------------------------------

--
-- Table structure for table `families`
--

CREATE TABLE `families` (
  `family_id` int(11) NOT NULL,
  `family_code` varchar(20) DEFAULT NULL,
  `family_name` varchar(100) NOT NULL,
  `head_of_family` varchar(100) NOT NULL,
  `members_count` int(11) DEFAULT 1,
  `address` text DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `family_email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `registered_on` date DEFAULT NULL,
  `photo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `families`
--

INSERT INTO `families` (`family_id`, `family_code`, `family_name`, `head_of_family`, `members_count`, `address`, `contact_number`, `family_email`, `password`, `registered_on`, `photo`) VALUES
(15, 'FAM-00123', 'The Johnsons', 'Michael Johnson', 2, 'saloni', '0983938939', 'family1@capp.com', '1234', '2025-06-26', '1751370026_3004df4c2e62fafe5a44.jpg'),
(17, 'AWE43', 'Ravuther', 'samsion', 3, '', '1321243434', 'awce@capp.com', '1234', '2025-06-12', '1751370102_0008ec0a3b56918acc68.jpg'),
(22, 'FAM-00018', 'hilson', 'hilsa', 2, '', '', 'hilsa@capp.com', '1234', '0000-00-00', NULL),
(23, 'FAM-00023', 'Mukesh Ambani', 'mukesh', 8, '', '', 'ambani@capp.com', '1234', '0000-00-00', '1751369913_d4c9b8dc511f4911e143.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `family_members`
--

CREATE TABLE `family_members` (
  `member_id` int(11) NOT NULL,
  `family_id` int(11) NOT NULL,
  `family_code` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `relation_to_head` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `job` varchar(100) DEFAULT NULL,
  `education` varchar(100) DEFAULT NULL,
  `current_status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `family_members`
--

INSERT INTO `family_members` (`member_id`, `family_id`, `family_code`, `full_name`, `relation_to_head`, `date_of_birth`, `gender`, `job`, `education`, `current_status`) VALUES
(45, 22, '', 'jacobt', 'wife', '0000-00-00', '', '', '', ''),
(53, 15, '', 'ahaana', 'wife', '0000-00-00', '', '', '', ''),
(54, 23, '', 'Nita', 'wife', '2025-07-02', 'female', '', '', ''),
(55, 17, '', 'sharan', '', '0000-00-00', 'f', '', '', ''),
(56, 17, '', 'vineetha', 'wife', '0000-00-00', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `hub`
--

CREATE TABLE `hub` (
  `hub_id` int(11) NOT NULL,
  `hub_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hub`
--

INSERT INTO `hub` (`hub_id`, `hub_name`) VALUES
(1, 'Kochi'),
(2, 'Kozhikode'),
(3, 'Kottayam');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `url`, `icon`, `parent_id`, `role_id`, `order`, `is_active`) VALUES
(1, 'Dashboards', '/dashboard', 'ri-dashboard-2-line', NULL, 1, 1, 1),
(4, 'User Accounts', '#', 'ri-wallet-line', NULL, 1, 4, 0),
(5, 'Privileges', '#', 'ri-key-line', NULL, 1, 5, 1),
(6, 'Staff Management', '#', 'ri-apps-2-line', NULL, 1, 6, 0),
(10, 'Reports', '#', 'ri-rhythm-line', NULL, 1, 10, 1),
(19, 'Add User Account', '/adduser', NULL, 4, 1, 1, 1),
(20, 'User Account List', '/useraccounts', NULL, 4, 1, 2, 1),
(21, 'Add Privilege', '/addprivilages', NULL, 5, 1, 1, 1),
(22, 'Privilege List', '/listPrivileges', NULL, 5, 1, 2, 1),
(23, 'Add Staff', '/newstaff', NULL, 6, 1, 1, 1),
(24, 'Staff Details', '/staffmanagement', NULL, 6, 1, 2, 1),
(49, 'Family', '#', 'ri-rhythm-line', NULL, 1, 11, 1),
(50, 'Family List', '/families', NULL, 49, 1, 1, 1),
(51, 'Create Family', '/family/create', NULL, 49, 1, 2, 1),
(52, 'Request Certificate', '/family/request-certificate', NULL, 49, 1, 3, 1),
(53, 'Family Requests', '/family/requests', NULL, 49, 1, 4, 1),
(54, 'Family Certificates', '/family/certificates', NULL, 49, 1, 5, 1),
(55, 'Announcements', '#', 'ri-store-2-line', NULL, 1, 12, 1),
(56, 'Announcements', '/announcements', NULL, 55, 1, 1, 1),
(57, 'add announcements', 'add-announcements', NULL, 55, 1, 2, 1),
(58, 'Donation ', '#', 'ri-book-line', NULL, 1, 13, 1),
(59, 'Donation Purposes', '/donationpurposes', NULL, 58, 1, 1, 1),
(60, 'Add Donation  Puprose', 'donationpurposes/create', NULL, 58, 1, 2, 1),
(61, 'Add Donation', 'donation/add', NULL, 58, 1, 4, 1),
(62, 'Donations', 'donations', NULL, 58, 1, 3, 1),
(63, 'Payment', 'payment', NULL, 58, 1, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_role`
--

CREATE TABLE `menu_role` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_role`
--

INSERT INTO `menu_role` (`id`, `menu_id`, `role_id`) VALUES
(209, 1, 2),
(210, 2, 2),
(211, 11, 2),
(212, 12, 2),
(213, 13, 2),
(214, 14, 2),
(215, 15, 2),
(216, 16, 2),
(217, 10, 2),
(218, 37, 2),
(219, 38, 2),
(220, 39, 2),
(439, 1, 1),
(440, 5, 1),
(441, 21, 1),
(442, 22, 1),
(443, 49, 1),
(444, 50, 1),
(445, 51, 1),
(446, 53, 1),
(447, 54, 1),
(448, 55, 1),
(449, 56, 1),
(450, 57, 1),
(451, 58, 1),
(452, 59, 1),
(453, 60, 1),
(454, 61, 1),
(455, 62, 1),
(535, 1, 4),
(536, 49, 4),
(537, 50, 4),
(538, 52, 4),
(539, 54, 4),
(540, 55, 4),
(541, 56, 4),
(542, 58, 4),
(543, 59, 4),
(544, 62, 4),
(545, 63, 4);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `description`) VALUES
(1, 'Super Admin', 'Super Admin has full control of the system'),
(2, 'Local Admin', 'Admin has control over user management and certain resources'),
(4, 'Family Admin', 'famliy admin');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `role_id` int(11) UNSIGNED NOT NULL,
  `hub` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('active','inactive','suspended') NOT NULL DEFAULT 'active',
  `pancard` varchar(255) NOT NULL,
  `licence` varchar(255) NOT NULL,
  `insurance` varchar(255) NOT NULL,
  `aadhaarcard` varchar(255) NOT NULL,
  `bankaccountnumber` varchar(255) NOT NULL,
  `bankname` varchar(255) NOT NULL,
  `ifsccode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `nickname`, `email`, `phone`, `role_id`, `hub`, `image`, `created_at`, `updated_at`, `status`, `pancard`, `licence`, `insurance`, `aadhaarcard`, `bankaccountnumber`, `bankname`, `ifsccode`) VALUES
(15, 'Geetha', '', 'geth@gmail.com', '0983938939', 4, 1, 'uploads/staff/1741492436_f3e663860198c8047e87.jpg', '2025-03-09 03:53:56', '2025-03-26 06:32:11', 'suspended', '', '', '', '', '', '', ''),
(16, 'Ram', '', 'ram@gmail.com', '0983938939', 4, 2, 'uploads/staff/1741493521_3a0c67eb5e39751bc73d.webp', '2025-03-09 04:04:02', '2025-03-26 06:33:45', 'active', '', '', '', '', '', '', ''),
(17, 'Manu', '', 'manu@gmail.com', '9898987778', 4, 1, 'uploads/staff/default.jpg', '2025-03-09 04:12:27', '2025-03-26 07:22:07', 'active', '', '', '', '', '', '', ''),
(18, 'Kiara', '', 'kiara@example.com', '0983938939', 4, 3, 'uploads/staff/1741779903_16558483a5f15f901c12.jpg', '2025-03-10 07:01:06', '2025-03-27 05:35:23', 'active', '', '', '', '', '', '', ''),
(19, 'Jeni', '', 'jeni@meesho.com', '99898878787', 4, 1, 'uploads/staff/1741593142_9a3980d7c71b0ae222e7.webp', '2025-03-10 07:52:22', '2025-03-26 07:21:52', 'active', '', '', '', '', '', '', ''),
(24, 'nimisha', '', 'nimisha@truettech.in', '0983938939', 4, 3, 'uploads/staff/1742969696_953d3b6ec0bcfefda0d1.jpg', '2025-03-21 05:20:59', '2025-03-27 08:02:50', 'active', '', '', '', '', '', '', ''),
(26, 'minju', '', 'minju@trusttech.in', '0983938939', 0, 2, 'uploads/staff/1742970897_047f2cbff326d0a459ee.webp', '2025-03-26 06:34:46', '2025-03-26 06:34:57', 'active', '', '', '', '', '', '', ''),
(33, '  testing entries trusttech', '', '', '0983938939', 0, 1, 'uploads/staff/1743935293_70721cb36d2f17a1e011.jpg', '2025-04-06 10:28:13', '2025-04-06 10:50:51', 'active', 'uploads/staff/1743936651_e9be43957bb7bb8f3b8f.webp', 'uploads/staff/1743935293_002b87aabde65c1d4e06.jpg', 'uploads/staff/1743935293_16bcec3c24a3948e5a24.webp', 'uploads/staff/1743936636_71b9eb1a413230aff977.jpg', 'ARR34444', 'DFFFFFFFF', 'FSFDF'),
(39, '  testing entries nimishhh', '', NULL, '0983938939', 0, 1, '', '2025-04-14 05:11:54', '2025-04-14 05:39:07', 'active', '', '', '', 'uploads/staff/1744609147_22c959cfa55bf321fdd3.png', '34wfd', 'DFFFFFFFF', 'q2wrweer'),
(40, 'marketnews', '', NULL, '0983938939', 0, 1, '', '2025-04-21 10:31:13', '2025-04-21 10:31:13', 'active', '', '', '', '', '34wfd', 'sbi', 'q2wrweer'),
(41, 'hubsaa', '', NULL, '6282719879', 0, 1, '', '2025-04-21 10:45:03', '2025-04-21 10:45:03', 'active', '', '', '', '', '798709', 'DFFFFFFFF', 'q2wrweer'),
(42, 'gethyy', '', NULL, '62854456546', 0, 1, '', '2025-04-21 10:49:54', '2025-04-21 10:49:54', 'active', '', '', '', '', '798709', 'DFFFFFFFF', 'q2wrweer'),
(43, 'shssyy', '', NULL, '344444444444444444', 0, 1, '', '2025-04-21 10:50:50', '2025-04-21 10:50:50', 'active', '', '', '', '', '34wfd', 'DFFFFFFFF', 'q2wrweer'),
(44, 'fgergergrg', '', NULL, '43434343434', 0, 2, '', '2025-04-21 10:51:05', '2025-04-21 10:51:05', 'active', '', '', '', '', '34wfd', 'DFFFFFFFF', 'q2wrweer'),
(45, 'gamsth', '', NULL, '324444444444444444', 0, 1, '', '2025-04-21 10:52:32', '2025-04-21 10:52:32', 'active', '', '', '', '', '34wfd', 'DFFFFFFFF', 'q2wrweer'),
(46, 'judghe', '', NULL, '243333333', 0, 1, '', '2025-04-21 10:53:38', '2025-04-21 10:53:38', 'active', '', '', '', '', '34wfd', 'DFFFFFFFF', '23435dfsdf'),
(47, 'tecnknikmame', 'nikkkhthrt', NULL, '4543543', 0, 2, '', '2025-04-21 13:35:30', '2025-04-21 13:36:29', 'active', '', '', '', '', '34wfd', 'DFFFFFFFF', 'q2wrweer'),
(48, 'nimishatest', 'test', NULL, '967855676', 0, 1, '', '2025-04-22 08:44:38', '2025-04-22 08:44:38', 'active', '', '', '', '', '21312SD', 'SBI', '34354335FDF'),
(49, '  testing entries trusttech', 'nikkk', NULL, '0983938939', 0, 0, '', '2025-04-22 09:46:23', '2025-04-22 09:46:23', 'active', '', '', '', '', '34wfd', 'DFFFFFFFF', 'q2wrweer'),
(50, '  testing entries trusttechs414', 'nikkk23412', NULL, '0983938939', 0, 0, '', '2025-04-22 09:46:46', '2025-04-22 09:46:46', 'active', '', '', '', '', '34wfd', 'DFFFFFFFF', 'q2wrweer'),
(51, 'marketnewsdwew', 'wewewqew', NULL, '3455', 0, 0, '', '2025-04-22 09:54:41', '2025-04-22 10:41:24', 'suspended', '', '', '', '', '34wfd', 'DFFFFFFFF', 'q2wrweer');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `reset_token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `hub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role_id`, `is_active`, `reset_token`, `created_at`, `updated_at`, `hub`) VALUES
(1, 'superadmin', 'superadmin@capp.com', '1234', 1, 1, '', '2025-03-07 10:53:53', '2025-06-25 16:48:13', 0),
(73, 'FAM-00123', 'family1@capp.com', '1234', 4, 1, '', '2025-06-26 10:21:30', '2025-07-01 11:20:54', 0),
(74, 'AWE43', 'awce@capp.com', '1234', 4, 1, '', '2025-06-26 10:22:11', '2025-06-26 10:22:11', 0),
(76, 'FAM-00018', 'hilsa@capp.com', '1234', 4, 1, '', '2025-06-26 14:38:26', '2025-06-26 14:38:26', 0),
(77, 'FAM-00023', 'ambani@capp.com', '1234', 4, 1, '', '2025-07-01 11:29:12', '2025-07-01 11:29:12', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificate_requests`
--
ALTER TABLE `certificate_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purpose_id` (`purpose_id`);

--
-- Indexes for table `donation_purposes`
--
ALTER TABLE `donation_purposes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `families`
--
ALTER TABLE `families`
  ADD PRIMARY KEY (`family_id`),
  ADD UNIQUE KEY `family_code` (`family_code`),
  ADD UNIQUE KEY `family_email` (`family_email`);

--
-- Indexes for table `family_members`
--
ALTER TABLE `family_members`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `family_id` (`family_id`);

--
-- Indexes for table `hub`
--
ALTER TABLE `hub`
  ADD PRIMARY KEY (`hub_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_role`
--
ALTER TABLE `menu_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `certificate_requests`
--
ALTER TABLE `certificate_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `donation_purposes`
--
ALTER TABLE `donation_purposes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `families`
--
ALTER TABLE `families`
  MODIFY `family_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `family_members`
--
ALTER TABLE `family_members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `hub`
--
ALTER TABLE `hub`
  MODIFY `hub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `menu_role`
--
ALTER TABLE `menu_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=546;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`purpose_id`) REFERENCES `donation_purposes` (`id`);

--
-- Constraints for table `family_members`
--
ALTER TABLE `family_members`
  ADD CONSTRAINT `family_members_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `families` (`family_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
