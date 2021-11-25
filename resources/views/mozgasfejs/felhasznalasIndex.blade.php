@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="public/css/datatables.css">
    @include('layouts.costumcss')
@endsection

@section('content')
<div class="col-lg-12 col-md-12 col-xs-12">
    <section class="content-header">
        <h1 class="pull-left">Felhasználás</h1>
        <h1 class="pull-right">
            <a class="btn btn-success pull-right" title="Felhasználás" href="{!! route('KIVET') !!}"><i class="fa fa-calculator"></i></a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered fej-table"></table>
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
                ajax: "{{ route('felhasznalasIndex') }}",
                columns: [
                    {title: 'Id', data: 'id', name: 'id'},
                    {title: 'Dátum', data: 'datum', name: 'datum'},
                    {title: 'Partner', data: 'nev', name: 'nev'},
                    {title: 'Bizonylat', data: 'bizszam', name: 'bizszam'},
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('FC') !!}"><i class="fa fa-plus-square"></i></a>', 
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
