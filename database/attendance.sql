-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2022 at 07:28 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_control`
--

CREATE TABLE `app_control` (
  `id` int(11) NOT NULL,
  `cipher_key` varchar(50) NOT NULL,
  `jwt_secret` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `app_control`
--

INSERT INTO `app_control` (`id`, `cipher_key`, `jwt_secret`) VALUES
(1, 'SqigdBpNvliYy4qOHFU49fdtv455Mi', 'LwTosfZHvIIIrMn86cHBpWwtZO3yLQoJeSCjvqsC');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `punch_in_time` datetime NOT NULL,
  `punch_out_time` datetime NOT NULL,
  `attendance_status` tinyint(4) NOT NULL,
  `location` tinyint(4) NOT NULL DEFAULT 0,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `user_id`, `punch_in_time`, `punch_out_time`, `attendance_status`, `location`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 19, '2015-12-20 10:01:00', '2015-12-20 07:01:05', 1, 0, 11.234332, 12.02222222, '2022-04-12 09:36:14', '2022-06-23 06:32:26');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(30) DEFAULT NULL,
  `branch_latitude` double DEFAULT NULL,
  `branch_longitude` double DEFAULT NULL,
  `branch_radius` int(11) DEFAULT NULL,
  `branch_address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_name`, `branch_latitude`, `branch_longitude`, `branch_radius`, `branch_address`, `created_at`, `updated_at`) VALUES
(1, 'Pudukkottai', 11.0778678, 78.031545466, 12, 'Kamarajapuram 3rd street.', '2022-04-08 09:37:52', '2022-04-20 04:20:27');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `created_at`, `updated_at`) VALUES
(1, 'Development Team', '2022-04-08 09:38:37', '2022-04-11 06:04:42'),
(2, 'Design Team', '2022-04-11 06:04:51', '2022-04-11 11:54:31'),
(3, 'Digital Marketing Team', '2022-04-11 06:05:04', '2022-04-11 11:54:35');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `designation_id` int(11) NOT NULL,
  `designation_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designation_id`, `designation_name`) VALUES
(1, 'Web Developer'),
(2, 'UI/UX Designer');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `event_tiltle` text NOT NULL,
  `event_image` text NOT NULL,
  `event_date` date NOT NULL,
  `starting_time` time NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `event_tiltle`, `event_image`, `event_date`, `starting_time`, `branch_id`) VALUES
(1, 'Fun activity', 'upload/offer/1.png', '2022-04-08', '11:08:00', 1),
(4, 'fd', 'upload/offer/4.png', '2022-04-20', '09:30:00', 1),
(5, '133', 'upload/offer/5.png', '2022-04-06', '19:36:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `holidays_id` int(11) NOT NULL,
  `holidays_name` varchar(20) DEFAULT NULL,
  `holidays_date` date DEFAULT NULL,
  `holidays_day` varchar(20) DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`holidays_id`, `holidays_name`, `holidays_date`, `holidays_day`, `branch_id`, `created_at`, `updated_at`) VALUES
(2, 'Tamil NewYear', '2022-04-14', 'Thursday', 0, '2022-04-08 12:19:10', '2022-04-08 12:19:10'),
(5, 'bb', '2022-04-20', 'Friday', 1, '2022-04-11 10:12:47', '2022-04-26 11:19:04'),
(6, 'Saturday holiday', '2022-04-30', 'Saturday', 0, '2022-04-20 05:46:56', '2022-04-22 14:40:13');

-- --------------------------------------------------------

--
-- Table structure for table `leave_details`
--

CREATE TABLE `leave_details` (
  `id` int(11) NOT NULL,
  `requestType` int(11) NOT NULL,
  `leaveType` int(11) NOT NULL,
  `leave_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `shift` int(11) NOT NULL,
  `primary_locations` varchar(225) NOT NULL,
  `status` int(11) NOT NULL,
  `reason` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_details`
--

INSERT INTO `leave_details` (`id`, `requestType`, `leaveType`, `leave_id`, `date`, `user_id`, `shift`, `primary_locations`, `status`, `reason`) VALUES
(1, 1, 1, 1, '2022-01-01', 2, 0, '', 0, 'fe'),
(2, 1, 1, 1, '2022-01-01', 2, 0, '', 0, 'fe'),
(3, 1, 1, 0, '2022-01-01', 2, 0, '', 0, 'fe'),
(4, 1, 1, 0, '2022-01-01', 2, 0, '', 0, 'fe'),
(5, 1, 1, 0, '1970-01-01', 2, 0, '', 0, ''),
(6, 1, 1, 4, '1970-01-01', 2, 0, '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `leave_list`
--

CREATE TABLE `leave_list` (
  `id` int(11) NOT NULL,
  `requestType` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tl_id` int(11) NOT NULL,
  `leaveType` varchar(20) NOT NULL,
  `fromDate` varchar(20) NOT NULL,
  `toDate` varchar(20) NOT NULL,
  `reason` text NOT NULL,
  `remark` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_list`
--

INSERT INTO `leave_list` (`id`, `requestType`, `user_id`, `tl_id`, `leaveType`, `fromDate`, `toDate`, `reason`, `remark`, `status`) VALUES
(1, 1, 2, 0, '1', '', '', '', '', 1),
(2, 1, 2, 0, '1', '1970-01-01', '1970-01-01', 'cold', '12d', 1),
(3, 1, 2, 0, '1', '2022-04-28', '2022-01-01', 'cold', '12d', 1),
(4, 1, 2, 0, '1', '1970-01-01', '1970-01-01', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `cipher` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `control` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `username`, `password`, `cipher`, `date`, `time`, `control`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'JPIL', '5214528881899347', '2022-03-25', '15:42:57', 0, '2022-04-08 07:51:21', '2022-04-08 07:51:21');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `manager_id` int(11) NOT NULL,
  `department_id` text NOT NULL,
  `manager_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`manager_id`, `department_id`, `manager_name`) VALUES
(1, '2,3', 'Raghaavan'),
(2, '3', 'Kishore Kumar');

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE `meeting` (
  `meeting_id` int(11) NOT NULL,
  `starting_time` time NOT NULL,
  `meeting_date` date NOT NULL,
  `meeting_day` varchar(20) NOT NULL,
  `meeting_type` varchar(30) NOT NULL,
  `team_type` smallint(6) NOT NULL,
  `department_id` text NOT NULL,
  `user_id` text NOT NULL,
  `meeting_link` text NOT NULL,
  `meeting_heading` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meeting`
--

INSERT INTO `meeting` (`meeting_id`, `starting_time`, `meeting_date`, `meeting_day`, `meeting_type`, `team_type`, `department_id`, `user_id`, `meeting_link`, `meeting_heading`, `created_at`, `updated_at`) VALUES
(14, '10:44:00', '2022-05-04', 'Monday', 'Daily Meeting', 2, '1,3', '20', 'meeetings', 'Meeting1', '2022-04-12 11:00:58', '2022-04-25 05:50:22'),
(36, '16:27:00', '2022-04-26', '', '2', 2, '1', '19,27', 'd', 'd', '2022-04-26 10:02:34', '2022-04-26 10:02:34'),
(37, '16:33:00', '2022-04-26', '', '2', 3, '1,2', '', '1', '1', '2022-04-26 10:03:17', '2022-04-26 10:03:17'),
(39, '16:38:00', '2022-04-11', '', '3', 3, '1,2,3', '', 'vino', 'vino', '2022-04-26 10:08:22', '2022-04-26 10:08:22'),
(42, '16:38:00', '2022-04-11', '', '3', 3, '1,2,3', '', 'vino', 'vino', '2022-04-26 10:14:53', '2022-04-26 10:14:53'),
(45, '15:55:00', '2022-04-14', '', 'Monthly Meeting', 1, '1', '', 'w', 'w', '2022-04-26 10:23:09', '2022-04-26 10:23:09'),
(49, '17:21:00', '2022-04-08', '', 'Monthly Meeting', 2, '', '19,27', 'VINOTHINI', 'vinothINI', '2022-04-26 10:49:37', '2022-04-26 10:50:20'),
(50, '16:27:00', '2022-04-26', '', '2', 2, '1', '19,27', 'd', 'd', '2022-04-26 11:47:35', '2022-04-26 11:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_details`
--

CREATE TABLE `meeting_details` (
  `meeting_details_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meeting_details`
--

INSERT INTO `meeting_details` (`meeting_details_id`, `meeting_id`, `department_id`, `user_id`) VALUES
(1, 1, 1, 19);

-- --------------------------------------------------------

--
-- Table structure for table `personal`
--

CREATE TABLE `personal` (
  `personal_id` int(11) NOT NULL,
  `emp_first` varchar(255) NOT NULL,
  `emp_last` varchar(225) NOT NULL,
  `father_name` varchar(225) NOT NULL,
  `mother_name` varchar(225) NOT NULL,
  `DOB` date NOT NULL,
  `blood_group` varchar(225) NOT NULL,
  `phone_number` varchar(225) NOT NULL,
  `emgerency_contact_no` varchar(225) NOT NULL,
  `gender` varchar(225) NOT NULL,
  `experience` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `permanent_address` varchar(225) NOT NULL,
  `pan` varchar(225) NOT NULL,
  `aadhar` varchar(225) NOT NULL,
  `passport` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `personal`
--

INSERT INTO `personal` (`personal_id`, `emp_first`, `emp_last`, `father_name`, `mother_name`, `DOB`, `blood_group`, `phone_number`, `emgerency_contact_no`, `gender`, `experience`, `address`, `permanent_address`, `pan`, `aadhar`, `passport`) VALUES
(2, 'vinothinir', 'raja', 'raja', 'santhi', '2022-04-08', 'o+', '900', '90', 'Male', '2 +', 'raju', 'raju', 'upload/pan/2.png', 'upload/aadhar/2.PNG', 'upload/passport/2.PNG'),
(3, 'vijo', 'c', 'rjsa', 'san', '2022-04-20', 'o+', '09003352711', '09003352711', 'Female', '2 year 4 month', 'Raju street', 'Raju street', 'upload/pan/3.png', 'upload/aadhar/3.png', 'upload/passport/3.png');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `position_id` int(4) NOT NULL,
  `position_name` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position_id`, `position_name`, `created_at`, `updated_at`) VALUES
(1, 'Team Lead', '2022-04-08 09:36:48', '2022-04-08 09:39:52'),
(5, 'Member', '2022-04-14 11:27:48', '2022-04-14 11:27:48'),
(6, 'Intern', '2022-04-14 11:28:28', '2022-04-19 04:25:43');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `requestType` tinyint(4) NOT NULL,
  `leaveType` tinyint(4) NOT NULL,
  `fromDate` date NOT NULL,
  `toDate` date NOT NULL,
  `reason` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`request_id`, `user_id`, `requestType`, `leaveType`, `fromDate`, `toDate`, `reason`, `created_at`, `updated_at`) VALUES
(1, 9, 1, 1, '2022-04-28', '2022-04-30', 'stomach', '2022-04-12 08:23:53', '2022-04-12 08:23:53'),
(2, 8, 1, 1, '2022-04-30', '2022-04-30', 'fever', '2022-04-12 09:06:34', '2022-04-12 09:06:34'),
(13, 7, 1, 1, '0000-00-00', '0000-00-00', 'fever', '2022-04-25 07:59:45', '2022-04-25 07:59:45'),
(14, 6, 1, 1, '0000-00-00', '0000-00-00', 'fever', '2022-04-25 07:59:54', '2022-04-25 07:59:54'),
(15, 5, 2, 1, '0000-00-00', '0000-00-00', 'fever', '2022-04-25 08:00:02', '2022-04-25 08:00:02'),
(16, 4, 2, 1, '0000-00-00', '0000-00-00', 'fever', '2022-04-25 08:09:35', '2022-04-25 08:09:35'),
(17, 3, 2, 1, '0000-00-00', '0000-00-00', 'fever', '2022-04-25 08:09:36', '2022-04-25 08:09:36'),
(18, 2, 2, 1, '0000-00-00', '0000-00-00', 'dd', '2022-04-25 08:09:36', '2022-04-25 08:09:36'),
(19, 1, 1, 1, '0000-00-00', '0000-00-00', 'fever', '2022-04-25 08:15:51', '2022-04-25 08:15:51'),
(67, 2, 3, 2, '0000-00-00', '0000-00-00', 'cold', '2022-04-25 11:26:47', '2022-04-25 11:26:47'),
(68, 2, 1, 2, '0000-00-00', '0000-00-00', 'cold', '2022-04-25 11:28:03', '2022-04-25 11:28:03'),
(69, 0, 1, 1, '2022-03-21', '2022-03-23', 'fever', '2022-04-27 07:46:24', '2022-04-27 07:46:24'),
(70, 20, 1, 1, '0000-00-00', '0000-00-00', '', '2022-06-23 07:54:53', '2022-06-23 07:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `request_permission`
--

CREATE TABLE `request_permission` (
  `permission_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `requestType` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `duration` time NOT NULL,
  `admin_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_permission`
--

INSERT INTO `request_permission` (`permission_id`, `user_id`, `requestType`, `date`, `start_time`, `end_time`, `duration`, `admin_id`, `status`, `reason`) VALUES
(4, 0, 0, '2022-04-27', '00:00:10', '00:00:12', '00:00:00', 1, 2, 'cold'),
(5, 0, 0, '2022-04-27', '20:08:16', '21:08:16', '00:00:00', 1, 2, 'cold'),
(8, 0, 2, '1970-01-01', '00:00:00', '00:00:00', '00:00:00', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `request_wfh`
--

CREATE TABLE `request_wfh` (
  `wfh_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `leaveType` tinyint(4) NOT NULL,
  `requestType` int(11) NOT NULL,
  `fromDate` date NOT NULL,
  `toDate` date NOT NULL,
  `reason` text NOT NULL,
  `status` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_wfh`
--

INSERT INTO `request_wfh` (`wfh_id`, `user_id`, `leaveType`, `requestType`, `fromDate`, `toDate`, `reason`, `status`, `admin_id`) VALUES
(1, 9, 3, 0, '2022-04-28', '2022-04-30', 'fever', 1, 1),
(2, 0, 3, 0, '1970-01-01', '1970-01-01', 'cold', 2, 1),
(3, 2, 3, 0, '2022-04-27', '2022-04-27', 'cold', 1, 1),
(4, 2, 2, 3, '1970-01-01', '1970-01-01', 'cold', 1, 1),
(5, 2, 1, 3, '1970-01-01', '1970-01-01', 'cold', 1, 0),
(6, 2, 1, 3, '1970-01-01', '1970-01-01', 'cold', 0, 0),
(7, 2, 2, 3, '1970-01-01', '1970-01-01', 'cold', 0, 0),
(8, 2, 1, 3, '1970-01-01', '1970-01-01', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `user_phone_number` int(20) DEFAULT NULL,
  `user_doj` date DEFAULT NULL,
  `employee_id` varchar(10) DEFAULT NULL,
  `user_email` varchar(30) DEFAULT NULL,
  `office_email` varchar(30) DEFAULT NULL,
  `user_image` text NOT NULL,
  `offer_letter` text NOT NULL,
  `appointment_letter` text NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `position_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cipher` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `refresh_token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_phone_number`, `user_doj`, `employee_id`, `user_email`, `office_email`, `user_image`, `offer_letter`, `appointment_letter`, `department_id`, `designation_id`, `position_id`, `created_at`, `updated_at`, `cipher`, `password`, `refresh_token`) VALUES
(19, 'Raghavan', 907837979, '2022-04-12', 'GTS123', 'vino1997@gmail.com', 'vino.gtech@gmail.com', '', 'upload/offer/19.png', 'upload/app/19.png', 1, 1, 1, '2022-04-12 05:38:21', '2022-04-23 08:42:34', '', '', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NTA3MDMzNTQuMDU0NjI0LCJuYmYiOjE2NTA3MDMzNTQuMDU0NjI0LCJleHAiOjE2NTEzMDgxNTQuMDU0NjI0LCJ1c2VyX2lkIjoxOX0.PcqbFqWzCv5IPQ2NdNxhJq6f_I5slxEO7grGcA8vxmY'),
(20, 'vinothini', 2147483647, '2022-04-11', 'GTS1232', 'vinothiniraja8@gmail.com', 'vinothiniraja8@gmail.com', 'upload/photo/20.jpg', 'upload/offer/20.PNG', 'upload/app/20.PNG', 1, 1, 1, '2022-04-12 06:33:47', '2022-07-02 07:11:23', '', '', ''),
(27, 'Naresh', 878785545, '1999-02-09', 'GTS1235', 'a@gamil.com', 'a@gamil.com', 'upload/photo/27.jpg', 'upload/photo/27.jpg', 'upload/app/27.jpg', 1, 1, 1, '2022-04-23 07:21:11', '2022-07-02 07:11:46', '8948094294136097', 'Dxuz', ''),
(28, 's', 2147483647, '2022-07-06', 'ss', 'ww@sdfgh', 'ww@sdfgh', '', '', '', 1, 1, 5, '2022-07-02 09:20:28', '2022-07-02 09:20:40', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_control`
--
ALTER TABLE `app_control`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`holidays_id`);

--
-- Indexes for table `leave_details`
--
ALTER TABLE `leave_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_list`
--
ALTER TABLE `leave_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`manager_id`);

--
-- Indexes for table `meeting`
--
ALTER TABLE `meeting`
  ADD PRIMARY KEY (`meeting_id`);

--
-- Indexes for table `meeting_details`
--
ALTER TABLE `meeting_details`
  ADD PRIMARY KEY (`meeting_details_id`);

--
-- Indexes for table `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`personal_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `request_permission`
--
ALTER TABLE `request_permission`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `request_wfh`
--
ALTER TABLE `request_wfh`
  ADD PRIMARY KEY (`wfh_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `position` (`position_id`),
  ADD KEY `department` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_control`
--
ALTER TABLE `app_control`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `holidays_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `leave_details`
--
ALTER TABLE `leave_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `leave_list`
--
ALTER TABLE `leave_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `manager_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `meeting`
--
ALTER TABLE `meeting`
  MODIFY `meeting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `meeting_details`
--
ALTER TABLE `meeting_details`
  MODIFY `meeting_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal`
--
ALTER TABLE `personal`
  MODIFY `personal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `position_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `request_permission`
--
ALTER TABLE `request_permission`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `request_wfh`
--
ALTER TABLE `request_wfh`
  MODIFY `wfh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `position` (`position_id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
