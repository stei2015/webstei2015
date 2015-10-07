<?php

require_once(__DIR__.'/../include/database.php');

$userColumnDescription = [

	'id' 				=> 'NIM',
	'username' 			=> 'Username',
	'password' 			=> 'Password',
	'type' 				=> 'Jenis akun',

	'nim' 				=> 'NIM',
	'namalengkap' 		=> 'Nama lengkap',
	'namapanggilan' 	=> 'Nama panggilan',
	'noreg' 			=> 'Nomor registrasi',
	'tempatlahir' 		=> 'Tempat lahir',
	'tanggallahir'		=> 'Tanggal lahir',
	'sma' 				=> 'SMA asal',
	'alamatasal' 		=> 'Alamat asal',
	'kotaasal' 			=> 'Kota asal',
	'provinsiasal' 		=> 'Provinsi asal',
	'kodeposasal' 		=> 'Kode pos asal',
	'alamatstudi' 		=> 'Alamat di Bandung',
	'kodeposstudi' 		=> 'Kode pos di Bandung',
	'hp' 				=> 'Nomor HP',
	'telepondarurat' 	=> 'Telepon darurat',
	'email' 			=> 'Email',
	'emailstudents' 	=> 'Email students.itb.ac.id',
	'line' 				=> 'LINE',
	'twitter' 			=> 'Twitter',
	'facebook'		 	=> 'Facebook',
	'golongandarah' 	=> 'Golongan darah',
	'riwayatpenyakit' 	=> 'Riwayat penyakit',
	'bio' 				=> 'Bio/deskripsi singkat',
	'catatan' 			=> 'Catatan'
];

function getUserColumnDescription($column){
	global $userColumnDescription;

	if(is_string($column)){
		if(!array_key_exists($column, $userColumnDescription)) return '';
		return $userColumnDescription[$column];
	
	} else if(is_array($column)){

		$result = [];
		foreach($column as $item){
			$result[$item] = getUserColumnDescription($item);
		}
		return $result;
	}

	return false;
}

$userSearchableColumns = [
	'admin' => ['id', 'username', 'type', 'namalengkap', 'namapanggilan', 'noreg', 'tempatlahir', 'tanggallahir', 'sma', 'alamatasal', 'kotaasal', 'provinsiasal', 'kodeposasal', 'alamatstudi', 'kodeposstudi', 'hp', 'telepondarurat', 'email', 'emailstudents', 'line', 'twitter', 'facebook', 'golongandarah', 'riwayatpenyakit', 'bio', 'catatan'],
	'user' 	=> ['id', 'username', 'namalengkap', 'namapanggilan']
];

function getUserSearchableColumns($role = 'user'){
	global $userSearchableColumns;
	if(!array_key_exists($role, $userSearchableColumns)) $role = 'user';
	return $userSearchableColumns[$role];
}

$userViewableColumns = [
	'admin' => ['id', 'username', 'type', 'namalengkap', 'namapanggilan', 'noreg', 'tempatlahir', 'tanggallahir', 'sma', 'alamatasal', 'kotaasal', 'provinsiasal', 'kodeposasal', 'alamatstudi', 'kodeposstudi', 'hp', 'telepondarurat', 'email', 'emailstudents', 'line', 'twitter', 'facebook', 'golongandarah', 'riwayatpenyakit', 'bio', 'catatan'],
	'user' 	=> ['id', 'username', 'namalengkap', 'namapanggilan']
];

function getUserViewableColumns($role = 'user'){
	global $userViewableColumns;
	if(!array_key_exists($role, $userViewableColumns)) $role = 'user';
	return $userViewableColumns[$role];
}

/**
 * Returns users data in the form of array[rowIndex][columnName]
 *
 * @param $parameters
 * 
 * role: defaults to 'user'
 * columns: array containing columns to be returned, defaults to getUserViewableColumns[$role]
 * search: value to be searched, if not specified then will return all rows
 * searchBy: column to be searched, if not specified or invalid then will return all rows
 * searchOperator: operator to be used for searching, defaults to =
 * sortBy: column to search by, if not specified then will not sort
 * sortOrder: ASC/DESC, defaults to ASC
 * limit: maximum number of rows to be returned, if not specified then will not set a limit
 *
 */
function getUsers($parameters){

	global $validSearchOperators;
	global $userColumnDescription;
	global $dbConnection;

	$sql = "SELECT ";
	$boundInput = ['']; //reserve $boundInput[0] for the string denoting variable types
	$boundOutput = [];

	if(!array_key_exists('role', $parameters)) $parameters['role'] = 'user';

	$separator = '';
	$counter = 0;
	if(!array_key_exists('columns', $parameters)) $parameters['columns'] = getUserViewableColumns($parameters['role']);
	foreach($userColumnDescription as $key => $val){
		if(in_array($key, $parameters['columns'])){
			$sql .= $separator.$key;
			$boundName = '_boundOutput'.$counter; //name of new variable
			$counter++;
			$$boundName = $key; //create new variable named with the value of boundName, assign the value of $key to it
			$boundOutput[$key] = &$$boundName; //store the reference to the new variable in the boundOutput array
			$separator = ', ';
		}
	}

	$sql .= " FROM users LEFT JOIN studentdata ON users.id = studentdata.nim";

	if(array_key_exists('search', $parameters) && isset($parameters['search']) && array_key_exists('searchBy', $parameters) && isset($parameters['searchBy']) && in_array($parameters['searchBy'], getUserSearchableColumns($parameters['role']))){	
		if(array_key_exists('searchOperator', $parameters)) $parameters['searchOperator'] = strtoupper($parameters['searchOperator']);
		if(!array_key_exists('searchOperator', $parameters) || !in_array($parameters['searchOperator'], $validSearchOperators)) $parameters['searchOperator'] = '=';

		$sql .= ' WHERE '.$parameters['searchBy'].' '.$parameters['searchOperator'].' ?';
		$boundInput[] = &$parameters['search'];
		$boundInput[0] .= getParameterType($parameters['search']);
	}

	if(array_key_exists('sortBy', $parameters)){
		if(array_key_exists('sortOrder', $parameters)) $parameters['sortOrder'] = strtoupper($parameters['sortOrder']);
		if(!array_key_exists('sortOrder', $parameters) || ($parameters['sortOrder'] != 'ASC' && $parameters['sortOrder'] != 'DESC')) $parameters['sortOrder'] = 'ASC';

		$sql .= ' ORDER BY '.$parameters['sortBy'].' '.$parameters['sortOrder'];
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
 * Returns users data count
 *
 * @param $parameters
 * 
 * role: defaults to 'user'
 * search: value to be searched, if not specified then will return all rows
 * searchBy: column to be searched, if not specified or invalid then will return all rows
 * searchOperator: operator to be used for searching, defaults to =
 * limit: maximum number of rows to be returned, if not specified then will not set a limit
 *
 * useStudentDataTable: count data using only the student data table
 *
 */
function countUsers($parameters){

	global $validSearchOperators;
	global $dbConnection;

	if(!array_key_exists('role', $parameters)) $parameters['role'] = 'user';
	
	if(array_key_exists('useStudentDataTable', $parameters) && $parameters['useStudentDataTable']){
		$sql = "SELECT COUNT(*) AS count FROM studentdata";
		$useSDT = true;
	} else {
		$sql = "SELECT COUNT(*) AS count FROM users";
		$useSDT = false;
	}

	$boundInput = ['']; //reserve $boundInput[0] for the string denoting variable types

	if(array_key_exists('search', $parameters) && isset($parameters['search']) && array_key_exists('searchBy', $parameters) && isset($parameters['searchBy'])){
		
		if(($useSDT && $parameters['searchBy'] == 'nim') || in_array($parameters['searchBy'], getUserSearchableColumns($parameters['role']))){

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
 * Updates user data, returns number of affected rows on success and false otherwise
 *
 * @param $parameters
 * 
 * values: associative array containing columns and values to be updated
 * search: value to be searched, if not specified then will return all rows - required
 * searchBy: column to be searched, if not specified or invalid then will return all rows
 * searchOperator: operator to be used for searching, defaults to =
 * limit: maximum number of rows to be updated
 *
 * useStudentDataTable: if true, update the student data table, otherwise update users table
 *
 */
function updateUsers($parameters){

	global $validSearchOperators;
	global $userColumnDescription;
	global $dbConnection;

	if(array_key_exists('useStudentDataTable', $parameters) && $parameters['useStudentDataTable']){
		$sql = "UPDATE studentdata SET ";
		$useSDT = true;
	} else {
		$sql = "UPDATE users SET ";
		$useSDT = false;
	}

	$boundInput = ['']; //reserve $boundInput[0] for the string denoting variable types

	$separator = '';
	if(!array_key_exists('values', $parameters)) $parameters['values'] = [];
	foreach($parameters['values'] as $key => $val){
		if(array_key_exists($key, $userColumnDescription)){
			$sql .= $separator.$key.' = ?';
			$separator = ', ';

			$boundInput[] = &$parameters['values'][$key];
			$boundInput[0] .= getParameterType($parameters['values'][$key]);
		}
	}

	if(array_key_exists('search', $parameters) && isset($parameters['search']) && array_key_exists('searchBy', $parameters) && isset($parameters['searchBy'])){
		
		if(($useSDT && $parameters['searchBy'] == 'nim') || in_array($parameters['searchBy'], getUserSearchableColumns('admin'))){

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
 * Inserts user data, returns number of affected rows on success and false otherwise
 *
 * @param $parameters
 * 
 * values: associative array containing columns and values to be updated
 *
 * useStudentDataTable: if true, insert to the student data table, otherwise insert to users table
 *
 */
function insertUsers($parameters){

	global $userColumnDescription;
	global $dbConnection;

	if(array_key_exists('useStudentDataTable', $parameters) && $parameters['useStudentDataTable']){
		$sql = "INSERT INTO studentdata (";
		$useSDT = true;
	} else {
		$sql = "INSERT INTO users (";
		$useSDT = false;
	}

	$boundInput = ['']; //reserve $boundInput[0] for the string denoting variable types

	$counter = 0;
	$separator = '';
	if(!array_key_exists('values', $parameters)) $parameters['values'] = [];
	foreach($parameters['values'] as $key => $val){
		if(array_key_exists($key, $userColumnDescription)){
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