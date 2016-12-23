<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: usermanagement.php

Files in the modules folder are used for handling the visible content

*/
##########################################################################
##########################################################################
##########################################################################
/*

   1 USERS Page

   Page to set manage all Users
   - Grant Admin rights
   - Reset password to Initial password
   - Delete user

*/
##########################################################################
##########################################################################
##########################################################################

if(isset($_GET['page']) and $_GET['page']=='users' and $_SESSION['username'] and $_SESSION['useradmin'] ) {
    $allUsers = getAllUsers();
    $hashkey = $siteSettings[0]['initialPassword'];
    $key = password_hash($hashkey.$_SESSION['userid'], PASSWORD_DEFAULT);

    echo '<div class="basicPage">';
    echo "<p class='paragraphTitle'><b>".$lang['titles']['users']."</b></p><br />";
    echo "  <table class='baseTable'>";
    echo "      <tr class='header'><td>".$lang['tableHeaders']['username']."</td><td>".$lang['tableHeaders']['admin']."</td><td>".$lang['tableHeaders']['permissions']."</td><td>".$lang['tableHeaders']['reset']."</td><td>".$lang['tableHeaders']['delete']."</td></tr>";
    for($i = 0; $i < count($allUsers); $i++) {
        if($allUsers[$i]['administrator']) {
            $adminState = $lang['states']['admin'];
        }
        else {
            $adminState = $lang['states']['user'];
        }
        echo '  <tr>';
        echo '      <td>'.$allUsers[$i]['username'].'</td><td>'.$adminState.'</td>';
        if($allUsers[$i]['id'] != 1) {
            echo '      <td><form action="#" method="post"><p class="center"><input type="hidden" name="changeAdminRights" value="'.$allUsers[$i]['id'].'" /><button onclick="return confirm(\''.$lang['confirmation']['changeAdminRights'].'\')" class="button" id="small"/><i class="fa fa-cogs" aria-hidden="true"></i></button></p></form></td>';
            echo '      <td><form action="#" method="post"><p class="center"><input type="hidden" name="resetPassword" value="'.$allUsers[$i]['id'].'" /><button onclick="return confirm(\''.$lang['confirmation']['passReset'].'\')" class="button" id="small"/><i class="fa fa-key" aria-hidden="true"></i></button></p></form></td>';
            echo '      <td><form action="#" method="post"><p class="center"><input type="hidden" name="deleteUser" value="'.$allUsers[$i]['id'].'" /><button onclick="return confirm(\''.$lang['confirmation']['deleteUser'].'\')" class="button" id="small"/><i class="fa fa-trash" aria-hidden="true"></i></button></p></form></td>';
        }
        else {
            echo '<td></td><td></td><td></td>';
        }
        echo '  </tr>';

    }
    echo '  </table>';
    echo '  </form><br />';
    echo '  <a href="index.php?page=createUser" class="button" id="small">'.$lang['buttons']['createUser'].'</a><br /><br /> ';
    echo '  <b>'.$lang['fields']['initialpassword'].':</b> '.$siteSettings[0]['initialPassword'].'<br /><br />';
    echo '</div>';
}

##########################################################################
/*

   2 CREATE USER Page

   Page to create Users

*/
##########################################################################

if(isset($_GET['page']) and $_GET['page']=='createUser' and $_SESSION['username'] and $_SESSION['useradmin'] ) {

    echo '<div class="basicPage">';
    echo "<p class='paragraphTitle'>".$lang['titles']['createUser']."</p>";
    echo '<form action="#" method="post">';
    echo '    <p><input type="text" name="username" class="inputField" placeholder="'.$lang['fields']['username'].'" id="username"/></p>';
    echo '    <p><input type="hidden" name="createUser" /></p>';
    echo '    <p><input type="submit" value="'.$lang['buttons']['create'].'" class="button" /></p>';
    echo '</form>';
    echo "<p>".$lang['texts']['usernameWillHaveInitialPass']."</p>";
    echo '</div>';

}

?>
