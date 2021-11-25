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
        {!! Form::text('bizszam', $mozgasfej->bizszam, ['class' => 'form-control', 'style' => 'cursor: not-allowed', 'readonly' => 'true']) !!}
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
                  <table class="table table-hover table-bordered tetel-table" style="width: 100%;"></table>
              </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
</div>

<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary ment']) !!}
    <a href="{!! route('mozgasfejs.index') !!}" class="btn btn-default">Kilép</a>
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

            var table = $('.tetel-table').DataTable({
                serverSide: true,
                scrollY: 250,
                colReorder: true,
                paging: false,
                buttons: [],
                dom: '<"clear">',
                order: [[0, 'asc']],
                ajax: "{{ route('tetelIndex', $mozgasfej->id ) }}",
                columns: [
                    {title: 'Termék', data: 'termeknev', name: 'termeknev'},
                    {title: 'Mennyiség', data: 'mennyiseg', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'mennyiseg'},
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('BevetTetelInsert', $mozgasfej->id) !!}"><i class="fa fa-plus-square"></i></a>',
                      data: 'action', sClass: "text-center", name: 'action', orderable: false, searchable: false},
                ],
            });

        });
    </script>
@endsection

