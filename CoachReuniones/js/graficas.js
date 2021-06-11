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


function EstadosBecas(listaCiclos, listaClases, finan, sede) {
    let templete = '';
    let alumnos = [];
    let table = [];
    let contador = 1;
    fetch(
        "../CoachReuniones/Modelo/ModeloReportes/ModelUniversidad/estadosBecas.php", {
        method: 'POST',
        body: JSON.stringify({ ciclos: listaCiclos, clases: listaClases, finan: finan, sedes: sede }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.json())
        .then(json => {

            alumnos = json.alumnos;
            for (const e of alumnos) {
                table += `<tr>
                                <td>${contador++}</td>
                                <td><img src='../img/imgUser/${e.img}' alt='Alumno' style='width:60px; height:60px; border-radius: 45px;'></td>
                                <td>${e.nombre}</td>
                                <td>${e.carrera}</td>
                                <td>${e.universidad}</td>
                                <td>${e.estatus}</td>
                                <td>${e.fecha}</td>
                                <td>${e.ciclo}</td>
                            </tr>`;
            }

            templete = `
            <div class="graficas p-3">
                <button type="button" class="btn btn-danger w-50 " data-toggle="modal" data-target=".bd-example-modal-lg">
                Becas Declinadas/Cancelada </button>

            </div> 
        
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Becas Declinadas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
              </div>
              <div class="modal-body">
              <table class='table table-striped' id="becas" >
                <thead class="thead-dark">
                    <th>No.</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Carrera</th>
                    <th>Universidad</th>
                    <th>Status</th>
                    <th>Fecha</th>
                    <th>Ciclo</th>
                </thead>
                <tbody class='table-bordered table-hover'>
                    ${table}
                </tbody>
          </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
            
                </div>
            </div>
            </div>
      
            `;
            document.getElementById('becas').innerHTML = templete;

        })
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
            mapa1(datosRetornados.result1, datosRetornados.result2, datosRetornados.result3, datosRetornados.ciclo, datosRetornados.clase, cums.cumSSFT);
            mapa2(datosRetornados.result4, datosRetornados.result5, datosRetornados.result6, datosRetornados.ciclo, datosRetornados.clase, cums.cumSAFT);
            mapaGeneral(datosRetornados.result7, datosRetornados.result8, datosRetornados.result9, cums.cumM);
            graficBySex(datosRetornados.result10, datosRetornados.result11, datosRetornados.result12, cums);
            principal(datosRetornados.result13, datosRetornados.result14, datosRetornados.result15);
        }
    });
};


// funcion para cargar mapa #1
function mapa1(result1, result2, result3, ciclo, clase, cumSSFT) {
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
function mapa2(result4, result5, result6, ciclo, clase, cumSAFT) {
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