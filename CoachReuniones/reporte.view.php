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
<div class="title  mb-2">
    <a href="javascript:history.back();" title=""><img src="../img/back.png" class="icon"></a>
    <h2 class="main-title">Reporteria Reuniones</h2>
    <div class="title2">
    </div>
</div>
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
        <div id="main" class="col-md-6 d-flex justify-content-center"></div>
        <div id="tabla" class="col-md-6 d-flex justify-content-center"></div>
    </div>
    <div id="principal" class="row"></div>
</div>

<div class="separador" id="modals"></div>


<script src="js/ReporteReunion.js"> </script>
<!-- script principal -->
<script async src="js/filtrosReunion.js"></script>
<script src="js/ExportarReporteReuExcel.js"></script>
<?php include 'Modularidad/PiePagina.php'; ?>