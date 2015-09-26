<?php 
  $pageTitle = 'Edit Foto Profil';
  require(__DIR__.'/../parts/top.php');
?>

<div class="container">

  <form class="form-register callout" method="POST" enctype="multipart/form-data">
    <h1>Edit Foto Profil <small><?php echo $nim; ?></small></h1>
    <p>Foto sebaiknya foto wajah dan bukan foto grup. Ukuran file maksimal 256 KB</p>
    <br>

    <input type="hidden" name="nim" value="<?php echo $nim; ?>">
    
    <div class="form-group">
      <input name="profilepicture" type="file">
    </div>
    
    <?php if($hasPicture){ ?>
          <div style="max-width: 250px; max-height:250px;">
            <div style="background: url('<?php echo ROOT_URL.'/profilepicture.php?id='.$nim; ?>') repeat scroll center center / cover #ccc; padding-bottom:100%;"></div>
          </div>
    <?php } ?>

    <br>

    <?php
      if(isset($uploadErrors)) echo '<div class="alert alert-danger">'.htmlspecialchars($uploadErrors).'</div>';
    ?>

    <button class="btn btn-primary">Upload <span class="glyphicon glyphicon-upload"></span></button>

    <?php if($hasPicture){ ?>
      <a href="<?php echo ROOT_URL.'/index.php'; ?>" class="btn btn-success">Lanjut <span class="glyphicon glyphicon-chevron-right"></span></a>
    <?php } ?>

    

  </form>
  <br><br>

</div>

<script>

</script>

<?php require(__DIR__.'/../parts/bottom.php'); ?>
