var datareu = {
    idreunion: taller,
};

const alumno = document.getElementById("idalumno").value;
const reunion2 = document.getElementById("idreunion").value;


let exprs = new RegExp("([0-9]){4}-([0-9]){4}");
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
        this.reuniones();
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
                this.GuardarCupo(this.valor);
            } else {
                $("#TmodalAlerta").html("¡Advertencia!");
                $("#modalAlerta-content").html("Debes rellenar el campo del número de teléfono,    siguiendo el patrón 00000000.");
                $('#modalAlerta').modal('show');
            }
        },
        cancelar: function () {
            $('#modalDes').modal('show');
        },
        validarTelefono: function (e) {
            const tel = document.querySelector('#txttel');
            if (RegExp("([0-9])").test(e.key)) {
                if (tel.value.length == 4) {
                    tel.value += "-";
                }
            }else{
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
            $.ajax({
                type: "POST",
                url: "./Modelo/ModeloReunion/inscrSinCupo.php",
                data: datos,
                success: function (response) {
                    const result = JSON.parse(response);
                    if (result.estado == "ok") {
                        $("#TmodalAlerta").html("Respuesta"); 
                        $("#modalAlerta-content").html(`<p style='text-align: center;'>${result.mensaje}</p>` + `<p style='text-align: center;'>Link de la reunión: </p> <input type='text' class='form-control text-primary' readonly id='link' value='${result.Link}'>`);
                        $('#modalAlerta').modal('show');      
                        document.getElementById('BtnLink').classList.remove("d-none");
                        document.getElementById('BtnAceptar').classList.add("d-none");
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

var ObjDelteInscr = new Vue({
    el: "#modalDes",
    data: {
        infoReunion: [],
    },
    created: function () {
        this.infoReunion;
    },
    methods: {
        eliminar: function () {
            const re = document.getElementById("idreunion").value;
            const datos = {
                idalumno: alumno,
                idreunion: re,
                desinscribir: true
            };
            console.log(datos);
            $.ajax({
                type: "POST",
                url: "Modelo/ModeloReunion/inscrSinCupo.php",
                data: datos,
                success: function (response) {
                    console.log("success");
                    const result = JSON.parse(response);
                    if (result.estado == "ok") {
                        $("#TmodalAlerta").html("Respuesta");
                        $("#modalAlerta-content").html(result.mensaje);
                        $('#modalAlerta').modal('show');
                        document.getElementById('BtnLink').classList.add("d-none");
                        document.getElementById('BtnAceptar').classList.remove("d-none");
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