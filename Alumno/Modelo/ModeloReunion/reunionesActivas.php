<?php
include_once "../../../BaseDatos/conexion.php";
session_start();
$data = array();
header("Content-type: application/json; charset=utf-8");

//Extraemos el carnet del estudiante
$stmt1 = $pdo->prepare("SELECT `ID_Alumno`, `ID_Empresa` FROM `alumnos` WHERE 
correo='" . $_SESSION['Email'] . "'");
// Ejecutamos
$stmt1->execute();

while ($fila = $stmt1->fetch()) {
    $alumno = $fila["ID_Alumno"];
    $universidad = $fila["ID_Empresa"];
}

$stmt2 = $pdo->prepare("SELECT r.ID_Reunion AS 'id', r.Titulo, r.Fecha, r.encargado, r.Tipo
FROM reuniones r INNER JOIN universidadreunion u ON r.ID_Reunion = u.ID_Reunion WHERE u.ID_Empresa= '" . $universidad . "' and r.Estado='Activo'");
// Ejecutamos
$stmt2->execute();

while ($row = $stmt2->fetch()) {
    $data[] = $row;
}

echo json_encode(array("disponibles" => $data));
