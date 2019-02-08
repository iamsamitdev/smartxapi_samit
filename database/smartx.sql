-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2019 at 03:57 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartx`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(5) NOT NULL,
  `eqnum` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `picture1` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `picture2` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gps_lat` decimal(8,6) NOT NULL,
  `gps_long` decimal(8,6) NOT NULL,
  `light` decimal(5,2) NOT NULL,
  `userid` int(5) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `eqnum`, `description`, `status`, `picture1`, `picture2`, `gps_lat`, `gps_long`, `light`, `userid`, `create_at`) VALUES
(1, '115879', 'Test desc', '2', 'pic1.jpg', 'pic2.jpg', '11.938329', '99.893275', '3.00', 3, '0000-00-00 00:00:00'),
(2, '8795489', 'Test desc 2', '3', 'pic1.jpg', NULL, '11.938329', '99.893275', '23.50', 3, '2019-02-07 08:33:24'),
(3, '8795489', 'Test desc 2', '3', 'pic1.jpg', NULL, '11.938329', '99.893275', '23.50', 3, '2019-02-07 08:41:33'),
(4, 'ETD 002', 'This is ETD job desc', '2', 'job1.jpg', NULL, '99.983256', '10.345634', '20.20', 5, '2019-02-07 10:08:19'),
(5, 'E2989', 'test upload file', 'pass', '1549593721_bgtodaysamit1..jpg', NULL, '10.989389', '99.989389', '20.30', 3, '2019-02-08 02:42:01'),
(6, 'E2989', 'test upload file', 'pass', '1549594004_autocad2019_trial.jpg', NULL, '10.989389', '99.989389', '20.30', 3, '2019-02-08 02:46:44'),
(7, 'E2989', 'test upload file', 'pass', 'nopic.jpg', NULL, '10.989389', '99.989389', '20.30', 3, '2019-02-08 03:01:08'),
(8, 'Ets22', 'askfjsafk', 'Abnormal', '1549614623_scg_7243968747395317456.jpg', NULL, '10.345678', '99.345678', '20.50', 4, '2019-02-08 08:30:23'),
(9, 'Ets22', 'askfjsafk', 'Abnormal', '1549614667_img_20190208_112639.jpg', NULL, '10.345678', '99.345678', '20.50', 4, '2019-02-08 08:31:07'),
(10, 'gggg', 'ggggg', 'Normal', '1549615834_1549615817299.jpg', NULL, '10.345678', '99.345678', '20.50', 4, '2019-02-08 08:50:34'),
(11, 'gggg', 'ggggg', 'Normal', '1549615893_1549615880582.jpg', NULL, '10.345678', '99.345678', '20.50', 4, '2019-02-08 08:51:34'),
(12, 'gggg', 'ggggg', 'Normal', '1549615904_1549615817299.jpg', NULL, '10.345678', '99.345678', '20.50', 4, '2019-02-08 08:51:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `fullname` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `password`, `type`) VALUES
(4, 'Anurak Meesuk', 'anurak', '123456', 1),
(5, 'Samit Koyom', 'iamsamit', '112233', 1),
(6, 'Sirirat Butkan', 'sirirat', '145879', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
