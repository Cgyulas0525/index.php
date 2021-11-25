<div>
    <script type="text/javascript">
        $(function () {

            var rdata = ['Hétfö', 'Kedd', 'Szerda', 'Csütörtök', 'Péntek', 'Szombat', 'Vasárnap'];

           function HCCF(data_view_at, renderTo, type, height, borderRadius, borderColor, borderWidth, titleText, subtitleText, valueSuffix, inverted, polar){
               var data_at = [];
                var kategoria_at = [];
                for (i = 0; i < data_view_at.length; i++) {
                    kategoria_at.push(data_view_at[i].nev);
                    data_at.push(parseInt(data_view_at[i].osszeg));
                }
                var chart = HighChartColumn(renderTo, type, kategoria_at, data_at, height, borderRadius, borderColor, borderWidth, titleText, subtitleText, valueSuffix, inverted, polar);
                chartSkin(chart, '#FFFFFF', 25, 'lightgray', 3);
                return chart;
            }

            var chart_megye = HCCF(<?php echo $haviNapiArbevetelMegoszlasOszlop; ?>, 'napiMegoszlasOszlop', 'column', 350, 25, 'lightgray', 3, 'Árbevétel megoszlás', 'Poláris', ' darab', false, true);
            HCCGomb('#plain_m', '#inverted_m', '#polar_m', chart_megye)
        });

    </script>
</div>
