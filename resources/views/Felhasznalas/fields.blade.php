<!-- Datum Field -->
<div class="form-group col-sm-6">
    {!! Form::label('datum', 'Datum:') !!}
    {!! Form::date('datum', null, ['class' => 'form-control','id'=>'datum']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#datum').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Partner Field -->
<div class="form-group col-sm-6">
    {!! Form::label('partner', 'Partner:') !!}
    {!! Form::number('partner', null, ['class' => 'form-control']) !!}
</div>

<!-- Bizszam Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bizszam', 'Bizszam:') !!}
    {!! Form::text('bizszam', null, ['class' => 'form-control']) !!}
</div>

<!-- Bf Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bf', 'Bf:') !!}
    {!! Form::number('bf', null, ['class' => 'form-control']) !!}
</div>

<!-- Feldolgozott Field -->
<div class="form-group col-sm-6">
    {!! Form::label('feldolgozott', 'Feldolgozott:') !!}
    {!! Form::number('feldolgozott', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('mozgasfejs.index') !!}" class="btn btn-default">Cancel</a>
</div>
