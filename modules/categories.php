<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: categories.php

Files in the modules folder are used for handling the visible content

*/
##########################################################################
##########################################################################
##########################################################################
/*

   1 CATEGORY Page

   Page to manage all Categories

*/
##########################################################################
##########################################################################
##########################################################################

if(isset($_GET['page']) and $_GET['page']=='configureCategories' and $_SESSION['username'] and $_SESSION['useradmin'] ) {

    $allCategories = getAllCategories();

    echo '<div class="basicPage">';
    echo "<p class='paragraphTitle'><b>".$lang['titles']['categories']."</b></p><br />";
    echo "  <table class='baseTable'>";
    echo "      <tr class='header'><td>".$lang['tableHeaders']['category']."</td><td>".$lang['tableHeaders']['state']."</td>"./*"<td>Neu</td>".*/"<td>".$lang['tableHeaders']['edit']."</td><td>".$lang['tableHeaders']['onoff']."</td><td>".$lang['tableHeaders']['delete']."</td></tr>";
    foreach($allCategories as $category) {
        if($category['active']) {
            $state = $lang['states']['active'];
        }
        else {
            $state = $lang['states']['inactive'];
        }
        echo '  <tr>';
        echo '      <td>'.$category['name'].'</td><td>'.$state.'</td>';
        //echo '      <td class="centered"><a href="index.php?page=createItem&cat='.$category['id'].'" class="button" id="small"><i class="fa fa-plus" aria-hidden="true"></i></a></td>';
        echo '      <td class="centered"><a href="index.php?page=manageCategory&cat='.$category['id'].'" class="button" id="small"><i class="fa fa-cogs" aria-hidden="true"></i></a></td>';
        echo '      <td class="centered"><form action="#" method="post"><p class="center"><input type="hidden" name="changeCategoryState" value="'.$category['id'].'" /><button onclick="return confirm(\''.$lang['confirmation']['changeCategoryState'].'\')" class="button" id="small"/><i class="fa fa-power-off" aria-hidden="true"></i></button></p></form></td>';
        echo '      <td class="centered"><form action="#" method="post"><p class="center"><input type="hidden" name="deleteCategory" value="'.$category['id'].'" /><button onclick="return confirm(\''.$lang['confirmation']['deleteCategory'].'\')" class="button" id="small"/><i class="fa fa-trash" aria-hidden="true"></i></button></p></form></td>';
        echo '  </tr>';

    }
    echo '  </table>';
    echo '  </form><br />';
    echo '  <a href="index.php?page=createCategory" class="button" id="small">'.$lang['buttons']['createCategory'].'</a><br /><br /> ';
    echo '</div>';
}

##########################################################################
/*

   2 MANAGE CATEGORY Page

   Page to manage all Categories

*/
##########################################################################

if(isset($_GET['page']) and $_GET['page']=='manageCategory' and $_SESSION['username'] and $_SESSION['useradmin'] ) {

    $items = getItems($_GET['cat']);
    $subCategories = getSubcategories($_GET['cat']);
    $category = getCategoryById($_GET['cat']);

    echo '<div class="basicPage">';

    //Items

    echo "<p class='paragraphTitle'><b>".$lang['titles']['editItems']."</b></p>";
    echo "<p>".$lang['fields']['category'].": ".$category[0]['name']."</p>";
    echo "  <table class='baseTable'>";
    echo "      <tr class='header'><td>".$lang['tableHeaders']['name']."</td><td>".$lang['tableHeaders']['state']."</td><td>".$lang['tableHeaders']['edit']."</td><td>".$lang['tableHeaders']['onoff']."</td><td>".$lang['tableHeaders']['delete']."</td></tr>";
    foreach($items as $item) {
        if($item['active']) {
            $state = $lang['states']['active'];
        }
        else {
            $state = $lang['states']['inactive'];
        }
        echo '  <tr>';
        echo '      <td>'.$item['name'].'</td><td>'.$state.'</td>';
        echo '      <td class="centered"><a href="index.php?page=editItem&item='.$item['id'].'" class="button" id="small"><i class="fa fa-cog" aria-hidden="true"></i></a></td>';
        if($item['active']) {
            echo '      <td class="centered"><form action="#" method="post"><p class="center"><input type="hidden" name="deactivateItem" value="'.$item['id'].'" /><button class="button" id="small"/><i class="fa fa-power-off" aria-hidden="true"></i></button></p></form></td>';
        }
        else {
            echo '      <td class="centered"><form action="#" method="post"><p class="center"><input type="hidden" name="activateItem" value="'.$item['id'].'" /><button class="button" id="small"/><i class="fa fa-power-off" aria-hidden="true"></i></button></p></form></td>';
        }

        echo '      <td class="centered"><form action="#" method="post"><p class="center"><input type="hidden" name="deleteItem" value="'.$item['id'].'" /><button onclick="return confirm(\''.$lang['confirmation']['deleteItem'].'\')" class="button" id="small"/><i class="fa fa-trash" aria-hidden="true"></i></button></p></form></td>';
        echo '  </tr>';

    }
    echo '  </table>';
    echo '  </form><br />';
    echo '  <a href="index.php?page=createItem&cat='.$_GET['cat'].'" class="button" id="small">'.$lang['buttons']['createItem'].'</a><br /><br /> ';

    //Subcategories

    echo "<p class='paragraphTitle'><b>".$lang['titles']['editSubcategories']."</b></p><br />";
    echo "  <table class='baseTable'>";
    echo "      <tr class='header'><td>".$lang['tableHeaders']['name']."</td><td>".$lang['tableHeaders']['state']."</td>"./*<td>".$lang['tableHeaders']['edit']."</td>*/"<td>".$lang['tableHeaders']['onoff']."</td><td>".$lang['tableHeaders']['delete']."</td></tr>";
    foreach($subCategories as $subCategory) {
        if($subCategory['active']) {
            $state = $lang['states']['active'];
        }
        else {
            $state = $lang['states']['inactive'];
        }
        echo '  <tr>';
        echo '      <td>'.$subCategory['name'].'</td><td>'.$state.'</td>';
        //echo '      <td class="centered"><a href="index.php?page=editItem&item='.$subCategory['id'].'" class="button" id="small"><i class="fa fa-cog" aria-hidden="true"></i></a></td>';
        echo '      <td class="centered"><form action="#" method="post"><p class="center"><input type="hidden" name="changeSubcategoryState" value="'.$subCategory['id'].'" /><button class="button" id="small"/><i class="fa fa-power-off" aria-hidden="true"></i></button></p></form></td>';
        echo '      <td class="centered"><form action="#" method="post"><p class="center"><input type="hidden" name="deleteSubcategory" value="'.$subCategory['id'].'" /><button onclick="return confirm(\''.$lang['confirmation']['deleteItem'].'\')" class="button" id="small"/><i class="fa fa-trash" aria-hidden="true"></i></button></p></form></td>';
        echo '  </tr>';

    }
    echo '  </table>';
    echo '  </form><br />';
    echo '  <a href="index.php?page=createSubcategory&cat='.$_GET['cat'].'" class="button" id="small">'.$lang['buttons']['createSubcategory'].'</a> <br /><br /> <a href="index.php?page=configureCategories" class="button" id="small">'.$lang['buttons']['back'].'</a> <br /><br />';
    echo '</div>';
}

##########################################################################
/*

   3 CREATE CATEGORY Page

   Page to create Users

*/
##########################################################################

if(isset($_GET['page']) and $_GET['page']=='createCategory' and $_SESSION['username'] and $_SESSION['useradmin'] ) {

    echo '<div class="basicPage">';
    echo "<p class='paragraphTitle'>".$lang['titles']['createCategory']."</p>";
    echo '<form action="#" method="post">';
    echo '    <p><input type="text" name="category" class="inputField" placeholder="'.$lang['fields']['category'].'" id="category"/></p>';
    echo '    <p><input type="hidden" name="createCategory" /></p>';
    echo '    <p><input type="submit" value="'.$lang['buttons']['create'].'" class="button" /></p>';
    echo '</form>';
    echo '</div>';

}

##########################################################################
/*

   4 CREATE SUBCATEGORY Page

   Page to create Users

*/
##########################################################################

if(isset($_GET['page']) and $_GET['page']=='createSubcategory' and $_SESSION['username'] and $_SESSION['useradmin'] ) {

    $category = $_GET['cat'];

    echo '<div class="basicPage">';
    echo "<p class='paragraphTitle'>".$lang['titles']['createSubcategory']."</p>";
    echo '<form action="#" method="post">';
    echo '    <p><input type="text" name="subcategory" class="inputField" placeholder="'.$lang['fields']['subcategory'].'" id="subcategory"/></p>';
    echo '    <p><input type="hidden" name="category" value="'.$category.'" /></p>';
    echo '    <p><input type="hidden" name="createSubcategory" /></p>';
    echo '    <p><input type="submit" value="'.$lang['buttons']['create'].'" class="button" /></p>';
    echo '</form>';
    echo '</div>';

}

?>
