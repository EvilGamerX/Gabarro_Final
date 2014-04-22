-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 13, 2013 at 02:40 AM
-- Server version: 5.6.13-log
-- PHP Version: 5.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE IF NOT EXISTS `forums` (
  `forum_id` int(8) NOT NULL AUTO_INCREMENT,
  `forum_name` varchar(255) NOT NULL,
  `forum_desc` varchar(255) NOT NULL,
  `has_subform` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`forum_id`),
  UNIQUE KEY `forum_name` (`forum_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`forum_id`, `forum_name`, `forum_desc`, `has_subform`) VALUES
(1, 'Site News', 'Any information or questions about the website, please go here.', 1),
(2, 'Playstation 4', 'Home of your Playstation 4 discussions.', 1),
(3, 'Xbox One', 'Home of your Xbox One discussions.', 1),
(4, 'WiiU', 'Home of your WiiU discussions.', 1),
(5, 'Playstation Vita', 'Home of your Playstation Vita discussions.', 1),
(6, 'Nintendo 3DS', 'Home of your Nintendo 3DS discussions.', 1),
(7, 'Playstation 3', 'Home of your Playstation 3 discussions.', 1),
(8, 'Xbox 360', 'Home of your Xbox 360 discussions.', 1),
(9, 'Wii', 'Home of your Wii discussions.', 1),
(10, 'Playstation Portable', 'Home of your Playstation Portable discussions.', 1),
(11, 'Nintendo DS', 'Home of your Nintendo DS discussions.', 1),
(12, '"Retro" Zone', 'Home of your retro gaming discussions.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `game_review_table`
--

CREATE TABLE IF NOT EXISTS `game_review_table` (
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `review` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`game_id`,`user_id`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `game_review_table`
--

INSERT INTO `game_review_table` (`game_id`, `user_id`, `username`, `timestamp`, `review`) VALUES
(2, 1, 'EvilGamerX', '2013-12-13 02:32:36', 'THIS SURE IS A GAME');

-- --------------------------------------------------------

--
-- Table structure for table `game_table`
--

CREATE TABLE IF NOT EXISTS `game_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `platform` int(11) DEFAULT NULL,
  `genre` int(11) DEFAULT NULL,
  `amazon` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `game_table`
--

INSERT INTO `game_table` (`id`, `name`, `platform`, `genre`, `amazon`, `image`, `release_date`) VALUES
(1, 'Call of Duty: Ghosts', 1008, NULL, 'http://www.amazon.com/Call-Duty-Ghosts-Playstation-3/dp/B003O6CBIG/ref=sr_1_1?ie=UTF8&qid=1386458561&sr=8-1&keywords=call+of+duty+ghost', 'http://ecx.images-amazon.com/images/I/51d84ij79tL._SY300_.jpg', NULL),
(2, 'Battlefield 4', 992, NULL, 'http://www.amazon.com/Battlefield-4-PlayStation/dp/B00DS0MQUQ/ref=sr_1_1?ie=UTF8&qid=1386458722&sr=8-1&keywords=battlefield+4', 'http://ecx.images-amazon.com/images/I/51U4bU1VeoL._SY300_.jpg', NULL),
(3, 'Killzone: Shadow Fall', 256, NULL, 'http://www.amazon.com/Killzone-Shadow-Fall-PlayStation-4/dp/B00BGA9YZK/ref=sr_1_2?ie=UTF8&qid=1386458853&sr=8-2&keywords=killzone+shadow+fall', 'http://ecx.images-amazon.com/images/I/51vePFmD68L._SY300_.jpg', NULL),
(4, 'Titanfall', 672, NULL, 'http://www.amazon.com/Titanfall-Xbox-One/dp/B00DB9JYFY/ref=sr_1_1?ie=UTF8&qid=1386458887&sr=8-1&keywords=titanfall', 'http://ecx.images-amazon.com/images/I/51VA0r4nMZL._SY300_.jpg', '2014-03-11'),
(5, 'Assassin''s Creed IV Black Flag', 992, NULL, 'http://www.amazon.com/Assassins-Creed-IV-Black-Flag-Xbox/dp/B00BMFIXT2/ref=sr_1_1?ie=UTF8&qid=1386458923&sr=8-1&keywords=assassins+creed+4', 'http://ecx.images-amazon.com/images/I/51P1JBgSRIL._SY300_.jpg', NULL),
(6, 'Destiny', 480, NULL, 'http://www.amazon.com/Destiny-PlayStation-4/dp/B00BGA9Y3W/ref=sr_1_1?ie=UTF8&qid=1386458944&sr=8-1&keywords=destiny', 'http://ecx.images-amazon.com/images/I/519HE7ad%2BLL._SY300_.jpg', NULL),
(7, 'Need for Speed Rivals', 992, NULL, 'http://www.amazon.com/Need-Speed-Rivals-PlayStation-4/dp/B00D3RBZHY/ref=sr_1_1?ie=UTF8&qid=1386458966&sr=8-1&keywords=need+for+speed+rivals', 'http://ecx.images-amazon.com/images/I/51STP7QSwSL._SY300_.jpg', NULL),
(8, 'The Sims 3', 512, NULL, 'http://www.amazon.com/The-Sims-3-PC/dp/B00166N6SA/ref=sr_1_5?ie=UTF8&qid=1386458985&sr=8-5&keywords=sims', 'http://ecx.images-amazon.com/images/I/51cPdrVL51L._SY300_.jpg', NULL),
(9, 'Madden NFL 25', 480, NULL, 'http://www.amazon.com/Madden-NFL-25-Xbox-360/dp/B00AY1CT4U/ref=sr_1_1?s=videogames&ie=UTF8&qid=1386459196&sr=1-1&keywords=madden+25', 'http://ecx.images-amazon.com/images/I/51RPXjdPZLL._SY300_.jpg', NULL),
(10, 'Final Fantasy XIV: A Realm Reborn', 832, NULL, 'http://www.amazon.com/Final-Fantasy-XIV-Realm-Reborn-Playstation/dp/B002BRZ79E/ref=sr_1_1?s=videogames&ie=UTF8&qid=1386459373&sr=1-1&keywords=final+fantasy', 'http://ecx.images-amazon.com/images/I/51uh24kqHcL._SY300_.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(8) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `topic_id` int(8) NOT NULL,
  `post_data` varchar(1000) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edit_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`,`topic_id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `topic_id`, `post_data`, `post_date`, `edit_date`) VALUES
(22, 1, 14, 'Have fun, and be nice!', '2013-12-12 01:35:49', '0000-00-00 00:00:00'),
(23, 3, 14, 'NO I WON''T', '2013-12-12 02:08:11', '0000-00-00 00:00:00'),
(24, 5, 15, 'Topic.', '2013-12-12 05:05:04', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sub_forums`
--

CREATE TABLE IF NOT EXISTS `sub_forums` (
  `forum_id` int(8) NOT NULL,
  `sub_forum_id` int(8) NOT NULL AUTO_INCREMENT,
  `sub_forum_name` varchar(255) NOT NULL,
  `sub_forum_desc` varchar(255) NOT NULL,
  PRIMARY KEY (`sub_forum_id`),
  UNIQUE KEY `sub_forum_name` (`sub_forum_name`),
  KEY `forum_id` (`forum_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `sub_forums`
--

INSERT INTO `sub_forums` (`forum_id`, `sub_forum_id`, `sub_forum_name`, `sub_forum_desc`) VALUES
(1, 1, 'Announcements', 'Announcements will be posted here.'),
(1, 2, 'General Discussion', 'General talk about the website.'),
(1, 3, 'Support/Contact', 'Problems? Come here!'),
(2, 4, 'PS4 General', 'General PS4 discussion.'),
(2, 5, 'PS4 Accessories and Hardware', 'Talk about the Console, Accessories or any other Hardware for the PS4'),
(2, 6, 'PS4 Games', 'A general board for and and all PS4 Games'),
(2, 7, 'PS4 Support', 'Ask your fellow gamers for some help.'),
(3, 8, 'Xbox One General', 'General Xbox One discussion.'),
(3, 9, 'Xbox One Accessories and Hardware', 'Talk about the Console, Accessories or any other Hardware for the Xbox One'),
(3, 10, 'Xbox One Games', 'A general board for and and all Xbox One Games'),
(3, 11, 'Xbox One Support', 'Ask your fellow gamers for some help.'),
(4, 12, 'WiiU General', 'General WiiU discussion.'),
(4, 13, 'WiiU Accessories and Hardware', 'Talk about the Console, Accessories or any other Hardware for the WiiU'),
(4, 14, 'WiiU Games', 'A general board for and and all WiiU Games'),
(4, 15, 'WiiU Support', 'Ask your fellow gamers for some help.'),
(5, 16, 'Vita General', 'General Vita discussion.'),
(5, 17, 'Vita Accessories and Hardware', 'Talk about the Console, Accessories or any other Hardware for the Vita'),
(5, 18, 'Vita Games', 'A general board for and and all Vita Games'),
(5, 19, 'Vita Support', 'Ask your fellow gamers for some help.'),
(6, 20, '3DS General', 'General 3DS discussion.'),
(6, 21, '3DS Accessories and Hardware', 'Talk about the Console, Accessories or any other Hardware for the 3DS'),
(6, 22, '3DS Games', 'A general board for and and all 3DS Games'),
(6, 23, '3DS Support', 'Ask your fellow gamers for some help.'),
(7, 24, 'PS3 General', 'General PS3 discussion.'),
(7, 25, 'PS3 Accessories and Hardware', 'Talk about the Console, Accessories or any other Hardware for the PS3'),
(7, 26, 'PS3 Games', 'A general board for and and all PS3 Games'),
(7, 27, 'PS3 Support', 'Ask your fellow gamers for some help.'),
(8, 28, 'Xbox 360 General', 'General Xbox 360 discussion.'),
(8, 29, 'Xbox 360 Accessories and Hardware', 'Talk about the Console, Accessories or any other Hardware for the Xbox 360'),
(8, 30, 'Xbox 360 Games', 'A general board for and and all Xbox 360 Games'),
(8, 31, 'Xbox 360 Support', 'Ask your fellow gamers for some help.'),
(9, 32, 'Wii General', 'General Wii discussion.'),
(9, 33, 'Wii Accessories and Hardware', 'Talk about the Console, Accessories or any other Hardware for the Wii'),
(9, 34, 'Wii Games', 'A general board for and and all Wii Games'),
(9, 35, 'Wii Support', 'Ask your fellow gamers for some help.'),
(10, 36, 'PSP General', 'General PSP discussion.'),
(10, 37, 'PSP Accessories and Hardware', 'Talk about the Console, Accessories or any other Hardware for the PSP'),
(10, 38, 'PSP Games', 'A general board for and and all PSP Games'),
(10, 39, 'PSP Support', 'Ask your fellow gamers for some help.'),
(11, 40, 'DS General', 'General DS discussion.'),
(11, 41, 'DS Accessories and Hardware', 'Talk about the Console, Accessories or any other Hardware for the DS'),
(11, 42, 'DS Games', 'A general board for and and all DS Games'),
(11, 43, 'DS Support', 'Ask your fellow gamers for some help.'),
(12, 44, 'Retro General', 'General Retro discussion.'),
(12, 45, 'Retro Accessories and Hardware', 'Talk about the Console, Accessories or any other Hardware for Retro Systems'),
(12, 46, 'Retro Games', 'A general board for and and all Retro Games'),
(12, 47, 'Retro Support', 'Ask your fellow gamers for some help.');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `topic_id` int(8) NOT NULL AUTO_INCREMENT,
  `topic_title` varchar(255) NOT NULL,
  `topic_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sub_forum_id` int(8) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`topic_id`),
  UNIQUE KEY `topic_title` (`topic_title`),
  KEY `topic_op` (`user_id`),
  KEY `forum_id` (`sub_forum_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_title`, `topic_date`, `sub_forum_id`, `user_id`) VALUES
(14, 'Welcome to SideStall', '2013-12-11 20:35:49', 1, 1),
(15, 'What is "Retro"?', '2013-12-12 00:05:04', 44, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `username` varchar(24) NOT NULL,
  `password` varchar(128) NOT NULL,
  `salt` varchar(128) NOT NULL,
  `email` varchar(64) NOT NULL,
  `notif_pref` varchar(1) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `access` varchar(1) NOT NULL,
  `muted` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`username`, `password`, `salt`, `email`, `notif_pref`, `id`, `access`, `muted`) VALUES
('EvilGamerX', '8d08fba7969e7afcc1d0961a3ff5cd7005da5258bdb9b6ace97caba1ac12cd8367e01d9b8ea4ec2b8916c9fdebece1e2ab2da75c43f90729193ea86ea2a41662', '2219487999b40d79c0e3e2b013fbe55d93935e4dbf42ad1c203ba02715ab371c838c00e32f1d9ba9e2e370269b6fd95c6a1a642a0560e85de63afb55d669966e', 'Gamer@gmail.com', '1', 1, '1', 1386729816),
('mmmmmm', 'b5fcbc5ff822bda450baa5bb39837eb5b6215a6f8451d253dff676f483db435c686be7866d66eb7fb9eb3524439ee98fc80d97dfff08410ec02fd1c710683dad', 'f26eb1070213f9765257ed3eacb6947997ebbd75c5dc1730898ba31873713d5d81b7909e9861284be3d97c0a85bf21dc3719c1e855ce008db8cb8eb1f8d6146b', 'm@m.com', '0', 2, '0', 0),
('Omally', '54f0ef1f6f6891155041c9f6d46b96609cf6a5d8df8e286b20a9ad94669c403e65363af7cf66f4b39034060b396c423cc2490ad2dccebcc2046b461df5e6255d', 'fbddd31996f730d26b0356f4949bc356bbdc9081040d656e5c4f810af6085c9a42431ec3d83b4c117be2581cf6b7a60e4333e95f8bbd5f6cede4e1578a2c613f', 'a@b.c', '0', 4, '0', 0),
('nomaggienooo', '66e010fcf276addf1b6b431dedc2918a98257206c03275d09dadd60daaa6d66664ca51aaf97d485064a0b779388de6979590a73e3e0b07504f9fb440e69b1963', '822246ad9b829e70c574950d364de3bb2333f4dbc7de913392e3e0eafe821c78aca275482d67cf9bf5d2ecf18a8a7623b4037b30bef08f2f993abf4362817c6f', 'no@maggie.nooo', '0', 5, '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE IF NOT EXISTS `wishlist` (
  `uID` int(11) NOT NULL,
  `gID` int(11) NOT NULL,
  PRIMARY KEY (`uID`,`gID`),
  KEY `gID` (`gID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`uID`, `gID`) VALUES
(3, 1),
(4, 1),
(1, 4),
(1, 5),
(1, 8),
(4, 8),
(5, 8);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_forums`
--
ALTER TABLE `sub_forums`
  ADD CONSTRAINT `sub_forums_ibfk_1` FOREIGN KEY (`forum_id`) REFERENCES `forums` (`forum_id`);

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`id`),
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`sub_forum_id`) REFERENCES `sub_forums` (`sub_forum_id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`gID`) REFERENCES `game_table` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
