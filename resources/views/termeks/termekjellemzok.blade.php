<div class="form-group col-sm-4">
    <div class="row">
        <div class="mylabel col-sm-4">
            {!! Form::label('energiakjlabel', 'Energia kj:', ['id' => 'energiakjlabel']) !!}
        </div>
        <div class="col-sm-8">
            {!! Form::number('energiakj', !empty($termek) ? $termek->energiakj : null, ['class' => 'form-control  text-right', 'readonly' => $ro, 'id' => 'energiakj']) !!}
        </div>
    </div>
</div>
<div class="form-group col-sm-4">
    <div class="row">
        <div class="mylabel col-sm-4">
            {!! Form::label('energiakcallabel', 'Energia kcal:', ['id' => 'energiakcallabel']) !!}
        </div>
        <div class="col-sm-8">
            {!! Form::number('energiakcal', !empty($termek) ? $termek->energiakcal : null, ['class' => 'form-control  text-right', 'readonly' => $ro, 'id' => 'energiakcal']) !!}
        </div>
    </div>
</div>
<div class="form-group col-sm-4">
    <div class="row">
        <div class="mylabel col-sm-4">
            {!! Form::label('zsirlabel', 'Zsír:', ['id' => 'zsirlabel']) !!}
        </div>
        <div class="col-sm-8">
            {!! Form::number('zsir', !empty($termek) ? $termek->zsir : null, ['class' => 'form-control text-right', 'readonly' => $ro, 'id' => 'zsir', 'pattern="[0-9]+([\.,][0-9]+)?" step="0.01"']) !!}
        </div>
    </div>
</div>
<div class="form-group col-sm-4">
    <div class="row">
        <div class="mylabel col-sm-4">
            {!! Form::label('telitettlabel', 'Telített zsírsavak:', ['id' => 'telitettlabel']) !!}
        </div>
        <div class="col-sm-8">
            {!! Form::number('telitett', !empty($termek) ? $termek->telitett : null, ['class' => 'form-control text-right', 'readonly' => $ro, 'id' => 'telitett', 'pattern="[0-9]+([\.,][0-9]+)?" step="0.01"']) !!}
        </div>
    </div>
</div>
<div class="form-group col-sm-4">
    <div class="row">
        <div class="mylabel col-sm-4">
            {!! Form::label('szenhidratlabel', 'Szénhidrát:', ['id' => 'szenhidratlabel']) !!}
        </div>
        <div class="col-sm-8">
            {!! Form::number('szenhidrat', !empty($termek) ? $termek->szenhidrat : null, ['class' => 'form-control text-right', 'readonly' => $ro, 'id' => 'szenhidrat', 'pattern="[0-9]+([\.,][0-9]+)?" step="0.01"']) !!}
        </div>
    </div>
</div>
<div class="form-group col-sm-4">
    <div class="row">
        <div class="mylabel col-sm-4">
            {!! Form::label('cukorlabel', 'Cukor:', ['id' => 'cukorlabel']) !!}
        </div>
        <div class="col-sm-8">
            {!! Form::number('cukor', !empty($termek) ? $termek->cukor : null, ['class' => 'form-control text-right', 'readonly' => $ro, 'id' => 'cukor', 'pattern="[0-9]+([\.,][0-9]+)?" step="0.01"']) !!}
        </div>
    </div>
</div>
<div class="form-group col-sm-4">
    <div class="row">
        <div class="mylabel col-sm-4">
            {!! Form::label('rostlabel', 'Rost:', ['id' => 'rostlabel']) !!}
        </div>
        <div class="col-sm-8">
            {!! Form::number('rost', !empty($termek) ? $termek->rost : null, ['class' => 'form-control text-right', 'readonly' => $ro, 'id' => 'rost', 'pattern="[0-9]+([\.,][0-9]+)?" step="0.01"']) !!}
        </div>
    </div>
</div>
<div class="form-group col-sm-4">
    <div class="row">
        <div class="mylabel col-sm-4">
            {!! Form::label('feherjelabel', 'Fehérje:', ['id' => 'feherjelabel']) !!}
        </div>
        <div class="col-sm-8">
            {!! Form::number('feherje', !empty($termek) ? $termek->feherje : null, ['class' => 'form-control text-right', 'readonly' => $ro, 'id' => 'feherje', 'pattern="[0-9]+([\.,][0-9]+)?" step="0.01"']) !!}
        </div>
    </div>
</div>
<div class="form-group col-sm-4">
    <div class="row">
        <div class="mylabel col-sm-4">
            {!! Form::label('solabel', 'Só:', ['id' => 'solabel']) !!}
        </div>
        <div class="col-sm-8">
            {!! Form::number('so', !empty($termek) ? $termek->so : null, ['class' => 'form-control text-right', 'readonly' => $ro, 'id' => 'so', 'pattern="[0-9]+([\.,][0-9]+)?" step="0.01"']) !!}
        </div>
    </div>
</div>

<div class="form-group col-sm-12" >
    {!! Form::label('osszetevoklabel', 'Összetevők:', ['id' => 'osszetevoklabel']) !!}
    {!! Form::textarea('osszetevok', !empty($termek) ? $termek->osszetevok : null, ['class' => 'form-control', 'readonly' => $ro, 'id' => 'osszetevok', 'rows' => 4]) !!}
</div>
