<?php
require_once 'templates/head.php';
?>
<title>Listado de horario</title>
<?php
require_once 'templates/header.php';
require_once 'templates/MenuHorizontal.php';
require '../Conexion/conexion.php';

setlocale(LC_TIME, 'es_SV.UTF-8');
$taller = $_GET["reunion"];

//Extraemos el carnet del estudiante
$stmt1 = $dbh->prepare("SELECT * FROM `alumnos` WHERE correo='" . $_SESSION['Email'] . "'");
// Ejecutamos
$stmt1->execute();

while ($fila = $stmt1->fetch()) {
  $alumno = $fila["ID_Alumno"];
  $name = $fila["Nombre"];
}

$mesActual = date("m");
$numero = 1;
$stmt2 = $dbh->query("SELECT * FROM inscripcionreunion i INNER JOIN alumnos a on a.ID_Alumno = i.id_alumno WHERE i.id_reunion = $taller  and i.estado = 'lleno'");
$stmt3 = $dbh->query("SELECT * FROM inscripcionreunion i WHERE i.id_reunion = $taller  and i.estado = 'disponible'");


// consulta para saber si un alumno se ha inscrito a más de un cupo
$stmt4 = $dbh->query("SELECT COUNT(*) FROM `inscripcionreunion` WHERE id_alumno = '$alumno' ");

$stmt5 = $dbh->query("SELECT * FROM inscripcionreunion i  INNER JOIN alumnos a on a.ID_Alumno = i.id_alumno WHERE i.id_alumno = '$alumno' ");

while ($row = $stmt4->fetch()) {
  $cantidad  = $row[0];
}

?>

<div class="container-fluid text-center">
  <br>
  <h1 class="h1">Listado por el horario </h1>
  <br>
  <br>
  <div>
    <?php include "config/Alerta.php"; ?>
  </div>

  <div class="col">
    <table id="data" class="table table-hover table-striped table-bordered table-responsive-lg w-75 mx-auto float-center">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Hora inicio</th>
          <th scope="col">Hora Final</th>
          <th scope="col">inscribir</th>
        </tr>
      </thead>
      <tbody>
        <?php

        while ($row = $stmt2->fetch()) {
          if ($name == $row['Nombre']) {
            continue;
          }
          echo "<tr>";
          echo "<td>" . ($numero++) . "</td>";
          echo "<td>" . $row['Nombre'] . "</td>";
          echo "<td>" . $row['horainicio'] . "</td>";
          echo "<td>" . $row['horafin'] . " </td>";
          echo "<td><button class='btn btn-warning' disabled >Cupo Lleno </button></td>";
          echo "</tr>";
        }

        while ($row = $stmt5->fetch()) {
          $horaInicio = $row['horainicio'];
          $horaFinal = $row['horafin'];
          $nombre = $row['Nombre'];
          $idhorario = $row['id'];

          echo "<tr>";
          echo "<td>" . ($numero++) . "</td>";
          echo "<td>" . $nombre . "</td>";
          echo "<td>" . $horaInicio . "</td>";
          echo "<td>" . $horaFinal . " </td>";
          echo "<td><a href='Modelo/ModeloReunion/cancelar.php?id= " . $_GET["id"] . " &reunion=$taller&horario=$idhorario' class='btn btn-danger' >Cancelar</a></td>";
          echo "</tr>";
        }

        if ($cantidad >= 1) {
          while ($row = $stmt3->fetch()) {
            echo "<tr>";
            echo "<td>" . ($numero++) . "</td>";
            echo "<td>Cupo Disponible</td>";
            echo "<td>" . $row['horainicio'] . "</td>";
            echo "<td>" . $row['horafin'] . " </td>";
            echo "<td> <button class='btn btn-success'  value='' disabled >Inscribir</button> </td>";
            echo "</tr>";
          }
        } else {
          while ($row = $stmt3->fetch()) {
            echo "<tr>";
            echo "<td>" . ($numero++) . "</td>";
            echo "<td>Cupo Disponible</td>";
            echo "<td>" . $row['horainicio'] . "</td>";
            echo "<td>" . $row['horafin'] . " </td>";
            echo "<td> <button class='btn btn-warning' data-toggle='modal' data-target='#exampleModal-" . $cont++ . "' value=''>Inscribir</button> </td>";
            echo "</tr>";

            echo "<div class='modal fade' id='exampleModal-" . $cont2++ . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h5 class='modal-title' id='exampleModalLabel'>Ingrese su número de telefono para finalizar</h5>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>
                <div class='modal-body'>
                  <form action='Modelo/ModeloReunion/inscribir.php' method='post'>
                    <label for='telefono'>telefono:</label>
                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                    <input type='hidden' name='horario' value='" . $_GET["id"] . "'> 
                    <input type='hidden' name='reunion' value='" . $_GET["reunion"] . "'>   
                    <input type='hidden' name='alumno' value='$alumno'>    
                    <input type='text' class='form-control' name='telefono' placeholder='0000-0000' pattern='[0-9]{4}-[0-9]{4}' title='El teleono debe ser en el formato 0000-0000' required>
                </div>
                <div class='modal-footer'>
                  <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                  <button type='submit' class='btn btn-primary' name ='inscribir' value='Inscribir' >Inscribir</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          ";
          }
        }

        ?>
      </tbody>
    </table>

    <div>
      <table class="table">
        <thead>
          <th>#</th>
          <th>Nombre</th>
          <th>Hora inicio</th>
          <th>Hora Final</th>
          <th>inscribir</th>
        </thead>
        <tbody>
          <tr id="app">
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- /#page-content-wrapper -->
<br><br><br>

</div>
</div>
<!-- /#wrapper -->

<script>
  var app = new Vue({
    el: "#app",
    data: {
      all_data: []
    },
    created: function() {
      console.log("Iniciando ...");
      this.get_contacts();
    },
    methods: {
      get_contacts: function() {
        fetch("Modelo/ModeloReunion/select.php")
          .then(response => response.json())
          .then(json => {
            this.all_data = json.contactos
          })
      }
    }
  });
</script>

<?php
require_once 'templates/footer.php';
?>