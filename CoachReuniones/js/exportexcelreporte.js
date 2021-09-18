
function exportar() {
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
                let pdf = document.getElementById("excelexport");

                pdf.innerHTML = `<i class="fas fa-spinner " id="rotate" ></i>`;
                setTimeout(() => {
                    pdf.innerHTML = `<i class="fas fa-file-excel"></i>`;
                    //vector con los id o carnets de los alumnos
                    let idsAlmunos = [];
                    let listaA = [], listaB = [], listaC = []
                    //obteniendo datos de aprobados
                    for (const key in datos) {
                        listaA.push(datos[key].listaAprobado);
                    }
                    for (const key in datos) {
                        listaB.push(datos[key].listaRetirado);
                    }
                    for (const key in datos) {
                        listaC.push(datos[key].listaReprobado);
                    }

                    for (const key in listaA.flat()) {
                        //añade el carnet o id a nuestro vector de ids
                        if (!idsAlmunos.includes(listaA.flat()[key].idAlumno)) {
                            idsAlmunos.push(listaA.flat()[key].idAlumno);
                        }
                    }
                    if (listaB) {
                        for (const key in listaB.flat()) {
                            //añade el carnet o id a nuestro vector de ids
                            if (!idsAlmunos.includes(listaB.flat()[key].idAlumno)) {
                                idsAlmunos.push(listaB.flat()[key].idAlumno);
                            }
                        }
                    }
                    if (listaC) {
                        for (const key in listaC.flat()) {
                            //añade el carnet o id a nuestro vector de ids
                            if (!idsAlmunos.includes(listaC.flat()[key].idAlumno)) {
                                idsAlmunos.push(listaC.flat()[key].idAlumno);
                            }
                        }
                    }
                    ExtraerInfoPorCiclo(idsAlmunos.map(x => "'" + x.toString() + "'"), "General");
                }, 5000);

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

        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log("some error in ajax" + "\n" + XMLHttpRequest + "\n" + textStatus + "\n" + errorThrown);
        }
    })

}


const ExportarEXCEL = (datos) => {
    const btnexportExcel = document.querySelectorAll((".btnexpExcel"));
    let universidad = [];

    btnexportExcel.forEach(btn => btn.addEventListener("click", (e) => {

        let icon = `<i class="fas fa-spinner " id="rotate" ></i>`;
        btn.innerHTML = icon;
        setTimeout(() => {
            //extraemos el id de la universidad del btn
            const idU = e.target.classList[0].replace("-", " ");
            //filtramos los datos para la U seleccionada
            for (const U in datos) {
                if (datos[U].id === idU) {
                    universidad = datos[U];
                    break;
                }
            }

            //vector con los id o carnets de los alumnos
            let idsAlmunos = [];

            //obteniendo datos de aprobados
            const listAprobados = universidad.listaAprobado;
            for (const key in listAprobados) {
                //añade el carnet o id a nuestro vector de ids
                if (!idsAlmunos.includes(listAprobados[key].idAlumno)) {
                    idsAlmunos.push(listAprobados[key].idAlumno);
                }
            }

            //obteniendo datos de retirados
            const listRetirados = universidad.listaRetirado;
            for (const key in listRetirados) {
                //añade el carnet o id a nuestro vector de ids
                if (!idsAlmunos.includes(listRetirados[key].idAlumno,)) {
                    idsAlmunos.push(listRetirados[key].idAlumno,);
                }
            }

            //obteniendo datos de reprobados
            const listReprobados = universidad.listaReprobado;
            for (const key in listReprobados) {
                //añade el carnet o id a nuestro vector de ids
                if (!idsAlmunos.includes(listReprobados[key].idAlumno)) {
                    idsAlmunos.push(listReprobados[key].idAlumno);
                }
            }

            try {
                ExtraerInfoPorCiclo(idsAlmunos.map(x => "'" + x.toString() + "'"), universidad.id);
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Time Out',
                    text: error,
                    footer: '<b>Intente de nuevo dentro de unos segundos</b>'
                });
            }
            btn.innerHTML = `<i class="fas fa-file-excel"></i>`;
        }, 5000);
    }));
}
function ExtraerInfoPorCiclo(ids, idU) {
    const datos = {
        idalumnos: ids,
        ciclos: listaCiclos
    }

    $.ajax({
        type: "POST",
        url: "Modelo/ModeloReportes/ModelUniversidad/infoPorCiclo.php",
        data: datos,
        success: function (response) {
            try {
                datosExcel = JSON.parse(response);
                const datosGeneral = datosExcel.general;

                //Recorremos todos los alumnos del primer array general
                const datoGeneralMerge = datosGeneral[0].map((x) => {
                    //recorremos todos los demás arrays en la info general
                    for (const key in datosGeneral) {
                        //con esta validación evitamos repetir info del primer vector
                        if (key !== "0") {
                            //buscamos nota del alumno en la actual iteración y si hay nota la agregamps
                            //de lo contrario pondremos "NA"
                            const datoEncontrado = datosGeneral[key].find(element => element[0] === x[0]);
                            if (datoEncontrado !== undefined) {
                                x.push(parseFloat(datoEncontrado[1]).toFixed(2));
                            } else {
                                x.push("NA");
                            }
                        }
                    }
                    return x;
                });

                datosExcel.general = datoGeneralMerge;
                datosExcel.general.unshift(["ID", "Alumno", "Correo", "Universidad", "Class", "Estatus", "Financiamiento"].concat(listaCiclos));
                datosExcel.reprobadas.unshift(["ID", "Alumno", "Correo", "Universidad", "Class", "Estatus", "Financiamiento", "Estatus", "Ciclo", "Materias", "Cantidad"]);
                datosExcel.retiradas.unshift(["ID", "Alumno", "Correo", "Universidad", "Class", "Estatus", "Financiamiento", "Estatus", "Ciclo", "Materias", "Cantidad"]);
                MakeExcel(datosExcel, idU);
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Time Out',
                    text: error,
                    footer: '<b>Intente de nuevo dentro de unos segundos</b>'
                });
            }
        }, error: function (xhr, ajaxOptions, thrownError) {
            Swal.fire({
                icon: 'error',
                title: 'Time Out',
                text: "HTTP REQUEST ERROR",
                footer: '<b>Contacte con los administradores del sistema</b>'
            });
        }
    });
}

const fecha = new Date();

function CreateAnArrayBuffer(info) {
    var buff = new ArrayBuffer(info.length); //convert info to arrayBuffer
    var view = new Uint8Array(buff);  //create uint8array as viewer
    for (var i = 0; i < info.length; i++) view[i] = info.charCodeAt(i) & 0xFF; //convert to octet
    return buff;
}

function MakeExcel(data, UId) {
    var wb = XLSX.utils.book_new();
    wb.Props = {
        Title: "Reporte Universidad" + UId,
        Subject: "Reporte",
        Author: "Coach reuniones",
        CreateDate: new Date(fecha.toLocaleString()),
    }

    wb.SheetNames.push("General");
    var wsg = XLSX.utils.aoa_to_sheet(data.general);
    wb.Sheets["General"] = wsg;

    wb.SheetNames.push("Reprobados");
    var wsrp = XLSX.utils.aoa_to_sheet(data.reprobadas);
    wb.Sheets["Reprobados"] = wsrp;

    wb.SheetNames.push("Retirados");
    var wsrt = XLSX.utils.aoa_to_sheet(data.retiradas);
    wb.Sheets["Retirados"] = wsrt;

    var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'binary' });

    //Guardando el archivo
    saveAs(new Blob([CreateAnArrayBuffer(wbout)], { type: "application/octet-stream" }), "Reporte " + UId + ".xlsx");
}