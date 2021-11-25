<?php
use App\Models\Partner;
use App\Models\Termek;
use App\Models\Termekcsoport;
use App\Models\Termekfocsoport;
use App\Models\szamla;
use App\Models\Koltsegfocsoport;
use App\Models\Koltsegcsoport;
use App\Classes\Koltseg;
use App\Models\Zaras;

$evhonapKoltseg = Koltseg::getEvHetKoltseg();
$ev = date("Y");


$osszkoltseg = szamla::OsszKoltseg();
$arbevetel = Zaras::sumArbevetel();
$egyenleg = $arbevetel - $osszkoltseg;

$osszkoltseg = number_format($osszkoltseg, 0, ",", "." );
$arbevetel = number_format($arbevetel, 0, ",", "." );
$egyenleg = number_format($egyenleg, 0, ",", "." );

$kezdo = date('Y-m-d', strtotime('first day of january last year'));
$veg   = date('Y-m-d', strtotime('last day of december this year'));
$KoltsegFoCsoportOsszesen = Koltsegfocsoport::KoltsegFoCsoportOsszesen($kezdo, $veg, NULL);
$KoltsegCsoportOsszesen = Koltsegcsoport::KoltsegCsoportOsszesen($kezdo, $veg, NULL);

$termekOsszesen = termek::TermekOsszesen($kezdo, $veg, NULL);
$termekCsoportOsszesen = termekcsoport::TermekCsoportOsszesen($kezdo, $veg, NULL);
$termekFoCsoportOsszesen = termekfocsoport::TermekFoCsoportOsszesen($kezdo, $veg, NULL);

$kezdo = date('Y-m-d', strtotime('today -30 day'));
$veg   = date('Y-m-d', strtotime('today'));
$haviNapiArbevetel = Zaras::haviNapiArbevetel($kezdo, $veg);
$haviNapiArbevetelMegoszlas = Zaras::osszNapiArbevetelMegoszlas($kezdo, $veg);
$haviNapiArbevetelMegoszlasOszlop = Zaras::haviNapiArbevetelMegoszlasOszlop($kezdo, $veg);
$atlag = Zaras::atlagNapiArbevetelMegoszlasOszlop();
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

    @include("hsjs.hsjs")
    <script type="text/javascript">
    $(function () {
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        var oTable = $('.min-table').DataTable({
            serverSide: true,
            scrollY: 150,
            order: [[1, 'asc']],
            ajax: "{{ route('Minkeszlet') }}",
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
            ]
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

        var kategoria = csoportfeltolt(<?php echo $KoltsegCsoportOsszesen; ?>);
        var pie_data = csoportPieData(<?php echo $KoltsegCsoportOsszesen; ?>);
        var chart_koltsegcsoport = HighChartPie( 'koltsegcsoport', 'pie', 350, kategoria, pie_data, 'Költségek', 'Csoportonként', 'Csoport', 200, true, true, '40%');

        var fokategoria = csoportfeltolt(<?php echo $KoltsegFoCsoportOsszesen; ?>);
        var fopie_data = csoportPieData(<?php echo $KoltsegFoCsoportOsszesen; ?>);
        var chart_koltsegfocsoport = HighChartPie( 'koltsegfocsoport', 'pie', 350, fokategoria, fopie_data, 'Költségek', 'Főcsoportonként', 'Főcsoport', 200, true, true, '0%');

        kategoria = [];
        pie_data = [];
        kategoria = csoportfeltolt(<?php echo $termekOsszesen; ?>);
        pie_data = csoportPieData(<?php echo $termekOsszesen; ?>);
        var chart_termek = HighChartPie( 'termek', 'pie', 350, kategoria, pie_data, 'Termék beszerzés', 'Termékenként', 'Termék', 200, true, true, '0%');

        kategoria = [];
        pie_data = [];
        var kategoria = csoportfeltolt(<?php echo $termekCsoportOsszesen; ?>);
        var pie_data = csoportPieData(<?php echo $termekCsoportOsszesen; ?>);
        var chart_termekcsoport = HighChartPie( 'termekcsoport', 'pie', 350, kategoria, pie_data, 'Termék beszerzés', 'Termék csoportonként', 'Termék csoport', 200, true, true, '0%');

        kategoria = [];
        pie_data = [];
        var kategoria = csoportfeltolt(<?php echo $termekFoCsoportOsszesen; ?>);
        var pie_data = csoportPieData(<?php echo $termekFoCsoportOsszesen; ?>);
        var chart_termekfocsoport = HighChartPie( 'termekfocsoport', 'pie', 350, kategoria, pie_data, 'Termék beszerzés', 'Termék főcsoportonként', 'Termék főcsoport', 200, true, true, '0%');

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
