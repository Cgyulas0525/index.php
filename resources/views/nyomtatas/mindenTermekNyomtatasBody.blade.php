@section('css')
    @include('layouts.costumcss')
@endsection()

<div class="content">
    <div class="row">
        <div class="col-xs-12">
            <h2 style="text-align: center;">
                Minden Termék
            </h2>
        </div>
        <!-- /.col -->
    </div>

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th style="text-align: center;">Termék csoport</th>
                    <th style="text-align: center;">Termék</th>
                    <th style="text-align: center;">Cikkszám</th>
                    <th style="text-align: center;">Me</th>
                    <th style="width: 100px; text-align: right;">Beszerzési ár</th>
                    <th style="width: 100px; text-align: right;">Ár</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($termekek as $key => $termek)
                        <tr id="sor">
                            <td>{{ $termek->csoportnev }}</td>
                            <td>{{ $termek->nev }}</td>
                            <td style="text-align: center;">{{ $termek->cikkszam }}</td>
                            <td style="text-align: center;">{{ $termek->menev }}</td>
                            <td style="width: 100px; text-align: right;">{{ number_format($termek->beszar, 0, ",", "." ) }}</td>
                            <td style="width: 100px; text-align: right;">{{ number_format($termek->ar, 0, ",", ".") }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <p class="lead">Készült: {{ date('Y.m.d', strtotime(\Carbon\Carbon::now())) }}</p>
        </div>
    </div>
</div>

@section('scripts')

    <script type="text/javascript">
        $(function () {


        });
    </script>

@endsection

