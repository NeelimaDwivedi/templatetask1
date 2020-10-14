-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2020 at 09:45 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `templatetask`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryid` varchar(50) NOT NULL,
  `categoryname` varchar(100) NOT NULL,
  `description` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryid`, `categoryname`, `description`) VALUES
('101', 'Men', 'items related to mens'),
('102', 'Women', 'items related to women'),
('103', 'Sport', 'items related to sports'),
('104', 'Kids', 'items related to kids'),
('105', 'Fashion', 'Fashion item');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `cartdata` varchar(400) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `pimage` varchar(400) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `pprice` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `tag` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pimage`, `pname`, `pprice`, `category`, `tag`, `description`) VALUES
(1, 'upld/basketball.png', 'Basketball', 150, 'Men', 'Sports', 'Basketball for sports'),
(2, 'upld/football.png', 'Football', 120, 'Men', 'Sports', 'Football for sports'),
(3, 'upld/soccer.png', 'Soccer', 140, 'Men', 'Sports', 'Soccer for sports'),
(13, 'upld/table-tennis.png', 'Table-tennis ball', 120, 'Sport', 'Ecommerce,Shop,', 'Table-tenis for sports'),
(16, 'upld/tennis.png', 'Tennis ball', 140, 'Sport', 'Ecommerce,Shop,', 'sport games');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tagid` varchar(40) NOT NULL,
  `tagname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tagid`, `tagname`) VALUES
('001', 'Ecommerce'),
('002', 'Fashion'),
('003', 'Laptop'),
('004', 'Accessories'),
('005', 'Handbags'),
('006', 'Cosmetics');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `uname`, `dob`, `address`, `email`, `password`, `role`) VALUES
(1, 'Neelima Dwivedi', '1999-09-03', 'B 47 b block sector 56 noida\r\npanchsheel colony', 'dwivedineelima62@gmail.com', 'neelima', ''),
(2, 'test', '2020-10-13', 'B 47 b block sector 56 noida\r\npanchsheel colony', 'test@localhost.com', 'test', ''),
(3, 'root', '2002-01-14', 'B 47 b block sector 56 Noida', 'root@localhost.com', 'root', 'user'),
(4, 'admin', '2020-10-28', 'B 47 b block sector 56 Noida', 'admin@localhost.com', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`),
  ADD UNIQUE KEY `categoryid` (`categoryid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tagid`),
  ADD UNIQUE KEY `tagid` (`tagid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
