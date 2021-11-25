<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $penztarFej->id !!}</p>
</div>

<!-- Bizonylatszam Field -->
<div class="form-group">
    {!! Form::label('bizonylatszam', 'Bizonylatszam:') !!}
    <p>{!! $penztarFej->bizonylatszam !!}</p>
</div>

<!-- Ertek Field -->
<div class="form-group">
    {!! Form::label('ertek', 'Ertek:') !!}
    <p>{!! $penztarFej->ertek !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $penztarFej->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $penztarFej->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $penztarFej->deleted_at !!}</p>
</div>

