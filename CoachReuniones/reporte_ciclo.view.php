<?php include 'Modularidad/CabeceraInicio.php'; ?>
<title>Reporteria || Reuniones</title>
<?php
include 'Modularidad/EnlacesCabecera.php';
include 'Modularidad/MenuHorizontal.php';
require_once '../Conexion/conexion.php';
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" type="text/css" href="css/modulos-moodle.css">
<link rel="stylesheet" type="text/css" href="css/reporte.view.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" type="text/css" href="css/Alumnos.css">
<link rel="stylesheet" type="text/css" href="css/Menu.css">
<link rel="stylesheet" href="css/main.css">
<nav class="navbar navbar-expand-lg navbar-light" id="row">
    <a href="javascript:history.back();"><img src="../img/back.png" class="icon"></a>
    <a class="navbar-brand" id="T1">REPORTE REUNIONES</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item" id="bloque">
                <a class="nav-link" href="RecordAlumnos.php">
                    REPORTE CICLO
                </a>
            </li>
        </ul>
    </div>
</nav>
<div class="float-right"> <?php include 'Modularidad/Alerta.php' ?></div>
<div class="card p-2 ">
    <div class='row'>
        <div class="col-sm m-1">
            <select id="clase" class="browser-default bg-light custom-select">
                <option class='dropdown-item' disabled selected>Class</option>
            </select>
        </div>
        <div class="col-sm m-1">
            <select id="ciclo" class="browser-default bg-light custom-select" onchange="procesar();">
                <option class='dropdown-item' disabled selected>Ciclo</option>
            </select>
        </div>
    </div>
</div>

<div class="card p-1">
    <div class="row p-1 datos m-1 p-1">
        <div id="main" class="col-md-6 d-flex justify-content-center"></div>
        <div id="tabla" class="col-md-6 d-flex justify-content-center"></div>
    </div>
    <div id="principal" class="row"></div>

</div>

<div class="separador" id="modals"></div>

<!-- jsPDF -->
<script src="js/jspdf.umd.js"></script>
<!-- jsPDF Autotable -->
<script src="js/jspdf.plugin.autotable.js"></script>
<!-- SheetJs -->
<script src="js/xlsx.full.min.js"></script>
<!-- FileSaver -->
<script src="js/FileSaver.js"></script>

<script src="js/reporteCiclo.js"></script>
<!-- sweet alert cdn -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- script principal -->
<script src="js/ExportarReporteReuExcel.js"></script>
<script src="js/ExportarReporteReuPdf.js"></script>
<?php include 'Modularidad/PiePagina.php'; ?>