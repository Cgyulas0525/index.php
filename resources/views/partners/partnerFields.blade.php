<div class="form-group col-sm-4">
    <div class="row">
        <div class="mylabel col-sm-3">
            {!! Form::label('nevlabel', 'Név:', ['id' => 'nevlabel']) !!}
        </div>
        <div class="col-sm-9">
            {!! Form::text('nev', null, ['class' => 'form-control', 'id' => 'nev'] ) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-3">
            {!! Form::label('adoszamlabel', 'Adószám:', ['id' => 'adoszamlabel']) !!}
        </div>
        <div class="col-sm-9">
            {!! Form::text('adoszam', null, ['class' => 'form-control', 'id' => 'adoszam', 'maxlength' => 13, 'data-inputmask'=>"'mask': '99999999-9-99'"]) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-3">
            {!! Form::label('bankszamlalabel', 'Bankszámla:', ['id' => 'bankszamlalabel']) !!}
        </div>
        <div class="col-sm-9">
            {!! Form::text('bankszamla', null, ['class' => 'form-control', 'id' => 'bankszamla', 'maxlength' => 26, 'data-inputmask'=>"'mask': '99999999-99999999-99999999'"]) !!}
        </div>
    </div>
</div>

<!-- Isz Field -->
<div class="form-group col-sm-4">
    <div class="row">
        <div class="mylabel col-sm-3">
            {!! Form::label('iszlabel', 'Isz:', ['id' => 'iszlabel']) !!}
        </div>
        <div class="col-sm-9">
            {!! Form::select('isz', App\Models\Telepules::ddwIsz(), null,['class'=>'select2 form-control', 'id' => 'isz']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-3">
            {!! Form::label('telepuleslabel', 'Település:', ['id' => 'telepuleslabel']) !!}
        </div>
        <div class="col-sm-9">
            {!! Form::select('telepules', App\Models\Telepules::ddw(), null,['class'=>'select2 form-control', 'id' => 'telepules']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-3">
            {!! Form::label('cimlabel', 'Cím:', ['id' => 'cimlabel']) !!}
        </div>
        <div class="col-sm-9">
            {!! Form::text('cim', null, ['class' => 'form-control', 'id' => 'cim']) !!}
        </div>
    </div>
</div>

<div class="form-group col-sm-4">
    <div class="row">
        <div class="mylabel col-sm-3">
            {!! Form::label('tipuslabel', 'Típus:', ['id' => 'tipuslabel']) !!}
        </div>
        <div class="col-sm-9">
            {!! Form::select('tipus', App\Classes\DDW::dictionaryDdw(24), null,['class'=>'select2 form-control', 'id' => 'tipus']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-3">
            {!! Form::label('emaillabel', 'Email:', ['id' => 'emaillabel']) !!}
        </div>
        <div class="col-sm-9">
            {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-3">
            {!! Form::label('telefonszamlabel', 'Telefonszám:', ['id' => 'telefonszamlabel']) !!}
        </div>
        <div class="col-sm-9">
            {!! Form::text('telefonszam', null, ['class' => 'form-control', 'id' => 'telefonszam']) !!}
        </div>
    </div>
</div>
