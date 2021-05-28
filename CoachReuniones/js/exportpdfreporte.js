window.jsPDF = window.jspdf.jsPDF;

const ExportarPDF = (datos) =>{
    const btnexportPdf = document.querySelectorAll((".btnexpPdf"));
    let universidad = [];

    btnexportPdf.forEach(btn => btn.addEventListener("click", (e) => {
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
            columns:[{
                No: "No.",
                nombre: "Alumno",
                universidad: "Universidad",
                tipo: "Tipo de materias",
                promedio: "Promedio",
                materias: "Materias"
            }],
            rows:[]
        };
        let alumnotmp = "";
        let contador = 1;
        //obteniendo datos de aprobados
        const listAprobados = universidad.listaAprobado;
        for (const key in listAprobados) {
            if (alumnotmp !== listAprobados[key].alumno) {
                alumnotmp = listAprobados[key].alumno;
                data.rows.push({
                    No: contador++,
                    nombre: listAprobados[key].alumno,
                    universidad: universidad.id,
                    tipo: "Aprobadas",
                    promedio: PromedioMaterias(listAprobados.filter(x => x.alumno === alumnotmp)),
                    materias: NombreMaterias(listAprobados.filter(x => x.alumno === alumnotmp)),
                });
            }
        }

        //obteniendo datos de retirados
        alumnotmp = "";
        const listRetirados = universidad.listaRetirado;
        for (const key in listRetirados) {
            if (alumnotmp !== listRetirados[key].alumno) {
                alumnotmp = listRetirados[key].alumno;
                data.rows.push({
                    No: contador++,
                    nombre: listRetirados[key].alumno,
                    universidad: universidad.id,
                    tipo: "Retiradas",
                    promedio: PromedioMaterias(listRetirados.filter(x => x.alumno === alumnotmp)),
                    materias: NombreMaterias(listRetirados.filter(x => x.alumno === alumnotmp)),
                });
            }
        }

        //obteniendo datos de reprobados
        alumnotmp = "";
        const listReprobados = universidad.listaReprobado;
        for (const key in listReprobados) {
            if (alumnotmp !== listReprobados[key].alumno) {
                alumnotmp = listReprobados[key].alumno;
                data.rows.push({
                    No: contador++,
                    nombre: listReprobados[key].alumno,
                    universidad: universidad.id,
                    tipo: "Reprobadas",
                    promedio: PromedioMaterias(listReprobados.filter(x => x.alumno === alumnotmp)),
                    materias: NombreMaterias(listReprobados.filter(x => x.alumno === alumnotmp)),
                });
            }
        }

        console.log(data);
        MakePDf(data)
    }));

    function PromedioMaterias(materias) {
        let promedio = 0;
        materias.forEach(materia => {
            promedio += parseFloat(materia.nota);
        });
        promedio = promedio/materias.length;
        return parseFloat(promedio).toFixed(2);
    }

    function NombreMaterias(materias) {
        let nombres = "";
        materias.forEach(materia => {
            nombres += materia.nombreMateria + ", ";   
        });

        return nombres;
    }

    function MakePDf(data) 
    {
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