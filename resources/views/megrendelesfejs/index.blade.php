@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="public/css/datatables.css">
    @include('layouts.costumcss')
@endsection

@section('content')
<div class="col-lg-12 col-md-12 col-xs-12">
    <section class="content-header">
        <h1 class="pull-left">Megrendelés</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered fej-table"  style="width: 100%;"></table>
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
                order: [[0, 'desc']],
                ajax: "{{ route('megrendelesfejs.index') }}",
                columns: [
                    {title: 'Id', data: 'id', name: 'id'},
                    {title: 'Megrendelés szám', data: 'megrendelesszam', name: 'megrendelesszam'},
                    {title: 'Dátum', data: 'datum', name: 'datum'},
                    {title: 'Partner', data: 'nev', name: 'nev'},
                    {title: 'Érték', data: 'ertek', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'ertek'},
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('megrendelesfejs.create') !!}"><i class="fa fa-plus-square"></i></a>',
                      data: 'action', sClass: "text-center", name: 'action', orderable: false, searchable: false},
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


