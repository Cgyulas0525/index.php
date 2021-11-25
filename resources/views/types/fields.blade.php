<div class="form-group col-lg-6, col-sm-12, col-md-6">
    {!! Form::label('nev', 'Név:') !!}
    {!! Form::text('nev', null,  ['class' => 'form-control', 'id' => 'nev']) !!}
    {!! Form::label('leiras', 'Leirás:') !!}
    {!! Form::textarea('leiras', null, ['class' => 'form-control', 'rows="10" cols="50"', 'style' => 'maxlength: 500']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('types.index') !!}" class="btn btn-default">Kilép</a>
</div>

