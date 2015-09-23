
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">

    <div class="navbar-header pull-left">
      <a class="navbar-brand" href="#">STEI ITB 2015</a>
    </div>

    <div class="navbar-header pull-right rightmost">
      <ul class="nav navbar-nav pull-right">
        <li class="pull-left">
          <a class="user-display" href="<?php echo ROOT_URL; ?>/studentdata/profile.php">
            <?php echo htmlspecialchars($_SESSION['username']); ?>
            <div class="profile-picture" style="background: url('<?php echo ROOT_URL.'/profilepicture.php?id='.filter_var($_SESSION['id'], FILTER_SANITIZE_NUMBER_INT); ?>') repeat scroll center center / cover #aaa;"></div>
          </a>
        </li>
      </ul>
    </div>

  </div>
</nav>

<div class="sidebar">
  <ul class="nav nav-sidebar">
    <li <?php if($activeSidebarSection == 'forum') echo 'class="active"' ?> >
      <a href="<?php echo ROOT_URL; ?>/forum"><span class="glyphicon glyphicon-th-list"></span><span class="link-text">Forum</span></a>
    </li>
    <li <?php if($activeSidebarSection == 'data') echo 'class="active"' ?> >
      <a href="<?php echo ROOT_URL; ?>/studentdata"><span class="glyphicon glyphicon-list-alt"></span><span class="link-text">Data</span></a>
    </li>
    <li <?php if($activeSidebarSection == 'chat') echo 'class="active"' ?> >
      <a href="<?php echo ROOT_URL; ?>/chat"><span class="glyphicon glyphicon-comment"></span><span class="link-text">Chat</span></a>
    </li>
    <li <?php if($activeSidebarSection == 'files') echo 'class="active"' ?> >
      <a href="<?php echo ROOT_URL; ?>/files"><span class="glyphicon glyphicon-folder-open"></span><span class="link-text">Files</span></a>
    </li>
    <li <?php if($activeSidebarSection == 'kontak') echo 'class="active"' ?> >
      <a href="<?php echo ROOT_URL; ?>/kontak.php"><span class="glyphicon glyphicon-phone"></span><span class="link-text">Kontak</span></a>
    </li>
  </ul>

  <ul class="nav nav-sidebar right">
    <li><a href="<?php echo ROOT_URL; ?>/logout.php"><span class="glyphicon glyphicon-log-out"></span><span class="link-text">Logout</span></a></li>
  </ul>
</div>