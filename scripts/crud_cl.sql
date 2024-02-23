-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2024 at 04:19 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud_cl`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `aid` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `address` varchar(510) NOT NULL,
  `country` varchar(110) NOT NULL,
  `state` varchar(110) NOT NULL,
  `pincode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`aid`, `employee_id`, `address`, `country`, `state`, `pincode`) VALUES
(10, 29, 'I2,515,GOVT.QUARTERS,NEW RTO ROAD,SADAR BAZAAR', 'dfs', 'Maharashtra', 415001),
(11, 30, 'I2,515,GOVT.QUARTERS,NEW RTO ROAD,SADAR BAZAAR', 'dfs', 'Maharashtra', 415001),
(12, 31, 'I2,515,GOVT.QUARTERS,NEW RTO ROAD,SADAR BAZAAR', 'dfs', 'Maharashtra', 415001),
(13, 32, 'I2,515,GOVT.QUARTERS,NEW RTO ROAD,SADAR BAZAAR', 'dfs', 'Maharashtra', 415001),
(14, 33, 'I2,515,GOVT.QUARTERS,NEW RTO ROAD,SADAR BAZAAR', 'asa', 'Maharashtra', 415001),
(15, 34, 'I2,515,GOVT.QUARTERS,NEW RTO ROAD,SADAR BAZAAR', 'ada', 'Maharashtra', 415001),
(16, 35, 'thane, mumbai, sjkbdjks', 'india', 'Maharashtra', 415001),
(17, 36, 'I2,515,GOVT.QUARTERS,NEW RTO ROAD,SADAR BAZAARw', 'awqwww', 'Mahaww', 415001),
(18, 37, 'I2,515,GOVT.QUARTERS,NEW RTO ROAD,SADAR BAZAAR', 'dfs', 'Maharashtra', 415001),
(19, 38, 'I2,515,GOVT.QUARTERS,NEW RTO ROAD,SADAR BAZAAR', 'awqw', 'Maharashtra', 415001),
(20, 39, 'I2,515,GOVT.QUARTERS,NEW RTO ROAD,SADAR BAZAAR', 'awqwww', 'Maharashtra', 415001),
(21, 40, 'I2,515,GOVT.QUARTERS,NEW RTO ROAD,SADAR BAZAAR', 'awqw', 'Maharashtra', 415001),
(22, 41, 'I2,515,GOVT.QUARTERS,NEW RTO ROAD,SADAR BAZAAR', 'dfs', 'Maharashtra', 415001),
(23, 42, 'I2,515,GOVT.QUARTERS,NEW RTO ROAD,SADAR BAZAAR', 'asdasd', 'Maharashtra', 415001);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `eid` int(10) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `mname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `gender` enum('Male','Female','Others') NOT NULL,
  `mail` varchar(30) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `dob` varchar(30) NOT NULL,
  `pic` varchar(500) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`eid`, `fname`, `mname`, `lname`, `gender`, `mail`, `contact`, `dob`, `pic`, `status`) VALUES
(29, 'SHUBHAM PRADEEP BHOSALE', 'sd', 'asas', 'Male', 'shubhampbhosale1999@gmail.com', '9146809186', '2024-02-01', 'C:fakepath(766) New 25+ Anime Skin Presets for Tower of Fantasy Part 3 - YouTube - Google Chrome 12-08-2022 04_34_06 PM.png', 1),
(30, 'siddu', 'asaS', 'AsAS', 'Male', 'shubhampbhSSSosale1999@gmail.c', '9146809186', '2024-02-02', 'C:fakepath(766) These ASSETS for Character Creation are Legit in Tower of Fantasy - YouTube - Google Chrome 12-08-2022 04_14_59 PM.png', 1),
(31, 'siddu', 'DSD', 'SDS', 'Male', 'shubhampbhosalSe1999@gmail.com', '9146809186', '2024-02-22', 'C:fakepathHonkai_ Star Rail 10-02-2024 20_11_02.png', 1),
(32, 'siddu', 'sd', 'asas', 'Female', 'shubhampbhsale1999@gmail.com', '9146809186', '2024-02-09', 'C:fakepath(3346) TOP 5 SECRETS OF ENKANOMIYA YOU PROBABLY MISSED _ GENSHIN IMPACT - YouTube - Google Chrome 16-01-2024 00_36_42.png', 1),
(33, 'SHUBHAM PRADEEP BHOSALE', 'sdfs', 'sdfds', 'Female', 'shubhampbhosaleds1999@gmail.co', '9146809186', '2024-02-02', 'C:fakepath(401) Kokomi Theme Music 1 HOUR - A Thousand Waves Under the Moon (tnbee mix) _ Genshin Impact - YouTube - Google Chrome 03-10-2021 08_02_14 PM.png', 1),
(34, 'siddudsasdssdsdsd', 'asdasd', 'sadd', 'Male', 'shubhampbdddhosale1999@gmail.c', '9146809186', '2024-02-02', 'C:fakepath80d625871df049ee7746a0dde7177baa.jpg', 1),
(35, 'shivraju', 'raj', 'khulape', 'Others', 'siddu1999@gmail.com', '7709231184', '2024-02-01', 'C:fakepathWhatsApp Image 2023-12-08 at 9.14.03 PM.jpeg', 0),
(36, 'nidhi', 'ram', 'dod', 'Female', 'asaa@gmail.com', '9146809186', '2024-02-01', 'C:fakepath80d625871df049ee7746a0dde7177baa.jpg', 0),
(37, 'smita', 'raj', 'menkar', 'Male', 'bhosale1999@gmail.com', '9146809186', '2024-02-01', 'C:fakepath80d625871df049ee7746a0dde7177baa.jpg', 0),
(38, 'siddesh', 'sd', 'sdfds', 'Male', 'e1999@gmail.com', '9146809186', '2024-02-02', 'C:fakepath80d625871df049ee7746a0dde7177baa.jpg', 0),
(39, 'siddu', 'asds', 'ad', 'Female', 'hosale1999@gmail.com', '9146809186', '2024-02-02', 'C:fakepath80d625871df049ee7746a0dde7177baa.jpg', 0),
(40, 'siddu', 'sd', 'asas', 'Male', 'shubhampbhosale9@gmail.com', '9146809186', '2024-02-09', 'C:fakepath80d625871df049ee7746a0dde7177baa.jpg', 1),
(41, 'FileName', 'fsdf', 'sfsf', 'Female', '199@gmail.com', '9146809186', '2024-02-02', 'C:fakepath80d625871df049ee7746a0dde7177baa.jpg', 1),
(42, 'sds', 'asdasd', 'adasd', 'Female', 'shubhampbhosaleadasd1999@gmail', '9146809186', '2024-02-09', 'C:fakepath80d625871df049ee7746a0dde7177baa.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `address_ibfk_1` (`employee_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`eid`),
  ADD UNIQUE KEY `u_mail` (`mail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `eid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`eid`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
