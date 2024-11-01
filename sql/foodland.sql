-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2021 at 03:48 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodland`
--

-- --------------------------------------------------------

--
-- Table structure for table `breakfast`
--

CREATE TABLE `breakfast` (
  `id` int(11) NOT NULL,
  `day` varchar(20) DEFAULT NULL,
  `dish` varchar(20) DEFAULT NULL,
  `item` varchar(50) DEFAULT NULL,
  `price` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `breakfast`
--

INSERT INTO `breakfast` (`id`, `day`, `dish`, `item`, `price`) VALUES
(1, 'Mon', 'UPAMA', 'images/14.jpeg', 30),
(2, 'Tue', 'ALOO PARATHA', 'images/12.jpeg', 30),
(3, 'Wed', 'IDALI', 'images/16.jpeg', 30),
(4, 'Thu', 'POHA', 'images/', 30),
(5, 'Fri', 'THEPALA', 'images/13.jpeg', 40),
(6, 'Sat', 'ALOO PARATHA', 'images/12.jpeg', 30);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `srno` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `Item_id` varchar(100) NOT NULL,
  `count` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lunch`
--

CREATE TABLE `lunch` (
  `id` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `dishes` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lunch`
--

INSERT INTO `lunch` (`id`, `day`, `dishes`) VALUES
(1, 'Mon', 'Dal,Vegeable(Drt & G'),
(2, 'Tue', 'Dal,Vegeable(Drt & G'),
(3, 'Wed', 'Kadhi,Vegetable(Dry '),
(4, 'Thu', 'Dal,Vegetable(Gravy)'),
(5, 'Fri', 'Mix Dal,Panjabi Veg,'),
(6, 'Sat', 'Dal,Vegeable(Drt & G'),
(7, 'Sun', 'Dal,Vegetable(Dry & ');

-- --------------------------------------------------------

--
-- Table structure for table `mstcustomer`
--

CREATE TABLE `mstcustomer` (
  `srno` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `custname` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `createdts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mstcustomer`
--

INSERT INTO `mstcustomer` (`srno`, `email`, `username`, `custname`, `password`, `createdts`) VALUES
(1, 'utkarsh.verma9598@gmail.com', 'admin', 'utkarsh verma', '$2y$10$0PvjlgR8F1YSpVWtjC3TsOzXgdXVtn7FlAmDzdLNKlt0y6QTlP86i', '2021-10-13 23:51:46'),
(3, 'yisem71618@ismailgul.net', 'utkarsh', 'elen jansen', '$2y$10$LHMyHwoDSBeW.HndijA1ce3ghJX4b5cbcoiVlf.YpnSE/6XvyLhrO', '2021-10-15 23:55:24'),
(4, 'yisem71618@ismailgul.net', 'admin', 'elen jansen', '$2y$10$MgFe2ZqeFQqCjPQGqANluumyejpX.z9j27VH.mTUTcrYMAoNIBZSC', '2021-11-25 02:41:13');

-- --------------------------------------------------------

--
-- Table structure for table `mstitem`
--

CREATE TABLE `mstitem` (
  `id` int(10) NOT NULL,
  `itemname` varchar(100) NOT NULL,
  `rate` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mstitem`
--

INSERT INTO `mstitem` (`id`, `itemname`, `rate`) VALUES
(1, 'Aloo Paratha', 90),
(2, 'Bread Pakoda', 35),
(3, 'Dhokla', 35),
(4, 'Idli', 35),
(5, 'Lunch', 80),
(6, 'Masala Rice', 35),
(7, 'Muthia - Duddhi', 35),
(8, 'Poha', 35),
(9, 'Sabji - Mix Veg', 100),
(10, 'Sabji - Paneer', 150),
(11, 'Thepla (1P)', 10),
(12, 'Thepla (3P)', 35),
(13, 'Upma', 35);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `emailid` varchar(100) NOT NULL,
  `createdts` datetime NOT NULL,
  `cancelledts` datetime DEFAULT NULL,
  `delivery_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `itemid`, `qty`, `rate`, `amount`, `emailid`, `createdts`, `cancelledts`, `delivery_dt`) VALUES
(56, 10, 1, 150, 150, 'utkarsh.verma9598@gmail.com', '2021-10-10 21:33:28', '2021-10-19 22:04:01', '2021-10-19 22:03:28'),
(57, 12, 19, 35, 665, 'utkarsh.verma9598@gmail.com', '2021-10-19 21:39:34', NULL, '2021-10-19 22:09:34'),
(58, 3, 1, 35, 35, 'utkarsh.verma9598@gmail.com', '2021-10-19 21:39:34', NULL, '2021-10-19 22:09:34'),
(59, 6, 2, 35, 70, 'utkarsh.verma9598@gmail.com', '2021-10-19 21:39:34', NULL, '2021-10-19 22:09:34'),
(60, 8, 1, 35, 35, 'utkarsh.verma9598@gmail.com', '2021-10-19 21:39:34', NULL, '2021-10-19 22:09:34'),
(61, 7, 1, 35, 35, 'utkarsh.verma9598@gmail.com', '2021-10-23 21:39:34', NULL, '2021-10-19 22:09:34'),
(62, 10, 1, 150, 150, 'utkarsh.verma9598@gmail.com', '2021-10-19 21:39:34', NULL, '2021-10-19 22:09:34'),
(63, 13, 3, 35, 105, 'utkarsh.verma9598@gmail.com', '2021-10-19 21:39:34', NULL, '2021-10-19 22:09:34'),
(64, 10, 1, 150, 150, 'utkarsh.verma9598@gmail.com', '2021-10-27 06:53:15', NULL, '2021-10-20 07:23:15'),
(78, 5, 5, 544, 555, 'hello@hhf.fkjf', '2021-10-27 08:14:12', NULL, '0000-00-00 00:00:00'),
(79, 10, 2, 150, 300, 'utkarsh.verma9598@gmail.com', '2021-10-20 09:16:46', NULL, '2021-10-20 09:46:46'),
(80, 8, 2, 35, 70, 'utkarsh.verma9598@gmail.com', '2021-10-20 09:16:46', NULL, '2021-10-20 09:46:46'),
(81, 7, 2, 35, 70, 'utkarsh.verma9598@gmail.com', '2021-10-20 09:16:46', NULL, '2021-10-20 09:46:46'),
(82, 7, 2, 35, 70, 'yisem71618@ismailgul.net', '2021-10-20 09:26:24', '2021-10-20 09:26:32', '2021-10-20 09:56:24'),
(83, 6, 16, 35, 560, 'yisem71618@ismailgul.net', '2021-10-20 09:26:24', NULL, '2021-10-20 09:56:24'),
(84, 1, 1, 90, 90, 'yisem71618@ismailgul.net', '2021-10-20 09:26:24', NULL, '2021-10-20 09:56:24'),
(85, 6, 4, 35, 140, 'utkarsh.verma9598@gmail.com', '2021-11-25 07:23:34', '2021-11-25 08:13:12', '2021-11-25 07:53:34'),
(86, 2, 1, 35, 35, 'utkarsh.verma9598@gmail.com', '2021-11-25 08:12:25', NULL, '2021-11-25 08:42:25'),
(87, 3, 1, 35, 35, 'utkarsh.verma9598@gmail.com', '2021-11-25 08:17:54', NULL, '2021-11-25 08:47:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `breakfast`
--
ALTER TABLE `breakfast`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `lunch`
--
ALTER TABLE `lunch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mstcustomer`
--
ALTER TABLE `mstcustomer`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `mstitem`
--
ALTER TABLE `mstitem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `breakfast`
--
ALTER TABLE `breakfast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lunch`
--
ALTER TABLE `lunch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mstcustomer`
--
ALTER TABLE `mstcustomer`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mstitem`
--
ALTER TABLE `mstitem`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
