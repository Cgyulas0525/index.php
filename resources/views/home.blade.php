@extends('layouts.app')

@section('css')
    @include('layouts.costumcss')
@endsection

@section('content')
    @include('layouts.homepageheader')
    <!-- Main content -->
    <section class="content">
        <div class="col-lg-12">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon">
                        <a href="{!! route('penztarIndit') !!}" target="_blank"><img src={{ URL::asset('/public/img/penztargep.jpg')}} style="width: 90%; height: 90%;"></a>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">Pénztár</span>
                        <span class="info-box-number">Napi forgalom: {{ number_format(App\Http\Controllers\HomeController::penztarNapiForgalom(), 0, ',', '.') }} Ft.</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: {{ App\Http\Controllers\HomeController::penztarForgalomSzazalek() }}%;"></div>
                        </div>
                        <span class="progress-description">
                            Az átlagos napi forgalom {{ App\Http\Controllers\HomeController::penztarForgalomSzazalek() }}%-a
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-blue">
                    <span class="info-box-icon">
                        <a href="{!! route('zaras.create') !!}"><img src={{ URL::asset('/public/img/zaras.jpg')}} style="width: 90%; height: 90%;"></a>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text" >Zárás</span>
                        <span class="info-box-number" >{{ \Carbon\Carbon::now()->year }}. összesen: {{ number_format(App\Classes\ZarasClass::aktualisEvSumArbevetel(), 0, ',', '.') }} Ft.</span>

                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <span class="progress-description">
                            Az aktuális havi: {{ number_format(App\Classes\ZarasClass::aktualisHaviSumArbevetel(), 0, ',', '.') }} Ft.
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-green">
                    <span class="info-box-icon">
                        <a href="{!! route('szamlas.create') !!}"><img src={{ URL::asset('/public/img/szamla.jpg')}} style="width: 90%; height: 90%;"></a>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">Számla</span>
                        <span class="info-box-number">{{ \Carbon\Carbon::now()->year }}. összesen: {{ number_format(App\Classes\SzamlaClass::aktualisEvOsszKoltseg(), 0, ',', '.') }} Ft.</span>

                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <span class="progress-description">
                            Az aktuális havi: {{ number_format(App\Classes\SzamlaClass::aktualisHaviOsszKoltseg(), 0, ',', '.') }} Ft.
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-yellow">
                    <span class="info-box-icon">
                        <a href="{!! route('termeks.create') !!}"><img src={{ URL::asset('/public/img/termek.jpg')}} style="width: 90%; height: 90%;"></a>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">Termék</span>
                        <span class="info-box-number">Összesen: {{ App\Models\Termek::count() }} darab</span>

                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <span class="progress-description">
                            Gluténmentes: {{ App\Models\Termek::where('glutenmentes', 1)->get()->count() }} darab
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-red">
                    <span class="info-box-icon">
                        <a href="{!! route('partners.create') !!}"><img src={{ URL::asset('/public/img/partner.jpg')}}  style="width: 90%; height: 90%;"></a>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">Partner</span>
                        <span class="info-box-number">Összesen: {{ App\Models\Partner::count() }} darab</span>

                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <span class="progress-description">
                            Forgalmazó: {{ App\Models\Partner::whereIn('tipus', [2053, 2087, 2088])->get()->count() }} darab
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-gray">
                    <span class="info-box-icon">
                        <a href="{!! route('mozgasfejs.create') !!}"><img src={{ URL::asset('/public/img/keszlet.jpg')}} style="width: 90%; height: 90%;"></a>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">Készlet mozgás</span>
                        <span class="info-box-number">Összesen: {{ App\Models\Mozgasfej::count() }} darab</span>

                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <span class="progress-description">
                            Bevételezés: {{ App\Models\Mozgasfej::whereIn('mozgaskod_id', [1, 3])->get()->count() }} darab
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon">
                        <a href="{!! route('penztarIndit') !!}" target="_blank"><img src={{ URL::asset('/public/img/product/gluténfree.jpg')}} style="width: 90%; height: 90%;"></a>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">Termék karton</span>
                        <div class="mylabel col-sm-2">
                            {!! Form::label('barcode', 'Vonalkód:') !!}
                        </div>
                        <div class="col-lg-7">
                            {!! Form::text('barcode', null, ['style' => 'cursor: not-allowed', 'class' => 'form-control text-right', 'id' => 'barcode', 'autofocus']) !!}
                            {!! Form::hidden('termek', null, ['style' => 'cursor: not-allowed', 'class' => 'form-control text-right', 'id' => 'termek']) !!}
                        </div>
                        <div class="mylabel3 col-sm-3" style="margin-top: -20px;">
                            <a href="#" class="btn btn-danger szuresgomb szures" title="Szűrés"><i class="glyphicon glyphicon-book"></i></a>
                        </div>

                        <div class="progress">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                        <span class="progress-description">
                            Termék karton keresés
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box bg-blue">
                    <span class="info-box-icon">
                        <a href="{!! route('vevoirendelesfejs.create') !!}"><img src={{ URL::asset('/public/img/menu/order.png')}} style="width: 90%; height: 90%;"></a>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">Vevői rendelés</span>
                        <span class="info-box-number">Összesen: {{ App\Models\Vevoirendelesfej::count() }} darab</span>

                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <span class="progress-description">
                            Függő: {{ App\Models\Mozgasfej::whereIn('mozgaskod_id', [1, 3])->get()->count() }} darab
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>


        </div>
    </section>
@endsection

@section('scripts')

    @include('functions.ajax_js')
    @include('functions.barcode_js')

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            function barcodeInit() {
                $("#barcode").val(null);
                $("#termek").val(null);
                $('#barcode').focus();
            }

            function vmi(bcode) {
                var theResponse = null;
                let barcode = barcodeReplace(bcode);
                $("#barcode").val(barcode);
                // jQuery ajax
                $.ajax({
                    type: "GET",
                    url:"{{url('api/getBarcodeTermek')}}",
                    data: { barcode: barcode },
                    success: function (response) {
                        if(response.id != null){
                            theResponse = parseInt(response.id);
                            $('#termek').val(theResponse);
                        } else {
                            alert( "Nincs ilyen vonalkódú tétel!");
                            barcodeInit();
                        }
                    }
                });
            }

            $('#barcode').change(function() {
                let barcode = $('#barcode').val();
                if (barcode != 0) {
                    vmi(barcode);
                }
            });

            $('.szures').click(function () {
                var SITEURL = "{{url('/')}}";
                let termek = $('#termek').val();
                if (termek != 0) {
                    var url = SITEURL + '/termeks.termekKarton/' + termek;
                    window.location = url;
                } else {
                    alert('Nem adott meg vonalkódot!');
                    $('#barcode').focus();
                }
            });

            barcodeInit();

        });
    </script>
@endsection
