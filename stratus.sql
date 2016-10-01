-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2016 at 06:13 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stratus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `udid` int(6) NOT NULL,
  `uid` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`udid`, `uid`) VALUES
(1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `Name` varchar(64) NOT NULL,
  `Value` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`Name`, `Value`) VALUES
('storeName', 'Stratus'),
('secretCode', 'deviant');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `uid` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`uid`, `email`, `count`) VALUES
(9, 'demouser@stratus.com', 8),
(10, 'thisisanemail@email.com', 9),
(11, 'thisisanemail@email.com', 10),
(12, 'thisisanemail@email.com', 11),
(13, 'thisisanemail@email.com', 12),
(16, 'email@email.com', 15),
(17, 'email@email.com', 16);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `itemCode` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` varchar(128) DEFAULT NULL,
  `onSale` int(1) NOT NULL,
  `inStock` tinyint(1) NOT NULL,
  `isParent` int(1) NOT NULL,
  `price` varchar(16) NOT NULL,
  `data` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`itemCode`, `name`, `description`, `onSale`, `inStock`, `isParent`, `price`, `data`) VALUES
(1, 'bubblemint', 'Tastes like bubblegum, tingles like mint!', 0, 1, 0, '6.99', ''),
(2, 'lazarus', 'A great flavor, back from the dead.', 0, 1, 0, '17.99', ''),
(3, 'butt', 'I have no idea what this is supposed to be.', 0, 0, 0, '69.69', ''),
(4, 'test', 'testytesytetsey', 0, 1, 0, '00.00', ''),
(5, 'Chocorush', 'A flood of your favorite coco cereal!', 0, 1, 0, '123.45', '');

-- --------------------------------------------------------

--
-- Table structure for table `tagdir`
--

CREATE TABLE `tagdir` (
  `tdid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tagdir`
--

INSERT INTO `tagdir` (`tdid`, `tid`, `pid`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 5),
(6, 2, 3),
(7, 1, 4),
(8, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tid`, `name`) VALUES
(1, 'juice'),
(2, 'hardware');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `uid` int(6) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`uid`, `token`) VALUES
(0, 'd05230cabaafcf86f6ef84c32ece0e34'),
(16, '60a62a131f631ac9afc7686bb5096709'),
(17, '8aa205eaf51c44becffde0fdf3d8647e');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(22) NOT NULL,
  `hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `hash`) VALUES
(9, 'demouser', '$2y$10$9bOeSCITeP5nK0KzKnHvLOv90301GxupJu4AfAWFE7reifBJeGzvC'),
(10, 'testuser', '$2y$10$qJuJVxlXgLJUZ/BnMAEK7uVVua93hvs390Xqw8Ol1SxnKCrjgQTke'),
(11, 'testuser2', '$2y$10$z680N2fsdQUfK5KMMgBq2.FpBPvvEHfgu9nF7XdQYXz4LakMoRQvO'),
(12, 'testuser3', '$2y$10$aXrl/2gyAGVTSojvNbRhDu3vjVA7mw3aIQKJZ/6PL8YSnbuLpnS2i'),
(13, 'testuser4', '$2y$10$srqSh3gUJIP3Ob9ZKP/TAen67zoVYN06eDcj7UHbAt1gc/s0hds4u'),
(16, 'testuser9', '$2y$10$E0SEx8dU1QJqSbPUeUdbjuI8mSYoHsVbEZbq8YTkFN.u608U1eGh.'),
(17, 'coleTestAcct', '$2y$10$X8ccp.5xEfAkR.vywROCbeixH53iU.iPky.PqqMyDM0CsFRmqWyI.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`udid`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`count`),
  ADD KEY `count` (`count`),
  ADD KEY `uid` (`uid`),
  ADD KEY `count_2` (`count`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`itemCode`),
  ADD KEY `itemCode` (`itemCode`);

--
-- Indexes for table `tagdir`
--
ALTER TABLE `tagdir`
  ADD PRIMARY KEY (`tdid`),
  ADD KEY `tid` (`tid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `udid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `count` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `itemCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tagdir`
--
ALTER TABLE `tagdir`
  MODIFY `tdid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tagdir`
--
ALTER TABLE `tagdir`
  ADD CONSTRAINT `tagdir_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `inventory` (`itemCode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tagdir_ibfk_2` FOREIGN KEY (`tid`) REFERENCES `tags` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
