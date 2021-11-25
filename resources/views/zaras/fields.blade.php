<!-- Datum Field -->
<div class="form-group col-sm-2">
    {!! Form::label('datum', 'Dátum:') !!}
    {!! Form::date('datum',  \Carbon\Carbon::now(), ['class' => 'form-control','id'=>'datum']) !!}
    {!! Form::label('kartya', 'myPos:') !!}
    {!! Form::number('kartya', 0, ['class' => 'form-control  text-right', 'id' => 'kartya']) !!}
    {!! Form::label('szep', 'SZÉP kártya:') !!}
    {!! Form::number('szep', 0, ['class' => 'form-control  text-right', 'id' => 'szep']) !!}
    {!! Form::label('Sum', 'Összesen:') !!}
    {!! Form::number('Sum', 0, ['style' => 'cursor: not-allowed', 'class'=>'form-control  text-right', 'readonly' => 'true', 'id' => 'Sum']) !!}
    {!! Form::label('napkozben', 'Napközben kivett:') !!}
    {!! Form::number('napkozben', 0, ['class'=>'form-control  text-right', 'id' => 'napkozben']) !!}
    {!! Form::label('kiveheto', 'Kivehető:') !!}
    {!! Form::number('kiveheto', 0, ['style' => 'cursor: not-allowed', 'class'=>'form-control  text-right', 'readonly' => 'true', 'id' => 'kiveheto']) !!}
</div>

<!-- 5 Field -->
<div class="form-group col-sm-2">
    {!! Form::label('5', '5:') !!}
    {!! Form::number('A5', 0, ['class' => 'form-control  text-right', 'id' => 'A5']) !!}
    {!! Form::label('10', '10:') !!}
    {!! Form::number('A10', 0, ['class' => 'form-control  text-right', 'id' => 'A10']) !!}
    {!! Form::label('20', '20:') !!}
    {!! Form::number('A20', 0, ['class' => 'form-control  text-right', 'id' => 'A20']) !!}
    {!! Form::label('50', '50:') !!}
    {!! Form::number('A50', 0, ['class' => 'form-control  text-right', 'id' => 'A50']) !!}
    {!! Form::label('100', '100:') !!}
    {!! Form::number('A100', 0, ['class' => 'form-control  text-right', 'id' => 'A100']) !!}
    {!! Form::label('200', '200:') !!}
    {!! Form::number('A200', 0, ['class' => 'form-control  text-right', 'id' => 'A200']) !!}
</div>
<div class="form-group col-sm-2">
    {!! Form::label('500', '500:') !!}
    {!! Form::number('A500', 0, ['class' => 'form-control  text-right', 'id' => 'A500']) !!}
    {!! Form::label('1000', '1000:') !!}
    {!! Form::number('A1000', 0, ['class' => 'form-control  text-right', 'id' => 'A1000']) !!}
    {!! Form::label('2000', '2000:') !!}
    {!! Form::number('A2000', 0, ['class' => 'form-control  text-right', 'id' => 'A2000']) !!}
    {!! Form::label('5000', '5000:') !!}
    {!! Form::number('A5000', 0, ['class' => 'form-control  text-right', 'id' => 'A5000']) !!}
    {!! Form::label('10000', '10000:') !!}
    {!! Form::number('A10000', 0, ['class' => 'form-control  text-right', 'id' => 'A10000']) !!}
    {!! Form::label('20000', '20000:') !!}
    {!! Form::number('A20000', 0, ['class' => 'form-control  text-right', 'id' => 'A20000']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('zaras.index') !!}" class="btn btn-default">Kilép</a>
</div>

@section('scripts')
    @include('functions.required_js')
    <script type="text/javascript">
        RequiredBackgroundModify('.form-control')

        function Sum(){
            var sum = 0;
            sum = sum + (parseInt($('#A5').val()) * 5);
            sum = sum + (parseInt($('#A10').val()) * 10);
            sum = sum + (parseInt($('#A20').val()) * 20);
            sum = sum + (parseInt($('#A50').val()) * 50);
            sum = sum + (parseInt($('#A100').val()) * 100);
            sum = sum + (parseInt($('#A200').val()) * 200);
            sum = sum + (parseInt($('#A500').val()) * 500);
            sum = sum + (parseInt($('#A1000').val()) * 1000);
            sum = sum + (parseInt($('#A2000').val()) * 2000);
            sum = sum + (parseInt($('#A5000').val()) * 5000);
            sum = sum + (parseInt($('#A10000').val()) * 10000);
            sum = sum + (parseInt($('#A20000').val()) * 20000);
            sum = sum + parseInt($('#kartya').val());
            sum = sum + parseInt($('#szep').val());
            sum = sum + parseInt($('#napkozben').val())
            $('#Sum').val(sum);
            sum = ((sum - 20000) - (parseInt($('#kartya').val()) + parseInt($('#szep').val()))) - parseInt($('#napkozben').val());
            $('#kiveheto').val(sum);
        }

        $('#A5').change(function(){
            Sum()
        });
        $('#A10').change(function(){
            Sum()
        });
        $('#A20').change(function(){
            Sum()
        });
        $('#A50').change(function(){
            Sum()
        });
        $('#A100').change(function(){
            Sum()
        });
        $('#A200').change(function(){
            Sum()
        });
        $('#A500').change(function(){
            Sum()
        });
        $('#A1000').change(function(){
            Sum()
        });
        $('#A2000').change(function(){
            Sum()
        });
        $('#A5000').change(function(){
            Sum()
        });
        $('#A10000').change(function(){
            Sum()
        });
        $('#A20000').change(function(){
            Sum()
        });
        $('#kartya').change(function(){
            Sum()
        });
        $('#napkozben').change(function(){
            Sum()
        });
        $('#szep').change(function(){
            Sum()
        });
    </script>
@endsection
