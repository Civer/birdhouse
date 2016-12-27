<?php header("Content-type: text/css");

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: style.php

This is the style.css.
As you can see it is created as a php file to get the colors from database

*/
##########################################################################
##########################################################################
##########################################################################

    require $_SERVER['DOCUMENT_ROOT'].'/include/general.php';
    $colorArray = getColors();

    $background = $colorArray['background'];
    $outerBox = $colorArray['outerBox'];
    $basicPage = $colorArray['basicPage'];

    $ingredients = $colorArray['ingredients'];
    $tableBackground = $colorArray['tableBackground'];

    $boxshadow = $colorArray['boxshadow'];

    $buttonShadow = $colorArray['buttonShadow'];
    $buttonColor1 = $colorArray['buttonColor1'];
    $buttonColor2 = $colorArray['buttonColor2'];
    $buttonBorder = $colorArray['buttonBorder'];
    $fontColorButton = $colorArray['fontColorButton'];

    $textShadow = $colorArray['textShadow'];

    $border = $colorArray['border'];

    $inputFieldBorder = $colorArray['inputFieldBorder'];
    $inputFieldShadow = $colorArray['inputFieldShadow'];

    $fontColor = $colorArray['fontColor'];


?>

/*************************************************/
/*

 1 - General Tags
 2 - Basic structure
 3 - Specific structures
 3.1 - Item Page
 4 - Texts
 5 - Special Elements (Buttons, Tables, etc.)

---------------------------------------------------

 9 - Changes for mobile
 9.1 - General Tags
 9.2 - Basic structure
 9.3 - Specific structures
 9.4 - Texts
 9.5 - Special Elements (Buttons, Tables, etc.)

*/
/*************************************************/



div.container {
    margin: 0 auto;
    width: 800;
}

/*************************************************/
/*

    1 - General Tags

*/
/*************************************************/

body {
    font-family: Arial;
    background-color: <?=$background?>;
    margin: auto;
    color: <?=$fontColor?>;
}

h1 {
    margin: 5px 0;
    font-variant: small-caps;
}

h2 {
    margin: 5px 0;
    font-variant: small-caps;
}

hr {
    border: 1px solid <?=$basicPage?>;;
}

li {
    width:100%;
    list-style-type: none;
    background-color: <?=$buttonColor1?>;
    border: 1px solid <?=$border?>;
}

form {
    margin-bottom: 0;
}

table {
    padding: 0 10;
    margin: auto;
}

td {
    padding: 5px;
    border-style: solid;
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    border: 1px solid <?=$border?>;
    box-shadow: 1px 1px 3px <?=$boxshadow?>;
    -moz-box-shadow: 1px 1px 3px <?=$boxshadow?>;
    -webkit-box-shadow: 1px 1px 3px <?=$boxshadow?>;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    margin: 5px auto;
    background-color: <?=$tableBackground?>;
}

/*************************************************/
/*

    2 - Basic Structure

*/
/*************************************************/

header, nav, section, footer, div.offers, div.search {
    background-color: <?=$outerBox?>;
    padding: 15px 0;
    margin: 10 0;
    text-align: center;
    border-radius: 5px;
    min-width: 750;
}

footer {
    font-size: 0.6em;
}

div.mobileMenu, div.mobileSearch, div.mobileNavigation, div.search {
    display: none;
}

div.basicPage {
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    border: 1px solid <?=$border?>;
    box-shadow: 1px 1px 4px <?=$boxshadow?>;
    -moz-box-shadow: 1px 1px 4px <?=$boxshadow?>;
    -webkit-box-shadow: 1px 1px 4px <?=$boxshadow?>;
    border-radius: 5px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    margin: 10 20;
    background-color: <?=$basicPage?>;
}

div.subCategory, div.category {
    display: none;
}

div.subCategoryTitle {
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    border: 1px solid <?=$border?>;
    box-shadow: 1px 1px 4px <?=$boxshadow?>;
    -moz-box-shadow: 1px 1px 4px <?=$boxshadow?>;
    -webkit-box-shadow: 1px 1px 4px <?=$boxshadow?>;
    border-radius: 5px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    margin: 0 14px;
    background-color: <?=$basicPage?>;
}

div.subCategoryTitleFixedMainpage {
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    border: 1px solid <?=$border?>;
    box-shadow: 1px 1px 4px <?=$boxshadow?>;
    -moz-box-shadow: 1px 1px 4px <?=$boxshadow?>;
    -webkit-box-shadow: 1px 1px 4px <?=$boxshadow?>;
    border-radius: 5px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    margin: 0 14px;
    background-color: <?=$background?>;
}

div.subCategoryTitleFixed {
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    border: 1px solid <?=$border?>;
    box-shadow: 1px 1px 4px <?=$boxshadow?>;
    -moz-box-shadow: 1px 1px 4px <?=$boxshadow?>;
    -webkit-box-shadow: 1px 1px 4px <?=$boxshadow?>;
    border-radius: 5px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    margin: 0 14px;
    margin-bottom: 10;
    background-color: <?=$background?>;
}

div.subCategoryTitleFixedNoSubCategories {
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    border: 1px solid <?=$border?>;
    box-shadow: 1px 1px 4px <?=$boxshadow?>;
    -moz-box-shadow: 1px 1px 4px <?=$boxshadow?>;
    -webkit-box-shadow: 1px 1px 4px <?=$boxshadow?>;
    border-radius: 5px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    margin: 0 14px;
    margin-bottom: 10;
    background-color: <?=$background?>;
}

div.inactiveItems {
    display: none;
    border: 1px solid transparent;
}

div.Category div.subCategory {
    display: block;
    border: 1px solid transparent;
    margin: 10 14px;
}

/*************************************************/
/*

    3 - Specific structures

*/
/*************************************************/

/*************************************************/
/*

    3.1 - Item Page

*/
/*************************************************/

p.itemIngredients {
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    border: 1px solid <?=$border?>;
    box-shadow: 1px 1px 3px <?=$boxshadow?>;
    -moz-box-shadow: 1px 1px 3px <?=$boxshadow?>;
    -webkit-box-shadow: 1px 1px 3px <?=$boxshadow?>;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    width: 150;
    margin: 5px auto;
    background-color: <?=$ingredients?>;
    font-weight: bold;
    padding: 0;
}

div.ingredientsList {
    float:right;
    width: 25%;
}

span.ingredientCheckbox {
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    border: 1px solid <?=$inputFieldBorder?>;
    box-shadow: 1px 1px 4px <?=$inputFieldShadow?>;
    -moz-box-shadow: 1px 1px 4px <?=$inputFieldShadow?>;
    -webkit-box-shadow: 1px 1px 4px <?=$inputFieldShadow?>;
    background: white;
    padding: 6px;
    margin: 10px;
    outline: none;
    font-size: 0.75em;
    text-align: center;
}

span.suggestionCheckbox {
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    border: 1px solid <?=$inputFieldBorder?>;
    box-shadow: 1px 1px 4px <?=$inputFieldShadow?>;
    -moz-box-shadow: 1px 1px 4px <?=$inputFieldShadow?>;
    -webkit-box-shadow: 1px 1px 4px <?=$inputFieldShadow?>;
    background: white;
    padding: 6px;
    margin: auto;
    display: block;
    width: 150px;
    outline: none;
    font-size: 0.75em;
    text-align: center;
}

div.description {
    float: left;
    width: 75%
}

div.orderButtons {
    clear: both;
}

/*************************************************/
/*

    3.2 - Offers

*/
/*************************************************/

span.offers {
    margin: 0 5px 0 5px;
}

/*************************************************/
/*

    4 - Texts

*/
/*************************************************/

p.error {
    text-align: center;
    font-size: 1.25em;
    color: red;
    font-weight: bold;
    background-color: rgba(0, 0, 0, 0.7);
    margin: 0;
}

p.success {
    text-align: center;
    font-size: 1.25em;
    color: green;
    font-weight: bold;
    background-color: rgba(0, 0, 0, 0.7);
    margin: 0;
}

p.center {
    text-align: center;
}

p.paragraphTitle {
    font-size: 1.25em;
    margin-bottom: 0;
}

p.paragraphDescription {
    text-align: justify;
    margin: 20;
}

p.bold {
    font-weight: bold;
}

p.underlined {
    text-decoration: underline;
}

p.buttonMargin, p.noMargin {
    margin: 0;
}


/*************************************************/
/*

    5 - Special Elements

*/
/*************************************************/

.button {
	-moz-box-shadow:inset 0 1px 0 0 <?=$buttonShadow?>;
	-webkit-box-shadow:inset 0 1px 0 0 <?=$buttonShadow?>;
	box-shadow:inset 0 1px 0 0 <?=$buttonShadow?>;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, <?=$buttonColor1?>), color-stop(1, <?=$buttonColor2?>));
	background:-moz-linear-gradient(top, <?=$buttonColor1?> 5%, <?=$buttonColor2?> 100%);
	background:-webkit-linear-gradient(top, <?=$buttonColor1?> 5%, <?=$buttonColor2?> 100%);
	background:-o-linear-gradient(top, <?=$buttonColor1?> 5%, <?=$buttonColor2?> 100%);
	background:-ms-linear-gradient(top, <?=$buttonColor1?> 5%, <?=$buttonColor2?> 100%);
	background:linear-gradient(to bottom, <?=$buttonColor1?> 5%, <?=$buttonColor2?> 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='<?=$buttonColor1?>', endColorstr='<?=$buttonColor2?>',GradientType=0);
	background-color:<?=$buttonColor1?>;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid <?=$buttonBorder?>;
	display:inline-block;
	cursor:pointer;
	color: <?=$fontColorButton?>;
	font-family:Arial;
	font-size:1.1em;
	font-weight:bold;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:0 1px 0 <?=$textShadow?>;
}
.button:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, <?=$buttonColor2?>), color-stop(1, <?=$buttonColor1?>));
	background:-moz-linear-gradient(top, <?=$buttonColor2?> 5%, <?=$buttonColor1?> 100%);
	background:-webkit-linear-gradient(top, <?=$buttonColor2?> 5%, <?=$buttonColor1?> 100%);
	background:-o-linear-gradient(top, <?=$buttonColor2?> 5%, <?=$buttonColor1?> 100%);
	background:-ms-linear-gradient(top, <?=$buttonColor2?> 5%, <?=$buttonColor1?> 100%);
	background:linear-gradient(to bottom, <?=$buttonColor2?> 5%, <?=$buttonColor1?> 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='<?=$buttonColor2?>', endColorstr='<?=$buttonColor1?>',GradientType=0);
	background-color:<?=$buttonColor2?>;
}
.button:active {
	position:relative;
	top:1px;
}

#small {
    font-size:0.75em;
}

.inputField {
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    border: 1px solid <?=$inputFieldBorder?>;
    box-shadow: 1px 1px 4px <?=$inputFieldShadow?>;
    -moz-box-shadow: 1px 1px 4px <?=$inputFieldShadow?>;
    -webkit-box-shadow: 1px 1px 4px <?=$inputFieldShadow?>;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    padding: 7px;
    margin: 10;
    outline: none;
    width: 150;
    text-align: center;
}

.inputFieldWide {
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    border: 1px solid <?=$inputFieldBorder?>;
    box-shadow: 1px 1px 4px <?=$inputFieldShadow?>;
    -moz-box-shadow: 1px 1px 4px <?=$inputFieldShadow?>;
    -webkit-box-shadow: 1px 1px 4px <?=$inputFieldShadow?>;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    padding: 7px;
    margin: 10;
    outline: none;
    width: 380;
    text-align: center;
}

hr.alternate {
    border: 1px solid <?=$ingredients?>;;
}

td.tableHeader {
    font-weight: bold;
}

td.menu {
    border: none;
    box-shadow: none;
    background-color: transparent;
}

td.cName {
    width: 200;
    font-weight: bold;
}

td.centered {
    text-align: center;
}

tr.header {
    text-align: center;
    font-weight: bold;
}

tr.center {
    text-align: center;
}

h3.subtitle {
    margin: 20px;
}

span.subtitleleft {
    float: left;
}

span.subtitleright {
    float: right;
}

/*************************************************/
/*

    9 - Smartphone Layout

*/
/*************************************************/

@media (max-device-width: 800) {

    /*************************************************/
    /*

        9.1 - General Tags

    */
    /*************************************************/

    body {
        font-size: 2em;
        margin-top: 0;
    }

    /*************************************************/
    /*

        9.2 - Basic structure

    */
    /*************************************************/

    header, nav, section, footer, div.offers, div.search  {
        border-radius: 0;
        margin-top: 0;
    }

    div.offers {
        margin-top: 10;
    }

    header {
        margin-top: 0;
        margin-bottom: 0;
        height: 90;
    }

    nav {
        padding: 0;
        margin: 0;
        text-align: center;
        width: 100%;
    }

    div.navigation {
        display:  none;
    }

    div.mobileNavigation {
        padding: 10 0;
    }

    div.mobileMenu {
        display: block;
        float: right;
        margin: 15px;
    }

    div.mobileSearch {
        display: block;
        float: left;
        margin: 15px;
    }

    img.logo {
        margin: 20;
    }

    div.container {
        margin: 0 auto;
        width: 100%;
    }

    section {
        padding: 30 2px;
    }

    div.basicPage {
        margin: 0 0;
    }

    div.subCategoryTitle {
        border: 5px solid <?=$fontColorButton?>;
        letter-spacing: 2px;
        font-size: 1.25em;
        margin: 0 0;
        margin-top: 30;
    }

    div.subCategoryTitleFirst {
        border: 5px solid <?=$fontColorButton?>;
        letter-spacing: 2px;
        font-size: 1.25em;
        margin: 0 0;
    }

    div.subCategoryTitleFixed {
        border: 5px solid <?=$fontColorButton?>;
        letter-spacing: 4px;
        font-size: 1.25em;
        margin: 0 0;
    }

    div.subCategoryTitleFixedNoSubCategories {
        border: 5px solid <?=$fontColorButton?>;
        letter-spacing: 4px;
        font-size: 1.25em;
        margin: 0 0;
        margin-bottom: 30;
    }

    div.subCategoryTitleFixedMainpage {
        border: 5px solid <?=$fontColorButton?>;
        letter-spacing: 4px;
        font-size: 1.25em;
        margin: 0 0;
    }

    footer {
        font-size: 0.75em;
    }

    /*************************************************/
    /*

        9.3 - Specific structures

    */
    /*************************************************/

    div.ingredientsList {
        float:right;
        width: 30%;
    }

    div.description {
        float: left;
        width: 70%
    }

    p.itemIngredients {
        width: 250;
    }

    /*************************************************/
    /*

        9.4 - Texts

    */
    /*************************************************/

    p.paragraphTitle {
        font-size: 40;
        margin-bottom: 0;
    }

    /*************************************************/
    /*

        9.5 - Special Elements (Buttons, Tables, etc.)

    */
    /*************************************************/

    .buttonMobileNav {
        display:inline-block;
    	cursor:pointer;
    	color: <?=$fontColorButton?>;
    	font-family:Arial;
    	font-size:1.5em;
    	font-weight:bold;
    	padding:10 24px;
    	text-decoration:none;
    	text-shadow:0 1px 0 <?=$textShadow?>;
        margin: 10;
    }

    .button {
        font-size: 1.5em;
    }

    #small {
        font-size: 1em;
    }

    .inputField {
        font-size: 1.2em;
        width: 400;
        height: 80;
        margin: 20;
    }

    .inputFieldWide {
        font-size: 1.2em;
        width: 940;
        margin: 20;
    }

    span.ingredientCheckbox {
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        border: 1px solid <?=$inputFieldBorder?>;
        box-shadow: 1px 1px 4px <?=$inputFieldShadow?>;
        -moz-box-shadow: 1px 1px 4px <?=$inputFieldShadow?>;
        -webkit-box-shadow: 1px 1px 4px <?=$inputFieldShadow?>;
        background: <?=$outerBox?>;
        padding: 6px;
        margin: 10;
        outline: none;
        width: 150;
        text-align: center;
    }

    table {
        font-size: 1em;
    }

    input[type=checkbox]
    {
      /* Double-sized Checkboxes */
      -ms-transform: scale(1.5); /* IE */
      -moz-transform: scale(1.5); /* FF */
      -webkit-transform: scale(1.5); /* Safari and Chrome */
      -o-transform: scale(1.5); /* Opera */
      padding: 10;
      margin: 10;
    }
}
