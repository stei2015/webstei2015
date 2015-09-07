<?php

require_once(__DIR__.'/../include/database.php');

if(!preg_match('/^[a-z_\d]{3,64}$/i', $_GET['username'])){
	echo 'invalid';
} else {

	//cek apakah username ini sudah dipakai

	$stmt = $dbConnection->prepare("SELECT COUNT(*) as count FROM users WHERE username = ?");
    $stmt->bind_param('s', $_GET['username']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if($count > 0){
        echo 'taken';
    } else {
    	echo 'available';
    }
}

?>