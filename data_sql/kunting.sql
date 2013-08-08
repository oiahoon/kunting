-- phpMyAdmin SQL Dump
-- version 4.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 08, 2013 at 02:54 PM
-- Server version: 5.5.32-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kunting_import`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_group`
--

DROP TABLE IF EXISTS `admin_group`;
CREATE TABLE IF NOT EXISTS `admin_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(32) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin_group`
--

INSERT INTO `admin_group` (`id`, `group_name`, `order`) VALUES
(1, '鹳狸猿', 1),
(2, '普通用户', 2);

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `group_id` int(11) NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `group_id`, `last_login`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, '2013-08-05 03:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `alias` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `alias`) VALUES
(1, '资讯', 'articles'),
(2, '活动', 'actions'),
(3, '团购', 'groupbuy');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
CREATE TABLE IF NOT EXISTS `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact` varchar(64) DEFAULT ' ',
  `username` varchar(32) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` int(13) DEFAULT NULL,
  `content` text,
  `version` varchar(40) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone` decimal(13,0) NOT NULL,
  `type` enum('actions','groupbuy') DEFAULT NULL COMMENT '类型',
  `objectid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone_obj` (`phone`,`objectid`) COMMENT '电话-活动'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `member_activity`
--

DROP TABLE IF EXISTS `member_activity`;
CREATE TABLE IF NOT EXISTS `member_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL COMMENT '用户id',
  `category_id` int(11) NOT NULL COMMENT '类型id（活动/团购..）',
  `object_id` int(11) NOT NULL COMMENT '具体活动的id',
  PRIMARY KEY (`id`),
  UNIQUE KEY `m_c_o` (`member_id`,`category_id`,`object_id`) COMMENT '参加一次统一个活动'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `title_2nd` varchar(64) NOT NULL,
  `content_id` int(11) NOT NULL,
  `holding_date` date DEFAULT '2000-00-00' COMMENT '活动举办时间',
  `begin_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '活动开始日期',
  `end_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '活动截止日期',
  `create_date` datetime NOT NULL,
  `author` varchar(32) NOT NULL,
  `imagecover` varchar(64) DEFAULT '' COMMENT '封面图片',
  `imagetitle` varchar(64) DEFAULT '',
  `orders` int(11) NOT NULL DEFAULT '9' COMMENT '置顶用排序',
  `short_link` varchar(64) DEFAULT '',
  `top` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `push`
--

DROP TABLE IF EXISTS `push`;
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

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(32) NOT NULL,
  `value` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'groupbuy_s', '1'),
(2, 'emailusername', '4296411@qq.com'),
(3, 'emailpassword', '19870511'),
(4, 'emailsubject', '昆庭'),
(5, 'emailhost', 'smtp.qq.com'),
(6, 'systemuser', 'admin'),
(7, 'systempassword', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL DEFAULT 'New Bee',
  `password` varchar(42) NOT NULL,
  `status` int(5) NOT NULL DEFAULT '1',
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reset_key` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `email`, `username`, `password`, `status`, `reg_date`, `reset_key`) VALUES
(1, 'admin@admin.com', 'admin', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 1, '2012-08-22 02:46:41', NULL),
(27, 'robot_13481231079819@adonice.com', 'robot_13481231079819', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 9, '2012-09-20 06:38:27', NULL),
(24, '4296411@qq.com', '4296411@qq.com', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', -1, '2012-09-01 06:34:53', NULL),
(26, '@adonice.com', 'robot_13481230939666', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 9, '2012-09-20 06:38:13', NULL),
(21, '83098181@qq.com', 'aadada', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 9, '2012-08-29 07:37:43', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
