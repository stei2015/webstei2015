<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Get Full View Data Base</title>
<link rel="stylesheet" href="../css/font-awesome.min.css" />
<link rel="stylesheet" href="../css/font-awesome-setting.css" />
</head>

<body>
<style>
body{
	margin-top:100px;
	font-family:arial;
	font-size:13px;
	background:#F3F3F3;
}
input {
	text-align:center;
	margin: 5px;
}
.main{
	width:20%;
	margin:50px auto;
	padding: 20px 0 10px 0;
	background:#FFFFFF;
	border-left:3px solid #6685E8;
}
.pass{
	width:70%;
	outline:none;
	border:none;
	border-bottom:1px solid #6685E8;
}
.btn{
	display:block;
	border-radius: 3px;
	height:35px;
	width:70px;
	background:#6685E8;
	border:2px solid #6685E8;
	transition:all .5s;
	color:#FFFFFF;
	font-weight:700;
	outline:none;
}
.btn:hover{
	background:#FFFFFF;
	color:#6685E8;
	transition:all .5s;
}
</style>
<div class="main">
<center>
<form action="ceking.php" method="post" style="margin-bottom:0px;">
<span style="font-size:17px; margin-bottom:7px; display:block;"><strong>Password</strong></span>
<input class="pass" required autofocus name="password" type="password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" /><br />
<input class="btn" type="submit" value="Confirm" />
</form>
</center></div>
</body>
</html>