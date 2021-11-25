<div class="table-responsive">
    <table class="table" id="zaras-table">
        <thead>
            <tr>
                <th>Datum</th>
        <th>5</th>
        <th>10</th>
        <th>20</th>
        <th>50</th>
        <th>100</th>
        <th>200</th>
        <th>500</th>
        <th>1000</th>
        <th>2000</th>
        <th>5000</th>
        <th>10000</th>
        <th>20000</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($zaras as $zaras)
            <tr>
                <td>{!! $zaras->datum !!}</td>
            <td>{!! $zaras->5 !!}</td>
            <td>{!! $zaras->10 !!}</td>
            <td>{!! $zaras->20 !!}</td>
            <td>{!! $zaras->50 !!}</td>
            <td>{!! $zaras->100 !!}</td>
            <td>{!! $zaras->200 !!}</td>
            <td>{!! $zaras->500 !!}</td>
            <td>{!! $zaras->1000 !!}</td>
            <td>{!! $zaras->2000 !!}</td>
            <td>{!! $zaras->5000 !!}</td>
            <td>{!! $zaras->10000 !!}</td>
            <td>{!! $zaras->20000 !!}</td>
                <td>
                    {!! Form::open(['route' => ['zaras.destroy', $zaras->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('zaras.show', [$zaras->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('zaras.edit', [$zaras->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
