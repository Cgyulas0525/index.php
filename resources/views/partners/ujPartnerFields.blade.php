<div class="form-group col-sm-4">
    <div class="row">
        <div class="mylabel col-sm-3">
            {!! Form::label('partner_nevlabel', 'Név:', ['id' => 'partner_nevlabel']) !!}
        </div>
        <div class="col-sm-9">
            {!! Form::text('partner_nev', null, ['class' => 'form-control', 'id' => 'partner_nev'] ) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-3">
            {!! Form::label('partner_adoszamlabel', 'Adószám:', ['id' => 'partner_adoszamlabel']) !!}
        </div>
        <div class="col-sm-9">
            {!! Form::text('partner_adoszam', null, ['class' => 'form-control', 'id' => 'partner_adoszam', 'maxlength' => 13, 'data-inputmask'=>"'mask': '99999999-9-99'"]) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-3">
            {!! Form::label('partner_bankszamlalabel', 'Bankszámla:', ['id' => 'partner_bankszamlalabel']) !!}
        </div>
        <div class="col-sm-9">
            {!! Form::text('partner_bankszamla', null, ['class' => 'form-control', 'id' => 'partner_bankszamla', 'maxlength' => 26, 'data-inputmask'=>"'mask': '99999999-99999999-99999999'"]) !!}
        </div>
    </div>
</div>

<!-- Isz Field -->
<div class="form-group col-sm-4">
    <div class="row">
        <div class="mylabel col-sm-3">
            {!! Form::label('partner_iszlabel', 'Isz:', ['id' => 'partner_iszlabel']) !!}
        </div>
        <div class="col-sm-9">
            {!! Form::select('partner_isz', App\Models\Telepules::ddwIsz(), null,['class'=>'select2 form-control', 'id' => 'partner_isz']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-3">
            {!! Form::label('partner_telepuleslabel', 'Település:', ['id' => 'partner_telepuleslabel']) !!}
        </div>
        <div class="col-sm-9">
            {!! Form::select('partner_telepules', App\Models\Telepules::ddw(), null,['class'=>'select2 form-control', 'id' => 'partner_telepules']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-3">
            {!! Form::label('partner_cimlabel', 'Cím:', ['id' => 'partner_cimlabel']) !!}
        </div>
        <div class="col-sm-9">
            {!! Form::text('partner_cim', null, ['class' => 'form-control', 'id' => 'partner_cim']) !!}
        </div>
    </div>
</div>

<div class="form-group col-sm-4">
    <div class="row">
        <div class="mylabel col-sm-3">
            {!! Form::label('partner_tipuslabel', 'Típus:', ['id' => 'partner_tipuslabel']) !!}
        </div>
        <div class="col-sm-9">
            {!! Form::select('partner_tipus', App\Classes\DDW::dictionaryDdw(24), null,['class'=>'select2 form-control', 'id' => 'partner_tipus']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-3">
            {!! Form::label('partner_emaillabel', 'Email:', ['id' => 'partner_emaillabel']) !!}
        </div>
        <div class="col-sm-9">
            {!! Form::email('partner_email', null, ['class' => 'form-control', 'id' => 'partner_email']) !!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="mylabel col-sm-3">
            {!! Form::label('partner_telefonszamlabel', 'Telefonszám:', ['id' => 'partner_telefonszamlabel']) !!}
        </div>
        <div class="col-sm-9">
            {!! Form::text('partner_telefonszam', null, ['class' => 'form-control', 'id' => 'partner_telefonszam']) !!}
        </div>
    </div>
</div>
