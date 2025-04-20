-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2025 at 02:02 PM
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
-- Database: `samsystemattendencedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `attends`
--

CREATE TABLE `attends` (
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `date_joined` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `initials` varchar(10) NOT NULL,
  `HOD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `full_name`, `initials`, `HOD`) VALUES
(1, 'Computer Science Engineering', 'CSE', 112),
(2, 'Chemical Engineering', 'CHM', 113),
(3, 'Electrical Engineering', 'EC', 114);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `teacher` int(11) NOT NULL,
  `start_date` date NOT NULL DEFAULT current_timestamp()
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
(1, 8, 'approved', '2025-04-19'),
(2, 10, 'approved', '2025-04-19'),
(100, 108, 'approved', '2025-04-19'),
(101, 109, 'approved', '2025-04-19'),
(102, 110, 'approved', '2025-04-19'),
(103, 111, 'approved', '2025-04-19'),
(104, 112, 'pending', '2025-04-20'),
(105, 113, 'pending', '2025-04-20'),
(106, 114, 'pending', '2025-04-20'),
(107, 115, 'pending', '2025-04-20');

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
(6, '23031C04053', 1, 'Hello I am lakshya pachkhede. i am an engineer.'),
(108, '23031C04034', 2, 'sfsdfs'),
(110, '23031C04051', 1, 'asdfsafd'),
(115, '23031C04084', 1, 'i am kirti pachkhede');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_profile`
--

CREATE TABLE `teacher_profile` (
  `teacher_id` int(11) NOT NULL,
  `about` varchar(200) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(6, 'Lakshya Pachkhede', 'pachkhedelakshya@gmail.com', '$2y$10$ZjaZEcomm3uX0NACc9mM7uzxMxNlWQ4JW8qJfLkgrJTKnAUps0Ka2', 'student', 1, '2025-04-19'),
(8, 'Yash Pachkhede', 'pachkhedeyash@gmail.com', '$2y$10$DRfyJRTyzCn34IEhv9xs2O53ibirlENNYGel1.MxGGU1HrxNQ/dXW', 'student', 0, '2025-04-19'),
(10, 'admin', 'admin@gmail.com', '$2y$10$aV6zFmghl5GlrlemCoEpOOz4O63zP9K5UnG0U7ltG47Jvf4s.EM6G', 'admin', 1, '2025-04-19'),
(108, 'Emily Garcia', 'emily.garcia98@example.com', '$2y$10$50qSrBOfXx4ZTi0fBqjiZuczvC0NW86K8qY06Xcg4ZfNl2tPTqPq6', 'student', 1, '2025-04-19'),
(109, 'Laura Davis', 'laura.davis99@example.com', '$2y$10$IpAOgtgDFB4qzCVXgOgpCujzQ.SLQjmW0s.KdFtHjJ0zRUj8QzaC2', 'student', 1, '2025-04-19'),
(110, 'Emily Smith', 'emily.smith100@example.com', '$2y$10$FnWLul6To5oEJsVV3MXmIuzi0CS4iHPlwATGoPGR4E9i/WOOAH4C2', 'student', 1, '2025-04-19'),
(111, 'Rock Johnson', 'johnrock@hotmail.com', '$2y$10$XVFCtnJ1WLkhy6W7smaKfe6LctLsmG4m4/F6XhlH71Touyk/vcUqW', 'student', 1, '2025-04-19'),
(112, 'Deepesh yadav', 'deepeshyadav@gmail.com', '$2y$10$4BoJ6QljQn9I9pceYlVGnutfeenLZr5vJZa2T/ocmKj6JvqB3yBm2', 'teacher', 0, '2025-04-20'),
(113, 'Dilip Yadav', 'dilipyadav@gmail.com', '$2y$10$GjskGWR5bOlwfq8TCzDOT.djxKi51WxsuCM3q3UupPXc18KbJbTQC', 'teacher', 0, '2025-04-20'),
(114, 'Rajesh Prajapati', 'rajeshpanthi@gmail.com', '$2y$10$BS/hcFUTnzUi/TN8tVYyhupvDDWY8MnbU9kS3iX0V/ywi5p1Ug9oa', 'teacher', 0, '2025-04-20'),
(115, 'Kirti Pachkhede', 'kirtipachkhede@gmail.com', '$2y$10$qPLTFZzhdi.Wq6r0LFDtleTozUuq9RYzfC23GoUvzY9emU0LeO.d.', 'student', 0, '2025-04-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attends`
--
ALTER TABLE `attends`
  ADD PRIMARY KEY (`student_id`,`class_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `HOD` (`HOD`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signuprequests`
--
ALTER TABLE `signuprequests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `signuprequests_ibfk_1` (`user_id`);

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
  ADD KEY `branch_id` (`branch_id`);

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
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `signuprequests`
--
ALTER TABLE `signuprequests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attends`
--
ALTER TABLE `attends`
  ADD CONSTRAINT `attends_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `attends_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `branch`
--
ALTER TABLE `branch`
  ADD CONSTRAINT `branch_ibfk_1` FOREIGN KEY (`HOD`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`teacher`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `teacher_profile_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
