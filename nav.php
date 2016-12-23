<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: nav.php

In this file all the visible content shown in the nav element
is handled

*/
##########################################################################
##########################################################################
##########################################################################

$loggedIn = false;
$administrator = false;

if ( $_SESSION['username'] ) {
    $loggedIn = true;
}

if ( $_SESSION['useradmin'] ) {
    $administrator = true;
}

echo '<div class="navigation">';

    if ( $loggedIn && !$administrator ) {
        echo '<a href="index.php?page=myOrders" class="button" id="butMyOrders"><i class="fa fa-tasks" aria-hidden="true"></i></a> ';
        echo '<a href="index.php?page=settings" class="button" id="butLogout"><i class="fa fa-cog" aria-hidden="true"></i></a>';
    }
    elseif ( $loggedIn && $administrator ) {
        echo '<a href="index.php?page=myOrders" class="button" id="butAllOrders"><i class="fa fa-tasks" aria-hidden="true"></i></a> ';
        echo '<a href="index.php?page=configureCategories" class="button" id="configureCategories"><i class="fa fa-bars" aria-hidden="true"></i></a> ';
        echo '<a href="index.php?page=users" class="button" id="users"><i class="fa fa-user" aria-hidden="true"></i></a> ';
        echo '<a href="index.php?page=config" class="button" id="config"><i class="fa fa-terminal" aria-hidden="true"></i></a> ';
        echo '<a href="index.php?page=settings" class="button" id="butLogout"><i class="fa fa-cog" aria-hidden="true"></i></a> ';
    }
    else {
        echo '<a href="index.php?page=login" class="button" id="butLogin"><i class="fa fa-sign-in" aria-hidden="true"></i></a>';
    }

echo '</div>';

echo '<div class="mobileNavigation" id="mobileNavigation">';

    if ( $loggedIn && !$administrator ) {
        echo '<li class="mobileNavigation"><a href="index.php?page=myOrders" class="buttonMobileNav" id="butMyOrders">Meine Bestellungen</a></li> ';
        echo '<li class="mobileNavigation"><a href="index.php?page=settings" class="buttonMobileNav" id="butLogout">Einstellungen</a></li>';
    }
    elseif ( $loggedIn && $administrator ) {
        echo '<li class="mobileNavigation"><a href="index.php?page=myOrders" class="buttonMobileNav" id="butAllOrders">Alle Bestellungen</a></li> ';
        echo '<li class="mobileNavigation"><a href="index.php?page=configureCategories" class="buttonMobileNav" id="configureCategories">Kategorieverwaltung</a></li> ';
        echo '<li class="mobileNavigation"><a href="index.php?page=users" class="buttonMobileNav" id="users">Benutzerverwaltung</a></li> ';
        echo '<li class="mobileNavigation"><a href="index.php?page=config" class="buttonMobileNav" id="config">Applikationseinstellungen</a></li> ';
        echo '<li class="mobileNavigation"><a href="index.php?page=settings" class="buttonMobileNav" id="butLogout">Einstellungen</a></li> ';
    }
    else {
        echo '<li class="mobileNavigation"><a href="index.php?page=login" class="buttonMobileNav" id="butLogin">Login</a></li>';
    }

echo '</div>';

?>
