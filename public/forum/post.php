<?php

require_once(__DIR__.'/../../include/http.php');
require_once(__DIR__.'/../../include/auth.php');
require_once(__DIR__.'/../../models/post.php');
require_once(__DIR__.'/../../models/post.php');

ensureLogin();

if(isset($_GET['post'])) $post = $_GET['post'];
else if(isset($_POST['post'])) $post = $_POST['post'];
else redirect('forum');

if($post != 'new'){

	$post = filter_var($post, FILTER_SANITIZE_NUMBER_INT);

	$data = getPosts([
		'role' 		=> $_SESSION['type'],
		'search'	=> $post,
		'searchBy'	=> 'id',
		'limit'		=> 1
	]);

	if(!$data){
		httpError(404, 'Data post tidak ditemukan');
	}

	if($_SESSION['type'] != 'admin' && $_SESSION['id'] != $data[0]['author']){
		httpError(403, 'Tidak diijinkan mengedit post milik orang lain');
	}

	//TODO: enforce readonly
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(!isset($_POST['content'])){
		httpError(500, 'Isi post belum diisi');
	}

	if($post === 'new'){ //insert

		$thread = filter_var($_POST['thread'], FILTER_SANITIZE_NUMBER_INT);

		$insertUpdateResult = insertPosts([
			'values' => [
				'thread' 	=> $thread,
				'author'	=> $_SESSION['id'],
				'posttime'	=> date('Y-m-d H:i:s'),
				'content'	=> $_POST['content']
			]
		]);

	} else { //update

		$thread = filter_var($data[0]['thread'], FILTER_SANITIZE_NUMBER_INT);

		$insertUpdateResult = updatePosts([
			'search' => $post,
			'searchBy' => 'id',
			'values' => [
				'posttime'	=> date('Y-m-d H:i:s'),
				'content'	=> $_POST['content']
			]
		]);
	}

	if($insertUpdateResult === false || $insertUpdateResult < 1){
		httpError(500, 'Gagal menulis data post ke database');
	}

	redirect('forum/posts.php?thread='.$thread);

} else {

	if(isset($_GET['thread'])) $thread = $_GET['thread'];
	else if($post == 'new') httpError(500, 'Parameter thread tidak ditemukan');

	require(__DIR__.'/../../views/forum/post.php');
}

?>