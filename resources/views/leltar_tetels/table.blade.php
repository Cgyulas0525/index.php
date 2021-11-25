<div class="table-responsive">
    <table class="table" id="leltarTetels-table">
        <thead>
            <tr>
                <th>Leltarfej Id</th>
        <th>Termek Id</th>
        <th>Darab</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($leltarTetels as $leltarTetel)
            <tr>
                <td>{!! $leltarTetel->leltarfej_id !!}</td>
            <td>{!! $leltarTetel->termek_id !!}</td>
            <td>{!! $leltarTetel->darab !!}</td>
                <td>
                    {!! Form::open(['route' => ['leltarTetels.destroy', $leltarTetel->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('leltarTetels.show', [$leltarTetel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('leltarTetels.edit', [$leltarTetel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
