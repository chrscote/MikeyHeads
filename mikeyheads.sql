SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE IF NOT EXISTS `mikeyheads` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `mikeyheads`;

CREATE TABLE IF NOT EXISTS `admin` (
  `ID` int(11) NOT NULL,
  `firstName` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userID` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `admin` (`ID`, `firstName`, `lastName`, `email`, `userID`, `password`) VALUES
(0, 'Chris', 'Cote', 'admin@mikeyheads.com', 'admin', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441');

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `product_ID` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prod_abbr` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

INSERT INTO `products` (`id`, `product_ID`, `product_name`, `prod_abbr`, `price`) VALUES
(1, 'bb1_8', '1/8 oz. Black Shaky Head', '1/8 Blk Shky Hd', '5.00'),
(2, 'bb3_16', '3/16 oz. Black Shaky Head', '3/16 Blk Shky Hd', '5.00'),
(3, 'bb1_4', '1/4 oz. Black Shakey Head', '1/4 Blk Shky Hd', '5.00'),
(4, 'bg_1_8', '1/8 oz. Green Pumpkin Shaky Head', '1/8 Grn Pmkn Shky Hd', '5.00'),
(5, 'bg3_16', '3/16 oz. Green Pumpkin Shaky Head', '3/16 Grn Pmkn Shky Hd', '5.00'),
(6, 'bg1_4', '1/4 oz. Green Pumpkin Shaky Head', '1/4 Grn Pmkn Shky Hd', '5.00'),
(7, 'br1_8', '1/8 oz. Watermelon Red Shaky Head', '1/8 Wtrmln Rd Shky Hd', '5.00'),
(8, 'br3_16', '3/16 oz. Watermelon Red Shaky Head', '3/16 Wtrmln Rd Shky Hd', '5.00'),
(9, 'br1_4', '1/4 oz. Watermelon Red Shaky Head', '1/4 Wtrmln Rd Shky Hd', '5.00'),
(10, 'sb3_16', '3/16 oz. Black Swim Bait', '3/16 Blk Swm Bt', '5.00'),
(11, 'sb1_4', '1/4 oz. Black Swim Bait', '1/4 Blk Swm Bt', '5.00'),
(12, 'sr3_16', '3/16 oz. Watermelon Red Swim Bait', '3/16 Wtrmln Rd Swm Bt', '5.00'),
(13, 'sr1_4', '1/4 oz. Watermelon Red Swim Bait', '1/4 Wtrmln Rd Swm Bt', '5.00'),
(14, 'sw3_16', '3/16 oz. White Swim Bait', '3/16 Wht Swm Bt', '5.00'),
(15, 'sw1_4', '1/4 oz. White Swim Bait', '1/4 Wht Swm Bt', '5.00'),
(16, 'tr3_8', '3/8 oz. Watermelon Red Tornado Spin', '3/8 Wtrmln Rd Trndo Spn', '5.00'),
(17, 'tw3_8', '3/8 oz. White Tornado Spin', '3/8 Wht Trndo Spn', '5.00'),
(18, 'tb3_8', '3/8 oz. Black Tornado Spin', '3/8 Blk Trndo Spn', '5.00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
