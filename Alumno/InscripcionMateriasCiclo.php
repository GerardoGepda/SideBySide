<?php
    if (!isset($_COOKIE['InscrpCiclo'])) {
       header('location: expedienteU.php'); 
    }
    require_once 'templates/head.php';
?>
<title>Inscripcion materias</title>
<?php
    require_once 'templates/header.php';
    require_once 'templates/MenuHorizontal.php';
    require '../Conexion/conexion.php';

    setlocale(LC_TIME, 'es_SV.UTF-8');
    //extraemos cookie con expediente, carnet, IDincripcion y ciclo
    $dataMInscrpataC = $_COOKIE['InscrpCiclo'];
?>

<!--///////////////////////////////////////////////-->
<!--Para ver el nombre del archivo que sube-->
<script type="text/javascript">
$(document).ready(function() {
    bsCustomFileInput.init()
});
</script>

<!--Fin de funcion-->
<!--///////////////////////////////////////////////-->




<!--Estructura -->
<div class="container-fluid text-center">
    <div class="title" style="margin-left: -14px;">
        <a href="javascript:history.back();"><img src="../img/proximo.svg" class="icon"></a>
        <h2 class="main-title">Inscripcion de materias</h2>

    </div>
    <br>
    <div class="alerta">
        <?php
    include "config/Alerta.php";
      ?>
    </div>
    <!--Información de solicitud-->
    <div class="row">

        <!--tabla con informacion de solicitud-->
        <div class="col text-center">
            <br><br><br>
            <?php 
    include "CSS/inscripcionMaterias.php";
    ?>

            <!--Tabla de buses de Ida -->
            <h3 class="card-header h3s bg-light w-75 mx-auto">Materias por cursar</h3>
            <div class='centerTable'>
                <table class="table-responsive mx-auto w-75">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Asignatura</th>
                            <th>Estado</th>
                            <th>Inscribir</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

        $sqlMaterias = "SELECT mt.idMateria, mt.Estado, nombreMateria, estadoM, Id_InscripcionC, idExpedienteU FROM materias mt LEFT JOIN inscripcionmateria imt ON mt.idMateria = imt.idMateria WHERE idExpedienteU = ?";

        $consulMaterias=$pdo->prepare($sqlMaterias);
        $consulMaterias->execute(array($dataMInscrpataC['idExpdt']));
        
        if ($consulMaterias->rowCount()>=1)
        {
           while ($fila2=$consulMaterias->fetch())
           { 
               if( $fila2['estadoM']!='Aprobada'){
                if ($fila2['estadoM'] !='Inscrita') {

                    echo "<tr>
                        <td >".$fila2[0]."</td>
                        <td class='oscuro'>".$fila2['nombreMateria']."</td>
                        <td >".$fila2[1]."</td>                
                        <td>
                        <center>
                         <button type='button' id=".$fila2[0]." class='btn btn-primary' data-toggle='modal' data-target='#ModalMateria' onclick='mandarId(id)' ><i class='fa fa-check'></i>
                         </button>
                        </center>
                        </td>
                      </tr>";     
                  }else if($fila2['Id_InscripcionC'] == $dataMInscrpataC['idInscrip'])
                     {
    
                       echo 
                       "<tr>
                             <td >".$fila2[0]."</td>
                             <td class='oscuro'>".$fila2['nombreMateria']."</td>
                             <td >".$fila2['estadoM']."</td>        
                             <td>
                        <center>
                        <a href='javascript:void(0)' data-toggle='modal' data-target='#modalFinal' class='btn btn-danger btn-icon-split'>
                        <i class='fa fa-ban'></i></a>
                        </center>
                        </td>
                      </tr>"; 
                       } //fin de else
    
                    
               }else{

               }
              
           }//fin de while
        }else{
              echo "<tr><td colspan='8'>No ha agregado ninguna Asignatura</td></tr>";
             }//fin de else-if                           
            ?>
                    </tbody>

                    <tfoot>

                    </tfoot>
                </table>
                <br>

                <div class='f1-buttons'>

                    <button id="terminarprocess" type='button' style="border-radius: 20px;
    border: 2px solid #9d120e;
    width: 200px;height: 38px;
     background-color: #9d120e;
     color:white;" data-toggle='modal' data-target='#TerminarInscrp'>Terminar proceso</button>
                </div>
                <br><br><br> <br>
            </div>
            <!--Fin Tabla-->
        </div>
    </div>
</div>


<!-- Modal Pensum carrera -->
<div class="modal fade" id="TerminarInscrp" tabindex="-1" role="dialog" aria-labelledby="ModalTerminarInscrp"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalTerminarInscrp">¿Desea terminar la inscripción?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    Al darle aceptar su proceso de inscripción terminará y su ciclo se incribirá
                </div>

                <?php
$date = date('Y');
?>

            </div>
            <div class="modal-footer">


                <button style="border-radius: 20px;
    border: 2px solid #515151;
    width: 100px;height: 38px;
     background-color: #515151;
     color:white;" type="submit" name="actualizar" data-dismiss="modal">Cancelar</button>
                <form action="DeleteCookieInscrp.php" method="POST">
                <input style="border-radius: 20px;
    border: 2px solid #9d120e;
    width: 200px;height: 38px;
     background-color: #9d120e;
     color:white;" type="submit" name="comprobante_Ciclo" value="Guardar Cambios" id="comprobante_Ciclo">
                </form>

            </div>
        </div>
    </div>
</div>


<!-- MODAL Materias -->
<!--**************-->
<div class="modal fade " id="ModalMateria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Inscripcion Materia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="Modelo/ModeloMaterias/inscripcionM.php" method="POST" accept-charset="utf-8">
                    <div id="alerta5"></div>
                    <div class="col">

                        <script type="text/javascript">
                        function mandarId(id) {
                            var prueba = id;
                            var prueba2 = id;

                            document.getElementById("mate").innerHTML = prueba2;
                            document.getElementById("Materia").value = prueba;

                        }
                        </script>
                        <div class="form-group">
                            <label class="" for="Materia">Codigo de materia:</label>
                            <input type="text" name="materia" id="Materia" class="Materia form-control">
                        </div>



                        <div class="form-group">
                            <label id="mate" style="margin-left:1%" for="matricula" hidden="hidden"></label>
                        </div>



                        <div class="form-group">
                            <label class="" for="matricula">Matricula:</label>
                            <small id="passwordHelpBlock" class="form-text text-muted">
                                Ingrese el número de veces que ha cursado la materia
                            </small>
                            <input type="number" name="matricula" min="0" max="10" placeholder=""
                                class="matricula form-control" id="matricula">
                        </div>
                    </div>

                    <input class="btn btn-primary btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit"
                        name="Inscribir_Materia" value="Inscribir Materia " id="Inscribir_Materia">
                </form>
            </div>
        </div>
    </div>

    <!-- FIN MODAL MATERIA -->
    <!--**********************-->
</div>


<!-- Modal de verificacion -->
<div class="modal fade" id="modalFinal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Desinscribir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <h3>¿Seguro desea desinscribir la materia?</h3>

                <form method="POST" action="Modelo/ModeloMaterias/eliminarInscripcion.php">

                    <input type="text" id="materia" class="form-control" disabled>
                    <input type="hidden" id="idmateria" class="form-control" name="idmateria">

                    <input type="hidden" name="idsoliTrans" value="<?php echo $dataMInscrpataC['idInscrip']; ?>">
                    <input type="hidden" name="alumno" value="<?php echo $dataMInscrpataC['alumnoCarnet']; ?>">

            </div>
            <div class="modal-footer">
                <input class="btn btn-primary btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit"
                    name="Desenscribir_Materia" value="Desenscribir Materia " id="Desenscribir_Materia">

                <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Desinscribir</button-->


            </div>
            </form>
        </div>
    </div>
</div>














</div>




<br><br>



<script type="text/javascript">
window.onload = function() {
    $("table tbody tr").click(function() {
        // Tomar la captura la información  de la tabla 
        var idmateria = $(this).find("td:eq(0)").text();
        document.getElementById('idmateria').value = idmateria;

        var nombre = $(this).find("td:eq(1)").text();
        document.getElementById('materia').value = nombre;



    });
}
</script>

<?php
  require_once 'templates/footer.php';
?>