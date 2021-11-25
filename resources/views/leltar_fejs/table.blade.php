<div class="table-responsive">
    <table class="table" id="leltarFejs-table">
        <thead>
            <tr>
                <th>Datum</th>
        <th>Raktar Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($leltarFejs as $leltarFej)
            <tr>
                <td>{!! $leltarFej->datum !!}</td>
            <td>{!! $leltarFej->raktar_id !!}</td>
                <td>
                    {!! Form::open(['route' => ['leltarFejs.destroy', $leltarFej->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('leltarFejs.show', [$leltarFej->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('leltarFejs.edit', [$leltarFej->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
