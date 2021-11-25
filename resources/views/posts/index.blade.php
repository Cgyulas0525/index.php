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
                        <h1><img src="public/img/menu/partner_40.png"> Post</h1>
                    </section>
                    @include('flash::message')
                    <div class="clearfix"></div>
                    <div class="box box-primary" id="mitis">
                        <div class="box-body"  >
                              <table class="table table-bordered table-hover partners-table"></table>
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
              order: [[1, 'asc']],
              ajax: "{{ route('posts.index') }}",
              columns: [
                  {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('posts.create') !!}"><i class="fa fa-plus-square"></i></a>', 
                    data: 'action', sClass: "text-center", width: '120px', name: 'action', orderable: false, searchable: false},
                  {title: 'Név', data: 'name', name: 'name'},
                  {title: '', data: "image_url", "render": function (data) {
                       return '<img src="/' + data + '" style="height:50px;width:50px;"/>';
                       }
                   },  
              ],
            });
        });

    </script>
@endsection
