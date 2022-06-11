-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 11, 2022 at 06:25 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `billing_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `type`, `status`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'super_admin', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `cart_grand_total`
--

CREATE TABLE `cart_grand_total` (
  `n_slno` bigint(20) NOT NULL,
  `n_order_id` bigint(20) NOT NULL DEFAULT 0,
  `n_sub_total` double NOT NULL DEFAULT 0,
  `n_shipping_charge` double NOT NULL DEFAULT 0,
  `n_discount` double NOT NULL DEFAULT 0,
  `n_discount_persantage` double DEFAULT 0,
  `n_grand_total` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_grand_total`
--

INSERT INTO `cart_grand_total` (`n_slno`, `n_order_id`, `n_sub_total`, `n_shipping_charge`, `n_discount`, `n_discount_persantage`, `n_grand_total`) VALUES
(1, 12, 48, 0, 0, 0, 48);

-- --------------------------------------------------------

--
-- Table structure for table `cart_order_detail`
--

CREATE TABLE `cart_order_detail` (
  `n_slno` int(11) NOT NULL,
  `n_order_id` int(11) DEFAULT NULL,
  `n_customer_id` int(11) NOT NULL,
  `n_product_id` int(11) NOT NULL,
  `c_product` varchar(100) DEFAULT NULL,
  `product_code` varchar(20) DEFAULT NULL,
  `n_amount` double(10,2) NOT NULL,
  `n_quantity` int(11) NOT NULL,
  `n_tax` int(11) DEFAULT NULL,
  `n_cgst` double(10,2) DEFAULT NULL,
  `n_sgst` double(10,2) DEFAULT NULL,
  `n_igst` double(10,2) DEFAULT NULL,
  `n_discount` double DEFAULT NULL,
  `n_subtotal` double(10,2) NOT NULL,
  `n_grand_total` double(10,2) DEFAULT 0.00,
  `n_attribute` int(11) DEFAULT NULL,
  `n_price_id` int(11) DEFAULT NULL,
  `d_date` datetime NOT NULL,
  `c_status` varchar(5) NOT NULL DEFAULT 'Y',
  `c_order_status` varchar(35) DEFAULT 'PENDING',
  `c_delivery_status` varchar(10) DEFAULT 'SHIPPING',
  `d_delivery_status_date` datetime DEFAULT NULL,
  `c_reason` text DEFAULT NULL,
  `c_invoice_no` varchar(75) DEFAULT NULL,
  `d_invoice` datetime DEFAULT NULL,
  `c_mode_of_payment` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_order_detail`
--

INSERT INTO `cart_order_detail` (`n_slno`, `n_order_id`, `n_customer_id`, `n_product_id`, `c_product`, `product_code`, `n_amount`, `n_quantity`, `n_tax`, `n_cgst`, `n_sgst`, `n_igst`, `n_discount`, `n_subtotal`, `n_grand_total`, `n_attribute`, `n_price_id`, `d_date`, `c_status`, `c_order_status`, `c_delivery_status`, `d_delivery_status_date`, `c_reason`, `c_invoice_no`, `d_invoice`, `c_mode_of_payment`) VALUES
(5, 12, 11, 1, 'Chilli Powder', 'KTCH123', 0.00, 1, 5, NULL, NULL, NULL, 0, 48.00, 48.00, 1, 4, '2022-06-11 08:53:40', 'Y', 'DELIVERED', 'SHIPPING', NULL, NULL, '12', '2022-06-11 00:00:00', 'Shop Purchase');

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `customer_id` int(11) NOT NULL,
  `n_mobile_no` int(11) NOT NULL,
  `c_place` int(11) NOT NULL,
  `d_date` int(11) NOT NULL,
  `d_date_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`customer_id`, `n_mobile_no`, `c_place`, `d_date`, `d_date_time`) VALUES
(7, 54546567, 0, 2022, 2022),
(8, 54546567, 0, 2022, 2022),
(9, 54546567, 0, 2022, 2022),
(10, 54546567, 0, 2022, 2022),
(11, 34545, 0, 2022, 2022);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `n_slno` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `discount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_master`
--

CREATE TABLE `invoice_master` (
  `n_slno` bigint(20) NOT NULL,
  `n_order_id` bigint(20) NOT NULL,
  `d_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_master`
--

INSERT INTO `invoice_master` (`n_slno`, `n_order_id`, `d_date`) VALUES
(12, 12, '2022-06-11 08:53:40');

-- --------------------------------------------------------

--
-- Table structure for table `maxtab`
--

CREATE TABLE `maxtab` (
  `ID` varchar(25) NOT NULL,
  `VAL` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maxtab`
--

INSERT INTO `maxtab` (`ID`, `VAL`) VALUES
('INVOICE_NO', 0),
('TRANSCATIONID', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE `order_master` (
  `n_slno` bigint(20) NOT NULL,
  `n_id` bigint(20) NOT NULL,
  `d_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_master`
--

INSERT INTO `order_master` (`n_slno`, `n_id`, `d_date`) VALUES
(12, 34545, '2022-06-11 08:53:40');

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE `product_attribute` (
  `n_attribute_id` int(11) NOT NULL,
  `n_product_id` int(11) NOT NULL,
  `n_attributes` varchar(250) DEFAULT NULL,
  `c_status` varchar(100) NOT NULL,
  `c_image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_attribute`
--

INSERT INTO `product_attribute` (`n_attribute_id`, `n_product_id`, `n_attributes`, `c_status`, `c_image`) VALUES
(1, 1, '1', 'A', 'The upload path does not appear to be valid.2'),
(2, 1, '2', 'A', 'The upload path does not appear to be valid.2');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `n_id` bigint(20) NOT NULL,
  `c_image` varchar(255) NOT NULL,
  `n_product_id` bigint(20) NOT NULL,
  `c_status` varchar(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`n_id`, `c_image`, `n_product_id`, `c_status`) VALUES
(1, 'The upload path does not appear to be valid.2', 1, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `product_master`
--

CREATE TABLE `product_master` (
  `n_product_id` int(11) NOT NULL,
  `c_product_name` varchar(100) NOT NULL,
  `c_type` varchar(100) NOT NULL DEFAULT 'Single',
  `n_category` text NOT NULL,
  `n_brand_id` int(11) NOT NULL,
  `n_hsncode` varchar(100) DEFAULT NULL,
  `n_batch_code` int(11) DEFAULT NULL,
  `c_description` text DEFAULT NULL,
  `c_supplier_name` varchar(100) DEFAULT NULL,
  `c_product_code` varchar(100) DEFAULT NULL,
  `c_status` varchar(100) NOT NULL,
  `c_image` varchar(300) DEFAULT NULL,
  `n_combo_id` int(11) DEFAULT NULL,
  `n_views` int(11) NOT NULL,
  `n_rating` int(11) NOT NULL,
  `c_product_type` varchar(25) DEFAULT NULL,
  `c_product_role` varchar(100) NOT NULL DEFAULT 'Normal',
  `d_edit` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_master`
--

INSERT INTO `product_master` (`n_product_id`, `c_product_name`, `c_type`, `n_category`, `n_brand_id`, `n_hsncode`, `n_batch_code`, `c_description`, `c_supplier_name`, `c_product_code`, `c_status`, `c_image`, `n_combo_id`, `n_views`, `n_rating`, `c_product_type`, `c_product_role`, `d_edit`) VALUES
(1, 'Chilli Powder', 'Single', '1', 2, '123123', NULL, '<p>Good Product</p>', 'Kitchen Treasures', 'KTCH123', 'A', NULL, NULL, 0, 0, NULL, 'Normal', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_offers`
--

CREATE TABLE `product_offers` (
  `n_id` int(11) NOT NULL,
  `n_product_id` int(11) DEFAULT NULL,
  `n_price_id` int(11) NOT NULL,
  `n_offer_category` int(11) DEFAULT NULL,
  `d_expiry_date` date DEFAULT NULL,
  `c_status` varchar(20) NOT NULL DEFAULT 'A'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_price`
--

CREATE TABLE `product_price` (
  `n_price_id` int(11) NOT NULL,
  `n_product_id` int(11) NOT NULL,
  `n_attribute_id` int(11) NOT NULL,
  `d_distributor_price` double NOT NULL,
  `d_mrp` double NOT NULL,
  `d_tax` double NOT NULL,
  `d_date` date NOT NULL,
  `d_expiry_date` date NOT NULL,
  `c_batch_code` varchar(200) NOT NULL,
  `c_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_price`
--

INSERT INTO `product_price` (`n_price_id`, `n_product_id`, `n_attribute_id`, `d_distributor_price`, `d_mrp`, `d_tax`, `d_date`, `d_expiry_date`, `c_batch_code`, `c_status`) VALUES
(4, 1, 1, 46, 48, 5, '2022-06-10', '2023-04-01', '10001', 'A'),
(5, 1, 2, 68, 70, 5, '2022-06-11', '2023-04-01', '10002', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `n_slno` int(11) NOT NULL,
  `c_company_name` varchar(55) COLLATE utf8_bin NOT NULL,
  `c_title` varchar(77) COLLATE utf8_bin NOT NULL,
  `c_address` text COLLATE utf8_bin NOT NULL,
  `c_contact1` varchar(77) COLLATE utf8_bin NOT NULL,
  `c_contact2` int(11) NOT NULL,
  `c_email` varchar(77) COLLATE utf8_bin NOT NULL,
  `c_website` varchar(77) COLLATE utf8_bin NOT NULL,
  `c_logo` varchar(77) COLLATE utf8_bin NOT NULL,
  `c_location_map` text COLLATE utf8_bin NOT NULL,
  `c_lat` varchar(55) COLLATE utf8_bin NOT NULL,
  `c_long` varchar(55) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`n_slno`, `c_company_name`, `c_title`, `c_address`, `c_contact1`, `c_contact2`, `c_email`, `c_website`, `c_logo`, `c_location_map`, `c_lat`, `c_long`) VALUES
(1, 'ABC', 'ABC', 'Cochin po, Kakkanad PIn:123456', '+91 1234567890', 0, 'contact@abc.com', 'www.abc.com', 'http://thelifevision.in/assets/images/logo.png', '', '10.0013655', '76.310081');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_attribute`
--

CREATE TABLE `shopping_attribute` (
  `n_id` int(11) NOT NULL,
  `c_attribute_name` varchar(100) NOT NULL,
  `n_attribute_group` int(11) NOT NULL,
  `c_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_attribute`
--

INSERT INTO `shopping_attribute` (`n_id`, `c_attribute_name`, `n_attribute_group`, `c_status`) VALUES
(1, '250gm', 1, 'A'),
(2, '500gm', 1, 'A'),
(3, '1kg', 2, 'A'),
(4, '5kg', 2, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_brand`
--

CREATE TABLE `shopping_brand` (
  `n_id` int(11) NOT NULL,
  `c_brand_name` varchar(100) NOT NULL,
  `c_image` varchar(300) NOT NULL,
  `c_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_brand`
--

INSERT INTO `shopping_brand` (`n_id`, `c_brand_name`, `c_image`, `c_status`) VALUES
(1, 'Ashirvad', '17058441301654886027.png', 'A'),
(2, 'Kitchen Treasures', '11086571401654886072.png', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_category`
--

CREATE TABLE `shopping_category` (
  `n_id` int(11) NOT NULL,
  `c_category_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `n_parent_id` int(11) NOT NULL,
  `n_level` int(11) NOT NULL,
  `c_display` text NOT NULL,
  `n_order` int(11) NOT NULL DEFAULT 1,
  `c_status` varchar(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_category`
--

INSERT INTO `shopping_category` (`n_id`, `c_category_name`, `image`, `n_parent_id`, `n_level`, `c_display`, `n_order`, `c_status`) VALUES
(1, 'Grocery', '2684616871654885891.jpeg', 0, 0, 'Grocery', 1, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_group_name`
--

CREATE TABLE `shopping_group_name` (
  `n_id` int(11) NOT NULL,
  `c_group_name` varchar(100) NOT NULL,
  `c_display` varchar(100) NOT NULL,
  `c_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_group_name`
--

INSERT INTO `shopping_group_name` (`n_id`, `c_group_name`, `c_display`, `c_status`) VALUES
(1, 'Gram', 'Gram', 'A'),
(2, 'Kilogram', 'Kilogram', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `stock_master`
--

CREATE TABLE `stock_master` (
  `n_stock_id` int(11) NOT NULL,
  `n_product_id` int(11) NOT NULL,
  `n_attribute_id` int(11) NOT NULL,
  `n_price_id` int(11) NOT NULL,
  `c_batch_code` varchar(200) NOT NULL,
  `n_stock` int(11) NOT NULL,
  `n_added_stock` int(11) NOT NULL,
  `d_date` date NOT NULL,
  `n_creator` int(11) NOT NULL,
  `c_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_master`
--

INSERT INTO `stock_master` (`n_stock_id`, `n_product_id`, `n_attribute_id`, `n_price_id`, `c_batch_code`, `n_stock`, `n_added_stock`, `d_date`, `n_creator`, `c_status`) VALUES
(4, 1, 1, 4, '10001', 998, 1000, '2022-06-10', 1, 'A'),
(5, 1, 2, 5, '10002', 1000, 1000, '2022-06-11', 1, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `stock_master_log`
--

CREATE TABLE `stock_master_log` (
  `n_id` int(11) NOT NULL,
  `n_user_id` bigint(20) NOT NULL DEFAULT -1,
  `c_batch_code` varchar(255) NOT NULL,
  `n_product_id` bigint(20) NOT NULL,
  `n_attribute_id` int(11) NOT NULL,
  `n_stock` bigint(20) NOT NULL,
  `distributor_price` double NOT NULL,
  `d_mrp` double(10,2) NOT NULL,
  `mrp` double NOT NULL,
  `tax` double NOT NULL,
  `date_added` datetime NOT NULL,
  `n_stock_id` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_master_log`
--

INSERT INTO `stock_master_log` (`n_id`, `n_user_id`, `c_batch_code`, `n_product_id`, `n_attribute_id`, `n_stock`, `distributor_price`, `d_mrp`, `mrp`, `tax`, `date_added`, `n_stock_id`) VALUES
(1, 1, '10001', 1, 1, 1000, 46, 48.00, 0, 5, '2022-06-10 00:00:00', NULL),
(2, 1, '10002', 1, 2, 1000, 68, 70.00, 0, 5, '2022-06-11 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `C_CODE1` (`password`);

--
-- Indexes for table `cart_grand_total`
--
ALTER TABLE `cart_grand_total`
  ADD PRIMARY KEY (`n_slno`);

--
-- Indexes for table `cart_order_detail`
--
ALTER TABLE `cart_order_detail`
  ADD PRIMARY KEY (`n_slno`),
  ADD KEY `n_order_id` (`n_order_id`),
  ADD KEY `c_order_status` (`c_order_status`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`n_slno`);

--
-- Indexes for table `invoice_master`
--
ALTER TABLE `invoice_master`
  ADD PRIMARY KEY (`n_slno`);

--
-- Indexes for table `maxtab`
--
ALTER TABLE `maxtab`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `order_master`
--
ALTER TABLE `order_master`
  ADD PRIMARY KEY (`n_slno`);

--
-- Indexes for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD PRIMARY KEY (`n_attribute_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `product_master`
--
ALTER TABLE `product_master`
  ADD PRIMARY KEY (`n_product_id`);

--
-- Indexes for table `product_offers`
--
ALTER TABLE `product_offers`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `product_price`
--
ALTER TABLE `product_price`
  ADD PRIMARY KEY (`n_price_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`n_slno`);

--
-- Indexes for table `shopping_attribute`
--
ALTER TABLE `shopping_attribute`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `shopping_brand`
--
ALTER TABLE `shopping_brand`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `shopping_category`
--
ALTER TABLE `shopping_category`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `shopping_group_name`
--
ALTER TABLE `shopping_group_name`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `stock_master`
--
ALTER TABLE `stock_master`
  ADD PRIMARY KEY (`n_stock_id`);

--
-- Indexes for table `stock_master_log`
--
ALTER TABLE `stock_master_log`
  ADD PRIMARY KEY (`n_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_grand_total`
--
ALTER TABLE `cart_grand_total`
  MODIFY `n_slno` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart_order_detail`
--
ALTER TABLE `cart_order_detail`
  MODIFY `n_slno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `n_slno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_master`
--
ALTER TABLE `invoice_master`
  MODIFY `n_slno` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_master`
--
ALTER TABLE `order_master`
  MODIFY `n_slno` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_attribute`
--
ALTER TABLE `product_attribute`
  MODIFY `n_attribute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `n_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_master`
--
ALTER TABLE `product_master`
  MODIFY `n_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_price`
--
ALTER TABLE `product_price`
  MODIFY `n_price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `n_slno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shopping_attribute`
--
ALTER TABLE `shopping_attribute`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shopping_brand`
--
ALTER TABLE `shopping_brand`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shopping_category`
--
ALTER TABLE `shopping_category`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shopping_group_name`
--
ALTER TABLE `shopping_group_name`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_master`
--
ALTER TABLE `stock_master`
  MODIFY `n_stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stock_master_log`
--
ALTER TABLE `stock_master_log`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
