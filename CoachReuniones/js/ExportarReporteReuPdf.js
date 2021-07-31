window.jsPDF = window.jspdf.jsPDF;
//construyendo la información
let dataPDF = {
    columns: [{
        No: "No.",
        nombre: "Alumno",
        correo: "Correo",
        u: 'Universidad', 
        sede: 'Sede/Modalidad', 
        estadoB: 'Estado Beca', 
        class: 'Class',
        estado: "Estado"
    }],
    rows: []
};
function ExportarPDF(data) {
    try {
        const btnexcel = document.querySelectorAll((".btn-pdf"));
        btnexcel.forEach(btn => btn.addEventListener("click", (e) => {
            const idU = e.target.classList[0].replace("-", " ");
            for (const key in data) {
                if (idU === data[key].universidad) {
                    MakePDf(PrepareArrayPdf(data[key]));
                    break;
                }
            }
        }));
    } catch (error) {
        console.log(error);
    }

}


function PrepareArrayPdf(json) {
    let cont = 1;
    dataPDF.rows = [];

    for (const key in json) {
        if (key !== 'universidad') {
            json[key].forEach(element => {
                let asistenciaAlmn = element.asistencia;
                if (asistenciaAlmn === null || asistenciaAlmn === undefined || asistenciaAlmn === " ") {
                    asistenciaAlmn = "No Inscrito"
                }
                dataPDF.rows.push([cont++, element.nombre, element.correo, element.U, element.sede, element.estatus, element.Class, asistenciaAlmn]);
            });
        }
    }
    return dataPDF;
}


function MakePDf(data) {
    var pdfdoc = new jsPDF({
        unit: "pt",
        orientation: "landscape"
    });

    pdfdoc.setFontSize(12);
    pdfdoc.setTextColor(0);
    pdfdoc.text("Lista de asistencia", 40, 40);

    //creando la tabla
    pdfdoc.autoTable({
        head: data.columns,
        body: data.rows,
        theme: 'grid',
        headStyles: {
            fillColor: [157, 18, 14],
        },
        margin: { top: 60 },
    });

    pdfdoc.save("Reporte asistencia.pdf");
}