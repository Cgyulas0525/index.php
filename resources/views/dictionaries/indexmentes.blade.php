@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="http://priestago.hu/padmin/public/css/app.css">
    <link rel="stylesheet" href="http://priestago.hu/padmin/public/css/datatables.css">
@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Szótár</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" title="Felvitel" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('dictionaries.create') !!}"><i class="fa fa-plus-square"></i></a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="panel-body">
            <form id="search-form" class="form-inline">
                <div class="form-group text-center">
                    <label for="title">Típus:</label>
                    {!! Form::select('típus', [""] + \App\Models\Type::orderBy('nev')->pluck('nev', 'nev')->toArray(), null,['class'=>'select2 form-control', 'id' => 'tipus', 'style=width:180px']) !!}
                </div>
            </form>
        </div>
        <div class="box box-primary">
            <div class="box-body">
              <div class="table-responsive">
                  <table class="table table-striped table-bordered dictionaries-table">
                      <thead>
                          <tr>
                              <th>Típus</th>
                              <th>Név</th>
                              <th>Leírás</th>
                              <th>Akció</th>
                          </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                          <tr>
                            <th>Típus</th>
                            <th>Név</th>
                            <th>Leírás</th>
                            <th>Akció</th>
                          </tr>
                      </tfoot>

                  </table>
              </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

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
              ajax: "{{ route('dictionaries.index') }}",
              columns: [
                  {data: 'tnev', name: 'tnev'},
                  {data: 'nev', name: 'nev'},
                  {data: 'leiras', name: 'leiras'},
                  {data: 'action', sClass: "text-center", name: 'action', orderable: false, searchable: false},
              ],
            });

            $('#tipus').on('change', function(e) {
                var tipus = $('#tipus').val();
                oTable.column(0).search(tipus).draw();
                e.preventDefault();
            });

            $("#tipus").change();

        });
    </script>
@endsection
