<?php

include_once "../../../Conexion/conexion.php";
session_start();

$FotoAlumno = '';
header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);
$data = array();
$id = $input['id'];
$idExpedienteU = 0;
$sql2 = "SELECT `idExpedienteU`,  `cum`, `proyecEgreso`, `pensum`, `avancePensum`, `estado`, `carnet` FROM expedienteu   WHERE ID_Alumno  = '" . $id . "' ";

$query2 = $dbh->query($sql2);



try {
    $data = array_merge($query2->fetchAll(PDO::FETCH_ASSOC));
    // enviar info
    echo json_encode(array("alumno" => $data));
} catch (\Throwable $th) {
    echo ($th);
}
