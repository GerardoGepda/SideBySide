function CreateAnArrayBuffer(info) {
    var buff = new ArrayBuffer(info.length); //convert info to arrayBuffer
    var view = new Uint8Array(buff);  //create uint8array as viewer
    for (var i = 0; i < info.length; i++) view[i] = info.charCodeAt(i) & 0xFF; //convert to octet
    return buff;
}

function CreateExcel(data) {
    const fecha = new Date();
    var wb = XLSX.utils.book_new();
    wb.Props = {
        Title: "Reporte Reunión",
        Subject: "Reporte",
        Author: "Coach reuniones",
        CreateDate: new Date(fecha.toLocaleString()),
    }
    //Creación para asistieron
    wb.SheetNames.push("Asistieron");
    var wsg = XLSX.utils.aoa_to_sheet(data[0]);
    wb.Sheets["Asistieron"] = wsg;

    //Creación de hoja No asistieron 
    wb.SheetNames.push("No asistieron");
    var wsh = XLSX.utils.aoa_to_sheet(data[1]);
    wb.Sheets["No asistieron"] = wsh;

    //Creación de hoja No inscritos 
    wb.SheetNames.push("No inscritos");
    var wsk = XLSX.utils.aoa_to_sheet(data[2]);
    wb.Sheets["No inscritos"] = wsk;

    var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'binary' });
    saveAs(new Blob([CreateAnArrayBuffer(wbout)], { type: "application/octet-stream" }), "Reporte Reunión" + ".xlsx");
}

function ExportExcel(data) {
    try {
        const btnexcel = document.querySelectorAll((".btn-excel"));
        btnexcel.forEach(btn => btn.addEventListener("click", (e) => {
            var idU = e.target.classList[0].replace("-", " ");
            for (const key in data) {
                if (idU === data[key].universidad) {
                    CreateExcel(PrepareArrayExcel(data[key]));
                    //PrepareArrayExcel(data[key]);
                    break;
                }
            }
        }));
    } catch (error) {
        console.log(error);
    }

}

function PrepareArrayExcel(json) {
    let result = [];
    let arrayTmp = [];
    let cont = 0;
    delete json['universidad'];

    for (const key in json) {
        arrayTmp = [];

        cont = 1;
        json[key].forEach(element => {
            arrayTmp.push([cont++, element.nombre]);
        });
        result.push(arrayTmp);
    }
    return result;
}