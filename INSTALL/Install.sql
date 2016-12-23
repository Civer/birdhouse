SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-----------------------
-- TABLE CATEGORIES
-----------------------

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `subcategoryEnabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-----------------------
-- TABLE ITEMS
-----------------------

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `categoryId` int(11) NOT NULL,
  `subcategoryId` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `orders` int(10) NOT NULL,
  `ranking` int(1) NOT NULL,
  `ingr4` varchar(40) NOT NULL,
  `ingr1` varchar(40) NOT NULL,
  `ingr1_admin` varchar(40) NOT NULL,
  `ingr1_show` tinyint(1) NOT NULL DEFAULT '1',
  `ingr2` varchar(40) NOT NULL,
  `ingr2_admin` varchar(40) NOT NULL,
  `ingr2_show` tinyint(1) NOT NULL DEFAULT '1',
  `ingr3` varchar(40) NOT NULL,
  `ingr3_admin` varchar(40) NOT NULL,
  `ingr3_show` tinyint(1) NOT NULL DEFAULT '1',
  `ingr4_admin` varchar(40) NOT NULL,
  `ingr4_show` tinyint(1) NOT NULL DEFAULT '1',
  `ingr5` varchar(40) NOT NULL,
  `ingr5_admin` varchar(40) NOT NULL,
  `ingr5_show` tinyint(1) NOT NULL DEFAULT '1',
  `ingr6` varchar(40) NOT NULL,
  `ingr6_admin` varchar(40) NOT NULL,
  `ingr6_show` tinyint(1) NOT NULL DEFAULT '1',
  `ingr7` varchar(40) NOT NULL,
  `ingr7_admin` varchar(40) NOT NULL,
  `ingr7_show` tinyint(1) NOT NULL DEFAULT '1',
  `ingr8` varchar(40) NOT NULL,
  `ingr8_admin` varchar(40) NOT NULL,
  `ingr8_show` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-----------------------
-- TABLE ORDERS
-----------------------

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `additionalInfo` varchar(150) NOT NULL,
  `itemId` int(11) NOT NULL,
  `done` tinyint(1) NOT NULL,
  `orderTime` datetime NOT NULL,
  `solveTime` datetime NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

-----------------------
-- TABLE pageColors
-----------------------

CREATE TABLE IF NOT EXISTS `pageColors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bundle` varchar(150) NOT NULL,
  `color` varchar(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

INSERT INTO `pageColors` (`id`, `bundle`, `color`) VALUES
(1, 'background', '#A5C2BD'),
(2, 'outerBox', '#EAECDE'),
(3, 'basicPage', '#ACD4BA'),
(4, 'ingredients', '#EAECDE'),
(5, 'tableBackground', '#EAECDE'),
(6, 'boxshadow', '#3B3A36'),
(7, 'buttonShadow', '#3B3A36'),
(8, 'buttonColor1', '#4A4944'),
(9, 'buttonColor2', '#565E5C'),
(10, 'buttonBorder', '#54534D'),
(11, 'textShadow', '#3B3A36'),
(12, 'border', '#A0ADAB'),
(13, 'inputFieldBorder', '#C2C2C2'),
(14, 'inputFieldShadow', '#EBEBEB'),
(15, 'fontColorButton', '#FFFFFF'),
(16, 'fontColor', '#000000');

-----------------------
-- TABLE SETTINGS
-----------------------

CREATE TABLE IF NOT EXISTS `settings` (
  `sitename` varchar(150) NOT NULL,
  `siteslogan` varchar(150) NOT NULL,
  `lang` varchar(5) NOT NULL,
  `initialPassword` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `settings` (`sitename`, `siteslogan`, `lang`, `initialPassword`) VALUES
('Birdhouse', 'Party Menu', 'de', 'BH;2017!');

-----------------------
-- TABLE SUBCATEGORIES
-----------------------

CREATE TABLE IF NOT EXISTS `subCategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-----------------------
-- TABLE USERS
-----------------------

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `creationdate` date NOT NULL,
  `administrator` tinyint(1) NOT NULL,
  `descEnable` tinyint(1) NOT NULL DEFAULT '1',
  `ingrEnable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;
