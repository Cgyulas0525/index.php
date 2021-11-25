@section('css')
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="public/css/datatables.css">
    <link rel="stylesheet" href="public/css/Highcharts.css">
    @include('layouts.costumcss')
@endsection

<!-- Focsoport Field -->
<div class="form-group col-sm-4">
    {!! Form::label('focsoport', 'Főcsopor:') !!}
    {!! Form::hidden('focsoport', $termekcsoport->focsoport, ['class' => 'form-control', 'id' => 'focsoport']) !!}
    {!! Form::text('focsoportnev', $termekcsoport->focsoportnev, ['class' => 'form-control', 'style' => 'cursor: not-allowed', 'readonly' => 'true']) !!}
    {!! Form::label('nev', 'Név:') !!}
    {!! Form::text('nev', $termekcsoport->nev, ['class' => 'form-control', 'required' => 'true']) !!}
    {!! Form::label('afa', 'ÁFA:') !!}
    {!! Form::select('afa', App\Classes\DDW::dictionaryDdw(28), $termekcsoport->afa,['class'=>'select2 form-control', 'id' => 'afa']) !!}
    {!! Form::label('haszonkulcs', 'Haszon kulcs %:') !!}
    {!! Form::number('haszonkulcs', $termekcsoport->haszonkulcs,['class'=>'form-control', 'id' => 'haszonkulcs']) !!}
    {!! Form::label('megjegyzes', 'Megjegyzés:') !!}
    {!! Form::textarea('megjegyzes', $termekcsoport->megjegyzes, ['class' => 'form-control']) !!}
    <br>
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('TermekCsoportInsert', $termekcsoport->focsoport) !!}" class="btn btn-default">Kilép</a>
    <a href="{!! route('termekfocsoports.index') !!}" class="btn btn-warning">Főcsoport</a>
</div>

<div class="form-group col-sm-8">
    <section class="content-header">
        <h1 class="pull-left">Termékek</h1>
    </section>
    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body"  >
            <table class="table table-hover table-bordered partners-table" style="width: 100%;"></table>
        </div>
    </div>
</div>


<!-- Submit Field -->


@section('scripts')
    @include('functions.required_js')
    @include('layouts.datatables_js')
    @include('functions.ajax_js')
    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            let table = $('.partners-table').DataTable({
                serverSide: true,
                scrollY: 250,
                scrollX: true,
                paging: false,
                order: [[1, 'asc']],
                ajax: "{{ route('termekIndexCsoport', $termekcsoport->id) }}",
                columns: [
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('createWithTermekcsoport', $termekcsoport->id) !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", width:'260px', name: 'action', orderable: false, searchable: false},
                    {title: 'Név', data: 'nev', name: 'nev'},
                    {title: 'Cikkszám', data: 'cikkszam', name: 'cikkszam'},
                    {title: 'Mennyiségi egység', data: 'menev', sClass: "text-center", name: 'menev'},
                    {title: 'Mennyiség', data: 'mennyiseg', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'mennyiseg'},
                    {title: 'Minimális', data: 'minmenny', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'minmenny'},
                    {title: 'Ár', data: 'ar', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'ar'},
                    {title: 'Gyártó', data: 'pnev', name: 'pnev'},
                    {title: '', data: "fokep",  "render": function (data) {
                            if ( data == null ) {
                                return '<img src="../../public/img/nincskep.png" style="height:40px;width:40px;object-fit:cover;"/>';
                            }
                            return '<img src="../../' + data + '" style="height:40px;width:40px;object-fit:cover;"/>';
                        }
                    },

                ]
            });

            RequiredBackgroundModify('.form-control')

        });

    </script>
@endsection
