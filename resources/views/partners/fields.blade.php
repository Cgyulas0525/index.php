<!-- Nev Field -->
@include('partners.partnerFields')
<!-- Email Field -->
<div class="form-group col-sm-12">
    {!! Form::label('megjegyzes', 'Megjegyzés:') !!}
    {!! Form::textarea('megjegyzes', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('partners.index') !!}" class="btn btn-default">Kilép</a>
</div>

@section('scripts')
    @include('functions.required_js')
    <script type="text/javascript">

        $('#adoszam').inputmask();
        $('#bankszamla').inputmask();

        RequiredBackgroundModify('.form-control')
        var SITEURL = "{{url('/')}}";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#isz').change(function(){
            var countryID = $('#isz').val();
            if(countryID){
                $.ajax({
                   type:"POST",
                   url: SITEURL + '/api/getTelepulesList',
                   data: "&id=" + countryID,
                   success:function(res){
                    if(res){
                        $("#telepules").empty();
                        $("#telepules").append('<option></option>');
                        $.each(res,function(key,value){
                            var option = "<option value='"+value.id+"'>"+value.telepules+"</option>";
                            $("#telepules").append(option);
                        });
                        $('#telepules').val(res[0].id);
                    }else{
                       $("#telepules").empty();
                    }
                   }
                });
            }else{
                $("#telepules").empty();
            }
        });
    </script>
@endsection
