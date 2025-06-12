-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2025 at 06:32 PM
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
  `brand` varchar(256) NOT NULL,
  `year_model` date NOT NULL,
  `car_id` bigint(20) NOT NULL,
  `plate_number` varchar(256) NOT NULL,
  `mileage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_model`
--

INSERT INTO `car_model` (`brand`, `year_model`, `car_id`, `plate_number`, `mileage`) VALUES
('aaa', '2222-07-22', 4, '132', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `firstname`, `lastname`, `username`, `email`, `password`) VALUES
(1, 'ja', 'ej', 'ejja', 'ejja@gmail.com', 'pass233'),
(2, 'ja', 'ejja', 'ja ejja', 'ejjaja@gmail.com', '8279309a6fa82723da732043c3620f81'),
(3, 'jaaa', 'ejjaa', 'ja ejjaa', 'ejjaja2@gmail.com', 'pass22'),
(4, 'seb', 'bailey', 'baileyseb02', 'seb@gmail.com', '8279309a6fa82723da732043c3620f81'),
(5, 'aaa', 'aaaa', 'useruser', 'useremail@email.com', '63e780c3f321d13109c71bf81805476e');

-- --------------------------------------------------------

--
-- Table structure for table `viewcar`
--

CREATE TABLE `viewcar` (
  `id` int(11) NOT NULL,
  `dateval` date NOT NULL,
  `task` varchar(255) NOT NULL,
  `performedBy` varchar(255) NOT NULL,
  `materials` int(11) NOT NULL,
  `labor` int(11) NOT NULL,
  `otherCost` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `viewcar`
--

INSERT INTO `viewcar` (`id`, `dateval`, `task`, `performedBy`, `materials`, `labor`, `otherCost`, `total`) VALUES
(1, '2025-05-31', 'engine swap', 'john', 200, 200, 200, 0),
(3, '2025-05-31', 'change oil', 'seb', 300, 250, 100, 0);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car_model`
--
ALTER TABLE `car_model`
  MODIFY `car_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `viewcar`
--
ALTER TABLE `viewcar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
