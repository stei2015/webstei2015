<?php 
  $pageTitle = 'Register';
  include(__DIR__.'/parts/top.php');
?>

<div class="container">

  <form class="form-register callout" method="POST" onsubmit="validateThenSubmit(); return false;">
    <h1>Daftar</h1>
    <br>

    <div id="nimFormGroup" class="form-group">
      <label for="nim">NIM</label>
      <input type="text" id="nim" name="nim" class="form-control" required autofocus>
      <label class="error-text">NIM harus merupakan NIM TPB STEI yang valid</label>
    </div>

    <div id="usernameFormGroup" class="form-group">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" class="form-control" onchange="checkUsername();" required>
      <label class="error-text">Username tidak tersedia atau tidak valid (hanya huruf, angka dan underscore diperbolehkan, minimal 3 karakter)</label>
    </div>

    <div id="passwordFormGroup" class="form-group">
      <label for="password">Password</label>
      <input id="password" type="password" name="password" class="form-control" required>
      <label class="error-text">Password minimal harus sepanjang 6 karakter</label>
    </div>

    <div id="confirmPasswordFormGroup" class="form-group">
      <label for="confirmPassword">Konfirmasi Password</label>
      <input id="confirmPassword" type="password" name="confirmPassword" class="form-control" required>
      <label class="error-text">Password dan konfirmasi harus sama</label>
    </div>

    <?php
      if(defined('REGCODE')){
        ?>
          <div class="form-group">
            <label for="regcode">Kode Registrasi</label>
            <input type="password" name="regcode" class="form-control" required>
            <label>Kode registrasi diumumkan di kelas atau dapat ditanyakan di group</label>
          </div>
        <?php
      }
    ?>
    
    <br>
    <button class="btn btn-primary">Daftar <span class="glyphicon glyphicon-list-alt"></span></button>
    <br><br>
    
    <?php
      if($authErrors) echo '<div class="alert alert-danger">'.htmlspecialchars($authErrors).'</div>';
      if($authMessages) echo '<div class="alert alert-info">'.htmlspecialchars($authMessages).'</div>';
    ?>
    
  </form>

</div>

<script>

  var usernameOk = true;

  //event handler onchange, setiap ada perubahan username, cek apakah username sudah terpakai

  function checkUsername(){

    usernameOk = true;
    $('#usernameFormGroup').removeClass('has-error');

    $.ajax({
      method: "GET",
      url: "checkusername.php",
      data: { username: $('#username').val() }

    }).done(function(result){

      //alert(result);

      if(result !== 'available'){
        $('#usernameFormGroup').addClass('has-error');
        usernameOk = false;
      }

    });

  }

  //cek apakah semua data sudah valid sebelum disubmit

  function validateThenSubmit(){

    $('#nimFormGroup').removeClass('has-error');
    $('#passwordFormGroup').removeClass('has-error');
    $('#confirmPasswordFormGroup').removeClass('has-error');

    if(!($.isNumeric($('#nim').val()) && $('#nim').val() >= 16515001 && $('#nim').val() <= 16515500)){
       $('#nimFormGroup').addClass('has-error');
       $('#nim').focus();

    } else if(!usernameOk){
       $('#username').focus();

    } else if($('#password').val().length < 6){
      $('#passwordFormGroup').addClass('has-error');
      $('#password').focus();
      
    } else if($('#password').val() !== $('#confirmPassword').val()){
      $('#confirmPasswordFormGroup').addClass('has-error');
      $('#confirmPassword').focus();

    } else {
      $('.form-register').submit()
    }

    return false;
  }

</script>

<?php include(__DIR__.'/parts/bottom.php'); ?>
