<?php

require_once(__DIR__.'/../include/http.php');
require_once(__DIR__.'/../include/auth.php');

$regCodeValid = (!defined('REGCODE') || ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['regcode']) && ($_POST['regcode']==REGCODE)));

if(isLoggedIn() || ($_SERVER['REQUEST_METHOD'] == 'POST' && $regCodeValid && register($_POST['nim'], $_POST['username'], $_POST['password']))){
	
	//registrasi berhasil, login dan redirect
	login($_POST['nim'], $_POST['password']);
	redirect('index.php');

} else {

	if($_SERVER['REQUEST_METHOD'] == 'POST' && !$regCodeValid) $authErrors = 'Kode registrasi tidak valid';

	//tampilkan page registrasi
	//jika registrasi gagal, $authMessages atau $authErrors dapat ditampilkan
	include(__DIR__.'/../views/register.php');
}

?>