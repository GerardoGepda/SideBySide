<?php
include_once "../../../../Conexion/conexion.php";
session_start();

header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);
$data = array();

$sql = "SELECT COUNT(r.ID_Reunion) AS cantidad,u.ID_Empresa FROM reuniones r INNER JOIN universidadreunion u ON u.ID_Reunion = r.ID_Reunion WHERE u.ID_Empresa IN ('UDB', 'UCA SS','ECMH') AND r.ID_Ciclo = '02-2021' GROUP BY u.ID_Empresa";

$query = $dbh->prepare($sql);
$query->execute();
$data = $query->fetchAll(PDO::FETCH_ASSOC);
