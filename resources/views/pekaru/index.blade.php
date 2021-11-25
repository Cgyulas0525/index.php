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
                        <h1 class="oldalcim"><img src="public/img/menu/pekaru_40.png"><a id="fejszoveg"> Pékáru</a>
                            <h4>
                                <div class="col-sm-12">
                                    <div class="mylabel3 col-sm-1">
                                        {!! Form::label('gyarto', 'Gyártó:') !!}
                                    </div>
                                    <div class="mylabel3 col-sm-4">
                                        {!! Form::select('gyarto', App\Classes\DDW::peksegDdw(), null,['class'=>'select2 form-control', 'id' => 'gyarto']) !!}
                                    </div>
                                </div>
                            </h4>
                       </h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('home') }}"><img src="public/img/menu/dashboard_25.png"> Vezérlő pult</a></li>
                            <li class="active"><img src="public/img/menu/pekaru_25.png"> Pékáru</li>
                            <li class="active"><img src="public/img/menu/pekaru_25.png"> Pékáru</li>
                        </ol>
                    </section>
                    @include('flash::message')
                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body"  >
                              <table class="table table-hover table-bordered partners-table" style="width: 100%;"></table>
                              <button id="mind" title="Minden tétel" ><img src="public/img/chart/sum.png"></button>
                              <button id="minkesz" title="Minimális" ><img src="public/img/chart/costumer-token.png"></button>
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
    @include('functions.ajax_js')
    @include('functions.apis.getPartner')

    <script type="text/javascript">
        $(function () {

          var printHeader = '<h1><center>Szerződések lista</center></h1>';

          ajaxSetup();

          var oTable = $('.partners-table').DataTable({
              serverSide: true,
              scrollY: 300,
              order: [[1, 'asc']],
              paging: false,
              ajax: "{{ route('pekaru.index') }}",
              columns: [
                  {title: 'Akció', data: 'action', sClass: "text-center", name: 'action', width:'100px', orderable: false, searchable: false},
                  {title: 'Név', data: 'nev', width:'250px', name: 'nev'},
                  {title: 'Cikkszám', data: 'cikkszam', width:'120px', name: 'cikkszam'},
                  {title: 'Mennyiségi egység', data: 'menev', sClass: "text-center", name: 'menev'},
                  {title: 'Mennyiség', data: 'mennyiseg', width:'80px', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'mennyiseg'},
                  {title: 'Minimális', data: 'minmenny', width:'80px', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'minmenny'},
                  {title: 'Ár', data: 'ar', width:'80px', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'ar'},
                  {title: 'Gyártó', data: 'pnev', width:'200px', name: 'pnev'},
                  {title: 'Megjegyzés', data: 'megjegyzes', name: 'megjegyzes'},
              ],
              buttons: []
            });

            $('#mind').click(function () {
                printHeader = '<h1><center>Pékáru lista</center></h1>';
                urlChange("{{ route('pekaru.index') }}");
            });

            $('#minkesz').click(function () {
                printHeader = '<h1><center>Pékáru minimál készleten lista</center></h1>';
                urlChange("{{ route('Minkeszlet') }}");
            });

            $('#gyarto').change(function() {
                let gyarto = $('#gyarto').val();
                if ( gyarto != 0 ) {
                    $.ajax({
                        type: "GET",
                        url:"{{url('api/getPartner')}}",
                        data: { id: gyarto },
                        success: function (response) {
                            if ( response != 0 ) {
                                $('#fejszoveg').text(' '.concat(response.nev.concat(' pékárui')));
                            }
                        },
                        error: function (response) {
                            console.log('Error:', response);
                            alert('nem ok');
                        }
                    });
                    let url = '{{ route('pekaruSzurt', [":melyik"]) }}';
                    urlChange(oTable, url.replace(':melyik', gyarto));
                }

                if ( gyarto == 0) {
                    $('#fejszoveg').text(' Pékáru');
                    let url = "{{ route('pekaru.index') }}";
                    urlChange(oTable, url);
                }

            });
        });
    </script>
@endsection
