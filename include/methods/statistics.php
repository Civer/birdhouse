<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: statistics.php

This is used for storing all functions used in the solution
related to statistics.

Functions will mostly be run by the Action scripts.
Some of them are triggered from index and content as well.

*/
##########################################################################
##########################################################################
##########################################################################
#
#   Table of Content
#
#   5       Statistics
#   5.1         setStatistics($userId, $itemId)
#   5.2         getStatisticsDay()
#   5.3         getStatisticsAlltime()
#   5.4         getUserStatistics($id)
#   5.5         getCategoryStatistics($id)
#   5.6         getSubcategoryStatistics($id)
#   5.7         getItemStatistics($id)
#
##########################################################################
##########################################################################
##########################################################################

/*

   5.1 setStatistics($userId, $itemId)

   Set a statistic Value

*/

##########################################################################
##########################################################################
##########################################################################

    function setStatistics($userId, $itemId) {

        $conn = getConnection();

        $itemInformation = getItem($itemId);
        $categoryId = $itemInformation[0]['categoryId'];
        $subcategoryId = $itemInformation[0]['subcategoryId'];

        $sql = "INSERT INTO statistics (userId, itemId, categoryId, subcategoryId, orderTime) VALUES ('".$userId."', '".$itemId."','".$categoryId."','".$subcategoryId."', CURRENT_TIMESTAMP)";
        $conn->exec($sql);

        }


##########################################################################


/*

   5.2 getStatisticsDay()

   Get all orders by user or all users (admin)

*/

##########################################################################

    function getStatisticsDay() {

        $conn = getConnection();

        $sql = "SELECT id, userId, itemId, categoryId, subcategoryId, orderTime FROM statistics WHERE orderTime > DATE_SUB(NOW(), INTERVAL 12 HOUR)";

        $results = array();

        foreach ($conn->query($sql) as $row) {
            $index++;
            array_push($results,
                array(
                    "id" => $row["id"],
                    "userId" => $row["userId"],
                    "categoryId" => $row["categoryId"],
                    "itemId" => $row["itemId"],
                    "subcategoryId" => $row["subcategoryId"],
                    "orderTime" => $row["orderTime"],
                )
            );
        }

        $conn = null; #Close Connection

        return $results;
    }

##########################################################################


/*

   5.3 getStatisticsAlltime()

   Get all orders by user or all users (admin)

*/

##########################################################################

    function getStatisticsAlltime() {

        $conn = getConnection();

        $sql = "SELECT id, userId, itemId, categoryId, subcategoryId, orderTime FROM statistics";

        $results = array();

        foreach ($conn->query($sql) as $row) {
            $index++;
            array_push($results,
                array(
                    "id" => $row["id"],
                    "userId" => $row["userId"],
                    "categoryId" => $row["categoryId"],
                    "itemId" => $row["itemId"],
                    "subcategoryId" => $row["subcategoryId"],
                    "orderTime" => $row["orderTime"],
                )
            );
        }

        $conn = null; #Close Connection

        return $results;
    }

##########################################################################


/*

   5.4 getUserStatistics($id)

   Get all orders by user or all users (admin)

*/

##########################################################################

    function getUserStatistics($id) {

        $conn = getConnection();

        $sql = "SELECT id, userId, itemId, categoryId, subcategoryId, orderTime FROM statistics WHERE userId = '".$id."'";

        $results = array();

        foreach ($conn->query($sql) as $row) {
            $index++;
            array_push($results,
                array(
                    "id" => $row["id"],
                    "userId" => $row["userId"],
                    "categoryId" => $row["categoryId"],
                    "itemId" => $row["itemId"],
                    "subcategoryId" => $row["subcategoryId"],
                    "orderTime" => $row["orderTime"],
                )
            );
        }

        $conn = null; #Close Connection

        return $results;
    }

##########################################################################


/*

   5.5 getCategoryStatistics($id)

   Get all orders by user or all users (admin)

*/

##########################################################################

    function getCategoryStatistics($id) {

        $conn = getConnection();

        $sql = "SELECT id, userId, itemId, categoryId, subcategoryId, orderTime FROM statistics WHERE categoryId = '".$id."'";

        $results = array();

        foreach ($conn->query($sql) as $row) {
            $index++;
            array_push($results,
                array(
                    "id" => $row["id"],
                    "userId" => $row["userId"],
                    "categoryId" => $row["categoryId"],
                    "itemId" => $row["itemId"],
                    "subcategoryId" => $row["subcategoryId"],
                    "orderTime" => $row["orderTime"],
                )
            );
        }

        $conn = null; #Close Connection

        return $results;
    }

##########################################################################


/*

   5.6 getSubcategoryStatistics($id)

   Get all orders by user or all users (admin)

*/

##########################################################################

    function getSubcategoryStatistics($id) {

        $conn = getConnection();

        $sql = "SELECT id, userId, itemId, categoryId, subcategoryId, orderTime FROM statistics WHERE subcategoryId = '".$id."'";

        $results = array();

        foreach ($conn->query($sql) as $row) {
            $index++;
            array_push($results,
                array(
                    "id" => $row["id"],
                    "userId" => $row["userId"],
                    "categoryId" => $row["categoryId"],
                    "itemId" => $row["itemId"],
                    "subcategoryId" => $row["subcategoryId"],
                    "orderTime" => $row["orderTime"],
                )
            );
        }

        $conn = null; #Close Connection

        return $results;
    }

##########################################################################


/*

   5.7 getItemStatistics($id)

   Get all orders by user or all users (admin)

*/

##########################################################################

    function getItemStatistics($id) {

        $conn = getConnection();

        $sql = "SELECT id, userId, itemId, categoryId, subcategoryId, orderTime FROM statistics WHERE itemId = '".$id."'";

        $results = array();

        foreach ($conn->query($sql) as $row) {
            $index++;
            array_push($results,
                array(
                    "id" => $row["id"],
                    "userId" => $row["userId"],
                    "categoryId" => $row["categoryId"],
                    "itemId" => $row["itemId"],
                    "subcategoryId" => $row["subcategoryId"],
                    "orderTime" => $row["orderTime"],
                )
            );
        }

        $conn = null; #Close Connection

        return $results;
    }

?>
