<?php
session_start();
$uid_now 	=$_SESSION['uid'];
$tid		=$_GET['tid'];
include "config.php";

$sql = mysqli_query($connection, "SELECT * FROM `db_like` WHERE `tid` = '$tid' ");
$nlike=mysqli_num_rows($sql);

if (!$nlike > 0) {
mysqli_query($connection, "INSERT INTO `db_like`(`tid`, `uid`) VALUES ('$tid', '$uid_now')");
}

$get=mysqli_query($connection, "SELECT * FROM `db_thread` WHERE `tid` = '$tid'");
while ($result = mysqli_fetch_array($get)){
	$last_nlike=$result['nlike'];
};
$new_nlike += $last_nlike+1;
mysqli_query($connection, "UPDATE `db_thread` SET `nlike` = '$new_nlike' WHERE `tid` = '$tid'");

header ("location: showthread.php?tid=$tid");

?>