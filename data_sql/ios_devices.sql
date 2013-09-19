-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 09 月 19 日 13:31
-- 服务器版本: 5.5.24-log
-- PHP 版本: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `kunting`
--

-- --------------------------------------------------------

--
-- 表的结构 `ios_devices`
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
  UNIQUE KEY `DeviceToken` (`device_token`),
  KEY `DeviceToken_test` (`device_token`,`is_test_device`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='apns的设备记录' AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `ios_devices`
--

INSERT INTO `ios_devices` (`device_id`, `device_token`, `date_created`, `is_test_device`, `device_notes`, `launch_count`, `push_count`) VALUES
(1, '435c4ee00e7c3ccd3ea4fa28818acfc623928f56aba05714c170f5cb306ef712', '2013-09-17 08:58:27', 1, ' zh', 0, 0),
(5, 'e79ded2f67ff345e02c3eb8c5655833f666a7f6f929671e80111da606f12aaa5', '2013-09-18 04:32:38', 1, ' ', 1, 0),
(6, '06ca2d69b3d9e2d85bc62a66a949f9b23ee314453288222f92ea4e9223dcc6d6', '2013-09-19 10:00:00', 1, ' ', 0, 0),
(7, '46ae1e90d14369d631692b850068ec2580bbfa2ebf02874aee29de56ca103b20', '2013-09-19 10:00:00', 1, ' ', 0, 0),
(8, '2b0f0b347950425f0af56659c3b7d9b838535d8250bedae4b882df8436860af5', '2013-09-19 10:00:12', 1, ' ', 0, 0),
(10, '33352e6f8ad54895a1a77927090622f6172f3fab1e918014beb6ad3d5e0cda8c', '2013-09-19 10:00:19', 1, ' ', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
