<?php

require_once(__DIR__.'/../include/http.php');
require_once(__DIR__.'/../include/auth.php');
require_once(__DIR__.'/../include/database.php');

ensureLogin();

redirect('forum');


?>