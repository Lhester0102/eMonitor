-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2024 at 07:01 AM
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
  `email` text NOT NULL,
  `user_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`UID`, `username`, `password`, `email`, `user_type`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 'admin'),
(2, 'user', 'user', 'user@gmail.com', 'user'),
(3, 'supply', 'supply', 'supply@gmail.com', 'supply_user'),
(4, 'a', 'a', 'a@gmail.com', 'admin'),
(5, 'name', 'name', 'name@gmail.com', 'user'),
(7, 'add', 'add', 'add@gmail.com', 'user'),
(9, 'nicer', 'nicer', 'nicer@gmail.com', 'supply_user'),
(12, '2', '2', '2', 'supply_user');

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
  `quantity` int(11) NOT NULL,
  `item_type` text NOT NULL,
  `aid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archive_inventory`
--

INSERT INTO `archive_inventory` (`id`, `item_code`, `equipment_name`, `equipment_brand`, `equipment_model`, `equipment_type`, `quantity`, `item_type`, `aid`) VALUES
(20, '32412dsfa', 'adfa', 'fagfsd', '3425', 'gfsd', 20, '', 1),
(18, 'fafdf', 'afadfa', 'afdf', 'afad', 'fadfdsa', 3, '', 2),
(25, '4806521682130Enter', '4806521682130', '4806521682130', '4806521682130', '4806521682130', 2147483647, '', 3),
(17, '90909', '9090', '9090', '9090', '9090', 90909, '', 4),
(30, '010101010', '0101010010', '1010010', '010101010101', '10101010', 11010101, '', 5);

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_item`
--

CREATE TABLE `borrowed_item` (
  `item_code` int(11) NOT NULL,
  `borrow_date` date NOT NULL,
  `borrower` text NOT NULL,
  `equipment_name` text NOT NULL,
  `useless` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowed_item`
--

INSERT INTO `borrowed_item` (`item_code`, `borrow_date`, `borrower`, `equipment_name`, `useless`) VALUES
(10, '2024-02-27', 'user', 'Monitor', 4),
(12, '2024-02-27', 'add', '33', 5),
(14, '2024-02-27', 'user', '777', 6),
(15, '2024-02-27', 'user', '777', 7),
(16, '2024-02-27', 'add', 'ytr765hgj', 8),
(27, '2024-02-27', 'user', 'HDD', 9),
(28, '2024-02-27', 'add', 'Realme', 10),
(29, '2024-02-27', 'user', 'abcd', 11),
(31, '2024-02-27', 'add', 'Nike Air Force One', 12);

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
  `quantity` int(11) NOT NULL,
  `request` int(11) NOT NULL,
  `borrow_no` int(11) NOT NULL,
  `item_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `item_code`, `equipment_name`, `equipment_brand`, `equipment_model`, `equipment_type`, `quantity`, `request`, `borrow_no`, `item_type`) VALUES
(10, '456543567', 'Monitor', 'LG', '26174', 'Electronic', 2, 0, 1, 'consumable'),
(11, '2143152', 'iPhone 15 Pro Max', 'Apple', '234523', 'Electronic', 1, 0, 0, 'non-consumable'),
(12, '34a', '33', '3', '3', '3', 2, 0, 1, 'consumable'),
(14, '777', '777', '777', '777', '777', 774, 0, 1, 'non-consumable'),
(15, '777', '777', '777', '777', '777', 776, 0, 1, 'consumable'),
(16, '990908', 'ytr765hgj', 'hjgi776', 'kfgi765', 'hgi65', 6, 0, 1, 'non-consumable'),
(21, '1214462452', 'Laptop', 'Samsung', 'ase353adf', 'Electronic', 1, 0, 0, 'consumable'),
(26, '1111000000', 'iPhone 15 Pro Max', 'q24244354352', 'i15PMx', 'Electronics', 1, 0, 0, 'non-consumable'),
(27, '7636490063435', 'HDD', 'SEAGATE', '320ADG', 'Electronic', 11, 0, 1, 'consumable'),
(28, '863320063528200', 'Realme', 'Realme', '3254352', 'Electronic', 2, 0, 1, 'non-consumable'),
(29, 'ABCD', 'abcd', 'efgh', 'EFGH', 'ijkl', 12344, 0, 1, 'consumable'),
(31, '883412740890', 'Nike Air Force One', 'Nike', '1242425', 'Shoes', 1, 0, 1, 'non-consumable');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `rid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `rname` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`UID`);

--
-- Indexes for table `archive_inventory`
--
ALTER TABLE `archive_inventory`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `borrowed_item`
--
ALTER TABLE `borrowed_item`
  ADD PRIMARY KEY (`useless`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`rid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `archive_inventory`
--
ALTER TABLE `archive_inventory`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `borrowed_item`
--
ALTER TABLE `borrowed_item`
  MODIFY `useless` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
