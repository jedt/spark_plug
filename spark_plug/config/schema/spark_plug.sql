-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 27, 2010 at 05:32 AM
-- Server version: 5.1.37
-- PHP Version: 5.2.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spark_plug`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `paypal_email` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `time_zone_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` VALUES(17, 2, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_tokens`
--

CREATE TABLE `login_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` char(32) NOT NULL,
  `duration` varchar(32) NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `login_tokens`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_id` int(11) unsigned DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `active` varchar(3) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `country` varchar(5) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`username`),
  KEY `mail` (`email`),
  KEY `users_FKIndex1` (`user_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(1, 1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', '', '', '1', '', '', '', '', '', '', '2009-11-17 22:22:33', '2009-11-17 22:22:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` VALUES(1, 'Admin', 1);
INSERT INTO `user_groups` VALUES(2, 'User', 2);
INSERT INTO `user_groups` VALUES(3, 'Guest', 10);

-- --------------------------------------------------------

--
-- Table structure for table `user_group_permissions`
--

CREATE TABLE `user_group_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_group_id` int(10) unsigned NOT NULL,
  `controller` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `action` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `allowed` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `user_group_permissions`
--

INSERT INTO `user_group_permissions` VALUES(1, 3, 'Users', 'register', 1);
INSERT INTO `user_group_permissions` VALUES(2, 3, 'Users', 'login', 1);
INSERT INTO `user_group_permissions` VALUES(3, 3, 'Users', 'logout', 1);
INSERT INTO `user_group_permissions` VALUES(4, 3, 'Users', 'forgot_password', 1);
INSERT INTO `user_group_permissions` VALUES(5, 3, 'Users', 'activate_password', 1);
INSERT INTO `user_group_permissions` VALUES(6, 2, 'Users', 'dashboard', 1);
INSERT INTO `user_group_permissions` VALUES(7, 1, 'Users', '*', 1);
INSERT INTO `user_group_permissions` VALUES(8, 1, 'Websites', '*', 0);
INSERT INTO `user_group_permissions` VALUES(9, 2, 'Websites', '*', 1);
INSERT INTO `user_group_permissions` VALUES(11, 2, 'Users', 'change_password', 1);
INSERT INTO `user_group_permissions` VALUES(12, 1, 'UserGroupPermissions', '*', 1);
INSERT INTO `user_group_permissions` VALUES(13, 1, 'UserGroups', '*', 1);
INSERT INTO `user_group_permissions` VALUES(14, 3, 'test.php', '', 1);
