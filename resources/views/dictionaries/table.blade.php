<div class="table-responsive">
    <table class="table table-striped table-bordered" id="dictionaries-table">
        <thead>
            <tr>
                <th>Típus</th>
                <th>Név</th>
                <th>Leírás</th>
                <th>Akció</th>
            </tr>
        </thead>
        <tbody>
        @foreach($dictionaries as $dictionary)
            <tr>
                <td>{!! $dictionary->tnev !!}</td>
                <td>{!! $dictionary->nev !!}</td>
                <td>{!! $dictionary->leiras !!}</td>
                <td>
                    {!! Form::open(['route' => ['dictionaries.destroy', $dictionary->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('dictionaries.edit', [$dictionary->id]) !!}" class='btn btn-success btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Törli a tételt?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
              <th>Típus</th>
              <th>Név</th>
              <th>Leírás</th>
              <th>Akció</th>
            </tr>
        </tfoot>

    </table>
</div>
