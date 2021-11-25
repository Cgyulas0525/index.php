<div class="table-responsive">
    <table class="table" id="modulszuros-table">
        <thead>
            <tr>
                <th>Modul Id</th>
        <th>Sorszam</th>
        <th>Nev</th>
        <th>Megjegyzes</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($modulszuros as $modulszuro)
            <tr>
                <td>{!! $modulszuro->modul_id !!}</td>
            <td>{!! $modulszuro->sorszam !!}</td>
            <td>{!! $modulszuro->nev !!}</td>
            <td>{!! $modulszuro->megjegyzes !!}</td>
                <td>
                    {!! Form::open(['route' => ['modulszuros.destroy', $modulszuro->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('modulszuros.show', [$modulszuro->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('modulszuros.edit', [$modulszuro->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
