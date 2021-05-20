<?php

header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);






require_once "../../../BaseDatos/conexion.php";
session_start();
if (isset($input["verificar"])) {
    //validando si ya se inscribio el alumno. 
    $vAlumno = $input["alumno"];
    $vReunion = $input["reunion"];
    $data = array();
    try {
        $query = $pdo->prepare("SELECT COUNT(id_alumno) FROM inscripcionreunion WHERE id_alumno = ? AND id_reunion = ?");
        $query->execute([$vAlumno, $vReunion]);
        $rowInscrito = $query->fetch();
        $result = (int)$rowInscrito[0];
        $data[] = $result;
        echo json_encode(array("verify" => $data));
    } catch (PDOException $e) {
        $errmnsj = 'Error: ' . $e->getMessage();
        echo json_encode(array("verify" => $errmnsj));
    }
} else {
    $respuesta = array("estado" => "err", "mensaje" => "Error en el envio de datos.");
    echo json_encode(array("verify" => $respuesta));
}
