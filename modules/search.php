<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: search.php

Files in the modules folder are used for handling the visible content

*/
##########################################################################
##########################################################################
##########################################################################
/*

   1 Search

*/
##########################################################################
##########################################################################
##########################################################################

if(isset($_GET['page']) and $_GET['page']=='search') {

    $allItems = getItemsWithSearchstring($_GET['search']);

    $hashkey = $config['key']['hash'];
    $key = password_hash($hashkey.$_SESSION['userid'], PASSWORD_DEFAULT);

    //Filter the active and inactive Items
    $allItemsActive = array_filter($allItems, function ($var) {
        if($var['active']) {
            return $var;
        }
    });

    $allItemsInactive = array_filter($allItems, function ($var) {
        if(!$var['active']) {
            return $var;
        }
    });

    //Active items
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
                    echo '<td class="menu"><a href="index.php?order='.$item['id'].'&key='.$key.'" class="button" id="butMyOrders">Bestellen</a></td>';
                    echo '<td class="menu"><form action="#" method="post"><p class="center"><input type="hidden" name="deactivateItem" value="'.$item['id'].'" /><button onclick="return confirm(\''.$lang['confirmation']['deactivateItem'].'\')" class="button" id="small"/><i class="fa fa-toggle-on" aria-hidden="true"></i></button></p></form></td>';
                    echo'</tr></table></p>';
                }
                else if(isset($_SESSION['username'])) {
                    echo '<p class="itemButtonParagraph"><a href="index.php?order='.$item['id'].'&key='.$key.'" class="button" id="butMyOrders">Bestellen</a></p>';
                }
                else {
                    echo '<br />';
                }
                echo '</div>';
            echo '</div>';
        }
    }

    if(count($allItemsActive) == 0) {
        echo '<div class="basicPage">';
            echo '<p class="paragraphTitle"><b>'.$lang['texts']['noSearchResult'].'</b></p><br />';
        echo '</div>';
    }

    //Inactive Items (For Admin Only)
    if(isset($_SESSION['username']) and $_SESSION['useradmin']) {

        echo "<br /><hr /><br />";
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
                        echo '<td class="menu"><a href="index.php?order='.$item['id'].'&key='.$key.'" class="button" id="butMyOrders">Bestellen</a></td>';
                        echo '<td class="menu"><form action="#" method="post"><p class="center"><input type="hidden" name="activateItem" value="'.$item['id'].'" /><button onclick="return confirm(\''.$lang['confirmation']['deactivateItem'].'\')" class="button" id="small"/><i class="fa fa-toggle-off" aria-hidden="true"></i></button></p></form></td>';
                        echo'</tr></table></p>';
                    }
                    else if(isset($_SESSION['username'])) {
                        echo '<p class="itemButtonParagraph"><a href="index.php?order='.$item['id'].'&key='.$key.'" class="button" id="butMyOrders">Bestellen</a></p>';
                    }
                    else {
                        echo '<br />';
                    }
                    echo '</div>';
                echo '</div>';
            }
        }

        if(count($allItemsInactive) == 0) {
            echo '<div class="basicPage">';
                echo '<p class="paragraphTitle"><b>'.$lang['texts']['noSearchResultInactive'].'</b></p><br />';
            echo '</div>';
        }

    }
}

?>
