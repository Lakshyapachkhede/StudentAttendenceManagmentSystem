-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2025 at 03:30 PM
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
(2, 10, 'pending', '2025-04-19'),
(3, 11, 'pending', '2025-04-19'),
(4, 12, 'pending', '2025-04-19'),
(5, 13, 'pending', '2025-04-19'),
(6, 14, 'pending', '2025-04-19'),
(7, 15, 'pending', '2025-04-19'),
(8, 16, 'pending', '2025-04-19'),
(9, 17, 'pending', '2025-04-19'),
(10, 18, 'pending', '2025-04-19'),
(11, 19, 'pending', '2025-04-19'),
(12, 20, 'pending', '2025-04-19'),
(13, 21, 'pending', '2025-04-19'),
(14, 22, 'pending', '2025-04-19'),
(15, 23, 'pending', '2025-04-19'),
(16, 24, 'pending', '2025-04-19'),
(17, 25, 'pending', '2025-04-19'),
(18, 26, 'pending', '2025-04-19'),
(19, 27, 'pending', '2025-04-19'),
(20, 28, 'pending', '2025-04-19'),
(21, 29, 'pending', '2025-04-19'),
(22, 30, 'pending', '2025-04-19'),
(23, 31, 'pending', '2025-04-19'),
(24, 32, 'pending', '2025-04-19'),
(25, 33, 'pending', '2025-04-19'),
(26, 34, 'pending', '2025-04-19'),
(27, 35, 'pending', '2025-04-19'),
(28, 36, 'pending', '2025-04-19'),
(29, 37, 'pending', '2025-04-19'),
(30, 38, 'pending', '2025-04-19'),
(31, 39, 'pending', '2025-04-19'),
(32, 40, 'pending', '2025-04-19'),
(33, 41, 'pending', '2025-04-19'),
(34, 42, 'pending', '2025-04-19'),
(35, 43, 'pending', '2025-04-19'),
(36, 44, 'pending', '2025-04-19'),
(37, 45, 'pending', '2025-04-19'),
(38, 46, 'pending', '2025-04-19'),
(39, 47, 'pending', '2025-04-19'),
(40, 48, 'pending', '2025-04-19'),
(41, 49, 'pending', '2025-04-19'),
(42, 50, 'pending', '2025-04-19'),
(43, 51, 'pending', '2025-04-19'),
(44, 52, 'pending', '2025-04-19'),
(45, 53, 'pending', '2025-04-19'),
(46, 54, 'pending', '2025-04-19'),
(47, 55, 'pending', '2025-04-19'),
(48, 56, 'pending', '2025-04-19'),
(49, 57, 'pending', '2025-04-19'),
(50, 58, 'pending', '2025-04-19'),
(51, 59, 'declined', '2025-04-19'),
(52, 60, 'approved', '2025-04-19'),
(53, 61, 'approved', '2025-04-19'),
(54, 62, 'approved', '2025-04-19'),
(55, 63, 'pending', '2025-04-19'),
(56, 64, 'pending', '2025-04-19'),
(57, 65, 'pending', '2025-04-19'),
(58, 66, 'pending', '2025-04-19'),
(59, 67, 'pending', '2025-04-19'),
(60, 68, 'pending', '2025-04-19'),
(61, 69, 'pending', '2025-04-19'),
(62, 70, 'pending', '2025-04-19'),
(63, 71, 'pending', '2025-04-19'),
(64, 72, 'pending', '2025-04-19'),
(65, 73, 'pending', '2025-04-19'),
(66, 74, 'pending', '2025-04-19'),
(67, 75, 'pending', '2025-04-19'),
(68, 76, 'pending', '2025-04-19'),
(69, 77, 'pending', '2025-04-19'),
(70, 78, 'pending', '2025-04-19'),
(71, 79, 'pending', '2025-04-19'),
(72, 80, 'pending', '2025-04-19'),
(73, 81, 'pending', '2025-04-19'),
(74, 82, 'pending', '2025-04-19'),
(75, 83, 'pending', '2025-04-19'),
(76, 84, 'pending', '2025-04-19'),
(77, 85, 'pending', '2025-04-19'),
(78, 86, 'pending', '2025-04-19'),
(79, 87, 'pending', '2025-04-19'),
(80, 88, 'pending', '2025-04-19'),
(81, 89, 'pending', '2025-04-19'),
(82, 90, 'pending', '2025-04-19'),
(83, 91, 'pending', '2025-04-19'),
(84, 92, 'pending', '2025-04-19'),
(85, 93, 'pending', '2025-04-19'),
(86, 94, 'pending', '2025-04-19'),
(87, 95, 'pending', '2025-04-19'),
(88, 96, 'pending', '2025-04-19'),
(89, 97, 'pending', '2025-04-19'),
(90, 98, 'pending', '2025-04-19'),
(91, 99, 'pending', '2025-04-19'),
(92, 100, 'pending', '2025-04-19'),
(93, 101, 'pending', '2025-04-19'),
(94, 102, 'pending', '2025-04-19'),
(95, 103, 'pending', '2025-04-19'),
(96, 104, 'pending', '2025-04-19'),
(97, 105, 'pending', '2025-04-19'),
(98, 106, 'pending', '2025-04-19'),
(99, 107, 'pending', '2025-04-19'),
(100, 108, 'pending', '2025-04-19'),
(101, 109, 'pending', '2025-04-19'),
(102, 110, 'pending', '2025-04-19');

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
(6, 'Lakshya Pachkhede', 'pachkhedelakshya@gmail.com', '$2y$10$ZjaZEcomm3uX0NACc9mM7uzxMxNlWQ4JW8qJfLkgrJTKnAUps0Ka2', 'student', 0, '2025-04-19'),
(8, 'Yash Pachkhede', 'pachkhedeyash@gmail.com', '$2y$10$DRfyJRTyzCn34IEhv9xs2O53ibirlENNYGel1.MxGGU1HrxNQ/dXW', 'student', 0, '2025-04-19'),
(10, 'admin', 'admin@gmail.com', '$2y$10$aV6zFmghl5GlrlemCoEpOOz4O63zP9K5UnG0U7ltG47Jvf4s.EM6G', 'admin', 1, '2025-04-19'),
(11, 'Laura Miller', 'laura.miller1@example.com', '$2y$10$ZF6MDUAoXGoOChlaP5zI7.3NFk0h03Y.GdEiCsSF3Ma4XuqFvKAGm', 'teacher', 0, '2025-04-19'),
(12, 'Laura Miller', 'laura.miller2@example.com', '$2y$10$0a0/YSA2nvTML3ixz4PJleIIyQjuk3Jn4JQQuHpyFPZuOAnmdpZAW', 'teacher', 0, '2025-04-19'),
(13, 'Jane Jones', 'jane.jones3@example.com', '$2y$10$aZaCcw0fgGp4fTgVWD3m3OWyoKdmrEGAzqTznGa3zELz1TklJxleC', 'teacher', 0, '2025-04-19'),
(14, 'James Miller', 'james.miller4@example.com', '$2y$10$yOZRTKTz3ggBVaDWKA.6tODvQ8U1zN5IOM39ic2bwOt6MTxLtrxUG', 'teacher', 0, '2025-04-19'),
(15, 'Linda Johnson', 'linda.johnson5@example.com', '$2y$10$He8PCblvlkhCKIpI65kq7Oi3YFOFxK0Nk2vZPOj2lzkcfz4NAQk1C', 'teacher', 0, '2025-04-19'),
(16, 'James Wilson', 'james.wilson6@example.com', '$2y$10$Koa3DvNeNUjftexw894/AO3xhglNBHzQPB830wyESyiFuAGGFSK8q', 'teacher', 0, '2025-04-19'),
(17, 'Sara Brown', 'sara.brown7@example.com', '$2y$10$6IzFbhKEdbaO/OTTyE4yt.kXXJ5kP6ryAwJDFMZN/laFxa8utYnCG', 'teacher', 0, '2025-04-19'),
(18, 'Jane Davis', 'jane.davis8@example.com', '$2y$10$.6Kxgsu2eEW5ztf/EeTkDuZh0/MtnTQaAnO1B.9NvLJYrWrRpi0/2', 'teacher', 0, '2025-04-19'),
(19, 'Laura Davis', 'laura.davis9@example.com', '$2y$10$9YlndYHTlNLPNaQN/X3cSuMvVIDPFuDvYWSHjSBKoMXKz4Ibs2MfK', 'teacher', 0, '2025-04-19'),
(20, 'Emily Jones', 'emily.jones10@example.com', '$2y$10$kRTAdE/BgGhNgFixrgPwsuXOXGRH6r8AlAbYywdPJEl8horOR7MG2', 'teacher', 0, '2025-04-19'),
(21, 'James Wilson', 'james.wilson11@example.com', '$2y$10$sX18L/oZvNjCxds5EMAzMOmPpcPKzBRL9qmJTTqK4VP5dP1YwrDcG', 'teacher', 0, '2025-04-19'),
(22, 'John Miller', 'john.miller12@example.com', '$2y$10$ICjmIz.wS/NAu0e/mXw.4urUSkLKxD6u.zL9K/j8ZOzWvvyEy2jNu', 'teacher', 0, '2025-04-19'),
(23, 'James Wilson', 'james.wilson13@example.com', '$2y$10$Mwh.EZSBY5Ga2YWJf56y1.5Q4A2EHWI.fIES/ySIbNoTt71dgwQ7O', 'teacher', 0, '2025-04-19'),
(24, 'Jane Williams', 'jane.williams14@example.com', '$2y$10$2E//lIWeGgQvIbCvcZkQUu2fByLuQoGfmHxrku77IXoyvHDwoN/06', 'teacher', 0, '2025-04-19'),
(25, 'Alex Wilson', 'alex.wilson15@example.com', '$2y$10$ARKASHN9.4V31kbCRuNXY.4B9E/3TKRca6/Q1HXIoycUPs79Zwt9e', 'teacher', 0, '2025-04-19'),
(26, 'Alex Williams', 'alex.williams16@example.com', '$2y$10$mYzh8zT4kXyLt6elggGBtu8OkumKS2B3TbBiHO7aHAlEHp6ixRKzG', 'student', 0, '2025-04-19'),
(27, 'Robert Taylor', 'robert.taylor17@example.com', '$2y$10$.7joKUBYP6Blv6PHunmgou36Ga/mj6jx6obrl1XcOfPIhgS2719Ha', 'student', 0, '2025-04-19'),
(28, 'Mike Wilson', 'mike.wilson18@example.com', '$2y$10$09dOQcnZSn3DqCZ6/brCvesonIrvbCUYOsi.MDdSP8MItEwiJougq', 'student', 0, '2025-04-19'),
(29, 'Emily Wilson', 'emily.wilson19@example.com', '$2y$10$921Of/rVLBl2461yT2PALu/MO/KDo7gkxB8h3u7NcQXrKawWSq6c6', 'student', 0, '2025-04-19'),
(30, 'Jane Smith', 'jane.smith20@example.com', '$2y$10$KQwqwB14A9fwv5flT3y6cu/UmfQS5Ayvav80m7rTt1mFD3wO7JZq.', 'student', 0, '2025-04-19'),
(31, 'John Williams', 'john.williams21@example.com', '$2y$10$039LvOLDczCrgcjDB7aee.zkQP9xaudwH9gHMm3F/eg7Jqb3n41Gy', 'student', 0, '2025-04-19'),
(32, 'Mike Johnson', 'mike.johnson22@example.com', '$2y$10$vmkLcwAbU5iGizq0CXHkQeXuO15Tq3LmkFaR43kvJcQBNf7rq0Zai', 'student', 0, '2025-04-19'),
(33, 'Jane Wilson', 'jane.wilson23@example.com', '$2y$10$rQM.mSzadSFONS18nqbojOWUDsbSuQlip5QeB2.TdU4zzicdyMEK6', 'student', 0, '2025-04-19'),
(34, 'John Taylor', 'john.taylor24@example.com', '$2y$10$uLkgAvAq//ennw4oyUWqKeBOKpo/UjL.rZ6tZGIB3CgzZIySIg3BK', 'student', 0, '2025-04-19'),
(35, 'Emily Garcia', 'emily.garcia25@example.com', '$2y$10$p0Qk/1y5rV9dDqVYGTT0NeR3NYrXPJ5nd12vsymEVpVc2cFFgLkD.', 'student', 0, '2025-04-19'),
(36, 'Linda Williams', 'linda.williams26@example.com', '$2y$10$S1BgIMhhpwJozWbhJwL26eWdW6XtxI6xtvOiORHEfrIN.z7GW4ZKi', 'student', 0, '2025-04-19'),
(37, 'Robert Johnson', 'robert.johnson27@example.com', '$2y$10$PrQic6yBZ3EhbOMmoDWDJ.U62GUtq9cGHok4FWXStB2jzIsRFwD2G', 'student', 0, '2025-04-19'),
(38, 'James Garcia', 'james.garcia28@example.com', '$2y$10$uLNqoCi5m1GwtRaF22MReOaIbkPhz66tFeWXRfOZGaHiXcMLe9bDy', 'student', 0, '2025-04-19'),
(39, 'Jane Johnson', 'jane.johnson29@example.com', '$2y$10$frABL7cduZknlYBzQGJ89O2L9E46iUkbtmQJTEEx0cOLSKLmpO1vu', 'student', 0, '2025-04-19'),
(40, 'Jane Garcia', 'jane.garcia30@example.com', '$2y$10$EWcfhcpvqlU3nag2aI.jSen3hN3bR5K7l52R89WHiJZ1anlQ4nWP.', 'student', 0, '2025-04-19'),
(41, 'Robert Brown', 'robert.brown31@example.com', '$2y$10$UP8CJrFuFEq0BaYH69b4cezXL.MWPm4MjbYoCG0FA4T3Ql2EIuhqq', 'student', 0, '2025-04-19'),
(42, 'James Brown', 'james.brown32@example.com', '$2y$10$EZv0uuymHGyPt28Syc4DKOvCnWFniB18iBEf5eUH3/s5QR.r7FDDy', 'student', 0, '2025-04-19'),
(43, 'Emily Taylor', 'emily.taylor33@example.com', '$2y$10$rY4Zp.E1vNzxdT76bwjQ8.yv/0r143FuLrFLQTnA7XUdpEPerpzJ2', 'student', 0, '2025-04-19'),
(44, 'Robert Wilson', 'robert.wilson34@example.com', '$2y$10$CpvrjYMP98zF.FEdkWDBAOP2EbqLAt4V.sNnlU1UuaccvFCX5tjqG', 'student', 0, '2025-04-19'),
(45, 'Mike Williams', 'mike.williams35@example.com', '$2y$10$8zEmRrWNmNj8cwS..krMxuG2bR9bGPw1iwgmfnOmqyJOldwHFR7yq', 'student', 0, '2025-04-19'),
(46, 'Mike Garcia', 'mike.garcia36@example.com', '$2y$10$HUzr8I/76RLQQmYB5ilVg.Kp7OALYAtpcWybM5zthSjUAZ3zNqxd.', 'student', 0, '2025-04-19'),
(47, 'Alex Taylor', 'alex.taylor37@example.com', '$2y$10$suGa/zfY2DG/mdSd2AoAa.g5ERNQff1Xb9xyrJfSJSnLLzdU3FKi6', 'student', 0, '2025-04-19'),
(48, 'John Davis', 'john.davis38@example.com', '$2y$10$uVfhOUm2NyIBwmVMw.up/eJsZKWC/6iNNNFow2n2lHJ/bonY6D76u', 'student', 0, '2025-04-19'),
(49, 'James Wilson', 'james.wilson39@example.com', '$2y$10$g8SHcSXZfPB/NBK8h8QUKeu4EOj55/Zs4u4Gqwzh400tMa1p7F72C', 'student', 0, '2025-04-19'),
(50, 'James Jones', 'james.jones40@example.com', '$2y$10$0iUcOEpRVEOgIl8opyXz7.GIOPGuxn0L9uVfGAfEd7SOPCqsOfrvu', 'student', 0, '2025-04-19'),
(51, 'James Miller', 'james.miller41@example.com', '$2y$10$3kYoe2Ia/LSBS4luBAYJ7e..AuTI0Ba0yEZdrz3.9coV1lJfxQyiq', 'student', 0, '2025-04-19'),
(52, 'John Garcia', 'john.garcia42@example.com', '$2y$10$xOxs6QgopM0PRmTgu8ZiYekER8/CtlOHoO/KvQ5DIlcn6jW.zstFK', 'student', 0, '2025-04-19'),
(53, 'Sara Johnson', 'sara.johnson43@example.com', '$2y$10$1Ihlpu8RMhCSxIlFFBCe4ulxoF5o7CNfyRd2CdJYjIa2JzS8syJwO', 'student', 0, '2025-04-19'),
(54, 'Emily Johnson', 'emily.johnson44@example.com', '$2y$10$WspH5P92B.BvHgnTRB4Auu0QtdiWXKYEQI7Uz429/iVr75tH6/oD2', 'student', 0, '2025-04-19'),
(55, 'Laura Taylor', 'laura.taylor45@example.com', '$2y$10$8fGE8B3r91kTxDSxRx9FxeygrjC6Q3n4PvacN/Mya5tHh0.naFsUi', 'student', 0, '2025-04-19'),
(56, 'Sara Taylor', 'sara.taylor46@example.com', '$2y$10$Hj230jTc1a4og.buQRVTCOFo.aRVxRuuO1nGNWeXsKxlAqR00I49G', 'student', 0, '2025-04-19'),
(57, 'Alex Johnson', 'alex.johnson47@example.com', '$2y$10$MMvZRVPva9Q68u3TPQ3GtOGV2f3T0Ma1caeR08R4Bm/HA.3X5CtPq', 'student', 0, '2025-04-19'),
(58, 'Linda Taylor', 'linda.taylor48@example.com', '$2y$10$xxozd8VbX5GV4jPGkKfN5ezRY7fLuRyU9mD/2IiVWldchb9dZHcBq', 'student', 0, '2025-04-19'),
(59, 'Robert Williams', 'robert.williams49@example.com', '$2y$10$TC23KI53Bn5BsfxGlAtHQutLsFIVbJB5I7rxt.b4vjVYscT4YDffa', 'student', 0, '2025-04-19'),
(60, 'Emily Brown', 'emily.brown50@example.com', '$2y$10$/h5zptJZGDRIOwQUyz1lxOkeQ3.vvJHSP9hk.pGmwRdU6VbVg79UO', 'student', 1, '2025-04-19'),
(61, 'Laura Smith', 'laura.smith51@example.com', '$2y$10$.0yk18jRDUfEv/WUgRcLh.T5paaHeWpSswSKB0vlLR27PeYh2AgZC', 'student', 1, '2025-04-19'),
(62, 'Linda Wilson', 'linda.wilson52@example.com', '$2y$10$.TmjY8fpYZVyLGnh9ELuNOm.4ENOOiyaLeEeyp6qrcnYtH1nEMEIu', 'student', 1, '2025-04-19'),
(63, 'Sara Smith', 'sara.smith53@example.com', '$2y$10$9jzlLF8GTdXq1JWd.5ZbxOtY65m7K8AvcM0BJlVyPqB52RBeoRLc2', 'student', 0, '2025-04-19'),
(64, 'Robert Garcia', 'robert.garcia54@example.com', '$2y$10$6zEG70cmbQOPPxugCI92YeFkhFy/1f6l5TL.K3a6TXwHfIWc.pDmS', 'student', 0, '2025-04-19'),
(65, 'Linda Johnson', 'linda.johnson55@example.com', '$2y$10$1OmtVewXgnMXDEyv9ARUc./zgV9PP5kgN3/VobfXfTldE6nJbXZWW', 'student', 0, '2025-04-19'),
(66, 'Mike Johnson', 'mike.johnson56@example.com', '$2y$10$cLlzgu61Pa/D9WPTsGBP9.mybDhbQcNH2MRZp7eF0x1a74pSDVinC', 'student', 0, '2025-04-19'),
(67, 'Jane Taylor', 'jane.taylor57@example.com', '$2y$10$FiCMBxa164ZoE./UhZWHnOB1Jf0RtEQIf2uO8RwmffXRVo2.p7D.G', 'student', 0, '2025-04-19'),
(68, 'Jane Brown', 'jane.brown58@example.com', '$2y$10$.ZS8Fc7.50UWNxKxg4XcM.dCSnR1qw9oL6pYF7QN.Z5cITL2tKttS', 'student', 0, '2025-04-19'),
(69, 'Mike Davis', 'mike.davis59@example.com', '$2y$10$DLAGJ9cyEUrY/0p2VGRLi.5nHmS5I6kwzi4iEsna1Sjf6e.kg2lPm', 'student', 0, '2025-04-19'),
(70, 'Linda Brown', 'linda.brown60@example.com', '$2y$10$WWxO04OzXSyTA024x7YwM.NKDbKiBmfWmxK/IYjiFlJNwb1M4zT76', 'student', 0, '2025-04-19'),
(71, 'Jane Wilson', 'jane.wilson61@example.com', '$2y$10$vivjiBS2Yhpn3NECL2k/7OKgx0AR/Yqnp/eHQfuJ8GtxndZuvoXEu', 'student', 0, '2025-04-19'),
(72, 'Alex Wilson', 'alex.wilson62@example.com', '$2y$10$UVFuRbiMZn9Ly1exoePfeOBGNcXFSfeS0yd.2Y4c3HrSc3tw2rGcq', 'student', 0, '2025-04-19'),
(73, 'James Garcia', 'james.garcia63@example.com', '$2y$10$jRjaxiu2rp4PbtTslbLspuxr6G6B2vQy.cZL3c/Vjn.BJssrRf1mu', 'student', 0, '2025-04-19'),
(74, 'Mike Davis', 'mike.davis64@example.com', '$2y$10$dXvUPh5ZfUX5SYXWKs7gdOvkFSpLnGuMnHGAMMkzI8yDO6nJYRZi.', 'student', 0, '2025-04-19'),
(75, 'Sara Taylor', 'sara.taylor65@example.com', '$2y$10$7ahftRT/p7pIPb1AMuaXSO1DqAQR4batduYQQZd6NcizH9VkHfYhe', 'student', 0, '2025-04-19'),
(76, 'Mike Taylor', 'mike.taylor66@example.com', '$2y$10$/6aFX/9rgBOPhsr22mGHNuYs2mD55qfNF8FYO8qIND0JaLaePZBSK', 'student', 0, '2025-04-19'),
(77, 'Emily Smith', 'emily.smith67@example.com', '$2y$10$JaaAgOwSBQ/.BxGW1a5jTOsEusRwDWkA.YroZYVEAx2iPW2rP5m7u', 'student', 0, '2025-04-19'),
(78, 'James Smith', 'james.smith68@example.com', '$2y$10$ii2XAu0FXcAC1ZAMSf5D5eipT21IhzniUmODVQWdIM9zQc1wkMvlS', 'student', 0, '2025-04-19'),
(79, 'Emily Johnson', 'emily.johnson69@example.com', '$2y$10$tashcSMQkk4Tk99Kc1ozX.6xi/4NGRrskVunxz1xvDWx/5reI/jXe', 'student', 0, '2025-04-19'),
(80, 'Emily Johnson', 'emily.johnson70@example.com', '$2y$10$tBg6WjG6Xs30Y7PXy/WChuEdb6EcQzJrldKljiHc/41VhBsyoPb/i', 'student', 0, '2025-04-19'),
(81, 'James Jones', 'james.jones71@example.com', '$2y$10$PwFxQ9IBhnkxAZFLEA5gRuBh6J45ZwmtxrjXnC.7gejqnz8bLcte2', 'student', 0, '2025-04-19'),
(82, 'Robert Williams', 'robert.williams72@example.com', '$2y$10$0d1Lc6iFwLkNPoMk/v.EOO1fXEngd0dJzS7uc7O4aK5Mp/dGzcEtm', 'student', 0, '2025-04-19'),
(83, 'Mike Davis', 'mike.davis73@example.com', '$2y$10$u/8x8B/GSxRgyKFUhv781ORPJziQw0m1WEyhcPG9F/Qc2mGYkVOx6', 'student', 0, '2025-04-19'),
(84, 'Laura Wilson', 'laura.wilson74@example.com', '$2y$10$I3qmII/jBP5nNJJZjDE5sOsIUR8gAT6RzcYNcZuWj2z9.d9ywWW6W', 'student', 0, '2025-04-19'),
(85, 'Sara Miller', 'sara.miller75@example.com', '$2y$10$wvUtRUbOycu0j.fikSaTBuxc0J8vtAf539PwAigMHP8Jpm10ODmrq', 'student', 0, '2025-04-19'),
(86, 'Linda Smith', 'linda.smith76@example.com', '$2y$10$hz0a/q5O4hFm2KP4MumLpOU93XWmOueoPR1p3rDBKGUZnZI61EGT.', 'student', 0, '2025-04-19'),
(87, 'Alex Johnson', 'alex.johnson77@example.com', '$2y$10$2KgarPw9aKuMzJwJQblhBuIywdR3g/ypajkChvwnV1Kc2KFE87.p.', 'student', 0, '2025-04-19'),
(88, 'Sara Johnson', 'sara.johnson78@example.com', '$2y$10$0rg0S55eKSend/C73wXu4uE8OY1AcdTBUFHDk3KTCrOSL3LO16MFu', 'student', 0, '2025-04-19'),
(89, 'Alex Davis', 'alex.davis79@example.com', '$2y$10$zGo6n8jHKXMoiTq1cpB2x.efOZmxnG3Z1RDpLPPHBQkrJc7c9iXya', 'student', 0, '2025-04-19'),
(90, 'Alex Jones', 'alex.jones80@example.com', '$2y$10$CKYMG/rZ2zQjAoSrQ3eS/uJVEs4xa2Bz9SInx4rcAFPS5Aksq0THK', 'student', 0, '2025-04-19'),
(91, 'Emily Brown', 'emily.brown81@example.com', '$2y$10$lXR.7utMYaZ.AC70U7skduS1AERNyr4Eu2m4l9zqRs0wW6.dU0TnG', 'student', 0, '2025-04-19'),
(92, 'Emily Miller', 'emily.miller82@example.com', '$2y$10$31RvCR4AXf5xgSg8PGng6e9aVzoqNCSQowGmolhH0lFK42/WCqjmC', 'student', 0, '2025-04-19'),
(93, 'James Jones', 'james.jones83@example.com', '$2y$10$sE82RHGBb0RcklZdigV88.F8vSJID8DHhxZ9z/TjZa77uu4g/bDAG', 'student', 0, '2025-04-19'),
(94, 'Jane Johnson', 'jane.johnson84@example.com', '$2y$10$mNa8/3c9jOVOhfmTIP0X3uD.QpM266qWYKPqqmKqq3UDPovrXpa/W', 'student', 0, '2025-04-19'),
(95, 'Emily Smith', 'emily.smith85@example.com', '$2y$10$nSNI2QsIrzEfSfnEuN92uu/5K0QvXdwUFlefffguajR6iiLWGBU46', 'student', 0, '2025-04-19'),
(96, 'Alex Garcia', 'alex.garcia86@example.com', '$2y$10$aA8DAD2D1hJmekH2btVxkedXG3FsDQ9D4SQa80.1nCEGrbuhQmybm', 'student', 0, '2025-04-19'),
(97, 'John Wilson', 'john.wilson87@example.com', '$2y$10$Z1nQJnvRIFse7DRF1pyEEuXkzw1DukzX/6tp.gZTMjMp1hW4rXKru', 'student', 0, '2025-04-19'),
(98, 'James Wilson', 'james.wilson88@example.com', '$2y$10$Vb/BvY1tcb1dYaqtnQeHDOqIixndSO/PeMZjSjnj/hgxZCQdLxI8.', 'student', 0, '2025-04-19'),
(99, 'James Garcia', 'james.garcia89@example.com', '$2y$10$R4uGlt4n1Q6Xg0vAyAvD0uDzS5FJdGlwslGs0aX.kKc0v8uMFhyTe', 'student', 0, '2025-04-19'),
(100, 'Sara Davis', 'sara.davis90@example.com', '$2y$10$LQyt0.T8Qfl8aGMPRsuTGuBoKELT7zuM6DRwel7/ZZnLKx2psREXC', 'student', 0, '2025-04-19'),
(101, 'James Jones', 'james.jones91@example.com', '$2y$10$MR9r8I.bzMvSDD6PcbhYROebICZ.zQzv3.96nXHlKFzT.86LXY1ne', 'student', 0, '2025-04-19'),
(102, 'James Brown', 'james.brown92@example.com', '$2y$10$lx9jCOJLFYscxI3j0LQvpOuaTEy//sMn4t0VxvCEs6ArWSuwneP66', 'student', 0, '2025-04-19'),
(103, 'John Davis', 'john.davis93@example.com', '$2y$10$w5eTXcb/2wp6sbTx5dPmKeEVqxcdtwBIU7AMEfMlnpCnI66bDFokS', 'student', 0, '2025-04-19'),
(104, 'Robert Brown', 'robert.brown94@example.com', '$2y$10$WqOej23UnkMyM7AEI6ihROaweHgOIMA1UJ5FMXAwwD3o03976JyJK', 'student', 0, '2025-04-19'),
(105, 'Alex Smith', 'alex.smith95@example.com', '$2y$10$9rHRBbtciBVTP1zUHlOo1OLjds/7QjjDWpVwgtyMlpJFjXn/7OeMK', 'student', 0, '2025-04-19'),
(106, 'Alex Brown', 'alex.brown96@example.com', '$2y$10$lHz9jLOHHVgWOfFUMtlK7.GBh97lL4JujVFnDAmsU9J4F4GSNtZwm', 'student', 0, '2025-04-19'),
(107, 'John Taylor', 'john.taylor97@example.com', '$2y$10$DJg9A5LtTOGS67wtKk.Os.AqpO7XWeQ8dUrHVkaUpxxIL7EifYEWC', 'student', 0, '2025-04-19'),
(108, 'Emily Garcia', 'emily.garcia98@example.com', '$2y$10$50qSrBOfXx4ZTi0fBqjiZuczvC0NW86K8qY06Xcg4ZfNl2tPTqPq6', 'student', 0, '2025-04-19'),
(109, 'Laura Davis', 'laura.davis99@example.com', '$2y$10$IpAOgtgDFB4qzCVXgOgpCujzQ.SLQjmW0s.KdFtHjJ0zRUj8QzaC2', 'student', 0, '2025-04-19'),
(110, 'Emily Smith', 'emily.smith100@example.com', '$2y$10$FnWLul6To5oEJsVV3MXmIuzi0CS4iHPlwATGoPGR4E9i/WOOAH4C2', 'student', 0, '2025-04-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `signuprequests`
--
ALTER TABLE `signuprequests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `signuprequests`
--
ALTER TABLE `signuprequests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `signuprequests`
--
ALTER TABLE `signuprequests`
  ADD CONSTRAINT `signuprequests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
