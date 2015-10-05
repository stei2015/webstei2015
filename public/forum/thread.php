<?php

require_once(__DIR__.'/../../include/http.php');
require_once(__DIR__.'/../../include/auth.php');
require_once(__DIR__.'/../../models/thread.php');
require_once(__DIR__.'/../../models/forum.php');

ensureLogin();

if(isset($_GET['thread'])) $thread = $_GET['thread'];
else if(isset($_POST['thread'])) $thread = $_POST['thread'];
else redirect('forum');

if($thread != 'new'){

	$thread = filter_var($thread, FILTER_SANITIZE_NUMBER_INT);

	$data = getThreads([
		'role' 		=> $_SESSION['type'],
		'search'	=> $thread,
		'searchBy'	=> 'id',
		'limit'		=> 1
	]);

	if(!$data){
		httpError(404, 'Data thread tidak ditemukan');
	}

	if($_SESSION['type'] != 'admin' && $_SESSION['id'] != $data[0]['author']){
		httpError(403, 'Tidak diijinkan mengedit thread milik orang lain');
	}
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	//TODO: add readonly forums so only admins can post to those
	//TODO: add admin badge to all username displays
	//TODO: filter html content

	//TODO: isset($_POST variables) !!!!!!!!!!!!!!!, sticky and readonly not working if not selected
	//content, title etc if not present then show 500 or some other error

	if($thread === 'new'){ //insert

		$insertUpdateResult = insertThreads([
			'values' => [
				'forum' 	=> filter_var($_POST['forum'], FILTER_SANITIZE_NUMBER_INT),
				'title' 	=> $_POST['forum'],
				'author'	=> $_SESSION['id'],
				'lastpost'	=> date('Y-m-d H:i:s'),
				'readonly'	=> $_POST['readonly'],
				'sticky'	=> $_POST['sticky'],
				'content'	=> $_POST['content']
			]
		]);

	} else { //update

		$insertUpdateResult = updateThreads([
			'search' => $thread,
			'searchBy' => 'id',
			'values' => [
				'title' 	=> $_POST['forum'],
				'lastpost'	=> date('Y-m-d H:i:s'),
				'readonly'	=> $_POST['readonly'],
				'sticky'	=> $_POST['sticky'],
				'content'	=> $_POST['content']
			]
		]);
	}

	if($insertUpdateResult === false || $insertUpdateResult < 1){
		httpError(500, 'Gagal menulis data thread ke database');
	}

	//bump forum lastpost
	updateForums([
		'search' => $_POST['forum'],
		'searchBy' => 'id',
		'values' => ['lastpost' => date('Y-m-d H:i:s')]
	]);

	redirect('forum/threads.php?forum='.filter_var($_POST['forum'], FILTER_SANITIZE_NUMBER_INT));

} else {

	if(isset($_GET['forum'])) $forum = $_GET['forum'];
	else $forum = 1;

	require(__DIR__.'/../../views/forum/thread.php');
}

?>