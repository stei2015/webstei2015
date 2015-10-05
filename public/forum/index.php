<?php

require_once(__DIR__.'/../../include/http.php');
require_once(__DIR__.'/../../include/auth.php');
require_once(__DIR__.'/../../models/forum.php');

ensureLogin();

$data = getForums([]);

if($data === false){
	httpError(500, 'Gagal mengakses database');
}

require(__DIR__.'/../../views/forum/index.php');

?>