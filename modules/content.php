<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: content.php

Files in the modules folder are used for handling the visible content

*/
##########################################################################
##########################################################################
##########################################################################
/*

   1 INDEX

   First Page which is shown to the user
   In this version the items will be shown
   It is planned to make another page the index
   and create seperate categories

*/
##########################################################################
##########################################################################
##########################################################################

echo '<script src="./js/scripts.js"></script>';
$siteSettings = getSettings();

if((!isset($_GET['page']) and !isset($_GET['order'])) or isset($_GET['page']) and $_GET['page']=='category') {

    if(isset($_GET['page']) and $_GET['page']=='category' and isset($_GET['cat'])) {
        $allItems = getItems($_GET['cat']);
    }
    else {
        $allItems = getItems();
    }

    $hashkey = $config['key']['hash'];
    $key = password_hash($hashkey.$_SESSION['userid'], PASSWORD_DEFAULT);

    $categoryId = getCategoryByName($_GET['cat']);
    $subCategories = getSubcategories($categoryId[0]['id']);

    $subCategoriesActive = array_filter($subCategories, function ($var) {
        if($var['active']) {
            return $var;
        }
    });

    //Filter the active and inactive Items
    $allItemsActive = array_filter($allItems, function ($var) {
        if($var['active']) {
            return $var;
        }
    });

    $allActiveItemsWithoutSubcat = array_filter($allItemsActive, function ($var) {
        if($var['subcategoryId'] == 0) {
            return $var;
        }
    });

    $allActiveItemsInADeactivatedSubcat = array_filter($allItemsActive, function ($var) {
        $subCat = getSubcategoryById($var['subcategoryId']);
        if($subCat and $subCat[0]['active'] == 0) {
            return $var;
        }
    });

    $allItemsInactive = array_filter($allItems, function ($var) {
        if(!$var['active']) {
            return $var;
        }
    });


    ##########################################################################
    /*

    If Subcategories are enabled the following block will cluster them

    */
    ##########################################################################

    if($subCategoriesActive) {

        echo '<div class="subCategoryTitleFixed">';
        echo '<h3>'.$categoryId[0]['name'].'</h3>';
        echo '</div>';

        foreach($subCategoriesActive as $subCat) {

            $subCatArray = subCatFilter($allItemsActive, $subCat);

            echo '<div class="subCategoryTitle" onclick="toggleSubcategory('.$subCat['id'].')">';
            echo '<h3>'.$subCat['name'].' ('.count($subCatArray).')</h3>';
            echo '</div>';

            echo '<div class="subCategory" id="subCat'.$subCat['id'].'">';

            foreach($subCatArray as $item) {

                $category = getCategoryById($item['categoryId']);

                if($category[0]['active']) {
                    echo '<div class="basicPage">';
                    echo '<p class="paragraphTitle"><b>'.$item['name'].'</b></p>';
                    echo '<div class="description">';
                        if(isset($_SESSION['username']) and $_SESSION['descEnable'] == 0) {} else {
                            echo '<p class="paragraphDescription">"'.$item['description'].'"</p>'; //Only shown when ELSE!!!!!!
                        }
                    echo '</div>';
                    echo '<div class="ingredientsList">';
                        if(isset($_SESSION['username']) and $_SESSION['ingrEnable'] == 0) {} else {
                            for($j = 1; $j <= 8; $j++) {
                                if($item['ingr'.$j] and $item['ingr'.$j.'_show']) {
                                    echo '<p class="itemIngredients">'.$item['ingr'.$j].'</p>'; //Only shown when ELSE!!!!!!
                                }
                            }
                        }
                    echo '</div>';
                    echo '<div class="orderButtons">';
                    if(isset($_SESSION['username']) and $_SESSION['useradmin']) {
                        echo '<p class="itemButtonParagraph"><table><tr>';
                        echo '<td class="menu"><a href="index.php?page=editItem&item='.$item['id'].'" class="button" id="small"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>';
                        echo '<td class="menu"><a href="index.php?order='.$item['id'].'&key='.$key.'" class="button" id="butMyOrders">'.$lang['buttons']['order'].'</a></td>';
                        echo '<td class="menu"><form action="#" method="post"><p class="center"><input type="hidden" name="deactivateItem" value="'.$item['id'].'" /><button onclick="return confirm(\''.$lang['confirmation']['deactivateItem'].'\')" class="button" id="small"/><i class="fa fa-toggle-on" aria-hidden="true"></i></button></p></form></td>';
                        echo'</tr></table></p>';
                    }
                    else if(isset($_SESSION['username'])) {
                        echo '<p class="itemButtonParagraph"><a href="index.php?order='.$item['id'].'&key='.$key.'" class="button" id="butMyOrders">'.$lang['buttons']['order'].'</a></p>';
                    }
                    else {
                        echo '<br />';
                    }
                    echo '</div>';
                    echo '</div>';
                }
            }
            echo '</div>';
        }

        ##########################################################################
        /*

        All items without Subcategory will be put into this part

        */
        ##########################################################################

        echo '<div class="subCategoryTitle" onclick="toggleSubcategory(0)">';
        echo '<h3>'.$lang['fields']['withoutSubcategory'].' ('.count($allActiveItemsWithoutSubcat).')</h3>';
        echo '</div>';

        echo '<div class="subCategory" id="subCat0">';

        foreach($allActiveItemsWithoutSubcat as $item) {

            $category = getCategoryById($item['categoryId']);

                if($category[0]['active']) {
                    echo '<div class="basicPage">';
                    echo '<p class="paragraphTitle"><b>'.$item['name'].'</b></p>';
                    echo '<div class="description">';
                        if(isset($_SESSION['username']) and $_SESSION['descEnable'] == 0) {} else {
                            echo '<p class="paragraphDescription">"'.$item['description'].'"</p>'; //Only shown when ELSE!!!!!!
                        }
                    echo '</div>';
                    echo '<div class="ingredientsList">';
                        if(isset($_SESSION['username']) and $_SESSION['ingrEnable'] == 0) {} else {
                            for($j = 1; $j <= 8; $j++) {
                                if($item['ingr'.$j] and $item['ingr'.$j.'_show']) {
                                    echo '<p class="itemIngredients">'.$item['ingr'.$j].'</p>'; //Only shown when ELSE!!!!!!
                                }
                            }
                        }
                    echo '</div>';
                    echo '<div class="orderButtons">';
                    if(isset($_SESSION['username']) and $_SESSION['useradmin']) {
                        echo '<p class="itemButtonParagraph"><table><tr>';
                        echo '<td class="menu"><a href="index.php?page=editItem&item='.$item['id'].'" class="button" id="small"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>';
                        echo '<td class="menu"><a href="index.php?order='.$item['id'].'&key='.$key.'" class="button" id="butMyOrders">'.$lang['buttons']['order'].'</a></td>';
                        echo '<td class="menu"><form action="#" method="post"><p class="center"><input type="hidden" name="deactivateItem" value="'.$item['id'].'" /><button onclick="return confirm(\''.$lang['confirmation']['deactivateItem'].'\')" class="button" id="small"/><i class="fa fa-toggle-on" aria-hidden="true"></i></button></p></form></td>';
                        echo'</tr></table></p>';
                    }
                    else if(isset($_SESSION['username'])) {
                        echo '<p class="itemButtonParagraph"><a href="index.php?order='.$item['id'].'&key='.$key.'" class="button" id="butMyOrders">'.$lang['buttons']['order'].'</a></p>';
                    }
                    else {
                        echo '<br />';
                    }
                    echo '</div>';
                    echo '</div>';
                }
        }
        echo '</div>';


    ##########################################################################
    /*

    All items within a deactivate Subcategory will be put into this part

    */
    ##########################################################################

        if(isset($_SESSION['username']) and $_SESSION['useradmin'] and count($allActiveItemsInADeactivatedSubcat) != 0) {

            echo "<br /><hr /><br />";

            echo '<div class="subCategoryTitle" onclick="toggleInactiveSubcategories()">';
            echo '<h3>'.$lang['fields']['withInactiveSubcategory'].' ('.count($allActiveItemsInADeactivatedSubcat).')</h3>';
            echo '</div>';
            echo '<div class="inactiveItems" id="inactiveSubcategories">';
                foreach($allActiveItemsInADeactivatedSubcat as $item) {

                    $category = getCategoryById($item['categoryId']);

                    if($category[0]['active']) {
                        echo '<div class="basicPage">';
                            echo '<p class="paragraphTitle"><b>'.$item['name'].'</b></p>';
                            echo '<div class="description">';
                                if(isset($_SESSION['username']) and $_SESSION['descEnable'] == 0) {} else {
                                    echo '<p class="paragraphDescription">"'.$item['description'].'"</p>'; //Only shown when ELSE!!!!!!
                                }
                            echo '</div>';
                            echo '<div class="ingredientsList">';
                                if(isset($_SESSION['username']) and $_SESSION['ingrEnable'] == 0) {} else {
                                    for($j = 1; $j <= 8; $j++) {
                                        if($item['ingr'.$j]) {
                                            echo '<p class="itemIngredients">'.$item['ingr'.$j].'</p>'; //Only shown when ELSE!!!!!!
                                        }
                                    }
                                }
                            echo '</div>';
                            echo '<div class="orderButtons">';
                            if(isset($_SESSION['username']) and $_SESSION['useradmin']) {
                                echo '<p class="itemButtonParagraph"><table><tr>';
                                echo '<td class="menu"><a href="index.php?page=editItem&item='.$item['id'].'" class="button" id="small"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>';
                                //echo '<td class="menu"><a href="index.php?order='.$item['id'].'&key='.$key.'" class="button" id="butMyOrders">'.$lang['buttons']['order'].'</a></td>';
                                                        echo '<td class="menu"><form action="#" method="post"><p class="center"><input type="hidden" name="deactivateItem" value="'.$item['id'].'" /><button onclick="return confirm(\''.$lang['confirmation']['deactivateItem'].'\')" class="button" id="small"/><i class="fa fa-toggle-on" aria-hidden="true"></i></button></p></form></td>';
                                echo'</tr></table></p>';
                            }
                            else if(isset($_SESSION['username'])) {
                                echo '<p class="itemButtonParagraph"><a href="index.php?order='.$item['id'].'&key='.$key.'" class="button" id="butMyOrders">'.$lang['buttons']['order'].'</a></p>';
                            }
                            else {
                                echo '<br />';
                            }
                            echo '</div>';
                        echo '</div>';
                    }
                }
            echo '</div>';
        }
    }

    ##########################################################################
    /*

    If there is no active Subcategory but it is a category page
    this block will be triggered

    */
    ##########################################################################

    elseif($categoryId) {

        echo '<div class="subCategoryTitleFixedNoSubCategories">';
        echo '<h3>'.$categoryId[0]['name'].'</h3>';
        echo '</div>';

        echo '<div class="category" id="cat'.$categoryId[0]['id'].'">';

        foreach($allItemsActive as $item) {

            $category = getCategoryById($item['categoryId']);

            if($category[0]['active']) {
                echo '<div class="basicPage">';
                    echo '<p class="paragraphTitle"><b>'.$item['name'].'</b></p>';
                    echo '<div class="description">';
                        if(isset($_SESSION['username']) and $_SESSION['descEnable'] == 0) {} else {
                            echo '<p class="paragraphDescription">"'.$item['description'].'"</p>'; //Only shown when ELSE!!!!!!
                        }
                    echo '</div>';
                    echo '<div class="ingredientsList">';
                        if(isset($_SESSION['username']) and $_SESSION['ingrEnable'] == 0) {} else {
                            for($j = 1; $j <= 8; $j++) {
                                if($item['ingr'.$j] and $item['ingr'.$j.'_show']) {
                                    echo '<p class="itemIngredients">'.$item['ingr'.$j].'</p>'; //Only shown when ELSE!!!!!!
                                }
                            }
                        }
                    echo '</div>';
                    echo '<div class="orderButtons">';
                    if(isset($_SESSION['username']) and $_SESSION['useradmin']) {
                        echo '<p class="itemButtonParagraph"><table><tr>';
                        echo '<td class="menu"><a href="index.php?page=editItem&item='.$item['id'].'" class="button" id="small"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>';
                        echo '<td class="menu"><a href="index.php?order='.$item['id'].'&key='.$key.'" class="button" id="butMyOrders">'.$lang['buttons']['order'].'</a></td>';
                        echo '<td class="menu"><form action="#" method="post"><p class="center"><input type="hidden" name="deactivateItem" value="'.$item['id'].'" /><button onclick="return confirm(\''.$lang['confirmation']['deactivateItem'].'\')" class="button" id="small"/><i class="fa fa-toggle-on" aria-hidden="true"></i></button></p></form></td>';
                        echo'</tr></table></p>';
                    }
                    else if(isset($_SESSION['username'])) {
                        echo '<p class="itemButtonParagraph"><a href="index.php?order='.$item['id'].'&key='.$key.'" class="button" id="butMyOrders">'.$lang['buttons']['order'].'</a></p>';
                    }
                    else {
                        echo '<br />';
                    }
                    echo '</div>';
                echo '</div>';
            }
        }
        echo '</div>';
    }

    ##########################################################################
    /*

    If the main page is shown trigger this block

    */
    ##########################################################################

    else {

        $allCategories = getAllCategories();

        foreach($allCategories as $cat) {
            $allCategoryItemsActive = CatFilter($allItemsActive, $cat);

            if(count($allCategoryItemsActive) != 0 and $cat['active'] == 1) {

                echo '<div class="subCategoryTitleFixedMainpage" onclick="toggleCategory('.$cat['id'].')">';
                echo '<h3>'.$cat['name'].'</h3>';
                echo '</div>';

                echo '<div class="category" id="cat'.$cat['id'].'">';
                foreach($allCategoryItemsActive as $item) {

                    $category = getCategoryById($item['categoryId']);

                    if($category[0]['active']) {
                        echo '<div class="basicPage">';
                            echo '<p class="paragraphTitle"><b>'.$item['name'].'</b></p>';
                            echo '<div class="description">';
                                if(isset($_SESSION['username']) and $_SESSION['descEnable'] == 0) {} else {
                                    echo '<p class="paragraphDescription">"'.$item['description'].'"</p>'; //Only shown when ELSE!!!!!!
                                }
                            echo '</div>';
                            echo '<div class="ingredientsList">';
                                if(isset($_SESSION['username']) and $_SESSION['ingrEnable'] == 0) {} else {
                                    for($j = 1; $j <= 8; $j++) {
                                        if($item['ingr'.$j] and $item['ingr'.$j.'_show']) {
                                            echo '<p class="itemIngredients">'.$item['ingr'.$j].'</p>'; //Only shown when ELSE!!!!!!
                                        }
                                    }
                                }
                            echo '</div>';
                            echo '<div class="orderButtons">';
                            if(isset($_SESSION['username']) and $_SESSION['useradmin']) {
                                echo '<p class="itemButtonParagraph"><table><tr>';
                                echo '<td class="menu"><a href="index.php?page=editItem&item='.$item['id'].'" class="button" id="small"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>';
                                echo '<td class="menu"><a href="index.php?order='.$item['id'].'&key='.$key.'" class="button" id="butMyOrders">'.$lang['buttons']['order'].'</a></td>';
                                echo '<td class="menu"><form action="#" method="post"><p class="center"><input type="hidden" name="deactivateItem" value="'.$item['id'].'" /><button onclick="return confirm(\''.$lang['confirmation']['deactivateItem'].'\')" class="button" id="small"/><i class="fa fa-toggle-on" aria-hidden="true"></i></button></p></form></td>';
                                echo'</tr></table></p>';
                            }
                            else if(isset($_SESSION['username'])) {
                                echo '<p class="itemButtonParagraph"><a href="index.php?order='.$item['id'].'&key='.$key.'" class="button" id="butMyOrders">'.$lang['buttons']['order'].'</a></p>';
                            }
                            else {
                                echo '<br />';
                            }
                            echo '</div>';
                        echo '</div>';
                    }
                }
                echo '</div>';
            }
        }
    }

    //Inactive Items (For Admin Only)
    if(isset($_SESSION['username']) and $_SESSION['useradmin'] and count($allItemsInactive) != 0) {

        echo "<br /><hr /><br />";

        echo '<div class="subCategoryTitle" onclick="toggleInactive()">';
        echo '<h3>'.$lang['states']['inactive'].' ('.count($allItemsInactive).')</h3>';
        echo '</div>';
        echo '<div class="inactiveItems" id="inactive">';
            foreach($allItemsInactive as $item) {

                $category = getCategoryById($item['categoryId']);

                if($category[0]['active']) {
                    echo '<div class="basicPage">';
                        echo '<p class="paragraphTitle"><b>'.$item['name'].'</b></p>';
                        echo '<div class="description">';
                            if(isset($_SESSION['username']) and $_SESSION['descEnable'] == 0) {} else {
                                echo '<p class="paragraphDescription">"'.$item['description'].'"</p>'; //Only shown when ELSE!!!!!!
                            }
                        echo '</div>';
                        echo '<div class="ingredientsList">';
                            if(isset($_SESSION['username']) and $_SESSION['ingrEnable'] == 0) {} else {
                                for($j = 1; $j <= 8; $j++) {
                                    if($item['ingr'.$j]) {
                                        echo '<p class="itemIngredients">'.$item['ingr'.$j].'</p>'; //Only shown when ELSE!!!!!!
                                    }
                                }
                            }
                        echo '</div>';
                        echo '<div class="orderButtons">';
                        if(isset($_SESSION['username']) and $_SESSION['useradmin']) {
                            echo '<p class="itemButtonParagraph"><table><tr>';
                            echo '<td class="menu"><a href="index.php?page=editItem&item='.$item['id'].'" class="button" id="small"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>';
                            //echo '<td class="menu"><a href="index.php?order='.$item['id'].'&key='.$key.'" class="button" id="butMyOrders">'.$lang['buttons']['order'].'</a></td>';
                            echo '<td class="menu"><form action="#" method="post"><p class="center"><input type="hidden" name="activateItem" value="'.$item['id'].'" /><button onclick="return confirm(\''.$lang['confirmation']['activateItem'].'\')" class="button" id="small"/><i class="fa fa-toggle-off" aria-hidden="true"></i></button></p></form></td>';
                            echo'</tr></table></p>';
                        }
                        else if(isset($_SESSION['username'])) {
                            echo '<p class="itemButtonParagraph"><a href="index.php?order='.$item['id'].'&key='.$key.'" class="button" id="butMyOrders">'.$lang['buttons']['order'].'</a></p>';
                        }
                        else {
                            echo '<br />';
                        }
                        echo '</div>';
                    echo '</div>';
                }
            }
        echo '</div>';
    }
}

?>
