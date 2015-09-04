<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>User Registration</title>
<link rel="stylesheet" href="../css/register_style.css" />
</head>

<body>

<form id="registration_form" class="registration_form" action="update_pass.php">
	<table class="header"><tbody><tr>
    		<td>Reset Password</td>
    	</tr></tbody></table>
	<table cellpadding="5px" cellspacing="0" border="0"><tbody>
		<tr><td>NIM</td><td>:</td><td><input type="text" class="inputbox" required placeholder="NIM"	name="nim" /></td></tr>
   		<tr><td>Password</td><td>:</td><td><input	name="password" required type="password" class="inputbox" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" autocomplete="off" /></td></tr>


        <tr><td></td><td></td><td><br /><input class="btn" type="submit" value="Submit" /></td></tr>
	</tbody></table>
    
</form>
</body>
</html>