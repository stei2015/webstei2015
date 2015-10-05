<?php 
  $pageTitle = htmlspecialchars($forumData[0]['name']);
  require(__DIR__.'/../parts/top.php');

  $activeSidebarSection = 'forum';
  require(__DIR__.'/../parts/navigation.php');
?>

<div class="page-container-full">

  <div class="forum-header" style="overflow:hidden; background: url('<?php echo ROOT_URL; ?>/img/backgroundstei2015.jpg') repeat scroll center center / cover #ccc;">
  	<div style="color: #fff; font-size: 28px; font-weight: 700; margin: 100px 20px 20px 20px;"><?php echo htmlspecialchars($forumData[0]['name']); ?></div>
  </div>

  <div class="callout-list hover" style="margin-top:20px;">

    <?php
      foreach($data as $thread){
        ?>

          <a class="callout-list-item" href="<?php echo ROOT_URL;?>/forum/posts.php?thread=<?php echo filter_var($thread['id'], FILTER_SANITIZE_NUMBER_INT); ?>">
            <div class="callout-list-item-header"><?php echo htmlspecialchars($thread['title']); ?></div>
            <p><?php echo htmlspecialchars($thread['author']); ?></p>
          </a>

        <?php
      }
    ?>
  	
  </div>

</div>

<?php require(__DIR__.'/../parts/bottom.php'); ?>
