-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 03, 2020 at 11:48 AM
-- Server version: 8.0.19
-- PHP Version: 7.1.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pro_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `boq_doc`
--

CREATE TABLE `boq_doc` (
  `id` int UNSIGNED NOT NULL,
  `pro_id` int UNSIGNED NOT NULL,
  `doc_name` varchar(100) NOT NULL,
  `release_user` int UNSIGNED NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `boq_doc`
--

INSERT INTO `boq_doc` (`id`, `pro_id`, `doc_name`, `release_user`, `release_date`) VALUES
(1, 1, '5e3444e51b9225.10625685.xlsm', 1, '2020-01-31 20:46:53'),
(2, 2, '5e34f788de1911.19383038.xlsm', 1, '2020-02-01 09:29:05'),
(3, 3, '5e34fadb7630a1.85292420.xlsx', 1, '2020-02-01 09:43:15'),
(4, 4, '5e363b0891c711.82827690.xlsx', 1, '2020-02-02 08:29:20'),
(5, 5, '5e37b3dee51ee2.10748881.xlsx', 1, '2020-02-03 11:17:11');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int UNSIGNED NOT NULL,
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
  `release_user` int UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `user_registered` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `last_name`, `address`, `tel_no`, `nic`, `occupation`, `email`, `password`, `user_type`, `user_img`, `release_user`, `status`, `user_registered`) VALUES
(1, 'John', 'Wick', '1542/N Address', '+94771223123', '147852369V', 'Bmae', 'john@gmail.com', '202cb962ac59075b964b07152d234b70', 'customer', NULL, 1, 1, '2020-01-31 20:38:54'),
(2, 'Mary', 'Mary', '123/ Address', '+94778956741', '145789654V', 'Job', 'mary@gmail.com', '202cb962ac59075b964b07152d234b70', 'customer', NULL, 1, 1, '2020-02-01 09:41:58'),
(3, 'Merwin ', 'Fernando', 'teutiioi', '+94767511243', '784867045V', 'student', 'merwinp@gmail.com', '6cf28c9113e9836e77dc83f5b4c12384', 'customer', NULL, 1, 1, '2020-02-02 12:39:32'),
(4, 'Amal', 'Jayasena', 'gcgckhjljk;j', '+94767511248', '234587353V', 'lecturer', 'mani834@gmail.com', '41d49745c9084b63b48463d60a4ee9c0', 'customer', NULL, 1, 1, '2020-02-02 12:44:42'),
(5, 'Mainshaxss', 'sss', 'ssss', '+94767939743', '223315633V', 'xc', 'imal333waas@gmail.com', '00eda365983c89c71e738419fe2cd06f', 'customer', NULL, 1, 1, '2020-02-02 12:54:06'),
(6, 'Nuwan', 'Fernando', 'No.16, peter perise mawatha ,4th kurana,negombo', '+94767519245', '784827345V', 'lecturer', 'nuwan23@gmail.com', '55654dd135b494def3006a1573ed9863', 'customer', NULL, 1, 1, '2020-02-03 11:04:29');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int UNSIGNED NOT NULL,
  `customer_id` int UNSIGNED NOT NULL,
  `project_id` int UNSIGNED NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `release_user` int UNSIGNED NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `customer_id`, `project_id`, `amount`, `release_user`, `release_date`) VALUES
(1, 1, 1, '50000.00', 1, '2020-01-31 22:29:43'),
(2, 1, 2, '5000.00', 1, '2020-02-01 09:32:04'),
(3, 2, 3, '75000.00', 1, '2020-02-01 09:48:31'),
(4, 2, 4, '10000.00', 1, '2020-02-02 10:21:32'),
(5, 2, 3, '50000.00', 1, '2020-02-02 16:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int UNSIGNED NOT NULL,
  `product_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `product_desc` varchar(1500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `uom_code` varchar(6) NOT NULL,
  `unit_cost` decimal(11,2) NOT NULL,
  `product_type` varchar(10) NOT NULL,
  `release_user` int UNSIGNED NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_desc`, `uom_code`, `unit_cost`, `product_type`, `release_user`, `release_date`) VALUES
(1, 'AAA', 'sadasd', 'KG', '5000.00', 'goods', 1, '2020-01-31 22:16:21'),
(2, 'Baco', 'Used for site clearing work', 'hrs', '2000.00', 'service', 1, '2020-02-03 11:36:51'),
(3, 'Site workmanship', 'workmanship for site clearning', 'hrs', '300.00', 'goods', 1, '2020-02-03 11:39:55'),
(4, 'transportation site  clearing', 'wastage clearning', 'hrs', '250.00', 'service', 1, '2020-02-03 11:40:47'),
(5, 'Soil', ' Use for back filling ', 'cube', '4500.00', 'goods', 1, '2020-02-03 11:47:47'),
(6, 'Rubble', 'Use rubble 6\" x 9\' masonry work', 'cube', '35000.00', 'goods', 1, '2020-02-03 11:48:56'),
(7, 'sand', 'use for rubble work,brick work,concreting etc.', 'cube', '14000.00', 'goods', 1, '2020-02-03 11:50:43'),
(8, 'cement', 'Use for rubble work,brick work etc.', 'bags', '1000.00', 'goods', 1, '2020-02-03 11:51:30'),
(9, 'masonory work', 'use for  rubble work', 'cube', '8500.00', 'goods', 1, '2020-02-03 11:56:01'),
(10, 'cement brickwork', 'Use (4\' X 14\'X 6\")4\" walls', 'sqrs', '125.00', 'goods', 1, '2020-02-03 11:57:53'),
(11, 'redbrick work', 'Use (4\' X 8\" X 21/4\')4\' walls', 'sqrs', '14500.00', 'goods', 1, '2020-02-03 11:59:08'),
(12, 'metal', 'Use for concerting.', 'cube', '9500.00', 'goods', 1, '2020-02-03 12:04:11'),
(13, 'R/F bar 12mm', 'Reinforcement bars  ', 'nos', '780.00', 'goods', 1, '2020-02-03 12:12:01'),
(14, 'R/F bar 10mm', 'Reinforcement bars ', 'nos', '480.00', 'goods', 1, '2020-02-03 12:13:04'),
(15, 'R/F bar 1/4 coil', 'Use for R/F bars', 'KG', '200.00', 'goods', 1, '2020-02-03 12:19:59'),
(16, 'Binding R/F bar', 'Use for  R/F bars ', 'KG', '225.00', 'goods', 1, '2020-02-03 12:28:17'),
(17, 'form work', 'Materials used for form-work', 'sqrs', '200.00', 'goods', 1, '2020-02-03 12:35:23'),
(18, 'Lime', 'Use for plastering', 'bags', '350.00', 'goods', 1, '2020-02-03 12:35:58'),
(19, 'wacker for back filling ', 'Use for back filling', 'hrs', '800.00', 'goods', 1, '2020-02-03 12:56:43'),
(20, '1/0/44 wire', 'Electrical work', 'Roll', '1750.00', 'goods', 1, '2020-02-03 14:44:27'),
(22, 'Conduit pipe', 'For electrical wiring', 'nos', '150.00', 'goods', 1, '2020-02-03 14:46:38'),
(23, 'switch box', 'for electrical wiring', 'nos', '75.00', 'goods', 1, '2020-02-03 14:49:01'),
(24, 'switch box', 'for electrical wiring', 'nos', '75.00', 'goods', 1, '2020-02-03 14:50:24'),
(25, 'Earth wire', 'for electrical wiring mateials', 'Roll', '4250.00', 'goods', 1, '2020-02-03 14:58:14'),
(26, 'Sloan 1/2 piepe', 'use for plumbing', 'ft.', '15.00', 'goods', 1, '2020-02-03 15:12:05'),
(27, 'Sloan 1\' ,1/3 \'pipe ', 'use for plumbing', 'ft.', '18.00', 'goods', 1, '2020-02-03 15:13:36'),
(28, 'Fittings', 'To connect the pipe and fixing tap and accessories', 'nos', '100.00', 'goods', 1, '2020-02-03 15:14:58'),
(29, 'S-lon solvent Gum', 'use to fix pipes', 'lit', '1800.00', 'goods', 1, '2020-02-03 15:16:56'),
(30, 'wall filler', 'Apply two coats of filler', 'lit', '200.00', 'goods', 1, '2020-02-03 15:24:46'),
(31, 'Emulsion paint', 'Apply color to all interfaces', 'lit', '600.00', 'goods', 1, '2020-02-03 15:26:10');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int UNSIGNED NOT NULL,
  `pro_owner_id` int UNSIGNED NOT NULL,
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
  `release_user` int UNSIGNED NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `pro_owner_id`, `pro_name`, `address`, `approx_budget`, `start_date`, `end_date`, `pro_act_start_date`, `pro_act_end_date`, `plan_doc`, `in_paid_state`, `full_paid_state`, `status`, `is_stages`, `release_user`, `release_date`) VALUES
(1, 1, 'Project/001', '231/B Address', '100000.00', '2020-01-31', '2020-02-29', '2020-02-01 08:43:08', '2020-02-01 08:47:13', '5e3444e51b41b0.05461231.pdf', 1, 0, 'complete', 1, 1, '2020-01-31 20:46:53'),
(2, 1, 'Project/002', '7845/B Address', '50000.00', '2020-02-01', '2020-02-29', '2020-02-01 09:33:26', '2020-02-01 09:37:42', '5e34f788de0275.25057728.pdf', 1, 0, 'complete', 1, 1, '2020-02-01 09:29:04'),
(3, 2, 'Project/003', '784/B Address', '200000.00', '2020-02-01', '2020-02-29', '2020-02-01 09:48:39', '2020-02-01 14:44:44', '5e34fadb760140.82471506.pdf', 1, 0, 'complete', 1, 1, '2020-02-01 09:43:15'),
(4, 2, 'Project/004', 'rtdhfgjhjhf', '45600000.00', '2020-01-09', '2021-10-20', '2020-02-02 10:22:05', NULL, '5e363b08918ce5.64080843.pdf', 1, 0, 'inprogress', 1, 1, '2020-02-02 08:29:20'),
(5, 6, 'Lake Villa', 'eyrjkhjl', '120000000.00', '2020-02-01', '2020-08-19', NULL, NULL, '5e37b3dee4e946.57431733.pdf', 0, 0, 'notstart', 1, 1, '2020-02-03 11:17:10');

-- --------------------------------------------------------

--
-- Table structure for table `project_remark`
--

CREATE TABLE `project_remark` (
  `id` int UNSIGNED NOT NULL,
  `pro_id` int UNSIGNED NOT NULL,
  `remark` varchar(255) NOT NULL,
  `customer_visible` tinyint(1) NOT NULL,
  `release_user` int UNSIGNED NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `pro_stock_in` (
  `id` int UNSIGNED NOT NULL,
  `pro_id` int UNSIGNED NOT NULL,
  `stage_id` int UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `item_cost` decimal(11,2) NOT NULL,
  `qty` decimal(11,2) NOT NULL,
  `total_amount` decimal(11,2) NOT NULL,
  `release_user` int UNSIGNED NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pro_stock_in`
--

INSERT INTO `pro_stock_in` (`id`, `pro_id`, `stage_id`, `item_id`, `item_cost`, `qty`, `total_amount`, `release_user`, `release_date`) VALUES
(1, 4, 7, 1, '5000.00', '3.00', '15000.00', 1, '2020-02-02 16:51:31'),
(2, 4, 8, 1, '5000.00', '2.00', '10000.00', 1, '2020-02-02 16:51:31');

-- --------------------------------------------------------

--
-- Table structure for table `pro_stock_out`
--

CREATE TABLE `pro_stock_out` (
  `id` int UNSIGNED NOT NULL,
  `pro_id` int UNSIGNED NOT NULL,
  `stage_id` int UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `item_cost` decimal(11,2) NOT NULL,
  `qty` decimal(11,2) NOT NULL,
  `total_amount` decimal(11,2) NOT NULL,
  `release_user` int UNSIGNED NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pro_stock_out`
--

INSERT INTO `pro_stock_out` (`id`, `pro_id`, `stage_id`, `item_id`, `item_cost`, `qty`, `total_amount`, `release_user`, `release_date`) VALUES
(1, 4, 7, 1, '5000.00', '1.00', '5000.00', 1, '2020-02-02 16:51:57');

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

CREATE TABLE `stages` (
  `stage_id` int UNSIGNED NOT NULL,
  `pro_id` int UNSIGNED NOT NULL,
  `stage_name` varchar(30) NOT NULL,
  `stage_desc` varchar(1500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `approx_budget` decimal(11,2) NOT NULL,
  `outstanding` decimal(11,2) NOT NULL,
  `stages_status` varchar(15) DEFAULT 'notstart',
  `stage_act_start_date` datetime DEFAULT NULL,
  `stage_act_end_date` datetime DEFAULT NULL,
  `release_user` int UNSIGNED NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`stage_id`, `pro_id`, `stage_name`, `stage_desc`, `approx_budget`, `outstanding`, `stages_status`, `stage_act_start_date`, `stage_act_end_date`, `release_user`, `release_date`) VALUES
(1, 1, 'Project/001/Stage/001', 'sdadasd', '50000.00', '0.00', 'complete', '2020-02-01 08:44:12', '2020-02-01 08:47:13', 1, '2020-01-31 22:18:47'),
(2, 1, 'Project/001/Stage/002', 'Description', '50000.00', '50000.00', 'complete', '2020-02-01 08:46:56', '2020-02-01 08:47:13', 1, '2020-01-31 22:23:41'),
(3, 2, 'Project/002/Stage/001', 'Address', '25000.00', '20000.00', 'complete', '2020-02-01 09:34:08', '2020-02-01 09:37:42', 1, '2020-02-01 09:30:48'),
(4, 3, 'Project/003/Stage/001', 'Address', '50000.00', '0.00', 'complete', '2020-02-01 09:48:48', '2020-02-01 14:44:43', 1, '2020-02-01 09:44:10'),
(5, 3, 'Project/003/Stage/002', 'Address', '50000.00', '0.00', 'complete', '2020-02-01 09:50:42', '2020-02-01 14:44:44', 1, '2020-02-01 09:44:42'),
(6, 3, 'Project/003/Stage/003', 'Address', '50000.00', '25000.00', 'complete', '2020-02-01 14:43:50', '2020-02-01 14:44:44', 1, '2020-02-01 09:46:08'),
(7, 3, 'Project/003/Stage/004', 'Address', '50000.00', '50000.00', 'complete', '2020-02-01 14:44:20', '2020-02-01 14:44:44', 1, '2020-02-01 09:46:36'),
(8, 4, 'stage 01', 'rtutyit', '15000.00', '5000.00', 'inprogress', '2020-02-02 11:32:35', NULL, 1, '2020-02-02 10:13:20'),
(9, 4, 'stage 02', 'gdfhghkjh', '35000.00', '35000.00', 'notstart', NULL, NULL, 1, '2020-02-02 11:38:48'),
(10, 4, 'stage 02', 'dsgfhhdgf', '35000.00', '35000.00', 'notstart', NULL, NULL, 1, '2020-02-02 11:40:03'),
(11, 5, 'Site Clearing ', 'Preparation of site ', '33600.00', '33600.00', 'notstart', NULL, NULL, 1, '2020-02-03 12:51:29'),
(12, 5, 'Excavation', 'excavation with laborsgehrryyj\n', '225000.00', '225000.00', 'notstart', NULL, NULL, 1, '2020-02-03 12:53:47'),
(13, 5, 'back filling', 'back filling with  labors & compacting with wacker\n', '21600.00', '21600.00', 'notstart', NULL, NULL, 1, '2020-02-03 12:57:00'),
(14, 5, 'Rubble work', 'With the usage of rubble and masonry work', '350000.00', '350000.00', 'notstart', NULL, NULL, 1, '2020-02-03 12:59:01'),
(15, 5, 'Brick work', 'With the use of cement brick work (4\" x 14\" x 6\" )4\" walls\n', '48125000.00', '48125000.00', 'notstart', NULL, NULL, 1, '2020-02-03 13:02:37'),
(16, 5, 'Concreting', 'Add concrete base,concrete slabs,floor concrete,beams,concrete lintols ,tie-beam 12\' X 6\'', '521000.00', '521000.00', 'notstart', NULL, NULL, 1, '2020-02-03 14:39:26'),
(17, 5, 'Plastering', '1:2:4 cement plastering complete with smoothing', '25000.00', '25000.00', 'notstart', NULL, NULL, 1, '2020-02-03 14:40:56'),
(18, 5, 'wiring', 'Single phase wiring with the use of electrical materials', '30000.00', '30000.00', 'notstart', NULL, NULL, 1, '2020-02-03 14:59:14'),
(19, 5, 'Plumbing', 'Fixing pipe joins ', '20840.00', '20840.00', 'notstart', NULL, NULL, 1, '2020-02-03 15:20:57'),
(20, 5, 'Color washing and Painting', 'apply 02 coats of wall filler and minimum 02 coats of  emulsion paint', '16000.00', '16000.00', 'notstart', NULL, NULL, 1, '2020-02-03 15:29:07'),
(21, 5, 'Wall tile laying', 'Apply 1/2\' bedding in cement & sand 1/3 & finish with tile grout', '50000.00', '50000.00', 'notstart', NULL, NULL, 1, '2020-02-03 15:32:32');

-- --------------------------------------------------------

--
-- Table structure for table `stages_img`
--

CREATE TABLE `stages_img` (
  `id` int UNSIGNED NOT NULL,
  `pro_id` int UNSIGNED NOT NULL,
  `stages_id` int UNSIGNED NOT NULL,
  `img` varchar(50) NOT NULL,
  `release_user` int UNSIGNED NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stages_img`
--

INSERT INTO `stages_img` (`id`, `pro_id`, `stages_id`, `img`, `release_user`, `release_date`) VALUES
(1, 2, 3, '5e34f9acb06ab9.72079207.png', 1, '2020-02-01 09:38:12'),
(2, 3, 7, '5e34fc6c049097.38733559.png', 1, '2020-02-01 09:49:56'),
(3, 3, 4, '5e34fc79b64af2.03837092.png', 1, '2020-02-01 09:50:09'),
(4, 3, 4, '5e34fc8a6fead7.56944213.png', 1, '2020-02-01 09:50:26'),
(5, 4, 8, '5e34fc6c049097.38733559.png', 1, '2020-02-02 11:37:03'),
(6, 4, 9, '5e34fc6c049097.38733559.png', 1, '2020-02-02 11:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `stages_item`
--

CREATE TABLE `stages_item` (
  `id` int UNSIGNED NOT NULL,
  `stage_id` int UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `item_cost` decimal(11,2) NOT NULL,
  `qty` decimal(11,2) NOT NULL,
  `total_amount` decimal(11,2) NOT NULL,
  `release_user` int UNSIGNED NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stages_item`
--

INSERT INTO `stages_item` (`id`, `stage_id`, `item_id`, `item_cost`, `qty`, `total_amount`, `release_user`, `release_date`) VALUES
(1, 1, 1, '5000.00', '10.00', '50000.00', 1, '2020-01-31 22:18:47'),
(2, 2, 1, '5000.00', '10.00', '50000.00', 1, '2020-01-31 22:23:42'),
(3, 3, 1, '5000.00', '5.00', '25000.00', 1, '2020-02-01 09:30:48'),
(4, 4, 1, '5000.00', '10.00', '50000.00', 1, '2020-02-01 09:44:10'),
(5, 6, 1, '5000.00', '10.00', '50000.00', 1, '2020-02-01 09:46:09'),
(6, 7, 1, '5000.00', '10.00', '50000.00', 1, '2020-02-01 09:46:36'),
(7, 8, 1, '5000.00', '3.00', '15000.00', 1, '2020-02-02 10:13:20'),
(8, 9, 1, '5000.00', '7.00', '35000.00', 1, '2020-02-02 11:38:49'),
(9, 11, 2, '2000.00', '6.00', '12000.00', 1, '2020-02-03 12:51:29'),
(10, 11, 3, '300.00', '72.00', '21600.00', 1, '2020-02-03 12:51:29'),
(11, 12, 3, '300.00', '750.00', '225000.00', 1, '2020-02-03 12:53:47'),
(12, 13, 3, '300.00', '72.00', '21600.00', 1, '2020-02-03 12:57:00'),
(13, 14, 6, '35000.00', '10.00', '350000.00', 1, '2020-02-03 12:59:02'),
(14, 15, 10, '12500.00', '3850.00', '48125000.00', 1, '2020-02-03 13:02:37'),
(15, 16, 7, '14000.00', '10.00', '140000.00', 1, '2020-02-03 14:39:27'),
(16, 16, 12, '9500.00', '6.00', '57000.00', 1, '2020-02-03 14:39:27'),
(17, 16, 8, '1000.00', '150.00', '150000.00', 1, '2020-02-03 14:39:27'),
(18, 16, 14, '480.00', '200.00', '96000.00', 1, '2020-02-03 14:39:27'),
(19, 16, 13, '780.00', '100.00', '78000.00', 1, '2020-02-03 14:39:27'),
(20, 17, 8, '1000.00', '25.00', '25000.00', 1, '2020-02-03 14:40:56'),
(21, 18, 20, '1750.00', '12.00', '21000.00', 1, '2020-02-03 14:59:14'),
(22, 18, 22, '150.00', '40.00', '6000.00', 1, '2020-02-03 14:59:14'),
(23, 18, 23, '75.00', '40.00', '3000.00', 1, '2020-02-03 14:59:14'),
(24, 19, 26, '15.00', '20.00', '300.00', 1, '2020-02-03 15:20:57'),
(25, 19, 27, '18.00', '30.00', '540.00', 1, '2020-02-03 15:20:57'),
(26, 19, 28, '100.00', '200.00', '20000.00', 1, '2020-02-03 15:20:57'),
(27, 20, 30, '200.00', '80.00', '16000.00', 1, '2020-02-03 15:29:07'),
(28, 21, 7, '14000.00', '2.00', '28000.00', 1, '2020-02-03 15:32:32'),
(29, 21, 8, '1000.00', '22.00', '22000.00', 1, '2020-02-03 15:32:32');

-- --------------------------------------------------------

--
-- Table structure for table `uom`
--

CREATE TABLE `uom` (
  `uom_code` varchar(6) NOT NULL,
  `uom_desc` varchar(50) DEFAULT NULL,
  `allow_decimal` tinyint(1) NOT NULL,
  `release_user` int UNSIGNED NOT NULL,
  `release_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uom`
--

INSERT INTO `uom` (`uom_code`, `uom_desc`, `allow_decimal`, `release_user`, `release_date`) VALUES
('bags', 'cement measurement', 1, 1, '2020-02-03 11:29:38'),
('cube', 'material measure', 1, 1, '2020-02-03 11:29:08'),
('ft.', 'Foot for material measurement', 1, 1, '2020-02-03 15:11:20'),
('hrs', 'to measure workmanship,machine operations', 1, 1, '2020-02-03 11:27:58'),
('KG', 'dasdasd', 1, 1, '2020-01-31 22:12:40'),
('lit', 'Liters', 1, 1, '2020-02-03 15:16:42'),
('nos', 'Numbers', 1, 1, '2020-02-03 11:30:48'),
('Roll', 'Electrical wire for Wiring', 1, 1, '2020-02-03 14:43:49'),
('sqrs', 'brick work', 1, 1, '2020-02-03 11:30:10'),
('ton ', 'R/f Bars', 1, 1, '2020-02-03 11:31:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
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
  `user_registered` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `address`, `tel_no`, `nic`, `email`, `password`, `user_type`, `user_img`, `release_user`, `status`, `user_registered`) VALUES
(1, 'Sarto', 'De Waas', 'No.18 Peter perise Mawatha ,4th kurana ,Negombo', '+94778956123', '789456123V', 'admin@pro.com', '202cb962ac59075b964b07152d234b70', 'administrator', '../doc/img/5e36ba57485474.87752237.jpg', 'admin@pro.com', 1, '2020-01-31 20:34:06'),
(2, 'Imalie', 'De Waas', 'No.18 Peter perise mawatha,4th kurana,nengmbo', '+94767511245', '784867345V', 'imaldewaas@gmail.com', '65034fc34e934d0432ddc7b8b7f3f86c', 'superuser', '../doc/img/defaultImg.png', 'admin@pro.com', 1, '2020-02-01 22:27:25'),
(3, 'Lumina', 'Cooray ', 'No.34 temple road,Negombo', '+94767511243', '967911461V', 'luminacooray@gmail.com', '74c60ac3b69063898ccb3ecc3fc529d1', 'supervisor', '../doc/img/defaultImg.png', 'admin@pro.com', 1, '2020-02-01 22:31:27'),
(4, 'Sarto', 'De Waas', 'No.65 Lotus road,Jaella', '+94767511242', '784847343V', 'uasdewaas@gmail.com', '21f0ad476dd326bb29142982bcc1d18f', 'employee', '../doc/img/defaultImg.png', 'admin@pro.com', 1, '2020-02-01 22:34:35'),
(5, 'Kamal', 'Fernando', 'reutiipojp', '+94767939749', '784867845V', 'kamal56@gmail.com', '443e5a43a3a3e8e9ef46bfa37bef7600', 'supervisor', '../doc/img/defaultImg.png', 'admin@pro.com', 1, '2020-02-02 12:37:49'),
(6, 'Imalxxx', 'xxx', 'xx', '+94767511243', '783847345V', 'seasxt2@gmail.com', '3a161500a63064666ac41f2f22de89b6', 'supervisor', '../doc/img/defaultImg.png', 'admin@pro.com', 1, '2020-02-02 12:51:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boq_doc`
--
ALTER TABLE `boq_doc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `release_user` (`release_user`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `release_user` (`release_user`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `release_user` (`release_user`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uom_code` (`uom_code`),
  ADD KEY `release_user` (`release_user`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pro_owner_id` (`pro_owner_id`),
  ADD KEY `release_user` (`release_user`);

--
-- Indexes for table `project_remark`
--
ALTER TABLE `project_remark`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `release_user` (`release_user`);

--
-- Indexes for table `pro_stock_in`
--
ALTER TABLE `pro_stock_in`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `stage_id` (`stage_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `release_user` (`release_user`);

--
-- Indexes for table `pro_stock_out`
--
ALTER TABLE `pro_stock_out`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `stage_id` (`stage_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `release_user` (`release_user`);

--
-- Indexes for table `stages`
--
ALTER TABLE `stages`
  ADD PRIMARY KEY (`stage_id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `release_user` (`release_user`);

--
-- Indexes for table `stages_img`
--
ALTER TABLE `stages_img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stages_id` (`stages_id`),
  ADD KEY `release_user` (`release_user`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `stages_item`
--
ALTER TABLE `stages_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stage_id` (`stage_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `release_user` (`release_user`);

--
-- Indexes for table `uom`
--
ALTER TABLE `uom`
  ADD PRIMARY KEY (`uom_code`),
  ADD KEY `release_user` (`release_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boq_doc`
--
ALTER TABLE `boq_doc`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project_remark`
--
ALTER TABLE `project_remark`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pro_stock_in`
--
ALTER TABLE `pro_stock_in`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pro_stock_out`
--
ALTER TABLE `pro_stock_out`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stages`
--
ALTER TABLE `stages`
  MODIFY `stage_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `stages_img`
--
ALTER TABLE `stages_img`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stages_item`
--
ALTER TABLE `stages_item`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
