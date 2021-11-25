<p>
<div class="row" style="margin-top: 10px;">
    <div class="col-lg-4 col-md-8 col-xs-12" style="margin-top: 10px;">
        <!-- small box -->
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header" id="header1"></div>
            <div class="panel-footer" style="background-color: white;">
                <ul class="nav nav-stacked">
                    <li><a href="{!! route('partners.index') !!}">Partnerek összesen <span class="pull-right badge bg-blue"> {{ App\Models\Partner::count() }} db </span></a></li>
                    <li><a href="{!! route('szamlas.index') !!}">{{ $ev }} Költség 
                        <span class="pull-right badge bg-aqua"> {{ number_format( App\Models\szamla::aktualisEvOsszKoltseg(), 0, ",", "." ) }} Ft</span></a></li>
                    <li><a href="{!! route('zaras.index') !!}">{{ $ev }} Árbevétel 
                        <span class="pull-right badge bg-green">{{ number_format(App\Models\zaras::aktualisEvSumArbevetel(), 0, ",", "." ) }} Ft</span></a></li>
                    <li><a href="{!! route('szamlas.index') !!}">{{ $ev }} Egyenleg 
                        <span class="pull-right badge bg-red">{{ number_format((App\Models\zaras::aktualisEvSumArbevetel() - App\Models\szamla::aktualisEvOsszKoltseg()), 0, ",", "." ) }} Ft</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-8 col-xs-12" style="margin-top: 10px;">
        <!-- small box -->
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header" id="header2"></div>
            <div class="panel-footer">
                <ul class="nav nav-stacked">
                    <li><a href="{!! route('termeks.index') !!}">Termékek összesen <span class="pull-right badge bg-blue"> {{ App\Models\Termek::count() }} db </span></a></li>
                    <li><a href="{!! route('szamlas.index') !!}">Össz Költség <span class="pull-right badge bg-aqua"> {{ number_format(App\Models\szamla::osszKoltseg(), 0, ",", "." ) }} Ft</span></a></li>
                    <li><a href="{!! route('zaras.index') !!}">Össz Árbevétel <span class="pull-right badge bg-green">{{ number_format(App\Models\zaras::sumArbevetel(), 0, ",", "." ) }} Ft</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-8 col-xs-12" style="margin-top: 10px;">
        <!-- small box -->
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header" id="header3"></div>
            <div class="panel-footer">
                <h3 class="m-t-0" style="text-align: center;">Vác Piac 7 számú üzlet</h3>
                <h3 class="m-t-0">Nyitva tartás:</h3>
                <h4 class="m-t-0">Kedd - Péntek: 7.00 - 15.00</h4>
                <h4 class="m-t-0">Szombat: 7.00 - 13.00</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="box box-primary" >
            <div class="box-body">
                <table class="table table-hover table-bordered min-table"></table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-6 col-xs-12">
        @include('zaras.zarasTable')
        <p style="margin-top: 100px;"></p>
        @include('zaras.zarasNapiArbevetelMegoszlas')
    </div>
    <div class="col-lg-6 col-md-6 col-xs-12">
        @include('zaras.zarasNapiArbevetel')
        @include('zaras.atlagNapiArbevetelMegoszlas')
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-8 col-xs-12" style="position: relative; height: 450px; margin-top:20px;">
        <div class="nav-tabs-custom" >
        <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
                <li class="active"><a href="#koltsegcsoport-chart" data-toggle="tab">Csoportonként</a></li>
                <li><a href="#koltsegfocsoport-chart" data-toggle="tab">Főcsoportonként</a></li>
                <li class="pull-left header"><img src="public/img/menu/ktgfocsoport_25.png"> Költségek</li>
            </ul>
            <div class="tab-content no-padding">
                <div id="koltsegcsoport-chart" class="tab-pane fade in active" style="position: relative; height: 400px;">
                    <figure class="highcharts-figure">
                        <div id="koltsegcsoport"></div>
                        <div id="button-bar">
                            <a class="route-button" title="Számlák" href="{!! route('szamlas.index') !!}"><img src={{config('chartbuttontablazat')}}></a>
                        </div>
                    </figure>
                </div>
                <div id="koltsegfocsoport-chart" class="tab-pane fade in" style="position: relative; height: 400px;">
                    <figure class="highcharts-figure">
                        <div id="koltsegfocsoport"></div>
                        <div id="button-bar">
                            <a class="route-button" title="Számlák" href="{!! route('szamlas.index') !!}"><img src={{config('chartbuttontablazat')}}></a>
                        </div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-8 col-xs-12" style="position: relative; height: 450px; margin-top:20px;">
        <div class="nav-tabs-custom" >
        <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
                <li class="active"><a href="#termek-chart" data-toggle="tab">Termékenként</a></li>
                <li><a href="#termekcsoport-chart" data-toggle="tab">Csoportonként</a></li>
                <li><a href="#termekfocsoport-chart" data-toggle="tab">Főcsoportonként</a></li>
                <li class="pull-left header"><img src="public/img/menu/ktgfocsoport_25.png"> Termék beszerzés</li>
            </ul>
            <div class="tab-content no-padding">
                <div id="termek-chart" class="tab-pane fade in active" style="position: relative; height: 400px;">
                    <figure class="highcharts-figure">
                        <div id="termek"></div>
                        <div id="button-bar">
                            <a class="route-button" title="Számlák" href="{!! route('szamlas.index') !!}"><img src={{config('chartbuttontablazat')}}></a>
                        </div>
                    </figure>
                </div>
                <div id="termekcsoport-chart" class="tab-pane fade in" style="position: relative; height: 400px;">
                    <figure class="highcharts-figure">
                        <div id="termekcsoport"></div>
                        <div id="button-bar">
                            <a class="route-button" title="Számlák" href="{!! route('szamlas.index') !!}"><img src={{config('chartbuttontablazat')}}></a>
                        </div>
                    </figure>
                </div>
                <div id="termekfocsoport-chart" class="tab-pane fade in" style="position: relative; height: 400px;">
                    <figure class="highcharts-figure">
                        <div id="termekfocsoport"></div>
                        <div id="button-bar">
                            <a class="route-button" title="Számlák" href="{!! route('szamlas.index') !!}"><img src={{config('chartbuttontablazat')}}></a>
                        </div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
</div>
