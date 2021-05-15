
function graficarTorta(promedios){
    var datos = [];
    console.log(promedios);
    for(let i = 0; i < promedios.length; i++) { 
        var serie = new Array(promedios[i].nombreMateria,parseInt(promedios[i].promedio),null);
        datos.push(serie);
    }
    console.log(datos);
    // Create the chart
    Highcharts.chart('container', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Promedios de notas por materia'
        },
        subtitle: {
            text: 'Promedios'
        },

        accessibility: {
            announceNewData: {
                enabled: true
            },
            point: {
                valueSuffix: ''
            }
        },

        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.y:.1f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> Calificación promedio<br/>'
        },

        series: [
            {
                
                name: "Materias",
                colorByPoint: true,
                data: datos
            }
        ]
    });
    
}