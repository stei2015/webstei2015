<?php include "tops.php" ?>
<ul class="navigation">
	<li><a href="index.php"><i class="icon-home"></i> Home</a></li>
    <li><a style="cursor:pointer;"><i class="icon-user"></i> Profile</a></li>
</ul>

<div class="window">
<?php 
require_once "config.php";
$uid = $_GET['uid'];
$runsql = mysqli_query($connection, "SELECT * FROM `db_user` WHERE `uid` = '$uid'");
while ($result = mysqli_fetch_array($runsql)){
	$username = $result['username'];
	$nim 	  = $result['nim'];
global $username, $nim; 
};

if ($nim == 16515000){ print "<center><br /><h2>Admin Forum adalah Anggota STEI 2015</h2></center>"; } else {
$sql = "SELECT * FROM `db_datainduk` WHERE `nim` = '$nim'";
$getsql = mysqli_query($connection, $sql);
while ($allsql = mysqli_fetch_array($getsql)) {
$noreg	= $allsql['noreg'];
$nama	= $allsql['nama'];
$panggilan=$allsql['panggilan'];
$sma	= $allsql['sma'];
$lahir	= $allsql['tmplahir'].", ".$allsql['tgllahir'];
$asal	= $allsql['alamat1'].", ".$allsql['kota1'].", ".$allsql['prov1']." (".$allsql['pos1'].")";
$bandung= $allsql['alamat2'].", ".$allsql['kota2'].", ".$allsql['prov2']." (".$allsql['pos2'].")";
$nohp	= $allsql['nohp'];
$nodarurat=$allsql['nodarurat'];
$ebebas	= $allsql['ebebas'];
$estudent=$allsql['estudent'];
$twitter= $allsql['twitter'];
$facebook=$allsql['facebook'];
$line	= $allsql['line'];
$darah	= $allsql['darah'];
$penyakit=$allsql['penyakit'];

print "
    <table class='window-inner profile' cellpadding='10px' cellspacing='0' border='0' align='center'><tbody>
        <th colspan='4'>General Infotmation</th>
        <tr>
            <td rowspan='3' width='20%'>
            	<center><div style='width:100px; height:100px; display:block; background: url(img/avatar/$uid.jpg); background-size: cover;' class='avatar'></div></center>
            </td>
            <td><b>Nama Lengkap</b></td><td>:</td><td>$nama</td>
        </tr>
            <tr><td width='20%'><b>Nama Panggilan</b></td><td width='2%'>:</td><td>$panggilan</td></tr>
            <tr><td><b>No Reg</b></td><td>:</td><td>$noreg</td></tr>
        <tr><td><center>$username</center></td><td><b>Email Student</b></td><td>:</td><td>$estudent</td></tr>
        <tr><td><center>Status dll</center></td><td><b>Id Line</b></td><td>:</td><td>$line</td></tr>
    </tbody></table>
    
    <table class='window-inner profile' cellpadding='10px' cellspacing='0'><tbody>
	    <th colspan='4'>Detail Profile</th>
        <tr><td width='5%'>&nbsp;</td><td width='20%'><b>Alamat Bandung</b></td><td width='2%'>:</td><td>$bandung</td></tr>
        <tr><td>&nbsp;</td><td><b>Alamat Asal</b></td><td>:</td><td>$asal</td></tr>
        <tr><td>&nbsp;</td><td><b>Asal SMA</b></td><td>:</td><td>$sma</td></tr>
        <tr><td>&nbsp;</td><td><b>No Hp</b></td><td>:</td><td>$nohp</td></tr>
        <tr><td>&nbsp;</td><td><b>Email</b></td><td>:</td><td>$ebebas</td></tr>
        <tr><td>&nbsp;</td><td><b>Tempat Tanggal Lahir</b></td><td>:</td><td>$lahir</td></tr>
        <tr><td>&nbsp;</td><td><b>Golongan Darah</b></td><td>:</td><td>$darah</td></tr>
    </tbody></table>
</div>";
};
}
include "end.php"; ?>