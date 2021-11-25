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
            {!! Form::text('barcode', !empty($termek->barcode) ? $termek->barcode : null, ['style' => 'cursor: not-allowed', 'readonly' => 'true', 'class' => 'form-control text-right', 'id' => 'barcode']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-2">
            {!! Form::label('focsoport', 'Főcsoport:') !!}
        </div>
        <div class="col-sm-10">
            {!! Form::text('focsoport', $termek->focsoportnev, ['class'=>'select2 form-control', 'required' => 'true', 'readonly' => 'true', 'id' => 'focsoport']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-2">
            {!! Form::label('csoport', 'Csoport:') !!}
        </div>
        <div class="col-sm-10">
            {!! Form::text('csoport', $termek->csoportnev, ['class'=>'select2 form-control', 'required' => 'true', 'readonly' => 'true', 'id' => 'csoport']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-2">
            {!! Form::label('nev', 'Név:') !!}
        </div>
        <div class="col-sm-10">
            {!! Form::text('nev', $termek->nev, ['class' => 'form-control', 'required' => 'true', 'readonly' => 'true', 'id' => 'nev']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="ujtetelcol col-sm-2">
            {!! Form::label('partner', 'Partner:') !!}
        </div>
        <div class="col-sm-10">
            {!! Form::text('partner', $termek->partnernev, ['class'=>'select2 form-control', 'readonly' => 'true', 'id' => 'partner']) !!}
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
            {!! Form::text('cikkszam', $termek->cikkszam, ['style' => 'cursor: not-allowed', 'readonly' => 'true', 'class' => 'form-control', 'id' => 'cikkszam']) !!}
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
                {!! Form::text('me', $termek->menev, ['class'=>'select2 form-control', 'readonly' => 'true', 'id' => 'me']) !!}
            </div>
        </div>
    </div>
    <div class="form-group col-sm-4">
        <div class="row">
            <div class="mylabel col-sm-4">
                {!! Form::label('minmennylabel', 'Minimális:', ['id' => 'minmennylabel']) !!}
            </div>
            <div class="col-sm-8">
                {!! Form::number('minmenny', $termek->minmenny, ['class' => 'form-control  text-right', 'readonly' => 'true', 'id' => 'minmenny']) !!}
            </div>
        </div>
    </div>
    <div class="form-group col-sm-4">
        <div class="row">
            <div class="mylabel col-sm-4">
                {!! Form::label('mennyiseglabel', 'Mennyiség:', ['id' => 'mennyiseglabel']) !!}
            </div>
            <div class="col-sm-8">
                {!! Form::number('mennyiseg', $termek->mennyiseg, ['class' => 'form-control  text-right', 'readonly' => 'true', 'id' => 'mennyiseg']) !!}
            </div>
        </div>
    </div>
    <div class="form-group col-sm-6">
        <div class="row">
            <div class="mylabel col-sm-5">
                {!! Form::label('beszarlabel', 'Beszerzési ár:', ['id' => 'beszarlabel']) !!}
            </div>
            <div class="col-sm-7">
                {!! Form::number('beszar', $termek->beszar, ['class' => 'form-control  text-right', 'readonly' => 'true', 'id' => 'beszar']) !!}
            </div>
        </div>
    </div>
    <div class="form-group col-sm-6">
        <div class="row">
            <div class="mylabel col-sm-5">
                {!! Form::label('arlabel', 'Ár:', ['id' => 'arlabel']) !!}
            </div>
            <div class="col-sm-7">
                {!! Form::number('ar', $termek->ar, ['class' => 'form-control  text-right', 'readonly' => 'true', 'id' => 'ar']) !!}
            </div>
        </div>
    </div>
</div>

@include('termeks.termekjelzok')
@include('termeks.termekjellemzok', array('ro' => 'true'))

<div class="col-xs-12" style="margin-top: 30px;">
    <div class="col-lg-6 col-md-6 col-xs-6" style="margin-top: -40px">

        <section class="content-header">
            <h1 class="pull-left">Raktár készlet</h1>
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

    <div class="col-lg-6 col-md-6 col-xs-6" style="margin-top: -40px">

        <section class="content-header">
            <h1 class="pull-left">Mozgások</h1>
        </section>
        <div class="content">
            <div class="clearfix"></div>

            @include('flash::message')

            <div class="clearfix"></div>
            <div class="box box-primary">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered mozgas-table" style="width: 100%;"></table>
                    </div>
                </div>
            </div>
            <div class="text-center">

            </div>
        </div>
    </div>

</div>


@section('scripts')

    @include('layouts.datatables_js')

    @include('functions.ajax_js')
    @include('functions.checkBoxes_js')
    @include('functions.termek.termekCheckBoxFieldChange_js')

    @include('functions.termek.termekJelzoMezok_js')
    @include('functions.partner.partnerMezok_js')


    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            var table = $('.tetel-table').DataTable({
                serverSide: true,
                scrollY: 375,
                order: [[1, 'asc'], [2, 'asc']],
                ajax: "{{ route('rkindex', $termek->id) }}",
                columns: [
                    {title: 'Raktár', data: 'raktarnev', name: 'raktarnev'},
                    {title: 'Termék', data: 'termeknev', name: 'termeknev'},
                    {title: 'Mennyiség', data: 'mennyiseg', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'mennyiseg'}
                ],
                buttons: [],
            });

            var table = $('.mozgas-table').DataTable({
                serverSide: true,
                scrollY: 375,
                order: [[0, 'desc'], [1, 'asc']],
                ajax: "{{ route('indexMozgasokTermek', $termek->id) }}",
                columns: [
                    {title: 'Dátum', data: 'datum', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'datum'},
                    {title: 'Bizonylat', data: 'bizszam', name: 'bizszam'},
                    {title: 'Menny.', data: 'mennyiseg', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'50px', name: 'mennyiseg'},
                ],
                buttons: [],
            });

            let mezok = termekJezoMezok();

            console.log(mezok);

            fieldCheck(mezok);

            termekCheckBoxFieldChange();

            for ( i = 0; i < mezok.length; i++ ) {
                let checkBox = document.getElementById(mezok[i]);
                checkBox.checked = true;
                $('#'.concat(mezok[i])).val(1);
            }

        });

    </script>
@endsection
