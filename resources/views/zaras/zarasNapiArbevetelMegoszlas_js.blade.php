<div>
    <script type="text/javascript">
        $(function () {

            var rdata = ['Hétfö', 'Kedd', 'Szerda', 'Csütörtök', 'Péntek', 'Szombat', 'Vasárnap'];

            function kategoriaFeltolt(data){
                var vkategoria = [];
                for (i = 0; i < rdata.length; i++){
                    for (j = 0; j < data.length; j++){
                        if (data[j].nev == rdata[i]){
                            vkategoria.push(data[j].nev);
                        }
                    }
                }
                return vkategoria;
            }


            function kategoriaPieData(data){
              var vpieData = [];
              for (i = 0; i < rdata.length; i++){
                  for (j = 0; j < data.length; j++){
                      if (data[j].nev == rdata[i]){
                          vpieData.push({name: data[j].nev, y: parseInt(Math.round(data[j].osszeg).toFixed(0))});
                      }
                  }
              }
              return vpieData;
            }

            var kategoria = kategoriaFeltolt(<?php echo $haviNapiArbevetelMegoszlas; ?>);
            var pieData = kategoriaPieData(<?php echo $haviNapiArbevetelMegoszlas; ?>);
            var chart_koltsegcsoport = HighChartPie( 'haviNapiArbevetelMegoszlas', 'pie', 350, kategoria, pieData, 'Össz árbevétel megoszlás', 'Naponként', 'Nap', 200, true, true, '40%');

        });

    </script>
</div>
