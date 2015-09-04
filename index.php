<?php include "top.php" ?>
<ul class="navigation">
	<li><a href="trial/index.php"><i class="icon-home"></i> Home</a></li>
    
</ul>
<div class="announcement">
	<table cellpadding="2" cellspacing="0" height="100%;" border="0"><tbody><tr>
	    <td><i class="icon-bullhorn"></i></td>
		<td><?php echo "Selamat Datang!!<br />Mohon Semua Member Membaca Peraturan Forum"; ?></td>
    </tr></tbody></table>
</div>

<!-- Mulai ISI nya -->
<?php 

$category = "SELECT * FROM `db_forum` WHERE `type` = 'c' ORDER BY `disporder` ASC ";
$getcategory = mysqli_query($connection, $category);
while ($allcategory = mysqli_fetch_array($getcategory)) {
		$fid	= $allcategory['fid'];
		$fname	= $allcategory['fname'];
		$fdisporder	= $allcategory['disporder'];
		global $parent; $parent=$fdisporder;
	echo "
		<section class='onecategory'>
		<table width='100%' class='tcategory'><tbody><tr>
			<td class='categori' colspan='2'><b>$fname</b></td>
		</tr></tbody></table>
		"; include ('listingforum.php');

	};
?>
<!-- Akhir ISI nya -->

<?php include "end.php";