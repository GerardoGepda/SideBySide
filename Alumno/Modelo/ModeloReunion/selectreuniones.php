<?php

include_once "../../../BaseDatos/conexion.php";
session_start();


header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);
$data = array();

$sql = "SELECT * FROM `horariosreunion` h INNER JOIN reuniones r ON h.ID_Reunion = r.ID_Reunion WHERE r.ID_Reunion = ". $input['idreunion']. "";
$query = $pdo->query($sql);

while ($r = $query->fetch()) {
    $data[] = $r;
}

echo json_encode(array("reunion" => $data));