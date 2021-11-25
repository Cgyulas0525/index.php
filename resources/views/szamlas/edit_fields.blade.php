<!-- Partner Field -->
<div class="form-group col-sm-6">
    {!! Form::label('partner', 'Partner:') !!}
    {!! Form::select('partner', App\Classes\DDW::partnerSzallitoDdw(), $szamla->partner,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'partner']) !!}
    {!! Form::label('szamlaszam', 'Számlaszám:') !!}
    {!! Form::text('szamlaszam', $szamla->szamlaszam, ['class' => 'form-control', 'required' => 'true']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('fizitesimod', 'Fizitésimód:') !!}
    {!! Form::select('fizitesimod', App\Classes\DDW::dictionaryDdw(25), $szamla->fizitesimod,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'fizitesimod']) !!}
    {!! Form::label('osszeg', 'Összeg:') !!}
    {!! Form::number('osszeg', $szamla->osszeg, ['class' => 'form-control  text-right', 'readonly' => 'true', 'style' => 'cursor: not-allowed']) !!}
</div>
<!-- Kelt Field -->
<div class="form-group col-sm-4">
    {!! Form::label('kelt', 'Kelt:') !!}
    {!! Form::date('kelt', $szamla->kelt, ['class' => 'form-control', 'required' => 'true', 'id'=>'kelt']) !!}
</div>
<div class="form-group col-sm-4">
    {!! Form::label('teljesites', 'Teljesítés:') !!}
    {!! Form::date('teljesites', $szamla->teljesites, ['class' => 'form-control', 'required' => 'true','id'=>'teljesites']) !!}
</div>
<div class="form-group col-sm-4">
    {!! Form::label('fizetesihatarido', 'Fizetési határidő:') !!}
    {!! Form::date('fizetesihatarido', $szamla->fizetesihatarido, ['class' => 'form-control', 'required' => 'true','id'=>'fizetesihatarido']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('szamlas.index') !!}" class="btn btn-default">Kilép</a>
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
    @include('layouts.ajax_js')
    @include('functions.required_js')
    @include('szamlas.szamla_js')
    @include('layouts.datatables_js')

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
                ajax: "{{ route('szTetelIndex', $szamla->id) }}",
                columns: [
                    {title: 'Termék', data: 'termeknev', name: 'termeknev'},
                    {title: 'Ktg típus', data: 'koltsegnev', name: 'koltsegnev'},
                    {title: 'Mennyiség', data: 'mennyiseg', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'mennyiseg'},
                    {title: 'Netto', data: 'mennyiseg', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'netto'},
                    {title: 'Áfa', data: 'afa', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'afa'},
                    {title: 'Brutto', data: 'brutto', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", name: 'brutto'},
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('SzamlaTetelInsert', $szamla->id) !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", name: 'action', orderable: false, searchable: false},
                ],
            });
        });
    </script>
<!--
/*    <script type="text/javascript">
        var submitButton = document.querySelector('.form-group .btn.btn-primary');
        submitButton.addEventListener('click', function(ev) {
            ev.preventDefault();
            alert('baszki ez működik');
        })
    </script>*/
-->
@endsection
