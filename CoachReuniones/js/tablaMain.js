//codigo ajax que obtiene los datos de la BD
let contador = 1;
let contador2 = 1;

//función que extrae los datos para las graficas de barra de Aprovados, reprobados, etc. por Universidad
function GetDataGraphBarU(ciclos, clases, financiamiento, sedes, grafico, status) {
    let datos;
    $.ajax({
        type: "POST",
        url: "../CoachReuniones/Modelo/ModeloReportes/ModelUniversidad/GraphBarUniversidad.php",
        data: {
            "ciclos": ciclos,
            "clases": clases,
            "financiamientos": financiamiento,
            "sedes": sedes,
            "status": status
        },
        success: function (response) {
            try {
                datos = JSON.parse(response);
                grafico(datos);
            } catch (error) {
                console.log("Error al momento de parseo de datos" + "\n" + error);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log("some error in ajax" + "\n" + XMLHttpRequest + "\n" + textStatus + "\n" + errorThrown);
        }
    });
}


function CreateModals(e, universidad, l1, l2, l3) {
    let template = '';
    let contador1 = 4, contador2 = 4, contador3 = 4;
    data1 = [], data2 = [], data3 = [];
    // resultados de listas extendidas (aprobados,reprodados y retirados)
    let final = [], final2 = [], final3 = [];
    let f1 = [], f2 = [], f3 = [];
    lista1 = [], lista2 = [], lista3 = [], text1 = [], text2 = [], text3 = [];

    // lista DISTINCT aprobados
    for (let index = 0; index < l1.length; index++) {
        photo = [];
        nombre = [];
        totalMaterias = [];
        media = [];
        text1 = l1[index];
        c = [];
        text1.forEach(e => {
            nombre.push(e.alumno);
            photo.push(e.imagen);
            totalMaterias.push(e.total);
            media.push(parseFloat(e.promedio).toFixed(1));
            c.push(e.correo);
        });
        f1.push(text1);
    }
    // lista DISTINCT reprobados
    for (let index = 0; index < l2.length; index++) {
        photo = [];
        nombre = [];
        totalMaterias = [];
        media = [];
        text2 = l2[index];
        c = [];

        text2.forEach(e => {
            nombre.push(e.alumno);
            photo.push(e.imagen);
            totalMaterias.push(e.total);
            media.push(parseFloat(e.promedio).toFixed(1));
            c.push(e.correo);
        });
        f2.push(text2);
    }
    for (let index = 0; index < l3.length; index++) {
        photo = [];
        nombre = [];
        totalMaterias = [];
        media = [];
        text3 = l3[index];
        c = [];
        text3.forEach(e => {
            nombre.push(e.alumno);
            photo.push(e.imagen);
            totalMaterias.push(e.total);
            media.push(parseFloat(e.promedio).toFixed(1));
            c.push(e.correo);
        });
        f3.push(text3);
    }

    for (let index = 0; index < e; index++) {
        let table1 = '';
        let table2 = '';
        let table3 = '';
        let c1 = 1;
        let c2 = 1;
        let c3 = 1;

        for (const dato of f1[index]) {
            table1 += templatePanel(dato, universidad[index]);
        }

        for (const dato of f2[index]) {
            table2 += templatePanel(dato, universidad[index]);
        }

        for (const dato of f3[index]) {
            table3 += templatePanel(dato, universidad[index]);
        }


        template += modalForStudentInfo(`aprobados-${contador1++}`, universidad[index], table1);
        template += modalForStudentInfo(`reprobadas-${contador2++}`, universidad[index], table2);
        template += modalForStudentInfo(`retiradas-${contador3++}`, universidad[index], table3);

        document.getElementById('showData').innerHTML = template;
    }
}

function CreatDivs(e, ids) {
    let templete = '';
    let contador = 4;
    let cont1 = 4;
    let cont2 = 4;
    let cont3 = 4;
    for (let index = 0; index < e; index++) {
        templete += `
                    <div class='uni-content my-1 ${ids[index].replace(/\s/g, "-")}' style = 'height: 285px; position:relative; z-index:1;' >
                <div id='u-${contador++}' style='height: 220px;'></div>
                <div style='height: 60px; margin: 0px auto;'>
                    <center>
                        <button type="button" class="btn" data-toggle="modal" data-target="#aprobados-${cont1++}" style='background-color: #54E38A;'>Aprobadas</button>
                        <button type="button" class="btn" data-toggle="modal" data-target="#reprobadas-${cont2++}" style='background-color: #FF8C64;'>Reprobadas</button>
                        <button type="button" class="btn" data-toggle="modal" data-target="#retiradas-${cont3++}" style='background-color: #FFF587;'>Retiradas</button>
                    </center>
                </div>
                <div class='exporting'>
                    <button class='${ids[index].replace(/\s/g, "-")} btn btn-danger d-block p-3 btnexpPdf'><i class="fas fa-file-pdf"></i></button>
                <br/>
                    <button class=' ${ids[index].replace(/\s/g, "-")} btn btn-success d-block p-3 btnexpExcel'><i class="fas fa-file-excel"></i></button>
                </div>
            </div>
                `;
    }
    document.getElementById('universidades').innerHTML = templete;
}

function CumGeneral(cum) {
    let template = '';
    template = ` <div class='text-white details' id = 'cum2' >
                <div>
                    <h5 >` + cum + `</h5>
                    <br><br>
                    </div>
                </div>
            `;

    document.getElementById('cumGeneral').innerHTML = template;
}

function GraficaCUM(id, cums) {

    let a = [];
    let b = [];

    cums.forEach(e => {
        a.push(parseFloat(e.cum));
    });
    respv = (300 * id.length) / 60;

    Highcharts.chart('cum', {
        chart: {
            renderTo: 'container',
            type: 'column',
            height: 195,
            scrollablePlotArea: {
                minWidth: respv,
                scrollPositionX: 1
            }
        },
        title: {
            text: 'CUM por Universidad'
        },
        xAxis: {
            tickInterval: 1,
            categories: id,
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    pointFormat: '<b>{point.y:.2f}</b>',
                }
            }
        },
        series: [{
            name: 'CUM por Universidad',
            data: a,
            y: a,
        }],
        credits: {
            enabled: false
        },
        colors: ['#54E38A']
    });

}

function graficasByAlumno(n1, n2, n3, universidades) {

    let Aaprobados = [];
    let Areprobados = [];
    let Aretirados = [];

    n1.forEach(e => {
        Aaprobados.push(parseInt(e.alumno));
    });
    n2.forEach(e => {
        Areprobados.push(parseInt(e.alumno));
    });
    n3.forEach(e => {
        Aretirados.push(parseInt(e.alumno));
    });

    respv = (300 * universidades.length) / 60;

    Highcharts.chart('one', {
        chart: {
            renderTo: 'container',
            type: 'column',
            scrollablePlotArea: {
                minWidth: respv,
                scrollPositionX: 1
            }
        },
        title: {
            text: 'Alumnos aprobados por universidad'
        },
        xAxis: {
            tickInterval: 1,
            categories: universidades,
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                }
            }
        },
        series: [{
            name: 'Cantidad de alumnos que han aprobado materias',
            data: Aaprobados
        }],
        credits: {
            enabled: false
        },
        colors: ['#54E38A']
    });

    Highcharts.chart('two', {
        chart: {
            renderTo: 'container',
            type: 'column',
            scrollablePlotArea: {
                minWidth: respv,
                scrollPositionX: 1
            }
        },
        title: {
            text: 'Alumnos reprobados por universidad'
        },
        xAxis: {
            tickInterval: 1,
            categories: universidades,
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                }
            }
        },
        series: [{
            name: 'Cantidad de alumnos que han reprobado materias',
            data: Areprobados
        }],
        credits: {
            enabled: false
        },
        colors: ['#FF8C64']
    });

    Highcharts.chart('three', {
        chart: {
            renderTo: 'container',
            type: 'column',
            scrollablePlotArea: {
                minWidth: respv,
                scrollPositionX: 1
            }
        },
        title: {
            text: 'Alumnos retirados por universidad'
        },
        xAxis: {
            tickInterval: 1,
            categories: universidades,
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                }
            }
        },
        series: [{
            name: 'Cantidad de alumnos que han retirado materias',
            data: Aretirados
        }],
        credits: {
            enabled: false
        },
        colors: ['#FFF587']
    });
}


// proceso de llenado graficas
function loadUniversity(datos) {
    // inicio de declaración de variables
    let nombres = [];
    let ids = [];
    let aprobadas = [];
    let reprobadas = [];
    let retiradas = [];



    let listaAprobados = [];
    let listaReprobados = [];
    let listaRetirados = [];

    let lista1 = [];
    let lista2 = [];
    let lista3 = [];

    total1 = 0;
    total2 = 0;
    total3 = 0;

    let cum = [];

    // cum global 
    let cumGlobal = 0;


    let one = [];
    let two = [];
    let three = [];

    // fin de declaración de arreglos
    //------------------------------------------------ 
    // recorrer datos
    datos.forEach(dato => {
        ids.push(dato.id);
        nombres.push(dato.name);
        aprobadas.push(parseInt(dato.aprobadas));
        reprobadas.push(parseInt(dato.reprobadas));
        retiradas.push(parseInt(dato.retiradas));
        listaAprobados.push(dato.listaAprobado);
        listaReprobados.push(dato.listaReprobado);
        listaRetirados.push(dato.listaRetirado);
        lista1.push(dato.l1);
        lista2.push(dato.l2);
        lista3.push(dato.l3);
        cum.push(dato.globalInfo);
        one.push(dato.alumnosAprobados);
        two.push(dato.alumnosReprobados);
        three.push(dato.alumnosRetirados);
    });
    cum.forEach(e => {
        cumGlobal += parseFloat(e.cum);
    });

    cumGlobal = cumGlobal / cum.length;

    graficasByAlumno(one, two, three, ids);
    GraficaCUM(ids, cum);


    // calcular cum global
    const reducer = (accumulator, currentValue) => accumulator + currentValue;

    CreateModals(nombres.length, nombres, lista1, lista2, lista3);
    CreatDivs(nombres.length, ids);
    CumGeneral(cumGlobal.toFixed(1));


    aprobadas.forEach(function (numero) {
        total1 += numero;
    });
    reprobadas.forEach(function (numero) {
        total2 += numero;
    });
    retiradas.forEach(function (numero) {
        total2 += numero;
    });

    // total = total1 + total2 + total3;

    // contadores
    cont1 = 0;
    cont2 = 0;
    cont3 = 0;

    cont4 = 0;
    cont5 = 0;
    cont6 = 0;

    let contador = 4;
    let show = [];


    cum.forEach(e => {
        console.log(e);
        show.push(parseFloat(e.cum).toFixed(2));
    });
    // este for sirve para cargar las graficas de todas las universidades
    for (let index = 0; index < nombres.length; index++) {

        Highcharts.chart('u-' + (contador++) + '', {
            chart: {
                styledMode: false,
            },
            title: {
                text: nombres[index]
            },
            subtitle: {
                text: '* CUM: ' + show[index],
                align: 'right',
                x: -10
            },
            xAxis: {
                categories: ['Universidad', 'Aprobados', 'Reprobados', 'Retirados']
            },
            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data: [
                    ['Aprobadas: ' + aprobadas[cont1++] + '', ((aprobadas[cont4++] * 100) / total), true],
                    ['Reprobadas: ' + reprobadas[cont2++] + '', ((reprobadas[cont5++] * 100) / total), true],
                    ['Retiradas: ' + retiradas[cont3++] + '', ((retiradas[cont6++] * 100) / total), true]
                ],
                showInLegend: true,
            }],
            credits: {
                enabled: false
            },
            colors: ['#54E38A', '#FF8C64', '#FFF587', '#FF665A', '#9154E3']
        });
    }

    ExportarPDF(datos);
    ExportarEXCEL(datos);
}


//codigo ajax que obtiene los datos de la BD

function graphicsByUniversity(ciclos, clases, financiamiento, sedes, status) {
    let datos;
    spinner = document.getElementById("universidades")
    spinner.innerHTML = `
                <div class="d-flex justify-content-center" >
                    <div class="spinner-border " style="color: #B01D33" role="status">
                        <span class="sr-only" >Loading...</span>
                    </div>
                </div>
                `;

    $.ajax({
        type: "POST",
        url: "../CoachReuniones/Modelo/ModeloReportes/ModelUniversidad/GraphBarUniversidad.php",
        data: {
            "ciclos": ciclos,
            "clases": clases,
            "financiamientos": financiamiento,
            "sedes": sedes,
            "status": status
        },
        success: function (response) {
            try {
                spinner.innerHTML = "";

                datos = JSON.parse(response);
                loadUniversity(datos);

                const op = document.createElement('option');
                op.innerHTML = "Mostrar Todas";
                op.value = "all";

                const filtroU = document.querySelector('#searchUGraph');
                $('#searchUGraph').empty();
                filtroU.appendChild(op);
                datos.forEach(dato => {
                    var opt = document.createElement('option');
                    opt.innerHTML = dato.id.replace(/\s/g, "-");
                    opt.value = dato.id.replace(/\s/g, "-");;
                    filtroU.appendChild(opt);
                });
            } catch (error) {
                console.log("Error al momento de parseo de datos" + "\n" + error);
            }

        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log("some error in ajax" + "\n" + XMLHttpRequest + "\n" + textStatus + "\n" + errorThrown);
        }
    });
}
/*
    Funcion del panel de datos
*/
function mostrarpanel(e) {
    console.log(e.target.parentNode.parentNode.classList.toggle("mostrarpanel"));
    e.target.innerHTML = (e.target.textContent == "Ver detalles") ? "Ocultar detalles" : "Ver detalles";
}

/**
 * Template de los datos de alumnos
 */

function templatePanel(datos, universidad) {
    let template = `<div class='contenidoAlumno' id = 'contenidoAlumno' >
                        <div class='contenido-informacion'>
                            <img src='../img/imgUser/${datos[1]}' alt='Imagen del alumno'
                                class='img-responsive'>
                            <h2 class ='title-name'>
                            ${datos[0]}
                            <span>${universidad} </span>
                            </h2>
                            <button class ='btn btn-link btn-detalles' id='btn-detalles' onclick='mostrarpanel(event)'>Ver detalles</button>
                            <div class ='informacionAlumno'>
                            <ul>
                                <li><strong>Cantidad materias: </strong> ${datos[2]}</li>
                                <li><strong>Promedio materias: </strong> ${datos[3]}</li>
                            </ul>
                                <a href='AlumnoInicio.php?id=${datos[4]}' id='expediente'>Ver expediente</a>
                            </div>
                        </div>
                    </div > `;
    return template;
}

function capitalizarPrimeraLetra(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

function modalForStudentInfo(numeroId, universidad, datosAlumno) {
    let title = numeroId.match(/[\w]/g).join('');
    title = title.match(/[\D]/g).join('');

    let template = `<div class="modal fade " id="${numeroId}" tabindex=" - 1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Listado: ${universidad} <span class="tipo-nota">${capitalizarPrimeraLetra(title.toLowerCase())}</span> </h5>
                                    
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    ${datosAlumno}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" >Save</button>
                                </div>
                            </div>
                        </div>
                    </div > `;

    return template;
}