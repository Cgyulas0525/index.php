@section('css')
    @include('layouts.costumcss')
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="public/css/datatables.css">
    @include('layouts.costumcss')

@endsection

<!-- Partner Field -->
<div class="form-group col-sm-12">
    @include('partners.partnerFields')
</div>
<div class="form-group col-sm-12" id="csoport">
    <div class="form-group col-sm-4">
        <div class="row">
            <div class="ujtetelcol col-sm-2">
                <a class="btn btn-default ujtetelgomb partnergomb" title="Partner" href="#">Partner</a>
            </div>
            <div class="col-sm-10">
                {!! Form::select('partner_id', App\Classes\DDW::vevoDdw(), $vevoirendelesfej->partner_id,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'partner']) !!}
            </div>
        </div>
    </div>
    <div class="form-group col-sm-2">
        <div class="row">
            <div class="mylabel col-sm-3">
                {!! Form::label('mikorra', 'Mikorra:') !!}
            </div>
            <div class="col-sm-9">
                {!! Form::hidden('mikor', $vevoirendelesfej->mikor, ['class' => 'form-control','id'=>'mikor']) !!}
                {!! Form::date('mikorra', $vevoirendelesfej->mikorra, ['class' => 'form-control','id'=>'mikorra']) !!}
            </div>
        </div>
    </div>
    <div class="form-group col-sm-6">
        <div class="row">
            <div class="mylabel col-sm-2">
                {!! Form::label('megjegyzes', 'Megjegyzés:') !!}
            </div>
            <div class="col-sm-10">
                {!! Form::textarea('megjegyzes', $vevoirendelesfej->megjegyzes, ['class' => 'form-control', 'rows' => '1', 'id'=>'megjegyzes']) !!}
            </div>
        </div>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary', 'id' => 'mentes']) !!}
    <a href="{!! route('vevoirendelesfejs.index') !!}" class="btn btn-default">Kilép</a>
</div>

<div class="col-lg-12 col-md-12 col-xs-12">

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
    @include('functions.ajax_js')
    @include('functions.required_js')
    @include('szamlas.szamla_js')
    @include('functions.apis.getPartner')
    @include('functions.api_js')

    @include('layouts.datatables_js')
    @include('layouts.RowCallBack_js')

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

        var table = $('.tetel-table').DataTable({
            serverSide: true,
            scrollY: 390,
            scrollX: true,
            order: [[1, 'asc']],
            ajax: "{{ route('vrTetelIndex', $vevoirendelesfej->id) }}",
            columns: [
                {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('vevoiRendelesTetelInsert', $vevoirendelesfej->id) !!}"><i class="fa fa-plus-square"></i></a>',
                    data: 'action', sClass: "text-center", width: '200px', name: 'action', orderable: false, searchable: false},
                {title: 'Termék', data: 'termeknev', name: 'termeknev'},
                {title: 'Mennyiség', data: 'mennyiseg', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'mennyiseg'},
                {title: 'Átadott', data: 'atadott', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'atadott'},
            ]
        });

    </script>
@endsection
