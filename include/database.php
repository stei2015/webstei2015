<?php

require_once(__DIR__.'/../config.php');

$dbConnection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if($dbConnection->connect_errno){
	die('Error accessing database (error code '.$dbConnection->connect_errno.').');
}

//change character set to utf8 and check it
if(!$dbConnection->set_charset("utf8")){
    die('Error setting character set to UTF-8');
}

?>