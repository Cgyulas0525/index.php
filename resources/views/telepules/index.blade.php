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
                        <h1><img src="public/img/menu/telepules_40.png"> Település</h1>
                        <ol class="breadcrumb">
                        <li><a href="{{ route('home') }}"><img src="public/img/menu/dashboard_25.png"> Vezérlő pult</a></li>
                        <li class="active"><img src="public/img/menu/telepules_25.png"> Település</li>
                        </ol>
                        <form id="header-form" class="form-inline" >
                            <h3 class="pull-right" style="margin-top: -2px;">
                                <a class="btn btn-primary pull-right" title="Felvitel" href="{!! route('telepules.create') !!}" style="margin-left: 5px;"><i class="fa fa-plus-square"></i></a>
                            </h3>
                        </form>
                    </section>
                    @include('flash::message')
                    <div class="clearfix"></div>
                    <div class="box box-primary" id="mitis">
                        <div class="box-body"  >
                              <table class="table table-hover table-bordered partners-table" style="width: 100%;"></table>
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
              processing: true,
              serverSide: true,
              paging: true,
              scrollY: 475,
              order: [[1, 'asc'], [2, 'asc']],
              ajax: "{{ route('telepules.index') }}",
              deferRender: true,
              columns: [
                  {title:  'Akció', data: 'action', sClass: "text-center", name: 'action', width:'100px', orderable: false, searchable: false},
                  {title: 'Isz', data: 'iranyitoszam', sClass: "text-center", name: 'iranyitoszam'},
                  {title: 'Település', data: 'telepules', name: 'telepules'},
                  {title: 'Megye', data: 'megye', name: 'megye'},
                  {title: 'Járás', data: 'jaras', name: 'jaras'},
              ],
            });

        });

    </script>
@endsection
