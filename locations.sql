-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 16, 2014 at 04:34 PM
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
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lat` float NOT NULL,
  `long` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location`, `lat`, `long`) VALUES
('amos', 'Amos Lake', 41.5167, -71.976),
('ct', 'CT River (Salmon River)', 41.4904, -72.4779),
('gard', 'Gardner Lake', 41.5138, -72.2263),
('glas', 'Glasgo Pond', 41.562, -71.8814),
('hope', 'Hopeville Pond', 41.603, -71.9286),
('isle', 'Lake of Isles', 41.4837, -71.9492),
('latt', 'Candlewood Lake (Lattins)', 41.4503, -73.4317),
('mash', 'Mashapaug Lake', 42.0172, -72.1329),
('mood', 'Moodus Reservoir  Upper & Lower', 41.5072, -72.4052),
('patt', 'Pattagansett Lake', 41.3719, -72.2303),
('quin', 'Quinnebaug River (Butts Bridge)', 41.6517, -71.9708),
('squan', 'Candlewood Lake (Squantz)', 41.5233, -73.4821),
('will', 'Lake Williams', 41.6373, -72.3104);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
