<?php
require_once "../../config.php";

$noreg=$_POST['noreg'];
$timestamp = strtotime($_POST['tgllahir']);
$tgllahir=date("Y-m-d",$timestamp);

$runsql = mysqli_query($connection, "SELECT `noreg`, `tgllahir` FROM `db_datainduk` WHERE `noreg` = '$noreg'");
$rowcount=mysqli_num_rows($runsql);

if ($rowcount > 0 ) {
while ($result = mysqli_fetch_array($runsql)) {
	$tgl	= $result['tgllahir'];
	$noreg	= $result['noreg'];

	if ($tgllahir == $tgl){
		session_start();
		$_SESSION['noreg']=$noreg;
		header("location:../view.php");
		echo "succses";
	} else {
		header("location: failure.php");
		echo "gagal";
	}
}
} else {header("location: failure.php");echo "gagal";}
?>