@section('css')
    @include('layouts.costumcss')
@endsection

<!-- Partner Field -->
<div class="form-group col-sm-12">
    @include('partners.partnerFields')
</div>
<div class="form-group col-sm-6" id="csoport">
    <div class="row">
        <div class="ujtetelcol col-sm-2">
            <a class="btn btn-default ujtetelgomb partnergomb" title="Partner" href="#">Partner</a>
        </div>
        <div class="col-sm-10">
            {!! Form::select('partner', App\Classes\DDW::partnerSzallitoDdw(), null,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'partner']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-2">
            {!! Form::label('szamlaszam', 'Szamlaszám:') !!}
        </div>
        <div class="col-sm-10">
            {!! Form::text('szamlaszam', null, ['class' => 'form-control', 'required' => 'true']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-2">
            {!! Form::label('fizitesimod', 'Fizitésimód:') !!}
        </div>
        <div class="col-sm-10">
            {!! Form::select('fizitesimod', App\Classes\DDW::dictionaryDdw(25), null,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'fizitesimod']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-2">
            {!! Form::label('osszeg', 'Összeg:') !!}
        </div>
        <div class="col-sm-10">
            {!! Form::number('osszeg', null, ['class' => 'form-control  text-right', 'required' => 'true']) !!}
        </div>
    </div>
</div>
<!-- Kelt Field -->
<div class="form-group col-sm-6" id="csoport1">
    <div class="row">
        <div class="mylabel col-sm-3">
            {!! Form::label('kelt', 'Kelt:') !!}
        </div>
        <div class="col-sm-3">
            {!! Form::date('kelt', \Carbon\Carbon::now(), ['class' => 'form-control', 'required' => 'true', 'id'=>'kelt']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-3">
            {!! Form::label('teljesites', 'Teljesítés:') !!}
        </div>
        <div class="col-sm-3">
            {!! Form::date('teljesites', null, ['class' => 'form-control', 'required' => 'true','id'=>'teljesites']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-3">
            {!! Form::label('fizetesihatarido', 'Fizetési határidő:') !!}
        </div>
        <div class="col-sm-3">
            {!! Form::date('fizetesihatarido', null, ['class' => 'form-control', 'required' => 'true','id'=>'fizetesihatarido']) !!}
        </div>
    </div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('szamlas.index') !!}" class="btn btn-default">Kilép</a>
</div>

@section('scripts')
    @include('functions.ajax_js')
    @include('functions.required_js')
    @include('szamlas.szamla_js')
    @include('functions.apis.getPartner')
    @include('functions.api_js')

    <script type="text/javascript">

        ajaxSetup();

        $('#adoszam').inputmask();
        $('#bankszamla').inputmask();

        let tf = false;

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
                $('#csoport').css("margin-top", "0px" );
                $('#csoport1').css("margin-top", "0px" );
            } else {
                $('#partner').prop('required', true);
                $('#partner').show();
                $('#partner').focus();
                $('#csoport').css("margin-top", "-90px" );
                $('#csoport1').css("margin-top", "-90px" );
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

        $('.partnergomb').click(function () {
            tf = !tf;
            partnerFields(tf);
        });

        $('#partner').change(function() {
            let partner = $('#partner').val();
            console.log('Partner:', partner);
            $.ajax({
                type: "GET",
                url:"{{url('api/getPartner')}}",
                data: { id: partner },
                success: function (response) {
                    if ( response != 0 ) {
                        $('#nev').val(response.nev);
                        $('#adoszam').val(response.adoszam);
                        $('#bankszamla').val(response.bankszamla);
                        $('#isz').val(response.isz);
                        $('#telepules').val(response.telepules);
                        $('#cim').val(response.cim);
                        $('#tipus').val(response.tipus);
                        $('#email').val(response.email);
                        $('#telefonszam').val(response.telefonszam);
                    }
                },
                error: function (response) {
                    console.log('Error:', response);
                    alert('nem ok');
                }
            });
        });

        partnerFields(tf);

        /*        var submitButton = document.querySelector('.form-group .btn.btn-primary');
                submitButton.addEventListener('click', function(ev) {
                    ev.preventDefault();
                    alert('baszki ez működik');
                })*/

    </script>

@endsection
