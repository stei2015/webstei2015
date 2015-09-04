<html>
<head>
<title>Upload Your Photo Profile</title>
<link rel="stylesheet" href="../css/main.css" />
</head>

<body style="font-family:arial; font-size:12px;">
<?php
session_start();
$uid_now	  = $_SESSION['uid'];
?>
<div style="display:block; width:100%; height:100px;">&nbsp;</div>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#47C1FC">
	<tr>
	<form action="upload_rename_ac.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
		<td>
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
			<tr>
				<td align="center"><strong>Upload Your Photo Profile</strong></td>
			</tr>
			<tr>
				<td align="center" height="60px">
				Select file 
				<input name="ufile" type="file" id="ufile" size="50" onchange="ValidateSingleInput(this);" class="btn-allsize btn-blue" /></td><br />
				<input name="uid" type="hidden" value="<?php echo "$uid_now"; ?>" />
			</tr>
			<tr><td align="center"><span style="color: #FF3033; font-size:12px; font-weight:700;">Pastikan format Foto ".jpg" !<br />Foto yang di Izinkan adalah Foto SNMPTN/SBMPTN! </span></td></tr>
			<tr>
				<td align="center"><input class="btn btn-blue" type="submit" name="Submit" value="Upload" /></td>
			</tr>
			</table>
		</td>
	</form>
    <script type="text/javascript">
	var _validFileExtensions = [".jpg"];    
	function ValidateSingleInput(oInput) {
		if (oInput.type == "file") {
			var sFileName = oInput.value;
			 if (sFileName.length > 0) {
				var blnValid = false;
				for (var j = 0; j < _validFileExtensions.length; j++) {
					var sCurExtension = _validFileExtensions[j];
					if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
						blnValid = true;
						break;
					}
				}
				 
				if (!blnValid) {
					alert("Sorry, " + sFileName + " is invalid, allowed extensions are:  " + _validFileExtensions.join(", "));
					oInput.value = "";
					return false;
				}
			}
		}
		return true;
	}
    </script>
	</tr>
</table>
</body>
</html>