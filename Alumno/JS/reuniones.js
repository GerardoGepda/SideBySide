var columnas = new Vue({
    el: "#columnas",
    data: {
        columns: ["Hora inicio", "Hora final", "Cupo", "Duración por sesión"],
        tipo: tiporeunion,
        result: null,
        id: taller,
        student: a,
        verificado: null,
        polling: null
    },
    created: function () {
        this.validarTH();
        this.columns;

        this.polling = setInterval(() => {
            this.VerificarInscripcion();
        }, 3000);


    },
    methods: {
        validarTH: function () {
            if (this.tipo != "Sesión individual" && this.tipo != "Otro" && this.tipo != "Sesión Grupal") {
                this.columns.push("Teléfono");

                if (this.result == 0) {
                    this.columns.push("Inscribir")
                } else {
                    this.columns.push("Desinscribir")
                }
            } else {
                this.columns.push("Horarios")
            }
        },
        VerificarInscripcion: function () {
            const datos = {
                verificar: true,
                alumno: this.student,
                reunion: this.id
            }
            fetch(
                "Modelo/ModeloReunion/verificar.php", {
                method: 'POST',
                body: JSON.stringify(datos),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(json => {
                    this.verificado = json.verify[0];
                    if (this.verificado >= 1) {
                        this.columns.push("Link");
                        clearInterval(this.polling);
                    }
                })
        },
    },
});
