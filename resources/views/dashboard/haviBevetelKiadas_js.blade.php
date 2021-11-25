<script type="text/javascript">
    $(function () {


        function LineChartKategoria(data){
            kategoria = [];
            for (i = 0; i < data.length; i++){
                kategoria.push(data[i].nev);
            }
            return kategoria;
        }

        function LineChartData(data, mi){
            chartdata = [];
            bevdata = [];
            kiaddata = [];
            for (i = 0; i < data.length; i++){
                bevdata.push(parseInt(data[i].bev));
                kiaddata.push(parseInt(data[i].kiad))
            }
            chartdata.push({name: 'Bevétel', data: bevdata});
            chartdata.push({name: 'Kiadás', data: kiaddata});
            console.log(bevdata);
            console.log(kiaddata);
            console.log(chartdata);
            return chartdata;
        }

        var chart_havibevetelkiadas = highchartLine( 'havibevetelkiadas', 'line', 450, LineChartKategoria(<?php echo $haviBevetelKiadas; ?>), LineChartData(<?php echo $haviBevetelKiadas; ?>, ''), 'Havi bevétel/kiadás', 'havi bontás', 'forint');

    });

</script>


