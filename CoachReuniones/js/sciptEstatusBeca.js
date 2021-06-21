$(document).ready(function () {
    window.jsPDF = window.jspdf.jsPDF;

    //petición fetch para extraer datos de estatus de becas
    fetch(
        "Modelo/ModeloReportes/ModelUniversidad/estadosBecas.php", {
        method: 'POST', // or 'PUT'
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(json => {
        CreateTableData(json.alumnos);
    })
    .catch(function(error) {
        console.log('Hubo un problema con la petición Fetch:' + error.message);
    });

    //eventos para botones de exportación
    const btnExportExcel = document.getElementById('exprtToExcel');
    btnExportExcel.addEventListener('click', ExportEXCEL);

    const btnExportPdf = document.getElementById('exprtToPdf');
    btnExportPdf.addEventListener('click', ExportPDF);
    

});

function CreateTableData(data) {

    let templete = '';

    data.forEach(element => {
        templete += `
            <tr class='table-light'>
                <td>${element[0]}</td>
                <td>${element[1]}</td>
                <td>${element[2]}</td>
                <td>${element[3]}</td>
                <td>${element[6]}</td>
                <td>${element[5]}</td>
                <td>${element[7]}</td>
                <td>${element[4]}</td>
                <td>${element[10]}</td>
                <td>
                    ${new Date(element[8]).toLocaleString('en-US',{
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric',
                    })}
                </td>
                <td><a class="btn" Style="background-color: rgb(157, 18, 14); color: white;" href="Renovacion.php?id=${element.IDalumno}"><i class="fas fa-history"></i></a></td>
            </tr>
            `;
    });

    const tBodyStatus = document.getElementById('bodyTableStatus');
    tBodyStatus.innerHTML = templete;

    var table = $('#tablestatus').DataTable({
        "scrollX": true,
        "scrollY": "50vh",
        //Esto sirve que se auto ajuste la tabla al aplicar un filtro
        "scrollCollapse": true,
        language: {
            "processing": "Procesando...",
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "infoThousands": ",",
            "loadingRecords": "Cargando...",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad",
                "collection": "Colección",
                "colvisRestore": "Restaurar visibilidad",
                "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                "copySuccess": {
                    "1": "Copiada 1 fila al portapapeles",
                    "_": "Copiadas %d fila al portapapeles"
                },
                "copyTitle": "Copiar al portapapeles",
                "csv": "CSV",
                "excel": "Excel",
                "pageLength": {
                    "-1": "Mostrar todas las filas",
                    "1": "Mostrar 1 fila",
                    "_": "Mostrar %d filas"
                },
                "pdf": "PDF",
                "print": "Imprimir"
            },
            "autoFill": {
                "cancel": "Cancelar",
                "fill": "Rellene todas las celdas con <i>%d<\/i>",
                "fillHorizontal": "Rellenar celdas horizontalmente",
                "fillVertical": "Rellenar celdas verticalmentemente"
            },
            "decimal": ",",
            "searchBuilder": {
                "add": "Añadir condición",
                "button": {
                    "0": "Constructor de búsqueda",
                    "_": "Constructor de búsqueda (%d)"
                },
                "clearAll": "Borrar todo",
                "condition": "Condición",
                "conditions": {
                    "date": {
                        "after": "Despues",
                        "before": "Antes",
                        "between": "Entre",
                        "empty": "Vacío",
                        "equals": "Igual a",
                        "notBetween": "No entre",
                        "notEmpty": "No Vacio",
                        "not": "Diferente de"
                    },
                    "number": {
                        "between": "Entre",
                        "empty": "Vacio",
                        "equals": "Igual a",
                        "gt": "Mayor a",
                        "gte": "Mayor o igual a",
                        "lt": "Menor que",
                        "lte": "Menor o igual que",
                        "notBetween": "No entre",
                        "notEmpty": "No vacío",
                        "not": "Diferente de"
                    },
                    "string": {
                        "contains": "Contiene",
                        "empty": "Vacío",
                        "endsWith": "Termina en",
                        "equals": "Igual a",
                        "notEmpty": "No Vacio",
                        "startsWith": "Empieza con",
                        "not": "Diferente de"
                    },
                    "array": {
                        "not": "Diferente de",
                        "equals": "Igual",
                        "empty": "Vacío",
                        "contains": "Contiene",
                        "notEmpty": "No Vacío",
                        "without": "Sin"
                    }
                },
                "data": "Data",
                "deleteTitle": "Eliminar regla de filtrado",
                "leftTitle": "Criterios anulados",
                "logicAnd": "Y",
                "logicOr": "O",
                "rightTitle": "Criterios de sangría",
                "title": {
                    "0": "Constructor de búsqueda",
                    "_": "Constructor de búsqueda (%d)"
                },
                "value": "Valor"
            },
            "searchPanes": {
                "clearMessage": "Borrar todo",
                "collapse": {
                    "0": "Paneles de búsqueda",
                    "_": "Paneles de búsqueda (%d)"
                },
                "count": "{total}",
                "countFiltered": "{shown} ({total})",
                "emptyPanes": "Sin paneles de búsqueda",
                "loadMessage": "Cargando paneles de búsqueda",
                "title": "Filtros Activos - %d"
            },
            "select": {
                "1": "%d fila seleccionada",
                "_": "%d filas seleccionadas",
                "cells": {
                    "1": "1 celda seleccionada",
                    "_": "$d celdas seleccionadas"
                },
                "columns": {
                    "1": "1 columna seleccionada",
                    "_": "%d columnas seleccionadas"
                }
            },
            "thousands": ".",
            "datetime": {
                "previous": "Anterior",
                "next": "Proximo",
                "hours": "Horas",
                "minutes": "Minutos",
                "seconds": "Segundos",
                "unknown": "-",
                "amPm": [
                    "am",
                    "pm"
                ]
            },
            "editor": {
                "close": "Cerrar",
                "create": {
                    "button": "Nuevo",
                    "title": "Crear Nuevo Registro",
                    "submit": "Crear"
                },
                "edit": {
                    "button": "Editar",
                    "title": "Editar Registro",
                    "submit": "Actualizar"
                },
                "remove": {
                    "button": "Eliminar",
                    "title": "Eliminar Registro",
                    "submit": "Eliminar",
                    "confirm": {
                        "_": "¿Está seguro que desea eliminar %d filas?",
                        "1": "¿Está seguro que desea eliminar 1 fila?"
                    }
                },
                "error": {
                    "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
                },
                "multi": {
                    "title": "Múltiples Valores",
                    "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
                    "restore": "Deshacer Cambios",
                    "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
                }
            },
            "info": "Mostrando de _START_ a _END_ de _TOTAL_ entradas"
        },
        initComplete: function () {
                //En el columns especificamos las columnas que queremos que tengan filtro
                this.api().columns([0, 1, 2, 3, 4, 5, 6, 7, 8, 9]).every(function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo($(column.header()))
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val().trim()
                            );
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
                    column.data().unique().sort().each(function (d, j) {
                        // select.append('<option value="' + d + '">' + d + '</option>')

                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            },
            "aoColumnDefs": [{
                "bSearchable": false
            }]
    });
    //****Esta bendita linea hace la magia, adjusta el header de la tabla con el body
    table.columns.adjust();
}

function table_to_array(table_id) {
    const myData = document.getElementById(table_id).rows
    my_liste = []
    for (var i = 0; i < myData.length; i++) {
            el = myData[i].children
            my_el = []
            for (var j = 0; j < el.length; j++) {
                    my_el.push(el[j].innerText);
            }
            my_liste.push(my_el)

    }
    return my_liste
}

function CreateAnArrayBuffer(info) {
    var buff = new ArrayBuffer(info.length); //convert info to arrayBuffer
    var view = new Uint8Array(buff);  //create uint8array as viewer
    for (var i=0; i<info.length; i++) view[i] = info.charCodeAt(i) & 0xFF; //convert to octet
    return buff;    
}

function ExportEXCEL() {
    var wb = XLSX.utils.book_new();
    wb.Props = {
        Title: "Reporte estatus de beca",
        Subject: "Reporte",
        Author: "Coach reuniones",
    }

    let data = table_to_array('tablestatus');
    data.shift();
    const field = ["Carnet", "Alumno", "Class", "Sede", "Universidad", "Carrera", "Estatus", "Financiamiento", "Ciclo", "Fecha"];
    data.unshift(field);

    wb.SheetNames.push("Test Sheet2");
    var ws = XLSX.utils.aoa_to_sheet(data);
    wb.Sheets["Test Sheet2"] = ws;

    var wbout = XLSX.write(wb, {bookType:'xlsx',  type: 'binary'});

    //Guardando el archivo
    saveAs(new Blob([CreateAnArrayBuffer(wbout)],{type:"application/octet-stream"}), "Reporte estatus de beca.xlsx");
}

function ExportPDF() {

    const data = table_to_array('tablestatus');
    data.shift();
    const header = ["Carnet", "Alumno", "Class", "Sede", "Universidad", "Carrera", "Estatus", "Financiamiento", "Ciclo", "Fecha"];

    var pdfdoc = new jsPDF({
        unit: "pt",
        orientation: "landscape"
    });
    pdfdoc.setFontSize(12);
    pdfdoc.setTextColor(0);
    pdfdoc.text("Lista de alumnos con estatus de beca cancelada y declinados", 40, 40);

    pdfdoc.autoTable({
        head: [header],
        body: data,
        theme: 'grid',
        headStyles: {
            fillColor: [157, 18, 14],
        },
        margin: {top: 60},
    });

    pdfdoc.save("Reporte estatus de beca.pdf");
}