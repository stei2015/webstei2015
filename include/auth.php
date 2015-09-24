<?php

require_once(__DIR__.'/http.php');
require_once(__DIR__.'/database.php');
require_once(__DIR__.'/../models/user.php');

// checking for minimum PHP version
if(version_compare(PHP_VERSION, '5.3.7', '<')){
    exit("Auth library not compatible with PHP versions under 5.3.7!");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')){
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("password_compatibility_library.php");
}

//modified from php-login-minimal-master

$authMessages = '';
$authErrors = '';

function isLoggedIn(){

	global $authMessages;
	global $authErrors;

	$authMessages = '';
	$authErrors = '';

	if(session_status() === PHP_SESSION_NONE) session_start();
	return isset($_SESSION['id']);
}

function ensureLogin(){
	if(!isLoggedIn()) redirect('login.php');
	return true;
}

function login($username, $password){

	global $dbConnection;
	global $authMessages;
	global $authErrors;

	//cek apakah sudah terlogin
	if(isLoggedIn()){
		$authMessages = 'User sudah terlogin';
		return true;
	}

	if(empty($username) || empty($password)){
		$authErrors = 'Username, NIM atau password kosong';
		return false;
            
    } else {
        
        //get user info 

        $userInfo = getUsers([
            'role' => 'user',
            'columns' => ['id', 'username', 'password', 'type'],
            'search' => $username,
            'searchBy' => 'username',
            'limit' => 1
        ]);

        if(count($userInfo) != 1){
            $userInfo = getUsers([
                'role' => 'user',
                'columns' => ['id', 'username', 'password', 'type'],
                'search' => $username,
                'searchBy' => 'id',
                'limit' => 1
            ]);
        }
        
        if(count($userInfo) == 1){

            //using PHP 5.5's password_verify() function to check if the provided password is correct
            if(password_verify($password, $userInfo[0]['password'])){

                //write user data into PHP session
                $_SESSION['id'] = $userInfo[0]['id'];
                $_SESSION['username'] = $userInfo[0]['username'];
                $_SESSION['type'] = $userInfo[0]['type'];

                //bump lastlogin
                $stmt = $dbConnection->prepare("UPDATE users SET lastlogin = ? WHERE id = ?");
                $stmt->bind_param('si', date('Y-m-d H:i:s'), $userInfo[0]['id']);
                $stmt->execute();
                $stmt->close();
                
                $authMessages = 'Selamat datang, '.$userInfo[0]['username'].'!';
                return true;

            } else {
            	$authErrors = 'Password salah';
            	return false;
            }
        } else {
        	$authErrors = 'Username atau NIM tidak ditemukan';
        	return false;
        }
    }
}

function logout(){
    if(isLoggedIn()){
        $_SESSION = array();
        session_destroy();
        return true;
    }
}

function register($nim, $username, $password, $type='user'){

	global $dbConnection;
	global $authMessages;
	global $authErrors;

	$nim = filter_var($nim, FILTER_SANITIZE_NUMBER_INT);
	
	if(empty($nim)){
        $authErrors = 'NIM tidak boleh kosong';
        return false;
    } elseif(empty($username)){
        $authErrors = 'Username tidak boleh kosong';
        return false;
    } elseif(empty($password)){
        $authErrors = 'Password tidak boleh kosong';
        return false;
    } elseif(strlen($password) < 6){
    	$authErrors = 'Password minimal sepanjang 6 karakter';
    	return false;
    } elseif(!preg_match('/^[a-z_\d]{3,64}$/i', $username)){
        $authErrors = 'Username hanya boleh mengandung angka, huruf dan underscore sepanjang 3-64 karakter';
        return false;
    } else {

        $count1 = countUsers([
            'role' => 'user',
            'search' => $username,
            'searchBy' => 'username',
            'limit' => 1
        ]);

        $count2 = countUsers([
            'role' => 'user',
            'search' => $nim,
            'searchBy' => 'id',
            'limit' => 1
        ]);

        if($count1 != 0 || $count2 != 0){
            $authErrors = 'Username atau NIM sudah ada';
            return false;
        }

        $stmt = $dbConnection->prepare("INSERT INTO users (id, username, password, type) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('isss', $nim, $username, password_hash($password, PASSWORD_DEFAULT), $type);
        $stmt->execute();
        $stmt->close();

        $authMessages = 'Registrasi berhasil';
        return true;
    }
}

?>