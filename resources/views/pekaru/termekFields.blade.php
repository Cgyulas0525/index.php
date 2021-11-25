@section('css')
    @include('layouts.costumcss')
@endsection

<!-- Nev Field -->
<div class="form-group col-sm-6">
    <div class="row">
        <div class="mylabel col-sm-2">
            {!! Form::label('barcode', 'Vonalkód:') !!}
        </div>
        <div class="col-sm-10">
            {!! Form::text('barcode', !empty($termek->id) ? $termek->vonalkod : null, ['style' => 'cursor: not-allowed', 'class' => 'form-control text-right', 'id' => 'barcode', 'autofocus']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-2">
            {!! Form::label('focsoport', 'Főcsoport:') !!}
        </div>
        <div class="col-sm-10">
            {!! Form::select('focsoport', App\Classes\DDW::termekFoCsoportDdw(),
                                          !empty($termek->id) ? $termek->focsoport : (!empty($termekcsoport->focsoport) ? $termekcsoport->focsoport :null),
                                          ['class'=>'select2 form-control', 'required' => 'true', 'id' => 'focsoport']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-2">
            {!! Form::label('csoport', 'Csoport:') !!}
        </div>
        <div class="col-sm-10">
            {!! Form::select('csoport', App\Classes\DDW::termekCsoportDdw(),
                                        !empty($termek->id) ? $termek->csoport : (!empty($termekcsoport->id) ? $termekcsoport->id :null),
                                        ['class'=>'select2 form-control', 'required' => 'true', 'id' => 'csoport']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-2">
            {!! Form::label('nev', 'Név:') !!}
        </div>
        <div class="col-sm-10">
            {!! Form::text('nev', null, ['class' => 'form-control', 'required' => 'true', 'id' => 'nev']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="ujtetelcol col-sm-2">
            <a class="btn btn-default ujtetelgomb" id="pgomb" title="Partner" href="#">Partner</a>
        </div>
        <div class="col-sm-10">
            {!! Form::select('partner', App\Classes\DDW::partnerSzallitoDdw(), null,['class'=>'select2 form-control', 'id' => 'partner']) !!}
        </div>
    </div>
</div>
<!-- Me Field -->
<div class="form-group col-sm-6">
    <div class="row">
        <div class="mylabel col-sm-2">
            {!! Form::label('cikkszam', 'Cikkszám:') !!}
        </div>
        <div class="col-sm-10">
            {!! Form::text('cikkszam', null, ['style' => 'cursor: not-allowed', 'class' => 'form-control', 'id' => 'cikkszam']) !!}
        </div>
    </div>
    <br>
    {!! Form::hidden('tsz', null, ['style' => 'cursor: not-allowed', 'class' => 'form-control', 'id' => 'tsz']) !!}
</div>
<div class="form-group col-sm-6">
    <div class="form-group col-sm-4">
        <div class="row">
            <div class="mylabel col-sm-2">
                {!! Form::label('melabel', 'Me.:', ['id' => 'melabel']) !!}
            </div>
            <div class="col-sm-10">
                {!! Form::select('me', App\Classes\DDW::dictionaryDdw(26), !empty($termek->me) ? $termek->me : App\Classes\Api::getDarabId(),['class'=>'select2 form-control', 'id' => 'me']) !!}
            </div>
        </div>
    </div>
    <div class="form-group col-sm-4">
        <div class="row">
            <div class="mylabel col-sm-4">
                {!! Form::label('minmennylabel', 'Minimális:', ['id' => 'minmennylabel']) !!}
            </div>
            <div class="col-sm-8">
                {!! Form::number('minmenny', !empty($termek->minmenny) ? $termek->minmenny : 1, ['class' => 'form-control  text-right', 'id' => 'minmenny']) !!}
            </div>
        </div>
    </div>
    <div class="form-group col-sm-4">
        <div class="row">
            <div class="mylabel col-sm-4">
                {!! Form::label('mennyiseglabel', 'Mennyiség:', ['id' => 'mennyiseglabel']) !!}
            </div>
            <div class="col-sm-8">
                {!! Form::number('mennyiseg', !empty($termek->mennyiseg) ? $termek->mennyiseg : 1, ['class' => 'form-control  text-right', 'id' => 'mennyiseg']) !!}
            </div>
        </div>
    </div>
    <div class="form-group col-sm-6">
        <div class="row">
            <div class="mylabel col-sm-5">
                {!! Form::label('beszarlabel', 'Beszerzési ár:', ['id' => 'beszarlabel']) !!}
            </div>
            <div class="col-sm-7">
                {!! Form::number('beszar', null, ['class' => 'form-control  text-right', 'id' => 'beszar']) !!}
            </div>
        </div>
    </div>
    <div class="form-group col-sm-6">
        <div class="row">
            <div class="mylabel col-sm-5">
                {!! Form::label('arlabel', 'Ár:', ['id' => 'arlabel']) !!}
            </div>
            <div class="col-sm-7">
                {!! Form::number('ar', null, ['class' => 'form-control  text-right', 'id' => 'ar']) !!}
            </div>
        </div>
    </div>
</div>

@include('termeks.termekjelzok')
@include('termeks.termekjellemzok', array('ro' => 'false'))

<div class="form-group col-sm-12">
    @include('partners.ujPartnerFields')
</div>

<!-- Megjegyzes Field -->
<div class="form-group col-sm-12" id="megjegyz">
    {!! Form::label('megjegyzes', 'Megjegyzés:') !!}
    {!! Form::textarea('megjegyzes', null, ['class' => 'form-control', 'rows' => 4]) !!}
</div>

@section('scripts')

    @include('functions.ajax_js')

    @include('functions.kovetkezoCikkszam_js')

    @include('functions.barcode_js')
    @include('functions.checkBoxes_js')
    @include('functions.termek.termekCheckBoxFieldChange_js')
    @include('functions.api_js')
    @include('functions.kerekit_js')
    @include('functions.csoportddw_js')
    @include('functions.termek.arszamol_js')
    @include('functions.termek.termekJelzoMezok_js')
    @include('functions.partner.partnerMezok_js')

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            $('#partner_adoszam').inputmask();
            $('#partner_bankszamla').inputmask();

            let mezok = termekJezoMezok();

            let pMezok = partnerMezok();

            let ptf = false;

            partnerFields(ptf, pMezok);
            $('#megjegyz').css("margin-top", "-100px" );

            $('#pgomb').click(function () {
                ptf = !ptf;
                partnerFields(ptf, pMezok);
                if (!ptf) {
                    $('#megjegyz').css("margin-top", "-100px" );
                } else {
                    $('#megjegyz').css("margin-top", "0px" );
                }
            });

            fieldCheck(mezok);

            termekCheckBoxFieldChange();

            $('#barcode').change(function() {
                vanEIlyenBarcode($('#barcode').val());
            });

            $('#csoport').change(function() {
                arSzamol();
                getFocsoportFromCsoport($('#csoport').val(), '#cikkszam');
            });


            $('#beszar').change(function () {
                arSzamol();
            });

            $('#partner').change(function () {
                $('#beszar').val(null);
                $('#beszar').focus();
            });

            for ( i = 0; i < mezok.length; i++ ) {
                let checkBox = document.getElementById(mezok[i]);
                checkBox.checked = true;
                $('#'.concat(mezok[i])).val(1);
            }

            let cikkszam = $('#cikkszam').val();
            if ( isNaN(cikkszam)) {
                getFocsoportFromCsoport($('#csoport').val(), 'cikkszam');
            }

        });
    </script>
@endsection
