var data2 = {
    id: taller,
    horario: horas
};



var app = new Vue({
    el: "#app",
    data: {
        all_data: [],
        all_data2: [],
        all_data3: [],
        all_data4: 0,
        op:0,
        contador: 1,
        active_el: 0
    },
    created: function () {
        console.log("Iniciando ...");
        this.get_contacts();
        this.cancelarInscripcion();
        this.disponibles();
    },
    methods: {
        get_contacts: function () {
            fetch(
                "Modelo/ModeloReunion/select.php", {
                method: 'POST', // or 'PUT'
                body: JSON.stringify(data2),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(json => {
                    this.all_data = json.reuniones
                })
        },
        cancelarInscripcion: function () {
            fetch(
                "Modelo/ModeloReunion/select_inscripcion.php", {
                method: 'POST',
                body: JSON.stringify(data2),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(json => {
                    this.all_data2 = json.lista1
                })
        },
        disponibles: function () {
            fetch(
                "Modelo/ModeloReunion/select_disponible.php", {
                method: 'POST',
                body: JSON.stringify(data2),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(json => {
                    this.all_data3 = json.disponibles;
                })
        },
        activate: function (el) {
            this.active_el = el;
            fetch(
                "Modelo/ModeloReunion/is_typping.php", {
                method: 'POST',
                body: JSON.stringify({ id: el }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    this.all_data4 = response.status;
                    this.op = el
                })
        }
    }
});