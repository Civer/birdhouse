<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: category.php

This script is used to handle all form activities related to settings

*/
##########################################################################
##########################################################################
##########################################################################

if(isset($_POST['colorPicker'])) {

    $colorArray = array(
        array('key' => 'background', 'color' => "#".$_POST['background']),
        array('key' => 'outerBox', 'color' => "#".$_POST['outerBox']),
        array('key' => 'basicPage', 'color' => "#".$_POST['basicPage']),
        array('key' => 'ingredients', 'color' => "#".$_POST['ingredients']),
        array('key' => 'tableBackground', 'color' => "#".$_POST['tableBackground']),
        array('key' => 'boxshadow', 'color' => "#".$_POST['boxshadow']),
        array('key' => 'buttonShadow', 'color' => "#".$_POST['buttonShadow']),
        array('key' => 'buttonColor1', 'color' => "#".$_POST['buttonColor1']),
        array('key' => 'buttonColor2', 'color' => "#".$_POST['buttonColor2']),
        array('key' => 'buttonBorder', 'color' => "#".$_POST['buttonBorder']),
        array('key' => 'fontColorButton', 'color' => "#".$_POST['fontColorButton']),
        array('key' => 'textShadow', 'color' => "#".$_POST['textShadow']),
        array('key' => 'border', 'color' => "#".$_POST['border']),
        array('key' => 'inputFieldBorder', 'color' => "#".$_POST['inputFieldBorder']),
        array('key' => 'inputFieldShadow', 'color' => "#".$_POST['inputFieldShadow']),
        array('key' => 'fontColor', 'color' => "#".$_POST['fontColor'])
    );

    setColors($colorArray);
}

if(isset($_POST['resetColors'])) {
    resetColors();
}

if(isset($_POST['generalPageSettings'])) {
    setSettings($_POST['sitetitle'],$_POST['siteslogan'],$_POST['initialPassword'],$_POST['language']);
}

?>
