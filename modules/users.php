<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: users.php

Files in the modules folder are used for handling the visible content

*/
##########################################################################
##########################################################################
##########################################################################
/*

   1 LOGIN

   Loginpage to enter Username and Password
   A form is triggering the user.php (include/actions)

*/
##########################################################################
##########################################################################
##########################################################################

if(isset($_GET['page']) and $_GET['page']=='login') {
    echo'<div class="basicPage">';
    echo"   <p class='paragraphTitle'><b>".$lang['titles']['login']."</b></p><br />";
    echo'   <form action="index.php" method="post">';
    echo'       <input type="text" name="username" placeholder="'.$lang['fields']['username'].'" class="inputField" /><br />';
    echo'       <input type="password" name="password" placeholder="'.$lang['fields']['password'].'" class="inputField" /><br />';
    echo'       <input type="hidden" name="loginForm" /><br />';
    echo'       <p class="buttonMargin"><input type="submit" value="'.$lang['buttons']['login'].'" class="button"/></p>';
    echo'   </form><br />';
    echo'</div>';
}

##########################################################################
/*

   2 LOGOUT (Settings)

   Logout and Change Password Page
   Both forms are triggering the user.php (include/actions)

*/
##########################################################################

if(isset($_GET['page']) and $_GET['page']=='settings' and isset($_SESSION['username'])) {

    echo "<div class='basicPage'>";
    echo "<p class='paragraphTitle'><b>".$lang['titles']['settings']."</b></p><br />";
    echo '  <form action="#" method="post">';
    echo "      <table>";
    if($_SESSION['descEnable']) {
        echo '          <tr><td>'.$lang['settings']['showDescription'].': </td><td><input type="checkbox" name="descEnable" value="descEnable" checked/></td></tr>';
    }
    else {
        echo '          <tr><td>'.$lang['settings']['showDescription'].': </td><td><input type="checkbox" name="descEnable" value="descEnable" /></td></tr>';
    }
    if($_SESSION['ingrEnable']) {
        echo '          <tr><td>'.$lang['settings']['showIngredients'].': </td><td><input type="checkbox" name="ingrEnable" value="ingrEnable" checked/></td></tr>';
    }
    else {
        echo '          <tr><td>'.$lang['settings']['showIngredients'].': </td><td><input type="checkbox" name="ingrEnable" value="ingrEnable" /></td></tr>';
    }
    echo "      </table><br />";
    echo '    <input type="hidden" name="changeSettings" />';
    echo '    <input type="submit" value="'.$lang['buttons']['changeSettings'].'" class="button" id="small"/>';
    echo '  </form><br /><hr />';
    echo "<p class='paragraphTitle'><b>".$lang['titles']['changePassword']."</b></p>";
    echo '  <form action="#" method="post">';
    echo '      <input type="password" name="newPassword" placeholder="'.$lang['fields']['newPassword'].'" class="inputField" /><br />';
    echo '      <input type="password" name="newPasswordVerify" placeholder="'.$lang['fields']['confirmPassword'].'" class="inputField" /><br />';
    echo '      <input type="hidden" name="changePassword" />';
    echo '      <input type="submit" value="'.$lang['buttons']['changePassword'].'" class="button" id="small"/>';
    echo '  </form>';
    echo "<br /><hr /><p></p>";
    echo '  <form action="#" method="post">';
    echo '      <input type="hidden" name="logoutForm" />';
    echo '      <input type="submit" value="'.$lang['buttons']['logout'].'" class="button"/>';
    echo '  </form><br /></div>';

}

?>
