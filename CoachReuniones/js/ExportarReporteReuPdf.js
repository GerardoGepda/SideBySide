window.jsPDF = window.jspdf.jsPDF;
//construyendo la información
let dataPDF = {
    columns: [{
        No: "No.",
        nombre: "Alumno",
        estado: "estado"
    }],
    rows: []
};
function ExportarPDF(data) {
    try {
        const btnexcel = document.querySelectorAll((".btn-pdf"));
        btnexcel.forEach(btn => btn.addEventListener("click", (e) => {
            var idU = e.target.classList[0].replace("-", " ");
            for (const key in data) {
                if (idU === data[key].universidad) {
                    MakePDf(PrepareArrayPdf(data[key]));
                    //PrepareArrayPdf(data[key]);
                    break;
                }
            }
        }));
    } catch (error) {
        console.log(error);
    }

}


function PrepareArrayPdf(json) {
    let arrayTmp = [];
    let cont = 1;
    delete json['universidad'];

    for (const key in json) {
        // arrayTmp = [];
        // cont = 1;
        json[key].forEach(element => {
            let noInscritos = element.asistencia;
            if (noInscritos === null || noInscritos === undefined || noInscritos === " ") {
                noInscritos = "No Inscrito"
            }
            dataPDF.rows.push([cont++, element.nombre, noInscritos]);
        });
        // data.rows.push(arrayTmp);
    }
    console.log(dataPDF.rows);
    return dataPDF;
}


function MakePDf(data) {
    var pdfdoc = new jsPDF("1", "pt");
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