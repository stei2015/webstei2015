<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script>document.documentElement.className += ' spoiler-js';</script>
<script type="text/javascript" src="js/spoiler.js"></script>
<link rel="stylesheet" href="css/spoiler.css" />

<link rel='stylesheet' href='css/showthread.css'>
<?php 
include "tops.php";
$tid= $_GET['tid'];

$infothread = mysqli_query($connection, "SELECT * FROM `db_thread` WHERE `tid` = '$tid'");
while ($infoTH = mysqli_fetch_array($infothread)){
	global $fid, $judul;
	$fid	= $infoTH['fid'];
	$nama	= $infoTH['judul'];
};
$infoforum = mysqli_query($connection, "SELECT * FROM `db_forum` WHERE `fid` = '$fid'");
while ($infoFR = mysqli_fetch_array($infoforum)){
	global $parent, $fname;
	$parent	= $infoFR['parent'];
	$fname	= $infoFR['fname'];
};
$infocategory = mysqli_query($connection, "SELECT * FROM `db_forum` WHERE `fid` = '$parent'");
while ($infoCT = mysqli_fetch_array($infocategory)){
	global $cname;
	$cname	= $infoCT['fname'];
};

echo "
<ul class='navigation'>
	<li><a href='index.php'><i class='icon-home'></i> Home</a></li>
	<li><a href='index.php'>$cname</a></li>
	<li><a href='thread.php?fid=$fid'>$fname</a></li>
	<li><a href='showthread.php?tid=$tid'>$nama</a></li>
    
</ul>";

$chars = 	array(
				"[b]", "[/b]", "[i]", "[/i]", "[u]", "[/u]",
				"[R]", "[/R]",
				"[e]", "[/e]",
				"[J]", "[/J]",
				"[L]", "[/L]",
				" -> ", "[/a]", "[a]", 
				"[img]", "[/img]",
				"[code]", "[/code]",
				"[file]", " numb: ", " name: ", "[/file]" );
			
$code = 	array(
				"<b>", "</b>", "<i>", "</i>", "<u>", "</u>",
				"<span class='text-right'>", "</span>",
				"<center>", "</center>",
				"<span class='text-justify'>", "</span>",
				"", "",
				"' target='_blank' class='text-link'>", "</a>", "<a href='",
"<div class='spoiler spoiler-primary spoiler-state-collapsed' data-toggle-text='Picture' data-toggle-placement='picture'>
  <div class='spoiler-content'><img class='text-img' src='", "' /></div></div>",
				"<div class='spoiler spoiler-primary spoiler-state-collapsed' data-toggle-text='Code' data-toggle-placement='code'>
  <div class='spoiler-content'><pre><code>", "</code></pre></div></div>",
				"<span class='text-file'><li><a class='text-file-link' href='file/download.php?code=", "' target='_blank'><i class='icon-file-alt'></i> File ", ": ", "</a></li></span>" );

/*?> how to use copas this -->  str_replace($chars,$code,$txt)  <?php */

$sql	= mysqli_query($connection, "SELECT * FROM `db_like` WHERE `tid` = '$tid' ");
$nlike	= mysqli_num_rows($sql);

$is_like	= mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `db_like` WHERE `tid` = '$tid' AND `uid` = '$uid_now' "));

$thread = "SELECT * FROM `db_thread` WHERE `tid` = '$tid'";
$getthread = mysqli_query($connection, $thread);

while ($listthread = mysqli_fetch_array($getthread)){
	$judul	= $listthread['judul']; 	
	$uid	= $listthread['uid'];
	$username= $listthread['username'];
	$date	= $listthread['date'];
	$time	= $listthread['time'];
	$content= $listthread['content'];
	$ncomment= $listthread['ncomment'];
	$allowed= $listthread['allowed'];
}

echo "
<div class='window'>
	<div class='window-inner thread-window' style='background:none;'>
		<table width='100%' cellpadding='0' cellspacing='0' style='background:#fff;'><tbody><tr>
			<th width='10%' class='window-top'>
				<center><a href='profile.php?uid=$uid' target='_self'><div style='width:60px; height:60px; display:block; background: url(img/avatar/$uid.jpg); background-size: cover;' class='avatar'></div></a></center>
			</th>
			<td class='window-top'>
				<span class='username'><i class='icon-user'></i> <b>$username</b></span> &nbsp;&nbsp;
				<span class='time'><i class='icon-calendar-empty'></i> $date &nbsp;&nbsp; <i class='icon-time'></i> $time </span> <br />
				<span class='judul'>$judul</span>
			</td>
		</tr>
		<tr><td colspan='2'>
			<div style='padding:25px 5%; width:90%;'>". nl2br(str_replace($chars,$code,$content)) ."</div>
		</td></tr>
		<tr>
			<td colspan='2'>";
				if ($is_like > 0){
					echo "<a style='margin-left:2%; color:#4C95D9 ; cursor:pointer;' class='btn'><i class='icon-thumbs-up'></i>";
				} else {
					echo "<a href='like.php?tid=$tid' style='margin-left:2%;' target='_self' class='btn'><i class='icon-thumbs-up'></i>";
				};
			
				echo "	$nlike
				</a> 
				<span class='btn'><i class='icon-comments-alt'></i> $ncomment</span>";

	if ($allowed !== "1" ){
	print"
				<a style='float:right; margin:0 20px 5px 0; line-height:30px;' class='btn-allsize btn-red'>&nbsp;&nbsp;Thread Closed&nbsp;&nbsp;</a>";
	} else {
	print "
				<a href='reply.php?tid=$tid' style='float:right; margin:0 20px 5px 0; line-height:30px;' class='btn btn-blue'>Reply</a>";
	}

print
		   "</td>
		</tr>";

$getpost = mysqli_query($connection, "SELECT * FROM `db_post` WHERE `tid` = '$tid'");
while ($listpost= mysqli_fetch_array($getpost)){
	$pid	=$listpost['pid'];
	$uidp	=$listpost['uid'];
	$usernamep=$listpost['username'];
	$datepost=$listpost['datepost'];
	$post	=$listpost['post'];
	
echo "
	<tr><td width='100%' colspan='2' height='15px' style='background:#F3F3F3;'>&nbsp;</td></tr>
	<tr style='background:#F3F3F3;'>
		<td width='10%' valign='top' style='margin:25px 1px 25px 0;'>
			<br /><center>
				<div style='width:50px; height:50px; display:block; background: url(img/avatar/$uid.jpg); background-size: cover;' class='avatar'></div>
			$usernamep</center>
		</td>
		<td width:'80%'>
			<div style='margin:10px; padding:15px 15px 20px 15px; background:#FFFFFF; border-radius:5px;'>".
			nl2br(str_replace($chars,$code,$post))."<br /><span class='time' style=' float:right;'><i>$datepost</i></span>
			</div>
		</td>
	</tr>
";
};

echo "		
		</tbody></table>
	</div>
</div>";

include "end.php"; ?>