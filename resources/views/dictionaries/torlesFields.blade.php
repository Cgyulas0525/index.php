<!-- Tipus Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipus', 'Típus:') !!}
    {!! Form::select('tipus', \App\Models\Type::where('id', '=', $dictionary->tipus)->get()->sortby('nev')->pluck('nev', 'id')->toArray(), 'null',
                     ['style' => 'cursor: not-allowed', 'class'=>' select2 form-control', 'readonly' => 'true', 'id' => 'tipus']) !!}
</div>

<!-- Nev Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nev', 'Név:') !!}
    {!! Form::text('nev', null, ['class' => 'form-control']) !!}
</div>

<!-- Leiras Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('leiras', 'Leírás:') !!}
    {!! Form::textarea('leiras', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Törlés', ['class' => 'btn btn-danger']) !!}
    <a href="{!! route('types.edit', $dictionary->tipus) !!}" class="btn btn-default">Kilép</a>
</div>
