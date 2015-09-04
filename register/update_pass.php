<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Processing Data Regristration</title>
</head>

<body>
<?php
require_once "../config.php";
session_start();
$nim				= $_GET['nim'];
$password = $_GET['password'];

$form = "
UPDATE `db_user` SET `password`= '$password' WHERE `nim` = '$nim' ";
mysqli_query($connection, $form);

header ("location: ../database/getfullview.php");
?>
</body>
</html>