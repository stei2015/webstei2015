<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login STEI 2015</title>
<link rel="stylesheet" href="css/main.css" />
<link rel="stylesheet" href="css/font-awesome.min.css" />
<link rel="stylesheet" href="css/font-awesome-setting.css" />
</head>

<body>

<?php
$notif=$_GET['notif'];

if ($notif=='user_null'){
	$warning = 'Username Yang Anda Masukan Salah';
} elseif ($notif=='pass_salah') {
	$warning = 'Password Anda Salah';
} elseif ($notif=='nim_salah') {
	$warning = 'NIM Anda Salah';
} elseif ($notif=='null') {
	$warning = 'Silahkan Login Terlebih Dahulu';
}

if (isset ($warning) and $notif!==''){
	print "<div class='btn importan'><i class='icon-warning-sign'></i> &nbsp; $warning</div>";
} else {print "";}
?>

<div class="loginform">
	<center><h3>Login</h3></center>
    <form action="creatingsession/createsession.php" method="post">
    <div class="input-group">
        <span class="input-group-addon"><i class="icon-user"></i></span><input class="form-control" type="text" placeholder="Username" name="username" id="username" autofocus autocomplete="off" required />
    </div>
    <div class="input-group">
        <span class="input-group-addon"><i class="icon-key"></i></span><input class="form-control" type="password" placeholder="Password" name="password" id="password" required />
    </div>
    <div class="input-group">
        <span class="input-group-addon"><i class="icon-credit-card"></i></span><input class="form-control" type="text" placeholder="NIM" name="nim" id="nim" required />
    </div>
    
    <div style="float:right; font-size:12px; padding:0 13px;"><a style="text-decoration:none;" href="register/"><small>Belum Terdaftar?</small></a> &nbsp;<input class="btn btn-blue" value="Masuk" type="submit" /></div>
    </form>
</div>

</body>
</html>