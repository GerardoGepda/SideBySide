<?php
include("../BaseDatos/conexion.php");
//Modularidad para inicializar el Head y <!DOCTYPE html>
include 'Modularidad/CabeceraInicio.php';

//titulo de la pagina
echo "<title>Estatus de beca</title>";

//Modularaidad para extraere los enlaces. Se cierra el Head.
include 'Modularidad/EnlacesCabecera.php';

//Incluir el menu horizontal y vertical
include 'Modularidad/MenuHorizontal.php';
include 'Modularidad/MenuVertical.php';
?>
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/Alumnos.css">
<link rel="stylesheet" type="text/css" href="css/Menu.css">
<link rel="stylesheet" href="css/styleEstatusBeca.css">
<style>
    #tablestatus_info {
        color: white !important;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light" id="row">
    <a href="javascript:history.back();"><img src="../img/back.png" class="icon"></a>
    <a class="navbar-brand" id="T1">Estatus de becas de alumnos</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<div class="statusMain">
    <div class="mx-3 my-3 d-flex flex-row-reverse">
        <button class="btn btn-danger mx-2" id="exprtToPdf"><i class="fas fa-file-pdf"></i> Exportar a PDF</button>
        <button class="btn btn-success" id="exprtToExcel"><i class="fas fa-file-excel"></i> Exportar a EXCEL</button>
    </div>
    <div class="card-body mx-3 my-3">
        <div class="table-responsive">
            <br>
            <table id="tablestatus" class="table table-hover w-100 table-sm table-bordered table-fixed">
                <thead class="table-secondary w-100">
                    <tr>
                        <th scope="col">Carnet</th>
                        <th scope="col">Alumno</th>
                        <th scope="col">Class</th>
                        <th scope="col">Sede</th>
                        <th scope="col">Universidad</th>
                        <th scope="col">Carrera</th>
                        <th scope="col">Estatus beca</th>
                        <th scope="col">F. financiamiento</th>
                        <th scope="col">Ciclo</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Historial</th>
                    </tr>
                </thead>
                <tbody class="table h-100 w-100" id="bodyTableStatus">
                </tbody>
            </table>
        </div>
        <!--Fin de la caja responsivo de la tabla-->
    </div>
</div>

<!-- jsPDF -->
<script src="js/jspdf.umd.js"></script>
<!-- jsPDF Autotable -->
<script src="js/jspdf.plugin.autotable.js"></script>
<!-- SheetJs -->
<script src="js/xlsx.full.min.js"></script>
<!-- FileSaver -->
<script src="js/FileSaver.js"></script>
<script async src="js/sciptEstatusBeca.js"></script>

<?php
//Incluir el footer
include 'Modularidad/PiePagina.php';
?>