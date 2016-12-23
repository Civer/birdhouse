<?php

//Blue Scheme

function resetColors() {
    $conn = getConnection();

    #logTxt("Trying to get Colors!");

    $array = array(
        array('key' => 'background', 'color' => '#006064'),
        array('key' => 'outerBox', 'color' => '#00BAD4'),
        array('key' => 'basicPage', 'color' => '#00D2FF'),
        array('key' => 'ingredients', 'color' => '#00E9FF'),
        array('key' => 'tableBackground', 'color' => '#00E9FF'),
        array('key' => 'boxshadow', 'color' => '#00ACC1'),
        array('key' => 'buttonShadow', 'color' => '#97c4fe'),
        array('key' => 'buttonColor1', 'color' => '#3d94f6'),
        array('key' => 'buttonColor2', 'color' => '#1e62d0'),
        array('key' => 'buttonBorder', 'color' => '#337fed'),
        array('key' => 'fontColorButton', 'color' => '#FFFFFF'),
        array('key' => 'textShadow', 'color' => '#1570cd'),
        array('key' => 'border', 'color' => '#00BCD4'),
        array('key' => 'inputFieldBorder', 'color' => '#C2C2C2'),
        array('key' => 'inputFieldShadow', 'color' => '#EBEBEB'),
        array('key' => 'fontColor', 'color' => '#000000')
    );

    foreach($array as $row) {
        $sql = "UPDATE pageColors SET color = '".$row[color]."' WHERE bundle = '".$row[key]."'";
        $conn->exec($sql);
    }

    $conn = null;

    return $results;
}

//Beige/Green Scheme

function resetColors() {
    $conn = getConnection();

    #logTxt("Trying to get Colors!");

    $array = array(
        array('key' => 'background', 'color' => '#B3C2BF'),
        array('key' => 'outerBox', 'color' => '#E9ECE5'),
        array('key' => 'basicPage', 'color' => '#C5D5CB'),
        array('key' => 'ingredients', 'color' => '#E9ECE5'),
        array('key' => 'tableBackground', 'color' => '#E9ECE5'),
        array('key' => 'boxshadow', 'color' => '#3B3A36'),
        array('key' => 'buttonShadow', 'color' => '#3B3A36'),
        array('key' => 'buttonColor1', 'color' => '#4A4944'),
        array('key' => 'buttonColor2', 'color' => '#565E5C'),
        array('key' => 'buttonBorder', 'color' => '#54534D'),
        array('key' => 'fontColorButton', 'color' => '#FFFFFF'),
        array('key' => 'textShadow', 'color' => '#3B3A36'),
        array('key' => 'border', 'color' => '#A0ADAB'),
        array('key' => 'inputFieldBorder', 'color' => '#C2C2C2'),
        array('key' => 'inputFieldShadow', 'color' => '#EBEBEB'),
        array('key' => 'fontColor', 'color' => '#000000')
    );

    foreach($array as $row) {
        $sql = "UPDATE pageColors SET color = '".$row[color]."' WHERE bundle = '".$row[key]."'";
        $conn->exec($sql);
    }

    $conn = null;

    return $results;
}

?>
