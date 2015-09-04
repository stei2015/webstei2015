<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="../css/main.css" />
<link rel="stylesheet" href="../css/font-awesome.min.css" />
<link rel="stylesheet" href="../css/font-awesome-setting.css" />
<title>Upload File</title>
</head>
<body>

<div class="window" style="margin:50px auto; width:50%;">
	<div class="window-head" style="padding:10px; font-weight:700; font-size:17px; text-align:center;">Choose Your Upload  to File</div>
	<div class="window-inner"><br /> <br /> <center>
        <table cellpadding='7px' cellspacing='0' border='0'><tbody>
        <tr><td align='center' colspan='2'>
            <form action="upload_prosses.php" method="post" enctype="multipart/form-data">
                <input type="file" required name="fileToUpload" id="fileToUpload" class="choose_file"><br /><br />
                <input type="submit" value="Upload File" name="submit" class="btn-allsize btn-blue" style="padding:10px;">
            </form>        	
        </td></tr>
        </tbody></table><br /> <br /></center>
	</div>
</div>
</body>
</html>