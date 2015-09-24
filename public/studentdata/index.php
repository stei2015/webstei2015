<?php

require_once(__DIR__.'/../../include/http.php');
require_once(__DIR__.'/../../include/auth.php');
require_once(__DIR__.'/../../models/user.php');

ensureLogin();

$queryParams = [
	'role' 		=> $_SESSION['type'],
	'columns' 	=> array_diff(getUserViewableColumns($_SESSION['type']), ['bio', 'catatan']),
	'sortBy' 	=> 'id'
];

if(isset($_GET['search']) && isset($_GET['by'])){
	$queryParams['search'] = $_GET['search'];
	$queryParams['searchBy'] = $_GET['by'];
	$queryParams['searchOperator'] = 'LIKE';
}

$viewColumns = getUserColumnDescription($queryParams['columns']);

$data = getUsers($queryParams);

include(__DIR__.'/../../views/studentdata/index.php');

?>