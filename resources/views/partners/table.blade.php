<div class="table-responsive">
    <table class="table" id="partners-table">
        <thead>
            <tr>
                <th>Nev</th>
        <th>Tipus</th>
        <th>Adoszam</th>
        <th>Bankszamla</th>
        <th>Isz</th>
        <th>Telepules</th>
        <th>Cim</th>
        <th>Email</th>
        <th>Telefonszam</th>
        <th>Megjegyzes</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($partners as $partner)
            <tr>
                <td>{!! $partner->nev !!}</td>
            <td>{!! $partner->tipus !!}</td>
            <td>{!! $partner->adoszam !!}</td>
            <td>{!! $partner->bankszamla !!}</td>
            <td>{!! $partner->isz !!}</td>
            <td>{!! $partner->telepules !!}</td>
            <td>{!! $partner->cim !!}</td>
            <td>{!! $partner->email !!}</td>
            <td>{!! $partner->telefonszam !!}</td>
            <td>{!! $partner->megjegyzes !!}</td>
                <td>
                    {!! Form::open(['route' => ['partners.destroy', $partner->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('partners.show', [$partner->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('partners.edit', [$partner->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
