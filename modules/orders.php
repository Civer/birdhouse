<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: orders.php

Files in the modules folder are used for handling the visible content

*/
##########################################################################
##########################################################################
##########################################################################
/*

   1 ORDERS Page

   Page to show all orders
   If an admin is logged in special admin functionalities are available

*/
##########################################################################
##########################################################################
##########################################################################

if(isset($_GET['page']) and $_GET['page']=='myOrders' and isset($_SESSION['username'])) {
    echo '<div class="basicPage">';
    echo "<p class='paragraphTitle'><b>".$lang['titles']['orders']."</b></p><br />";
    echo "<table class='baseTable'>";

    $orderArray = getOrders($_SESSION['userid'],$_SESSION['useradmin']);

    if(count($orderArray) != 0) {
        echo "<tr class='header'><td>".$lang['tableHeaders']['time']."</td><td>".$lang['tableHeaders']['name']."</td><td>".$lang['tableHeaders']['note']."</td><td>".$lang['tableHeaders']['state']."</td>";
        if($_SESSION['useradmin']) {
            echo "<td>".$lang['tableHeaders']['orderer']."</td><td></td><td></td></tr>";
        }
        else {
            echo "</tr>";
        }
        for($i = 0; $i < count($orderArray); $i++) {
            $itemId = (int)$orderArray[$i]['itemId'];
            $itemArrayForJS = getItem($itemId)[0];
            $itemName = getItem($itemId)[0]['name'];
            $userId = (int)$orderArray[$i]['userId'];
            $userName = getUser($userId)[0]['username'];
            if($orderArray[$i]['additionalInfo']) {
                $itemArrayForJS['notes'] = $orderArray[$i]['additionalInfo'];
            }
            else {
                $itemArrayForJS['notes'] = null;
            }
            $itemArrayForJS = json_encode($itemArrayForJS);
            if($orderArray[$i]['done']) {
                $orderStatus = $lang['states']['closed'];
            }
            else {
                $orderStatus = $lang['states']['open'];
            }
            $date = date_create($orderArray[$i]['orderTime']);
            $formatedDate = date_format($date,"H:i");

            echo "<tr class='orderRow'><td>".$formatedDate."</td>";
            if($_SESSION['useradmin']) {
                echo "<td class='cName'><span onclick='cocktailInformation(".$itemArrayForJS.")'><i class='fa fa-cubes' aria-hidden='true'></i> ".$itemName." </span></td>";
            }
            else {
                echo "<td class='cName'>".$itemName."</td>";
            }

            echo "<td>".$orderArray[$i]['additionalInfo']."</td>";
            echo "<td>".$orderStatus."</td>";
            if($_SESSION['useradmin']) {
                echo '<td>'.$userName.'</td>';
                echo '<td><form action="#" method="post"><p class="center"><input type="hidden" name="deleteOrder" value="'.$orderArray[$i]['id'].'" /><button onclick="return confirm(\''.$lang['confirmation']['deleteOrder'].'\')" class="button" id="small"/><i class="fa fa-trash" aria-hidden="true"></i></button></p></form></td>';
                echo '<td><form action="#" method="post"><p class="center"><input type="hidden" name="switchOrderStateSingle" value="'.$orderArray[$i]['id'].'" /><button class="button" id="small"/><i class="fa fa-check-circle" aria-hidden="true"></i></button></p></form></td>';
            }
            echo "</tr>";
        }
    }
    else {
        echo "<tr><td>".$lang['texts']['noOpenOrders']."</td></tr>";
    }

    echo "</table>";
    echo '<br />';
    if($_SESSION['useradmin']) {
        echo '<form action="#" method="post"><p class="buttonMargin"><input type="hidden" name="deleteOrders" /><input type="submit" value="'.$lang['buttons']['deleteAllOrders'].'" onclick="return confirm(\''.$lang['confirmation']['deleteOrders'].'\')" class="button" id="small" /></p></form>';
    }
    echo '<br /></div>';
}

##########################################################################
/*

   2 Place an order

   Page to place an order

*/
##########################################################################

if(isset($_GET['order']) and $_SESSION['username']) {
    $hashkey = $config['key']['hash'];
    $keyVerify = password_verify($hashkey.$_SESSION['userid'], $_GET['key']);

    if($keyVerify) {
        $acceptItem = getItem($_GET['order']);

        echo '<div class="basicPage">';
        echo "<p>".$lang['confirmation']['order']."</p>";
        echo "<p><b>".$acceptItem[0]['name']."</b></p>";
        echo '<form action="index.php" method="post">';
        echo '    <p><input type="text" name="description" class="inputField" placeholder="'.$lang['fields']['notes'].'" /></p>';
        echo '    <p><input type="hidden" name="item" value="'.$_GET['order'].'" /></p>';
        echo '    <p><input type="hidden" name="order" /></p>';
        echo '    <p><input type="submit" value="'.$lang['buttons']['order'].'" class="button" /></p>';
        echo '</form>';
        echo '</div>';
    }
    else {
        echo "<p class='error'>Da ist bei der Bestellung etwas schiefgelaufen!</p>";
        logTxt("ERROR: Key verification was not possible - UserId: ".$_SESSION['userid']);
    }
}

?>
