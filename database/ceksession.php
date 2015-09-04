<?php
session_start();
if (!isset($_SESSION['nim'])) 
{
	header('location: ../login.php');
}

?>