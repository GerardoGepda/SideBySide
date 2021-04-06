function ciclos() {
    var selected = [];
    // seleccionar todos los ciclos
    for (var option of document.getElementById('ciclo').options) {
        if (option.selected) {
            selected.push(option.value);
        }
    }
    listaCiclos = selected;
}

function clases() {
    var selected = [];
    // seleccionar todos los ciclos
    for (var option of document.getElementById('clase').options) {
        if (option.selected) {
            selected.push(option.value);
        }
    }
    listaClases = selected;
}

function financiamiento() {
    var selected = [];
    // seleccionar todos los ciclos
    for (var option of document.getElementById('financiamiento').options) {
        if (option.selected) {
            selected.push(option.value);
        }
    }
    listaFinanciamiento = selected;
}

function sede() {
    var selected = [];
    // seleccionar todos los ciclos
    for (var option of document.getElementById('sede').options) {
        if (option.selected) {
            selected.push(option.value);
        }
    }
    listaSede = selected;
}

// la funcion ShowSelected recibe como parametro ciclos,
// el el array ciclos se extrae de la funcion ciclos() que extrae los ciclos seleccionados
function ShowSelected(ciclos, clases, financiamiento, sedes) {
    const ciclo = document.getElementById("ciclo").value;
    const clase = document.getElementById("clase").value;
    $.ajax({
        url: '../CoachReuniones/Modelo/ModeloReportes/ModelUniversidad/cargarMap.php',
        data: {
            "ciclo": ciclo,
            "class": clase,
            "ciclos": ciclos,
            "clases": clases,
            "financiamientos": financiamiento,
            "sedes": sedes
        },
        type: "POST",
        //AGREGA ESTE TIPO DE RETORNO
        dataType: "json",
        error: function(xhr, textStatus, errorMessage) {
            // console.log("ERROR, debe seleccionar valores de todos los filtros\n" + errorMessage + textStatus + xhr);
        },
        success: function(datosRetornados) {
            // console.log(datosRetornados.fragmento1);
            mapa1(datosRetornados.result1, datosRetornados.result2, datosRetornados.result3, datosRetornados.ciclo, datosRetornados.clase);
            mapa2(datosRetornados.result4, datosRetornados.result5, datosRetornados.result6, datosRetornados.ciclo, datosRetornados.clase);
            mapaGeneral(datosRetornados.result7, datosRetornados.result8, datosRetornados.result9);
            graficBySex(datosRetornados.result10, datosRetornados.result11, datosRetornados.result12);
            principal(datosRetornados.result13, datosRetornados.result14, datosRetornados.result15);
        }
    });
};


// funcion para cargar mapa #1
function mapa1(result1, result2, result3, ciclo) {
    var data = [
        ['sv-ss', 'San Salvador'],

    ];
    // Create the chart
    Highcharts.mapChart('map1', {
        chart: {
            map: 'countries/sv/sv-all'
        },

        title: {
            text: 'Reporte San Salvador ',
            style: {
                color: '#be0032',
                fontWeight: 'bold'
            }
        },

        subtitle: {
            text: ''
        },
        // propiedad para hacer zoom
        // mapNavigation: {
        //     enabled: true,
        //     buttonOptions: {
        //         verticalAlign: 'bottom'
        //     }
        // },
        // ejemplo de como mostrar datos
        series: [{
                data: data,
                name: 'Cantidad de materias aprobadas: ' + result1 + ' ',
                states: {
                    hover: {
                        color: '#ffc107',
                        borderWidth: 1
                    }
                },
                dataLabels: {
                    enabled: true,
                    format: data.subtitle
                }
            }, {
                data: data,
                name: 'Cantidad de materias reprobadas: ' + result2 + ' ',
                states: {
                    hover: {
                        color: '#ffc107'
                    }
                },
                dataLabels: {
                    enabled: true,
                    format: data.subtitle
                }
            },
            {
                data: data,
                name: 'Cantidad de materias retiradas: ' + result3 + '',
                states: {
                    hover: {
                        color: '#ffc107'
                    }
                },
                dataLabels: {
                    enabled: true,
                    format: data.subtitle
                }
            }
        ],
        credits: {
            enabled: false
        },
    });
}
// result4 es la cantidad de materias aprobadas
// result5 es la cantidad de materias reprobadas
// result6 es la cantidad de materias reprobadas
// ciclo es el ciclo seleccionado
function mapa2(result4, result5, result6, ciclo) {
    var data = [
        ['sv-sa', 'Santa Ana'],

    ];
    // Create the chart
    Highcharts.mapChart('map2', {
        chart: {
            map: 'countries/sv/sv-all'
        },

        title: {
            text: 'Reporte Santa Ana',
            style: {
                color: '#be0032',
                fontWeight: 'bold'
            }
        },

        subtitle: {
            text: ''
        },
        series: [{
                data: data,
                name: 'Cantidad de materias aprobadas:  ' + result4 + ' ',
                states: {
                    hover: {
                        color: '#ffc107'
                    }
                },
                dataLabels: {
                    enabled: true,
                    format: data.subtitle
                }
            }, {
                data: data,
                name: 'Cantidad de materias reprobadas:  ' + result5 + ' ',
                states: {
                    hover: {
                        color: '#ffc107'
                    }
                },
                dataLabels: {
                    enabled: true,
                    format: data.subtitle
                }
            },
            {
                data: data,
                name: 'Cantidad de materias retiradas:  ' + result6 + ' ',
                states: {
                    hover: {
                        color: '#ffc107'
                    }
                },
                dataLabels: {
                    enabled: true,
                    format: data.subtitle
                }
            }
        ],
        credits: {
            enabled: false
        },
    });
}


function principal(aprobadas, reprobadas, retiradas) {
    total = parseInt(aprobadas) + parseInt(reprobadas) + parseInt(retiradas);

    // calcular porcentajes
    PorcentajeAprobados = (parseInt(aprobadas) * 100) / total;
    PorcentajeReprobados = (parseInt(reprobadas) * 100) / total;
    PorcentajeRetirados = (parseInt(retiradas) * 100) / total;

    Highcharts.chart('middle-pie', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: 'Grafica General',
            align: 'center',
            verticalAlign: 'middle',
            y: 80
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: true,
                    distance: 0,
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%', '75%'],
                size: '130%'
            }
        },
        series: [{
            type: 'pie',
            name: 'text',
            innerSize: '50%',
            data: [
                ['Aprobados', PorcentajeAprobados],
                ['Reprobados', PorcentajeReprobados],
                ['Retirados', PorcentajeRetirados],
            ]
        }],
        credits: {
            enabled: false
        },
        colors: ['#54E38A', '#FF8C64', '#FFF587', '#FF665A', '#9154E3']
    });
}

function MateriasPoruniversidad(datos) {
    let uni = [];
    let apro = [];
    let repro = [];
    let reti = [];
    let respv;
    datos.forEach(dato => {
        uni.push(dato.id);
        apro.push(parseInt(dato.aprobadas));
        repro.push(parseInt(dato.reprobadas));
        reti.push(parseInt(dato.retiradas));
    });

    respv = (5000 * uni.length) / 60;
    
    Highcharts.chart('Ugraph', {
        chart: {
            renderTo: 'container',
            type: 'column',
            scrollablePlotArea: {
                minWidth: respv,
                scrollPositionX: 1
            }
        },
        title: {
            text: 'Materias Aprobadas, reprobadas y retiradas por universidad'
        },
        xAxis: {
            title: {
                text: 'Grafica por Universidad'
            },
            tickInterval: 1,
            categories: uni,
        },
        yAxis: {
            title: {
                text: 'Grafica por Universidad'
            },
            tickInterval: 1
        },
        series: [{
            name: 'Materias Aprobadas',
            data: apro
        }, {
            name: 'Materias Reprobadas',
            data: repro
        }, {
            name: 'Materias Retiradas',
            data: reti
        }],
        credits: {
            enabled: false
        },
        colors: ['#54E38A', '#FF8C64', '#FFF587', '#FF665A', '#9154E3']
    });
}