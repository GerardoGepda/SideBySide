//inicio de declaración de variables
let tipo;
let ciclo;
let titulo;
// fin de declaración de variables

// grafica 
function LlenarGrafica(e) {
    
}

// función para llenar los ciclos 
function llenarCiclos(ciclos) {
    let template = "";
    let option = `<option class='dropdown-item' disabled selected>Ciclo</option>`;
    ciclos.forEach(e => {
        template +=
            `<option class='dropdown-item'>${e.ID_Ciclo}</option>`;
    });
    document.getElementById("ciclo").innerHTML = "";
    document.getElementById("ciclo").innerHTML = option + template;
}
// función para llenar los nombres de reuniones
function llenarNombres(nombre) {
    let template = "";
    let option = `<option class='dropdown-item' disabled selected>Nombre</option>`;
    nombre.forEach(e => {
        template +=
            `<option class='dropdown-item'>${e.Titulo}</option>`;
    });
    document.getElementById("nombre").innerHTML = "";
    document.getElementById("nombre").innerHTML = option + template;
}
// función para obtener los ciclos
function getciclos(tipo) {
    try {
        fetch(
            "Modelo/ModeloReportes/ModelReunion/getCiclos.php", {
            method: 'POST', // or 'PUT'
            body: JSON.stringify({ tipo: tipo }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(json => {
                llenarCiclos(json.tipo)
            })
    } catch (e) {
        console.log(e);
    }
}

function getNombre(ciclo) {
    try {
        fetch(
            "Modelo/ModeloReportes/ModelReunion/getTitulo.php", {
            method: 'POST', // or 'PUT'
            body: JSON.stringify({ ciclo: ciclo }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(json => {
                llenarNombres(json.nombre)
            })
    } catch (e) {
        console.log(e);
    }
}

function nombre() {
    ciclo = document.getElementById("ciclo").value;
    getNombre(ciclo);
}
function ciclos() {
    tipo = document.getElementById("class").value;
    getciclos(tipo);
}
// funcion principal
function procesar() {
    try {
        titulo = document.getElementById("nombre").value;
        if (titulo && tipo && ciclo) {
            fetch(
                "Modelo/ModeloReportes/ModelReunion/procesar.php", {
                method: 'POST', // or 'PUT', 'GET'
                body: JSON.stringify({ titulo: titulo, tipo: tipo, ciclo: ciclo }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            //promise
                .then(response => response.json())
                .then(json => {
                    LlenarGrafica(json.nombre)
                })
        } else {
            console.log("No hay valores suficientes");
        }
    } catch (error) {
        console.log(error);
    }
}
