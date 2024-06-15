-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2023 at 04:56 PM
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
-- Database: `badminto`
--

-- --------------------------------------------------------

--
-- Table structure for table `bigbillion`
--

CREATE TABLE `bigbillion` (
  `id` int(11) NOT NULL,
  `start_datetime` datetime(6) NOT NULL,
  `end_datetime` datetime(6) NOT NULL,
  `raquets_discount` int(255) NOT NULL,
  `shuttles_discount` int(255) NOT NULL,
  `shoes_discount` int(255) NOT NULL,
  `grippers_discount` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billionproducts`
--

CREATE TABLE `billionproducts` (
  `i` int(255) NOT NULL,
  `p_id1` int(255) NOT NULL,
  `pname1` varchar(255) NOT NULL,
  `pdescript1` varchar(255) NOT NULL,
  `pcost1` int(255) NOT NULL,
  `pcat1` varchar(255) NOT NULL,
  `imgg1` varchar(255) NOT NULL,
  `pquantity1` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart1`
--

CREATE TABLE `cart1` (
  `pname` varchar(255) NOT NULL,
  `pimage` varchar(255) NOT NULL,
  `pcost` int(255) NOT NULL,
  `date` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `id` int(255) NOT NULL,
  `pquantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart1`
--

INSERT INTO `cart1` (`pname`, `pimage`, `pcost`, `date`, `email`, `id`, `pquantity`) VALUES
('uyyu', 'ss1.jpg', 343, '2023-06-10', 'jhon22@gmail.com', 85, 1),
('df', 'ss1.jpg', 2345, '2023-06-10', 'jhon22@gmail.com', 86, 1),
('uyyu', 'ss1.jpg', 343, '2023-06-19', 'dhanrajjpoojary25@gmail.com', 105, 2),
('df', 'ss1.jpg', 2345, '2023-06-19', 'dhanrajjpoojary25@gmail.com', 106, 1),
('ghjg', 'b1.jpg', 6754, '2023-06-19', 'dhanrajjpoojary25@gmail.com', 107, 1);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_boy`
--

CREATE TABLE `delivery_boy` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `phnum` int(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_boy`
--

INSERT INTO `delivery_boy` (`id`, `name`, `email`, `date`, `phnum`, `password`, `address`) VALUES
(49, 'dixen', 'dixen@gmail.com', '2023-06-01', 2147483647, '!@#QWE123qwe', 'jodukatte, karkala'),
(50, 'Jhon', 'jpoojarydhanraj@gmail.com', '2023-06-09', 2147483647, '*()IOP890iop', 'ajekar,karkala');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_or_return`
--

CREATE TABLE `delivery_or_return` (
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `o_id` int(255) NOT NULL,
  `o_date` date NOT NULL,
  `amount` int(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `delivery_stat` varchar(255) NOT NULL,
  `assigned_to` varchar(255) DEFAULT NULL,
  `id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_or_return`
--

INSERT INTO `delivery_or_return` (`fname`, `lname`, `o_id`, `o_date`, `amount`, `address`, `delivery_stat`, `assigned_to`, `id`) VALUES
('Dhanraj', 'J Poojary', 48, '2023-06-19', 343, 'Mithalbettu House#3-52,harikandige Post,Udupi taluk & dist. 576124', 'yet to return', 'Jhon', 20),
('Dhanraj', 'J Poojary', 49, '2023-06-22', 1800, 'Mithalbettu House#3-52,harikandige Post,Udupi taluk & dist. 576124', ' Will Be Delivered Shortly!!!', 'Jhon', 21);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `product_id` int(255) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `review` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`product_id`, `rating`, `review`, `name`, `id`) VALUES
(51, 'good', 'gfhjkhjkl', NULL, 6);

-- --------------------------------------------------------

--
-- Table structure for table `payment1`
--

CREATE TABLE `payment1` (
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pin` int(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `o_date` date NOT NULL,
  `d_date` date DEFAULT NULL,
  `r_within` date DEFAULT NULL,
  `return_reason` varchar(255) DEFAULT NULL,
  `pname` varchar(255) NOT NULL,
  `pcost` varchar(255) NOT NULL,
  `pquantity` varchar(255) NOT NULL,
  `id` int(255) NOT NULL,
  `delivery_stat` varchar(255) NOT NULL,
  `dcode` varchar(255) NOT NULL,
  `r_order` varchar(255) DEFAULT NULL,
  `feedback_stat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment1`
--

INSERT INTO `payment1` (`fname`, `lname`, `email`, `address`, `pin`, `amount`, `o_date`, `d_date`, `r_within`, `return_reason`, `pname`, `pcost`, `pquantity`, `id`, `delivery_stat`, `dcode`, `r_order`, `feedback_stat`) VALUES
('Dhanraj', 'tryhrthy', 'jpoojarydhanraj@gmail.com', 'rtyr', 0, 5431, '2023-06-19', '2023-06-22', '2023-06-25', 'Defective', 'ADIDAS \r\nBadminton Shoes For Men  (Multicolor),Yonex Badminton Racquet GR 303I Dark Blue Graphite', '5432', '1', 48, 'yet to return', ' 73153', 'yes', 'yes'),
('Dj', 'poojary', 'jpoojarydhanraj@gmail.com', 'ajekar', 576124, 1500, '2023-06-23', '2023-06-23', '2023-06-26', 'Defective', 'Raze Badminton Shoes For Men', '1554', '1', 51, 'Returned', ' 11962', 'yes', 'yes'),
('Dhanraj', 'J Poojary', 'jpoojarydhanraj@gmail.com', 'tyu', 0, 360, '2023-06-26', '2023-06-26', '2023-06-29', NULL, 'LI-NING GP-20 ', '360', '1', 53, 'Delivered', ' 87567', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pdescript` varchar(255) NOT NULL,
  `pcost` int(255) NOT NULL,
  `pcat` varchar(255) NOT NULL,
  `imgg` varchar(255) NOT NULL,
  `pquantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `pname`, `pdescript`, `pcost`, `pcat`, `imgg`, `pquantity`) VALUES
(16, 'Yonex Badminton Racquet GR 303I Dark Red, Graphite', 'Style Name:GR 303I', 549, 'Racquet', 'r1.jpg', 47),
(17, 'YONEX ACB-TR Feather Shuttle ', 'Multicolor  (Medium, 77, Pack of 12)', 1732, 'Shuttle', 's2.webp', 40),
(18, 'Raze Badminton Shoes For Men', 'Available in Blue', 1554, 'Shoes', 'sh2.webp', 60),
(19, 'LI-NING GP-20 ', 'Multicolor, Pack of 5', 360, 'Gripper', 'g1.webp', 69);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `phnum` int(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cpassword` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `code` int(20) NOT NULL,
  `otp_expiry` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `name`, `user_type`, `email`, `date`, `phnum`, `password`, `cpassword`, `address`, `code`, `otp_expiry`) VALUES
(1, 'Nachiketh', 'user', 'nachiketh@gmail.com', '2017-01-09', 897337897, '2', '!@#QWE123qwe', 'jodukatte, maala', 0, '2023-05-30 13:27:23'),
(2, 'dhanraj', 'admin', 'dhanrajjpoojary25@gmail.com', '2002-08-25', 2147483647, '1', '!@#QWE123qwe', 'ajekar', 0, '2023-05-30 14:42:11'),
(3, 'DJ POOJARY', 'user', 'jpoojarydhanraj@gmail.com', '2001-02-06', 2147483647, '3', '*()IOP890iop', 'Donderandi', 0, '2023-06-15 11:13:15');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(255) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `s_description` varchar(255) NOT NULL,
  `s_cost` int(255) NOT NULL,
  `s_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `s_name`, `s_description`, `s_cost`, `s_img`) VALUES
(1, 'gutting', 'best gutting', 1000, 'aa.gif');

-- --------------------------------------------------------

--
-- Table structure for table `servicebooking`
--

CREATE TABLE `servicebooking` (
  `s_id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `service_name` varchar(255) DEFAULT NULL,
  `service_cost` int(255) DEFAULT NULL,
  `service_date` date NOT NULL,
  `service_time` varchar(100) NOT NULL,
  `requested_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `servicebooking`
--

INSERT INTO `servicebooking` (`s_id`, `name`, `email`, `service_name`, `service_cost`, `service_date`, `service_time`, `requested_date`) VALUES
(241, 'Nachiketh', ' nachiketh@gmail.com', NULL, NULL, '2023-06-25', '10:00 - 11:00', '2023-06-23'),
(242, 'Nachiketh', ' nachiketh@gmail.com', NULL, NULL, '2023-06-30', '11:00 - 12:00', '2023-06-23'),
(244, 'Nachiketh', ' nachiketh@gmail.com', NULL, NULL, '2023-06-29', '16:00 - 17:00', '2023-06-23'),
(245, 'Nachiketh', ' nachiketh@gmail.com', NULL, NULL, '2023-06-30', '13:00 - 14:00', '2023-06-23'),
(246, 'Nachiketh', ' nachiketh@gmail.com', NULL, NULL, '2023-06-28', '13:00 - 14:00', '2023-06-23'),
(247, 'DJ POOJARY', ' jpoojarydhanraj@gmail.com', NULL, NULL, '2023-06-30', '9:00 - 10:00', '2023-06-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bigbillion`
--
ALTER TABLE `bigbillion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billionproducts`
--
ALTER TABLE `billionproducts`
  ADD PRIMARY KEY (`i`);

--
-- Indexes for table `cart1`
--
ALTER TABLE `cart1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_or_return`
--
ALTER TABLE `delivery_or_return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment1`
--
ALTER TABLE `payment1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servicebooking`
--
ALTER TABLE `servicebooking`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bigbillion`
--
ALTER TABLE `bigbillion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `billionproducts`
--
ALTER TABLE `billionproducts`
  MODIFY `i` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=448;

--
-- AUTO_INCREMENT for table `cart1`
--
ALTER TABLE `cart1`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `delivery_or_return`
--
ALTER TABLE `delivery_or_return`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment1`
--
ALTER TABLE `payment1`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `servicebooking`
--
ALTER TABLE `servicebooking`
  MODIFY `s_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
