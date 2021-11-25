<!-- Parent Id Field -->
<div class="form-group col-sm-6">
    {!! Form::hidden('parent_id', $kep->parent_id, ['class' => 'form-control']) !!}
    {!! Form::hidden('dictionary_id', $kep->dictionary_id, ['class' => 'form-control']) !!}
    {!! Form::label('nev', 'Név:') !!}
    {!! Form::text('nev', $kep->nev, ['class' => 'form-control', 'required' => 'true']) !!}
    <br>
    {!! Form::label('fokep', 'Főkép:') !!}
    {!! Form::checkbox('fokep', $kep->fokep, !$kep->fokep == 0 ? false : true, ['id' => 'fokep']) !!}
    <br>
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('createFocsoportKep', [$kep->parent_id, $kep->dictionary_id]) !!}" class="btn btn-default">Kilép</a>
</div>

<div class="form-group col-sm-6">
    <div class="form-group col-sm-6">
        <p><img height="200" src={{ URL::asset($kep->kep)}}/></p>
    </div>
</div>

@section('scripts')
    @include('functions.checkBoxes_js')
    @include('functions.ajax_js')

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            window.onload = function()
            {
                let tf = $('#fokep').val();
                console.log(tf);
                let checkBox = document.getElementById('fokep');
                if (tf == 0) {
                    checkBox.checked = false;
                    $('#fokep').val(0);
                } else {
                    checkBox.checked = true;
                    $('#fokep').val(1);
                }
            }

            $('#fokep').change(function() {
                mezoChange('fokep')
            });

            function masikFokep(fokep) {
                if ( fokep == 1 ) {
                    var parent = <?php echo $focsoport->id; ?>;
                    var dictionary = <?php echo $melyik; ?>;
                    var id = <?php echo $kep->id; ?>;
                    $.ajax({
                        type:"GET",
                        url:"{{ url('api/vanMarFokep') }}",
                        data: { parent_id: parent, dictionary_id: dictionary, id: id },
                        success:function(res) {
                            if ( res > 0 ) {
                                swal ( "Hiba" ,  "Egy másik kép már főkép!" ,  "error" );
                                fokepCheck();
                            }
                        }
                    })
                }
            }

        });
    </script>
@endsection
