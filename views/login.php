<?php 
  $pageTitle = 'Login';
  require(__DIR__.'/parts/top.php');
?>

<div class="container">

  <form class="form-login callout" method="POST">
    <h1>Login</h1>
    <br>

    <label for="username" class="sr-only">Username/NIM</label>
    <div class="input-group">
      <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
      <input type="text" name="username" class="form-control" placeholder="Username/NIM" required autofocus>
    </div>
    <label for="password" class="sr-only">Password</label>
    <div class="input-group">
      <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
      <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>

    <br>
    <a href="<?php echo ROOT_URL; ?>/register.php">Belum terdaftar?</a>
    <button class="btn btn-primary btn-block" type="submit">Masuk <span class="glyphicon glyphicon-log-in"></span></button>
    
    <?php
      if($authErrors) echo '<div class="alert alert-danger">'.htmlspecialchars($authErrors).'</div>';
      if($authMessages) echo '<div class="alert alert-info">'.htmlspecialchars($authMessages).'</div>';
    ?>
    
  </form>

</div>

<?php require(__DIR__.'/parts/bottom.php'); ?>
