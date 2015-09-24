<?php

require_once(__DIR__.'/../models/user.php');

if(!preg_match('/^[a-z_\d]{3,64}$/i', $_GET['username'])){
	echo 'invalid';
} else {

	//cek apakah username ini sudah dipakai

    $count = countUsers([
        'search' => $_GET['username'],
        'searchBy' => 'username',
        'limit' => 1
    ]);

    if($count > 0){
        echo 'taken';
    } else {
    	echo 'available';
    }
}

?>