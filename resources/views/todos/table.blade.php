<div class="table-responsive">
    <table class="table" id="todos-table">
        <thead>
            <tr>
                <th>User</th>
        <th>Mit</th>
        <th>Mikorra</th>
        <th>Megjegyzes</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($todos as $todo)
            <tr>
                <td>{!! $todo->user !!}</td>
            <td>{!! $todo->mit !!}</td>
            <td>{!! $todo->mikorra !!}</td>
            <td>{!! $todo->megjegyzes !!}</td>
                <td>
                    {!! Form::open(['route' => ['todos.destroy', $todo->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('todos.show', [$todo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('todos.edit', [$todo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
