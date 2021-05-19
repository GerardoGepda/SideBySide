var datareu = {
    idreunion: taller,
};

var reunion = new Vue({
    el: "#tbody-reunion",
    data: {
        dinscrito: [],
        dnoinscrito: [],
    },
    created: function () {
        this.reuniones();
    },
    methods: {
        reuniones: function() {
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
        }
    },
});