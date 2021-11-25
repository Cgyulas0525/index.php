<div class="table-responsive">
    <table class="table" id="listas-table">
        <thead>
            <tr>
                <th>Modul Id</th>
        <th>Nev</th>
        <th>Megjegyzes</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($listas as $lista)
            <tr>
                <td>{!! $lista->modul_id !!}</td>
            <td>{!! $lista->nev !!}</td>
            <td>{!! $lista->megjegyzes !!}</td>
                <td>
                    {!! Form::open(['route' => ['listas.destroy', $lista->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('listas.show', [$lista->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('listas.edit', [$lista->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
