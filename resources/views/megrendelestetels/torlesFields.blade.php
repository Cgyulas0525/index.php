<!-- Termek Field -->
<div class="form-group col-sm-6">
    <div class="form-group col-sm-12">
        {!! Form::hidden('megrendelesfej', 'Bizonylat:') !!}
        {!! Form::hidden('megrendelesfej', $megrendelestetel->megrendelesfej) !!}
        {!! Form::label('termek', 'Termék:') !!}
        {!! Form::select('termek', [" "] + \App\Models\termek::orderBy('nev')->pluck('nev', 'id')->toArray(), $megrendelestetel->termek, ['class'=>'select2 form-control', 'readonly' => 'true', 'required' => 'true', 'id' => 'termek', 'autofocus']) !!}
    </div>
    <div class="form-group col-sm-12">
        <div class="form-group col-sm-6">
            {!! Form::label('mennyiseg', 'Mennyiség:') !!}
            {!! Form::number('mennyiseg', $megrendelestetel->mennyiseg, ['class' => 'form-control text-right', 'readonly' => 'true', 'required' => 'true']) !!}
        </div>
        <div class="form-group col-sm-6">
            {!! Form::hidden('ertek', 'Érték:') !!}
            {!! Form::hidden('ertek', $megrendelestetel->ertek) !!}
        </div>
    </div>
</div>
<div class="form-group col-sm-12">
    {!! Form::submit('Törlés', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('megrendelesfejs.edit', $megrendelestetel->megrendelesfej) !!}" class="btn btn-default">Kilép</a>
</div>



