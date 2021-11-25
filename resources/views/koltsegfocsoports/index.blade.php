@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="http://tarca.priestago.hu/public/css/app.css">
    <link rel="stylesheet" href="http://tarca.priestago.hu/public/css/datatables.css">
    @include('layouts.costumcss')
@endsection

@section('content')
<div class="col-lg-6 col-md-6 col-xs-12">
    <section class="content-header">
        <h1 class="pull-left">Főcsoport</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" title="Felvitel" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('koltsegfocsoports.create') !!}"><i class="fa fa-plus-square"></i></a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover focsoport-table"></table>
                </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
</div>

<div class="col-lg-6 col-md-6 col-xs-12">

    <section class="content-header">
        <h1 class="pull-left">Csoport</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
              <div class="table-responsive">
                  <table class="table table-bordered table-hover dictionaries-table" style="width: 100%;"></table>
              </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
</div>
@endsection

@section('scripts')
    @include('layouts.datatables_js')

    <script type="text/javascript">
        $(function () {

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          var oTable = $('.dictionaries-table').DataTable({
              serverSide: true,
              scrollY: 350,
              colReorder: true,
              order: [[0, 'asc'], [1, 'asc']],
              ajax: "{{ route('koltsegcsoports.index') }}",
              columns: [
                  {title: 'Főcsoport', data: 'tnev', name: 'tnev'},
                  {title: 'Név', data: 'nev', name: 'nev'},
                  {title: 'Megjegyzés', data: 'megjegyzes', name: 'megjegyzes'},
                  {title: 'Akció', data: 'action', sClass: "text-center", name: 'action', orderable: false, searchable: false},
              ],
              columnDefs: [
                    {
                    visible: false,
                    targets: [0]
                    },
                ],
            });


          var table = $('.focsoport-table').DataTable({
              serverSide: true,
              scrollY: 350,
              colReorder: true,
              order: [[0, 'asc']],
              ajax: "{{ route('koltsegfocsoports.index') }}",
              columns: [
                  {title: 'Név', data: 'nev', width:'137px', name: 'nev'},
                  {title: 'Megjegyzés', data: 'megjegyzes', width:'250px', name: 'megjegyzes'},
                  {title: 'Akció', data: 'action', sClass: "text-center", name: 'action', width:'90px', orderable: false, searchable: false},
              ],
           });

           var nev = 'XXX';

           table.on( 'select', function () {
               var selected = table.row( { selected: true } );
                if ( selected.any() ) {
                    nev = selected.data().nev;
                }

               oTable.column(0).search(nev).draw();
               e.preventDefault();
           } );

           table.on( 'deselect', function () {
               nev = 'XXX';
               oTable.column(0).search(nev).draw();
               e.preventDefault();
           } );

           oTable.column(0).search(nev).draw();

        });

    </script>
@endsection
