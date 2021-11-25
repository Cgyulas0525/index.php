@section('css')
    @include('layouts.costumcss')
@endsection

<!-- Parent Id Field -->
<div class="form-group col-sm-6">
    {!! Form::hidden('parent_id', $focsoport->id, ['class' => 'form-control']) !!}
    {!! Form::hidden('dictionary_id', $melyik, ['class' => 'form-control']) !!}

    {!! Form::label('nev', 'Név:') !!}
    {!! Form::text('nev', null, ['class' => 'form-control', 'required' => 'true']) !!}
    <br>
    {!! Form::label('fokeplabel', 'Főkép:', ['id' => 'fokeplabel']) !!}
    {!! Form::checkbox('fokep', 0, false, ['id' => 'fokep']) !!}
    <br>
    {!! Form::submit('Ment', ['class' => 'btn btn-primary ment']) !!}
    @if ($melyik == 2109)
        <a href="{!! route('termekfocsoports.index') !!}" class="btn btn-default">Kilép</a>
    @elseif ($melyik == 2110)
        <a href="{!! route('TermekCsoportInsert', [App\Models\Termekcsoport::find($focsoport->id)->focsoport]) !!}" class="btn btn-default">Kilép</a>
    @elseif ($melyik == 2111)
        <a href="{!! route('termekcsoports.edit', [App\Models\Termek::find($focsoport->id)->csoport]) !!}" class="btn btn-default">Kilép</a>
    @endif
</div>

<div class="form-group col-sm-6">
    <div class="row">
        <div class="mylabel col-sm-1">
            {!! Form::label('kep', 'Kép:') !!}
            {!! Form::hidden('kep', null, ['class' => 'form-control','maxlength' => 100,'maxlength' => 100]) !!}
            {!! Form::hidden('kicsikep', null, ['class' => 'form-control','maxlength' => 100,'maxlength' => 100]) !!}
        </div>
        <div class="form-group col-sm-11">
            <label class="image__file-upload">Válasszon
                {!! Form::file('image_url',['class'=>'d-none', 'id' => 'image']) !!}
            </label>
        </div>
    </div>
</div>

<div class="col-sm-12">
    <section class="content-header">
        <h1 class="pull-left">Képek</h1>
    </section>
    @include('flash::message')
    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body"  >
            <table class="table table-hover table-bordered partners-table" style="width: 100%;"></table>
        </div>
    </div>
    <div class="text-center"></div>
</div>

@section('scripts')
    @include('layouts.datatables_js')
    @include('functions.checkBoxes_js')
    @include('functions.ajax_js')
    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            var table = $('.partners-table').DataTable({
                serverSide: true,
                scrollY: 390,
                scrollX: true,
                order: [[1, 'asc']],
                ajax: "{{ route('parentKep', [$focsoport->id, $melyik]) }}",
                columns: [
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('keps.create') !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", width: '200px', name: 'action', orderable: false, searchable: false},
                    {title: 'Név', data: 'nev', name: 'nev'},
                    {title: 'Szülő', data: 'parentnev', name: 'parentnev'},
                    {title: '', data: "kicsikep", sClass: "text-center", "render": function (data) {
                            return '<img src="../../../' + data + '" style="height:40px;width:40px;object-fit:cover;"/>';
                        }
                    },
                ]
            });

            window.onload = function()
            {
                fokepCheck();
            }

            $('#fokep').change(function() {
                mezoChange('fokep')
                vanMarFokep($('#fokep').val());
            });

            function vanMarFokep(fokep) {
                if ( fokep == 1 ) {
                    var parent = <?php echo $focsoport->id; ?>;
                    var dictionary = <?php echo $melyik; ?>;
                    $.ajax({
                        type:"GET",
                        url:"{{ url('api/vanMarFokep') }}",
                        data: { parent_id: parent, dictionary_id: dictionary },
                        success:function(res) {
                            if ( res > 0 ) {
                                swal ( "Hiba" ,  "Egy másik kép már főkép!" ,  "error" );
                                fokepCheck();
                            }
                        }
                    })
                }
            }

            function fokepCheck() {
                let checkBox = document.getElementById('fokep');
                checkBox.checked = false;
                $('#fokep').val(0);
            }

            $('.ment').click(function () {
                let image = $('#image').val();
                if (!image) {
                    alert('Nem választott képet?');
                }
            });
        });
    </script>
@endsection
