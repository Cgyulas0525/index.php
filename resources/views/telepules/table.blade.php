<div class="table-responsive">
    <table class="table" id="telepules-table">
        <thead>
            <tr>
                <th>Iranyitoszam</th>
        <th>Telepules</th>
        <th>Megye</th>
        <th>Jaras</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($telepules as $telepules)
            <tr>
                <td>{!! $telepules->iranyitoszam !!}</td>
            <td>{!! $telepules->telepules !!}</td>
            <td>{!! $telepules->megye !!}</td>
            <td>{!! $telepules->jaras !!}</td>
                <td>
                    {!! Form::open(['route' => ['telepules.destroy', $telepules->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('telepules.show', [$telepules->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('telepules.edit', [$telepules->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
