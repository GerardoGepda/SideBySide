//codigo ajax que obtiene los datos de la BD

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
            alert("ERROR\n" + errorMessage + textStatus + xhr);
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
            //console.log(datos);
            grafico(datos);
        }
    });
    return datos;
}

// proceso de llenado graficas
function loadUniversity(values) {
    let contador = 1;

    for (let index = 0; index < values.length; index++) {
        const element = values['name'];
        console.log(element);

        Highcharts.chart('u-' + contador + '', {
            chart: {
                styledMode: false,
            },
            title: {
                text: 'prueba'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data: [
                    ['Aprobadas', 29.9, false],
                    ['Reprobadas', 71.5, false],
                    ['Retiradas', 106.4, false]
                ],
                showInLegend: true,
            }],
            credits: {
                enabled: false
            },
        });
    }
}


//codigo ajax que obtiene los datos de la BD

function graphicsByUniversity(ciclos, clases, financiamiento, sedes) {
    $.ajax({
        url: "../CoachReuniones/Modelo/ModeloReportes/ModelUniversidad/cargarUniversidades.php",
        type: "POST",
        data: {
            "ciclos": ciclos,
            "clases": clases,
            "financiamientos": financiamiento,
            "sedes": sedes
        },
        // dataType: "json",

        error: function(xhr, textStatus, errorMessage) {
            console.log("ERROR, al cargar graficas por universidad\n" + errorMessage + textStatus + xhr);
        },
        success: function(response) {
            loadUniversity(response);
        }
    });
}