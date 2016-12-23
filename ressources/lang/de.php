<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: de.php

This file is used for handling translations.
Embedded the translation you want and load the $lang array to handle it

*/
##########################################################################
##########################################################################
##########################################################################

$lang = array(
    "titles" => array(
        "orders" => "Bestellungen",
        "login" => "Login",
        "settings" => "Einstellungen",
        "changePassword" => "Passwort ändern",
        "categories" => "Kategorien",
        "createCategory" => "Kategorie anlegen",
        "editCategory" => "Kategorie bearbeiten",
        "sortCategories" => "Kategorien sortieren",
        "editItems" => "Gegenstände bearbeiten",
        "editItem" => "Gegenstand bearbeiten",
        "createItem" => "Gegenstand anlegen",
        "editSubcategories" => "Unterkategorien bearbeiten",
        "sortSubcategories" => "Unterkategorien sortieren",
        "editSubcategory" => "Unterkategorie bearbeiten",
        "createSubcategory" => "Unterkategorie anlegen",
        "users" => "Benutzer",
        "createUser" => "Benutzer anlegen",
        "pageSettings" => "Seiteneinstellungen",
        "generalPageSettings" => "Allgemeine Einstellungen",
        "language" => "Sprache"
    ),
    "texts" => array(
        "noOpenOrders" => "Keine offenen Bestellungen",
        "usernameWillHaveInitialPass" => "Der Benutzer wird automatisch mit dem Initialpasswort angelegt",
        "noSearchResult" => "Die Suche liefert keine Ergebnisse",
        "noSearchResultInactive" => "Die Suche liefert keine inaktiven Ergebnisse",
        "LoginFailed" => "Login fehlgeschlagen",
        "passwordChanged" => "Passwort geändert",
        "passwortShort" => "Das neue Passwort muss mindestens 8 Zeichen haben",
        "passwordMismatch" => "Passwörter stimmen nicht überein",
        "settingsSaved" => "Einstellungen gespeichert",
        "orderDeleted" => "Bestellung gelöscht",
        "AllOrdersDeleted" => "Alle Bestellungen gelöscht",
        "userCreated1" => "Benutzer <b>",
        "userCreated2" => "</b> wurde angelegt.",
        "userDeleted1" => "Benutzer <b>",
        "userDeleted2" => "</b> wurde gelöscht.",
        "itemActivated" => "Gegenstand aktiviert",
        "itemDeactivated" => "Gegenstand deaktiviert",
        "categoryCreated1" => "Kategorie <b>",
        "categoryCreated2" => "</b> wurde angelegt.",
        "categoryDeleted1" => "Kategorie (Id: ",
        "categoryDeleted2" => ") gelöscht.",
        "subcategoryCreated1" => "Unterkategorie <b>",
        "subcategoryCreated2" => "</b> wurde angelegt.",
        "subcategoryDeleted1" => "Unterkategorie (Id: ",
        "subcategoryDeleted2" => ") gelöscht.",
        "itemCreated1" => "Gegenstand <b>",
        "itemCreated2" => "</b> wurde angelegt.",
        "itemUpdated1" => "Gegenstand <b>",
        "itemUpdated2" => "</b> wurde aktualisiert.",
        "itemDeleted1" => "Gegenstand <b>",
        "itemDeleted2" => "</b> wurde gelöscht."
    ),
    "confirmation" => array(
        "order" => "Willst du folgendes bestellen?",
        "colorReset" => "Bist du sicher, dass du die Farben zurücksetzen möchtest?",
        "passReset" => "Bist du sicher, dass du das Passwort zurücksetzen möchtest?",
        "changeAdminRights" => "Bist du sicher, dass du die Berechtigung ändern möchtest?",
        "deleteUser" => "Bist du sicher, dass du den Benutzer löschen möchtest?",
        "deleteOrder" => "Bist du sicher, dass du diese Bestellung löschen möchtest?",
        "deleteOrders" => "Bist du sicher, dass du alle Bestellungen löschen möchtest?",
        "deactivateItem" => "Bist du sicher, dass du den Gegenstand deaktivieren möchtest?",
        "activateItem" => "Bist du sicher, dass du den Gegenstand aktivieren möchtest?",
        "deleteCategory" => "Bist du sicher, dass du die Kategorie löschen möchtest?",
        "deleteItem" => "Bist du sicher, dass du den Gegenstand löschen möchtest?",
        "changeCategoryState" => "Bist du sicher, dass du den Status dieser Kategorie ändern möchtest?"
    ),
    "buttons" => array(
        "order" => "Bestellen",
        "changePassword" => "Passwort ändern",
        "changeSettings" => "Einstellungen ändern",
        "login" => "Login",
        "logout" => "Logout",
        "deleteOrder" => "Bestellung löschen",
        "switchState" => "Status ändern",
        "deleteAllOrders" => "Alle Bestellungen löschen",
        "edit" => "Bearbeiten",
        "confirm" => "bestätigen",
        "onff" => "An / Aus",
        "delete" => "löschen",
        "createCategory" => "Kategorie anlegen",
        "createItem" => "Gegenstand anlegen",
        "createSubcategory" => "Unterkategorie anlegen",
        "create" => "Erstellen",
        "back" => "zurück",
        "change" => "speichern",
        "createUser" => "Benutzer anlegen",
        "editColors" => "Farben anpassen",
        "changeSettings" => "Einstellungen ändern",
        "changePageSettings" => "Allgemeine Einstellungen",
        "reset" => "Zurücksetzen",
        "sort" => "sortieren"
    ),
    "fields" => array(
        "username" => "Benutzername",
        "password" => "Passwort",
        "notes" => "Anmerkungen",
        "none" => "Keine",
        "newPassword" => "Neues Passwort",
        "confirmPassword" => "Passwort bestätigen",
        "category" => "Kategorie",
        "subcategory" => "Unterkategorie",
        "withoutSubcategory" => "Ohne Unterkategorie",
        "withInactiveSubcategory" => "Gegenstände in deaktivierten Unterkategorien",
        "name" => "Name",
        "description" => "Beschreibung",
        "ingredient" => "Zutat",
        "ingredientAdmin" => "Anmerkung für Admin",
        "showIngredientInFrontend" => "Im Frontend",
        "initialpassword" => "Initialpasswort",
        "language" => "Sprache",
        "sitename" => "Seitentitel",
        "siteslogan" => "Seitenslogan"
    ),
    "tableHeaders" => array(
        "time" => "Zeit",
        "name" => "Name",
        "note" => "Anmerkung",
        "state" => "Status",
        "orderer" => "Besteller",
        "category" => "Kategorie",
        "edit" => "Bearbeiten",
        "onoff" => "An / Aus",
        "delete" => "Löschen",
        "username" => "Benutzername",
        "admin" => "Admin",
        "permissions" => "Rechte",
        "reset" => "Reset"
    ),
    "states" => array(
        "open" => "offen",
        "closed" => "erledigt",
        "active" => "aktiv",
        "inactive" => "inaktiv",
        "admin" => "Administrator",
        "user" => "Benutzer"
    ),
    "settings" => array(
        "showDescription" => "Beschreibung anzeigen",
        "showIngredients" => "Zutaten anzeigen"
    ),
    "languages" => array(
        "de" => "Deutsch",
        "en" => "Englisch"
    )
);
 ?>
