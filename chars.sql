-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 21, 2013 at 04:00 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chars`
--
CREATE DATABASE IF NOT EXISTS `chars` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `chars`;

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

DROP TABLE IF EXISTS `characters`;
CREATE TABLE IF NOT EXISTS `characters` (
  `char_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(80) NOT NULL,
  `name` varchar(60) NOT NULL,
  `job` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `power` int(3) NOT NULL,
  `magic` int(3) NOT NULL,
  `awesome` int(3) NOT NULL,
  PRIMARY KEY (`char_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `characters`
--

INSERT INTO `characters` (`char_id`, `image`, `name`, `job`, `description`, `power`, `magic`, `awesome`) VALUES
(1, 'images/compostHeap.gif', 'Compost Heap', 'Food Taster', 'Compost Heap''s strengths are in the creation of delicious and nutritious foodstuffs to heal the group.  Of course, he always keeps a little bit for himself.', 60, 80, 50),
(2, 'images/felix.gif', 'Felix', 'Basket Weaver', 'Weaving is a dangerous profession, as Felix knows. Trained from a young age, he can take any wooden object and turn it into a deadly basket.', 75, 50, 60),
(3, 'images/robopig.gif', 'Robopig', 'Dentist', 'Finding treasure is a lot like pulling teeth, and it turns out that plyers, drills, and mirrors on little sticks are great out on the field.  Robopig is the innovator of the group, and she always has some item for the task at hand.', 70, 40, 70),
(4, 'images/slimeMan.gif', 'Slimy', 'Proctologist', 'Silmy can be a real pain in the nether regions to her enemies, and is most efficient wielding heated iron rods. She is also the brains of the group, easily solving any puzzle.', 40, 70, 75),
(5, 'images/sockMonster.gif', 'Sock Monster', 'Dragon Slayer', 'Easily the strongest of the group, Sock Monster can wield any type of weapon, but is most deadly with anything made from cotton.  Dragons beware!', 90, 30, 75);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_username` varchar(256) NOT NULL,
  `user_pass` varchar(40) NOT NULL,
  `user_name_full` varchar(512) NOT NULL,
  `user_email` varchar(256) NOT NULL,
  `user_country` varchar(100) NOT NULL,
  `user_creditcard_number` varchar(19) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `username` (`user_username`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_username`, `user_pass`, `user_name_full`, `user_email`, `user_country`, `user_creditcard_number`) VALUES
(1, 'bryanerayner', '123456', 'Bryan Rayner', 'bryanerayner@gmail.com', 'Canada', 'lkjlkjslkdf');

-- --------------------------------------------------------

--
-- Table structure for table `users_characters`
--

DROP TABLE IF EXISTS `users_characters`;
CREATE TABLE IF NOT EXISTS `users_characters` (
  `user_id` int(11) unsigned NOT NULL,
  `char_id` int(11) unsigned NOT NULL,
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_characters`
--

INSERT INTO `users_characters` (`user_id`, `char_id`) VALUES
(1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
