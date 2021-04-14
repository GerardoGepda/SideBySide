<?php
include 'Modularidad/CabeceraInicio.php';
?>
<title>Historial Notas</title>
<?php
include 'Modularidad/EnlacesCabecera.php';
include 'Modularidad/MenuHorizontal.php';
// include 'Modularidad/MenuVertical.php';
require_once '../Conexion/conexion.php';
include "../Alumno/CSS/cod.php";
?>

<?php
$id = $_GET['id'];

//-------------------------------------------------------------------
//Extraer ID  Expediente U
//-------------------------------------------------------------------
// Consulta que muestra las solicitudes que haga el usuario
//dependiendo del usuario asi se l mostrara los datos
$consulta = $dbh->prepare("SELECT idExpedienteU FROM expedienteu  WHERE ID_Alumno = ? AND estado = 'Activo'");
$consulta->execute(array($id));
$idExpedienteU;

if ($consulta->rowCount() >= 1) {
    while ($fila = $consulta->fetch()) {
        $idExpedienteU = $fila['idExpedienteU'];
    }
}
//-------------------------------------------------------------------
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
<!-- /#page-content-wrapper -->
<style type="text/css">
    .modal-content {
        background-color: white;
        border-color: black;
        border-radius: 30px;
        padding: 20px;
    }

    .modal-body {
        text-align: left;
    }

    .form-control {
        background-color: #ADADB2;
        color: black;
        border-radius: 20px;

    }

    .modal-header {
        border-color: #ADADB2;
        border: 3px;
    }
</style>


<nav class="navbar navbar-expand-lg navbar-light" id="row">
    <a href="javascript:history.back();"><img src="../img/back.png" class="icon" style="transform:rotate(0deg);"></a>
    <a class="navbar-brand" href="#" id="T1">Historial Notas</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item" id="bloque">
                <a class="nav-link" href="NotasPorAlumno.php?id=<?php echo $id ?>">Notas<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item" id="bloque">
                <a class="nav-link" href="HorasVinculacionPorAlumno.php?id=<?php echo $id ?>">Horas de Vinculación</a>
            </li>
            <li class="nav-item" id="bloque">
                <a class="nav-link" href="Renovacion.php?id=<?php echo $id ?>">Renovaciones de Beca</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container-fluid text-center" id="main">
    <div class="alerta">
        <?php include "config/Alerta.php"; ?>
    </div>
    <!--Información principal del estudiante-->
    <!--Comiezo de estructura de trabajo 2fila-->
    <div class="container-fluid text-center" ng-app="app">
        <div class="principal">
            <div style="display: block;">
                <br>
                <span class="float-right">
                    <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#ModalMateria' style="border-radius: 20px; border: 2px solid #9d120e; width: 100px;height: 50px; background-color: #9d120e; color:white;"><img src="../img/add.png" width="25px" height="25px"><br>
                        <p style="font-size: 10px;">Crear Materia</p>
                    </button>
                </span>
                <table id="pensum" class="table table-hover table-sm table-bordered table-fixed w-75 mx-auto">
                    <thead style="background-color: #2D2D2E; color: white; ">
                        <tr>
                            <th scope="col">Codigo</th>
                            <th scope="col">Asignatura</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody class="table-bordered table-hover">
                        <?php
                        //-------------------------------------------------------------------
                        //Extraer Todas las materias 
                        //-------------------------------------------------------------------
                        $consulMaterias = $dbh->prepare("SELECT idMateria, nombreMateria FROM materias WHERE idExpedienteU = ? AND estado = 'Activo'");
                        $consulMaterias->execute(array($idExpedienteU));
                        if ($consulMaterias->rowCount() >= 1) {
                            //muestra en la tabla
                            while ($fila2 = $consulMaterias->fetch()) {
                                echo "
                                        <tr class='table-light'>
                                            <th>" . $fila2['idMateria'] . "</th>  
                                            <th>" . utf8_decode($fila2['nombreMateria']) . "</th>
                                            <td>
                                            <center><a href='Modelo/ModeloMaterias/delete.php?id=" . $fila2['idMateria'] . "&alumno=$id' class='btn btn-danger'><i class='fas fa-trash'></i></a></center>
                                            </td>
                                        </tr>";
                            } //fin while
                        } //fin if
                        ?>
                    </tbody>
                </table>
                <!--MODALS-->
                <div class="hidden">
                    <!-- MODAL Materias -->
                    <!--******-->
                    <div class="modal fade " id="ModalMateria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Materia Pensum</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="Modelo/ModeloMaterias/GuardarMaterias.php" method="POST" accept-charset="utf-8">
                                        <div id="alerta5"></div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="sr-only" for="nombremateria">Nombre de materia</label>
                                                <input type="text" name="nombremateria" placeholder="Nombre de materia" class="nombremateria form-control" id="nombremateria">
                                            </div>
                                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                                            <input type="hidden" name="expedienteu" value="<?php echo $idExpedienteU; ?>">
                                        </div>
                                        <center>
                                            <input style="border-radius: 20px; border: 2px solid #9d120e; width: 200px;height: 38px; background-color: #9d120e; color:white;" type="submit" name="Guardar_Materia" value="Agregar Materia " id="Guardar_Materia">
                                        </center>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- FIN MODAL Pensum -->
                        <!--********-->
                    </div>
                    <!--fin contenedor modals pensum-->
                </div>
                <!-- /#wrapper -->
                <script src="main.js"></script>
                <script>
                    $('#pensum').dataTable({
                        pageLength: 5,
                        lengthMenu: [10, 25, 50, 75, 100]
                    });
                </script>
                <?php
                include 'Modularidad/PiePagina.php';;
                ?>