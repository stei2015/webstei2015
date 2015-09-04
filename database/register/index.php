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

    
    <form class="form" action="submiting.php" method="post">
        <!-- fieldsets -->
        <div class="subform" id="tab1">
            <input type="text" class="textbox" name="noreg" onkeypress="javascript:return isNumber (event)" placeholder="No Registrasi" />
            <input type="hidden" class="textbox" name="nim" readonly onkeypress="javascript:return isNumber (event)" placeholder="NIM"  value="<?php session_start(); $nim	 = $_SESSION['nim']; echo "$nim" ?>" />
            <input type="text" class="textbox" name="nama" placeholder="Nama Lengkap" />
            <input type="text" class="textbox" name="panggilan" placeholder="Nama Panggilan" />
            <input type="text" class="textbox" name="tmplahir" placeholder="Tempat Lahir" />
            <input type="text" class="textbox" name="tgllahir" placeholder="Tanggal Lahir | Format: YYYY-MM-DD " />
            <input type="button" name="next" class="button" value="Lanjut" onClick="selectStep(2)" />
        </div>
    	<div class="subform" id="tab2">
            <input type="text" class="textbox" name="alamat1" placeholder="Alamat" />
            <input type="text" class="textbox" name="kota1" placeholder="Kota" />
            <input type="text" class="textbox" name="prov1" placeholder="Provinsi" />
            <input type="text" class="textbox" name="pos1" placeholder="Kode POS" />
            <input type="button" name="previous" class="previous button" value="Kembali" onClick="selectStep(1)" />
            <input type="button" name="next" class="next button" value="Lanjut" onClick="selectStep(3)" />
        </div>
    	<div class="subform" id="tab3">
            <input type="text" class="textbox" name="alamat2" placeholder="Alamat" />
            <input type="text" class="textbox" name="kota2" placeholder="Kota" />
            <input type="text" class="textbox" name="prov2" placeholder="Provinsi" />
            <input type="text" class="textbox" name="pos2" placeholder="Kode POS" />
            <input type="button" name="previous" class="previous button" value="Kembali" onClick="selectStep(2)" />
            <input type="button" name="next" class="next button" value="Lanjut" onClick="selectStep(4)" />
        </div>
        <div class="subform" id="tab4">
            <input type="text" class="textbox" name="nohp" onkeypress="javascript:return isNumber (event)" placeholder="No Handphone" />
            <input type="text" class="textbox" name="nodarurat" onkeypress="javascript:return isNumber (event)" placeholder="No Telepon Darurat" />
            <input type="email" class="textbox" name="ebebas" placeholder="Email Bebas | @yahoo.com @gmail.com @hotmail.com" />
            <input type="email" class="textbox" name="estudent" placeholder="Email Student | @itb.ac.id" />
            <input type="button" name="previous" class="previous button" value="Kembali" onClick="selectStep(3)" />
            <input type="button" name="next" class="next button" value="Lanjut" onClick="selectStep(5)" />
        </div>
	    <div class="subform" id="tab5">
            <input type="text" class="textbox" name="twitter" placeholder="Twitter" />
            <input type="text" class="textbox" name="facebook" placeholder="Facebook | contoh: www.facebook.com/userprofile" />
            <input type="text" class="textbox" name="line" placeholder="ID Line" />
            <input type="button" name="previous" class="button" value="Kembali" onClick="selectStep(4)" />
            <input type="button" name="next" class="button" value="Lanjut" onClick="selectStep(6)" />
        </div>
        <div class="subform" id="tab6">
            <input type="text" class="textbox" name="sma" placeholder="Asal SMA/MA/SMK/sederajat" />
            <input type="text" class="textbox" name="darah" placeholder="Golongan Darah | A/B/AB/O" />
            <input type="text" class="textbox" name="penyakit" placeholder="Riwayat Penyakit | Asma; Alergi; ...; ...;" />
            <input type="button" name="previous" class="previous button" value="Kembali" onClick="selectStep(5)" />
            <input type="submit" name="submit" class="button" value="Selesai" />
        </div>
    </form>
  </div>
</div>

</body>
</html>