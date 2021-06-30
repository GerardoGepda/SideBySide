<?php
// incluir conexion
include "../../../Conexion/conexion.php";
session_start();
//error_reporting(0);

//inicio de declarar variables
$universidad = "";
$ciclo = 0;
$tipo = "";
$year = "";
$carta = "";
$alumno = "";
$size = 0;
$fileType = "";
$direccion = "";
$estado = "";
$Nombre = "";
$SC = "";
$Class = "";
$correo = "";
$lN = "";
$formato = "";
$idRenovacion = "";
// fin de declarar variables

//var_dump($_POST, $_FILES["renovacion_archivo"]);


if (isset($_POST['subirRenovacion'])) {

    // inicio de asignar valores
    $alumno = trim($_POST['renovacion_alumno']);
    $universidad = $_POST['renovacion_universidad'];
    $ciclo = $_POST['renovacion_ciclo'];
    $tipo = $_POST['renovacion_tipo'];
    $year = $_POST['renovacion_anio'];
    $carta = $_FILES["renovacion_archivo"]["name"];
    $size = $_FILES["renovacion_archivo"]["size"];
    $fileType = $_FILES["renovacion_archivo"]["type"];
    $direccion = $_FILES["renovacion_archivo"]["tmp_name"];
    //creación de id de renovación
    $numero = rand(1, 10000000);
    $idRenovacion = "RN-" . $numero;
    // fin de asignar valores

    if($fileType != "application/pdf") {
        $_SESSION['message'] = "Error: El formato del documento es incorrecto. Formato permitido \".pdf\"";
		$_SESSION['message2'] = 'danger';
		header("Location: ../../Renovacion.php?id=$alumno");
    }elseif ($size == 0){
        $_SESSION['message'] = "El tamaño del archivo no cumple el requerimiento, tamaño: $size";
		$_SESSION['message2'] = 'danger';
		header("Location: ../../Renovacion.php?id=$alumno");
    }    
    elseif ($size <= 5000000) {
        // consulta para obtener informacion de alumno
        foreach ($dbh->query("SELECT a.Nombre, LEFT(a.Nombre,LOCATE(' ',a.Nombre) - 1) AS 'name', 
        a.SedeAsistencia, a.Class, a.correo FROM alumnos a WHERE a.ID_Alumno = '" . $alumno . "'") as $Name) {
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
            $formato = "Carta de cancelación de beca " . $Nombre . " " . $universidad . " " . $Sede . " " . $Modalidad . " " . $Class . " " . $diferencia . ".pdf";
        } else {
            $formato = $Nombre . " " . $universidad . " " . $Sede . " " . $Modalidad . " " . $Class . " " . $diferencia . ".pdf";
        }

        if ($tipo != "renovacion") {
            $archivero = "../../../CoachReuniones/Renovaciones/" . $year . "/Class-" . $Class . "/" . "Ciclo 0" . $ciclo . "/" . $alumno . "/" . $tipo;
            $ubicacion = "Renovaciones/" . $year . "/Class-" . $Class . "/" . "Ciclo 0" . $ciclo . "/" . $alumno . "/" . $tipo . "/" . $formato;
            $carpeta = "Renovaciones/" . $year . "/Class-" . $Class . "/" . "Ciclo 0" . $ciclo . "/" . $alumno . "/" . $tipo . "/";
        } else {
            $archivero = "../../../CoachReuniones/Renovaciones/" . $year . "/Class-" . $Class . "/" . "Ciclo 0" . $ciclo . "/" . $alumno;
            $ubicacion = "Renovaciones/" . $year . "/Class-" . $Class . "/" . "Ciclo 0" . $ciclo . "/" . $alumno . "/" . $formato;
            $carpeta = "Renovaciones/" . $year . "/Class-" . $Class . "/" . "Ciclo 0" . $ciclo . "/" . $alumno . "/";
        }

        $mysql = "SELECT COUNT(*) AS 'contar' FROM renovacion WHERE ciclo = $ciclo AND year = '$year' AND ID_Alumno = '$alumno'";
        $cantidad = $dbh->query($mysql)->fetch(PDO::FETCH_NUM);
        $ex = $cantidad[0];

        if($ex != 0) {
            $_SESSION['message'] = 'Error: ¡Ya ha subido esta renovación!';
            $_SESSION['message2'] = 'danger';
            header("Location: ../../Renovacion.php?id=$alumno");
        }elseif ($dbh) {
            try {
                $nombreArchivo = $formato;
                $sql = "INSERT INTO renovacion (idRenovacion, ID_Alumno, ciclo, `year`, 
                    archivo, direccion, carpeta, Estado, tipo, class, sede)
                    VALUES(? , ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $result =   $dbh->prepare($sql)->execute([
                    $idRenovacion, $alumno, $ciclo, 
                    "$year", $formato, $ubicacion, $carpeta, 
                    'enviado', $tipo, $Class, $Sede
                ]);
    
                if ($result) {
                    mkdir($archivero, 0777, true);
                    $nuevo =  $archivero . "/" . $nombreArchivo;
                    $resultado = move_uploaded_file($direccion,$archivero."/".$nombreArchivo);

                    if ($resultado) {
                        $_SESSION['message'] = 'Éxito: Renovación creada';
                        $_SESSION['message2'] = 'success';
                        header("Location: ../../Renovacion.php?id=$alumno");
                    } else {
                        $_SESSION['message'] = 'No se pudo crear la renovación';
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
    }else {
        $tamanioActual = $size/1000;
        $_SESSION['message'] = "El tamaño de su archivo PDF sobrepasa el limite permitido (5 MB), \n su tamaño es de: $tamanioActual";
		$_SESSION['message2'] = 'danger';
		header("Location: ../../Renovacion.php?id=$alumno");
    }
} else {
    $_SESSION['message'] = 'Datos incompletos';
    $_SESSION['message2'] = 'danger';
    header("Location: ../../Renovacion.php?id=$alumno");
}