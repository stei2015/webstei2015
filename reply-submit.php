<?php
$tid		=$_POST['tid'];
$uid		=$_POST['uid'];
$username	=$_POST['username'];
$content	=$_POST['content'];

$date = date("d M Y", time()-2*60+60*60*7);
$time = date("G.i", time()-2*60+60*60*7);
$datepost = $date." (".$time.")";

include "config.php";

$sql= "
INSERT INTO `db_post` (`pid`, `tid`, `uid`, `username`, `post`, `datepost`) 
VALUES (NULL, '$tid', '$uid', '$username', '$content', '$datepost')";

mysqli_query($connection, $sql);

$get=mysqli_query($connection, "SELECT * FROM `db_thread` WHERE `tid` = '$tid'");
while ($result = mysqli_fetch_array($get)){
	$last_npost=$result['ncomment']; global $last_npost;
};
$new_npost = ++$last_npost;
$sql2= "UPDATE `db_thread` SET `ncomment` = '$new_npost', `lastposter` = '$username', `lastposter_date` = '$datepost' WHERE `tid` = '$tid'";
mysqli_query($connection, $sql2);

header ("location: showthread.php?tid=$tid");

?>