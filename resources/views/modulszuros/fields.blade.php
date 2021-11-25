<!-- Modul Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('modul_id', 'Modul:') !!}
    {!! Form::select('modul_id', App\Classes\DDW::modulDdw(), null, ['class'=>'select2 form-control', 'id' => 'modul_id']) !!}
    {!! Form::label('sorszam', 'Sorszám:') !!}
    {!! Form::number('sorszam', null, ['style' => 'cursor: not-allowed', 'readonly' => 'true', 'class' => 'form-control']) !!}
    {!! Form::label('nev', 'Név:') !!}
    {!! Form::text('nev', null, ['class' => 'form-control']) !!}
    {!! Form::label('megjegyzes', 'Megjegyzés:') !!}
    {!! Form::textarea('megjegyzes', null, ['class' => 'form-control', 'rows' => 4]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('modulszuros.index') !!}" class="btn btn-default">Kilép</a>
</div>

@section('scripts')

    @include('functions.ajax_js')

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            $('#modul_id').change(function() {
                let modul = parseInt($('#modul_id').val());
                let sorszam = 0;
                $.ajax({
                    type: "GET",
                    url: '{{url('api/getMaxModulszuroSorszam')}}',
                    data: "&id=" + modul,
                    success: function (response) {
                        console.log(response);
                        $('#sorszam').val(response);
                    },
                    error: function (response) {
                        console.log('Error:', response);
                        swal( "Hiba",  "A api/getMaxModulszuroSorszam hibát generált!",  "error" );
                    }
                });
            });

        });
    </script>
@endsection

