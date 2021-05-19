var datareu = {
    idreunion: taller,
};

let exprs = new RegExp("([0-9]){8}");
let telefono = document.getElementById("txttel");

var reunion = new Vue({
    el: "#tbody-reunion",
    data: {
        dinscrito: [],
        dnoinscrito: [],
        valor: ''
    },
    created: function () {
        this.reuniones();
    },
    methods: {
        reuniones: function () {
            fetch(
                "Modelo/ModeloReunion/selectreuniones.php", {
                method: 'POST', // or 'PUT'
                body: JSON.stringify(datareu),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(json => {
                    this.dinscrito = json.reunion;
                })
        },
        inscribir: function () {
            console.log("iniciando");
            if (exprs.test((this.valor))) {
                const telefono = this.valor.substring(0, 4) + "-" + this.valor.substring(4, 8);
                this.GuardarCupo(telefono);
            } else {
                $("#TmodalAlerta").html("¡Advertencia!");
                $("#modalAlerta-content").html("Debes rellenar el campo del número de teléfono,    siguiendo el patrón 00000000.");
                $('#modalAlerta').modal('show');
            }
        },
        validarTelefono: function (e) {
            if (!RegExp("([0-9])").test(e.key)) {
                e.preventDefault();
            }
        },
        GuardarCupo: function (telefono) {

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
                        setTimeout(function () {
                            window.location = "AlumnoReuniones.php";
                        }, 2000);
                    } else {
                        $("#TmodalAlerta").html("Respuesta");
                        $("#modalAlerta-content").html(result.mensaje);
                        $('#modalAlerta').modal('show');
                    }
                }
            });
        }
    },
});