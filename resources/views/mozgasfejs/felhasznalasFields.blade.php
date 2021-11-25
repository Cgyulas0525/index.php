<div class="form-group col-sm-6">
    {!! Form::label('datum', 'Dátum:') !!}
    {!! Form::date('datum', \Carbon\Carbon::now(), ['class' => 'form-control','id'=>'datum']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('felhasznalasIndex') !!}" class="btn btn-default">Kilép</a>
</div>

