<?php

require_once(__DIR__.'/../include/database.php');

$forumColumnDescription = [

	'id' 				=> 'ID',
	'name' 				=> 'Nama forum',
	'category' 			=> 'Kategori',
	'description' 		=> 'Deskripsi',
	'lastpost'			=> 'Update terakhir'
];

function getForumColumnDescription($column){
	global $forumColumnDescription;

	if(is_string($column)){
		if(!array_key_exists($column, $forumColumnDescription)) return '';
		return $forumColumnDescription[$column];
	
	} else if(is_array($column)){

		$result = [];
		foreach($column as $item){
			$result[$item] = getForumColumnDescription($item);
		}
		return $result;
	}

	return false;
}

$forumSearchableColumns = [
	'admin' => ['id', 'name', 'category', 'description', 'lastpost'],
	'user' 	=> ['id', 'name', 'category', 'description', 'lastpost']
];

function getForumSearchableColumns($role = 'user'){
	global $forumSearchableColumns;
	if(!array_key_exists($role, $forumSearchableColumns)) $role = 'user';
	return $forumSearchableColumns[$role];
}

$forumViewableColumns = [
	'admin' => ['id', 'name', 'category', 'description', 'lastpost'],
	'user' 	=> ['id', 'name', 'category', 'description', 'lastpost']
];

function getForumViewableColumns($role = 'user'){
	global $forumViewableColumns;
	if(!array_key_exists($role, $forumViewableColumns)) $role = 'user';
	return $forumViewableColumns[$role];
}

/**
 * Returns forums data in the form of array[rowIndex][columnName]
 *
 * @param $parameters
 * 
 * role: defaults to 'user'
 * columns: array containing columns to be returned, defaults to getForumViewableColumns[$role]
 * search: value to be searched, if not specified then will return all rows
 * searchBy: column to be searched, if not specified or invalid then will return all rows
 * searchOperator: operator to be used for searching, defaults to =
 * sortBy: column to search by, if not specified then will not sort
 * sortOrder: ASC/DESC, defaults to ASC
 * limit: maximum number of rows to be returned, if not specified then will not set a limit
 *
 */
function getForums($parameters){

	global $validSearchOperators;
	global $forumColumnDescription;
	global $dbConnection;

	$sql = "SELECT ";
	$boundInput = ['']; //reserve $boundInput[0] for the string denoting variable types
	$boundOutput = [];

	if(!array_key_exists('role', $parameters)) $parameters['role'] = 'user';

	$separator = '';
	$counter = 0;
	if(!array_key_exists('columns', $parameters)) $parameters['columns'] = getForumViewableColumns($parameters['role']);
	foreach($forumColumnDescription as $key => $val){
		if(in_array($key, $parameters['columns'])){
			$sql .= $separator.$key;
			$boundName = '_boundOutput'.$counter; //name of new variable
			$counter++;
			$$boundName = $key; //create new variable named with the value of boundName, assign the value of $key to it
			$boundOutput[$key] = &$$boundName; //store the reference to the new variable in the boundOutput array
			$separator = ', ';
		}
	}

	$sql .= " FROM forums";

	if(array_key_exists('search', $parameters) && isset($parameters['search']) && array_key_exists('searchBy', $parameters) && isset($parameters['searchBy']) && in_array($parameters['searchBy'], getForumSearchableColumns($parameters['role']))){	
		if(array_key_exists('searchOperator', $parameters)) $parameters['searchOperator'] = strtoupper($parameters['searchOperator']);
		if(!array_key_exists('searchOperator', $parameters) || !in_array($parameters['searchOperator'], $validSearchOperators)) $parameters['searchOperator'] = '=';

		$sql .= ' WHERE '.$parameters['searchBy'].' '.$parameters['searchOperator'].' ?';
		$boundInput[] = &$parameters['search'];
		$boundInput[0] .= getParameterType($parameters['search']);
	}

	if(array_key_exists('sortBy', $parameters)){
		if(array_key_exists('searchOrder', $parameters)) $parameters['searchOrder'] = strtoupper($parameters['searchOrder']);
		if(!array_key_exists('searchOrder', $parameters) || ($parameters['searchOrder'] != 'ASC' && $parameters['searchOrder'] != 'DESC')) $parameters['searchOrder'] = 'ASC';

		$sql .= ' ORDER BY '.$parameters['sortBy'].' '.$parameters['searchOrder'];
	}

	if(array_key_exists('limit', $parameters) && is_int($parameters['limit']) && $parameters['limit'] > 0){
		$sql .= ' LIMIT '.$parameters['limit'];
	}

	$stmt = $dbConnection->prepare($sql);

	if(array_key_exists('debug', $parameters) && $parameters['debug']){
		echo "stmt: ";
		var_dump($stmt);
		echo "sql: ";
		var_dump($sql);
		echo "boundInput: ";
		var_dump($boundInput);
		echo "boundOutput: ";
		var_dump($boundOutput);
	}

	if(!$stmt) return false;

	if(count($boundInput) > 1) call_user_func_array([$stmt, "bind_param"], $boundInput);
	$stmt->execute();
	$stmt->store_result();
	call_user_func_array([$stmt, "bind_result"], $boundOutput);

	$data = getResultArray($boundOutput, $stmt);
	$stmt->close();

	return $data;
}

?>