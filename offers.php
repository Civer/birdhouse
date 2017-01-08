<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: offers.php

In this file all the visible content shown in the div.offers element
is handled

*/
##########################################################################
##########################################################################
##########################################################################

$allCategories = getAllCategories();

$allActiveCategories = array_filter($allCategories, function ($var) {
    if($var['active']) {
        return $var;
    }
});

echo '<span class="offers"><a href="index.php" class="button" id="butAllOrders">&nbsp;<i class="fa fa-star" aria-hidden="true"></i>&nbsp;</a></span>';

foreach ($allActiveCategories as $category) {
    echo '<span class="offers"><a href="index.php?page=category&cat='.$category['name'].'" class="button" id="butCocktails">'.$category['name'].'</a></span>';
}


#echo '<a href="index.php" class="button" id="butCocktails">Cocktails</a>';

 ?>
