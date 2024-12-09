-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 24, 2024 at 07:55 PM
-- Server version: 8.2.0
-- PHP Version: 8.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bk_exitschool`
--

-- --------------------------------------------------------

--
-- Table structure for table `reg_data`
--

CREATE TABLE `reg_data` (
  `id` int NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `teacher_pin` varchar(13) COLLATE utf8mb4_general_ci NOT NULL,
  `reg_type` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `reg_date1` date NOT NULL,
  `reg_time1` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `reg_date2` date NOT NULL,
  `reg_time2` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `who_respon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `filename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `doc_status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `who_approve` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nday` int NOT NULL DEFAULT '0',
  `nday_approve` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `reg_data_nday`
-- (See below for the actual view)
--
CREATE TABLE `reg_data_nday` (
`id` int
,`timestamp` timestamp
,`teacher_pin` varchar(13)
,`teacher_name` varchar(100)
,`sara` varchar(100)
,`reg_type` varchar(100)
,`reg_date1` date
,`reg_time1` varchar(20)
,`reg_date2` date
,`reg_time2` varchar(20)
,`who_respon` varchar(255)
,`remark` varchar(255)
,`filename` varchar(255)
,`doc_status` varchar(1)
,`who_approve` varchar(255)
,`nday` int
,`ndayx` bigint
);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int NOT NULL,
  `teacher_pin` varchar(13) COLLATE utf8mb4_general_ci NOT NULL,
  `teacher_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sara` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `__________bkexit`
--

CREATE TABLE `__________bkexit` (
  `COL 1` int DEFAULT NULL,
  `COL 2` bigint DEFAULT NULL,
  `COL 3` varchar(29) DEFAULT NULL,
  `COL 4` varchar(1) DEFAULT NULL,
  `COL 5` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure for view `reg_data_nday`
--
DROP TABLE IF EXISTS `reg_data_nday`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `reg_data_nday`  AS SELECT `reg_data`.`id` AS `id`, `reg_data`.`timestamp` AS `timestamp`, `reg_data`.`teacher_pin` AS `teacher_pin`, `teacher`.`teacher_name` AS `teacher_name`, `teacher`.`sara` AS `sara`, `reg_data`.`reg_type` AS `reg_type`, `reg_data`.`reg_date1` AS `reg_date1`, `reg_data`.`reg_time1` AS `reg_time1`, `reg_data`.`reg_date2` AS `reg_date2`, `reg_data`.`reg_time2` AS `reg_time2`, `reg_data`.`who_respon` AS `who_respon`, `reg_data`.`remark` AS `remark`, `reg_data`.`filename` AS `filename`, `reg_data`.`doc_status` AS `doc_status`, `reg_data`.`who_approve` AS `who_approve`, `reg_data`.`nday` AS `nday`, ((to_days(`reg_data`.`reg_date2`) - to_days(`reg_data`.`reg_date1`)) + 1) AS `ndayx` FROM (`reg_data` join `teacher`) WHERE (`reg_data`.`teacher_pin` = `teacher`.`teacher_pin`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reg_data`
--
ALTER TABLE `reg_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reg_data`
--
ALTER TABLE `reg_data`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
