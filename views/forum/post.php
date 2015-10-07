<?php 
  $pageTitle = 'Edit Post';
  require(__DIR__.'/../parts/top.php');

  $activeSidebarSection = 'forum';
  require(__DIR__.'/../parts/navigation.php');
?>

<div class="page-container">

  <div class="page-header">
    <h1><?php echo ($post == 'new' ? 'Post Baru' : 'Edit Post'); ?></h1>
  </div>

  <form method="POST">

    <input type="hidden" name="thread" value="<?php echo htmlspecialchars($thread); ?>">

    <div class="form-group">
      <textarea id="contenteditor" name="content" rows="12">
        <?php if(isset($data)) echo htmlspecialchars($data[0]['content']); ?>
      </textarea>
    </div>

    <button class="btn btn-primary">Simpan <span class="glyphicon glyphicon-check"></span></button>
    <br>

  </form>

</div>

<script src="<?php echo ROOT_URL; ?>/js/ckeditor/ckeditor.js"></script>
<script>
  window.onload = function(){
    CKEDITOR.replace('contenteditor');
  };
</script>

<?php require(__DIR__.'/../parts/bottom.php'); ?>
