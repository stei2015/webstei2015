<?php

require_once(__DIR__.'/../include/http.php');
require_once(__DIR__.'/../include/auth.php');
require_once(__DIR__.'/../include/database.php');

ensureLogin();

$stmt = $dbConnection->prepare("SELECT namapanggilan, tanggallahir,	email FROM studentdata WHERE nim = ? LIMIT 1");
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if($result->num_rows > 0){

	$resultRow = $result->fetch_object();
	$_SESSION['namapanggilan'] = $resultRow->namapanggilan;
	$_SESSION['tanggallahir'] = $resultRow->tanggallahir;
	$_SESSION['email'] = $resultRow->email;

} else {
	redirect('studentdata/edit.php'); //jika blm isi data diri, redirect ke form data diri
}

redirect('forum');

?>