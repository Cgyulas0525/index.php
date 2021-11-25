@section('css')
    @include('layouts.datatables_css')
@endsection
<div class="form-group col-lg-4, col-sm-12, col-md-4">
    {!! Form::label('nev', 'Név:') !!}
    {!! Form::text('nev', $type->nev,  ['class' => 'form-control', 'id' => 'nev']) !!}
    {!! Form::label('leiras', 'Leirás:') !!}
    {!! Form::textarea('leiras', $type->leiras, ['class' => 'form-control', 'rows="10" cols="50"', 'style' => 'maxlength: 500']) !!}
</div>
<div class="form-group col-lg-8, col-sm-12, col-md-8">
    @include('dictionaries.szotar')
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('types.index') !!}" class="btn btn-default">Kilép</a>
</div>

@section('scripts')
    @include('layouts.datatables_js')

    <script type="text/javascript">

        $(function () {

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          var oTable = $('.dictionaries-table').DataTable({
              serverSide: true,
              order: [[0, 'asc'], [1, 'asc']],
              buttons: [],
              scrollY: 200,
              ajax: "{{ route('dictionaries.index') }}",
              columns: [
                  {title: 'Típus', data: 'tnev', name: 'tnev'},
                  {title: 'Név', data: 'nev', name: 'nev'},
                  {title: 'Leírás', data: 'leiras', name: 'leiras'},
                  {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('SzotarInsert', $type->id) !!}"><i class="fa fa-plus-square"></i></a>', 
                    data: 'action', sClass: "text-center", name: 'action', orderable: false, searchable: false},
              ],
              columnDefs: [
                    {
                    visible: false,
                    targets: [0]
                    },
                ],
            });

            nev = $('#nev').val();
            oTable.column(0).search(nev).draw();
            e.preventDefault();
        });
    </script>
@endsection
