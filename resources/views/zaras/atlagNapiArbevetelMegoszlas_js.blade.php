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

            var chart_megye = HCCF(<?php echo $atlag; ?>, 'atlagNapiArbevetelMegoszlas', 'column', 350, 25, 'lightgray', 3, 'Árbevétel megoszlás', 'Egyszerű', ' darab', false, false);
            HCCGomb('#plain_am', '#inverted_am', '#polar_am', chart_megye)
        });

    </script>
</div>
