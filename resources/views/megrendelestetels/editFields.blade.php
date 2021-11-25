<!-- Termek Field -->
<div class="form-group col-sm-6">
    <div class="form-group col-sm-12">
        {!! Form::hidden('megrendelesfej', 'Bizonylat:') !!}
        {!! Form::hidden('megrendelesfej', $megrendelestetel->megrendelesfej) !!}
        {!! Form::label('termek', 'Termék:') !!}
        {!! Form::select('termek', App\Classes\DDW::termekDDW(), $megrendelestetel->termek, ['class'=>'select2 form-control', 'required' => 'true', 'id' => 'termek', 'autofocus']) !!}
    </div>
    <div class="form-group col-sm-12">
        <div class="form-group col-sm-6">
            {!! Form::label('mennyiseg', 'Mennyiség:') !!}
            {!! Form::number('mennyiseg', $megrendelestetel->mennyiseg, ['class' => 'form-control text-right', 'required' => 'true']) !!}
        </div>
        <div class="form-group col-sm-6">
            {!! Form::hidden('ertek', 'Érték:') !!}
            {!! Form::hidden('ertek', $megrendelestetel->ertek) !!}
        </div>
    </div>
</div>
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('megrendelesfejs.edit', $megrendelestetel->megrendelesfej) !!}" class="btn btn-default">Kilép</a>
</div>



