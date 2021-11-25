<!-- User Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user', 'Felhasználó:') !!}
    {!! Form::select('user', [" "] + \App\User::orderBy('name')->pluck('name', 'id')->toArray(), null,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'user']) !!}
    {!! Form::label('mit', 'Mit:') !!}
    {!! Form::text('mit', $todo->mit, ['class' => 'form-control', 'required' => 'true']) !!}
</div>

<!-- Mikorra Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mikorra', 'Mikorra:') !!}
    {!! Form::date('mikorra', $todo->mikorra, ['class' => 'form-control', 'required' => 'true','id'=>'mikorra']) !!}
    {!! Form::label('vege', 'Vége:') !!}
    {!! Form::date('vege', $todo->vege, ['style' => 'cursor: not-allowed', 'readonly' => 'true', 'class' => 'form-control','id'=>'vege']) !!}
</div>

<!-- Megjegyzes Field -->
<div class="form-group col-sm-12">
    {!! Form::label('megjegyzes', 'Megjegyzés:') !!}
    {!! Form::textarea('megjegyzes', $todo->megjegyzes, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div id="header-form" class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('todos.index') !!}" class="btn btn-default">Kilép</a>
</div>

@section('scripts')
    @include('functions.required_js')
    <script type="text/javascript">
        RequiredBackgroundModify('.form-control')
    </script>
@endsection
