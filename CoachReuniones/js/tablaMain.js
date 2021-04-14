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
        error: function (xhr, textStatus, errorMessage) {
            console.log("ERROR\n" + errorMessage + textStatus + xhr);
        },
        success: function (response) {
            let datos = JSON.stringify(response);
            let templete;
            templete = datos;
            //añadimos el html con los datos a la tabla
            // $("#TableBody").html(templete);

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
        success: function (response) {
            datos = JSON.parse(response);
            grafico(datos);
        }
    });
}

function printPageArea(areaID) {
    var printContent = document.getElementById(areaID);
    var WinPrint = window.open('', '', 'width=900,height=650');
    WinPrint.document.write(printContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}

function CreateModals(e, universidad, listaAprobados, listaReprobados, listaRetirados, l1, l2, l3) {
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
        text1 = l1[index];

        text1.forEach(e => {
            nombre.push(e.alumno);
            photo.push(e.imagen);
        });
        f1.push(text1);
    }
    // lista DISTINCT reprobados
    for (let index = 0; index < l2.length; index++) {
        photo = [];
        nombre = [];
        text2 = l2[index];

        text2.forEach(e => {
            nombre.push(e.alumno);
            photo.push(e.imagen);
        });
        f2.push(text2);
    }
    for (let index = 0; index < l3.length; index++) {
        photo = [];
        nombre = [];
        text3 = l3[index];

        text3.forEach(e => {
            nombre.push(e.alumno);
            photo.push(e.imagen);
        });
        f3.push(text3);
    }


    for (let index = 0; index < listaAprobados.length; index++) {
        // inicio de declaración de arrays
        student1 = [], student2 = [], subject1 = [], grade1 = [], status1 = [], img1 = []
        // fin de declaración de arrays;
        data1 = listaAprobados[index];

        data1.forEach(e => {
            img1.push(e.imagen);
            student2.push(e.nombreMateria);
            student1.push(e.alumno);
            subject1.push(e.id);
            grade1.push(e.nota);
            status1.push(e.estado);
        });
        final.push(data1);
    }

    for (let index = 0; index < listaReprobados.length; index++) {
        student2 = [], subject2 = [], grade2 = [], status2 = [], student3 = [], img2 = []
        data2 = listaReprobados[index];
        data2.forEach(element => {
            img2.push(element.imagen);
            student3.push(element.nombreMateria);
            student2.push(element.alumno);
            subject2.push(element.id);
            grade2.push(element.nota);
            status2.push(element.estado);
        });
        final2.push(data2)
    }

    for (let index = 0; index < listaRetirados.length; index++) {
        student3 = []
        subject3 = [];
        grade3 = [];
        status3 = [];
        student4 = [];
        img3 = [];
        data3 = listaRetirados[index];

        data3.forEach(element => {
            img3.push(element.imagen);
            student4.push(element.nombreMateria);
            student3.push(element.alumno);
            subject3.push(element.id);
            grade3.push(element.nota);
            status3.push(element.estado);
        });
        final3.push(data3)
    }
    for (let index = 0; index < e; index++) {
        let table1 = '';
        let table2 = '';
        let table3 = '';
        let data = '';
        let c1 = 1;
        let c2 = 1;
        let c3 = 1;

        for (const dato of final[index]) {
            data += `<tr>
                        <td>${c++}</td>
                        <td><img src='../img/imgUser/${dato[5]}' alt='Alumno' style='width:60px; height:60px; border-radius: 45px;'></td>
                        <td>${dato[0]}</td>
                        <td>${dato[4]}</td>
                        <td>${dato[2]}</td>
                        <td>${dato[3]}</td>
                    </tr>`;
        }

        let data2 = '';
        c = 1;
        for (const dato of final2[index]) {
            data2 += `<tr>
                        <td>${c++}</td>
                        <td><img src='../img/imgUser/${dato[5]}' alt='Alumno' style='width:60px; height:60px; border-radius: 45px; '></td>
                        <td>${dato[0]}</td>
                        <td>${dato[4]}</td>
                        <td>${dato[2]}</td>
                        <td>${dato[3]}</td>
                    </tr>`;
        }
        let data3 = '';
        c = 1;
        for (const e of final3[index]) {
            data3 += `<tr>
                        <td>${c++}</td>
                        <td><img src='../img/imgUser/${e[5]}' alt='Alumno' style='width:60px; height:60px; border-radius: 45px;'></td>
                        <td>${e[0]}</td>
                        <td>${e[4]}</td>
                        <td>${e[2]}</td>
                        <td>${e[3]}</td>
                    </tr>`;
        }


        for (const dato of f1[index]) {
            table1 += `<tr>
                        <td>${c1++}</td>
                        <td><img src='../img/imgUser/${dato[1]}' alt='Alumno' style='width:60px; height:60px; border-radius: 45px;'></td>
                        <td>${dato[0]}</td>
                        <td>
                        <button type='button' class='btn btn-primary' data-bs-toggle='tooltip' data-bs-placement='right' title='lista de materias inscritas:'>Detalles</button>
                        </td>
                    </tr>`;
        }

        for (const dato of f2[index]) {
            table2 += `<tr>
                        <td>${c2++}</td>
                        <td><img src='../img/imgUser/${dato[1]}' alt='Alumno' style='width:60px; height:60px; border-radius: 45px;'></td>
                        <td>${dato[0]}</td>
                    </tr>`;
        }
        for (const dato of f3[index]) {
            table3 += `<tr>
                        <td>${c3++}</td>
                        <td><img src='../img/imgUser/${dato[1]}' alt='Alumno' style='width:60px; height:60px; border-radius: 45px;'></td>
                        <td>${dato[0]}</td>
                    </tr>`;
        }


        template += `
    <div class="modal fade " id="aprobados-${contador1++}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
             <center>
                <h5 class="modal-title" id="exampleModalLabel">Listado: ${universidad[index]} &nbsp;&nbsp;&nbsp;<code>Materias Aprobadas</code></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
             </center>
            </div>
            <div class="modal-body">
               <table class='table ' id='save-${index}' >
                    <thead class='table-dark'>
                        <tr>
                            <th>#</th>
                            <th>img</th>
                            <th>Nombre</th>
                            <th>Nombre Materia</th>
                            <th>Nota</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody class='table-light table-bordered table-striped table-hover'> 
                        ${data}
                    </tbody>     
               </table>
               <table class='table' >
                    <thead class='table-dark'>
                        <tr>
                            <th>#</th>
                            <th>img</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody class='table-light table-bordered table-striped table-hover'> 
                        ${table1}
                    </tbody>     
               </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick='printPageArea('save-${index}')')>Save</button>
            </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="reprobadas-${contador2++}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
         <center>
            <h5 class="modal-title" id="exampleModalLabel">Listado: ${universidad[index]} &nbsp; &nbsp; &nbsp;<code>Materias Reprobadas </code></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </center>
        </div>
        <div class="modal-body">
        <table class='table' id='s-${index}'>
        <thead class='table-dark'>
            <tr>
                <th>#</th>
                <th>img</th>
                <th>Nombre</th>
                <th>Nombre Materia</th>
                <th>Nota</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody class='table-light table-bordered table-striped table-hover'>
        ${data2}
        </tbody>     
   </table>
   <table class='table' >
                    <thead class='table-dark'>
                        <tr>
                            <th>#</th>
                            <th>img</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody class='table-light table-bordered table-striped table-hover'> 
                        ${table2}
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
    <table class='table' id='sa-${index}'>
    <thead class='table-dark'>
        <tr>
            <th>#</th>
            <th>img</th>
            <th>Nombre</th>           
            <th>Nombre Materia</th>
            <th>Nota</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody class='table-light table-bordered table-striped table-hover'>
    ${data3}
    </tbody>     
</table>
<table class='table' >
                    <thead class='table-dark'>
                        <tr>
                            <th>#</th>
                            <th>img</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody class='table-light table-bordered table-striped table-hover'> 
                        ${table3}
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
            <div class='uni-content my-1 ${ids[index].replace(/\s/g, "-")}' style='height: 285px;'>
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
    template = ` <div class='text-white details' id='cum2'>
                        <div>
                            <h5 >` + cum + `</h5>
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

    let lista1 = [];
    let lista2 = [];
    let lista3 = [];

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
        listaReprobados.push(dato.listaReprobado);
        listaRetirados.push(dato.listaRetirado);
        lista1.push(dato.l1);
        lista2.push(dato.l2);
        lista3.push(dato.l3);
    });
    // calcular cum global
    const reducer = (accumulator, currentValue) => accumulator + currentValue;
    cumGlobal = (cum1.reduce(reducer)) / cum1.length;
    // console.log(lista1);
    // console.log(lista2);
    // console.log(lista3);
    CreateModals(nombres.length, nombres, listaAprobados, listaReprobados, listaRetirados, lista1, lista2, lista3);
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
        success: function (response) {
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
        }
    });
}