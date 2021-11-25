<div class="table-responsive">
    <table class="table" id="mozgaskods-table">
        <thead>
            <tr>
                <th>Nev</th>
        <th>Prefix</th>
        <th>Honnan</th>
        <th>Hova</th>
        <th>Pm</th>
        <th>Megjegyzes</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($mozgaskods as $mozgaskod)
            <tr>
                <td>{!! $mozgaskod->nev !!}</td>
            <td>{!! $mozgaskod->prefix !!}</td>
            <td>{!! $mozgaskod->honnan !!}</td>
            <td>{!! $mozgaskod->hova !!}</td>
            <td>{!! $mozgaskod->pm !!}</td>
            <td>{!! $mozgaskod->megjegyzes !!}</td>
                <td>
                    {!! Form::open(['route' => ['mozgaskods.destroy', $mozgaskod->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('mozgaskods.show', [$mozgaskod->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('mozgaskods.edit', [$mozgaskod->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
