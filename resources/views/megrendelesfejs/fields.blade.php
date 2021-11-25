<!-- Datum Field -->
<div class="form-group col-sm-6">
    {!! Form::hidden('megrendelesszam', 'Megrendelés szám:') !!}
    {!! Form::hidden('megrendelesszam', null, ['style' => 'cursor: not-allowed', 'class' => 'form-control','id'=>'megrendelesszam']) !!}
    {!! Form::label('datum', 'Dátum:') !!}
    {!! Form::date('datum', \Carbon\Carbon::now(), ['class' => 'form-control','id'=>'datum']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('partner', 'Partner:') !!}
    {!! Form::select('partner', App\Classes\DDW::partnerDdw(), null,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'partner']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('megrendelesfejs.index') !!}" class="btn btn-default">Kilép</a>
</div>
