-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307:3307
-- Generation Time: Jun 23, 2025 at 08:18 AM
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
-- Database: `samdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

CREATE DATABASE samdb;
USE samdb;

CREATE TABLE `attendence` (
  `session_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `status` enum('present','absent') NOT NULL DEFAULT 'absent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendence`
--

INSERT INTO `attendence` (`session_id`, `student_id`, `status`) VALUES
(11, 8, 'present'),
(12, 8, 'present'),
(13, 8, 'absent'),
(14, 8, 'present'),
(15, 8, 'present'),
(16, 8, 'present'),
(17, 8, 'present'),
(64, 8, 'present'),
(65, 8, 'present'),
(66, 8, 'absent'),
(69, 8, 'absent'),
(70, 8, 'present'),
(71, 8, 'present'),
(72, 8, 'present'),
(73, 8, 'absent'),
(73, 18, 'present');

-- --------------------------------------------------------

--
-- Table structure for table `attendence_session`
--

CREATE TABLE `attendence_session` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendence_session`
--

INSERT INTO `attendence_session` (`id`, `class_id`, `date_time`) VALUES
(11, 3, '2025-04-26 09:19:00'),
(12, 3, '2025-04-27 09:31:00'),
(13, 3, '2025-04-28 09:31:00'),
(14, 3, '2025-04-28 09:31:00'),
(15, 3, '2025-04-30 09:31:00'),
(16, 3, '2025-04-26 13:09:00'),
(17, 3, '2025-05-01 10:24:00'),
(64, 3, '2025-06-22 12:28:03'),
(65, 3, '2025-06-22 12:39:11'),
(66, 11, '2025-06-22 12:48:32'),
(69, 3, '2025-06-23 09:33:45'),
(70, 3, '2025-06-23 09:48:08'),
(71, 11, '2025-06-23 09:49:39'),
(72, 3, '2025-06-23 10:23:12'),
(73, 3, '2025-06-23 11:01:56');

-- --------------------------------------------------------

--
-- Table structure for table `attends`
--

CREATE TABLE `attends` (
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `date_joined` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attends`
--

INSERT INTO `attends` (`student_id`, `class_id`, `date_joined`) VALUES
(8, 3, '2025-04-25 15:49:53'),
(8, 11, '2025-06-23 09:49:25'),
(18, 3, '2025-06-23 11:01:44');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `initials` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `full_name`, `initials`) VALUES
(1, 'Computer Science ', 'CSE'),
(2, 'Chemical', 'CHM'),
(3, 'Mechanical', 'MECH');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `branch` int(11) DEFAULT NULL,
  `longitude` decimal(10,5) DEFAULT NULL,
  `latitude` decimal(10,5) DEFAULT NULL,
  `open_session_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`, `description`, `teacher_id`, `date_created`, `branch`, `longitude`, `latitude`, `open_session_id`) VALUES
(3, 'Data Structure ', 'I love data structure', 5, '2025-04-23 14:30:22', 2, 75.85830, 22.71943, 73),
(11, 'New class', 'Newest class', 5, '2025-06-22 10:18:40', 1, 75.85773, 22.71957, 71);

-- --------------------------------------------------------

--
-- Table structure for table `join_requests`
--

CREATE TABLE `join_requests` (
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `requested_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `signuprequests`
--

CREATE TABLE `signuprequests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('pending','approved','declined') NOT NULL DEFAULT 'pending',
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signuprequests`
--

INSERT INTO `signuprequests` (`id`, `user_id`, `status`, `date`) VALUES
(3, 5, 'approved', '2025-04-21'),
(5, 8, 'approved', '2025-04-22'),
(13, 17, 'approved', '2025-06-22'),
(14, 18, 'approved', '2025-06-23');

-- --------------------------------------------------------

--
-- Table structure for table `student_profile`
--

CREATE TABLE `student_profile` (
  `student_id` int(11) NOT NULL,
  `roll_no` varchar(15) NOT NULL,
  `branch` int(11) DEFAULT NULL,
  `bio` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_profile`
--

INSERT INTO `student_profile` (`student_id`, `roll_no`, `branch`, `bio`) VALUES
(8, '23031C04053', 1, 'I am cool.'),
(17, '74747373773', 1, 'I am cool.'),
(18, '23041C0409999', 1, 'Hshe');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_profile`
--

CREATE TABLE `teacher_profile` (
  `teacher_id` int(11) NOT NULL,
  `about` varchar(200) NOT NULL,
  `branch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_profile`
--

INSERT INTO `teacher_profile` (`teacher_id`, `about`, `branch`) VALUES
(5, 'I am HOD of computer Science Department. and leader', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` enum('student','teacher','admin') NOT NULL DEFAULT 'student',
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `type`, `approved`, `date_created`) VALUES
(3, 'admin', 'admin@gmail.com', '$2y$10$dKI17tdgqhtTeHqt9pqn/OOWjh6RfjyKKs/jMnkv9NV.SvDZZ6qES', 'admin', 1, '2025-04-21'),
(5, 'Deepesh yadav', 'deepeshyadav@gmail.com', '$2y$10$/GcGEXuMStjlHif5Qw1fDeyPOOzwQZ0gXio/z3JdVNYTCrFoWu.H2', 'teacher', 1, '2025-04-21'),
(8, 'Lakshya Pachkhede', 'pachkhedelakshya@gmail.com', '$2y$10$j90UzRUe4fctEAgggnzSfuaik1AgfEUDMsRR51j3YdSGGnrS9XNt.', 'student', 1, '2025-04-22'),
(17, 'Yash Panchkhede', 'yash27bc068@satiengg.in', '$2y$10$n6F/YuLMzMPJNGyfkjz8YuCbE20o0TxpVbGX.ULL0FbputZo.Yvhy', 'student', 1, '2025-06-22'),
(18, 'Lakshya Pachkhede 2', 'pachkhedelakshya26@gmail.com', '$2y$10$4nfcDtZX9UOPpdbNGoxWvuJCRABmifcG0ToiOqpE7lAicyJVfFnPa', 'student', 1, '2025-06-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendence`
--
ALTER TABLE `attendence`
  ADD PRIMARY KEY (`session_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `attendence_session`
--
ALTER TABLE `attendence_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_class_id` (`class_id`);

--
-- Indexes for table `attends`
--
ALTER TABLE `attends`
  ADD PRIMARY KEY (`student_id`,`class_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_teacher_id` (`teacher_id`),
  ADD KEY `branch_fk` (`branch`),
  ADD KEY `class_ibfk_1` (`open_session_id`);

--
-- Indexes for table `join_requests`
--
ALTER TABLE `join_requests`
  ADD PRIMARY KEY (`student_id`,`class_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `signuprequests`
--
ALTER TABLE `signuprequests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `student_profile`
--
ALTER TABLE `student_profile`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `roll_no` (`roll_no`),
  ADD KEY `fk_branch_id` (`branch`);

--
-- Indexes for table `teacher_profile`
--
ALTER TABLE `teacher_profile`
  ADD UNIQUE KEY `teacher_id` (`teacher_id`),
  ADD KEY `branch` (`branch`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendence_session`
--
ALTER TABLE `attendence_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `signuprequests`
--
ALTER TABLE `signuprequests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendence`
--
ALTER TABLE `attendence`
  ADD CONSTRAINT `attendence_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `attendence_session` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendence_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attendence_session`
--
ALTER TABLE `attendence_session`
  ADD CONSTRAINT `fk_class_id` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attends`
--
ALTER TABLE `attends`
  ADD CONSTRAINT `attends_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attends_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `branch_fk` FOREIGN KEY (`branch`) REFERENCES `branch` (`id`),
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`open_session_id`) REFERENCES `attendence_session` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_teacher_id` FOREIGN KEY (`teacher_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `join_requests`
--
ALTER TABLE `join_requests`
  ADD CONSTRAINT `join_requests_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  ADD CONSTRAINT `join_requests_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `join_requests_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `signuprequests`
--
ALTER TABLE `signuprequests`
  ADD CONSTRAINT `signuprequests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `student_profile`
--
ALTER TABLE `student_profile`
  ADD CONSTRAINT `fk_branch_id` FOREIGN KEY (`branch`) REFERENCES `branch` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_student_user` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `teacher_profile`
--
ALTER TABLE `teacher_profile`
  ADD CONSTRAINT `teacher_profile_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `teacher_profile_ibfk_2` FOREIGN KEY (`branch`) REFERENCES `branch` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
