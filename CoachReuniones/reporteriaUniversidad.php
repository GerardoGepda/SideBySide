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
<!-- jsPDF -->
<script src="js/jspdf.umd.js"></script>
<!-- jsPDF Autotable -->
<script src="js/jspdf.plugin.autotable.js"></script>
<!-- SheetJs -->
<script src="js/xlsx.full.min.js"></script>
<!-- FileSaver -->
<script src="js/FileSaver.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" type="text/css" href="css/Renovacion.css">
<div class="title mb-2">
    <a href="javascript:history.back();"><img src="../img/back.png" class="icon"></a>
    <h2 class="main-title">Reporteria Universidad</h2>
</div>
<div class="container-fluid text-center">
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
                                <input class="form-check-input" type="checkbox" id="checkbox1">Select All</input>
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
                                <input class="form-check-input" type="checkbox" id="checkbox2">Select All</input>
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
                                <option value="Financiamiento Propio" class="dropdown-item">Financiamiento propio</option>
                            </select>
                            <input class="form-check-input" type="checkbox" id="checkbox3">Select All</input>
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
                            <input class="form-check-input" type="checkbox" id="checkbox4">Select All</input>
                        </div>
                    </fieldset>
                </div>
            </div>
        </form>
    </div>
    <!-- fin de filtros -->

    <!-- cargar los contenedores por medio de este identificador -->
    <div id="loader">

    </div>

</div>

<div class="title">
    <a href="javascript:history.back();"><i class="fas fa-university icon text-dark fs-1"></i></a>
    <h2 class="main-title">Graphics By University</h2>
</div>

<div class="container d-flex justify-content-center" style="margin-top: -65px;">
    <div class="form-group w-50">
        <label for="searchUGraph" class="text-dark">Seleccione universidad</label>
        <select class="form-control" id="searchUGraph">
            <option>Mostrar todas</option>
        </select>
    </div>
</div>
<div id="universidades"> </div>

<div id="showData" style="display: hidden;"></div>

<br><br><br><br><br><br>

<!-- proceso de graficas -->
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<!-- cargar tabla  -->
<script src="./js/tablaMain.js"></script>
<!-- grafica tipo pais  -->
<script src="./js/graficas.js"></script>
<!-- grafica general -->
<script src="./js/graficaGeneral.js"></script>
<!-- anclar los id de filtros -->
<script src="./js/filtros.js"></script>
<!-- grafica por sexo -->
<script src="./js/graficBySex.js"></script>
<script async src="./js/main.js"></script>
<!-- Script del filtro por universidad -->
<script src="./js/filtroUniversidad.js"></script>
<!-- js para exportar pdf -->
<script src="js/exportpdfreporte.js"></script>
<!-- js para exportar a Excel -->
<script src="js/exportexcelreporte.js"></script>

<!-- fin de proceso de  graficas -->
<!-- **************************************** Fin de estructura de trabajo **************************** -->

<?php include 'Modularidad/PiePagina.php'; ?>