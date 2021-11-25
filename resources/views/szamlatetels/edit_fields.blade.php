<!-- Szamla Field -->
<div class="form-group col-sm-6">
    {!! Form::label('szamla', 'Számla:') !!}
    {!! Form::select('szamla', \App\Models\szamla::where('id', '=', $szamlatetel->id)->pluck('szamlaszam', 'id')->toArray(), $szamlatetel->id, ['style' => 'cursor: not-allowed', 'class'=>' select2 form-control', 'readonly' => 'true', 'id' => 'szamla']) !!}
    {!! Form::label('termek', 'Termék:') !!}
    {!! Form::select('termek', App\Classes\DDW::termekDDW(), $szamlatetel->termek,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'termek']) !!}
    {!! Form::label('koltseg', 'Költség:') !!}
    {!! Form::select('koltseg', App\Classes\DDW::koltsegCsoportDdw(), null,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'koltseg']) !!}
    {!! Form::label('mennyiseg', 'Mennyiség:') !!}
    {!! Form::number('mennyiseg', null, ['class' => 'form-control text-right', 'id' => 'mennyiseg']) !!}
</div>

<!-- Afaszaz Field -->
<div class="form-group col-sm-2">
    {!! Form::label('afaszaz', 'Áfa %:') !!}
    {!! Form::select('afaszaz', App\Classes\DDW::dictionaryDdw(28), null,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'afaszaz']) !!}
    {!! Form::label('netto', 'Netto:') !!}
    {!! Form::number('netto', null, ['class' => 'form-control  text-right', 'required' => 'true']) !!}
    {!! Form::label('afa', 'Áfa:') !!}
    {!! Form::number('afa', null, ['style' => 'cursor: not-allowed', 'class' => 'form-control text-right', 'readonly' => 'true']) !!}
    {!! Form::label('brutto', 'Brutto:') !!}
    {!! Form::number('brutto', null, ['style' => 'cursor: not-allowed', 'class' => 'form-control text-right', 'readonly' => 'true']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('szamlas.edit', $szamlatetel->szamla) !!}" class="btn btn-default">Kilép</a>
</div>

@section('scripts')
    @include('layouts.ajax_js')
    @include('functions.required_js')
    @include('szamlatetels.szamlatetel_js')
@endsection
