// declaración de variables
let template, clase, ciclo, status;
let contador = 1;
let listaFaltantes = [];
let data = {};
let contar = 0;

function checkAll() {
    var inputs = document.querySelectorAll('.pl');
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].checked = true;
    }
}
function grafica(cantidad, faltan) {
    google.charts.load("current", { packages: ["corechart"] });
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Notas', 'Cantidad'],
            ['Subidas: ' + cantidad, cantidad],
            ['Faltantes: ' + faltan, faltan],
        ]);

        var options = {
            title: 'Notas Faltantes',
            pieHole: 0.4,
            colors: ['#54E38A', '#BE0032'],
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
    }
}
function createTemplate(ciclo) {
    template = `
    <div style="background-color:#ADADB2; border-radius:15px;" class="w-75 mx-auto m-1 p-1">
    <form action="Modelo/ModeloNotas/correo.php" method="post" style="background-color:#ADADB2">
        <button type="submit" class="btn btn-primary p-1" value="enviar"><i class="fa fa-paper-plane"></i>Enviar</button>
        <input type="text" value="${ciclo}" name="ciclo" hidden>
        <table class="table  mx-auto mt-4 m-1 p-2 table-responsive" id="example" style="width:98%; border-radius:15px;" >
            <thead class="thead-dark table-bordered">
                <th>#</th>
                <th><button type="button" class="btn btn-primary p-1 m-1" onclick="checkAll()">Todos</button></th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Universidad</th>
                <th>Carrera</th>
                <th>Class</th>
                <th>Sede</th>
            </thead>
            <tbody class='table table-striped table-hover table-bordered' id='alumnos'>
                <tr>
                    <td colspan="8">
                    <center>
                        <div class="spinner-border text-danger mx-auto text-center" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </center>
                    </td>
                </tr>
            </tbody>
        </table>
        </form>
    </div>
    
    `;

    document.getElementById("lista").innerHTML = template;
}
// inicio de funciones
function main() {
    //inicio de extraer valores de los filtros
    clase = document.getElementById("class").value
    ciclo = document.getElementById("ciclo").value
    status = document.getElementById("status").value
    // fin de extraer valores de los filtros   

    data = {
        clase: clase, ciclos: ciclo, estado: status
    };
    // buscar la lista de los alumnos que no han subido sus notas
    fetch(
        "Modelo/ModeloNotas/extraerNotasFaltantes.php", {
        method: 'POST', // or 'PUT'
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.json())
        .then(json => {
            listaFaltantes = json.lista;
            createTemplate(json.ciclos);
            if (listaFaltantes) {
                alumnos = "";
                listaFaltantes.forEach(e => {
                    contar++;
                    alumnos += `
                                <tr>
                                    <td>${contador++}</td>
                                    <td><input type='checkbox' name='ActuaAlumno[]' class='pl' value="${e.correo}"></td>
                                    <td>${e.name}</td>
                                    <td>${e.correo}</td>
                                    <td>${e.ID_Empresa} </td>
                                    <td>${e.nombre} </td>
                                    <td>${e.Class} </td>
                                    <td>${e.ID_Sede} </td>
                                </tr>
                                `
                });
                let subieron = 0;
                subieron = parseInt(json.cantidad) - contar;
                grafica(subieron, contar);
                document.getElementById("alumnos").innerHTML = alumnos;
                $(document).ready(function () {
                    $('#example').DataTable({
                        "lengthMenu": [[200, 300, 400, -1], [200, 300, 400, "All"]],

                    });
                });
            }
        })
}