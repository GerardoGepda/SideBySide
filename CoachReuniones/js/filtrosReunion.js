//inicio de declaración de variables
let tipo;
let ciclo;
let titulo;
let idreunion
// fin de declaración de variables

// grafica principal
function LlenarGrafica(asistieron, NoAsistieron, NoInscritos) {
    google.charts.load("current", { packages: ["corechart"] });
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Option', 'Value'],
            ['Asistieron: ' + asistieron, asistieron],
            ['No Asistieron: ' + NoAsistieron, NoAsistieron],
            ['No Inscritos: ' + NoInscritos, NoInscritos]
        ]);

        var options = {
            title: 'Resumen general de participación estudiantil',
            pieHole: 0.4,
            colors: ['#302044', '826290', '#be0032']
        };

        var chart = new google.visualization.PieChart(document.getElementById('main'));
        chart.draw(data, options);
    }
}

function maquetar(longitud) {
    let template = "";

    for (let index = 0; index < longitud.length; index++) {
        template += `
                    <div class="col-md-6 d-flex justify-content-center">
                        <div id="${longitud[index].replace(/\s/g, "-")}" class="graficas"></div>
                    </div>
                    `;
    }
    document.getElementById("principal").innerHTML = template;
}

function LlenarGraficaIndividual(data, universidad) {
    maquetar(universidad);

    for (let index = 0; index < universidad.length; index++) {
        google.charts.load('current');
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            var wrapper = new google.visualization.ChartWrapper({
                chartType: 'ColumnChart',
                dataTable: [
                    ['', 'Asistieron: ' + data[index].Asistieron.length, 'No Asistieron: ' + data[index].Inasistieron.length, 'No Inscritos: ' + data[index].No_inscritos.length],
                    ['', data[index].Asistieron.length, data[index].Inasistieron.length, data[index].No_inscritos.length]
                ],
                options: {
                    'title': universidad[index].replace(/\s/g, "-"),
                    tooltip: {
                        text: 'percentage',
                        showColorCode: true,
                        ignoreBounds: true
                    },
                    legend: {
                        position: 'right',
                        alignment: 'center',
                    },
                    colors: ['#302044', '826290', '#be0032']
                },
                containerId: universidad[index].replace(/\s/g, "-")
            });
            wrapper.draw();
        }
    }

}



// función para llenar los ciclos 
function llenarCiclos(ciclos) {
    let template = "";
    let option = `<option class='dropdown-item' disabled selected>Ciclo</option>`;
    ciclos.forEach(e => {
        template +=
            `<option class='dropdown-item'>${e.ID_Ciclo}</option>`;
    });
    document.getElementById("ciclo").innerHTML = "";
    document.getElementById("ciclo").innerHTML = option + template;
}
// función para llenar los nombres de reuniones
function llenarNombres(reuniones) {
    let template = "";
    let option = `<option class='dropdown-item' disabled selected>Nombre</option>`;
    reuniones.forEach(e => {
        template +=
            `<option class='dropdown-item' value="${e.ID_Reunion}">${e.Titulo}</option>`;
    });
    document.getElementById("nombre").innerHTML = "";
    document.getElementById("nombre").innerHTML = option + template;
}
// función para obtener los ciclos
function getciclos(tipo) {
    try {
        fetch(
            "Modelo/ModeloReportes/ModelReunion/getCiclos.php", {
            method: 'POST', // or 'PUT'
            body: JSON.stringify({ tipo: tipo }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(json => {
                llenarCiclos(json.tipo)
            })
    } catch (e) {
        console.log(e);
    }
}

function getNombre(ciclo) {
    try {
        fetch(
            "Modelo/ModeloReportes/ModelReunion/getTitulo.php", {
            method: 'POST', // or 'PUT'
            body: JSON.stringify({ ciclo: ciclo }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(json => {
                llenarNombres(json)
            })
    } catch (e) {
        console.log(e);
    }
}

function nombre() {
    ciclo = document.getElementById("ciclo").value;
    getNombre(ciclo);
}
function ciclos() {
    tipo = document.getElementById("class").value;
    getciclos(tipo);
}
// funcion principal
function procesar() {
    try {
        idreunion = document.getElementById("nombre").value;

        if (idreunion != "") {
            fetch(
                "Modelo/ModeloReportes/ModelReunion/procesar.php", {
                method: 'POST', // or 'PUT', 'GET'
                body: JSON.stringify({ idreunion: idreunion, tipo: tipo, ciclo: ciclo }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                //promise
                .then(response => response.json())
                .then(json => {
                    let contador1 = 0, contador2 = 0, contador3 = 0, id = []
                    let lista1 = [], lista2 = [], lista3 = [];
                    let data = [];
                    // listar asistieron
                    let asistieron = [], inasistieron = [], noInscritos = []
                    console.log(json);
                    for (let index = 1; index < json.length; index++) {
                        asistieron.push(json[index].Asistieron)
                        inasistieron.push(json[index].Inasistieron)
                        noInscritos.push(json[index].No_inscritos)
                        id.push(json[index].universidad)
                        data.push(json[index])
                    }
                    //inicio de calcular cuantos alumnos asistieron
                    for (let i = 0; i < asistieron.length; i++) {
                        for (let index = 0; index < asistieron[i].length; index++) {
                            contador1++;
                            lista1.push((asistieron[i])[index]);
                        }
                    }
                    // fin de calcular cuantos alumnos asistieron

                    // inicio de calcular cuantos alumnos no asistieron
                    for (let i = 0; i < inasistieron.length; i++) {
                        for (let index = 0; index < inasistieron[i].length; index++) {
                            contador2++;
                            lista2.push((inasistieron[i])[index]);
                        }
                    }
                    // fin de calcular cuantos alumnos no asistieron
                    for (let i = 0; i < noInscritos.length; i++) {
                        for (let index = 0; index < noInscritos[i].length; index++) {
                            contador3++;
                            lista3.push((noInscritos[i])[index]);
                        }
                    }
                    // inicio de calcular cuantos alumnos no se inscribieron

                    // fin de calcular cuantos alumnos no se inscribieron

                    LlenarGrafica(contador1, contador2, contador3)
                    LlenarGraficaIndividual(data, id)
                })
        } else {
            console.log("No hay valores suficientes");
        }
    } catch (error) {
        console.log(error);
    }
}



