// declarar variables
let listaClases;
let listaCiclos;
let listaFinanciamiento;
let listaSede;
let listaStatus;

function main() {
    // extraer datos
    ciclos();
    clases();
    financiamiento();
    sede();
    getstatus();
    // fin de extraer datos

    // inicio de procesar consultas
    ShowSelected(listaCiclos, listaClases, listaFinanciamiento, listaSede, listaStatus);
    graphicsByUniversity(listaCiclos, listaClases, listaFinanciamiento, listaSede, listaStatus);
    // fin de procesar consultas

}

function GraphBarraU() {
    GetDataGraphBarU(listaCiclos, listaClases, listaFinanciamiento, listaSede, MateriasPoruniversidad, listaStatus);
}
