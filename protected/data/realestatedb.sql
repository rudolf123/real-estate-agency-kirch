-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Авг 04 2014 г., 08:43
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `realestatedb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `file` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `property`
--

CREATE TABLE IF NOT EXISTS `property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purpose_id` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `area` float NOT NULL,
  `price` float NOT NULL,
  `type` varchar(100) NOT NULL,
  `owner` varchar(300) NOT NULL,
  `supervisor` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `property`
--

INSERT INTO `property` (`id`, `purpose_id`, `address`, `area`, `price`, `type`, `owner`, `supervisor`) VALUES
(1, 7, 'ул. Строителей 2', 12000, 123, '1', '', ''),
(2, 5, 'ул. 2', 234, 12, '1', '', ''),
(3, 1, 'ул. 1', 12, 123, '0', '', ''),
(4, 3, 'ул. Строителей 2', 12, 12, '0', '', ''),
(5, 4, 'ул. Строителей 2', 12, 12, '0', '', ''),
(6, 4, 'ул. Строителей 2', 12, 12, '0', '', ''),
(7, 2, 'ул. Строителей 2', 12, 12, '0', '', ''),
(8, 2, 'ул. Строителей 2', 12, 12, '0', '', ''),
(9, 1, 'ул. Ладожская', 40, 123, '0', '', ''),
(10, 4, 'ул. Ладожская', 60, 123, '0', '', ''),
(11, 4, 'ул. 1', 45, 123, '0', '', ''),
(12, 1, 'sdfasdf', 150, 23, '0', '', ''),
(13, 6, 'ghfkhgfkgkg', 250, 78, '1', '', ''),
(14, 5, 'sdfdfgdhfh', 234, 12, '1', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `purposes`
--

CREATE TABLE IF NOT EXISTS `purposes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `purposes`
--

INSERT INTO `purposes` (`id`, `name`, `type`) VALUES
(1, 'Офис', 0),
(2, 'Торгов.', 0),
(3, 'Произв.', 0),
(4, 'Склад', 0),
(5, 'ИЖС', 1),
(6, 'Произв.', 1),
(7, 'Сельхоз.', 1),
(8, 'Свобод.', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `passwd`, `name`, `surname`, `secondname`, `role`, `sessionstart`, `sessionend`, `autologin`, `online`, `regdate`, `email`, `approved`) VALUES
(11, 'rudolf', 'Fg2iivD8qjU6M', 'Владимир', 'Юранов', 'Сергеевич', 'moderator', '0000-00-00 00:00:00', '2014-05-27 10:27:58', 0, 1, '2014-02-10 15:02:54', '', 1),
(12, 'hotenovY', 'Fg/FVF9sieij.', 'Юрий', 'Хотенов', 'Юрьевич', 'moderator', '0000-00-00 00:00:00', '2014-07-10 22:00:14', 0, 1, '2014-02-18 06:40:26', '', 1),
(13, 'rudolf1', 'Fg8WLfmbZ/y5k', 'Владимир', 'Юранов', 'd', 'user', '0000-00-00 00:00:00', '2014-05-07 16:31:42', 0, 1, '2014-05-07 16:11:18', 'rudolf@pgta.ru', 1),
(14, 'rud', 'Fg8WLfmbZ/y5k', 'Владимир', 'Иванов', 'Иванович', 'user', '0000-00-00 00:00:00', '2014-05-08 11:26:50', 0, 1, '2014-05-07 16:33:01', 'rudolf123@narod.ru', 1),
(17, 'qwe', 'Fg8WLfmbZ/y5k', 'qwe', 'qwe', 'qwe', 'user', '0000-00-00 00:00:00', '2014-07-10 19:49:27', 0, 1, '2014-05-08 11:16:00', 'qwe', 1),
(16, 'sfhsfgj', 'Fg8WLfmbZ/y5k', 'adfhsd', 'asdas', 'gjsfgj', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2014-05-08 11:15:35', 'sgjsk', 1),
(19, 'admin', 'Fg/FVF9sieij.', '', 'Администратор', '', 'administrator', '0000-00-00 00:00:00', '2014-07-29 16:00:02', 0, 1, '2014-05-08 11:19:52', 'rudolf123@narod.ru', 1),
(20, 'qwe1', 'Fg8WLfmbZ/y5k', 'qwe', 'qwe', 'qwe', 'user', '0000-00-00 00:00:00', '2014-05-08 12:16:04', 0, 1, '2014-05-08 11:50:18', 'qwe', 1),
(21, 'zxc', 'FgPG0Z4UJoKg.', 'ASDG', 'AFSDG', 'sfhdh', 'user', '0000-00-00 00:00:00', '2014-05-14 14:46:45', 0, 1, '2014-05-14 14:45:49', 'dsfhsdfh', 1),
(22, 'asd', 'FgHiYz4aOHDFI', 'asd', 'asd', 'asd', 'user', '0000-00-00 00:00:00', '2014-05-14 15:02:16', 0, 1, '2014-05-14 15:01:37', 'asd', 1),
(23, 'dfg', 'FglkDkeidg.IY', 'dfg', 'dfgdfg', 'dfg', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2014-05-14 15:31:15', 'rudolf123@narod.ru', 1),
(26, 'xcv', 'Fgc/9gXKNWQs2', 'xcv', 'xcv', 'xcv', 'user', '0000-00-00 00:00:00', '2014-05-29 16:04:06', 0, 1, '2014-05-14 16:06:13', 'rudolf123@narod.ru', 1),
(25, 'rty', 'Fg23dG79OPcso', 'dfg', 'dfg', 'dfg', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2014-05-14 15:33:10', 'rudolf123@narod.ru', 1),
(27, 'cvb', 'FgfydP5Fg.5tg', 'cvb', 'cvb', 'cvb', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2014-05-14 16:08:33', 'cvb', 1),
(28, 'rufo', 'FgBgyIsPjSw/I', 'Иван', 'Иванов', 'Иванович', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '2014-07-11 22:54:36', 'rudolf123@narod.ru', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
