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
                <a class="nav-link" href="reporte_ciclo.view.php">
                    REPORTE CICLO
                </a>
            </li>
            <li id="anuncio" class="navbar navbar-dark bg-dark">

                <label class="text-uppercase" style="font-size: 15px;">Anuncio</label>
            </li>
            <li class="navbar">
                <label class="text-uppercase" style="color: black;">
                    <marquee behavior="Slide"> Los datos que se muestran aquí son solo de alumnos becados</marquee>
                </label>
            </li>
        </ul>
    </div>
</nav>
<div class="float-right"> <?php include 'Modularidad/Alerta.php' ?></div>
<div class="card p-2 ">
    <div class='row'>
        <div class="col-sm m-1">
            <select id="class" class="browser-default bg-light custom-select" onchange="ciclos();">
                <option class='dropdown-item' disabled selected>Tipo</option>
                <option value="Charla Informativa" title="Tienen cupo ilimitado">Charla Informativa</option>
                <option value="Reunión General" title="Tienen cupo ilimitado">Reunión General</option>
                <option value="Sesión individual" title="Tienen un horario único por cupo">Sesión individual</option>
                <option value="Otro" title="Tienen un horario único por cupo">Otro</option>
                <option value="Sesión Grupal" title="Las Sesiones grupales tiene el mismo horario pero tienen definido la cantidad de inscripción disponible">Sesión Grupal</option>
            </select>
        </div>
        <div class="col-sm m-1">
            <select id="ciclo" class="browser-default bg-light custom-select" onchange="nombre();">
                <option class='dropdown-item' disabled selected>Ciclo</option>
            </select>
        </div>
        <div class="col-sm m-1">
            <select id="nombre" class="browser-default bg-light custom-select" onchange="procesar();">
                <option class='dropdown-item' disabled selected>Nombre</option>
            </select>
        </div>
    </div>
</div>
<div class="card p-1">
    <div class="row p-1 datos m-1 p-1">
        <div id="main" class="col-md-5 d-flex justify-content-center"></div>
        <div id="tabla" class="col-md-7 d-flex justify-content-center" style="width: 100%;"></div>
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

<script src="js/ReporteReunion.js"> </script>

<!-- sweet alert cdn -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- script principal -->
<script src="js/ExportarReporteReuExcel.js"></script>
<script src="js/ExportarReporteReuPdf.js"></script>
<script src="js/filtrosReunion.js"></script>
<?php include 'Modularidad/PiePagina.php'; ?>