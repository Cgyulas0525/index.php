<div class="table-responsive">
    <table class="table" id="mozgastetels-table">
        <thead>
            <tr>
                <th>Mozgasfej</th>
        <th>Termek</th>
        <th>Mennyiseg</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($mozgastetels as $mozgastetel)
            <tr>
                <td>{!! $mozgastetel->mozgasfej !!}</td>
            <td>{!! $mozgastetel->termek !!}</td>
            <td>{!! $mozgastetel->mennyiseg !!}</td>
                <td>
                    {!! Form::open(['route' => ['mozgastetels.destroy', $mozgastetel->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('mozgastetels.show', [$mozgastetel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('mozgastetels.edit', [$mozgastetel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
