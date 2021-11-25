@include('pekaru.termekFields')

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('termeks.index') !!}" class="btn btn-default">Kilép</a>
</div>

@section('scripts')

    @include('functions.required_js')
    @include('functions.jsFunctions_js')
    @include('functions.barcode_js')
    @include('functions.kovetkezoCikkszam_js')
    @include('functions.api_js')

    <script type="text/javascript">

        RequiredBackgroundModify('.form-control')
        ajaxSetup();

        $('#csoport').change(function(){
            arSzamol('Cikk');
            getFocsoportFromCsoport($('#csoport').val());
        });

        $('#barcode').change(function() {
            vanEIlyenBarcode($('#barcode').val());
        });

        $('#beszar').change(function() {
            arSzamol('Cikk');
        });

        $('#mennyiseg').change(function() {
            arSzamol('Cikk');
        });

    </script>
@endsection
