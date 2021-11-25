<!-- Datum Field -->
<div class="form-group col-sm-6">
    {!! Form::label('datum', 'Dátum:') !!}
    {!! Form::date('datum', \Carbon\Carbon::now(), ['class' => 'form-control','id'=>'datum']) !!}
</div>

<!-- Raktar Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('raktar_id', 'Raktár:') !!}
    {!! Form::select('raktar_id', App\Classes\DDW::dictionaryDdw(32), null,['class'=>'select2 form-control', 'id' => 'raktar_id']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('leltarFejs.index') !!}" class="btn btn-default">Kilép</a>
</div>

@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @include('layouts.datatables_js')

    <script type="text/javascript">
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function ellenorzes() {
                let datum = $('#datum').val();
                let raktar = $('#raktar_id').val();
                if ( datum != 0 && raktar != 0 ) {
                    $.ajax({
                        type: "GET",
                        url:"{{url('api/vanLeltar')}}",
                        data: { datum: datum, raktar: raktar },
                        success: function (response) {
                            if ( response.id ) {
                                swal( "Hiba",  "Van már erre a napra és erre a raktárra leltár indítva!",  "error" );
                                $('#raktar_id').val(null);
                                $('#datum').focus();
                            }
                        },
                        error: function (response) {
                            console.log('Error:', response);
                            swal( "Hiba",  "A api/vanLeltar hibát generált!",  "error" );
                        }
                    });
                }
            }

            $('#datum').change(function() {
                ellenorzes();
            });

            $('#raktar_id').change(function() {
                ellenorzes();
            });

        });
    </script>
@endsection

