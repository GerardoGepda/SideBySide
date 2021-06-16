    // declarar variables
    let listaClases;
    let listaCiclos;
    let listaFinanciamiento;
    let listaSede;

    function main() {
        // extraer datos
        ciclos();
        clases();
        financiamiento();
        sede();
        // inicio de procesar consultas
        ShowSelected(listaCiclos, listaClases, listaFinanciamiento, listaSede);
        // fin de procesar consultas
        // cargar tabla
        ObtenerDatos(listaCiclos, listaClases, listaFinanciamiento, listaSede);
        // cargar graficas por universidad
        graphicsByUniversity(listaCiclos, listaClases, listaFinanciamiento, listaSede);
    }

    function GraphBarraU() {
        GetDataGraphBarU(listaCiclos, listaClases, listaFinanciamiento, listaSede, MateriasPoruniversidad);
    }