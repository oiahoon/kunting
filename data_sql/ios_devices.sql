-- phpMyAdmin SQL Dump
-- version 4.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 18, 2013 at 05:57 PM
-- Server version: 5.5.32-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kunting`
--

-- --------------------------------------------------------

--
-- Table structure for table `ios_devices`
--

CREATE TABLE IF NOT EXISTS `ios_devices` (
  `device_id` int(32) NOT NULL AUTO_INCREMENT,
  `device_token` varchar(71) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_test_device` tinyint(1) NOT NULL DEFAULT '0',
  `device_notes` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT ' ',
  `launch_count` int(11) NOT NULL DEFAULT '0',
  `push_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`device_id`),
  KEY `DeviceToken` (`device_token`),
  KEY `DeviceToken_test` (`device_token`,`is_test_device`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='apns的设备记录' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ios_devices`
--

INSERT INTO `ios_devices` (`device_id`, `device_token`, `date_created`, `is_test_device`, `device_notes`, `launch_count`, `push_count`) VALUES
(1, '435c4ee00e7c3ccd3ea4fa28818acfc623928f56aba05714c170f5cb306ef712', '2013-09-17 08:58:27', 1, ' zh', 0, 0),
(5, 'e79ded2f67ff345e02c3eb8c5655833f666a7f6f929671e80111da606f12aaa5', '2013-09-18 04:32:38', 0, ' ', 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
