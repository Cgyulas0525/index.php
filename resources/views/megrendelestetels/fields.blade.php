@section('css')
    @include('layouts.costumcss')
@endsection

<div class="col-sm-12">
    <div class="col-sm-3">
        {!! Form::hidden('megrendelesfej', $id, ['class' => 'form-control text-right', 'required' => 'true', 'id' => 'megrendelesfej']) !!}
        {!! Form::text('barcode', null, ['style' => 'cursor: not-allowed', 'class' => 'form-control text-right', 'id' => 'barcode', 'autofocus', 'placeholder' => 'Vonalkód']) !!}
    </div>
    <div class="mylabel col-sm-1">
        {!! Form::label('termek', 'Termék:') !!}
    </div>
    <div class="col-sm-3">
        {!! Form::select('termek', App\Classes\DDW::termekDDW(), null, ['class'=>'select2 form-control', 'required' => 'true', 'id' => 'termek']) !!}
    </div>
    <div class="mylabel col-sm-1">
        {!! Form::label('mennyiseg', 'Mennyiség:') !!}
    </div>
    <div class="col-sm-2">
        {!! Form::number('mennyiseg', null, ['class' => 'form-control text-right', 'required' => 'true', 'id' => 'mennyiseg']) !!}
    </div>
    <div class="form-group col-sm-2">
        <div class="form-group col-sm-6">
            {!! Form::submit('Ment', ['class' => 'btn btn-primary ment']) !!}
        </div>
        <div class="form-group col-sm-6">
            <a href="{!! route('megrendelesfejs.index') !!}" class="btn btn-default">Kilép</a>
        </div>
    </div>
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
    @include('layouts.RowCallBack_js')
    @include('functions.ajax_js')
    @include('functions.barcode_js')

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            var table = $('.tetel-table').DataTable({
                serverSide: false,
                scrollY: 250,
                colReorder: true,
                paging: false,
                order: [[0, 'asc']],
                ajax: "{{ route('megrTetelIndex', $id) }}",
                columns: [
                    {title: 'MegrendelésFej', data: 'megrendelesfej', name: 'megrendelesfej'},
                    {title: 'Termék', data: 'tnev', name: 'tnev'},
                    {title: 'Mennyiség', data: 'mennyiseg', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'mennyiseg'},
                    {title: 'Érték', data: 'ertek', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'ertek'},
                ],
                columnDefs: [
                    {
                    visible: false,
                    targets: [0]
                    },
                ],
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
                            if ( response.id ) {
                                $('#termek').val(response.id);
                                $('#termek').attr("readonly",true);
                                $('#termek').css("cursor", "not-allowed" );

                                $('#mennyiseg').focus();
                            }
                        },
                        error: function (response) {
                            console.log('Error:', response);
                            alert('nem ok');
                        }
                    });
                }
            });

            $('#mennyiseg').change(function() {
                $('.ment').focus();
                $('.ment').click();
            });

        });
    </script>
@endsection




