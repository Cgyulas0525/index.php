<!-- Penztarfej Id Field -->
{!! Form::hidden('penztarfej_id', 'Penztarfej Id:') !!}
{!! Form::hidden('penztarfej_id', $penztarFej->id, ['class' => 'form-control']) !!}
{!! Form::hidden('sorszam', 'Sorszam:') !!}
{!! Form::hidden('sorszam', 1, ['class' => 'form-control']) !!}

<!-- Termek Id Field -->
<div class="form-group col-sm-12">
    <div class="form-group col-sm-6">
        {!! Form::label('barcode', 'Vonalkód:') !!}
        {!! Form::text('barcode', null, ['style' => 'cursor: not-allowed', 'class' => 'form-control text-right', 'id' => 'barcode', 'autofocus']) !!}
    </div>
    <div class="form-group col-sm-6">
        {!! Form::hidden('termek_id', 'Termék:') !!}
        {!! Form::hidden('termek_id',  null, ['class'=>'form-control', 'id' => 'termek']) !!}
    </div>
</div>
<div class="form-group col-sm-12">
    <div class="form-group col-sm-3">
        {!! Form::hidden('darab', 'Darab:') !!}
        {!! Form::hidden('darab', 1, ['class' => 'form-control', 'id' => 'darab']) !!}
        {!! Form::hidden('egysar', null, ['class' => 'form-control', 'id' => 'egysar']) !!}
    </div>
    <div class="form-group col-sm-3">
        {!! Form::hidden('netto', 'Netto:') !!}
        {!! Form::hidden('netto', 0, ['class' => 'form-control', 'style' => 'cursor: not-allowed', 'id' => 'netto']) !!}
    </div>,
    <div class="form-group col-sm-3">
        {!! Form::hidden('afa', 'Áfa:') !!}
        {!! Form::hidden('afa', 0, ['class' => 'form-control', 'style' => 'cursor: not-allowed', 'id' => 'afa']) !!}
    </div>
    <div class="form-group col-sm-3">
        {!! Form::hidden('brutto', 'Bruttó:') !!}
        {!! Form::hidden('brutto', 0, ['class' => 'form-control', 'id' => 'brutto']) !!}
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary ment']) !!}
    <a href="{!! route('penztarKilep', $penztarFej->id) !!}" class="btn btn-default">Kilép</a>
    <a href="{!! route('penztarKovetkezo', $penztarFej->id) !!}" class="btn btn-warning">Következő</a>
</div>


<div class="col-lg-12 col-md-12 col-xs-12">

    <section class="content-header">
        <h1 class="pull-left">Tétel</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered tetel-table" style="width: 100%;"></table>
                </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
</div>


@section('scripts')

    @include('layouts.datatables_js')
    @include('functions.barcode_js')
    @include('functions.ajax_js')

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            var oTable = $('.tetel-table').DataTable({
                serverSide: true,
                scrollY: 250,
                paging: false,
                bAutoWidth: true,
                buttons: [],
                dom: '<"clear">',
                order: [[0, 'asc']],
                ajax: "{{ route('indexTetel', $penztarFej->id) }}",
                columns: [
                    {title: 'Termék', data: 'termek', name: 'termek'},
                    {title: 'Mennyiség', data: 'darab', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'darab'},
                    {title: 'Netto', data: 'netto', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'netto'},
                    {title: 'Áfa', data: 'afa', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'afa'},
                    {title: 'Brutto', data: 'brutto', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'brutto'},
                    {title: '', data: 'action', sClass: "text-center", name: 'action', orderable: false, searchable: false},
                ],
            });

            function kovetkezo() {
                let egysar = $('#egysar').val();
                let darab = $("#darab").val();
                let termek = $('#termek').val();
                if ( egysar != 0 || darab != 0 ) {
                    let brutto = darab * egysar;
                    $('#brutto').val( brutto );
                }
                $('.ment').focus();
                $('.ment').click();
            }

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
                            if ( response.id ) {
                                $('#termek').val(response.id);
                                $('#egysar').val(response.ar);
                                kovetkezo();
                            }
                            $('.ment').click();
                        },
                        error: function (response) {
                            console.log('Error:', response);
                            alert('nem ok');
                        }
                    });

                }
            });

        });
    </script>
@endsection

