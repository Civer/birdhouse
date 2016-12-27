<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: installActions.php

Installing Birdhouse

*/
##########################################################################
##########################################################################
##########################################################################

if (isset($_POST['generalPageSettings'])) {
    $sitetitle = $_POST['sitetitle'];
    $siteslogan = $_POST['siteslogan'];
    $initialPassword = $_POST['initialPassword'];
    $language = $_POST['language'];
    $dbname = $_POST['dbname'];
    $dbusername = $_POST['dbusername'];
    $dbpassword = $_POST['dbpassword'];
    $dbhost = $_POST['dbhost'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $pusherappkey = $_POST['pusherappkey'];
    $pusherappsecret = $_POST['pusherappsecret'];
    $pusherappid = $_POST['pusherappid'];
    $dummyData = $_POST['dummyData'];

    if($dummyData == 'on') {
        $dummyData = true;
    }
    else {
        $dummyData = false;
    }

//Create Config file

    file_put_contents($_SERVER['DOCUMENT_ROOT']."/ressources/config.php", '<?php

    ##########################################################################
    ##########################################################################
    ##########################################################################
    /*

    Author: Peter Vogelmann
    Title: config.php

    This file is used for storing most of the config stuff

    */
    ##########################################################################
    ##########################################################################
    ##########################################################################

    $config = array(
        "db" => array(
            "dbname" => "'.$dbname.'",
            "username" => "'.$dbusername.'",
            "password" => "'.$dbpassword.'",
            "host" => "'.$dbhost.'"
        ),
        "push" => array(
            "appKey" => "'.$pusherappkey.'",
            "appSecret" => "'.$pusherappsecret.'",
            "appId" => "'.$pusherappid.'"
        ),
        "paths" => array(
            "ressources" => $_SERVER["DOCUMENT_ROOT"] . "/ressources",
            "images" => $_SERVER["DOCUMENT_ROOT"] . "/img"
        ),
        "key" => array(
            "hash" => ".89f73hfeuenf.sjei",
        ),
        "logfile" => array(
            "path" => $_SERVER["DOCUMENT_ROOT"]."/logs/log.txt"
        )
    );
?>');



require $_SERVER['DOCUMENT_ROOT']."/ressources/config.php";
require $_SERVER['DOCUMENT_ROOT']."/include/general.php";

//Prepare SQL

if($dummyData) {
    $sql = "SET SQL_MODE = ".'"NO_AUTO_VALUE_ON_ZERO"'.";
SET time_zone = ".'"+00:00"'.";

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `subcategoryEnabled` tinyint(1) NOT NULL,
  `menuOrder` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `categories` (`id`, `name`, `active`, `subcategoryEnabled`, `menuOrder`) VALUES
(1, 'Cocktails', 1, 0, 0);

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `categoryId` int(11) NOT NULL,
  `subcategoryId` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `adminDescription` varchar(1000) NOT NULL,
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
  `showOnSuggestionPage` tinyint(1) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

INSERT INTO `items` (`id`, `categoryId`, `subcategoryId`, `name`, `description`, `adminDescription`, `orders`, `ranking`, `ingr4`, `ingr1`, `ingr1_admin`, `ingr1_show`, `ingr2`, `ingr2_admin`, `ingr2_show`, `ingr3`, `ingr3_admin`, `ingr3_show`, `ingr4_admin`, `ingr4_show`, `ingr5`, `ingr5_admin`, `ingr5_show`, `ingr6`, `ingr6_admin`, `ingr6_show`, `ingr7`, `ingr7_admin`, `ingr7_show`, `ingr8`, `ingr8_admin`, `ingr8_show`, `active`, `showOnSuggestionPage`) VALUES
(1, 1, 9, 'Pina Colada', 'Karibik pur! Mit einer Pina Colada kommt sofort Urlaubsstimmung auf. Der tropisch-fruchtige Sommer-Cocktail verwandelt Ananas, braunen und weißen Rum, Kokos und Sahne in eine wunderbar cremige Mischung, die auch in unseren Breiten Tiki-Kultur aufleben lässt.', 'Die Zutaten inklusive Eis im Shaker schütteln und in ein mit drei großen Eiswürfeln gefülltes Longdrinkglas abseihen. Das cremige Geheimnis einer Pina Colada ist der richtige Schuß Sahne.\r\nWie bei vielen anderen Drinks kann man natürlich auch eine leichtere Variante, ein Pina Colada Light mixen. Dazu braucht man je 2 cl weißen und braunen Rum, nur 6 cl Ananassaft und 2 cl Cream of Coconut, außerdem noch 3 cl Milch. Fertig ist der Light-Drink, der noch lighter wirkt mit einem Minzzweig als Dekoration...', 0, 0, 'Ananas-Saft', 'Rum, weiss', '4cl', 1, 'Cream of Coconut', '5cl', 1, 'Sahne', '3cl', 1, '10cl', 1, '', '', 1, '', '', 1, '', '', 1, '', '', 1, 1, 0),
(2, 1, 12, 'Long Island Iced Tea', 'Sieht aus wie Eistee, schmeckt hochprozentig fantastisch. Im starken Klassiker Long Island Ice Tea ist alles drin, was Laune macht: Wodka, Rum, Gin und Triple Sec, getoppt mit Cola und etwas Zitrone. Eine amerikanische Erfindung ganz nach unserem Geschmack.', '', 0, 0, 'Triple Sec', 'Wodka', '', 1, 'Rum', '', 1, 'Gin', '', 1, '', 1, 'Zuckersirup', '', 1, 'Zitronensaft', '', 1, 'Cola', '', 1, '', '', 1, 1, 0),
(3, 1, 10, 'Caipirinha', 'Der Caipirinha ist einfach der Hit unter den Cocktails! Keine Party geht ohne der erfrischenden, fruchtig-säuerlichen Caipirinha. Tips: den Trinkhalm vor dem Servieren kräftig umrühren, damit der Zucker sich verteilt.', '', 0, 0, 'Limettensaft', 'Limetten', '', 1, 'Cachaca', '', 1, 'Rohrzucker', '', 1, '', 1, '', '', 1, '', '', 1, '', '', 1, '', '', 1, 1, 0),
(4, 1, 8, 'Cuba Libre', 'Das Leben kann so einfach sein: Im Cuba Libre werden Cola, Rum und Limette zum anregenden Longdrink ? mit kubanischem Rum, versteht sich. Das Ergebnis ist so simpel wie raffiniert: Eine süß-säuerliche Erfrischung mit leichtem Koffeinkick für durchtanzte Nächte.', 'Den Rum in ein mit Eiswürfeln gefülltes Longdrinkglas geben und mit Coca Cola auffüllen.\r\nDie Limettenachtel über dem Glas ausdrücken und dazugeben.\r\nKurz umrühren.TEST', 0, 0, '', 'Rum, weiss', '4cl', 1, 'Cola', 'auffüllen', 1, 'Limetten', '1/4 Limette', 1, '', 1, '', '', 1, '', '', 1, '', '', 1, '', '', 1, 1, 0),
(5, 1, 11, 'The Power Of 43', 'Eine süße Verführung mit dem intensiven Licor 43. Die Vanillearomen vermischen sich mit den süßen Aromen der Fruchsäfte. Ein Gedicht!', '', 0, 0, 'Karamellsirup', 'Licor 43', '', 1, 'Cranberrysaft', '', 1, 'Maracujanektar', '', 1, '', 1, 'Limettensaft', '', 1, '', '', 1, '', '', 1, '', '', 1, 1, 0),
(6, 1, 9, 'Sunflower', 'Ein fruchtig süßes Erlebnis. Die Kokosaromen des Malibu Rums vermischen sich mit den exotischen Säften. Ein sommerliches Drink, der Sommer, Strand und Meer vermittelt.', '', 0, 0, 'Orangensaft', 'Malibu', '8cl', 1, 'Maracujasaft', '6cl', 1, 'Ananassaft', '6cl', 1, '8cl', 1, 'Grenadinensirup', '1cl', 1, '', '', 1, '', '', 1, '', '', 1, 1, 0),
(7, 1, 11, 'Green Mamba', 'Bis auf die Farbe hat dieser Cocktail kaum etwas mit seiner Namengeberin gemein. Die Vanillearomen des Licor 43 vermischen sich mit den Aromen von Zitrusfrüchten und Maracujasaft.', '', 0, 0, 'Zitronensaft', 'Licor 43', '4cl', 1, 'Blue Curacao', '2cl', 1, 'Maracujasaft', '10cl', 1, '1cl', 1, 'Sahne', '2cl', 1, '', '', 1, '', '', 1, '', '', 1, 1, 0),
(8, 1, 11, 'My Dream', 'Ein Traum aus Pfirsich und Alkohol. Dieser fruchtige Cocktail bietet alles um Träume in Erfüllung gehen zu lassen. Das Pfirsicharoma mischt sich mit Rum und Wodka und wird durch die vielen Früchte wie Orange und Ananas angereichert.', '', 0, 0, 'Blue Curacao', 'Rum, weiss', '2cl', 1, 'Wodka', '2cl', 1, 'Pfirsischlikör', '2cl', 1, '2cl', 1, 'Ananassaft', '6cl', 1, 'Orangensaft', '8cl', 1, '', '', 1, '', '', 1, 1, 1),
(9, 1, 8, 'Sex on the Beach', 'Sex on the Beach ist ursprünglich ein fruchtiger, leicht süßer Longdrink, der mit Cranberry-Saft gemixt wird. \r\nDa Cranberry-Saft (oder Nektar) auch heute nicht überall erhältlich oder vorrätig ist, existieren verschiedene Variationen.', 'Alle Zutaten mit Eis in einem Shaker kräftig durchschütteln. Anschließend in ein Longdrinkglas mit Eiswürfel abgießen. Mit Ananas und Kirsche dekorieren.', 0, 0, 'Cranberrysaft', 'Wodka', '4cl', 1, 'Pfirschlikör', '2cl', 1, 'Orangensaft', '8cl', 1, '8cl', 1, '', '', 1, '', '', 1, '', '', 1, '', '', 1, 1, 0),
(10, 1, 8, 'Tequila Sunrise', 'Es gibt kaum einen Cocktail, der so einfach zu erkennen ist, wie ein Tequila Sunrise. Ein Sonnenuntergang aus der Südsee erzeugt durch die Zugabe von Grenadine direkt nach der Vermischung von Tequila und Orangensaft. Ein raffinierter Klassiker.', 'Tequila, Orangensaft mit Eiswürfeln im Shaker gut schütteln und in ein mit gestoßenem Eis gefülltes Longdrinkglas abseihen. Grenadinesirup langsam darüber laufen lassen. Mit einer Orangenscheibe und Kirsche garnieren. Vor dem Trinken umrühren.', 0, 0, '', 'Tequila', '4cl', 1, 'Grenadine', '2cl', 1, 'Orangensaft', 'auffüllen', 1, '', 1, '', '', 1, '', '', 1, '', '', 1, '', '', 1, 1, 0),
(11, 1, 9, 'Flying Kangaroo', 'Wer es gern süß mag, auf tropische Aromen steht und einen cremigen Cocktail gerne trinkt, der liegt beim Flying Kangaroo genau richtig. ', 'Glas: Hurricane\r\nZubereitung: 	Zutaten mit Eis shaken und in das vorgekühlte Gästeglas abseihen.', 0, 0, 'Kokossirup', 'Wodka', '2cl', 1, 'Rum', '2cl', 1, 'Licor 43', '1cl', 1, '2cl', 1, 'Sahne', '2cl', 1, 'Ananassaft', '6cl', 1, 'Orangensaft', '6cl', 1, '', '', 1, 1, 0),
(12, 1, 9, 'Malibu Pina Colada', 'Der perfekte Pina Colada. Weich und cremig. Ein Traum der Südsee.', 'Alle Zutaten mit viel Eiswürfeln im Mixer zubereiten', 0, 0, '', 'Malibu', '10cl', 1, 'Cream of Coconut', '5cl', 1, 'Ananassaft', '15cl', 1, '', 1, '', '', 1, '', '', 1, '', '', 1, '', '', 1, 1, 0),
(13, 1, 18, 'Tom Collins', 'Der Collins hat seinen Namen von Tom Collins Hoax aus dem Jahre 1874. Dabei wurde einzelnen Bargästen erzählt, es würde ein gewisser Tom Collins in einer anderen Bar sitzen und Unverschämtheiten über sie erzählen. Einige Besucher nahmen diese Geschichte ernst und stürmten auf die Straßen auf der Suche nach Mr. Collins. Geblieben ist ein beliebter Sour.', 'Der Cocktail wird entweder ?gebaut?, also direkt im Gästeglas hergestellt, oder aber die Grundmischung wird zunächst mit Eiswürfeln im Cocktail-Shaker geschüttelt oder in einem Rührglas mit dem Barlöffel gerührt und anschließend auf frische Eiswürfel in ein Longrink-Glas abgeseiht. Im zweiten Schritt wird dann mit kaltem Sodawasser aufgegossen und vorsichtig umgerührt. ', 0, 0, 'Zuckersirup', 'Gin', '5cl', 1, 'Zitronensaft', '2cl', 1, 'Soda', '10cl', 1, '1cl', 1, 'Zitronenachtel', '2', 0, '', '', 1, '', '', 1, '', '', 1, 1, 1),
(14, 1, 18, 'Gin Tonic', 'Der Klassiker unter den Cocktails. Der Gin Tonic kommt wahrscheinlich aus dem British Empire, als in Indien zum Schutz vor Malaria das chininhaltige, damals sehr bittere Indian Tonic Water getrunken wurde, welches zugefügter Gin geschmacklich verbesserte. Wie die meisten Highballs, in der Regel aus lediglich einer Spirituose und einem kohlensäurehaltigen Filler bestehende Mixgetränke, wird Gin Tonic direkt im Glas zubereitet, indem man die Zutaten über Eiswürfel gießt und vorsichtig umrührt. ', 'Garniert wird mit einem in den Drink gegebenen kleineren, geschnittenen Stück (Schnitz) oder einer dünnen, daumengroßen Schale (Zeste) einer Limette oder Zitrone, alternativ einer Zitronenscheibe, seltener mit einer Gurkenscheibe (meist bei Hendrick?s Gin).', 0, 0, '', 'Gin', '4cl', 1, 'Tonic Water', '16cl', 1, '', '', 1, '', 1, '', '', 1, '', '', 1, '', '', 1, '', '', 1, 1, 0),
(15, 1, 13, 'Virgin Sunrise', 'Der alkoholfreie Cocktail zum Tequila Sunrise: der Virgin Sunrise! Fruchtig, Süß und einfach sensationell. Da will man fast schon nicht mehr den alkoholhaltigen Tequila Sunrise trinken.', 'Die Säfte im Shaker mit Eiswürfeln mischen und auf Crushed Ice abseien. Grenadine dazugeben für den Sunriseeffekt.', 0, 0, 'Grenadine', 'Orangensaft', '7cl', 1, 'Ananassaft', '4cl', 1, 'Zitronensaft', '1cl', 1, '1cl', 1, '', '', 1, '', '', 1, '', '', 1, '', '', 1, 1, 0),
(16, 1, 13, 'Kiba', 'Der Kirschbanane ist wohl der bekannteste Vertreter unter den Alkoholfreien Cocktails. Simpel und gut. Einfache ein absolutes Muss für die Fahrer.', 'Beide Säfte sollen sich nicht vollständig vermischen, damit farbige Schichten bzw. Schlieren entstehen. Auf ein paar Eiswürfeln Bananennektar in ein Longdrinkglas geben, und anschließend Kirschsaft über einen langen Barlöffel langsam hineinlaufen lassen. KiBa mit Bananenstück garnieren. Es geht auch eine alkoholische Variante mit Kirschlikör.', 0, 0, '', '12cl', 'Bananennektar', 1, '6cl', 'Kirschsaft', 1, '', '', 1, '', 1, '', '', 1, '', '', 1, '', '', 1, '', '', 1, 1, 0),
(17, 1, 13, 'Abendsonne', 'Ein karibischer Traum aus Grenadine und Banane. Die Abendsonne ist eine tropische Creme ideal für alle die, die gerne Holiday Cocktails trinken, aber heute leider fahren müssen.', 'Alle Zutaten mit Eis in den Shaker geben, kräftig schütteln und anschließend in ein Glas abseihen. Eventuell ist Cream Of Coconut noch eine gute Ergänzung.', 0, 0, '', 'Bananennektar', '7cl', 1, 'Sahne', '10cl', 1, 'Grenadine', '3cl', 1, '', 1, '', '', 1, '', '', 1, '', '', 1, '', '', 1, 1, 0),
(18, 1, 8, 'Black Russian', 'Der Black Russian besteht nur aus zwei Zutaten. Wodka und Kaffeelikör. Für die einen zum Davonlaufen, für die anderen eine Delikatesse. Am Black Russian scheiden sich die Geister und das ist auch gut so!', 'Kaffeelikör und Wodka in ein Rührglas geben.\r\nMit einem Stirrer gut verrühren.\r\nEiswürfel in einen Tumbler geben.\r\nDen Cocktail in das Glas gießen.\r\nSofort servieren.', 0, 0, '', 'Wodka', '4cl', 1, 'Kaffeelikör', '2cl', 1, '', '', 1, '', 1, '', '', 1, '', '', 1, '', '', 1, '', '', 1, 1, 0);

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `additionalInfo` varchar(150) NOT NULL,
  `itemId` int(11) NOT NULL,
  `done` tinyint(1) NOT NULL,
  `orderTime` datetime NOT NULL,
  `solveTime` datetime NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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

CREATE TABLE IF NOT EXISTS `settings` (
  `sitename` varchar(150) NOT NULL,
  `siteslogan` varchar(150) NOT NULL,
  `lang` varchar(5) NOT NULL,
  `initialPassword` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `settings` (`sitename`, `siteslogan`, `lang`, `initialPassword`) VALUES
('".$sitetitle."', '".$siteslogan."', '".$language."', '".$initialPassword."');

CREATE TABLE IF NOT EXISTS `subCategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `menuOrder` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

INSERT INTO `subCategories` (`id`, `name`, `categoryId`, `active`, `menuOrder`) VALUES
(1, 'Classical', 1, 1, 0),
(2, 'Holiday', 1, 1, 1),
(3, 'Caipi & Co.', 1, 1, 2),
(4, 'Fruity', 1, 1, 4),
(5, 'Jumbo', 1, 1, 5),
(6, 'Drivers', 1, 1, 6),
(7, 'Gin & Co.', 1, 1, 3);

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `creationdate` date NOT NULL,
  `administrator` tinyint(1) NOT NULL,
  `descEnable` tinyint(1) NOT NULL DEFAULT '1',
  `ingrEnable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;";
}

else {
    $sql = "SET SQL_MODE = ".'"NO_AUTO_VALUE_ON_ZERO"'.";
SET time_zone = ".'"+00:00"'.";

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `subcategoryEnabled` tinyint(1) NOT NULL,
  `menuOrder` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `categoryId` int(11) NOT NULL,
  `subcategoryId` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `adminDescription` varchar(1000) NOT NULL,
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
  `showOnSuggestionPage` tinyint(1) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `additionalInfo` varchar(150) NOT NULL,
  `itemId` int(11) NOT NULL,
  `done` tinyint(1) NOT NULL,
  `orderTime` datetime NOT NULL,
  `solveTime` datetime NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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

CREATE TABLE IF NOT EXISTS `settings` (
  `sitename` varchar(150) NOT NULL,
  `siteslogan` varchar(150) NOT NULL,
  `lang` varchar(5) NOT NULL,
  `initialPassword` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `settings` (`sitename`, `siteslogan`, `lang`, `initialPassword`) VALUES
('".$sitetitle."', '".$siteslogan."', '".$language."', '".$initialPassword."');

CREATE TABLE IF NOT EXISTS `subCategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `menuOrder` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `creationdate` date NOT NULL,
  `administrator` tinyint(1) NOT NULL,
  `descEnable` tinyint(1) NOT NULL DEFAULT '1',
  `ingrEnable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;";

}

$conn = getConnection();
$conn->exec($sql);

//Create Userpassword

    $hashkey = $config['key']['hash'];
    $encryptedPassword = password_hash($password.$hashkey, PASSWORD_DEFAULT);

//Create first user

$sql = "INSERT INTO users (username, password, creationdate, administrator) VALUES ('".utf8_decode($username)."', '".$encryptedPassword."',CURRENT_TIMESTAMP, 1)";

$conn->exec($sql);

$conn = null;

echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';

}

?>
