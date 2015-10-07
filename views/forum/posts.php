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
        <a class="btn btn-xs btn-primary" href="<?php echo ROOT_URL.'/forum/post.php?post=new&thread='.filter_var($threadData[0]['id'], FILTER_SANITIZE_NUMBER_INT); ?>">Post baru <span class="glyphicon glyphicon-plus"></span></a>
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
        <?php if(!$threadData[0]['readonly'] && ($threadData[0]['author'] == $_SESSION['id'] || $_SESSION['type'] == 'admin')){ ?>
          -
          <a href="<?php echo ROOT_URL.'/forum/thread.php?thread='.filter_var($threadData[0]['id'], FILTER_SANITIZE_NUMBER_INT); ?>"><span class="glyphicon glyphicon-pencil"></span></a>
        <?php } ?>
      </div>

    </div>

  </div>

  <div class="callout-list" style="margin: 0 -20px;">

    <?php
      foreach($data as $post){
        ?>

          <div class="callout-list-item">
            
            <?php echo $purifier->purify($post['content']); ?>

            <div style="text-align:right;">
              <?php if($post['authortype'] == 'admin'){ ?>
                <span class="admin-badge"><?php echo htmlspecialchars($post['authorusername']); ?></span>
                -
                <?php echo getRelativeTime($post['posttime']); ?>
              <?php } else {
                echo htmlspecialchars($post['authorusername']).' - '.getRelativeTime($post['posttime']);
              } ?>

              <?php if(!$threadData[0]['readonly'] && ($post['author'] == $_SESSION['id'] || $_SESSION['type'] == 'admin')){ ?>
                -
                <a href="<?php echo ROOT_URL.'/forum/post.php?post='.filter_var($post['id'], FILTER_SANITIZE_NUMBER_INT); ?>"><span class="glyphicon glyphicon-pencil"></span></a>
              <?php } ?>
            </div>

          </div>

        <?php
      }
    ?>
  	
  </div>

</div>

<?php require(__DIR__.'/../parts/bottom.php'); ?>
