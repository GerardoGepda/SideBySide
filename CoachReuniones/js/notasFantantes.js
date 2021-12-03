// declaración de variables
let template, clase, ciclo, status, sedes;
let listaFaltantes = [];
let data = {};
let contar = 0;

function checkAll() {
    var inputs = document.querySelectorAll('.pl');
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].checked = true;
    }
}
function uncheckAll() {
    var inputs = document.querySelectorAll('.pl');
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].checked = false;
    }
}
function grafica(cantidad, faltan) {
    document.getElementById('donutchart').classList.remove('d-none');
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
    <div id="caja" class="mx-auto p-1">
    <form action="Modelo/ModeloNotas/correo.php" method="post" id="caja2">
        <button type="submit" id="enviar" class="btn btn-primary p-1" value="enviar"><i class="fa fa-paper-plane"></i>Enviar</button>
        <input type="text" value="${ciclo}" name="ciclo" hidden>
        <table class="table table-responsive"  id="example"  >
            <thead >
                <th scope="col">#</th>
                <th scope="col" id="che">
                <button type="button" id="check" class="btn p-1 m-1" onclick="checkAll()"><p>✓</p></button>
                <button type="button" id="uncheck" class="btn p-1 m-1" onclick="uncheckAll()"><p>X</p></i></button>
                </th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">Universidad</th>
                <th scope="col">Carrera</th>
                <th scope="col">Class</th>
                <th scope="col">Sede</th>
                <th scope="col">PDF</th>
                <th scope="col">N. Faltantes</th>
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
    clase = $("#class").val();
    ciclo = $("#ciclo").val();
    status = $("#status").val();
    sedes = $("#sede").val();
    // fin de extraer valores de los filtros   

    if (clase.length > 0 && ciclo.length > 0 && status.length > 0) {

        const classtxt = clase.map(x => "'" + x + "'").join(",");
        const ciclotxt = "'"+ciclo.trim()+"'";
        const statustxt = status.map(x => "'" + x + "'").join(",");
        const sedestxt = sedes.map(x => "'" + x + "'").join(",");

        data = {
            clase: classtxt, ciclos: ciclotxt, estado: statustxt, sedes: sedestxt
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
                console.log(listaFaltantes);
                createTemplate(json.ciclos);
                if (listaFaltantes) {
                    alumnos = "";
                    let contador = 1;
                    listaFaltantes.forEach(e => {
                        let nombre = e.Universidad;
                        if (nombre == 'UNDESA') {
                            nombre = 'UES SA';
                        } else if (nombre == 'UNDESS') {
                            nombre = 'UES';
                        } else if (nombre == 'UFGSS') {
                            nombre = 'UFG SS';
                        } else if (nombre == 'ECdCI') {
                            nombre = 'ECCI';
                        } else if (nombre == 'INICAES') {
                            nombre = 'UNICAES';
                        }
                        alumnos += `
                                    <tr>
                                        <td>${contador++}</td>
                                        <td>
                                            <label class='checkbox-wrap checkbox-primary'>
										  <input type='checkbox' class='pl' name='ActuaAlumno[]' value='${e.correo}'>
										  <span class='checkmark'></span></label></td>
                                        <td>${e.Nombre}</td>
                                        <td>${e.correo}</td>
                                        <td>${nombre} </td>
                                        <td>${e.Carrera} </td>
                                        <td>${e.Class} </td>
                                        <td>${e.Sede} </td>
                                        <td>${
                                            e.pdfnotas != null ? '<span class="badge badge-success">Con PDF</span>' : '<span class="badge badge-danger">Sin PDF</span>'
                                        } </td>
                                        <td>${
                                            e.NotasFalt > 0 ? '<span class="badge badge-danger">'+e.NotasFalt+'</span>' : '<span class="badge badge-success">0</span>'
                                        } </td>
                                    </tr>
                                    `
                    });
                    grafica(parseInt(json.completos), parseInt(json.faltantes));
                    document.getElementById("alumnos").innerHTML = alumnos;
                    $(document).ready(function () {
                        $('#example').DataTable({
                            "lengthMenu": [[200, 300, 400, -1], [200, 300, 400, "All"]],

                        });
                    });
                }
            })
    }


}