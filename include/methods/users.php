<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: users.php

This is used for storing all functions used in the solution
related to users.

Functions will mostly be run by the Action scripts.
Some of them are triggered from index and content as well.

*/
##########################################################################
##########################################################################
##########################################################################
#
#   Table of Content
#
#   2       Users
#   2.1         loginUser($providedUsername, $providedPassword)
#   2.2         getUser($id)
#   2.3         getAllUsers()
#   2.4         changePassword($userId,$password,$passwordVerify)
#   2.5         createUser($username)
#   2.6         changeAdminRights($userId)
#   2.7         deleteUser($userId)
#   2.8         changeSettings($userId,$descEnable, $ingrEnable)
#
##########################################################################
##########################################################################
##########################################################################

/*

   2.1 loginUser($providedUsername, $providedPassword)

   This will take a username and a password and tries to log the user in.

*/

##########################################################################
##########################################################################
##########################################################################

    function loginUser($providedUsername, $providedPassword) {

        $pageSettings = getSettings();
        include dirname(dirname(__DIR__))."/ressources/config.php";
        include dirname(dirname(__DIR__))."/ressources/lang/".$pageSettings[0]['lang'].".php"; //Get the proper language from DB

        $conn = getConnection();

        logTxt("Trying to log in with username: ".$providedUsername);

        $hashkey = $config['key']['hash'];
        $encryptedPassword = password_hash($providedPassword.$hashkey, PASSWORD_DEFAULT);

        $sql = "SELECT id, username, password, creationdate, administrator, descEnable, ingrEnable FROM users WHERE username = '".$providedUsername."'";

        $index = 0;
        foreach ($conn->query($sql) as $row) {
            $index++;
            $passwordVerify = password_verify($providedPassword.$hashkey, $row['password']);
            if($passwordVerify){
                $_SESSION['userid'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['useradmin'] = $row['administrator'];
                $_SESSION['descEnable'] = $row['descEnable'];
                $_SESSION['ingrEnable'] = $row['ingrEnable'];
                logTxt("SUCCESS: ".$providedUsername." logged in!");
                //echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';

            }
            else {
                echo "<p class='error'>".$lang['texts']['LoginFailed']."</p>";
                logTxt("ERROR: Username exists but Password is wrong!");
                //echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?page=login&error=wp">';
            }
        }
        if($index == 0) {
            echo "<p class='error'>".$lang['texts']['LoginFailed']."</p>";
            logTxt("ERROR: Username does not exist!");
            //echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?page=login&error=wp">';
        }

        $conn = null; #Close Connection

    }

##########################################################################

/*

   2.2 getUser($id)

   This will get a user from the database by id

*/

##########################################################################

    function getUser($id) {

        $conn = getConnection();
        $sql = "SELECT id, username, administrator FROM users WHERE id = ".$id;
        $index = 0;
        $results = array();

        foreach ($conn->query($sql) as $row) {
            $index++;
            array_push($results,
                array(
                    "id" => $row["id"],
                    "username" => utf8_encode($row["username"]),
                    "administrator" => $row["administrator"],
                )
            );
        }

        if($index == 0) {
            logTxt("ERROR: No User found!");
        }

        #logTxt("Users loaded: ".$index);

        $conn = null; #Close Connection

        return $results;
    }

##########################################################################

/*

   2.3 getAllUsers()

   This will get all users at once (used for administration)

*/

##########################################################################

    function getAllUsers() {

        $conn = getConnection();
        $sql = "SELECT id, username, administrator FROM users";
        $index = 0;
        $results = array();

        foreach ($conn->query($sql) as $row) {
            $index++;
            array_push($results,
                array(
                    "id" => $row["id"],
                    "username" => utf8_encode($row["username"]),
                    "administrator" => utf8_encode($row["administrator"]),
                )
            );
        }

        if($index == 0) {
            logTxt("ERROR: No User found!");
        }

        #logTxt("Users loaded: ".$index);

        $conn = null; #Close Connection

        return $results;
    }

##########################################################################

/*

   2.4 changePassword($userId,$password,$passwordVerify)

   This will push a new password for a user to the database
   The password can be changed by the user or can be reset
   using the administration menu

*/

##########################################################################

    function changePassword($userId,$password,$passwordVerify) {

        $pageSettings = getSettings();
        include dirname(dirname(__DIR__))."/ressources/config.php";
        include dirname(dirname(__DIR__))."/ressources/lang/".$pageSettings[0]['lang'].".php"; //Get the proper language from DB

        if ($password == $passwordVerify) {
            if(strlen($password) >= 8) {
                $hashkey = $config['key']['hash'];
                $encryptedPassword = password_hash($password.$hashkey, PASSWORD_DEFAULT);

                $conn = getConnection();

                $sql = "UPDATE users SET password = '".$encryptedPassword."' WHERE id = ".$userId;

                $conn->exec($sql);

                echo "<p class='success'>".$lang['texts']['passwordChanged']."</p>";
            }
            else {
                echo "<p class='error'>".$lang['texts']['passwortShort']."</p>";
            }
        }
        else {
            echo "<p class='error'>".$lang['texts']['passwordMismatch']."</p>";
        }

    }

##########################################################################

/*

   2.5 createUser($username)

   This function will create a user and will set an Initialpassword

*/

##########################################################################

    function createUser($username) {

        require dirname(dirname(__DIR__))."/ressources/config.php";
        $siteSettings = getSettings();
        include dirname(dirname(__DIR__))."/ressources/lang/".$siteSettings[0]['lang'].".php"; //Get the proper language from DB
        $initPass = $siteSettings[0]['initialPassword'];

        $hashkey = $config['key']['hash'];
        $encryptedPassword = password_hash($initPass.$hashkey, PASSWORD_DEFAULT);

        $conn = getConnection();

        $sql = "INSERT INTO users (username, password, creationdate, administrator) VALUES ('".utf8_decode($username)."', '".$encryptedPassword."',CURRENT_TIMESTAMP, 0)";

        $conn->exec($sql);

        echo "<p class='success'>".$lang['texts']['userCreated1'].$username.$lang['texts']['userCreated2']."</p>";

    }

##########################################################################

/*

   2.6 changeAdminRights($userId)

   Change the admin rights to the opposing flag

*/

##########################################################################

    function changeAdminRights($userId) {

        $pageSettings = getSettings();
        include dirname(dirname(__DIR__))."/ressources/lang/".$pageSettings[0]['lang'].".php"; //Get the proper language from DB

        $conn = getConnection();

        #logTxt("Trying to UPDATE an order in the database!");

        $sql = "SELECT administrator FROM users WHERE id = '".$userId."'";
        foreach ($conn->query($sql) as $row) {
            $admin = $row['administrator'];

            if($admin & $userId != 1) {
                $sql2 = "UPDATE users SET administrator = 0 WHERE id = ".$userId;
            }
            else {
                $sql2 = "UPDATE users SET administrator = 1 WHERE id = ".$userId;
            }

            $conn->exec($sql2);

        }

        $conn = null;

        #logTxt("SQL Executed. Order Updated!");

    }

##########################################################################

/*

   2.7 deleteUser($userId)

   This will delete the User

*/

##########################################################################

    function deleteUser($userId) {

        $pageSettings = getSettings();
        include dirname(dirname(__DIR__))."/ressources/lang/".$pageSettings[0]['lang'].".php"; //Get the proper language from DB

        $conn = getConnection();

        $sql = "DELETE FROM users WHERE id = ".$userId;

        $conn->exec($sql);

        echo "<p class='success'>".$lang['texts']['userDeleted1'].$userId.$lang['texts']['userDeleted2']."</p>";

    }

##########################################################################

/*

   2.8 changeSettings($userId,$descEnable, $ingrEnable)

   This is used to save specific user settings
   Right now the following settings can be changed
   - description visible

*/

##########################################################################

    function changeSettings($userId,$descEnable, $ingrEnable) {

        $pageSettings = getSettings();
        include dirname(dirname(__DIR__))."/ressources/lang/".$pageSettings[0]['lang'].".php"; //Get the proper language from DB

        $conn = getConnection();

        if($descEnable) {
            $sql = "UPDATE users SET descEnable = 1 WHERE id = ".$userId;
            $conn->exec($sql);
            $_SESSION['descEnable'] = 1;
        }
        else {
            $sql = "UPDATE users SET descEnable = 0 WHERE id = ".$userId;
            $conn->exec($sql);
            $_SESSION['descEnable'] = 0;
        }

        if($ingrEnable) {
            $sql = "UPDATE users SET ingrEnable = 1 WHERE id = ".$userId;
            $conn->exec($sql);
            $_SESSION['ingrEnable'] = 1;
        }
        else {
            $sql = "UPDATE users SET ingrEnable = 0 WHERE id = ".$userId;
            $conn->exec($sql);
            $_SESSION['ingrEnable'] = 0;
        }

        echo "<p class='success'>".$lang['texts']['settingsSaved']."</p>";

    }

?>
