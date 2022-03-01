<?php require_once 'templates/head.php';?>
<title>Indicaciones inscripción</title>
 <link rel="stylesheet" href="assets1/css1/style.css">
<?php  
  
  //Manda  allamar plantillas
  require_once 'templates/header.php';

  //require_once 'templates/MenuVertical.php';

  require_once 'templates/MenuHorizontal.php';

  require '../Conexion/conexion.php';


    //Carnet del alumno
    $alumno;
    $stmt1 =$dbh->prepare("SELECT `ID_Alumno`  FROM `alumnos` WHERE correo='".$_SESSION['Email']."'");
    $stmt1->execute();
     while($fila = $stmt1->fetch()){
       $alumno=$fila["ID_Alumno"];
     }//Fin de while 



     // Expediente U
    $consulta=$pdo->prepare("SELECT idExpedienteU  FROM expedienteu WHERE ID_Alumno = ? AND estado = 'Activo'");
 
    $consulta->execute(array($alumno));
    $idExpedienteU;
     if ($consulta->rowCount()>=1)
     {
       while ($fila=$consulta->fetch())
       {   
         $idExpedienteU = $fila['idExpedienteU'];
       }
     }//fin de condicion


  
$CL="CL";
$n1="-";
$n2=mt_rand(1,9);
$n3=mt_rand(1,9);
$n4=mt_rand(1,9);
$n5=mt_rand(1,9);
$n6=mt_rand(1,9);

 //Generamos el id con el año y 4 numeros random
//codigo inscripcion ciclo
 $inscriC= $CL."".$n1."".$n2."".$n3."".$n4."".$n5."".$n6;
  $comp=1;



  while ($comp==1) {
      //Comprobamos que no exista otro igual
        $query=$pdo->prepare("SELECT COUNT(`idExpedienteU`) AS existe FROM `inscripcionciclos` WHERE `idExpedienteU`='".$inscriC."'");
        $query->execute();
        $existe;
        if ($query->rowCount() >0)
        {
          $r=$query->fetch();
          $existe = $r['existe'];
        }
        //Comprobamos que no exista
        if ($existe>=1) {
         $n1="-";
          $n2=mt_rand(1,9);
          $n3=mt_rand(1,9);
          $n4=mt_rand(1,9);
          $n5=mt_rand(1,9);
      $n6=mt_rand(1,9);
          // Si existe generamos otro id con el año y 4 numeros random
          $inscriC= $CL."".$n1."".$n2."".$n3."".$n4."".$n5."".$n6;
        }else {
          $comp=2;
        }
    }



 ?>

<!--div principal-->
<div class="container-fluid text-center">
<div class="title">
    <a href="javascript:history.back();"><img src="../img/proximo.svg" class="icon"></a>
	<h2 class="main-title" >Requerimiento de inscripcion</h2>
  <br>
</div> 
  <div>
    <div>

    <div class="alerta my-2">
      <?php
        include "config/Alerta.php";
      ?>
    </div>

    <div class="container">
          <h2>Inscripción de materias</h2>
          <br>
          <br>
          <br>
           <div class="row">
             
              <!--Primera columna-->
                  <div class="col-sm">
                    <div class="col-sm-12 col-xs-12 col-md-12" id="requisitos">

                    <ul style="text-align: justify; color: black;" >
                           <h3 style="color: #BF3E3E;">Requisitos</h3>
                           <br>
                            <li>Ser becario activo del Programa Oportunidades.</li>
                            <li>Debera inscribir previamente su pensum</li>
                            

                               
                         </ul>
                        <br>
                    </div>
                   
                        
                      
                        <br>
                        <div class="col-sm-12 col-xs-12 col-md-12" id="archivos">

                        <ul style="text-align: justify; color: black; ">
                          <h4 style="color: #BF3E3E;">Archivos</h4>
                          <br>
                          
                           <li>Debera escanear el comprobante de inscipcion de materias que le proporciona su Universidad.</lil>
                           <li>Tambien sera necesario que en el mismo documento se encuentre su horario de clases.</lil>
                               
                        </ul>
                      <br>
                        </div>
                        

                   </div>

               <!-- Fin Primera columna-->

       <br>
                 <div class="col-sm" id="pasos" style="background-color: #c7c7c7">

                         <ol style="text-align: justify; color: black;" >
                            <h3 style="color: #BF3E3E;">Pasos:</h3>
                            <br>
                            <li>Seleccionar el ciclo a inscribir y agregar su comprobante de inscripción y su horario escaneado en un documento con formato pdf.</li>
                            <li>Luego se le presentará un formulario donde creara el listado de las asignaturas que tendra que cursar en su respectivo ciclo.</li>
                           
     
                         </ol>


                       
                         
                         <div class="alert" style="width: 80%; height:105px; text-align: justify; color: #BF3E3E; ">
                         <img src="../img/alert.svg" class="img-fluid">
                           <p>  <b>Nota:</b><i> No se recibiran solicitudes con documentación incompleta.</i></p>
                           <br>
                           
                         </div>
                      
         

     
                      
                       <ol>
                         <!-- <form style="text-align: justify;color: white;" name="form" action="Modelo/ModeloMaterias/GuardarInscriCiclo.php" method="post"> -->

                           <label for="checkbox" class="agree" style="color:black;"><input type="checkbox"  class="checkbox" name="checkbox" id="chbxiniciarprocs" onclick= "enableSending();"/> <i>Acepto que he leido completamente la información y los requerimientos para la inscripcion de materias.</i></label>

                          <center>
                          <button style="background: #1C1C1C;" class="submit btn btn-dark" id="Guardar_InscriCiclo"  name = "Guardar_InscriCiclo" disabled="disabled" data-toggle="modal" data-target="#ModalCiclo">Iniciar proceso</button>                          
                          </center>
                         <!-- </form> -->
          

                       </ol>
                       <br>
      

  
              <!--Funcion que habilita y desabilita el boton de aceptacion terminos-->
                <script>
                   function enableSending() {
                   const chbxvalue = document.querySelector('#chbxiniciarprocs').checked;
                   const btninit = document.querySelector('#Guardar_InscriCiclo');

                   if (chbxvalue) {
                     btninit.removeAttribute("disabled");
                   }else {
                    btninit.setAttribute("disabled", "disabled");
                   }
                  }

                </script>

             </div> <!--Fin segunda columna-->

    
           </div> <!--Fin de row-->


         </div><!--Fin de container-->

       </div> 

     </div>
  </div> 
  <br>
  <br>
</div><!-- Fin de div principal-->

<!-- /#page-content-wrapper -->



</div>

</div>

<!-- /#wrapper -->


<!--**********************-->
<!-- INICIO MODAL I. CICLO -->
<div class="modal fade " id="ModalCiclo" tabindex="-1" role="dialog" aria-labelledby="ModalCicloLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalCicloLabel">Inscripcion de ciclo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="Modelo/ModeloMaterias/GuardarInscriCiclo.php" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
                    <div class="col">
                        <div class="form-group">
                            <label class="" for="ciclo">Ciclo:</label>
                            <select name="ciclo" id="ciclo" class="ciclo form-control">
                                <!-- año 2015 -->
                                <option disabled>2015</option>
                                <option value="Ciclo 01-2017">Ciclo 01-2015</option>
                                <option value="Ciclo 02-2017">Ciclo 02-2015</option>
                                <option value="Ciclo 03-2017">Ciclo 03-2015</option>
                                <!-- año 2016 -->
                                <option disabled>2016</option>
                                <option value="Ciclo 01-2017">Ciclo 01-2016</option>
                                <option value="Ciclo 02-2017">Ciclo 02-2016</option>
                                <option value="Ciclo 03-2017" title="Interciclo">Ciclo 03-2016</option>
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
								<!-- año 2022 -->
                                <option disabled>2022</option>
                                <option value='Ciclo 01-2022'>Ciclo 01-2022</option>
                                <option value='Ciclo 02-2022'>Ciclo 02-2022</option>
                                <option value='Ciclo 03-2022' title="Interciclo">Ciclo 03-2022</option>
                            </select>
                            <input type="hidden" name="expediente" value="<?php echo  $idExpedienteU; ?>">
                            <input type="hidden" name="inscriCiclo" value="<?php echo  $inscriC; ?>">
                            <input type="hidden" name="alumno" value="<?php echo  $alumno; ?>">
                        </div>

                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" accept=".pdf" id="customFileLang" name="archivo" required>
                                <label class="custom-file-label" for="customFileLang" data-browse="Buscar">Seleccionar Comprobante</label>
                                <center><small>El archivo no debe pesar más de 5MB</small></center>
                            </div>
                        </div>
                    </div>
                    <input class="btn btn-danger btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="Guardar_InscriCiclo" value="Inscribir ciclo " id="Grdins_ciclo">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- FIN MODAL I. CICLO -->
<!--**********************-->

<script type="text/javascript">
$(document).ready(function() {
    bsCustomFileInput.init()
});
</script>

 <?php

  require_once 'templates/footer.php';

?>