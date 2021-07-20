<?php
include_once "../../../../Conexion/conexion.php";
session_start();
header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);
$data = array();


if (isset($input['ciclo']) && isset($input['titulo']) && isset($input['tipo'])) {
    // asignación de variables
    $ciclo = $input['ciclo'];
    $titulo = $input['titulo'];
    $tipo = $input['tipo'];

    // creación de consulta
    $sql1 = "SELECT DISTINCT Titulo FROM reuniones WHERE ID_Ciclo = '$ciclo' ";
    $query1 = $dbh->query($sql1);

    // llenado de información
    try {
        $data = array_merge($query1->fetchAll(PDO::FETCH_ASSOC));
        // enviar info
        echo json_encode(array("nombre" => $data));
    } catch (\Throwable $th) {
        echo ($th);
    }
}
