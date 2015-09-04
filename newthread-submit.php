<?php
$fid		=$_POST['fid'];
$uid		=$_POST['uid'];
$username	=$_POST['username'];
$judul		=$_POST['judul'];
$content	=$_POST['content'];

$timestamp		= strtotime(date("Y-m-d", time()-2*60+7*60*60));
$date  = date("Y-m-d", $timestamp);
$time = date("G:i", time()-2*60+7*60*60);


include "config.php";
$sql= "
INSERT INTO `db_thread` (`tid`, `fid`, `uid`, `username`, `judul`, `content`, `date`, `time`) 
VALUES (NULL, '$fid', '$uid', '$username', '$judul', '$content', '$date', '$time')";

mysqli_query($connection, $sql);

$get=mysqli_query($connection, "SELECT * FROM `db_forum` WHERE `db_forum`.`fid` = $fid");
while ($result = mysqli_fetch_array($get)){
	$last_nthread=$result['thread']; global $last_nthread;
};
$new_nthread= $last_nthread+1;
mysqli_query($connection, "UPDATE `db_forum` SET `thread` = '$new_nthread' WHERE `db_forum`.`fid` = $fid");
 
header ("location: thread.php?fid=$fid");

?>