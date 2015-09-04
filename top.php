<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>STEI 2015</title>
<link rel="stylesheet" href="css/main.css" />
<link rel="stylesheet" href="css/font-awesome.min.css" />
<link rel="stylesheet" href="css/font-awesome-setting.css" />
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/blur-on-scroll.js"></script>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.7/styles/railscasts.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.7/highlight.min.js"></script>
<script src="/path/to/highlight.pack.js"></script>
<script>hljs.initHighlightingOnLoad();</script>

</head>

<body>
<?php include "creatingsession/cek.php"; require_once "config.php"; ?>    
    <div class="left-menu"><center>
        <h2>STEI ITB 2015</h2>
        <div class="search-box"><span><i class="icon-search"></i></span><input type="text" placeholder="Find something..." /></div>
        <ul style="padding:0;">
        	<li class="menu active-menu"><span><i class="icon-home"></i></span>Home</li>
            <li class="menu"><span><i class="icon-comments"></i></span><a href="chatbox/">Chat Room</a></li>
            <li class="menu"><span><i class="icon-list-alt"></i></span><a href="database/view.php">Data Induk</a></li>
            <li class="menu"><span><i class="icon-file-alt"></i></span><a href="file/">Sharing File</a></li>
            <li class="menu"><span><i class="icon-envelope-alt"></i></span>Contact Us</li>
        </ul>
        <div class="credit">Credit : Mahasiswa STEI ITB 2015 &copy;</div>
    </center></div>
    <div class="main-view">
       	<div class="header">
        	<img style="z-index:1; position:relative; left:0; top: -150px; filter: url(#blur);" width="100%" src="img/logo.jpg" class="scrollblur" /></div>
        
        <!-- USER toolbar -->
        <?php
		$uid_now	  = $_SESSION['uid'];
        $username = $_SESSION['username'];
		$nim	  = $_SESSION['nim'];
		
        ?>
        <script type="text/javascript">
		$(document).ready(function() {
			var s = $("#stiker");
			var sp = $("#space");
			var pos = s.position();
			sp.hide(0);$(".forum-name").hide(0);					   
			$(window).scroll(function() {
				var windowpos = $(window).scrollTop();
				if (windowpos >= pos.top) {
					s.addClass("stick");
					sp.show(0);
					$(".forum-name").fadeIn(500);
				} else {
					s.removeClass("stick");	
					sp.hide(0);
					$(".forum-name").fadeOut(500);
				}
			});
		});
		</script>

        <div class="user" id="stiker">
        	<span class="forum-name" id="forumname">Forum STEI ITB 2015</span>
            <span class="toolbar">
                <a href="#" class="utool"><i class="icon-bell"></i></a>
                <a href="#" class="utool"><i class="icon-envelope"></i></a>
                <a href="#" class="utool"><i class="icon-cog"></i></a>
                <a href="logout.php" class="utool"><i class="icon-signout"></i></a>
            </span>
            <span class="akundisplay">
                <i class="icon-user"></i>&nbsp; <?php echo "<a href='profile.php?uid=$uid_now'>$username</a>" ?> 
            </span>
        </div>
		<div class="user" id="space"></div>

        <div class="contener" >