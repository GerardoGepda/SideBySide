var data = {
    id: carnet,
};

const pensum = new Vue({
    el: "#estudio",
    data: {
        info: [],
        expedU: []
    }
});

const totales = new Vue({
    el: "#totales",
    data: {
        aprob: [],
        reprob: [],
        retir: [],
        inscritas: [],
    }
});

const modalMaterias = new Vue({
    el: "#materiasInsc",
    data: {
        materias: []
    }
})
const modal = new Vue({
    el: "#formAlumno",
    data: {
        universidad: [],
        otros: []
    }
})
const porcentaje = new Vue({
    el: "#porcentaje",
    data: {
        porcentaje: 0.00
    }
})


const app = new Vue({
    el: "#detalles",
    data: {
        datos: [],
        block: [],
        total: [],
    },
    created: function () {
        this.getInfo()
        this.getExpedienteU()
        this.getTotal()
    },
    methods: {
        getInfo: function () {
            fetch(
                "Modelo/ModeloReunion/infoAlumno.php", {
                method: 'POST', // or 'PUT'
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(json => {
                    this.datos = json.alumno[0]
                    pensum.info = this.datos
                    modal.otros = this.datos
                })
        },
        getExpedienteU: function () {
            fetch(
                "Modelo/ModeloReunion/expedienteU.php", {
                method: 'POST', // or 'PUT'
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(json => {
                    this.block = json.alumno[0]
                    pensum.expedU = json.alumno[0]
                    modal.universidad = json.alumno[0]
                    porcentaje.porcentaje = parseFloat(json.alumno[0].avancePensum).toFixed(2)
                })
        },
        getTotal: function () {
            fetch(
                "Modelo/ModeloAlumno/aprobado.php", {
                method: 'POST', // or 'PUT'
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(json => {
                    totales.aprob = json[0].Aprobado
                    totales.reprob = json[1].Reprobada
                    totales.retir = json[2].Retirada
                    totales.inscritas = json[3].Inscrita
                    modalMaterias.materias = json[4]

                    console.log(modalMaterias.materias);
                })
        }


    }
})

