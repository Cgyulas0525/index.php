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
                        <h1><img src="public/img/menu/partner_40.png"> Partner</h1>
                        <ol class="breadcrumb">
                        <li><a href="{{ route('home') }}"><img src="public/img/menu/dashboard_25.png"> Vezérlő pult</a></li>
                        <li class="active"><img src="public/img/menu/crm_25.png"> CRM</li>
                        <li class="active"><img src="public/img/menu/partner_25.png"> Partner</li>
                        </ol>
                    </section>
                    @include('flash::message')
                    <div class="clearfix"></div>
                    <div class="panel-body">
                        <form id="search-form" class="form-inline">
                            <div class="form-group text-center">
                                <label style="height:30px;font-weight: bold;font-size:15px; font-family: 'Palatino, URW Palladio L, serif'" for="title">Típus:</label>
                                {!! Form::select('tipus', [""] + \App\Models\Dictionary::where('tipus', '=', '24')->orderBy('nev')->pluck('nev', 'nev')->toArray(), null,['class'=>'select2 form-control', 'id' => 'tipus', 'style=height:30px;width:150px;font-size:12px;']) !!}
                            </div>
                        </form>
                    </div>
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
              ajax: "{{ route('partners.index') }}",
              columns: [
                  {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('partners.create') !!}"><i class="fa fa-plus-square"></i></a>',
                    data: 'action', sClass: "text-center", width: '120px', name: 'action', orderable: false, searchable: false},
                  {title: 'Név', data: 'nev', width:'250px', name: 'nev'},
                  {title: 'Típus', data: 'tipusnev', width:'120px', name: 'tipusnev'},
                  {title: 'Adószám', width: '200px', data: 'adoszam', width:'120px', sClass: "text-center", name: 'adoszam'},
                  {title: 'Bankszámla', data: 'bankszamla', width:'200px', sClass: "text-center", name: 'bankszamla'},
                  {title: 'Cím', width:'320px', data: 'partnercim', name: 'partnercim'},
                  {title: 'Email', width:'120px', data: 'email', name: 'email'},
                  {title: 'Telefonszám', width:'120px', data: 'telefonszam', name: 'telefonszam'},
                  {title: 'Megjegyzés', data: 'megjegyzes', name: 'megjegyzes'},
                  {title: 'TelepülésId', data: 'telepules', name: 'telepules'},
              ],
              columnDefs: [
                  {
                      targets: [8, 9],
                      visible: false,
                      searchable: true
                  }
              ]
            });

            $('#tipus').change(function(e){
                var tipus = $('#tipus').val();
                if (tipus != '0'){
                    table.column(2).search(tipus).draw();
                }else{
                    table.column(2).search("").draw();
                }
                e.preventDefault();
            });

        });

    </script>
@endsection
