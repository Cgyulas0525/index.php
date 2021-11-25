<script type="text/javascript">
function highchartLine( renderTo, type, height, kategoria, data_view, chartTitleText, chartSubtitleText, yAxisTitleText){
    var chart = Highcharts.chart({
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
            categories: kategoria
        },
        yAxis: {
            title: {
              text: yAxisTitleText
            }
        },
        plotOptions: {
            line: {
              dataLabels: {
                enabled: true
              },
              enableMouseTracking: false
            }
        },
        series: data_view
    });
    return chart;
}

</script>
