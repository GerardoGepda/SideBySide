<title>Reportería</title>
<?php
//Realizamos la conexión con la base de datos
include 'Modularidad/CabeceraInicio.php';
include "../BaseDatos/conexion.php";
//Modularaidad para extraere los enlaces en HEAD
include 'Modularidad/CabeceraReporteria.php';
//Incluir el menu horizontal
include 'Modularidad/MenuHorizontal.php';
// consulta para obtener los ciclos

//INICIO DE  CONSULTAS PARA FILTROS
$stmt = $pdo->query("SELECT DISTINCT cicloU FROM inscripcionciclos ORDER BY cicloU ASC");
$stmt->execute();

// consulta para obtener las clases
$stmt2 = $pdo->query("SELECT DISTINCT Class FROM alumnos ORDER BY Class ASC");
$stmt2->execute();

// consulta para obtener las sede
$stmt3 = $pdo->query("SELECT DISTINCT ID_Sede FROM alumnos ORDER BY Class ASC");
$stmt3->execute();

$sql = "SELECT * FROM empresas WHERE Tipo = 'Universidad' ";

// ejecucion de consultas
$query = $pdo->prepare($sql);
$query->execute();
$cantidad = $query->rowCount();

// FIN DE CONSULTAS PARA FILTROS

?>
<link rel="stylesheet" type="text/css" href="css/Renovacion.css">
<div class="title mb-2">
    <a href="javascript:history.back();"><img src="../img/back.png" class="icon"></a>
    <h2 class="main-title">Reporteria Universidad</h2>
</div>
<div class="container-fluid text-center">
    <!-- inicio de librerias y esitlo -->
    <?php include "../CoachReuniones/Modelo/ModeloReportes/ModelUniversidad/librerias.php"; ?>
    <!-- fin de librerias y esitlo -->

    <!-- **************************************** Inicio de estructura de trabajo **************************** -->
    <!-- inicio de filtros -->
    <div id="filtros">
        <form>
            <div class="row tex-center">
                <div class="col" id="filtro1">
                    <fieldset>
                        <div class="mb-1">
                            <label class="form-label">Ciclo</label>
                            <div class="pl-3 tex-center">
                                <select class="js-example-basic-single form-control" id="ciclo" multiple="multiple" onchange=" main(), GraphBarraU()">
                                    <?php
                                    while ($row = $stmt->fetch()) {
                                        echo "<option >" . $row['cicloU'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col" id="filtro2">
                    <fieldset>
                        <div class="mb-1">
                            <label class="form-label">Class</label>
                            <div class="tex-center">
                                <select class="js-example-basic-single form-control" id="clase" multiple="multiple" onchange=" main(), GraphBarraU()">
                                    <?php
                                    while ($row2 = $stmt2->fetch()) {
                                        echo "<option>" . $row2['Class'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col" id="filtro3">
                    <fieldset>
                        <div class="mb-1 tex-center">
                            <label class="form-label">Financiamiento</label>
                            <select class="form-select form-control" id="financiamiento" multiple="" onchange=" main(), GraphBarraU()">
                                <option value="FGK" class="dropdown-item">FGK</option>
                                <option value="BORJA" class="dropdown-item">BORJA</option>
                                <option value="FOM" class="dropdown-item">FOM</option>
                                <option value="Financiamiento Propio" class="dropdown-item">Financiamiento propio
                                </option>
                            </select>
                        </div>
                    </fieldset>
                </div>
                <div class="col" id="filtro3">
                    <fieldset>
                        <div class="mb-1 w-75 pl-3">
                            <label class="form-label">Sede</label>
                            <select class="form-select form-control" id="sede" multiple="" onchange=" main(), GraphBarraU()">
                                <?php
                                while ($row3 = $stmt3->fetch()) {
                                    echo "<option>" . $row3['ID_Sede'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </fieldset>
                </div>
            </div>
        </form>
    </div>
    <!-- fin de filtros -->

    <!-- graficas generales -->
    <div id="content3">
        <div id="middle-pie"></div>
        <div id="generalTable">
            <table class="table table-striped table-dark" id="tablaGeneral">
                <thead>
                    <tr>
                        <th scope="col">Universidad</th>
                        <th scope="col">Materias Aprobados</th>
                        <th scope="col">Materias Reprobados</th>
                        <th scope="col">Materias Retiradas</th>
                    </tr>
                </thead>
                <tbody id="TableBody" class="table-light text-dark table-hover table-striped">
                </tbody>
            </table>
        </div>
    </div>
    <!-- fin de graficas generales -->
    <div id="maps">
        <div id="content">
            <!-- inicio de contenedores de mapas -->
            <div id="map1" class="loading"></div>
            <div id="map2" class="loading"></div>
            <!-- fin de contenedores de mapas -->
        </div>
    </div>
    <div id="maps">
        <div id="content2">
            <!-- inicio de contenedores de graficas por sexo -->
            <h3>Grafica por Género</h3>
            <figure class="highcharts-figure">
                <div id="gen"></div>
            </figure>
            <figure class="highcharts-figure">
                <div id="gen2"></div>
            </figure>
            <!-- fin de contenedores de graficas por sexo -->
        </div>
    </div>
</div>
<div class="title ">
    <a href="javascript:history.back();"><i class="fas fa-university icon text-dark fs-1"></i></a>
    <h2 class="main-title">Graphics By University</h2>
</div>
<br>
<br>
<div id="Ugraph">
</div>
<div id="universidades">

</div>
<br>
<br>
<!-- proceso de graficas -->
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<!-- cargar tabla  -->
<script async src="./js/tablaMain.js"></script>
<!-- grafica tipo pais  -->
<script async src="./js/graficas.js"></script>
<!-- grafica general -->
<script src="./js/graficaGeneral.js"></script>
<!-- anclar los id de filtros -->
<script async src="./js/filtros.js"></script>
<!-- grafica por sexo -->
<script async src="./js/graficBySex.js"></script>
<script type="text/javascript">
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
</script>
<!-- datatable -->
<script>
    $(document).ready(function() {
        $(document).ready(function() {
            $('#tablaGeneral').DataTable({
                "ordering": false,
                "bFilter": false,
                "scrollY": 100,
                "bPaginate": false,
                "bLengthChange": false,
                "bInfo": false,
                "bAutoWidth": false
            });
        });
        //MateriasPoruniversidad();
    });
</script>
<script>

</script>
<script src="../Alumno/JS/datatable.js"></script>

<!-- fin de proceso de  graficas -->
<!-- **************************************** Fin de estructura de trabajo **************************** -->

<?php
//Incluir el footer
include 'Modularidad/PiePagina.php'; ?>