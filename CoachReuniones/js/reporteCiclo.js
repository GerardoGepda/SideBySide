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

function CreateExcel(data) {
    const fecha = new Date();
    var wb = XLSX.utils.book_new();
    wb.Props = {
        Title: "Reporte Reunion Ciclo",
        Subject: "Reporte",
        Author: "Coach reuniones",
        CreateDate: new Date(fecha.toLocaleString()),
    }

    wb.SheetNames.push("informacion");
    var wsg = XLSX.utils.aoa_to_sheet(data);
    wb.Sheets["informacion"] = wsg;

    var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'binary' });
    saveAs(new Blob([CreateAnArrayBuffer(wbout)], { type: "application/octet-stream" }), "Reporte Reunion Ciclo.xlsx");
}

function CreateAnArrayBuffer(info) {
    var buff = new ArrayBuffer(info.length); //convert info to arrayBuffer
    var view = new Uint8Array(buff);  //create uint8array as viewer
    for (var i = 0; i < info.length; i++) view[i] = info.charCodeAt(i) & 0xFF; //convert to octet
    return buff;
}

function PrepareArrayExcel(json) {
    let result = [];
    let cont = 1;
    result.push(['#', 'Nombre', 'Correo', 'Universidad', 'Sede/Modalidad', 'Status', 'Class', 'Cantidad', 'Asistencias', 'Porcentaje', 'Fechas de asistencia']);

    for (const key in json) {
        result.push([cont++, json[key].nombre, json[key].correo,
        json[key].univeridad, json[key].ID_Sede, json[key].StatusActual,
        json[key].Class, json[key].cantidad, json[key].cantidad.substring(0, json[key].cantidad.indexOf('/')), 
        json[key].promedio, json[key].fechas]);
    }
    return result;
}

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

function ExportAllExcel(data) {
    //adding event listener for btnExoportAllExcel
    document.getElementById('btnExoportAllExcel').addEventListener('click', () => {
        const btnExoportAllExcel = document.getElementById('btnExoportAllExcel');
        btnExoportAllExcel.innerHTML = '<i class="fas fa-spinner rotated"></i> Cargando...';

        CreateExcel(PrepareArrayExcel(data));

        btnExoportAllExcel.innerHTML = '<i class="fas fa-file-excel"></i> Exportar registros';
    });
}

function ExportExcel(data, ids) {
    try {
        const btnexcel = document.querySelectorAll((".btn-excel"));
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
                        `<option value="${e.Class}">${e.Class}</option>`;
                });

                document.querySelector('.clases').innerHTML = "";
                document.querySelector('.clases').innerHTML = template;

                //inicializando selección multiple para las clases
                var multipleCancelButton = new Choices('#choices-multiple-remove-button-class', {
                    removeItemButton: true,
                    maxItemCount:8,
                    searchResultLimit:8,
                    renderChoiceLimit:8
                });
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
    let clases = $('.clases').val().map(x => "'".concat(x, "'")).join(",");
    let sedes = $('.sedes').val().map(x => "'".concat(x, "'")).join(",");
    let financiamientos = $('.financiamientos').val().map(x => "'".concat(x, "'")).join(",");
    // 
    GetAllData(ciclo, clases, sedes, financiamientos);
}

function MainGraphic(ciclo, data) {
    google.charts.load("current", { packages: ["corechart"] });
    google.charts.setOnLoadCallback(drawChart);

    let claves = [], finalData = [];

    for (let index = 0; index < data.length; index++) {
        for (const i in data[index]) {
            //se verifica si esta incluido, para solo añadirlo una vez
            if (!claves.includes(i)) {
                claves.push(i);
            }
        }
    }
    
    //recorremos la claves en el array nombre (porcentajes)
    claves.forEach((element, indx) => {
        finalData.push(['', 0]);

        for (let index = 0; index < data.length; index++) {
            if (data[index].hasOwnProperty(element)) {
                finalData[indx][1] += parseInt(data[index][element]);
            } 
        }

        finalData[indx][0] = element.concat("%: ", finalData[indx][1])
    });

    finalData.unshift(['Porcentaje', 'Cantidad']);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(finalData);

        var options = {
            title: 'Resumen general de participación estudiantil ciclo ' + ciclo,
            pieHole: 0.4,
            colors: ['#be0032', '#343a40', '#adadb2', '#FF665A', '#9154E3'],
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

function mostrarpanel(e) {
    e.target.parentNode.parentNode.classList.toggle("mostrarpanel");
    e.target.innerHTML = (e.target.textContent == "Ver detalles") ? "Ocultar detalles" : "Ver detalles";
}

function maquetarModal(longitud, alumnos) {
    let template = '';
    let table = '';
    let modals = '';

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
            if (e.nombre !== undefined || e.nombre !== null) {
                table += `
                <div class='contenidoAlumno' id = 'contenidoAlumno' >
                    <div class='contenido-informacion'>
                        <img src='../img/imgUser/${imagen}' alt='Imagen del alumno'
                            class='img-responsive'>
                        <h2 class ='title-name'>
                        ${e.nombre}
                        <span style='font-size:1.2rem'><strong>Class: </strong>${e.Class} </span>
                        </h2>
                        <button class ='btn btn-link btn-detalles' id='btn-detalles' onclick='mostrarpanel(event)'>Ver detalles</button>
                        <div class ='informacionAlumno'>
                        <ul>
                            <li><strong>Cantidad: </strong> ${e.cantidad}</li>
                            <li><strong>Promedio: </strong> ${e.promedio}</li>
                        </ul>
                        </div>
                    </div>
                </div >     
                `;
            }else {
                table += `
                <tr>
                    <td colspan="5">No hay datos</td>
                </tr>`;
            }
        });

        if (alumnos[index].length === 0) {
            table += `
            <tr>
                <td colspan="5">No hay datos</td>
            </tr>`;
        }

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
                          `+ table + `
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
    ExportExcel(alumnos, longitud);
    ExportAllExcel(alumnos.flat());
    //mostrando boton para exportar todo a excel
    document.getElementById('btnExoportAllExcel').classList.remove('d-none');
}

function graficaByU(e, universidad) {
    google.charts.load("current", { 'packages': ['bar'] });
    google.charts.setOnLoadCallback(drawChart);
    //variables
    let nombre = [], finalData = [];

    //ciclo for que me extrae las claves de los objetos que son los porcentajes de asistencias
    //esto se guarda en el array nombre
    for (let index = 0; index < universidad.length; index++) {
        for (const i in e[index]) {
            //se verifica si esta incluido, para solo añadirlo una vez
            if (!nombre.includes(i)) {
                nombre.push(i);
            }
        }
    }

    //recorremos las universidades y al mismo tiempo los datos en la variable "e"
    for (let index = 0; index < universidad.length; index++) {
        let tmp = []; //array temporal
        tmp.push(universidad[index].universidad); //se añade primero la universidad

        //recorremos la claves en el array nombre (porcentajes)
        nombre.forEach(element => {
            //accedemos a los datos en "e" por cada universidad y verificamos is este objeto
            //contiene la clave (porcentaje) element en sus propiedades, de ser así se añade su valor
            //al array tmp, si no contiene ese propiedad se añade cero (0)
            if (e[index].hasOwnProperty(element)) {
                tmp.push(e[index][element]);
            } else {
                tmp.push(0);
            }
        });

        //se agrega el array tmp al array finalData que contendra los datos finales
        finalData.push(tmp);
    }

    //en el array nombre con las claves de porcentajes le añadimos la palabra "porcentaje" al inicio
    nombre.unshift('porcentaje');
    //añadimos el array nombre al inicio del array finalData
    finalData.unshift(nombre);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(finalData);
        var options = {
            title: "Resumen general de participación estudiantil por universidad",
            legend: { position: "right" },
            colors: ['#be0032', '#343a40', '#adadb2', '#FF665A', '#9154E3'],
        };
        var chart = new google.charts.Bar(document.getElementById("tabla"));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
}

function graficaIndividual(data, universidad) {
    for (let index = 0; index < universidad.length; index++) {
        let nombre = ['',], valor = ['',];
        if (Object.values(data[index]).length > 0) {
            for (const i in data[index]) {
                nombre.push(i);
                valor.push((data[index])[i]);
            }
        }else {
            nombre.push('0');
            valor.push(0);
        }

        google.charts.load('current');
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            var wrapper = new google.visualization.ChartWrapper({
                chartType: 'ColumnChart',
                dataTable: [
                    nombre,
                    valor
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
                    colors: ['#be0032', '#343a40', '#adadb2', '#FF665A', '#9154E3'],
                    width: 550,
                    height: 300,
                },
                containerId: (universidad[index])['universidad'].replace(/\s/g, "-")
            });
            wrapper.draw();
        }
    }
}


function GetAllData(ciclo, clases, sedes, financiamientos) {
    let modificarArray = [];
    fetch(
        "Modelo/ModeloReportes/ModelCiclo/getPrincipalData.php", {
        method: 'POST', // or 'PUT'
        body: JSON.stringify({ ciclo: ciclo, clases: clases , sedes: sedes, financiamientos: financiamientos}),
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
            MainGraphic(ciclo, modificarArray);
            maquetarModal(json.data, json.alumnos);
            graficaIndividual(modificarArray, json.data);
            graficaByU(modificarArray, json.data);
        });
}