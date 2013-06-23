-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 06 月 23 日 16:30
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
-- 表的结构 `admin_group`
--

CREATE TABLE IF NOT EXISTS `admin_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(32) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `admin_group`
--

INSERT INTO `admin_group` (`id`, `group_name`, `order`) VALUES
(1, '鹳狸猿', 1),
(2, '普通用户', 2);

-- --------------------------------------------------------

--
-- 表的结构 `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `group_id` int(11) NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `group_id`, `last_login`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, '2013-06-13 05:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `alias` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `name`, `alias`) VALUES
(1, '资讯', 'articles'),
(2, '活动', 'actions'),
(3, '团购', 'groupbuy');

-- --------------------------------------------------------

--
-- 表的结构 `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `content`
--

INSERT INTO `content` (`id`, `content`) VALUES
(8, '额头有'),
(9, '<p>阿斯打三打三打啊 &nbsp;</p><div>阿斯打三打三打啊 &nbsp;阿斯打三打三打啊 &nbsp;阿斯打三打三打啊 &nbsp;阿斯打三打三打啊 &nbsp;阿斯打三打三打啊 &nbsp;阿斯打三打三打啊 &nbsp;阿斯打三打三打啊 &nbsp;阿斯打三打三打啊 &nbsp;阿斯打三打三打啊 &nbsp;阿斯打三打三打啊 &nbsp;阿斯打三打三打啊 &nbsp;阿斯打三打三打啊 &nbsp;阿斯打三打三打啊 &nbsp;阿<strong>斯打三打三打啊 &nbsp;阿斯打三打三打啊</strong> &nbsp;阿斯打三打三打啊 &nbsp;阿斯打三打三打啊 &nbsp;</div>'),
(10, '啊是打算'),
(11, '啊是打算asda'),
(12, 'asdasdasdasd阿道夫哈哈是否');

-- --------------------------------------------------------

--
-- 表的结构 `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone` decimal(13,0) NOT NULL,
  `type` enum('actions','groupbuy') DEFAULT NULL COMMENT '类型',
  `objectid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone_obj` (`phone`,`objectid`) COMMENT '电话-活动'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `members`
--

INSERT INTO `members` (`id`, `username`, `email`, `phone`, `type`, `objectid`) VALUES
(1, '丁继勇', 'ding@kt.com', '13222222222', 'groupbuy', 8),
(2, '打酱油', 'dajyou@kt.com', '13111111111', 'groupbuy', 9),
(3, '丁继勇', 'ding@kt.com', '13111111111', 'actions', 8),
(4, '打酱油', 'dajyou@kt.com', '13222222222', 'actions', 9),
(5, 'dingj', 'ding@qq.com', '13115212649', 'actions', 12),
(10, '阿三打扫打扫', '4296411@qq.com', '9564621', 'groupbuy', 5),
(11, '', '', '0', 'actions', 0);

-- --------------------------------------------------------

--
-- 表的结构 `member_activity`
--

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
-- 表的结构 `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `title_2nd` varchar(64) NOT NULL,
  `content_id` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `author` varchar(32) NOT NULL,
  `imagecover` varchar(64) DEFAULT '' COMMENT '封面图片',
  `imagetitle` varchar(64) DEFAULT '',
  `orders` int(11) NOT NULL DEFAULT '9' COMMENT '置顶用排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `post`
--

INSERT INTO `post` (`id`, `category_id`, `title`, `title_2nd`, `content_id`, `create_date`, `author`, `imagecover`, `imagetitle`, `orders`) VALUES
(8, 1, '主标题11', '副标题44444', 8, '2013-06-17 00:39:47', 'admin', '63_832159_30314cf3105aa0a.jpg', '', 1),
(9, 2, '活动主标题', '活动副标题', 9, '2013-06-17 12:18:11', 'admin', '20110812113437285.jpg', '', 2),
(10, 3, '团购aaaaaaaaa', '团购二标', 10, '2013-06-17 16:29:25', 'admin', '971.gif', '63_832159_30314cf3105aa0a.jpg', 9),
(11, 3, '团购ccccccccccc', '团购二标', 10, '2013-06-17 16:29:25', 'admin', 'asd', '', 9),
(12, 3, '团购ccccccccccccc', '团购二标12', 11, '2013-06-19 00:53:45', 'admin', '', '', 9),
(13, 1, 'zixun2222222', 'title222222222222', 12, '2013-06-19 01:07:46', 'admin', '6628711bgw1dlgxcqyv6tj.jpg', '', 9);

-- --------------------------------------------------------

--
-- 表的结构 `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(32) NOT NULL,
  `value` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'groupbuy_s', '1');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=153322 ;

--
-- 转存表中的数据 `users`
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
