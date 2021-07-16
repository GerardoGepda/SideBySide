<?php
require_once '../Conexion/conexion.php';
session_start();

if (isset($_GET['cn'])) {
  // declaración de variables
  $rn = $_GET['cn'];
  //inicio  de consulta para obtener el id del alumno
  foreach ($dbh->query("SELECT ID_Alumno, direccion FROM renovacion WHERE idRenovacion = '" . $rn . "'") as $alumno) {
    $st = trim($alumno['ID_Alumno']);
    $dir = trim($alumno['direccion']);
  }
  //fin de consulta para obtener el id del alumno 


  // consulta para eliminar la renovacion
  $stmt = "DELETE FROM `renovacion` WHERE idRenovacion = :id ";
  $delete = $dbh->prepare($stmt);
  $delete->bindParam(":id", $rn);
  if ($delete->execute()) {
    if (unlink("./" . $dir)) {
      $_SESSION['message'] = 'Renovación Eliminada';
      $_SESSION['message2'] = 'success';
      header("Location:Renovacion.php?id=$st");
    } else {
      $_SESSION['message'] = 'Error al eliminar el documento';
      $_SESSION['message2'] = 'danger';
      header("Location:Renovacion.php?id=$st");
    }
  } else {
    $_SESSION['message'] = 'SQL Error, No se encontro la renovación';
    $_SESSION['message2'] = 'danger';
    header("Location:Renovacion.php?id=$st");
  }
}
