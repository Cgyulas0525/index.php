<!-- Iranyitoszam Field -->
<div class="form-group col-sm-6">
    {!! Form::label('iranyitoszam', 'Iranyitoszam:') !!}
    {!! Form::text('iranyitoszam', null, ['class' => 'form-control', 'required' => 'true']) !!}
</div>

<!-- Telepules Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telepules', 'Telepules:') !!}
    {!! Form::text('telepules', null, ['class' => 'form-control', 'required' => 'true']) !!}
</div>

<!-- Megye Field -->
<div class="form-group col-sm-6">
    {!! Form::label('megye', 'Megye:') !!}
    {!! Form::text('megye', null, ['class' => 'form-control', 'required' => 'true']) !!}
</div>

<!-- Jaras Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jaras', 'Jaras:') !!}
    {!! Form::text('jaras', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('telepules.index') !!}" class="btn btn-default">Kilép</a>
</div>

@section('scripts')
    @include('functions.required_js')
    <script type="text/javascript">
        RequiredBackgroundModify('.form-control')
    </script>
@endsection
