<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: orders.php

This is used for storing all functions used in the solution
related to orders.

Functions will mostly be run by the Action scripts.
Some of them are triggered from index and content as well.

*/
##########################################################################
##########################################################################
##########################################################################
#
#   Table of Content
#
#   3       Orders
#   3.1         getOrders($userId, $administrator)
#   3.2         setOrder($additionalInfo, $itemId)
#   3.3         completeOrder($orderId)
#   3.4         deleteOrder($orderId)
#   3.5         deleteOrders()
#
##########################################################################
##########################################################################
##########################################################################

/*

   3.1 getOrders($userId, $administrator)

   Get all orders by user or all users (admin)

*/

##########################################################################
##########################################################################
##########################################################################

    function getOrders($userId, $administrator) {

        $conn = getConnection();

        if($administrator) {
            $sql = "SELECT id, userId, additionalInfo, itemId, done, orderTime, solveTime FROM orders ORDER BY id DESC";
        }
        else {
            $sql = "SELECT id, userId, additionalInfo, itemId, done, orderTime, solveTime  FROM orders WHERE userId = ".$userId." ORDER BY id DESC";
        }

        $index = 0;
        $results = array();

        foreach ($conn->query($sql) as $row) {
            $index++;
            array_push($results,
                array(
                    "id" => $row["id"],
                    "userId" => utf8_encode($row["userId"]),
                    "additionalInfo" => utf8_encode($row["additionalInfo"]),
                    "itemId" => $row["itemId"],
                    "done" => $row["done"],
                    "orderTime" => $row["orderTime"],
                    "solveTime" => $row["solveTime"]
                )
            );
        }

        if($index == 0) {
            logTxt("ERROR: No Orders found!");
        }

        #logTxt("Orders loaded: ".$index);

        $conn = null; #Close Connection

        return $results;
    }

##########################################################################

/*

   3.2 setOrder($additionalInfo, $itemId)

   Place an order

*/

##########################################################################

    function setOrder($additionalInfo, $itemId) {

        $pageSettings = getSettings();
        include dirname(dirname(__DIR__))."/ressources/lang/".$pageSettings[0]['lang'].".php"; //Get the proper language from DB
        require dirname(dirname(__DIR__))."/ressources/config.php";

        $conn = getConnection();

        $orders = getOrders($_SESSION['userid'], null);

        $activeOrders = array_filter($orders, function ($var) {
            if(!$var['done']) {
                return $var;
            }
        });

        if(count($activeOrders) >= 2) {
            echo "<p class='error'>".$lang['texts']['tooMuchActiveOrders']."</p>";
        }
        else {
            $sql = "INSERT INTO orders (userId, additionalInfo, itemId, orderTime, done) VALUES (".$_SESSION['userid'].", '".utf8_decode($additionalInfo)."',".$itemId.", CURRENT_TIMESTAMP, 0)";
            $conn->exec($sql);

            echo "<p class='success'>".$lang['texts']['orderPlaced']."</p>";

            //The following block is just used for push notifications

                $options = array('cluster' => 'eu', 'encrypted' => true);
                $pusher = new Pusher($config['push']['appKey'], $config['push']['appSecret'], $config['push']['appId'], $options);

                $data['title'] = 'Neue Bestellungen';
                $data['message'] = 'Es liegt eine neue Bestellung von '.$_SESSION['username'].' vor.';
                $pusher->trigger('adminInformation', 'newCocktail', $data);
        }
    }

##########################################################################

/*

   3.3 completeOrder($orderId)

   This will switch an order to the oppsite state

*/

##########################################################################

    function completeOrder($orderId) {

        $conn = getConnection();

        #logTxt("Trying to UPDATE an order in the database!");

        $sql = "SELECT done FROM orders WHERE id = '".$orderId."'";
        foreach ($conn->query($sql) as $row) {
            $done = $row['done'];

            if($done) {
                $sql2 = "UPDATE orders SET done = 0, solveTime = CURRENT_TIMESTAMP WHERE id = ".$orderId;
            }
            else {
                $sql2 = "UPDATE orders SET done = 1, solveTime = CURRENT_TIMESTAMP WHERE id = ".$orderId;
            }

        }

        $conn->exec($sql2);

        $conn = null;

        #logTxt("SQL Executed. Order Updated!");

    }

##########################################################################

/*

   3.4 deleteOrder($orderId)

   This will delete an order

*/

##########################################################################

    function deleteOrder($orderId) {

        $pageSettings = getSettings();
        include dirname(dirname(__DIR__))."/ressources/lang/".$pageSettings[0]['lang'].".php"; //Get the proper language from DB

        $conn = getConnection();

        $sql = "DELETE FROM orders WHERE id = ".$orderId;

        $conn->exec($sql);

        echo "<p class='success'>".$lang['texts']['orderDeleted']."</p>";

    }

##########################################################################

/*

   3.5 deleteOrders()

   This will delete all Orders

*/

##########################################################################

    function deleteOrders() {

        $pageSettings = getSettings();
        include dirname(dirname(__DIR__))."/ressources/lang/".$pageSettings[0]['lang'].".php"; //Get the proper language from DB

        $conn = getConnection();

        $sql = "DELETE FROM orders";

        $conn->exec($sql);

        echo "<p class='success'>".$lang['texts']['AllOrdersDeleted']."</p>";

    }


?>
