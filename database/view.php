<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Data Base Mahasiswa STEI 2015</title>
<link rel="stylesheet" href="../css/font-awesome.min.css" />
<link rel="stylesheet" href="../css/font-awesome-setting.css" />
</head>

<body>

<style>
::-webkit-scrollbar {
                    height:8px;
                    width: 10px;
                    background: #DAD2D2;}
::-webkit-scrollbar-thumb {
                    background-color: #333;
                    border-radius: 7px;}


body{
	font-family:Arial;
	background:#EFEFEF;
	margin:0; padding:0;
}
.main {
	width:90%;
	margin: 60px auto;
	background:#ffffff;
	padding-bottom:15px;
	border-bottom:2px solid #CCCCCC;
}
.header{
	width:100%;
	background:#567AEB;
	margin-bottom: 15px;
	display:block;
	border-bottom:3px solid #8EA8F8;
	border-radius: 5px 5px 0 0;
	height:50px;
	line-height:50px;
	text-align:center;
	color:#FFFFFF;
	font-size:16px;
	font-weight:700;
}
.label{
	width:100%;
	background:#FFFFFF;
	text-align:center;
}
td:nth-child(even){
	background:#F4F4F4;
}
td:nth-child(odd){
	background:#FBFBFB;
}
tr:nth-last-child td{
	border-bottom:2px solid #999999;
}
.atas{
	border-bottom:2px solid #999999;
	border-top:2px solid #999999;
	font-weight:700;
}
.toolbar{
	position:fixed;
	width:100%;
	top:0;
	right:0;
	padding:0 10px 0 0;
	background:#FFFFFF;
}
.button{
	background:#6685E8;
	border:1px solid #3F64D8;
	box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2);
	color:#FFFFFF;
	border-radius:4px;
	display:inline-block;
	height:12px;
	padding:7px 10px;
	margin: 10px 5px 10px 0;
	text-decoration:none;
	text-align:center;
	font:12px arial;
	float:right;
}
.button i{
	font-size:14px;
	line-height:12px;
}
.info{
	background:#DFDFDF;
	border:1px solid #CFCFCF;
	color:#000000;
	cursor:pointer;
}
</style>
<div class="main">
<div class="header">Data Base Mahasiswa STEI angkatan 2015</div>

<?php 
include "ceksession.php";
$nim= $_SESSION['nim'];
?>
<div class="toolbar">
    <a class="button" href="../index.php"><i class="icon-signout"></i> Forum</a>
    <a class="button" href="getfullview.php"><i class="icon-list-alt"></i> View All</a>
    <a class="button info"><i class="icon-user"></i> <b><?php echo $nim ?></b></a>
</div>

<table cellpadding="5px" cellspacing="0" class="label" border="0"><tbody>
<tr><td class="atas">No Registrasi</td><td class="atas">Nama Lengkap</td><td class="atas">Email</td><td class="atas">ID Line</td></tr>

<?php
require_once "../config.php";

$runsql = mysqli_query($connection, "SELECT * FROM `db_datainduk` ORDER BY `db_datainduk`.`noreg` ASC");

while ($result = mysqli_fetch_array($runsql)) {
	$noreg			= $result['noreg'];
	$nama			= $result['nama'];
	$email			= $result['ebebas'];
	$line				= $result['line'];
	
	print "<tr class='list'>
	<td>$noreg</td>
	<td>$nama</td>
	<td>$email</td>	
	<td>$line</td>
	</tr>";
};
?>
</tbody></table>
</div>
</body>
</html>