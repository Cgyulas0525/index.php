<!DOCTYPE html>
<html>
<head>
  @include('admin_head')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
      @include('admin_top_menu')
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <section class="sidebar">
        @include('admin_sidebar_menu')
    </section>
  </aside>
  @include('admin_content')
  @include('admin_foot')

  <aside class="control-sidebar control-sidebar-dark" style="display: none;">
    @include('admin_control_sidebar')
  </aside>
  <div class="control-sidebar-bg"></div>-->
</div>
@include('admin_script')
</body>
</html>
