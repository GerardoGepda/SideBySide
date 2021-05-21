<?php require_once 'templates/head.php'; ?>
<title>Horarios Disponibles</title>
<?php
require_once 'templates/header.php';
require_once 'templates/MenuHorizontal.php';
require '../Conexion/conexion.php';

setlocale(LC_TIME, 'es_SV.UTF-8');
$taller = $_GET["id"];
$tipoReunion = $_GET["typereu"];

//Extraemos el carnet del estudiante
$stmt1 = $dbh->prepare("SELECT `ID_Alumno` FROM `alumnos` WHERE correo='" . $_SESSION['Email'] . "'");
// Ejecutamos
$stmt1->execute();

while ($fila = $stmt1->fetch()) {
  $alumno = $fila["ID_Alumno"];
}

?>

<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<script async src="JS/AdmCupo.js"></script>
<div class="container-fluid text-center">
  <br>
  <h1 class="h1">Inscripción reuniones</h1>
  <br>
  <br>
  <div>
    <?php  include "config/Alerta.php";  ?>
  </div>
  <div class="row">
    <div class="col">
      <table class="table table-responsive-lg w-75 mx-auto float-center">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Hora inicio</th>
            <th>Hora final</th>
            <th>Cupo</th>
            <th>Duración por sesión</th>
            <?php
           if ($tipoReunion != "Sesión individual" && $tipoReunion != "Otro" && $tipoReunion != "Sesión Grupal" ) {
              echo "<th>Teléfono</th>";
              if ($result == 0) {
                echo "<th>Inscribir</th>";
              } else {
                echo "<th>Desinscribir</th>";
              }
            } else {
              echo "<th>Horarios</th>";
            }
            ?>
          </tr>
        </thead>
        <tbody class="bg-light table-bordered" id="tbody-reunion">
          <tr v-for="e in dinscrito">
            <td>{{e.HorarioInicio}}</td>
            <td>{{e.HorarioFinalizado}}</td>
            <td v-if="e.Tipo != 'Sesión individual' && e.Tipo != 'Otro' && e.Tipo  != 'Sesión Grupal' ">Ilimitado</td>
            <td v-else="">{{e.Canitdad}} </td>
            <td>{{e.TiempoReunion}} Minutos</td>
            <td v-if="e.Tipo != 'Sesión individual' && e.Tipo != 'Otro'  && e.Tipo  != 'Sesión Grupal' ">
              <input type="text" id='txttel' name="txttel" class="form-control-sm" v-on:keypress='validarTelefono($event)' v-model="valor" value="valor" placeholder="0000-0000" maxlength='9' required>
            </td>
            <td v-if="e.Tipo != 'Sesión individual' && e.Tipo != 'Otro' && e.Tipo != 'Sesión Grupal' ">
              <div v-if="verificado == 0">
                <button class='btn btn-warning' id='btninscribir' v-on:click='inscribir' title='Inscribir' value='btninscribir'>
                  <i class='fas fa-pen'></i></button>
                <!-- añadimos el boton desinscribir pero oculto para evitar errores en JS -->
                <button style='display: none' id='btndesinscribir' v-on:click='cancelar' value='btndesinscribir'></button>
              </div>
              <div v-else="">
                <button class='btn btn-danger' id='btndesinscribir' value='btndesinscribir' v-on:click='cancelar' title='Desinscribir'><i class='fas fa-ban'></i></button>
                <!-- añadimos el boton inscribir pero oculto para evitar errores en JS -->
                <button style='display: none' id='btninscribir' v-on:click='inscribir' value='btninscribir'></button>
              </div>
            </td>
            <td v-else="">
              <a v-bind:href="'listadoxReunion.php?id='+e.IDHorRunion+'&reunion='+e.ID_Reunion" class="btn btn-warning"><i class="fas fa-user-edit"></i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>
<!-- /#page-content-wrapper -->
<br><br><br><br><br><br><br><br><br><br>
</div>

<div id="dReunionDiv">
  <div v-for="e in infoReunion">
    <input type="hidden" id="idreunion" v-bind:value="e.ID_Reunion">
    <input type="hidden" id="idalumno" value="<?php echo $alumno; ?>">
    <input type="hidden" id="idhorario" v-bind:value="e.IDHorRunion">
    <input type="hidden" id="hinicio" v-bind:value="e.HorarioInicio">
    <input type="hidden" id="hfin" v-bind:value="e.HorarioFinalizado">
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAlerta" tabindex="-1" aria-labelledby="TmodalAlerta" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TmodalAlerta">Mensaje</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalAlerta-content">
        Debes rellenar el campo del número de teléfono, siguiendo el patrón 0000-0000
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Desinscribir -->
<div class="modal fade" id="modalDes" tabindex="-1" aria-labelledby="TmodalDes" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TmodalDes">Advertencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalAlerta-content">
        ¿Realmente desea borrar su inscripción de la reunión?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" id="btnModalDesinscribir" v-on:click='eliminar' data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Enlace con el JS para mandar datos de inscripción por Ajax -->
<script async>
  const taller = <?php echo $taller; ?>;
</script>

<script async>
  const tiporeunion = <?php echo $tipoReunion; ?>;
  console.log(tiporeunion);
</script>

<script async src="JS/CrearHorario.js"></script>
<?php require_once 'templates/footer.php'; ?>