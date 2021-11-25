<div class="row">
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
                {!! Form::select('termek_partner', App\Classes\DDW::partnerDdw(), null,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'termek_partner']) !!}
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
                    {!! Form::number('termek_minmenny', 1, ['class' => 'form-control  text-right', 'id' => 'termek_minmenny']) !!}
                </div>
                <div class="form-group col-sm-4">
                    {!! Form::label('termek_mennyiseg', 'Mennyiség:', ['id' => 'termek_mennyiseglabel']) !!}
                    {!! Form::number('termek_mennyiseg', 1, ['class' => 'form-control  text-right', 'id' => 'termek_mennyiseg']) !!}
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
    </div>
    <div class="col-lg-12">
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
