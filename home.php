<?php include "top.php" ?>
<link rel="stylesheet" href="css/home.css">

<div class="header">
    <!-- Navigaion -->
    <a href="home.php"><i class="icon-home"></i> Home</a>
    <span><i class='icon-chevron-right'></i></span>
    
</div>

<?php 
require_once "config.php";

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
			<td class='categori'><b>$fname</b></td>
			<td class='new'><a href='forum.php?fid=$fid'><i class='icon-plus-sign-alt'></i></a></td>
		</tr></tbody></table>
		"; include ('listingforum.php');

	};
?>
<?php include "end.php";