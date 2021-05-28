const ExportarEXCEL = (datos) =>{
    const btnexportExcel = document.querySelectorAll((".btnexpExcel"));
    let universidad = [];

    btnexportExcel.forEach(btn => btn.addEventListener("click", (e) => {
        //extraemos el id de la universidad del btn
        const idU = e.target.classList[0].replace("-", " ");
        //filtramos los datos para la U seleccionada
        for (const U in datos) {
            if (datos[U].id === idU) {
                universidad = datos[U];
                break;
            }
        }

        let data = [
            ["No.", "Alumno", "Universidad", "Tipo de materias","Promedio", "Materias"],
        ];

        let alumnotmp = "";
        let contador = 1;
        //obteniendo datos de aprobados
        const listAprobados = universidad.listaAprobado;
        for (const key in listAprobados) {
            if (alumnotmp !== listAprobados[key].alumno) {
                alumnotmp = listAprobados[key].alumno;
                data.push([
                    contador++,
                    listAprobados[key].alumno,
                    universidad.id,
                    "Aprobadas",
                    PromedioMaterias(listAprobados.filter(x => x.alumno === alumnotmp)),
                    NombreMaterias(listAprobados.filter(x => x.alumno === alumnotmp))
                ]);
            }
        }

        //obteniendo datos de retirados
        alumnotmp = "";
        const listRetirados = universidad.listaRetirado;
        for (const key in listRetirados) {
            if (alumnotmp !== listRetirados[key].alumno) {
                alumnotmp = listRetirados[key].alumno;
                data.push([
                    contador++,
                    listRetirados[key].alumno,
                    universidad.id,
                    "Retiradas",
                    PromedioMaterias(listRetirados.filter(x => x.alumno === alumnotmp)),
                    NombreMaterias(listRetirados.filter(x => x.alumno === alumnotmp))
                ]);
            }
        }

        //obteniendo datos de reprobados
        alumnotmp = "";
        const listReprobados = universidad.listaReprobado;
        for (const key in listReprobados) {
            if (alumnotmp !== listReprobados[key].alumno) {
                alumnotmp = listReprobados[key].alumno;
                data.push([
                    contador++,
                    listReprobados[key].alumno,
                    universidad.id,
                    "Reprobadas",
                    PromedioMaterias(listReprobados.filter(x => x.alumno === alumnotmp)),
                    NombreMaterias(listReprobados.filter(x => x.alumno === alumnotmp))
                ]);
            }
        }
        
        MakeExcel(data);
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

    const fecha = new Date();

    function CreateAnArrayBuffer(info) {
        var buff = new ArrayBuffer(info.length); //convert info to arrayBuffer
        var view = new Uint8Array(buff);  //create uint8array as viewer
        for (var i=0; i<info.length; i++) view[i] = info.charCodeAt(i) & 0xFF; //convert to octet
        return buff;    
    }

    function MakeExcel(data) {
        var wb = XLSX.utils.book_new();
        wb.Props = {
            Title: "Reporte Universidad" + data[1][2],
            Subject: "Reporte",
            Author: "Coach reuniones",
            CreateDate: new Date(fecha.toLocaleString())
        }

        wb.SheetNames.push("hoja reporte");
        var ws = XLSX.utils.aoa_to_sheet(data);
        wb.Sheets["hoja reporte"] = ws;

        var wbout = XLSX.write(wb, {bookType:'xlsx',  type: 'binary'});

        //Guardando el archivo. data[1][2] representa las siglas de la universidad
        saveAs(new Blob([CreateAnArrayBuffer(wbout)],{type:"application/octet-stream"}), "Reporte " + data[1][2] +".xlsx");
    }
}