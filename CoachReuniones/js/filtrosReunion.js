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
            colors: ['#54E38A', '#FF8C64', '#F2B90C', '#FF665A', '#9154E3'],
            width: 500,
            height: 300
        };

        var chart = new google.visualization.PieChart(document.getElementById('main'));
        chart.draw(data, options);
    }
}

function checkFileExist(urlToFile) {
    try {
        var xhr = new XMLHttpRequest();
        xhr.open('HEAD', urlToFile, false);
        xhr.send();

        if (xhr.status == "404") {
            return false;
        } else {
            return true;
        }
    } catch (error) {

    }
}
function LlenarGraficaPorUniversidad(e, id) {
    google.charts.load("current", { packages: ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);
    let info = [
        ['Universidad', 'Asistieron', 'No Asistieron', 'No Inscribieron'],
    ]
    for (let i = 0; i < e.length; i++) {
        info.push([id[i].replace(/\s/g, "-"), parseInt(e[i].Asistieron.length), parseInt(e[i].Inasistieron.length), parseInt(e[i].No_inscritos.length)])
    }
    function drawChart() {
        var data = google.visualization.arrayToDataTable(info);
        var view = new google.visualization.DataView(data);
        var options = {
            title: "Resumen general de participación estudiantil por universidad",
            width: 525,
            height: 325,
            bar: { groupWidth: "95%" },
            legend: { position: "right" },
            colors: ['#54E38A', '#FF8C64', '#F2B90C', '#FF665A', '#9154E3'],
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("tabla"));
        chart.draw(view, options);
    }
}

function maquetar(alumnos, longitud) {
    // variables
    let template = "";
    let modals = "";
    let imagen = "";
    let table1 = "", table2 = "", table3 = "";
    let c1 = 1, c2 = 1, c3 = 1;
    let result;
    let asistieron = [], inasistieron = [], noInscritos = []

    for (let i = 0; i < longitud.length; i++) {
        asistieron.push(alumnos[i].Asistieron)
        inasistieron.push(alumnos[i].Inasistieron)
        noInscritos.push(alumnos[i].No_inscritos)
    }


    for (let index = 0; index < longitud.length; index++) {
        table1 = "", table2 = "", table3 = "";
        c1 = 1, c2 = 1, c3 = 1;
        for (const key in asistieron[index]) {
            result = checkFileExist('../img/imgUser/' + ((asistieron[index])[key]).imagen);
            if (result == true) {
                imagen = ((asistieron[index])[key]).imagen
            } else {
                imagen = "imgDefault.png"
            }
            table1 += `
                <tr>
                    <td>${c1++}</td>
                    <td><img src='../img/imgUser/${imagen}' class='alumnos' alt='Alumno' style='width:60px; height:60px; border-radius: 45px;'></td>
                    <td>${((asistieron[index])[key]).nombre}</td>
                </tr>`;
        }

        inasistieron[index].forEach(e => {
            result = checkFileExist('../img/imgUser/' + e.imagen);
            if (result == true) {
                imagen = e.imagen
            } else {
                imagen = "imgDefault.png"
            }
            table2 += `
                <tr>
                    <td>${c2++}</td>
                    <td><img src='../img/imgUser/${imagen}' class='alumnos' alt='Alumno' style='width:60px; height:60px; border-radius: 45px;'></td>
                    <td>${e.nombre}</td>
                </tr>`;
        });
        noInscritos[index].forEach(e => {
            result = checkFileExist('../img/imgUser/' + e.imagen);
            if (result == true) {
                imagen = e.imagen
            } else {
                imagen = "imgDefault.png"
            }
            table3 += `
                <tr>
                    <td>${c3++}</td>
                    <td><img src='../img/imgUser/${imagen}' class='alumnos' alt='Alumno' style='width:60px; height:60px; border-radius: 45px;'></td>
                    <td>${e.nombre}</td>
                </tr>`;
        });
        template += `
                    <div class="col-md-6 justify-content-center grapp">
                        <div id="${longitud[index].replace(/\s/g, "-")}" class="datos p-1 graficas"></div>
                        <div id="botones" class='btns'>
                            <small class="text-center short" >Alumnos</small>
                                <button type="button" data-toggle="modal" data-target=".bd-example-y-${longitud[index].replace(/\s/g, "-")}-modal-lg" id="y-${longitud[index].replace(/\s/g, "-")}" class="btn" style='background-color: #54E38A;'>
                                <i class="fa fa-clipboard-check"></i>
                                </button>

                                <button type="button" data-toggle="modal" data-target=".bd-example-n-${longitud[index].replace(/\s/g, "-")}-modal-lg" id="n-${longitud[index].replace(/\s/g, "-")}" class="btn" style='background-color: #FF8C64;'>
                                <i class="fa fa-clipboard-check"></i>
                                </button>

                                <button type="button" id="u-${longitud[index].replace(/\s/g, "-")}" data-toggle="modal" data-target=".bd-example-u-${longitud[index].replace(/\s/g, "-")}-modal-lg" class="btn" style='background-color: #F2B90C;'>
                                
                                <i class="fa fa-clipboard-check"></i>
                                </button>
                                <div id="botones" class='exporting'>
                                    <small class="text-center short" >Export</small>

                                            <button id="pdf" type="button" class="${longitud[index].replace(/\s/g, "-")} btn btn-danger"><i class="${longitud[index].replace(/\s/g, "-")} fas fa-file-pdf"></i></button>
                                            <button id="excel" type="button" class="${longitud[index].replace(/\s/g, "-")} btn btn-success btn-excel"><i class="${longitud[index].replace(/\s/g, "-")} fas fa-file-excel"></i></button>
                                    
                                        
                                </div>
                            </div>
                        </div>
                        `;
        modals += `
                    <div class="modal fade bd-example-y-${longitud[index].replace(/\s/g, "-")}-modal-lg modal-dialog-scrollable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Asistieron ${longitud[index].replace(/\s/g, "-")}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                  <table class="table text-center">
                                    <thead class="thead-dark table-bordered table-dark">
                                        <td>#</td>
                                        <td>Imagen</td>
                                        <td>Nombre</td>
                                    </thead>
                                    <tbody class="table-striped table-bordered table-hover">
                                    `+ table1 + `
                                    </tbody>                                  
                                  </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade bd-example-n-${longitud[index].replace(/\s/g, "-")}-modal-lg modal-dialog-scrollable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">No Asistieron ${longitud[index].replace(/\s/g, "-")}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <table class="table text-center">
                                    <thead class="thead-dark table-bordered table-dark">
                                        <td>#</td>
                                        <td>Imagen</td>
                                        <td>Nombre</td>
                                    </thead>
                                    <tbody class="table-striped table-hover table-bordered">
                                    `+ table2 + `
                                    </tbody>                                  
                                  </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="modal fade bd-example-u-${longitud[index].replace(/\s/g, "-")}-modal-lg modal-dialog-scrollable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">No Inscritos ${longitud[index].replace(/\s/g, "-")}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <table class="table text-center">
                                    <thead class="thead-dark table-bordered table-dark">
                                        <td>#</td>
                                        <td>Imagen</td>
                                        <td>Nombre</td>
                                    </thead>
                                    <tbody class="table-striped table-bordered table-hover">
                                    `+ table3 + `
                                    </tbody>                                  
                                  </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                    `;
    }
    document.getElementById("principal").innerHTML = template;
    document.getElementById("modals").innerHTML = modals;
    ExportExcel(alumnos);
}

function LlenarGraficaIndividual(data, universidad) {
    maquetar(data, universidad);

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
                        ignoreBounds: true,
                    },
                    legend: {
                        position: 'right',
                        alignment: 'center',
                    },
                    colors: ['#54E38A', '#FF8C64', '#F2B90C', '#FF665A', '#9154E3'],
                    width: 550,
                    height: 300,
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
        template += `<option class='dropdown-item' value="${e.ID_Reunion}">${e.Titulo}</option>`;
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
                    LlenarGraficaPorUniversidad(data, id)
                })
        } else {
            console.log("No hay valores suficientes");
        }
    } catch (error) {
        console.log(error);
    }
}



