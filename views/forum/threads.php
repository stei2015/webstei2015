<?php 
  $pageTitle = htmlspecialchars($forumData[0]['name']);
  require(__DIR__.'/../parts/top.php');

  $activeSidebarSection = 'forum';
  require(__DIR__.'/../parts/navigation.php');
?>

<div class="page-container-full">

  <div class="forum-header" style="overflow:hidden; background: url('<?php echo ROOT_URL; ?>/img/backgroundstei2015.jpg') repeat scroll center center / cover #ccc;">
  	<div class="forum-header-text">
      <?php echo htmlspecialchars($forumData[0]['name']); ?>
      <a href="<?php echo ROOT_URL.'/forum/thread.php?thread=new&forum='.filter_var($forumData[0]['id'], FILTER_SANITIZE_NUMBER_INT); ?>" class="btn btn-default btn-header btn-xs">Thread baru <span class="glyphicon glyphicon-plus"></span></a>
    </div>
  </div>

  <div class="callout-list hover" style="margin-top:20px;">

    <?php
      foreach($data as $thread){
        ?>

          <a class="callout-list-item" href="<?php echo ROOT_URL;?>/forum/posts.php?thread=<?php echo filter_var($thread['id'], FILTER_SANITIZE_NUMBER_INT); ?>">
            <div class="callout-list-item-header"><?php echo htmlspecialchars($thread['title']); ?></div>
            <p>
              <?php if($thread['authortype'] == 'admin'){ ?>
                <span class="admin-badge"><?php echo htmlspecialchars($thread['authorusername']); ?></span>
              <?php } else {
                echo htmlspecialchars($thread['authorusername']);
              } ?>
              -
              <?php echo getRelativeTime($thread['lastpost']); ?>
            </p>

            <div class="callout-list-item-icons">
              <?php
                if($thread['sticky']) echo '<span class="glyphicon glyphicon-star"></span>'; 
                if($thread['readonly']) echo '<span class="glyphicon glyphicon-lock"></span>'; 
              ?>
            </div>
          </a>

        <?php
      }
    ?>
  	
  </div>

</div>

<?php require(__DIR__.'/../parts/bottom.php'); ?>
