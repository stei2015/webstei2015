<?php

require_once(__DIR__.'/../../include/http.php');
require_once(__DIR__.'/../../include/auth.php');
require_once(__DIR__.'/../../models/user.php');

ensureLogin();

if($_SESSION['type'] == 'admin'){

	if(isset($_GET['nim'])) $nim = $_GET['nim'];
	elseif(isset($_POST['nim'])) $nim = $_POST['nim'];
	else $nim = $_SESSION['id'];  //hanya admin yang bisa edit data orang lain
	
} else {
	$nim = $_SESSION['id'];
}

$nim = filter_var($nim, FILTER_SANITIZE_NUMBER_INT);

$oldData = getUsers([
	'role' => 'admin',
	'search' => $nim,
	'searchBy' => 'id',
	'limit' => 1
]);

if($oldData === false){
	httpError(500, 'Gagal mengakses database');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){ //proses hasil submit form data induk
	
	//filter input
	$_POST['noreg'] = filter_var($_POST['noreg'], FILTER_SANITIZE_NUMBER_INT);
	$_POST['tanggallahir'] = filter_var($_POST['tanggallahir'], FILTER_SANITIZE_STRING);
	$_POST['kodeposasal'] = filter_var($_POST['kodeposasal'], FILTER_SANITIZE_NUMBER_INT);
	$_POST['kodeposstudi'] = filter_var($_POST['kodeposstudi'], FILTER_SANITIZE_NUMBER_INT);
	$_POST['hp'] = filter_var($_POST['hp'], FILTER_SANITIZE_STRING);
	$_POST['telepondarurat'] = filter_var($_POST['telepondarurat'], FILTER_SANITIZE_STRING);
	$_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$_POST['emailstudents'] = filter_var($_POST['emailstudents'], FILTER_SANITIZE_EMAIL);

	$editColumns = [
		'namalengkap',
		'namapanggilan',
		'noreg',
		'tempatlahir',
		'tanggallahir',
		'sma',
		'alamatasal',
		'kotaasal',
		'provinsiasal',
		'kodeposasal',
		'alamatstudi',
		'kodeposstudi',
		'hp',
		'telepondarurat',
		'email',
		'emailstudents',
		'line',
		'twitter',
		'facebook',
		'golongandarah',
		'riwayatpenyakit',
		'bio',
		'catatan'
	];

	foreach($editColumns as $column){
		if($column != 'nim') $editValues[$column] = $_POST[$column];
	}

	$count = countUsers([
		'role' => 'user',
		'search' => $nim,
		'searchBy' => 'nim',
		'limit' => 1,
		'useStudentDataTable' => true,
	]);

	if($count > 0){

		//data induk sudah pernah diisi, update
		$affectedRows = updateUsers([
			'values' => $editValues,
			'search' => $nim,
			'searchBy' => 'nim',
			'useStudentDataTable' => true
		]);

	} else {

		$editValues['nim'] = $nim;

		//data induk belum ada, insert
		$affectedRows = insertUsers([
			'values' => $editValues,
			'useStudentDataTable' => true,
			'debug' => true
		]);
	}

	if(!$affectedRows){
		httpError(500, 'Gagal menyimpan data ke database');
	}

	redirect('index.php');

} else { //tampilkan page input data induk

	require(__DIR__.'/../../views/studentdata/edit.php');
}

?>