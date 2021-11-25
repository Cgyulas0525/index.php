@section('css')
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="public/css/datatables.css">
    <link rel="stylesheet" href="public/css/Highcharts.css">
    @include('layouts.costumcss')
@endsection

<!-- Nev Field -->
<div class="row">
    <div class="form-group col-sm-6">
        <div class="form-group col-sm-12">
            {!! Form::label('nev', 'Név:') !!}
            {!! Form::text('nev', null, ['class' => 'form-control', 'readonly' => 'true', 'autofocus']) !!}
        </div>
        <div class="form-group col-sm-12">
            {!! Form::label('csoport', 'Csoport:') !!}
            {!! Form::select('csoport', App\Classes\DDW::termekCsoportDdw(), null,['class'=>'select2 form-control', 'readonly' => 'true', 'id' => 'csoport']) !!}
        </div>
        <div class="form-group col-sm-12">
            {!! Form::label('partner', 'Partner:') !!}
            {!! Form::select('partner', App\Classes\DDW::partnerDdw(), null,['class'=>'select2 form-control', 'readonly' => 'true', 'id' => 'partner']) !!}
        </div>
    </div>
    <!-- Me Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('cikkszam', 'Cikkszám:') !!}
        {!! Form::text('cikkszam', null, ['style' => 'cursor: not-allowed', 'readonly' => 'true', 'class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-6">
        <div class="form-group col-sm-4">
            {!! Form::label('me', 'Mennyiségi egység:') !!}
            {!! Form::select('me', App\Classes\DDW::dictionaryDdw(26), null,['class'=>'select2 form-control', 'readonly' => 'true', 'id' => 'me']) !!}
        </div>
        <div class="form-group col-sm-4">
            {!! Form::label('minmenny', 'Minimális:') !!}
            {!! Form::number('minmenny', null, ['class' => 'form-control  text-right', 'readonly' => 'true']) !!}
        </div>
        <div class="form-group col-sm-4">
            {!! Form::label('mennyiseg', 'Mennyiség:') !!}
            {!! Form::number('mennyiseg', null, ['class' => 'form-control  text-right', 'readonly' => 'true']) !!}
        </div>
        <div class="form-group col-sm-6">
            {!! Form::label('beszar', 'Beszerzési ár:') !!}
            {!! Form::number('beszar', null, ['class' => 'form-control  text-right', 'readonly' => 'true']) !!}
        </div>
        <div class="form-group col-sm-6">
            {!! Form::label('ar', 'Ár:') !!}
            {!! Form::number('ar', null, ['class' => 'form-control  text-right', 'readonly' => 'true']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-body"  >
                <table class="table table-hover table-bordered partners-table" style="width: 100%;"></table>
            </div>
        </div>
    </div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    <a href="{!! route('termeks.index') !!}" class="btn btn-default">Kilép</a>
</div>

@section('scripts')
    @include('layouts.datatables_js')
    @include('layouts.RowCallBack_js')
    @include('layouts.highcharts_js')

    <script type="text/javascript">
        $(function () {

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          var table = $('.partners-table').DataTable({
              serverSide: true,
              scrollY: 150,
              order: [[1, 'asc'], [2, 'asc']],
              buttons: [],
              ajax: "{{ route('rkindex', $termek->id) }}",
              columns: [
                  {title: 'Raktár', data: 'raktarnev', name: 'raktarnev'},
                  {title: 'Termék', data: 'termeknev', name: 'termeknev'},
                  {title: 'Mennyiség', data: 'mennyiseg', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'mennyiseg'}
              ],
            });

        });

    </script>
@endsection
