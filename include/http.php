<?php

require_once(__DIR__.'/../config.php');

function redirect($route, $relativeToRootUrl = true){

	$route = filter_var($route, FILTER_SANITIZE_URL);

	if($relativeToRootUrl) $route = ROOT_URL.'/'.$route;

	header('Location: '.$route);

	echo 'Redirecting to <a href="'.$route.'">'.$route.'</a>'; //fallback if redirect fails

	die(); //supaya kode dibawah redirect tidak dijalankan lagi
}

function httpError($status, $description = ''){
	http_response_code($status);
	@include(__DIR__.'/../views/error.php');
	die();
}

?>