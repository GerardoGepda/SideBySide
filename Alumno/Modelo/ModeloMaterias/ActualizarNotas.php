<?php
session_start();
include_once "../../../BaseDatos/conexion.php";

$cantidadMateria = $_SESSION['cantidadMaterias'];
$idExpedienteU=$_GET['expediente']; // Id del expediente
$idInscripcionCiclo=$_GET['idInscripcionCiclo']; // Id del ciclo

    if (isset($_GET['cancel'])) { //verificamos si el usuario quiere cancelar la modificación
        //borramos la cookie si existe
        setcookie("datosAlumnos" , "", time() -60, '/');
        header("Location: ../../expedienteU.php");
    } else if (isset($_COOKIE['datosAlumnos'])){ // Verificar si existe la cookie donde estan los datos ingresados

        $datos = json_decode($_COOKIE['datosAlumnos']);

        if ($_SESSION['isFirtsTime'] && sizeof($datos) == $cantidadMateria ){
            actualizar($datos, $idExpedienteU , $idInscripcionCiclo, $pdo);
        }elseif ($_SESSION['isFirtsTime'] == false && $cantidadMateria > 0) {

            $dataComplete = true; //nos ayudara a saber si los datos de las materias inscritas si fueron enviados

            //si $cantidadMateria > 0 indica que hay materias con estado de inscritas y que deben
            //ser actualizadas obligatoriamente
            //primero extraemos las materias que no han sido actualizadas (solo inscritas).
            $sqlEvalMat = "SELECT * FROM inscripcionmateria WHERE Id_InscripcionC = ? AND estado = ?";
            $queryEvalMat = $pdo->prepare($sqlEvalMat);
            $queryEvalMat->execute([$idInscripcionCiclo, 'Inscrita']);
            $materiasBD = $queryEvalMat->fetchAll(PDO::FETCH_ASSOC);

            foreach ($materiasBD as $key => $materiaBD) {
                if (!IsInArray($materiaBD['idMateria'], $datos)) {
                    //si el estado de esta variable cambia a falso, ya sabemos que nos faltan datos de materias que si o si se deben actualizar
                    $dataComplete = false;
                }
            }

            if ($dataComplete) {
                actualizar($datos , $idExpedienteU , $idInscripcionCiclo, $pdo);
            }else {
                $_SESSION['message'] = 'Debes de asegurarte de actualizar las ' . $cantidadMateria . ' materias cuyo estado es "inscrita"';
                $_SESSION['message2'] = 'danger';
                header("Location: ../../ModificarInscripcio.php?id=$idInscripcionCiclo&idAlumno=$idExpedienteU");
            }

        }elseif ($_SESSION['isFirtsTime'] == false){
            actualizar($datos , $idExpedienteU , $idInscripcionCiclo, $pdo);
        }else{
            $_SESSION['message'] = 'Es primera vez que ingresas notas. Por favor, verifica los datos de las ' . $cantidadMateria . ' materias';
            $_SESSION['message2'] = 'danger';
            header("Location: ../../ModificarInscripcio.php?id=$idInscripcionCiclo&idAlumno=$idExpedienteU");
        }



    }else{
        $_SESSION['message'] = 'No hay cambios para poder actualizar.';
        $_SESSION['message2'] = 'danger';
       header("Location: ../../ModificarInscripcio.php?id=$idInscripcionCiclo&idAlumno=$idExpedienteU");
    }

    function actualizar($datos, $idExpedienteU, $idInscripcionCiclo, $pdo)
    {
        foreach ($datos as $dato) {
            $idMateria = $dato[0];
            $nota = $dato[1];
            $estado = $dato[2];

            $sql = "UPDATE inscripcionmateria SET  nota=?, estado = ? WHERE idMateria=? AND Id_InscripcionC = ?";

            if ($pdo->prepare($sql)->execute([$nota, $estado, $idMateria, $idInscripcionCiclo])) {

                $sql2 = "UPDATE materias SET estadoM = ? WHERE idMateria=?";
                if ($pdo->prepare($sql2)->execute([$estado, $idMateria])) {
                    $_SESSION['message'] = 'Notas actualizadas';
                    $_SESSION['message2'] = 'success';
                    setcookie("datosAlumnos", "", time() - 60, '/');
                    header("Location: ../../expedienteU.php");
                } else {
                    $_SESSION['message'] = 'No se puedo actualizar.';
                    $_SESSION['message2'] = 'danger';

                    header("Location: ../../ModificarInscripcio.php?id=$idInscripcionCiclo&idAlumno=$idExpedienteU");
                }
            }
        }
    }

    function IsInArray($id, $array) {
        foreach ($array as $key => $val) {
            //$val[0] representa el id de la materia
            if ($val[0] === $id) {
                return true;
            }
        }
        return false;
     }