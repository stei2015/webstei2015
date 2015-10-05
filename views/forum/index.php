<?php 
  $pageTitle = 'Forum';
  require(__DIR__.'/../parts/top.php');

  $activeSidebarSection = 'forum';
  require(__DIR__.'/../parts/navigation.php');
?>

<div class="page-container-full">

  <div class="forum-header" style="overflow:hidden; background: url('<?php echo ROOT_URL; ?>/img/backgroundstei2015.jpg') repeat scroll center center / cover #ccc;">
  	<div style="color: #fff; font-size: 28px; font-weight: 700; margin: 100px 20px 20px 20px;">Forum STEI ITB 2015</div>
  </div>

  <div class="callout-list hover" style="margin-top:20px;">

    <?php
      foreach($data as $forum){
        ?>

          <a class="callout-list-item" href="<?php echo ROOT_URL;?>/forum/threads.php?forum=<?php echo filter_var($forum['id'], FILTER_SANITIZE_NUMBER_INT); ?>">
            <div class="callout-list-item-header"><?php echo htmlspecialchars($forum['name']); ?></div>
            <p><?php echo htmlspecialchars($forum['description']); ?></p>
          </a>

        <?php
      }
    ?>
  	
  </div>

</div>

<?php require(__DIR__.'/../parts/bottom.php'); ?>
