<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="../css/main.css" />
<link rel="stylesheet" href="../css/font-awesome.min.css" />
<link rel="stylesheet" href="../css/font-awesome-setting.css" />
<title>Download Page</title>
</head>

<body>
<div class="window" style="margin:50px auto; width:50%;">
	<div class="window-head" style="padding:10px; font-weight:700; font-size:17px; text-align:center;">Download File Page</div>
	<div class="window-inner">
<?php
$code = $_GET['code'];

include "../config.php";

$sql = mysqli_query($connection, "SELECT *  FROM `db_file` WHERE `filecode` LIKE '$code'");
$rowcount=mysqli_num_rows($sql);
if ($rowcount < 1) {
	echo "<h4 style='text-align:center; padding:40px 20px; margin:0;'>File tidak di temukan atau telah dihapus.</h4>";
} else {
while ($run = mysqli_fetch_array($sql)) {
	$filename		= $run['filename'];
	$upload_uid		= $run['upload_uid'];
	$upload_username= $run['upload_username'];
	$upload_date	= $run['upload_date'];
	$dl_counter		= $run['dl_counter'];
}
if (strlen($filename) > 27){
	$filename_new = substr($filename, 0, 13).". ... .".substr($filename, -5, 5);
} else {
	$filename_new = $filename;
}
echo "<br /> <br /> <center>
<table cellpadding='7px' cellspacing='0' border='0'><tbody>
<tr>
	<td><i class='icon-3x icon-file-alt'></i></td>
	<td width='250px' style='font-size:20px;'><b>$filename_new</b><br />
	<span style='font-size:12px; color:#ccc;'><i class='icon-user'></i> <a style='text-decoration:none; color:#ccc;' href='../profile.php?uid=$upload_uid' target='_blank'>$upload_username</a> &nbsp; 
		<i class='icon-calendar-empty'></i> $upload_date</span>
	<td>
	<td rowspan='2'><span style='padding:19px 13px 10px 13px; font-size:49px; line-height:15px;' class='btn-allsize btn-green'>$dl_counter<br /><span style='font-size:14px;'>times</span></span></td>
</tr>
<tr><td align='center' colspan='2'><a href='download/$filename' style='padding:5px; font-size:14px;' class='btn-allsize btn-blue'>Download</a></td></tr></tbody></table><br /> <br /></center>";
}
?>
</div></div>
</body>
</html>