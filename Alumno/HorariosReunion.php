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

?>

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
                echo "<th>Inscribir</th>";
              }else {
                echo "<th>Horarios</th>";
              }
            ?>
          </tr>
        </thead>


        <tbody class="bg-light table-bordered">
          <?php
          $vuelta = 0;
          while ($row = $stmt->fetch()) {
            //extraemos el id horario hinicio hfin para usarlo después
            $idHorario = $row['IDHorRunion'];
            $horainicio = $row["HorarioInicio"];
            $horafin = $row["HorarioFinalizado"];
            $vuelta++;
            echo "<tr>";
            echo "<td>" . $row["HorarioInicio"] . "</td>";
            echo "<td>" . $row["HorarioFinalizado"] . "</td>";
            if ($tipoReunion != "Sesión individual" && $tipoReunion != "Otro") {
              echo "<td>Ilimitado</td>"; 
            }else {
              echo "<td>" . $row["Canitdad"] . "</td>";
            }
            echo "<td>" . $row["TiempoReunion"] . " Minutos" . "</td>";
            if ($tipoReunion != "Sesión individual" && $tipoReunion != "Otro") {
              echo "<td><input type=\"text\" id='txttel' class=\"form-control-sm\" form=\"formulario" . $vuelta . "\" name=\"telefono\" placeholder=\"0000-0000\" maxlength='9' pattern=\"[0-9]{4}-[0-9]{4}\" title=\"El teleono debe ser en el formato '0000-0000'\" required></td>";
              
              echo "<td><button class=' btn btn-warning' id='btninscribir'><i class='fas fa-pen'></i></button></td>";
            }else {
              echo "<td><a href='listadoxReunion.php?id=" . $row['IDHorRunion'] . "&reunion=".$taller."' class='fas fa-user  btn btn-warning'></a></td>";
            }
            // echo "<td>";
            $verificar = "SELECT COUNT(`id_reunion`) as total FROM `inscripcionreunion` WHERE `id_alumno`='" . $alumno . "' AND `id_reunion`='" . $taller . "' AND `Horario`=" . $row["IDHorRunion"] . "";
            $stmt2 = $dbh->prepare($verificar);
            $stmt2->execute();

            $verificar2 = "SELECT `Canitdad` FROM `horariosreunion` WHERE `IDHorRunion`='" . $row["IDHorRunion"] . "'";
            $stmt3 = $dbh->prepare($verificar2);
            $stmt3->execute();

            $verificar3 = "SELECT COUNT(`id_reunion`) as total2 FROM `inscripcionreunion` WHERE `id_alumno`='" . $alumno . "' AND `id_reunion`='" . $taller . "'";
            $stmt4 = $dbh->prepare($verificar3);
            $stmt4->execute();

            while ($fila4 = $stmt4->fetch()) {
              $total2 = $fila4["total2"];
            }

            while ($fila2 = $stmt2->fetch()) {
              $total = $fila2["total"];
            }
            while ($fila3 = $stmt3->fetch()) {
              $cantidad = $fila3["Canitdad"];
            }



            // if ($cantidad > 0) {


            //   if ($total2 == 1) {
            //     if ($total > 0) {
            //       echo "<form action=\"inscribirReunion.php\" method=\"POST\" id=\"formulario2" . $vuelta . "\">";
            //       echo "<input type=\"text\" name=\"reunion\" value='" . $taller . "' hidden>
            //             <input type=\"text\"  name=\"horario\" value='" . $row["IDHorRunion"] . "' hidden>
            //             <input type=\"text\" name=\"alumno\" value='" . $alumno . "' hidden>
            //             <input type=\"number\" name=\"inscribir\" value=\"0\" hidden>";

            //       echo "<button type=\"submit\" form=\"formulario2" . $vuelta . "\" class=\"btn btn-warning\"><i class=\"fas fa-times\"></i> Desinscribir</button>";
            //       echo "</form>";
            //     }
            //   } else {
            //     if ($total == 0) {
            //       echo "<form action=\"inscribirReunion.php\" method=\"POST\" id=\"formulario" . $vuelta . "\">";
            //       echo "<input type=\"text\" name=\"reunion\" value='" . $taller . "' hidden>
            //             <input type=\"text\" name=\"horario\" value='" . $row["IDHorRunion"] . "' hidden>
            //             <input type=\"text\" name=\"alumno\" value='" . $alumno . "' hidden>
            //             <input type=\"number\" name=\"inscribir\" value=\"1\" hidden>";

            //       echo "<button type=\"submit\" form=\"formulario" . $vuelta . "\" class=\"btn btn-primary\"><i class=\"fas fa-check\"></i> Inscribir</button>";
            //       echo "</form>";
            //     } elseif ($total > 0) {
            //       echo "<form action=\"inscribirReunion.php\" method=\"POST\" id=\"formulario2" . $vuelta . "\">";
            //       echo "<input type=\"text\" name=\"reunion\" value='" . $taller . "' hidden>
            //             <input type=\"text\" name=\"alumno\" value='" . $alumno . "' hidden>
            //             <input type=\"number\" name=\"inscribir\" value=\"0\" hidden>";

            //       echo "<button type=\"submit\" form=\"formulario2" . $vuelta . "\" class=\"btn btn-warning\"><i class=\"fas fa-times\"></i> Desinscribir</button>";
            //       echo "</form>";
            //     }
            //   }
            // } else {
            //   if ($total > 0) {
            //     echo "<form action=\"inscribirReunion.php\" method=\"POST\" id=\"formulario2" . $vuelta . "\">";
            //     echo "<input type=\"text\" name=\"reunion\" value='" . $taller . "' hidden>
            //           <input type=\"text\"  name=\"horario\" value='" . $row["IDHorRunion"] . "' hidden>
            //           <input type=\"text\" name=\"alumno\" value='" . $alumno . "' hidden>
            //           <input type=\"number\" name=\"inscribir\" value=\"0\" hidden>";

            //     echo "<button type=\"submit\" form=\"formulario2" . $vuelta . "\" class=\"btn btn-warning\"><i class=\"fas fa-times\"></i> Desinscribir</button>";
            //     echo "</form>";
            //   } else {
            //     echo "El cupo se encuentra lleno";
            //   }
            // }
            // echo "</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
        <div>
          <input type="hidden" id="idreunion" value="<?php echo $taller;?>"> 
          <input type="hidden" id="idalumno" value="<?php echo $alumno;?>"> 
          <input type="hidden" id="idhorario" value="<?php echo $idHorario;?>">
          <input type="hidden" id="hinicio" value="<?php echo $horainicio;?>">
          <input type="hidden" id="hfin" value="<?php echo $horafin;?>">
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

<script>
  $(document).ready(function() {
    var table = $('#data').DataTable({

      "scrollX": true,
      "scrollY": "50vh",
      //Esto sirve que se auto ajuste la tabla al aplicar un filtro
      "scrollCollapse": true,

      language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
          "first": "Primero",
          "last": "Ultimo",
          "next": "Siguiente",
          "previous": "Anterior"
        }
      },

      initComplete: function() {
        //En el columns especificamos las columnas que queremos que tengan filtro
        this.api().columns([1, 2, 3]).every(function() {
          var column = this;

          var select = $('<select><option value=""></option></select>')
            .appendTo($(column.header()))
            .on('change', function() {
              var val = $.fn.dataTable.util.escapeRegex(
                $(this).val().trim()
              );
              column
                .search(val ? '^' + val + '$' : '', true, false)
                .draw();
            });
          //Este codigo sirve para que no se active el ordenamiento junto con el filtro
          $(select).click(function(e) {
            e.stopPropagation();
          });
          //===================

          column.data().unique().sort().each(function(d, j) {
            // select.append('<option value="' + d + '">' + d + '</option>')

            select.append('<option value="' + d + '">' + d + '</option>')

          });
        });
      },
      "aoColumnDefs": [{
        "bSearchable": false
        //"aTargets": [ 1] sirve para indicar que columna no queremos que funcione el filtro
      }]
    });
    //********Esta bendita linea hace la magia, adjusta el header de la tabla con el body
    table.columns.adjust();
  });
</script>
</div>

<!-- Enlace con el JS para mandar datos de inscripción por Ajax -->
<script src="JS/SaveCupo.js"></script>

<!-- /#wrapper -->


<?php
require_once 'templates/footer.php';
?>