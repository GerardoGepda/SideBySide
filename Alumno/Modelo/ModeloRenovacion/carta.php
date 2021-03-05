<?php 
if (isset($_POST['subirCarta']) && $_POST['subirCarta'] != null && !(empty($_POST['subirCarta'])))
{
    require '../../../Conexion/conexion.php';
    require '../../../BaseDatos/conexion.php';
  session_start();
try {
$nombreArchivo=$_FILES["archivo"]["name"];
$direccion= $_FILES["archivo"]["tmp_name"];
$ciclo=$_POST['ciclo'];
$year=$_POST['year'];
$alumno=$_POST['alumno'];
$tipoarchivo = $_FILES["archivo"]["type"];
$tamaño = $_FILES["archivo"]["size"];
$rutaarchivo=$_FILES["archivo"]["tmp_name"];
$universidad=$_POST['uni'];
$tipo = $_POST['tipo'];
foreach ($dbh->query("SELECT Nombre,LEFT(alumnos.Nombre,LOCATE(' ',alumnos.Nombre) - 1) AS 'name',SedeAsistencia,Class,correo FROM alumnos WHERE ID_Alumno = '".$alumno."'") as $Name) {
  $Nombre = $Name['Nombre'];
  $SC = $Name['SedeAsistencia'];
  $Class = $Name['Class'];
  $correo = $Name['correo'];
  $lN = $Name['name'];
}

$Sede = substr($SC, 0, 2);
$Modalidad = substr($SC, 2, 2);
$diferencia = "(0".$ciclo."-".$year.")";
$formato = "";
if ($tipo == "pausa") {
  $formato = "Carta de pausa de beca ".$Nombre." ".$universidad." ".$Sede." ".$Modalidad." ".$Class." ".$diferencia.".pdf";
}elseif($tipo == "condicionamiento"){
  $formato = "Carta de condicionamiento ".$Nombre." ".$universidad." ".$Sede." ".$Modalidad." ".$Class." ".$diferencia.".pdf";
}elseif($tipo == "cancelacion"){
  $formato = utf8_decode("Carta de cancelación de beca ").$Nombre." ".$universidad." ".$Sede." ".$Modalidad." ".$Class." ".$diferencia.".pdf";
}else{
  $formato = $Nombre." ".$universidad." ".$Sede." ".$Modalidad." ".$Class." ".$diferencia.".pdf";
}
$numero = rand(1, 10000000);



$status = 'enviado';



$idRenovacion = "RN-".$numero;

if ($tipo != "renovacion") {
  $archivero = "../../../CoachReuniones/Renovaciones/".$year."/Class-".$Class."/"."Ciclo 0".$ciclo."/".$alumno."/".$tipo;
  $ubicacion = "Renovaciones/".$year."/Class-".$Class."/"."Ciclo 0".$ciclo."/".$alumno."/".$tipo."/".$formato;
  $carpeta = "Renovaciones/".$year."/Class-".$Class."/"."Ciclo 0".$ciclo."/".$alumno."/".$tipo."/";
}else{
  $archivero = "../../../CoachReuniones/Renovaciones/".$year."/Class-".$Class."/"."Ciclo 0".$ciclo."/".$alumno;
  $ubicacion = "Renovaciones/".$year."/Class-".$Class."/"."Ciclo 0".$ciclo."/".$alumno."/".$formato;
  $carpeta = "Renovaciones/".$year."/Class-".$Class."/"."Ciclo 0".$ciclo."/".$alumno."/";
}


$mysql = "SELECT COUNT(*) AS 'contar' FROM renovacion WHERE direccion = '".$ubicacion."' AND Estado = 'enviado'";
foreach ($dbh->query($mysql) as $con) {
    $ex = $con['contar'];
      }
if ($tamaño > 5000000) {
  //$_SESSION["error"] = "Tamaño de archivo mayor a 5MB";
$_SESSION['noti'] = "<script>swal({
  title: 'Error!',
  text: 'Tamaño de archivo mayor a 5MB!',
  icon: 'error',
  button: 'Cerrar',
});</script>";
header("Location:../../renovacionBeca.php");
}elseif (mime_content_type($rutaarchivo) != "application/pdf") {
//$_SESSION["error"] = "Formato de archivo diferente al solicitado";
$_SESSION['noti'] = "<script>swal({
  title: 'Error!',
  text: 'Archivo subido con formato incorrecto!',
  icon: 'error',
  button: 'Cerrar',
});</script>";
header("Location:../../renovacionBeca.php");
}elseif ( $ex > 0) {

  $_SESSION['noti'] = "<script>swal({
  title: 'Error!',
  text: 'Ya ha subido documento!',
  icon: 'error',
  button: 'Cerrar',
});</script>";
header("Location:../../renovacionBeca.php");
}
else
{


if ($ex = 0) {
    
 
  $nombreArchivo = $formato;
  $actualizar = $dbh->prepare("UPDATE renovacion SET Estado = 'enviado' WHERE year = '".$year."')  
  AND ciclo = :ciclo AND archivo = :archivo AND Estado = 'rechazada' OR Estado = 'eliminado' AND ID_Alumno = :alumno AND tipo = :tipo");
  $actualizar->bindParam(':ciclo',$ciclo,PDO::PARAM_STR);
  $actualizar->bindParam(':archivo',$formato,PDO::PARAM_STR);
  $actualizar->bindParam(':alumno',$alumno,PDO::PARAM_STR);
  $actualizar->bindParam(':tipo',$alumno,PDO::PARAM_STR);
  if ($actualizar->execute() AND move_uploaded_file($direccion,$archivero."/".$nombreArchivo)) {
  $asunto = "Renovaciones de Beca Ciclo-0".$ciclo;
  $mensaje = "Hola ".$lN."\nPor este medio se te informa que tu  renovación ha sido entregada con exito\nTen un lindo dia.";
  include '../../../CoachReuniones/Modelo/ModeloCorreo/correo.php';
    $_SESSION['noti'] = "<script>swal({
    title: 'Exito!',
    text: 'Documento ingresado correctamente!',
    icon: 'success',
    button: 'Cerrar',
    });</script>";
  header("Location:../../renovacionBeca.php");
  }
}else
{
 if (file_exists($archivero)) {
  $estado = "enviado";
          $consulta = $dbh->prepare("INSERT INTO renovacion(idRenovacion,ID_Alumno,ciclo,year,archivo,direccion,carpeta,Estado,tipo,class,sede)
    VALUES(:idRenovacion,:ID_Alumno,:ciclo,'2020',:archivo,:direccion,:carpeta,:estado,:tipo,:class,:sede)");
          $consulta->bindParam(':idRenovacion', $idRenovacion, PDO::PARAM_STR);
          $consulta->bindParam(':ID_Alumno', $alumno, PDO::PARAM_STR);
          $consulta->bindParam(':ciclo', $ciclo, PDO::PARAM_INT);
          $consulta->bindParam(':archivo', $formato, PDO::PARAM_STR);
          $consulta->bindParam(':direccion', $ubicacion, PDO::PARAM_STR);
          $consulta->bindParam(':carpeta', $carpeta, PDO::PARAM_STR);
          $consulta->bindParam(':estado', $estado, PDO::PARAM_STR);
          $consulta->bindParam(":tipo", $tipo, PDO::PARAM_STR);
          $consulta->bindParam(':class', $Class, PDO::PARAM_STR);
          $consulta->bindParam(":sede", $SC, PDO::PARAM_STR);
          $nombreArchivo = $formato;
         
         if( $consulta->execute() AND move_uploaded_file($direccion,$archivero."/".$nombreArchivo)){
 $asunto = "Renovaciones de Beca Ciclo-0".$ciclo;
  $mensaje = "Hola ".$lN."\nPor este medio se te informa que tu  renovación ha sido entregada con exito\nTen un lindo dia.";
  include '../../../CoachReuniones/Modelo/ModeloCorreo/correo.php';
      $_SESSION['noti'] = "<script>swal({
    title: 'Exito!',
    text: 'Documento ingresado correctamente!',
    icon: 'success',
    button: 'Cerrar',
    });</script>";
header("Location:../../renovacionBeca.php");
         }


}else{
    $estado = "enviado";
  mkdir($archivero, 0777, true);
          $consulta = $dbh->prepare("INSERT INTO renovacion(idRenovacion,ID_Alumno,ciclo,year,archivo,direccion,carpeta,Estado,tipo,class,sede)
    VALUES(:idRenovacion,:ID_Alumno,:ciclo,'2020',:archivo,:direccion,:carpeta,:estado,:tipo,:class,:sede)");
          $consulta->bindParam(':idRenovacion', $idRenovacion, PDO::PARAM_STR);
          $consulta->bindParam(':ID_Alumno', $alumno, PDO::PARAM_STR);
          $consulta->bindParam(':ciclo', $ciclo, PDO::PARAM_INT);
          $consulta->bindParam(':archivo', $formato, PDO::PARAM_STR);
          $consulta->bindParam(':direccion', $ubicacion, PDO::PARAM_STR);
          $consulta->bindParam(':carpeta', $carpeta, PDO::PARAM_STR);
          $consulta->bindParam(':estado', $estado, PDO::PARAM_STR);
          $consulta->bindParam(":tipo", $tipo, PDO::PARAM_STR);
          $consulta->bindParam(':class', $Class, PDO::PARAM_STR);
          $consulta->bindParam(":sede", $SC, PDO::PARAM_STR);
          $nombreArchivo = $formato;
         
         if( $consulta->execute() AND move_uploaded_file($direccion,$archivero."/".$nombreArchivo)){
 $asunto = "Renovaciones de Beca Ciclo-0".$ciclo;
  $mensaje = "Hola ".$lN."\nPor este medio se te informa que tu  renovación ha sido entregada con exito\nTen un lindo dia.";
  include '../../../CoachReuniones/Modelo/ModeloCorreo/correo.php';
      $_SESSION['noti'] = "<script>swal({
    title: 'Exito!',
    text: 'Documento ingresado correctamente!',
    icon: 'success',
    button: 'Cerrar',
    });</script>";
header("Location:../../renovacionBeca.php");
         }
}

}
}//Aqui



} catch (PDOException $ex) {
  echo $ex->getMessage();
  
}
}
