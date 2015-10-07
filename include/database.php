<?php

require_once(__DIR__.'/../config.php');

$validSearchOperators = ['=', 'LIKE', '>=', '>', '<', '<=', '<>', '!=', 'IS', '<=>', 'IS NOT', 'NOT LIKE'];

$dbConnection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if($dbConnection->connect_errno){
	die('Error accessing database (error code '.$dbConnection->connect_errno.').');
}

//change character set to utf8 and check it
if(!$dbConnection->set_charset("utf8")){
    die('Error setting character set to UTF-8');
}

function getResultArray(&$boundArray, &$stmt){

	$numRows = $stmt->num_rows;
	$result = [];

	for ($i = 0; $i < $numRows; $i++){
	    $stmt->data_seek($i);
	    $stmt->fetch();
	    foreach ($boundArray as $key => $val){
	        $result[$i][$key]=$val;
	    }
	}

	return $result;
}

/**
 * Returns a character representing the bind_param type of a variable
 *
 */
function getParameterType($parameter){
	if(is_string($parameter)) return 's';
    if(is_int($parameter) || is_bool($parameter)) return 'i';
    if(is_float($parameter)) return 'd';
    return 'b';
}


?>