<?php
require_once "../../../BaseDatos/conexion.php";

// Desactivar toda notificación de error
error_reporting(0);
session_start();

$CL = "CL";
$n1 = "-";
$n2 = mt_rand(1, 9);
$n3 = mt_rand(1, 9);
$n4 = mt_rand(1, 9);
$n5 = mt_rand(1, 9);
$n6 = mt_rand(1, 9);

//Generamos el id con el año y 4 numeros random
//codigo inscripcion ciclo
$inscriC = $CL . "" . $n1 . "" . $n2 . "" . $n3 . "" . $n4 . "" . $n5 . "" . $n6;
$comp = 1;
while ($comp == 1) {
    //Comprobamos que no exista otro igual
    $query = $pdo->prepare("SELECT COUNT(`idExpedienteU`) AS existe FROM `inscripcionciclos` WHERE `idExpedienteU`='" . $inscriC . "'");
    $query->execute();
    $existe;
    if ($query->rowCount() > 0) {
        $r = $query->fetch();
        $existe = $r['existe'];
    }
    //Comprobamos que no exista
    if ($existe >= 1) {
        $n1 = "-";
        $n2 = mt_rand(1, 9);
        $n3 = mt_rand(1, 9);
        $n4 = mt_rand(1, 9);
        $n5 = mt_rand(1, 9);
        $n6 = mt_rand(1, 9);
        // Si existe generamos otro id con el año y 4 numeros random
        $inscriC = $CL . "" . $n1 . "" . $n2 . "" . $n3 . "" . $n4 . "" . $n5 . "" . $n6;
    } else {
        $comp = 2;
    }
}
if (isset($_POST['comprobante_Ciclo'])) {
    $nombrearchivo = $_FILES["archivo"]["name"];
    $tipoarchivo = $_FILES["archivo"]["type"];
    $tama«Ðoarchivo = $_FILES["archivo"]["size"];
    $rutaarchivo = $_FILES["archivo"]["tmp_name"];
    $destino = "../../../pdfCicloInscripcion/";
    $iduser = $_POST['alumno'];  //guarda el id del alumno
    $ciclo = $_POST['ciclo'];      //ciclo correspondiente de u
    $idExpediente = $_POST['expediente'];   //codigo del expediente u
    // crear id inscripción ciclo
    $incripCiclo = $_POST['idInscripcionCiclo'];


    if ($tama«Ðoarchivo <= 5000000) {
        $RutaArchivo = "../../../pdfCicloInscripcion/" . $ArchivoPDF; //Buscammos el archivo con el nombre que se encuentra en la base 
        if (!file_exists($destino)) {
            mkdir($destino);
        }
        $nombrearchivo = $iduser . "-" . $ciclo . ".pdf";
        $destino .= $nombrearchivo;
        if (copy($rutaarchivo, $destino)) {
            $consulta = $pdo->prepare("INSERT INTO inscripcionciclos (`Id_InscripcionC`, `idExpedienteU`, `cicloU`, `comprobante`)
             VALUES(:Id_InscripcionC, :idExpedienteU, :cicloU, :comprobante)");

            $consulta->bindParam(":Id_InscripcionC", $inscriC);
            $consulta->bindParam(":idExpedienteU", $idExpediente);
            $consulta->bindParam(":cicloU", $ciclo);
            $consulta->bindParam(":comprobante", $nombrearchivo);

            //Verifica si ha insertado los datos
            if ($consulta->execute()) {
                //Si todo fue correcto muestra el resultado con exito;
                $_SESSION['message'] = 'Inscripción Guardada';
                $_SESSION['message2'] = 'success';
                header("Location: ../../NotasPorAlumno.php?id=$iduser");
            } else {
                $_SESSION['message'] = 'Error al momento de guardar';
                $_SESSION['message2'] = 'danger';
                header("Location: ../../NotasPorAlumno.php?id=$iduser");
            }
        } else {
            $_SESSION['message'] = 'Error al guardar el documento';
            $_SESSION['message2'] = 'danger';
            header("Location: ../../NotasPorAlumno.php?id=$iduser");
        }
    } else {
        $_SESSION['message'] = 'Archivo Demasiado Grande';
        $_SESSION['message2'] = 'danger';
        header("Location: ../../NotasPorAlumno.php?id=$iduser");
    }
}
