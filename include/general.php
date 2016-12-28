<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: methods.php

This is used for storing all functions used in the solution
related to items.

Functions will mostly be run by the Action scripts.
Some of them are triggered from index and content as well.

*/
##########################################################################
##########################################################################
##########################################################################
#
#   Table of Content
#
#   9       General Methods
#   9.1         logTxt($text)
#   9.2         getConnection()
#   9.3         getColors()
#   9.4         getPageInformation()
#   9.5         Filter Functions (catFilter, subCatFilter)
#
##########################################################################
##########################################################################
##########################################################################

/*

   9.1 logTxt($text)

   Used to log to a file

*/

##########################################################################
##########################################################################
##########################################################################

    function logTxt($text) {
        require dirname(__DIR__)."/ressources/config.php";
        $logfile = $config['logfile']['path'];
        $file = fopen($logfile, "a") or die("Unable to open file! "."Test: ".$logfile);
        $logdate = date("d.m.Y - H:i:s").": ";
        $logtxt = $text."\n";
        fwrite($file, $logdate.$logtxt);
        fclose($file);
    }


##########################################################################

/*

   9.2 getConnection()

   Used to establish the SQL connection

*/

##########################################################################


    function getConnection() {
        require dirname(__DIR__)."/ressources/config.php";

        $server = $config['db']['host'];
        $dbname = $config['db']['dbname'];
        $username = $config['db']['username'];
        $password = $config['db']['password'];

        try {
            #logTxt("Trying to establish a database connection!");
            $conn = new PDO("mysql:host=".$server.";dbname=".$dbname, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            #logTxt("Connected successfully");
            return $conn;
        }
        catch(PDOException $e) {
            logTxt("ERROR: Connection failed: " . $e->getMessage());
        }
    }

##########################################################################

/*

   9.3 getColors()

   Get the Colors for the page

*/

##########################################################################

    function getColors() {

        $conn = getConnection();

        #logTxt("Trying to get Colors!");

        $sql = "SELECT bundle, color FROM pageColors";

        $results = array();

        foreach ($conn->query($sql) as $row) {
            $results[$row["bundle"]] = utf8_encode($row["color"]);
        }

        $conn = null;

        return $results;

    }

##########################################################################

/*

   9.4 getPageInformation()

   Get page information like language, title and initialpassword

*/

##########################################################################

    function getSettings() {

        $conn = getConnection();

        #logTxt("Trying to get Colors!");

        $sql = "SELECT sitename, siteslogan, lang, initialPassword FROM settings";

        $index = 0;
        $results = array();

        foreach ($conn->query($sql) as $row) {
            $index++;
            array_push($results,
                array(
                    "sitename" => utf8_encode($row["sitename"]),
                    "siteslogan" => utf8_encode($row["siteslogan"]),
                    "lang" => $row["lang"],
                    "initialPassword" => utf8_encode($row["initialPassword"]),
                )
            );
        }

        if($index == 0) {
            logTxt("ERROR: No Settings found!");
        }

        #logTxt("Orders loaded: ".$index);

        $conn = null; #Close Connection

        return $results;

    }

##########################################################################

/*

   5.5 Filter functions (CatFilter, SubCatFilter)
    CatFilter($itemArray, $cat)
    subCatFilter($itemArray, $subCat)

   Filter stuff

*/

##########################################################################

function CatFilter($itemArray, $cat) {
    $results = array();

    foreach ($itemArray as $item) {
        if($item['categoryId'] == $cat['id']) {
            $results[] = $item;
        }
    }

    return $results;
}

function CatFilterSuggested($itemArray, $cat) {
    $results = array();

    foreach ($itemArray as $item) {
        if($item['categoryId'] == $cat['id'] and $item['showOnSuggestionPage'] == 1) {
            $results[] = $item;
        }
    }

    return $results;
}


function subCatFilter($itemArray, $subCat) {
    $results = array();

    foreach ($itemArray as $item) {
        if($item['subcategoryId'] == $subCat['id']) {
            $results[] = $item;
        }
    }

    return $results;
}

?>
