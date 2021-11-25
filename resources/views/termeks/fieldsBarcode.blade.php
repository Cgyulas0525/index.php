<div class="form-group col-sm-6">
    {!! Form::label('barcode', 'Vonalkód:') !!}
    {!! Form::text('barcode', null, ['style' => 'cursor: not-allowed', 'class' => 'form-control text-right', 'id' => 'barcode']) !!}
</div>

{!! Form::hidden('nev', null, ['class' => 'form-control']) !!}
{!! Form::hidden('csoport', null,['class'=>'form-control']) !!}
{!! Form::hidden('cikkszam', null, ['class' => 'form-control']) !!}


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('termeks.index') !!}" class="btn btn-default">Kilép</a>
</div>

@section('scripts')
    @include('functions.required_js')
    @include('functions.jsFunctions_js')
    @include('functions.barcode_js')
    <script type="text/javascript">

        var SITEURL = "{{url('/')}}";
        var CIKKSZAM = " ";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#barcode').change(function() {
            vanEIlyenBarcode($('#barcode').val());
        });

        $('#barcode').focus();

    </script>
@endsection
