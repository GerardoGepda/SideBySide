<?php include 'Modularidad/CabeceraInicio.php'; ?>
<title>Notas || Notas Faltantes</title>
<?php
include 'Modularidad/EnlacesCabecera.php';
include 'Modularidad/MenuHorizontal.php';
require_once '../Conexion/conexion.php';
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" type="text/css" href="css/modulos-moodle.css">
<div class="title  mb-2">
    <a href="javascript:history.back();" title=""><img src="../img/back.png" class="icon"></a>
    <h2 class="main-title">Notas faltantes</h2>
    <div class="title2">
    </div>
</div>
<div class="float-right"> <?php include 'Modularidad/Alerta.php' ?></div>
<div class="card p-2 ">
    <div class='row'>
        <div class="col-sm m-1">
            <select id="class" class="browser-default bg-light custom-select" name="class" onchange="main();">
                <option class='dropdown-item' disabled selected>Class</option>
                <?php
                foreach ($dbh->query("SELECT DISTINCT(Class) FROM alumnos ORDER BY Class DESC") as $alumnos) {
                    echo '<option value="' . $alumnos['Class'] . '">' . $alumnos["Class"] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-sm m-1">
            <select id="ciclo" class="browser-default bg-light custom-select" name="ciclo" onchange="main();">
                <option class='dropdown-item' disabled selected>Ciclo</option>
                <?php
                foreach ($dbh->query("SELECT DISTINCT cicloU FROM inscripcionciclos WHERE cicloU != '' ORDER BY cicloU ASC") as $alumnos) {
                    echo '<option value="' . $alumnos['cicloU'] . '">' . $alumnos['cicloU'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-sm m-1">
            <select id="status" class="browser-default bg-light custom-select" name="status" onchange="main();">
                <option class='dropdown-item' disabled selected>Status</option>
                <?php
                foreach ($dbh->query("SELECT DISTINCT StatusActual FROM alumnos ORDER BY StatusActual ASC") as $alumnos) {
                    echo '<option value="' . $alumnos['StatusActual'] . '">' . $alumnos['StatusActual'] . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
</div>
<div>
   <center><div id="donutchart" class="h-50 d-inline bg-light mx-auto" style="width: 55%;"></div></center>
    <div id="lista" class="d-inline h-50 w-75 mx-auto p-1" style="background-color:#ADADB2"></div>
</div>
</div>
<div style="height:300px;">

</div>
<script async src="js/notasFantantes.js"></script>
<?php include 'Modularidad/PiePagina.php'; ?>