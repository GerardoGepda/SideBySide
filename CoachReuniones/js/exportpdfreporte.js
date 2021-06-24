window.jsPDF = window.jspdf.jsPDF;
//construyendo la información
let data = {
    columns: [{
        No: "No.",
        nombre: "Alumno",
        universidad: "Universidad",
        class: "Class",
        status: "Status",
        promedio: "Promedio",
        materias1: "No. mat. Aprobadas",
        materias2: "No. mat. Reprobadas",
        materias3: "No. mat. Retiradas"
    }],
    rows: []
};

let alumnotmp = "";

function ExportarGeneralPDF() {
    let pdf = document.getElementById("pdfExport");
    let contador = 1;

    pdf.innerHTML = `<i class="fas fa-spinner " id="rotate" ></i>`;
    try {
        $.ajax({
            type: "POST",
            url: "../CoachReuniones/Modelo/ModeloReportes/ModelUniversidad/GraphBarUniversidad.php",
            data: {
                "ciclos": listaCiclos,
                "clases": listaClases,
                "financiamientos": listaFinanciamiento,
                "sedes": listaSede,
                "status": listaStatus
            },
            success: function (response) {
                try {
                    datos = JSON.parse(response);
                    let pdf = document.getElementById("pdfExport");
                    setTimeout(() => {
                        pdf.innerHTML = `<i class="fas fa-file-pdf"></i>`;
                        let listAprobados = [], lis2 = [], listRetirados = [], listReprobados = []
                        //obteniendo datos de aprobados
                        for (const key in datos) {
                            listAprobados.push(datos[key].l1);
                        }
                        for (const key in datos) {
                            lis2.push(datos[key].listaAprobado);
                        }
                        for (const key in datos) {
                            listRetirados.push(datos[key].listaRetirado);
                        }
                        for (const key in datos) {
                            listReprobados.push(datos[key].listaReprobado);
                        }
                        //llenar data
                        for (const key in listAprobados.flat()) {
                            if (alumnotmp !== listAprobados.flat()[key].alumno) {
                                alumnotmp = listAprobados.flat()[key].alumno;
                                let promedi = 0;
                                let reprob = parseFloat(PromedioMaterias(listReprobados.flat().filter(x => x.alumno === alumnotmp)))
                                let aprob = parseFloat(PromedioMaterias(lis2.flat().filter(x => x.alumno === alumnotmp)))

                                if (isNaN(reprob)) {
                                    promedi = aprob
                                } else {
                                    promedi = ((aprob + reprob + 1) / 2).toFixed(2)
                                }
                                data.rows.push({
                                    No: contador++,
                                    nombre: listAprobados.flat()[key].alumno,
                                    universidad: listAprobados.flat()[key].empresa,
                                    class: listAprobados.flat()[key].Class,
                                    status: listAprobados.flat()[key].estatus,
                                    promedio: promedi,
                                    materias1: listAprobados.flat()[key].total,
                                    materias2: (listReprobados.flat().filter(x => x.alumno === alumnotmp).length),
                                    materias3: (listRetirados.flat().filter(x => x.alumno === alumnotmp).length),
                                });

                            }
                        }
                        MakePDf(data)
                    }, 5000);

                } catch (error) {

                    pdf.innerHTML = `<i class="fas fa-file-pdf"></i>`;
                    if ((listaCiclos = []) || (listaClases = []) || (listaFinanciamiento = [] || (listaSede = []))) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Dede selecionar todos los filtros',
                            text: error,
                            footer: '<b>Intente de nuevo </b>'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Time Out',
                            text: error,
                            footer: '<b>Intente de nuevo dentro de unos segundos</b>'
                        });
                    }
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: XMLHttpRequest,
                    text: textStatus,
                    footer: errorThrown
                })
            }
        })
    } catch (error) {
        if ((listaCiclos = []) || (listaClases = []) || (listaFinanciamiento = [] || (listaSede = []))) {
            Swal.fire({
                icon: 'error',
                title: 'Dede selecionar todos los filtros',
                text: error,
                footer: '<b>Intente de nuevo </b>'
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Time Out',
                text: error,
                footer: '<b>Intente de nuevo dentro de unos segundos</b>'
            });
        }
    }
}
const ExportarPDF = (datos) => {
    let contador = 1;

    const btnexportPdf = document.querySelectorAll((".btnexpPdf"));
    let universidad = [];

    btnexportPdf.forEach(btn => btn.addEventListener("click", (e) => {
        let icon = `<i class="fas fa-spinner " id="rotate" ></i>`;
        btn.innerHTML = icon;
        setTimeout(
            () => {
                //extraemos el id de la universidad del btn
                const idU = e.target.classList[0].replace("-", " ");
                //filtramos los datos para la U seleccionada
                for (const U in datos) {
                    if (datos[U].id === idU) {
                        universidad = datos[U];
                        break;
                    }
                }

                //obteniendo datos de aprobados
                const listAprobados = universidad.l1;
                const lis2 = universidad.listaAprobado;
                const listRetirados = universidad.listaRetirado;
                const listReprobados = universidad.listaReprobado;

                for (const key in listAprobados) {
                    if (alumnotmp !== listAprobados[key].alumno) {
                        alumnotmp = listAprobados[key].alumno;
                        let promedi = 0;
                        let reprob = parseFloat(PromedioMaterias(listReprobados.filter(x => x.alumno === alumnotmp)))
                        let aprob = parseFloat(PromedioMaterias(lis2.filter(x => x.alumno === alumnotmp)))

                        if (isNaN(reprob)) {
                            promedi = aprob
                        } else {
                            promedi = ((aprob + reprob + 1) / 2).toFixed(2)
                        }

                        data.rows.push({
                            No: contador++,
                            nombre: listAprobados[key].alumno,
                            universidad: universidad.id,
                            class: listAprobados[key].Class,
                            status: listAprobados[key].estatus,
                            promedio: promedi,
                            materias1: listAprobados[key].total,
                            materias2: (listReprobados.filter(x => x.alumno === alumnotmp).length),
                            materias3: (listRetirados.filter(x => x.alumno === alumnotmp).length),
                        });

                    }
                }
                MakePDf(data)
                btn.innerHTML = `<i class="fas fa-file-pdf"></i>`;
            }, 5000, "Finished"
        );

    }));

}
function PromedioMaterias(materias) {
    let promedio = 0;
    materias.forEach(materia => {
        promedio += parseFloat(materia.nota);
    });
    promedio = promedio / materias.length;
    if (isNaN(promedio)) {
        return null
    } else {
        return parseFloat(promedio).toFixed(2);
    }
}



function MakePDf(data) {
    var pdfdoc = new jsPDF("1", "pt");
    pdfdoc.setFontSize(12);
    pdfdoc.setTextColor(0);
    pdfdoc.text("Lista de aprobados reprobados y retirados", 40, 40);

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

    pdfdoc.save("Reporte universidad.pdf");
}