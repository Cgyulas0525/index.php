@section('css')
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="public/css/datatables.css">
    @include('layouts.costumcss')
@endsection<!-- Datum Field -->

<div class="form-group col-sm-3">
    {!! Form::label('megrendelesszam', 'Megrendelés szám:') !!}
    {!! Form::text('megrendelesszam', $megrendelesfej->megrendelesszam, ['style' => 'cursor: not-allowed', 'readonly' => 'true', 'class' => 'form-control','id'=>'megrendelesszam']) !!}
</div>

<div class="form-group col-sm-3">
    {!! Form::label('datum', 'Dátum:') !!}
    {!! Form::date('datum', $megrendelesfej->datum, ['class' => 'form-control','id'=>'datum']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('partner', 'Partner:') !!}
    {!! Form::select('partner', App\Classes\DDW::partnerDdw(), $megrendelesfej->partner,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'partner']) !!}
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

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('megrendelesfejs.index') !!}" class="btn btn-default">Kilép</a>
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
                order: [[0, 'asc']],
                ajax: "{{ route('megrendelestetels.index') }}",
                columns: [
                    {title: 'MegrendelésFej', data: 'megrendelesfej', name: 'megrendelesfej'},
                    {title: 'Termék', data: 'tnev', name: 'tnev'},
                    {title: 'Mennyiség', data: 'mennyiseg', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'mennyiseg'},
                    {title: 'Érték', data: 'ertek', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'ertek'},
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('megrendelesTetelInsert', $megrendelesfej->id) !!}"><i class="fa fa-plus-square"></i></a>',
                      data: 'action', sClass: "text-center", name: 'action', orderable: false, searchable: false},
                ],
                columnDefs: [
                    {
                    visible: false,
                    targets: [0]
                    },
                ],
            });
            var nev = <?php echo $megrendelesfej->id ?>;
            oTable.column(0).search(nev).draw();

        });
    </script>
@endsection
