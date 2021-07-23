<?php
include_once "../../../../Conexion/conexion.php";
session_start();
header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);
$data = array();


if (isset($input['ciclo'])) {
    $ciclo = $input['ciclo'];
    $sql1 = "SELECT DISTINCT Titulo, ID_Reunion FROM reuniones WHERE ID_Ciclo = '$ciclo' ";
    $query1 = $dbh->query($sql1);
    try {
        $data = array_merge($query1->fetchAll(PDO::FETCH_ASSOC));
        // enviar info
        echo json_encode($data);
    } catch (\Throwable $th) {
        echo ($th);
    }
}
