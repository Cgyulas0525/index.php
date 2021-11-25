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
            <a class="btn btn-warning pull-right idei" title="Idei" style="margin-top: -10px;margin-bottom: 5px" href="#"><i class="glyphicon glyphicon-list-alt"></i></a>
            <a class="btn btn-warning pull-right szures" title="Szűrés" style="margin-top: -10px;margin-bottom: 5px" href="#"><i class="glyphicon glyphicon-filter"></i></a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-hover table-bordered focsoport-table"></table>
            </div>
        </div>
        <div class="text-center"></div>
    </div>
</div>
@endsection

@section('scripts')
    @include('layouts.datatables_js')
    @include('layouts.RowCallBack_js')

    <script type="text/javascript">
        $(function () {

            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.focsoport-table').DataTable({
                serverSide: true,
                scrollY: 375,
                order: [[5, 'desc'],[1, 'asc']],
                ajax: "{{ route('szamlas.index') }}",
                columns: [
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('szamlas.create') !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", width: '200px', name: 'action', orderable: false, searchable: false},
                    {title: 'Partner', data: 'pnev', width:'250px', name: 'pnev'},
                    {title: 'Szamlaszám', data: 'szamlaszam', width:'150px', name: 'szamlaszam'},
                    {title: 'Fiz.mód', data: 'fiznev', width:'150px', name: 'fiznev'},
                    {title: 'Összeg', data: 'osszeg', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'150px', name: 'osszeg'},
                    {title: 'Kelt', data: 'kelt', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'kelt'},
                    {title: 'Teljesítés', data: 'teljesites', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'teljesites'},
                    {title: 'Fiz.hat', data: 'fizetesihatarido', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'fizetesihatarido'},
                    {title: 'Bev.biz', data: 'bizonylatszam', width:'100px', name: 'bizonylatszam'},
                    {title: 'Tétel', data: 'tetelszam', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'50px', name: 'tetelszam'},
                    {title: 'SzamlaId', data: 'id', name: 'id'},
                ],
                buttons: [],
                columnDefs: [
                    {
                        visible: false,
                        targets: [10]
                    },
                ],
                fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    RCB(nRow, aData, iDisplayIndex, iDisplayIndexFull);
                },
            });

            $('.szures').click(function () {
                var url = '{{ route('szamlaFeldolgozott') }}';
                urlChange(table, url);
            });

            $('.idei').click(function () {
                var url = '{{ route('szamlaIdei') }}';
                urlChange(table, url);
            });

        });

    </script>
@endsection
