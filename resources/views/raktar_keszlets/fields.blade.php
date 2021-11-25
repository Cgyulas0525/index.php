<!-- Raktar Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('raktar_id', 'Raktar Id:') !!}
    {!! Form::number('raktar_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Termek Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('termek_id', 'Termek Id:') !!}
    {!! Form::number('termek_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Mennyiseg Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mennyiseg', 'Mennyiseg:') !!}
    {!! Form::number('mennyiseg', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('raktarKeszlets.index') !!}" class="btn btn-default">Cancel</a>
</div>
