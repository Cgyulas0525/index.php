@section('css')
    @include('layouts.costumcss')
@endsection

<div class="form-group col-sm-4">
    <div class="row">
        <div class="mylabel col-sm-2">
            {!! Form::label('barcode', 'Vonalkód:') !!}
        </div>
        <div class="col-sm-10">
            {!! Form::text('barcode', null, ['style' => 'cursor: not-allowed', 'class' => 'form-control text-right', 'id' => 'barcode', 'autofocus']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="ujtetelcol col-sm-2">
            <a class="btn btn-default ujtetelgomb termekgomb" title="Termék" href="#">Termék</a>
        </div>
        <div class="col-sm-10">
            {!! Form::select('termek', App\Classes\DDW::termekDDW(), null, ['class'=>'select2 form-control', 'id' => 'termek']) !!}
        </div>
    </div>
</div>
<div class="form-group col-sm-4">
    <div class="row">
        <div class="mylabel col-sm-4">
            {!! Form::label('koltseg', 'Költség típus:', ['id' => 'koltseglabel']) !!}
        </div>
        <div class="col-sm-8">
            {!! Form::select('koltseg', App\Classes\DDW::koltsegCsoportDdw(), null, ['class'=>'select2 form-control', 'id' => 'koltseg', 'required' => 'true']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-4">
            {!! Form::label('mennyiseg', 'Mennyiség:', ['id' => 'mennyiseglabel']) !!}
        </div>
        <div class="col-sm-8">
            {!! Form::number('mennyiseg', null, ['class' => 'form-control  text-right', 'required' => 'true', 'id' => 'mennyiseg']) !!}
        </div>
    </div>
</div>
<div class="form-group col-sm-4">
    {!! Form::hidden('szamla', $szamla->id, ['class' => 'form-control  text-right', 'required' => 'true', 'id' => 'szamla']) !!}
    {!! Form::hidden('afaszaz', 1, ['class' => 'form-control  text-right', 'required' => 'true', 'id' => 'afaszaz']) !!}
    {!! Form::hidden('beszar', 1, ['class' => 'form-control  text-right', 'required' => 'true', 'id' => 'beszar']) !!}
    {!! Form::hidden('csoport', 1, ['class' => 'form-control  text-right', 'required' => 'true', 'id' => 'csoport']) !!}
    <div class="row">
        <div class="mylabel col-sm-4">
            {!! Form::label('afa', 'Áfa:', ['id' => 'afalabel']) !!}
        </div>
        <div class="col-sm-8">
            {!! Form::number('afa', null, ['class' => 'form-control  text-right', 'required' => 'true', 'id' => 'afa',
                                        'style' => 'cursor: not-allowed', 'readonly' => 'true']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-4">
            {!! Form::label('netto', 'Netto:', ['id' => 'nettolabel']) !!}
        </div>
        <div class="col-sm-8">
            {!! Form::number('netto', null, ['class' => 'form-control  text-right', 'required' => 'true', 'id' => 'netto',
                                          'style' => 'cursor: not-allowed', 'readonly' => 'true']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-4 bruttolab">
            {!! Form::label('brutto', 'Bruttó:', ['id' => 'bruttolabel']) !!}
        </div>
        <div class="col-sm-8 bruttoent">
            {!! Form::number('brutto', null, ['class' => 'form-control  text-right' , 'required' => 'true', 'id' => 'brutto']) !!}
        </div>
    </div>
</div>

<div class="col-sm-12 termekelemek">
    <div class="col-sm-6">
        <div class="form-group col-sm-12">
            <div class="mylabel col-sm-2">
                {!! Form::label('termek_nev', 'Név:', ['id' => 'termek_nevlabel']) !!}
            </div>
            <div class="col-sm-10">
                {!! Form::text('termek_nev', null, ['class' => 'form-control', 'required' => 'true', 'id' => 'termek_nev']) !!}
            </div>
        </div>
        <div class="form-group col-sm-12">
            <div class="mylabel col-sm-2">
                {!! Form::label('termek_csoport', 'Csoport:', ['id' => 'termek_csoportlabel']) !!}
            </div>
            <div class="col-sm-10">
                {!! Form::select('termek_csoport', App\Classes\DDW::termekCsoportDdw(), null,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'termek_csoport']) !!}
            </div>
        </div>
        <div class="form-group col-sm-12">
            <div class="ujtetelcol col-sm-2">
                <a class="btn btn-default ujtetelgomb" id="pgomb" title="Partner" href="#">Partner</a>
            </div>
            <div class="col-sm-10">
                {!! Form::select('termek_partner', App\Classes\DDW::partnerDdw(), $szamla->partner,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'termek_partner']) !!}
            </div>
        </div>
    </div>
    <!-- Me Field -->
    <div class="form-group col-sm-6">
        <div class="mylabel col-sm-2">
            {!! Form::label('termek_cikkszam', 'Cikkszám:', ['id' => 'termek_cikkszamlabel']) !!}
        </div>
        <div class="col-sm-10">
            {!! Form::text('termek_cikkszam', null, ['style' => 'cursor: not-allowed', 'class' => 'form-control', 'id' => 'termek_cikkszam']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="row">
            <div class="form-group col-sm-4">
                <div class="mylabel col-sm-3">
                    {!! Form::label('termek_me', 'Me.:', ['id' => 'termek_melabel']) !!}
                </div>
                <div class="col-sm-9">
                    {!! Form::select('termek_me', App\Classes\DDW::dictionaryDdw(26), null,['class'=>'select2 form-control', 'id' => 'termek_me']) !!}
                </div>
            </div>
            <div class="form-group col-sm-4">
                <div class="mylabel col-sm-3">
                    {!! Form::label('termek_minmenny', 'Min:', ['id' => 'termek_minmennylabel']) !!}
                </div>
                <div class="col-sm-9">
                    {!! Form::number('termek_minmenny', null, ['class' => 'form-control  text-right', 'id' => 'termek_minmenny']) !!}
                </div>
            </div>
            <div class="form-group col-sm-4">
                <div class="mylabel col-sm-3">
                    {!! Form::label('termek_mennyiseg', 'Menny.:', ['id' => 'termek_mennyiseglabel']) !!}
                </div>
                <div class="col-sm-9">
                    {!! Form::number('termek_mennyiseg', null, ['class' => 'form-control  text-right', 'id' => 'termek_mennyiseg']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <div class="mylabel col-sm-3">
                    {!! Form::label('termek_beszar', 'Besz.ár:', ['id' => 'termek_beszarlabel']) !!}
                </div>
                <div class="col-sm-9">
                    {!! Form::number('termek_beszar', null, ['class' => 'form-control  text-right', 'id' => 'termek_beszar']) !!}
                </div>
            </div>
            <div class="form-group col-sm-6">
                <div class="mylabel col-sm-3">
                    {!! Form::label('termek_ar', 'Ár:', ['id' => 'termek_arlabel']) !!}
                </div>
                <div class="col-sm-9">
                    {!! Form::number('termek_ar', null, ['class' => 'form-control  text-right', 'id' => 'termek_ar']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group col-sm-12">
    @include('partners.partnerFields')
</div>

<div class="col-lg-12 jelzok">
    <div class="col-lg-2">
        {!! Form::label('glutenmentes', 'Gluténmentes:', ['id' => 'glutenmenteslabel']) !!}
        {!! Form::checkbox('glutenmentes', !empty($termek->glutenmentes) ? $termek->glutenmentes : 0, ['class' => 'form-control', 'id'=>'glutenmentes']) !!}
    </div>
    <div class="col-lg-2">
        {!! Form::label('laktozmentes', 'Laktózmentes:', ['id' => 'laktozmenteslabel']) !!}
        {!! Form::checkbox('laktozmentes', !empty($termek->laktozmentes) ? $termek->laktozmentes : 0, ['class' => 'form-control', 'id'=>'laktozmentes']) !!}
    </div>
    <div class="col-lg-2">
        {!! Form::label('tejmentes', 'Tejmentes:', ['id' => 'tejmenteslabel']) !!}
        {!! Form::checkbox('tejmentes', !empty($termek->tejmentes) ? $termek->tejmentes : 0, ['class' => 'form-control', 'id'=>'tejmentes']) !!}
    </div>
    <div class="col-lg-2">
        {!! Form::label('tojasmentes', 'Tojásmentes:', ['id' => 'tojasmenteslabel']) !!}
        {!! Form::checkbox('tojasmentes', !empty($termek->tojasmentes) ? $termek->tojasmentes : 0, ['class' => 'form-control', 'id'=>'tojasmentes']) !!}
    </div>
    <div class="col-lg-2">
        {!! Form::label('cukormentes', 'Cukormentes:', ['id' => 'cukormenteslabel']) !!}
        {!! Form::checkbox('cukormentes', !empty($termek->cukormentes) ? $termek->cukormentes : 0, ['class' => 'form-control', 'id'=>'cukormentes']) !!}
    </div>
    <div class="col-lg-2">
        {!! Form::label('vegan', 'Vegán:', ['id' => 'veganlabel']) !!}
        {!! Form::checkbox('vegan', !empty($termek->vegan) ? $termek->vegan : 0, ['class' => 'form-control', 'id'=>'vegan']) !!}
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 gombok" >
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('szamlas.edit', $szamla->id) !!}" class="btn btn-default">Kilép</a>
    <a href="{!! route('szamlas.create') !!}" class="btn btn-success">Új számla</a>
    <a href="{!! route('szamlas.index') !!}" class="btn btn-info">Számla</a>
</div>

<div class="col-lg-12 col-md-12 col-xs-12 tablazat">

    <section class="content-header">
        <h1 class="pull-left">Tétel</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered tetel-table" style="width: 100%;"></table>
                </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
</div>


@section('scripts')

    @include('mozgasfejs.termekmezok_js')
    @include('functions.barcode_js')
    @include('functions.kovetkezoCikkszam_js')
    @include('functions.api_js')
    @include('functions.jsFunctions_js')
    @include('layouts.datatables_js')

    @include('functions.ajax_js')
    @include('functions.apis.kovetkezoTermekCikkszam')
    @include('functions.apis.kovetkezoSzolgaltatasCikkszam')
    @include('functions.apis.focsoportFromCsoport')
    @include('functions.apis.afaSzazMezobe')

    @include('functions.checkBoxes_js')
    @include('functions.termek.termekCheckBoxFieldChange_js')
    @include('functions.termek.termekCsoportChange_js')


    <script type="text/javascript">
        $(function () {

            ajaxSetup();
            ujTermekMezok(true);

            let tf = true;
            let ptf = false;

            $('.gombok').css("margin-top", "-200px" );
            $('.tablazat').css("margin-top", "-170px" );

            var oTable = $('.tetel-table').DataTable({
                serverSide: true,
                scrollY: 250,
                colReorder: true,
                paging: false,
                buttons: [],
                dom: '<"clear">',
                order: [[0, 'asc']],
                ajax: "{{ route('szTetelIndex', $szamla->id) }}",
                columns: [
                    {title: 'Termék', data: 'termeknev', name: 'termeknev'},
                    {title: 'Ktg típus', data: 'koltsegnev', name: 'koltsegnev'},
                    {title: 'Mennyiség', data: 'mennyiseg', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'mennyiseg'},
                    {title: 'Netto', data: 'netto', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'netto'},
                    {title: 'Áfa', data: 'afa', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'afa'},
                    {title: 'Brutto', data: 'brutto', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'brutto'},
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('SzamlaTetelInsert', $szamla->id) !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", name: 'action', orderable: false, searchable: false},
                ],
            });

            function fieldsInit() {
                $('#barcode').val(null);
                $('#koltseg').val(null);
                $('#beszar').val(0);
                $('#brutto').val(0);
                $('#afa').val(0);
                $('#netto').val(0);
            }

            function szamlaErtekek() {
                var beszar = $('#termek_beszar').val();
                var csoport = $('#termek_csoport').val();
                var termek = $('#termek').val();
                if ( beszar != 0 && termek != 0 && csoport != 0) {
                    $.ajax({
                        type: "GET",
                        url: "{{url('api/getTermekCsoport')}}",
                        data: "&id=" + csoport,
                        success: function (response) {
                            let afaKod = parseInt(response.afa);
                            if ( afaKod != 0 ) {
                                var afaSzaz = parseInt(afaSzazalek(afaKod));
                                $('#afaszaz').val(afaKod);
                                var nettoErtek = (parseInt(beszar) / (100 + afaSzaz)) * 100;
                                var afaErtek = (parseInt(beszar) / (100 + afaSzaz)) * afaSzaz;
                                $('#afa').val(beszar - nettoErtek.toFixed(0));
                                $('#netto').val(nettoErtek.toFixed(0));
                                $('#brutto').val(beszar);
                            }
                        },
                        error: function (response) {
                            console.log('Error:', response);
                        }
                    });


                }
            }

            $('#termek_beszar').change(function() {
                $('#beszar').val($('#termek_beszar').val());
                arSzamol('Termék');
                szamlaErtekek();
            });

            $('#termek_mennyiseg').change(function() {
                $('#mennyiseg').val($('#termek_mennyiseg').val());
            });

            $('#mennyiseg').change(function() {
                $('#termek_mennyiseg').val($('#mennyiseg').val());
                arSzamol('Termék');
                bruttoSzamitas();
            });

            $('#termek').change(function() {
                var termek = $('#termek').val();
                if ( termek != 0 ) {
                    fieldsInit();
                    afaSzazToltes(termek);
                    $.ajax({
                        type: "GET",
                        url:"{{url('api/getTermek')}}",
                        data: { id: termek },
                        success: function (response) {
                            if ( response != 0 ) {
                                var cikkszam = response.cikkszam;
                                if ( response.barcode ) {
                                    $('#barcode').val(response.barcode)
                                } else {
                                    $('#barcode').val(response.cikkszam);
                                }

                                if ( cikkszam.substr(0, 1) == 'T' ) {
                                    $('#beszar').val(parseInt(response.beszar));
                                    var brutto  = parseInt(response.beszar) * $('#mennyiseg').val();
                                    $('#brutto').val(brutto);
                                    var afa = parseInt(afaSzazalek($('#afaszaz').val()));
                                    $('#afa').val(((brutto / (100 + afa)) * afa).toFixed(0));
                                    $('#netto').val(brutto - $('#afa').val());
                                    $('#koltseg').val(9);
                                }
                                if ( cikkszam.substr(0, 1) == 'S' ) {
                                    $('#koltseg').val(10);
                                    $('#brutto').val(null);
                                    $('#brutto').focus();
                                }
                            }
                        },
                        error: function (response) {
                            console.log('Error:', response);
                            alert('nem ok');
                        }
                    });

                }
                $('#mennyiseg').focus();
            });

            function bruttoSzamitas() {
                var termek = $('#termek').val();
                var mennyiseg = $('#mennyiseg').val();
                var beszar = $('#beszar').val();
                var brutto = mennyiseg * beszar;
                $('#brutto').val(brutto);
                $.ajax({
                    type: "GET",
                    url:"{{url('api/getTermekAfaSzazalek')}}",
                    data: { id: termek },
                    success: function (response) {
                        if ( response != 0 ) {
                            var afa = parseInt(response);
                            var netto = (brutto / (100 + afa) * 100).toFixed(0);
                            $('#netto').val(netto);
                            $('#afa').val(brutto - netto);
                        }
                    },
                    error: function (response) {
                        console.log('Error:', response);
                        alert('nem ok');
                    }
                });
            }

            function newProductFields(tf) {
                if (!tf) {
                    ujTermekMezok(false);
                    $('.jelzok').css("margin-top", "-100px" );
                    $('#termek_partner').val(<?php echo $szamla->partner; ?>);
                    $('#koltseg').val(9);
                    $('#koltseg').attr("readonly",true);
                    $("#koltseg").css("cursor", "not-allowed" );
                    $('#mennyiseg').hide();
                    $('#mennyiseglabel').hide();
                    $('#afa').hide();
                    $('#afalabel').hide();
                    $('#netto').hide();
                    $('#nettolabel').hide();
                    $('#brutto').hide();
                    $('#bruttolabel').hide();
/*                    $('#brutto').attr("readonly",true);
                    $('#brutto').css("cursor", "not-allowed" );*/
                    $('#pgomb').show();
                    $('#termek_nev').focus();
                    $('.gombok').css("margin-top", "0px" );
                    $('.tablazat').css("margin-top", "0px" );

                } else {
                    ujTermekMezok(true);
                    ptf = false;
                    partnerFields(ptf);
                    $('.jelzok').css("margin-top", "0px" );
                    $('#koltseg').val(null);
                    $('#koltseg').attr("readonly",false);
                    $("#koltseg").css("cursor", "default" );
                    $('#mennyiseg').show();
                    $('#mennyiseglabel').show();
                    $('#afa').show();
                    $('#afalabel').show();
                    $('#netto').show();
                    $('#nettolabel').show();
                    $('#brutto').show();
                    $('#bruttolabel').show();
/*                    $('#brutto').attr("readonly",false);
                    $('#brutto').css("cursor", "default" );*/
                    $('#pgomb').hide();
                    $('#termek_nev').focus();
                    $('.gombok').css("margin-top", "-200px" );
                    $('.tablazat').css("margin-top", "-170px" );
                }
            }

            $('.termekgomb').click(function () {
                tf = !tf;
                newProductFields(tf);
            });

            $('#termek_csoport').change(function() {
                $('#csoport').val($('#termek_csoport').val());
            });

            $('#barcode').change(function() {
                var barcode = $('#barcode').val();
                if (barcode != 0) {
                    barcode = barcodeReplace(barcode);
                    $("#barcode").val(barcode);
                    $.ajax({
                        type: "GET",
                        url:"{{url('api/getBarcodeTermek')}}",
                        data: { barcode: barcode },
                        success: function (response) {
                            if ( !response.id ) {
                                newProductFields();
                            } else {
                                $('#koltseg').val(9);
                                $('#termek').val(response.id);
                                $('#csoport').val(response.csoport);
                                $('#beszar').val(response.beszar);
                                bruttoSzamitas();
                                afaSzazMezobe(response.id, '#afaszaz');
                                $('#mennyiseg').focus();

                                ujTermekMezok(true);
                            }
                        },
                        error: function (response) {
                            console.log('Error:', response);
                            swal( "Hiba",  "A api/getBarcodeTermek hibát generált!",  "error" );
                        }
                    });
                }
            });

            termekCsoportChange();

            let mezok = ["glutenmentes", "laktozmentes", "tejmentes", "tojasmentes", "cukormentes", "vegan"]

            fieldCheck(mezok);

            termekCheckBoxFieldChange();

            $('#adoszam').inputmask();
            $('#bankszamla').inputmask();

            let partnerMezok = [
                '#nevlabel', '#nev', '#adoszamlabel', '#adoszam', '#bankszamlalabel', '#bankszamla',
                '#iszlabel', '#isz', '#telepuleslabel', '#telepules', '#cimlabel', '#cim',
                '#tipuslabel', '#tipus', '#emaillabel', '#email', '#telefonszamlabel', '#telefonszam'
            ]

            function partnerFields(mire) {
                if (mire) {
                    $('#partner').val(null);
                    $('#partner').prop('required', false);
                    $('#partner').hide();
                    $('.jelzok').css("margin-top", "0px" );
                } else {
                    $('#partner').prop('required', true);
                    $('#partner').show();
                    $('#partner').focus();
                    $('.jelzok').css("margin-top", "-100px" );
                }
                for ( i = 0; i < partnerMezok.length; i++ ) {
                    if (mire) {
                        $(partnerMezok[i]).show();
                    } else {
                        $(partnerMezok[i]).val(null);
                        $(partnerMezok[i]).hide();
                    }
                }
                if (mire) {
                    $('#nev').focus();
                }
            }

            partnerFields(ptf);
            $('#pgomb').hide();

            $('#pgomb').click(function () {
                ptf = !ptf;
                partnerFields(ptf);
            });

            $('#brutto').change(function() {
                let brutto = $('#brutto').val();
                if ( brutto != 0 ) {
                    var termek = $('#termek').val();
                    var mennyiseg = $('#mennyiseg').val();
                    $.ajax({
                        type: "GET",
                        url:"{{url('api/getTermekAfaSzazalek')}}",
                        data: { id: termek },
                        success: function (response) {
                            if ( response != 0 ) {
                                var afa = parseInt(response);
                                var netto = (brutto / (100 + afa) * 100).toFixed(0);
                                $('#netto').val(netto);
                                $('#afa').val(brutto - netto);
                                $('#beszar').val((brutto / mennyiseg).toFixed(0));
                            }
                        },
                        error: function (response) {
                            console.log('Error:', response);
                            alert('nem ok');
                        }
                    });
                }
            });

            $('#mennyiseg').change(function() {
                $('#brutto').focus();
            });

        });

    </script>
@endsection
