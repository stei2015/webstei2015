<?php

require_once(__DIR__.'/../../include/http.php');
require_once(__DIR__.'/../../include/auth.php');
require_once(__DIR__.'/../../include/time.php');
require_once(__DIR__.'/../../models/thread.php');
require_once(__DIR__.'/../../models/post.php');
require_once(__DIR__.'/../../config.php');
require_once(__DIR__.'/../../include/htmlpurifier/library/HTMLPurifier.auto.php');

ensureLogin();

$thread = filter_var($_GET['thread'], FILTER_SANITIZE_NUMBER_INT);

if(!$thread){
	httpError(404, 'Data thread tidak ditemukan');
}

$data = getPosts([
	'role' 		=> $_SESSION['type'],
	'search'	=> $thread,
	'searchBy'	=> 'thread'
]);

if($data === false){
	httpError(500, 'Gagal mengakses database');
}

$threadData = getThreads([
	'search'	=> $thread,
	'searchBy'	=> 'id',
	'limit'		=> 1
]);

if($threadData === false){
	httpError(404, 'Thread tidak ditemukan');
}

if(count($threadData) == 0){
	httpError(404, 'Data thread tidak ditemukan');
}

$config = HTMLPurifier_Config::createDefault();
$config->set('Cache.SerializerPath', DATA_DIR.'HTMLPurifierCache');
$purifier = new HTMLPurifier($config);

require(__DIR__.'/../../views/forum/posts.php');

?>