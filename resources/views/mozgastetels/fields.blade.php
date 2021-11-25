@section('css')
    @include('layouts.costumcss')
@endsection

<div class="col-lg-12">
    {!! Form::hidden('mozgasfej', $mozgasFej->id, ['class'=>'form-control', 'readonly' => 'true', 'id' => 'mozgasfej']) !!}
    {!! Form::hidden('honnan', $mozgasFej->honnan, ['class'=>'form-control', 'id' => 'honnan']) !!}
    {!! Form::hidden('hova', $mozgasFej->hova, ['class'=>'form-control', 'id' => 'hova']) !!}
    {!! Form::hidden('darab', 0, ['class'=>'form-control', 'id' => 'darab']) !!}
    {!! Form::hidden('menny', 0, ['class'=>'form-control', 'id' => 'menny']) !!}
    <div class="col-lg-2">
        {!! Form::text('barcode', null, ['style' => 'cursor: not-allowed', 'class' => 'form-control text-right', 'id' => 'barcode', 'autofocus', 'placeholder' => 'Vonalkód']) !!}
    </div>
    <div class="mylabel col-sm-1">
        {!! Form::label('termek', 'Termék:') !!}
    </div>
    <div class="col-sm-4">
        {!! Form::select('termek', App\Classes\DDW::termekDDW(), null, ['class'=>'select2 form-control', 'required' => 'true', 'id' => 'termek']) !!}
    </div>
    <div class="mylabel col-sm-1">
        {!! Form::label('mennyiseg', 'Mennyiség:') !!}
    </div>
    <div class="col-sm-2">
        {!! Form::number('mennyiseg', null, ['class' => 'form-control text-right', 'required' => 'true', 'id' => 'mennyiseg']) !!}
    </div>
    <!-- Submit Field -->
    <div class="form-group col-sm-2">
        {!! Form::submit('Ment', ['class' => 'btn btn-primary ment']) !!}
        <a href="{!! route('mozgasfejs.index') !!}" class="btn btn-default">Kilép</a>
    </div>
    <div class="col-sm-12">
        <div class="col-sm-6">
            <div class="form-group col-sm-12">
                {!! Form::label('termek_nev', 'Név:', ['id' => 'termek_nevlabel']) !!}
                {!! Form::text('termek_nev', null, ['class' => 'form-control', 'required' => 'true', 'id' => 'termek_nev']) !!}
            </div>
            <div class="form-group col-sm-12">
                {!! Form::label('termek_csoport', 'Csoport:', ['id' => 'termek_csoportlabel']) !!}
                {!! Form::select('termek_csoport', App\Classes\DDW::termekCsoportDdw(), null,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'termek_csoport']) !!}
            </div>
            <div class="form-group col-sm-12">
                {!! Form::label('termek_partner', 'Partner:', ['id' => 'termek_partnerlabel']) !!}
                {!! Form::select('termek_partner', App\Classes\DDW::partnerDdw(), null,['class'=>'select2 form-control', 'id' => 'termek_partner']) !!}
            </div>
        </div>
        <!-- Me Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('termek_cikkszam', 'Cikkszám:', ['id' => 'termek_cikkszamlabel']) !!}
            {!! Form::text('termek_cikkszam', null, ['style' => 'cursor: not-allowed', 'class' => 'form-control', 'id' => 'termek_cikkszam']) !!}
        </div>
        <div class="col-sm-6">
            <div class="row">
                <div class="form-group col-sm-4">
                    {!! Form::label('termek_me', 'Menny.egység:', ['id' => 'termek_melabel']) !!}
                    {!! Form::select('termek_me', App\Classes\DDW::dictionaryDdw(26), null,['class'=>'select2 form-control', 'id' => 'termek_me']) !!}
                </div>
                <div class="form-group col-sm-4">
                    {!! Form::label('termek_minmenny', 'Minimális:', ['id' => 'termek_minmennylabel']) !!}
                    {!! Form::number('termek_minmenny', null, ['class' => 'form-control  text-right', 'id' => 'termek_minmenny']) !!}
                </div>
                <div class="form-group col-sm-4">
                    {!! Form::label('termek_mennyiseg', 'Mennyiség:', ['id' => 'termek_mennyiseglabel']) !!}
                    {!! Form::number('termek_mennyiseg', null, ['class' => 'form-control  text-right', 'id' => 'termek_mennyiseg']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    {!! Form::label('termek_beszar', 'Beszerzési ár:', ['id' => 'termek_beszarlabel']) !!}
                    {!! Form::number('termek_beszar', null, ['class' => 'form-control  text-right', 'id' => 'termek_beszar']) !!}
                </div>
                <div class="form-group col-sm-6">
                    {!! Form::label('termek_ar', 'Ár:', ['id' => 'termek_arlabel']) !!}
                    {!! Form::number('termek_ar', null, ['class' => 'form-control  text-right', 'id' => 'termek_ar']) !!}
                </div>
            </div>
        </div>
        <div class="row">
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
    </div>
</div>

<div class="col-lg-12 col-md-12 col-xs-12" style="margin-top: -55px;" id="tablerow">

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

            var table = $('.tetel-table').DataTable({
                serverSide: true,
                scrollY: 250,
                colReorder: true,
                paging: false,
                buttons: [],
                dom: '<"clear">',
                order: [[0, 'asc']],
                ajax: "{{ route('tetelIndex', $mozgasFej->id ) }}",
                columns: [
                    {title: 'Termék', data: 'termeknev', name: 'termeknev'},
                    {title: 'Mennyiség', data: 'mennyiseg', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'mennyiseg'},
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('BevetTetelInsert', $mozgasFej->id) !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", name: 'action', orderable: false, searchable: false},
                ],
            });

            ujTermekMezok(true);

            termekCsoportChange();

            $('#termek_beszar').change(function() {
                arSzamol('Termék');
                szamlaErtekek();
            });

            function termekMennyiseg(mennyiseg) {
                $('#termek_mennyiseg').val(mennyiseg);
                arSzamol('Termék');
                $('.ment').focus();
                $('.ment').click();
            }

            $('#mennyiseg').change(function() {
                let honnan = $('#honnan').val();
                if ( honnan == 2093 || honnan == 2094 ) {
                    let darab = parseInt($('#darab').val());
                    let mennyiseg = parseInt($('#mennyiseg').val()) + parseInt($('#menny').val());
                    console.log(mennyiseg, darab);
                    if ( mennyiseg > darab ) {
                        alert('Nem mozgathat nagyobb mennyiséget, mint amennyi készleten van: '+ darab.toString() );
                        $('#mennyiseg').val(null);
                        $('#mennyiseg').focus();
                    } else {
                        termekMennyiseg(mennyiseg);
                    }
                } else {
                    termekMennyiseg(mennyiseg);
                }
            });

            function mozgasTermekMennyiseg() {
                let id = $('#mozgasfej').val();
                let termek = $('#termek').val();
                $.ajax({
                    type: "GET",
                    url: "{{url('api/getMozgasTermekMennyiseg')}}",
                    data: { id: id, termek: termek },
                    success: function (response) {
                        console.log('response', response);
                        $('#menny').val(response);
                    },
                    error: function (response) {
                        console.log('Error:', response);
                        alert('nem ok');
                    }
                });
            }

            function raktarKeszlet( termek, honnan) {
                $.ajax({
                    type: "GET",
                    url: "{{url('api/getTermekRaktaron')}}",
                    data: { raktar: honnan, termek: termek },
                    success: function (response) {
                        $('#darab').val(response.mennyiseg);
                    },
                    error: function (response) {
                        console.log('Error:', response);
                        alert('nem ok');
                    }
                });
            }

            $('#barcode').change(function() {
                var barcode = $('#barcode').val();
                let honnan = $('#honnan').val();
                if (barcode != 0) {
                    barcode = barcodeReplace(barcode);
                    $("#barcode").val(barcode);
                    $.ajax({
                        type: "GET",
                        url: "{{url('api/getBarcodeTermek')}}",
                        data: { barcode: barcode },
                        success: function (response) {
                            if ( !response.id ) {
                                if ( honnan == 2093 || honnan == 2094 ) {
                                    alert('Nincs ilyen vonalkódú tétel!');
                                    $('#barcode').val(null);
                                    $('#barcode').focus();
                                } else {
                                    ujTermekMezok(false);
                                    $('#tablerow').css("margin-top", "0px" );
                                    $('#termek_nev').focus();
                                }
                            } else {
                                $('#termek').val(response.id);
                                $('#termek').attr("readonly",true);
                                $('#termek').css("cursor", "not-allowed" );

                                raktarKeszlet(response.id, honnan);
                                mozgasTermekMennyiseg();

                                $('#mennyiseg').focus();
                                ujTermekMezok(true);
                            }
                        },
                        error: function (response) {
                            console.log('Error:', response);
                            alert('nem ok');
                        }
                    });
                }
            });

            let mezok = ["glutenmentes", "laktozmentes", "tejmentes", "tojasmentes", "cukormentes", "vegan"]

            fieldCheck(mezok);

            termekCheckBoxFieldChange();
        });

    </script>
@endsection



