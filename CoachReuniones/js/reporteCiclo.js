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

function procesar() {
    let ciclo = document.getElementById("ciclo").value;
    let clase = document.getElementById("clase").value
    MainGraphic(ciclo);

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