<?php 
  $pageTitle = 'Error :(';
  require(__DIR__.'/parts/top.php');
?>

<div class="container">

    <br>
    <h1>Error! <small><?php echo 'HTTP '.htmlspecialchars($status); ?></small></h1>
    <hr>

    <p>
      <?php
        if(isset($description)) echo htmlspecialchars($description);
      ?>
    </p>
    
</div>

<?php require(__DIR__.'/parts/bottom.php'); ?>
