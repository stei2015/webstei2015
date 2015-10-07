<?php 
  $pageTitle = 'Edit Thread';
  require(__DIR__.'/../parts/top.php');

  $activeSidebarSection = 'forum';
  require(__DIR__.'/../parts/navigation.php');
?>

<div class="page-container">

  <div class="page-header">
    <h1><?php echo ($thread == 'new' ? 'Thread Baru' : 'Edit Thread'); ?></h1>
  </div>

  <form method="POST">

    <input type="hidden" name="forum" value="<?php echo htmlspecialchars($forum); ?>">
    
    <div class="form-group">
      <label for="title" class="sr-only">Judul</label>
      <input type="text" name="title" class="form-control" required value="<?php if(isset($data)) echo htmlspecialchars($data[0]['title']); ?>" placeholder="Judul Thread"/>
    </div>

    <div class="form-group">
      <textarea id="contenteditor" name="content" rows="12">
        <?php if(isset($data)) echo htmlspecialchars($data[0]['content']); ?>
      </textarea>
    </div>

     <?php if($changeStickyReadonly){ ?>

      <div class="checkbox">
        <label>
          <input name="readonly" type="checkbox" <?php if(isset($data) && $data[0]['readonly']) echo 'checked'; ?> > Read-only
        </label>
      </div>

      <div class="checkbox">
        <label>
          <input name="sticky" type="checkbox" <?php if(isset($data) && $data[0]['sticky']) echo 'checked'; ?> > Sticky
        </label>
      </div>

    <?php } ?>

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
