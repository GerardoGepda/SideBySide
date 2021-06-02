window.jsPDF = window.jspdf.jsPDF;

const ExportarPDF = (datos) => {
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
                let contador = 1;
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
        pdfdoc.text("Lista de aprobados reprobados y retirados", 40, 20);

        //creando la tabla
        pdfdoc.autoTable({
            head: data.columns,
            body: data.rows,
        });

        pdfdoc.save("Reporte universidad.pdf");
    }
}