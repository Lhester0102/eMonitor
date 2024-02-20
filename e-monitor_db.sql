-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2024 at 07:57 AM
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
-- Database: `e-monitor_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `UID` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `user_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`UID`, `username`, `password`, `user_type`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'user', 'user', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `archive_inventory`
--

CREATE TABLE `archive_inventory` (
  `id` int(11) NOT NULL,
  `item_code` char(200) NOT NULL,
  `equipment_name` char(200) NOT NULL,
  `equipment_brand` char(200) NOT NULL,
  `equipment_model` char(200) NOT NULL,
  `equipment_type` char(200) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archive_inventory`
--

INSERT INTO `archive_inventory` (`id`, `item_code`, `equipment_name`, `equipment_brand`, `equipment_model`, `equipment_type`, `quantity`) VALUES
(20, '32412dsfa', 'adfa', 'fagfsd', '3425', 'gfsd', 20),
(18, 'fafdf', 'afadfa', 'afdf', 'afad', 'fadfdsa', 3),
(25, '4806521682130Enter', '4806521682130', '4806521682130', '4806521682130', '4806521682130', 2147483647),
(17, '90909', '9090', '9090', '9090', '9090', 90909);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `item_code` char(100) NOT NULL,
  `equipment_name` char(100) NOT NULL,
  `equipment_brand` char(100) NOT NULL,
  `equipment_model` char(100) NOT NULL,
  `equipment_type` char(100) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `item_code`, `equipment_name`, `equipment_brand`, `equipment_model`, `equipment_type`, `quantity`) VALUES
(10, '1527aaaa', 'Monitor', 'LG', '26174', 'Electronic', 1),
(11, '2', '2', '2', '2', '2', 2),
(12, '34a', '33', '3', '3', '3', 3),
(14, '777', '777', '777', '777', '777', 777),
(15, '777', '777', '777', '777', '777', 777),
(16, '990908', 'ytr765hgj', 'hjgi776', 'kfgi765', 'hgi65', 7),
(21, '1214462452', 'Laptop', 'Samsung', 'ase353adf', 'Electronic', 1),
(26, 'svg', 's', 's', 'd', 'gry', 2),
(27, '7636490063435', 'HDD', 'SEAGATE', '320ADG', 'Electronic', 12),
(28, '863320063528200', 'Realme', 'Realme', '3254352', 'Electronic', 1),
(29, 'ABCD', 'abcd', 'efgh', 'EFGH', 'ijkl', 12345),
(30, '010101010', '0101010010', '1010010', '010101010101', '10101010', 11010101),
(31, '883412740890', 'Nike Air Force One', 'Nike', '1242425', 'Shoes', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`UID`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
