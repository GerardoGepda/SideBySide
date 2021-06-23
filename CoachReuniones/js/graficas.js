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

function getstatus() {
    var selected = []
    for (var option of document.getElementById('status').options) {
        if (option.selected) {
            selected.push(option.value);
        }
    }
    listaStatus = selected;
}

function loadTemplete() {
    let templete = '';
    templete = `
        <div id="content3">
            <div id="content-middle-pie">
                <h4><span>G</span>rafica General</h4>
                <div id="middle-pie"></div>
            </div>

            <div id="cum1">
                <h4><span>C</span>um Global</h4>
                <div id="cumGeneral"></div>
            </div>
        </div>

        <div class="graficas">
        <div class="content">
            <div id="map1" class="loading"></div>
            <div id="map2" class="loading"></div>
        </div>

        <div class="content">
            <figure class="highcharts-figure">
                <div id="gen"></div>
            </figure>
            <figure class="highcharts-figure">
                <div id="gen2"></div>
            </figure>
        </div>

        <div class="content">
            <div id="cum"></div>
        </div>

    </div>

    <h3 class="materia">Estadística por materia</h3>
    <div class="graficas">
        <div id="Ugraph"></div>
        <div id="graphicTwo"></div>
        <div id="graphicThree"></div>
    </div>

    <h3 class="materia">Estadística por alumno</h3>
    <div class="graficas">
        <div id="one"></div>
        <div id="two"></div>
        <div id="three"></div>
    </div>
    `;

    document.getElementById('loader').innerHTML = templete;

    spinner = `
    <div class="spinner-border m-5" role="status" style="color: #B01D33">
        <span class="sr-only">Loading...</span>
    </div>
    `;

    document.getElementById("middle-pie").innerHTML = spinner
    document.getElementById("cumGeneral").innerHTML = `
    <div class="spinner-border m-1" role="status" style="color: #B01D33">
        <span class="sr-only">Loading...</span>
    </div>
    `;

    document.getElementById("Ugraph").innerHTML = spinner;
    document.getElementById("graphicTwo").innerHTML = spinner;
    document.getElementById("graphicThree").innerHTML = spinner;
    document.getElementById("one").innerHTML = spinner;
    document.getElementById("two").innerHTML = spinner;
    document.getElementById("three").innerHTML = spinner;
}
function graficBySex(aprobados, reprobados, retirados, cums) {
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
        subtitle: {
            text: 'CUM: ' + cums.cumF,
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
            showInLegend: false
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

// ************************ inicio de graficas generales *********************************
// La funcion mapaGeneral recibe 3 parametros que son la cantidad de materias aprobadas, reprobadas y retirdas
function mapaGeneral(aprobados, reprobados, retirados, cumM) {
    total = parseInt(aprobados) + parseInt(reprobados) + parseInt(retirados);

    // calcular porcentajes
    PorcentajeAprobados = (parseInt(aprobados) * 100) / total;
    PorcentajeReprobados = (parseInt(reprobados) * 100) / total;
    PorcentajeRetirados = (parseInt(retirados) * 100) / total;

    // maquetación de graficas
    Highcharts.chart('gen', {

        chart: {
            styledMode: false,
            height: (14 / 16 * 100) + '%' // 16:9 ratio
        },

        title: {
            text: 'Masculino',
            style: {
                color: '#be0032',
                fontWeight: 'bold'
            }
        },
        subtitle: {
            text: 'CUM: ' + cumM,
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
            showInLegend: false
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
        colors: ['#54E38A', '#FF8C64', '#FFF587', '#FF665A', '#9154E3'],
    });
}
/***************************fin de graficas generales */

// la funcion ShowSelected recibe como parametro ciclos,
// el el array ciclos se extrae de la funcion ciclos() que extrae los ciclos seleccionados
function ShowSelected(ciclos, clases, financiamiento, sedes, status) {
    $.ajax({
        url: '../CoachReuniones/Modelo/ModeloReportes/ModelUniversidad/cargarMap.php',
        data: {
            "ciclos": ciclos,
            "clases": clases,
            "financiamientos": financiamiento,
            "sedes": sedes,
            "status": status
        },
        type: "POST",
        //AGREGA ESTE TIPO DE RETORNO
        dataType: "json",
        error: function (xhr, textStatus, errorMessage) {
            // console.log("ERROR, debe seleccionar valores de todos los filtros\n" + errorMessage + textStatus + xhr);
        },
        success: function (datosRetornados) {
            // console.log(datosRetornados.fragmento1);
            const cums = {
                cumSSFT: parseFloat(datosRetornados.cumSSFT).toFixed(1),
                cumSAFT: parseFloat(datosRetornados.cumSAFT).toFixed(1),
                cumM: parseFloat(datosRetornados.cumM).toFixed(1),
                cumF: parseFloat(datosRetornados.cumF).toFixed(1)
            };
            loadTemplete();
            mapa1(datosRetornados.result1, datosRetornados.result2, datosRetornados.result3, cums.cumSSFT);
            mapa2(datosRetornados.result4, datosRetornados.result5, datosRetornados.result6, cums.cumSAFT);
            mapaGeneral(datosRetornados.result7, datosRetornados.result8, datosRetornados.result9, cums.cumM);
            graficBySex(datosRetornados.result10, datosRetornados.result11, datosRetornados.result12, cums);
            principal(datosRetornados.result13, datosRetornados.result14, datosRetornados.result15);
        }
    });
};


// funcion para cargar mapa #1
function mapa1(result1, result2, result3, cumSSFT) {
    var data = [
        ['sv-ss', 'San Salvador'],

    ];
    // Create the chart
    Highcharts.mapChart('map1', {
        chart: {
            map: 'countries/sv/sv-all',
            height: 195
        },


        title: {
            text: 'Reporte San Salvador FT ',
            style: {
                color: '#be0032',
                fontWeight: 'bold',
                fontSize: '10px'
            }
        },

        subtitle: {
            text: 'CUM: ' + cumSSFT,
        },
        series: [{
            data: data,
            name: 'Aprobadas: ' + result1 + ' ',
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
            name: 'Reprobadas: ' + result2 + ' ',
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
            name: 'Retiradas: ' + result3 + '',
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
function mapa2(result4, result5, result6, cumSAFT) {
    var data = [
        ['sv-sa', 'Santa Ana'],

    ];
    // Create the chart
    Highcharts.mapChart('map2', {
        chart: {
            map: 'countries/sv/sv-all',
            height: 195,
        },

        title: {
            text: 'Reporte Santa Ana FT',
            style: {
                color: '#be0032',
                fontWeight: 'bold',
                fontSize: '10px'
            }
        },

        subtitle: {
            text: 'CUM: ' + cumSAFT,
        },
        series: [{
            data: data,
            name: 'Aprobadas:  ' + result4 + ' ',
            states: {
                hover: {
                    color: '#ffc107'
                }
            },
            dataLabels: {
                enabled: true,
                format: data.subtitle,
            }
        }, {
            data: data,
            name: 'Reprobadas:  ' + result5 + ' ',
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
            name: 'Retiradas:  ' + result6 + ' ',
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

    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Aprobados: ' + parseInt(aprobadas), PorcentajeAprobados],
            ['Reprobados: ' + parseInt(reprobadas), PorcentajeReprobados],
            ['Retirados: ' + parseInt(retiradas), PorcentajeRetirados],
        ]);

        var options = {
            colors: ['#54E38A', '#FF8C64', '#FFF587', '#FF665A', '#9154E3'],
            backgroundColor: { fill: "#343A40" },
            titleTextStyle: {
                color: '#ffff'
            },
            legendTextStyle: { color: '#FFF' },
            titleTextStyle: { color: '#FFF' },
            hAxis: {
                textStyle: { color: '#FFF' }
            }
        };
        var chart = new google.visualization.PieChart(document.getElementById('middle-pie'));
        chart.draw(data, options);
    }
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

    respv = (300 * uni.length) / 60;
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
            text: 'Materias Aprobadas por universidad'
        },
        xAxis: {
            tickInterval: 1,
            categories: uni,
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                }
            }
        },
        series: [{
            name: 'Materias Aprobadas',
            data: apro
        }],
        credits: {
            enabled: false
        },
        colors: ['#54E38A']
    });


    Highcharts.chart('graphicTwo', {
        chart: {
            renderTo: 'container',
            type: 'column',
            scrollablePlotArea: {
                minWidth: respv,
                scrollPositionX: 1
            }
        },
        title: {
            text: 'Materias Reprobadas por universidad'
        },
        xAxis: {
            tickInterval: 1,
            categories: uni,
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                }
            }
        },
        series: [{
            name: 'Materias Reprobadas',
            data: repro
        }],
        credits: {
            enabled: false
        },
        colors: ['#FF8C64']
    });

    Highcharts.chart('graphicThree', {
        chart: {
            renderTo: 'container',
            type: 'column',
            scrollablePlotArea: {
                minWidth: respv,
                scrollPositionX: 1
            }
        },
        title: {
            text: 'Materias Retiradas por universidad'
        },
        xAxis: {
            tickInterval: 1,
            categories: uni,
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                }
            }
        },
        series: [{
            name: 'Materias Retiradas',
            data: reti
        }],
        credits: {
            enabled: false
        },
        colors: ['#FFF587']
    });
}