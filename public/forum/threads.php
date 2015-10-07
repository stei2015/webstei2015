<?php

require_once(__DIR__.'/../../include/http.php');
require_once(__DIR__.'/../../include/auth.php');
require_once(__DIR__.'/../../include/time.php');
require_once(__DIR__.'/../../models/thread.php');
require_once(__DIR__.'/../../models/forum.php');


ensureLogin();

$forum = filter_var($_GET['forum'], FILTER_SANITIZE_NUMBER_INT);

if(!$forum){
  httpError(404, 'Data forum tidak ditemukan');
}

$data = getThreads([
  'role'    => $_SESSION['type'],
  'search'  => $forum,
  'searchBy'  => 'forum'
]);

if($data === false){
  httpError(500, 'Gagal mengakses database');
}

$forumData = getForums([
  'search'  => $forum,
  'searchBy'  => 'id',
  'limit'   => 1
]);

if($forumData === false){
  httpError(404, 'Forum tidak ditemukan');
}

require(__DIR__.'/../../views/forum/threads.php');

?>