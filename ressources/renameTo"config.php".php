<?php

##########################################################################
##########################################################################
##########################################################################
/*

Author: Peter Vogelmann
Title: config.php

This file is used for storing most of the config stuff

*/
##########################################################################
##########################################################################
##########################################################################

$config = array(
    "db" => array(
        "dbname" => "DBNAME",
        "username" => "USERNAME",
        "password" => "PASSWORD",
        "host" => "HOST"
    ),
    "push" => array(
        "appKey" => "APPKEY",
        "appSecret" => "APPSECRET",
        "appId" => "APPID"
    ),
    "urls" => array(
        "baseUrl" => "URL"
    ),
    "paths" => array(
        "ressources" => $_SERVER['DOCUMENT_ROOT'] . "/ressources",
        "images" => $_SERVER['DOCUMENT_ROOT'] . "/img"
    ),
    "key" => array(
        "hash" => ".89f73hfeuenf.sjei"
    ),
    "logfile" => array(
        "path" => $_SERVER['DOCUMENT_ROOT']."/logs/log.txt"
    )
);
 ?>
