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
$idcarta = "";
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
    $idcarta = $_POST["idCarta"];
    // fin de asignar valores


    // consulta para obtener informacion de alumno
    foreach ($dbh->query("SELECT r.carpeta as 'nuevo', r.archivo , a.Nombre,LEFT(a.Nombre,LOCATE(' ',a.Nombre) - 1) AS 'name',a.SedeAsistencia,a.Class,a.correo FROM alumnos a
    INNER JOIN renovacion r ON r.ID_Alumno = a.ID_Alumno   WHERE a.ID_Alumno = '" . $alumno . "'") as $Name) {
        $Nombre = $Name['Nombre'];
        $SC = $Name['SedeAsistencia'];
        $Class = $Name['Class'];
        $correo = $Name['correo'];
        $lN = $Name['name'];
        $ubication = $Name['nuevo'];
        $dir = $Name['archivo'];
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

    $old  =  $ubication . $dir;

    if ($dbh) {
        try {
            $nombreArchivo = $formato;
            $sql = "UPDATE renovacion SET ciclo = ?, `year` = ?, archivo = ?, direccion = ?,
                carpeta = ?, Estado = ?, tipo = ? WHERE idRenovacion  = ?";
            $result =   $dbh->prepare($sql)->execute([
                $ciclo, $year, $formato, $ubicacion,
                $carpeta, 'enviado', $tipo, $idcarta
            ]);
            if ($result) {
                $nuevo =  $archivero . "/" . $nombreArchivo;
                $resultado = rename($direccion, $archivero . "/" . $nombreArchivo);

                if ($resultado) {
                    $_SESSION['message'] = 'Carta Actualizada';
                    $_SESSION['message2'] = 'success';
                    header("Location: ../../Renovacion.php?id=$alumno");
                } else {
                    $_SESSION['message'] = 'No se pudo actualizar el documento';
                    $_SESSION['message2'] = 'danger';
                    header("Location: ../../Renovacion.php?id=$alumno");
                }
            } else {
                $_SESSION['message'] = 'No se pudo actualizar en la base de datos';
                $_SESSION['message2'] = 'danger';
                header("Location: ../../Renovacion.php?id=$alumno");
            }
        } catch (PDOException $th) {
            $error =  $th->getMessage();
            $_SESSION['message'] = $error;
            $_SESSION['message2'] = 'danger';
            header("Location: ../../Renovacion.php?id=$alumno");
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
