<?php require_once 'templates/head.php'; ?>
<title>Indicaciones Renovacion</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
 <link rel="stylesheet" href="assets1/css1/style.css">
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 
<?php  
  
  //Manda  al llamar plantillas
  require_once 'templates/header.php';

  //require_once 'templates/MenuVertical.php';

  require_once 'templates/MenuHorizontal.php';

  require '../Conexion/conexion.php';


    //Carnet del alumno
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

//Extraer ID Inscripcion ciclo 
       // Consulta que muestra el idciclo del expediente correspondiente
       //dependiendo del expediente asi se l mostrara los datos
       $consultaIC=$pdo->prepare("SELECT Id_InscripcionC FROM inscripcionciclos WHERE idExpedienteU = ? ");
       $consultaIC->execute(array($idExpedienteU));
       $Id_InscripcionC;
         if ($consultaIC->rowCount()>=1)
         {
            while ($fila=$consultaIC->fetch())
            {   
             $Id_InscripcionC = $fila['Id_InscripcionC'];
            }
         }

setlocale(LC_TIME, 'es_SV.UTF-8');

  //Extraemos el carnet del estudiante
  $stmt1 =$dbh->prepare("SELECT `ID_Alumno`, `ID_Empresa` FROM `alumnos` WHERE correo='".$_SESSION['Email']."'");
  // Ejecutamos
  $stmt1->execute();

  while($fila = $stmt1->fetch()){
      $alumno=$fila["ID_Alumno"];
      $universidad=$fila["ID_Empresa"];
  }

  foreach ($pdo->query("SELECT Nombre,SedeAsistencia,Class FROM alumnos WHERE ID_Alumno = '".$alumno."'") as $Name) {
  $Nombre = $Name['Nombre'];
  $SC = $Name['SedeAsistencia'];
  $Class = $Name['Class'];
}
$Sede = substr($SC, 0, 2);
$Modalidad = substr($SC, 2, 2);
$formato = utf8_decode($Nombre)." ".$universidad." ".$Sede." ".$Modalidad." ".$Class;
$direccion = $_SERVER['PHP_SELF'];
 ?>
<!--///////////////////////////////////////////////-->
<!--Para ver el nombre del archivo que sube-->

  </script>
  
  <!--Fin de funcion-->
  <!--///////////////////////////////////////////////-->

<!--div principal-->
<div class="container-fluid text-center">
  <style type="text/css">
     .modal-content{
  background-color: white;
  border-color: black;
  border-radius: 30px;
  padding: 20px;
}
.modal-body{
  text-align: left;
}

.form-control{
  background-color: #ADADB2;
  color: black;
  border-radius: 20px;

}
.modal-header{
  border-color: #ADADB2;
  border:3px;
}
.modal-footer{
  border-color: #ADADB2;
  border:3px;
}
 </style>
 <script type="../js/alertify.js"></script>
 <link rel="stylesheet" type="text/css" href="../css/alertify.core.css">
 <link rel="stylesheet" type="text/css" href="../css/alertify.default.css">
<div class="title">
    <a href="javascript:history.back();"><img src="../img/proximo.svg" class="icon"></a>
	<h2 class="main-title" >Renovación de beca</h2>
  <br>
</div> 
  <div>
    <div>
                             
    <div class="container" style="">
      <?php
     session_start();
      if (isset($_SESSION['noti']) && $_SESSION['noti'] != "") {
        echo $_SESSION['noti'];
        unset($_SESSION['noti']);
        $_SESSION['noti'] = "";
      }else if(isset($_SESSION['error']) && $_SESSION['error'] != ""){
        echo $_SESSION['error'];
        unset($_SESSION['error']);
        $_SESSION['error'] = "";
      }
      ?>
<a href="historialRenovacion.php?id=<?php echo $alumno ?>"
style="border-radius: 20px;
    border: 2px solid #9d120e;
    width: 200px;height: 38px;
     background-color: #9d120e;
     color:white;margin-bottom: -10px;float:right;font-size:18px;text-decoration:none"><i class="fa fa-file-pdf" style="margin-right:8px;" ></i>Historial</a>
              <!--Primera columna-->
          <h2>Indicaciones Generales</h2>
          <br>
          <br>
          <br>
           <div class="row">

                  <div class="col-sm">
                    <div class="col-sm-12 col-xs-12 col-md-12" id="requisitos">

                    <ul style="text-align: justify; color: black;" >
                           <h3 style="color: #BF3E3E;">Requisitos</h3>
                           <br>
                            <li>Ser becario activo del Programa Oportunidades.</li>
                            <li>Haber cumplido con todos los requisitos que usted ya conoce como parte de su responsabilidad como alumno becado del Programa Oportunidades.</li>
                            <li>Enviar el documento dentro de la fecha estipulada.</li>

                               
                         </ul>
                        <br>
                    </div>
                   
                        
                      
                        <br>
                        <div class="col-sm-12 col-xs-12 col-md-12" id="archivos">

                        <ul style="text-align: justify; color: black; ">
                          <h4 style="color: #BF3E3E;">Archivos</h4>
                          <br>
                          
                           <li>Tendrá que adjuntar la carta de renovación de beca debidamente firmada y con la información necesaria en formato PDF.</li>
                           
                               
                        </ul>
                   
                        </div>
                        

                   </div>

               <!-- Fin Primera columna-->

                 <div class="col-sm" id="pasos" style="background-color: #c7c7c7">

                         <ol style="text-align: justify; color: black;" >
                            <h3 style="color: #BF3E3E;">Pasos:</h3>
                            <br>
                            <li>Leer la información completa del PDF que se les proporciona.</li>
                            <li>Completar y llenar el PDF con sus datos personales,el archivo que envie en PDF tiene debe tener la siguiente información: nombre completo, universidad ( siglas por ejemplo ESEN, UDB UJMD, UCA etc…) sede, modalidad y promoción, si no trae esta información quedara como invalida su carta de renovación.</li>
                           
     
                         </ol>
                         <div class="alert" style="width: 80%; height:105px; text-align: justify; color: #BF3E3E; ">
                         <img src="../img/alert.svg" class="img-fluid">
                           <p>  <b>Nota:</b><i> No se recibirán cartas de renovación con documentación incompleta.</i></p>
                           
                           
                         </div>
                      
                       <ol>
                         <form style="text-align: justify;color: white;" name="form" action="Modelo/ModeloRenovacion/carta.php" method="post">

                           <label for="checkbox" class="agree" style="color:black;"><input type="checkbox"  class="checkbox" name="checkbox" id="checkbox" onclick= "enableSending();"/> <i>Acepto que he leido completamente la información y los requerimientos para la renovacion de becas.</i></label>

                       
                        <!--ID Expediente U
                           <input type="hidden" name="expediente" value="<?php echo  $idExpedienteU;  ?>"> 
                        
                        
                        <input type="hidden" name="inscriCiclo" value="<?php echo  $inscriC;  ?>"> -->
                        


                         
                          <center>
                        <button type="button" class="btn btn-dark px-3" data-toggle="modal" data-target="#ModalPdf" style="border-radius: 20px;border: 2px solid ;width: 205px;height: 38px" id="GuardarRenovacion"  name = "GuardarRenovacion" disabled="disabled" > <i class="fa fa-file-pdf"></i> Subir Carta</button>
                                                    </center>
                         </form>
          

                       </ol>
                       <br>
      

  
              <!--Funcion que habilita y desabilita el boton de aceptacion terminos-->
                <script>
                   function enableSending() {
                   document.form.GuardarRenovacion.disabled = !document.form.checkbox.checked;
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
<div class="modal fade" id="ModalPdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Carta</h5>        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <!--<div class="alert alert-danger" style="height: 60px;margin-bottom: -10px;">
           <p style="font-size: 13px;text-align: center;">Debe de escribir el nombre del archivo  de la siguiente manera: <span style="font-style: italic; "><?php echo $formato ?>.pdf</span></p>
        </div>-->
       
        <br>
        <form action="Modelo/ModeloRenovacion/carta.php" method="post" enctype="multipart/form-data">
          <label >Universidad</label>
        <input name="uni" placeholder="año" readonly class="form-control" value="<?php echo $universidad;  ?>" ></input>
        <br>
        <label >Ciclo</label>
        <select name="ciclo" class="form-control">
          <option>1</option>
          <option>2</option>
        </select>
        <br>

        <label >Tipo</label>
        <select name="tipo" class="form-control">
          <option value="renovacion">Renovación de beca</option>
          <option value="cancelacion">Beca cancelada</option>
          <option value="condicionamiento">Beca condicionada</option>
          <option value="pausa">Beca pausada</option>
        </select>
        <br>
        <label >Año</label>
        <input name="year" type="number" placeholder="año" class="form-control" value="<?php echo date("Y");  ?>" ></input>
        <br>
          <div class="custom-file" style="color:black;">
          <input type="file" class="custom-file-input" accept=".pdf" id="customFileLang" name="archivo" required style="color:black;">
          <label class="custom-file-label" for="customFileLang" data-browse="Buscar" style="color:black;">Seleccionar Carta</label>
          <center><small>El archivo no debe pesar más de 5MB</small></center>
        </div>
        <br><br>

<div>

          <?php 
            $stmt1 =$dbh->prepare("SELECT `ID_Alumno`  FROM `alumnos` WHERE correo='".$_SESSION['Email']."'");
                      
            $stmt1->execute();

            while($fila = $stmt1->fetch()){
              $alumno=$fila["ID_Alumno"];
                                
            }
            ?>

        
        <!--idalumnos-->
        <input type="hidden" name="alumno" value="<?php echo $alumno;?>"> 

        <!--id expedente-->
        <input type="hidden" name="expediente" value="<?php echo $idExpedienteU;?>"> 

        <input type="hidden" name="idInscripcionCiclo" value="<?php echo $Id_InscripcionC;?>">  
      </div>

      </div>

      <div class="modal-footer" style="margin-top: -30px;">
        
          <center><input style="border-radius: 20px;
    border: 2px solid #9d120e;
    width: 200px;height: 38px;
     background-color: #9d120e;
     color:white;margin-bottom: -10px;" type="submit" id="subirCarta" name="subirCarta" value="Guardar Cambios"></center>
      </div>

      </form>
    </div>
  </div>
</div>


</div>

</div>

<!-- /#wrapper -->





 <?php

require_once 'templates/footer.php';


?>