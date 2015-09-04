<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>STEI ITB 2015</title>

<script>
    // WRITE THE VALIDATION SCRIPT IN THE HEAD TAG.
    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
</script>
</head>

<body>
<style>
body{
	background:#F5F5F5;
}
*{
	font-family:arial;
	font-size:12px;
}
.main {
	width:23%;
	background:#FFFFFF;
	border-left:4px solid #6685E8;
	margin: 70px auto;
	padding:2% 3%;
	text-align:center;
}
.header{
	font-size:20px;
	font-weight:700;
	display:block;
	padding: 0 0 5px 0;
	width:100%;
	height:30px;
	line-height:30px;
	text-align:center;
}
.inputbox{
	outline:none;
	width:100%;
	padding: 3px 0;
	text-align:center;
	border:none;
	border-bottom:2px solid #6685E8;
}
.btn{
	background:#6685E8;
	border:1px solid #3F64D8;
	box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2);
	color:#FFFFFF;
	border-radius:4px;
	display:inline-block;
	width: 65px;
	height:30px;
	line-height:30px;
	margin: 20px 10px 0 10px;
}
.link{
	background:#B8B8B8;
	border:1px solid #A0A0A0;
	text-decoration:none;
	text-align:center;
}
.gagal{
	box-shadow: inset 0 2px 0 rgba(255, 255, 255, 0.2);
	color:#FFFFFF;
	border-radius:4px;
	background:#FD282C;
	border:1px solid #E50E12;
	display:block;
	padding: .5% 1%;
	width:26%;
	text-align:center;
	position:absolute;
	top:20px;
	left:35%;
}
td{
   text-align: center;
}
</style>

<div class="main">
	<span class="header">Login</span>
    <form action="sessioncreate.php" method="post" style="margin-bottom: 0;">
    <table cellpadding="5px" cellspacing="0" width="100%"><tbody>
        <tr>
            <td>No Registrasi/SBMPTN</td><td>:</td><td><input class="inputbox" type="text" name="noreg" onkeypress="javascript:return isNumber (event)" /></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td><td>:</td><td><input class="inputbox" type="text" name="tgllahir" placeholder="YYYY-MM-DD" /></td>
        </tr>
    </tbody></table>
    <a class="btn link" href="../register/">Register</a><input class="btn" type="submit" style="height:33px;"value="Login" />
    </form>
</div>
</body>
</html>