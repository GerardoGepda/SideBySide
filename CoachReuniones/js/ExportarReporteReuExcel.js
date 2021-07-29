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
    var wsg = XLSX.utils.json_to_sheet(data.Asistieron);
    wb.Sheets["Asistieron"] = wsg;

    //Creación de hoja No asistieron 
    wb.SheetNames.push("No asistieron");
    var wsh = XLSX.utils.json_to_sheet(data.Inasistieron);
    wb.Sheets["No asistieron"] = wsh;

    //Creación de hoja No inscritos
    wb.SheetNames.push("No inscritos");
    var wsi = XLSX.utils.json_to_sheet(data.No_incritos);
    wb.Sheets["No inscrtos"] = wsi;

    var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'binary' });
    saveAs(new Blob([CreateAnArrayBuffer(wbout)], { type: "application/octet-stream" }), "Reporte Reunión" + ".xlsx");
}
function ExportExcel(data){
    const btnexcel = document.querySelectorAll((".btn-excel"));
    btnexcel.forEach(btn => btn.addEventListener("click",(e)=>{
       var idU = e.target.classList[0].replace("-"," "); 
       for (const key in data) {
           if(idU === data[key].universidad) {
               //CreateExcel(data[key]);
               Convert(data[key]);
               break;             
           }              
       }       
    }));  
}
function Convert(json) {
    var resultado = [];
    for (var i in json ) {
        resultado.push([(json[i])]);
    }    
    console.log(resultado); 
}