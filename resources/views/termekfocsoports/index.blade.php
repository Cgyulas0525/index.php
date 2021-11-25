@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="http://tarca.priestago.hu/public/css/app.css">
    <link rel="stylesheet" href="http://tarca.priestago.hu/public/css/datatables.css">
    @include('layouts.costumcss')
@endsection

@section('content')
    <div class="col-lg-12 col-md-12 col-xs-12">
        <section class="content-header">
            <h1 class="pull-left">Főcsoport</h1>
            <h1 class="pull-right">
               <a class="btn btn-primary pull-right" title="Felvitel" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('termekfocsoports.create') !!}"><i class="fa fa-plus-square"></i></a>
            </h1>
        </section>
        <div class="content">
            <div class="clearfix"></div>

            @include('flash::message')

            <div class="clearfix"></div>
            <div class="box box-primary">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered focsoport-table" style="width: 100%;"></table>
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

            var table = $('.focsoport-table').DataTable({
                serverSide: true,
                scrollY: 350,
                colReorder: true,
                order: [[0, 'asc']],
                ajax: "{{ route('termekfocsoports.index') }}",
                columns: [
                    {title: 'Név', data: 'nev', name: 'nev'},
                    {title: 'Megjegyzés', data: 'megjegyzes', name: 'megjegyzes'},
                    {title: 'T/SZ', data: 'tsz', name: 'tsz'},
                    {title: '', data: "fokep", sClass: "text-center",  "render": function (data) {
                            if ( data == null ) {
                                return '<img src="public/img/nincskep.png" style="height:40px;width:40px;object-fit:cover;"/>';
                            }
                            return '<img src="' + data + '" style="height:40px;width:40px;object-fit:cover;"/>';
                        }
                    },
                    {title: 'Akció', data: 'action', sClass: "text-center", name: 'action', width:'140px', orderable: false, searchable: false},
                ],
            });
        });

    </script>
@endsection
