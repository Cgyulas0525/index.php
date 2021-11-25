<!-- Bizonylatszam Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bizonylatszam', 'Bizonylatszam:') !!}
    {!! Form::text('bizonylatszam', null, ['class' => 'form-control']) !!}
</div>

<!-- Ertek Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ertek', 'Ertek:') !!}
    {!! Form::number('ertek', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('penztarFejs.index') !!}" class="btn btn-default">Cancel</a>
</div>
