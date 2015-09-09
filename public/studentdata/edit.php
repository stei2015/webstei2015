<?php

require_once(__DIR__.'/../../include/http.php');
require_once(__DIR__.'/../../include/auth.php');
require_once(__DIR__.'/../../include/database.php');

ensureLogin();

if($_SESSION['type'] == 'admin'){

	if(isset($_GET['nim'])) $nim = $_GET['nim'];
	elseif(isset($_POST['nim'])) $nim = $_POST['nim'];
	else $nim = $_SESSION['id'];  //hanya admin yang bisa edit data orang lain
	
} else {
	$nim = $_SESSION['id'];
}

$nim = filter_var($nim, FILTER_SANITIZE_NUMBER_INT);

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
								catatan
								FROM studentdata WHERE nim = ? LIMIT 1");

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
	$result['catatan']
);
$oldData = getResultArray($result, $stmt);
$numRows = $stmt->num_rows;
$stmt->close();

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
	
	if($numRows > 0){

		//data induk sudah pernah diisi, update
		$sql = "UPDATE studentdata SET
				namalengkap = ?,
				namapanggilan = ?,
				noreg = ?,
				tempatlahir = ?,
				tanggallahir = ?,
				sma = ?,
				alamatasal = ?,
				kotaasal = ?,
				provinsiasal = ?,
				kodeposasal = ?,
				alamatstudi = ?,
				kodeposstudi = ?,
				hp = ?,
				telepondarurat = ?,
				email = ?,
				emailstudents = ?,
				line = ?,
				twitter = ?,
				facebook = ?,
				golongandarah = ?,
				riwayatpenyakit = ?,
				bio = ?,
				catatan = ?
				WHERE nim = ?";    

		$stmt = $dbConnection->prepare($sql);
		$stmt->bind_param('ssissssssisisssssssssssi',
							$_POST['namalengkap'],
							$_POST['namapanggilan'],
							$_POST['noreg'],
							$_POST['tempatlahir'],
							$_POST['tanggallahir'],
							$_POST['sma'],
							$_POST['alamatasal'],
							$_POST['kotaasal'],
							$_POST['provinsiasal'],
							$_POST['kodeposasal'],
							$_POST['alamatstudi'],
							$_POST['kodeposstudi'],
							$_POST['hp'],
							$_POST['telepondarurat'],
							$_POST['email'],
							$_POST['emailstudents'],
							$_POST['line'],
							$_POST['twitter'],
							$_POST['facebook'],
							$_POST['golongandarah'],
							$_POST['riwayatpenyakit'],
							$_POST['bio'],
							$_POST['catatan'],
							$nim
						);

	    $stmt->execute();
	    $stmt->close();

	} else {

		//data induk belum ada, insert
		$sql = "INSERT INTO studentdata (
				nim,
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
				) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$stmt = $dbConnection->prepare($sql);

		$stmt->bind_param('ississssssisisssssssssss',
							$nim,
							$_POST['namalengkap'],
							$_POST['namapanggilan'],
							$_POST['noreg'],
							$_POST['tempatlahir'],
							$_POST['tanggallahir'],
							$_POST['sma'],
							$_POST['alamatasal'],
							$_POST['kotaasal'],
							$_POST['provinsiasal'],
							$_POST['kodeposasal'],
							$_POST['alamatstudi'],
							$_POST['kodeposstudi'],
							$_POST['hp'],
							$_POST['telepondarurat'],
							$_POST['email'],
							$_POST['emailstudents'],
							$_POST['line'],
							$_POST['twitter'],
							$_POST['facebook'],
							$_POST['golongandarah'],
							$_POST['riwayatpenyakit'],
							$_POST['bio'],
							$_POST['catatan']
						);

	    $stmt->execute();
	    $stmt->close();
	}

	redirect('index.php');

} else { //tampilkan page input data induk

	include(__DIR__.'/../../views/studentdata/edit.php');
}

?>