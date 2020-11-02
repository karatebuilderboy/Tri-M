-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2018 at 08:05 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trim`
--
CREATE DATABASE IF NOT EXISTS `trim` DEFAULT CHARACTER SET utf16 COLLATE utf16_unicode_ci;
USE `trim`;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventId` smallint(5) UNSIGNED NOT NULL,
  `name` tinytext COLLATE utf16_unicode_ci,
  `date` date DEFAULT NULL,
  `startTime` time DEFAULT NULL,
  `endTime` time DEFAULT NULL,
  `address` text COLLATE utf16_unicode_ci,
  `eventCoordinator` text COLLATE utf16_unicode_ci,
  `maxSlots` tinyint(4) NOT NULL DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventId`, `name`, `date`, `startTime`, `endTime`, `address`, `eventCoordinator`, `maxSlots`) VALUES
(1, 'BMMS Winter Concert', '2018-11-27', '18:30:00', '21:30:00', '4300 Centennial Lane\r\nEllicott City, MD 21042', '', 20);

-- --------------------------------------------------------

--
-- Table structure for table `signups`
--

CREATE TABLE `signups` (
  `signupId` tinyint(3) UNSIGNED NOT NULL,
  `eventId` smallint(5) UNSIGNED NOT NULL,
  `name` tinytext COLLATE utf16_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `signups`
--

INSERT INTO `signups` (`signupId`, `eventId`, `name`) VALUES
(1, 1, 'Spongebob Squarepants'),
(2, 1, 'Squidward Tentacles'),
(3, 1, 'Patrick Star'),
(4, 1, 'Sandy Cheeks'),
(5, 1, 'Eugene Krabs'),
(6, 1, 'Gary Something');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventId`);

--
-- Indexes for table `signups`
--
ALTER TABLE `signups`
  ADD PRIMARY KEY (`signupId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventId` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `signups`
--
ALTER TABLE `signups`
  MODIFY `signupId` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
