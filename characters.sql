-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 31, 2013 at 12:08 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chars`
--

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

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
