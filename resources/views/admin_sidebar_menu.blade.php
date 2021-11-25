<?php
use Illuminate\Support\Facades\Auth;
?>

    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="img/Gyula.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <?php
        if (Auth::check()) {
             $user = Auth::user()->name;
        } else {
             $user = 'PriestAgo';
        };
        ?>
        <p>{{$user}}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Keres...">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MENŰ</li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-server"></i>
          <span>Szótár</span>
          <span class="pull-right-container">
            <span class="label label-primary pull-right">4</span>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a class="nav-link" href="{{ route('type.index') }}"><i class="fa fa-circle-o"></i> Típusok</a></li>
          <li><a class="nav-link" href="#"><i class="fa fa-circle-o"></i> Szótárok</a></li>
          <li><a class="nav-link" href="{{ route('product.index') }}"><i class="fa fa-circle-o"></i> Termékek</a></li>
          <li><a class="nav-link" href="#"><i class="fa fa-circle-o"></i> Partnerek</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-link"></i>
          <span>Folyamatok</span>
          <span class="pull-right-container">
            <span class="label label-primary pull-right">3</span>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a class="nav-link" href="#"><i class="fa fa-circle-o"></i> Ajánlatok</a></li>
          <li><a class="nav-link" href="#"><i class="fa fa-circle-o"></i> Látogatások</a></li>-->
          <li><a class="nav-link" href="#"><i class="fa fa-circle-o"></i> Szerződések</a></li>-->
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-balance-scale"></i>
          <span>Elszámolások</span>
          <span class="pull-right-container">
            <span class="label label-primary pull-right">2</span>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a class="nav-link" href="#"><i class="fa fa-circle-o"></i> Jutalékok</a></li>
          <li><a class="nav-link" href="#"><i class="fa fa-circle-o"></i> Számlák</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-balance-scale"></i>
          <span>Betöltések</span>
          <span class="pull-right-container">
            <span class="label label-primary pull-right">1</span>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a class="nav-link" href="{{ route('szamlaexcel.index') }}"><i class="fa fa-circle-o"></i> Számlák</a></li>
        </ul>
      </li>

    </ul>
<!-- /.sidebar -->
