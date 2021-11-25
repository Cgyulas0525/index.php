<div class="table-responsive">
    <table class="table" id="penztarTetels-table">
        <thead>
            <tr>
                <th>Penztarfej Id</th>
        <th>Sorszam</th>
        <th>Termek Id</th>
        <th>Darab</th>
        <th>Netto</th>
        <th>Afa</th>
        <th>Brutto</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($penztarTetels as $penztarTetel)
            <tr>
                <td>{!! $penztarTetel->penztarfej_id !!}</td>
            <td>{!! $penztarTetel->sorszam !!}</td>
            <td>{!! $penztarTetel->termek_id !!}</td>
            <td>{!! $penztarTetel->darab !!}</td>
            <td>{!! $penztarTetel->netto !!}</td>
            <td>{!! $penztarTetel->afa !!}</td>
            <td>{!! $penztarTetel->brutto !!}</td>
                <td>
                    {!! Form::open(['route' => ['penztarTetels.destroy', $penztarTetel->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('penztarTetels.show', [$penztarTetel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('penztarTetels.edit', [$penztarTetel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
