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
    return datos;
}

// proceso de llenado graficas
function loadUniversity(datos) {

    // inicio de declaración de arreglos
    let nombres = [];
    let aprobadas = [];
    let reprobadas = [];
    let retiradas = [];
    // fin de declaración de arreglos
    //------------------------------------------------ 

    // recorrer datos
    datos.forEach(dato => {
        nombres.push(dato.name);
        aprobadas.push(parseInt(dato.aprobadas));
        reprobadas.push(parseInt(dato.reprobadas));
        retiradas.push(parseInt(dato.retiradas));
    });

    // este for sirve para cargar las graficas de todas las universidades
    for (let index = 0; index < 60; index++) {
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
                    ['Aprobadas', ((aprobadas[index] * 100) / (aprobadas[index] + reprobadas[index] + retiradas[index])), false],
                    ['Reprobadas', ((reprobadas[index] * 100) / (aprobadas[index] + reprobadas[index] + retiradas[index])), false],
                    ['Retiradas', 50.5, false]
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
        }
    });
    return datos;
}