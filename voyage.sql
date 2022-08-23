-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 23, 2022 at 04:12 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voyage`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`admin_id`, `name`, `email`, `password`) VALUES
(2, 'admin', 'abc@gmail.com', 'ash');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `price` bigint(20) NOT NULL,
  `day` int(3) NOT NULL,
  `night` int(3) NOT NULL,
  `booked` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `product_id`, `user_id`, `start_date`, `end_date`, `price`, `day`, `night`, `booked`) VALUES
(4, 2, 14, '2022-09-13 18:30:00', '2022-09-15 18:30:00', 6400, 3, 2, 0),
(7, 3, 14, '2022-08-18 00:00:00', '2022-08-18 00:00:00', 6000, 4, 3, 0),
(8, 7, 14, '2022-08-16 00:00:00', '2022-08-21 00:00:00', 20000, 6, 5, 1),
(9, 6, 14, '2022-09-17 00:00:00', '2022-09-20 00:00:00', 10500, 4, 3, 0),
(10, 4, 14, '2022-08-25 00:00:00', '2022-08-28 00:00:00', 7500, 4, 3, 0),
(11, 5, 14, '2022-08-28 00:00:00', '2022-08-31 00:00:00', 8100, 4, 3, 0),
(13, 7, 14, '2022-12-24 00:00:00', '2022-12-31 00:00:00', 28000, 8, 7, 0),
(16, 6, 14, '2022-09-20 00:00:00', '2022-09-22 00:00:00', 7000, 3, 2, 1),
(17, 8, 14, '2022-09-29 00:00:00', '2022-10-02 00:00:00', 11100, 4, 3, 0),
(19, 5, 15, '2022-09-13 00:00:00', '2022-09-17 00:00:00', 10800, 5, 4, 0),
(20, 6, 15, '2022-08-18 00:00:00', '2022-08-20 00:00:00', 7000, 3, 2, 1),
(21, 15, 15, '2022-08-12 00:00:00', '2022-08-20 00:00:00', 9600, 9, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `msg_id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `message` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`msg_id`, `email`, `message`) VALUES
(5, 'ab@gmail.com', 'vgsadjavd'),
(6, 'theflash257@gmail.com', 'hsadsbdahdsa');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `pay_id` int(11) NOT NULL,
  `payment_id` varchar(100) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `price` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`pay_id`, `payment_id`, `order_id`, `signature`, `price`, `user_id`, `product_id`) VALUES
(4, 'pay_K3HTUOwPz24UQb', 'order_K3HTLba8FWIm6L', 'a3f231f2b55df0ff371076bd155fc8cb14ef6136bf123748f19b3275dbd4166a', 7000, 14, 6),
(5, 'pay_K3HY772p72xNfQ', 'order_K3HXetHkbjvsPG', 'aa6ec966c83a7a8ffb05a4dff0c2e310cabaa0191f8388942c59ebf74e10b5c1', 20000, 14, 7),
(6, 'pay_K3I4v0xLfPkwAq', 'order_K3I4jIUKWskOzX', 'e1a7ea9c6b37e79c1772c4b4e6690effbf60337583372b3517fdd583f484cc76', 7000, 15, 6),
(7, 'pay_K3ICyoAnTYOgsR', 'order_K3ICHXyWFbQhNQ', 'aacbfd6161287d70b0afc34b540bddcd5ac9f8f26dd682e89c1a656088be1f46', 9600, 15, 15);

-- --------------------------------------------------------

--
-- Table structure for table `p_info`
--

CREATE TABLE `p_info` (
  `product_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `base_price` bigint(10) NOT NULL,
  `image` varchar(64) NOT NULL,
  `description` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_info`
--

INSERT INTO `p_info` (`product_id`, `name`, `base_price`, `image`, `description`) VALUES
(2, 'Bangalore', 3200, 'bangalore.jpg', 'abc'),
(3, 'Chennai', 2000, 'chennai.png', 'hello'),
(4, 'Agra', 2500, 'Agra.jpg', 'ty'),
(5, 'Darjeeling', 2700, 'darjeeling.jpg', ''),
(6, 'Delhi', 3500, 'delhi.jpg', ''),
(7, 'Kashmir', 4000, 'kashmir.jpg', ''),
(8, 'Kerela', 3700, 'kerela.jpg', 'kbdwhab'),
(15, 'Haridwar', 1200, 'haridwar.jpg', 'haridwar desc');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `mobile` bigint(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `firstname`, `lastname`, `mobile`, `email`, `password`) VALUES
(14, 'ash', 'b', 8779613274, 'ab@gmail.com', 'ash'),
(15, 'Harry', 'Potter', 8779613274, 'hp@hogwarts.com', 'harry');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `p_info`
--
ALTER TABLE `p_info`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `p_info`
--
ALTER TABLE `p_info`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
