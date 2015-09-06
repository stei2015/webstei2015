<?php

require_once(__DIR__.'/../include/auth.php');
require_once(__DIR__.'/../include/http.php');

logout();
redirect('index.php');

?>