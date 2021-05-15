<?php require_once 'templates/head.php'; ?>
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


// consulta para saber si un alumno se ha inscrito a más de un cupo
$stmt4 = $dbh->query("SELECT COUNT(*) FROM `inscripcionreunion` WHERE id_alumno = '$alumno' ");

while ($row = $stmt4->fetch()) {
  $cantidad  = $row[0];
}

?>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>

<div class="container-fluid text-center">
  <br>
  <h1 class="h1">Listado por el horario </h1>
  <br>
  <br>
  <div>
    <?php include "config/Alerta.php"; ?>
  </div>

  <div class="col">

    <div>
      <table class="table table-bordered">
        <thead class="table thead-dark">
          <th>#</th>
          <th>Nombre</th>
          <th>Hora inicio</th>
          <th>Hora Final</th>
          <th>inscribir</th>
        </thead>
        <tbody id="app">
          <tr v-for="data in all_data ">
            <td>{{contador}}</td>
            <td>{{data.Nombre}}</td>
            <td>{{data.horainicio}}</td>
            <td>{{data.horafin}}</td>
            <td><button class='btn btn-warning' disabled>Cupo Lleno </button></td>
          </tr>
          <tr v-for="e in all_data2 ">
            <td>{{contador}}</td>
            <td>{{e.Nombre}}</td>
            <td>{{e.horainicio}}</td>
            <td>{{e.horafin}}</td>
            <td><a v-bind:href="'Modelo/ModeloReunion/cancelar.php?id=<?php echo $_GET["id"] ?>&reunion=<?php echo $taller ?>&horario='+e.id" class='btn btn-danger'>Cancelar</a></td>
            </td>
          </tr>
          <?php
          if ($cantidad >= 1) { ?>
            <tr v-for="e in all_data3 ">
              <td>{{contador}}</td>
              <td>Disponible</td>
              <td>{{e.horainicio}}</td>
              <td>{{e.horafin}}</td>
              <td><button class='btn btn-success' disabled>Inscribir</button> </td>
              </td>
            </tr>
          <?php } else { ?>
            <tr v-for="e in all_data3 ">
              <td>{{contador}}</td>
              <td>Disponible</td>
              <td>{{e.horainicio}}</td>
              <td>{{e.horafin}}</td>
              <td><button class='btn btn-warning' data-toggle='modal' v-bind:data-target="'#exampleModal'+e.id">Inscribir</button></td>
              <td style="border:0;padding:0; margin:0">
                <div class='modal fade' v-bind:id="'exampleModal'+e.id" tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
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
                          <input type='hidden' name='id' :value="e.id">
                          <input type='hidden' name='horario' value='<?php echo $_GET["id"] ?>'>
                          <input type='hidden' name='reunion' value='<?php echo $_GET["reunion"] ?>'>
                          <input type='hidden' name='alumno' value='<?php echo $alumno ?>'>

                          <input type='text' class='form-control' name='telefono' placeholder='0000-0000' pattern='[0-9]{4}-[0-9]{4}' title='El teleono debe ser en el formato 0000-0000' required>
                          <button type='submit' class='btn btn-primary' name='inscribir' value='Inscribir'>Inscribir</button>
                        </form>
                      </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>

                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          <?php
          } ?>
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
  const taller = <?php echo $taller ?>;

  var data2 = {
    id: taller
  };

    var app = new Vue({
      el: "#app",
      data: {
        all_data: [],
        all_data2: [],
        all_data3: [],
        contador: 1,
      },

      created: function() {
        console.log("Iniciando ...");
        this.get_contacts();
        this.cancelarInscripcion();
        this.disponibles();
      },
      methods: {
        get_contacts: function() {
          fetch(
              "Modelo/ModeloReunion/select.php", {
                method: 'POST', // or 'PUT'
                body: JSON.stringify(data2),
                headers: {
                  'Content-Type': 'application/json'
                }
              })
            .then(response => response.json())
            .then(json => {
              this.all_data = json.reuniones
            })
        },
        cancelarInscripcion: function() {
          fetch(
              "Modelo/ModeloReunion/select_inscripcion.php", {
                method: 'POST',
                body: JSON.stringify(data2),
                headers: {
                  'Content-Type': 'application/json'
                }
              })
            .then(response => response.json())
            .then(json => {
              this.all_data2 = json.lista1
            })
        },
        disponibles: function() {
          fetch(
              "Modelo/ModeloReunion/select_disponible.php", {
                method: 'POST',
                body: JSON.stringify(data2),
                headers: {
                  'Content-Type': 'application/json'
                }
              })
            .then(response => response.json())
            .then(json => {
              this.all_data3 = json.disponibles
            })
        }
      }
    })
</script>

<?php
require_once 'templates/footer.php';
?>