<!doctype html>
<html>
<head>
<title>Data Base STEI ITB 2015</title>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript">
// WRITE THE VALIDATION SCRIPT IN THE HEAD TAG.
function isNumber(evt) {
	var iKeyCode = (evt.which) ? evt.which : evt.keyCode
	if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
		return false;

	return true;
}
function selectStep(n){
	pos= (n-1)*450;
	$(".subform").animate({left:'-'+pos+'px'},400);
	$(".tab").removeClass("activeTab")
	$("#btntb"+n).addClass("activeTab")
}
</script>
<link rel="stylesheet" href="../../css/formdatabase.css" />
</head>

<body>
<?php
include "ceksession.php";
require_once "../../config.php";
$noreg	= $_SESSION['noreg'];
$nim		= $_SESSION['nim'];
$runsql = mysqli_query($connection, "SELECT * FROM `db_datainduk` WHERE `noreg` = '$noreg'");

while ($result = mysqli_fetch_array($runsql)) {
	global $nama, $panggilan, $tmplahir, $tgllahir, $sma, $alamat1, $kota1, $prov1, $pos1, $alamat2, $kota2, $prov2, $pos2, $nohp, $nodarurat, $ebebas, $estudent, $twitter, $facebook, $line, $darah, $penyakit;
	$nama			= $result['nama'];
	$panggilan		= $result['panggilan'];
	$tmplahir		= $result['tmplahir'];
	$tgllahir		= $result['tgllahir'];
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
}
?>

<div id="bg">
  <div class="module">
    <table cellpadding="2" cellspacing="0" align="center"><tbody>
    	<tr>
        	<td onClick="selectStep(1);" id="btntb1" class="tab activeTab"><span class="icon">Data Diri</span></td>
        	<td onClick="selectStep(2);" id="btntb2" class="tab"><span class="icon">Alamat Asli</span></td>
        	<td onClick="selectStep(3);" id="btntb3" class="tab"><span class="icon">Alamat Bandung</span></td>
        	<td onClick="selectStep(4);" id="btntb4" class="tab"><span class="icon">Informasi Kontak</span></td>
        	<td onClick="selectStep(5);" id="btntb5" class="tab"><span class="icon">Media Sosial</span></td>
        	<td onClick="selectStep(6);" id="btntb6" class="tab"><span class="icon">Lain Lain</span></td>
        </tr>
    </tbody></table>

    
    <form class="form" action="updating.php" method="post">
        <!-- fieldsets -->
        <div class="subform" id="tab1">
            <input type="text" class="textbox" name="noreg" readonly onkeypress="javascript:return isNumber (event)" placeholder="No Registrasi"  value="<?php echo "$noreg" ?>" />
            <input type="hidden" class="textbox" name="nim" readonly onkeypress="javascript:return isNumber (event)" placeholder="NIM"  value="<?php echo "$nim" ?>" />
            <input type="text" class="textbox" name="nama" placeholder="Nama Lengkap" value="<?php echo "$nama" ?>" />
            <input type="text" class="textbox" name="panggilan" placeholder="Nama Panggilan" value="<?php echo "$panggilan" ?>" />
            <input type="text" class="textbox" name="tmplahir" placeholder="Tempat Lahir" value="<?php echo "$tmplahir" ?>" />
            <input type="text" class="textbox" name="tgllahir" placeholder="Tanggal Lahir | Format: YYYY-MM-DD" value="<?php echo "$tgllahir" ?>" />
            <input type="button" name="next" class="button" value="Lanjut" onClick="selectStep(2)" />
        </div>
    	<div class="subform" id="tab2">
            <input type="text" class="textbox" name="alamat1" placeholder="Alamat" value="<?php echo "$alamat1" ?>" />
            <input type="text" class="textbox" name="kota1" placeholder="Kota" value="<?php echo "$kota1" ?>" />
            <input type="text" class="textbox" name="prov1" placeholder="Provinsi" value="<?php echo "$prov1" ?>" />
            <input type="text" class="textbox" name="pos1" placeholder="Kode POS" value="<?php echo "$pos1" ?>" />
            <input type="button" name="previous" class="previous button" value="Kembali" onClick="selectStep(1)" />
            <input type="button" name="next" class="next button" value="Lanjut" onClick="selectStep(3)" />
        </div>
    	<div class="subform" id="tab3">
            <input type="text" class="textbox" name="alamat2" placeholder="Alamat" value="<?php echo "$alamat2" ?>" />
            <input type="text" class="textbox" name="kota2" placeholder="Kota" value="<?php echo "$kota2" ?>" />
            <input type="text" class="textbox" name="prov2" placeholder="Provinsi" value="<?php echo "$prov2" ?>" />
            <input type="text" class="textbox" name="pos2" placeholder="Kode POS" value="<?php echo "$pos2" ?>" />
            <input type="button" name="previous" class="previous button" value="Kembali" onClick="selectStep(2)" />
            <input type="button" name="next" class="next button" value="Lanjut" onClick="selectStep(4)" />
        </div>
        <div class="subform" id="tab4">
            <input type="text" class="textbox" name="nohp" onkeypress="javascript:return isNumber (event)" placeholder="No Handphone" value="<?php echo "$nohp" ?>" />
            <input type="text" class="textbox" name="nodarurat" onkeypress="javascript:return isNumber (event)" placeholder="No Telepon Darurat" value="<?php echo "$nodarurat" ?>" />
            <input type="email" class="textbox" name="ebebas" placeholder="Email Bebas | @yahoo.com @gmail.com @hotmail.com" value="<?php echo "$ebebas" ?>" />
            <input type="email" class="textbox" name="estudent" placeholder="Email Student | @itb.ac.id" value="<?php echo "$estudent" ?>" />
            <input type="button" name="previous" class="previous button" value="Kembali" onClick="selectStep(3)" />
            <input type="button" name="next" class="next button" value="Lanjut" onClick="selectStep(5)" />
        </div>
	    <div class="subform" id="tab5">
            <input type="text" class="textbox" name="twitter" placeholder="Twitter" value="<?php echo "$twitter" ?>" />
            <input type="text" class="textbox" name="facebook" placeholder="Facebook | contoh: www.facebook.com/userprofile" value="<?php echo "$facebook" ?>" />
            <input type="text" class="textbox" name="line" placeholder="ID Line" value="<?php echo "$line" ?>" />
            <input type="button" name="previous" class="button" value="Kembali" onClick="selectStep(4)" />
            <input type="button" name="next" class="button" value="Lanjut" onClick="selectStep(6)" />
        </div>
        <div class="subform" id="tab6">
            <input type="text" class="textbox" name="sma" placeholder="Asal SMA/MA/SMK/sederajat" value="<?php echo "$sma" ?>" />
            <input type="text" class="textbox" name="darah" placeholder="Golongan Darah | A/B/AB/O" value="<?php echo "$darah" ?>" />
            <input type="text" class="textbox" name="penyakit" placeholder="Riwayat Penyakit | Asma; Alergi; ...; ...;" value="<?php echo "$penyakit" ?>" />
            <input type="button" name="previous" class="previous button" value="Kembali" onClick="selectStep(5)" />
            <input type="submit" name="submit" class="button" value="Selesai" />
        </div>
    </form>
  </div>
</div>

</body>
</html>