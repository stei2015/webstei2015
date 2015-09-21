<?php

require_once(__DIR__.'/../../include/http.php');
require_once(__DIR__.'/../../include/auth.php');
require_once(__DIR__.'/../../include/database.php');

ensureLogin();

if(isset($_GET['nim'])) $nim = $_GET['nim']; else $nim = $_SESSION['id'];
$nim = filter_var($nim, FILTER_SANITIZE_NUMBER_INT);

$profileEditable = false;
if($nim == $_SESSION['id']) $profileEditable = true;

$stmt = $dbConnection->prepare("SELECT
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
								catatan,
								username,
								type
								FROM studentdata
								INNER JOIN users
								ON users.id = studentdata.nim
								WHERE nim = ? LIMIT 1");

$stmt->bind_param('i', $nim);
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
	$result['catatan'],
	$result['username'],
	$result['type']
);
$studentData = getResultArray($result, $stmt);
$numRows = $stmt->num_rows;
$stmt->close();

include(__DIR__.'/../../views/studentdata/profile.php');

?>