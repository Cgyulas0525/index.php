@include('pekaru.termekFields')

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('termeks.index') !!}" class="btn btn-default">Kilép</a>
</div>

@section('scripts')

    @include('functions.required_js')
    @include('functions.kovetkezoCikkszam_js')

    <script type="text/javascript">

        var SITEURL = "{{url('/')}}";
        var CIKKSZAM = " ";

        RequiredBackgroundModify('.form-control')

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#csoport').change(function(){
            getFocsoportFromCsoport($('#csoport').val());
        });

    </script>
@endsection
