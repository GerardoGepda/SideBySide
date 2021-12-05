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
    //obtenesmos los segundos unix de las fechas y los restamos para validar que se muestren los horarios
    //solo si la diferencia de tiempo enre las 2 fechas (actual y reunión) tienen una separación de
    //2 horas (7200 segundos) o más
    if (($reuFecha->getTimestamp() - $fechaNow->getTimestamp()) >= 7200) {
        $data[] = $r;
    }  
}
echo json_encode(array("reunion" => $data));