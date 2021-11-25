<div class="table-responsive">
    <table class="table" id="koltsegcsoports-table">
        <thead>
            <tr>
                <th>Focsoport</th>
        <th>Nev</th>
        <th>Megjegyzes</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($koltsegcsoports as $koltsegcsoport)
            <tr>
                <td>{!! $koltsegcsoport->focsoport !!}</td>
            <td>{!! $koltsegcsoport->nev !!}</td>
            <td>{!! $koltsegcsoport->megjegyzes !!}</td>
                <td>
                    {!! Form::open(['route' => ['koltsegcsoports.destroy', $koltsegcsoport->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('koltsegcsoports.show', [$koltsegcsoport->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('koltsegcsoports.edit', [$koltsegcsoport->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
