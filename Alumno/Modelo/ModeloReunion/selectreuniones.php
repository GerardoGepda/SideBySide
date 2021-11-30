<?php

include_once "../../../BaseDatos/conexion.php";
session_start();
date_default_timezone_set("America/El_Salvador");
$fechaNow = new DateTime();

header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);
$data = array();

$sql = "SELECT * FROM `horariosreunion` h INNER JOIN reuniones r ON h.ID_Reunion = r.ID_Reunion WHERE r.ID_Reunion = ". $input['idreunion']. "";
$query = $pdo->query($sql);

while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
    $reuFecha = new DateTime($r["Fecha"] . " " . $r["HorarioInicio"]);
    if ($fechaNow->getTimestamp() < $reuFecha->getTimestamp()) {
        if ($reuFecha->diff($fechaNow)->h >= 2) {
            $data[] = $r;
        }
    }  
}
echo json_encode(array("reunion" => $data));