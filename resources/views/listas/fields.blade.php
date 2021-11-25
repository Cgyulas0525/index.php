<!-- Modul Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('modul_id', 'Modul:') !!}
    {!! Form::select('modul_id', App\Classes\DDW::modulDdw(), null,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'modul_id']) !!}
    {!! Form::label('nev', 'Név:') !!}
    {!! Form::text('nev', null, ['class' => 'form-control']) !!}
    {!! Form::label('url', 'URL:') !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
    {!! Form::label('megjegyzes', 'Megjegyzés:') !!}
    {!! Form::textarea('megjegyzes', null, ['class' => 'form-control', 'rows' => 4]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('listas.index') !!}" class="btn btn-default">Kilép</a>
</div>
