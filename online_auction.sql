-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2023 at 02:44 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `auction_history`
--

CREATE TABLE `auction_history` (
  `history_id` int(20) NOT NULL,
  `auction_id` int(20) NOT NULL,
  `item_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `offer_price` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `auction_table`
--

CREATE TABLE `auction_table` (
  `auction_id` int(20) NOT NULL,
  `item_id` int(20) NOT NULL,
  `auction_date` date NOT NULL,
  `final_price` int(50) NOT NULL,
  `user_id` int(20) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employee_table`
--

CREATE TABLE `employee_table` (
  `employee_id` int(20) NOT NULL,
  `employee_name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `level_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `item_table`
--

CREATE TABLE `item_table` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(30) NOT NULL,
  `input_date` date NOT NULL,
  `initial_price` int(50) NOT NULL,
  `description` varchar(160) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `telephone` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auction_history`
--
ALTER TABLE `auction_history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `auction_id` (`auction_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auction_table`
--
ALTER TABLE `auction_table`
  ADD PRIMARY KEY (`auction_id`),
  ADD KEY `item_id` (`item_id`,`user_id`,`employee_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `employee_table`
--
ALTER TABLE `employee_table`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `item_table`
--
ALTER TABLE `item_table`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `initial_price` (`initial_price`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auction_history`
--
ALTER TABLE `auction_history`
  MODIFY `history_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auction_table`
--
ALTER TABLE `auction_table`
  MODIFY `auction_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_table`
--
ALTER TABLE `employee_table`
  MODIFY `employee_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_table`
--
ALTER TABLE `item_table`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auction_history`
--
ALTER TABLE `auction_history`
  ADD CONSTRAINT `auction_history_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item_table` (`item_id`),
  ADD CONSTRAINT `auction_history_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`user_id`),
  ADD CONSTRAINT `auction_history_ibfk_3` FOREIGN KEY (`auction_id`) REFERENCES `auction_table` (`auction_id`);

--
-- Constraints for table `auction_table`
--
ALTER TABLE `auction_table`
  ADD CONSTRAINT `auction_table_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`user_id`),
  ADD CONSTRAINT `auction_table_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee_table` (`employee_id`),
  ADD CONSTRAINT `auction_table_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `item_table` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
