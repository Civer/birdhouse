<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: settings.php

This is used for storing all functions used in the solution
related to settings.

Functions will mostly be run by the Action scripts.
Some of them are triggered from index and content as well.

*/
##########################################################################
##########################################################################
##########################################################################
#
#   Table of Content
#
#   4       Settings
#   4.1         resetColors()
#   4.2         setColors($array)
#
##########################################################################
##########################################################################
##########################################################################

/*

   4.1 resetColors()

   Reset all Colors

*/

##########################################################################
##########################################################################
##########################################################################

function resetColors() {
    $conn = getConnection();

    #logTxt("Trying to get Colors!");

    $array = array(
        array('key' => 'background', 'color' => '#A5C2BD'),
        array('key' => 'outerBox', 'color' => '#EAECDE'),
        array('key' => 'basicPage', 'color' => '#ACD4BA'),
        array('key' => 'ingredients', 'color' => '#EAECDE'),
        array('key' => 'tableBackground', 'color' => '#EAECDE'),
        array('key' => 'boxshadow', 'color' => '#3B3A36'),
        array('key' => 'buttonShadow', 'color' => '#3B3A36'),
        array('key' => 'buttonColor1', 'color' => '#4A4944'),
        array('key' => 'buttonColor2', 'color' => '#565E5C'),
        array('key' => 'buttonBorder', 'color' => '#54534D'),
        array('key' => 'fontColorButton', 'color' => '#FFFFFF'),
        array('key' => 'textShadow', 'color' => '#3B3A36'),
        array('key' => 'border', 'color' => '#A0ADAB'),
        array('key' => 'inputFieldBorder', 'color' => '#C2C2C2'),
        array('key' => 'inputFieldShadow', 'color' => '#EBEBEB'),
        array('key' => 'fontColor', 'color' => '#000000')
    );

    foreach($array as $row) {
        $sql = "UPDATE pageColors SET color = '".$row[color]."' WHERE bundle = '".$row[key]."'";
        $conn->exec($sql);
    }

    $conn = null;
}

##########################################################################

/*

   4.2 setColors($array)

   This will write the new Colors to the database

*/

##########################################################################

function setColors($array) {
    $conn = getConnection();

    #logTxt("Trying to get Colors!");

    foreach($array as $row) {
        $sql = "UPDATE pageColors SET color = '".$row[color]."' WHERE bundle = '".$row[key]."'";
        $conn->exec($sql);
    }

    $conn = null;
}

##########################################################################

/*

   4.2 setColors($array)

   This will write the new Colors to the database

*/

##########################################################################

function setSettings($sitetitle, $siteslogan, $initialPassword, $language) {
    $conn = getConnection();

    #logTxt("Trying to get Colors!");

    $sql = "UPDATE settings SET sitename = '".utf8_decode($sitetitle)."', siteslogan = '".utf8_decode($siteslogan)."', initialPassword = '".utf8_decode($initialPassword)."', lang = '".$language."'";
    $conn->exec($sql);

    $conn = null;

    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
}


?>
