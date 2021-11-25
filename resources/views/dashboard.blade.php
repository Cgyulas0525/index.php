<?php
use App\Models\Partner;
use App\Models\Szamla;
use App\Models\Koltsegfocsoport;
use App\Models\Koltsegcsoport;
use App\Classes\Koltseg;
use App\Models\Zaras;
use App\Classes\ZarasClass;
use App\Classes\SzamlaClass;

$img = Image::make('public/img/menu/products_40.png');

$evhonapKoltseg = Koltseg::getEvHetKoltseg();
$ev = date("Y");

$osszkoltseg = Szamla::sum('osszeg');
$arbevetel = ZarasClass::sumArbevetel();
$egyenleg = $arbevetel - $osszkoltseg;

$osszkoltseg = number_format($osszkoltseg, 0, ",", "." );
$arbevetel = number_format($arbevetel, 0, ",", "." );
$egyenleg = number_format($egyenleg, 0, ",", "." );

$kezdo = date('Y-m-d', strtotime('Monday -26 week '));
$veg   = date('Y-m-d', strtotime('Sunday this week'));

$hetiArbevetel = ZarasClass::hetiArbevetelMegoszlas($kezdo, $veg);

$kezdo = date('Y-m-d', strtotime('first day of january last year'));
$veg   = date('Y-m-d', strtotime('last day of december this year'));

$haviArbevetel = ZarasClass::haviArbevetelMegoszlas($kezdo, $veg);

$KoltsegFoCsoportOsszesen = Koltseg::KoltsegFoCsoportOsszesen($kezdo, $veg, NULL);

$osszHetDB = ZarasClass::hetDB($kezdo, $veg);

$szamlaPartnerenkentOssz = SzamlaClass::szamlaOsszPartnerenkent();

$kezdo = date('Y-m-d', strtotime('today -30 day'));
$veg   = date('Y-m-d', strtotime('today'));
$haviNapiArbevetel = ZarasClass::haviNapiArbevetel($kezdo, $veg);
$haviNapiArbevetelMegoszlas = ZarasClass::osszNapiArbevetelMegoszlas($kezdo, $veg);
$haviNapiArbevetelMegoszlasOszlop = ZarasClass::haviNapiArbevetelMegoszlasOszlop($kezdo, $veg);
$atlag = ZarasClass::atlagNapiArbevetelMegoszlasOszlop();

$kezdo = date('Y-m-d', strtotime('first day of january this year'));
$veg   = date('Y-m-d', strtotime('last day of december this year'));
$ideiHetDB = ZarasClass::hetDB($kezdo, $veg);

$haviBevetelKiadas = Koltseg::haviBevetelKiadas($kezdo, $veg);
 ?>
@extends('layouts.app')

@section('css')

    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="public/css/datatables.css">
    <link rel="stylesheet" href="public/css/Highcharts.css">
    @include('layouts.costumcss')

@endsection

@section('content')
    @include('layouts.header')
    <!-- Main content -->
    <section class="content">
        @include('dashboard.dashboardrow')
    </section>
@endsection

@section('scripts')
    @include('layouts.datatables_js')
    @include('layouts.RowCallBack_js')
    @include('layouts.highcharts_js')
    @include('zaras.zarasTable_js')
    @include('zaras.zarasNapiArbevetel_js')
    @include('zaras.zarasNapiArbevetelMegoszlas_js')
    @include('zaras.atlagNapiArbevetelMegoszlas_js')
    @include('zaras.zarasHetiArbevetelMegoszlas_js')
    @include('zaras.HaviArbevetel_js')
    @include('dashboard.haviBevetelKiadas_js')
    @include('functions.ajax_js')

    @include("hsjs.hsjs")
    <script type="text/javascript">
    $(function () {

        ajaxSetup();

        var table = $('.heti-table').DataTable({
            serverSide: true,
            scrollY: 300,
            paging: false,
            order: [[0, 'desc']],
            ajax: "{{ route('HBK') }}",
            columns: [
                {title: 'Hét', data: 'nev', name: 'nev'},
                {title: 'Bevétel', data: 'bev', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'bev'},
                {title: 'Kiadás', data: 'kiad', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'kiad'},
            ],
        });

        var table = $('.havi-table').DataTable({
            serverSide: true,
            scrollY: 300,
            paging: false,
            order: [[0, 'desc']],
            ajax: "{{ route('HaviBK') }}",
            columns: [
                {title: 'Hónap', data: 'nev', name: 'nev'},
                {title: 'Bevétel', data: 'bev', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'bev'},
                {title: 'Kiadás', data: 'kiad', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'kiad'},
                {title: 'Egyenleg', data: 'egyenleg', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'egyenleg'},
            ],
        });

        var oTable = $('.baszki-table').DataTable({
            serverSide: true,
            scrollY: 300,
            paging: false,
            order: [[0, 'asc']],
            ajax: "{{ route('PartnerOssz') }}",
            columns: [
                {title: 'Név', data: 'nev', width:'75%', name: 'nev'},
                {title: 'Összesen', data: 'ossz', width:'25%', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'ossz'},
            ],
            footerCallback: function ( row, data, start, end, display ) {
                  var api = this.api(), data;
                  // Remove the formatting to get integer data for summation
                  var intVal = function ( i ) {
                      return typeof i === 'string' ?
                          i.replace(/[\$,]/g, '')*1 :
                          typeof i === 'number' ?
                              i : 0;
                  };
                  // Total over all pages
                  total = api.column( 1 ).data().sum();
                  // Total over this page
                  pageTotal = api.column( 1, {page:'current'} ).data().sum();
                  // Update footer
                  $( api.column( 1 ).footer() ).html(
                      currencyFormatDE(total)
                  );
                },

        });

        function csoportfeltolt(data_viewer) {
            var v_kategoria = [];
            for (i = 0; i < data_viewer.length; i++ ){
                v_kategoria.push(data_viewer[i].nev);
            }
            return v_kategoria;
        }

        function csoportPieData(data){
          var pieData = [];
          var sum = 0;
          for (i = 0; i < data.length; i++){
              pieData.push({name: data[i].nev, y: parseInt(Math.round(data[i].osszeg).toFixed(0))});
          }
          return pieData;
        }

        var kategoria = csoportfeltolt(<?php echo $szamlaPartnerenkentOssz; ?>);
        var pie_data = csoportPieData(<?php echo $szamlaPartnerenkentOssz; ?>);
        var chart_koltsegcsoport = HighChartPie( 'koltsegcsoport', 'pie', 450, kategoria, pie_data, 'Költségek', 'Partnernként', 'Partner', 200, true, true, '40%');


        function LineChartKategoria(data){
            kategoria = [];
            for (i = 0; i < data.length; i++){
                kategoria.push(data[i].honap);
            }
            return kategoria;
        }

        function LineChartData(data, mi){
            chartdata = [];
            cdata = [];
            for (i = 0; i < data.length; i++){
                cdata.push(parseInt(data[i].db));
            }
            chartdata.push({name: mi, data: cdata});
            return chartdata;
        }

        var chart_havikotes = highchartLine( 'evhonapKoltseg', 'line', 262, LineChartKategoria(<?php echo $evhonapKoltseg; ?>), LineChartData(<?php echo $evhonapKoltseg; ?>, ''), 'Költségek', 'heti bontás', 'forint');

    });
  </script>

@endsection
