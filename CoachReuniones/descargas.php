<?php
//Modularidad para inicializar el Head y <!DOCTYPE html>
include 'Modularidad/CabeceraInicio.php';
?>
<?php include("../BaseDatos/conexion.php"); //Realizamos la conexión con la base de datos
?>

<title>Descargas-Renovación</title>

<?php
//Modularaidad para extraere los enlaces en HEAD
include 'Modularidad/EnlacesCabecera.php';
//Incluir el menu horizontal
include 'Modularidad/MenuHorizontal.php';
include 'Modularidad/MenuVertical.php';
?>

<!--****************************************Comiezo de estructura de trabajo *************************-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/Renovacion.css">
<style type="text/css">
    #form
    {
        background-color: #ADADB2;
        border-radius: 20px;
        border-color: white;
    }
    #btn
    {
        background-color: #BE0032;
        width:100px;
        font-size: 15px;
        margin: 0 auto;
    }
    form
    {
        text-align: center;
    }
</style>
<div class="title mb-5">
<script type="../js/alertify.js"></script>
 <link rel="stylesheet" type="text/css" href="../css/alertify.core.css">
 <link rel="stylesheet" type="text/css" href="../css/alertify.default.css">
  <a href="javascript:history.back();"><img src="../img/back.png" class="icon"></a>
    <h2 class="main-title" >Descargas-Renovación</h2>
</div>
<body>
<?php
     session_start();
      if (isset($_SESSION['noti']) && $_SESSION['noti'] != "") {
        echo $_SESSION['noti'];
        unset($_SESSION['noti']);
        $_SESSION['noti'] = "";
      }
?>

<link rel="stylesheet" type="text/css" href="Modelo/ModeloRenovacion/Descargar/estilos.css">
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script type="text/javascript" src="Modelo/ModeloRenovacion/Descargar/select2.min.js"></script>





<form action="Modelo/ModeloRenovacion/Descargar/archiver.php" method="POST" >
    <button name="todo" type="submit" class="btn btn-success" style="float: right;margin-right:50px;margin-top:-30px" href="Modelo/ModeloRenovacion/Descargar/archiver.php">
<span class="glyphicon glyphicon-save" aria-hidden="true"><svg style="margin-right:8px;margin-bottom:5px;"xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0z"/>
</svg>Registro completo</span>
</button>
    <div style="width: 30%;margin: 0 auto;">
    <div class="form-group">
    <label style="color: black;" >Alumno</label>
    <select name="alumnos" id="alumnos" class="form-control" id="form">
<option value="0">Seleccione un alumno</option>
<?php 
$sql = "SELECT DISTINCT(alumnos.Nombre), alumnos.ID_Alumno FROM alumnos WHERE alumnos.Nombre <> 'Prueba' ";
foreach ($pdo->query($sql) as $alumnos) {
?>
<option value="<?php  echo $alumnos['ID_Alumno'] ?>"><?php  echo  $alumnos['Nombre'] ?></option>
<?php 
}
?>
</select>
</div>
    <div class="form-group">
        <label style="color: black;">Año</label>
	<select name="year" class="form-control" id="form">
    
    <option value="0">Seleccione un año</option>
    <?php  
    for($i=2020;$i<=2023;$i++) {

    ?>
    <option value="<?php  echo $i ?>"><?php  echo $i; ?></option>
    <?php 
    }
    ?>
</select>
</div>
<div class="form-group">
    <label style="color: black;">Promoción</label>
    <select name="class" class="form-control" id="form">
    <option value="0">Seleccione una promoción</option>
    <?php  
    $año = date("Y");
    foreach ($pdo->query("SELECT DISTINCT(Class) FROM alumnos
ORDER BY Class DESC") as $Class) {
?>
    <option value="<?php  echo $Class['Class'] ?>"><?php  echo "Class-".$Class['Class'] ?></option>
    <?php 
    }
    ?>
</select>
</div>

<div class="form-group">
    <label style="color: black;">Sede</label>
<select name="sede" class="form-control" id="form">
    <option value="0">Seleccione una sede</option>
    <?php
    foreach ($pdo->query("SELECT DISTINCT(ID_Sede) AS 'sede' FROM alumnos") as $place) {
        

    ?>
    <option value="<?php echo $place['sede'] ?>"><?php echo $place['sede'] ?></option>
    <?php
    }

?>
</select>
</div>



<div class="form-group">
    <label style="color: black;">Ciclo</label>
<select name="ciclo" class="form-control" id="form">
	<option value="0">Seleccione un ciclo</option>
	<option value="1">Ciclo 01</option>
	<option value="2">Ciclo 02</option>
</select>
</div>
<div class="form-group">
    <label style="color: black;">Tipo</label>
<select name="tipo" class="form-control" id="form">
    <option value="0">Seleccione un tipo</option>
    <option value="renovacion">Renovaciones</option>
    <option value="cancelacion">Beca cancelada</option>
    <option value="condicionamiento">Beca condicionada</option>
    <option value="pausa">Beca pausada</option>
</select>
</div>
<div class="form-group">
    <label style="color: black;">Estado</label>
<select name="estado" class="form-control" id="form">
    <option value="0">Seleccione un estado</option>
    <option value="rechazada">Rechazadas</option>
    <option value="aceptada">Aceptadas</option>
    <option value="enviado">Enviadas</option>
</select>
</div>
<br>
<!--<center><input id="cbx1" type="checkbox" name="todo" value="todo" id="form"> Todo<br></center><br>-->
<center><!--<input type="submit" name="descargar2" value="Descargar" class="btn btn-success" id="btn" style="width:45%;">-->

        <input type="submit" name="descargar" value="Descargar" class="btn btn-success" id="btn" style="width:45%;">
</center>
    </div>
</form>
<script type="text/javascript">
$(document).ready(function()
{
    $('#alumnos').select2();
}

);
</script>
<br><br><br>
<?php

require_once "Modularidad/PiePagina.php";


?>
</body>

