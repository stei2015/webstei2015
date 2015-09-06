<?php

require_once(__DIR__.'/../include/http.php');
require_once(__DIR__.'/../include/auth.php');

if(isLoggedIn() || ($_SERVER['REQUEST_METHOD'] == 'POST' && register($_POST['nim'], $_POST['username'], $_POST['password']))){
	
	//registrasi berhasil, login dan redirect
	login($_POST['nim'], $_POST['password']);
	redirect('index.php');

} else {

	//tampilkan page registrasi
	//jika registrasi gagal, $authMessages atau $authErrors dapat ditampilkan
	include(__DIR__.'/../views/register.php');
}

?>