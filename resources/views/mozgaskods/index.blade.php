@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="public/css/datatables.css">
    <link rel="stylesheet" href="public/css/Highcharts.css">
    @include('layouts.costumcss')
@endsection

@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary" >
            <div class="box-body">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <section class="content-header">
                        <h1><img src="public/img/menu/mozgaskod_40.jpg"> Mozgáskód</h1>
                        <ol class="breadcrumb">
                        <li><a href="{{ route('home') }}"><img src="public/img/menu/dashboard_25.png"> Vezérlő pult</a></li>
                        <li class="active"><img src="public/img/menu/km_25.png"> Készlet mozgás</li>
                        <li class="active"><img src="public/img/menu/mozgaskod_25.jpg"> Mozgáskód</li>
                        </ol>
                    </section>
                    @include('flash::message')
                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body"  >
                            <table class="table table-bordered table-hover fej-table" style="width:100%;"></table>
                        </div>
                    </div>
                    <div class="text-center"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('layouts.datatables_js')
    @include('layouts.RowCallBack_js')
    @include('layouts.highcharts_js')

    <script type="text/javascript">
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.fej-table').DataTable({
                serverSide: true,
                scrollY: 390,
                scrollX: true,
                order: [[0, 'asc']],
                ajax: "{{ route('mozgaskods.index') }}",
                columns: [
                    {title: 'Név', data: 'nev', name: 'nev'},
                    {title: 'Prefix', data: 'prefix', name: 'prefix'},
                    {title: 'Honnan', data: 'honnannev', name: 'honnannev'},
                    {title: 'Hova', data: 'hovanev', name: 'hovanev'},
                    {title: 'P/M', data: 'pmnev', name: 'pmnev'},
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('mozgaskods.create') !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", name: 'action', orderable: false, searchable: false},
                ],
                fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    RCB(nRow, aData, iDisplayIndex, iDisplayIndexFull);
                },
            });

        });
    </script>
@endsection

