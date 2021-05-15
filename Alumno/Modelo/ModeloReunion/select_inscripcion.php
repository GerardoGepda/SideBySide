<?php

include_once "../../../BaseDatos/conexion.php";
session_start();
$_SESSION['Email'];

$stmt1 = $pdo->prepare("SELECT * FROM `alumnos` WHERE correo='" . $_SESSION['Email'] . "'");
// Ejecutamos
$stmt1->execute();

while ($fila = $stmt1->fetch()) {
    $name = $fila["Nombre"];
    $id = $fila["ID_Alumno"];
}


header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);

$data = array();

$sql = "SELECT * FROM inscripcionreunion i  INNER JOIN alumnos 
a on a.ID_Alumno = i.id_alumno WHERE i.id_alumno = '$id' ";

$query = $pdo->query($sql);

while ($r = $query->fetch()) {
    $data[] = $r;
}
echo json_encode(array("lista1" => $data));
