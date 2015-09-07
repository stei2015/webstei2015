<?php

require_once(__DIR__.'/../include/http.php');
require_once(__DIR__.'/../include/auth.php');
require_once(__DIR__.'/../include/database.php');

ensureLogin();

$stmt = $dbConnection->prepare("SELECT namapanggilan, tanggallahir,	email FROM studentdata WHERE nim = ? LIMIT 1");
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->store_result();
$result = [];
$stmt->bind_result($result['namapanggilan'], $result['tanggallahir'], $result['email']);
$numRows = $stmt->num_rows;
$users = getResultArray($result, $stmt);
$stmt->close();

if($numRows > 0){

	$_SESSION['namapanggilan'] = $users[0]['namapanggilan'];
	$_SESSION['tanggallahir'] = $users[0]['tanggallahir'];
	$_SESSION['email'] = $users[0]['email'];

} else {
	redirect('studentdata/edit.php'); //jika blm isi data diri, redirect ke form data diri
}

//jika blm upload foto, redirect ke page utk upload foto

$nim = filter_var($_SESSION['id'], FILTER_SANITIZE_NUMBER_INT);
if(!file_exists(__DIR__.'/../data/profilepictures/'.$nim)) redirect('studentdata/editprofilepicture.php');

redirect('forum');

?>