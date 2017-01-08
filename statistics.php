<?php

header('Content-Type: text/html; charset=utf-8');

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: statistics.php

Handling all includes, header and body information
as well as loading the content related scripts

*/
##########################################################################
##########################################################################
##########################################################################

session_start();

require __DIR__."/ressources/config.php";
require __DIR__."/include/general.php";

foreach (glob("./include/methods/*.php") as $filename) {
    require $filename;
}

$pageSettings = getSettings();
require __DIR__."/ressources/lang/".$pageSettings[0]['lang'].".php"; //Get the proper language from DB

foreach (glob("./include/formActions/*.php") as $filename) {
    require $filename;
}

?>

<html>
    <head>
        <title><?php echo $pageSettings[0]['sitename'].' - '.$pageSettings[0]['siteslogan'] ?></title>
        <meta charset="utf-8" />
        <link href="./css/style.php" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="./js/scripts.js"></script>
        <script src="./js/statistics.js"></script>


    </head>
    <body>
        <div class="container">
            <div class="dayStatistics">

            </div>
            <div class="cocktailStatistics">

            </div>
            <div class="allTimeStatistiscs">

            </div>
        </div>
    </body>
</html>
