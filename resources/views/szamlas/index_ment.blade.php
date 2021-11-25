@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="http://tarca.priestago.hu/public/css/app.css">
    <link rel="stylesheet" href="http://tarca.priestago.hu/public/css/datatables.css">
    @include('layouts.costumcss')
@endsection

@section('content')
<div class="col-lg-12 col-md-12 col-xs-12">
    <section class="content-header">
        <h1 class="pull-left oldalcim">Számla</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" title="Felvitel" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('szamlas.create') !!}"><i class="fa fa-plus-square"></i></a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered focsoport-table"></table>
                </div>
            </div>
        </div>
        <div class="text-center"></div>
    </div>
</div>

<div class="col-lg-12 col-md-12 col-xs-12">
    <section class="content-header">
        <h1 class="pull-left">Tétel</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
              <div class="table-responsive">
                  <table class="table table-hover table-bordered dictionaries-table"></table>
              </div>
            </div>
        </div>
        <div class="text-center"></div>
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
              scrollY: 200,
              colReorder: true,
              order: [[1, 'asc'], [2, 'asc']],
              ajax: "{{ route('szamlatetels.index') }}",
              columns: [
                  {title: 'Számla', data: 'szamla', name: 'szamla'},
                  {title: 'Termék', data: 'tnev', name: 'tnev'},
                  {title: 'Költség', data: 'knev', name: 'knev'},
                  {title: 'Áfa %', data: 'afanev', name: 'afanev'},
                  {title: 'Netto', data: 'netto', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'netto'},
                  {title: 'Áfa', data: 'afa', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'afa'},
                  {title: 'Brutto', data: 'brutto', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'brutto'}
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
              scrollY: 200,
              colReorder: true,
              order: [[5, 'desc'],[1, 'asc']],
              ajax: "{{ route('szamlas.index') }}",
              columns: [
                  {title: 'Akció', data: 'action', sClass: "text-center", name: 'action', width:'200px', orderable: false, searchable: false},
                  {title: 'Partner', data: 'pnev', width:'250px', name: 'pnev'},
                  {title: 'Szamlaszám', data: 'szamlaszam', width:'250px', name: 'szamlaszam'},
                  {title: 'Fiz.mód', data: 'fiznev', width:'250px', name: 'fiznev'},
                  {title: 'Összeg', data: 'osszeg', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'150px', name: 'osszeg'},
                  {title: 'Kelt', data: 'kelt', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'kelt'},
                  {title: 'Teljesítés', data: 'teljesites', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'teljesites'},
                  {title: 'Fiz.hat', data: 'fizetesihatarido', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'fizetesihatarido'},
                  {title: 'SzamlaId', data: 'id', name: 'id'},
              ],
              buttons: [],
              columnDefs: [
                    {
                    visible: false,
                    targets: [8]
                    },
                ],
           });

           var nev = 'XXX';

           table.on( 'select', function () {
               var selected = table.row( { selected: true } );
                if ( selected.any() ) {
                    nev = selected.data().id;
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
