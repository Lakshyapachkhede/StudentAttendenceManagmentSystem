-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 08, 2025 at 08:31 AM
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
-- Database: `samdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

CREATE TABLE `attendence` (
  `session_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `status` enum('present','absent') NOT NULL DEFAULT 'absent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendence`
--

INSERT INTO `attendence` (`session_id`, `student_id`, `status`) VALUES
(11, 7, 'absent'),
(11, 8, 'absent'),
(11, 11, 'present'),
(11, 13, 'present'),
(11, 14, 'present'),
(11, 15, 'present'),
(12, 7, 'absent'),
(12, 8, 'present'),
(12, 11, 'absent'),
(12, 13, 'present'),
(12, 14, 'absent'),
(12, 15, 'absent'),
(13, 7, 'present'),
(13, 8, 'present'),
(13, 11, 'present'),
(13, 13, 'absent'),
(13, 14, 'present'),
(13, 15, 'present'),
(14, 7, 'present'),
(14, 8, 'present'),
(14, 11, 'present'),
(14, 13, 'present'),
(14, 14, 'present'),
(15, 7, 'present'),
(15, 8, 'present'),
(15, 11, 'present'),
(15, 13, 'present'),
(15, 14, 'present'),
(15, 15, 'present'),
(16, 7, 'present'),
(16, 8, 'absent'),
(16, 11, 'present'),
(16, 13, 'absent'),
(16, 14, 'absent'),
(16, 15, 'present'),
(17, 7, 'absent'),
(17, 8, 'present'),
(17, 11, 'present'),
(17, 13, 'absent'),
(17, 14, 'present'),
(17, 15, 'absent'),
(18, 7, 'present'),
(18, 8, 'absent'),
(18, 11, 'absent'),
(18, 13, 'present'),
(18, 14, 'absent'),
(18, 15, 'present'),
(19, 7, 'present'),
(19, 8, 'absent'),
(19, 11, 'present'),
(19, 13, 'absent'),
(19, 14, 'absent'),
(19, 15, 'present'),
(20, 7, 'present'),
(20, 8, 'absent'),
(20, 11, 'present'),
(20, 13, 'present'),
(20, 14, 'absent'),
(20, 15, 'present'),
(21, 7, 'present'),
(21, 8, 'present'),
(21, 11, 'absent'),
(22, 7, 'absent'),
(22, 8, 'present'),
(22, 11, 'present'),
(23, 7, 'absent'),
(23, 8, 'present'),
(23, 11, 'absent');

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
(16, 3, '2025-05-08 11:04:00'),
(17, 3, '2025-05-08 11:56:00'),
(18, 3, '2025-05-08 11:57:00'),
(19, 3, '2025-05-08 11:57:00'),
(20, 3, '2025-05-08 11:57:00'),
(21, 5, '2025-05-08 11:59:00'),
(22, 5, '2025-05-09 11:59:00'),
(23, 5, '2025-05-10 11:59:00');

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
(7, 3, '2025-04-23 19:41:53'),
(7, 5, '2025-04-23 19:40:26'),
(8, 3, '2025-04-25 15:49:53'),
(8, 5, '2025-04-23 19:50:28'),
(11, 3, '2025-04-24 15:26:32'),
(11, 4, '2025-04-24 15:26:40'),
(11, 5, '2025-04-25 09:23:55'),
(13, 3, '2025-04-25 22:32:48'),
(14, 3, '2025-04-26 08:27:27'),
(15, 3, '2025-05-08 11:04:00');

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
  `branch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`, `description`, `teacher_id`, `date_created`, `branch`) VALUES
(3, 'Data Structure ', 'I love data structure', 5, '2025-04-23 14:30:22', 2),
(4, 'maths 101', 'this is basic maths for polytechnic students', 5, '2025-04-23 14:33:39', 2),
(5, 'Computer Network', 'This is the best class on computer network ever', 5, '2025-04-23 18:51:53', 1),
(6, 'Engineering Mechanics', 'Engineering Mechanics Class for II semester students', 12, '2025-04-25 09:44:57', 1),
(7, 'Social Science', 'This class is about social sciences', 5, '2025-04-25 22:59:05', 1),
(8, 'Personal Development', 'Personal Development', 5, '2025-04-25 22:59:38', 2);

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
(4, 7, 'approved', '2025-04-22'),
(5, 8, 'approved', '2025-04-22'),
(6, 11, 'approved', '2025-04-24'),
(7, 12, 'declined', '2025-04-25'),
(8, 12, 'approved', '2025-04-25'),
(9, 13, 'pending', '2025-04-25'),
(10, 14, 'pending', '2025-04-26'),
(11, 15, 'pending', '2025-05-08');

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
(7, '23031C04099', 2, 'I am yash pachkhede'),
(8, '23031C04053', 1, 'I am cool.'),
(11, '23031C04012', 1, 'rcb lover'),
(13, '23031C04028', 1, 'I am harsh rathoud'),
(14, '23031C04048', 1, 'I am kanha'),
(15, '23031C040323', 1, 'i am cool');

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
(5, 'I am HOD of computer Science Department. and leader', 1),
(12, 'I am pl bansal teacher in mechanical branch', 3);

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
(7, 'Yash Pachkhede', 'pachkhedeyash@gmail.com', '$2y$10$mF.6erYaUmsy4wIzQ31iCeE8LSDGG6gK0XkvmC4PVpCSuzgZIeky.', 'student', 1, '2025-04-22'),
(8, 'Lakshya Pachkhede', 'pachkhedelakshya@gmail.com', '$2y$10$j90UzRUe4fctEAgggnzSfuaik1AgfEUDMsRR51j3YdSGGnrS9XNt.', 'student', 1, '2025-04-22'),
(10, 'Anand Pachkhede', 'anand@gmail.com', '$2y$10$.3GdoyXrgm8GdAbjUxkb0uVhH17z80y.Wk.0Q4UwQRALuK44R73HG', 'student', 0, '2025-04-23'),
(11, 'Anuj Verma', 'anujverma@gmail.com', '$2y$10$NzbXHhebCjDj06ABhCoP8uVMTIm9YhQGeJFMhShFW2Fx7l2pRS8wm', 'student', 1, '2025-04-24'),
(12, 'P.L. Bansal', 'plbansal@gmail.com', '$2y$10$SHHptYNX8S.5tzaiuh7Dv.zGM2XDPZqjLJJaXBZmN5EIdWsq.Rbde', 'teacher', 1, '2025-04-25'),
(13, 'Harshvardhan Singh Rathoud', 'harsh@gmail.com', '$2y$10$ZoCZdEb379KND0GsUTqQQ.whKdmZ6cSB7I6eFAu.ZOqV7QJqYhEyy', 'student', 0, '2025-04-25'),
(14, 'Kanha chaturvedi', 'kanha@gmail.com', '$2y$10$JBfRbeNDzkmjxMhFtEQr6.f755Eu9AVtBlMKbhjLsoz5kTsSEOkv2', 'student', 0, '2025-04-26'),
(15, 'Shivansh Pandey', 'shivansh@gmail.com', '$2y$10$u4x/5owLS7bpimwvMTZVr.TKoLK1BWGg97xW/tI77opwPIxcXc7N2', 'student', 0, '2025-05-08');

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
  ADD KEY `branch_fk` (`branch`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `signuprequests`
--
ALTER TABLE `signuprequests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
