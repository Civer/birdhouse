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

-- DUMMY DATA

INSERT INTO `categories` (`id`, `name`, `active`, `subcategoryEnabled`) VALUES
(1, 'Cocktails', 1, 0);

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

-- DUMMY DATA

INSERT INTO `items` (`id`, `categoryId`, `subcategoryId`, `name`, `description`, `orders`, `ranking`, `ingr4`, `ingr1`, `ingr1_admin`, `ingr1_show`, `ingr2`, `ingr2_admin`, `ingr2_show`, `ingr3`, `ingr3_admin`, `ingr3_show`, `ingr4_admin`, `ingr4_show`, `ingr5`, `ingr5_admin`, `ingr5_show`, `ingr6`, `ingr6_admin`, `ingr6_show`, `ingr7`, `ingr7_admin`, `ingr7_show`, `ingr8`, `ingr8_admin`, `ingr8_show`, `active`) VALUES
(1, 1, 0, 'Pina Colada', 'Karibik pur! Mit einer Pina Colada kommt sofort Urlaubsstimmung auf. Der tropisch-fruchtige Sommer-Cocktail verwandelt Ananas, braunen und weißen Rum, Kokos und Sahne in eine wunderbar cremige Mischung, die auch in unseren Breiten Tiki-Kultur aufleben lässt.', 0, 0, 'Sahne', 'Rum, weiss', '', 1, 'Rum, braun', '', 1, 'Kokossirup', '', 1, '', 1, 'Ananas-Saft', '', 1, '', '', 1, '', '', 1, '', '', 1, 1),
(2, 1, 0, 'Long Island Iced Tea', 'Sieht aus wie Eistee, schmeckt hochprozentig fantastisch. Im starken Klassiker Long Island Ice Tea ist alles drin, was Laune macht: Wodka, Rum, Gin und Triple Sec, getoppt mit Cola und etwas Zitrone. Eine amerikanische Erfindung ganz nach unserem Geschmack.', 0, 0, 'Triple Sec', 'Wodka', '', 1, 'Rum', '', 1, 'Gin', '', 1, '', 1, 'Zuckersirup', '', 1, 'Zitronensaft', '', 1, 'Cola', '', 1, '', '', 1, 1),
(3, 1, 0, 'Caipirinha', 'Der Caipirinha ist einfach der Hit unter den Cocktails! Keine Party geht ohne der erfrischenden, fruchtig-säuerlichen Caipirinha. Tips: den Trinkhalm vor dem Servieren kräftig umrühren, damit der Zucker sich verteilt.', 0, 0, 'Limettensaft', 'Limetten', '', 1, 'Cachaca', '', 1, 'Rohrzucker', '', 1, '', 1, '', '', 1, '', '', 1, '', '', 1, '', '', 1, 1),
(4, 1, 0, 'Cuba Libre', 'Das Leben kann so einfach sein: Im Cuba Libre werden Cola, Rum und Limette zum anregenden Longdrink ? mit kubanischem Rum, versteht sich. Das Ergebnis ist so simpel wie raffiniert: Eine süß-säuerliche Erfrischung mit leichtem Koffeinkick für durchtanzte Nächte.', 0, 0, '', 'Rum, weiss', '', 1, 'Cola', '', 1, 'Limetten', '', 1, '', 1, '', '', 1, '', '', 1, '', '', 1, '', '', 1, 1),
(5, 1, 0, 'The Power Of 43', 'Eine süße Verführung mit dem intensiven Licor 43. Die Vanillearomen vermischen sich mit den süßen Aromen der Fruchsäfte. Ein Gedicht!', 0, 0, 'Karamellsirup', 'Licor 43', '', 1, 'Cranberrysaft', '', 1, 'Maracujanektar', '', 1, '', 1, 'Limettensaft', '', 1, '', '', 1, '', '', 1, '', '', 1, 0);

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

-- DUMMY DATA 

INSERT INTO `subCategories` (`id`, `name`, `categoryId`, `active`) VALUES
(1, 'Süß', 1, 0),
(2, 'Stark', 1, 0);

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

-- DUMMY DATA

INSERT INTO `users` (`id`, `username`, `password`, `creationdate`, `administrator`, `descEnable`, `ingrEnable`) VALUES
(1, 'Admin', '$2y$10$lybmer4iBPm1ekOBCjtdBuud/gTZT0nF6z6PNokMUae3y/lSY2Taq', '2016-12-12', 1, 1, 1),
(2, 'User', '$2y$10$lybmer4iBPm1ekOBCjtdBuud/gTZT0nF6z6PNokMUae3y/lSY2Taq', '2016-12-14', 0, 1, 1),
