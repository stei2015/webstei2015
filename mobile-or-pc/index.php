<?php

$agent = $_SERVER['HTTP_USER_AGENT']; 
if(preg_match('/iPhone|Android|Blackberry/i', $agent)){ 
header ("location: ../mobile/");
} else { 
echo "main.css"; 
}

?>
