<?php

require_once(__DIR__.'/../include/database.php');

$threadColumnDescription = [

	'id' 				=> 'ID',
	'forum' 			=> 'Forum',
	'title' 			=> 'Judul',
	'author'	 		=> 'Penulis',
	'lastpost'			=> 'Update terakhir',
	'readonly'			=> 'Read-only',
	'sticky'			=> 'Sticky',
	'content'			=> 'Isi'
];

function getThreadColumnDescription($column){
	global $threadColumnDescription;

	if(is_string($column)){
		if(!array_key_exists($column, $threadColumnDescription)) return '';
		return $threadColumnDescription[$column];
	
	} else if(is_array($column)){

		$result = [];
		foreach($column as $item){
			$result[$item] = getThreadColumnDescription($item);
		}
		return $result;
	}

	return false;
}

$threadSearchableColumns = [
	'admin' => ['id', 'forum', 'title', 'author', 'lastpost', 'readonly', 'sticky', 'content'],
	'user' 	=> ['id', 'forum', 'title', 'author', 'lastpost', 'readonly', 'sticky', 'content']
];

function getThreadSearchableColumns($role = 'user'){
	global $threadSearchableColumns;
	if(!array_key_exists($role, $threadSearchableColumns)) $role = 'user';
	return $threadSearchableColumns[$role];
}

$threadViewableColumns = [
	'admin' => ['id', 'forum', 'title', 'author', 'lastpost', 'readonly', 'sticky', 'content'],
	'user' 	=> ['id', 'forum', 'title', 'author', 'lastpost', 'readonly', 'sticky', 'content']
];

function getThreadViewableColumns($role = 'user'){
	global $threadViewableColumns;
	if(!array_key_exists($role, $threadViewableColumns)) $role = 'user';
	return $threadViewableColumns[$role];
}

/**
 * Returns threads data in the form of array[rowIndex][columnName]
 *
 * @param $parameters
 * 
 * role: defaults to 'user'
 * columns: array containing columns to be returned, defaults to getThreadViewableColumns[$role]
 * search: value to be searched, if not specified then will return all rows
 * searchBy: column to be searched, if not specified or invalid then will return all rows
 * searchOperator: operator to be used for searching, defaults to =
 * sortBy: column to search by, if not specified then will will sort sticky DESC, posttime DESC
 * sortOrder: ASC/DESC, defaults to ASC
 * limit: maximum number of rows to be returned, if not specified then will not set a limit
 *
 */
function getThreads($parameters){

	global $validSearchOperators;
	global $threadColumnDescription;
	global $dbConnection;

	$sql = "SELECT ";
	$boundInput = ['']; //reserve $boundInput[0] for the string denoting variable types
	$boundOutput = [];

	if(!array_key_exists('role', $parameters)) $parameters['role'] = 'user';

	$separator = '';
	$counter = 0;
	if(!array_key_exists('columns', $parameters)) $parameters['columns'] = getThreadViewableColumns($parameters['role']);
	foreach($threadColumnDescription as $key => $val){
		if(in_array($key, $parameters['columns'])){
			$sql .= $separator.'threads.'.$key;
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


	$sql .= " FROM threads LEFT JOIN users ON threads.author = users.id ";

	if(array_key_exists('search', $parameters) && isset($parameters['search']) && array_key_exists('searchBy', $parameters) && isset($parameters['searchBy']) && in_array($parameters['searchBy'], getThreadSearchableColumns($parameters['role']))){	
		if(array_key_exists('searchOperator', $parameters)) $parameters['searchOperator'] = strtoupper($parameters['searchOperator']);
		if(!array_key_exists('searchOperator', $parameters) || !in_array($parameters['searchOperator'], $validSearchOperators)) $parameters['searchOperator'] = '=';

		$sql .= ' WHERE threads.'.$parameters['searchBy'].' '.$parameters['searchOperator'].' ?';
		$boundInput[] = &$parameters['search'];
		$boundInput[0] .= getParameterType($parameters['search']);
	}

	if(array_key_exists('sortBy', $parameters)){
		if(array_key_exists('sortOrder', $parameters)) $parameters['sortOrder'] = strtoupper($parameters['sortOrder']);
		if(!array_key_exists('sortOrder', $parameters) || ($parameters['sortOrder'] != 'ASC' && $parameters['sortOrder'] != 'DESC')) $parameters['sortOrder'] = 'ASC';

		$sql .= ' ORDER BY threads.'.$parameters['sortBy'].' '.$parameters['sortOrder'];
	} else {
		$sql .= ' ORDER BY sticky DESC, lastpost DESC';
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
 * Returns forum threads count
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
function countThreads($parameters){

	global $validSearchOperators;
	global $dbConnection;

	if(!array_key_exists('role', $parameters)) $parameters['role'] = 'user';
	
	$sql = "SELECT COUNT(*) AS count FROM threads";

	$boundInput = ['']; //reserve $boundInput[0] for the string denoting variable types

	if(array_key_exists('search', $parameters) && isset($parameters['search']) && array_key_exists('searchBy', $parameters) && isset($parameters['searchBy'])){
		
		if(in_array($parameters['searchBy'], getThreadSearchableColumns($parameters['role']))){

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
 * Updates thread data, returns number of affected rows on success and false otherwise
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
function updateThreads($parameters){

	global $validSearchOperators;
	global $threadColumnDescription;
	global $dbConnection;

	$sql = "UPDATE threads SET ";

	$boundInput = ['']; //reserve $boundInput[0] for the string denoting variable types

	$separator = '';
	if(!array_key_exists('values', $parameters)) $parameters['values'] = [];
	foreach($parameters['values'] as $key => $val){
		if(array_key_exists($key, $threadColumnDescription)){
			$sql .= $separator.$key.' = ?';
			$separator = ', ';

			$boundInput[] = &$parameters['values'][$key];
			$boundInput[0] .= getParameterType($parameters['values'][$key]);
		}
	}

	if(array_key_exists('search', $parameters) && isset($parameters['search']) && array_key_exists('searchBy', $parameters) && isset($parameters['searchBy'])){
		
		if(in_array($parameters['searchBy'], getThreadSearchableColumns('admin'))){

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
 * Inserts thread data, returns number of affected rows on success and false otherwise
 *
 * @param $parameters
 * 
 * values: associative array containing columns and values to be updated
 *
 */
function insertThreads($parameters){

	global $threadColumnDescription;
	global $dbConnection;

	$sql = "INSERT INTO threads (";

	$boundInput = ['']; //reserve $boundInput[0] for the string denoting variable types

	$counter = 0;
	$separator = '';
	if(!array_key_exists('values', $parameters)) $parameters['values'] = [];
	foreach($parameters['values'] as $key => $val){
		if(array_key_exists($key, $threadColumnDescription)){
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