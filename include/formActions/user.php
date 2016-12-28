<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: category.php

This script is used to handle all form activities related to users

*/
##########################################################################
##########################################################################
##########################################################################

if(isset($_POST['loginForm'])) {
    loginUser($_POST['username'], $_POST['password']);
}

if (isset($_POST['logoutForm'])) {
    $_SESSION['userid'] = null;
    $_SESSION['username'] = null;
    $_SESSION['useradmin'] = null;
    $_SESSION['descEnable'] = null;
    $_SESSION['ingrEnable'] = null;
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
}

if (isset($_POST['changePassword'])) {
    changePassword($_SESSION['userid'], $_POST['newPassword'], $_POST['newPasswordVerify']);
}

if (isset($_POST['changeAdminRights'])) {
    changeAdminRights($_POST['changeAdminRights']);
}

if (isset($_POST['resetPassword'])) {
    $siteSettings = getSettings();
    $initPass = $siteSettings[0]['initialPassword'];
    changePassword($_POST['resetPassword'], $initPass, $initPass);
}

if (isset($_POST['deleteUser'])) {
    deleteUser($_POST['deleteUser']);
}

if (isset($_POST['createUser'])) {
    $validUserTest = getAllUsers();

    //Used to check if username is already in use
    $index = 0;
    foreach ($validUserTest as $userValid) {
        if(strtoupper($userValid['username']) == strtoupper($_POST['username'])) {
            $index++;
        }
    }

    if($index == 0){
        createUser($_POST['username']);
    }
    else {
        echo '<p class="error">Der Benutzername'.$_POST['createUser'].' existiert schon</p>';
    }
}

if (isset($_POST['changeSettings'])) {
    changeSettings($_SESSION['userid'],$_POST['descEnable'],$_POST['ingrEnable']);
}

?>
