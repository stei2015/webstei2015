<?php
session_start();
if(isset($_SESSION['username'])){
	$pesan = $_POST['text'];
	$chars = 	array(
					":angry:", ":((", "x_x", "-_-", ":O", 
					":hah:", ":bzzz:", ":love:", ":huh:", ";P", ";p",
					":P", ":p", ":))", ":kiss:", ":*",
					":x", "o.o", "O.O", ":D", ":hehe:",
					":haha:", "^_^", ":ahik:", ":)", ":smallsmile:",
					":laugh:", ":sad:", "T_T", ":shock:",
					">..<", ":veryangry:", ":yahh:", ":uhh:", ":.pessimist:",
					":scream:", ":sleapy:", ":smirking:", ":jiah:", ":disappointed:",
					"l_l", ";)" );
				
	$icons = 	array(
					"<span class='emoji emoji1f620'></span>", "<span class='emoji emoji1f629'></span>", "<span class='emoji emoji1f632'></span>", "<span class='emoji emoji1f61e'></span>", "<span class='emoji emoji1f635'></span>",
					"<span class='emoji emoji1f630'></span>", "<span class='emoji emoji1f612'></span>", "<span class='emoji emoji1f60d'></span>", "<span class='emoji emoji1f624'></span>", "<span class='emoji emoji1f61c'></span>","<span class='emoji emoji1f61c'></span>",
					"<span class='emoji emoji1f61d'></span>","<span class='emoji emoji1f61d'></span>", "<span class='emoji emoji1f60b'></span>", "<span class='emoji emoji1f618'></span>", "<span class='emoji emoji1f61a'></span>", 
					"<span class='emoji emoji1f637'></span>", "<span class='emoji emoji1f633'></span>","<span class='emoji emoji1f633'></span>", "<span class='emoji emoji1f603'></span>", "<span class='emoji emoji1f605'></span>", 
					"<span class='emoji emoji1f606'></span>", "<span class='emoji emoji1f601'></span>", "<span class='emoji emoji1f602'></span>", "<span class='emoji emoji1f60a'></span>", "<span class='emoji emoji263a'></span>", 
					"<span class='emoji emoji1f604'></span>", "<span class='emoji emoji1f622'></span>", "<span class='emoji emoji1f62d'></span>", "<span class='emoji emoji1f628'></span>", 
					"<span class='emoji emoji1f623'></span>", "<span class='emoji emoji1f621'></span>", "<span class='emoji emoji1f60c'></span>", "<span class='emoji emoji1f616'></span>", "<span class='emoji emoji1f614'></span>",
					"<span class='emoji emoji1f631'></span>", "<span class='emoji emoji1f62a'></span>", "<span class='emoji emoji1f60f'></span>", "<span class='emoji emoji1f613'></span>", "<span class='emoji emoji1f625'></span>", 
					"<span class='emoji emoji1f62b'></span>", "<span class='emoji emoji1f609'></span>"			
				);
	$pesan_baru = str_replace($chars,$icons,$pesan);
	echo $pesan_baru;

     
    $fp = fopen("log.html", 'a');
	if (substr($pesan_baru, 0, 4) == "np: ") {
	fwrite($fp, "<div class='msglnIf'><em><span class='notice'>".substr($pesan_baru,4,strlen($pesan_baru))."</span></em></div>");
	//buat beda antara Admin dng guest.
	} else if ($_SESSION['username']!=="Admin") {
    fwrite($fp, "<div class='msgln'><b>".$_SESSION['username']."</b>: <i>(".date("g:i A", time()-2*60+60*60*7).")</i><br /><p>".$pesan_baru."</p></div>");
	} else if ($_SESSION['username']=="Admin") {
	fwrite($fp, "<div class='msglnku'><b>Admin</b>: <i>(".date("g:i A", time()-2*60+60*60*7).")</i><br /><p>".$pesan_baru."</p></div>");
	}
	fclose($fp);
}
?>