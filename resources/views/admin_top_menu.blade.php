<?php
use Illuminate\Support\Facades\Auth;
?>


<a href="{{ url('/admin') }}" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><img src="img/pa_32.jpg" class="img-circle" alt="User Image"></span>
  <!-- logo for regular state and mobile devices -->

  <span class="logo-lg"><img src="img/pa_32.jpg" class="img-circle" alt="User Image"><b>PriestAgo</span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Váltás a navigációhoz</span>
  </a>

  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- Messages: style can be found in dropdown.less-->
      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">

          <img src="img/Gyula.png" class="user-image" alt="User Image">
           <span class="hidden-xs">Cseszneki Gyula</span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <?php
            if (Auth::check()) {
                 $user = Auth::user()->name;
            } else {
                 $user = 'PriestAgo';
            };
            ?>
            <img src="img/Gyula.png" class="user-image" alt="User Image">
            <p>
              {{$user}} - Web Developer
              <small>tulajdos, ügyvezető</small>
            </p>
          </li>
          <!-- Menu Body -->
          <li class="user-body">
            <div class="row">
              <div class="col-xs-4 text-center">
                <a href="#">Követők</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Partnerek</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Barátok</a>
              </div>
            </div>
            <!-- /.row -->
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="#" class="btn btn-default btn-flat">Profil</a>
            </div>
            <div class="pull-right">
              <a href="#" class="btn btn-default btn-flat">Kijelentkezés</a>
            </div>
          </li>
        </ul>
      </li>
      <!-- Control Sidebar Toggle Button -->
      <li>
        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
      </li>
    </ul>
  </div>
