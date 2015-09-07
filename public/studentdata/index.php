<?php

require_once(__DIR__.'/../../include/http.php');
require_once(__DIR__.'/../../include/auth.php');
require_once(__DIR__.'/../../include/database.php');

ensureLogin();

if($_SESSION['type'] == 'admin'){
	$validSearchCriteria = ['namalengkap', 'namapanggilan', 'noreg', 'tempatlahir', 'tanggallahir', 'sma', 'alamatasal', 'kotaasal', 'provinsiasal', 'kodeposasal', 'alamatstudi', 'kodeposstudi', 'hp', 'telepondarurat', 'email', 'emailstudents', 'line', 'twitter', 'facebook', 'golongandarah', 'riwayatpenyakit', 'bio', 'catatan'];
} else {
	$validSearchCriteria = ['namalengkap', 'namapanggilan', 'sma', 'kotaasal', 'provinsiasal', 'alamatstudi', 'kodeposstudi', 'emailstudents', 'line', 'twitter', 'facebook', 'golongandarah', 'bio'];
}

$sql = "SELECT
		namalengkap,
		namapanggilan,
		noreg,
		tempatlahir,
		tanggallahir,
		sma,
		alamatasal,
		kotaasal,
		provinsiasal,
		kodeposasal,
		alamatstudi,
		kodeposstudi,
		hp,
		telepondarurat,
		email,
		emailstudents,
		line,
		twitter,
		facebook,
		golongandarah,
		riwayatpenyakit,
		bio,
		catatan
		FROM studentdata";

$doSearch = false;
if(isset($_GET['search']) && isset($_GET['by']) && array_key_exists($_GET['by'], $validSearchCriteria)){
	$sql = $sql . " WHERE ".$_GET['by']." LIKE ?";
	$doSearch = true;
}

$stmt = $dbConnection->prepare($sql);

if($doSearch) $stmt->bind_param('s', $_GET['search']);
$stmt->execute();
$stmt->store_result();
$result = [];
$stmt->bind_result(
	$result['namalengkap'],
	$result['namapanggilan'],
	$result['noreg'],
	$result['tempatlahir'],
	$result['tanggallahir'],
	$result['sma'],
	$result['alamatasal'],
	$result['kotaasal'],
	$result['provinsiasal'],
	$result['kodeposasal'],
	$result['alamatstudi'],
	$result['kodeposstudi'],
	$result['hp'],
	$result['telepondarurat'],
	$result['email'],
	$result['emailstudents'],
	$result['line'],
	$result['twitter'],
	$result['facebook'],
	$result['golongandarah'],
	$result['riwayatpenyakit'],
	$result['bio'],
	$result['catatan']
);
$data = getResultArray($result, $stmt);
$numRows = $stmt->num_rows;
$stmt->close();

include(__DIR__.'/../../views/studentdata/index.php');

?>