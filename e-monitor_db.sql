-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2024 at 03:05 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

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
-- Table structure for table `accept`
--

CREATE TABLE `accept` (
  `AAID` int(11) NOT NULL,
  `user` text NOT NULL,
  `equipment_name` text NOT NULL,
  `amount` int(11) NOT NULL,
  `type` text NOT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accept`
--

INSERT INTO `accept` (`AAID`, `user`, `equipment_name`, `amount`, `type`, `reason`) VALUES
(3, 'supply', 'iPhone 15 Pro Max', 12, 'accept', ''),
(4, 'supply', 'iPhone 15 Pro Max', 12, 'accept', ''),
(15, 'user', '33', 1, 'accept', ''),
(16, 'user', 'iPhone 15 Pro Max', 1, 'accept', ''),
(17, 'user', 'ytr765hgj', 1, 'accept', ''),
(18, 'user', 'Nike Air Force One', 1, 'accept', ''),
(19, 'user', 'HDD', 1, 'accept', ''),
(20, 'user', 'Laptop', 1, 'accept', ''),
(21, 'user', '777', 1, 'accept', ''),
(22, 'user', 'iPhone 15 Pro Max', 1, 'accept', ''),
(23, 'user', '777', 1, 'accept', ''),
(24, 'user', '1234567890', 1, 'accept', ''),
(25, 'user', 'HDD', 1, 'accept', ''),
(26, 'user', 'marker', 1, 'accept', ''),
(27, 'user', 'iPhone 15 Pro Max', 1, 'accept', ''),
(28, 'user', '33', 1, 'deny', '1'),
(29, '', 'iPhone 15 Pro Max', 0, 'deny', '1');

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `UID` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `department` text NOT NULL,
  `position` text NOT NULL,
  `user_type` text NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `iid` text NOT NULL,
  `iid_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`UID`, `username`, `password`, `email`, `department`, `position`, `user_type`, `image_path`, `iid`, `iid_image`) VALUES
(16, 'supply', '$2y$10$8ZeNHEB/NDjadtyYLU7OQeZmtqk2upfkMzCcTQ3BbTjcPSfLvzZF.', 'supply', '', 'new', 'supply_user', 'uploads/3.png', '10 14 01', 'id/5.png'),
(19, 'user', '$2y$10$oBKxMyk7SHWbh.cqLG.Nyu6gg4UWfh8oPY3sH80GJANbq.GHFeLpi', 'user', 'BSIT', 'new', 'user', 'uploads/432934309_391714240329971_74603740169139332_n.jpg', '10 14 01', 'id/432934309_391714240329971_74603740169139332_n.jpg'),
(20, 'admin', '$2y$10$yOCaEH81xKRa14fhR7CjleNo5NXGgfwRHmbvJ0SV6WXdnbptwME0q', 'admin', '', '', 'admin', '', '', ''),
(22, 'ss', '$5$rounds=5000$5/FZ/SrgjpaGNu5r$gf9u2dKfaErgrQRFez.5x40/yb6KLLW55rwYEG4ArX6', 'ss', '', '', 'supply_user', '', '', ''),
(33, 'karl', '$2y$10$prKXQ4.B0cHBmbYzocVrUObtYO/o7k1bioE7I57bRsdpfquTWXr1m', 'karlpagdilao14@gmail.com', '', '', 'supply_user', 'uploads/IMG_1906.JPG', '', ''),
(34, 'karl1', '$2y$10$HPgw5vwZWb/z11vc3j6Ep.JjC1MdpBUL4rUfCqAq4G9sdFZ076XI6', 'karlpagdilao14@gmail.com', 'BSIT', '', 'user', 'uploads/IMG_1907.JPG', '', ''),
(35, '2', '$2y$10$y.xMPcZRc9jgiY3vP0AuUOQvVXzzSQeATlVdhS/xtrNeXyai9g1eu', 'password1@gmail.com', 'BSBA', 'elijah', 'user', 'uploads/368091901_663299042322666_5156241491238501512_n.jpg', '', ''),
(36, 'users', '$2y$10$r9zkGnIQDEmI/obIBTViNe4BVF7nekl7OtY4wjGMJrA3cFEJtogiu', 'user@gmail.com', 'BSIT', '', 'user', 'uploads/modern-blue-orange-yellow-abstract-3d-geometric-presentation-background_249611-566.jpg', '', ''),
(42, 'Lhester', '$2y$10$m492nJLauR9VAm2SvYdgOewyjIjWLaCNXGyOD65I8Kf0mY/5/haO2', 'lhester@gmail.com', '', '', 'supply_user', 'uploads/WIN_20240305_10_47_05_Pro.jpg', '', ''),
(43, 'lhester12', '$2y$10$O.ptKpUW0eWtNVyHdrBkUOVdQBss57kSk53MGaLsZvHxEswP6uSV2', 'lhester123@gmail.com', '', '', 'supply_user', 'uploads/WIN_20240305_10_47_05_Pro.jpg', '', ''),
(46, 'christopher', '$2y$10$etMU/oeGqishe6bR38gGEegE4P0aUq9CQLmd/0hIaPmgxxFfw3doS', 'christopheradolfoacoba@gmail.com', '', '', 'supply_user', 'uploads/1710753050733.jpg', '', ''),
(47, 'dd111@gmail.com', '$2y$10$0l8IYLq44w/UyZsN/lvtHOEDDhOFKJQ7hkFcI0g1rg37OXYVARu/W', 'dd111@gmail.com', 'BSCRIM', '', 'user', 'uploads/3671229.png', '', ''),
(48, 'dd111@gmail.com', '$2y$10$AKTldeOo7Yw7bJV6ucwZ1u0Z1pXjsPEAIQ05Znm/r5emx8PLsgWOa', 'dd111@gmail.com', 'BSEDUC', '', 'user', 'uploads/programmer.png', '', ''),
(49, 'jessa', '$2y$10$urkKarEJA24n7ohIp9mSwOp9eTCd4sC63os8mxCBJNexiPkYM8BUC', 'jessa@gmail.com', '', '', 'supply_user', 'uploads/programmer.png', '', ''),
(50, 'jessaa', '$2y$10$zEjmoGdTY5tXtYg88D2XuutEBui.JB8gY47RWkEPkODvIufRnNxWi', 'jessaa@gmail.com', '', '', 'user', 'uploads/supply_officer-icon.png', '', ''),
(52, '1234124', '$2y$10$kMTNyQUyYM3g2MjdN5LEsOffUUe.bjyVPI6LrGhK/d0q8irQmEi3q', 'user@gmail.com', '', 'pos', 'supply_user', 'uploads/370231291_295609796656099_7324808414139182706_n.jpg', '', ''),
(56, 'asd', '$2y$10$BRQfggJQlZGu.44mhelXdOieIHTx1EVyxC/77rKEmlM6WhxfBC2qS', 'asd@gmail.com', '', '', 'supply_user', 'uploads/WIN_20240305_10_47_05_Pro.jpg', '', ''),
(58, 'shshshshshshs', '$2y$10$DZbLLY5JP5GbpexpEqbF7eXkTM/.GcYQZwhueTILnD7cnqAIjZ8ai', 'shshshshshshs@gmail.com', 'SHS', 'shshshshshshs', 'user', 'uploads/images (1).jpg', '12312124', 'id/images (1).jpg'),
(59, 'bcriminale', '$2y$10$rD85vNFxQiuqMluFGvObHulVtCaz5.sBt1lN6oQkeD1jKNV4ly9sa', 'user@gmail.com', 'BSCRIM', 'Program Head', 'supply_user', 'uploads/images (1).jpg', '12312124', 'id/images (1).jpg'),
(60, 'bsit000110001', '$2y$10$H.iTppe0ff8UQVLaheOKLeqdJt.xk3xV0tlq5vXYMK1oNexGy88iC', 'user@gmail.com', 'BSIT', 'Program Head', 'supply_user', 'uploads/b90b42869d60cd52c1949096dfd93c04b977ed55r1-750-1034v2_hq.jpg', '12312124', 'id/b90b42869d60cd52c1949096dfd93c04b977ed55r1-750-1034v2_hq.jpg'),
(61, 'beeducation', '$2y$10$Wsf9V5oZv6CXPOdNbaqnO.PD0z1hR8G5wyq1/2mCiXE6gXHyN9oy.', 'user@gmail.com', 'BEED', 'Program Head', 'supply_user', 'uploads/ehrrdfhqe6231.jpg', '12312124', 'id/ehrrdfhqe6231.jpg'),
(12345, 'Computer Technician', '$2y$10$8ZeNHEB/NDjadtyYLU7OQeZmtqk2upfkMzCcTQ3BbTjcPSfLvzZF.', 'Computer Technician', 'supply officer', 'Computer Technician', 'admin', '', '12345', ''),
(123456, 'Supply Officer', '$2y$10$8ZeNHEB/NDjadtyYLU7OQeZmtqk2upfkMzCcTQ3BbTjcPSfLvzZF.', 'Supply Officer', 'supply officer', 'Supply Officer', 'admin', '', '123456', ''),
(1234567, 'General Merchandise', '$2y$10$8ZeNHEB/NDjadtyYLU7OQeZmtqk2upfkMzCcTQ3BbTjcPSfLvzZF.', 'General Merchandise', 'supply officer', 'General Merchandise', 'admin', '', '1234567', '');

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
  `img` varchar(255) NOT NULL,
  `aid` int(11) NOT NULL,
  `Locate` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `archive_inventory`
--

INSERT INTO `archive_inventory` (`id`, `item_code`, `equipment_name`, `equipment_brand`, `equipment_model`, `equipment_type`, `quantity`, `item_type`, `img`, `aid`, `Locate`) VALUES
(20, '32412dsfa', 'adfa', 'fagfsd', '3425', 'gfsd', 20, '', '', 1, ''),
(18, 'fafdf', 'afadfa', 'afdf', 'afad', 'fadfdsa', 3, '', '', 2, ''),
(25, '4806521682130Enter', '4806521682130', '4806521682130', '4806521682130', '4806521682130', 2147483647, '', '', 3, ''),
(17, '90909', '9090', '9090', '9090', '9090', 90909, '', '', 4, ''),
(30, '010101010', '0101010010', '1010010', '010101010101', '10101010', 11010101, '', '', 5, ''),
(10, '456543567', 'Monitor', 'LG', '26174', '', 105, 'consumable', '', 7, ''),
(15, '777', '777', '777', '777', '', 728, 'consumable', 'uploads/tumblr_ea2b1b3e757dd5efd67a3ff148c3b073_0a3dd22a_1280.gif', 10, ''),
(48, '', 'name', 'brand', 'model', '', 123, 'non-consumable', 'inventory/acer (1).png', 13, ''),
(47, '', '1241424124124', '1241424124124', '1241424124124', '', 2147483647, 'non-consumable', 'inventory/421793657_1767117097101005_665925613396737985_n.jpg', 14, ''),
(46, '', '11111111111111111', '11111111111111111', '11111111111111111', '', 2147483647, 'non-consumable', 'inventory/acer.png', 15, '');

-- --------------------------------------------------------

--
-- Table structure for table `archive_merch`
--

CREATE TABLE `archive_merch` (
  `amid` int(11) NOT NULL,
  `mid` text NOT NULL,
  `name` text NOT NULL,
  `barcode` text NOT NULL,
  `quantity` text NOT NULL,
  `measurement` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `archive_merch`
--

INSERT INTO `archive_merch` (`amid`, `mid`, `name`, `barcode`, `quantity`, `measurement`, `image`) VALUES
(4, '4', '23542354', '235435', '35235', '3535', 'inventory/5da24471b8efc956c516b86d4a571e1d.jpg'),
(5, '6', '1', '2', '3', '4', 'inventory/b90b42869d60cd52c1949096dfd93c04b977ed55r1-750-1034v2_hq.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `archive_user`
--

CREATE TABLE `archive_user` (
  `eid` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `department` text NOT NULL,
  `position` text NOT NULL,
  `user_type` text NOT NULL,
  `image_path` text NOT NULL,
  `iid` text NOT NULL,
  `iid_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `archive_user`
--

INSERT INTO `archive_user` (`eid`, `username`, `password`, `email`, `department`, `position`, `user_type`, `image_path`, `iid`, `iid_image`) VALUES
(4, '1234124', '$2y$10$fEei0rw3p5Sxfo3wul2WBuPQP0TKZ1yXgWff3RSVQRYGHd4GMze7q', 'user@gmail.com', '', 'new', 'supply_user', 'uploads/378135593_698875024909345_835143336972800485_n.jpg', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_item`
--

CREATE TABLE `borrowed_item` (
  `item_code` int(11) NOT NULL,
  `borrow_date` date NOT NULL,
  `borrower` text NOT NULL,
  `equipment_name` text NOT NULL,
  `useless` int(11) NOT NULL,
  `item_type` text NOT NULL,
  `borrowed_amount` int(11) NOT NULL,
  `request_destination` text NOT NULL,
  `request_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrowed_item`
--

INSERT INTO `borrowed_item` (`item_code`, `borrow_date`, `borrower`, `equipment_name`, `useless`, `item_type`, `borrowed_amount`, `request_destination`, `request_date`) VALUES
(14, '2024-03-26', 'user', '777', 49, 'non-consumable', 1, 'New Building', '2024-03-30'),
(12, '2024-03-26', 'user', '33', 50, 'consumable', 1, 'Old Building', '0000-00-00'),
(11, '2024-03-26', 'user', 'iPhone 15 Pro Max', 51, 'consumable', 12, 'Old Building', '0000-00-00'),
(16, '2024-03-26', 'user', 'ytr765hgj', 53, 'non-consumable', 1, 'New Building', '2024-03-27'),
(14, '2024-03-27', 'user', '777', 55, 'non-consumable', 1, 'New Building', '2024-03-25'),
(11, '2024-03-27', 'user', 'iPhone 15 Pro Max', 56, 'consumable', 1, 'New Building', '0000-00-00'),
(11, '2024-03-27', 'user', 'iPhone 15 Pro Max', 57, 'consumable', 10, 'Old Building', '0000-00-00'),
(14, '2024-03-27', 'user', '777', 58, 'non-consumable', 10, 'Old Building', '2024-03-29'),
(11, '2024-03-27', 'supply', 'iPhone 15 Pro Max', 59, 'consumable', 12, '', '0000-00-00'),
(11, '2024-03-27', 'supply', 'iPhone 15 Pro Max', 60, 'consumable', 12, 'New Building', '0000-00-00'),
(14, '2024-03-27', 'supply', '777', 61, 'non-consumable', 12, 'Old Building', '2024-03-29'),
(16, '2024-03-27', 'supply', 'ytr765hgj', 62, 'non-consumable', 12, 'Old Building', '2024-03-28'),
(14, '2024-03-27', 'supply', '777', 63, 'non-consumable', 12, 'New Building', '2024-03-29'),
(12, '2024-04-04', 'user', '33', 64, 'consumable', 1, 'Old Building', '0000-00-00'),
(11, '2024-04-04', 'user', 'iPhone 15 Pro Max', 65, 'consumable', 1, 'Old Building', '0000-00-00'),
(16, '2024-04-04', 'user', 'ytr765hgj', 66, 'non-consumable', 1, 'Old Building', '2024-04-13'),
(31, '2024-04-04', 'user', 'Nike Air Force One', 67, 'non-consumable', 1, 'Old Building', '2024-04-20'),
(27, '2024-04-04', 'user', 'HDD', 68, 'consumable', 1, 'Old Building', '0000-00-00'),
(21, '2024-04-04', 'user', 'Laptop', 69, 'consumable', 1, 'Old Building', '0000-00-00'),
(14, '2024-04-04', 'user', '777', 70, 'non-consumable', 1, 'Old Building', '2024-04-05'),
(26, '2024-04-04', 'user', 'iPhone 15 Pro Max', 71, 'non-consumable', 1, 'Old Building', '2024-04-26'),
(14, '2024-04-04', 'user', '777', 72, 'non-consumable', 1, 'Old Building', '2024-04-06'),
(35, '2024-04-04', 'user', '1234567890', 73, 'non-consumable', 1, 'New Building', '2024-04-05'),
(27, '2024-04-04', 'user', 'HDD', 74, 'consumable', 1, 'New Building', '0000-00-00'),
(32, '2024-04-04', 'user', 'marker', 75, 'consumable', 1, 'Old Building', '0000-00-00'),
(11, '2024-04-07', 'user', 'iPhone 15 Pro Max', 76, 'consumable', 1, 'Old Building', '0000-00-00');

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
  `quantity` int(11) NOT NULL,
  `item_type` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `Locate` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `item_code`, `equipment_name`, `equipment_brand`, `equipment_model`, `quantity`, `item_type`, `img`, `Locate`) VALUES
(11, '2143152', 'iPhone 15 Pro Max', 'Apple', '234523', 788, 'consumable', 'uploads/purepng.com-wifi-icon-blackwifi-iconwifiiconwireless-connection-17015284361412yp74.png', 'Unspecified'),
(12, '34a', '33', '3', '3', 45, 'consumable', 'uploads/supply_officer-icon.png', 'BSCRIM'),
(14, '777', '777', '777', '777', 635, 'non-consumable', '', 'BSCRIM'),
(16, '990908', 'ytr765hgj', 'hjgi776', 'kfgi765', 12285, 'non-consumable', '', 'BSBS'),
(21, '1214462452', 'Laptop', 'Samsung', 'ase353adf', 0, 'consumable', '', 'BSHM'),
(26, '1111000000', 'iPhone 15 Pro Max', 'q24244354352', 'i15PMx', 0, 'non-consumable', '', 'Supply Officer'),
(27, '7636490063435', 'HDD', 'SEAGATE', '320ADG', 80, 'consumable', '', 'Supply Officer'),
(28, '863320063528200', 'Realme', 'Realme', '3254352', 2, 'non-consumable', '', 'Supply Officer'),
(29, 'ABCD', 'abcd', 'efgh', 'EFGH', 12330, 'consumable', '', 'Supply Officer'),
(31, '883412740890', 'Nike Air Force One', 'Nike', '1242425', 0, 'non-consumable', '', 'Supply Officer'),
(32, '4902505088933', 'marker', 'pilot', 'N/A', 4, 'consumable', '', ''),
(33, '789456', 'Monitor', 'Acer', 'ASFT451', 1, 'non-consumable', '', ''),
(34, '0101132401', 'Marker - Pilot', 'HVW', '00000001', 9, 'consumable', '', ''),
(35, '1234567890', '1234567890', '1234567890', '1234567890', 1234567876, 'non-consumable', '', ''),
(36, '8994993002672', 'Garnier', 'Garnier', 'Yogurt Sleeping Mask', 6784, 'consumable', '', ''),
(37, 'bb', 'bb', 'bb', 'bb', 33, 'non-consumable', 'inventory/1710753050733.jpg', ''),
(38, '1234124', 'user-12345', '1', '123', 2134124, 'non-consumable', 'inventory/421793657_1767117097101005_665925613396737985_n.jpg', 'Unspecified'),
(39, '12', '12', '12', '12', 12, 'non-consumable', 'inventory/5da24471b8efc956c516b86d4a571e1d.jpg', 'BSHM'),
(40, '1234124', 'user-12345', 'user@gmail.com', '123', 123, 'non-consumable', 'inventory/5da24471b8efc956c516b86d4a571e1d.jpg', 'HCS'),
(41, '98765', '98765', '98765', '98765', 98765, 'non-consumable', 'inventory/5da24471b8efc956c516b86d4a571e1d.jpg', 'SHS'),
(42, '123456789987654321', 'qwerqwer', 'qwrqwr', 'qwrwqr', 2147483647, 'non-consumable', 'inventory/2143152.png', 'SHS'),
(43, 'user-12345', 'user-12345', 'user-12345', 'user-12345', 12345, 'non-consumable', 'inventory/images.jpg', 'BSHM'),
(44, 'acer', 'acer', 'acer', 'acer', 12, 'non-consumable', 'inventory/421793657_1767117097101005_665925613396737985_n.jpg', ''),
(45, 'acer', 'acer', 'acer', 'acer', 123, 'non-consumable', 'inventory/419546073_856976492819303_895761370860930558_n.jpg', 'BSIT'),
(49, 'bsit', 'name bsit', 'brand bsit', 'model bsit', 123, 'non-consumable', 'inventory/421793657_1767117097101005_665925613396737985_n.jpg', 'BSIT');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `log_id` int(11) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `action` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`log_id`, `time`, `date`, `action`) VALUES
(1, '14:21:28', '2024-02-29', 'admin has archived item id:123'),
(2, '14:21:30', '2024-02-29', 'admin has unarchived item id:123'),
(3, '09:46:41', '2024-03-14', 'admin has inserted user12345 as a new supply officer'),
(4, '09:49:29', '2024-03-14', 'admin has made changes on the account of user1234'),
(5, '09:52:28', '2024-03-14', 'admin has deleted '),
(6, '09:54:15', '2024-03-14', 'admin has inserted jj as a new supply officer'),
(7, '09:54:19', '2024-03-14', 'admin has deleted '),
(8, '12:40:58', '2024-03-15', 'admin has made changes on the account of user1'),
(9, '04:29:33', '2024-03-19', 'admin has inserted Lhester as a new supply officer'),
(10, '04:30:26', '2024-03-19', 'admin has inserted lhester12 as a new supply officer'),
(11, '04:31:37', '2024-03-19', 'admin has inserted dsds as a new supply officer'),
(12, '04:33:20', '2024-03-19', 'admin has inserted asd as a new supply officer'),
(13, '06:18:01', '2024-03-19', 'admin has inserted christopher as a new supply officer'),
(14, '06:19:54', '2024-03-22', 'admin has made changes on the account of supply'),
(15, '06:20:44', '2024-03-22', 'admin has made changes on the account of supply'),
(16, '20:23:24', '2024-03-23', 'admin has inserted jessa as a new supply officer'),
(17, '13:26:34', '2024-03-24', 'admin has made changes on the account of unknoen'),
(18, '13:37:09', '2024-03-24', 'admin has made changes on the account of 1234124'),
(19, '13:37:29', '2024-03-24', 'admin has made changes on the account of 2'),
(20, '13:37:39', '2024-03-24', 'admin has made changes on the account of 1234124'),
(21, '13:46:20', '2024-03-24', 'admin has made changes on the account of user'),
(22, '13:47:11', '2024-03-24', 'admin has deleted '),
(23, '13:47:19', '2024-03-24', 'admin has deleted '),
(24, '13:47:24', '2024-03-24', 'admin has deleted '),
(25, '12:34:51', '2024-03-29', 'admin has made changes on the account of user'),
(26, '12:38:10', '2024-03-29', 'admin has made changes on the account of user'),
(27, '12:42:24', '2024-03-29', 'admin has made changes on the account of user'),
(28, '13:11:42', '2024-03-29', 'admin has made changes on the account of user'),
(29, '13:15:50', '2024-03-29', 'admin has made changes on the account of user'),
(30, '13:18:15', '2024-03-29', 'admin has made changes on the account of user'),
(31, '13:31:39', '2024-03-29', 'admin has made changes on the account of user'),
(32, '13:34:39', '2024-03-29', 'admin has made changes on the account of user'),
(33, '13:41:25', '2024-03-29', 'admin has made changes on the account of user'),
(34, '13:42:59', '2024-03-29', 'admin has made changes on the account of '),
(35, '13:46:58', '2024-03-29', 'admin has made changes on the account of '),
(36, '13:48:25', '2024-03-29', 'admin has made changes on the account of '),
(37, '13:48:52', '2024-03-29', 'admin has made changes on the account of '),
(38, '13:50:00', '2024-03-29', 'admin has made changes on the account of '),
(39, '07:37:20', '2024-04-02', 'admin has deleted '),
(40, '07:38:29', '2024-04-02', 'admin has deleted asd'),
(41, '08:08:47', '2024-04-02', 'admin has deleted 1234124'),
(42, '08:09:03', '2024-04-02', 'admin has deleted 1234124'),
(43, '10:28:52', '2024-04-04', 'admin has archived 1234124');

-- --------------------------------------------------------

--
-- Table structure for table `merch`
--

CREATE TABLE `merch` (
  `mid` int(11) NOT NULL,
  `name` text NOT NULL,
  `barcode` int(11) NOT NULL,
  `quantity` text NOT NULL,
  `measurement` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `merch`
--

INSERT INTO `merch` (`mid`, `name`, `barcode`, `quantity`, `measurement`, `image`) VALUES
(1, 'Frpptees', 7890, '1200', '1200 kg', 'uploads/5da24471b8efc956c516b86d4a571e1d.jpg'),
(5, 'kkkk', 23523, '235432', '235325', 'inventory/d9ee8c316491bacb89db18ea4c38d814.jpg'),
(7, '12345', 2147483647, '12345', '12345', 'inventory/421793657_1767117097101005_665925613396737985_n.jpg'),
(8, '1', 2, '3', '4', 'inventory/5da24471b8efc956c516b86d4a571e1d.jpg'),
(9, '1234567890', 8, '1010101010', 'measurment', 'inventory/419546073_856976492819303_895761370860930558_n.jpg'),
(10, 'name', 123456789, '101010101', 'measure', 'inventory/images.jpg'),
(11, '12', 12, '12', '12', 'inventory/5da24471b8efc956c516b86d4a571e1d.jpg'),
(12, '2354', 235235235, '235235235', '235235235', 'inventory/b90b42869d60cd52c1949096dfd93c04b977ed55r1-750-1034v2_hq.jpg'),
(13, '13', 2147483647, '12', '12', 'inventory/663f859af8e181866e8267aaa9a3de73.jpg'),
(14, 'user1', 123, '123', '123', 'inventory/555.png'),
(15, 'kkkk', 12345, '12345', '`12345', 'inventory/663f859af8e181866e8267aaa9a3de73.jpg'),
(16, 'animal', 98765, '98765', '98765', 'inventory/tumblr_ea2b1b3e757dd5efd67a3ff148c3b073_0a3dd22a_1280.gif');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `rid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `rname` text NOT NULL,
  `request_no` int(11) NOT NULL,
  `item_code` int(11) NOT NULL,
  `equipment_name` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `request_destination` text NOT NULL,
  `return_date` date NOT NULL,
  `type` text NOT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`rid`, `id`, `rname`, `request_no`, `item_code`, `equipment_name`, `quantity`, `request_destination`, `return_date`, `type`, `reason`) VALUES
(159, 14, 'bsit000110001', 1, 777, '777', 0, 'Old Building', '2024-04-12', 'request', '121212');

-- --------------------------------------------------------

--
-- Table structure for table `request_to_ph`
--

CREATE TABLE `request_to_ph` (
  `rid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `rname` text NOT NULL,
  `request_no` int(11) NOT NULL,
  `item_code` int(11) NOT NULL,
  `equipment_name` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `request_destination` text NOT NULL,
  `return_date` date NOT NULL,
  `type` text NOT NULL,
  `reason` text NOT NULL,
  `dept` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_to_ph`
--

INSERT INTO `request_to_ph` (`rid`, `id`, `rname`, `request_no`, `item_code`, `equipment_name`, `quantity`, `request_destination`, `return_date`, `type`, `reason`, `dept`) VALUES
(0, 11, 'user', 1, 2143152, 'iPhone 15 Pro Max', 795, 'New Building', '0000-00-00', 'consumable', '1', 'BSIT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accept`
--
ALTER TABLE `accept`
  ADD PRIMARY KEY (`AAID`);

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
-- Indexes for table `archive_merch`
--
ALTER TABLE `archive_merch`
  ADD PRIMARY KEY (`amid`);

--
-- Indexes for table `archive_user`
--
ALTER TABLE `archive_user`
  ADD PRIMARY KEY (`eid`);

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
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `merch`
--
ALTER TABLE `merch`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `request_to_ph`
--
ALTER TABLE `request_to_ph`
  ADD PRIMARY KEY (`rid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accept`
--
ALTER TABLE `accept`
  MODIFY `AAID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1234568;

--
-- AUTO_INCREMENT for table `archive_inventory`
--
ALTER TABLE `archive_inventory`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `archive_merch`
--
ALTER TABLE `archive_merch`
  MODIFY `amid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `archive_user`
--
ALTER TABLE `archive_user`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `borrowed_item`
--
ALTER TABLE `borrowed_item`
  MODIFY `useless` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `merch`
--
ALTER TABLE `merch`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
