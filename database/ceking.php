<?php
$pass= $_POST['password'];

if ( $pass == 'StEi 20!%') {
	header ("location: fullview.php");
} else {
	header ("location: failure.php");
}
?>