@section('css')
    @include('layouts.costumcss')
@endsection()

<div class="content">
    <div class="row">
        <div class="col-xs-12">
            <h2 style="text-align: center;">
                Vonalkód cikkszám alapján
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
                    <th style="width: 300px; text-align: center;">Termék</th>
                    <th style="width: 100px; text-align: center;">Cikkszám</th>
                    <th style="width: 200px; text-align: center;">Vonalkód</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($termekek as $key => $termek)
                        <tr id="sor">
                            <td>{!! Form::text('nev', $termek->nev, ['readonly' => 'true', 'id' => 'nev', 'style' => 'cursor: not-allowed; width: 300px;']) !!}</td>
                            <td>{!! Form::text('cikkszam', $termek->cikkszam, ['readonly' => 'true', 'id' => 'cikkszam', 'style' => 'cursor: not-allowed; width: 100px;']) !!}</td>
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

            let rows = $("table tbody tr");
            let inputs;

            rows.each(function(i) {
                inputs = $(this).find('input');
                i++;
                inputs.eq(0).attr('id', 'nev' + i )
                    .attr('name', 'nev' + i )
                inputs.eq(1).attr('id', 'cikkszam' + i )
                    .attr('name', 'cikkszam' + i )
                var cikkszam = $('#cikkszam' + i).val();
                var $bars = $('<div class="thebars"><svg class="barcodes"></div></svg>').appendTo(this);
                $bars.find('.barcodes').JsBarcode(cikkszam, {
                    displayValue: false,
                    height: 20
                });
            });


        });
    </script>

@endsection

