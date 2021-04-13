<?php
include 'Modularidad/CabeceraInicio.php';
?>
<title>Historial Notas</title>
<?php
include 'Modularidad/EnlacesCabecera.php';
include 'Modularidad/MenuHorizontal.php';
include 'Modularidad/MenuVertical.php';
require_once '../Conexion/conexion.php';
include "../Alumno/CSS/cod.php";
require_once '../Alumno/templates/header.php';
?>

<?php
$id = $_GET['id'];
// Expediente U
$consulta = $dbh->prepare("SELECT idExpedienteU  FROM expedienteu WHERE ID_Alumno = ? AND estado = 'Activo'");

$consulta->execute(array($id));
$idExpedienteU;
if ($consulta->rowCount() >= 1) {
    while ($fila = $consulta->fetch()) {
        $idExpedienteU = $fila['idExpedienteU'];
    }
} //fin de condicion
//consulta que muestra las materias
$consulMaterias = $dbh->prepare("SELECT  IM.nota,IM.idMateria,IM.matricula, M.nombreMateria, IM.estado,
 IC.cicloU, M.idExpedienteU from materias M INNER JOIN inscripcionmateria IM ON IM.idMateria= M.idMateria 
 INNER JOIN inscripcionciclos IC ON IC.Id_InscripcionC=IM.Id_InscripcionC WHERE M.idExpedienteU = ? AND 
 (IM.estado = 'Reprobada' OR IM.estado = 'Aprobada' OR IM.estado ='Retirada' ) ");

$consulMaterias->execute(array($idExpedienteU));
?>
<link rel="stylesheet" type="text/css" href="../Alumno/CSS/Alumno-Inicio.css">

<script type="text/javascript">
    $(document).ready(function() {
        bsCustomFileInput.init()
    });
</script>
<!--Comiezo de estructura de trabajo -->
<style type="text/css">
    @media screen and (max-width: 992px) {
        #main {
            margin-top: 100px;
        }
    }
</style>
<link rel="stylesheet" type="text/css" href="css/Menu.css">
<nav class="navbar navbar-expand-lg navbar-light" id="row">
    <a href="javascript:history.back();"><img src="../img/back.png" class="icon" style="transform:rotate(0deg);"></a>
    <a class="navbar-brand" href="#" id="T1">Historial Notas</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item" id="bloque">
                <a class="nav-link" href="NotasPorAlumno.php?id=<?php echo $Carnet ?>">Notas<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item" id="bloque">
                <a class="nav-link" href="HorasVinculacionPorAlumno.php?id=<?php echo $id ?>">Horas de Vinculación</a>
            </li>
            <li class="nav-item" id="bloque">
                <a class="nav-link" href="Renovacion.php?id=<?php echo $Carnet ?>">Renovaciones de Beca</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container-fluid text-center" id="main">
    <div class="alerta">
        <?php  include "config/Alerta.php";?>
    </div>
    <!--Información principal del estudiante-->
        <!--Comiezo de estructura de trabajo 2fila-->
        <div class="container-fluid text-center" ng-app="app">
            <div class="principal">
                <div style="display: block;">
                <br>
                    <table class="table text-center w-75 mx-auto table-bordered">
                        <thead class="table-dark ">
                            <tr>
                                <th scope="col">Codigo</th>
                                <th scope="col">Asignatura</th>
                                <th scope="col">Ciclo</th>
                                <th scope="col">Nota</th>
                                <th scope="col">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="table-hover">
                            <?php
                            if ($consulMaterias->rowCount() >= 1) {
                                while ($fila2 = $consulMaterias->fetch()) {
                                    if ($fila2['estadoM'] != 'Inscrita') {

                                        echo "<tr>
                                                <td>" . $fila2['idMateria'] . "</td>
                                                <td>" . utf8_decode($fila2['nombreMateria']) . "</td> 
                                                <td>" . $fila2['cicloU'] . "</td>
                                                <td>" . $fila2['nota'] . "</td>
                                                <td>" . $fila2['estado'] . "</td>
                                            </tr>";
                                    } else {
                                        echo "<tr>
                                                <td>" . $fila2['idMateria'] . "</td>
                                                <td class='oscuro'>" . utf8_decode($fila2['nombreMateria']) . "</td>
                                                <td></td>
                                                <td></td>
                                                <td >" . $fila2['nota'] . "</td>
                                                <td >" . $fila2['estadoM'] . "</td>
                  
                                             </tr>";
                                    } //fin de else
                                } //fin de while
                            } else {
                                echo "<tr><td colspan='6'>No ha agregado ninguna Asignatura</td></tr>";
                            } //fin de else-if
                            ?>
                        </tbody>
                        <tfoot class="table-dark ">
                            <tr>
                                <th>Codigo</th>
                                <th>Asignatura</th>
                                <th>Ciclo</th>
                                <th>Nota</th>
                                <th>Estado</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <!-- /#wrapper -->
            <script src="main.js"></script>
            <?php include "../Alumno/GRAFICA.php";
                  include "../Alumno/GRAFICA2.php";
                  include 'Modularidad/PiePagina.php';;
            ?>