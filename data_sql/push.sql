-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 07 月 18 日 16:50
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
-- 表的结构 `push`
--

CREATE TABLE IF NOT EXISTS `push` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `content` text,
  `command` varchar(32) DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `last_push_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
