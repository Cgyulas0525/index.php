<div class="table-responsive">
    <table class="table" id="raktarKeszlets-table">
        <thead>
            <tr>
                <th>Raktar Id</th>
        <th>Termek Id</th>
        <th>Mennyiseg</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($raktarKeszlets as $raktarKeszlet)
            <tr>
                <td>{!! $raktarKeszlet->raktar_id !!}</td>
            <td>{!! $raktarKeszlet->termek_id !!}</td>
            <td>{!! $raktarKeszlet->mennyiseg !!}</td>
                <td>
                    {!! Form::open(['route' => ['raktarKeszlets.destroy', $raktarKeszlet->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('raktarKeszlets.show', [$raktarKeszlet->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('raktarKeszlets.edit', [$raktarKeszlet->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
