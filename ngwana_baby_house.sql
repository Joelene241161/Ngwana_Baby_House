-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2026 at 09:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ngwana_baby_house`
--

-- --------------------------------------------------------

--
-- Table structure for table `1to2`
--

CREATE TABLE `1to2` (
  `slot_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT 0,
  `capacityLimit` int(11) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `1to2`
--

INSERT INTO `1to2` (`slot_id`, `day_id`, `locked`, `capacityLimit`, `capacity`) VALUES
(1, 1, 0, 8, 0),
(2, 2, 0, 8, 0),
(3, 3, 0, 8, 0),
(4, 4, 0, 8, 0),
(5, 5, 0, 8, 0),
(6, 6, 0, 8, 0),
(7, 7, 0, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `2to3`
--

CREATE TABLE `2to3` (
  `slot_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT 0,
  `capacityLimit` int(11) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `2to3`
--

INSERT INTO `2to3` (`slot_id`, `day_id`, `locked`, `capacityLimit`, `capacity`) VALUES
(1, 1, 0, 8, 1),
(2, 2, 0, 8, 0),
(3, 3, 0, 8, 1),
(4, 4, 0, 8, 0),
(5, 5, 0, 8, 0),
(6, 6, 0, 8, 0),
(7, 7, 0, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `3to4`
--

CREATE TABLE `3to4` (
  `slot_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT 0,
  `capacityLimit` int(11) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `3to4`
--

INSERT INTO `3to4` (`slot_id`, `day_id`, `locked`, `capacityLimit`, `capacity`) VALUES
(1, 1, 0, 8, 0),
(2, 2, 0, 8, 0),
(3, 3, 0, 8, 0),
(4, 4, 0, 8, 0),
(5, 5, 0, 8, 2),
(6, 6, 0, 8, 0),
(7, 7, 0, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `4to5`
--

CREATE TABLE `4to5` (
  `slot_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT 0,
  `capacityLimit` int(11) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `4to5`
--

INSERT INTO `4to5` (`slot_id`, `day_id`, `locked`, `capacityLimit`, `capacity`) VALUES
(1, 1, 0, 4, 0),
(2, 2, 0, 8, 0),
(3, 3, 0, 8, 1),
(4, 4, 0, 8, 0),
(5, 5, 0, 8, 1),
(6, 6, 0, 8, 0),
(7, 7, 0, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `5to6`
--

CREATE TABLE `5to6` (
  `slot_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT 0,
  `capacityLimit` int(11) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `5to6`
--

INSERT INTO `5to6` (`slot_id`, `day_id`, `locked`, `capacityLimit`, `capacity`) VALUES
(1, 1, 0, 6, 0),
(2, 2, 0, 8, 0),
(3, 3, 0, 8, 0),
(4, 4, 0, 8, 0),
(5, 5, 0, 8, 0),
(6, 6, 0, 8, 0),
(7, 7, 0, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `9to10`
--

CREATE TABLE `9to10` (
  `slot_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT 0,
  `capacityLimit` int(11) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `9to10`
--

INSERT INTO `9to10` (`slot_id`, `day_id`, `locked`, `capacityLimit`, `capacity`) VALUES
(1, 1, 0, 7, 0),
(2, 2, 0, 8, 0),
(3, 3, 0, 8, 1),
(4, 4, 0, 8, 0),
(5, 5, 0, 8, 1),
(6, 6, 0, 8, 0),
(7, 7, 0, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `10to11`
--

CREATE TABLE `10to11` (
  `slot_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT 0,
  `capacityLimit` int(11) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `10to11`
--

INSERT INTO `10to11` (`slot_id`, `day_id`, `locked`, `capacityLimit`, `capacity`) VALUES
(1, 1, 0, 8, 0),
(2, 2, 0, 8, 0),
(3, 3, 0, 8, 0),
(4, 4, 0, 8, 0),
(5, 5, 0, 8, 0),
(6, 6, 0, 8, 0),
(7, 7, 0, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `11to12`
--

CREATE TABLE `11to12` (
  `slot_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT 0,
  `capacityLimit` int(11) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `11to12`
--

INSERT INTO `11to12` (`slot_id`, `day_id`, `locked`, `capacityLimit`, `capacity`) VALUES
(1, 1, 0, 8, 0),
(2, 2, 0, 8, 1),
(3, 3, 0, 8, 0),
(4, 4, 0, 8, 0),
(5, 5, 0, 8, 1),
(6, 6, 0, 8, 1),
(7, 7, 0, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `12to1`
--

CREATE TABLE `12to1` (
  `slot_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT 1,
  `capacityLimit` int(11) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `12to1`
--

INSERT INTO `12to1` (`slot_id`, `day_id`, `locked`, `capacityLimit`, `capacity`) VALUES
(1, 1, 1, 8, 0),
(2, 2, 1, 8, 0),
(3, 3, 1, 8, 0),
(4, 4, 1, 8, 0),
(5, 5, 1, 8, 0),
(6, 6, 0, 5, 0),
(7, 7, 1, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `createdFor` datetime DEFAULT NULL,
  `task` enum('cuddle','tummy','feed','play','reading') DEFAULT 'cuddle',
  `CheckIn_at` datetime DEFAULT NULL,
  `CheckOut_at` datetime DEFAULT NULL,
  `status` enum('pending','expected','arrived','late') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `day_id`, `createdFor`, `task`, `CheckIn_at`, `CheckOut_at`, `status`) VALUES
(5, 6, 3, '2026-10-16 12:30:55', 'reading', '2026-10-16 12:37:14', '2026-10-16 12:50:58', 'arrived'),
(8, 6, 5, NULL, 'tummy', NULL, NULL, 'expected'),
(9, 6, 5, NULL, 'tummy', NULL, NULL, 'expected'),
(10, 6, 6, NULL, 'tummy', NULL, NULL, 'expected'),
(11, 6, 5, NULL, 'play', NULL, NULL, 'expected'),
(12, 6, 7, NULL, 'play', NULL, NULL, 'expected'),
(13, 6, 8, '2026-10-19 11:00:00', 'tummy', NULL, NULL, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `recipient_id`, `sender_id`, `created_at`, `content`) VALUES
(2, 6, 5, '2026-10-16 12:43:49', 'Thank you for the reading you did this week. You really entertained the babies, we\'d love to have you back again.');

-- --------------------------------------------------------

--
-- Table structure for table `scheduledday`
--

CREATE TABLE `scheduledday` (
  `day_id` int(11) NOT NULL,
  `date_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scheduledday`
--

INSERT INTO `scheduledday` (`day_id`, `date_at`) VALUES
(1, '2026-10-13 00:00:00'),
(2, '2026-10-15 00:00:00'),
(3, '2026-10-16 00:00:00'),
(4, '2026-10-14 00:00:00'),
(5, '2026-10-23 00:00:00'),
(6, '2026-10-20 00:00:00'),
(7, '2026-10-26 00:00:00'),
(8, '2026-10-19 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `supplyrequest`
--

CREATE TABLE `supplyrequest` (
  `supplyAsk_id` int(11) NOT NULL,
  `received` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `category` enum('nappies','wipes','toys','formula') DEFAULT 'nappies',
  `urgency` enum('red','yellow','green') DEFAULT 'green',
  `wipe` enum('none','sensitive','fragranceFree','regular') DEFAULT 'none',
  `size` enum('1','2','3','4','5','6','none') DEFAULT 'none',
  `age` enum('0-3','3-6','12-24','none') DEFAULT 'none',
  `toy` enum('none','soft','blocks','books') DEFAULT 'none',
  `stage` enum('none','1','2','3') DEFAULT 'none',
  `formula` enum('none','standard','lactoseFree','antiReflux') DEFAULT 'none'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplyrequest`
--

INSERT INTO `supplyrequest` (`supplyAsk_id`, `received`, `created_at`, `category`, `urgency`, `wipe`, `size`, `age`, `toy`, `stage`, `formula`) VALUES
(1, 1, '2026-10-12 15:54:45', 'nappies', 'green', 'none', '4', 'none', 'none', 'none', 'none'),
(2, 1, '2026-10-12 15:54:45', 'nappies', 'green', 'none', '4', 'none', 'none', 'none', 'none'),
(3, 1, '2026-10-12 15:55:07', 'nappies', 'green', 'none', '3', 'none', 'none', 'none', 'none'),
(4, 1, '2026-10-12 15:55:07', 'nappies', 'green', 'none', '3', 'none', 'none', 'none', 'none'),
(5, 1, '2026-10-12 16:01:49', 'nappies', 'green', 'none', '3', 'none', 'none', 'none', 'none'),
(6, 1, '2026-10-12 16:01:49', 'nappies', 'green', 'none', '3', 'none', 'none', 'none', 'none'),
(7, 1, '2026-10-12 16:02:35', 'wipes', 'yellow', 'fragranceFree', 'none', 'none', 'none', 'none', 'none'),
(8, 1, '2026-10-12 16:02:44', 'toys', 'green', 'none', 'none', '3-6', 'blocks', 'none', 'none'),
(9, 1, '2026-10-12 16:02:44', 'toys', 'green', 'none', 'none', '3-6', 'blocks', 'none', 'none'),
(10, 1, '2026-10-12 16:02:44', 'toys', 'green', 'none', 'none', '3-6', 'blocks', 'none', 'none'),
(13, 1, '2026-10-12 16:33:18', 'toys', 'green', 'none', 'none', '12-24', 'blocks', 'none', 'none'),
(14, 1, '2026-10-13 09:23:58', 'formula', 'green', 'none', 'none', 'none', 'none', '2', 'lactoseFree'),
(15, 0, '2026-10-13 09:23:58', 'formula', 'green', 'none', 'none', 'none', 'none', '2', 'lactoseFree'),
(16, 1, '2026-10-13 09:24:06', 'toys', 'green', 'none', 'none', '3-6', 'books', 'none', 'none'),
(17, 0, '2026-10-15 09:08:00', 'wipes', 'yellow', 'regular', 'none', 'none', 'none', 'none', 'none'),
(18, 0, '2026-10-15 09:08:00', 'wipes', 'yellow', 'regular', 'none', 'none', 'none', 'none', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('volunteer','staff') DEFAULT 'volunteer',
  `joined_at` datetime DEFAULT current_timestamp(),
  `designation` enum('none','nursery','volunteers','admin') DEFAULT 'none',
  `telephoneNumber` varchar(12) NOT NULL,
  `profilePicture` varchar(255) DEFAULT 'default.png',
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password_hash`, `role`, `joined_at`, `designation`, `telephoneNumber`, `profilePicture`, `reset_token`, `token_expiry`) VALUES
(2, 'Mark Williams', 'markW@gmail.com', '$2y$10$O0pvp3qhpV5OpBy7DeBrFuNOBiiTGdzwajyVk5hsi7sN4wYaCKvAm', 'staff', '2026-10-12 14:47:46', 'nursery', '0831457835', '7850a27c1166ec08e6bf97c8c390b160.jpg', NULL, NULL),
(3, 'Kit Davids', 'kitdavids@gmail.com', '$2y$10$xQ3r49bYYcLEx/V8sQ94..xI.7ghu4aAg4dj69snvFj/oXh68K/fi', 'volunteer', '2026-10-15 07:34:00', 'none', '0833455620', 'default.jpg', NULL, NULL),
(5, 'Jasper Smith', 'jaspersmith@gmail.com', '$2y$10$brsZ5gTkcHzZAR2BUlo.xOoO62OnMTr6FoEzWTKR8mKNns0AbPuzi', 'staff', '2026-10-15 08:02:01', 'admin', '0831234678', '68ecf45a198b884246d264ff5070fdc6.jpg', NULL, NULL),
(6, 'Samantha Wilkinson', 'samWilkinson123@gmail.com', '$2y$10$/TImkOG4LLtOyNr2efEvm.65sSiD7N4ZTNEfUZMPuVzqsaSx5unfS', 'volunteer', '2026-10-16 12:30:42', 'none', '0824786354', '364a55d3b5a95ddfc388d8f825ad2b64.jpg', NULL, NULL),
(7, 'Joe du Toit', 'joelenesuenedutoit@gmail.com', '$2y$10$4iuVGTqOTV8fppiJ5AdtG.OY4F38B6KL0tV.09kmFxzorR7AfSGne', 'volunteer', '2026-10-16 14:07:24', 'none', '', 'default.png', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `1to2`
--
ALTER TABLE `1to2`
  ADD PRIMARY KEY (`slot_id`),
  ADD KEY `day_id` (`day_id`);

--
-- Indexes for table `2to3`
--
ALTER TABLE `2to3`
  ADD PRIMARY KEY (`slot_id`),
  ADD KEY `day_id` (`day_id`);

--
-- Indexes for table `3to4`
--
ALTER TABLE `3to4`
  ADD PRIMARY KEY (`slot_id`),
  ADD KEY `day_id` (`day_id`);

--
-- Indexes for table `4to5`
--
ALTER TABLE `4to5`
  ADD PRIMARY KEY (`slot_id`),
  ADD KEY `day_id` (`day_id`);

--
-- Indexes for table `5to6`
--
ALTER TABLE `5to6`
  ADD PRIMARY KEY (`slot_id`),
  ADD KEY `day_id` (`day_id`);

--
-- Indexes for table `9to10`
--
ALTER TABLE `9to10`
  ADD PRIMARY KEY (`slot_id`),
  ADD KEY `day_id` (`day_id`);

--
-- Indexes for table `10to11`
--
ALTER TABLE `10to11`
  ADD PRIMARY KEY (`slot_id`),
  ADD KEY `day_id` (`day_id`);

--
-- Indexes for table `11to12`
--
ALTER TABLE `11to12`
  ADD PRIMARY KEY (`slot_id`),
  ADD KEY `day_id` (`day_id`);

--
-- Indexes for table `12to1`
--
ALTER TABLE `12to1`
  ADD PRIMARY KEY (`slot_id`),
  ADD KEY `day_id` (`day_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `day_id` (`day_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `recipient_id` (`recipient_id`);

--
-- Indexes for table `scheduledday`
--
ALTER TABLE `scheduledday`
  ADD PRIMARY KEY (`day_id`);

--
-- Indexes for table `supplyrequest`
--
ALTER TABLE `supplyrequest`
  ADD PRIMARY KEY (`supplyAsk_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `1to2`
--
ALTER TABLE `1to2`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `2to3`
--
ALTER TABLE `2to3`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `3to4`
--
ALTER TABLE `3to4`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `4to5`
--
ALTER TABLE `4to5`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `5to6`
--
ALTER TABLE `5to6`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `9to10`
--
ALTER TABLE `9to10`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `10to11`
--
ALTER TABLE `10to11`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `11to12`
--
ALTER TABLE `11to12`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `12to1`
--
ALTER TABLE `12to1`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scheduledday`
--
ALTER TABLE `scheduledday`
  MODIFY `day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `supplyrequest`
--
ALTER TABLE `supplyrequest`
  MODIFY `supplyAsk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `1to2`
--
ALTER TABLE `1to2`
  ADD CONSTRAINT `1to2_ibfk_1` FOREIGN KEY (`day_id`) REFERENCES `scheduledday` (`day_id`);

--
-- Constraints for table `2to3`
--
ALTER TABLE `2to3`
  ADD CONSTRAINT `2to3_ibfk_1` FOREIGN KEY (`day_id`) REFERENCES `scheduledday` (`day_id`);

--
-- Constraints for table `3to4`
--
ALTER TABLE `3to4`
  ADD CONSTRAINT `3to4_ibfk_1` FOREIGN KEY (`day_id`) REFERENCES `scheduledday` (`day_id`);

--
-- Constraints for table `4to5`
--
ALTER TABLE `4to5`
  ADD CONSTRAINT `4to5_ibfk_1` FOREIGN KEY (`day_id`) REFERENCES `scheduledday` (`day_id`);

--
-- Constraints for table `5to6`
--
ALTER TABLE `5to6`
  ADD CONSTRAINT `5to6_ibfk_1` FOREIGN KEY (`day_id`) REFERENCES `scheduledday` (`day_id`);

--
-- Constraints for table `9to10`
--
ALTER TABLE `9to10`
  ADD CONSTRAINT `9to10_ibfk_1` FOREIGN KEY (`day_id`) REFERENCES `scheduledday` (`day_id`);

--
-- Constraints for table `10to11`
--
ALTER TABLE `10to11`
  ADD CONSTRAINT `10to11_ibfk_1` FOREIGN KEY (`day_id`) REFERENCES `scheduledday` (`day_id`);

--
-- Constraints for table `11to12`
--
ALTER TABLE `11to12`
  ADD CONSTRAINT `11to12_ibfk_1` FOREIGN KEY (`day_id`) REFERENCES `scheduledday` (`day_id`);

--
-- Constraints for table `12to1`
--
ALTER TABLE `12to1`
  ADD CONSTRAINT `12to1_ibfk_1` FOREIGN KEY (`day_id`) REFERENCES `scheduledday` (`day_id`);

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`day_id`) REFERENCES `scheduledday` (`day_id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
