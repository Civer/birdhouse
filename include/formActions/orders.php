<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: orders.php

This script is used to handle all form activities related to ordermanagement

*/
##########################################################################
##########################################################################
##########################################################################

if (isset($_POST['order'])) {
    setOrder($_POST['description'],$_GET['order']);
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
}

/*
// Deprecated (Checkbox)
if (isset($_POST['switchOrderState'])) {
    foreach($_POST as $value) {
        if($value!='Status ändern') {
            completeOrder($value);
        }
    }
}
*/

if(isset($_POST['switchOrderStateSingle'])) {
    completeOrder($_POST['switchOrderStateSingle']);
}

if (isset($_POST['deleteOrder'])) {
    deleteOrder($_POST['deleteOrder']);
}

if (isset($_POST['deleteOrders'])) {
    deleteOrders();
}

?>
