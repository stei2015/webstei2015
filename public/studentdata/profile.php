<?php

require_once(__DIR__.'/../../include/http.php');
require_once(__DIR__.'/../../include/auth.php');
require_once(__DIR__.'/../../models/user.php');

ensureLogin();

if(isset($_GET['nim'])) $nim = $_GET['nim']; else $nim = $_SESSION['id'];
$nim = filter_var($nim, FILTER_SANITIZE_NUMBER_INT);

$profileEditable = false;
if($nim == $_SESSION['id'] || $_SESSION['type'] == 'admin') $profileEditable = true;

$studentData = getUsers([
	'role' => $nim == $_SESSION['id'] ? 'admin' : $_SESSION['type'],
	'search' => $nim,
	'searchBy' => 'id',
	'limit' => 1
]);

if($studentData === false){
	httpError(500, 'Gagal mengakses database');
}

require(__DIR__.'/../../views/studentdata/profile.php');

?>