<div class="table-responsive">
    <table class="display table-striped table-bordered" id="main-table">
        <thead>
            <tr>
                <th>Név</th>
                <th>Leírás</th>
                <th>Akció</th>
            </tr>
        </thead>
        <tbody>
        @foreach($types as $type)
            <tr>
            <td>{!! $type->nev !!}</td>
            <td>{!! $type->leiras !!}</td>
            <td>
                {!! Form::open(['route' => ['types.destroy', $type->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
<!--                    <a href="{!! route('types.show', [$type->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>-->
                    <a href="{!! route('types.edit', [$type->id]) !!}" class='btn btn-success btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Törli a tételt?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        @endforeach
        </tbody>
    </table>
</div>
