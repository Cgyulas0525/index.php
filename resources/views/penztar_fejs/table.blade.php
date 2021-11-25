<div class="table-responsive">
    <table class="table" id="penztarFejs-table">
        <thead>
            <tr>
                <th>Bizonylatszam</th>
        <th>Ertek</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($penztarFejs as $penztarFej)
            <tr>
                <td>{!! $penztarFej->bizonylatszam !!}</td>
            <td>{!! $penztarFej->ertek !!}</td>
                <td>
                    {!! Form::open(['route' => ['penztarFejs.destroy', $penztarFej->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('penztarFejs.show', [$penztarFej->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('penztarFejs.edit', [$penztarFej->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
