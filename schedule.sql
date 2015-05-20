-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 14, 2014 at 11:52 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mikeyheads`
--

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `location` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `firstPlace` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `secondPlace` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `thirdPlace` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lunker` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `date`, `location`, `firstPlace`, `secondPlace`, `thirdPlace`, `lunker`) VALUES
('mood', '2014-03-30', 'Moodus Reservoir Upper & Lower', 'Art Walden', 'Mike Benjamin', NULL, 'Art Walden'),
('quinn', '2014-04-13', 'Quinnebaug River (Butts Bridge)', 'Josh Burkhalter', 'Michael Benjamin', 'Gordon Bacash', 'Elwin Sherman');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
