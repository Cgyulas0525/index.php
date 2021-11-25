<div class="table-responsive">
    <table class="table" id="koltsegfocsoports-table">
        <thead>
            <tr>
                <th>Nev</th>
        <th>Megjegyzes</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($koltsegfocsoports as $koltsegfocsoport)
            <tr>
                <td>{!! $koltsegfocsoport->nev !!}</td>
            <td>{!! $koltsegfocsoport->megjegyzes !!}</td>
                <td>
                    {!! Form::open(['route' => ['koltsegfocsoports.destroy', $koltsegfocsoport->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('koltsegfocsoports.show', [$koltsegfocsoport->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('koltsegfocsoports.edit', [$koltsegfocsoport->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
