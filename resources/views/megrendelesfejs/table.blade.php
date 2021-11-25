<div class="table-responsive">
    <table class="table" id="megrendelesfejs-table">
        <thead>
            <tr>
                <th>Datum</th>
        <th>Partner</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($megrendelesfejs as $megrendelesfej)
            <tr>
                <td>{!! $megrendelesfej->datum !!}</td>
            <td>{!! $megrendelesfej->partner !!}</td>
                <td>
                    {!! Form::open(['route' => ['megrendelesfejs.destroy', $megrendelesfej->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('megrendelesfejs.show', [$megrendelesfej->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('megrendelesfejs.edit', [$megrendelesfej->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
