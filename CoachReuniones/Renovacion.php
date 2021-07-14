<?php
//Modularidad para inicializar el Head y <!DOCTYPE html>
include 'Modularidad/CabeceraInicio.php';
?>
<title>Renovación</title>

<?php
//Modularaidad para extraere los enlaces en HEAD
include 'Modularidad/EnlacesCabecera.php';
//Incluir el menu horizontal
include 'Modularidad/MenuHorizontal.php';
require_once '../Conexion/conexion.php';

$ID = trim($_GET['id']);
$_SESSION['alumno'] = $ID;
foreach ($dbh->query("SELECT ID_Empresa FROM alumnos WHERE ID_Alumno = '" . $ID . "'") as $Uni) {
  $U = $Uni["ID_Empresa"];
}
foreach ($dbh->query("SELECT Nombre FROM alumnos WHERE ID_Alumno = '" . $ID . "'") as $ES) {
  $Alumno = $ES["Nombre"];
}
foreach ($dbh->query("SELECT imagen FROM usuarios WHERE nombre = '" . $Alumno . "'") as $PIC) {
  $FotoAlumno = $PIC["imagen"];
}
foreach ($dbh->query("SELECT COUNT(*) AS 'Condicion' FROM renovacion 
  WHERE ID_Alumno = '" . $ID . "' and Estado != 'eliminado'")  as $CON) {
  $condicion = $CON["Condicion"];
}

?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php

if (isset($_SESSION['noti'])) {
  echo $_SESSION['noti'];
  unset($_SESSION['noti']);
}
?>




<link rel="stylesheet" type="text/css" href="css/Renovacion.css">
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

  .modal-footer {
    border-color: #ADADB2;
    border: 3px;
  }
</style>
<div class="title">
  <a href="javascript:history.back();"><img src="../img/back.png" class="icon"></a>
  <h2 style="font-size: 25px;
    align-items: center;
    font-weight: bold;
    letter-spacing: 2px;margin-top: 10px;margin-left: 5px;">Renovaciones de Beca</h2>
</div>

<div>
  <div class="alerta">
    <?php include "../Alumno/config/Alerta.php" ?>
  </div>
</div>
<div id="body">
  <table id="table" class="table table-striped w-75 w-1">
    <?php

    if ($condicion < 1) {
      echo " <thead><td colspan='4' style='font-size: 18px;font-weight: bold;''>" . $Alumno . "</td></thead>";
      echo "<thead><td colspan='4'><img src='../img/imgUser/$FotoAlumno?>' alt='img de usuario' id='perfil'></td></thead>";
      echo "<td colspan='4' class='alert alert-danger'>Sin renovaciones de Beca</td>";
    } else {
    ?>
      </thead>
      <thead>
        <td colspan="5" style="font-size: 18px;font-weight: bold;"><?php echo $Alumno ?></td>
      </thead>
      <thead>
        <td colspan="5"><img src="../img/imgUser/<?php echo $FotoAlumno ?>" alt="img de usuario" id="perfil"></td>
        <thead class="table-dark">
          <tr>
            <th>Ciclo</th>
            <th>Año</th>
            <th>Estado</th>
            <th>Tipo</th>
            <th style="width: 40%;">Acciones</th>
        </thead>
      <tbody>
        <?php

        foreach ($dbh->query("SELECT idRenovacion,ciclo,year,direccion,Estado,ID_Alumno,tipo FROM renovacion 
  WHERE ID_Alumno = '" . $ID . "' AND Estado != 'eliminado' ORDER BY year DESC,ciclo DESC") as $datos) {

          $n = 1;

        ?>
          <tr>
            <td><?php echo $datos["ciclo"] ?></td>
            <td><?php echo $datos["year"] ?></td>
            <td><?php echo ucfirst($datos["Estado"]); ?></td>
            <td>
              <?php 
                if ($datos["tipo"] == 'renovacion') {
                  echo "Renovación de Beca";
                }elseif ($datos["tipo"] == 'condicionamiento') {
                  echo "Condicionamiento de Beca";
                }elseif ($datos["tipo"] == 'cancelacion') {
                  echo "Cancelación de Beca";
                }elseif ($datos["tipo"] == 'pausa') {
                  echo "Beca en Pausa";
                }else {
                  echo "Error en tipo";
                }
              ?>
            </td>
            <td>
              <div class="btn-grupo">
                <button type="button" value="<?php echo $datos['direccion'] ?>" class="btn btn-warning" data-toggle="modal" data-target="#mostrarPDF" id="direccion<?php echo $n ?>"><i class="fas fa-eye"></i>Ver PDF</button>
                <button type="button" value="<?php echo $datos['idRenovacion'] ?>" class="btn btn-success" data-toggle="modal" data-target="#subirPDF" id="archivo" onclick="obtener()"><i class="fas fa-user-edit"></i>Editar</button>
                <a id="btn" href="proceso-renovacion.php?cn=<?php echo $datos["idRenovacion"] ?>" class="btn btn-danger"><i class="fas fa-trash"></i>Eliminar</a>
            </td>
            <input type="hidden" name="id" id="id" value="<?php echo $datos['idRenovacion'] ?>">
            <input type="hidden" name="carne" value="<?php echo $datos['ID_Alumno'] ?>">
          </tr>
      <?php
          $n++;
        }
      }
      ?>
      </tbody>
  </table>
</div>
<center><button type="button" class="btn btn-primary  mx-auto " data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-upload"></i> Subir Carta</button></center>
</body>
<script>
  let dir = "";

  function obtener() {
    dir = document.getElementById("archivo").value
    document.getElementById("carta").innerHTML = `
          <label class="text-dark">ID carta</label>
          <input type="text" class="form-control" name='idCarta' readonly value='${dir}'>
        `;
  }
</script>
<!--VER PDF-->
<script>
  let temp = $("#btn1").clone();
  $("#btn1").click(function() {
    $("#btn1").after(temp);
  });
</script>

<script type="text/javascript">
  $(".btn-grupo button").click(function() {

    var dir = $('#direccionpdf').val($(this).val());

  })
</script>

<script type="text/javascript">
  $(document).ready(function($) {
    $(document).on('click', '#mostrar', function() {

      //obtenemos el id

      var dir = $('#direccionpdf').val();
      var idEditar = $('#id').val();
      $('#pdf2').html('<iframe  src="' + dir + '" width="700px" height="500px"></iframe>');
    });
    $(document).on('click', '#cerrar', function() {
      $('#pdf2').val('');
    });
    $(document).on('click', '#cerrar2', function() {
      $('#direccionpdf').val("");
    });
  });
</script>

<script type="text/javascript">
  window.onload = function() {
    $("table tbody tr").click(function() {
      // Tomar la captura la informaci���n  de la tabla 
      var id = $(this).find("td:eq(0)").text();
      document.getElementById('idRenovacion').value = id;
    });
  }
</script>

<!-- mostrar pdf -->
<div class="modal fade" id="mostrarPDF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form action="Modelo/ModeloRenovacion/procesoRenovacion.php" method="POST">
    <div class="modal-dialog modal-lg" role="document" style="width: 750px;margin: auto;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" id="mostrar" class="btn btn-success" style="margin:auto;">Mostrar</button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="idRenovacion" id="idRenovacion">
          <input type="hidden" name="direccionpdf" id="direccionpdf">
          <div id="pdf2" style="margin: 0 auto;"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Close</button>
        </div>
      </div>
    </div>
  </form>
</div>
<!-- modificar carta -->
<div class="modal fade" id="subirPDF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Carta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body m-2">
        <form action="Modelo/ModeloRenovacion/carta.php" method="post" enctype="multipart/form-data">
          <div id="carta">
          </div>
          <label class="text-dark">Universidad</label>
          <input name="uni" placeholder="año" readonly class="form-control w-3" value="<?php echo $U;  ?>"></input>
          <label class="text-dark">Ciclo</label>
          <select name="ciclo" class="form-control w-3">
            <option>1</option>
            <option>2</option>
          </select>
          <label class="text-dark">Tipo</label>
          <select name="tipo" class="form-control w-1">
            <option value="renovacion">Beca renovada</option>
            <option value="cancelacion">Beca cancelada</option>
            <option value="condicionamiento">Beca condicionada</option>
            <option value="pausa">Beca en pausa</option>
          </select>
          <label class="text-dark">Año</label>
          <input name="anio" placeholder="año" class="form-control w-3 p-2" value="<?php echo date("Y");  ?>"></input>
          <br>
          <div class="form-check">
            <input class="form-check-input" name="checkDocumento" type="checkbox" value="true" id="defaultCheck1" disabled>
            <label class="form-check-label text-dark" for="defaultCheck1">
              Modificación de documento
            </label>
            <input type="hidden" name="cambiarDocumento" value="" id="HcambiarDocumento">
          </div>
          <br>
          <div class="custom-file p-2">
            <input type="file" class="custom-file-input" accept=".pdf" id="customFileLangActualizar" name="archivo">
            <label class="custom-file-label" for="customFileLangActualizar" data-browse="Buscar">Seleccionar Carta</label>
            <center><small>El archivo no debe pesar más de 5MB</small></center>
          </div>
          <div>
            <!--idalumnos-->
            <input type="hidden" name="alumno" value="<?php echo $ID; ?>">
          </div>
      </div>
      <div class="modal-footer" style="margin-top: -30px;">
        <center><input style="border-radius: 20px;  border: 2px solid #9d120e;  width: 200px;height: 38px; background-color: #9d120e; color:white;margin-bottom: -10px;" type="submit" id="subirCarta" name="subirCarta" value="Guardar Cambios"></center>
      </div>
      </form>
    </div>
  </div>
</div>



<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Subir Carta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-auto">
        <form action="Modelo/ModeloRenovacion/subir.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <div>
              <div class="col mx-auto text-center">
                <label for="" class="text-dark" style="width: 300px;">Alumno</label>
                <input type="text" name="renovacion_alumno" class="form-control" readonly value=" <?php echo $ID ?>">
              </div>
            </div>
            <div>
              <div class="col mx-auto text-center">
                <label for="" class="text-dark">Universidad</label>
                <input type="text" name="renovacion_universidad" readonly class="form-control" value="<?php echo $U;  ?>" style="width: 300px;">
              </div>
            </div>
          </div>
          <div class="row">
            <div>
              <div class="col  text-center">
                <label for="" class="text-dark">Ciclo</label>
                <select name="renovacion_ciclo" class="form-control " style="width: 300px;">
                  <option>1</option>
                  <option>2</option>
                </select>
              </div>
            </div>
            <div>
              <div class="col  text-center">
                <label for="" class="text-dark">Tipo</label>
                <select name="renovacion_tipo" class="form-control " style="width: 300px;">
                  <option value="renovacion">Beca renovada</option>
                  <option value="cancelacion">Beca cancelada</option>
                  <option value="condicionamiento">Beca condicionada</option>
                  <option value="pausa">Beca en pausa</option>
                </select>
              </div>
            </div>
          </div>
          <div>
            <div class="row">
              <div class="col  text-center">
                <label for="" class="text-dark">Año</label>
                <input type="number" min="2007" name="renovacion_anio" placeholder="año" class="form-control" value="<?php echo date("Y");  ?>"></input>
              </div>
              <br>
              <div class="custom-file row m-2">
                <input type="file" class="custom-file-input" name="renovacion_archivo" accept=".pdf" id="inputGroupFile01" required>
                <label class="custom-file-label" for="inputGroupFile01">Elegir un archivo</label>
                <center><small>El archivo no debe pesar más de 5MB</small></center>
              </div>
            </div>
          </div>
          <br>
          <center><input name="subirRenovacion" class="btn mx-auto m-1" style="border-radius: 20px;  border: 2px solid #9d120e;  width: 200px;height: 38px; background-color: #9d120e; color:white;margin-bottom: -10px;" type="submit" value="Subir Datos"></center>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script type="text/javascript">
  document.getElementById("customFileLangActualizar").addEventListener("change", () => {
    let cant = document.getElementById("customFileLangActualizar").files.length;
    if (cant > 0) {
      document.getElementById("defaultCheck1").checked = true;
      document.getElementById("HcambiarDocumento").value = "true";
    }
  });
</script>

</html>