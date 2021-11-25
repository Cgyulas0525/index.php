@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="public/css/datatables.css">
    <link rel="stylesheet" href="public/css/Highcharts.css">
    @include('layouts.costumcss')
@endsection

@section('content')
    <div class="content">
        <?php
            $modul = 'Termék';
        ?>
        <div class="clearfix"></div>
        <div class="box box-primary" >
            <div class="box-body">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <section class="content-header">
                        <h1 class="oldalcim"><img src="public/img/menu/products_40.png"><a id="fejszoveg"> Minden termék</a>
                            <h4>
                                <div class="col-sm-12">
                                    <div class="col-sm-3">
                                        {!! Form::label('focsoport', 'Főcsoport:') !!}
                                        {!! Form::select('focsoport', [""] + \App\Models\termekfocsoport::orderBy('nev')->pluck('nev', 'id')->toArray(),
                                                          empty($_COOKIE['termekIndexFocsoport']) ? null : $_COOKIE['termekIndexFocsoport'],
                                                          ['class'=>'select2 form-control', 'id' => 'focsoport']) !!}
                                    </div>
                                    <div class="col-sm-3">
                                        {!! Form::label('csoport', 'Csoport:') !!}
                                        {!! Form::select('csoport', [""] + \App\Models\termekcsoport::orderBy('nev')->pluck('nev', 'id')->toArray(),
                                                          empty($_COOKIE['termekIndexCsoport']) ? null : $_COOKIE['termekIndexCsoport'],
                                                          ['class'=>'select2 form-control', 'id' => 'csoport']) !!}
                                    </div>
                                    <div class="col-sm-3">
                                        {!! Form::label('partner', 'Partner:') !!}
                                        {!! Form::select('partner', App\Classes\DDW::partnerSzallitoDdw(),
                                                          empty($_COOKIE['termekIndexPartner']) ? null : $_COOKIE['termekIndexPartner'],
                                                          ['class'=>'select2 form-control', 'id' => 'partner']) !!}
                                    </div>
                                    <div class="mylabel3 col-sm-3" style="margin-top: -20px;">
                                        <a href="#" class="btn btn-warning szuresgomb szures" title="Szűrés"><i class="glyphicon glyphicon-filter"></i></a>
                                        <a href="#" class="btn btn-default szuresgomb mind" title="Minden tétel"><i class="glyphicon glyphicon-remove"></i></a>
                                        <a href="#" class="btn btn-success szuresgomb barcode" title="Vonalkód nélküli termékek"><i class="glyphicon glyphicon-barcode"></i></a>
                                    </div>
                                    <div class="mylabel3 col-sm-3">
                                        {!! Form::select('modul_id', App\Classes\DDW::listaDdw($modul), null,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'modul_id']) !!}
                                    </div>
                                </div>
                            </h4>
                        </h1>
                        <ol class="breadcrumb">
                        <li><a href="{{ route('home') }}"><img src="public/img/menu/dashboard_25.png"> Vezérlő pult</a></li>
                        <li class="active"><img src="public/img/menu/keszlet_25.png"> Készlet</li>
                        <li class="active"><img src="public/img/menu/products_25.png"> Termék</li>
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
    @include('functions.ajax_js')
    @include('functions.cookiesFunctions_js')
    @include('functions.lista.modulChange_js')
    @include('functions.csoportddw_js')

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            let table = $('.partners-table').DataTable({
                serverSide: true,
                scrollY: 390,
                scrollX: true,
                paging: false,
                order: [[1, 'asc']],
                ajax: "{{ route('termeks.index') }}",
                columns: [
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('termeks.create') !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", width: '260px', name: 'action', orderable: false, searchable: false},
                    {title: 'Név', data: 'nev', width:'250px', name: 'nev'},
                    {title: '', data: "fokep", "render": function (data) {
                            if ( data == null ) {
                                return '<img src="public/img/nincskep.png" style="height:40px;width:40px;object-fit:cover;"/>';
                            }
                            return '<img src="' + data + '" style="height:40px;width:40px;object-fit:cover;"/>';
                        }
                    },

                    /*                 {title: 'Barcode', data: "cbarcode", "render": function (data) {
                                           return '<img src="data:image/png;base64,' + data + '"/>';
                                       }
                                   },*/
                    {title: 'Fő csoport', data: 'focsoportnev', name: 'focsoportnev'},
                    {title: 'Csoport', data: 'csnev', name: 'csnev'},
                    {title: 'Cikkszám', data: 'cikkszam', name: 'cikkszam'},
                    {title: 'Vonalkód', data: "barcode", name: 'barcode'},
                    {title: 'Mennyiségi egység', data: 'menev', sClass: "text-center", name: 'menev'},
                    {title: 'Mennyiség', data: 'mennyiseg', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'mennyiseg'},
                    {title: 'Minimális', data: 'minmenny', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'minmenny'},
                    {title: 'Ár', data: 'ar', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'ar'},
                    {title: 'Gyártó', data: 'pnev', name: 'pnev'},
                ]
            });

            function urlInit() {
                let url = '{{ route('indexSzurt', [":melyik"]) }}';
                melyik = 'Mind';
                url = url.replace(':melyik', melyik);

                return url;
            }

            urlalap = urlInit();

            function szuroInit() {
                $('#focsoport').val(null);
                $('#csoport').val(null);
                $('#partner').val(null);
            }

            $('.mind').click(function () {
                $('#fejszoveg').text('Minden termék');
                szuroInit();
                let url = '{{ route('indexSzurt' , [":melyik"]) }}';
                urlChange(table, url.replace(':melyik', 'Mind'));
            });

            $('.barcode').click(function () {
                $('#fejszoveg').text('Vonalkód nélküli termékek');
                let url = '{{ route('indexSzurt', [":melyik"]) }}';
                urlChange(table, url.replace(':melyik', 'Barcode'));
            });

            function szures() {
                let csoport = $('#csoport').val() != 0 ? $('#csoport').val() : -99999;
                let partner = $('#partner').val() != 0 ? $('#partner').val() : -99999;
                let focsoport = $('#focsoport').val() != 0 ? $('#focsoport').val() : -99999;

                $('#fejszoveg').text('Szűrt termékek');
                let url = '{{ route('indexFiltered', [":focsoport", ":tipus", ":partner"]) }}';
                url = url.replace(':focsoport', focsoport);
                url = url.replace(':tipus', csoport);
                url = url.replace(':partner', partner);
                urlChange(table, url);
            }


            $('.szures').click(function () {
                szures();
                let focsoport = $('#focsoport').val() != 0 ? $('#focsoport').val() : -99999;
                let csoport = $('#csoport').val() != 0 ? $('#csoport').val() : -99999;
                let partner = $('#partner').val() != 0 ? $('#partner').val() : -99999;
                createCookie('termekIndexFocsoport', focsoport, '30');
                createCookie('termekIndexCsoport', csoport, '30');
                createCookie('termekIndexPartner', partner, '30');
            });

            modulChange();

            szures();

            let focsoport = $('#focsoport').val() != 0 ? $('#focsoport').val() : -99999;
            let csoport = $('#csoport').val() != 0 ? $('#csoport').val() : -99999;
            console.log(focsoport);
            if( focsoport != -99999 ){
                $.ajax({
                    type:"GET",
                    url:"{{url('ddw/termekFocsoportCsoportDdw')}}?focsoport="+focsoport,
                    success:function(res){
                        if(res){
                            $("#csoport").empty();
                            $("#csoport").append('<option></option>');
                            $.each(res,function(key,value){
                                $("#csoport").append('<option value="'+value.id+'">'+value.nev+'</option>');
                            });

                            if ( csoport != -99999 ) {
                                $('#csoport').val(csoport);
                            }

                        }else{
                            $("#csoport").empty();
                        }
                    }
                });
            }else{
                $("#csoport").empty();
            }

        });
    </script>
@endsection
