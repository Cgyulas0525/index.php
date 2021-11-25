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
