<html>
<head>
<title>Upload Your Photo Profile</title>
<link rel="stylesheet" href="../css/main.css" />
</head>

<body>
<?php
session_start();
$uid_now	  = $_SESSION['uid'];
?>
<div style="display:block; width:100%; height:100px;">&nbsp;</div>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#47C1FC">
	<tr>
		<td align="center"><strong><span style="color:#fff; display:block; margin: 10px 0;">Review Your Photo Profile</span></strong>
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
			<tr>
				<td align="center" height="60px">
				Foto Anda akan ditampilkan Seperti berikut:<br /><div style='width:100px; height:100px; display:block; background: url(avatar/<?php echo "$uid_now"; ?>.jpg); background-size: cover;' class='avatar'> &nbsp; </div></center>
			</tr>
			<tr><td align="center"><span style="color: #FF3033; font-size:12px; font-weight:700;">Apakah Anda sudah setuju dan Ingin melanjutkan?</span></td></tr>
			<tr>
				<td align="center">
					<a href="upload_rename.php" class="btn-allsize btn-red" style="padding: 5px; font-size:13px;">Ganti Foto Baru</a>
					<a href=" ../database/register/" class="btn-allsize btn-blue" style="padding: 5px; font-size:13px;">Setuju</a>
				</td>
			</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>