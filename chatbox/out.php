<?php
$to = $_GET['to'];

session_start();
$uid_now = $_SESSION['uid'];

require_once "../config.php";
mysqli_query($connection, "UPDATE `db_user` SET `chat_on`= '0' WHERE `uid` = '$uid_now'");

if ($to == "home"){
	header ("location: ../index.php");
} elseif ($to == "database"){
	header ("location: ../database/view.php");
};