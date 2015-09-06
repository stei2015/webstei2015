<?php

require_once(__DIR__.'/../../include/http.php');
require_once(__DIR__.'/../../include/auth.php');
require_once(__DIR__.'/../../include/upload.php');

ensureLogin();

if($_SESSION['type'] == 'admin'){
	$nim = $_GET['nim'] || $_POST['nim'] || $_SESSION['id']; //hanya admin yang bisa edit data orang lain
} else {
	$nim = $_SESSION['id'];
}

$nim = filter_var($nim, FILTER_SANITIZE_NUMBER_INT);

if($_SERVER['REQUEST_METHOD'] == 'POST'){ //proses upload

	if(isset($_FILES['profilepicture'])){
		$uploadResult = upload_pp('profilepicture', $nim, 256000);
		if($uploadResult != '') $uploadErrors = $uploadResult;
	}
}

$hasPicture = file_exists(__DIR__.'/../../data/profilepictures/'.$nim);

include(__DIR__.'/../../views/studentdata/editprofilepicture.php'); //tampilkan page upload profile picture

?>