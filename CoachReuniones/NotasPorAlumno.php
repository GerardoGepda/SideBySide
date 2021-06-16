<?php
//Modularidad para inicializar el Head y <!DOCTYPE html>
include 'Modularidad/CabeceraInicio.php';
?>
<title>Notas del alumno</title>
<?php include("../BaseDatos/conexion.php"); //Realizamos la conexión con la base de datos  


include_once "Modelo/ModeloAlumno/NotasAlumno.php";
//Modularaidad para extraere los enlaces en HEAD
include 'Modularidad/EnlacesCabecera.php';
//Incluir el menu horizontal
include 'Modularidad/MenuHorizontal.php';
// include 'Modularidad/MenuVertical.php';
?>
<title>Inicio</title>
<style>
  @media only screen and (min-width: 320px) and (max-width: 767px) {

    .title h2 {
      font-size: 20px;
      margin-top: 8px;
      margin-left: 0em;

    }

    .icon {
      height: 18px;
      width: 18px;
      margin-top: 0px;
    }

    .title {
      width: 100%;

    }

  }
</style>

<?php
require '../Conexion/conexion.php';

$id = $_GET['id'];

//consulta para extraer el id universitario del alumno
$stmt14525646 = $dbh->prepare("SELECT idExpedienteU FROM expedienteu WHERE ID_Alumno= '" . $id . "' ");
$stmt14525646->execute();
while ($row = $stmt14525646->fetch()) {
  $idExpedienteU = $row['idExpedienteU'];
  $expediente = $row['idExpedienteU'];
}


//consulta para extraer las materias inscritas de los alumnos
$stmt9945246 = $dbh->prepare("SELECT * FROM materias WHERE idExpedienteU = :id AND Estado = 'Activo' ");
$stmt9945246->bindParam(":id", $idExpedienteU);
$stmt9945246->execute();
// fin de consulta para extraer las materias inscritas de los alumnos

//consulta para extraer las materias retiradas de los alumnos
$stmt99452462 = $dbh->prepare("SELECT * FROM materias WHERE idExpedienteU = :id AND estadoM = 'Retirada' ");
$stmt99452462->bindParam(":id", $idExpedienteU);
$stmt99452462->execute();
// fin de consulta para extraer las materias retiradas de los alumnos

//consulta para extraer las materias retiradas de los alumnos
$stmt99452463 = $dbh->prepare("SELECT * FROM materias WHERE idExpedienteU = :id AND estadoM = 'Reprobada' ");
$stmt99452463->bindParam(":id", $idExpedienteU);
$stmt99452463->execute();
// fin de consulta para extraer las materias retiradas de los alumnos

//consulta para extraer las materias retiradas de los alumnos
$stmt99452464 = $dbh->prepare("SELECT * FROM materias WHERE idExpedienteU = :id AND estadoM = 'Aprobada' ");
$stmt99452464->bindParam(":id", $idExpedienteU);
$stmt99452464->execute();
// fin de consulta para extraer las materias retiradas de los alumnos



$stmt4 = $dbh->prepare("SELECT COUNT(idMateria) AS 'Aprobado' FROM `materias` WHERE `idExpedienteU` = ? AND estadoM ='Aprobada'");
// Ejecutamos
$stmt4->execute(array($idExpedienteU));


if ($stmt4->rowCount() >= 0) {
  $fila4 = $stmt4->fetch();
  $Aprobado = $fila4['Aprobado'];
}



$stmt5 = $dbh->prepare("SELECT COUNT(idMateria) AS 'Reprobado' FROM `materias` WHERE `idExpedienteU` = ? AND estadoM ='Reprobada'");
// Ejecutamos
$stmt5->execute(array($idExpedienteU));


if ($stmt5->rowCount() >= 0) {
  $fila5 = $stmt5->fetch();
  $Reprobado = $fila5['Reprobado'];
}



$stmt6 = $dbh->prepare("SELECT COUNT(Id_InscripcionM) AS 'RETIRADAS' FROM inscripcionmateria IM INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC WHERE IC.idExpedienteU = ? AND estado = 'Retirada' ");
// Ejecutamos
$stmt6->execute(array($idExpedienteU));


if ($stmt6->rowCount() >= 0) {
  $fila6 = $stmt6->fetch();
  $Retirads = $fila6['RETIRADAS'];
}


$stmt7 = $dbh->prepare("SELECT COUNT(idMateria) AS 'Inscrita' FROM materias WHERE idExpedienteU = ? ");
// Ejecutamos
$stmt7->execute(array($idExpedienteU));


if ($stmt7->rowCount() >= 0) {
  $fila7 = $stmt7->fetch();
  $Inscrita = $fila7['Inscrita'];
}


$stmt9 = $dbh->prepare("SELECT * FROM `inscripcionciclos` WHERE `idExpedienteU` = ?");
$stmt9->execute(array($idExpedienteU));

$stmt16584 = $dbh->prepare("SELECT * FROM `materias` WHERE  `idExpedienteU` = ? ORDER BY estadoM DESC");
$stmt16584->execute(array($idExpedienteU));


?>

<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<link rel="stylesheet" type="text/css" href="css/Menu.css">
<nav class="navbar navbar-expand-lg navbar-light" id="row">
  <a href="javascript:history.back();"><img src="../img/back.png" class="icon" style="transform:rotate(0deg);"></a>
  <a class="navbar-brand" href="#" id="T1">Expediente</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item" id="bloque">
        <a class="nav-link" href="pensum.php?id=<?php echo $id ?>">Pensum<span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>
<div class="float-right"> <?php include 'Modularidad/Alerta.php' ?></div>
<div class="float-right"> <?php include 'Modularidad/AlertaCorreo.php' ?></div>

<div class="container-fluid text-center">
  <div class="row  mt-2" id="detalles">
    <div class="text-center align-self-center ml-5 " id="carnet" style="background-color:  #c7c7c7;">
      <br>
      <img v-bind:src="'../img/imgUser/'+datos.imagen" alt="img de usuario" style="height: 170px; width: 170px; background-repeat: no-repeat; background-position: 50%; border-radius: 50%; background-size: 100% auto;">
      <h4 style="color: white; text-align: center; font-weight: bold;"> {{datos.Universidad}} </h4>
    </div>
    <div class="col text-center">
      <h3 style="text-align: left; color: #555555; font-weight: bold;"> {{datos.Alumno}} </h3>
      <h5 style="color: #555555; text-align: left;" v-if="block">Carnet Universidad: {{block.carnet}} </h5>
      <h5 style="color: #555555; text-align: left;" v-else>Carnet Universidad: Debe actualizar expediente </h5>

      <table class="table table-responsive-lg float-left">
        <thead style="background-color: #2D2D2E;; color: white; ">
          <tr>
            <th scope="col">Universidad</th>
            <th scope="col">Carrera</th>
            <th scope="col">Facultad</th>
            <th scope="col">Estado</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="datos" class="table-dark text-dark ">
            <td> {{datos.Universidad}} </td>
            <td>{{datos.CARRERA}}</td>
            <td> {{datos.Facultad}} </td>
            <td> Activo</td>
          </tr>
          <tr v-else="" class="table-dark text-dark ">
            <td>Debe actualizar</td>
            <td>Debe actualizar</td>
            <td>Debe actualizar</td>
            <td>Debe actualizar</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <br>
  <div class="card text-center" style=" border-color: white;border-width: 3px;border-style: solid;">
    <h3 style="text-align: left; font-weight: bold;">Detalles del Estudio</h3>
    <div class="card-body" style="background-color: white; ">
      <div class="row">
        <table class="table table-responsive-lg float-left">
          <thead style="background-color: #2D2D2E; color: white; ">
            <tr>
              <th scope="col">Universidad</th>
              <th scope="col">Carrera</th>
              <th scope="col">Cum</th>
              <th scope="col">Estado</th>
              <th scope="col">Subir Pensum</th>
              <th scope="col">Ver Pensum</th>
              <th scope="col">Actualizar</th>
            </tr>
          </thead>
          <tbody id="estudio">
            <tr class="table-dark text-dark ">
              <th scope="col"> {{info.Universidad}} </th>
              <th scope="col"> {{info.CARRERA}} </th>
              <th scope="col" v-if="expedU.cum"> {{expedU.cum}} </th>
              <th scope="col" v-else> Debe actualizar </th>
              <th scope="col" v-if="expedU.estado"> {{expedU.estado}} </th>
              <th scope="col" v-else> Debe actualizar </th>
              <th scope="col">
                <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#pensum' style="border-radius: 20px; border: 2px solid #9d120e; width: 100px;height: 50px; background-color: #9d120e; color:white;"><img src="../img/add.png" width="25px" height="25px"><br>
                  <p style="font-size: 10px;">Subir pensum</p>
                </button>
              </th>
              <th scope="col" v-if="expedU.pensum "><a v-bind:href="'../pdfPensum/'+expedU.pensum" target='_blank' class='btn btn-danger '><img src='../img/PDF.png' width='25px' height='25px'></a></th>
              <th scope="col" v-else><a v-bind:href="'../pdfPensum/'+expedU.pensum" target='_blank' class='btn btn-danger ' disabled><img src='../img/PDF.png' width='25px' height='25px'></a></th>
              <th scope="col">
                <button type="button" class="btn" data-toggle="modal" data-target="#exampleModalx">
                  <i class='fas fa-pen'></i>
                </button>
              </th>
            </tr>
          </tbody>
        </table>
        <br>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <div class="card text-white bg-success mb-3 text-center">
                <div class="card-header">
                  <h1>
                    <span id="ContentPlaceHolder1_LbCAprobadas"><?php echo  $Aprobado;  ?></span>
                  </h1>
                </div>
                <div class="card-footer">
                  <small><button type="button" data-toggle="modal" data-target="#notas4" style="color: white; background-color: transparent; border-color: transparent; cursor: default;">APROBADAS</button></small>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <div class="card text-white bg-danger mb-3 text-center">
                <div class="card-header">
                  <h1>
                    <span id="ContentPlaceHolder1_LbCReprobadas"><?php echo  $Reprobado;  ?></span>
                  </h1>
                </div>
                <div class="card-footer">
                  <small><button type="button" data-toggle="modal" data-target="#notas3" style="color: white; background-color: transparent; border-color: transparent; cursor: default;">REPROBADAS</button></small>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <div class="card text-white bg-warning mb-3 text-center">
                <div class="card-header">
                  <h1>
                    <span id="ContentPlaceHolder1_LbCRetiradas"><?php echo  $Retirads;  ?></span>
                  </h1>
                </div>
                <div class="card-footer">
                  <small><button type="button" data-toggle="modal" data-target="#notas2" style="color: white; background-color: transparent; border-color: transparent; cursor: default;">RETIRADAS</button></small>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6 text-center">
              <div class="panel panel-udb text-white bg-primary">
                <div class="card-header">
                  <h1>
                    <span id="ContentPlaceHolder1_LbCEquivalencia"><?php echo  $Inscrita;  ?></span>
                  </h1>
                </div>
                <div class="card-footer">
                  <small> <button type="button" data-toggle="modal" data-target="#notas" style="color: white; background-color: transparent; border-color: transparent; cursor: default;">INSCRITAS</button></small>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center" id="porcentaje">
          <div class="card card-udb" style="background-color: #c7c7c7; border-width: medium; border-color: #2D2D2E; border-radius: 3%;">
            <div class="card-header">
              <b>
                <h1>
                  <span id="ContentPlaceHolder1_LbCPorcentaje"> {{porcentaje}}%</span>
                </h1>
              </b>
            </div>
            <div class="card-footer">
              <small style="font-weight: bold; color: black;">PORCENTAJE DE AVANCE</small>
            </div>
          </div>
        </div>
      </div>
      <h3 style="text-align: left; font-weight: bold;" class="m-3">Inscripciones de Ciclos</h3>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#exampleModal">Agregar inscripción</button>

      <table class="table table-responsive-lg float-left">
        <thead style="background-color: #2D2D2E; color: white; ">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Ciclo Universidad</th>
            <th scope="col">Comprobante</th>
            <th scope="col">Detalles</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // idExpedienteU

          $numero = 0;
          $numero++;
          $num = 0;
          $num++;
          $num88 = 1;


          while ($fila9 = $stmt9->fetch()) {

            $pdfCiclo = $fila9['comprobante'];
            $prueba = $fila9["cicloU"];
            $ciclou = $fila9["Id_InscripcionC"];
            $nota = $fila[""];
            //consulta para obtener nota de materia
            $stmt1658484 = $dbh->prepare("SELECT * FROM `inscripcionmateria` WHERE  `Id_InscripcionC` = ?");
            $stmt1658484->execute(array($ciclou));

            $stmt16584842 = $dbh->prepare("SELECT * FROM `inscripcionmateria` WHERE  `Id_InscripcionC` = ?");
            $stmt16584842->execute(array($ciclou));

            echo " <tr class='table-dark' style ='color: black;'>
                      <td scope=\"row\">" . $fila9["Id_InscripcionC"] . "</td>
                      <td>" . $fila9["cicloU"] . "</td>";
            if ($pdfCiclo == null) {
              echo "
            <th><button type='button' class='btn btn-danger'  disabled> 
            <img src='../img/PDF.png' width='25px' height='25px'></button></th>";
            } else {
              echo "<th><a href='../pdfCicloInscripcion/$pdfCiclo' target='_blank' class='btn btn-danger '>
              <img src='../img/PDF.png' width='25px' height='25px>'</a> </th>";
            }
            $num2 = 1;
            echo "<td>
            <button type='button' class='btn btn-info' data-toggle='modal' data-target='#exampleModalCenter" . ($numero++) . "'>
          <i class=\"fas fa-info-circle\"></i>
            </button>
             <div class='btn-group' role='group' aria-label='Button group with nested dropdown'>
              <div class='btn-group' role='group'>
                <button id='btnGroupDrop1' type='button' class='btn btn-secondary ' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                <i class='fas fa-ellipsis-v'></i>
                </button>
                <div class='dropdown-menu' aria-labelledby=btnGroupDrop1'>
                  <a class='dropdown-item' href='Modelo/ModeloMaterias/eliminarInscripcion.php?id=$ciclou&idAlumno=$idExpedienteU&expediente=$expediente' ><button class='btn btn-danger'>Eliminar</button></a>
                  <a class='dropdown-item' href='ModificarInscripcio.php?id=$ciclou&idAlumno=$idExpedienteU&expediente=$expediente' ><button class='btn btn-warning'>Modificar</button></a>
                </div>
              </div>
           </div>
            </td>
        </tr>";
            $stmt123456 = $pdo->query("SELECT m.nombreMateria  FROM inscripcionmateria i INNER JOIN materias m ON m.idMateria = i.idMateria INNER JOIN inscripcionciclos n ON n.Id_InscripcionC = i.Id_InscripcionC  WHERE n.Id_InscripcionC = '$ciclou' ");
            echo "
                  <div class='modal fade' id='exampleModalCenter" . ($num++) . "' tabindex='-1' role='dialog'
                  aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered modal-lg' role='document' >
                      <div class='modal-content' >
                        <div class='modal-header' >
                          <h5 class='modal-title' id='exampleModalLongTitle'>Materias Inscritas: $prueba </h5>
                          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                          </button>
                        </div>
                        <div class='modal-body ' width='auto'>
                        <div class='row'>
                        <div class='col-sm-6' >
                        <div class='card' style='width: 20rem; >
                        <ul class='list-group list-group-flush'>
                          <li class='list-group-item'> &nbsp; &nbsp;" . "Materia" . "&nbsp;" . "</li> ";
            while ($row = $stmt123456->fetch()) {
              echo " <li class='list-group-item'>" . "<p class=''></p>" . utf8_decode($row['nombreMateria']) . "&nbsp;" . "</li> ";
            }
            echo "</ul>
            </div>
        </div>
        <div class='col-sm-3' >
        <div class='card' style='width: 10rem; >
                 <ul class='list-group list-group-flush'>
                 <li class='list-group-item'> &nbsp; &nbsp;" . "Estado" . "&nbsp;" . "  </li> ";
            while ($row2 = $stmt1658484->fetch()) {
              if ($row2["estado"] != null) {
                echo " <li class='list-group-item'>" . trim($row2["estado"])
                  . "<p class=''></p> " . "</li> ";
              }
            }
            echo "</ul>
            </div>
            </div>
        <div class='col-sm-3' >
        <div class='card' style='width: 10rem; >
                 <ul class='list-group list-group-flush'>
                 <li class='list-group-item'> &nbsp; &nbsp;" . "Nota" . "&nbsp;" . "  </li> ";
            while ($row2 = $stmt16584842->fetch()) {
              echo " <li class='list-group-item'>" . "<p class=''></p> " . trim($row2["nota"])
                . "&nbsp;" . "</li> ";
            }
            echo "</ul>
            </div>
          </div>
      </div>
   </div>
   <div class='modal-footer'>
              <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
          </div>
        </div>
      </div>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <br>
  <br>
</div><!-- /#page-content-wrapper -->


<!-- Modal Pensum carrera -->
<div class="modal fade" id="pensum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Comprobante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body m-3">
        <form action="Modelo/ModeloMaterias/subirPensum.php" method="post" enctype="multipart/form-data">
          <div class="custom-file">
            <input type="file" class="custom-file-input" accept=".pdf" id="customFileLang" name="archivo" required>
            <label class="custom-file-label" for="customFileLang" data-browse="Buscar">Seleccionar
              Comprobante</label>
            <center><small>El archivo no debe pesar más de 5MB</small></center>
          </div>
          <div>
            <!--idalumnos-->
            <input type="hidden" name="alumno" value="<?php echo $id; ?>">
            <!--id expedente-->
            <input type="hidden" name="expediente" value="<?php echo $idExpedienteU; ?>">
          </div>

      </div>
      <div class="modal-footer">
        <input class="btn btn-primary btn-rounded" type="submit" name="actualizar" value="Cerrar " data-dismiss="modal">
        <input class="btn btn-primary btn-rounded" type="submit" name="actualizar" value="Guardar Cambios " id="actualizar">
      </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
<!-- /#wrapper -->
<!-- Modal -->
<div class="modal fade" id="notas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Listado de materias inscritas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul>
          <?php
          while ($row = $stmt9945246->fetch()) {
            echo "<li>" . (utf8_decode($row['nombreMateria'])) . "</li>";
          }
          ?>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="notas2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Listado de materias retiradas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul>
          <?php
          while ($row = $stmt99452462->fetch()) {
            echo "<li>" . utf8_decode(($row['nombreMateria'])) . "</li>";
          }
          ?>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="notas3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Listado de materias reprobadas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul>
          <?php

          while ($row = $stmt99452463->fetch()) {
            echo "<li>" . utf8_decode(($row['nombreMateria'])) . "</li>";
          }

          ?>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="notas4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Listado de materias Aprobadas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul>
          <?php

          while ($row = $stmt99452464->fetch()) {
            echo "<li>" . utf8_decode(($row['nombreMateria'])) . "</li>";
          }

          ?>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Comprobante | Ciclo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert">
          Para que su solicitud sea terminada con exito agregue los siguientes datos que se le solicitan.
        </div>

        <form action="../CoachReuniones/Modelo/ModeloMaterias/subirPdfCiclo.php" method="post" enctype="multipart/form-data">

          <div class="form-group">
            <label class="" for="ciclo">Ciclo:</label>
            <select name="ciclo" id="ciclo" class="ciclo form-control">
              <!-- año 2014 -->
              <option disabled>2014</option>
              <option value="Ciclo 01-2014">Ciclo 01-2014</option>
              <option value="Ciclo 02-2014">Ciclo 02-2014</option>
              <option value="Ciclo 03-2014">Ciclo 03-2014</option>
              <!-- año 2015 -->
              <option disabled>2015</option>
              <option value="Ciclo 01-2015">Ciclo 01-2015</option>
              <option value="Ciclo 02-2015">Ciclo 02-2015</option>
              <option value="Ciclo 03-2015">Ciclo 03-2015</option>
              <!-- año 2016 -->
              <option disabled>2016</option>
              <option value="Ciclo 01-2016">Ciclo 01-2016</option>
              <option value="Ciclo 02-2016">Ciclo 02-2016</option>
              <option value="Ciclo 03-2016" title="Interciclo">Ciclo 03-2016</option>
              <!-- año 2017 -->
              <option disabled>2017</option>
              <option value="Ciclo 01-2017">Ciclo 01-2017</option>
              <option value="Ciclo 02-2017">Ciclo 02-2017</option>
              <option value="Ciclo 03-2017" title="Interciclo">Ciclo 03-2017</option>
              <!-- año 2018 -->
              <option disabled>2018</option>
              <option value="Ciclo 01-2018">Ciclo 01-2018</option>
              <option value="Ciclo 02-2018">Ciclo 02-2018</option>
              <option value="Ciclo 03-2018" title="Interciclo">Ciclo 03-2018</option>
              <!-- año 2019 -->
              <option disabled>2019</option>
              <option value="Ciclo 01-2019">Ciclo 01-2019</option>
              <option value="Ciclo 02-2019">Ciclo 02-2019</option>
              <option value="Ciclo 03-2019" title="Interciclo">Ciclo 03-2019</option>
              <!-- año 2020 -->
              <option disabled>2020</option>
              <option value='Ciclo 01-2020'>Ciclo 01-2020</option>
              <option value='Ciclo 02-2020'>Ciclo 02-2020</option>
              <option value='Ciclo 03-2020' title="Interciclo">Ciclo 03-2020</option>
              <!-- año 2021 -->
              <option disabled>2021</option>
              <option value='Ciclo 01-2021'>Ciclo 01-2021</option>
              <option value='Ciclo 02-2021'>Ciclo 02-2021</option>
              <option value='Ciclo 03-2021' title="Interciclo">Ciclo 03-2021</option>
            </select>
          </div>
          <div class="custom-file">
            <input type="file" class="custom-file-input" accept=".pdf" id="customFileLang" name="archivo" required>
            <label class="custom-file-label" for="customFileLang" data-browse="Buscar">Seleccionar
              Comprobante</label>
            <center><small>El archivo no debe pesar más de 5MB</small></center>
          </div>
          <br><br>
          <div>
            <!--idalumnos-->
            <input type="hidden" name="alumno" value="<?php echo $id; ?>">
            <!--id expedente-->
            <input type="hidden" name="expediente" value="<?php echo $idExpedienteU; ?>">
          </div>
      </div>
      <div class="modal-footer">
        <input style="border-radius: 20px;  border: 2px solid #9d120e; width: 100px;height: 38px;  background-color: #9d120e; color:white;" type="submit" name="actualizar" value="Cerrar " data-dismiss="modal">
        <input style="border-radius: 20px; border: 2px solid #9d120e; width: 200px;height: 38px;  background-color: #9d120e;   color:white;" type="submit" name="comprobante_Ciclo" value="Guardar Cambios " id="comprobante_Ciclo">
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalx" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar información</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="formAlumno">
        <form class="w-50 mx-auto" method="post" action="Modelo/ModeloAlumno/actualizar.php">
          <div class="form-group">
            <label for="" class="text-dark">Hola <b> {{otros.Alumno}} </b> a continuación escriba los datos que se solicitan:</label><br>
            <label for="exampleInputEmail1" class="text-dark">CUM:</label>
            <input type="number" step="0.1" min="0" max="10" name="cum" v-bind:value="universidad.cum" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese su CUM">
          </div>
          <div class="form-group text-dark">
            <label for="exampleInputPassword1" class="text-dark">Carnet:</label>
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input type="hidden" name="carrera" v-bind:value="otros.idUni" />
            <input type="text" name="carnet" v-bind:value="universidad.carnet" class="form-control" id="exampleInputPassword1" placeholder="Ingrese su carnet">
            <input type="hidden" name="universidad" v-bind:value="otros.idem">
            <input type="hidden" name="expU" v-bind:value="universidad.idExpedienteU">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1" class="text-dark">avance de carrera:</label>
            <input type="number" step="0.01" min="0" max="100" name="avance" v-bind:value="universidad.avancePensum" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese su CUM">
          </div>
          <div class="form-check">
          </div>
          <center><button type="submit" class="btn btn-success" name="actualizar" value="Actualizar">Actualizar</button></center>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script async>
  const carnet = '<?php echo $id; ?>';
</script>

<script async src="js/vue.js"></script>
<?php require_once '../Alumno/templates/footer.php'; ?>