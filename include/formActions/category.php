<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: category.php

This script is used to handle all form activities related to category
or item management

*/
##########################################################################
##########################################################################
##########################################################################

    if(isset($_POST['deactivateItem'])) {
        deactivateItem($_POST['deactivateItem']);
    }

    if(isset($_POST['activateItem'])) {
        activateItem($_POST['activateItem']);
    }

    if(isset($_POST['createItem'])) {

        for ($i = 1; $i <= 8; $i++ ) {
            if($_POST['ingr'.$i.'_show'] == 'on') {
                $ingr_array[$i] = 1;
            }
            else {
                $ingr_array[$i] = 0;
            }
        }

        $itemArray = array(
            "category" => $_POST['category'],
            "subcategory" => $_POST['subcategory'],
            "name" => utf8_decode($_POST['name']),
            "description" => utf8_decode($_POST['description']),
            "ingr1" => utf8_decode($_POST['ingr1']),
            "ingr2" => utf8_decode($_POST['ingr2']),
            "ingr3" => utf8_decode($_POST['ingr3']),
            "ingr4" => utf8_decode($_POST['ingr4']),
            "ingr5" => utf8_decode($_POST['ingr5']),
            "ingr6" => utf8_decode($_POST['ingr6']),
            "ingr7" => utf8_decode($_POST['ingr7']),
            "ingr8" => utf8_decode($_POST['ingr8']),
            "ingr1_admin" => utf8_decode($_POST['ingr1_admin']),
            "ingr2_admin" => utf8_decode($_POST['ingr2_admin']),
            "ingr3_admin" => utf8_decode($_POST['ingr3_admin']),
            "ingr4_admin" => utf8_decode($_POST['ingr4_admin']),
            "ingr5_admin" => utf8_decode($_POST['ingr5_admin']),
            "ingr6_admin" => utf8_decode($_POST['ingr6_admin']),
            "ingr7_admin" => utf8_decode($_POST['ingr7_admin']),
            "ingr8_admin" => utf8_decode($_POST['ingr8_admin']),
            "ingr1_show" => $ingr_array[1],
            "ingr2_show" => $ingr_array[2],
            "ingr3_show" => $ingr_array[3],
            "ingr4_show" => $ingr_array[4],
            "ingr5_show" => $ingr_array[5],
            "ingr6_show" => $ingr_array[6],
            "ingr7_show" => $ingr_array[7],
            "ingr8_show" => $ingr_array[8],
            "status" => $_POST['status']
        );

        createItem($itemArray);
    }

    if(isset($_POST['editItem'])) {

        for ($i = 1; $i <= 8; $i++ ) {
            if($_POST['ingr'.$i.'_show'] == 'on') {
                $ingr_array[$i] = 1;
            }
            else {
                $ingr_array[$i] = 0;
            }
        }

        $itemArray = array(
            "item" => $_POST['item'],
            "subcategory" => $_POST['subcategory'],
            "name" => utf8_decode($_POST['name']),
            "description" => utf8_decode($_POST['description']),
            "ingr1" => utf8_decode($_POST['ingr1']),
            "ingr2" => utf8_decode($_POST['ingr2']),
            "ingr3" => utf8_decode($_POST['ingr3']),
            "ingr4" => utf8_decode($_POST['ingr4']),
            "ingr5" => utf8_decode($_POST['ingr5']),
            "ingr6" => utf8_decode($_POST['ingr6']),
            "ingr7" => utf8_decode($_POST['ingr7']),
            "ingr8" => utf8_decode($_POST['ingr8']),
            "ingr1_admin" => utf8_decode($_POST['ingr1_admin']),
            "ingr2_admin" => utf8_decode($_POST['ingr2_admin']),
            "ingr3_admin" => utf8_decode($_POST['ingr3_admin']),
            "ingr4_admin" => utf8_decode($_POST['ingr4_admin']),
            "ingr5_admin" => utf8_decode($_POST['ingr5_admin']),
            "ingr6_admin" => utf8_decode($_POST['ingr6_admin']),
            "ingr7_admin" => utf8_decode($_POST['ingr7_admin']),
            "ingr8_admin" => utf8_decode($_POST['ingr8_admin']),
            "ingr1_show" => $ingr_array[1],
            "ingr2_show" => $ingr_array[2],
            "ingr3_show" => $ingr_array[3],
            "ingr4_show" => $ingr_array[4],
            "ingr5_show" => $ingr_array[5],
            "ingr6_show" => $ingr_array[6],
            "ingr7_show" => $ingr_array[7],
            "ingr8_show" => $ingr_array[8],
            "status" => $_POST['status']
        );

        editItem($itemArray);

    }

    if(isset($_POST['createCategory'])) {
        createCategory($_POST['category']);
    }

    if(isset($_POST['changeCategoryState'])) {
        changeCategoryState($_POST['changeCategoryState']);
    }

    if(isset($_POST['deleteCategory'])) {
        deleteCategory($_POST['deleteCategory']);
    }

    if(isset($_POST['createSubcategory'])) {
        createSubcategory($_POST['subcategory'],$_POST['category']);
    }

    if(isset($_POST['changeSubcategoryState'])) {
        changeSubcategoryState($_POST['changeSubcategoryState']);
    }

    if(isset($_POST['deleteSubcategory'])) {
        deleteSubcategory($_POST['deleteSubcategory']);
    }

    if(isset($_POST['deleteItem'])) {
        deleteItem($_POST['deleteItem']);
    }

?>
