-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2025 at 11:45 AM
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
-- Database: `hostlesystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `token_no` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `room_no` varchar(50) DEFAULT NULL,
  `morning` tinyint(1) DEFAULT NULL,
  `remark_morning` text DEFAULT NULL,
  `afternoon` tinyint(1) DEFAULT NULL,
  `remark_afternoon` text DEFAULT NULL,
  `night` tinyint(1) DEFAULT NULL,
  `remark_night` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `token_no`, `name`, `date`, `room_no`, `morning`, `remark_morning`, `afternoon`, `remark_afternoon`, `night`, `remark_night`, `created_at`) VALUES
(1, 20, 'RNTC0822006', 'Mangu Ram Hembram', '2025-04-07', '101', 1, '', 1, '0', 0, '', '2025-04-07 09:38:15'),
(2, 21, 'RNTC0822008', 'Chandan  Hembram', '2025-04-07', '101', 0, '', 0, '0', 0, '', '2025-04-07 09:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE `beds` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `bed_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beds`
--

INSERT INTO `beds` (`id`, `room_id`, `bed_number`) VALUES
(238, 7, 1),
(239, 7, 2),
(240, 7, 3),
(241, 7, 4),
(242, 7, 5);

-- --------------------------------------------------------

--
-- Table structure for table `budgets`
--

CREATE TABLE `budgets` (
  `id` int(11) NOT NULL,
  `month` varchar(7) NOT NULL,
  `total_budget` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `budgets`
--

INSERT INTO `budgets` (`id`, `month`, `total_budget`) VALUES
(1, '2025-03', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `month` varchar(7) NOT NULL,
  `category` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `Item Name` varchar(100) NOT NULL,
  `Quantity` int(100) NOT NULL,
  `Category` varchar(100) NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `outing`
--

CREATE TABLE `outing` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `token_no` varchar(50) NOT NULL,
  `outing_purpose` text NOT NULL,
  `outing_date` datetime NOT NULL,
  `return_date` datetime NOT NULL,
  `destination` varchar(255) NOT NULL,
  `warden_approval` enum('Yes','No') NOT NULL,
  `application_file` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `outing`
--

INSERT INTO `outing` (`id`, `first_name`, `middle_name`, `last_name`, `token_no`, `outing_purpose`, `outing_date`, `return_date`, `destination`, `warden_approval`, `application_file`, `created_at`) VALUES
(5, 'Mangu', 'Ram', 'Hembram', 'RNTC0822006', 'Walkin interview', '2025-04-07 12:19:00', '2025-04-07 14:19:00', 'kormangla', 'Yes', 'application_67f37cd67e0846.89892164.jpeg', '2025-04-07 07:20:54');

-- --------------------------------------------------------

--
-- Table structure for table `previous_students`
--

CREATE TABLE `previous_students` (
  `id` int(11) NOT NULL,
  `token_no` varchar(50) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact_no` bigint(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `pincode` int(50) NOT NULL,
  `room_no` varchar(10) NOT NULL,
  `bed_no` varchar(10) NOT NULL,
  `stay_from` date NOT NULL,
  `duration` int(11) NOT NULL,
  `total_fees` varchar(100) NOT NULL,
  `fees_per_month` varchar(255) DEFAULT NULL,
  `parent_name` varchar(255) NOT NULL,
  `parent_contact` bigint(10) NOT NULL,
  `parent_address` varchar(255) NOT NULL,
  `student_photo` longblob NOT NULL,
  `student_aadhaar` longblob NOT NULL,
  `parent_photo` longblob DEFAULT NULL,
  `parent_aadhaar` longblob NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_no` varchar(10) NOT NULL COMMENT '#Room No',
  `total_beds` varchar(10) NOT NULL,
  `floor` varchar(20) NOT NULL,
  `fees_per_bed` int(11) NOT NULL COMMENT 'price',
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_no`, `total_beds`, `floor`, `fees_per_bed`, `description`) VALUES
(7, '101', '5', '1', 5000, 'normal');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(10) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Staff_id` int(20) NOT NULL,
  `Designation` varchar(20) NOT NULL,
  `Contact` bigint(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Join_date` date NOT NULL,
  `staff_photo` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `Name`, `Staff_id`, `Designation`, `Contact`, `Email`, `Address`, `Join_date`, `staff_photo`) VALUES
(1, 'Chandan Singh', 69, 'Warden', 9212173314, 'chandan@gmail.com', 'Gamariah', '2025-04-03', 0x363763366336366264633963395f524e5443303832323030362e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `token_no` varchar(50) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact_no` bigint(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `pincode` int(50) NOT NULL,
  `room_no` varchar(10) NOT NULL,
  `bed_no` varchar(10) NOT NULL,
  `stay_from` date NOT NULL,
  `duration` int(11) NOT NULL,
  `total_fees` varchar(100) NOT NULL,
  `fees_per_month` varchar(255) DEFAULT NULL,
  `parent_name` varchar(255) NOT NULL,
  `parent_contact` bigint(10) NOT NULL,
  `parent_address` varchar(255) NOT NULL,
  `student_photo` longblob NOT NULL,
  `student_aadhaar` longblob NOT NULL,
  `parent_photo` longblob DEFAULT NULL,
  `parent_aadhaar` longblob NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `token_no`, `first_name`, `middle_name`, `last_name`, `gender`, `contact_no`, `email`, `address`, `city`, `state`, `pincode`, `room_no`, `bed_no`, `stay_from`, `duration`, `total_fees`, `fees_per_month`, `parent_name`, `parent_contact`, `parent_address`, `student_photo`, `student_aadhaar`, `parent_photo`, `parent_aadhaar`, `created_at`) VALUES
(20, 'RNTC0822006', 'Mangu', 'Ram', 'Hembram', 'male', 7903428978, 'manguramhembram@gmail.com', 'Karandih, Dukhutola, Jamshedpur', 'Jamshedpur', 'Jharkhand', 8321002, '101', '1', '2025-04-04', 12, '60000', '5000', 'Bishwa Nath Hembram', 9430121882, 'Karandih, Dukhutola, Jamshedpur', 0x75706c6f6164732f524e5443303832323030362e6a7067, 0x75706c6f6164732f6161646861722e706466, 0x75706c6f6164732f4d616e67752052616d2048656d6272616d203574682053656d2e6a7067, 0x75706c6f6164732f6161646861722e706466, '2025-04-07 04:37:51'),
(21, 'RNTC0822008', 'Chandan', '', 'Hembram', 'Select Gen', 9212173314, 'chandan@gmail.com', 'Gamariah', 'Jamshedpur', 'Jharkhand', 8321002, '101', '2', '2025-04-07', 12, '60000', '5000', 'Mangu Ram Hembram', 7903428956, 'Karandih, Dukhutola, Jamshedpur', 0x75706c6f6164732f524e5443303832323030362e6a7067, 0x75706c6f6164732f6161646861722e706466, '', 0x75706c6f6164732f6161646861722e706466, '2025-04-07 05:10:59');

-- --------------------------------------------------------

--
-- Table structure for table `student_registration`
--

CREATE TABLE `student_registration` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `Token_no` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `contact` bigint(10) NOT NULL,
  `city` varchar(255) NOT NULL,
  `Room_no` int(50) NOT NULL,
  `student_photo` longblob NOT NULL,
  `parent_guardian` varchar(255) NOT NULL,
  `parent_contact` bigint(10) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `parent_photo` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_registration`
--

INSERT INTO `student_registration` (`id`, `name`, `Token_no`, `gender`, `dob`, `contact`, `city`, `Room_no`, `student_photo`, `parent_guardian`, `parent_contact`, `Address`, `parent_photo`) VALUES
(1, 'Mangu Ram Hembram', 'RNTC0822006', 'Male', '2001-12-09', 7903428956, 'jamshedpur', 407, 0x524e5443303832323030362e6a7067, 'Bishwa Nath Hembram', 9430121882, 'Karandih, Dukhutola, Jamshedpur', 0x7369676e61747572652e706e67),
(2, 'Chandan', 'RNTC0822008', 'Male', '2004-12-31', 9212173314, 'Jamshedpur', 407, 0x363763366231343231353533375f7369676e61747572652e706e67, 'Mangu', 7903428956, 'Karandih, Dukhutola, Jamshedpur', 0x363763366231343231353533625f494d472d32303234303831322d5741303032322e6a7067),
(3, 'Kajal', 'RNTC0822009', 'Female', '2005-09-23', 8266299289, 'Jamshedpur', 111, 0x363763666235643934383532335f426c61636b204d696e696d616c204d6f7469766174696f6e2051756f7465204c696e6b6564496e2042616e6e65722e706e67, 'sff', 9430121882, 'SONARI', 0x363763666235643934383532615f436c65616e20576f726b20506c616365204c696e6b6564496e2042616e6e657220696e20576869746520477265656e2042726f776e2050686f746f63656e74726963205374796c652e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','manager','staff','student') NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Mangu  Ram Hembram', 'manguramhembram@gmail.com', '$2y$10$S91HIFTPeBOzQr5oisn0PObK.zUgXgOyS92rLzsdfD4DPyDyoJRAK', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`,`date`);

--
-- Indexes for table `beds`
--
ALTER TABLE `beds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `month` (`month`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `month` (`month`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outing`
--
ALTER TABLE `outing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `previous_students`
--
ALTER TABLE `previous_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_registration`
--
ALTER TABLE `student_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `beds`
--
ALTER TABLE `beds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `budgets`
--
ALTER TABLE `budgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `outing`
--
ALTER TABLE `outing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `previous_students`
--
ALTER TABLE `previous_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `student_registration`
--
ALTER TABLE `student_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beds`
--
ALTER TABLE `beds`
  ADD CONSTRAINT `beds_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`month`) REFERENCES `budgets` (`month`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
