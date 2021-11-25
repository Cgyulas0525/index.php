<script type="text/javascript">
    $(function () {

        function LineChartKategoria(data){
            kategoria = [];
            for (i = 0; i < data.length; i++){
                kategoria.push(data[i].nap);
            }
            return kategoria;
        }

        function LineChartData(data, mi){
            chartdata = [];
            cdata = [];
            for (i = 0; i < data.length; i++){
                cdata.push(parseInt(data[i].osszeg));
            }
            chartdata.push({name: mi, data: cdata});
            return chartdata;
        }

        var chart_haviNapiArbevetel = highchartLine( 'haviNapiArbevetel', 'line', 450, LineChartKategoria(<?php echo $haviNapiArbevetel; ?>), LineChartData(<?php echo $haviNapiArbevetel; ?>, ''), 'Aktuális havi árbevétel', 'napi bontás', 'forint');

    });

</script>
