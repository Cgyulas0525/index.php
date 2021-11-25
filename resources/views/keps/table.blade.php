<div class="table-responsive">
    <table class="table" id="keps-table">
        <thead>
            <tr>
                <th>Parent Id</th>
        <th>Dictionaries Id</th>
        <th>Fokep</th>
        <th>Kep</th>
        <th>Kicsikep</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($keps as $kep)
            <tr>
                <td>{!! $kep->parent_id !!}</td>
            <td>{!! $kep->dictionaries_id !!}</td>
            <td>{!! $kep->fokep !!}</td>
            <td>{!! $kep->kep !!}</td>
            <td>{!! $kep->kicsikep !!}</td>
                <td>
                    {!! Form::open(['route' => ['keps.destroy', $kep->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('keps.show', [$kep->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('keps.edit', [$kep->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
