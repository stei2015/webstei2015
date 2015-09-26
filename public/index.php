<?php

require_once(__DIR__.'/../include/http.php');
require_once(__DIR__.'/../include/auth.php');
require_once(__DIR__.'/../models/user.php');
require_once(__DIR__.'/../config.php');

ensureLogin();

//jika blm isi data diri, redirect ke form data diri

$count = countUsers([
	'role' => 'user',
	'search' => $_SESSION['id'],
	'searchBy' => 'nim',
	'limit' => 1,
	'useStudentDataTable' => true,
]);

if($count == false){
	httpError(500, 'Gagal mengakses database');
}

if($count < 1) redirect('studentdata/edit.php');

//jika blm upload foto, redirect ke page utk upload foto

$nim = filter_var($_SESSION['id'], FILTER_SANITIZE_NUMBER_INT);
if(!file_exists(DATA_DIR.'profilepictures/'.$nim)) redirect('studentdata/editprofilepicture.php');

//all forms filled, redirect to home page

redirect('forum');

?>