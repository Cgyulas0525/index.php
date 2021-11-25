@section('css')
    @include('layouts.costumcss')
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="public/css/datatables.css">
    @include('layouts.costumcss')
@endsection

<div class="form-group col-sm-3">
    {!! Form::label('barcode', 'Vonalkód:') !!}
    {!! Form::text('barcode', null, ['style' => 'cursor: not-allowed', 'class' => 'form-control text-right', 'id' => 'barcode', 'autofocus']) !!}
</div>

<div class="form-group col-sm-3">
    {!! Form::label('termek_id', 'Termék:') !!}
    {!! Form::select('termek_id', App\Classes\DDW::termekDDW(), null,['class'=>'select2 form-control', 'id' => 'termek_id']) !!}
</div>

<div class="form-group col-sm-2">
    {!! Form::label('mennyiseg', 'Mennyiség:') !!}
    {!! Form::number('mennyiseg', null, ['class' => 'form-control', 'id' => 'mennyiseg']) !!}
    {!! Form::hidden('vevoirendelesfej_id', !empty($vevoirendelesfej->id) ? $vevoirendelesfej->id : $vevoirendelestetel->vevoirendelesfej_id ,
                     ['class' => 'form-control', 'id' => 'vevoirendelesfej_id']) !!}
</div>

<div class="form-group col-sm-4">
    {!! Form::label('megjegyzes', 'Megjegyzés:') !!}
    {!! Form::textarea('megjegyzes', null, ['class' => 'form-control', 'id' => 'megjegyzes', 'rows' => '1']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('vevoirendelesfejs.index') !!}" class="btn btn-default">Kilép</a>
</div>

@include('vevoirendelestetels.tetelfields')

@section('scripts')
    @include('functions.ajax_js')
    @include('functions.required_js')

    @include('layouts.datatables_js')
    @include('layouts.RowCallBack_js')

    @include('functions.barcode_js')

    <script type="text/javascript">

        ajaxSetup();

        var table = $('.tetel-table').DataTable({
            serverSide: true,
            scrollY: 390,
            scrollX: true,
            order: [[1, 'asc']],
            ajax: "{{ route('vrTetelIndex', !empty($vevoirendelesfej->id) ? $vevoirendelesfej->id : $vevoirendelestetel->vevoirendelesfej_id) }}",
            columns: [
                {title: 'Termék', data: 'termeknev', name: 'termeknev'},
                {title: 'Mennyiség', data: 'mennyiseg', render: $.fn.dataTable.render.number( '.', ',', 0), width:'150px', sClass: "text-right", name: 'mennyiseg'},
                {title: 'Megjegyzés', data: 'megjegyzes', name: 'megjegyzes'},
            ]
        });

        $('#barcode').change(function() {
            var barcode = $('#barcode').val();
            if (barcode != 0) {
                barcode = barcodeReplace(barcode);
                $("#barcode").val(barcode);
                $.ajax({
                    type: "GET",
                    url:"{{url('api/getBarcodeTermek')}}",
                    data: { barcode: barcode },
                    success: function (response) {
                        if ( !response.id ) {
                            newProductFields();
                        } else {
                            $('#termek_id').val(response.id);
                            $('#mennyiseg').focus();
                        }
                    },
                    error: function (response) {
                        console.log('Error:', response);
                        swal( "Hiba",  "A api/getBarcodeTermek hibát generált!",  "error" );
                    }
                });
            }
        });

    </script>
@endsection
