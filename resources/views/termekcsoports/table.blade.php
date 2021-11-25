<div class="table-responsive">
    <table class="table" id="termekcsoports-table">
        <thead>
            <tr>
                <th>Focsoport</th>
        <th>Nev</th>
        <th>Megjegyzes</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($termekcsoports as $termekcsoport)
            <tr>
                <td>{!! $termekcsoport->focsoport !!}</td>
            <td>{!! $termekcsoport->nev !!}</td>
            <td>{!! $termekcsoport->megjegyzes !!}</td>
                <td>
                    {!! Form::open(['route' => ['termekcsoports.destroy', $termekcsoport->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('termekcsoports.show', [$termekcsoport->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('termekcsoports.edit', [$termekcsoport->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
