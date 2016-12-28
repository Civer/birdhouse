<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: index.php

Handling all includes, header and body information
as well as loading the content related scripts

*/
##########################################################################
##########################################################################
##########################################################################

try {
    if(!file_exists(__DIR__."/ressources/config.php")) {
        throw new Exception("Running install file");
    }
}
catch(Exception $e) {
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=install.php">';
}

session_start();

require __DIR__."/include/plugins/PusherLocal.php";
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
        <link href="./css/sweetalert.php" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css" />
        <script src="./js/jscolor.js"></script>
        <script src="./js/sweetalert.min.js"></script>
        <script src="./js/scripts.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://js.pusher.com/3.2/pusher.min.js"></script>
        <?php
            if(isset($_SESSION['userid'])) {
                echo '<script>activateNotification('.$_SESSION['userid'].','.$_SESSION['useradmin'].')</script>';
            }
        ?>

    </head>
    <body>
        <div class="container">
            <header>
                <?php include 'header.php' ?>
            </header>
            <div class="search" id="searchDiv">
                <?php include 'search.php' ?>
            </div>
            <nav>
                <?php include 'nav.php' ?>
            </nav>
            <div class="offers">
                <?php include 'offers.php' ?>
            </div>
            <section>
                <?php
                    foreach (glob("./modules/*.php") as $filename) {
                        require $filename;
                    }
                ?>
            </section>
            <footer>
                <?php include 'footer.php' ?>
            </footer>
        </div>
    </body>
</html>
