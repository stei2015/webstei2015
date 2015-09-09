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
		FROM studentdata";

$doSearch = false;
if(isset($_GET['search']) && isset($_GET['by']) && in_array($_GET['by'], $validSearchCriteria)){
	$sql = $sql . " WHERE ".$_GET['by']." LIKE ?";
	$doSearch = true;
	$searchQuery = '%'.$_GET['search'].'%';
}

$stmt = $dbConnection->prepare($sql);

if($doSearch) $stmt->bind_param('s', $searchQuery);
$stmt->execute();
$stmt->store_result();
$result = [];
$stmt->bind_result(
	$result['nim'],
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

if($_SESSION == 'admin'){
	$viewColumns = [
		'nim' => 'NIM',
		'namalengkap' => 'Nama lengkap',
		'namapanggilan' => 'Nama panggilan',
		'noreg' => 'Nomor registrasi',
		'tempatlahir' => 'Tempat lahir',
		'tanggallahir' => 'Tanggal lahir',
		'sma' => 'SMA asal',
		'alamatasal' => 'Alamat asal',
		'kotaasal' => 'Kota asal',
		'provinsiasal' => 'Provinsi asal',
		'kodeposasal' => 'Kode pos asal',
		'alamatstudi' => 'Alamat di Bandung',
		'kodeposstudi' => 'Kode pos di Bandung',
		'hp' => 'Nomor HP',
		'telepondarurat' => 'Telepon darurat',
		'email' => 'Email',
		'emailstudents' => 'Email students.itb.ac.id',
		'line' => 'LINE',
		'twitter' => 'Twitter',
		'facebook' => 'Facebook',
		'golongandarah' => 'Golongan darah',
		'riwayatpenyakit' => 'Riwayat penyakit',
		'bio' => 'Bio/deskripsi diri',
	];

} else {

	$viewColumns = [
		'nim' => 'NIM',
		'namalengkap' => 'Nama lengkap',
		'namapanggilan' => 'Nama panggilan',
		'sma' => 'SMA asal',
		'kotaasal' => 'Kota asal',
		'provinsiasal' => 'Provinsi asal',
		'line' => 'LINE',
		'twitter' => 'Twitter',
		'facebook' => 'Facebook'
	];
}

include(__DIR__.'/../../views/studentdata/index.php');

?>