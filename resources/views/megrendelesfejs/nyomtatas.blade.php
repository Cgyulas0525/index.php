<?php
use App\Models\Partner;
use App\Models\Megrendelestetel;
use App\Models\Megrendelesfej;


$tulajdonos = Partner::getTulajdonos(2056);
$partner = Partner::find($megrendelesfej->partner);
$tetelek = Megrendelestetel::where('megrendelesfej', $megrendelesfej->id)->get();
$ertek = Megrendelestetel::where('megrendelesfej', $megrendelesfej->id)->get()->sum('ertek');
$afak = App\Classes\MegrendelesClass::magerendelesAfa($megrendelesfej->id);
$sumafa = 0;
foreach ($afak as $key => $value) {
    $sumafa = $sumafa + $value->ertek;
}
$netto = $ertek - $sumafa;
?>

@extends('layouts.app')

<body onload="window.print();">
@section('content')

    <section class="content-header">
        <h1>
            Megrendelesfej
        </h1>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <img src={{ URL::asset('/public/img/brand/logo_1.png')}} style="width: 40px; height: 40px;" alt="MH Image"> MentesHetes
                    <small class="pull-right">{{ date('Y.m.d', strtotime(\Carbon\Carbon::now())) }}</small>
                </h2>
            </div>
          <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                Megrendelő:
                <address>
                    <strong>{{ $tulajdonos->nev }}</strong><br>
                    {{ $tulajdonos->partnercim }}<br>
                    Mobil: {{ $tulajdonos->telefonszam }}<br>
                    Email: {{ $tulajdonos->email }}
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                Szállító:
                <address>
                    <strong>{{ $partner->nev }}</strong><br>
                    {{ $partner->partnercim }}<br>
                    Mobil: {{ $partner->telefonszam }}<br>
                    Email: {{ $partner->email }}
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Megrendelés szám: {{ $megrendelesfej->megrendelesszam }}</b><br>
            <br>
            </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Termék</th>
                            <th style="text-align: right;">Darab</th>
                            <th style="text-align: right;">Ár</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tetelek as $key => $tetel)
                            <tr>
                                <td>{{ $tetel->termeknev }}</td>
                                <td style="text-align: right;">{{ Str::ezresTagozas($tetel->mennyiseg,0,",",".") }} </td>
                                <td style="text-align: right;">{{ Str::ezresTagozas($tetel->ertek,0,",",".") }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <!-- accepted payments column -->
            <div class="col-xs-6">
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    A várható szállítási időpontot kérem jelezze a fejlécben található elérhetőségeinken!
                </p>
            </div>
          <!-- /.col -->
            <div class="col-xs-6">
                <p class="lead">Megrendelés dátuma: {{ date('Y.m.d', strtotime($megrendelesfej->datum)) }}</p>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Összesen:</th>
                            <td style="text-align: right;">{{ Str::ezresTagozas($ertek,0,",",".") }}</td>
                        </tr>
                        <tr>
                            <th>Netto:</th>
                            <td style="text-align: right;">{{ Str::ezresTagozas($netto,0,",",".") }}</td>
                        </tr>
                        @foreach ($afak as $key => $value)
                            <tr>
                                <th>{{ $value->afa }}% ÁFA</th>
                                <td style="text-align: right;">{{ Str::ezresTagozas($value->ertek,0,",",".") }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th>Összesen:</th>
                            <td style="text-align: right;">{{ Str::ezresTagozas($ertek,0,",",".") }}</td>
                        </tr>
                    </table>
                </div>
            </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@endsection
</body>
