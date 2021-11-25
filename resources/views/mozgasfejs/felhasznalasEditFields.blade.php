@section('css')
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="public/css/datatables.css">
    @include('layouts.costumcss')
@endsection
<!-- Datum Field -->
<div class="form-group col-sm-12">
    <div class="form-group col-sm-2">
        {!! Form::label('datum', 'Dátum:') !!}
        {!! Form::date('datum', $mozgasfej->datum, ['class' => 'form-control','id'=>'datum']) !!}
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('partner', 'Partner:') !!}
        {!! Form::select('partner', App\Classes\DDW::partnerDdw(), $mozgasfej->patner,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'partner']) !!}
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('bizszam', 'Bizonylat szám:') !!}
        {!! Form::text('bizszam', 'Felhasználás', ['class' => 'form-control']) !!}
    </div>
</div>

<div class="col-lg-12 col-md-12 col-xs-12" style="margin-top: -40px">

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
                  <table class="table table-hover table-bordered tetel-table"></table>
              </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
</div>

<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('felhasznalasIndex') !!}" class="btn btn-default">Kilép</a>
</div>

@section('scripts')
    @include('layouts.datatables_js')
    @include('layouts.RowCallBack_js')

    <script type="text/javascript">
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var oTable = $('.tetel-table').DataTable({
                serverSide: true,
                scrollY: 250,
                colReorder: true,
                paging: false,
                buttons: [],
                dom: '<"clear">',
                order: [[0, 'asc']],
                ajax: "{{ route('mozgastetels.indexFejId', $mozgasfej->id) }}",
                columns: [
                    {title: 'MozgásFej', data: 'mozgasfej', name: 'mozgasfej'},
                    {title: 'Termék', data: 'tnev', name: 'tnev'},
                    {title: 'Mennyiség', data: 'mennyiseg', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'mennyiseg'},
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('createFelhasznalas', $mozgasfej->id) !!}"><i class="fa fa-plus-square"></i></a>',
                      data: 'action', sClass: "text-center", name: 'action', orderable: false, searchable: false},
                ],
                columnDefs: [
                    {
                    visible: false,
                    targets: [0]
                    },
                ],
            });

        });
    </script>
@endsection

