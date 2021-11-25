<div class="table-responsive">
    <table class="table" id="termeks-table">
        <thead>
            <tr>
                <th>Nev</th>
        <th>Cikkszam</th>
        <th>Me</th>
        <th>Tsz</th>
        <th>Megjegyzes</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($termeks as $termek)
            <tr>
                <td>{!! $termek->nev !!}</td>
            <td>{!! $termek->cikkszam !!}</td>
            <td>{!! $termek->me !!}</td>
            <td>{!! $termek->tsz !!}</td>
            <td>{!! $termek->megjegyzes !!}</td>
                <td>
                    {!! Form::open(['route' => ['termeks.destroy', $termek->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('termeks.show', [$termek->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('termeks.edit', [$termek->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
