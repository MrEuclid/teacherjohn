-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 21, 2021 at 12:21 PM
-- Server version: 10.3.31-MariaDB-0+deb10u1
-- PHP Version: 7.3.29-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `euclid_temple`
--

-- --------------------------------------------------------

--
-- Table structure for table `triangleResults`
--

CREATE TABLE `triangleResults` (
  `id` int(11) NOT NULL,
  `team` varchar(32) NOT NULL,
  `score` int(2) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `triangleResults`
--

INSERT INTO `triangleResults` (`id`, `team`, `score`, `time`) VALUES
(1, 'dsa-#510', 1, '2021-11-14 04:42:35'),
(2, 'dsa-#510', 1, '2021-11-14 04:43:18'),
(3, 'zxc-#531', 5, '2021-11-14 04:47:52'),
(4, 'zxc-#531', 5, '2021-11-14 04:49:32'),
(5, 'zxc-#531', 5, '2021-11-14 04:50:00'),
(6, 'xzs-#590', 5, '2021-11-14 04:50:43'),
(7, 'john-#229', 5, '2021-11-14 04:53:51'),
(8, 'alpha2-#620', 5, '2021-11-14 04:55:10'),
(9, 'asd', 3, '2021-11-21 02:16:56'),
(10, 'alpha', 3, '2021-11-21 02:19:29'),
(11, 'alpha', 3, '2021-11-21 02:20:53'),
(12, 'alpha', 3, '2021-11-21 02:24:37'),
(13, 'alpha', 3, '2021-11-21 02:25:16'),
(14, 'alpha', 6, '2021-11-21 02:26:51'),
(15, 'alpha', 3, '2021-11-21 02:30:07'),
(16, 'alpha', 3, '2021-11-21 02:30:57'),
(17, 'alpha', 3, '2021-11-21 02:33:19'),
(18, 'gdg', 3, '2021-11-21 02:36:34'),
(19, 'gdg', 3, '2021-11-21 04:20:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `triangleResults`
--
ALTER TABLE `triangleResults`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `triangleResults`
--
ALTER TABLE `triangleResults`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
