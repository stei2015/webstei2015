<?php

require_once(__DIR__.'/../../include/http.php');
require_once(__DIR__.'/../../include/auth.php');

ensureLogin();

require(__DIR__.'/../../views/forum/index.php');

?>