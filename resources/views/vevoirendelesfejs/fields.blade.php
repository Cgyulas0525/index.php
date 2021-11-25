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
            {!! Form::select('partner_id', App\Classes\DDW::vevoDdw(), null,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'partner']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-2">
            {!! Form::label('mikorra', 'Mikorra:') !!}
        </div>
        <div class="col-sm-4">
            {!! Form::hidden('mikor', \Carbon\Carbon::now(), ['class' => 'form-control','id'=>'mikor']) !!}
            {!! Form::date('mikorra', null, ['class' => 'form-control','id'=>'mikorra']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-2">
            {!! Form::label('megjegyzes', 'Megjegyzés:') !!}
        </div>
        <div class="col-sm-10">
            {!! Form::textarea('megjegyzes', null, ['class' => 'form-control', 'rows' => '4', 'id'=>'megjegyzes']) !!}
        </div>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary', 'id' => 'mentes']) !!}
    <a href="{!! route('vevoirendelesfejs.index') !!}" class="btn btn-default">Kilép</a>
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

        $('#mentes').click(function (e) {
            let partner = $('#partner').val();
            let nev = $('nev').val();
            console.log(nev);
            if ( partner == 0 && (nev == 0 || nev == undefined) ) {
                alert('Nem adott meg partner!');
                e.preventDefault();
                $('#partner').focus();
                return false;
            }
        });

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

        function dateForm(date) {
            var result = new Date(date);
            var d = result.getDate();
            var m =  result.getMonth() + 1;
            m = m.toString().length == 1 ? '0'+m.toString() : m.toString();
            var y = result.getFullYear();
            result = (y + "-" + m + "-" + d);
            return result;
        }

        $('#mikorra').change(function(){
            let mikor = dateForm($('#mikor').val());
            let mikorra = dateForm($('#mikorra').val());
            if (mikorra < mikor) {
                alert('Nem adhat meg korábbi dátumot!');
                $('#mikorra').val(null);
                $('#mikorra').focus();
            } else {
                let nev = $('#nev').val();
                if ( nev == 0 ) {
                    $('#partner').focus();
                } else {
                    $('#megjegyzes').focus();
                }
            }
        });
    </script>
@endsection
