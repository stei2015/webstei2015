<?php

require_once(__DIR__.'/../config.php');

$filePath = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
$filePath = preg_replace('/[^(0-9_\(\)\[\]\-.,)]/','',$filePath);
$filePath = DATA_DIR.'profilepictures/'.$filePath;

if(!file_exists($filePath)){
	$filePath = __DIR__.'/img/defaultprofilepicture';
}

$fp = fopen($filePath, 'rb');
header('Content-Type: ' . exif_imagetype($filePath));
header('Content-Length: ' . filesize($filePath));
fpassthru($fp);

?>