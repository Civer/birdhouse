<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: install.php

This file is used to install Birdhouse Party Manager Application

*/
##########################################################################
##########################################################################
##########################################################################

session_start();

require __DIR__."/include/formActions/installActions.php";

?>

<html>
    <head>
        <title>Install Birdhouse Party Manager</title>
        <meta charset="utf-8" />
    </head>
    <body>
        <img class='logo' src='./img/logo.png' />
        <div class="container">
            <p class='paragraphTitle'><b></b></p><br />
              <form action="#" method="post">
                  <table class='baseTable'>
                      <tr><td><b>Project Name</b></td><td>
                          <p><input type="text" name="sitetitle" class="inputField" placeholder="Project Name" value=""/></p>
                      </td></tr>
                      <tr><td><b>Project Slogan</b></td><td>
                          <p><input type="text" name="siteslogan" class="inputField" placeholder="Project Slogan" value=""/></p>
                      </td></tr>
                      <tr><td><b>Initial Password</b></td><td>
                          <p><input type="text" name="initialPassword" class="inputField" placeholder="Inital Password" value=""/></p>
                      </td></tr>
                      <tr><td><b>Language</b></td><td>
                          <select name="language" class="inputField">
                          <option value="de">German</option>
                          <option value="en">English</option>
                          </select>
                      </td></tr><tr><td>&nbsp;</td></tr>
                      <tr><td><b>MySQL DB Name</b></td><td>
                          <p><input type="text" name="dbname" class="inputField" placeholder="DB Name" value=""/></p>
                      </td></tr>
                      <tr><td><b>MySQL DB Username</b></td><td>
                          <p><input type="text" name="dbusername" class="inputField" placeholder="DB Username" value=""/></p>
                      </td></tr>
                      <tr><td><b>MySQL DB Password</b></td><td>
                          <p><input type="text" name="dbpassword" class="inputField" placeholder="DB Password" value=""/></p>
                      </td></tr>
                      <tr><td><b>MySQL DB Host</b></td><td>
                          <p><input type="text" name="dbhost" class="inputField" placeholder="DB Host" value=""/></p>
                      </td></tr>
                  </td></tr><tr><td>&nbsp;</td></tr>
                  <tr><td><b>Pusher App Key</b></td><td>
                      <p><input type="text" name="pusherappkey" class="inputField" placeholder="Pusher App Key" value=""/></p>
                  </td></tr>
                  <tr><td><b>Pusher Secret Key</b></td><td>
                      <p><input type="text" name="pusherappsecret" class="inputField" placeholder="Pusher Secret Key" value=""/></p>
                  </td></tr>
                  <tr><td><b>Pusher App Id</b></td><td>
                      <p><input type="text" name="pusherappid" class="inputField" placeholder="Pusher App Id" value=""/></p>
                  </td></tr>
                  </td></tr><tr><td>&nbsp;</td></tr>
                  <tr><td><b>First User</b></td><td>
                      <p><input type="text" name="username" class="inputField" placeholder="Username" value=""/></p>
                  </td></tr>
                  <tr><td><b>User Password</b></td><td>
                      <p><input type="text" name="password" class="inputField" placeholder="Password" value=""/></p>
                  </td></tr>
                  </td></tr><tr><td>&nbsp;</td></tr>
                  <tr><td><b>Install Dummy Data</b></td><td>
                      <p><input type="checkbox" name="dummyData" value="on"/></p>
                  </td></tr>
                  </table>
                      <input type="hidden" name="generalPageSettings" /><br />
                      <p class="buttonMargin"><input type="submit" value="Create Project" class="button"/></p>
              </form><br />
            </div>
        </div>
    </body>
</html>
