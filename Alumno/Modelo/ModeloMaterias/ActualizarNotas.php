<?php
session_start();
$cantidadMateria = $_SESSION['cantidadMaterias'];
$idExpedienteU=$_GET['expediente']; // Id del expediente
$idInscripcionCiclo=$_GET['idInscripcionCiclo']; // Id del ciclo

    if (isset($_COOKIE['datosAlumnos'])){ // Verificar si existe la cookie donde estan los datos ingresados

        $datos = json_decode($_COOKIE['datosAlumnos']);


        if ($_SESSION['isFirtsTime'] && sizeof($datos) == $cantidadMateria ){
            actualizar($datos, $idExpedienteU , $idInscripcionCiclo);
        }elseif ($_SESSION['isFirtsTime'] == false){
            actualizar($datos , $idExpedienteU , $idInscripcionCiclo);
        }else{
            $_SESSION['message'] = 'Es primera vez que actualizar. Por favor, verifica los datos de las ' . $cantidadMateria . ' materias';
            $_SESSION['message2'] = 'danger';
            header("Location: ../../ModificarInscripcio.php?id=$idInscripcionCiclo&idAlumno=$idExpedienteU");
        }



    }else{
        $_SESSION['message'] = 'No hay cambios para poder actualizar.';
        $_SESSION['message2'] = 'danger';
       header("Location: ../../ModificarInscripcio.php?id=$idInscripcionCiclo&idAlumno=$idExpedienteU");
    }

    function actualizar($datos , $idExpedienteU , $idInscripcionCiclo ){

        require_once "../../../BaseDatos/conexion.php";

         foreach ($datos as $dato) {
            $idMateria = $dato[0];
            $nota = $dato[1];
            $estado = $dato[2];

            $sql = "UPDATE inscripcionmateria SET  nota=?, estado = ? WHERE idMateria=? AND Id_InscripcionC = ?";

            if ($pdo->prepare($sql)->execute([$nota, $estado, $idMateria, $idInscripcionCiclo])) {

                $sql2 = "UPDATE materias SET estadoM = ? WHERE idMateria=?";
                if ($pdo->prepare($sql2)->execute([$estado, $idMateria])) {
                    $_SESSION['message'] = 'Notas actualizada';
                    $_SESSION['message2'] = 'success';
                    setcookie("datosAlumnos" , "", time() -60);
                    header("Location: ../../ModificarInscripcio.php?id=$idInscripcionCiclo&idAlumno=$idExpedienteU");

                } else {
                    $_SESSION['message'] = 'No se puedo actualizar.';
                    $_SESSION['message2'] = 'danger';

                    header("Location: ../../ModificarInscripcio.php?id=$idInscripcionCiclo&idAlumno=$idExpedienteU");

                }
            }
        }
    }