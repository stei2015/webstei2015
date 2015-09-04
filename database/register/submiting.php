<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Processing Data Regristration</title>
</head>

<body>
<?php
require_once "../../config.php";

$nim				= $_POST['nim'];
$noreg			= $_POST['noreg'];
$nama			= $_POST['nama'];
$panggilan		= $_POST['panggilan'];
$tmplahir		= $_POST['tmplahir'];
$timestamp		= strtotime($_POST['tgllahir']);
$tgllahir  = date("Y-m-d", $timestamp);
$sma			= $_POST['sma'];
$alamat1		= $_POST['alamat1'];
$kota1			= $_POST['kota1'];
$prov1			= $_POST['prov1'];
$pos1			= $_POST['pos1'];
$alamat2		= $_POST['alamat2'];
$kota2			= $_POST['kota2'];
$prov2			= $_POST['prov2'];
$pos2			= $_POST['pos2'];
$nohp			= $_POST['nohp'];
$nodarurat		= $_POST['nodarurat'];
$ebebas			= $_POST['ebebas'];
$estudent		= $_POST['estudent'];
$twitter		= $_POST['twitter'];
$facebook		= $_POST['facebook'];
$line			= $_POST['line'];
$darah			= $_POST['darah'];
$penyakit		= $_POST['penyakit'];

$form = "
INSERT INTO `u723809496_forum`.`db_datainduk` (`noreg`, `nim`, `nama`, `panggilan`, `tmplahir`, `tgllahir`, `sma`, `alamat1`, `kota1`, `prov1`, `pos1`, `alamat2`, `kota2`, `prov2`, `pos2`, `nohp`, `nodarurat`, `ebebas`, `estudent`, `twitter`, `facebook`, `line`, `darah`, `penyakit`) 
VALUES ('$noreg', '$nim', '$nama', '$panggilan', '$tmplahir', '$tgllahir', '$sma', '$alamat1', '$kota1', '$prov1', '$pos1', '$alamat2', '$kota2', '$prov2', '$pos2', '$nohp', '$nodarurat', '$ebebas', '$estudent', '$twitter', '$facebook', '$line', '$darah', '$penyakit');";
mysqli_query($connection, $form);

session_start();
$_SESSION['nim']=$nim;
header ("location: ../view.php");
?>
</body>
</html>