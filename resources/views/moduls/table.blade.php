<div class="table-responsive">
    <table class="table" id="moduls-table">
        <thead>
            <tr>
                <th>Nev</th>
        <th>Megjegyzes</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($moduls as $modul)
            <tr>
                <td>{!! $modul->nev !!}</td>
            <td>{!! $modul->megjegyzes !!}</td>
                <td>
                    {!! Form::open(['route' => ['moduls.destroy', $modul->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('moduls.show', [$modul->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('moduls.edit', [$modul->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
