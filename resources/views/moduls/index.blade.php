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
                        <h4><img src={{ URL::asset('/public/img/menu/modul_40.jpg')}}> Modul</h4>
                        <ol class="breadcrumb" style="float:right;">
                            <li><a href="{{ route('home') }}"><img src="public/img/menu/dashboard_25.png"> Főoldal</a></li>
                            <li class="active"><img src="public/img/menu/modul_25.jpg"> Modul</li>
                        </ol>
                    </section>
                    @include('flash::message')
                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body"  >
                            <table class="table table-hover table-bordered partners-table" style="width: 100%;"></table>
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

            var table = $('.partners-table').DataTable({
                serverSide: true,
                scrollY: 390,
                scrollX: true,
                order: [[1, 'asc']],
                ajax: "{{ route('moduls.index') }}",
                columns: [
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('moduls.create') !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", width: '200px', name: 'action', orderable: false, searchable: false},
                    {title: 'Név', data: 'nev', name: 'nev'},
                    {title: 'Szűrő', data: 'szurodarab', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'150px', name: 'szurodarab'},
                    {title: 'Lista', data: 'listadarab', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'150px', name: 'listadarab'},
                    {title: 'Időszak', data: 'idoszakdarab', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'150px', name: 'idoszakdarab'},
                    {title: 'Megjegyzés', data: 'megjegyzes', name: 'megjegyzes'},
                ]
            });

        });
    </script>
@endsection


