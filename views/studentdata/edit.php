<?php 
  $pageTitle = 'Input Data';
  include(__DIR__.'/../parts/top.php');
?>

<div class="container">

  <form class="form-register callout" method="POST" onsubmit="validateThenSubmit(); return false;">
    <h1>Input Data</h1>
    <br>

    <div class="form-group">
      <label for="nim">NIM</label>
      <input type="text" id="nim" name="nim" class="form-control" value="<?php echo $nim; ?>" required <?php if($_SESSION['type'] != 'admin') echo 'readonly';  ?> >
    </div>

    <div class="form-group">
      <label for="namalengkap">Nama lengkap</label>
      <input type="text" name="Nama lengkap" class="form-control" value="<?php if(isset($oldData)) echo htmlspecialchars($oldData->namalengkap); ?>" required>
    </div>

    <br>
    <button class="btn btn-primary">Simpan <span class="glyphicon glyphicon-save"></span></button>
    
  </form>

</div>

<?php include(__DIR__.'/../parts/bottom.php'); ?>
