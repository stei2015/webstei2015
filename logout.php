<?php
session_start();
$uid = $_SESSION['uid'];
require_once "config.php";
mysqli_query($connection, "UPDATE `db_user` SET `online`= '0' WHERE `uid` = '$uid'");
mysqli_query($connection, "UPDATE `db_user` SET `chat_on`= '0' WHERE `uid` = '$uid'");

session_destroy();
header('location: login.php');
?>