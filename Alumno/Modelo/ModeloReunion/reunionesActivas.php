<?php
date_default_timezone_set("America/El_Salvador");
include_once "../../../BaseDatos/conexion.php";
session_start();
$data = array();
header("Content-type: application/json; charset=utf-8");

//Extraemos el carnet del estudiante
$stmt1 = $pdo->prepare("SELECT `ID_Alumno`, `ID_Empresa`, `ID_Sede` FROM `alumnos` WHERE 
correo='" . $_SESSION['Email'] . "'");
// Ejecutamos
$stmt1->execute();

while ($fila = $stmt1->fetch()) {
    $alumno = $fila["ID_Alumno"];
    $universidad = $fila["ID_Empresa"];
    $sede = $fila["ID_Sede"];
}

$stmt2 = $pdo->prepare("SELECT r.ID_Reunion AS 'id', r.Titulo, r.Fecha, r.encargado, r.Tipo
FROM reuniones r INNER JOIN universidadreunion u ON r.ID_Reunion = u.ID_Reunion WHERE u.ID_Empresa= '" . $universidad . "' and r.Estado='Activo' AND r.ID_Sede = '$sede'");
// Ejecutamos
$stmt2->execute();
//Obtenemos la fecha de hoy
$fecha = new DateTime();


while ($row = $stmt2->fetch()) {
    if (strtotime($fecha->format('Y-m-d')) < strtotime($row['Fecha'])) {
        $data[] = $row;
    }
    
}


echo json_encode(array("disponibles" => $data));
