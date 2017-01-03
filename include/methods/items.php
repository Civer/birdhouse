<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: items.php

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
#   1       Items
#   1.1         getItems()
#   1.2         getItem($id)
#   1.4         activateItem($id)
#   1.5         deactivateItem($id)
#   1.6         getAllCategories()
#   1.7         getCategoryByName($name)
#   1.8         getCategoryById($id)
#   1.9         createCategory($category)
#   1.10        changeCategoryState($categoryId)
#   1.11        deleteCategory($categoryId)
#   1.12        getSubcategories($categoryId)
#   1.13        getSubcategoryByName($name)
#   1.14        getSubcategoryById($id)
#   1.15        createSubcategory($subcategory)
#   1.16        changeSubcategoryState($subcategory)
#   1.17        deleteSubcategory($subcategory)
#   1.18        createItem($categoryId, $name, $description, $ingr1, $ingr2, $ingr3, $ingr4, $ingr5, $ingr6, $ingr7, $ingr8, $active)
#   1.19        editItem($id, $name, $description, $ingr1, $ingr2, $ingr3, $ingr4, $ingr5, $ingr6, $ingr7, $ingr8, $active)
#   1.20        deleteItem($id)
#   1.21        changeCategoryName($categoryId, $categoryName)
#   1.22        changeSubcategoryName($subcategoryId, $subcategoryName)
#
##########################################################################
##########################################################################
##########################################################################

/*

   1.1 getItems()

   This is used to get Items from database
   It will get all items. Sorting of active and inactive will be done
   late in code.

*/

##########################################################################
##########################################################################
##########################################################################

    function getItems($category) { //Category is an optional parameter

        $sql = "SELECT id, categoryId, subcategoryId, name, description, adminDescription, orders, ranking,
        ingr1, ingr2, ingr3, ingr4,
        ingr5, ingr6, ingr7, ingr8,
        ingr1_admin, ingr2_admin, ingr3_admin,
        ingr4_admin, ingr5_admin, ingr6_admin, ingr7_admin, ingr8_admin,
        ingr1_show, ingr2_show, ingr3_show, ingr4_show,
        ingr5_show, ingr6_show, ingr7_show, ingr8_show,
        active, showOnSuggestionPage FROM items ORDER BY categoryId, subcategoryId, active ASC";

        if($category) {
            $catByName = getCategoryByName($category);
            $catById = getCategoryById($category);

            if($catByName) {
                $sql = "SELECT id, categoryId, subcategoryId, name, description, adminDescription, orders, ranking,
                ingr1, ingr2, ingr3, ingr4,
                ingr5, ingr6, ingr7, ingr8,
                ingr1_admin, ingr2_admin, ingr3_admin,
                ingr4_admin, ingr5_admin, ingr6_admin, ingr7_admin, ingr8_admin,
                ingr1_show, ingr2_show, ingr3_show, ingr4_show,
                ingr5_show, ingr6_show, ingr7_show, ingr8_show,
                active, showOnSuggestionPage FROM items WHERE categoryId = ".$catByName[0]['id']." ORDER BY categoryId, subcategoryId, active  ASC";
            }
            if($catById) {
                $sql = "SELECT id, categoryId, subcategoryId, name, description, adminDescription, orders, ranking,
                ingr1, ingr2, ingr3, ingr4,
                ingr5, ingr6, ingr7, ingr8,
                ingr1_admin, ingr2_admin, ingr3_admin,
                ingr4_admin, ingr5_admin, ingr6_admin, ingr7_admin, ingr8_admin,
                ingr1_show, ingr2_show, ingr3_show, ingr4_show,
                ingr5_show, ingr6_show, ingr7_show, ingr8_show,
                active, showOnSuggestionPage FROM items WHERE categoryId = ".$catById[0]['id']." ORDER BY categoryId, subcategoryId, active  ASC";
            }
        }

        $conn = getConnection();

        $index = 0;
        $results = array();

        foreach ($conn->query($sql) as $row) {
            $index++;
            array_push($results,
                array(
                    "id" => $row["id"],
                    "categoryId" => $row["categoryId"],
                    "subcategoryId" => $row["subcategoryId"],
                    "name" => utf8_encode($row["name"]),
                    "description" => utf8_encode($row["description"]),
                    "adminDescription" => utf8_encode($row["adminDescription"]),
                    "orders" => $row["orders"],
                    "ranking" => $row["ranking"],
                    "ingr1" => utf8_encode($row["ingr1"]),
                    "ingr2" => utf8_encode($row["ingr2"]),
                    "ingr3" => utf8_encode($row["ingr3"]),
                    "ingr4" => utf8_encode($row["ingr4"]),
                    "ingr5" => utf8_encode($row["ingr5"]),
                    "ingr6" => utf8_encode($row["ingr6"]),
                    "ingr7" => utf8_encode($row["ingr7"]),
                    "ingr8" => utf8_encode($row["ingr8"]),
                    "ingr1_admin" => utf8_encode($row["ingr1_admin"]),
                    "ingr2_admin" => utf8_encode($row["ingr2_admin"]),
                    "ingr3_admin" => utf8_encode($row["ingr3_admin"]),
                    "ingr4_admin" => utf8_encode($row["ingr4_admin"]),
                    "ingr5_admin" => utf8_encode($row["ingr5_admin"]),
                    "ingr6_admin" => utf8_encode($row["ingr6_admin"]),
                    "ingr7_admin" => utf8_encode($row["ingr7_admin"]),
                    "ingr8_admin" => utf8_encode($row["ingr8_admin"]),
                    "ingr1_show" => $row["ingr1_show"],
                    "ingr2_show" => $row["ingr2_show"],
                    "ingr3_show" => $row["ingr3_show"],
                    "ingr4_show" => $row["ingr4_show"],
                    "ingr5_show" => $row["ingr5_show"],
                    "ingr6_show" => $row["ingr6_show"],
                    "ingr7_show" => $row["ingr7_show"],
                    "ingr8_show" => $row["ingr8_show"],
                    "active" => $row["active"],
                    "showOnSuggestionPage" => $row["showOnSuggestionPage"]
                )
            );
        }
        if($index == 0) {
            logTxt("ERROR: No items found!");
        }

        #logTxt("Total items loaded: ".$index);

        $conn = null; #Close Connection

        return $results;
    }

##########################################################################

/*

   1.2 getItem($id)

   This will get a specific item defined by Id

*/

##########################################################################

    function getItem($id) {

        $conn = getConnection();
        $sql = "SELECT id, categoryId, subcategoryId, name, description, adminDescription, orders, ranking,
                    ingr1, ingr2, ingr3, ingr4,
                    ingr5, ingr6, ingr7, ingr8,
                    ingr1_admin, ingr2_admin, ingr3_admin,
                    ingr4_admin, ingr5_admin, ingr6_admin, ingr7_admin, ingr8_admin,
                    ingr1_show, ingr2_show, ingr3_show, ingr4_show,
                    ingr5_show, ingr6_show, ingr7_show, ingr8_show,
                    active, showOnSuggestionPage FROM items WHERE id = ".$id;


        $index = 0;
        $results = array();

        foreach ($conn->query($sql) as $row) {
            $index++;
            array_push($results,
                array(
                    "id" => $row["id"],
                    "categoryId" => $row["categoryId"],
                    "subcategoryId" => $row["subcategoryId"],
                    "name" => utf8_encode($row["name"]),
                    "description" => utf8_encode($row["description"]),
                    "adminDescription" => utf8_encode($row["adminDescription"]),
                    "orders" => $row["orders"],
                    "ranking" => $row["ranking"],
                    "ingr1" => utf8_encode($row["ingr1"]),
                    "ingr2" => utf8_encode($row["ingr2"]),
                    "ingr3" => utf8_encode($row["ingr3"]),
                    "ingr4" => utf8_encode($row["ingr4"]),
                    "ingr5" => utf8_encode($row["ingr5"]),
                    "ingr6" => utf8_encode($row["ingr6"]),
                    "ingr7" => utf8_encode($row["ingr7"]),
                    "ingr8" => utf8_encode($row["ingr8"]),
                    "ingr1_admin" => utf8_encode($row["ingr1_admin"]),
                    "ingr2_admin" => utf8_encode($row["ingr2_admin"]),
                    "ingr3_admin" => utf8_encode($row["ingr3_admin"]),
                    "ingr4_admin" => utf8_encode($row["ingr4_admin"]),
                    "ingr5_admin" => utf8_encode($row["ingr5_admin"]),
                    "ingr6_admin" => utf8_encode($row["ingr6_admin"]),
                    "ingr7_admin" => utf8_encode($row["ingr7_admin"]),
                    "ingr8_admin" => utf8_encode($row["ingr8_admin"]),
                    "ingr1_show" => $row["ingr1_show"],
                    "ingr2_show" => $row["ingr2_show"],
                    "ingr3_show" => $row["ingr3_show"],
                    "ingr4_show" => $row["ingr4_show"],
                    "ingr5_show" => $row["ingr5_show"],
                    "ingr6_show" => $row["ingr6_show"],
                    "ingr7_show" => $row["ingr7_show"],
                    "ingr8_show" => $row["ingr8_show"],
                    "active" => $row["active"],
                    "showOnSuggestionPage" => $row["showOnSuggestionPage"]
                )
            );
        }

        if($index == 0) {
            logTxt("ERROR: No items found!");
        }

        #logTxt("Item loaded: ".$index);

        $conn = null; #Close Connection

        return $results;
    }

##########################################################################

/*

   1.3 getItemsWithSearchstring($string)

   This will get a special result based on a search string

*/

##########################################################################

    function getItemsWithSearchstring($string) {

        $conn = getConnection();
        $sql = "SELECT id, categoryId, name, description, orders, ranking, ingr1, ingr2, ingr3, ingr4, ingr5, ingr6, ingr7, ingr8, active FROM items WHERE name like '%".$string."%' ORDER BY categoryId, subcategoryId, active DESC";
        $index = 0;
        $results = array();

        foreach ($conn->query($sql) as $row) {
            $index++;
            array_push($results,
                array(
                    "id" => $row["id"],
                    "categoryId" => $row["categoryId"],
                    "name" => utf8_encode($row["name"]),
                    "description" => utf8_encode($row["description"]),
                    "orders" => $row["orders"],
                    "ranking" => $row["ranking"],
                    "ingr1" => utf8_encode($row["ingr1"]),
                    "ingr2" => utf8_encode($row["ingr2"]),
                    "ingr3" => utf8_encode($row["ingr3"]),
                    "ingr4" => utf8_encode($row["ingr4"]),
                    "ingr5" => utf8_encode($row["ingr5"]),
                    "ingr6" => utf8_encode($row["ingr6"]),
                    "ingr7" => utf8_encode($row["ingr7"]),
                    "ingr8" => utf8_encode($row["ingr8"]),
                    "active" => $row["active"]
                )
            );
        }

        if($index == 0) {
            logTxt("ERROR: No items found!");
        }

        #logTxt("Item loaded: ".$index);

        $conn = null; #Close Connection

        return $results;
    }

##########################################################################

/*

   1.4 activateItem($id)

   This will activate a specific Item
   This means it is visible to the customer

*/

##########################################################################

function activateItem($id) {

    $pageSettings = getSettings();
    include dirname(dirname(__DIR__))."/ressources/lang/".$pageSettings[0]['lang'].".php"; //Get the proper language from DB

    $conn = getConnection();

    $sql = "UPDATE items SET active = 1 WHERE id = ".$id;

    $conn->exec($sql);

    echo "<p class='success'>".$lang['texts']['itemActivated']."</p>";

}

##########################################################################

/*

   1.5 deactivateItem($id)

   This will deactivate a specific Item
   This means it is not visible to the customer

*/

##########################################################################

function deactivateItem($id) {

    $pageSettings = getSettings();
    include dirname(dirname(__DIR__))."/ressources/lang/".$pageSettings[0]['lang'].".php"; //Get the proper language from DB

    $conn = getConnection();

    $sql = "UPDATE items SET active = 0 WHERE id = ".$id;

    $conn->exec($sql);

    echo "<p class='success'>".$lang['texts']['itemDeactivated']."</p>";

}

##########################################################################

/*

   1.6 getAllCategories()

   This is used to get all Categories from database

*/

##########################################################################

    function getAllCategories() {

        $conn = getConnection();
        $sql = "SELECT id, name, active FROM categories ORDER BY menuOrder ASC";
        $index = 0;
        $results = array();

        foreach ($conn->query($sql) as $row) {
            $index++;
            array_push($results,
                array(
                    "id" => $row["id"],
                    "name" => utf8_encode($row["name"]),
                    "active" => $row["active"]
                )
            );
        }
        if($index == 0) {
            logTxt("ERROR: No categories found!");
        }

        #logTxt("Total items loaded: ".$index);

        $conn = null; #Close Connection

        return $results;
    }

##########################################################################

/*

   1.7 getCategoryByName($name)

   This is used to get all Categories from database

*/

##########################################################################

    function getCategoryByName($name) {

        $conn = getConnection();
        $sql = "SELECT id, name, active FROM categories WHERE name = '".$name."' ORDER BY menuOrder ASC";
        $index = 0;
        $results = array();

        foreach ($conn->query($sql) as $row) {
            $index++;
            array_push($results,
                array(
                    "id" => $row["id"],
                    "name" => utf8_encode($row["name"]),
                    "active" => $row["active"]
                )
            );
        }
        if($index == 0) {
            logTxt("ERROR: Category ".$name." not found! Continue with blank value");
            return null;
        }
        if($index == 2) {
            logTxt("ERROR: Two Categories with ".$name." found! Continue with blank value");
            return null;
        }

        #logTxt("Total items loaded: ".$index);

        $conn = null; #Close Connection

        return $results;
    }

##########################################################################

/*

   1.8 getCategoryById($id)

   This is used to get all Categories from database

*/

##########################################################################

    function getCategoryById($id) {

        $conn = getConnection();
        $sql = "SELECT id, name, active FROM categories WHERE id = '".$id."' ORDER BY menuOrder ASC";
        $index = 0;
        $results = array();

        foreach ($conn->query($sql) as $row) {
            $index++;
            array_push($results,
                array(
                    "id" => $row["id"],
                    "name" => utf8_encode($row["name"]),
                    "active" => $row["active"]
                )
            );
        }

        #logTxt("Total items loaded: ".$index);

        $conn = null; #Close Connection

        return $results;
    }

##########################################################################

/*

   1.9 createCategory($category)

   This function will create a new category. It is inactive by default.

*/

##########################################################################

    function createCategory($category) {

        $pageSettings = getSettings();
        include dirname(dirname(__DIR__))."/ressources/lang/".$pageSettings[0]['lang'].".php"; //Get the proper language from DB

        $conn = getConnection();

        $sql = "INSERT INTO categories (name, active) VALUES ('".utf8_decode($category)."', 0)";

        $conn->exec($sql);

        //echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?page=configureCategories">';
        echo "<p class='success'>".$lang['texts']['categoryCreated1'].$category.$lang['texts']['categoryCreated2']."</p>";

    }

##########################################################################

/*

   1.10 changeCategoryState($categoryId)

   This function will change the category state from inactive to active

*/

##########################################################################

    function changeCategoryState($categoryId) {

        $conn = getConnection();

        #logTxt("Trying to UPDATE an order in the database!");

        $sql = "SELECT active FROM categories WHERE id = '".$categoryId."'";
        foreach ($conn->query($sql) as $row) {
            $active = $row['active'];

            if($active) {
                $sql2 = "UPDATE categories SET active = 0 WHERE id = ".$categoryId;
            }
            else {
                $sql2 = "UPDATE categories SET active = 1 WHERE id = ".$categoryId;
            }

            $conn->exec($sql2);

        }

        $conn = null;

        #logTxt("SQL Executed. Order Updated!");

    }

##########################################################################

/*

   1.11 deleteCategory($categoryId)

   This will delete a category defined by the Id

*/

##########################################################################

function deleteCategory($categoryId) {

    $pageSettings = getSettings();
    include dirname(dirname(__DIR__))."/ressources/lang/".$pageSettings[0]['lang'].".php"; //Get the proper language from DB

    $itemArray = getItems($categoryId);

    foreach($itemArray as $item) {
        deleteItem($item['id']);
    }

    $subCategories = getSubcategories($categoryId);

    foreach ($subCategories as $subCat) {
        deleteSubcategory($subCat['id']);
    }

    $conn = getConnection();

    $sql = "DELETE FROM categories WHERE id = ".$categoryId;

    $conn->exec($sql);

    echo "<p class='success'>".$lang['texts']['categoryDeleted1'].$categoryId.$lang['texts']['categoryDeleted2']."</p>";

}

##########################################################################

/*

   1.12 getAllSubcategories($categoryId)

   This is used to get all Categories from database

*/

##########################################################################

    function getSubcategories($categoryId) {

        $conn = getConnection();
        if($categoryId) {
            $sql = "SELECT id, name, categoryId, active FROM subCategories WHERE categoryId = '".$categoryId."' ORDER BY menuOrder ASC";
        }
        else {
            $sql = "SELECT id, name, categoryId, active FROM subCategories ORDER BY menuOrder ASC";
        }
        $index = 0;
        $results = array();

        if($categoryId) {
            foreach ($conn->query($sql) as $row) {
                $index++;
                array_push($results,
                    array(
                        "id" => $row["id"],
                        "name" => utf8_encode($row["name"]),
                        "categoryId" => $row["categoryId"],
                        "active" => $row["active"]
                    )
                );
            }
            if($index == 0) {
                logTxt("ERROR: No Subcategories found!");
            }

            #logTxt("Total items loaded: ".$index);

            $conn = null; #Close Connection

            return $results;
        }

        return null;
    }

##########################################################################

/*

   1.13 getSubcategoryByName($name)

   This is used to get all Categories from database

*/

##########################################################################

    function getSubcategoryByName($name) {

        $conn = getConnection();
        $sql = "SELECT id, name, categoryId, active FROM subCategories WHERE name = '".$name."' ORDER BY menuOrder ASC";
        $index = 0;
        $results = array();

        foreach ($conn->query($sql) as $row) {
            $index++;
            array_push($results,
                array(
                    "id" => $row["id"],
                    "name" => utf8_encode($row["name"]),
                    "categoryId" => $row["categoryId"],
                    "active" => $row["active"]
                )
            );
        }
        if($index == 0) {
            logTxt("ERROR: Subcategory ".$name." not found! Continue with blank value");
            return null;
        }
        if($index == 2) {
            logTxt("ERROR: Two Subcategories with ".$name." found! Continue with blank value");
            return null;
        }

        #logTxt("Total items loaded: ".$index);

        $conn = null; #Close Connection

        return $results;
    }

##########################################################################

/*

   1.14 getSubcategoryById($id)

   This is used to get all Categories from database

*/

##########################################################################

    function getSubcategoryById($id) {

        $conn = getConnection();
        $sql = "SELECT id, name, categoryId, active FROM subCategories WHERE id = '".$id."' ORDER BY menuOrder ASC";
        $index = 0;
        $results = array();

        foreach ($conn->query($sql) as $row) {
            $index++;
            array_push($results,
                array(
                    "id" => $row["id"],
                    "name" => utf8_encode($row["name"]),
                    "categoryId" => $row["categoryId"],
                    "active" => $row["active"]
                )
            );
        }
        if($index == 0) {
            logTxt("ERROR: Subcategory ".$name." not found! Continue with blank value");
            return null;
        }
        if($index == 2) {
            logTxt("ERROR: Two Subcategories with ".$name." found! Continue with blank value");
            return null;
        }

        #logTxt("Total items loaded: ".$index);

        $conn = null; #Close Connection

        return $results;
    }

##########################################################################

/*

   1.15 createSubcategory($subcategory)

   This function will create a new category. It is inactive by default.

*/

##########################################################################

    function createSubcategory($subcategory, $categoryId) {

        $pageSettings = getSettings();
        include dirname(dirname(__DIR__))."/ressources/lang/".$pageSettings[0]['lang'].".php"; //Get the proper language from DB

        $conn = getConnection();

        $sql = "INSERT INTO subCategories (name, categoryId ,active) VALUES ('".utf8_decode($subcategory)."', $categoryId, 0)";

        $conn->exec($sql);

        //echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?page=configureCategories">';
        echo "<p class='success'>".$lang['texts']['subcategoryCreated1'].$subcategory.$lang['texts']['subcategoryCreated2']."</p>";

    }

##########################################################################

/*

   1.16 changeCategoryState($categoryId)

   This function will change the category state from inactive to active

*/

##########################################################################

    function changeSubcategoryState($subcategory) {

        $conn = getConnection();

        #logTxt("Trying to UPDATE an order in the database!");

        $sql = "SELECT active FROM subCategories WHERE id = '".$subcategory."'";
        foreach ($conn->query($sql) as $row) {
            $active = $row['active'];

            if($active) {
                $sql2 = "UPDATE subCategories SET active = 0 WHERE id = ".$subcategory;
            }
            else {
                $sql2 = "UPDATE subCategories SET active = 1 WHERE id = ".$subcategory;
            }

            $conn->exec($sql2);

        }

        $conn = null;

        #logTxt("SQL Executed. Order Updated!");

    }

##########################################################################

/*

   1.17 deleteSubcategory($subcategory)

   This will delete a category defined by the Id

*/

##########################################################################

    function deleteSubcategory($subcategory) {

        $pageSettings = getSettings();
        include dirname(dirname(__DIR__))."/ressources/lang/".$pageSettings[0]['lang'].".php"; //Get the proper language from DB

        $conn = getConnection();

            $sql = "UPDATE items SET subcategoryId = 0 WHERE subcategoryId = ".$subcategory;

        $conn->exec($sql);

            $sql = "DELETE FROM subCategories WHERE id = ".$subcategory;

        $conn->exec($sql);

        $conn = null;

        echo "<p class='success'>".$lang['texts']['subcategoryDeleted1'].$subcategory.$lang['texts']['subcategoryDeleted2']."</p>";

    }


##########################################################################

/*

   1.18 createItem($itemArray)

   This will delete a category defined by the Id

*/

##########################################################################

function createItem($itemArray) {

    $pageSettings = getSettings();
    include dirname(dirname(__DIR__))."/ressources/lang/".$pageSettings[0]['lang'].".php"; //Get the proper language from DB

    if($itemArray['status'] == 'active') {
        $status = 1;
    }
    else {
        $status = 0;
    }

    if($itemArray['showOnSuggestionPage'] == 'on') {
        $showOnSuggestionPage = 1;
    }
    else {
        $showOnSuggestionPage = 0;
    }

    $conn = getConnection();

    $sql = "INSERT INTO items
                (categoryId,
                    name,
                    subcategoryId,
                    description,
                    adminDescription,
                    ingr1, ingr2,
                    ingr3, ingr4,
                    ingr5, ingr6,
                    ingr7, ingr8,
                    ingr1_admin, ingr2_admin,
                    ingr3_admin, ingr4_admin,
                    ingr5_admin, ingr6_admin,
                    ingr7_admin, ingr8_admin,
                    ingr1_show, ingr2_show,
                    ingr3_show, ingr4_show,
                    ingr5_show, ingr6_show,
                    ingr7_show, ingr8_show,
                    active, showOnSuggestionPage)
                VALUES
                    ('".addslashes($itemArray['category'])."', '".addslashes($itemArray['name'])."', '".addslashes($itemArray['subcategory'])."', '".addslashes($itemArray['description'])."', '".addslashes($itemArray['adminDescription'])."',
                    '".addslashes($itemArray['ingr1'])."', '".addslashes($itemArray['ingr2'])."',
                    '".addslashes($itemArray['ingr3'])."', '".addslashes($itemArray['ingr4'])."',
                    '".addslashes($itemArray['ingr5'])."', '".addslashes($itemArray['ingr6'])."',
                    '".addslashes($itemArray['ingr7'])."', '".addslashes($itemArray['ingr8'])."',
                    '".addslashes($itemArray['ingr1_admin'])."', '".addslashes($itemArray['ingr2_admin'])."',
                    '".addslashes($itemArray['ingr3_admin'])."', '".addslashes($itemArray['ingr4_admin'])."',
                    '".addslashes($itemArray['ingr5_admin'])."', '".addslashes($itemArray['ingr6_admin'])."',
                    '".addslashes($itemArray['ingr7_admin'])."', '".addslashes($itemArray['ingr8_admin'])."',
                    '".addslashes($itemArray['ingr1_show'])."', '".addslashes($itemArray['ingr2_show'])."',
                    '".addslashes($itemArray['ingr3_show'])."', '".addslashes($itemArray['ingr4_show'])."',
                    '".addslashes($itemArray['ingr5_show'])."', '".addslashes($itemArray['ingr6_show'])."',
                    '".addslashes($itemArray['ingr7_show'])."', '".addslashes($itemArray['ingr8_show'])."',
                    ".$status.", '".$showOnSuggestionPage."')";

                    //throw new Exception($sql);

    $conn->exec($sql);

    echo "<p class='success'>".$lang['texts']['itemCreated1'].$name.$lang['texts']['itemCreated2']."</p>";

}

##########################################################################

/*

   1.19 editItem($itemArray)

   This will delete a category defined by the Id

*/

##########################################################################

function editItem($itemArray) {

    if($itemArray['status'] == 'active') {
        $status = 1;
    }
    else {
        $status = 0;
    }

    if($itemArray['showOnSuggestionPage'] == 'on') {
        $showOnSuggestionPage = 1;
    }
    else {
        $showOnSuggestionPage = 0;
    }

    $conn = getConnection();

    $sql = "UPDATE items SET
                name = '".addslashes($itemArray['name'])."',
                description = '".addslashes($itemArray['description'])."',
                adminDescription = '".addslashes($itemArray['adminDescription'])."',
                subcategoryId = '".addslashes($itemArray['subcategory'])."',
                ingr1 = '".addslashes($itemArray['ingr1'])."', ingr2 = '".addslashes($itemArray['ingr2'])."',
                ingr3 = '".addslashes($itemArray['ingr3'])."', ingr4 = '".addslashes($itemArray['ingr4'])."',
                ingr5 = '".addslashes($itemArray['ingr5'])."', ingr6 = '".addslashes($itemArray['ingr6'])."',
                ingr7 = '".addslashes($itemArray['ingr7'])."', ingr8 = '".addslashes($itemArray['ingr8'])."',
                ingr1_admin = '".addslashes($itemArray['ingr1_admin'])."', ingr2_admin = '".addslashes($itemArray['ingr2_admin'])."',
                ingr3_admin = '".addslashes($itemArray['ingr3_admin'])."', ingr4_admin = '".addslashes($itemArray['ingr4_admin'])."',
                ingr5_admin = '".addslashes($itemArray['ingr5_admin'])."', ingr6_admin = '".addslashes($itemArray['ingr6_admin'])."',
                ingr7_admin = '".addslashes($itemArray['ingr7_admin'])."', ingr8_admin = '".addslashes($itemArray['ingr8_admin'])."',
                ingr1_show = '".addslashes($itemArray['ingr1_show'])."', ingr2_show = '".addslashes($itemArray['ingr2_show'])."',
                ingr3_show = '".addslashes($itemArray['ingr3_show'])."', ingr4_show = '".addslashes($itemArray['ingr4_show'])."',
                ingr5_show = '".addslashes($itemArray['ingr5_show'])."', ingr6_show = '".addslashes($itemArray['ingr6_show'])."',
                ingr7_show = '".addslashes($itemArray['ingr7_show'])."', ingr8_show = '".addslashes($itemArray['ingr8_show'])."',
                active = ".$status.", showOnSuggestionPage = ".$showOnSuggestionPage." WHERE id = ".$itemArray['item'];

    $conn->exec($sql);

    $pageSettings = getSettings();
    include dirname(dirname(__DIR__))."/ressources/lang/".$pageSettings[0]['lang'].".php"; //Get the proper language from DB

    echo "<p class='success'>".$lang['texts']['itemUpdated1'].$itemArray['name'].$lang['texts']['itemUpdated2']."</p>";
}

##########################################################################

/*

   1.20 deleteItem($item)

   This will delete an item defined by the Id

*/

##########################################################################

    function deleteItem($id) {

        $conn = getConnection();

        $sql = "DELETE FROM items WHERE id = ".$id;

        $conn->exec($sql);

        $pageSettings = getSettings();
        include dirname(dirname(__DIR__))."/ressources/lang/".$pageSettings[0]['lang'].".php"; //Get the proper language from DB

        echo "<p class='success'>".$lang['texts']['itemDeleted1'].$id.$lang['texts']['itemDeleted2']."</p>";
    }

##########################################################################

/*

   1.21 changeCategoryName($categoryId, $categoryName)

   This function will change the category name

*/

##########################################################################

    function changeCategoryName($categoryId, $categoryName) {

        $conn = getConnection();

        #logTxt("Trying to UPDATE an order in the database!");

        $sql = "UPDATE categories SET name = '".utf8_decode($categoryName)."' WHERE id = ".$categoryId;

        $conn->exec($sql);

        $conn = null;

        #logTxt("SQL Executed. Order Updated!");

    }

##########################################################################

/*

   1.22 changeSubcategoryName($subcategoryId, $subcategoryName)

   This function will change the subcategory name

*/

##########################################################################

    function changeSubcategoryName($subcategoryId, $subcategoryName) {

        $conn = getConnection();

        #logTxt("Trying to UPDATE an order in the database!");

        $sql = "UPDATE subCategories SET name = '".utf8_decode($subcategoryName)."' WHERE id = '".$subcategoryId."'";

        $conn->exec($sql);

        $conn = null;

        #logTxt("SQL Executed. Order Updated!");

    }

##########################################################################

/*

   1.23 sortCategory(Array)

   This function will change the subcategory name

*/

##########################################################################

    function sortCategory($array) {

        $conn = getConnection();

        #logTxt("Trying to UPDATE an order in the database!");
        $index = 0;

        foreach ($array as $value) {
            $sql = "UPDATE categories SET menuOrder = '".$index."' WHERE id = '".$value."'";
            $conn->exec($sql);
            $index++;
        }

        $conn = null;

        #logTxt("SQL Executed. Order Updated!");

    }

##########################################################################

/*

   1.24 sortSubcategories(Array)

   This function will change the subcategory name

*/

##########################################################################

    function sortSubcategories($array) {

        $conn = getConnection();

        #logTxt("Trying to UPDATE an order in the database!");
        $index = 0;

        foreach ($array as $value) {
            $sql = "UPDATE subCategories SET menuOrder = '".$index."' WHERE id = '".$value."'";
            $conn->exec($sql);
            $index++;
        }

        $conn = null;

        #logTxt("SQL Executed. Order Updated!");

    }

?>
