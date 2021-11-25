<script type="text/javascript">
function highchart( renderTo, type, height, kategoria, data_view, chartTitleText, chartSubtitleText, yAxisTitleText, tooltipValueSuffix){
    var chart = new Highcharts.chart({
        lang: {
          loading: 'Betöltés...',
          viewFullscreen: 'Teljes képernyő',
          exitFullscreen: 'Kilépés a teljes képernyőből',
          months: ['január', 'február', 'március', 'április', 'május','június',
                  'július', 'augusztus', 'szeptember', 'október', 'november', 'december'],
          shortMonths:  ['jan', 'febr', 'márc', 'ápr', 'máj', 'jún', 'júl', 'aug', 'szept', 'okt', 'nov', 'dec'],
          weekdays: ['vasárnap', 'hétfő', 'kedd', 'szerda', 'csütörtök', 'péntek', 'szombat'],
          exportButtonTitle: "Exportál",
          printButtonTitle: "Importál",
          rangeSelectorFrom: "ettől",
          rangeSelectorTo: "eddig",
          rangeSelectorZoom: "mutat:",
          downloadCSV: 'Letöltés CSV fileként',
          downloadXLS: 'Letöltés XLS fileként',
          downloadPNG: 'Letöltés PNG képként',
          downloadJPEG: 'Letöltés JPEG képként',
          downloadPDF: 'Letöltés PDF dokumentumként',
          downloadSVG: 'Letöltés SVG formátumban',
          resetZoom: "Visszaállít",
          resetZoomTitle: "Visszaállít",
          thousandsSep: "",
          decimalPoint: ',',
          viewData: 'Táblázat',
          printChart: 'Nyomtatás'
        },
        chart: {
            renderTo: renderTo,
            height: height,
            type: type
        },
        title: {
            text: chartTitleText
        },
        subtitle: {
            text: chartSubtitleText
        },
        xAxis: {
            categories: kategoria,
            tickmarkPlacement: 'on',
            title: {
                enabled: false
            }
        },
        yAxis: {
            title: {
                text: yAxisTitleText
            },
            labels: {
                formatter: function () {
                    return this.value;
              }
            }
        },
        tooltip: {
            split: true,
            valueSuffix: tooltipValueSuffix
        },
        plotOptions: {
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },
        series: data_view
    });
    return chart;
}
</script>
