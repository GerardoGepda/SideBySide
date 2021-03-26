function graficBySex(aprobados, reprobados, retirados) {
    total = parseInt(aprobados) + parseInt(reprobados) + parseInt(retirados);

    // calcular porcentajes
    PorcentajeAprobados = (parseInt(aprobados) * 100) / total;
    PorcentajeReprobados = (parseInt(reprobados) * 100) / total;
    PorcentajeRetirados = (parseInt(retirados) * 100) / total;

    // maquetación de graficas
    Highcharts.chart('gen2', {

        chart: {
            styledMode: false,
            height: (14 / 16 * 100) + '%' // 16:9 ratio
        },

        title: {
            text: 'Fenemino',
            style: {
                color: '#be0032',
                fontWeight: 'bold'
            }
        },

        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        legend: {
            // propiedades de las leyendas
            align: 'right',
            // verticalAlign: 'top',
            // layout: 'vertical',
            // x: 0,
            // y: 100
        },

        series: [{
            type: 'pie',
            allowPointSelect: true,
            keys: ['name', 'y', 'selected', 'sliced'],
            data: [
                ['Aprobadas: ' + aprobados + ' ', PorcentajeAprobados, true],
                ['Reprobadas: ' + reprobados + ' ', PorcentajeReprobados, true],
                ['Retiradas: ' + retirados + '', PorcentajeRetirados, true],
            ],
            showInLegend: true
        }],
        navigation: {
            buttonOptions: {
                align: 'right',
                verticalAlign: 'top',
                layout: 'vertical'
            }
        },
        credits: {
            enabled: false
        },
        colors: ['#54E38A', '#FF8C64', '#FFF587', '#FF665A', '#9154E3']
    });
}