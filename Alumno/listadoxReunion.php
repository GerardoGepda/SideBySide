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


// consulta para saber si un alumno se ha inscrito a más de un cupo
$stmt4 = $dbh->query("SELECT COUNT(*) FROM `inscripcionreunion` WHERE id_alumno = '$alumno' AND  id_reunion  = " . $_GET["reunion"] . " ");

while ($row = $stmt4->fetch()) {
  $cantidad  = $row[0];
}

?>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<link rel="stylesheet" href="CSS/reunion.css">
<div class="container-fluid text-center p-4">
  <h1 class="h1 p-2">Listado por el horario </h1>
  <div>
    <?php include "config/Alerta.php"; ?>
  </div>

  <div class="col">
    <div>
      <table class="table table-bordered w-75 mx-auto table-hover table-striped" id="reuniones">
        <thead class="table thead-dark">
          <th>#</th>
          <th>Nombre</th>
          <th>Horario</th>
          <th>telefono</th>
          <th>inscribir</th>
        </thead>
        <tbody id="app">
          <tr v-for="data in all_data " :class="{ active : active_el == e.id }">
            <td>{{data.id}}</td>
            <td>{{data.Nombre}}</td>
            <td>{{data.horainicio}}-{{data.horafin}}</td>
            <td></td>
            <td><button class='btn btn-warning' disabled>Cupo Lleno </button></td>
          </tr>
          <tr v-for="e in all_data2 " :class="{ active : active_el == e.id }">
            <td>{{e.id}}</td>
            <td>{{e.Nombre}}</td>
            <td>{{e.horainicio}}-{{e.horafin}}</td>
            <td></td>
            <td><a v-bind:href="'Modelo/ModeloReunion/cancelar.php?id=<?php echo $_GET["id"] ?>&reunion=<?php echo $taller ?>&horario='+e.id" class='btn btn-danger'>Cancelar</a></td>
            <td :class="['yes', ( e.is_typing == 'yes' && e.estado == 'disponible' ? 'no' : 'error' )] " id="info">escribiendo...</td>
          </tr>
          <?php
          if ($cantidad >= 1) { ?>
            <tr v-for="e in all_data3 ">
              <td>{{e.id}}</td>
              <td>Disponible</td>
              <td>{{e.horainicio}}-{{e.horafin}}</td>
              <td></td>
              <td><button class='btn btn-success' disabled>Inscribir</button> </td>
              </td>
              <td :class="['yes', ( e.is_typing == 'yes' && e.estado == 'disponible' ? 'no' : 'error' )] " id="info">escribiendo...</td>
            </tr>
          <?php } else { ?>
            <tr @click="activate(e.id)" @focusout="desactive(e.id)" :class="{ active : active_el == e.id }" v-for="e in all_data3 ">
              <td>{{e.id}}</td>
              <td>Disponible</td>
              <td>{{e.horainicio}}-{{e.horafin}}</td>
              <td colspan="2">
                <form action='Modelo/ModeloReunion/inscribir.php' method='post'>
                  <input type='hidden' name='id' :value="e.id">
                  <input type='hidden' name='horario' value='<?php echo $_GET["id"] ?>'>
                  <input type='hidden' name='reunion' value='<?php echo $_GET["reunion"] ?>'>
                  <input type='hidden' name='alumno' value='<?php echo $alumno ?>'>
                  <input type='text' class='form-control w-50 d-inline example' name='telefono' placeholder='0000-0000' pattern='[0-9]{4}-[0-9]{4}' title='El teleono debe ser en el formato 0000-0000' required>
                  <button type='submit' class='btn btn-primary d-inline ml-5' name='inscribir' value='Inscribir'>Inscribir</button>
                </form>
              </td>
              <td :class="['yes', ( e.is_typing == 'yes' && e.estado == 'disponible' ? 'no' : 'error' )] " id="info">escribiendo...</td>
            </tr>
          <?php
          } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
</div>

<script async>
  const taller = <?php echo $taller ?>;
  const horas = <?php echo $_GET["id"] ?>;
</script>
<!-- consultas para reuniones -->
<script async src="JS/vue.js"></script>

<?php require_once 'templates/footer.php'; ?>