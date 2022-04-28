-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 08, 2018 at 11:44 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eyeonic`
--
CREATE DATABASE IF NOT EXISTS `eyeonic` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `eyeonic`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brands`
--

CREATE TABLE IF NOT EXISTS `tbl_brands` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_num` varchar(11) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `tbl_brands`:
--

--
-- Truncate table before insert `tbl_brands`
--

TRUNCATE TABLE `tbl_brands`;
--
-- Dumping data for table `tbl_brands`
--

INSERT IGNORE INTO `tbl_brands` (`id`, `name`, `address`, `phone_num`, `mail`) VALUES
(1, 'Ray-Ban', 'Rochester, New York, United States', '866-472-922', 'rayban@mail.neot'),
(2, 'Oakley', 'Rochester, New York, United States', '866-472-922', 'rayban@mail.neot');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `tbl_cart`:
--   `user_id`
--       `tbl_users` -> `id`
--   `product_id`
--       `tbl_products` -> `id`
--

--
-- Truncate table before insert `tbl_cart`
--

TRUNCATE TABLE `tbl_cart`;
--
-- Dumping data for table `tbl_cart`
--

INSERT IGNORE INTO `tbl_cart` (`user_id`, `product_id`, `quantity`) VALUES
(3, 4, 2),
(3, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `tbl_category`:
--

--
-- Truncate table before insert `tbl_category`
--

TRUNCATE TABLE `tbl_category`;
--
-- Dumping data for table `tbl_category`
--

INSERT IGNORE INTO `tbl_category` (`id`, `name`) VALUES
(1, 'Eyeglasses'),
(2, 'Multifocal'),
(3, 'Sunglasses'),
(4, 'Rx. Sungla');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact_lense`
--

CREATE TABLE IF NOT EXISTS `tbl_contact_lense` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `price` decimal(5,2) DEFAULT '50.00',
  `description` text,
  `inbox_qty` tinyint(4) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `manufacturer` varchar(50) DEFAULT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `brand` varchar(20) DEFAULT 'Acuve',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `tbl_contact_lense`:
--

--
-- Truncate table before insert `tbl_contact_lense`
--

TRUNCATE TABLE `tbl_contact_lense`;
--
-- Dumping data for table `tbl_contact_lense`
--

INSERT IGNORE INTO `tbl_contact_lense` (`id`, `name`, `price`, `description`, `inbox_qty`, `type`, `manufacturer`, `image1`, `image2`, `brand`) VALUES
(1, 'Acuvue Oasys for Astigmatism 6 pack', '57.00', 'The Acuvue Oasys for Astig. is the first lens of its kind. Made uniquely suited for those suffering from an Astigmatism the Acuvue Oasys lenses support an Accelerated Stabilization Design Technology that perfectly matches the irregular curvature of your eyes.', 6, 'Single Vision', 'Johnson', 'https://static.glassesusa.com/media/catalog/product/cache/1/base_image/350x220/9df78eab33525d08d6e5fb8d27136e95/a/c/acuvue_oasys_for_astig._6pk.png', 'https://static.glassesusa.com/media/catalog/product/cache/1/base_image/350x220/9df78eab33525d08d6e5fb8d27136e95/a/c/acuvue_oasys_for_astig._6pk.png', 'Acuve'),
(2, 'Acuvue 2 6 pack', '37.00', 'The best selling Hydrogel contact lenses for nearly fifteen years. Acuvue 2 boast an easy insert and removal with their lightly tinted lenses as well as a high percentage of their clientele achieving nearly perfect vision.', 6, 'Single Vision', 'Johnson', 'https://static.glassesusa.com/media/catalog/product/cache/1/base_image/350x220/9df78eab33525d08d6e5fb8d27136e95/a/c/acuvue_2_6pk.png', 'https://static.glassesusa.com/media/catalog/product/cache/1/base_image/350x220/9df78eab33525d08d6e5fb8d27136e95/0/0/000802_demandware_prodrx.jpg', 'Acuve'),
(3, 'Biofinity 6 pack', '67.20', 'Biofinity monthly contact lenses use Aquaform Comfort technology which help your eyes stay healthy and moist from the oxygen. Coupled with a lens design that focuses light better for depth of focus, these Biofinity contacts are simply incredible.', 6, 'Multifocals', 'CooperVision', 'https://static.glassesusa.com/media/catalog/product/cache/1/base_image/350x220/9df78eab33525d08d6e5fb8d27136e95/b/i/biofinity_6pk.png', 'https://static.glassesusa.com/media/catalog/product/cache/1/base_image/350x220/9df78eab33525d08d6e5fb8d27136e95/0/0/002080_demandware_prodrx.jpg', 'Biofinity');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orderitem`
--

CREATE TABLE IF NOT EXISTS `tbl_orderitem` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(10) UNSIGNED NOT NULL,
  `prd_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `prd_id` (`prd_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `tbl_orderitem`:
--   `prd_id`
--       `tbl_products` -> `id`
--   `order_id`
--       `tbl_orders` -> `id`
--

--
-- Truncate table before insert `tbl_orderitem`
--

TRUNCATE TABLE `tbl_orderitem`;
--
-- Dumping data for table `tbl_orderitem`
--

INSERT IGNORE INTO `tbl_orderitem` (`id`, `order_id`, `prd_id`, `quantity`, `order_date`) VALUES
(1, 1, 5, 2, '2018-03-24 10:54:18'),
(2, 1, 3, 4, '2018-03-24 10:54:18'),
(3, 2, 4, 1, '2018-03-24 13:01:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE IF NOT EXISTS `tbl_orders` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `usr_id` int(10) UNSIGNED NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `notes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `stt` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `usr_id` (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `tbl_orders`:
--   `usr_id`
--       `tbl_users` -> `id`
--

--
-- Truncate table before insert `tbl_orders`
--

TRUNCATE TABLE `tbl_orders`;
--
-- Dumping data for table `tbl_orders`
--

INSERT IGNORE INTO `tbl_orders` (`id`, `usr_id`, `address`, `notes`, `stt`) VALUES
(1, 3, '85 Release Road, Hanoi, Vietnam', 'Please leave it at the backdoor.', 0),
(2, 2, '103 Unknown Street, Unknown District, Vietnam', 'Don’t bring me the gift', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_clense`
--

CREATE TABLE IF NOT EXISTS `tbl_order_clense` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `clense_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `power_right` decimal(2,2) DEFAULT NULL,
  `BC_right` decimal(2,2) DEFAULT NULL,
  `DIA_right` decimal(2,2) DEFAULT NULL,
  `CYL_right` decimal(2,2) DEFAULT NULL,
  `AXIS_right` int(11) DEFAULT NULL,
  `power_left` decimal(2,2) DEFAULT NULL,
  `BC_left` decimal(2,2) DEFAULT NULL,
  `DIA_left` decimal(2,2) DEFAULT NULL,
  `CYL_left` decimal(2,2) DEFAULT NULL,
  `AXIS_left` decimal(2,2) DEFAULT NULL,
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `clense_id` (`clense_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `tbl_order_clense`:
--   `order_id`
--       `tbl_orders` -> `id`
--   `clense_id`
--       `tbl_contact_lense` -> `id`
--

--
-- Truncate table before insert `tbl_order_clense`
--

TRUNCATE TABLE `tbl_order_clense`;
-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE IF NOT EXISTS `tbl_products` (
  `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `origin` varchar(40) NOT NULL,
  `material` varchar(40) DEFAULT NULL,
  `size` varchar(5) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `warranty` smallint(6) NOT NULL,
  `instock_stt` smallint(6) DEFAULT '0',
  `price` decimal(5,2) DEFAULT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `category_id` smallint(5) UNSIGNED NOT NULL,
  `image1` varchar(400) DEFAULT NULL,
  `image2` varchar(400) DEFAULT NULL,
  `image3` varchar(400) DEFAULT NULL,
  `description` text,
  `gender` smallint(6) DEFAULT '0',
  `len_width` varchar(4) DEFAULT NULL,
  `len_height` varchar(4) DEFAULT NULL,
  `bridge_width` varchar(4) DEFAULT NULL,
  `temple_length` varchar(4) DEFAULT NULL,
  `shape` varchar(40) DEFAULT 'Square',
  PRIMARY KEY (`id`),
  KEY `brand_id` (`brand_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `tbl_products`:
--   `brand_id`
--       `tbl_brands` -> `id`
--   `category_id`
--       `tbl_category` -> `id`
--

--
-- Truncate table before insert `tbl_products`
--

TRUNCATE TABLE `tbl_products`;
--
-- Dumping data for table `tbl_products`
--

INSERT IGNORE INTO `tbl_products` (`id`, `name`, `origin`, `material`, `size`, `color`, `warranty`, `instock_stt`, `price`, `brand_id`, `category_id`, `image1`, `image2`, `image3`, `description`, `gender`, `len_width`, `len_height`, `bridge_width`, `temple_length`, `shape`) VALUES
(1, 'Ray-Ban 3025 Classic Aviator', 'USA', 'Metal', 'L', 'Gold', 1, 0, '154.00', 1, 3, 'images/product/6711-f_2.jpg', 'images/product/6711-f_1.jpg', 'images/product/6711-f_3.jpg', 'The Ray-Ban 3025’s tear-shaped frame is a quirky play on the classic aviator style. With its double-bridge, thin yet durable frame, it is equally suited for cruising on a Chopper or at 35,000 feet altitude.', 0, '58', '50', '14', '135', 'Square'),
(2, 'Ray-Ban 5154 Clubmaster', 'UK', 'Metal', 'M', 'Black / Silver', 1, 0, '178.00', 1, 1, 'images/product/6711-f_2.jpg', 'images/product/6711-f_2.jpg', 'images/product/6711-f_2.jpg', 'The Ray-Ban 5154 is a classic browline frame that turned Ray-Ban into the iconic brand that it is. With its lean arms and bold, semi-rimless frame it continues to leave its mark every day and in every way. ', 1, '49', '38', '21', '140', 'Square'),
(3, 'Ray-Ban 5184 New Wayfarer', 'USA', 'Plastic', 'S', 'Tortoise', 1, 0, '178.00', 1, 1, 'images/product/6711-f_2.jpg', 'images/product/6711-f_2.jpg', 'images/product/6711-f_2.jpg', 'This Ray-Ban 5184 is the slimmer and sleeker version of the classic wayfarer. Constructed from high-grade plastic, its bulky arms and signature metal accents provide you with a sense of purpose and style.', 0, '50', '37', '18', '145', 'Square'),
(4, 'Ray-Ban 5277', 'UK', 'Plastic', 'L', 'Shiny Black', 1, 0, '140.00', 1, 2, 'images/product/6711-f_2.jpg', 'images/product/6711-f_2.jpg', 'images/product/6711-f_2.jpg', 'Ray-Ban 5277 eyeglasses comes in a high-grade plastic, with rounded rectangular lenses, that are fully surrounded by the tortoise shell colored, hipster-styled frames.', 0, '54', '31', '17', '140', 'Rectangle'),
(5, 'Ray-Ban 3498', 'USA', 'Metal', 'L', 'Gunmetal', 1, 0, '150.00', 1, 4, 'images/product/6711-f_2.jpg', 'images/product/6711-f_2.jpg', 'images/product/6711-f_2.jpg', 'The Ray-Ban 3498 is a sleek and modern frame that oozes an effortless cool. Crafted from lightweight and durable titanium, its muscular arms and clean design are made to comfortably catch the breeze.', 1, '61', '38', '17', '135', 'Rectangle'),
(6, 'Oakley Flak 2.0', 'USA', 'Plastic', 'M', 'Black', 3, 3, '150.00', 2, 4, 'images/product/Oakley_Flak_2.0_1.jpg', 'images/product/Oakley_Flak_2.0_2.jpg', 'images/product/Oakley_Flak_2.0_3.jpg', 'The Oakley Flak 2.0 is a stylish wrap-around frame crafted from Oakley’s iconic O-Matter. Sporting flexible arms, High Definition Optics and Unobtanium nose pads that ensure a no-slip grip', 2, '54', '37', '12', '133', 'Wrap'),
(7, 'Oakley RX Frogskin', 'USA', 'Plastic', 'M', 'Black', 5, 3, '134.00', 2, 1, 'images/product/Oakley_RX_Frogskin_1.jpg', 'images/product/Oakley_RX_Frogskin_2.jpg', 'images/product/Oakley_RX_Frogskin_3.jpg', 'The Oakley RX Frogskins is a perfect mix of 80\"s cool and modern geek-chic. Crafted from lightweight and durable O-matter, it features a keyhole bridge and sleek arms with a rich hue', 2, '54', '44', '17', '138', 'Square'),
(8, 'Oakley Feedback', 'USA', 'Metal', 'L', 'Brown', 3, 0, '155.00', 2, 3, 'images/product/Oakley_Feedback_1.jpg', 'images/product/Oakley_Feedback_2.jpg', 'images/product/Oakley_Feedback_3.jpg', 'The Oakley Feedback is an ultra-stylish aviator frame with a timeless appeal. Crafted from C-5 alloy and handcrafted acetate, it sports muscular arms and Unobtainium earsocks for the ultimate fit', 1, '59', '46', '13', '135', 'Aviator'),
(9, 'Oakley Gauge 5.2 Truss', 'USA', 'Metal', 'M', 'Black', 3, 3, '234.00', 2, 1, 'images/product/Oakley_Gauge_5.2_Truss_1.jpg', 'images/product/Oakley_Gauge_5.2_Truss_2.jpg', 'images/product/Oakley_Gauge_5.2_Truss_3.jpg', 'The Oakley Gauge 5.2 Truss is a rectangular full-rim frame made for comfort. Crafted from ultra lightweight titanium, it features a stylish double bridge and flexible, stress-resistant arms', 0, '53', '36', '17', '142', 'Rectangle'),
(10, 'Oakley Radar Pace', 'USA', 'Plastic', 'L', 'Black', 4, 5, '449.00', 2, 4, 'images/product/Oakley_Radar_Pace_1.jpg', 'images/product/Oakley_Radar_Pace_2.jpg', 'images/product/Oakley_Radar_Pace_3.jpg', 'The Oakley Radar Pace is a truly revolutionary frame, featuring cutting edge eyewear technology, integrated with internal sensors and a real-time voice-activated coaching system, providing a unique program to help you make the most of your training sessions. Talk on your phone or listen to music through the excellent earbuds and Bluetooth connection. The Ultimate eyewear for getting in shape', 2, '73', '49', '19', '132', 'Wrap'),
(11, 'Oakley Truss Rod  0.5', 'USA', 'Metal', 'M', 'Black', 4, 1, '320.00', 2, 1, 'images/product/Oakley_Truss_Rod _0.5_1.jpg', 'images/product/Oakley_Truss_Rod _0.5_2.jpg', 'images/product/Oakley_Truss_Rod _0.5_3.jpg', 'The Oakley Truss Rod 0.5 is a sleek semi-rimless frame that radiates control and composure. Crafted from C-5 alloy and supported by sporty wrap-around arms, its adjustable silicone nose pads provide a snug fit, while its futuristic design is adds a sense of flair', 0, '53', '37', '18', '143', 'Rectangle'),
(12, 'Oakley Taunt', 'USA', 'Plastic', 'M', 'Brown-Blue', 3, 0, '160.00', 2, 1, 'images/product/Oakley_Taunt_1.jpg', 'images/product/Oakley_Taunt_2.jpg', 'images/product/Oakley_Taunt_3.jpg', 'The Oakley Taunt is a stylish, geometric frame with a subtle cat eye. Coming in iridescent blue, its colors and lightweight acetate is a thing of beauty', 1, '52', '36', '12', '130', 'Square-Geometric'),
(13, 'Oakley Standpoint', 'USA', 'Plastic', 'M', 'Black', 3, 2, '174.00', 2, 1, 'images/product/Oakley_Standpoint_1.jpg', 'images/product/Oakley_Standpoint_2.jpg', 'images/product/Oakley_Standpoint_3.jpg', 'The Oakley Standpoint is a rectangle frame with a modern twist. Crafted from premium acetate, it features a smart glossy bridge and sleek temples with adjustable wire core, adding comfort to a simple look that never goes out of style', 1, '52', '38', '16', '136', 'Rectangle'),
(14, 'Oakely Straighlink', 'USA', 'Plastic', 'L', 'Black-Blue', 3, 4, '160.00', 2, 4, 'images/product/Oakely_Straighlink_1.jpg', 'images/product/Oakely_Straighlink_2.jpg', 'images/product/Oakely_Straighlink_3.jpg', 'The Oakley Straightlink is a slick wrap-around sports frame crafted from cutting-edge O-matter. Sporting Unobtainium arm tips and nose pads, it is made to provide ultimate comfort for the active lifestyle', 0, '61', '40', '17', '132', 'Rectangle-Wrap'),
(15, 'Oakley Overlord', 'USA', 'Plastic', 'M', 'Black', 4, 4, '320.00', 2, 1, 'images/product/Oakley_Overlord_1.jpg', 'images/product/Oakley_Overlord_2.jpg', 'images/product/Oakley_Overlord_3.jpg', 'The Oakley Overlord is a roundish frame with a cool retro twist. Crafted from a lightweight polymer, it features a keyhole bridge, sleek arms and adjustable nose pads for a comfortable fit', 1, '51', '39', '19', '143', 'Oval'),
(16, 'Oakley Trillbe', 'USA', 'Plastic', 'L', 'Black-Blue', 3, 4, '160.00', 2, 4, 'images/product/Oakley_Trillbe_1.jpg', 'images/product/Oakley_Trillbe_2.jpg', 'images/product/Oakley_Trillbe_3.jpg', 'The Oakley Trillbe is a modern full-rimmed frame crafted from lightweight O-matter. Sporting a saddle bridge and flexible arms with a rich hue, it adds plenty of comfort to its contemporary cool', 0, '67', '49', '22', '141', 'Oversized-Aviator'),
(17, 'Oakley Silver R', 'USA', 'Plastic', 'L', 'Blue-Clear', 3, 5, '175.00', 2, 3, 'images/product/Oakley_Silver_R_1.jpg', 'images/product/Oakley_Silver_R_2.jpg', 'images/product/Oakley_Silver_R_3.jpg', 'The Oakley Silver R is sleek square frame with a surprising touch of vintage. Crafted in lightweight O-matter, it features a retro keyhole bridge and flexible arms for contemporary style with unbeatable comfort', 0, '57', '47', '17', '134', 'Square'),
(18, 'Oakley Evzero Path', 'USA', 'Plastic', 'M', 'Blue-Silver', 3, 2, '160.00', 2, 4, 'images/product/Oakley_Evzero_Path_1.jpg', 'images/product/Oakley_Evzero_Path_2.jpg', 'images/product/Oakley_Evzero_Path_3.jpg', 'The Oakley Evzero Path is a rimless multi-sport frame crafted from cutting edge O-matter. Sporting Plutonite lenses and Unobtanium earsocks, it provides supreme comfort with an ultralightweight build and crystal clear vision', 0, '54', '51', '26', '125', 'Wrap'),
(19, 'Oakley Milestone XS', 'USA', 'Plastic', 'M', 'Black', 3, 4, '116.00', 2, 1, 'images/product/Oakley_Milestone_XS_1.jpg', 'images/product/Oakley_Milestone_XS_2.jpg', 'images/product/Oakley_Milestone_XS_3.jpg', 'Made for pre-teens, the Oakley Milestone is a squarish NanO-matter frame, made for a lightweight feel and flexibility', 0, '47', '38', '17', '130', 'Square'),
(20, 'Oakley Carbon Plate', 'USA', 'Metal', 'M', 'Black-Red', 4, 3, '420.00', 2, 1, 'images/product/Oakley_Carbon_Plate_1.jpg', 'images/product/Oakley_Carbon_Plate_2.jpg', 'images/product/Oakley_Carbon_Plate_3.jpg', 'The Oakley Carbon plate is a sleek wrap-around frame crafted out of top-grade metal. With its argyle detail, thick bridge, and beefy arms, it provides the ultimate fit for the person who’s always on the go', 2, '55', '32', '18', '142', 'Rectangle'),
(21, 'Oakley Pitchman', 'USA', 'Plastic', 'L', 'Gray', 4, 3, '210.00', 2, 1, 'images/product/Oakley_Pitchman_1.jpg', 'images/product/Oakley_Pitchman_2.jpg', 'images/product/Oakley_Pitchman_3.jpg', 'The Oakley Pitchman is a wrap around frame that looks pure and to the point. Made from O Matter and sporting premium Hollowpoint hinge technology as well as lightweight steel temples, this frame is a walk-off homerun', 0, '55', '35', '18', '140', 'Rectangle-Square'),
(22, 'Oakley Tincup 0.5 Titanium', 'USA', 'Metal', 'M', 'Gunmetal', 4, 0, '324.00', 2, 1, 'images/product/Oakley_Tincup_0.5_Titanium_1.jpg', 'images/product/Oakley_Tincup_0.5_Titanium_2.jpg', 'images/product/Oakley_Tincup_0.5_Titanium_3.jpg', 'This is a stylish wrap-around frame that leaves no head unturned. Crafted with titanium and carbon fiber, it features adjustable temples, titanium hinges and ultra lightweight arms', 0, '53', '35', '18', '135', 'Rectangle'),
(23, 'Oakley Fives Square', 'USA', 'Plastic', 'M', 'Gray-Clear', 2, 3, '90.00', 2, 4, 'images/product/Oakley_Fives_Square_1.jpg', 'images/product/Oakley_Fives_Square_2.jpg', 'images/product/Oakley_Fives_Square_3.jpg', 'The Oakley Fives is a rectangle smart wrap-around frame crafted from lightweight O-matter. Sporting a rectangular shape, flexible arms and extra-grip nose pads, it is a perfect mix of ultimate comfort and sport-elegant style', 0, '54', '34', '20', '133', 'Rectangle-Wrap'),
(24, 'Oakley Holbrook R', 'USA', 'Plastic', 'M', 'Brown', 3, 0, '204.00', 2, 3, 'images/product/Oakley_Holbrook_R_1.jpg', 'images/product/Oakley_Holbrook_R_2.jpg', 'images/product/Oakley_Holbrook_R_3.jpg', 'The Oakley Holbrook R adds a bit of round to the popular style of sunglasses. Crafted from durable O-matter, it features a keyhole bridge for a retro style, Unobtainium nose pads and stem pads for absolute comfort', 0, '55', '45', '17', '140', 'Square'),
(25, 'Oakley Jacket 2.0', 'USA', 'Plastic', 'L', 'Black', 3, 5, '134.00', 2, 4, 'images/product/Oakley_Jacket_2.0_1.jpg', 'images/product/Oakley_Jacket_2.0_2.jpg', 'images/product/Oakley_Jacket_2.0_3.jpg', 'The Oakley Jacket 2.0 is a stylish wrap around frame that has got you covered. Crafted from Oakley’s signature “O-Matter,” it sports impact resistant lenses, Unobtanium earsocks and a super snug fit', 2, '62', '37', '15', '133', 'Wrap'),
(26, 'Oakley Catalyst', 'USA', 'Plastic', 'L', 'Gray', 3, 3, '150.00', 2, 3, 'images/product/Oakley_Catalyst_1.jpg', 'images/product/Oakley_Catalyst_2.jpg', 'images/product/Oakley_Catalyst_3.jpg', 'The Oakley Catalyst is a stylish, retro frame with an angular design. Crafted from durable and lightweight O-Matter, it sports muscular arms, Unobtainium earsocks and Oakley’s signature polarized lenses for a timeless, snug and clear fit', 0, '56', '44', '17', '144', 'Square'),
(27, 'Oakley Intention', 'USA', 'Plastic', 'M', 'Black-Blue-Tortoise', 3, 0, '170.00', 2, 1, 'images/product/Oakley_Intention_1.jpg', 'images/product/Oakley_Intention_2.jpg', 'images/product/Oakley_Intention_3.jpg', 'The Oakley Intention is a full-rim frame that tops off a sophisticated look. Crafted from premium acetate, it features a low single bridge, wire-core arms for durability and spring hinges for comfort', 1, '52', '35', '16', '136', 'Rectangle'),
(28, 'Oakley Tincup Carbon', 'USA', 'Metal', 'M', 'Black', 4, 0, '430.00', 2, 1, 'images/product/Oakley_Tincup_Carbon_1.jpg', 'images/product/Oakley_Tincup_Carbon_2.jpg', 'images/product/Oakley_Tincup_Carbon_3.jpg', 'The Oakley Tincup Carbon is a sleek wrap-around frame handcrafted from top-grade metal. With its weave detail, thick bridge, and muscular arms, it provides the ultimate fit for the person who’s always on the go', 2, '54', '34', '17', '135', 'Rectangle-Wrap'),
(29, 'Oakley Lizard 2', 'USA', 'Metal', 'M', 'Black', 3, 0, '174.00', 2, 1, 'images/product/Oakley_Lizard_2_1.jpg', 'images/product/Oakley_Lizard_2_2.jpg', 'images/product/Oakley_Lizard_2_3.jpg', 'The Oakley Lizard 2 is the next frame in the Lizard line, crafted from ultralightweight titanium. Made for comfort, it features flexible wire core arms and race-car inspired titanium hinges', 2, '51', '32', '18', '135', 'Rectangle'),
(30, 'Oakley Wingspan', 'USA', 'Metal', 'M', 'Gunmetal', 3, 1, '274.00', 2, 1, 'images/product/Oakley_Wingspan_1.jpg', 'images/product/Oakley_Wingspan_2.jpg', 'images/product/Oakley_Wingspan_3.jpg', 'The Oakley Wingspan is a rectangular frame made for comfort. Crafted from lightweight titanium, it features titanium-cases hinges, Unobtainium ear socks and adjustable nose pads for a secure & comfortable fit', 0, '53', '29', '17', '138', 'Rectangle'),
(31, 'Ray-Ban 3561 The General', 'USA', 'Gold', 'M', 'Blue', 1, 0, '0.00', 1, 4, 'https://static.glassesusa.com/media/catalog/product/7/8/7801_u.jpg', 'https://static.glassesusa.com/media/catalog/product/7/8/7801_f.jpg', 'https://static.glassesusa.com/media/catalog/product/7/8/7801_s.jpg', 'The Ray-Ban 3561 is a stylish oversized frame inspired by the classic aviator frames. Crafted from metal and featuring an ornate double-bridge and silicone nose-pads, it exudes a sense of adventure - in style.', 2, '57', '51', '17', '145', 'Square'),
(32, 'Ray-Ban 3561 The General', 'USA', 'Gold', 'M', 'Blue', 1, 0, '163.00', 1, 4, 'https://static.glassesusa.com/media/catalog/product/7/8/7801_u.jpg', 'https://static.glassesusa.com/media/catalog/product/7/8/7801_f.jpg', 'https://static.glassesusa.com/media/catalog/product/7/8/7801_s.jpg', 'The Ray-Ban 3561 is a stylish oversized frame inspired by the classic aviator frames. Crafted from metal and featuring an ornate double-bridge and silicone nose-pads, it exudes a sense of adventure - in style.', 2, '57', '51', '17', '145', 'Square'),
(33, 'Ray-Ban 3025 Classic Aviator', 'USA', 'Gold', 'M', 'Gold', 1, 0, '154.00', 1, 4, 'https://static.glassesusa.com/media/catalog/product/6/7/67032.jpg', 'https://static.glassesusa.com/media/catalog/product/6/7/6704-f_2-new.jpg', 'https://static.glassesusa.com/media/catalog/product/6/7/6704-f_2-new.jpg', 'The Ray-Ban 3025’s tear-shaped frame is a quirky play on the classic aviator style. With its double-bridge, thin yet durable frame, it is equally suited for cruising on a Chopper or at 35,000 feet altitude.', 2, '57', '51', '17', '145', 'Square'),
(34, 'Magnus', 'UK', 'Metal', 'M', 'Silver', 1, 0, '104.00', 1, 4, 'https://static.glassesusa.com/media/catalog/product/7/6/7675_u_1_1.jpg', 'https://static.glassesusa.com/media/catalog/product/7/6/7675_f_1_1.jpg', 'https://static.glassesusa.com/media/catalog/product/7/6/7675_s_1_1.jpg', 'The Magnus is a classic aviator frame with a modern twist. Crafted in lightweight monel, its double bridge and elegant arms flaunt a retro design with plenty of contemporary chic.', 2, '57', '51', '17', '145', 'Square');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siteinf`
--

CREATE TABLE IF NOT EXISTS `tbl_siteinf` (
  `name` varchar(255) NOT NULL,
  `icon_path` text,
  `logo_path` text,
  `address_api` text,
  `phone` varchar(20) DEFAULT NULL,
  `phone_international` varchar(20) DEFAULT NULL,
  `mail` varchar(30) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `tbl_siteinf`:
--

--
-- Truncate table before insert `tbl_siteinf`
--

TRUNCATE TABLE `tbl_siteinf`;
--
-- Dumping data for table `tbl_siteinf`
--

INSERT IGNORE INTO `tbl_siteinf` (`name`, `icon_path`, `logo_path`, `address_api`, `phone`, `phone_international`, `mail`) VALUES
('Eyeonic Glasses', '{baseUrl}/images/icon.png', '{baseUrl}/images/logo.png', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAOunf5Mwog0a2rZ9Ffa5HtqgKtiYRNP8g&callback=initMap', '165-234-7631', '1 512 402 8557', 'theneoteric@googlegroups.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mail` varchar(30) NOT NULL,
  `pw` varchar(255) DEFAULT '356a192b7913b04c54574d18c28d46e6395428ab',
  `full_name` varchar(50) NOT NULL,
  `phone_num` varchar(12) DEFAULT NULL,
  `user_type` smallint(5) UNSIGNED DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`),
  KEY `user_type` (`user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `tbl_users`:
--   `user_type`
--       `tbl_usertype` -> `id`
--

--
-- Truncate table before insert `tbl_users`
--

TRUNCATE TABLE `tbl_users`;
--
-- Dumping data for table `tbl_users`
--

INSERT IGNORE INTO `tbl_users` (`id`, `mail`, `pw`, `full_name`, `phone_num`, `user_type`, `country`, `address`, `city`) VALUES
(1, 'owner@mail.neot', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Arno Victor Dorian', '123456789', 1, NULL, '43 Thi Sach', NULL),
(2, 'admin@mail.neot', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Elise de La Serre', '0195278956', 2, NULL, NULL, NULL),
(3, 'user@mail.neot', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Nhac Tung', '0125089758', 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usertype`
--

CREATE TABLE IF NOT EXISTS `tbl_usertype` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `tbl_usertype`:
--

--
-- Truncate table before insert `tbl_usertype`
--

TRUNCATE TABLE `tbl_usertype`;
--
-- Dumping data for table `tbl_usertype`
--

INSERT IGNORE INTO `tbl_usertype` (`id`, `name`) VALUES
(1, 'owner'),
(2, 'admin'),
(3, 'user');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_cart_info`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_cart_info` (
`user_id` int(10) unsigned
,`product_id` int(10) unsigned
,`name` varchar(40)
,`price` decimal(5,2)
,`quantity` int(11)
,`total` decimal(37,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_ordermanage`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_ordermanage` (
`id` int(10) unsigned
,`customer` varchar(63)
,`phone` varchar(12)
,`address` text
,`product` varchar(53)
,`quantity` int(11)
,`notes` text
,`price` varbinary(40)
,`order_date` datetime
,`stt` smallint(6)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_ordermanage_admin`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_ordermanage_admin` (
`id` int(10) unsigned
,`customer` varchar(63)
,`phone` varchar(12)
,`address` text
,`product` text
,`quantity` text
,`price` blob
,`total_cost` varbinary(24)
,`notes` text
,`order_date` datetime
,`stt` smallint(6)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_cart_info`
--
DROP TABLE IF EXISTS `vw_cart_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_cart_info`  AS  select `tbl_cart`.`user_id` AS `user_id`,`tbl_cart`.`product_id` AS `product_id`,`tbl_products`.`name` AS `name`,`tbl_products`.`price` AS `price`,`tbl_cart`.`quantity` AS `quantity`,sum((`tbl_products`.`price` * `tbl_cart`.`quantity`)) AS `total` from (`tbl_cart` join `tbl_products`) where (`tbl_cart`.`product_id` = `tbl_products`.`id`) group by `tbl_cart`.`user_id`,`tbl_cart`.`product_id`,`tbl_products`.`name`,`tbl_products`.`price`,`tbl_cart`.`quantity` ;

-- --------------------------------------------------------

--
-- Structure for view `vw_ordermanage`
--
DROP TABLE IF EXISTS `vw_ordermanage`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_ordermanage`  AS  select `tbl_orders`.`id` AS `id`,concat(`tbl_orders`.`usr_id`,' - ',`tbl_users`.`full_name`) AS `customer`,`tbl_users`.`phone_num` AS `phone`,`tbl_orders`.`address` AS `address`,concat(`tbl_orderitem`.`prd_id`,' - ',`tbl_products`.`name`) AS `product`,`tbl_orderitem`.`quantity` AS `quantity`,`tbl_orders`.`notes` AS `notes`,concat('$',sum((`tbl_products`.`price` * `tbl_orderitem`.`quantity`))) AS `price`,`tbl_orderitem`.`order_date` AS `order_date`,`tbl_orders`.`stt` AS `stt` from (((`tbl_orders` join `tbl_orderitem` on((`tbl_orders`.`id` = `tbl_orderitem`.`order_id`))) join `tbl_users` on((`tbl_orders`.`usr_id` = `tbl_users`.`id`))) join `tbl_products` on((`tbl_orderitem`.`prd_id` = `tbl_products`.`id`))) group by `tbl_orders`.`id`,concat(`tbl_orders`.`usr_id`,' - ',`tbl_users`.`full_name`),concat(`tbl_orderitem`.`prd_id`,' - ',`tbl_products`.`name`) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_ordermanage_admin`
--
DROP TABLE IF EXISTS `vw_ordermanage_admin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_ordermanage_admin`  AS  select `vw_ordermanage`.`id` AS `id`,`vw_ordermanage`.`customer` AS `customer`,`vw_ordermanage`.`phone` AS `phone`,`vw_ordermanage`.`address` AS `address`,group_concat(`vw_ordermanage`.`product` separator '(newline)') AS `product`,group_concat(`vw_ordermanage`.`quantity` separator '(newline)') AS `quantity`,group_concat(`vw_ordermanage`.`price` separator '(newline)') AS `price`,concat('$',sum(substr(`vw_ordermanage`.`price`,2))) AS `total_cost`,`vw_ordermanage`.`notes` AS `notes`,`vw_ordermanage`.`order_date` AS `order_date`,`vw_ordermanage`.`stt` AS `stt` from `vw_ordermanage` group by `vw_ordermanage`.`id`,`vw_ordermanage`.`customer` ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_Cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`),
  ADD CONSTRAINT `tbl_Cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`id`);

--
-- Constraints for table `tbl_orderitem`
--
ALTER TABLE `tbl_orderitem`
  ADD CONSTRAINT `tbl_OrderItem_ibfk_1` FOREIGN KEY (`prd_id`) REFERENCES `tbl_products` (`id`),
  ADD CONSTRAINT `tbl_OrderItem_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `tbl_orders` (`id`);

--
-- Constraints for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD CONSTRAINT `tbl_Orders_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `tbl_users` (`id`);

--
-- Constraints for table `tbl_order_clense`
--
ALTER TABLE `tbl_order_clense`
  ADD CONSTRAINT `tbl_order_clense_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tbl_orders` (`id`),
  ADD CONSTRAINT `tbl_order_clense_ibfk_2` FOREIGN KEY (`clense_id`) REFERENCES `tbl_contact_lense` (`id`);

--
-- Constraints for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD CONSTRAINT `tbl_Products_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `tbl_brands` (`id`),
  ADD CONSTRAINT `tbl_Products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`id`);

--
-- Constraints for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `tbl_Users_ibfk_1` FOREIGN KEY (`user_type`) REFERENCES `tbl_usertype` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
