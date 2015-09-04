<?php

$agent = $_SERVER['HTTP_USER_AGENT']; 
if(preg_match('/iPhone|Android|Blackberry/i', $agent)){ 
header ("location: //m.stei15.tk/");
} else { 
header ("location: index.php");
}

?>