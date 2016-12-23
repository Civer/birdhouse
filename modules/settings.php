<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: settings.php

Files in the modules folder are used for handling the visible content

*/
##########################################################################
##########################################################################
##########################################################################
/*

   1 SETTINGS Page

   Page to link to all other special settings

*/
##########################################################################
##########################################################################
##########################################################################

if(isset($_GET['page']) and $_GET['page']=='config' and $_SESSION['username'] and $_SESSION['useradmin'] ) {
    echo '<div class="basicPage">';
    echo "  <p class='paragraphTitle'><b>".$lang['titles']['pageSettings']."</b></p><br />";
    echo '      <p><a href="index.php?page=configLanguage" class="button">'.$lang['buttons']['changePageSettings'].'</a></p>';
    echo '      <p><a href="index.php?page=configColors" class="button">'.$lang['buttons']['editColors'].'</a></p>';
    echo '  <br />';
    echo '</div>';
}

##########################################################################
/*

   2 COLORS Page

   Page to set all Colors
   Colors can be reset to a global default

*/
##########################################################################

if(isset($_GET['page']) and $_GET['page']=='configColors' and $_SESSION['username'] and $_SESSION['useradmin'] ) {
    $colorArray = getColors();

        echo '<div class="basicPage">';
        echo "<p class='paragraphTitle'><b>".$lang['titles']['colors']."</b></p><br />";
        echo '  <form action="#" method="post">';
        echo "      <table class='baseTable'>";
        echo '          <tr><td>Background</td><td><input class="jscolor" name ="background" value="'.$colorArray["background"].'"></td></tr>';
        echo '          <tr><td>Outer Box</td><td><input class="jscolor" name ="outerBox" value="'.$colorArray["outerBox"].'"></td></tr>';
        echo '          <tr><td>Basic Page</td><td><input class="jscolor" name ="basicPage" value="'.$colorArray["basicPage"].'"></td></tr>';
        echo '          <tr><td>Ingredients</td><td><input class="jscolor" name ="ingredients" value="'.$colorArray["ingredients"].'"></td></tr>';
        echo '          <tr><td>Table Background</td><td><input class="jscolor" name ="tableBackground" value="'.$colorArray["tableBackground"].'"></td></tr>';
        echo '          <tr><td>Boxshadow</td><td><input class="jscolor" name ="boxshadow" value="'.$colorArray["boxshadow"].'"></td></tr>';
        echo '          <tr><td>Button Shadow</td><td><input class="jscolor" name ="buttonShadow" value="'.$colorArray["buttonShadow"].'"></td></tr>';
        echo '          <tr><td>Button Color 1</td><td><input class="jscolor" name ="buttonColor1" value="'.$colorArray["buttonColor1"].'"></td></tr>';
        echo '          <tr><td>Button Color 2</td><td><input class="jscolor" name ="buttonColor2" value="'.$colorArray["buttonColor2"].'"></td></tr>';
        echo '          <tr><td>Button Border</td><td><input class="jscolor" name ="buttonBorder" value="'.$colorArray["buttonBorder"].'"></td></tr>';
        echo '          <tr><td>Button Font Color</td><td><input class="jscolor" name ="fontColorButton" value="'.$colorArray["fontColorButton"].'"></td></tr>';
        echo '          <tr><td>Text Shadow</td><td><input class="jscolor" name ="textShadow" value="'.$colorArray["textShadow"].'"></td></tr>';
        echo '          <tr><td>Border</td><td><input class="jscolor" name ="border" value="'.$colorArray["border"].'"></td></tr>';
        echo '          <tr><td>Input Field Border</td><td><input class="jscolor" name ="inputFieldBorder" value="'.$colorArray["inputFieldBorder"].'"></td></tr>';
        echo '          <tr><td>Input Field Shadow</td><td><input class="jscolor" name ="inputFieldShadow" value="'.$colorArray["inputFieldShadow"].'"></td></tr>';
        echo '          <tr><td>Font Color</td><td><input class="jscolor" name ="fontColor" value="'.$colorArray["fontColor"].'"></td></tr>';
        echo "      </table>";
        echo '      <input type="hidden" name="colorPicker" /><br />';
        echo '      <p class="buttonMargin"><input type="submit" value="'.$lang['buttons']['editColors'].'" class="button"/></p>';
        echo '  </form><br /><form action="#" method="post"><p class="buttonMargin"><input type="hidden" name="resetColors" /><input type="submit" value="'.$lang['buttons']['reset'].'" onclick="return confirm(\''.$lang['confirmation']['colorReset'].'\')" class="button"/></p>';
        echo '  </form><br />';
        echo '</div>';
}

##########################################################################
/*

   3 GENERAL SETTINGS Page

   Page to change general page settings

*/
##########################################################################

if(isset($_GET['page']) and $_GET['page']=='configLanguage' and $_SESSION['username'] and $_SESSION['useradmin'] ) {

        echo '<div class="basicPage">';
        echo "<p class='paragraphTitle'><b>".$lang['titles']['generalPageSettings']."</b></p><br />";
        echo '  <form action="#" method="post">';
        echo "      <table class='baseTable'>";
        echo '          <tr><td><b>'.$lang['fields']['sitename'].'</b></td><td>';
        echo '              <p><input type="text" name="sitetitle" class="inputField" placeholder="'.$lang['fields']['sitename'].'" value="'.$siteSettings[0]['sitename'].'"/></p>';
        echo '          </td></tr>';
        echo '          <tr><td><b>'.$lang['fields']['siteslogan'].'</b></td><td>';
        echo '              <p><input type="text" name="siteslogan" class="inputField" placeholder="'.$lang['fields']['siteslogan'].'" value="'.$siteSettings[0]['siteslogan'].'"/></p>';
        echo '          </td></tr>';
        echo '          <tr><td><b>'.$lang['fields']['initialpassword'].'</b></td><td>';
        echo '              <p><input type="text" name="initialPassword" class="inputField" placeholder="'.$lang['fields']['initialpassword'].'" value="'.$siteSettings[0]['initialPassword'].'"/></p>';
        echo '          </td></tr>';
        echo '          <tr><td><b>'.$lang['fields']['language'].'</b></td><td>';
        echo '              <select name="language" class="inputField">';
        echo '              <option value="de">'.$lang['languages']['de'].'</option>';
        echo '              <option value="en">'.$lang['languages']['en'].'</option>';
        echo '              </select>';
        echo '          </td></tr>';
        echo "      </table>";
        echo '      <input type="hidden" name="generalPageSettings" /><br />';
        echo '      <p class="buttonMargin"><input type="submit" value="'.$lang['buttons']['changeSettings'].'" class="button"/></p>';
        echo '  </form><br />';
        echo '</div>';
}

?>
