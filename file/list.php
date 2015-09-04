<?php include "tops.php";?>
<style>
table{
	border:1px solid #4C95D9;
}
th {
	background:#4C95D9;
	color:#FFFFFF;
}
td:nth-child(even){
	background:#F4F4F4;
}
td:nth-child(odd){
	background:#EEE;
}
tr td{
	border-bottom:1px solid #DDD;
	border-right:1px solid #DDD;
}
</style>
<div class="window" style="margin:50px auto; width:70%;">
	<div class="window-head" style="padding:10px; font-weight:700; font-size:17px; text-align:center;">List File &amp; The Code</div>
	<div class="window-inner"><center>
		<div style="width:70%; padding: 10px 15%; font-size:12pt;">
            <p style="margin-top:0;">Di sini adalah List File yg pernah di Upload Oleh semua Member Forum STEI 2015. Kamu bisa ikut juga untuk berbagi File-file yang ingin kamu Share. Namun sebelumnya check dulu yuk File nya udah ada yg Upload Belum.</p>
            <p>Bila Ingin ikut berbagi File, yuk <a href="upload.php" target="_blank" style="text-decoration:none"><b>Kemari</b></a></p>
        </div>
        <table width="90%" cellpadding='7px' cellspacing='0' border='0'><tbody>
        <th width="7%">No</th><th>File Name</th><th width="13%">File Code</th><th width="17%">Upload by</th><th width="17%">Upload Date</th>
        <?php
		$no = 1;
		$sql = mysqli_query($connection, "SELECT * FROM `db_file`");
		$row = mysqli_num_rows($sql);
		if ($row < 1) {
			echo "<tr><td colspan='5'><center>-- No Record Found --</center></td></tr>";
		};
		while ($run = mysqli_fetch_array($sql)){
			$file_uid	= $run['upload_uid'];
			$file_user	= $run['upload_username'];
			$file_date	= $run['upload_date'];
			$file_code	= $run['filecode'];
			$file_name	= $run['filename'];
			
			print "
		<tr>
			<td align='center'>$no</td>
			<td>$file_name</td>
			<td align='center'>$file_code</td>
			<td align='center'><a href='../profile.php?uid=$file_uid' style='text-decoration:none; color:#000;' target='_blank'><b>$file_user</b></a></td>
			<td align='center'>$file_date</td>
		<tr>";
		$no = $no+1;
		}
?>
        </tbody></table><br /> <br /></center>
	</div>
</div>