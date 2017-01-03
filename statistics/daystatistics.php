<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: daystatistics.php

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

    $daystatistics = getStatisticsDay();
    $users = getAllUsers();

    $results = array();

    foreach ($users as $user) {
        $test = getUserStatistics($user['id']);
        if(count($test) > 0) {
            $count = 0;
            foreach($test as $val) {
                if(date($val['orderTime']) > date("Y-m-d H:i:s",strtotime( '-1 days' ))) {
                    $count++;
                }
            }
            if($count > 0) {
                $results[] = $test;
            }
        }
    }

    usort($results, function($a, $b) {
            return count($b) - count($a);
    });


echo '<div class="basicPage">';
echo "<p style='text-align: center; font-style: bold'>Day Statistics</p>";
    for ($i = 0; $i < count($results); $i++) {
        if($results[$i][0]['userId'] == $oldItemId) {

        }
        else {

            $user = getUser($results[$i][0]['userId']);
            echo '<table style="margin: 10px auto">';
            echo '<tr><td width="150" style="text-align: center"><b>'.$user[0]['username'].'</b></td><td width="50" style="text-align: center"><b>'.count($results[$i]).'</b></td></tr>';
            echo '</table>';

        }

        $oldItemId = $results[$i][0]['userId'];
    }
echo '</div>';


    function filterUser($array, $parameter) {
        $results = array();

        foreach ($array as $value) {
            if($value['userId'] == $parameter) {
                $results[] = $item;
            }
        }

        return $results;
    }

    function filterDayStatistics($array, $parameter) {
        $results = array();

        foreach ($array as $item) {
            if($item['userId'] == $parameter) {
                $results[] = $item;
            }
        }

        return $results;
    }

?>
