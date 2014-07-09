-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 09, 2014 at 03:37 PM
-- Server version: 5.1.40
-- PHP Version: 5.2.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `realestatedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `file` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `photos`
--


-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE IF NOT EXISTS `property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(200) NOT NULL,
  `purpose` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `area` float NOT NULL,
  `price` float NOT NULL,
  `type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `property`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `passwd` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `secondname` varchar(30) NOT NULL,
  `role` varchar(15) NOT NULL,
  `sessionstart` datetime NOT NULL,
  `sessionend` datetime NOT NULL,
  `autologin` tinyint(1) NOT NULL,
  `online` tinyint(1) NOT NULL DEFAULT '0',
  `regdate` datetime NOT NULL,
  `email` varchar(50) NOT NULL,
  `approved` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `passwd`, `name`, `surname`, `secondname`, `role`, `sessionstart`, `sessionend`, `autologin`, `online`, `regdate`, `email`, `approved`) VALUES
(11, 'rudolf', 'Fg2iivD8qjU6M', 'Владимир', 'Юранов', 'Сергеевич', 'moderator', '0000-00-00 00:00:00', '2014-02-13 09:08:34', 0, 1, '2014-02-10 15:02:54', '', 1),
(12, 'hotenovY', 'Fg/FVF9sieij.', 'Юрий', 'Хотенов', 'Юрьевич', 'moderator', '0000-00-00 00:00:00', '2014-06-10 10:17:42', 0, 1, '2014-02-18 06:40:26', '', 1),
(13, 'rudolf1', 'Fg8WLfmbZ/y5k', 'Владимир', 'Юранов', 'd', 'user', '0000-00-00 00:00:00', '2014-05-07 16:31:42', 0, 1, '2014-05-07 16:11:18', 'rudolf@pgta.ru', 1),
(14, 'rud', 'Fg8WLfmbZ/y5k', 'Владимир', 'Иванов', 'Иванович', 'user', '0000-00-00 00:00:00', '2014-05-08 11:26:50', 0, 1, '2014-05-07 16:33:01', 'rudolf123@narod.ru', 1),
(17, 'qwe', 'Fg8WLfmbZ/y5k', 'qwe', 'qwe', 'qwe', 'user', '0000-00-00 00:00:00', '2014-07-09 11:57:48', 0, 1, '2014-05-08 11:16:00', 'qwe@asda.rt', 1),
(16, 'sfhsfgj', 'Fg8WLfmbZ/y5k', 'adfhsd', 'asdas', 'gjsfgj', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2014-05-08 11:15:35', 'sgjsk', 1),
(19, 'admin', 'Fg/FVF9sieij.', '', 'Администратор', '', 'administrator', '0000-00-00 00:00:00', '2014-06-17 13:56:54', 0, 1, '2014-05-08 11:19:52', 'rudolf123@narod.ru', 1),
(20, 'qwe1', 'Fg8WLfmbZ/y5k', 'qwe', 'qwe', 'qwe', 'user', '0000-00-00 00:00:00', '2014-05-08 12:16:04', 0, 1, '2014-05-08 11:50:18', 'qwe', 1),
(21, 'zxc', 'FgPG0Z4UJoKg.', 'ASDG', 'AFSDG', 'sfhdh', 'user', '0000-00-00 00:00:00', '2014-05-14 14:46:45', 0, 1, '2014-05-14 14:45:49', 'dsfhsdfh', 1),
(22, 'asd', 'FgHiYz4aOHDFI', 'asd', 'asd', 'asd', 'user', '0000-00-00 00:00:00', '2014-06-03 17:31:50', 0, 1, '2014-05-14 15:01:37', 'asd', 1),
(23, 'dfg', 'FglkDkeidg.IY', 'dfg', 'dfgdfg', 'dfg', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2014-05-14 15:31:15', 'rudolf123@narod.ru', 1),
(26, 'xcv', 'Fgc/9gXKNWQs2', 'xcv', 'xcv', 'xcv', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2014-05-14 16:06:13', 'rudolf123@narod.ru', 1),
(25, 'rty', 'Fg23dG79OPcso', 'dfg', 'dfg', 'dfg', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2014-05-14 15:33:10', 'rudolf123@narod.ru', 1),
(29, 'ghj', 'FgUx2tL6hGrv6', 'ghj', 'ghj', 'ghj', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2014-05-30 14:36:32', 'vladimir.yuranov@codeinside.ru', 1),
(28, 'vbn', 'FgHiYz4aOHDFI', 'asd', 'asd', 'asd', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2014-05-30 13:38:27', 'rudolf123@narod.ru', 1),
(30, 'uio', 'FgGvWH58BISC6', 'uio', 'uio', 'uio', 'user', '0000-00-00 00:00:00', '2014-05-30 14:45:23', 0, 1, '2014-05-30 14:38:06', 'juranovv@gmail.com', 1),
(31, 'valeri', 'FgjbjXUeYeOvA', 'Валерий', 'Мошечков', 'Владимирович', 'user', '0000-00-00 00:00:00', '2014-06-10 09:59:49', 0, 1, '2014-06-05 09:44:13', 'valeri_penza@mail.ru', 1);
