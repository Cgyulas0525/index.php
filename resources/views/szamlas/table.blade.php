<div class="table-responsive">
    <table class="table" id="szamlas-table">
        <thead>
            <tr>
                <th>Partner</th>
        <th>Szamlaszam</th>
        <th>Fizitesimod</th>
        <th>Osszeg</th>
        <th>Kelt</th>
        <th>Teljesites</th>
        <th>Fizetesihatarido</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($szamlas as $szamla)
            <tr>
                <td>{!! $szamla->partner !!}</td>
            <td>{!! $szamla->szamlaszam !!}</td>
            <td>{!! $szamla->fizitesimod !!}</td>
            <td>{!! $szamla->osszeg !!}</td>
            <td>{!! $szamla->kelt !!}</td>
            <td>{!! $szamla->teljesites !!}</td>
            <td>{!! $szamla->fizetesihatarido !!}</td>
                <td>
                    {!! Form::open(['route' => ['szamlas.destroy', $szamla->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('szamlas.show', [$szamla->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('szamlas.edit', [$szamla->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
