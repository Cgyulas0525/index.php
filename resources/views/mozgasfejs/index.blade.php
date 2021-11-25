@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="public/css/datatables.css">
    @include('layouts.costumcss')
@endsection

@section('content')
<div class="col-lg-12 col-md-12 col-xs-12">
    <section class="content-header">
        <h1 class="pull-left oldalcim">Mozgások</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered fej-table" style="width: 100%;"></table>
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
    @include('layouts.RowCallBack_js')

    <script type="text/javascript">
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.fej-table').DataTable({
                serverSide: true,
                scrollY: 350,
                colReorder: true,
                order: [[2, 'desc']],
                ajax: "{{ route('mozgasfejs.index') }}",
                columns: [
                    {title: 'Id', data: 'id', name: 'id'},
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('mozgasfejs.create') !!}"><i class="fa fa-plus-square"></i></a>',
                      data: 'action', sClass: "text-center", name: 'action', orderable: false, searchable: false},
                    {title: 'Dátum', data: 'datum', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'datum'},
                    {title: 'Mozgás', data: 'mozgasnev', name: 'mozgasnev'},
                    {title: 'Partner', data: 'partnernev', name: 'partnernev'},
                    {title: 'Bizonylat', data: 'bizszam', name: 'bizszam'},
                    {title: 'Tétel', data: 'tetel', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'50px', name: 'tetel'},
                ],
                columnDefs: [
                    {
                    visible: false,
                    targets: [0]
                    },
                ],
                fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    RCB(nRow, aData, iDisplayIndex, iDisplayIndexFull);
                },
            });

        });
    </script>
@endsection
