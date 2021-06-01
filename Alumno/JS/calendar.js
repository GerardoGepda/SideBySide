window.addEventListener("load", function (event) {
    console.log("'Todos los recursos terminaron de cargar!");
    cargarCalendario();
});



function cargarCalendario() {

    fetch(
        "Modelo/ModeloReunion/reunionesInscritas.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.json())
        .then(json => {
            // successfull actions

            var date = new Date();
            let all_data = [];
            let all_data2 = [];


            var yyyy = date.getFullYear().toString();
            var mm = (date.getMonth() + 1).toString().length == 1 ? "0" + (date.getMonth() + 1).toString() : (date.getMonth() + 1).toString();
            var dd = (date.getDate()).toString().length == 1 ? "0" + (date.getDate()).toString() : (date.getDate()).toString();

            all_data = json.reuniones
            all_data2 = json.reunionesFinaizadas

            let activos = [];
            let finalizados = [];

            all_data.forEach(e => {
                activos.push({
                    id: e.id,
                    title: e.title,
                    start: e.start,
                    end: e.end,
                    color: '#54E38A',
                })
            });

            all_data2.forEach(e => {
                finalizados.push({
                    id: e.id,
                    title: e.title,
                    description: 'Lecture',
                    start: e.start,
                    end: e.end,
                    color: '#BE0032',
                })
            });

            //inicio de llenar calendario
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    editable: true,
                    resourceLabelText: 'Rooms',
                    initialView: 'dayGridMonth',
                    themeSystem: 'bootstrap',
                    events: activos,
                    schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                    
                    
                });
                calendar.render();
    
            //fin de llenar calendario
        })


}


