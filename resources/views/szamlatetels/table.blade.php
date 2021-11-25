<div class="table-responsive">
    <table class="table" id="szamlatetels-table">
        <thead>
            <tr>
                <th>Szamla</th>
        <th>Termek</th>
        <th>Koltseg</th>
        <th>Afaszaz</th>
        <th>Netto</th>
        <th>Afa</th>
        <th>Brutto</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($szamlatetels as $szamlatetel)
            <tr>
                <td>{!! $szamlatetel->szamla !!}</td>
            <td>{!! $szamlatetel->termek !!}</td>
            <td>{!! $szamlatetel->koltseg !!}</td>
            <td>{!! $szamlatetel->afaszaz !!}</td>
            <td>{!! $szamlatetel->netto !!}</td>
            <td>{!! $szamlatetel->afa !!}</td>
            <td>{!! $szamlatetel->brutto !!}</td>
                <td>
                    {!! Form::open(['route' => ['szamlatetels.destroy', $szamlatetel->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('szamlatetels.show', [$szamlatetel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('szamlatetels.edit', [$szamlatetel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
