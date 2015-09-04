<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<title>User Registration</title>
<link rel="stylesheet" href="../css/register_style.css" />
<script>
function cek(){
    var draf = "<?php echo ":-";
	require_once "../config.php";
	
		$getuser= mysqli_query($connection, "SELECT * FROM `db_user`");
		while ($listuser= mysqli_fetch_array($getuser)){
			global $username;
			$username = $listuser['username'];
			echo "$username:-";
	};
	?>";
	var src = draf.toUpperCase();
    var username = ":-"+document.getElementById("username").value+":-";
    var n = src.indexOf(username.toUpperCase());
    
	if (n == -1){
		document.getElementById("validate").innerHTML = "Username Dapat Digunakan";
		$("p#validate").removeClass("info").removeClass("dipakai").addClass("tersedia");
		document.getElementById("status").value = "siap";
	} else {
		document.getElementById("validate").innerHTML = "Username Telah Digunakan";
		$("p#validate").removeClass("info").removeClass("tersedia").addClass("dipakai");
		document.getElementById("status").value = "salah";
	}
};
</script>
</head>

<body>

<form id="registration_form" class="registration_form" action="submiting.php">
	<table class="header"><tbody><tr>
    		<td>Formulir Pendaftaran Member Forum<br /><small>STEI ITB 2015</small></td>
    	</tr></tbody></table>
	<table cellpadding="5px" cellspacing="0" border="0"><tbody>
		<tr><td>Username<br />&nbsp;</td><td>:<br />&nbsp;</td>
        		<td><input name="username" type="text" class="inputbox" id="username" required placeholder="Username"  onChange="javascript:cek();" /><br />
            		<p id="validate" class="info">Masukan Username</p></td><input type="hidden" id="status" />

	        </tr>
   		<tr><td>Password</td><td>:</td><td><input	name="password" required type="password" class="inputbox" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" autocomplete="off" /></td></tr>
		<tr><td>NIM</td><td>:</td><td><input type="text" class="inputbox" required placeholder="NIM"	name="nim" /></td></tr>

<script>
function submiting() {
	if (document.getElementById("status").value == "siap") {
		document.getElementById("registration_form").submit();
	} else {
		document.getElementById("username").select();
	}
}
</script>

        <tr><td></td><td></td><td><br /><input class="btn" type="button" value="Submit" onClick="submiting()" /></td></tr>
	</tbody></table>
    
</form>
</body>
</html>