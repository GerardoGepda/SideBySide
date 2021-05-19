<?php
error_reporting(0);
require_once "../../../BaseDatos/conexion.php";
session_start();

//var_dump($_POST);

if (isset($_POST['inscribir'])) {
    //extraccion de datos por metodo POST
    $idalumno = trim($_POST['idalumno']);
    $reunion = trim($_POST['idreunion']);
    $horario = trim($_POST['horario']);
    $telefono = trim($_POST['telefono']);
    $horainicio = trim($_POST['hinicio']);
    $horafin = trim($_POST['hfin']);
    $estado = trim($_POST['estado']); 

    $sql = "SELECT COUNT(id_alumno) AS inscrito FROM inscripcionreunion WHERE id_alumno = ? AND id_reunion = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$idalumno, $reunion]);
    $row = $query->fetch();
    $result = (int)$row[0];
    
    if ($result == 0) {
        $sql2 = "INSERT INTO `inscripcionreunion`(`id_alumno`, `id_reunion`, `Horario`, `telefono`, `asistencia`, `horainicio`, `horafin`, `estado`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        try {
            $query = $pdo->prepare($sql2);
            $ingresado = $query->execute([$idalumno, $reunion, $horario, $telefono, "En espera", $horainicio, $horafin, "lleno"]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        if ($ingresado) {
            $respuesta = array("estado"=>"ok", "mensaje"=>"¡Inscripción exitosa!");
            $jsnResponse = json_encode($respuesta);
            echo $jsnResponse;
        } else {
            $respuesta = array("estado"=>"err", "mensaje"=>"Erro al guardar su inscripción en, intente de nuevo.");
            $jsnResponse = json_encode($respuesta);
            echo $jsnResponse;
        }
    } else {
        $respuesta = array("estado"=>"err", "mensaje"=>"Ya esta inscrito en esta reunión.");
        $jsnResponse = json_encode($respuesta);
        echo $jsnResponse;
    }
    
} else if (isset($_POST['desinscribir'])) {
    $Didalumno = trim($_POST['idalumno']);
    $Dreunion = trim($_POST['idreunion']);
    
    $sqldes = "DELETE FROM inscripcionreunion WHERE id_alumno = ? AND id_reunion = ?";
    try {
        $querydes = $pdo->prepare($sqldes);
        $querydes->execute([$Didalumno, $Dreunion]);
    } catch (PDOException $e) {
        $errmnsj = 'Error: ' . $e->getMessage();
        $respuesta = array("estado"=>"ok", "mensaje"=>$errmnsj);
        $jsnResponse = json_encode($respuesta);
        echo $jsnResponse;
    }

    $respuesta = array("estado"=>"ok", "mensaje"=>"Se borro su inscripción.");
    $jsnResponse = json_encode($respuesta);
    echo $jsnResponse;

} else if (isset($_POST["verificar"])) {
    //validando si ya se inscribio el alumno. 
    $vAlumno = $_POST["alumno"];
    $vReunion = $_POST["reunion"];
    try {
        $query = $pdo->prepare("SELECT COUNT(id_alumno) FROM inscripcionreunion WHERE id_alumno = ? AND id_reunion = ?");
        $query->execute([$vAlumno, $vReunion]);
        $rowInscrito = $query->fetch();
        $result = (int)$rowInscrito[0];
    } catch (PDOException $e) {
        $errmnsj = 'Error: ' . $e->getMessage();
        $respuesta = array("estado"=>"ok", "mensaje"=>$errmnsj);
        $jsnResponse = json_encode($respuesta);
        echo $jsnResponse;
    }
    echo $result;
} else {
    $respuesta = array("estado"=>"err", "mensaje"=>"Error en el envio de datos.");
    $jsnResponse = json_encode($respuesta);
    echo $jsnResponse;
}
