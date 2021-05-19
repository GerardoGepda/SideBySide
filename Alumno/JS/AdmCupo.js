const btnInscribir = document.getElementById("btninscribir");
const btnDes = document.getElementById("btndesinscribir");
const btnDesinscribir = document.getElementById("btnModalDesinscribir");
const telefono = document.getElementById("txttel");
let exprs = new RegExp("([0-9]){4}-([0-9]){4}");

console.log("ok");

//evento del boton inscribir
btnInscribir.addEventListener("click", () => {
    if (exprs.test(telefono.value)) {
        GuardarCupo(telefono.value);
    }else{
        $("#TmodalAlerta").html("¡Advertencia!");
        $("#modalAlerta-content").html("Debes rellenar el campo del número de teléfono, siguiendo el patrón 0000-0000.");
        $('#modalAlerta').modal('show');
    }
});

//evento del campo telefono
telefono.addEventListener('keypress', (e) => { 
    if (RegExp("([0-9])").test(e.key)) {
        if (telefono.value.length == 4) {
            telefono.value += "-";
        }
    }else{
        e.preventDefault();
    }
});

//funcion que guarda la inscripcion o cupo
function GuardarCupo(telefono) {

    const reunion = document.getElementById("idreunion").value;
    const alumno = document.getElementById("idalumno").value;
    const horario = document.getElementById("idhorario").value;
    const horaIn = document.getElementById("hinicio").value;
    const horaFin = document.getElementById("hfin").value;

    const datos = {
        idalumno: alumno,
        idreunion: reunion,
        horario: horario,
        telefono: telefono,
        hinicio: horaIn,
        hfin: horaFin,
        inscribir: true
    };

    $.ajax({
        type: "POST",
        url: "./Modelo/ModeloReunion/inscrSinCupo.php",
        data: datos,
        success: function (response) {
            const result = JSON.parse(response);
            if (result.estado == "ok") {
                $("#TmodalAlerta").html("Respuesta");
                $("#modalAlerta-content").html(result.mensaje);
                $('#modalAlerta').modal('show');
                setTimeout(function(){
                    window.location = "AlumnoReuniones.php";
                },2000);  
            }else {
                $("#TmodalAlerta").html("Respuesta");
                $("#modalAlerta-content").html(result.mensaje);
                $('#modalAlerta').modal('show');
            }
        }
    });
}

//evento del boton para mostrar el modal de desinscribir
btnDes.addEventListener("click", () => {
    console.log();
    $('#modalDes').modal('show');
});

btnDesinscribir.addEventListener("click", () => {
    const reunion = document.getElementById("idreunion").value;
    const alumno = document.getElementById("idalumno").value;

    const datos = {
        idalumno: alumno,
        idreunion: reunion,
        desinscribir: true
    };

    console.log("des", datos);

    $.ajax({
        type: "POST",
        url: "./Modelo/ModeloReunion/inscrSinCupo.php",
        data: datos,
        success: function (response) {
            const result = JSON.parse(response);
            if (result.estado == "ok") {
                $("#TmodalAlerta").html("Respuesta");
                $("#modalAlerta-content").html(result.mensaje);
                $('#modalAlerta').modal('show');
                setTimeout(function(){
                    window.location = "AlumnoReuniones.php";
                },2000);    
            }else {
                $("#TmodalAlerta").html("Respuesta");
                $("#modalAlerta-content").html(result.mensaje);
                $('#modalAlerta').modal('show');
            }
        }
    });
    
});