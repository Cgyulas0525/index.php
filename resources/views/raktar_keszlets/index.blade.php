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
                        <h1><img src="public/img/menu/raktar_40.jpg"> Raktár készlet</h1>
                        <ol class="breadcrumb">
                        <li><a href="{{ route('home') }}"><img src="public/img/menu/dashboard_25.png"> Vezérlő pult</a></li>
                        <li class="active"><img src="public/img/menu/km_25.jpg"> Készlet mozgás</li>
                        <li class="active"><img src="public/img/menu/raktar_25.jpg"> Raktár készlet</li>
                        </ol>
                    </section>
                    @include('flash::message')
                    <div class="clearfix"></div>
                    <div class="box box-primary" id="mitis">
                        <div class="box-body"  >
                              <table class="table table-bordered table-hover partners-table" style="width: 100%;"></table>
                          </div>
                    </div>
                    <div class="text-center"></div>
                </div>
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
              scrollY: 375,
              order: [[1, 'asc'], [2, 'asc']],
              ajax: "{{ route('raktarKeszlets.index') }}",
              columns: [
                  {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('raktarKeszlets.create') !!}"><i class="fa fa-plus-square"></i></a>',
                    data: 'action', sClass: "text-center", width: '120px', name: 'action', orderable: false, searchable: false},
                  {title: 'Raktár', data: 'raktarnev', name: 'raktarnev'},
                  {title: 'Termék', data: 'termeknev', name: 'termeknev'},
                  {title: 'Mennyiség', data: 'mennyiseg', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'mennyiseg'}
              ],
            });

        });

    </script>
@endsection

