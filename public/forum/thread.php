<?php

require_once(__DIR__.'/../../include/http.php');
require_once(__DIR__.'/../../include/auth.php');
require_once(__DIR__.'/../../models/thread.php');
require_once(__DIR__.'/../../models/forum.php');

ensureLogin();

if(isset($_GET['thread'])) $thread = $_GET['thread'];
else if(isset($_POST['thread'])) $thread = $_POST['thread'];
else redirect('forum');

$changeStickyReadonly = $_SESSION['type'] == 'admin' ? true : false;


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
	//TODO: filter html content

	$sticky = isset($_POST['sticky']);
	$readonly = isset($_POST['readonly']);

	if($thread === 'new'){ //insert

		$forum = filter_var($_POST['forum'], FILTER_SANITIZE_NUMBER_INT);

		if(!isset($_POST['title']) || !isset($_POST['content']) || !isset($_POST['forum'])){
			httpError(500, 'Judul, forum atau isi thread belum diisi');
		}

		$values = [
			'forum' 	=> $forum,
			'title' 	=> $_POST['title'],
			'author'	=> $_SESSION['id'],
			'lastpost'	=> date('Y-m-d H:i:s'),
			'content'	=> $_POST['content']
		];

		if($changeStickyReadonly){
			$values['sticky'] = $sticky;
			$values['readonly'] = $readonly;
		}

		$insertUpdateResult = insertThreads([
			'values' => $values
		]);

	} else { //update

		$forum = filter_var($data[0]['forum'], FILTER_SANITIZE_NUMBER_INT);

		if(!isset($_POST['title']) || !isset($_POST['content'])){
			httpError(500, 'Judul atau isi thread belum diisi');
		}

		$values = [
			'title' 	=> $_POST['title'],
			'lastpost'	=> date('Y-m-d H:i:s'),
			'content'	=> $_POST['content']
		];

		if($changeStickyReadonly){
			$values['sticky'] = $sticky;
			$values['readonly'] = $readonly;
		}

		$insertUpdateResult = updateThreads([
			'search' => $thread,
			'searchBy' => 'id',
			'values' => $values
		]);
	}

	if($insertUpdateResult === false || $insertUpdateResult < 1){
		httpError(500, 'Gagal menulis data thread ke database');
	}

	redirect('forum/threads.php?forum='.$forum);

} else {

	if(isset($_GET['forum'])) $forum = $_GET['forum'];
	else if($thread == 'new') httpError(500, 'Parameter forum tidak ditemukan');

	require(__DIR__.'/../../views/forum/thread.php');
}

?>