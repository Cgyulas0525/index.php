<?php

use App\Classes\ZarasClass;

$kezdo = date('Y-m-d', strtotime('today - 30 day'));
$veg   = date('Y-m-d', strtotime('today'));
$haviNapiArbevetel = ZarasClass::haviNapiArbevetel($kezdo, $veg);
$haviNapiArbevetelMegoszlas = ZarasClass::haviNapiArbevetelMegoszlas($kezdo, $veg);
$haviNapiArbevetelMegoszlasOszlop = ZarasClass::haviNapiArbevetelMegoszlasOszlop($kezdo, $veg);
$atlag = ZarasClass::atlagNapiArbevetelMegoszlasOszlop();
$atlagnapi = ZarasClass::atlagNapiArbevetelMegoszlas();
$kezdo = date('Y-m-d', strtotime('first day of january last year'));
$veg   = date('Y-m-d', strtotime('last day of december this year'));
$hetiArbevetel = ZarasClass::hetiArbevetelMegoszlas($kezdo, $veg);
$haviArbevetel = ZarasClass::haviArbevetelMegoszlas($kezdo, $veg);

?>
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
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <section class="content-header">
                        <h1 class="oldalcim"><img src="public/img/menu/zaras_40.jpg"> Zárás</h1>
                        <ol class="breadcrumb">
                        <li><a href="{{ route('home') }}"><img src="public/img/menu/dashboard_25.png"> Vezérlő pult</a></li>
                        <li class="active"><img src="public/img/menu/zaras_25.jpg"> Zárás</li>
                        </ol>
                        <form id="header-form" class="form-inline" >
                            <h3 class="pull-right" style="margin-top: -2px;">
                                <a class="btn btn-primary pull-right" title="Felvitel" href="{!! route('zaras.create') !!}" style="margin-left: 5px;"><i class="fa fa-plus-square"></i></a>
                            </h3>
                        </form>
                    </section>
                    @include('flash::message')
                    <div class="clearfix"></div>
                    @include('zaras.zarasTable')
                    @include('zaras.zarasNapiArbevetelMegoszlas')
                    <div class="text-center"></div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    @include('zaras.zarasNapiArbevetel')
                    @include('zaras.zarasNapiArbevetelMegoszlasOszlop')
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    @include('zaras.atlagNapiArbevetelMegoszlas')
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    @include('zaras.atlagNapiArbevetelMegoszlasTable')
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                @include('zaras.zarasHetiArbevetelMegoszlas')
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                @include('zaras.HaviArbevetel')
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @include('layouts.datatables_js')
    @include('layouts.highcharts_js')
    @include('zaras.zarasTable_js')
    @include('zaras.zarasNapiArbevetel_js')
    @include('zaras.zarasNapiArbevetelMegoszlas_js')
    @include('zaras.zarasNapiArbevetelMegoszlasOszlop_js')
    @include('zaras.atlagNapiArbevetelMegoszlas_js')
    @include('zaras.atlagNapiArbevetelMegoszlasTable_js')
    @include('zaras.zarasHetiArbevetelMegoszlas_js')
    @include('zaras.HaviArbevetel_js')

    @include('hsjs.hsjs')
@endsection
