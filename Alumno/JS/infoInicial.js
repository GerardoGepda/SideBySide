var mostrarInfo = new Vue({
    el: "#listado",
    data: {
        info: [],
        sortKey: '',
        search: '',
        reverse: false,
        polling:null,
        columns: ['ID', 'Titulo', 'Fecha', 'Encargado', 'Tipo de reunión', 'Opciones'],
    },
    created: function () {
        this.reunionesActivas();
        this.polling = setInterval(() => {
            this.reunionesActivas();
        }, 3000);
    },
    methods: {
        reunionesActivas: function () {
            fetch(
                "Modelo/ModeloReunion/reunionesActivas.php", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(json => {
                    this.info = json.disponibles;
                })
        },
    }
});
