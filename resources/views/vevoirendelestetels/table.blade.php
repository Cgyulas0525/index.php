<div class="table-responsive">
    <table class="table" id="vevoirendelestetels-table">
        <thead>
            <tr>
                <th>Vevoimegrendelesfej Id</th>
        <th>Termek Id</th>
        <th>Mennyiseg</th>
        <th>Atadott</th>
        <th>Megjegyzes</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($vevoirendelestetels as $vevoirendelestetel)
            <tr>
                <td>{!! $vevoirendelestetel->vevoimegrendelesfej_id !!}</td>
            <td>{!! $vevoirendelestetel->termek_id !!}</td>
            <td>{!! $vevoirendelestetel->mennyiseg !!}</td>
            <td>{!! $vevoirendelestetel->atadott !!}</td>
            <td>{!! $vevoirendelestetel->megjegyzes !!}</td>
                <td>
                    {!! Form::open(['route' => ['vevoirendelestetels.destroy', $vevoirendelestetel->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('vevoirendelestetels.show', [$vevoirendelestetel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('vevoirendelestetels.edit', [$vevoirendelestetel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
