-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 19, 2016 at 02:27 PM
-- Server version: 5.5.37-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `retail`
--
CREATE DATABASE IF NOT EXISTS `retail` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `retail`;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--
-- Creation: Apr 13, 2016 at 06:20 PM
--

CREATE TABLE IF NOT EXISTS `branch` (
  `shop_name` varchar(50) NOT NULL,
  `shop_email_id` varchar(50) NOT NULL,
  `manager_email_id` varchar(50) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `manager_name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(30) NOT NULL,
  `phone_no` bigint(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `request1` varchar(30) DEFAULT NULL,
  `request2` varchar(30) DEFAULT NULL,
  `request3` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`manager_email_id`),
  KEY `shop_email_id` (`shop_email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `branch`:
--   `shop_email_id`
--       `shop` -> `email_id`
--

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`shop_name`, `shop_email_id`, `manager_email_id`, `branch_name`, `manager_name`, `address`, `city`, `phone_no`, `password`, `request1`, `request2`, `request3`) VALUES
('akshay store', 'akshay@gmail.com', 'akash@gmail.com', 'retail_store', 'akash', 'kengeri', 'bangalore', 12323523534, '123', ' ', ' ', ' '),
('akshay store', 'akshay@gmail.com', 'akshayi@gmail.com', 'ak_store', 'akshay', 'mysore roaad', 'bangalore', 24343435, '123', ' ', ' ', ' '),
('akshay store', 'akshay@gmail.com', 'manager1@gmail.com', 'branch11', 'manager1', 'mysore roaad', 'bengaluru', 12323523534, '123', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--
-- Creation: Apr 13, 2016 at 06:28 PM
--

CREATE TABLE IF NOT EXISTS `order` (
  `inv_no` bigint(50) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `quantity` int(20) NOT NULL,
  `amount` int(20) NOT NULL,
  KEY `inv_no` (`inv_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `order`:
--   `inv_no`
--       `sales` -> `inv_no`
--

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--
-- Creation: Apr 13, 2016 at 06:26 PM
--

CREATE TABLE IF NOT EXISTS `sales` (
  `inv_no` bigint(50) NOT NULL,
  `manager_email_id` varchar(50) NOT NULL,
  `shop_name` varchar(50) NOT NULL,
  PRIMARY KEY (`inv_no`),
  UNIQUE KEY `branch_name` (`manager_email_id`),
  KEY `branch_name_2` (`manager_email_id`),
  KEY `manager_email_id` (`manager_email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `sales`:
--   `manager_email_id`
--       `branch` -> `manager_email_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--
-- Creation: Apr 13, 2016 at 05:38 PM
--

CREATE TABLE IF NOT EXISTS `shop` (
  `email_id` varchar(50) NOT NULL,
  `shop_name` varchar(50) NOT NULL,
  `owner_name` varchar(50) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`email_id`),
  KEY `shop_name` (`shop_name`),
  KEY `shop_name_2` (`shop_name`),
  KEY `shop_name_3` (`shop_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`email_id`, `shop_name`, `owner_name`, `gender`, `address`, `city`, `password`) VALUES
('akshay@gmail.com', 'akshay store', 'Akshay Ijantkar', 'MALE', 'bangalore', 'rvce,mysore road', '123');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--
-- Creation: Apr 13, 2016 at 06:23 PM
--

CREATE TABLE IF NOT EXISTS `stock` (
  `item_id` varchar(50) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `base_price` int(30) NOT NULL,
  `sell_price` int(30) NOT NULL,
  `Quantity` int(30) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `manager_email_id` varchar(50) NOT NULL,
  `shop_name` varchar(50) NOT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `item_id` (`item_id`),
  KEY `branch_name` (`branch_name`),
  KEY `shop_name` (`shop_name`),
  KEY `manager_email_id` (`manager_email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `stock`:
--   `manager_email_id`
--       `branch` -> `manager_email_id`
--

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`item_id`, `item_name`, `base_price`, `sell_price`, `Quantity`, `branch_name`, `manager_email_id`, `shop_name`) VALUES
('123', 'abc', 45, 50, 30, 'retail_store', 'akash@gmail.com', 'akshay store'),
('1234', 'derfe', 60, 80, 2, 'retail_store', 'akash@gmail.com', 'akshay store');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `branch`
--
ALTER TABLE `branch`
  ADD CONSTRAINT `branch_ibfk_1` FOREIGN KEY (`shop_email_id`) REFERENCES `shop` (`email_id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`inv_no`) REFERENCES `sales` (`inv_no`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`manager_email_id`) REFERENCES `branch` (`manager_email_id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`manager_email_id`) REFERENCES `branch` (`manager_email_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
