<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Data Base Mahasiswa STEI 2015</title>
</head>

<body>

<style>
body{
	font-family:Arial;
	background:#EFEFEF;
	margin:0; padding:0;
}
.main {
	width:450%;
	margin: 0;
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
td {text-align:center;}
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
.button{
	background:#6685E8;
	border:1px solid #3F64D8;
	box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2);
	color:#FFFFFF;
	border-radius:4px;
	display:inline-block;
	width: 65px;
	height:12px;
	padding:7px 0;
	margin: 10px 0 5px 10px;
	text-decoration:none;
	text-align:center;
	font:12px arial;
}

th {
	background:#D7D7D7;
}
</style>
<div class="main">
<?php 
include "ceksession.php";
$noreg= $_SESSION['noreg'];
?>
<table border="1"><tbody>
<tr>
	<th rowspan="2" width="2.5%">No Registrasi /SBMPTN</th>
    <th rowspan="2" width="4%">NIM</th>
    <th rowspan="2" width="6.5%">Nama Lengkap</th>
	<th rowspan="2" width="2.5%">Nama Panggilan</th>
    <th colspan="4" width="7%">Lahir</th>
	<th rowspan="2" width="6%">Asal SMA</th>
    <th colspan="4" width="17%">Alamat Asal</th>
    <th colspan="4" width="17%">Alamat di Bandung</th>
	<th colspan="2" width="8%">Kontak</th>
    <th colspan="2" width="8%">Email</th>
    <th colspan="3" width="12.5%">Akun Media Sosial</th>
    <th rowspan="2" width="1.5%">Gol Darah</th>
    <th rowspan="2" width="5%">Penyakit</th>
</tr>
<tr>
	<th width="3%">Tempat</th>
    <th width="1%">Hari</th>
	<th width="1%">Bulan</th>
    <th width="2%">Tahun</th>
	<th width="325px">Alamat</th>
    <th width="3.5%">Kota</th>
	<th width="3.5%">Provinsi</th>
    <th width="2%">Kode Pos</th>
   	<th width="325px">Alamat</th>
    <th width="3.5%">Kota</th>
	<th width="3.5%">Provinsi</th>
    <th width="2%">Kode Pos</th>
    <th width="4%">No Hp</th>
	<th>No Darurat</th>
    <th width="4%">Email Bebas</th>
    <th>Email Student</th>
    <th width="3.5%">Twitter</th>
    <th width="5.5%">Facebook</th>
    <th width="3.5%">ID Line</th>
</tr>

<?php

require_once "../../config.php";

$runsql = mysqli_query($connection, "SELECT * FROM `db_datainduk` ORDER BY `db_datainduk`.`noreg` ASC");

while ($result = mysqli_fetch_array($runsql)) {
	$noreg			= $result['noreg'];
	$nama			= $result['nama'];
	$panggilan		= $result['panggilan'];
	$tmplahir		= $result['tmplahir'];
	$sma			= $result['sma'];
	$alamat1		= $result['alamat1'];
	$kota1			= $result['kota1'];
	$prov1			= $result['prov1'];
	$pos1			= $result['pos1'];
	$alamat2		= $result['alamat2'];
	$kota2			= $result['kota2'];
	$prov2			= $result['prov2'];
	$pos2			= $result['pos2'];
	$nohp			= $result['nohp'];
	$nodarurat		= $result['nodarurat'];
	$ebebas			= $result['ebebas'];
	$estudent		= $result['estudent'];
	$twitter		= $result['twitter'];
	$facebook		= $result['facebook'];
	$line			= $result['line'];
	$darah			= $result['darah'];
	$penyakit		= $result['penyakit'];
	$date			= $result['tgllahir'];
	
	$BulanIndo = array("Januari", "Februari", "Maret",
					   "April", "Mei", "Juni",
					   "Juli", "Agustus", "September",
					   "Oktober", "November", "Desember");

	$tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
	$bln = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
		$bulan=$BulanIndo[(int)$bln-1];
	$tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
	
	$tgllahir = $tgl . " " . $BulanIndo[(int)$bln-1] . " ". $tahun;

	
	print "<tr class='list'>
	<td>$noreg</td><td>0</td>
	<td>$nama</td><td>$panggilan</td>
	<td>$tmplahir</td><td>$tgl</td>
	<td>$bulan</td><td>$tahun</td>
	<td>$sma</td><td>$alamat1</td>
	<td>$kota1</td><td>$prov1</td>
	<td>$pos1</td><td>$alamat2</td>
	<td>$kota2</td><td>$prov2</td>
	<td>$pos2</td><td>$nohp</td>
	<td>$nodarurat</td><td>$ebebas</td>
	<td>$estudent</td><td>$twitter</td>
	<td>$facebook</td><td>$line</td>
	<td>$darah</td><td>$penyakit</td>
	</tr>";
};

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_Induk_STEI_ITB_2015.xls");

?>
</tbody></table>
</div>
</body>
</html>