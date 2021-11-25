<div class="table-responsive">
    <table class="table" id="mozgasfejs-table">
        <thead>
            <tr>
                <th>Datum</th>
        <th>Partner</th>
        <th>Bizszam</th>
        <th>Bf</th>
        <th>Feldolgozott</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($mozgasfejs as $mozgasfej)
            <tr>
                <td>{!! $mozgasfej->datum !!}</td>
            <td>{!! $mozgasfej->partner !!}</td>
            <td>{!! $mozgasfej->bizszam !!}</td>
            <td>{!! $mozgasfej->bf !!}</td>
            <td>{!! $mozgasfej->feldolgozott !!}</td>
                <td>
                    {!! Form::open(['route' => ['mozgasfejs.destroy', $mozgasfej->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('mozgasfejs.show', [$mozgasfej->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('mozgasfejs.edit', [$mozgasfej->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
