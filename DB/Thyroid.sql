-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2016-11-17 03:13:44
-- 服务器版本： 5.7.15
-- PHP Version: 7.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Thyroid`
--

-- --------------------------------------------------------

--
-- 表的结构 `CaseReport`
--

CREATE TABLE `CaseReport` (
  `CaseReport_ID` int(10) UNSIGNED NOT NULL,
  `patient_info` text COLLATE utf8_unicode_ci NOT NULL,
  `instance_info` text COLLATE utf8_unicode_ci NOT NULL,
  `check_result` text COLLATE utf8_unicode_ci NOT NULL,
  `treat_schedule` text COLLATE utf8_unicode_ci NOT NULL,
  `case_note` text COLLATE utf8_unicode_ci NOT NULL,
  `doctor_info` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `instance`
--

CREATE TABLE `instance` (
  `instance_id` int(10) UNSIGNED NOT NULL,
  `belongs_to_series_id` int(10) UNSIGNED NOT NULL,
  `instance_frame_number` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `instance_size` text COLLATE utf8_unicode_ci NOT NULL,
  `tumours_number` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `instance_info` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(12) UNSIGNED NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sex` char(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'M',
  `birthday` date NOT NULL,
  `checknumber` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `last_check` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `patient`
--

INSERT INTO `patient` (`patient_id`, `name`, `sex`, `birthday`, `checknumber`, `last_check`) VALUES
(12112121, '李梅花', '女', '1966-02-22', 2, '2016-11-14 09:26:23'),
(22093321, '钱小明', '男', '1988-05-24', 1, '2016-11-02 13:38:34'),
(24879923, '赵六', '男', '1968-11-15', 1, '2016-11-12 09:24:36'),
(27367285, '李建平', '男', '1984-09-16', 3, '2016-11-01 10:19:42'),
(32098865, '李四', '男', '1994-06-23', 2, '2016-11-13 10:19:21'),
(33545217, '孙小军', '男', '1977-11-30', 1, '2016-11-11 16:39:35');

-- --------------------------------------------------------

--
-- 表的结构 `Treat`
--

CREATE TABLE `Treat` (
  `id` int(11) UNSIGNED NOT NULL,
  `treat_id` int(10) UNSIGNED NOT NULL,
  `belongs_to_patientID` int(10) UNSIGNED NOT NULL,
  `Patient_name` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_id` int(10) UNSIGNED NOT NULL,
  `Doctor_name` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `treat_date` datetime NOT NULL,
  `treat_type` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `treat_series_number` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `Treat`
--

INSERT INTO `Treat` (`id`, `treat_id`, `belongs_to_patientID`, `Patient_name`, `doctor_id`, `Doctor_name`, `treat_date`, `treat_type`, `treat_series_number`) VALUES
(1, 10000001, 27367285, '李建平', 20160001, '王五七', '2016-10-28 09:18:42', 'CT', 1),
(2, 10000002, 27367285, '李建平', 20160001, '王五七', '2016-10-30 10:31:25', 'CT', 1),
(3, 10000003, 27367285, '李建平', 20160001, '王五七', '2016-11-01 10:19:42', 'CT', 1),
(4, 10000004, 22093321, '钱小明', 20160001, '王五七', '2016-11-02 13:38:34', '胸透', 1),
(5, 10000005, 33545217, '孙小军', 20160001, '王五七', '2016-11-11 16:39:35', 'CT', 1),
(6, 10000006, 24879923, '赵六', 20160001, '王五七', '2016-11-12 09:24:36', 'CT', 1),
(7, 10000007, 32098865, '李四', 20160002, '孙梅花', '2016-11-09 09:20:38', 'CT', 1),
(8, 10000008, 32098865, '李四', 20160001, '王五七', '2016-11-13 10:19:21', 'CT', 1),
(9, 10000009, 12112121, '李梅花', 20160001, '王五七', '2016-11-03 09:37:27', 'CT', 1),
(10, 10000010, 12112121, '李梅花', 20160001, '王五七', '2016-11-14 09:26:23', 'X光', 1);

-- --------------------------------------------------------

--
-- 表的结构 `treat_series`
--

CREATE TABLE `treat_series` (
  `series_id` int(10) UNSIGNED NOT NULL,
  `belongs_to_treat_id` int(10) UNSIGNED NOT NULL,
  `series_describe` text COLLATE utf8_unicode_ci NOT NULL,
  `instance_number` int(10) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(32) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `password` char(32) CHARACTER SET latin1 NOT NULL,
  `isAdmin` tinyint(4) NOT NULL DEFAULT '0',
  `birthday` date NOT NULL,
  `sex` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `Doctor_name` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `isAdmin`, `birthday`, `sex`, `Doctor_name`) VALUES
(20160001, 'wangwuqi', '123456', 0, '2001-01-01', 'M', '王五七'),
(20160002, 'sunmeihua', '123456', 0, '1983-02-01', 'F', '孙梅花'),
(20160003, 'lisicun', '123456', 0, '1974-08-09', 'F', '李思存'),
(20160004, 'zhaojianguo', '123456', 0, '1991-11-14', 'M', '赵建国');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `id` (`patient_id`);

--
-- Indexes for table `Treat`
--
ALTER TABLE `Treat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `treat_id` (`treat_id`),
  ADD UNIQUE KEY `unique` (`id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `doctor_id_2` (`doctor_id`),
  ADD KEY `belongs_to_patientID` (`belongs_to_patientID`);

--
-- Indexes for table `treat_series`
--
ALTER TABLE `treat_series`
  ADD UNIQUE KEY `belongs_to_treat_id` (`belongs_to_treat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `id` (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33545218;
--
-- 使用表AUTO_INCREMENT `Treat`
--
ALTER TABLE `Treat`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
