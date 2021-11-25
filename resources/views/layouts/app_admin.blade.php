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
  <div class="content-wrapper">
    <section class="content">
      <main class="container-fluid">
          @include('partials.errors')
          @include('partials.success')

          @yield('content')
      </main>
    </section>
    <!-- /.content -->
  </div>
  <aside class="control-sidebar control-sidebar-dark" style="display: none;">
    @include('admin_control_sidebar')
  </aside>
  <div class="control-sidebar-bg"></div>-->

</div>

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css') }}">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css') }}">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>

<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
/* Product scripts */
  $('#productedit').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var nev = button.data('mynev')
  var leiras = button.data('myleiras')
  var id = button.data('myid')

  var modal = $(this)
  modal.find('.modal-body #product-nev').val(nev);
  modal.find('.modal-body #product-leiras').val(leiras);
  modal.find('.modal-body #product-id').val(id);
  })

$('#productdelete').on('show.bs.modal', function (event) {
     var button = $(event.relatedTarget)
     var id = button.data('myid')
     var modal = $(this)
     modal.find('.modal-body #product-id').val(id);
})

/* Type scripts */
  $('#typeedit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var nev = button.data('mynev')
    var leiras = button.data('myleiras')
    var id = button.data('myid')

    var modal = $(this)
    modal.find('.modal-body #type-nev').val(nev);
    modal.find('.modal-body #type-leiras').val(leiras);
    modal.find('.modal-body #type-id').val(id);
  })

  $('#typedelete').on('show.bs.modal', function (event) {
     var button = $(event.relatedTarget)
     var id = button.data('myid')
     var modal = $(this)
     modal.find('.modal-body #type-id').val(id);
  })

</script>
</body>

</html>
