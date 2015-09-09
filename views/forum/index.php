<?php 
  $pageTitle = 'Forum';
  include(__DIR__.'/../parts/top.php');

  $activeSidebarSection = 'forum';
  include(__DIR__.'/../parts/navigation.php');
?>

<div class="page-container-full">

  <div class="forum-header" style="overflow:hidden; background: url('<?php echo ROOT_URL; ?>/img/backgroundstei2015.jpg') repeat scroll center center / cover #ccc;">
  	<div style="color: #fff; font-size: 28px; font-weight: 700; margin: 100px 20px 20px 20px;">Forum STEI ITB 2015</div>
  </div>

  <div style="margin:20px;">
  	<h1>Coming soon!</h1>

  	<a href="<?php echo ROOT_URL; ?>/studentdata/edit.php">Edit data diri</a>  
	<br>
	<a href="<?php echo ROOT_URL; ?>/studentdata/editprofilepicture.php">Edit foto profil</a>
  </div>

</div>

<?php include(__DIR__.'/../parts/bottom.php'); ?>
