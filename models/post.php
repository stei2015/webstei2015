<?php

require_once(__DIR__.'/../include/database.php');

$postColumnDescription = [

	'id' 				=> 'ID',
	'thread' 			=> 'Thread',
	'author'	 		=> 'Penulis',
	'posttime'			=> 'Update terakhir',
	'content'			=> 'Isi'
];

function getPostColumnDescription($column){
	global $postColumnDescription;

	if(is_string($column)){
		if(!array_key_exists($column, $postColumnDescription)) return '';
		return $postColumnDescription[$column];
	
	} else if(is_array($column)){

		$result = [];
		foreach($column as $item){
			$result[$item] = getPostColumnDescription($item);
		}
		return $result;
	}

	return false;
}

$postSearchableColumns = [
	'admin' => ['id', 'thread', 'author', 'posttime', 'content'],
	'user' => ['id', 'thread', 'author', 'posttime', 'content']
];

function getPostSearchableColumns($role = 'user'){
	global $postSearchableColumns;
	if(!array_key_exists($role, $postSearchableColumns)) $role = 'user';
	return $postSearchableColumns[$role];
}

$postViewableColumns = [
	'admin' => ['id', 'thread', 'author', 'posttime', 'content'],
	'user' => ['id', 'thread', 'author', 'posttime', 'content']
];

function getPostViewableColumns($role = 'user'){
	global $postViewableColumns;
	if(!array_key_exists($role, $postViewableColumns)) $role = 'user';
	return $postViewableColumns[$role];
}

/**
 * Returns posts data in the form of array[rowIndex][columnName]
 *
 * @param $parameters
 * 
 * role: defaults to 'user'
 * columns: array containing columns to be returned, defaults to getPostViewableColumns[$role]
 * search: value to be searched, if not specified then will return all rows
 * searchBy: column to be searched, if not specified or invalid then will return all rows
 * searchOperator: operator to be used for searching, defaults to =
 * sortBy: column to search by, if not specified then will sort posttime DESC
 * sortOrder: ASC/DESC, defaults to ASC
 * limit: maximum number of rows to be returned, if not specified then will not set a limit
 *
 */
function getPosts($parameters){

	global $validSearchOperators;
	global $postColumnDescription;
	global $dbConnection;

	$sql = "SELECT ";
	$boundInput = ['']; //reserve $boundInput[0] for the string denoting variable types
	$boundOutput = [];

	if(!array_key_exists('role', $parameters)) $parameters['role'] = 'user';

	$separator = '';
	$counter = 0;
	if(!array_key_exists('columns', $parameters)) $parameters['columns'] = getPostViewableColumns($parameters['role']);
	foreach($postColumnDescription as $key => $val){
		if(in_array($key, $parameters['columns'])){
			$sql .= $separator.'posts.'.$key;
			$boundName = '_boundOutput'.$counter; //name of new variable
			$counter++;
			$$boundName = $key; //create new variable named with the value of boundName, assign the value of $key to it
			$boundOutput[$key] = &$$boundName; //store the reference to the new variable in the boundOutput array
			$separator = ', ';
		}
	}

	//author username, type

	$sql .= $separator.'users.username';
	$boundName = '_boundOutput'.$counter; //name of new variable
	$counter++;
	$$boundName = 'users.username'; //create new variable named with the value of boundName, assign the value of $key to it
	$boundOutput['authorusername'] = &$$boundName; //store the reference to the new variable in the boundOutput array

	$sql .= $separator.'users.type';
	$boundName = '_boundOutput'.$counter; //name of new variable
	$counter++;
	$$boundName = 'users.type'; //create new variable named with the value of boundName, assign the value of $key to it
	$boundOutput['authortype'] = &$$boundName; //store the reference to the new variable in the boundOutput array


	$sql .= " FROM posts LEFT JOIN users ON posts.author = users.id ";

	if(array_key_exists('search', $parameters) && isset($parameters['search']) && array_key_exists('searchBy', $parameters) && isset($parameters['searchBy']) && in_array($parameters['searchBy'], getPostSearchableColumns($parameters['role']))){	
		if(array_key_exists('searchOperator', $parameters)) $parameters['searchOperator'] = strtoupper($parameters['searchOperator']);
		if(!array_key_exists('searchOperator', $parameters) || !in_array($parameters['searchOperator'], $validSearchOperators)) $parameters['searchOperator'] = '=';

		$sql .= ' WHERE posts.'.$parameters['searchBy'].' '.$parameters['searchOperator'].' ?';
		$boundInput[] = &$parameters['search'];
		$boundInput[0] .= getParameterType($parameters['search']);
	}

	if(array_key_exists('sortBy', $parameters)){
		if(array_key_exists('sortOrder', $parameters)) $parameters['sortOrder'] = strtoupper($parameters['sortOrder']);
		if(!array_key_exists('sortOrder', $parameters) || ($parameters['sortOrder'] != 'ASC' && $parameters['sortOrder'] != 'DESC')) $parameters['sortOrder'] = 'ASC';

		$sql .= ' ORDER BY posts.'.$parameters['sortBy'].' '.$parameters['sortOrder'];
	} else {
		$sql .= ' ORDER BY posttime DESC';
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


/**
 * Returns forum posts count
 *
 * @param $parameters
 * 
 * role: defaults to 'user'
 * search: value to be searched, if not specified then will return all rows
 * searchBy: column to be searched, if not specified or invalid then will return all rows
 * searchOperator: operator to be used for searching, defaults to =
 * limit: maximum number of rows to be returned, if not specified then will not set a limit
 *
 */
function countPosts($parameters){

	global $validSearchOperators;
	global $dbConnection;

	if(!array_key_exists('role', $parameters)) $parameters['role'] = 'user';
	
	$sql = "SELECT COUNT(*) AS count FROM posts";

	$boundInput = ['']; //reserve $boundInput[0] for the string denoting variable types

	if(array_key_exists('search', $parameters) && isset($parameters['search']) && array_key_exists('searchBy', $parameters) && isset($parameters['searchBy'])){
		
		if(in_array($parameters['searchBy'], getPostSearchableColumns($parameters['role']))){

			if(array_key_exists('searchOperator', $parameters)) $parameters['searchOperator'] = strtoupper($parameters['searchOperator']);
			if(!array_key_exists('searchOperator', $parameters) || !in_array($parameters['searchOperator'], $validSearchOperators)) $parameters['searchOperator'] = '=';

			$sql .= ' WHERE '.$parameters['searchBy'].' '.$parameters['searchOperator'].' ?';
			$boundInput[] = &$parameters['search'];
			$boundInput[0] .= getParameterType($parameters['search']);
		}
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
	}

	if(!$stmt) return false;

	if(count($boundInput) > 1) call_user_func_array([$stmt, "bind_param"], $boundInput);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($countResult);
	$stmt->fetch();
	$stmt->close();

	return $countResult;
}


/**
 * Updates post data, returns number of affected rows on success and false otherwise
 *
 * @param $parameters
 * 
 * values: associative array containing columns and values to be updated
 * search: value to be searched, if not specified then will return all rows - required
 * searchBy: column to be searched, if not specified or invalid then will return all rows
 * searchOperator: operator to be used for searching, defaults to =
 * limit: maximum number of rows to be updated
 *
 */
function updatePosts($parameters){

	global $validSearchOperators;
	global $postColumnDescription;
	global $dbConnection;

	$sql = "UPDATE posts SET ";

	$boundInput = ['']; //reserve $boundInput[0] for the string denoting variable types

	$separator = '';
	if(!array_key_exists('values', $parameters)) $parameters['values'] = [];
	foreach($parameters['values'] as $key => $val){
		if(array_key_exists($key, $postColumnDescription)){
			$sql .= $separator.$key.' = ?';
			$separator = ', ';

			$boundInput[] = &$parameters['values'][$key];
			$boundInput[0] .= getParameterType($parameters['values'][$key]);
		}
	}

	if(array_key_exists('search', $parameters) && isset($parameters['search']) && array_key_exists('searchBy', $parameters) && isset($parameters['searchBy'])){
		
		if(in_array($parameters['searchBy'], getPostSearchableColumns('admin'))){

			if(array_key_exists('searchOperator', $parameters)) $parameters['searchOperator'] = strtoupper($parameters['searchOperator']);
			if(!array_key_exists('searchOperator', $parameters) || !in_array($parameters['searchOperator'], $validSearchOperators)) $parameters['searchOperator'] = '=';

			$sql .= ' WHERE '.$parameters['searchBy'].' '.$parameters['searchOperator'].' ?';
			$boundInput[] = &$parameters['search'];
			$boundInput[0] .= getParameterType($parameters['search']);
		} else {
			return false; //fail-safe, if no where criteria specified dont update
		}
	} else {
		return false;
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
	}

	if(!$stmt) return false;

	if(count($boundInput) > 1) call_user_func_array([$stmt, "bind_param"], $boundInput);
	$stmt->execute();
	$affectedRows = $stmt->affected_rows;
	$stmt->close();

	return $affectedRows;
}



/**
 * Inserts post data, returns number of affected rows on success and false otherwise
 *
 * @param $parameters
 * 
 * values: associative array containing columns and values to be updated
 *
 */
function insertPosts($parameters){

	global $postColumnDescription;
	global $dbConnection;

	$sql = "INSERT INTO posts (";

	$boundInput = ['']; //reserve $boundInput[0] for the string denoting variable types

	$counter = 0;
	$separator = '';
	if(!array_key_exists('values', $parameters)) $parameters['values'] = [];
	foreach($parameters['values'] as $key => $val){
		if(array_key_exists($key, $postColumnDescription)){
			$sql .= $separator.$key;
			$separator = ', ';
			$counter++;

			$boundInput[] = &$parameters['values'][$key];
			$boundInput[0] .= getParameterType($parameters['values'][$key]);
		}
	}

	$sql .= ') VALUES (';

	$separator = '';
	for($i = 0; $i<$counter; $i++){
		$sql .= $separator.'?';
		$separator = ', ';
	}

	$sql .= ')';

	$stmt = $dbConnection->prepare($sql);

	if(array_key_exists('debug', $parameters) && $parameters['debug']){
		echo "stmt: ";
		var_dump($stmt);
		echo "sql: ";
		var_dump($sql);
		echo "boundInput: ";
		var_dump($boundInput);
	}

	if(!$stmt) return false;

	if(count($boundInput) > 1) call_user_func_array([$stmt, "bind_param"], $boundInput);
	$stmt->execute();
	$affectedRows = $stmt->affected_rows;
	$stmt->close();

	return $affectedRows;
}

?>