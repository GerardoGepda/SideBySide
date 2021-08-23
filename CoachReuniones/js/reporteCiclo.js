window.jsPDF = window.jspdf.jsPDF;

let dataPDF = {
    columns: [{
        No: "No.",
        nombre: "Alumno",
        correo: "Correo",
        u: 'Universidad',
        sede: 'Sede/Modalidad',
        estadoB: 'Estado Beca',
        class: 'Class',
        cantidad: 'Cantidad',
        porcentaje: "Porcentaje"
    }],
    rows: []
};


function ExportarPDF(data, ids) {
    try {
        const btnexcel = document.querySelectorAll((".btn-pdf"));
        btnexcel.forEach(btn => btn.addEventListener("click", (e) => {
            const idU = e.target.classList[0].replace("-", " ");

            for (let key = 0; key < ids.length; key++) {
                if (idU === (ids[key])['universidad']) {
                    MakePDf(PrepareArrayPdf(data[key]));
                    break;
                }
            }
        }));
    } catch (error) {
        console.log(error);
    }

}
function ExportExcel(data, ids) {
    try {
        const btnexcel = document.querySelectorAll((".btn-pdf"));
        btnexcel.forEach(btn => btn.addEventListener("click", (e) => {
            const idU = e.target.classList[0].replace("-", " ");

            for (let key = 0; key < ids.length; key++) {
                if (idU === (ids[key])['universidad']) {
                    CreateExcel(PrepareArrayExcel(data[key]));
                    break;
                }
            }
        }));
    } catch (error) {
        console.log(error);
    }

}


function PrepareArrayPdf(json) {
    let cont = 1;
    dataPDF.rows = [];
    for (const key in json) {
        dataPDF.rows.push([cont++, json[key].nombre, json[key].correo,
        json[key].univeridad, json[key].ID_Sede, json[key].StatusActual,
        json[key].Class, json[key].cantidad, json[key].promedio]);
    }
    return dataPDF;
}

function MakePDf(data) {
    var pdfdoc = new jsPDF({
        unit: "pt",
        orientation: "landscape"
    });

    pdfdoc.setFontSize(12);
    pdfdoc.setTextColor(0);
    pdfdoc.text("Reporte Reuniones", 40, 40);

    //creando la tabla
    pdfdoc.autoTable({
        head: data.columns,
        body: data.rows,
        theme: 'grid',
        headStyles: {
            fillColor: [157, 18, 14],
        },
        margin: { top: 60 },
    });

    pdfdoc.save("Reporte Reuniones.pdf");
}

function getciclos() {
    let temp = "";
    let op = `<option class='dropdown-item' disabled selected>Ciclo</option>`;
    try {
        fetch(
            "Modelo/ModeloReportes/ModelCiclo/getciclo.php", {
            method: 'POST', // or 'PUT'
            body: {},
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(json => {
                json.ciclo.forEach(e => {
                    temp += `<option class='dropdown-item'>${e.ciclo}</option>`;
                });

                document.getElementById("ciclo").innerHTML = "";
                document.getElementById("ciclo").innerHTML = op + temp;
            })
    } catch (e) {
        console.log(e);
    }
}

function getclass() {
    let template = "";
    let option = `<option class='dropdown-item' disabled selected>Class</option>`;
    try {
        fetch(
            "Modelo/ModeloReportes/ModelCiclo/getclase.php", {
            method: 'POST', // or 'PUT'
            body: {},
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(json => {
                json.clase.forEach(e => {
                    template +=
                        `<option class='dropdown-item'>${e.Class}</option>`;
                });

                document.getElementById("clase").innerHTML = "";
                document.getElementById("clase").innerHTML = option + template;
            })
    } catch (e) {
        console.log(e);
    }
}

$(document).ready(function () {
    getclass();
    getciclos();
});

function onlyUnique(value, index, self) {
    if (self.indexOf(value) === index) {
        return self.indexOf(value) === index
    } else {
        return 0;
    }
}


function procesar() {
    let ciclo = document.getElementById("ciclo").value;
    let clase = document.getElementById("clase").value
    MainGraphic(ciclo);
    // 
    GetAllData(ciclo, clase);
}

function MainGraphic(ciclo) {
    google.charts.load("current", { packages: ["corechart"] });
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Option', 'Value'],
            ['Completo: ' + 70.2, 70.2],
            ['Incompleto: ' + 29.8, 29.2],
        ]);

        var options = {
            title: 'Resumen general de participación estudiantil ciclo ' + ciclo,
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
        console.log(error);
    }
}


function maquetarModal(longitud, alumnos) {
    template = '';
    table = '';

    for (let index = 0; index < longitud.length; index++) {
        table = "";
        c = 1;
        alumnos[index].forEach(e => {
            result = checkFileExist('../img/imgUser/' + e.imagen);
            if (result == true) {
                imagen = e.imagen
            } else {
                imagen = "imgDefault.png"
            }
            table += `
            <tr>
                <td>${c++}</td>
                <td><img src='../img/imgUser/${imagen}' class='alumnos' alt='Alumno' style='width:60px; height:60px; border-radius: 45px;'></td>
                <td>${e.nombre}</td>
                <td>${e.cantidad}</td>
                <td>${e.promedio}</td>
            </tr>`;
        });
        template += `
        <div class="col-md-6 justify-content-center grapp">
            <div id="${(longitud[index])['universidad'].replace(/\s/g, "-")}" class="datos p-1 graficas"></div>
            <div id="botones" class='btns'>
                <small class="text-center short" >Alumnos</small>
                    <button type="button" data-toggle="modal" data-target=".bd-example-y-${(longitud[index])['universidad'].replace(/\s/g, "-")}-modal-lg" id="y-${(longitud[index])['universidad'].replace(/\s/g, "-")}" class="btn" style='background-color: #54E38A;'><i class="fa fa-clipboard-check"></i></button>
                    <div id="botones" class='exporting'>
                        <small class="text-center short" >Export</small>
                        <button id="pdf" type="button" class="${(longitud[index])['universidad'].replace(/\s/g, "-")} btn btn-danger btn-pdf"><i class="${(longitud[index])['universidad'].replace(/\s/g, "-")} fas fa-file-pdf"></i></button>
                        <button id="excel" type="button" class="${(longitud[index])['universidad'].replace(/\s/g, "-")} btn btn-success btn-excel"><i class="${(longitud[index])['universidad'].replace(/\s/g, "-")} fas fa-file-excel"></i></button>
                    </div>
                </div>
            </div>`;
        modals += `
            <div class="modal fade bd-example-y-${(longitud[index])['universidad'].replace(/\s/g, "-")}-modal-lg modal-dialog-scrollable" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Participación universidad ${(longitud[index])['universidad'].replace(/\s/g, "-")}</h5>
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
                                <td>Cantidad</td>
                                <td>Promedio</td>
                            </thead>
                            <tbody class="table-striped table-bordered table-hover">
                            `+ table + `
                            </tbody>                                  
                          </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>`;
    }

    document.getElementById("principal").innerHTML = template;
    document.getElementById("modals").innerHTML = modals;


    ExportarPDF(alumnos, longitud);

}

function graficaByU(e, universidad) {
    google.charts.load("current", { packages: ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);
    let nombre = ['Universidad',], valor = [], agrupar = [], longitud = [];

    for (let index = 0; index < universidad.length; index++) {
        valor = [];
        lenghtData = 0;
        for (const i in e[index]) {
            nombre.push([i]);
            lenghtData += 1;
            valor.push((e[index])[i]);
        }
        agrupar.push(valor);
        longitud.push(lenghtData);
    }
    //obtener valores unicos
    let unique = nombre.filter(onlyUnique)
    let info = [
        unique,
    ]
    for (let i = 0; i < e.length; i++) {
        info.push([(universidad[i])['universidad'].replace(/\s/g, "-"),
        parseInt(5),
        parseInt(7),
        parseInt(2)]);
    }

    for (let index = 0; index < array.length; index++) {
        const element = array[index];

    }

    info.push(['ITCA-SS', 0, 5, 0]);
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

function graficaIndividual(data, universidad) {
    for (let index = 0; index < universidad.length; index++) {
        let nombre = ['',], valor = ['',];

        for (const i in data[index]) {
            nombre.push(i);
            valor.push((data[index])[i]);
        }

        google.charts.load('current');
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            var wrapper = new google.visualization.ChartWrapper({
                chartType: 'ColumnChart',
                dataTable: [
                    nombre.sort(),
                    valor.sort()
                ],
                options: {
                    'title': (universidad[index])['universidad'].replace(/\s/g, "-"),
                    tooltip: {
                        text: 'percentage',
                        showColorCode: true,
                        ignoreBounds: true,
                    },
                    legend: {
                        position: 'right',
                        alignment: 'center',
                    },
                    colors: ['#FF8C64', '#54E38A', '#F2B90C', '#FF665A', '#9154E3'],
                    width: 550,
                    height: 300,
                },
                containerId: (universidad[index])['universidad'].replace(/\s/g, "-")
            });
            wrapper.draw();
        }
    }
}


function GetAllData(ciclo, clase) {
    let modificarArray = [];
    fetch(
        "Modelo/ModeloReportes/ModelCiclo/getPrincipalData.php", {
        method: 'POST', // or 'PUT'
        body: JSON.stringify({ ciclo: ciclo, clase: clase }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.json())
        .then(json => {
            for (const key in json.alumnos) {
                const arr = json.alumnos[key]
                const countUnique = arr => {
                    const counts = {};
                    for (var i = 0; i < arr.length; i++) {
                        counts[(arr[i])['promedio']] = 1 + (counts[(arr[i])['promedio']] || 0);
                    };
                    return counts;
                };
                modificarArray.push(countUnique(arr));
            }
            maquetarModal(json.data, json.alumnos);
            graficaIndividual(modificarArray, json.data);
            // graficaByU(modificarArray, json.data);
        });
}