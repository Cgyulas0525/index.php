@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href='/public/css/app.css'>
    @include('layouts.datatables_css')
@endsection

@section('content')
<div class="col-lg-12 col-md-12 col-xs-12">
    <section class="content-header">
        <h1 class="pull-left">Típus</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" title="Felvitel" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('types.create') !!}"><i class="fa fa-plus-square"></i></a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered type-table" style="width: 100%;"></table>
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

            var tTable = $('.type-table').DataTable({
                serverSide: true,
                order: [[0, 'asc']],
                ajax: "{{ route('types.index') }}",
                columns: [
                    {title: 'Név', data: 'nev', name: 'nev'},
                    {title: 'Leírás', data: 'leiras', name: 'leiras'},
                    {title: 'Akció', data: 'action', sClass: "text-center", name: 'action', orderable: false, searchable: false},
                ],
              });
        });
    </script>
@endsection
