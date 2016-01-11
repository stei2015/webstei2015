<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">

    <div class="navbar-header pull-left">
      <a class="navbar-brand" href="#">STEI ITB 2015</a>
    </div>

    <div class="navbar-header pull-right rightmost">
      <ul class="nav navbar-nav pull-right">
        <li class="pull-left">
          <a class="user-display" href="{{ url('studentdata/'.auth()->user()['nim']) }}">
            {{ auth()->user()['username'] }}
            <div class="profile-picture" style="background: url('{{ url('profilepictures/'.auth()->user()['nim']) }}') repeat scroll center center / cover #aaa;"></div>
          </a>
        </li>
      </ul>
    </div>

  </div>
</nav>

<div class="sidebar">
  <ul class="nav nav-sidebar">
    <li @if ($activeSection == 'forum') class="active" @endif>
      <a href="{{ url('forum') }}"><span class="glyphicon glyphicon-th-list"></span><span class="link-text">Forum</span></a>
    </li>
    <li @if ($activeSection == 'studentdata') class="active" @endif>
      <a href="{{ url('studentdata') }}"><span class="glyphicon glyphicon-list-alt"></span><span class="link-text">Data</span></a>
    </li>
    <li @if ($activeSection == 'files') class="active" @endif>
      <a href="{{ url('files') }}"><span class="glyphicon glyphicon-folder-open"></span><span class="link-text">Files</span></a>
    </li>
    <li @if ($activeSection == 'contact') class="active" @endif>
      <a href="{{ url('contact') }}"><span class="glyphicon glyphicon-phone"></span><span class="link-text">Kontak</span></a>
    </li>
    <li @if ($activeSection == 'events') class="active" @endif>
      <a href="{{ url('events') }}"><span class="glyphicon glyphicon-calendar"></span><span class="link-text">Events</span></a>
    </li>
  </ul>

  <ul class="nav nav-sidebar right">
    <li><a href="{{ url('logout') }}"><span class="glyphicon glyphicon-log-out"></span><span class="link-text">Logout</span></a></li>
  </ul>
</div>