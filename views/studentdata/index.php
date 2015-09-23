<?php 
  $pageTitle = 'Data Mahasiswa';
  include(__DIR__.'/../parts/top.php');

  $activeSidebarSection = 'data';
  include(__DIR__.'/../parts/navigation.php');

?>

<div class="page-container">
	
	<div class="page-header">
		<h1>Data Mahasiswa</h1>

		<form class="form-inline" method="GET">
			<div class="input-group">
				<input type="search" name="search" placeholder="Cari..." class="form-control" value="<?php if(isset($_GET['search'])) echo htmlspecialchars($_GET['search']); ?>">
				<span class="input-group-btn">
					<button class="btn btn-default" type="submit">
						<span class="glyphicon glyphicon-search"></span>
					</button>
				</span>
			</div>
			<select name="by" class="form-control">
				<?php
					if(isset($_GET['by'])) $selectedKey = $_GET['by']; else $selectedKey = 'namalengkap';
					foreach($viewColumns as $key => $val){
						if($key == $selectedKey) $selected = 'selected'; else $selected = '';
						echo '<option value="'.$key.'" '.$selected.'>'.$val.'</option>';
					}
				?>
			</select>
		</form>

	</div>
	
  <div class="table-responsive">
  	<table class="table table-hover">
  		
		  <?php

		  		if($numRows > 0){

		  			?>
		  				<thead>
				  			<tr>
				  				<?php
				  					foreach($viewColumns as $key => $val){
				  						echo '<th>'.htmlspecialchars($val).'</th>';
				  					}
				  				?>
				  			</tr>
				  		</thead>
				  		<tbody>
		  			<?php

						foreach($data as $row){
							?>
								<tr <?php if($_SESSION['type'] == 'admin') echo 'onclick="document.location=\''.ROOT_URL.'/studentdata/profile.php?nim='.filter_var($row['nim']).'\';"'; ?> >
									<?php
				  					foreach($viewColumns as $key => $val){
				  						echo '<td>'.htmlspecialchars($row[$key]).'</td>';
				  					}
				  				?>
								</tr>
							<?php
						}
						echo '</tbody>';

					} else {
						echo '<tr><td colspan="'.count($viewColumns).'">Tidak ada data</td></tr>';
					}

		  ?>

   	</table>
  </div>

</div>


<?php include(__DIR__.'/../parts/bottom.php'); ?>



