<?php
require_once "../config.php";

$username=$_POST['username'];
$password=$_POST['password'];
$nim=$_POST['nim'];

$sql = "SELECT `password`, `uid` FROM `db_user` WHERE `username` = '$username'";
$cek = mysqli_query($connection, $sql);
$rowcount=mysqli_num_rows($cek);

if (! $rowcount > 0) { header ("location: ../login.php?notif=user_null");} else {
	$sql2 = "SELECT `nim` FROM `db_user` WHERE `username` = '$username' and `nim` = '$nim'";
	$cek2 = mysqli_query($connection, $sql2);
	$rowcount2=mysqli_num_rows($cek2);
	if (! $rowcount2 > 0) { header ("location: ../login.php?notif=nim_salah");} else {

while ($hasil = mysqli_fetch_array($cek)){
	$realpass= $hasil['password'];
	$uid	 = $hasil['uid'];

	if ($password == $realpass){
		session_start();
		$_SESSION['username']=$username;
		$_SESSION['uid']	 =$uid;
		$_SESSION['nim']	 =$nim;
		
		mysqli_query($connection, "UPDATE `db_user` SET `online`= '1' WHERE `uid` = '$uid'");
		header("location:../index.php");
	} else {
		header('location:../login.php?notif=pass_salah');
	}

}}
}
?>
</body>
</html>