<?php
require_once "../../../BaseDatos/conexion.php";

// Desactivar toda notificación de error
error_reporting(0);

$nombrearchivo = $_FILES["archivo"]["name"];
$tipoarchivo = $_FILES["archivo"]["type"];
$tama«Ðoarchivo = $_FILES["archivo"]["size"];
$rutaarchivo = $_FILES["archivo"]["tmp_name"];
$destino = "../../../pdfCicloInscripcion/";

$iduser = $_POST['alumno'];  //guarda el id del alumno
$ciclo = $_POST['ciclo'];      //ciclo correspondiente de u
$idExpediente = $_POST['expediente'];   //codigo del expediente u
$incripCiclo = $_POST['idInscripcionCiclo'];
$comprobante = $_POST['comprobante'];

if ($tama«Ðoarchivo <= 5000000) {
    $RutaArchivo = "../../../pdfCicloInscripcion/" . $comprobante; //Buscammos el archivo con el nombre que se encuentra en la base 
    unlink($RutaArchivo);  // Eliminanos el archivo
    if (!file_exists($destino)) {
        mkdir($destino);
    }
    $nombrearchivo = $iduser . "-" . $ciclo . ".pdf";
    $destino .= $nombrearchivo;
    if (copy($rutaarchivo, $destino)) {
        $consulta = $pdo->prepare("UPDATE `inscripcionciclos` SET  `comprobante`= :comprobante WHERE `idExpedienteU` = :idExpedienteU AND `Id_InscripcionC` = :Id_InscripcionC");
        $consulta->bindParam(":comprobante", $nombrearchivo);
        $consulta->bindParam(":idExpedienteU", $idExpediente);
        $consulta->bindParam(":Id_InscripcionC", $incripCiclo);

        //Verifica si ha insertado los datos
        if ($consulta->execute()) {
            header("Location: ../../ModificarInscripcio.php?id=$IdCiclo&idAlumno=$idExpediente&expediente=$iduser");
            $_SESSION['message'] = 'Comprobante actualizado';
            $_SESSION['message2'] = 'success';            //Si todo fue correcto muestra el resultado con exito;
        } else {
            header("Location: ../../ModificarInscripcio.php?id=$incripCiclo&idAlumno=$idExpediente&expediente=$iduser");
            $_SESSION['message'] = 'Error al actualizar comprobante de inscripción';
            $_SESSION['message2'] = 'danger';
        }
    } else {
        $_SESSION['message'] = 'Error al guardar el documento';
        $_SESSION['message2'] = 'danger';
        header("Location: ../../ModificarInscripcio.php?id=$incripCiclo&idAlumno=$idExpediente&expediente=$iduser");
    }
} else {
    $_SESSION['message'] = 'Archivo Demasiado Grande';
    $_SESSION['message2'] = 'danger';
    header("Location: ../../ModificarInscripcio.php?id=$incripCiclo&idAlumno=$idExpediente&expediente=$iduser");
}
