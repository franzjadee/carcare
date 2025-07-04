-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2025 at 09:28 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_care`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_model`
--

CREATE TABLE `car_model` (
  `car_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plate_number` varchar(256) NOT NULL,
  `brand` varchar(256) NOT NULL,
  `year_model` date NOT NULL,
  `mileage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_model`
--

INSERT INTO `car_model` (`car_id`, `user_id`, `plate_number`, `brand`, `year_model`, `mileage`) VALUES
(11, 5, '1', 'asdasd', '0001-11-11', 1),
(12, 6, '121212', '1111', '0001-01-01', 1),
(16, 5, '414141', 'sdasda', '0111-11-11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `admin`, `firstname`, `lastname`, `username`, `email`, `password`) VALUES
(4, 0, 'seb', 'bailey', 'baileyseb02', 'seb@gmail.com', '8279309a6fa82723da732043c3620f81'),
(5, 0, 'aaa', 'aaaa', 'useruser', 'useremail@email.com', '63e780c3f321d13109c71bf81805476e'),
(6, 1, 'aaaa', 'aaaaaa', 'tryuser', 'user@email.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(7, 1, 'aa', 'aaa', 'admin', 'admin@email.com', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `viewcar`
--

CREATE TABLE `viewcar` (
  `task_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `dateval` date NOT NULL,
  `task` varchar(255) NOT NULL,
  `requested_by` varchar(256) NOT NULL,
  `performedBy` varchar(255) NOT NULL,
  `materials` int(11) NOT NULL,
  `labor` int(11) NOT NULL,
  `otherCost` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` enum('Pending','Approved','Completed','') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `viewcar`
--

INSERT INTO `viewcar` (`task_id`, `car_id`, `dateval`, `task`, `requested_by`, `performedBy`, `materials`, `labor`, `otherCost`, `total`, `status`) VALUES
(4, 11, '0000-00-00', 'washing', 'useruser', 'john', 2, 1, 111, 0, 'Completed'),
(6, 11, '0000-00-00', 'asdada', '', 'asd asd a', 1, 1, 30, 0, 'Completed'),
(7, 11, '2025-06-19', 'asd asda dsa', '', 'asda', 1, 1, 1, 0, 'Completed'),
(8, 11, '0000-00-00', 'task 1', '', '', 0, 0, 0, 0, 'Approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car_model`
--
ALTER TABLE `car_model`
  ADD PRIMARY KEY (`car_id`),
  ADD UNIQUE KEY `plate_number` (`plate_number`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `viewcar`
--
ALTER TABLE `viewcar`
  ADD PRIMARY KEY (`task_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car_model`
--
ALTER TABLE `car_model`
  MODIFY `car_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `viewcar`
--
ALTER TABLE `viewcar`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
