<!-- Datum Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mozgaskod_id', 'Mozgás:') !!}
    {!! Form::select('mozgaskod_id', App\Classes\DDW::mozgasKodDdw(), null,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'mozgaskod_id']) !!}
<!--
    {!! Form::label('raktar', 'Raktár:') !!}
    {!! Form::select('raktar', App\Classes\DDW::dictionaryDdw(32), null,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'raktar']) !!}
-->
    {!! Form::label('datum', 'Dátum:') !!}
    {!! Form::date('datum', \Carbon\Carbon::now(), ['class' => 'form-control','id'=>'datum']) !!}
    {!! Form::label('partner', 'Partner:') !!}
    {!! Form::select('partner', App\Classes\DDW::partnerDdw(), null,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'partner']) !!}
</div>


<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('mozgasfejs.index') !!}" class="btn btn-default">Kilép</a>
</div>

