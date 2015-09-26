<?php

require_once(__DIR__.'/../include/http.php');
require_once(__DIR__.'/../include/auth.php');

if(isLoggedIn() || ($_SERVER['REQUEST_METHOD'] == 'POST' && login($_POST['username'], $_POST['password']))){
	
	redirect('index.php'); //login berhasil

} else {

	//tampilkan page login
	//jika login gagal, $authMessages atau $authErrors dapat ditampilkan
	require(__DIR__.'/../views/login.php');
}

?>