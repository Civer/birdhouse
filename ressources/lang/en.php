<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: en.php

This file is used for handling translations.
Embedded the translation you want and load the $lang array to handle it

*/
##########################################################################
##########################################################################
##########################################################################

$lang = array(
    "titles" => array(
        "orders" => "Orders",
        "login" => "Login",
        "settings" => "Settings",
        "categories" => "Category",
        "createCategory" => "Create Category",
        "editCategory" => "Edit Category",
        "sortCategories" => "Sort categories",
        "editItems" => "Edit Items",
        "editItem" => "Edit Item",
        "createItem" => "Create Item",
        "editSubcategories" => "Edit Subcategories",
        "sortSubcategories" => "Sort Subcategories",
        "editSubcategory" => "Edit Subcategory",
        "createSubcategory" => "Create SubCategory",
        "users" => "Users",
        "createUser" => "Create User",
        "pageSettings" => "Pagesettings",
        "generalPageSettings" => "General settings",
        "language" => "Language"
    ),
    "texts" => array(
        "noOpenOrders" => "No open orders",
        "usernameWillHaveInitialPass" => "The user will be created with an initial password",
        "noSearchResult" => "No results",
        "noSearchResultInactive" => "No results (inactive)",
        "LoginFailed" => "Login failed",
        "passwordChanged" => "Password changed",
        "passwortShort" => "The new password has to have at least 8 signs",
        "passwordMismatch" => "Password mismatch",
        "settingsSaved" => "Settings saved",
        "orderDeleted" => "Order deleted",
        "AllOrdersDeleted" => "All orders deleted",
        "userCreated1" => "User <b>",
        "userCreated2" => "</b> created.",
        "userDeleted1" => "User <b>",
        "userDeleted2" => "</b> deleted.",
        "itemActivated" => "Item activated",
        "itemDeactivated" => "Item deactivated",
        "categoryCreated1" => "Category <b>",
        "categoryCreated2" => "</b> created.",
        "categoryDeleted1" => "Category (Id: ",
        "categoryDeleted2" => ") deleted.",
        "subcategoryCreated1" => "Subcategory <b>",
        "subcategoryCreated2" => "</b> created.",
        "subcategoryDeleted1" => "Subcategory (Id: ",
        "subcategoryDeleted2" => ") deleted.",
        "itemCreated1" => "Item <b>",
        "itemCreated2" => "</b> created.",
        "itemUpdated1" => "Item <b>",
        "itemUpdated2" => "</b> updated.",
        "itemDeleted1" => "Item <b>",
        "itemDeleted2" => "</b> deleted."
    ),
    "confirmation" => array(
        "order" => "Do you really want to order?",
        "colorReset" => "Are you sure you want to reset the colors?",
        "passReset" => "Are you sure you want to reset the password?",
        "changeAdminRights" => "Are you sure you want to change the admin rights?",
        "deleteUser" => "Are you sure you want to delete this user?",
        "deleteOrder" => "Are you sure you want to delete this order?",
        "deleteOrders" => "All orders will be deleted. Are you sure?",
        "deactivateItem" => "Are you sure you want to deactivate this item?",
        "activateItem" => "Are you sure you want to activate this item?",
        "deleteCategory" => "Do you really want to delete this category with all items?",
        "deleteItem" => "Do you really want to delete this item?",
        "changeCategoryState" => "Do you want to switch the category state?"
    ),
    "buttons" => array(
        "order" => "Order",
        "changePassword" => "Change password",
        "changeSettings" => "Change settings",
        "login" => "Login",
        "logout" => "Logout",
        "deleteOrder" => "Delete order",
        "switchState" => "Switch state",
        "deleteAllOrders" => "Delete all orders",
        "edit" => "Edit",
        "confirm" => "confirm",
        "onff" => "On / Off",
        "delete" => "Delete",
        "createCategory" => "Create category",
        "createItem" => "Create Item",
        "createSubcategory" => "Create SubCategory",
        "create" => "Create",
        "back" => "Back",
        "change" => "Save",
        "createUser" => "Create user",
        "editColors" => "Change colors",
        "changeColors" => "Change colors",
        "changeSettings" => "Save settings",
        "changePageSettings" => "General settings",
        "reset" => "Reset",
        "sort" => "sort"
    ),
    "fields" => array(
        "username" => "Username",
        "password" => "Password",
        "notes" => "Notes",
        "none" => "None",
        "newPassword" => "New password",
        "confirmPassword" => "Confirm password",
        "category" => "Category",
        "subcategory" => "Subcategory",
        "withoutSubcategory" => "Without Subcategory",
        "withInactiveSubcategory" => "Items in deactivated subcategories",
        "name" => "Name",
        "description" => "Description",
        "ingredient" => "Ingredient",
        "ingredientAdmin" => "Note for admin",
        "showIngredientInFrontend" => "Show in frontend",
        "initialpassword" => "Initial password",
        "language" => "Language",
        "sitename" => "Sitename",
        "siteslogan" => "Siteslogan"
    ),
    "tableHeaders" => array(
        "time" => "Time",
        "name" => "Name",
        "note" => "Note",
        "state" => "State",
        "orderer" => "Orderer",
        "category" => "Category",
        "edit" => "Edit",
        "onoff" => "On / Off",
        "delete" => "Delete",
        "username" => "Username",
        "admin" => "Admin",
        "permissions" => "Permissions",
        "reset" => "Reset"
    ),
    "states" => array(
        "open" => "open",
        "closed" => "closed",
        "active" => "active",
        "inactive" => "inactive",
        "admin" => "Admin",
        "user" => "User"
    ),
    "settings" => array(
        "showDescription" => "Show description",
        "showIngredients" => "Show ingredients"
    ),
    "languages" => array(
        "de" => "German",
        "en" => "English"
    )
);
 ?>
