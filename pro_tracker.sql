-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 01, 2020 at 05:59 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `boq_doc`
--

INSERT INTO `boq_doc` (`id`, `pro_id`, `doc_name`, `release_user`, `release_date`) VALUES
(1, 1, '5e3444e51b9225.10625685.xlsm', 1, '2020-01-31 20:46:53'),
(2, 2, '5e34f788de1911.19383038.xlsm', 1, '2020-02-01 09:29:05'),
(3, 3, '5e34fadb7630a1.85292420.xlsx', 1, '2020-02-01 09:43:15');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `last_name`, `address`, `tel_no`, `nic`, `occupation`, `email`, `password`, `user_type`, `user_img`, `release_user`, `status`, `user_registered`) VALUES
(1, 'John', 'Wick', '1542/N Address', '+94771223123', '147852369V', 'Bmae', 'john@gmail.com', '202cb962ac59075b964b07152d234b70', 'customer', NULL, 1, 1, '2020-01-31 20:38:54'),
(2, 'Mary', 'Mary', '123/ Address', '+94778956741', '145789654V', 'Job', 'mary@gmail.com', '202cb962ac59075b964b07152d234b70', 'customer', NULL, 1, 1, '2020-02-01 09:41:58');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `customer_id`, `project_id`, `amount`, `release_user`, `release_date`) VALUES
(1, 1, 1, '50000.00', 1, '2020-01-31 22:29:43'),
(2, 1, 2, '5000.00', 1, '2020-02-01 09:32:04'),
(3, 2, 3, '75000.00', 1, '2020-02-01 09:48:31');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_desc`, `uom_code`, `unit_cost`, `product_type`, `release_user`, `release_date`) VALUES
(1, 'AAA', 'sadasd', 'KG', '5000.00', 'goods', 1, '2020-01-31 22:16:21');

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
  `pro_act_start_date` datetime DEFAULT NULL,
  `pro_act_end_date` datetime DEFAULT NULL,
  `plan_doc` varchar(100) NOT NULL,
  `in_paid_state` tinyint(1) NOT NULL DEFAULT '0',
  `full_paid_state` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(15) DEFAULT 'notstart',
  `is_stages` tinyint(1) NOT NULL DEFAULT '0',
  `release_user` int(10) unsigned NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pro_owner_id` (`pro_owner_id`),
  KEY `release_user` (`release_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `pro_owner_id`, `pro_name`, `address`, `approx_budget`, `start_date`, `end_date`, `pro_act_start_date`, `pro_act_end_date`, `plan_doc`, `in_paid_state`, `full_paid_state`, `status`, `is_stages`, `release_user`, `release_date`) VALUES
(1, 1, 'Project/001', '231/B Address', '100000.00', '2020-01-31', '2020-02-29', '2020-02-01 08:43:08', '2020-02-01 08:47:13', '5e3444e51b41b0.05461231.pdf', 1, 0, 'complete', 1, 1, '2020-01-31 20:46:53'),
(2, 1, 'Project/002', '7845/B Address', '50000.00', '2020-02-01', '2020-02-29', '2020-02-01 09:33:26', '2020-02-01 09:37:42', '5e34f788de0275.25057728.pdf', 1, 0, 'complete', 1, 1, '2020-02-01 09:29:04'),
(3, 2, 'Project/003', '784/B Address', '200000.00', '2020-02-01', '2020-02-29', '2020-02-01 09:48:39', NULL, '5e34fadb760140.82471506.pdf', 1, 0, 'inprogress', 1, 1, '2020-02-01 09:43:15');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `project_remark`
--

INSERT INTO `project_remark` (`id`, `pro_id`, `remark`, `customer_visible`, `release_user`, `release_date`) VALUES
(1, 1, 'Customer Not Visible', 0, 1, '2020-01-31 22:33:56'),
(2, 1, 'Customer Visible', 1, 1, '2020-01-31 22:36:20'),
(3, 1, 'pro_id', 0, 1, '2020-01-31 22:40:13'),
(4, 1, 'Project pro', 0, 1, '2020-02-01 09:34:30'),
(5, 2, 'Pro002', 1, 1, '2020-02-01 09:37:09'),
(6, 3, 'Now Start', 1, 1, '2020-02-01 09:47:47'),
(7, 1, 'cussda 1254', 1, 1, '2020-02-01 10:58:07'),
(8, 1, 'dasdas sdasdasd', 1, 1, '2020-02-01 10:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `pro_stock_in`
--

CREATE TABLE IF NOT EXISTS `pro_stock_in` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` int(10) unsigned NOT NULL,
  `stage_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `item_cost` decimal(11,2) NOT NULL,
  `qty` decimal(11,2) NOT NULL,
  `total_amount` decimal(11,2) NOT NULL,
  `release_user` int(10) unsigned NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pro_id` (`pro_id`),
  KEY `stage_id` (`stage_id`),
  KEY `item_id` (`item_id`),
  KEY `release_user` (`release_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pro_stock_out`
--

CREATE TABLE IF NOT EXISTS `pro_stock_out` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` int(10) unsigned NOT NULL,
  `stage_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `item_cost` decimal(11,2) NOT NULL,
  `qty` decimal(11,2) NOT NULL,
  `total_amount` decimal(11,2) NOT NULL,
  `release_user` int(10) unsigned NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pro_id` (`pro_id`),
  KEY `stage_id` (`stage_id`),
  KEY `item_id` (`item_id`),
  KEY `release_user` (`release_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `stage_act_start_date` datetime DEFAULT NULL,
  `stage_act_end_date` datetime DEFAULT NULL,
  `release_user` int(10) unsigned NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`stage_id`),
  KEY `pro_id` (`pro_id`),
  KEY `release_user` (`release_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`stage_id`, `pro_id`, `stage_name`, `stage_desc`, `approx_budget`, `outstanding`, `stages_status`, `stage_act_start_date`, `stage_act_end_date`, `release_user`, `release_date`) VALUES
(1, 1, 'Project/001/Stage/001', 'sdadasd', '50000.00', '0.00', 'complete', '2020-02-01 08:44:12', '2020-02-01 08:47:13', 1, '2020-01-31 22:18:47'),
(2, 1, 'Project/001/Stage/002', 'Description', '50000.00', '50000.00', 'complete', '2020-02-01 08:46:56', '2020-02-01 08:47:13', 1, '2020-01-31 22:23:41'),
(3, 2, 'Project/002/Stage/001', 'Address', '25000.00', '20000.00', 'complete', '2020-02-01 09:34:08', '2020-02-01 09:37:42', 1, '2020-02-01 09:30:48'),
(4, 3, 'Project/003/Stage/001', 'Address', '50000.00', '0.00', 'complete', '2020-02-01 09:48:48', '2020-02-01 09:51:30', 1, '2020-02-01 09:44:10'),
(5, 3, 'Project/003/Stage/002', 'Address', '50000.00', '25000.00', 'complete', '2020-02-01 09:50:42', '2020-02-01 09:51:30', 1, '2020-02-01 09:44:42'),
(6, 3, 'Project/003/Stage/003', 'Address', '50000.00', '50000.00', 'notstart', NULL, NULL, 1, '2020-02-01 09:46:08'),
(7, 3, 'Project/003/Stage/004', 'Address', '50000.00', '50000.00', 'notstart', NULL, NULL, 1, '2020-02-01 09:46:36');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `stages_img`
--

INSERT INTO `stages_img` (`id`, `pro_id`, `stages_id`, `img`, `release_user`, `release_date`) VALUES
(1, 2, 3, '5e34f9acb06ab9.72079207.png', 1, '2020-02-01 09:38:12'),
(2, 3, 7, '5e34fc6c049097.38733559.png', 1, '2020-02-01 09:49:56'),
(3, 3, 4, '5e34fc79b64af2.03837092.png', 1, '2020-02-01 09:50:09'),
(4, 3, 4, '5e34fc8a6fead7.56944213.png', 1, '2020-02-01 09:50:26');

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
  `total_amount` decimal(11,2) NOT NULL,
  `release_user` int(10) unsigned NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `stage_id` (`stage_id`),
  KEY `item_id` (`item_id`),
  KEY `release_user` (`release_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `stages_item`
--

INSERT INTO `stages_item` (`id`, `stage_id`, `item_id`, `item_cost`, `qty`, `total_amount`, `release_user`, `release_date`) VALUES
(1, 1, 1, '5000.00', '10.00', '50000.00', 1, '2020-01-31 22:18:47'),
(2, 2, 1, '5000.00', '10.00', '50000.00', 1, '2020-01-31 22:23:42'),
(3, 3, 1, '5000.00', '5.00', '25000.00', 1, '2020-02-01 09:30:48'),
(4, 4, 1, '5000.00', '10.00', '50000.00', 1, '2020-02-01 09:44:10'),
(5, 6, 1, '5000.00', '10.00', '50000.00', 1, '2020-02-01 09:46:09'),
(6, 7, 1, '5000.00', '10.00', '50000.00', 1, '2020-02-01 09:46:36');

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
('KG', 'dasdasd', 1, 1, '2020-01-31 22:12:40');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `address`, `tel_no`, `nic`, `email`, `password`, `user_type`, `user_img`, `release_user`, `status`, `user_registered`) VALUES
(1, 'admin', 'admin', '1874/B Sri pura', '+94778956123', '789456123V', 'admin@pro.com', '202cb962ac59075b964b07152d234b70', 'administrator', NULL, 'admin@pro.com', 1, '2020-01-31 20:34:06');

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
-- Constraints for table `pro_stock_in`
--
ALTER TABLE `pro_stock_in`
  ADD CONSTRAINT `pro_stock_in_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `pro_stock_in_ibfk_2` FOREIGN KEY (`stage_id`) REFERENCES `stages` (`stage_id`),
  ADD CONSTRAINT `pro_stock_in_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `pro_stock_in_ibfk_4` FOREIGN KEY (`release_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `pro_stock_out`
--
ALTER TABLE `pro_stock_out`
  ADD CONSTRAINT `pro_stock_out_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `pro_stock_out_ibfk_2` FOREIGN KEY (`stage_id`) REFERENCES `stages` (`stage_id`),
  ADD CONSTRAINT `pro_stock_out_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `pro_stock_out_ibfk_4` FOREIGN KEY (`release_user`) REFERENCES `users` (`id`);

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
