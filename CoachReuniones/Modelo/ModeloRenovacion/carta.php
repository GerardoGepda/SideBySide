<?php
// incluir conexion
include "../../../Conexion/conexion.php";
session_start();

//inicio de declarar variables
$universidad = "";
$ciclo = 0;
$tipo = "";
$year = "";
$carta = "";
$alumno = "";
$size = 0;
$direccion = "";
$estado = "enviado";
$Nombre = "";
$SC = "";
$Class = "";
$correo = "";
$lN = "";
$formato = "";
$idRenovacion = "";
// fin de declarar variables

if (isset($_POST['subirCarta'])) {

    // inicio de asignar valores
    $universidad = $_POST['uni'];
    $ciclo = $_POST['ciclo'];
    $tipo = $_POST['tipo'];
    $year = $_POST['anio'];
    $carta = $_FILES["archivo"]["name"];
    $alumno = $_POST['alumno'];
    $size = $_FILES["archivo"]["size"];
    $direccion = $_FILES["archivo"]["tmp_name"];
    // fin de asignar valores


    // consulta para obtener informacion de alumno
    foreach ($dbh->query("SELECT Nombre,LEFT(alumnos.Nombre,LOCATE(' ',alumnos.Nombre) - 1) AS 'name',SedeAsistencia,Class,correo FROM alumnos WHERE ID_Alumno = '" . $alumno . "'") as $Name) {
        $Nombre = $Name['Nombre'];
        $SC = $Name['SedeAsistencia'];
        $Class = $Name['Class'];
        $correo = $Name['correo'];
        $lN = $Name['name'];
    }

    $Sede = substr($SC, 0, 2);
    $Modalidad = substr($SC, 2, 2);
    $diferencia = "(0" . $ciclo . "-" . $year . ")";

    if ($tipo == "pausa") {
        $formato = "Carta de pausa de beca " . $Nombre . " " . $universidad . " " . $Sede . " " . $Modalidad . " " . $Class . " " . $diferencia . ".pdf";
    } elseif ($tipo == "condicionamiento") {
        $formato = "Carta de condicionamiento " . $Nombre . " " . $universidad . " " . $Sede . " " . $Modalidad . " " . $Class . " " . $diferencia . ".pdf";
    } elseif ($tipo == "cancelacion") {
        $formato = utf8_decode("Carta de cancelación de beca ") . $Nombre . " " . $universidad . " " . $Sede . " " . $Modalidad . " " . $Class . " " . $diferencia . ".pdf";
    } else {
        $formato = $Nombre . " " . $universidad . " " . $Sede . " " . $Modalidad . " " . $Class . " " . $diferencia . ".pdf";
    }
    $numero = rand(1, 10000000);
    $idRenovacion = "RN-" . $numero;

    if ($tipo != "renovacion") {
        $archivero = "../../../CoachReuniones/Renovaciones/" . $year . "/Class-" . $Class . "/" . "Ciclo 0" . $ciclo . "/" . $alumno . "/" . $tipo;
        $ubicacion = "Renovaciones/" . $year . "/Class-" . $Class . "/" . "Ciclo 0" . $ciclo . "/" . $alumno . "/" . $tipo . "/" . $formato;
        $carpeta = "Renovaciones/" . $year . "/Class-" . $Class . "/" . "Ciclo 0" . $ciclo . "/" . $alumno . "/" . $tipo . "/";
    } else {
        $archivero = "../../../CoachReuniones/Renovaciones/" . $year . "/Class-" . $Class . "/" . "Ciclo 0" . $ciclo . "/" . $alumno;
        $ubicacion = "Renovaciones/" . $year . "/Class-" . $Class . "/" . "Ciclo 0" . $ciclo . "/" . $alumno . "/" . $formato;
        $carpeta = "Renovaciones/" . $year . "/Class-" . $Class . "/" . "Ciclo 0" . $ciclo . "/" . $alumno . "/";
    }

    $mysql = "SELECT COUNT(*) AS 'contar' FROM renovacion WHERE direccion = '" . $ubicacion . "' AND Estado = 'enviado'";
    foreach ($dbh->query($mysql) as $con) {
        $ex = $con['contar'];
    }


    if ($dbh) {
        try {
            $nombreArchivo = $formato;
            $actualizar = $dbh->prepare("UPDATE renovacion SET Estado = 'enviado' WHERE year = '" . $year . "')  
            AND ciclo = :ciclo AND archivo = :archivo AND Estado = 'rechazada' OR Estado = 'eliminado' AND ID_Alumno = :alumno AND tipo = :tipo");
            $actualizar->bindParam(':ciclo', $ciclo, PDO::PARAM_STR);
            $actualizar->bindParam(':archivo', $formato, PDO::PARAM_STR);
            $actualizar->bindParam(':alumno', $alumno, PDO::PARAM_STR);
            $actualizar->bindParam(':tipo', $tipo, PDO::PARAM_STR);

            echo $actualizar->execute(); 
            if ($actualizar->execute() and move_uploaded_file($direccion, $archivero . "/" . $nombreArchivo)) {
                // var_dump(
                //     $universidad,
                //     $ciclo,
                //     $tipo,
                //     $year,
                //     $carta,
                //     $alumno,
                //     $size,
                //     $direccion,
                //     $Nombre,
                //     $SC,
                //     $Class,
                //     $correo,
                //     $lN,
                //     $formato,
                //     $numero,
                //     $archivero,
                //     $ubicacion,
                //     $carpeta,
                //     $ex
                // );
                // $asunto = "Renovaciones de Beca Ciclo-0" . $ciclo;
                // $mensaje = "Hola " . $lN . "\nPor este medio se te informa que tu  renovación ha sido entregada con exito\nTen un lindo dia.";
                // include "../../../CoachReuniones/Modelo/ModeloCorreo/correo.php";

                $_SESSION['message'] = 'Carta Actualizada';
                $_SESSION['message2'] = 'success';
                header("Location: ../../Renovacion.php?id=$alumno");
                echo "success";
            }
        } catch (\Throwable $th) {
            throw $th;
            echo $th;
        }
    } else {
        $_SESSION['message'] = 'No hay conexion a la base de datos';
        $_SESSION['message2'] = 'danger';
        header("Location: ../../Renovacion.php?id=$alumno");
    }
} else {
    $_SESSION['message'] = 'Datos incompletos';
    $_SESSION['message2'] = 'danger';
    header("Location: ../../Renovacion.php?id=$alumno");
}
