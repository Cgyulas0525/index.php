<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $todo->id !!}</p>
</div>

<!-- User Field -->
<div class="form-group">
    {!! Form::label('user', 'User:') !!}
    <p>{!! $todo->user !!}</p>
</div>

<!-- Mit Field -->
<div class="form-group">
    {!! Form::label('mit', 'Mit:') !!}
    <p>{!! $todo->mit !!}</p>
</div>

<!-- Mikorra Field -->
<div class="form-group">
    {!! Form::label('mikorra', 'Mikorra:') !!}
    <p>{!! $todo->mikorra !!}</p>
</div>

<!-- Megjegyzes Field -->
<div class="form-group">
    {!! Form::label('megjegyzes', 'Megjegyzes:') !!}
    <p>{!! $todo->megjegyzes !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $todo->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $todo->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $todo->deleted_at !!}</p>
</div>

