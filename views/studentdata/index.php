<?php 
  $pageTitle = 'Data Mahasiswa';
  include(__DIR__.'/../parts/top.php');

  $activeSidebarSection = 'data';
  include(__DIR__.'/../parts/navigation.php');
?>

<div class="page-container">
	
	<h1>Data Mahasiswa</h1>

  <p>test</p>

  <?php
/*
  	if($_SESSION['type'] == 'admin'){

  		if($numRows > 0){

			foreach($data as $idx => $row)
				?>

					<tr>

						<td>

					</tr>

				<?php
			}

		} else {
			echo '<p>Tidak ada data</p>';
		}

  	} else {

  		if($numRows > 0){

			foreach($data as $idx => $row)
				?>

					<tr>

						<td>

					</tr>

				<?php
			}

		} else {
			echo '<p>Tidak ada data</p>';
		}
  	}*/
  ?>

</div>


<?php include(__DIR__.'/../parts/bottom.php'); ?>



