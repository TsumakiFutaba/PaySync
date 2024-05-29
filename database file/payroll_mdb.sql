-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2024 at 04:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll_mdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `wy_admin`
--

CREATE TABLE `wy_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_code` varchar(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wy_admin`
--

INSERT INTO `wy_admin` (`admin_id`, `admin_code`, `admin_name`, `admin_email`, `admin_password`, `admin_time`) VALUES
(1, 'WY00', 'Tsumaki Futaba', 'haxx0rfutaba@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2024-04-18 02:22:37');

-- --------------------------------------------------------

--
-- Table structure for table `wy_attendance`
--

CREATE TABLE `wy_attendance` (
  `attendance_id` int(11) NOT NULL,
  `emp_code` varchar(255) NOT NULL,
  `attendance_date` date NOT NULL,
  `action_name` enum('punchin','punchout') NOT NULL,
  `action_time` time NOT NULL,
  `emp_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wy_attendance`
--

INSERT INTO `wy_attendance` (`attendance_id`, `emp_code`, `attendance_date`, `action_name`, `action_time`, `emp_desc`) VALUES
(2, 'WY01', '2021-04-13', 'punchin', '10:41:27', '21'),
(3, 'WY01', '2021-04-13', 'punchout', '17:37:36', '220'),
(4, 'WY02', '2021-04-14', 'punchin', '15:05:42', 'D114'),
(5, 'WY02', '2021-04-14', 'punchout', '22:19:14', 'out-144'),
(6, 'WY03', '2021-04-14', 'punchin', '10:30:30', 'IN'),
(7, 'WY03', '2021-04-14', 'punchout', '17:30:52', 'OUT'),
(8, 'WY04', '2021-04-14', 'punchin', '10:00:59', 'IS1'),
(9, 'WY04', '2021-04-14', 'punchout', '14:31:27', 'IS1'),
(10, 'WY05', '2021-04-14', 'punchin', '19:11:29', 'In'),
(11, 'WY05', '2021-04-14', 'punchout', '19:13:02', 'Outt'),
(12, 'WY01', '2024-05-13', 'punchin', '19:04:01', 'Present'),
(13, 'WY01', '2024-05-13', 'punchout', '19:04:08', 'Out'),
(14, 'WY01', '2024-05-19', 'punchin', '11:29:04', 'First'),
(15, 'WY01', '2024-05-19', 'punchout', '19:30:58', ''),
(16, 'WY01', '2024-05-21', 'punchin', '19:33:44', ''),
(17, 'WY01', '2024-05-21', 'punchout', '19:33:53', '');

-- --------------------------------------------------------

--
-- Table structure for table `wy_employees`
--

CREATE TABLE `wy_employees` (
  `emp_id` int(11) NOT NULL,
  `emp_code` varchar(255) NOT NULL,
  `emp_password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL DEFAULT 'male',
  `address` longtext NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `identity_doc` varchar(255) NOT NULL,
  `emp_type` varchar(255) NOT NULL,
  `joining_date` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `idphoto` varchar(255) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wy_employees`
--

INSERT INTO `wy_employees` (`emp_id`, `emp_code`, `emp_password`, `first_name`, `last_name`, `dob`, `gender`, `address`, `email`, `mobile`, `telephone`, `identity_doc`, `emp_type`, `joining_date`, `photo`, `idphoto`, `created`) VALUES
(14, 'WY03', 'd00bb3f3b7c7b8815b6dcf237dd16aab9744eca8', 'Aru', 'Rikuhachima', '03/12/2012', 'female', '68th Handy Man Street', 'aru.rikuhachima@gmail.com', '09687292817', '09064560966', 'Voter Id', 'Permanent position', '05/01/2024', 'WY03.png', '', '2024-05-14 22:07:50'),
(15, 'WY04', 'f5b86511f75d7ff80afc270b24c323461c36eda6', 'Mika', 'MIsono', '05/08/2024', 'female', '33rd St. ', 'mika.misono8@gmail.com', '09064560966', '09150047372', 'Driving License', 'Part-time employee', '05/08/2024', 'WY04.png', '', '2024-05-14 22:21:39'),
(11, 'WY01', '3c8a9db095ccdd7bcb1e55d4e7f913801d94164f', 'Misaki', 'Imashino', '01/13/2006', 'female', '44th Vanitas Street , Arius District', 'vanitasvanitatum@gmail.com', '09186775903', '09186775903', 'SSS ID', 'Intern', '05/01/2024', 'WY01.png', '', '2024-05-11 15:04:21'),
(12, 'WY02', '2886f3ea59aed33b8d4434d763869436f6342a34', 'Jan Matthew', 'Salangsang', '06/22/2002', 'male', '99B Pearl St. Sitio Kislap\r\nFairview', 'matsu.yukii22@gmail.com', '09186775903', '09186775903', 'Voters ID', 'Intern', '04/01/2024', 'WY02.jpg', '', '2024-05-11 16:30:46'),
(16, 'WY05', '9613a27e80cce0bd8a86d2d99dae82cdbe03e35a', 'Maridel', 'Salangsang', '09/03/2007', 'female', '99B Pearl St. Sitio Kislap\r\nFairview', 'maridel.salangsang03@gmail.com', '09186775903', '09186775903', 'SSS ID', 'Part-time employee', '05/01/2024', 'WY05.jpg', '', '2024-05-19 16:04:01'),
(17, 'WY06', '2b485cb65cadfa52b649051dcf2b895a8904a6fb', 'Andrew Jeremiah', 'Salangsang', '05/27/2024', 'male', '99B Pearl St. Sitio Kislap\r\nFairview', 'matsu.yukii22@gmail.com', '09186775903', '09186775903', 'PhilHealth ID', 'Permanent position', '05/15/2024', 'WY06.png', '', '2024-05-21 16:32:16'),
(18, 'WY07', '907a7e42b60783e7e3a33e82dd1fff60085b4510', 'Ayumu', 'Uehara', '02/28/2010', 'female', '99B Pearl St. Sitio Kislap\r\nFairview', 'uehara.ayumu@gmail.com', '09150047372', '09150047372', 'Voters ID', 'Intern', '05/17/2024', 'WY07.jpg', '', '2024-05-21 17:19:51'),
(31, 'WY09', '3c8a9db095ccdd7bcb1e55d4e7f913801d94164f', 'Jan Matthew', 'Salangsang', '01/13/2006', '', '99B Pearl St. Sitio Kislap\r\nFairview', 'matsu.yukii22@gmail.com', '09186775903', '09186775903', 'PhilHealth ID', 'Permanent position', '05/21/2024', 'WY09.png', '', '2024-05-22 01:36:58'),
(32, 'WY10', '3c8a9db095ccdd7bcb1e55d4e7f913801d94164f', 'Jan Matthew', 'Salangsang', '03/12/2012', '', '99B Pearl St. Sitio Kislap\r\nFairview', 'matsu.yukii22@gmail.com', '09186775903', '09186775903', 'SSS ID', 'Permanent position', '05/21/2024', 'WY10.png', 'WY10_id.jpg', '2024-05-22 02:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `wy_holidays`
--

CREATE TABLE `wy_holidays` (
  `holiday_id` int(11) NOT NULL,
  `holiday_title` varchar(255) NOT NULL,
  `holiday_desc` varchar(255) NOT NULL,
  `holiday_date` varchar(50) NOT NULL,
  `holiday_type` enum('compulsory','restricted') NOT NULL DEFAULT 'compulsory'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wy_holidays`
--

INSERT INTO `wy_holidays` (`holiday_id`, `holiday_title`, `holiday_desc`, `holiday_date`, `holiday_type`) VALUES
(1, 'Labor Day', 'Labor Day 2020', '05/01/2020', 'compulsory'),
(9, 'Independence Day', 'Independence Day 2020', '08/15/2020', 'compulsory'),
(16, 'Memorial Day', 'Memorial Day 2020', '05/25/2020', 'restricted'),
(18, 'Christmas Day', 'Christmas Day 2020', '12/25/2020', 'compulsory'),
(21, 'New Year', 'New Year 2021', '01/01/2024', 'compulsory'),
(22, 'Rizal Day', 'Rizal Day 2023', '12/30/2023', 'compulsory');

-- --------------------------------------------------------

--
-- Table structure for table `wy_payheads`
--

CREATE TABLE `wy_payheads` (
  `payhead_id` int(11) NOT NULL,
  `payhead_name` varchar(255) NOT NULL,
  `payhead_desc` varchar(255) NOT NULL,
  `payhead_type` enum('earnings','deductions') NOT NULL DEFAULT 'earnings'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wy_payheads`
--

INSERT INTO `wy_payheads` (`payhead_id`, `payhead_name`, `payhead_desc`, `payhead_type`) VALUES
(1, 'Basic Salary', 'Basic Salary', 'earnings'),
(2, 'Tax Deduction', 'Tax Deduction', 'deductions'),
(4, 'Travel Expenses', 'Travel Expenses', 'deductions'),
(5, 'Food Allowances', 'Food Allowances', 'earnings'),
(6, 'Absentees', 'Absentees', 'deductions');

-- --------------------------------------------------------

--
-- Table structure for table `wy_pay_structure`
--

CREATE TABLE `wy_pay_structure` (
  `salary_id` int(11) NOT NULL,
  `emp_code` varchar(255) NOT NULL,
  `payhead_id` int(11) NOT NULL,
  `default_salary` float(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wy_pay_structure`
--

INSERT INTO `wy_pay_structure` (`salary_id`, `emp_code`, `payhead_id`, `default_salary`) VALUES
(408, 'WY01', 6, 4000.00),
(409, 'WY01', 1, 50000.00),
(410, 'WY01', 5, 50000.00);

-- --------------------------------------------------------

--
-- Table structure for table `wy_salaries`
--

CREATE TABLE `wy_salaries` (
  `salary_id` int(11) NOT NULL,
  `emp_code` varchar(255) NOT NULL,
  `payhead_name` varchar(255) NOT NULL,
  `pay_amount` float(11,2) NOT NULL,
  `earning_total` float(11,2) NOT NULL,
  `deduction_total` float(11,2) NOT NULL,
  `net_salary` float(11,2) NOT NULL,
  `pay_type` enum('earnings','deductions') NOT NULL,
  `pay_month` varchar(255) NOT NULL,
  `generate_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wy_salaries`
--

INSERT INTO `wy_salaries` (`salary_id`, `emp_code`, `payhead_name`, `pay_amount`, `earning_total`, `deduction_total`, `net_salary`, `pay_type`, `pay_month`, `generate_date`) VALUES
(270, 'WY01', 'Basic Salary', 500000.00, 501000.00, 51000.00, 450000.00, 'earnings', 'May, 2024', '2024-05-28 13:14:31'),
(271, 'WY01', 'Food Allowances', 1000.00, 501000.00, 51000.00, 450000.00, 'earnings', 'May, 2024', '2024-05-28 13:14:31'),
(272, 'WY01', 'Tax Deduction', 40000.00, 501000.00, 51000.00, 450000.00, 'deductions', 'May, 2024', '2024-05-28 13:14:31'),
(273, 'WY01', 'Travel Expenses', 10000.00, 501000.00, 51000.00, 450000.00, 'deductions', 'May, 2024', '2024-05-28 13:14:31'),
(274, 'WY01', 'Absentees', 1000.00, 501000.00, 51000.00, 450000.00, 'deductions', 'May, 2024', '2024-05-28 13:14:31'),
(275, 'WY01', 'Basic Salary', 50000.00, 50000.00, 7000.00, 43000.00, 'earnings', 'June, 2024', '2024-05-28 13:19:41'),
(276, 'WY01', 'Travel Expenses', 6000.00, 50000.00, 7000.00, 43000.00, 'deductions', 'June, 2024', '2024-05-28 13:19:41'),
(277, 'WY01', 'Absentees', 1000.00, 50000.00, 7000.00, 43000.00, 'deductions', 'June, 2024', '2024-05-28 13:19:41'),
(278, 'WY01', 'Basic Salary', 50000.00, 100000.00, 4000.00, 96000.00, 'earnings', 'July, 2024', '2024-05-28 14:24:21'),
(279, 'WY01', 'Food Allowances', 50000.00, 100000.00, 4000.00, 96000.00, 'earnings', 'July, 2024', '2024-05-28 14:24:21'),
(280, 'WY01', 'Absentees', 4000.00, 100000.00, 4000.00, 96000.00, 'deductions', 'July, 2024', '2024-05-28 14:24:21'),
(281, 'WY01', 'Basic Salary', 50000.00, 100000.00, 4000.00, 96000.00, 'earnings', 'August, 2024', '2024-05-28 15:07:38'),
(282, 'WY01', 'Food Allowances', 50000.00, 100000.00, 4000.00, 96000.00, 'earnings', 'August, 2024', '2024-05-28 15:07:38'),
(283, 'WY01', 'Absentees', 4000.00, 100000.00, 4000.00, 96000.00, 'deductions', 'August, 2024', '2024-05-28 15:07:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wy_admin`
--
ALTER TABLE `wy_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`),
  ADD UNIQUE KEY `admin_code` (`admin_code`);

--
-- Indexes for table `wy_attendance`
--
ALTER TABLE `wy_attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `emp_code` (`emp_code`);

--
-- Indexes for table `wy_employees`
--
ALTER TABLE `wy_employees`
  ADD PRIMARY KEY (`emp_id`),
  ADD UNIQUE KEY `emp_code` (`emp_code`);

--
-- Indexes for table `wy_holidays`
--
ALTER TABLE `wy_holidays`
  ADD PRIMARY KEY (`holiday_id`);

--
-- Indexes for table `wy_payheads`
--
ALTER TABLE `wy_payheads`
  ADD PRIMARY KEY (`payhead_id`);

--
-- Indexes for table `wy_pay_structure`
--
ALTER TABLE `wy_pay_structure`
  ADD PRIMARY KEY (`salary_id`),
  ADD KEY `emp_code` (`emp_code`),
  ADD KEY `payhead_id` (`payhead_id`);

--
-- Indexes for table `wy_salaries`
--
ALTER TABLE `wy_salaries`
  ADD PRIMARY KEY (`salary_id`),
  ADD KEY `emp_code` (`emp_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wy_admin`
--
ALTER TABLE `wy_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wy_attendance`
--
ALTER TABLE `wy_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `wy_employees`
--
ALTER TABLE `wy_employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `wy_holidays`
--
ALTER TABLE `wy_holidays`
  MODIFY `holiday_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `wy_payheads`
--
ALTER TABLE `wy_payheads`
  MODIFY `payhead_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wy_pay_structure`
--
ALTER TABLE `wy_pay_structure`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=411;

--
-- AUTO_INCREMENT for table `wy_salaries`
--
ALTER TABLE `wy_salaries`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=284;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
