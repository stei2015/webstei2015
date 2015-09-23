<?php 
  $pageTitle = 'Profil';
  include(__DIR__.'/../parts/top.php');

  $activeSidebarSection = 'data';
  include(__DIR__.'/../parts/navigation.php');

?>

<div class="page-container">
	
	<?php
		if($numRows > 0){
			?>

				<div class="page-header">
					<h1>Profil <small><?php echo htmlspecialchars($studentData[0]['username']); ?></small></h1>
					<?php
						if($profileEditable){
							?>
								<a href="<?php echo ROOT_URL; ?>/studentdata/edit.php?nim=<?php echo $nim; ?>">Edit data diri</a>
								/
								<a href="<?php echo ROOT_URL; ?>/studentdata/editprofilepicture.php?nim=<?php echo $nim; ?>">Edit foto</span></a>
							<?
						}
					?>
				</div>

				<div class="row">
					<div class="col-sm-3">
						<div style="background: url('<?php echo ROOT_URL.'/profilepicture.php?id='.$nim; ?>') repeat scroll center center / cover #aaa; padding-bottom:100%;"></div>
					</div>
					<div class="col-sm-9">
						<h2><?php echo htmlspecialchars($studentData[0]['namalengkap']); ?></h2>
						<hr>

						<span class="field-header">Nama panggilan</span>
						<p><?php echo htmlspecialchars($studentData[0]['namapanggilan']); ?></p>

						<span class="field-header">NIM</span>
						<p><?php echo htmlspecialchars($nim); ?></p>

						<br>
					</div>
				</div>

			<?php
		} else {
			?>
				<div class="page-header">
					<h1>Profil <small>NIM <?php echo htmlspecialchars($nim); ?></small></h1>
				</div>
				<p>Data tidak ditemukan</p>
			<?php
		}
	?>
	
</div>


<?php include(__DIR__.'/../parts/bottom.php'); ?>



