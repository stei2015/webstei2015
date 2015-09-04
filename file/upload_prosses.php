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
	<div class="window-head" style="padding:10px; font-weight:700; font-size:17px; text-align:center;">Upload File Information</div>
	<div class="window-inner"><br /> <br /> <center>
        <table cellpadding='7px' cellspacing='0' border='0'><tbody>
        <tr>
        	<td align='center' colspan='2'>
<?php
require_once "../config.php"; session_start();
$uid_now = $_SESSION['uid'];
$username= $_SESSION['username'];
$timestamp = strtotime(date("d M Y", time()-2*60+7*60*60));
$date_now  = date("d M Y", $timestamp);
$filename  = basename($_FILES["fileToUpload"]["name"]);

$target_dir = "download/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {

        $uploadOk = 1;
}
// Check if file already exists
if (file_exists($target_file)) {
    $warning = "<span style='color:#FF3033; font-weight:700; font-size:11px;'><i class='icon-warning-sign'></i> Sorry, file already exists</span><br />";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 3000000) {
    $warning = "<span style='color:#FF3033; font-weight:700; font-size:11px;'><i class='icon-warning-sign'></i> Sorry, your file is too large</span><br />";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<span style='color:#FF3033; font-weight:600; font-size:15px;'>Sorry, your file was not uploaded</span><br />$warning";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<b style='font-size:15px;'>File: \"". basename( $_FILES["fileToUpload"]["name"]). "\" has been uploaded</b>";
		function generatefilecode($length = 9) {
			$characters = '0123456789abcdef';
			$charactersLength = strlen($characters);
			$filecode = '';
			for ($i = 0; $i < $length; $i++) {
				$filecode .= $characters[rand(0, $charactersLength - 1)];
				global $filecode;
			}
			return $filecode;
		}
		
		echo "<br /><span class='btn-allsize btn-green' style='padding:7px; margin:10px 0; font-size:17px; font-weight:500;'>File code: <b>".generatefilecode()."</b></span><br /><span style='color:#FF3033; font-size:12px; font-weight:700;'><i class='icon-warning-sign'></i>  Remember This Code!! Copy and Save This Code!  <i class='icon-warning-sign'></i></span>";
		mysqli_query($connection, "INSERT INTO `db_file`(`fileid`, `filecode`, `filename`, `dl_counter`, `upload_date`, `upload_uid`, `upload_username`) VALUES (NULL, '$filecode', '$filename', '0', '$date_now','$uid_now', '$username') ");

    } else {
        echo "Sorry, there was an error uploading your file.<br />";
    }
}
?>

        	</td>
        </tr>
        </tbody></table><br /> <br /></center>
	</div>
</div>

</body>
</html>