<!-- Focsoport Field -->
<div class="form-group col-sm-4">
    <div class="form-group col-sm-12">
        {!! Form::hidden('focsoport', $termekfocsoport->id, ['class' => 'form-control', 'id' => 'focsoport']) !!}
        {!! Form::label('nev', 'Név:') !!}
        {!! Form::text('nev', null, ['class' => 'form-control', 'required' => 'true']) !!}
        {!! Form::label('afa', 'ÁFA:') !!}
        {!! Form::select('afa', App\Classes\DDW::dictionaryDdw(28), null,['class'=>'select2 form-control', 'id' => 'afa']) !!}
        {!! Form::label('haszonkulcs', 'Haszon kulcs %:') !!}
        {!! Form::number('haszonkulcs', 0,['class'=>'form-control', 'id' => 'haszonkulcs']) !!}
        {!! Form::label('megjegyzes', 'Megjegyzés:') !!}
        {!! Form::textarea('megjegyzes', null, ['class' => 'form-control']) !!}
        <br>
        {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('termekfocsoports.index') !!}" class="btn btn-default">Kilép</a>
    </div>
</div>

<div class="form-group col-sm-8">
    <section class="content-header">
        <h1 class="pull-left">Csoport</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered dictionaries-table"  style="width: 100%;"></table>
                </div>
            </div>
        </div>
        <div class="text-center"></div>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
</div>

@section('scripts')
    @include('functions.required_js')
    @include('layouts.datatables_js')
    <script type="text/javascript">
        $(function () {
            RequiredBackgroundModify('.form-control')


            var oTable = $('.dictionaries-table').DataTable({
                serverSide: true,
                scrollY: 200,
                colReorder: true,
                order: [[0, 'asc'], [1, 'asc']],
                ajax: "{{ route('TermekCsoportIndexFocsoport', $termekfocsoport->id) }}",
                columns: [
                    {title: 'Főcsoport', data: 'tnev', name: 'tnev'},
                    {title: 'Név', data: 'nev', name: 'nev'},
                    {title: 'ÁFA', data: 'afanev', name: 'afanev'},
                    {title: 'Haszon %', data: 'haszonkulcs', sClass: "text-right", width: '100px', name: 'haszonkulcs'},
                    {title: 'Megjegyzés', data: 'megjegyzes', name: 'megjegyzes'},
                    {title: '', data: "fokep",  "render": function (data) {
                            if ( data == null ) {
                                return '<img src="../../public/img/nincskep.png" style="height:40px;width:40px;object-fit:cover;"/>';
                            }
                            return '<img src="../../' + data + '" style="height:40px;width:40px;object-fit:cover;"/>';
                        }
                    },
                    {title: 'Akció', data: 'action', sClass: "text-center", width:'140px', name: 'action', orderable: false, searchable: false},
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
