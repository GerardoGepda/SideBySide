<?php
require_once 'templates/head.php';
?>
<title>Horarios Disponibles</title>
<?php
require_once 'templates/header.php';
//require_once 'templates/MenuVertical.php';
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


$mesActual = date("m");
$idHorario;
$horainicio;
$horafin;
$stmt = $dbh->prepare("SELECT `IDHorRunion`, `HorarioInicio`, `HorarioFinalizado`, `Canitdad`, `TiempoReunion` FROM `horariosreunion` WHERE `ID_Reunion`='" . $taller . "'");
// Ejecutamos
$stmt->execute();

//validando si ya se inscribio el alumno.
$query = $dbh->prepare("SELECT COUNT(id_alumno) FROM inscripcionreunion WHERE id_alumno = ? AND id_reunion = ?");
$rowInscrito = $query->execute([$alumno, $taller]);
$rowInscrito = $query->fetch();
$result = (int)$rowInscrito[0];
?>

<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>

<div class="container-fluid text-center">
  <br>
  <h1 class="h1">Inscripción reuniones</h1>
  <br>
  <br>
  <div>
    <?php
    include "config/Alerta.php";
    ?>
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
            if ($tipoReunion != "Sesión individual" && $tipoReunion != "Otro") {
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
            <td v-if="e.Tipo != 'Sesión individual' && e.Tipo != 'Otro'">
              Ilimitado
            </td>
            <td v-else="">
              {{e.Canitdad}}
            </td>
            <td>{{e.TiempoReunion}} Minutos</td>
            <td v-if="e.Tipo != 'Sesión individual' && e.Tipo != 'Otro'">
              <input type="text" id='txttel' class="form-control-sm" form="formulario" name="telefono" placeholder="0000-0000" maxlength='9' pattern="[0-9]{4}-[0-9]{4}" title="El teleono debe ser en el formato '0000-0000'" required>
            </td>
            <td>
              <?php
                if ($result == 0) {
                  echo "<button class='btn btn-warning' id='btninscribir' title='Inscribir'><i class='fas fa-pen'></i></button>";
                  //añadimos el boton desinscribir pero oculto para evitar errores en JS
                  echo "<button style='display: none' id='btndesinscribir'></button>";
                }else {
                  echo "<button class='btn btn-danger' id='btndesinscribir' title='Desinscribir'><i class='fas fa-ban'></i></button>";
                  //añadimos el boton inscribir pero oculto para evitar errores en JS
                  echo "<button style='display: none' id='btninscribir'></button>";
                }
              ?>
            </td>
          </tr>
        </tbody>
      </table>
      <div>
        <input type="hidden" id="idreunion" value="<?php echo $taller; ?>">
        <input type="hidden" id="idalumno" value="<?php echo $alumno; ?>">
        <input type="hidden" id="idhorario" value="<?php echo $idHorario; ?>">
        <input type="hidden" id="hinicio" value="<?php echo $horainicio; ?>">
        <input type="hidden" id="hfin" value="<?php echo $horafin; ?>">
      </div>
    </div>
  </div>

</div>
<!-- /#page-content-wrapper -->
<br><br><br><br><br><br><br><br><br><br>
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
        <button type="button" class="btn btn-danger" id="btnModalDesinscribir" data-dismiss="modal">Aceptar</button>
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
<!-- <script src="JS/AdmCupo.js"></script> -->
<script>
const btnInscribir = document.getElementById("btninscribir");
const btnDes = document.getElementById("btndesinscribir");
const btnDesinscribir = document.getElementById("btnModalDesinscribir");
const telefono = document.getElementById("txttel");
let exprs = new RegExp("([0-9]){4}-([0-9]){4}");

console.log("ok");

//evento del boton inscribir
btnInscribir.addEventListener("click", () => {
    if (exprs.test(telefono.value)) {
        GuardarCupo(telefono.value);
    }else{
        $("#TmodalAlerta").html("¡Advertencia!");
        $("#modalAlerta-content").html("Debes rellenar el campo del número de teléfono, siguiendo el patrón 0000-0000.");
        $('#modalAlerta').modal('show');
    }
});

//evento del campo telefono
telefono.addEventListener('keypress', (e) => { 
    if (RegExp("([0-9])").test(e.key)) {
        if (telefono.value.length == 4) {
            telefono.value += "-";
        }
    }else{
        e.preventDefault();
    }
});

//funcion que guarda la inscripcion o cupo
function GuardarCupo(telefono) {

    const reunion = document.getElementById("idreunion").value;
    const alumno = document.getElementById("idalumno").value;
    const horario = document.getElementById("idhorario").value;
    const horaIn = document.getElementById("hinicio").value;
    const horaFin = document.getElementById("hfin").value;

    const datos = {
        idalumno: alumno,
        idreunion: reunion,
        horario: horario,
        telefono: telefono,
        hinicio: horaIn,
        hfin: horaFin,
        inscribir: true
    };

    $.ajax({
        type: "POST",
        url: "./Modelo/ModeloReunion/inscrSinCupo.php",
        data: datos,
        success: function (response) {
            const result = JSON.parse(response);
            if (result.estado == "ok") {
                $("#TmodalAlerta").html("Respuesta");
                $("#modalAlerta-content").html(result.mensaje);
                $('#modalAlerta').modal('show');
                setTimeout(function(){
                    window.location = "AlumnoReuniones.php";
                },2000);  
            }else {
                $("#TmodalAlerta").html("Respuesta");
                $("#modalAlerta-content").html(result.mensaje);
                $('#modalAlerta').modal('show');
            }
        }
    });
}

//evento del boton para mostrar el modal de desinscribir
btnDes.addEventListener("click", () => {
    console.log();
    $('#modalDes').modal('show');
});

btnDesinscribir.addEventListener("click", () => {
    const reunion = document.getElementById("idreunion").value;
    const alumno = document.getElementById("idalumno").value;

    const datos = {
        idalumno: alumno,
        idreunion: reunion,
        desinscribir: true
    };

    console.log("des", datos);

    $.ajax({
        type: "POST",
        url: "./Modelo/ModeloReunion/inscrSinCupo.php",
        data: datos,
        success: function (response) {
            const result = JSON.parse(response);
            if (result.estado == "ok") {
                $("#TmodalAlerta").html("Respuesta");
                $("#modalAlerta-content").html(result.mensaje);
                $('#modalAlerta').modal('show');
                setTimeout(function(){
                    window.location = "AlumnoReuniones.php";
                },2000);    
            }else {
                $("#TmodalAlerta").html("Respuesta");
                $("#modalAlerta-content").html(result.mensaje);
                $('#modalAlerta').modal('show');
            }
        }
    });
    
});
</script>
<!-- /#wrapper -->


<?php
require_once 'templates/footer.php';
?>