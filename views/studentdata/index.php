<?php 
  $pageTitle = 'Data Mahasiswa';
  include(__DIR__.'/../parts/top.php');
?>


<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Menu utama</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">STEI 2015</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Forum</a></li>
        <li><a href="#">Data</a></li>
        <li><a href="#">Chat</a></li>
        <li><a href="#">Logout</a></li>
      </ul>
      <form class="navbar-form navbar-right">
        <input class="form-control" placeholder="Cari..." type="text">
      </form>
    </div>
  </div>
</nav>

<div class="sidebar">
  <ul class="nav nav-sidebar">
    <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
    <li><a href="#">Reports</a></li>
    <li><a href="#">Analytics</a></li>
    <li><a href="#">Export</a></li>
  </ul>
  <ul class="nav nav-sidebar">
    <li><a href="">Nav item</a></li>
    <li><a href="">Nav item again</a></li>
    <li><a href="">One more nav</a></li>
    <li><a href="">Another nav item</a></li>
    <li><a href="">More navigation</a></li>
  </ul>
  <ul class="nav nav-sidebar">
    <li><a href="">Nav item again</a></li>
    <li><a href="">One more nav</a></li>
    <li><a href="">Another nav item</a></li>
  </ul>
</div>

<div class="container-fluid container-sidebar">
	
	<h1 class="page-header">Data Mahasiswa</h1>

  <?php
/*
  	if($_SESSION['type'] == 'admin'){

  		if($result->num_rows > 0){

			while($resultRow = $result->fetch_object()){
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

  		if($result->num_rows > 0){

			while($resultRow = $result->fetch_object()){
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



