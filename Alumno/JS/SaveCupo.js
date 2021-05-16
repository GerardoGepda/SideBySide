const btnInscribir = document.getElementById("btninscribir");
const telefono = document.getElementById("txttel");
let exprs = new RegExp("([0-9]){4}-([0-9]){4}");

btnInscribir.addEventListener("click", () => {
    if (exprs.test(telefono.value)) {
        GuardarCupo(telefono.value);
    }else{
        $("#TmodalAlerta").html("¡Advertencia!");
        $("#modalAlerta-content").html("Debes rellenar el campo del número de teléfono, siguiendo el patrón 0000-0000.");
        $('#modalAlerta').modal('show');
    }
});

telefono.addEventListener('keypress', (e) => { 
    if (RegExp("([0-9])").test(e.key)) {
        if (telefono.value.length == 4) {
            telefono.value += "-";
        }
    }else{
        e.preventDefault();
    }
});

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
        hfin: horaFin
    };

    $.ajax({
        type: "POST",
        url: "./Modelo/ModeloReunion/inscribirSinCupo.php",
        data: datos,
        success: function (response) {
            $("#TmodalAlerta").html("Respuesta");
            $("#modalAlerta-content").html(response);
            $('#modalAlerta').modal('show');
            console.log("okok")
        }
    });
}