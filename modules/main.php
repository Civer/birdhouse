<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: main.php

Files in the modules folder are used for handling the visible content

*/
##########################################################################
##########################################################################
##########################################################################
/*

   INDEX

   First Page which is shown to the user
   In this version the items will be shown
   It is planned to make another page the index
   and create seperate categories

   The script is clustered in 2 big parts, containing different subroutines
   - Special Category Pages (Containing 1 Category each)
   - The Main Index Page (Containing all active categories)

   The Subroutine goes as follows:
   - If no subcategory is activated all Item of a Category are shown
   - If there are deactivated Subcategories the items inside them are not shown
   - If subcategories are active and an active item is not assigned to any subcategory
        the item will be shown in a special subcategory named "no subcategory"

    This is true for both Mainpage and Category pages.
    The Index Page will NOT show subcategories due to visibility reasons

*/
##########################################################################
##########################################################################
##########################################################################
/*

   1 ROUTINES AND FILTERING

   Here we do some initial Filtering

*/
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

    2 - CATEGORY PAGES

    2.1 If Subcategories are enabled the following block will cluster them

    */
    ##########################################################################

    if($subCategoriesActive) {

        echo '<div class="subCategoryTitleFixed">';
        echo '<h3>'.$categoryId[0]['name'].'</h3>';
        echo '</div>';

        $index = 0;

        foreach($subCategoriesActive as $subCat) {

            $subCatArray = subCatFilter($allItemsActive, $subCat);

            echo '<div class="subCategoryTitle" onclick="toggleSubcategory('.$subCat['id'].')">';
            echo '<h3 class="subtitle">&nbsp;<span class="subtitleleft"><i class="fa fa-angle-right" id="subCati'.$subCat['id'].'"></i> '.$subCat['name'].'</span> <span class="subtitleright"> ('.count($subCatArray).')</span></h3>';
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
            if($index == 0) {
                echo '<script>toggleSubcategory('.$subCat['id'].')</script>';
            }
            $index++;
        }

        ##########################################################################
        /*

        2 - CATEGORY PAGES

        2.2 All items without Subcategory will be put into this part

        */
        ##########################################################################

        if(count($allActiveItemsWithoutSubcat) > 0) {
            echo '<div class="subCategoryTitle" onclick="toggleSubcategory(0)">';
            echo '<h3 class="subtitle">&nbsp;<span class="subtitleleft"><i class="fa fa-angle-right" id="subCati0"></i> '.$lang['fields']['withoutSubcategory'].'</span> <span class="subtitleright"> ('.count($allActiveItemsWithoutSubcat).')</span></h3>';
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
        }


    ##########################################################################
    /*

    2 - CATEGORY PAGES

    2.3 All items within a deactivate Subcategory will be put into this part

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

    2 - CATEGORY PAGES

    2.4 If there is no active Subcategory but it is a category page
    this block will be triggered

    */
    ##########################################################################

    elseif($categoryId) {

        echo '<div class="subCategoryTitleFixedNoSubCategories">';
        echo '<h3>'.$categoryId[0]['name'].'</h3>';
        echo '</div>';

        //echo '<div class="category" id="cat'.$categoryId[0]['id'].'">';

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
        //echo '</div>';
    }


    ##########################################################################
    ##########################################################################
    ##########################################################################
    /*

    3 - MAIN PAGE

    3.1 If the main page is shown trigger this block

    */
    ##########################################################################
    ##########################################################################
    ##########################################################################


    else {

        $index = 0;
        $allCategories = getAllCategories();

        echo '<div class="subCategoryTitleFixed">';
        echo '<h3>'.$lang['titles']['suggestions'].'</h3>';
        echo '</div>';

        foreach($allCategories as $cat) {
            $allSuggestedItems = CatFilterSuggested($allItemsActive, $cat);

            if(count($allSuggestedItems) != 0 and $cat['active'] == 1) {

                $dontShow = false;

                echo '<div class="subCategoryTitle" onclick="toggleCategory('.$cat['id'].')">';
                echo '<h3 class="subtitle">&nbsp;<span class="subtitleleft"><i class="fa fa-angle-right" id="Cati'.$cat['id'].'"></i> '.$cat['name'].'</span> <span class="subtitleright"> ('.count($allSuggestedItems).')</span></h3>';
                echo '</div>';

                echo '<div class="category" id="Cat'.$cat['id'].'">';



                foreach($allSuggestedItems as $item) {

                    $allCategoryItemsActiveInADeactivatedSubcat = array_filter($allCategoryItemsActive, function ($var) {
                        $subCat = getSubcategoryById($var['subcategoryId']);
                        if($subCat and $subCat[0]['active'] == 0) {
                            return $var;
                        }
                    });

                    foreach($allCategoryItemsActiveInADeactivatedSubcat as $deactivatedSubCatItem) {
                        if($deactivatedSubCatItem['id'] == $item['id']) {
                            $dontShow = true;
                        }
                    }

                    if(!$dontShow or (count($allCategoryItemsActiveInADeactivatedSubcat) == count($allCategoryItemsActive))) {
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
                }
                echo '</div>';
            }
            if($index == 0) {
                echo '<script>toggleCategory('.$cat['id'].')</script>';
            }
            $index++;
        }

        ##########################################################################
        /*

        3 - MAIN PAGE

        3.2 All items within a deactivate Subcategory will be put into this part
        Now the big problem on the main page is, that we have to decide if all
        Categories are disabled (show all entries) or just a few are disabled
        (only show active subcats)

        */
        ##########################################################################

            if(isset($_SESSION['username']) and $_SESSION['useradmin'] and count($allActiveItemsInADeactivatedSubcat) != 0) {

                $count = 0;

                foreach($allActiveItemsInADeactivatedSubcat as $item) {
                    $allSubCatForThisItemCat = getSubcategories($item['categoryId']);
                    $allInactiveSubCats = array_filter($allSubCatForThisItemCat, function ($var) {
                        if($var['active'] == 0) {
                            return $var;
                        }
                    });

                    $category = getCategoryById($item['categoryId']);

                    if($category[0]['active'] && (count($allSubCatForThisItemCat) != count($allInactiveSubCats))) {
                        $count++;
                    }
                }

                echo "<br /><hr /><br />";

                echo '<div class="subCategoryTitle" onclick="toggleInactiveSubcategories()">';
                echo '<h3>'.$lang['fields']['withInactiveSubcategory'].' ('.$count.')</h3>';
                echo '</div>';
                echo '<div class="inactiveItems" id="inactiveSubcategories">';
                    foreach($allActiveItemsInADeactivatedSubcat as $item) {

                        $allSubCatForThisItemCat = getSubcategories($item['categoryId']);
                        $allInactiveSubCats = array_filter($allSubCatForThisItemCat, function ($var) {
                            if($var['active'] == 0) {
                                return $var;
                            }
                        });

                        $category = getCategoryById($item['categoryId']);

                        if($category[0]['active'] && (count($allSubCatForThisItemCat) != count($allInactiveSubCats))) {
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

    3 - MAIN PAGE

    3.3 All inactive Items

    */
    ##########################################################################

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
