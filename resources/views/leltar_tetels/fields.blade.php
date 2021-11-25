{!! Form::hidden('leltarfej_id', $leltarFej->id, ['class' => 'form-control']) !!}
{!! Form::hidden('termek_id', null, ['style' => 'cursor: not-allowed', 'class'=>'form-control', 'readonly' => 'true', 'id' => 'termek_id']) !!}

<div class="form-group col-sm-12">
    <div class="form-group col-lg-4">
        {!! Form::label('barcode', 'Vonalkód:') !!}
        {!! Form::text('barcode', null, ['style' => 'cursor: not-allowed', 'class' => 'form-control text-right', 'id' => 'barcode', 'autofocus']) !!}
    </div>
    <div class="form-group col-lg-5">
        {!! Form::label('termekid', 'Termék:', ['id' => 'termekidlabel']) !!}
        {!! Form::text('termeknev', null, ['style' => 'cursor: not-allowed', 'class'=>'form-control', 'readonly' => 'true', 'id' => 'termeknev']) !!}
    </div>
    <div class="form-group col-sm-3">
        {!! Form::label('darab', 'Darab:') !!}
        {!! Form::number('darab', null, ['class' => 'form-control text-right', 'required' => 'true']) !!}
    </div>
</div>

@include('ujTermek.ujTermek')

<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('leltarFejs.index') !!}" class="btn btn-default">Kilép</a>
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
    @include('mozgasfejs.termekmezok_js')
    @include('functions.ajax_js')
    @include('functions.apis.kovetkezoTermekCikkszam')
    @include('functions.apis.kovetkezoSzolgaltatasCikkszam')
    @include('functions.apis.focsoportFromCsoport')
    @include('functions.checkBoxes_js')
    @include('functions.termek.termekCsoportChange_js')
    @include('functions.barcode_js')

    <script type="text/javascript">
        $(function () {

            ajaxSetup();
            ujTermekMezok(true);

            var oTable = $('.tetel-table').DataTable({
                serverSide: true,
                scrollY: 250,
                paging: false,
                bAutoWidth: true,
                buttons: [],
                dom: '<"clear">',
                order: [[0, 'asc']],
                ajax: "{{ route('indexLeltarTetel', $leltarFej->id) }}",
                columns: [
                    {title: 'Termék', data: 'termeknev', name: 'termeknev'},
                    {title: 'Mennyiség', data: 'darab', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'darab'},
                    {title: '', data: 'action', sClass: "text-center", name: 'action', orderable: false, searchable: false},
                ],
            });

            $('#barcode').change(function() {
                let barcode = $('#barcode').val();
                if (barcode != 0) {
                    barcode = barcodeReplace(barcode);
                    $("#barcode").val(barcode);
                    $.ajax({
                        type: "GET",
                        url:"{{url('api/getBarcodeTermek')}}",
                        data: { barcode: barcode },
                        success: function (response) {
                            if ( response.id ) {
                                $('#termek_id').val(response.id);
                                $('#termeknev').val(response.nev);
                                $('#darab').focus();
                            } else {
                                ujTermekMezok(false);
                            }
                        },
                        error: function (response) {
                            console.log('Error:', response);
                            swal( "Hiba",  "A api/getBarcodeTermek hibát generált!",  "error" );
                        }
                    });
                } else {
                    $('#termek_id').val(null);
                    $('#termeknev').val(null);
                }
            });

            termekCsoportChange();

            let mezok = ["glutenmentes", "laktozmentes", "tejmentes", "tojasmentes", "cukormentes", "vegan"]

            fieldChange(mezok);

        });
    </script>
@endsection
