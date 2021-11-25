<!-- Focsoport Field -->
<div class="form-group col-sm-6">
    {!! Form::label('focsoport', 'Fő csoport:') !!}
    {!! Form::select('focsoport', \App\Models\Koltsegfocsoport::where('id', '=', $id)->pluck('nev', 'id')->toArray(), $id,
        ['style' => 'cursor: not-allowed', 'class'=>'select2 form-control', 'readonly' => 'true', 'id' => 'focsoport']) !!}
    {!! Form::label('nev', 'Név:') !!}
    {!! Form::text('nev', null, ['class' => 'form-control', 'required' => 'true']) !!}
    {!! Form::label('megjegyzes', 'Megjegyzés:') !!}
    {!! Form::textarea('megjegyzes', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('koltsegfocsoports.index') !!}" class="btn btn-default">Kilép</a>
</div>

@section('scripts')
    @include('functions.required_js')
    <script type="text/javascript">
        RequiredBackgroundModify('.form-control')
    </script>
@endsection
