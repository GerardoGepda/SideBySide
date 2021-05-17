<?php

include_once "../../../BaseDatos/conexion.php";
session_start();


header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);
$data = array();

$sql = "SELECT * FROM inscripcionreunion i WHERE i.id_reunion = " . $input['id'] . " AND i.Horario  
= " . $input['horario'] . " and i.estado = 'disponible'";
$query = $pdo->query($sql);

while ($r = $query->fetch()) {
    $data[] = $r;
}

echo json_encode(array("disponibles" => $data));
