<!-- Nev Field -->
<div class="form-group col-sm-6">
    <div class="row">
        <div class="col-lg-7">
            {!! Form::label('nev', 'Név:') !!}
            {!! Form::text('nev', null, ['class' => 'form-control']) !!}
        </div>
        <div class="col-lg-2">
            {!! Form::label('prefix', 'Prefix:') !!}
            {!! Form::text('prefix', null, ['class' => 'form-control']) !!}
        </div>
        <div class="col-lg-3">
            {!! Form::label('pm', 'P/M:') !!}
            {!! Form::select('pm', App\Classes\DDW::dictionaryDdw(34), null,['class'=>'select2 form-control', 'id' => 'pm']) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            {!! Form::label('honnan', 'Honnan:') !!}
            {!! Form::select('honnan', App\Classes\DDW::dictionaryDdw(33), null,['class'=>'select2 form-control', 'id' => 'honnan']) !!}
        </div>
        <div class="col-lg-6">
            {!! Form::label('hova', 'Hova:') !!}
            {!! Form::select('hova', App\Classes\DDW::dictionaryDdw(33), null,['class'=>'select2 form-control', 'id' => 'hova']) !!}
        </div>
    </div>
    {!! Form::label('megjegyzes', 'Megjegyzés:') !!}
    {!! Form::textarea('megjegyzes', null, ['row' => '4', 'class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('mozgaskods.index') !!}" class="btn btn-default">Kilép</a>
</div>

@section('scripts')
    <script type="text/javascript">
    
        function egyezike() {
            var honnan = $('#honnan').val();
            var hova = $('#hova').val();
            console.log(honnan, hova);
            if ( honnan != 0 && hova != 0 ) {
                if ( honnan === hova ) {
                    alert('Nem lehet a honnan és ahova egyforma!');
                    $('#honnan').focus();
                }
            }
        }
        
        $('#honnan').change(function() {
            egyezike();
        });

        $('#hova').change(function() {
            egyezike();
        });
        
        
    </script>
@endsection
