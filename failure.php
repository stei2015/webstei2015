<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
$notif=$_GET['notif'];
if (!isset ($notif)) {$notif='';};

if ($notif=='user-null'){
	$warning = 'Username Yang Anda Masukan Salah';
} elseif ($notif=='pass-salah') {
	$warning = 'Password Anda Salah';
} elseif ($notif=='nim-salah') {
	$warning = 'NIM Anda Salah';
} elseif ($notif=='') {
	$warning = 'Silahkan Login Terlebih Dahulu';
}
?>

<table cellpadding="0" cellspacing="0" border="0"><tbody class="btn importan"><tr>
	<td width="15%"><i class="icon-warning-sign"></i></td><td width="84%" style="text-align:center;"><?php echo $warning; ?></td>
</tr></tbody></table>

<?php include "login.php"; ?>

</body>
</html>