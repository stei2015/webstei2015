<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Processing Data Regristration</title>
</head>

<body>
<?php
require_once "../config.php";

$username		= $_GET['username'];
$password		= $_GET['password'];
$nim			= $_GET['nim'];

$form = "
INSERT INTO `u723809496_forum`.`db_user` (`uid`, `username`, `password`, `acc_type`, `nim`) 
VALUES (NULL, '$username', '$password', '3', '$nim')";
mysqli_query($connection, $form);

$sql= "SELECT * FROM `db_user` WHERE `username`='$username' AND `nim`= '$nim' ";
$get= mysqli_query($connection, $sql);
while ($result = mysqli_fetch_array($get)) { $uid = $result['uid']; };

session_start();
$_SESSION['uid']=$uid;
$_SESSION['nim']=$nim;
header ("location: ../img/upload_rename.php");
?>
</body>
</html>