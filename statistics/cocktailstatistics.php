<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: cocktailstatistics.php

Files in the modules folder are used for handling the visible content

*/
##########################################################################
##########################################################################
##########################################################################
/*

   1 Attribution

*/
##########################################################################
##########################################################################
##########################################################################

session_start();

require dirname(__DIR__)."/ressources/config.php";
require dirname(__DIR__)."/include/general.php";

foreach (glob("../include/methods/*.php") as $filename) {
    require $filename;
}

$pageSettings = getSettings();
require dirname(__DIR__)."/ressources/lang/".$pageSettings[0]['lang'].".php"; //Get the proper language from DB

foreach (glob("../include/formActions/*.php") as $filename) {
    require $filename;
}

///////////////////////////////////////////////////////////////////////////////

    echo '<div class="basicPage">';
    echo '<p>Es liegen noch nicht genug Daten vor.</p>';
    echo '</div>';

?>
