-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2020 at 06:43 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(15) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`) VALUES
(1, 'Optimum Nutrition'),
(2, 'MuscleTech'),
(3, 'Gymshark'),
(4, 'Cellucor'),
(5, 'Gaspari Nutrition');

-- --------------------------------------------------------

--
-- Table structure for table `origin`
--

CREATE TABLE `origin` (
  `id` int(15) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `origin`
--

INSERT INTO `origin` (`id`, `name`) VALUES
(1, 'vegan'),
(2, 'not vegan');

-- --------------------------------------------------------

--
-- Table structure for table `suplements`
--

CREATE TABLE `suplements` (
  `id` int(15) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` int(15) NOT NULL,
  `company` int(15) NOT NULL,
  `user` int(15) NOT NULL,
  `supplementType` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suplements`
--

INSERT INTO `suplements` (`id`, `name`, `price`, `company`, `user`, `supplementType`) VALUES
(9, 'Whey Protein', 50, 3, 5, 2),
(11, 'Omega-3', 40, 5, 5, 2),
(14, 'PROTA', 44, 2, 14, 1),
(19, 'Omega-3', 45, 3, 6, 1),
(21, 'Whey Protein', 50, 4, 8, 2),
(22, 'Creatinez', 45, 2, 9, 1),
(23, 'Roids', 150, 3, 5, 2),
(26, 'prota', 22, 4, 7, 1),
(51, 'Iglica', 33, 2, 12, 1),
(74, 'Creatin', 152, 1, 7, 1),
(79, 'sarms', 33, 1, 6, 1),
(80, 'Sarms', 123, 1, 7, 2),
(82, 'IsolateWhey', 55, 4, 12, 1),
(83, 'VeganProtein', 123, 5, 12, 1),
(84, 'Omega3', 42, 3, 12, 1),
(199, 'PEDS', 54, 1, 7, 1),
(212, 'Gains', 2, 1, 7, 2),
(214, 'steroids', 111, 1, 7, 1),
(218, 'Omega3Acid', 54, 1, 37, 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(15) NOT NULL,
  `user` int(15) NOT NULL,
  `supplement` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `user`, `supplement`) VALUES
(6, 5, 9),
(8, 14, 11),
(13, 24, 23),
(18, 21, 51),
(27, 21, 19),
(61, 12, 79),
(62, 12, 74),
(63, 12, 199),
(67, 37, 212);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(15) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'user'),
(2, 'admin'),
(3, 'banned');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(15) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `type` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `type`) VALUES
(4, 'damjan', '123', 1),
(5, 'Lionardo', '123', 1),
(6, 'Leonidas I', 'THISISSPARTA', 2),
(7, 'admin', 'admin', 2),
(8, 'Bred ', '123', 1),
(9, 'Bobo', '123', 1),
(12, 'Dado', 'dado', 1),
(14, 'User', 'user', 1),
(15, 'Nani', '123', 3),
(16, 'haj', '123', 3),
(18, 'mrs', 'mrs', 3),
(19, 'nzm', 'nzm', 3),
(20, 'aok', 'aok', 3),
(21, 'Dedi', '123', 1),
(24, 'Bajo', 'bajo', 3),
(25, 'Dale', '123456', 1),
(26, 'Das', '123456', 1),
(27, 'Be', '123456', 1),
(28, 'Tito', '123456', 1),
(29, 'Wut', '123456', 1),
(30, 'dekile', 'dekile', 3),
(31, 'uros', 'uros123', 3),
(32, 'Luka', 'luka12', 1),
(33, 'Tester', 'tester', 1),
(34, 'Tester1', 'tester1', 1),
(35, 'Final', 'final', 3),
(36, 'Aleks', 'aleks12', 1),
(37, 'Dedile', 'dedile', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `origin`
--
ALTER TABLE `origin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `suplements`
--
ALTER TABLE `suplements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company` (`company`,`user`),
  ADD KEY `user` (`user`),
  ADD KEY `supplementType` (`supplementType`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `supplement` (`supplement`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `origin`
--
ALTER TABLE `origin`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suplements`
--
ALTER TABLE `suplements`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `suplements`
--
ALTER TABLE `suplements`
  ADD CONSTRAINT `suplements_ibfk_1` FOREIGN KEY (`company`) REFERENCES `company` (`id`),
  ADD CONSTRAINT `suplements_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `suplements_ibfk_3` FOREIGN KEY (`supplementType`) REFERENCES `origin` (`id`);

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `supplier_ibfk_2` FOREIGN KEY (`supplement`) REFERENCES `suplements` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`type`) REFERENCES `type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
