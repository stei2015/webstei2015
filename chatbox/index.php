<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>STEI 2015 | Chat Room</title>
<link type="text/css" rel="stylesheet" href="style.css" />
<link type="text/css" rel="stylesheet" href="emoji.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
// jQuery Document
$(document).ready(function(e) {
$("#chatbox").scrollTop($("#chat_content").height());
setInterval(function(){
	loadLog();
},1000);
//Load the file containing the chat log
function loadLog(){
	var before_heigth = $("#chat_content").height();
	var before_pos = $("#chatbox").scrollTop();
	$.ajax({
		url: "log.html",
		cache: false,
		success: function(html){		
			$("#chat_content").html(html); //Insert chat log into the #chat_content div

			var new_heigth=$("#chat_content").height();
			var new_pos=$("#chatbox").scrollTop();
			if (before_heigth < new_heigth) {
				if (before_pos > before_heigth-750) {
				$("#chatbox").scrollTop(new_heigth);
			};};

		},
	});

};

//If user submits the form
$("#submitmsg").click(function(){	
	var clientmsg = $("#usermsg").val();
	$.post("post.php", {text: clientmsg});				
	document.getElementById("usermsg").value="";
	loadLog();

	return false;
	$("#usermsg").focus();
});
});


function insert(txt) {
	el = document.newmsg.usermsg;
	if(!el.value) el.value = txt + ' ';
	else el.value += ((el.value.charAt(el.value.length-1) == ' ') ? '' : ' ') + txt + ' ';
	$("#usermsg").focus();
}
</script>
<link rel="stylesheet" href="../css/main.css" />
<link rel="stylesheet" href="../css/font-awesome.min.css" />
<link rel="stylesheet" href="../css/font-awesome-setting.css" />
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.7/styles/railscasts.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.7/highlight.min.js"></script>
<script src="/path/to/highlight.pack.js"></script>
<script>hljs.initHighlightingOnLoad();</script>

</head>

<body style="background:#6B6B6B;">
<?php include "../creatingsession/cek.php"; require_once "../config.php"; ?>    
    <div class="left-menu"><center>
        <h2>STEI ITB 2015</h2>
        <div class="search-box"><span><i class="icon-search"></i></span><input type="text" placeholder="Find something..." /></div>
        <ul style="padding:0;">
            <li class="menu"><span><i class="icon-home"></i></span><a href="out.php?to=home">Home</a></li>
            <li class="menu active-menu"><span><i class="icon-comments"></i></span>Chat Room</li>
            <li class="menu"><span><i class="icon-list-alt"></i></span><a href="out.php?to=database">Data Induk</a></li>
            <li class="menu"><span><i class="icon-file-alt"></i></span><a href="out.php?to=file">Sharing File</a></li>
            <li class="menu"><span><i class="icon-envelope-alt"></i></span>Contact Us</li>
        </ul>
        <div class="credit">Credit : Mahasiswa STEI ITB 2015 &copy;</div>
    </center></div>
    <div class="main-view" style="height:auto;">
        
        <!-- USER toolbar -->
        <?php
		$uid_now	  = $_SESSION['uid'];
	        $username = $_SESSION['username'];
		$nim	  = $_SESSION['nim'];
		
		mysqli_query($connection, "UPDATE `db_user` SET `chat_on`= '1' WHERE `uid` = '$uid_now'");		        
        ?>

        <div class="user stick" id="stiker">
        	<span class="forum-name" id="forumname">Forum STEI ITB 2015</span>
            <span class="toolbar">
                <a href="#" class="utool"><i class="icon-bell"></i></a>
                <a href="#" class="utool"><i class="icon-envelope"></i></a>
                <a href="#" class="utool"><i class="icon-cog"></i></a>
                <a href="../logout.php" class="utool"><i class="icon-signout"></i></a>
            </span>
            <span class="akundisplay">
                <i class="icon-user"></i>&nbsp; <?php echo "<a href='profile.php?uid=$uid_now'>$username</a>" ?> 
            </span>
        </div>
		<div class="user" id="space"></div>


<div class="jendela">

<div class="leftmenu">
    <div class="whoisonline">
    	<span style="font-size:17px; font-weight:700;">Online User:</span>
        <ul>
<?php 
require_once "../config.php";
$sql = mysqli_query($connection, "SELECT * FROM `db_user` WHERE `online` = '1'");
while ($run = mysqli_fetch_array($sql)) {
	$username_ol= $run['username'];
	$uid_ol		= $run['uid'];
	$acc_type	= $run['acc_type'];
	$chat_on		= $run['chat_on'];

if ($chat_on == 1){	
	print "<li class='chat_on'><a href='../profile.php?uid=$uid_ol' target='_blank'>$username_ol</a></li>";
} else {
	print "<li class='user_ol'><a href='../profile.php?uid=$uid_ol' target='_blank'>$username_ol</a></li>";
};
}
?>
        </ul>
    </div>
    <div class="tool"><center>
    <span style="color:#FFFFFF; font-size:17px; font-weight:700; text-align:center; margin: 0 0 15px 0; display:inline-block;">Chatbox's Tools</span>
<!--    	<div class="text_tool">
        	<b>B</b> <em>I</em> U
        </div> -->
    	<div class="listemoji">
		    <?php include "listemoji.php"; ?>
    	</div>
    </div>
    </center>
</div>
<div id="wrapper">
	<div id="chatbox">
		<div id="chat_content" style="display:table; width:100%;">
		<?php
			session_start();
			
			if(file_exists("log.html") && filesize("log.html") > 0){
			$handle = fopen("log.html", "r");
			$contents = fread($handle, filesize("log.html"));
			fclose($handle);
			 
			echo $contents;
			
			}?>	
        </div>
    </div>
	<form style="text-align:center;" name="newmsg" action="" method="post" target="_self">
        <input name="username" type="hidden" value="<?php echo $_SESSION['username']; ?>" />
		<input name="Text" type="text" id="usermsg" />
		<input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
	</form>
    </div>
</div>
	</div>
</body>
</html>