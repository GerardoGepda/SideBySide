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
<link rel="stylesheet" type="text/css" href="css/Renovacion.css">
<link rel="stylesheet" type="text/css" href="css/Menu.css">
<link rel="stylesheet" href="css/main.css">
<!-- style para select multiple -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">

<!-- color de elementos seleccionados -->
<style>
    .choices__list--multiple .choices__item {
        background-color: #BE0032;
        border: 1px solid #BE0032;
    }

    .choices[data-type*="select-multiple"] .choices__button, .choices[data-type*="text"] .choices__button {
        border-left: 1px solid black;
    }

    
    .img-responsive{
        width: 90px;
        height: 90px;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light" id="row">
    <a href="javascript:history.back();"><img src="../img/back.png" class="icon"></a>
    <a class="navbar-brand" id="T1">REPORTE REUNIONES - CICLO</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
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
        <div class="col-md-3 my-1">
            <select class="browser-default bg-light custom-select clases" id="choices-multiple-remove-button-class" placeholder="Seleccionar class" multiple>
            </select> 
        </div>
        <div class="col-md-3 my-1">
            <select class="browser-default bg-light custom-select sedes" id="choices-multiple-remove-button" placeholder="Seleccionar sede" multiple>
                <option value="SSFT">SSFT</option>
                <option value="SAFT">SAFT</option>
            </select> 
        </div>
        <div class="col-md-3 my-1">
            <select class="browser-default bg-light custom-select financiamientos" id="choices-multiple-remove-button" placeholder="Financiamiento" multiple>
                <option value="FGK">FGK</option>
                <option value="FOM">FOM</option>
                <option value="Borja">Borja</option>
            </select> 
        </div>
        <div class="col-md-3 my-1">
            <select id="ciclo" class="browser-default bg-light custom-select" style="height: 47.25px !important;" onchange="procesar();">
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

<!-- script para select multiple -->
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>

<!-- script para select multiple -->
<script>
    $(document).ready(function(){

    var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
    removeItemButton: true,
    maxItemCount:5,
    searchResultLimit:5,
    renderChoiceLimit:5
    });
    
    });
</script>

<?php include 'Modularidad/PiePagina.php'; ?>