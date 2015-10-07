<?php 
  $pageTitle = htmlspecialchars($threadData[0]['title']);
  require(__DIR__.'/../parts/top.php');

  $activeSidebarSection = 'forum';
  require(__DIR__.'/../parts/navigation.php');
?>

<div class="page-container">

  <div class="page-header">
    <h2>
      <a href="<?php echo ROOT_URL.'/forum/threads.php?forum='.filter_var($threadData[0]['forum'], FILTER_SANITIZE_NUMBER_INT); ?>"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <?php echo htmlspecialchars($threadData[0]['title']); ?>
    </h2>

    <div class="thread-actions">
      <?php if($_SESSION['type'] == 'admin' || $_SESSION['id'] == $threadData[0]['author']){ ?>
        <a class="btn btn-xs btn-default" href="<?php echo ROOT_URL.'/forum/thread.php?thread='.filter_var($threadData[0]['id'], FILTER_SANITIZE_NUMBER_INT); ?>">Edit thread <span class="glyphicon glyphicon-pencil"></span></a>
      <?php } ?>

      <?php if(!$threadData[0]['readonly']){ ?>
        <a class="btn btn-xs btn-primary">Post baru <span class="glyphicon glyphicon-plus"></span></a>
      <?php } ?>
    </div>
    
    <div class="callout-list-item" style="margin: 20px 0 10px 0;">
      <?php echo $purifier->purify($threadData[0]['content']); ?>

      <div style="text-align:right;">
        <?php if($threadData[0]['authortype'] == 'admin'){ ?>
            <span class="admin-badge"><?php echo htmlspecialchars($threadData[0]['authorusername']); ?></span>
        <?php } else {
          echo htmlspecialchars($threadData[0]['authorusername']);
        } ?>
        -
        <?php echo getRelativeTime($threadData[0]['lastpost']); ?>
      </div>

    </div>

  </div>

  <!--<div class="callout-list hover" style="margin-top:20px;">

    <?php
      foreach($data as $post){
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
  	
  </div>-->

</div>

<?php require(__DIR__.'/../parts/bottom.php'); ?>
