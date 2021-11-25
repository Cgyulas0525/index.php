<div class="table-responsive">
    <table class="table" id="modulidoszaks-table">
        <thead>
            <tr>
                <th>Modul Id</th>
        <th>Nev</th>
        <th>Dictionaries Id</th>
        <th>Hossz</th>
        <th>Megjegyzes</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($modulidoszaks as $modulidoszak)
            <tr>
                <td>{!! $modulidoszak->modul_id !!}</td>
            <td>{!! $modulidoszak->nev !!}</td>
            <td>{!! $modulidoszak->dictionaries_id !!}</td>
            <td>{!! $modulidoszak->hossz !!}</td>
            <td>{!! $modulidoszak->megjegyzes !!}</td>
                <td>
                    {!! Form::open(['route' => ['modulidoszaks.destroy', $modulidoszak->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('modulidoszaks.show', [$modulidoszak->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('modulidoszaks.edit', [$modulidoszak->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
