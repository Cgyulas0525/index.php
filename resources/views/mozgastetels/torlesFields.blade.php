<!-- Mozgasfej Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mozgasfej', 'Bizonylat:') !!}
    {!! Form::select('mozgasfej', \App\Models\Mozgasfej::where('id', '=', $mozgastetel->mozgasfej)->pluck('bizszam', 'id')->toArray(), $mozgastetel->mozgasfej, ['style' => 'cursor: not-allowed', 'class'=>' select2 form-control', 'readonly' => 'true', 'id' => 'mozgasfej']) !!}
    {!! Form::label('termek', 'Termék:') !!}
    {!! Form::select('termek', [" "] + \App\Models\termek::orderBy('nev')->pluck('nev', 'id')->toArray(), null,['class'=>'select2 form-control', 'required' => 'true', 'readonly' => 'true', 'id' => 'termek']) !!}
    {!! Form::label('mennyiseg', 'Mennyiség:') !!}
    {!! Form::number('mennyiseg', null, ['class' => 'form-control  text-right', 'readonly' => 'true', 'required' => 'true']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Törlés', ['class' => 'btn btn-danger']) !!}
    <a href="{!! route('mozgasfejs.edit', $mozgastetel->mozgasfej) !!}" class="btn btn-default">Kilép</a>
</div>
