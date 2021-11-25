<!-- User Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user', 'Felhasználó:') !!}
    {!! Form::select('user', App\User::ddw(), null,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'user']) !!}
    {!! Form::label('mit', 'Mit:') !!}
    {!! Form::text('mit', null, ['class' => 'form-control', 'required' => 'true']) !!}
</div>

<!-- Mikorra Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mikorra', 'Mikorra:') !!}
    {!! Form::date('mikorra', \Carbon\Carbon::now(), ['class' => 'form-control', 'required' => 'true','id'=>'mikorra']) !!}
</div>

<!-- Megjegyzes Field -->
<div class="form-group col-sm-12">
    {!! Form::label('megjegyzes', 'Megjegyzés:') !!}
    {!! Form::textarea('megjegyzes', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('todos.index') !!}" class="btn btn-default">Kilép</a>
</div>

@section('scripts')
    @include('functions.required_js')
    <script type="text/javascript">
        RequiredBackgroundModify('.form-control')
    </script>
@endsection
