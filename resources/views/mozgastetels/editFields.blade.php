<!-- Mozgasfej Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mozgasfej', 'Bizonylat:') !!}
    {!! Form::text('mozgasfej', App\Models\Mozgasfej::where('id', $mozgastetel->mozgasfej)->first()->bizszam, ['style' => 'cursor: not-allowed', 'class'=>'form-control', 'readonly' => 'true', 'id' => 'mozgasfej']) !!}
    {!! Form::label('termek', 'Termék:') !!}
    {!! Form::text('termek', $mozgastetel->termeknev,['style' => 'cursor: not-allowed', 'class'=>'form-control', 'readonly' => 'true', 'id' => 'termek']) !!}
    {!! Form::label('mennyiseg', 'Mennyiség:') !!}
    {!! Form::number('mennyiseg', null, ['class' => 'form-control  text-right', 'required' => 'true', 'autofocus']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('mozgasfejs.edit', $mozgastetel->mozgasfej) !!}" class="btn btn-default">Kilép</a>
</div>
