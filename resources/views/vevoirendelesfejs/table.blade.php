<div class="table-responsive">
    <table class="table" id="vevoirendelesfejs-table">
        <thead>
            <tr>
                <th>Partner Id</th>
        <th>Mikor</th>
        <th>Mikorra</th>
        <th>Statusz</th>
        <th>Megjegyzes</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($vevoirendelesfejs as $vevoirendelesfej)
            <tr>
                <td>{!! $vevoirendelesfej->partner_id !!}</td>
            <td>{!! $vevoirendelesfej->mikor !!}</td>
            <td>{!! $vevoirendelesfej->mikorra !!}</td>
            <td>{!! $vevoirendelesfej->statusz !!}</td>
            <td>{!! $vevoirendelesfej->megjegyzes !!}</td>
                <td>
                    {!! Form::open(['route' => ['vevoirendelesfejs.destroy', $vevoirendelesfej->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('vevoirendelesfejs.show', [$vevoirendelesfej->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('vevoirendelesfejs.edit', [$vevoirendelesfej->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
