<?php include "tops.php"; ?>
<link rel="stylesheet" href="css/thread.css" />

<?php
$fid = $_GET['fid'];

$infoforum = mysqli_query($connection, "SELECT * FROM `db_forum` WHERE `fid` = '$fid'");
while ($infoFR = mysqli_fetch_array($infoforum)){
	global $parent, $fname;
	$parent	= $infoFR['parent'];
	$fname	= $infoFR['fname'];
};
$infocategory = mysqli_query($connection, "SELECT * FROM `db_forum` WHERE  `disporder` = '$parent' AND `type` LIKE 'c'");
while ($infoCT = mysqli_fetch_array($infocategory)){
	global $cname;
	$cname	= $infoCT['fname'];
};

echo "
<ul class='navigation'>
	<li><a href='index.php'><i class='icon-home'></i> Home</a></li>
	<li><a href='index.php'>$cname</a></li>
	<li><a href='thread.php?fid=$fid'>$fname</a></li>
    
</ul>";
echo "
<div class='window'>
    <table class='window-inner thread-window' cellpadding='10px' cellspacing='0' border='0' align='center'><tbody>
        <th colspan='3' class='window-head'>General Infotmation</th>
		<th class='window-head new'><a href='newthread.php?fid=$fid'><i class='icon-plus-sign-alt'></i></a></th>
";
	
$thread = "SELECT *  FROM `db_thread` WHERE `fid` = $fid";
$getthread = mysqli_query($connection, $thread);

while ($listthread = mysqli_fetch_array($getthread)){
	$tid	= $listthread['tid'];
	$judul	= $listthread['judul'];
	$uid	= $listthread['uid'];
	$username= $listthread['username'];
	$date	= $listthread['date'];
	$time	= $listthread['time'];
	$nlike	= $listthread['nlike'];
	$ncomment= $listthread['ncomment'];
	
	print "
	<tr>
		<td width='7%'><a href='profile.php?uid=$uid'><div style='width:50px; height:50px; display:block; background: url(img/avatar/$uid.jpg); background-size: cover;' class='avatar'></div></a></td>
		<td width='70%'>
			<div class='judul'><a href='showthread.php?tid=$tid'>$judul</a></div>
			<div class='desc'>
				<i class='icon-user'></i> <a href='profile.php?uid=$uid'>$username</a> &nbsp;&nbsp; 
				<i class='icon-calendar-empty'></i> $date &nbsp;&nbsp; 
				<i class='icon-time'></i> $time
			</div>
		</td>
		<td width='10%' class='nlike'><i class='icon-thumbs-up'></i> $nlike</td>
		<td width='10%' class='ncomment'><i class='icon-comments-alt'></i> $ncomment</td>
	</tr>
	";
};
echo "
	</tbody></table>
</section>";
include "end.php";
?>