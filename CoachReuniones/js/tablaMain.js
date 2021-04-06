//codigo ajax que obtiene los datos de la BD
let contador = 1;
let contador2 = 1;

function ObtenerDatos(ciclos, clases, financiamiento, sedes) {
    $.ajax({
        type: "POST",
        data: {
            "ciclos": ciclos,
            "clases": clases,
            "financiamientos": financiamiento,
            "sedes": sedes
        },
        url: "../CoachReuniones/Modelo/ModeloReportes/ModelUniversidad/cargarTabla.php",
        error: function(xhr, textStatus, errorMessage) {
            console.log("ERROR\n" + errorMessage + textStatus + xhr);
        },
        success: function(response) {
            let datos = JSON.stringify(response);
            let templete;
            templete = datos;
            //añadimos el html con los datos a la tabla
            $("#TableBody").html(templete);

        }
    });
}

//función que extrae los datos para las graficas de barra de Aprovados, reprobados, etc. por Universidad
function GetDataGraphBarU(ciclos, clases, financiamiento, sedes, grafico) {
    let datos;
    $.ajax({
        type: "POST",
        url: "../CoachReuniones/Modelo/ModeloReportes/ModelUniversidad/GraphBarUniversidad.php",
        data: {
            "ciclos": ciclos,
            "clases": clases,
            "financiamientos": financiamiento,
            "sedes": sedes
        },
        success: function(response) {
            datos = JSON.parse(response);
            grafico(datos);
        }
    });
}

function CreateModals(e, universidad, listaAprobados, listaReprobados, listaRetirados) {
    let template = '';
    let contador1 = 4;
    let contador2 = 4;
    let contador3 = 4;

    student1 = []
    subject1 = [];
    grade1 = [];
    status1 = [];


    listaAprobados.forEach(element => {
        student1.push(element.alumno);
        subject1.push(element.id);
        grade1.push(element.nota);
        status1.push(element.estado);
    });

    for (let index = 0; index < e; index++) {
        template += `
    <div class="modal fade" id="aprobados-${contador1++}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
             <center>
                <h5 class="modal-title" id="exampleModalLabel">Listado ${universidad[index]} &nbsp;&nbsp;&nbsp;<code>Materias Aprobadas</code></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
             </center>
            </div>
            <div class="modal-body">
               <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>IdMateria</th>
                            <th>Nota</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>${student1[index]}</td>
                            <td>${subject1[index]}</td>
                            <td>${grade1[index]}</td>
                            <td>${status1[index]}</td>
                        </tr>
                    </tbody>     
               </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="reprobadas-${contador2++}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
         <center>
            <h5 class="modal-title" id="exampleModalLabel">Listado ${universidad[index]} &nbsp; &nbsp; &nbsp;<code>Materias Reprobadas </code></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </center>
        </div>
        <div class="modal-body">
           <table>
            <tr>
                <th>Nombre</th>
            </tr>
            <tr>
            <td></td>
            </tr>
           </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
</div>
<div class="modal fade" id="retiradas-${contador3++}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
     <center>
        <h5 class="modal-title" id="exampleModalLabel">Listado: ${universidad[index]}&nbsp; &nbsp; &nbsp; <code>Materias Retiradas</code></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
     </center>
    </div>
    <div class="modal-body">
       <table>
        <tr>
            <th>Nombre</th>
        </tr>
       </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </div>
    </div>
</div>
</div>
    `;
    }

    document.getElementById('showData').innerHTML = template;
}

function CreatDivs(e, ids) {
    let templete = '';
    let contador = 4;
    let cont1 = 4;
    let cont2 = 4;
    let cont3 = 4;
    for (let index = 0; index < e; index++) {
        templete += `
            <div class='uni-content my-1 ${ids[index].replace(/\s/g,"-")}' style='height: 285px;'>
                <div id='u-${contador++}' style='height: 220px;'></div>
                <div style='height: 60px; margin: 0px auto;'>
                    <center>
                        <button type="button" class="btn" data-toggle="modal" data-target="#aprobados-${cont1++}" style='background-color: #54E38A;'>Aprobadas</button>
                        <button type="button" class="btn" data-toggle="modal" data-target="#reprobadas-${cont2++}" style='background-color: #FF8C64;'>Reprobadas</button>
                        <button type="button" class="btn" data-toggle="modal" data-target="#retiradas-${cont3++}" style='background-color: #FFF587;'>Retiradas</button>
                    </center>
                </div>
            </div>
        `;
    }
    document.getElementById('universidades').innerHTML = templete;
}


function CumGeneral(cum) {
    let template = '';
    template = ` <div class='text-white details mb-3' style='max-width: 18rem;'>
                    <div class='card-header'>CUM GLOBAL</div>
                        <div class='card-body'>
                            <h5 class='card-title numero text-center'>` + cum + `</h5>
                            <br><br>
                        </div>
                    </div>
                `;

    document.getElementById('cumGeneral').innerHTML = template;
}

// proceso de llenado graficas
function loadUniversity(datos) {
    // inicio de declaración de variables
    let nombres = [];
    let ids = [];
    let aprobadas = [];
    let reprobadas = [];
    let retiradas = [];


    let cum1 = [];
    let listaAprobados = [];
    let listaReprobados = [];
    let listaRetirados = [];


    total1 = 0;
    total2 = 0;
    total3 = 0;

    // cum global 
    let cumGlobal

    // fin de declaración de arreglos
    //------------------------------------------------ 
    // recorrer datos
    datos.forEach(dato => {
        ids.push(dato.id);
        nombres.push(dato.name);
        aprobadas.push(parseInt(dato.aprobadas));
        reprobadas.push(parseInt(dato.reprobadas));
        retiradas.push(parseInt(dato.retiradas));
        cum1.push((parseFloat(dato.cum)));
        listaAprobados.push(dato.listaAprobado);
        listaReprobados.push(datos.listaReprobado);
        listaRetirados.push(datos.listaRetirado);
    });

    console.log(listaAprobados);
    console.log(listaReprobados);
    console.log(listaRetirados);

    // calcular cum global
    const reducer = (accumulator, currentValue) => accumulator + currentValue;
    cumGlobal = (cum1.reduce(reducer)) / cum1.length;

    CreateModals(nombres.length, nombres, listaAprobados, listaReprobados, listaRetirados);
    CreatDivs(nombres.length, ids);
    CumGeneral(cumGlobal.toFixed(1));


    aprobadas.forEach(function(numero) {
        total1 += numero;
    });
    reprobadas.forEach(function(numero) {
        total2 += numero;
    });
    retiradas.forEach(function(numero) {
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

    // este for sirve para cargar las graficas de todas las universidades
    for (let index = 0; index < nombres.length; index++) {
        Highcharts.chart('u-' + (contador++) + '', {
            chart: {
                styledMode: false,
            },
            title: {
                text: nombres[index]
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
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
}


//codigo ajax que obtiene los datos de la BD

function graphicsByUniversity(ciclos, clases, financiamiento, sedes, grafico) {
    let datos;
    $.ajax({
        type: "POST",
        url: "../CoachReuniones/Modelo/ModeloReportes/ModelUniversidad/GraphBarUniversidad.php",
        data: {
            "ciclos": ciclos,
            "clases": clases,
            "financiamientos": financiamiento,
            "sedes": sedes
        },
        success: function(response) {
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
                opt.innerHTML = dato.id.replace(/\s/g,"-");
                opt.value = dato.id.replace(/\s/g,"-");;
                filtroU.appendChild(opt);
            });
        }
    });
}