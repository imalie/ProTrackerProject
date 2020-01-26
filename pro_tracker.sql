-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 15, 2020 at 05:28 AM
-- Server version: 5.6.13
-- PHP Version: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pro_tracker`
--
CREATE DATABASE IF NOT EXISTS `pro_tracker` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pro_tracker`;

-- --------------------------------------------------------

--
-- Table structure for table `boq_doc`
--

CREATE TABLE IF NOT EXISTS `boq_doc` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` int(10) unsigned NOT NULL,
  `doc_name` varchar(100) NOT NULL,
  `release_user` int(10) unsigned NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pro_id` (`pro_id`),
  KEY `release_user` (`release_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `boq_doc`
--

INSERT INTO `boq_doc` (`id`, `pro_id`, `doc_name`, `release_user`, `release_date`) VALUES
(1, 2, '5e1c52c70ae9d0.52443725.pdf', 1, '2020-01-13 16:51:43'),
(2, 2, '5e1c5be052f776.14525301.pdf', 1, '2020-01-13 17:30:32'),
(3, 1, '5e1dcada7097a6.49573968.pdf', 1, '2020-01-14 19:36:18'),
(4, 1, '5e1dcb5e3098e9.00693831.pdf', 1, '2020-01-14 19:38:30');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `tel_no` varchar(12) NOT NULL,
  `nic` varchar(10) NOT NULL,
  `occupation` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `user_type` varchar(16) NOT NULL,
  `user_img` varchar(50) DEFAULT NULL,
  `release_user` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `user_registered` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `release_user` (`release_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `last_name`, `address`, `tel_no`, `nic`, `occupation`, `email`, `password`, `user_type`, `user_img`, `release_user`, `status`, `user_registered`) VALUES
(4, 'nimal', 'asdas', 'asdasd', '+94114578456', '123456789V', 'sadas', 'democust@gmail.com', '202cb962ac59075b964b07152d234b70', 'customer', NULL, 1, 1, '2020-01-07 22:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `release_user` int(10) unsigned NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `project_id` (`project_id`),
  KEY `release_user` (`release_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `customer_id`, `project_id`, `amount`, `release_user`, `release_date`) VALUES
(1, 4, 1, '25000.00', 1, '2020-01-09 09:39:30'),
(2, 4, 2, '40000.00', 1, '2020-01-14 20:30:29');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(30) NOT NULL,
  `product_desc` varchar(50) NOT NULL,
  `uom_code` varchar(6) NOT NULL,
  `unit_cost` decimal(11,2) NOT NULL,
  `product_type` varchar(10) NOT NULL,
  `release_user` int(10) unsigned NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `uom_code` (`uom_code`),
  KEY `release_user` (`release_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_desc`, `uom_code`, `unit_cost`, `product_type`, `release_user`, `release_date`) VALUES
(2, 'AAA', 'sdasd', 'kg', '50.00', 'goods', 1, '2020-01-07 23:36:53'),
(3, 'BBB', 'sadasd', 'g', '8000.00', 'service', 1, '2020-01-08 20:54:54');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pro_owner_id` int(10) unsigned NOT NULL,
  `pro_name` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `approx_budget` decimal(11,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `plan_doc` varchar(100) NOT NULL,
  `in_paid_state` tinyint(1) NOT NULL DEFAULT '0',
  `full_paid_state` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(15) DEFAULT 'notstart',
  `release_user` int(10) unsigned NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pro_owner_id` (`pro_owner_id`),
  KEY `release_user` (`release_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `pro_owner_id`, `pro_name`, `address`, `approx_budget`, `start_date`, `end_date`, `plan_doc`, `in_paid_state`, `full_paid_state`, `status`, `release_user`, `release_date`) VALUES
(1, 4, 'NOVA', 'sdas', '50000.00', '2020-01-07', '2020-01-31', '5e1c5c5e606f87.62423498.pdf', 1, 0, 'inprogress', 1, '2020-01-07 23:41:48'),
(2, 4, 'sdsd', 'sdsad', '21212.00', '2020-01-13', '2020-01-13', '5e1c52c70ad321.70009828.pdf', 1, 0, 'notstart', 1, '2020-01-13 16:51:43');

-- --------------------------------------------------------

--
-- Table structure for table `project_remark`
--

CREATE TABLE IF NOT EXISTS `project_remark` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` int(10) unsigned NOT NULL,
  `remark` varchar(255) NOT NULL,
  `customer_visible` tinyint(1) NOT NULL,
  `release_user` int(10) unsigned NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pro_id` (`pro_id`),
  KEY `release_user` (`release_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `project_remark`
--

INSERT INTO `project_remark` (`id`, `pro_id`, `remark`, `customer_visible`, `release_user`, `release_date`) VALUES
(1, 1, 'sadasdasd', 1, 1, '2020-01-13 20:32:41'),
(2, 1, 'adsadasd', 0, 1, '2020-01-14 10:58:48');

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

CREATE TABLE IF NOT EXISTS `stages` (
  `stage_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` int(10) unsigned NOT NULL,
  `stage_name` varchar(30) NOT NULL,
  `stage_desc` varchar(30) NOT NULL,
  `approx_budget` decimal(11,2) NOT NULL,
  `outstanding` decimal(11,2) NOT NULL,
  `stages_status` varchar(15) DEFAULT 'notstart',
  `release_user` int(10) unsigned NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`stage_id`),
  KEY `pro_id` (`pro_id`),
  KEY `release_user` (`release_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`stage_id`, `pro_id`, `stage_name`, `stage_desc`, `approx_budget`, `outstanding`, `stages_status`, `release_user`, `release_date`) VALUES
(1, 1, 'NOVA/STAGE/01', 'stages description', '50000.00', '25000.00', 'inprogress', 1, '2020-01-09 09:23:00'),
(2, 2, 'dsadad', 'sdasda', '50000.00', '10000.00', 'notstart', 1, '2020-01-14 20:27:53'),
(3, 2, 'sdsawww', 'sasdasd', '8000.00', '8000.00', 'notstart', 1, '2020-01-14 20:28:10');

-- --------------------------------------------------------

--
-- Table structure for table `stages_img`
--

CREATE TABLE IF NOT EXISTS `stages_img` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` int(10) unsigned NOT NULL,
  `stages_id` int(10) unsigned NOT NULL,
  `img` varchar(50) NOT NULL,
  `release_user` int(10) unsigned NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `stages_id` (`stages_id`),
  KEY `release_user` (`release_user`),
  KEY `pro_id` (`pro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `stages_img`
--

INSERT INTO `stages_img` (`id`, `pro_id`, `stages_id`, `img`, `release_user`, `release_date`) VALUES
(2, 1, 1, '5e18674001c3e1.03931240.jpg', 1, '2020-01-14 00:10:50'),
(3, 1, 1, '5e1d66681a42e2.52634637.jpg', 1, '2020-01-14 12:27:44');

-- --------------------------------------------------------

--
-- Table structure for table `stages_item`
--

CREATE TABLE IF NOT EXISTS `stages_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stage_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `item_cost` decimal(11,2) NOT NULL,
  `qty` decimal(11,2) NOT NULL,
  `available_qty` decimal(11,2) NOT NULL DEFAULT '0.00',
  `total_amount` decimal(11,2) NOT NULL,
  `release_user` int(10) unsigned NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `stage_id` (`stage_id`),
  KEY `item_id` (`item_id`),
  KEY `release_user` (`release_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `stages_item`
--

INSERT INTO `stages_item` (`id`, `stage_id`, `item_id`, `item_cost`, `qty`, `available_qty`, `total_amount`, `release_user`, `release_date`) VALUES
(1, 1, 2, '50.00', '1000.00', '1000.00', '50000.00', 1, '2020-01-09 09:23:01'),
(2, 2, 2, '50.00', '1000.00', '0.00', '50000.00', 1, '2020-01-14 20:27:53'),
(3, 3, 3, '8000.00', '1.00', '0.00', '8000.00', 1, '2020-01-14 20:28:11');

-- --------------------------------------------------------

--
-- Table structure for table `uom`
--

CREATE TABLE IF NOT EXISTS `uom` (
  `uom_code` varchar(6) NOT NULL,
  `uom_desc` varchar(50) DEFAULT NULL,
  `allow_decimal` tinyint(1) NOT NULL,
  `release_user` int(10) unsigned NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uom_code`),
  KEY `release_user` (`release_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uom`
--

INSERT INTO `uom` (`uom_code`, `uom_desc`, `allow_decimal`, `release_user`, `release_date`) VALUES
('g', 'dfsdfdsf', 1, 1, '2020-01-08 20:47:53'),
('kg', 'asdasdas', 1, 1, '2020-01-07 23:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `tel_no` varchar(12) NOT NULL,
  `nic` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `user_type` varchar(16) NOT NULL,
  `user_img` varchar(50) DEFAULT NULL,
  `release_user` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `user_registered` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `address`, `tel_no`, `nic`, `email`, `password`, `user_type`, `user_img`, `release_user`, `status`, `user_registered`) VALUES
(1, 'admin', 'admin', '1874/B Sri pura', '+94778956123', '789456123V', 'admin@pro.com', '202cb962ac59075b964b07152d234b70', 'administrator', NULL, 'admin@pro.com', 1, '2020-01-07 20:37:46'),
(2, 'demo', 'user', '1223/B address here', '+94771223000', '123456789V', 'demouser@gmail.com', '202cb962ac59075b964b07152d234b70', 'employee', NULL, 'admin@pro.com', 0, '2020-01-07 20:45:07'),
(3, 'demo', 'girl', '343/M address here', '+94778212000', '123456789V', 'demo@mail.com', '202cb962ac59075b964b07152d234b70', 'superuser', NULL, 'admin@pro.com', 1, '2020-01-07 20:49:02');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `boq_doc`
--
ALTER TABLE `boq_doc`
  ADD CONSTRAINT `boq_doc_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `boq_doc_ibfk_2` FOREIGN KEY (`release_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`release_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `payment_ibfk_3` FOREIGN KEY (`release_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`uom_code`) REFERENCES `uom` (`uom_code`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`release_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`pro_owner_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `project_ibfk_2` FOREIGN KEY (`release_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `project_remark`
--
ALTER TABLE `project_remark`
  ADD CONSTRAINT `project_remark_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `project_remark_ibfk_2` FOREIGN KEY (`release_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `stages`
--
ALTER TABLE `stages`
  ADD CONSTRAINT `stages_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `stages_ibfk_2` FOREIGN KEY (`release_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `stages_img`
--
ALTER TABLE `stages_img`
  ADD CONSTRAINT `stages_img_ibfk_1` FOREIGN KEY (`stages_id`) REFERENCES `stages` (`stage_id`),
  ADD CONSTRAINT `stages_img_ibfk_2` FOREIGN KEY (`release_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `stages_img_ibfk_3` FOREIGN KEY (`pro_id`) REFERENCES `project` (`id`);

--
-- Constraints for table `stages_item`
--
ALTER TABLE `stages_item`
  ADD CONSTRAINT `stages_item_ibfk_1` FOREIGN KEY (`stage_id`) REFERENCES `stages` (`stage_id`),
  ADD CONSTRAINT `stages_item_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `stages_item_ibfk_3` FOREIGN KEY (`release_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `uom`
--
ALTER TABLE `uom`
  ADD CONSTRAINT `uom_ibfk_1` FOREIGN KEY (`release_user`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
