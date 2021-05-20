var datareu = {
    idreunion: taller,
};

const alumno = document.getElementById("idalumno").value;
const reunion2 = document.getElementById("idreunion").value;


let exprs = new RegExp("([0-9]){8}");
let telefono = document.getElementById("txttel");

var reunion = new Vue({
    el: "#tbody-reunion",
    data: {
        dinscrito: [],
        dnoinscrito: [],
        valor: '',
        tmp: [],
        refresh: null,
        verificado: null,
        tester: null
    },
    created: function () {
        this.refresh = setInterval(() => {
            this.reuniones();
            this.VerificarInscripcion();
        }, 3000);
    },
    methods: {
        VerificarInscripcion: function () {
            const r = document.getElementById("idreunion").value;
            const datos = {
                verificar: true,
                alumno: alumno,
                reunion: r
            }
            fetch(
                "Modelo/ModeloReunion/verificar.php", {
                method: 'POST', // or 'PUT'
                body: JSON.stringify(datos),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(json => {
                    this.verificado = json.verify[0];
                })
        },
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
                    this.tmp = json.reunion;
                    dReunion.infoReunion = json.reunion;
                })
            return this.tmp;
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
        cancelar: function () {
            $('#modalDes').modal('show');
        },
        eliminar: function () {
            const re = document.getElementById("idreunion").value;
            const datos = {
                idalumno: alumno,
                idreunion: re,
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
                    } else {
                        $("#TmodalAlerta").html("Respuesta");
                        $("#modalAlerta-content").html(result.mensaje);
                        $('#modalAlerta').modal('show');
                    }
                }
            });
        },
        validarTelefono: function (e) {
            if (!RegExp("([0-9])").test(e.key)) {
                e.preventDefault();
            }
        },
        GuardarCupo: function (telefono) {
            const horario = document.getElementById("idhorario").value;
            const horaIn = document.getElementById("hinicio").value;
            const horaFin = document.getElementById("hfin").value;
            const r = document.getElementById("idreunion").value;

            const datos = {
                idalumno: alumno,
                idreunion: r,
                horario: horario,
                telefono: telefono,
                hinicio: horaIn,
                hfin: horaFin,
                inscribir: true
            };

            console.log(datos);
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
                    } else {
                        $("#TmodalAlerta").html("Respuesta");
                        $("#modalAlerta-content").html(result.mensaje);
                        $('#modalAlerta').modal('show');
                    }
                }
            });
        },

    },
});

var dReunion = new Vue({
    el: "#dReunionDiv",
    data: {
        infoReunion: [],
    },
    created: function () {
        this.infoReunion;
    }
});