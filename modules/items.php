<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: items.php

Files in the modules folder are used for handling the visible content

*/
##########################################################################
##########################################################################
##########################################################################
/*

   1 CREATE ITEM Page

   Page to create Items

*/
##########################################################################
##########################################################################
##########################################################################

if(isset($_GET['page']) and $_GET['page']=='createItem' and $_SESSION['username'] and $_SESSION['useradmin'] ) {

    $category = getCategoryById($_GET['cat']);
    $subCategories = getSubcategories($category[0]['id']);

    echo '<div class="basicPage">';
    echo "<p class='paragraphTitle'>".$lang['titles']['createItem']."</p>";
    echo "<p>".$lang['fields']['category'].": <b>".$category[0]['name']."</b><br />";

    //Item Entry Form
    echo '<form action="#" method="post">';
    echo "<select name='subcategory' class='inputField'>";
    echo '<option value="0">'.$lang['fields']['none'].'</option>';
    foreach($subCategories as $subcategory) {
        echo '<option value="'.$subcategory['id'].'">'.$subcategory['name'].'</option>';
    }
    echo "</select></p>";
        echo '    <input type="text" name="name" class="inputField" placeholder="'.$lang['fields']['name'].'" id="category"/><br />';
        echo '    <textarea name="description" class="inputFieldWide" placeholder="'.$lang['fields']['description'].'" rows="6"></textarea><br /><br />';
        echo '    <span class="ingredientCheckbox">';
            echo '    <input type="checkbox" name="showOnSuggestionPage" />';
        echo ' '.$lang['fields']['showOnSuggestionPage'].'</span><br /><br />';

        //Ingredient Loop
        for ($i = 1; $i <= 8; $i++ ) {
            $ingr = 'ingr'.$i;
            $ingr_admin = 'ingr'.$i.'_admin';
            $ingr_show = 'ingr'.$i.'_show';
            echo '    <input type="text" name="'.$ingr.'" class="inputField" placeholder="'.$lang['fields']['ingredient'].'" id="category"/>';
            echo '    <input type="text" name="'.$ingr_admin.'" class="inputField" placeholder="'.$lang['fields']['ingredientAdmin'].'" id="category" />';
            echo '    <span class="ingredientCheckbox">';
                echo '    <input type="checkbox" name="'.$ingr_show.'" checked/>';
            echo '</span><br />';
        }

        echo '    <textarea name="adminDescription" class="inputFieldWide" placeholder="'.$lang['fields']['adminDescription'].'" rows="6"></textarea><br />';

        //Status and Submit
        echo '    <p><select name="status" class="inputField"><option value="active">'.$lang['states']['active'].'</option><option value="inactive">'.$lang['states']['inactive'].'</option></select></p>';
        echo '    <input type="hidden" name="category" value="'.$_GET['cat'].'"/>';
        echo '    <input type="hidden" name="createItem" />';
        echo '    <p><input type="submit" value="'.$lang['buttons']['create'].'" class="button" /></p>';
    echo '</form>';

    echo '<a href="index.php?page=manageCategory&cat='.$_GET['cat'].'" class="button" id="small">'.$lang['buttons']['back'].'</a><br /><br />';
    echo '</div>';

}

##########################################################################
/*

   2 EDIT ITEM Page

   Page to edit Items

*/
##########################################################################

if(isset($_GET['page']) and $_GET['page']=='editItem' and $_SESSION['username'] and $_SESSION['useradmin'] ) {

    $item = getItem($_GET['item']);
    $item = $item[0];
    $status = $item['active'];
    for ($i = 1; $i <= 8; $i++ ) {
        $ingr_array[$i] = $item['ingr'.$i.'_show'];
    }

    $category = getCategoryById($item['categoryId']);
    $subCategories = getSubcategories($category[0]['id']);

    echo '<div class="basicPage">';
    echo "<p class='paragraphTitle'>".$lang['titles']['editItem']."</p>";

    //Item Entry Form
    echo '<form action="index.php?page=manageCategory&cat='.$item['categoryId'].'" method="post">';
    echo "<p>".$lang['fields']['category'].": <b>".$category[0]['name']."</b><br />";

    echo "<select name='subcategory' class='inputField'>";
    echo '<option value="0">'.$lang['fields']['none'].'</option>';
    foreach($subCategories as $subcategory) {
        if($subcategory['id'] == $item['subcategoryId']) {
            echo '<option value="'.$subcategory['id'].'" selected>'.$subcategory['name'].'</option>';
        }
        else {
            echo '<option value="'.$subcategory['id'].'">'.$subcategory['name'].'</option>';
        }
    }
    echo "</select></p>";

        echo '    <p><input type="text" name="name" class="inputField" placeholder="'.$lang['fields']['name'].'" value ="'.$item['name'].'" id="category"/><br />';
        echo '    <textarea name="description" class="inputFieldWide" placeholder="'.$lang['fields']['description'].'" rows="6">'.$item['description'].'</textarea></p>';
        echo '    <span class="ingredientCheckbox">';
        if($item['showOnSuggestionPage']) {
            echo '    <input type="checkbox" name="showOnSuggestionPage" checked />';
        }
        else {
            echo '    <input type="checkbox" name="showOnSuggestionPage" />';
        }
        echo ' '.$lang['fields']['showOnSuggestionPage'].'</span><br /><br />';

        //Ingredient Loop
        for ($i = 1; $i <= 8; $i++ ) {
            $ingr = 'ingr'.$i;
            $ingr_admin = 'ingr'.$i.'_admin';
            $ingr_show = 'ingr'.$i.'_show';
            echo '    <input type="text" name="'.$ingr.'" class="inputField" placeholder="'.$lang['fields']['ingredient'].'" value ="'.$item[$ingr].'" id="category"/>';
            echo '    <input type="text" name="'.$ingr_admin.'" class="inputField" placeholder="'.$lang['fields']['ingredientAdmin'].'" value ="'.$item[$ingr_admin].'" id="category" />';
            echo '    <span class="ingredientCheckbox">';
                if($item[$ingr_show]) {
                    echo '    <input type="checkbox" name="'.$ingr_show.'" checked />';
                }
                else {
                    echo '    <input type="checkbox" name="'.$ingr_show.'" />';
                }
            echo '</span><br />';
        }

        echo '    <textarea name="adminDescription" class="inputFieldWide" placeholder="'.$lang['fields']['adminDescription'].'" rows="6">'.$item['adminDescription'].'</textarea><br />';

        //Status Flag
        if($status) {
            echo '    <p><select name="status" class="inputField"><option value="active">'.$lang['states']['active'].'</option><option value="inactive">'.$lang['states']['inactive'].'</option></select></p>';
        }
        else {
            echo '    <p><select name="status" class="inputField"><option value="active">'.$lang['states']['active'].'</option><option value="inactive" selected>'.$lang['states']['inactive'].'</option></select></p>';
        }
    echo '    <input type="hidden" name="item" value="'.$_GET['item'].'"/>';
    echo '    <input type="hidden" name="editItem" />';
    echo '    <p><input type="submit" value="'.$lang['buttons']['change'].'" class="button" /></p>';
    echo '</form>';
    //echo '<form action="#" method="post"><p class="center"><input type="hidden" name="deleteItem" value="'.$_GET['item'].'" /><button onclick="return confirm(\''.$lang['confirmation']['deleteItem'].'\')" class="button" id="small"/>'.$lang['buttons']['delete'].'</button></p></form>';
    echo '<hr class="alternate" /><p><a href="index.php?page=manageCategory&cat='.$item['categoryId'].'" class="button" id="small">'.$lang['buttons']['back'].'</a></p>';
    echo '</div>';

}

?>
